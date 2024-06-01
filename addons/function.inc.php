<?php
$link_type = 'internal_link';$local_url = 'https://'.$_SERVER['SERVER_NAME'];
//test input starts
function test_input($data){
 $data = htmlspecialchars($data,ENT_QUOTES,'UTF-8',true);
	$data = htmlentities($data,ENT_QUOTES,'UTF-8',true);
	$data = trim($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
 return $data;
}
//test input ends

//file location starts
function file_location($type='home_url',$filename = ''){
 global $link_type, $local_url;
 if(strstr($local_url,'000webhostapp') || $link_type === 'internal_link'){
  $home_root = $_SERVER['DOCUMENT_ROOT'];
  $home_url = $local_url.'/';
  $admin_url = $local_url.'/admin/';
  $doctor_url = $local_url.'/doctor/';
 }else{
  //for home document root
  $home_root = str_replace('/admin','',$home_root);
  //for url
  $home_url = "https://www.klusterhealth.com/";
  $admin_url = "https://admin.klusterhealth.com/";
  $admin_url = "https://doctor.klusterhealth.com/";
 }
	if($type === 'media_path'){// MEDIA
		return ($home_root.'/media/'.$filename);
	}elseif($type === 'media_url'){
		return ($home_url.'media/'.$filename);
	}elseif($type === 'home_url'){// ABSOLUTE SECTION URL
		return ($home_url.$filename);
	}elseif($type === 'admin_url'){
		return ($admin_url.$filename);
	}elseif($type === 'doctor_url'){
		return ($doctor_url.$filename);
	}elseif($type === 'ajax_url'){// AJAX URL
		return ($home_url.'ajax/'.$filename);
	}elseif($type === 'admin_ajax_url'){
		return ($admin_url.'ajax/'.$filename);
	}elseif($type === 'doctor_ajax_url'){
		return ($doctor_url.'ajax/'.$filename);
	}elseif($type === 'home_path'){ //ABSOLUTE PATHS
		return ($home_root.'/'.$filename);
	}elseif($type === 'admin_path'){
		return ($home_root.'/admin/'.$filename);
	}elseif($type === 'doctor_path'){
		return ($home_root.'/doctor/'.$filename);
	}elseif($type === 'inc_path'){// ADDS ON PATH
		return ($home_root.'/addons/'.$filename);
	}elseif($type === 'admin_inc_path'){
		return ($home_root.'/admin/addons/'.$filename);
	}elseif($type === 'doctor_inc_path'){
		return ($home_root.'/doctor/addons/'.$filename);
	}
}
//file location ends

$fur = ['json','xml','general','server_and_page','file_upload','date_and_time','device_and_location','get_database','social_handle','modal','form','patient','medication','adherence','doctor'];
foreach($fur AS $section){ require_once(file_location('inc_path',"functions/$section.fuc.php"));}
?>