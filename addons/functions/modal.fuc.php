<?php
//MODAL FUNCTION STARTS
//home modal starts
function home_modal($type){
 if($type === 'login'){
  ?>
  <div  id="login_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-color4 dm4"style="width:98%;max-width:400px;height:auto;">
     <div class="j-display-container j-large">
     <div class="j-container j-color2 j-padding"><b>Create Your KlusterHealth Account</b></div>
     <div class='j-padding'style="margin-top:10px;">
      <br>
      <a href="<?=file_location('home_url','login/')?>">
      <div class='j-btn j-medium j-paddng j-border-2 j-border-color1 j-color1 j-round-large j-bolder'style="width:100%">Login In As Patient</div>
      </a>
      <br>
      <div class='j-center j-large j-bolder j-italic j-text-color1'style="margin:10px 0px;">OR</div>
      <a href="<?=file_location('doctor_url','login/')?>">
      <div class='j-btn j-medium j-text-color1 j-paddng j-border-2 j-border-color1 j-round-large j-bolder'style="width:100%">Login In As Medical Professional</div>
      </a>
      <br><br>
      <div class='j-btn j-medium j-paddng j-border-2 j-border-color7 j-round-large j-bolder'style="width:100%"onclick="$('#login_modal').fadeOut('slow');">Close</div>
      <br><br>
     </div>
    </div>
    </div>
   </div>
  <?php
 }

 if($type === 'signup'){
  ?>
  <div  id="signup_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-color4 dm4"style="width:98%;max-width:400px;height:auto;">
     <div class="j-display-container j-large">
     <div class="j-container j-color2 j-padding"><b>Create Your KlusterHealth Account</b></div>
     <div class='j-padding'style="margin-top:10px;">
      <br>
      <a href="<?=file_location('home_url','signup/')?>">
      <div class='j-btn j-medium j-paddng j-border-2 j-border-color1 j-color1 j-round-large j-bolder'style="width:100%">Sign Up As Patient</div>
      </a>
      <br>
      <div class='j-center j-large j-bolder j-italic j-text-color1'style="margin:10px 0px;">OR</div>
      <a href="<?=file_location('doctor_url','signup/')?>">
      <div class='j-btn j-medium j-text-color1 j-paddng j-border-2 j-border-color1 j-round-large j-bolder'style="width:100%">Sign Up As Medical Professional</div>
      </a>
      <br><br>
      <div class='j-btn j-medium j-paddng j-border-2 j-border-color7 j-round-large j-bolder'style="width:100%"onclick="$('#signup_modal').fadeOut('slow');">Close</div>
      <br><br>
     </div>
    </div>
    </div>
   </div>
  <?php
 }
}
//home_modal ends

//patient modal starts
function patient_modal($type,$id='none',$subtype=''){
 if($type === 'settings'){
  ?>
  <div id="settings_modal" class="j-modal j-modal-click">
   <div class="j-card-4 j-modal-content j-modal-content-support2 j-color4 j-round-large">
    <div class="j-display-container">
     <div class="j-container j-color1 j-padding"><b>Settings</b></div>
     <div>
      <div class=''style='line-heght:30px;'>
       <div class='j-padding j-round'>
        <a href="<?= file_location('home_url','account/edit_profile/');?>">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color1 j-xlarge <?=icon('user');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color7 j-text-color7'>Edit Profile</span>
         <div class='j-small'style='margin-left:38px;'>Edit your profile information.</div>
        </div>
        </a>
       </div>
       <div class='j-padding j-round'>
        <a href="<?= file_location('home_url','account/account_security/');?>">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color1 j-xlarge <?=icon('shield-alt');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color7'>Account & Security</span>
         <div class='j-small'style='margin-left:38px;'>Change email, change password, delete account.</div>
        </div>
        </a>
       </div>
       <div class='j-padding j-round'>
        <a href="<?= file_location('home_url','account/medical_professional/');?>">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color1 j-xlarge <?=icon('user-md');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color7'>Medical Professional</span>
         <div class='j-small'style='margin-left:38px;'>View your medical professionals qualifications.</div>
        </div>
        </a>
       </div>
       <div class='j-padding j-round'>
        <a href="<?= file_location('home_url','misc/contact_us/');?>">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color1 j-xlarge <?=icon('users');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color7'>Support</span>
         <div class='j-small'style='margin-left:38px;'>Connect with our support team.</div>
        </div>
        </a>
       </div>
       <div class='j-padding j-round j-clickable'onclick="$('#logout_modal').fadeIn('slow');$('#settings_modal').fadeOut('slow');">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color8 j-xlarge <?=icon('power-off');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color8'>Sign Out</span>
         <div class='j-small j-text-color8'style='margin-left:38px;'>Sign out of your account.</div>
        </div>
       </div>
      </div>
     </div>
    </div>
    </div>
   </div>
   <?php
 }

 if($type === 'log_out'){
 ?>
 <center>
   <div  id="logout_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-color4 j-round-large j-padding dm4"style="width:90%;max-width:400px;height:auto;">
     <div class="j-display-container j-center j-large">
     <div class="j-container"><b>Sign Out ?</b></div>
     <div class="j-medium"style="margin-top:10px;">Are you sure want to sign out of your account?</div>
     <div class='j-medium'>
							<p style='display:inline'><button class="j-margin j-btn j-border j-border-color3 j-round" onclick="$('#logout_modal').fadeOut('slow');">Cancel</button></p>
        <p style='display:inline;'>
         <button id='lobtn'type="submit"class="j-margin j-btn j-border j-border-color3 j-round"onclick="sg()">
          Sign Out
         </button>
        </p>
					</div>
    </div>
    </div>
   </div>
  </center>
 <?php
}

if($type === 'patient_profile'){
  $ph_id = content_data('guidance_request_table','ph_id',$subtype,'gr_id');
  ?>
  <div  id="patient_profile_modal<?=$id?>" class="j-modal">
    <div class="j-card-4 j-modal-content j-color4 dm4"style="width:98%;max-width:400px;height:auto;">
     <div class="j-display-container">
     <div class="j-container j-color1 j-padding j-large"><b><?=ucwords(content_data('patient_table','p_fullname',$id,'p_id'))?> Profile</b></div>
     <div class='j-padding'style="margin-top:10px;">
      <div class="j-center">
       <img class=" j-circle"src="<?= file_location('media_url',get_media('patient',$id));?>"style="width:90px;height:90px;">
      </div>
      <div class="j-padding">
       <div class="">
        <div class='j-bolder j-text-color7 j-large'>Medical Condition:</div>
        <div class='j-text-color3'><?=ucfirst(content_data('patient_health_table','ph_illness',$ph_id,'ph_id'))?></div>
       </div>
       <div class="">
        <div class='j-bolder j-text-color7 j-large'>Stage:</div>
        <div class='j-text-color3'><?=ucfirst(content_data('patient_health_table','ph_stage',$ph_id,'ph_id'))?></div>
       </div>
       <div class="">
        <div class='j-bolder j-text-color7 j-large'>Medications:</div>
        <?php
        $pmd = multiple_content_data('patient_medication_table','pmd_name',$ph_id,'ph_id');
        if($pmd === false){
         ?><div class='j-text-color7'>No medication added yet</div><?php
        }else{
         foreach($pmd AS $pmd_name){
          ?><div class='j-text-color7'><?=$pmd_name?></div><?php
         }
        }
        ?>
       </div>
      </div>
      <br>
      <?php
      if(is_numeric($subtype)){
       ?>
       <div class="j-center">
        <div class='j-btn j-medium j-paddng j-color9 j-round-large'id='acbtn'style="margin-right:30px;"onclick="rgr('accepted',<?=addnum($subtype)?>);">Accept</div>
        <div class='j-btn j-medium j-paddng j-color8 j-round-large'id='rebtn'style=""onclick="rgr('rejected',<?=addnum($subtype)?>);">Reject</div>
       </div>
       <br>
       <?php
      }
      ?>
      <div class='j-btn j-medium j-paddng j-color5 j-round-large'style="width:100%"onclick="$('#patient_profile_modal<?=$id?>').fadeOut('slow');">Close</div>
      <br><br>
     </div>
    </div>
    </div>
    <span id="mdst"></span>
   </div>
  <?php
 }

 if($type === 'medical_cond_form'){
  ?>
   <div  id="health_form_modal" class="j-modal">
    <div class="j-card-4 j-modal-content j-color4 dm4"style="width:98%;max-width:400px;height:auto;">
     <div class="j-display-container j-large">
     <div class="j-container j-color1 j-padding"><b>Health Condition Form</b></div>
     <div class='j-padding'style="margin-top:10px;">
      <form id='adhcfrm'method="post">
      <?php
      $illness = multiple_content_data('disease_table','d_disease');
      $stage = ['none','Early','Mild','Late'];
      get_form_select('ill',$illness,'','Illness','Illness');
      get_form_select('stg',$stage,'','Stage','Stage');
      get_form_textarea('nt','','Short Note','','0','5','100','Short Note','','','Optional');//for note input
						get_form_button('adhcbtn','Add')// submit button
      ?>
      </form>
      <br>
      <div class='j-btn j-medium j-paddng j-color8 j-round-large'style="width:100%"onclick="$('#health_form_modal').fadeOut('slow');$('.ip').val('');">Close Form</div>
      <br><br>
     </div>
    </div>
    </div>
    <span id="mdst"></span>
   </div>
  <?php
}

if($type === 'medication_form'){
  ?>
   <div  id="med_form_modal" class="j-modal">
    <div class="j-card-4 j-modal-content j-color4 dm4"style="width:98%;max-width:400px;height:auto;">
     <div class="j-display-container j-large">
     <div class="j-container j-color1 j-padding"><b>Medication Form</b></div>
     <div class='j-padding'style="margin-top:10px;">
      <form id='admdfrm'method="post">
      <?php
      $nam_notice = "name of the medication";
      $dur_notice = "remaining time to complete the medication in days";
      $dos_notice = "time difference between each and the next dosage in hour";
      $las_notice = "must not be more than the interval ago";
      get_form_type('text','nm','','Medication Name','','2','70','Medication Name','','required','',$nam_notice);//for name input
      get_form_type('number','du','','Duration of Medication','','1','5','Duration of Medication','','required','',$dur_notice);//for dosage interval input
      get_form_type('number','dsi','','Dosage Interval in Hour','','1','5','Dosage Interval in Hour','','required','',$dos_notice);//for dosage interval input
      get_form_type('datetime-local','lit','','Last Medication Intake Time','','','','Last Medication Intake Time','','required','',$las_notice);//for last medication intake input
      get_form_hidden('phid',addnum($id)); //hidden form for ph_id
						get_form_button('admdbtn','Add Medication')// submit button
      ?>
      </form>
      <br>
      <div class='j-btn j-medium j-paddng j-color8 j-round-large'style="width:100%"onclick="$('#med_form_modal').fadeOut('slow');$('.ip').val('');">Close Form</div>
      <br><br>
     </div>
    </div>
    </div>
    <span id="mdst"></span>
   </div>
  <?php
}

if($type === 'health_action_modal'){
  ?>
  <div id="health_action_modal" class="j-modal j-modal-click">
   <div class="j-card-4 j-modal-content j-modal-content-support2 j-color4 j-round-large">
    <div class="j-display-container j-text-color1 j-bolder">
     <div class="j-padding"style='line-height:25px'>
      <div class='j-clickable j-row'onclick="$('#health_action_modal').fadeOut('slow');">
       <div class="j-col s1"><i class='<?= icon('edit');?>'></i></div>
       <div class="j-col s11">Edit Health Condition</div>
      </div>
      </div>
     <div class="j-padding"style='line-height:25px'>
      <div class='j-clickable j-row'onclick="$('#health_action_modal').fadeOut('slow');">
       <div class="j-col s1"><i class='<?= icon('trash');?>'></i></div>
       <div class="j-col s11">Delete Health Condition</div>
      </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php
}

if($type === 'medication_action_modal'){
  ?>
  <div id="medication_action_modal" class="j-modal j-modal-click">
   <div class="j-card-4 j-modal-content j-modal-content-support2 j-color4 j-round-large">
    <div class="j-display-container j-text-color1 j-bolder">
     <div class="j-padding"style='line-height:25px'>
      <div class='j-clickable j-row'onclick="$('#medication_action_modal').fadeOut('slow');">
       <div class="j-col s1"><i class='<?= icon('edit');?>'></i></div>
       <div class="j-col s11">Edit Medication</div>
      </div>
      </div>
     <div class="j-padding"style='line-height:25px'>
      <div class='j-clickable j-row'onclick="$('#medication_action_modal').fadeOut('slow');">
       <div class="j-col s1"><i class='<?= icon('trash');?>'></i></div>
       <div class="j-col s11">Delete Medication</div>
      </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php
}

if($type === 'adherence'){
  ?>
   <div  id="adherence_form_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-color4 dm4"style="width:98%;max-width:400px;height:auto;">
     <div class="j-display-container j-large">
     <div class="j-container j-color1 j-padding"><b>Track Adherence</b></div>
     <div class='j-padding'style="margin-top:10px;">
      <?php get_adherence_data($id,'short');?>
      <br>
      <div class='j-btn j-medium j-paddng j-color8 j-round-large'style="width:100%"onclick="$('#adherence_form_modal').fadeOut('slow');">Close</div>
      <br><br>
     </div>
    </div>
    </div>
   </div>
  <?php
}
if($type === 'remove_cancel'){
  ?>
  <center>
   <div  id="remove_cancel_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-color4 j-round-large j-padding dm4"style="width:90%;max-width:400px;height:auto;">
     <div class="j-display-container j-center j-large">
     <div class="j-container j-text-color1 j-bolder"><b><?=($subtype === 'cancel')?"Cancel Request":"Remove Med Professional";?> ?</b></div>
     <div class="j-medium"style="margin-top:10px;">Are you sure want to <?=($subtype === 'cancel')?"cancel guidance request":"remove the med. professional";?>?</div>
     <div class='j-medium'>
      	<p style='display:inline'><button class="j-margin j-btn j-border j-border-color3 j-round j-color8" onclick="$('#remove_cancel_modal').fadeOut('slow');">Close</button></p>
        <p style='display:inline;'>
         <button id='<?=($subtype === 'cancel')?"cnbtn":"rvbtn";?>'type="submit"class="j-margin j-btn j-border j-border-color8 j-round"onclick="dgr('<?=$subtype?>',<?=addnum($id)?>)">
         <?=($subtype === 'cancel')?"Cancel":"Remove";?>
         </button>
        </p>
			</div>
    </div>
    </div>
   </div>
  </center>
 <?php
}
}
// patient modal ends

//doctor modal starts
function doctor_modal($type,$id='none',$subtype=''){
 if($type === 'settings'){
  ?>
  <div id="settings_modal" class="j-modal j-modal-click">
   <div class="j-card-4 j-modal-content j-modal-content-support2 j-color4 j-round-large">
    <div class="j-display-container">
     <div class="j-container j-color9 j-padding"><b>Settings</b></div>
     <div>
      <div class=''style='line-heght:30px;'>
       <div class='j-padding j-round'>
        <a href="<?= file_location('doctor_url','account/edit_profile/');?>">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color9 j-xlarge <?=icon('user');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color7 j-text-color7'>Edit Profile</span>
         <div class='j-small'style='margin-left:38px;'>Edit your profile information.</div>
        </div>
        </a>
       </div>
       <div class='j-padding j-round'>
        <a href="<?= file_location('doctor_url','account/account_security/');?>">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color9 j-xlarge <?=icon('shield-alt');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color7'>Account & Security</span>
         <div class='j-small'style='margin-left:38px;'>Change email, change password, delete account.</div>
        </div>
        </a>
       </div>
       <div class='j-padding j-round j-clickable'onclick="$('#logout_modal').fadeIn('slow');$('#settings_modal').fadeOut('slow');">
        <div style="display:inline-block;width:35px;position:relative;top:7px;"><i class="j-text-color8 j-xlarge <?=icon('power-off');?>"></i></div>
        <div style="display:inline;line-height:15px;">
         <span class='j-bolder j-text-color8'>Sign Out</span>
         <div class='j-small j-text-color8'style='margin-left:38px;'>Sign out of your account.</div>
        </div>
       </div>
      </div>
     </div>
    </div>
    </div>
   </div>
   <?php
 }
 if($type === 'doctor_profile'){
  ?>
  <div  id="doctor_profile_modal<?=$id?>" class="j-modal">
    <div class="j-card-4 j-modal-content j-color4 dm4"style="width:98%;max-width:400px;height:auto;">
     <div class="j-display-container">
     <div class="j-container j-color1 j-padding j-large"><b>Dr. <?=ucwords(content_data('doctor_table','d_fullname',$id,'d_id'))?> Profile</b></div>
     <div class='j-padding'style="margin-top:10px;">
      <div class="j-center">
       <img class=" j-circle"src="<?= file_location('media_url',get_media('doctor',$id));?>"style="width:90px;height:90px;">
      </div>
      <div class="j-padding">
       <div class="">
        <div class='j-bolder j-text-color7 j-large'>Profession:</div>
        <div class='j-text-color3'><?=ucfirst(content_data('doctor_table','d_profession',$id,'d_id'))?></div>
       </div>
       <div class="">
        <div class='j-bolder j-text-color7 j-large'>Specialization:</div>
        <div class='j-text-color3'><?=ucfirst(content_data('doctor_table','d_specialization_keyword',$id,'d_id'))?></div>
       </div>
       <div class="">
        <div class='j-bolder j-text-color7 j-large'>Details:</div>
        <div class='j-text-color3'><?=ucfirst(content_data('doctor_table','d_details',$id,'d_id'))?></div>
       </div>
      </div>
      <br>
      <?php
      if(is_numeric($subtype)){
       ?><div class='j-btn j-medium j-paddng j-color2 j-round-large'id='srbtn'style="width:100%"onclick="sgr(<?=addnum($subtype)?>,<?=addnum($id)?>);">Send Request</div><br><br><?php
      }
      ?>
      <div class='j-btn j-medium j-paddng j-color8 j-round-large'style="width:100%"onclick="$('#doctor_profile_modal<?=$id?>').fadeOut('slow');">Close</div>
      <br><br>
     </div>
    </div>
    </div>
    <span id="mdst"></span>
   </div>
  <?php
 }
 if($type === 'log_out'){
 ?>
 <center>
   <div  id="logout_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-color4 j-round-large j-padding dm4"style="width:90%;max-width:400px;height:auto;">
     <div class="j-display-container j-center j-large">
     <div class="j-container"><b>Sign Out ?</b></div>
     <div class="j-medium"style="margin-top:10px;">Are you sure want to sign out of your account?</div>
     <div class='j-medium'>
							<p style='display:inline'><button class="j-margin j-btn j-border j-border-color3 j-round" onclick="$('#logout_modal').fadeOut('slow');">Cancel</button></p>
        <p style='display:inline;'>
         <button id='lobtn'type="submit"class="j-margin j-btn j-border j-border-color3 j-round"onclick="sg()">
          Sign Out
         </button>
        </p>
					</div>
    </div>
    </div>
   </div>
  </center>
 <?php
 }
}
// patient modal ends

//admin modal starts
function admin_modal($type,$id='none',$subtype=''){
 if($type === 'admin_log_out'){
 ?>
 <!--logout modal starts-->
 <center>
  <div id="log_out_modal"class="j-modal j-modal-click">
   <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1"style="width:98%;max-width:400px;height:auto;">
    <div class="j-display-container j-center">
     <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#log_out_modal').fadeOut('slow');"></span>
     <div class="j-container j-text-color1"><p><b>Log Out?</b></p></div>
     <div>
      <h5 class="j-text-color3">Are you sure want to log out of your account?</h5><hr>
							<p style='display:inline'><button id='lobtn'class="j-margin j-btn j-round-large j-color1 j-text-color4"onClick="lg();">Log Out</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color3 j-hover-color1 j-round-large"onclick="$('#log_out_modal').fadeOut('slow');">Cancel</button></p>
					</div>
    </div>
   </div>
  </div>
	</center>
	<!--logout modal ends-->
 <?php
 }
 if($type === 'admin_delete_account'){
  ?>
  <!--deleteadmin modal starts-->
  <center>
   <div  id="delete_account_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#delete_account_modal').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Delete Account?</b></p></div>
      <div>
       <h5 class="j-text-color3">Are you sure want to delete your account?. The action cannot be reverse.</h5><hr>
       <span class='j-text-color1 mg j-left'id='pse'></span>
       <input type="password"class=" j-input j-medium j-border j-border-color5 j-round-large"placeholder="Password"
          name="ps"id="ps"value=""style="width:100%;"/>
							<p style='display:inline'><button type="submit"id='dabtn'class="j-margin j-btn j-round j-color1 j-text-color4"onClick="da($('#ps'))">Delete Account</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#delete_account_modal').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <!--deleteadmin modal ends-->
  <?php
 }
}
//admin modal ends

function image_modal($type,$id,$s_id=-1500000000){
 if(get_media($type,$id) !== 'home/no_media.png' && get_media($type,$id) !== 'home/avatar.png'){$image = 'exists';}else{$image = 'no image';} //check if image exists
 ?>
 <div id="<?=$type.$id?>_pics_modal" class="j-modal">
  <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-teal">
   <div class="j-display-container">
    <div class="j-line-height j-text-color1">
     <div class='j-clickable j-row'onclick="$('#<?=$type.$id?>_pics_modal').fadeOut('slow');ti($('#<?=$type.$id?>_pics'))">
      <div class="j-col s1"> <i class='<?= icon('upload');?>'></i> </div>
      <div class="j-col s11 j-bolder"><?= $image === 'exists'?'Change':'Upload'?> Image</div>
     </div>
     <input type="file"name="<?=$type?>_pics"id="<?=$type.$id?>_pics"class="j-round j-hide"onchange="ci(this,'<?=$type?>',<?=addnum($id)?>,<?=addnum($s_id)?>);">
     <?php
     if($image === 'exists'){
      ?>
      <div class='j-clickable j-row' onclick="$('#remove_<?=$type.$id?>_image_modal').fadeIn('slow');$('#<?=$type.$id?>_pics_modal').fadeOut('slow');">
       <div class="j-col s1"> <i class='<?= icon('times');?>'></i> </div>
       <div class="j-col s11 j-bolder">Remove Image</div>
      </div>
      <?php
      }
      ?>
   </div>
   </div>
  </div>
 </div>
 <!--remove image modal starts-->
  <center>
   <div  id="remove_<?=$type.$id?>_image_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#remove_<?=$type.$id?>_image_modal').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Remove Image?</b></p></div>
      <div>
       <h5 class="j-text-color3">Are you sure want to remove the image? The action cannot be reverse.</h5><hr>
							<p style='display:inline'><button type="submit"id='rmbtn<?=$id?>'class="rmbtn j-margin j-btn j-round j-color1 j-text-color4"onClick="ri('<?=$type?>',<?=addnum($id)?>);">Remove</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#remove_<?=$type.$id?>_image_modal').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <!--remove image modal ends-->
 <?php
 }
//image modal ends

//preview modal starts
function preview_modal($type,$id=''){

}
//preview modal ends
//MODAL FUNCTIONS ENDS
?>