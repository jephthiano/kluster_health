<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','health/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "MEDICAL | ".strtoupper(get_xml_data('company_name'));
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
				<?php require_once(file_location('inc_path','navigation.inc.php'));?>
				<div class="j-main-body">
					<div class='j-center'style="width:100%;max-width:800px">
						<span>
							<?php $header="Medical Condition";$back="hide"; get_header($header,$back,'','','','j-color1');?>
						</span>
						<div id="hth"class="j-padding">
							<?php patient_section_data('health',$p_id);?>
						</div>
						<br><br>
					</div>
				</div>
			</div>
			<?php patient_modal('medical_cond_form')?>
			<?php require_once(file_location('inc_path','side_bar_2.inc.php')); //second side bar?>
		</div>
	<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>