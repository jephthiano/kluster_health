<?php
//PATIENT FUNCTION STARTS
//patient section data starts
function patient_section_data($type,$id='',$sub=''){
 global $p_id; global $d_id;
 if($type === 'short_profile'){//type,gr_id
  $p_id = content_data('guidance_request_table','p_id',$id,'gr_id');
  $ph_id = content_data('guidance_request_table','ph_id',$id,'gr_id');
  ?>
  <div class='j-padding-small'>
   <div class='j-row j-card-2 j-padding-small j-round j-color4'style="margin-bottom:10px;">
    <div class='j-col s2 j-center'>
     <img class=" j-circle"src="<?= file_location('media_url',get_media('patient',$p_id));?>"style="width:50px;height:50px;">
    </div>
    <div class='j-col s10 j-padding'>
     <div style="line-height:30px">
      <div>
       <div><div class="j-large j-bolder j-text-color7"><?=ucwords(content_data('patient_table','p_fullname',$p_id,'p_id'))?></div></div>
      </div>
     </div>
     <div class=''style="max-height:45px;overflow:hidden;text-overflow: ellipsis;">
      <span class="j-text-color7 j-bolder">Medical Condition: </span><?=ucfirst(content_data('patient_health_table','ph_illness',$ph_id,'ph_id'))?>
      </div>
    </div>
    <div class='j-center'>
     <div class='j-button j-color7 j-round'onclick="$('#patient_profile_modal<?=$p_id?>').fadeIn('slow')">View Profile</div>
    </div>
   </div>
  </div>
  <?php
  patient_modal('patient_profile',$p_id,$id); //type,p_id,gr_id
 }
 if($type === 'profile'){
  ?>
  <div class='j-col s12 l6 j-padding'>
   <a href="<?=file_location('doctor_url','patient/patient/'.addnum($id).'/')?>">
   <div class='j-row j-color6 j-round j-padding'style="margin-bottom:10px;">
    <div class='j-col s2 j-center'>
     <img class="j-circle"src="<?= file_location('media_url',get_media('patient',$id));?>"style="width:50px;height:50px;">
    </div>
    <div class='j-col s10 j-padding'>
     <div><div class="j-large j-bolder j-text-color7"><?=ucwords(content_data('patient_table','p_fullname',$id,'p_id'))?></div></div>
     <br>
    </div>
    <div>
     <div class="j-bolder">Medical Condition:</div>
     <div>
      <?php
      $ph_or = multiple_content_data('guidance_request_table','ph_id','accepted','gr_status',"AND d_id = {$d_id} AND p_id = {$id}");
      if($ph_or !== false){
       foreach($ph_or AS $ph_id){
        $illness = content_data('patient_health_table','ph_illness',$ph_id,'ph_id');
        ?><div><?=$illness?></div><?php
       }
      }
      ?>
     </div>
    </div>
   </div>
   </a>
  </div>
  <?php
 }
 if($type === 'profile_pic'){
  ?>
  <div>
   <div class=''style="position: relative;">
    <img class="j-circle j-clickable j-border-3 j-border-color7"src="<?= file_location('media_url',get_media('patient',$id));?>"style="width:120px;height:120px;"onclick="ti($('#patient_pics'))">
    <span class='j-bold j-vertical-center-element j-text-color4'style='font-size:40px;'>+</span>
   </div>
  </div>
  <input type="file"name="patient_pics"id="patient_pics"class="j-round j-hide"onchange="ci(this,'patient');">
  <?php
 }
 if($type === 'patient'){
  $gr = multiple_content_data('guidance_request_table','gr_id','pending','gr_status',"AND d_id = {$id}");
  if($gr === false){
   ?><div class="j-center"><br><br>You have no request at the moment</div><?php
  }else{
   foreach($gr AS $gr_id){patient_section_data('short_profile',$gr_id);}
  }
 }
 if($type === 'home'){
  //for unconfirm reminder andd co reminder
  $unconfirmed_id = multiple_content_data('patient_adherence_table','pma_id',$p_id,'p_id',"AND pma_status IN ('notified','pending') ORDER BY pma_id DESC");
  if($unconfirmed_id === false){ //show
   ?>
   <div class='j-color1 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
    <div class='j-text-color6 j-bolder j-large'>You have not registered any medication</div>
    <div class='j-center j-margin'>
     <a href="<?=file_location('home_url','health/')?>">
     <span class='j-text-color4 j-button j-color1 j-border j-border-color4'style="padding:5px 24px;border-radius:15px;">Register Medication</span>
     </a>
    </div>
   </div>
   <br>
   <?php
   }else{ //else show either next dosage time or unconfirmed medication
    $lapsed = []; $next = [];
    foreach($unconfirmed_id AS $id){
     $adhere_date = content_data('patient_adherence_table','pma_datetime',$id,'pma_id');
     if(is_lapsed(0,$adhere_date)){ //if adhere_time is greater than now (it has not lapsed i.e next medication)
      $next[] = $id;
     }else{
      $lapsed[] = $id;
     } //if it has lapses, add to lapsed array else add to next array
    }
    //for not lapsed adherence
    $total_next = count($next);
    if($total_next === 1){
     get_medication('next',$next[0],'home');
    }else{
     get_medication('next_more',$total_next,'home');
    }
    //for lapsed adherence
    $total_lapse = count($lapsed);
    if($total_lapse === 1){
     get_medication('lapsed',$lapsed[0],'home');
    }elseif($total_lapse > 1){
     get_medication('lapsed_more',$total_lapse,'home');
    }
   }
 }
 if($type === 'reminder'){
  //for unconfirm reminder andd co reminder
  $unconfirmed_id = multiple_content_data('patient_adherence_table','pma_id',$p_id,'p_id',"AND pma_status IN ('notified','pending') ORDER BY pma_id DESC");
  //seperate the next from lapsed id
  $lapsed = []; $next = [];
  foreach($unconfirmed_id AS $id){
   $adhere_date = content_data('patient_adherence_table','pma_datetime',$id,'pma_id');
   if(is_lapsed(0,$adhere_date)){ //if adhere_time is greater than now (it has not lapsed i.e next medication)
    $next[] = $id;
   }else{
    $lapsed[] = $id;
   } 
  }
  ?>
  <div>
   <div id='next_medication'class='trigger j-padding'style="">
    <?php
    $total_next = count($next);
    if($total_next > 0){
     foreach($next AS $next_id){get_medication('next',$next_id,'reminder');}
    }else{
     ?><div class='j-center j-padding'>You have 0 next medication intake plan at the moment</div><?php
    }
    ?>
   </div>
   <div id='unconfirmed_medication'class='trigger j-padding'style='display:none;'>
    <?php
    //for lapsed adherence
    $total_lapse = count($lapsed);
    if($total_lapse > 0){
     foreach($lapsed AS $lapsed_id){get_medication('lapsed',$lapsed_id,'reminder');}
    }else{
     ?><div class='j-center j-padding'>You have 0 unconfirmed medication intake at the moment</div><?php
    }
    ?>
   </div>
  </div>
  <?php  
 }
 if($type === 'health'){
  $or = multiple_content_data('patient_health_table','ph_id',$p_id,'p_id',"ORDER BY ph_id DESC");
  if($or === false){
   ?>
   <div class=''>
    <br><br><br>
    <div class='j-large j-center'> You have no registered medical condition at the moment.<br> <span class='j-medium'>Once you register you illness, you can attach your medication and medication details to it. You can also track how you adhere to your medication</span></div>
    <div class='j-center j-margin'><div class='j-btn j-padding j-color1 j-round'onclick="$('#health_form_modal').fadeIn('slow')">Add Medical Condition</div></div>
   </div>
   <?php
  }else{
   ?>
   <div class='j-right j-btn j-padding j-color1 j-round'onclick="$('#health_form_modal').fadeIn('slow')">Add Medical Condition</div><br class='j-clearfix'><br>
   <?php
   foreach($or AS $ph_id){
    $illness = ucwords(content_data('patient_health_table','ph_illness',$ph_id,'ph_id'));
    $total_med = get_numrow('patient_medication_table','ph_id',$ph_id,"return",'no round');
    ?>
     <div class='j-color1 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
							<div class='j-xlarge j-text-color4 j-bolder'><?=($illness)?> Medication</div>
							<div class=''>You have <span class='j-large j-bolder'><?=$total_med?></span> medication<?=($total_med > 1)?"s":"";?> for <?=$illness?></div>							
							<div class='j-center j-margin j-text-color2'>
									<a href="<?=file_location('home_url','health/health_condition/'.addnum($ph_id).'/')?>">
         <?php
         if($total_med > 0){
          ?><span class='j-button j-pdding j-color6'style="padding:5px 24px;border-radius:15px;">See Medication<?=($total_med > 1)?"s":"";?></span><?php
         }else{
          ?><span class='j-button j-pdding j-color6'style="padding:5px 24px;border-radius:15px;">Add Medication</span><?php
         }
         ?>
									</a>
								</div>
						</div>
     <br>
    <?php
   }
  }
 }
 if($type === 'health_condition'){
  ?>
  <div class='j-right j-btn j-padding j-color1 j-round' style="margin:5px;"onclick="$('#med_form_modal').fadeIn('slow')">Add Medication</div><br class='j-clearfix'>
  <div class="j-padding">
    <?php
    $illness = content_data('patient_health_table','ph_illness',$id,'ph_id');
    $or = multiple_content_data('patient_medication_table','pmd_id',$id,'ph_id',"ORDER BY pmd_id DESC");
    ?><div class="j-large j-bolder j-text-color5"style="margin-bottom:10px;">Medications (<?=get_numrow('patient_medication_table','ph_id',$id,"return",'no round');?>)</div><?php
    if($or === false){
    ?>
    <div class=''>
      <div class='j-center'> You have no medication registered under <?=$illness?></div>
    </div>
    <?php
    }else{
    ?>
    <?php
    foreach($or AS $pmd_id){
      $start_date = content_data('patient_medication_table','pmd_regdatetime',$pmd_id,'pmd_id');
      $duration = content_data('patient_medication_table','pmd_duration',$pmd_id,'pmd_id');
      $interval = content_data('patient_medication_table','pmd_dosage_interval',$pmd_id,'pmd_id');
      $rem_days = remaining_days($start_date,$duration);
      $last_adhere_id = content_data('patient_adherence_table','pma_id',$pmd_id,'pmd_id','ORDER BY pma_id DESC');
      $last_adhere_date = content_data('patient_adherence_table','pma_datetime',$last_adhere_id,'pma_id');
      ?>
      <div class='j-color1 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
                <div class='j-xlarge j-text-color4 j-bolder'><?=(content_data('patient_medication_table','pmd_name',$pmd_id,'pmd_id'))?> Medication</div>
        <?php
        if($rem_days === 'expired'){
          ?><div class='j-text-color6'>Medication duration has lapsed</div><?php
        }else{
          ?><div class='j-text-color6'>Medication remains <span class="j-bolder"><?=$rem_days?></span> days to end</div><?php
        }
        ?>
        <div class=''>Dosage Interval: <span class="j-bolder"><?=$interval?></span> hours</div>
        <?php
        if(is_lapsed(0,$last_adhere_date)){ //if adhere_time is greater than now (it has not lapsed i.e next medication)
          ?>
          <div class='j-text-color5'style="line-height:20px;">
          Your next medication is
          <b><span><?=show_time($last_adhere_date)?></span></b> <?=($last_adhere_date === 'Today' || $last_adhere_date === 'Tomorrow')?"on":"";?>
          <b><span><?=show_date($last_adhere_date,'date','shorter')?></span></b>
          </div>
          <?php
        }else{
          ?><div class='j-text-color5'>You have a pending unconfirmed medication intake</div><?php
        }
        ?>
        <div class='j-center j-margin j-text-color2'>
         <a href="<?=file_location('home_url','health/medication/'.addnum($pmd_id).'/')?>">
         <span class='j-button j-pdding j-color6'style="padding:5px 24px;border-radius:15px;">View Medication Data</span>
         </a>
        </div>
      </div>
      <br>
      <?php    
    }
    }
    ?>
  </div>
  <?php
 }
 if($type === 'medication'){
  $start_date = content_data('patient_medication_table','pmd_first_intake_time',$id,'pmd_id');
  $start_date = content_data('patient_medication_table','pmd_regdatetime',$id,'pmd_id');;
  $duration = content_data('patient_medication_table','pmd_duration',$id,'pmd_id');
  $rem_days = remaining_days($start_date,$duration);
  ?>
  <div class="j-color5"style="">
   <div class='j-padding j-large'style='line-height:25px;'>
    <div>
     <span class='j-bolder j-text-color7'>Name: </span> <span class='j-right'><?=ucwords(content_data('patient_medication_table','pmd_name',$id,'pmd_id'))?></span>
    </div>
    <div>
     <span class='j-bolder j-text-color7'>Duration: </span> <span class='j-right'><?=$duration?> days</span> 
    </div>
    <div>
     <span class='j-bolder j-text-color7'>Remaining Days: </span> <span class='j-right'><?=$rem_days?> <?=($rem_days !== 'expired')?"day":"";?><?=(is_numeric($rem_days) && $rem_days > 1)?"s":"";?></span>
    </div>
    <div>
     <span class='j-bolder j-text-color7'>Dosage Interval: </span> <span class='j-right'><?=ucwords(content_data('patient_medication_table','pmd_dosage_interval',$id,'pmd_id'))?> hours</span>
    </div>
    <div>
     <span class='j-bolder j-text-color7'>Started On: </span> <span class='j-right'><?=show_date($start_date)?>, <?=show_time($start_date)?></span>
    </div>
   </div>
   <br>
  </div><div class="j-large j-bolder j-text-color5 <?=($sub === 'doctor')?"j-hide":"";?>"style="margin-left:16px;">Reminder</div>
  <div class='j-padding'>
   <?php
   if($sub !== 'doctor'){
   ?>
    <?php
    $unconfirmed_id = content_data('patient_adherence_table','pma_id',$p_id,'p_id',"AND pmd_id = $id AND pma_status IN ('notified','pending') ORDER BY pma_id DESC");
    if($unconfirmed_id !== false){
     $adhere_date = content_data('patient_adherence_table','pma_datetime',$unconfirmed_id,'pma_id');
     if(is_lapsed(0,$adhere_date)){ //if adhere_time is greater than now (it has not lapsed i.e next medication)
      get_medication('next',$unconfirmed_id,'medication');
     }else{ //if not lapsed
      get_medication('lapsed',$unconfirmed_id,'medication');
     }
    }
   }
   ?>
   <div class='j-large j-bolder j-center <?=(server_type() ===  'doctor')?"j-color9":"j-color1";?>'>Adherence Summary</div>
   <div class='j-padding j-color6'>
    <div>
     <?php
     $pma_id_array = multiple_content_data('patient_adherence_table','pma_id',$p_id,'p_id',"AND pmd_id = $id ORDER BY pma_id DESC");
     if($pma_id_array === false){
      ?><div class="j-center ">No adherence data is available at the moment</div><?php
     }else{
      patient_modal('adherence',$pma_id_array);
      $total_adh = (get_numrow('patient_adherence_table','pmd_id',$id,"return",'no round')-1);
      $total_taken = get_numrow('patient_adherence_table','pmd_id',$id,"return",'no round',"AND pma_status = 'taken'");
      $total_missed = get_numrow('patient_adherence_table','pmd_id',$id,"return",'no round',"AND pma_status = 'missed'");
      ?>
      <div style="margin:5px 0px;">
       <div>
        <span class="j-bolder j-text-color7">Total Medication:</span> <span><?=$total_adh?></span>
       </div>
       <div>
        <span class="j-bolder j-text-color7">Taken Medication:</span> <span><?=$total_taken?> <span class=''>(<?=cal_percentage($total_adh,$total_taken)?>)</span></span>
       </div>
       <div>
        <span class="j-bolder j-text-color7">Missed Medication:</span> <span><?=$total_missed?>  <span class=''>(<?=cal_percentage($total_adh,$total_missed)?>)</span></span>
       </div>
      </div>
      <center><div id="myChart"style="max-width:600px;width:100%;height:200px;"class="j-magin j-bolder">Pie Chart Will be shown here</div></center>
      <div class='j-center j-margin j-hide-large j-hide-xlarge'>
       <div class='j-btn j-padding j-color8 j-round'style="margin-right:5px;"onclick="$('#adherence_form_modal').fadeIn('slow')">Track Adherence Data</div>
      </div>
      <?php
     }
     ?>
    </div>
   </div>
  </div>
  <?php
 }
}
//patient section data ends
//PATIENT FUNCTION ENDS
?>