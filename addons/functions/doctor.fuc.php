<?php
//DOCTTOR FUNCTION STARTS
//doctor section data starts
function doctor_section_data($type,$id='',$sub=''){
 global $d_id; global $p_id;
 if($type === 'short_profile'){//type,d_id and ph_id(for send request)
  ?>
  <div class='j-padding-small'>
   <div class='j-row j-card-2 j-padding-small j-round j-color4'style="margin-bottom:10px;">
    <div class='j-col s2 j-center'>
     <img class=" j-circle"src="<?= file_location('media_url',get_media('doctor',$id));?>"style="width:50px;height:50px;">
    </div>
    <div class='j-col s10 j-padding'>
     <div style="line-height:20px">
      <div>
       <div><div class="j-large j-bolder j-text-color7">Dr. <?=ucwords(content_data('doctor_table','d_fullname',$id,'d_id'))?></div></div>
      </div>
     </div>
     <div class=''style="max-height:45px;overflow:hidden;text-overflow: ellipsis;"><?=ucfirst(content_data('doctor_table','d_profession',$id,'d_id'))?></div>
    </div>
    <div class='j-center'>
     <div class='j-button j-color7 j-round'onclick="$('#doctor_profile_modal<?=$id?>').fadeIn('slow')">View Profile</div>
    </div>
   </div>
  </div>
  <?php
  doctor_modal('doctor_profile',$id,$sub);
 }

 if($type === 'profile_pic'){
  ?>
  <div>
   <div class=''style="position: relative;">
    <img class="j-circle j-clickable j-border-3 j-border-color7"src="<?= file_location('media_url',get_media('doctor',$id));?>"style="width:120px;height:120px;"onclick="ti($('#doctor_pics'))">
    <span class='j-bold j-vertical-center-element j-text-color4'style='font-size:40px;'>+</span>
   </div>
  </div>
  <input type="file"name="patient_pics"id="patient_pics"class="j-round j-hide"onchange="ci(this,'doctor');">
  <?php
 }

 if($type === 'illness_doctors'){ //for patient medical professional page
  $ph_id = content_data('patient_health_table','ph_id',$id,'ph_illness',"AND p_id = {$p_id}");
  $status = content_data('guidance_request_table','gr_status',$ph_id,'ph_id',"AND p_id = {$p_id}");
  if($status === false){
   $searchtext = $id.'*';
   // creating connection
   require_once(file_location('inc_path','connection.inc.php'));
   @$conn = dbconnect('admin','PDO');
   $sql = "SELECT d_id FROM doctor_table
   WHERE (MATCH(d_email,d_fullname,d_country,d_state,d_profession,d_details,d_specialization_keyword) AGAINST(:searchtext IN BOOLEAN MODE)) AND d_status = 'active'
   ORDER BY MATCH(d_email,d_fullname,d_country,d_state,d_profession,d_details,d_specialization_keyword) AGAINST(:searchtext IN BOOLEAN MODE)";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
   $stmt->bindColumn('d_id',$id);
   $stmt->execute();
   $numRow = $stmt->rowCount();
   if($numRow > 0){		// if a record is found
    $ph_id = content_data('patient_health_table','ph_id',$id,'ph_illness',"AND p_id = {$p_id}");
    ?>
    <div class='j-padding j-center j-bolder j-text-color7'>
     <?=$numRow?> Medical professional available for <?=$id?>
     </div>
    <?php
    while($stmt->fetch()){ doctor_section_data('short_profile',$id,$ph_id); }
   }else{
    ?>
    <div class='j-padding j-center j-bolder j-text-color7'> <br>No medical professional is available for <?=$id?> at the moment</div>
    <?php
    }
   }else{
    $d_id = content_data('guidance_request_table','d_id',$p_id,'p_id',"AND ph_id = {$ph_id}");
    $illness = ucwords(content_data('patient_health_table','ph_illness',$p_id,'p_id',"AND ph_id = {$ph_id}"));
    if($status === 'pending'){
     ?>
     <div class="j-margin"style="border-bottom: 1px black solid">
      <div style="margin-bottom:10px">
       <div class="j-right j-padding j-color9 j-round">Request <?=$status?></div>
       <div class="j-text-color7 j-bolder j-large"><?=$illness?></div>
       <br class='j-clearfix'>
      </div>
      <?php doctor_section_data('short_profile',$d_id,'no_send');?>
     </div>
     <?php
    }elseif($status === 'accepted'){
      ?>
      <div class='j-padding j-text-color7 j-bolder'>
        <div class="j-text-color7 j-bolder j-large">Your <?=$illness?> Med. Professional</div>
        <br>
        <?php doctor_section_data('short_profile',$d_id,'no_send');?>
      </div>
      <?php
    }
   }
  }

  if($type === 'med_cond_doctor'){
    $illness  = content_data('patient_health_table','ph_illness',$id,'ph_id',"AND p_id = {$p_id}");
    $gr_id = content_data('guidance_request_table','gr_id',$id,'ph_id',"AND p_id = {$p_id}");
    $status = content_data('guidance_request_table','gr_status',$gr_id,'gr_id');
    if($status === false){
      ?>
      <div class=' j-center'>
        <div>You have no a medical professional to monitor your <?=ucwords($illness)?> adherence</div>
        <div class='j-center j-margin j-text-color2 j-large'>
          <a href="<?=file_location('home_url',"health/medical_professional/{$illness}/")?>">
          <span class='j-button j-pdding j-color6'style="padding:5px 24px;border-radius:15px;">Select one</span>
          </a>
        </div>
      </div>
      <?php
    }else{
      $doctor_id = content_data('guidance_request_table','d_id',$gr_id,'gr_id');
      if($status === 'pending'){//if in pending
        doctor_section_data('short_profile',$doctor_id,'no_send');
        ?>
        <div>
          <div>Your request is still waiting for confirmation.</div>
          <div class='j-right j-btn j-padding j-color8 j-round-large'onclick="$('#remove_cancel_modal').fadeIn('slow');">Cancel Request</div>
          <br class='j-clearfix'>
        </div>
        <?php
        patient_modal('remove_cancel',$gr_id,'cancel');
      }elseif($status === 'accepted'){//if accepted
        ?>
        <div>
          <div>My Medical Professional</div>
          <div class='j-right j-btn j-padding j-color8 j-round-large'onclick="$('#remove_cancel_modal').fadeIn('slow');">Remove</div>
          <br class='j-clearfix'>
        </div>
        <?php
        doctor_section_data('short_profile',$doctor_id,'no_send');
        patient_modal('remove_cancel',$gr_id,'remove');
      }
    }
  }
}
//doctor section data ends
//DOCTTOR FUNCTION ENDS
?>