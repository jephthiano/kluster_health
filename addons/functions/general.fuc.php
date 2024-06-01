<?php
//GENERAL FUNCTIONS STARTS
//classes auto load starts
spl_autoload_register(function ($className){
 $className = str_replace('..','',$className); //to removes .. so as to ensure that it is not used by attacker to get to above folder
 require_once(file_location('inc_path','classes/'.$className.'.cla.php'));
});
//classes auto load ends

//close connection function starts
function closeconnect($connectionType='',$connectionVar=''){
	if(@$connectionType === "db"){
		return @$connectionVar = null;
	}elseif(@$connectionType === "stmt"){
		return @$connectionVar = null;
	}elseif(@$connectionType === "curl"){
		return curl_close(@$connectionVar);
	}
}
//close connection function ends

// decode output starts
function decode_data($data){$data = htmlspecialchars_decode($data);return $data;}
//decode output ends

//encryption and decryption 2 starts
define('IV','mwrsaasghsh53456');
define("CIPHER","aes-128-cfb");
define("KEY","6346634bchbjdb");
//encryption
function ssl_encrypt_input($data){
	return openssl_encrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
//decryption
function ssl_decrypt_input($data){
	return openssl_decrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
// message encryption
function ssl_encrypt_message($data){
	return openssl_encrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
// message decryption
function ssl_decrypt_message($data){
	return openssl_decrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
//encryption and decryption 2 ends	

// hash input starts
function hash_input($data){$salt1 = '@jhdge$#fyyigtun76565665nk3?(hryryr())hghg@%^&#$#';$salt2 = 'leehack2DJhs(874764_))';return hash('ripemd128',"$salt1$data$salt2");}
// hash input ends

// hash pass starts
function hash_pass($pass){$options = ['cost' => 10,];return password_hash($pass, PASSWORD_DEFAULT, $options);}
// hash pass ends

//page not available starts
function page_not_available($type="full"){
 if(server_type('previous') === 'admin'){
   $location = file_location('admin_url',''); $j_text_color = "j-text-color8";$j_color = "j-color8";$j_border_color = "j-border-color8";
 }elseif(server_type('previous') === 'doctor'){
  $location = file_location('doctor_url',''); $j_text_color = "j-text-color9";$j_color = "j-color9";$j_border_color = "j-border-color9";
 }else{
  $location = file_location('home_url',''); $j_text_color = "j-text-color1";$j_color = "j-color1";$j_border_color = "j-border-color1";
 }
	?>
 <br>
 <center>
  <div class="j-card-4 j-color6 j-round"style="width:96%;max-width:400px;height:auto;margin-top:50px">
   <div class="j-display-container">
    <div class="j-container">
     <br><br>
     <div style="width:150px;height: 150px;"class="j-border-2 <?=$j_bolder_color?> j-circle j-display-container">
      <span class="j-display-middle <?=$j_text_color?>"><i class="<?=icon('times')?> j-xxlarge"></i></span>
     </div>
     <div>
      <br>
      <div class=""style="font-family: Roboto,sans-serif;width: 100%;"">
       <p class="<?=$j_text_color?>">
        Sorry, the page you are looking for is not available, page may have been deleted, link may have been broken or you may not have access to the content<br><br>
        <a href="<?=$location?>"class="j-btn j-bolder <?=$j_color?> j-text-color4 j-round-large">
        Back to home
        </a>
       </p>
      </div>
      <br><br>
     </div>
    </div>
   </div>
  </div>
</center>   
	<?php
}
//page not available ends

// trigger error starts
function trigger_error_manual($error=404){http_response_code($error);require_once(file_location('home_path','error/index.php'));die();}
// trigger error starts

//add random number starts
function addnum($data){$first_four = rand(1,9).rand(1,9).rand(1,9).rand(1,9);$last_three = rand(1,9).rand(1,9).rand(1,9);return strrev($first_four.$data.$last_three);}
//add random number ends
	
//remove random number starts
function removenum($data){return strrev(substr(substr($data,3),0,-4));}
//add random number ends

//cal percentage starts
function cal_percentage($total,$data){
 return round(($data/$total) * 100,1).'%';
}
//cal percentage ends
//time token starts
function time_token(){return time().rand(000000,999999);}
//time token ends
 
// generate random token starts
function random_token($data = ''){return md5(microtime(true).mt_rand().$data);}
// generate random token ends
	
//text length start
function text_length($data,$length,$type='see_more'){
 if(strlen($data) > $length){
  if($type === 'see_more'){
   $data = substr($data,0,$length)."...<i class='j-text-color5'>See More</i>";
  }elseif($type === 'no_dot'){
   $data = substr($data,0,$length);
  }else{
   $data = substr($data,0,$length)."...";
  }  
 }
  return $data;
 }
//text length ends

//function convert to line break starts
function convert_2_br($data){$data2 = str_replace(array("\r\n","\r","\n"),"<br>",$data);echo $data2;}
//function convert to line break ends

//fucntion get word starts
function get_word($word,$num){
 $num = ($num-1);
 $word_array = explode(' ',$word);
 return $word_array[$num];
}
//fucntion get word ends
//icon starts
function icon($data,$type='fas'){return $type.' fa-'.$data;}
//icon ends

//remove last starts
function remove_last_value($input,$remove = '*'){
	$position = strpos($input,$remove);
	if ($position === false){
		return $input;
	}else{
		$input = substr($input,0,-1);return $input;
	}
}
//remove last ends

//s/n starts
function s_n(){static $x = 1;echo $x;$x++;}
//s/n ends

// regex starts
function regex($type,$data){
 if($type === 'email'){
  $reg = "/^[\w.-]*@[\w.-]+\.[A-Za-z]{2,6}$/";
 }elseif($type === 'word_comma'){ //for languages and co
  $reg = "/^[\w]*\,?\ ?[\w]*\,?\ ?[\w]*\,?\ ?[\w]*\,?\ ?$/";
 }elseif($type === 'word_space'){
  $reg = "/^[a-zA-Z ]*$/";
 }elseif($type === 'word_number_nospace'){
  $reg = "/^[a-zA-Z0-9]*$/";
 }elseif($type === 'phonenumber'){
  $reg = "/^\+?[\d]{11,17}$/";
 }elseif($type === 'skill'){ // for word . ' - @ 
  $reg = "/^[\w .'-@]+$/";
 }elseif($type === 'sql_date'){
  $reg = "/^[\d]{4}-[\d]{2}-[\d]{2} [\d]{2}:[\d]{2}:[\d]{2}$/";
 }elseif($type === 'account_number'){
  $reg = "/^[\d]{10}$/";
 }else{
  return false;
 }
 return preg_match($reg,$data);
}
// regex ends

//re key array starts
function re_key_array($data){if(is_array($data)){$data = implode('|',$data);$data = explode('|',$data);return $data;}else{return false;}}
// re key array ends

//function get_header starts
function get_header($header,$button='back',$right_menu='',$size='',$type='home_url',$color='j-color4'){
 global $color6;
 if($button === 'back'){
  $btn = "<span onclick='history.go(-1);'class='j-left'><span style='position:relative;top:-5px;'class='j-btn j-large'>&#10094;</span></span>";
 }elseif($button === 'hide'){
  $btn = "<span style='margin-right:20px;'></span>";
 }else{
  $btn = "<a href='{$button}'><span style='margin-right:20px;'class='j-btn j-large'>&#10094;</span></a>";
 }
 $right_menu = "<span class='j-right'>{$right_menu}</span>";
 ?>
 <div class='<?=$color?> dmb6 dm4 j-top-index'style="position:sticky;top:0;">
 <div class='j-hide-small j-hide-medium'>
  <div class='j-center j-large j-padding'><span><?=$btn."<div style='display:inline;'>".$header."</div>".$right_menu?></span></div>
 </div>
 <div class='j-hide-large j-hide-xlarge'>
  <div class='j-center <?=($button === 'hide')?"j-padding-large":"j-padding";?>'><span><?=$btn."<div class='j-large'style='display:inline;'>".$header."</div>".$right_menu?></span></div>
  <br class='j-clearfix'>
 </div>
 </div>
 <?php
}
//function get header ends

//fucntion back button starts
function back_btn(){
 ?>
 <a href='<?=file_location('home_url','')?>'><span style='margin-left:5px;'class='j-right j-xlarge'>
  &#10094;<span class="j-large"style='margin:5px 10px;position:relative;top:-2px'>Home</span></span>
 </a>
 <span onclick='history.go(-1);'><span style='margin:5px 15px;'class='j-clickable j-xlarge'>&#10094;</span></span>
 <?php
}
//fucntion back button ends

//back to the top starts
function back_to_top($type=''){
 ?> <div><a class="j-color3 j-button j-right"href="#<?=$type?>"><i class="fa fa-arrow-up j-margin-right"> </i>To the top</a></div><br><br> <?php
}
//back to the top ends

//function misc header starts
function misc_header($data){
 ?>
	<div class='j-display-container j-misc-height'style='width:100%'>
		<img src="<?=file_location('media_url','home/logo_large.png')?>"style='height:inherit;width:inherit;'/>
		<div class='j-display-middle j-text-color4 j-misc-height'style="font-family:Sofia;width:100%;background-color:rgba(0,0,0,0.4)">
			<?php back_btn();?>
			<center>
				<span class='j-xxxlarge j-hide-small'><b><br><?=strtoupper(get_xml_data('company_name'))?><br><?=strtoupper($data)?></b></span>
				<span class='j-xlarge j-hide-medium j-hide-large j-hide-xlarge'><b><br><?=strtoupper(get_xml_data('company_name'))?><br><?=strtoupper($data)?></b></span>
			</center>
		</div>
	</div>
	<br>
 <?php
}
//function misc header ends
//GENERAL FUNCTIONS ENDS
?>