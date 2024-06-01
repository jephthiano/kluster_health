<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "ACCOUNT";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('doctor_inc_path','session_check.inc.php'));
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class='j-color4'style="font-family:Roboto,sans-serif;width:100%;"onload="">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<div class="j-row">
		<?php require_once(file_location('doctor_inc_path','side_bar_1.inc.php')); //first side bar?>
		<div id=""class="j-col m10">
			<?php require_once(file_location('doctor_inc_path','navigation.inc.php'));?>
			<div class="j-main-body">
				<div class=''style="width:100%;">
					<span class='j-hide-large j-hide-xlarge'>
						<?php
						$fullname = (content_data('doctor_table','d_fullname',$d_id,'d_id'));
						$menu = "<span class='j-clickable j-large'onclick=\"$('#settings_modal').show()\"><b><i class='".icon('bars')."'></i></b></span>";
						$header="Profile";$back="hide"; get_header($header,$back,$menu,'','','j-color9');
						?>
					</span>
					<div class="j-row">
						<div class="j-col l8">
							<div class="j-color9 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
							<div class='j-color6'>
								<div class='j-color9'style='heiht:200px;padding:8px 16px 16px 16px;'>
									<center>
										<img src="<?=file_location('media_url',get_media('doctor',$d_id))?>"class='j-circle j-border j-border-color5'style='width:100px;height:100px;'/>
									</center>
									<div class='j-center'style="margin-bottom:5px;"><?=ucwords($fullname);?></div>
									<a href="<?=file_location('doctor_url','/account/edit_profile/')?>"><div class='j-right j-border-2  j-border-color4 j-text-color4 j-btn j-paddig j-round'>Edit Profile</div></a>
									<br class='j-clearfix'>
								</div>
								<div class='j-padding j-color6'style='line-height:35px;'>
									<div>
										<span class='j-bolder j-text-color7'>EMAIL: </span> <span class='j-right'><?=content_data('doctor_table','d_email',$d_id,'d_id')?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="j-col l4 j-hide-small j-hide-medium">
							<?php require_once(file_location('doctor_inc_path','settings.inc.php')); //settings bar?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php require_once(file_location('doctor_inc_path','side_bar_2.inc.php')); //second side bar?>
		<?php doctor_modal('log_out',$d_id);doctor_modal('settings',$d_id)?>
	</div>
	<?php require_once(file_location('doctor_inc_path','js.inc.php'));?>
</body>
</html>