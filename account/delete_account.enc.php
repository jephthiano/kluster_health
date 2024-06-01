<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
$page_url = file_location('home_url','account/delete_account/');// session check
require_once(file_location('inc_path','session_check.inc.php'));
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "DELETE ACCOUNT";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
?>
<!DOCTYPE html >
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color4"style="font-family: Roboto,sans-serif;width:100%;"onload="">
    <?php require_once(file_location('inc_path','page_load.inc.php')); //page loader?>
    <div class="j-row">
		<?php require_once(file_location('inc_path','side_bar_1.inc.php')); //first side bar?>
		<div id=""class="j-col m10">
			<div class="j-main-body">
				<div class=''style="width:100%;">
					<span class='j-hide-large j-hide-xlarge'>
						<?php
						$header="Delete Account";$back="back"; get_header($header,$back,$menu='','','','j-color1');
						?>
					</span>
					<div class="j-row">
						<div class="j-col l8 j-color6">
							<div class="j-color1 j-padding j-hide-small j-hide-medium"style="position:sticky;top:0;"><?=$header?></div>
							<div class=''>
								<div class='j-padding'>
                                    <div class='j-text-color7'>
                                        <div class="j-text-color3 j-bolder j-large">Delete your account</div>
                                        <div style="margin-top:10px;">
                                            Deleting your account is permanent, your account will be totally removed.
                                        </div>
                                        <div style="margin-top:10px;">
                                            Your data and contents will all be deleted and will not be retrieveable.
                                        </div>
                                        <div style="margin-top:10px;"class='j-text-color8'>
                                            Please note that this action is not reversible.
                                        </div>
                                    </div>
                                    <form id='ddafrm'style="margin-top:10px;"method='post'>
                                        <?php
                                        get_form_password('ddasbtn');//for password input
                                        get_form_button('ddasbtn','Delete Account','disabled');// submit button
                                        ?>
                                    </form>
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