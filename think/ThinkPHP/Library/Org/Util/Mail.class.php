<?php
namespace Org\Util;
use Org\Util\PHPMailer;
class Mail{
/**
 * -------------邮件发送函数-----------------------
 * $addresser_email		发件人邮箱
 * $addresser			发件人昵称或姓名
 * $title		        邮件标题（主题）
 * $emial_content   	邮件内容
 * $email_recipients	收件人邮箱
 * ------------------------------------------------
 **/
 
 function sendMail($addresser_email,$addresser,$title,$email_recipients,$emial_content,$code = "utf-8"){
	 $note = FS('Dynamic/note');
       if(!$note){
        $add = M('system')->select()[0];
        $note = FS('note',$add,'Dynamic/');
       }
	$mail= new PHPMailer();
	$mail->CharSet = $code; 					// 编码格式
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                    // 必填，SMTP服务器是否需要验证，true为需要，false为不需要
	$mail->Host       = $note['smtp_server'];    // 必填，设置SMTP服务器 
	$mail->Port       = $note['smtp_port'];      //$smtp_port;       // 设置端口
	$mail->Username   = $note['smtp_user'];     // 必填，开通SMTP服务的邮箱；任意一个163邮箱均可
	$mail->Password   = $note['smtp_pw'];       // 必填， 以上邮箱对应的密码
	$mail->From       = $addresser_email;       // 必填，发件人Email
	$mail->FromName   = $addresser;             // 必填，发件人昵称或姓名
	$mail->Subject    = $title	;       		// 必填，邮件标题（主题）
	
	//可选，纯文本形势下用户看到的内容
	//$mail->AltBody    = "This is the body when user views in plain text format"; 
	$mail->WordWrap   = 50; 				    // 自动换行的字数
	
	$mail->MsgHTML($emial_content );//邮件内容
	// $mail->AddReplyTo($result_mail);			// 收件人回复的邮箱地址
	$mail->AddAddress($email_recipients); 	// 收件人邮箱
	$mail->IsHTML(true); 						// 是否以HTML形式发送，如果不是，请删除此行
	$mail->Send();
}
}// $mail= new PHPMailer();
	// $mail->CharSet = $code; 					// 编码格式
	// $mail->IsSMTP();
	// $mail->SMTPAuth   = true;                   // 必填，SMTP服务器是否需要验证，true为需要，false为不需要
	// $mail->Host       = 'ssl://smtp.163.com';   // 必填，设置SMTP服务器 
	// $mail->Port       = 465;//$smtp_port;       // 设置端口
	// $mail->Username   = 'qin314752@163.com';    // 必填，开通SMTP服务的邮箱；任意一个163邮箱均可
	// $mail->Password   = 'qin314752';            // 必填， 以上邮箱对应的密码
	// $mail->From       = 'qin314752@163.com';    // 必填，发件人Email
	// $mail->FromName   = 'zhongyuan';             // 必填，发件人昵称或姓名
	// $mail->Subject    = 'title车市';       			// 必填，邮件标题（主题）
	
	// //可选，纯文本形势下用户看到的内容
	// //$mail->AltBody    = "This is the body when user views in plain text format"; 
	// $mail->WordWrap   = 50; 				    // 自动换行的字数
	
	// $mail->MsgHTML('asdasadfasdgarfgadfhgasdfhsadfgasdf');//邮件内容
	// // $mail->AddReplyTo($result_mail);			// 收件人回复的邮箱地址
	// $mail->AddAddress('qin713640@163.com'); 	// 收件人邮箱
	// $mail->IsHTML(true); 						// 是否以HTML形式发送，如果不是，请删除此行
	// $mail->Send();