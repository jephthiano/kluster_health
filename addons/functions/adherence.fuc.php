<?php
//ADHERENCE FUNCTION STARTS
//get adherence_data starts
function get_adherence_data($id,$type='short'){
 global $p_id;
  ?>
  <div style="margin:20px 0px;">
   <?php
   foreach($id AS $each_id){
    $status = content_data('patient_adherence_table','pma_status',$each_id,'pma_id');
    $date = content_data('patient_adherence_table','pma_datetime',$each_id,'pma_id');
    if($status === 'pending' || $status === 'notified'){
     $icon = 'circle';$color = "j-text-color7";
     if(!is_lapsed(0,$date)){ //if last adhere_time is not greater than now (it has lapsed and notification has been sent)
      $message = "Waiting for your confirmation to update the data";
      $name = "Last Notified";
     }else{ //it is next medication
      $message = "You will be notified when it is time for your medication";
      $name = "Next Medication";
     }
    }elseif($status === 'taken'){
     $icon = 'calendar-check'; $message = "Medication taken";$name = $status;$color = "j-text-color9";
    }elseif($status === 'missed'){
     $icon = 'calendar-times'; $message = "Medication missed";$name = $status;$color = "j-text-color8";
    }
    ?>
    <div style=''>
     <?php //stages of each pma data?>
     <span class=''style='margin-right:9px;position:relative;top:5px;'>
      <i class="j-xlarge <?=$color?> <?=icon($icon);?>"></i>
      
     </span>
     <span class='j-text-color4 j-color7 j-padding-small j-round j-btn j-small'><?=ucwords($name)?></span>
     <?php
     //for connecting line
     if(end($id) === $each_id){
      $settings = "margin-left:40px;";
     }else{
      if($status === 'pending' || $status === 'notified'){
       $settings = "margin:2px 9px;padding-left:25px;padding-bottom:20px;border-left:dotted 4px gray;"; //dot
      }else{
       $settings = "margin:2px 9px 0px 9px;padding-left:25px;padding-bottom:20px;border-left:solid 4px teal;"; //straight line
      }
     }
      //for date,message and line
      ?>
      <div style='<?=$settings?>'>
      <div class='j-small j-text-color7'><?=show_date($date)." ".show_time($date)?></div>
      <div class="j-small"><?=(end($id) === $each_id)?"First ":"";?><?=$message?></div>
      </div>
    </div>
    <?php
   }//end of foreach
   ?>
  </div>
  <?php
}
//get adherence_data ends
//ADHERENCE FUNCTION ENDS
?>