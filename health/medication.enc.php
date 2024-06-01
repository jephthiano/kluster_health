<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','health/medication/'.@$_GET['val']);
require_once(file_location('inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){
		$pmd_id = content_data('patient_medication_table','pmd_id',$raw_val,'pmd_id');
		$patient_id = content_data('patient_medication_table','p_id',$pmd_id,'pmd_id');
		if($pmd_id === false || $patient_id !== $p_id){
			trigger_error_manual(404);
		}else{
			$medication = content_data('patient_medication_table','pmd_name',$pmd_id,'pmd_id');
		}
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
}
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "MEDICATION | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title>
<script src="<?=file_location('home_url','plugins/google_chart.js');?>"></script>
</head>
<body id="body"class='j-color4'style="font-family:Roboto,sans-serif;width:100%;"onload="">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
	<div class="j-row">
		<?php require_once(file_location('inc_path','side_bar_1.inc.php')); //first side bar?>
		<div id=""class="j-col m10">
			<div class="j-main-body">
				<div class=''style="width:100%;">
					<span class='j-hide-large j-hide-xlarge'>
						<?php
						$header_med = ucwords(text_length($medication,13,'eclipsis'));
						$menu = "<span class='j-clickable j-large'onclick=\"$('#medication_action_modal').show()\"><b><i class='".icon('bars')."'></i></b></span>";
						$header="{$header_med} Medication";$back="back"; get_header($header,$back,$menu,'','','j-color1');
						?>
					</span>
					<div class="j-row">
						<div class="j-col l8 j-color6">
							<div class="j-color1 j-padding j-hide-small j-hide-medium j-top-index"style="position:sticky;top:0;"><?=$header?></div>
							<div class=''>
								<div id="med"class="">
									<?php patient_section_data('medication',$pmd_id);?>
								</div>
								<br>
							</div>
						</div>
						<div class="j-col l4 j-hide-small j-hide-medium">
							<div style="margin-left:16px;max-height:600px;overflow-y:scroll;">
								<div class="j-color7 j-padding">Track Adherence Data</div>
								<div>
									<?php
									$pma_id_array = multiple_content_data('patient_adherence_table','pma_id',$p_id,'p_id',"AND pmd_id = $pmd_id ORDER BY pma_id DESC");
									if($pma_id_array === false){
										?><div class="j-center ">No adherence data is available at the moment</div><?php
									}else{
										get_adherence_data($pma_id_array,'short');
									}
									?>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php require_once(file_location('inc_path','side_bar_2.inc.php')); //second side bar?>
	</div>
	<?php patient_modal('medication_action_modal',$pmd_id);?>
	<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>