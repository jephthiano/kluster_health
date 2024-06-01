<?php
if(isset($_GET['value'])){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = '';
	$ty = ($_GET['value']);

	if($ty === 'req'){
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$d_id = test_input($ido);}
		if(empty($error)){
			$counter = get_numrow('guidance_request_table','gr_status','pending',"return",'no round',"AND d_id = {$d_id}");
			if($counter > 9){$counter = "9+";}
		}
	}elseif($ty === 'pat'){
		$ido = removenum($_GET['id']);if(empty($ido)){$error = "empty";}else{$d_id = test_input($ido);}
		if(empty($error)){
			$counter = distinct_numrow('guidance_request_table','p_id','gr_status','accepted',"return",'no round',"AND d_id = {$d_id}");
			if($counter > 9){$counter = "9+";}
		}
	}else{
		$error = 'no value';
	}
	
	if(empty($error)){
		echo $counter;
	}else{
		echo '';
	}
}
?>