<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	// validating and sanitizing name
	$nam = ($_POST['fnm']);
	if(empty($nam)){$error['fnme'] = "* Name cannot be empty";}else{strtolower($fullname = test_input($nam));}
	
	// validating and sanitizing email
	$emai = ($_POST['ema']);
	if(empty($emai)){
		$error['emae'] = "* Email cannot be empty";
	}elseif(!regex('email',$emai)){
		$error['emae'] = "* Invalid email";
	}elseif(content_data('doctor_table','d_email',$emai,'d_email') !== false){
		$error['emae'] = "* Email has been registered ";
	}else{$email = strtolower(test_input($emai));}
	
	// validating and sanitizing email
	$rgidi = ($_POST['rgid']);
	if(empty($rgidi)){
		$error['rgide'] = "* Reg id cannot be empty";
	}elseif(!is_numeric($rgidi)){
		$error['rgide'] = "* Invalid reg_id";
	}else{$reg_id = strtolower(test_input($rgidi));}
	
	// validating and sanitize password
	$pass = ($_POST['pss']);
	if(empty($pass)){$error['psse'] = "* Password cannot be empty";}else{$password = test_input($pass);}
		
	if(empty($error) and empty($missing)){
		$doctor = new doctor('admin');
		$doctor->fullname = $fullname;
		$doctor->email = $email;
		$doctor->password = hash_pass($password);
		$doctor->reg_id = $reg_id;
		$doctor_id = $doctor->sign_up();
		if($doctor_id == true && is_numeric($doctor_id)){
			//SEND MAIL
//			$company_email = get_json_data('support_email','about_us');
//			$company_name = ucwords(get_xml_data('company_name'));
//			$mail = new mail();
//			$mail->p_receiver = $email;
//			$mail->p_subject = "Welcome To {$company_name}";
//			$mail->p_message = welcome_message($name);
//			$mail->p_header = implode("\r\n",[
//								"From:".$company_name." <".$company_email.">",
//								"MIME-Version: 1.0",
//								"Content-Type: text/html; charset=UTF-8"
//                            ]);
//			$mailsent = $mail->send_mail();
			require_once(file_location('doctor_inc_path','session_set.inc.php'));//setting session
			$data["status"] = 'success';$data["message"] = file_location('doctor_url','');
		}elseif($doctor_id === false){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while creating account, please try again later.<br>";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>