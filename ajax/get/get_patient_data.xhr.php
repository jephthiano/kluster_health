<?php
if(isset($_GET['value'])){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = '';
	$ty = ($_GET['value']);

	if($ty === 'patient'){
		$type = "profile_pic";
		$id = $p_id;
	}elseif($ty === 'hth'){
		$type = "health";
		$id = $p_id;
	}elseif($ty === 'hth_con'){
		$type = "health_condition";
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$id = test_input($ido);}
	}elseif($ty === 'med'){
		$type = "medication";
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$pma_id = test_input($ido);}
		$id = content_data('patient_adherence_table','pmd_id',$pma_id,'pma_id',"AND p_id = {$p_id}");
	}elseif($ty === 'hom'){
		$type = "home";
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$id = test_input($ido);}
	}elseif($ty === 'rem'){
		$type = "reminder";
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$id = test_input($ido);}
	}elseif($ty === 'pati'){
		$type = "patient";
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$id = test_input($ido);}
	}else{
		$type = '';$id='';
	}
	if(empty($error)){
		patient_section_data($type,$id); //for edit profile pics
	}
}
?>