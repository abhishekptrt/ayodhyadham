<?php
// require variables named: $input_name, $def_color
?>
<SCRIPT language=JavaScript>
 var color_picker_<?=$input_name?> = new ColorPicker('divColPick_<?=$input_name?>'); // Popup window
</SCRIPT>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="<?=$input_name?>" type="text" id="<?=$input_name?>" value="<?=$def_color?>" <?=$input_attr?> /></td>
    <td><div id="colpick_<?=$input_name?>" style="background-color: #ffffff"><a href="javascript:void(color_picker_<?=$input_name?>.select(document.getElementById('<?=$input_name?>'),'pick_<?=$input_name?>'))" name="pick_<?=$input_name?>" id="pick_<?=$input_name?>" class="readmorelink"><img src="<?=COLOR_PICKER_WS_PATH?>/colpick1.gif" alt="Pick Color" border="0" /></a></div>
	<div style="position:absolute" id="divColPick_<?=$input_name?>"></div>
	</td>
  </tr>
</table>
<?php if($def_color!='') { ?>
<SCRIPT language=JavaScript>
	document.getElementById('colpick_<?=$input_name?>').style.backgroundColor = "<?=$def_color?>";
</SCRIPT>
<?php }?>