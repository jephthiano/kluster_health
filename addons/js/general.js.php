<?php //GENERAL JS STARTS ?>
<?php //hide modal when page is ready ?>
$(document).ready(function(){$('#load_modal').fadeOut(300);})
const hu="<?=file_location('home_url','')?>";var dar="<?=file_location('ajax_url','')?>";const dhu="<?=file_location('doctor_url','')?>";var ddar="<?=file_location('doctor_ajax_url','')?>"; var err_msg = "<b class='j-text-color8'>Sorry!!!</b><br>";
function loading(s='Loading',t='id',i='sbtn'){let vl= "<span class='j-spinner-border j-spinner-border-sm'style='margin-right:7px;'></span>"+s;if(t==='id'){$('#'+i).html(vl);$('#'+i).prop('disabled',true);}else if(t==='class'){$('.'+i).html(vl);}$('.'+i).prop('disabled',true);}
function rvs(str){return str.split("").reverse().join('');}function grn(){return Math.floor(Math.random() * 9) + 1;}function an(str){frt4 = grn()+''+grn()+''+grn()+''+grn();lst3 = grn()+''+grn()+''+grn();return rvs(frt4+str+lst3)}function rn(str){str = ''+str;return rvs(str.slice(3).slice(0,-4));}<?php //reverse string, generate ranndom number, add num and remove number ?>
function r_b(s='Submit',t='id',i='sbtn'){if(t==='id'){$('#'+i).html(s);$('#'+i).prop('disabled',false);}else if(t==='class'){$('.'+i).html(s);$('.'+i).prop('disabled',false);}}
alertoff();function alertoff(){setTimeout(thealert,8000);}function thealert(){$("#thealert").fadeOut('slow');}
function r_m(s,d='st'){if(s.length>0){s=s;}else{s='Error occurred';}var msg = "<span class='j-text-color4 j-button alert j-color1 j-bolder j-container j-padding j-round j-fixalert'id='thealert'>"+s+"</span>";$('#'+d).html(msg);alertoff();}
function r_m2(s,d='st'){if(s.length>0){s=s;}else{s='Sorry!!!<br>Error occurred while running request, please try again later or reload page';}var err="<div id='return_message_modal'class='j-modal j-modal-click'><div class='j-card-4 j-modal-content j-color4'style='margin-top:200px;'><div class='j-padding'>"+s+"</div><center class='j-padding'><div class='j-clickable j-text-color1 j-round j-border j-border-color1 j-padding'style='width:100%'onclick=$('#return_message_modal').fadeOut('slow');>Close</div></center></div></div>";$('#'+d).html(err);$('#return_message_modal').fadeIn('slow');}
<?php //click anywhere to hide modal?>
$(document).ready(function(){let m = document.getElementsByClassName('j-modal-click');window.onclick = function(event){for(let i = 0; i < m.length; i++){if(event.target == m[i]){m[i].style.display = 'none';}}};})
<?php //hide 000webhost advert ?>
<?php if(strstr(file_location('home_url',''),'000webhostapp')){ ?>
$(document).ready(function(){$('div').last().hide();})
<?php } ?>
$('.min-height').css('min-height',$(window).height()+'px');<?php //for min height of the 3 segment?>
<?php //change password input type (change the inptu type and the eye symbol)?>
function cpit(i){let ps=$('#'+i).attr('type');if(ps==='password'){$('#'+i).attr('type','text');$('#eye'+i).html("<i class='<?=icon("eye-slash")?>'></i>");}else{$('#'+i).attr('type','password');$('#eye'+i).html("<i class='<?=icon("eye")?>'></i>");}}
<?php //to disable and reenable sign up button if input is not empty?>
function daebtn(s,btn){if(s.value.length > 0){btn.prop("disabled",false);}else{btn.prop("disabled",true);}}
<?php //get patient data?>
function gepid(t,i=''){$.ajax({type:'GET',url:dar+'get/gepid/'+t+'/'+i,cache:false}).done(function(s){$('#'+t).html(s);if(t==='rem'){hornavigation('unconfirmed_medication',$('#t_unconfirmed_medication'));}})}
<?php //get doctor data?>
function gedd(t,i=''){$.ajax({type:'GET',url:dar+'get/gedd/'+t+'/'+i,cache:false}).done(function(s){$('#'+t).html(s);})}
<?php //get numrow?>
function genr(t,i=''){$.ajax({type:'GET',url:dar+'get/genr/'+t+'/'+i,cache:false}).done(function(s){$('.'+t).html(s);})}
<?php if(php_self('/reminders/index.php','home')){ ?> <?php //for horizontal navigation?>
function hornavigation(n,c,i=''){
 let x = document.getElementsByClassName("trigger"+i);
 for(let i = 0; i < x.length; i++){x[i].style.display="none";}
 document.getElementById(n).style.display="block";
 $('.laucher'+i).each(function(){$(this).addClass('j-color6 j-text-color1');$(this).removeClass('j-color1 j-text-color4');}) //for all other buttons
 //for clicked button
 if(c.hasClass('j-color1')){
  c.addClass('j-color6 j-text-color1');c.removeClass('j-color1 j-text-color4');
 }else if(c.hasClass('j-color6')){
  c.addClass('j-color1 j-text-color4');c.removeClass('j-color6 j-text-color1');
 }
}
<?php } ?>