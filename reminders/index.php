<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','reminder/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "REMINDER | ".strtoupper(get_xml_data('company_name'));
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
						<div class='j-color6'style="width:100%;max-width:800px">
							<?php $header="Reminders";$back="hide"; get_header($header,$back,'','','','j-color1');?>
							<?php
							$unconfirmed_id = multiple_content_data('patient_adherence_table','pma_id',$p_id,'p_id',"AND pma_status IN ('notified','pending') ORDER BY pma_id DESC");
							if($unconfirmed_id === false){ //if patient has no medications
								?>
								<br><br>
								<div class='j-center j-padding'>You haven't registered any medication</div>
								<div class='j-center j-margin'>
									<a href="<?=file_location('home_url','health/')?>">
									<span class='j-text-color5 j-button j-color1'style="padding:5px 24px;border-radius:15px;">Register</span>
									</a>
								</div>
								<?php
							}else{//if patient has medication
								?>
								<div class='j-vertical-scroll'id=''style='margin:5px 0px;padding:5px 5px;'>
									<div class='j-center'style="padding:10px 0px;">
										<span id='t_next_medication'class="j-padding j-clickable laucher j-btn j-round j-color1 j-text-color4"onclick="hornavigation('next_medication',$(this));"style="margin-right:20px"><b>Next Med</b></span>
										<span id='t_unconfirmed_medication'class="j-padding j-clickable laucher j-btn j-round j-color6 j-text-color1"onclick="hornavigation('unconfirmed_medication',$(this));"><b>Unconfirmed Med</b></span>
									</div>
								</div>
								<div id='rem'>
									<?php patient_section_data('reminder');?>
								</div>
								<?php
								
							}
							?>
							<br><br>
						</div>
				</div>
			</div>
			<?php require_once(file_location('inc_path','side_bar_2.inc.php')); //second side bar?>
	</div>
	<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>