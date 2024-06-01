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
	}elseif(content_data('patient_table','p_email',$emai,'p_email') !== false){
		$error['emae'] = "* Email has been registered ";
	}else{$email = strtolower(test_input($emai));}
		
	// validating and sanitize password
	$pass = ($_POST['pss']);
	if(empty($pass)){$error['psse'] = "* Password cannot be empty";}else{$password = test_input($pass);}
		
	if(empty($error) and empty($missing)){
		$patient = new patient('admin');
		$patient->unique_id = 'id0_'.time_token();
		$patient->fullname = $fullname;
		$patient->email = $email;
		$patient->password = hash_pass($password);
		$patient_id = $patient->sign_up();
		if($patient_id == true && is_numeric($patient_id)){
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
			require_once(file_location('inc_path','session_set.inc.php'));//setting session
			$data["status"] = 'success';$data["message"] = file_location('home_url','');
		}elseif($patient_id === false){
			$data["status"] = 'fail';$data["message"] = "<b class='j-text-color8'>Sorry!!!</b><br>Error occurred while creating account, please try again later.<br>";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>