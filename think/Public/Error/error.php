<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>页面提示</title>
  <script type="text/javascript">
   setTimeout("refresh()",1000);
   function refresh(){
    location.href = "{$jumpUrl}";
   }
  </script>
  <style type="text/css">
   *{margin:0px;padding:0px;font-size:12px;font-family:Arial,Verdana;}
   #wrapper{width:450px;height:200px;background:#F5F5F5;border:1px solid #D2D2D2;position:absolute;top:40%;left:50%;margin-top:-100px;margin-left:-225px;}
   p.msg-title{width:100%;height:30px;line-height:30px;text-align:center;color:#EE7A38;margin-top:40px;font:14px Arial,Verdana;font-weight:bold;}
   p.message{width:100%;height:40px;line-height:40px;text-align:center;color:blue;margin-top:5px;margin-bottom:5px;}
   p.error{width:100%;height:40px;line-height:40px;text-align:center;color:red;margin-top:5px;margin-bottom:5px;}
   p.notice{width:100%;height:25px;line-height:25px;text-align:center;}
  </style>
 </head>

 <body>
  <div id="wrapper">
   <p class="msg-title"><{$msgTitle}></p>
   <present name="message">
    <p class="message"><{$message}></p>
   </present>
   <present name="error">
    <p class="error"><{$error}></p>
   </present>
  
  </div>
 </body>
</html>