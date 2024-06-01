<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','account/medical_professional/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "MEDICAL PROFESSIONALS | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class='j-color4'style="font-family:Roboto,sans-serif;width:100%;"onload="">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<div class="j-row">
		<?php require_once(file_location('inc_path','side_bar_1.inc.php')); //first side bar?>
		<div id=""class="j-col m10">
			<div class="j-main-body">
				<div class=''style="width:100%;max-width:800px">
					<span class='j-hide-large j-hide-xlarge'>
						<?php $header="Your Medical Profesionals";$back="back"; get_header($header,$back,$menu='','','','j-color1');?>
					</span>
					<div class="j-color1 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
					<?php
					$or = multiple_content_data('patient_health_table','ph_id',$p_id,'p_id');
					if($or === false){
						?><div class='j-center j-margin j-bolder j-text-color7'>You have not registered any medication to be monitored by medical professional</div><?php
					}else{
						$gr_id = content_data('guidance_request_table','gr_id',$p_id,'p_id');
						if($gr_id === false){
							?><div class='j-center j-margin j-bolder j-text-color7'>You have not request for medical professional to monitor your medication</div><?php
						}else{
							foreach($or AS $ph_id){
								$d_id = content_data('guidance_request_table','d_id',$p_id,'p_id',"AND ph_id = {$ph_id}");
								$illness = ucwords(content_data('patient_health_table','ph_illness',$p_id,'p_id',"AND ph_id = {$ph_id}"));
								$status = content_data('guidance_request_table','gr_status',$p_id,'p_id',"AND ph_id = {$ph_id} AND d_id = {$d_id}");
								?>
								<div class="j-margin"style="border-bottom: 1px black solid">
									<div style="margin-bottom:10px">
										<div class="j-right j-padding j-color9 j-round">Request <?=$status?></div>
										<div class="j-text-color7 j-bolder j-large"><?=$illness?></div>
										<br class='j-clearfix'>
									</div>
									<?php doctor_section_data('short_profile',$d_id);?>
								</div>
								<?php
							}
						}
					}
					?>
				</div>
			</div>
		</div>
		<?php require_once(file_location('inc_path','side_bar_2.inc.php')); //second side bar?>
	</div>
	<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>