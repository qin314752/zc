<?php
    /**
    * 安全检测（目录权限安全，样式目录和上传目录的权限）
    */
   class ScanAction extends ACommonAction
   {
       protected $safe = array ('type' => 'php|js','code' => '','func' => 'com|system|exec|eval|escapeshell|cmd|passthru|base64_decode|gzuncompress','dir' => '', 'md5_file'=>'');
       protected $ban_arr = array(
                        'config.php',
                        'db.inc.php',
                        'Lib.php',
                        'jquery.jBox.min.js',
                        'jquery.jBoxConfig.js',
                    );
       /**
       * 默认首页木马检测表单
       * 
       */
       public function index()
       {   
           $info = FS('Dynamic/scan/scanconfig');
           if(!$info) $info = $this->safe;
           $dirs = $this->getDir($info['dir']);
           $this->assign('dirs', $dirs);
           $this->assign('info', $info);
           $this->display();
       }
       public function scanReport()
       {
           $scan_badfile = FS('Dynamic/scan/badfile');
           foreach($scan_badfile as $key=>$val){
               $list[$key]['func_num'] = isset($val['func'])?count($val['func']):0;
               $list[$key]['code_num'] = isset($val['code'])?count($val['code']):0;

               if(isset($val['func'])){
                   $list[$key]['func'] = $this->each_badfile($val['func']);
               }
               if(isset($val['code'])){ 
                   $list[$key]['code'] = $this->each_badfile($val['code']);
               } 
           }
           $this->assign('list', $list);
           $this->display();
       }
       
       private function each_badfile($arr)
       {   
           if(count($arr)){
               foreach($arr as $k=>$v){
                   $bad[$k] = strtolower($v[1]);
               }
               $bad = array_unique($bad); 
               return implode(',', $bad);   
           }
           return null;
       }
       /**
       * 更新配置文件
       * 
       */
       public function updateConfig()
       {
           $config = isset($_POST['info'])? $_POST['info']:$this->safe;
           $config['dir'] = $_POST['dir'];
           FS('scanconfig', $config, 'Dynamic/scan/');
           $this->success("文件配置成功！准备文件筛选...", U("fileFilter"));
       }
       /**
       * 特征函数过滤
       * 
       */
       public function fileFunc()
       {
           set_time_limit(600);
           $scan_list = FS('Dynamic/scan/scan_file_list');
           $scan_config = FS('Dynamic/scan/scanconfig');
           if(isset($scan_config['func']) && !empty($scan_config['func'])){
               foreach($scan_list as $k=>$v){
                   $html = file_get_contents($_SERVER[DOCUMENT_ROOT].$k);
                   if(preg_match_all('/[^a-z]?('.$scan_config['func'].')/i', $html, $state, PREG_SET_ORDER)){
                       $badfiles[$k]['func'] = $state;
                   }
               }
           }
           if(!isset($badfiles)) $badfiles = array();
          
           $this->writeCache('webconfig/scan/badfile', $badfiles); 
           unset($badfiles);
           $this->success("特征函数过滤完成，进行特征代码过滤...", U("filecode"));
       }
       
       /**
       * 特征代码过滤
       */
       public function fileCode()
       {
           set_time_limit(600);
           $scan_list = FS('Dynamic/scan/scan_file_list');
           $scan_config = FS('Dynamic/scan/scanconfig');
           $badfiles = FS('Dynamic/scan/badfile');
           if(isset($scan_config['code']) && !empty($scan_config['code'])){  
               foreach($scan_list as $k=>$v){
                   $html = file_get_contents($_SERVER['DOCUMENT_ROOT'].$k);  
                   if(preg_match_all('/[^a-z]?('.$scan_config['code'].')/i', $html, $state, PREG_SET_ORDER)){
                       $badfiles[$k]['code'] =  $state;
                   }
               }
           }   
           if(!isset($badfiles)) $badfiles = array();
           
           $this->writeCache('webconfig/scan/badfile', $badfiles);
           unset($badfiles);  
           $this->success("扫描完成！", U("scanReport"));
           
       }
       
       private function writeCache($path, $data)
       {
           $document_root = $_SERVER[DOCUMENT_ROOT];
           $file =  $document_root.'/'.$path.'.php';
           if(file_exists($file)){ 
               @unlink($file);
               sleep(1);
           }
           $data = "<?php \n return ".var_export($data, true)." ?>";
           file_put_contents($file, $data);
           
       }
       
       /**
       * 对扫描文件进行筛选
       * 遍历配置文件中所有的dir 如果是文件直接判断文件类型，是目录则进行遍历目录中的所有文件
       */
       public function fileFilter()
       {
           $info = FS('Dynamic/scan/scanconfig');
           $dir = $info['dir'];
           $list = array();
           set_time_limit(120);
           $scan_type = explode("|", $info['type']);
           foreach($info['dir'] as $path){
               foreach($scan_type as $v){
                   if(is_dir($path)){
                       $list = array_merge($list, $this->file_list($path, $v));
                       continue;
                   }elseif($this->checkEx($path, $v)){ 
                       $list = array_merge($list, array(str_replace($_SERVER[DOCUMENT_ROOT],"", $path)=>md5($path)));
                       continue;
                   }
               }
           }
           unset($list['/App/Runtime/~runtime.php']);
           FS('scan_file_list', $list, 'Dynamic/scan/');
           $this->success("文件筛选完成！进行特征函数过滤...", U('filefunc'));
       }
       
       public function view()
       {
           $file = isset($_GET['file'])?$_GET['file']:'';
           $code = $_GET['code'];
           $func = $_GET['func'];
           if(!empty($file)){
               $document_root = $_SERVER[DOCUMENT_ROOT];
               if(file_exists($document_root.$file)){
                   $html = htmlspecialchars(file_get_contents($document_root.$file));
               }else{
                   $html = "文件不存在";
               }
           }else{
               $html =  '参数错误！';
           }
           $this->assign('func', $func);
           $this->assign('code', $code);
           $this->assign('file', $file);
           $this->assign('html', $html);
           $this->display();
       }
       private function  getDir($select_dir=array())
       {
           $document_root = $_SERVER['DOCUMENT_ROOT'];
           if(is_dir($document_root)){
               $handle = @opendir($document_root);
               while(($file = readdir($handle))!=false){
                   if($file!='.' && $file !='..'){
                       $dir['dir'] =  $document_root.'/'.$file;
                       $dir['type'] = filetype($dir['dir']);
                       $dir['file'] = iconv('GB2312', 'UTF-8', $file);
                       if(count($select_dir) && in_array($dir['dir'], $select_dir)){
                           $dir['selected'] = 1;
                       }else{
                           $dir['selected'] = 0;
                       }
                       $dirs[] = $dir;
                   }
               } 
               closedir($handle);  
           }
           
           if(is_array($dirs)){
               foreach($dirs as $key=>$value){
                   $type[$key]=$value['type'];
               }
               array_multisort($type, SORT_ASC, $dirs);
           }
           return $dirs;
       }
       
       private function file_list($path, $ex)
       {
           $list = array();
           $headle = opendir($path);
           while(($file = readdir($headle))!==false){
               if($file!='.' && $file!='..'){
                   $file = $path.'/'.$file;
                   if(is_dir($file)){
                       $list = array_merge($list, $this->file_list($file, $ex));
                   }else{
                       if($this->checkEx($file, $ex)){
                           $list = array_merge($list, array(str_replace($_SERVER['DOCUMENT_ROOT'], "", $file)=>md5($file)));
                       }
                   }
               }
           }
           closedir($headle);
           return $list;
       }
       
       private function checkEx($file, $ex)
       {
           $file_name = basename($file);   
           if(in_array($file_name, $this->ban_arr)){
              return false;
           }else{
               $ex_num = strlen($ex);
               if(substr($file, -$ex_num, $ex_num)==$ex){
                   return true;
               }
           }
           return false;
       }
   }
?>
