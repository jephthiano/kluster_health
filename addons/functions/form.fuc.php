<?php
//FORM FUNCTION STARTS
//form hidden starts
function get_form_hidden($id,$value){
  ?> <input type="hidden"name="<?=$id?>"id="<?=$id?>"value="<?=$value?>"> <?php
}
//form hidden ends

//form button starts
function get_form_button($id,$value,$disable=''){
 if(server_type() === 'admin'){$color = 'j-color8';}elseif(server_type() === 'doctor'){$color = 'j-color9';}else{$color = 'j-color1';}
  ?> <button type='submit'id='<?=$id?>'name='<?=$id?>'class="j-btn j-medium <?=$color?> j-round-large j-bolder"style='width:100%;max-width:400px;'<?=$disable?>><?=$value?></button> <?php
}
//form button ends


//form password starts
function get_form_password($btn_id,$id='pss',$placeholder='Password',$disable='',$label='',$eye=''){
  if(empty($label)){
   ?> <span class='mg j-text-color8 j-left'id='<?=$id?>e'></span><br class='j-clearfix'><?php
  }else{
   ?> <label class="j-left"><b><?=$label?>: </b><span class='mg j-text-color8 'id='<?=$id?>e'></span></label><br> <?php
  }
  ?>
  <div style="width:100%;max-width:400px;position:relative;">
   <input type="password"class="pss ip j-input j-medium j-border-2 j-border-color5 j-round j-color4 j-text-color3"minlength="7"maxlength="30"placeholder="<?=$placeholder?>"required
    name="<?=$id?>"id="<?=$id?>"value=""style="width:inherit;max-width:inherit;outline:none;"onkeyup="daebtn(this,$('#<?=$btn_id?>'))"/>
    <?php
    if($eye !== 'hide'){
     ?><div class="j-eye"style="width:30px;"><span id="eye<?=$id?>"class="j-clickable"onclick="cpit('<?=$id?>');"><i class="<?=icon('eye')?>"></i></span></div><?php
    }
    ?>
  </div>
  <br>
  <?php
}
//form password ends

//form checkbox starts
function get_form_checkbox($id,$value,$checked='',$onclick=''){
  ?><input type="checkbox"name="<?=$id?>"id="<?=$id?>"value="<?=$value?>"class="j-check"<?=$checked?>onclick="<?=$onclick?>"/><?php
}
//form checkbox ends

//form radio starts
function get_form_radio($id,$value,$checked='',$onclick=''){
  ?><input type="radio"name="<?=$id?>"id="<?=$id?>"value="<?=$value?>"class="j-check"<?=$checked?>onclick="<?=$onclick?>"/><?php
}
//form radio ends

//form select starts
function get_form_select($id,$data='',$value='',$label='',$select='',$action='',$notice=''){
 $value = strtolower($value);
 if(empty($label)){
   ?> <span class='mg j-text-color8 j-left'id='<?=$id?>e'></span><br class='j-clearfix'><?php
  }else{
   ?> <label class="j-left"><b><?=$label?>: </b><span class='mg j-text-color8'id='<?=$id?>e'></span></label><br> <?php
  }
 ?>
 <select id='<?=$id?>'name="<?=$id?>"class='ip j-input j-select j-medium j-border-2 j-border-color5 j-round j-color4 j-text-color3'style="width:100%;max-width:400px;outline:none;"<?=$action?>>
  <option value="">Select <?=$select?></option>
  <?php
  if(is_array($data)){
   foreach($data AS $datum){
    $low_datum = strtolower($datum);
    ?><option value="<?=$low_datum?>"<?=($value === $low_datum)?"selected":"";?>><?=ucwords($datum)?></option><?php
  }
  }else{
   ?><option value="<?=$data?>"<?=($value === $data)?"selected":"";?>><?=ucwords($data)?></option><?php
  }
  ?>
 </select>
 <?php if(!empty($notice)){?><span class='j-small j-text-color5 j-italic'style="position:relative;top:-5px;">(<?=$notice?>)</span><?php }?><br>
 <?php
}
//form select ends

//form textarea starts
function get_form_textarea($id,$btn_id,$placeholder,$value='',$row='',$min_len,$max_len,$label='',$disable='',$required='required',$notice=''){
 if(empty($label)){
   ?> <span class='mg j-text-color8 j-left'id='<?=$id?>e'></span><br class='j-clearfix'><?php
  }else{
   ?> <label class="j-left"><b><?=$label?>: </b><span class='mg j-text-color8'id='<?=$id?>e'></span></label><br> <?php
  }
  ?>
  <textarea class="ip j-input j-medium j-border-2 j-border-color5 j-round j-color4 j-text-color3"name="<?=$id?>"id="<?=$id?>"minlength="<?=$min_len?>"maxlength="<?=$max_len?>"placeholder="<?=$placeholder?>"rows="<?=$row?>"
    <?=$required?> <?=$disable?> style="width:100%;max-width:400px;outline:none;"onkeyup="daebtn(this,$('#<?=$btn_id?>'));"><?=$value?></textarea>
    <?php if(!empty($notice)){?><span class='j-small j-text-color5 j-italic'style="position:relative;top:-5px;">(<?=$notice?>)</span><?php }?><br><br>
  <?php
}
//form textarea ends

//form type starts
function get_form_type($type,$id,$btn_id,$placeholder,$value='',$min_len='',$max_len='',$label='',$disable='',$required='required',$onkeyup="",$notice=''){
  if(empty($label)){
   ?> <span class='mg j-text-color8 j-left'style=""id='<?=$id?>e'></span><br class='j-clearfix'><?php
  }else{
   ?> <label class="j-left"><b><?=$label?>: </b><span class='mg j-text-color8'id='<?=$id?>e'></span></label><br> <?php
  }
  ?>
		<input type="<?=$type?>"class="ip j-input j-medium j-border-2 j-border-color5 j-round j-color4 j-text-color3"minlength="<?=$min_len?>"maxlength="<?=$max_len?>"placeholder="<?=$placeholder?>"
				<?=$required?> <?=$disable?> name="<?=$id?>"id="<?=$id?>"value="<?=$value?>"style="width:100%;max-width:400px;outline:none;"
    onkeyup="daebtn(this,$('#<?=$btn_id?>'));<?=$onkeyup?>"/>
    <?php if(!empty($notice)){?><span class='j-small j-text-color5 j-italic'style="position:relative;top:-5px;">(<?=$notice?>)</span><?php }?><br>
  <?php
}
//form type ends
//FORM FUNCTION ENDS
?>