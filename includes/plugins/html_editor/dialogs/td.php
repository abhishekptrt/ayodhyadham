<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Table cell properties dialog
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// v.1.0, 2003-04-01
// ================================================

// include wysiwyg config
include '../config/spaw_control.config.php';
include $spaw_root.'class/util.class.php';
include $spaw_root.'class/lang.class.php';

$theme = SPAW_Util::getGETVar('theme',$spaw_default_theme);
$theme_path = $spaw_dir.'lib/themes/'.$theme.'/';

$l = new SPAW_Lang(SPAW_Util::getGETVar('lang'));
$l->setBlock('table_cell_prop');

$request_uri = urldecode(SPAW_Util::getPOSTVar('request_uri',SPAW_Util::getGETVar('request_uri')));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<meta http-equiv="Pragma" content="no-cache">
  <title><?php echo $l->m('title')?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $l->getCharset()?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $theme_path.'css/'?>dialog.css">
  <?php if (SPAW_Util::getBrowser() == 'Gecko') { ?>
  <script language="javascript" src="utils.gecko.js"></script>
  <?php }else{ ?>
  <script language="javascript" src="utils.js"></script>
  <?php } ?>
  <script language="javascript">
  <!--  
  function showColorPicker(curcolor) {

  <?php if (SPAW_Util::getBrowser() == 'Gecko') { ?>

    var wnd = window.open('<?php echo $spaw_dir?>dialogs/colorpicker.php?lang=<?php echo $_GET["lang"]?>&theme=<?php echo $_GET["theme"]?>&editor=<?php echo $_GET["editor"]?>&callback=showColorPicker_callback', 
      "color_picker", 
      'status=no,modal=yes,width=350,height=250'); 
    wnd.dialogArguments = curcolor;

  <?php }else{ ?>

    var newcol = showModalDialog('colorpicker.php?theme=<?php echo $theme?>&lang=<?php echo $l->lang?>', curcolor, 
      'dialogHeight:250px; dialogWidth:366px; resizable:no; status:no');  
    try {
      td_prop.cbgcolor.value = newcol;
      td_prop.color_sample.style.backgroundColor = td_prop.cbgcolor.value;
    }
    catch (excp) {}

  <?php } ?>
  }
  
  function showColorPicker_callback(editor, sender)
  {
    var bCol = sender.returnValue;
    try
    {
      document.getElementById('cbgcolor').value = bCol;
      document.getElementById('color_sample').style.backgroundColor = document.getElementById('cbgcolor').value;
    }
    catch (excp) {}
  }

  function showImgPicker()
  {
  <?php if (SPAW_Util::getBrowser() == 'Gecko') { ?>

    var wnd = window.open('<?php echo $spaw_dir?>dialogs/img_library.php?lang=<?php echo $_GET["lang"]?>&theme=<?php echo $_GET["theme"]?>&editor=<?php echo $_GET["editor"]?>&callback=showImgPicker_callback',
      "img_library", 
      'status=no,modal=yes,width=420,height=420'); 

  <?php }else{ ?>

    var imgSrc = showModalDialog('<?php echo $spaw_dir?>dialogs/img_library.php?theme=<?php echo $theme?>&lang=<?php echo $l->lang?>&request_uri=<?php echo $request_uri?>', '', 
      'dialogHeight:420px; dialogWidth:420px; resizable:no; status:no');
    
    if(imgSrc != null)
    {
      td_prop.cbackground.value = imgSrc;
    }

  <?php } ?>
  }
  
  function showImgPicker_callback(editor, sender)
  {
    var imgSrc = sender.returnValue;
    if(imgSrc != null)
    {
      document.getElementById('cbackground').value = imgSrc;
    }
  }

 
  function Init() {
    var cProps = window.dialogArguments;
    if (cProps)
    {
      // set attribute values
      document.getElementById('cbgcolor').value = cProps.bgColor;
      document.getElementById('color_sample').style.backgroundColor = document.getElementById('cbgcolor').value;
      document.getElementById('cbackground').value = cProps.background;
      if (cProps.width) {
        if (!isNaN(cProps.width) || (cProps.width.substr(cProps.width.length-2,2).toLowerCase() == "px"))
        {
          // pixels
          if (!isNaN(cProps.width))
            document.getElementById('cwidth').value = cProps.width;
          else
            document.getElementById('cwidth').value = cProps.width.substr(0,cProps.width.length-2);
          document.getElementById('cwunits').options[0].selected = false;
          document.getElementById('cwunits').options[1].selected = true;
        }
        else
        {
          // percents
          document.getElementById('cwidth').value = cProps.width.substr(0,cProps.width.length-1);
          document.getElementById('cwunits').options[0].selected = true;
          document.getElementById('cwunits').options[1].selected = false;
        }
      }
      if (cProps.width) {
        if (!isNaN(cProps.height) || (cProps.height.substr(cProps.height.length-2,2).toLowerCase() == "px"))
        {
          // pixels
          if (!isNaN(cProps.height))
            document.getElementById('cheight').value = cProps.height;
          else
            document.getElementById('cheight').value = cProps.height.substr(0,cProps.height.length-2);
          document.getElementById('chunits').options[0].selected = false;
          document.getElementById('chunits').options[1].selected = true;
        }
        else
        {
          // percents
          document.getElementById('cheight').value = cProps.height.substr(0,cProps.height.length-1);
          document.getElementById('chunits').options[0].selected = true;
          document.getElementById('chunits').options[1].selected = false;
        }
      }
      
      setHAlign(cProps.align);
      setVAlign(cProps.vAlign);
      
      if (cProps.noWrap)
        document.getElementById('cnowrap').checked = true;
      
      
	  /* spec styles for td will be used
      if (cProps.styleOptions) {
        for (i=1; i<cProps.styleOptions.length; i++)
        {
          var oOption = document.createElement("OPTION");
          td_prop.ccssclass.add(oOption);
          oOption.innerText = cProps.styleOptions[i].innerText;
          oOption.value = cProps.styleOptions[i].value;
  
          if (cProps.className) {
            td_prop.ccssclass.value = cProps.className;
          }
        }
      }
	  */

      if (cProps.className) {
        document.getElementById('ccssclass').value = cProps.className;
        css_class_changed();
      }
    }
    resizeDialogToContent();
  }
  
  function validateParams()
  {
    // check width and height
    if (isNaN(parseInt(document.getElementById('cwidth').value)) && document.getElementById('cwidth').value != '')
    {
      alert('<?php echo $l->m('error').': '.$l->m('error_width_nan')?>');
      document.getElementById('cwidth').focus();
      return false;
    }
    if (isNaN(parseInt(document.getElementById('cheight').value)) && document.getElementById('cheight').value != '')
    {
      alert('<?php echo $l->m('error').': '.$l->m('error_height_nan')?>');
      document.getElementById('cheight').focus();
      return false;
    }
    
    return true;
  }
  
  function okClick() {
    // validate paramters
    if (validateParams())    
    {
      var cprops = {};
      cprops.className = (document.getElementById('ccssclass').value != 'default')?document.getElementById('ccssclass').value:'';
      if (!document.getElementById('cwidth').disabled)
      {
        cprops.align = (document.getElementById('chalign').value)?(document.getElementById('chalign').value):'';
        cprops.vAlign = (document.getElementById('cvalign').value)?(document.getElementById('cvalign').value):'';
        cprops.width = (document.getElementById('cwidth').value)?(document.getElementById('cwidth').value + document.getElementById('cwunits').value):'';
        cprops.height = (document.getElementById('cheight').value)?(document.getElementById('cheight').value + document.getElementById('chunits').value):'';
        cprops.bgColor = document.getElementById('cbgcolor').value;
        cprops.noWrap = (document.getElementById('cnowrap').checked)?true:false;
        cprops.background = document.getElementById('cbackground').value;
      }
      window.returnValue = cprops;
      window.close();
      <?php
      if (!empty($_GET['callback']))
        echo "opener.".$_GET['callback']."('".$_GET['editor']."',this);\n";
      ?>
   