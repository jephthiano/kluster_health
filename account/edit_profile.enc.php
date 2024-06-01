<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','account/edit_profile/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "EDIT PROFILE | ".strtoupper(get_xml_data('company_name'));
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
				<div class=''style="width:100%;">
					<span class='j-hide-large j-hide-xlarge'>
						<?php $header="Edit Profile";$back="back"; get_header($header,$back,$menu='','','','j-color1');?>
					</span>
					<div class="j-row">
						<div class="j-col l8 j-color6">
							<div class="j-color1 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
							<div class=''>
								<div class='j-cener'>
									<br>
									<div id='patient'class='j-center'><?php patient_section_data('profile_pic',$p_id);?></div>
									<div class='j-padding'>
										<?php
										$phnumber = content_data('patient_table','p_phnumber',$p_id,'p_id');
										$gender = content_data('patient_table','p_gender',$p_id,'p_id');
										$country = content_data('patient_table','p_country',$p_id,'p_id');
										$state = content_data('patient_table','p_state',$p_id,'p_id');
										$address = content_data('patient_table','p_address',$p_id,'p_id');
										$gender_array = ['prefer not to say','male','female'];
										?>
										<form id='eupfrm'method='post'>
											<?php
											get_form_type('tel','phn','sppbtn','Mobile Number',$phnumber,'3','15','Mobile Number');//for mobile number input
											get_form_select('gd',$gender_array,$gender,'Gender','Gender');//for gender input
											get_form_type('text','ct','','Country',$country,'2','50','Country','',' ');//for country input
											get_form_type('text','ste','','State',$state,'2','50','State','',' ');//for state input
											get_form_textarea('add','','Address',$address,'4','5','200','Address','',' ');//for address input
											get_form_button('sppbtn','Save')// submit button
											?>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="j-col l4 j-hide-small j-hide-medium">
							<?php require_once(file_location('inc_path','settings.inc.php')); //settings bar?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php require_once(file_location('inc_path','side_bar_2.inc.php')); //second side bar?>
		<?php patient_modal('log_out',$p_id);?>
	</div>
	<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>