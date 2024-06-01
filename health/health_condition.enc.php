<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','health/health_condition/'.@$_GET['val']);
require_once(file_location('inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){
		$ph_id = content_data('patient_health_table','ph_id',$raw_val,'ph_id');
		$patient_id = content_data('patient_health_table','p_id',$ph_id,'ph_id');
		if($patient_id === false || $patient_id !== $p_id){
			trigger_error_manual(404);
		}else{
			$illness = content_data('patient_health_table','ph_illness',$ph_id,'ph_id');
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
$page = "MEDICAL CONDITION | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
?>
<!DOCTYPE html>
<html>

<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title>
</head>

<body id="body" class='j-color4' style="font-family:Roboto,sans-serif;width:100%;" onload="">
    <?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
    <div class="j-row">
        <?php require_once(file_location('inc_path','side_bar_1.inc.php')); //first side bar?>
        <div id="" class="j-col m10">
            <div class="j-main-body">
                <div class='' style="width:100%;max-width:800px">
                    <span>
                        <?php
						$menu = "<span class='j-clickable j-large'onclick=\"$('#health_action_modal').show()\"><b><i class='".icon('bars')."'></i></b></span>";
						$header=ucwords($illness)." Medication";$back="back"; get_header($header,$back,$menu,'','','j-color1');
						?>
                    </span>
                    <div class="j-color5" style="">
                        <div class='j-padding j-large' style='line-height:25px;'>
                            <div>
                                <span class='j-bolder j-text-color3'>Medical Condition: </span> <span
                                    class='j-right'><?=ucwords($illness)?></span>
                            </div>
                            <div>
                                <span class='j-bolder j-text-color3'>Stage: </span> <span
                                    class='j-right'><?=ucwords(content_data('patient_health_table','ph_stage',$ph_id,'ph_id'))?></span>
                            </div>
                            <div>
                                <span class='j-bolder j-text-color3'>Note: </span> <span
                                    class='j-right'><?=ucwords(content_data('patient_health_table','ph_note',$ph_id,'ph_id'))?></span>
                            </div>
                        </div>
                        <br>
                        <div>
                            <div id='mcd'class="j-color7 j-padding">
                                <?php doctor_section_data('med_cond_doctor',$ph_id);?>
                            </div>
                        </div>
                    </div>
                    <div id="hth_con">
                        <?php patient_section_data('health_condition',$ph_id);?>
                    </div>
                </div>
            </div>
        </div>
        <?php patient_modal('medication_form',$ph_id);patient_modal('health_action_modal',$ph_id);?>
    </div>
    <?php require_once(file_location('inc_path','js.inc.php'));?>
</body>

</html>