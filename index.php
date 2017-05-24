<?php
//删除文件夹及文件夹下所有内容
function Rmall($dirname) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }

    $dir = dir($dirname);//如果对像是目录

    while (false !== $file = $dir->read()) {

        if ($file == '.' || $file == '..') {
            continue;
        }
        if(!is_dir($dirname."/".$file)){
            unlink($dirname."/".$file);
        }else{
            Rmall($dirname."/".$file);
        }
        
        rmdir($dirname."/".$file);
    }

    $dir->close();
    
    rmdir($dirname);

    return true;
}

?>