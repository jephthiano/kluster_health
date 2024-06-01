<?php
//MEDICATION FUNCTION STARTS
//get medication starts
function get_medication($type,$id='',$subtype=''){
 if($type === 'next'){
  $adhere_date = content_data('patient_adherence_table','pma_datetime',$id,'pma_id');
  $pmd_id = content_data('patient_adherence_table','pmd_id',$id,'pma_id');
  $name = content_data('patient_medication_table','pmd_name',$pmd_id,'pmd_id');
  $day = show_date($adhere_date,'date','shorter');
  ?>
  <div class='j-color7 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
   <?php
   if($subtype !== 'medication'){
    ?><div class='j-xlarge j-text-color6 j-bolder'><?=$name?></div><?php
   }
   ?>
   <div class=''style="line-height:20px;margin:9px 0px">
    You will take <?=$name?> at <b><span><?=show_time($adhere_date)?></span></b> <?=($day === 'Tomorrow' || $day === 'Today')?"":"on";?> <b><span><?=$day?></span></b>
   </div>
   <?php
   if($subtype === 'home'){
    ?>
    <div class='j-center'>
     <a href="<?=file_location('home_url','reminders/')?>">
     <span class='j-text-color5 j-button j-color1'style="padding:5px 24px;border-radius:15px;">More Reminders</span>
     </a>
    </div>
    <?php
   }elseif($subtype === 'reminder'){
    ?>
    <div class='j-center'>
    <a href="<?=file_location('home_url','health/medication/'.addnum($pmd_id).'/')?>">
    <span class='j-medium j-text-color5 j-button j-color1'style="padding:5px 24px;border-radius:15px;">View Medication Details</span>
    </a>
   </div>
    <?php
   }
   ?>
  </div>
  <br>
  <?php
 }elseif($type === 'lapsed'){
  $adhere_date = content_data('patient_adherence_table','pma_datetime',$id,'pma_id');
  $pmd_id = content_data('patient_adherence_table','pmd_id',$id,'pma_id');
  $name = content_data('patient_medication_table','pmd_name',$pmd_id,'pmd_id');
  $day = show_date($adhere_date,'date','shorter');
  ?>
  <div class='j-color1 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
   <?php
   if($subtype !== 'medication'){
    ?><a href="<?=file_location('home_url',"health/medication/".addnum($pmd_id).'/')?>"><div class='j-xlarge j-text-color6 j-bolder'><?=$name?></div></a><?php
   }
   ?>
   <div class=''style="line-height:20px;margin:9px 0px">
    Did you take your last medication of <?=$name?> at <b><span><?=show_time($adhere_date)?></span></b> <?=($day === 'Today' || $day === 'Yesterday')?"":"on";?> <b><span><?=$day?></span></b>?
   </div>
   <?php
   if($subtype === 'medication'){
    $div = 'med';
   }elseif($subtype === 'reminder'){
    $div = 'rem';
   }elseif($subtype === 'home'){
    $div = 'hom';
   }
   ?>
   <div class=''>
    <span class='j-bolder j-text-color5 j-button j-pdding j-color4'style="padding:2px 16px;border-radius:15px;margin-right:20px;"onclick="ca(<?=addnum($id)?>,'taken','<?=$div?>')">Yes</span>
    <span class='j-bolder j-text-color5 j-button j-pdding j-color4 j-round-large'style="padding:2px 16px;border-radius:15px;"onclick="ca(<?=addnum($id)?>,'missed','<?=$div?>')">No</span>
   </div>
  </div>
  <br>
  <?php
 }elseif($type === 'next_more'){
  if($id > 0){
  ?>
  <div class='j-color1 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
   <div class='j-text-color6 j-bolder'style="font-size:20px;">You have <?=$id?> medication intakes in few hours</div>
   <div class='j-center j-margin'>
    <a href="<?=file_location('home_url','reminders/')?>">
    <span class='j-text-color4 j-button j-color3'style="padding:5px 24px;border-radius:15px;">Checkout Reminders</span>
    </a>
   </div>
  </div>
  <br>
  <?php
  }
 }elseif($type === 'lapsed_more'){
  if($id > 0){
  ?>
  <div class='j-color1 j-paddng-large j-round-large'style="line-height:30px;padding: 26px 24px">
   <div class='j-text-color6 j-bolder'style="font-size:20px;"><?=$id?> Un-updated medications</div>
   <div class='j-center j-margin'>
    <a href="<?=file_location('home_url','reminders/')?>">
    <span class='j-text-color1 j-button j-color4'style="padding:5px 24px;border-radius:15px;">Check Reminder</span>
    </a>
   </div>
  </div>
  <br>
  <?php
  }
 }
}
//get medication ends
//MEDICATION FUNCTION ENDS
?>