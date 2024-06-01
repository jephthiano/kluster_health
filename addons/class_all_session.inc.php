<?php
function all_session($type='patient'){
 if(strstr($_SERVER['SERVER_NAME'],'admin.') || strstr($_SERVER['PHP_SELF'],'/admin')){
   require_once(file_location('admin_inc_path','session_start.inc.php'));
   if(isset($_SESSION['admin_id']) || strstr($_SERVER['PHP_SELF'],'/admin')){
    $cla_current_admin = test_input(ssl_decrypt_input($_SESSION['admin_id']));
   }
 }elseif(strstr($_SERVER['SERVER_NAME'],'doctor.') || strstr($_SERVER['PHP_SELF'],'/doctor')){
  require_once(file_location('doctor_inc_path','session_start.inc.php'));
   if(isset($_SESSION['doctor_id'])){
    $cla_current_doctor = test_input(ssl_decrypt_input($_SESSION['doctor_id']));
   }
 }else{
    require_once(file_location('inc_path','session_start.inc.php'));
    if(isset($_SESSION['patient_id'])){
     $cla_current_patient = test_input(ssl_decrypt_input($_SESSION['patient_id']));
  }
 }
 if($type === 'admin' && isset($cla_current_admin)){
  return $cla_current_admin;
 }elseif($type === 'doctor' && isset($cla_current_doctor)){
  return $cla_current_doctor;
 }elseif($type === 'patient' && isset($cla_current_patient)){
  return $cla_current_patient;
 }else{
  return '';
 }
 }