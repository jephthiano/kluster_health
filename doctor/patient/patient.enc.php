<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('doctor_inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){
		$p_id = content_data('patient_table','p_id',$raw_val,'p_id');
		$doctor_id = content_data('guidance_request_table','gr_id',$raw_val,'p_id',"AND d_id = {$d_id}");
		if($p_id === false || $doctor_id === false){
			trigger_error_manual(404);
		}
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
}
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "PATIENTS DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="boy"class=''style="font-family:Roboto,sans-serif;width:100%;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<div class="j-row">
			<?php require_once(file_location('doctor_inc_path','side_bar_1.inc.php')); //first side bar?>
			<div id=""class="j-col m10">
				<?php require_once(file_location('doctor_inc_path','navigation.inc.php'));?>
				<div class="j-main-body">
					<?php
					$status = (content_data('doctor_table','d_status',$d_id,'d_id'));
					if($status === 'pending'){
						?>
						<div class='j-paddng-large j-round-large j-color6 j-margin'style="line-height:30px;padding: 26px 24px">
							<div class='j-large j-text-color8 j-bolder'>Your Profile is awaiting confirmation</div>
							<div class='j-text-color8'>Our admin are working on verifying your medical certification</div>
							<div class=''>
								You can complete some account settings in the mean time.
							</div>
						</div>
						<br>
						<?php
					}else{
						$fullname = content_data('patient_table','p_fullname',$p_id,'p_id');
						?>
						<div class=''style="width:100%;">
							<span class='j-hide-large j-hide-xlarge'>
								<?php $header="{$fullname} Data";$back="back"; get_header($header,$back,$menu='','','','j-color9'); ?>
							</span>
							<div class="j-row">
								<div class="j-col l7 j-color6">
									<div class="j-color9 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
									<div class='j-padding'>
										<center>
											<img src="<?=file_location('media_url',get_media('patient',$p_id))?>"class='j-circle j-border j-border-color5'style='width:100px;height:100px;'/>
										</center>
										<div class='j-center'style="margin-bottom:5px;"><?=ucwords($fullname);?></div>
										<div class='j-padding j-color6'style='line-height:35px;'>
											<div>
												<span class='j-bolder j-text-color7'>EMAIL: </span> <span class='j-right'><?=content_data('patient_table','p_email',$p_id,'p_id')?></span>
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
										</div>
									</div>
									<br><br>
								</div>
								<div class="j-col l5">
									<div style="margin:0px 16px;">
										<div class="j-color7 j-padding">Medications</div>
										<div class='j-color6'>
											<?php
											$ph_idor = multiple_content_data('guidance_request_table','ph_id','accepted','gr_status',"AND p_id = {$p_id} AND d_id = {$d_id}",);
											foreach($ph_idor AS $ph_id){
												$illness = content_data('patient_health_table','ph_illness',$ph_id,'ph_id');
												?>
												<div class='j-padding'>
													<div class="j-bolder j-text-color7"><?=ucwords($illness)?> Medications</div>
													<?php
													$pmd_idor = multiple_content_data('patient_medication_table','pmd_id',$ph_id,'ph_id',"AND p_id = {$p_id}",);
													if($pmd_idor === false){
														?><div class='j-padding'> No medication added yet</div><?php
													}else{
														foreach($pmd_idor as $pmd_id){
															$name = content_data('patient_medication_table','pmd_name',$pmd_id,'pmd_id');
															?>
															<a href="<?=file_location('doctor_url','patient/medication/'.addnum($pmd_id).'/')?>">
															<div class="j-color9 j-padding j-round"style="margin:10px 0px;">
																<div class="j-large j-bolder"><?=$name?></div>
																<div class='j-margin j-center'>
																	<div class="j-btn j-border-2 j-border-color8 j-text-color4 j-round-large">View Adherence Data</div>
																</div>
															</div>
															</a>
															<?php
														}
													}
													?>
												</div>
												<br>
												<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<br><br><br><br>
			</div>
			<?php require_once(file_location('doctor_inc_path','side_bar_2.inc.php')); //second side bar?>
		</div>
<?php require_once(file_location('doctor_inc_path','js.inc.php'));?>
</body>
</html>