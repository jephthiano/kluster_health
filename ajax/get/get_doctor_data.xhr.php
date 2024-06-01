<?php
if(isset($_GET['value'])){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = '';
	$ty = ($_GET['value']);

	if($ty === 'ill_doc'){ //for med condition doctor search at medical professional page
		$type = "illness_doctors";
		$id = $_GET['id'];
	}elseif($ty === 'mcd'){ // for doct section in med condition page
		$type = "med_cond_doctor";
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$id = test_input($ido);}
	}else{
		$type = '';$id='';
	}

	if(empty($error)){
		doctor_section_data($type,$id);
	}
}
?>