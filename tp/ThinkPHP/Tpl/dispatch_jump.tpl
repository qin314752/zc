<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title>Document</title>
        <script src="__PUBLIC__/error/js/jquery-1.7.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/error/css/tipDialog.css"/>
        <script type="text/javascript" src="__PUBLIC__/error/js/tipDialog.js"></script>
<body>
<?php if(isset($message)) {?>
            <script>
                $(function(){
                    tipDialog('<?php echo $message ?>','ok','',1);
                    setTimeout(function(){
                        window.location='<?php echo($jumpUrl); ?>';
                    },1000);
                })    
            </script>
        <?php }else{ ?>
            <script>
                $(function(){
                    tipDialog('<?php echo $error ?>','error','',3);
                    setTimeout(function(){
                        window.location='<?php echo($jumpUrl); ?>';
                    },1000);
                })    
            </script>
        <?php } ?>
</body>
</html>
