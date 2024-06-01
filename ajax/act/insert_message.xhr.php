<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	
	// validating and sanitizing name
	$nam = $_POST['nm'];
	if(empty($nam)){$error['nme'] = "* Name cannot be empty";}else{$name = strtolower(test_input($nam));}
	
	// validating and sanitizing email
	$emai = $_POST['em'];
	if(empty($emai)){$error['eme'] = "* Email cannot be empty";}elseif(!regex('email',$emai)){$error['eme'] = "* Invalid email";}else{$email = strtolower(test_input($emai));}
	
	// validating and sanitizing subject
	$sub = $_POST['sb'];
	if(empty($sub)){$error['sbe'] = "* Subject cannot be empty";}else{$subject = strtolower(test_input($sub));}
	
	// validating and sanitizing message
	$mess = $_POST['ms'];
	if(empty($mess)){$error['mse'] = "* Message cannot be empty";}else{$user_message = test_input($mess);}
	
	
	if(empty($error)){
		$message = new message('admin');
		$message->name = $name;
		$message->email = $email;
		$message->subject = $subject;
		$message->message = $user_message;
		$insert = $message->insert_message();
		if($insert === 'success'){
			$data["status"] = 'success';$data["message"] = "<b class='j-text-color9'>Thanks!!!</b>!<br>Message successfully sent";
			//SEND MAIL
			$mail = new mail();
			$mail->p_receiver = get_json_data('support_email','about_us');
			$mail->p_subject = $subject;
			$mail->p_message = $user_message;
			$mail->p_header = implode("\r\n",[
					"From:".$name." <".$email.">",
					"MIME-Version: 1.0",
					"Content-Type: text/html; charset=UTF-8"
					]);
			$mailsent = $mail->send_mail();
		}else{
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occur while sending message, try again later";
		}

	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>