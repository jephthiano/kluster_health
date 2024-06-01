<?php
//DATE AND TIME FUNCTION STARTS
//show date starts
function show_date($date,$type = 'date',$mode='shorter'){
 if($type === 'year'){
  $year = new DateTime($date.'-01');
  return $year->format('Y');
 }elseif($type === 'month'){
  $month = new DateTime($date);
  return $month->format('F Y');
 }else{
  $now = time()+(get_xml_data('time_correction'));
  $today = date("Y-m-d",$now); // today day
  $yesterday = date("Y-m-d",strtotime($today)-60*60*24); // yesterday
  $tomorrow = date("Y-m-d",strtotime($today)+60*60*24); // tomorrow
  $thedate = date('Y-m-d',strtotime($date));
  if($today === $thedate){  // if same day return the time not days
    return "Today";
  }elseif($yesterday === $thedate){  //if yesterday return yesterday
    return "Yesterday";
  }elseif($tomorrow === $thedate){  //if tomorrow return tomorrow
    return "Tomorrow";
  }else{
   $thedate = strtotime($date);
   if($mode === "shorter"){
    return date('M d',$thedate);
   }elseif($mode === 'full'){
    return date('M d, Y',$thedate);
   }
  }
 }//end of else
}
//show date ends

//show date starts
 function showdate($datetime,$type='full'){
	$now = time()+(get_xml_data('time_correction'));
	$thedate = strtotime($datetime);
	if($type === 'shorter'){
  return date('M d',$thedate);
 }elseif($type === "short"){ //return in full format for short
		return date('M d, Y',$thedate);
	}else{ // else return in full format
		return date('M d, Y : g:i a',$thedate);	
	}
 }
//show date ends

//show time starts
function show_time($time){
 $time = new DateTime($time);
 return $time->format('g:ia');
}
//show time ends

//show date starts
 function showdate2($datetime,$type){
	$now = time();
	$thedate = strtotime($datetime);
	$interval = $now-$thedate;
	if($interval < 60){ // if less than 60seconds return in second
		return $interval. " sec ago";
	}elseif($interval >= 60 AND $interval < (60*60)){ // if less than 60 min return in minute
		return floor($interval/60). " min ago";
	}elseif($interval >= (60*60) AND $interval < (60*60*24)){ // if less than 1day return in hours
		return floor($interval/(60*60)). " hr ago";
	}elseif($interval >= (60*60*24) AND $interval < (60*60*24*2)){ //if less than 2days return in day
		return floor($interval/(60*60*24)). " day ago";
	}elseif($interval >= (60*60*24*2) AND $interval < (60*60*24*7)){ //if less than 2days and less than 7 days return in days
		return floor($interval/(60*60*24)). " days ago";
	}elseif($interval >= (60*60*24*7) AND $interval < (60*60*24*14)){ //if greater than 7days  and less than 2 weeks return in week
		return floor($interval/(60*60*24*7)). " week ago";
	}elseif($interval >= (60*60*24*14) AND $interval < (60*60*24*30)){ //if greater than 2 weeks and less than 30days return in weeks
		return floor($interval/(60*60*24*7)). " weeks ago";
	}elseif($interval >= (60*60*24*30) AND $interval < (60*60*24*60)){ //if greater than 1month and less than 2months return in month
		return floor($interval/(60*60*24*30)). " month ago";
	}elseif($interval >= (60*60*24*60) AND $interval < (60*60*24*365)){ //if greater than 2months and less than one year return in months
		return floor($interval/(60*60*24*30)). " month ago";
	}elseif($type === "short"){ //return in full format for short
		return date('jS, M Y',$thedate);
	}else{ // else return in full format
		return date('g:i a - jS, M Y',$thedate);	
	}
 }
//show date ends

//check time validity starts
function is_lapsed($duration,$starttime,$endtime=''){//check starttime+duration aginst endtime
  if(empty($endtime)){
    $end_time = time();
  }else{
    $end_time = strtotime($endtime);
  }
 $total_time = (strtotime($starttime)+$duration);
 if($total_time > $end_time ){ // if $total time is greater than endtime (total time has lapsed)
  return true; //it has lapsed
 }else{
  return false; //it has not lapsed
 }
}
//check time validity starts

//check if date data is valid starts
function is_date_valid($data,$format = 'Y-m-d H:i:s'){
  $date_time = DateTime::createFromFormat($format,$data);
  if($date_time === $data){
    return true;
  }else{
    return false;
  }
}
//check if date data is valid ends

//get remaing days starts
function remaining_days($date,$duration,$endpoint=''){
 $reg_date = new DateTime($date);
 $now = new DateTime();
 if(empty($endpoint)){
  $durationClass = new DateInterval("P{$duration}D");
  $endpoint_Class = $reg_date->add($durationClass);
 }else{
    $endpoint_Class = new DateTime($endpoint);
 }
 $interval = $endpoint_Class->diff($now);
 $days = $interval->format('%a');
 if($days < 0){
  return 'expired';
 }elseif($days == 0){
  return 'less than a';
 }else{
  return $days;
 }

}
//get remaing days starts

// add_time starts
function add_time($datetime,$add,$type='second'){
 $thedate = strtotime($datetime);
 if($type === 'hour'){
  $add_time = (60*60*$add);
 }elseif($type === 'day'){
  $add_time = (60*60*24*$add);
 }
 $new_datetime =  ($thedate+$add_time);
 return date('Y-m-d H:i:s',$new_datetime);	
}
// add_time ends
// DATE AND TIME FUNCTION ENDS
?>