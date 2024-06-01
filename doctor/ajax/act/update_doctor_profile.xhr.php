<?php
if(isset($_POST)){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$missing = []; $data = [];	
	
	//validating mobile number
	$phn = ($_POST['phn']);
	if(empty($phn)){
		$missing['phne'] = "* Mobile number cannot be empty";
	}elseif(!regex('phonenumber',$phn)){
		$missing['phne'] = "* Invalid mobile number";
	}elseif(content_data('patient_table','p_id',$phn,'p_phnumber') !== false && content_data('patient_table','p_id',$phn,'p_phnumber') !== $p_id){
		$missing['phne'] = "* Mobile number already registered by another user";
	}else{
		$phnumber = test_input($phn);
	}
	
	// validating and sanitizing gender
	$gd = ($_POST['gd']);
	if($gd !== 'male' && $gd !== 'female' && $gd !== 'prefer not to say'){$missing['gde'] = "* invalid selection";}else{$gender = strtolower(test_input($gd));}
	
	// validating and sanitizing country
	$coun = ($_POST['ct']);
	if(empty($coun)){
		$missing['cte'] = "* country cannot be empty";
	}else{
		$country = strtolower(test_input($coun));
	}
	
	// validating and sanitizing state
	$ste = ($_POST['ste']);
	if(empty($ste)){
		$missing['stee'] = "* state cannot be empty";
	}else{
		$state = strtolower(test_input($ste));
	}
	
	// validating and sanitizing bio
	$add = ($_POST['add']);
	if(empty($add)){
		$missing['adde'] = "* address cannot be empty";
	}elseif(strlen($add) > 200){
		$missing['adde'] = "* address can not be more 200 char";
	}else{
		$address = (test_input($add));
	}
	if(empty($missing)){
		$patient = new patient('admin');
		$patient->phnumber = $phnumber;
		$patient->gender = $gender;
		$patient->country = $country;
		$patient->state = $state;
		$patient->address = $address;
		$update_profile = $patient->update_profile();
		if($update_profile === 'success'){
			$data["status"] = 'success';$data["message"] = file_location('home_url',"account/");
		}elseif($update_profile === 'fail'){
			$data["status"] = 'fail';$data["message"] = "No changes made";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
	echo json_encode($data);
}//end of if empty

?>