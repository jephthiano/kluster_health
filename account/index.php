<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','account/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "ACCOUNT | ".strtoupper(get_xml_data('company_name'));
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
				<div class=''style="width:100%;">
					<span class='j-hide-large j-hide-xlarge'>
						<?php
						$fullname = (content_data('patient_table','p_fullname',$p_id,'p_id'));
						$menu = "<span class='j-clickable j-large'onclick=\"$('#settings_modal').show()\"><b><i class='".icon('bars')."'></i></b></span>";
						$header="Profile";$back="hide"; get_header($header,$back,$menu,'','','j-color1');
						?>
					</span>
					<div class="j-row">
						<div class="j-col l8">
							<div class="j-color1 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
							<div class='j-color6'>
								<div class='j-color1'style='heiht:200px;padding:8px 16px 16px 16px;'>
									<center>
										<img src="<?=file_location('media_url',get_media('patient',$p_id))?>"class='j-circle j-border j-border-color5'style='width:100px;height:100px;'/>
									</center>
									<div class='j-center'style="margin-bottom:5px;"><?=ucwords($fullname);?></div>
									<a href="<?=file_location('home_url','/account/edit_profile/')?>"><div class='j-right j-border-2  j-border-color4 j-text-color4 j-btn j-paddig j-round'>Edit Profile</div></a>
									<br class='j-clearfix'>
								</div>
								<div class='j-padding j-color6'style='line-height:35px;'>
									<div>
										<span class='j-bolder j-text-color7'>ID: </span> <span class='j-right'><?=content_data('patient_table','p_unique_id',$p_id,'p_id')?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>EMAIL: </span> <span class='j-right'><?=content_data('patient_table','p_email',$p_id,'p_id')?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>MOBILE NUMBER: </span> <span class='j-right'><?=content_data('patient_table','p_phnumber',$p_id,'p_id','','not avail')?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>GENDER: </span> <span class='j-right'><?=ucwords(content_data('patient_table','p_gender',$p_id,'p_id','','not avail'))?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>COUNTRY: </span> <span class='j-right'><?=ucwords(content_data('patient_table','p_country',$p_id,'p_id','','not avail'))?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>STATE: </span> <span class='j-right'><?=ucwords(content_data('patient_table','p_state',$p_id,'p_id','','not avail'))?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>JOINED: </span> <span class='j-right'><?=show_date(content_data('patient_table','p_regdatetime',$p_id,'p_id','','not avail'),'month')?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>ADDRESS: </span> <span class='j-right'><?=content_data('patient_table','p_address',$p_id,'p_id','','not avail')?></span>
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
		<?php patient_modal('log_out',$p_id);patient_modal('settings',$p_id)?>
	</div>
	<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>