var $p=jQuery.noConflict();
$p(function () {
	 $p("#userName").blur(function(){
     	var userName=$p("#userName").val();
     	if(userName!=""){
     		$p("#userTip").html("");//通过
     	}
     })
     $p("#password").blur(function(){
     	var pwd=$p("#password").val();
     	if(pwd!=""){
     		$p("#pwdTip").html("");//通过
     	}
     })
     $p("#yanzhengma").blur(function(){
        var yzm=$p("#yanzhengma").val();
        if(yzm!=""){
            validate();
        }
     })
})
var code ; //在全局 定义验证码   
    function createCode()   
     {    
       code = "";   
       var codeLength = 4;//验证码的长度   
       var checkCode = document.getElementById("checkCode");   
       var selectChar = new Array(2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z',
    		                     'a','b','c','d','e','f','g','h','i','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z');//所有候选组成验证码的字符，当然也可以用中文的   
            
       for(var i=0;i<codeLength;i++)   
       {   
          
            
       var charIndex = Math.floor(Math.random()*57);   
       code +=selectChar[charIndex];   
           
           
       }   
//       alert(code);   
       if(checkCode)   
       {   
         checkCode.className="code";   
         checkCode.value = code;   
       }   
           
     }   
         
      function validate ()   
     {   
       //var inputCode = document.getElementById("input1").value; 
       var inputCode=$p("#yanzhengma").val();
       if(inputCode.length <=0)   
       {   
           $p("#yzmTip").html("<span style='font-size:12px;color:red;float:left;width:200px;line-height:30px; padding-left:90px;'>请输入验证码</span>");
       }   
       else if(inputCode.toLowerCase() != code.toLowerCase() )   
       {   
          $p("#yzmTip").html("<span style='font-size:12px;color:red;float:left;width:200px;line-height:30px; padding-left:90px;'>验证码错误</span>");
          createCode();//刷新验证码   
       }   
       else   
       {  
    	   $p("#yzmTip").html("");
//         $p("#yzmTip").html("<span style='font-size:12px;color:green;float:left;width:200px;line-height:30px; padding-left:90px;'>输入正确</span>");  
       }   
           
       } 
      function check(form){
    	var user=$p("#userName").val();
    	 if(user == ""){
    		  $p("#userTip").html("<span style='font-size:12px;color:red;float:left;width:200px;line-height:30px; padding-left:90px;'>用户名不能为空</span>");
    		  return false;
    	  }
    	 var pwd=$p("#password").val();
    	  if(pwd==""){
    		  $p("#pwdTip").html("<span style='font-size:12px;color:red;float:left;width:200px;line-height:30px; padding-left:90px;'>密码不能为空</span>");
    		  return false;
    	  }
    	var inputCode=$p("#yanzhengma").val();
       		  if(inputCode.length <=0)   
       {   
           $p("#yzmTip").html("<span style='font-size:12px;color:red;float:left;width:200px;line-height:30px; padding-left:90px;'>请输入验证码</span>");
           return false;
       }   
       else if(inputCode.toLowerCase() != code.toLowerCase() )   
       {   
          $p("#yzmTip").html("<span style='font-size:12px;color:red;float:left;width:200px;line-height:30px; padding-left:90px;'>验证码错误</span>");
          createCode();//刷新验证码   
          return false;
       }
       
       
       	
      }
      $p(window).load(function(){
    	  setTimeout("$p('#error').hide()",3000);
      });
      
     