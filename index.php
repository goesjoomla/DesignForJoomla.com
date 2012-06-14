<?php	/* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php if ($my->id) { initEditor(); } ?>
	<?php mosShowHead(); ?>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>">
	<META NAME="revisit-after" CONTENT="1 days">
	<meta name="Copyright" content="(c) Ju+Ju Group">
	<meta name="Publisher" content="Your Mambo Design">
	<meta name="Language" content="en">
	<link rel="shortcut icon" href="<?php echo $GLOBALS['mosConfig_live_site'];?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_05/css/template_css.css" />
<script language="JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->
</script>
</head>

<body bgcolor="#FFFFF2" link="#826800" vlink="#B38E00" alink="#CEA500" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="760" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="760" height="143" background="templates/business_05/images/header_bg.png">
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    		<tr>
    			<td height="22" valign="middle" nowrap>
<!-- Show Current Date - Begin -->
<div align="right" style="padding-right: 5px; font-size: 11px; font-weight: bold; font-style: italic; color: #FCFF00;">
	<?php echo (date(_DATE_FORMAT)); ?>
</div>
<!-- Show Current Date - End -->
    			</td>
  			</tr>
    		<tr>
    			<td height="77" valign="middle" nowrap>
<!-- Show Site's Logo, Title and Slogan - Begin -->
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="25%" align="center">
<!-- Show Logo - Begin -->
<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
	<img border="0" src="templates/business_05/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>" align="absmiddle" />
</a>
<!-- Show Logo - End -->
								</td>
								<td width="75%" valign="middle">
<!-- Show Title & Slogan - Begin -->
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
	<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
<!-- Show Title & Slogan - End -->
								</td>
							</tr>
						</table>
<!-- Show Site's Logo, Title and Slogan - End -->
    			</td>
  			</tr>
  			<tr> 
    			<td height="25" nowrap>
<!-- Top Menu - Begin -->
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,8");
	$rows = $database->loadObjectList();
	foreach($rows as $row) {
		echo "<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
	}
?>
<!-- Top Menu - End -->
    			</td>
  			</tr>
  			<tr> 
    			<td height="19" valign="middle" style="padding-left: 5px;" nowrap>
<!-- Load Pathway - Begin -->
	<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?>
<!-- Load Pathway - End -->
    			</td>
  			</tr>
    	</table>
    </td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#FFFFFF" valign="top"> 
          <td width="150" bgcolor="#FFCC33" style="padding: 5px;">
<!-- Load Left Module - Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module - End -->
          </td>
          <td width="460" bgcolor="#FFFFFF"> 
            <table width="100%" border="0" cellpadding="10" cellspacing="0" class="forTexts">
              <tr>
<?php
	$head_imgs = array('main.jpg', 'office.gif');
	$head_img = $head_imgs[rand(0, 1)];
?>
                <td><div align="left"><img src="templates/business_05/images/<?php echo $head_img; ?>" width="440" height="162"></div>
<!-- Load User1, User2, Top Module, Main Content & Bottom Module - Begin -->
<?php if ( (mosCountModules('user1') > 0) OR (mosCountModules('user2') > 0) ) { ?>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
<?php if ( (mosCountModules('user1') > 0) AND (mosCountModules('user2') > 0) ) { ?>
	<td width='50%' align='center' valign='top'><?php mosLoadModules("user1"); ?></td>
	<td width="3" height="100%" nowrap></td>
	<td width='50%' align='center' valign='top'><?php mosLoadModules("user2"); ?></td>
<?php } elseif (mosCountModules('user1') > 0) { ?>
	<td width='100%' align='center' valign='top'><?php mosLoadModules("user1"); ?></td>
<?php } elseif (mosCountModules('user2') > 0) { ?>
	<td width='100%' align='center' valign='top'><?php mosLoadModules("user2"); ?></td>
<?php } ?>
	</tr></table>
<?php }
	if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; }
	mosMainBody();
	if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); }
?>
<!-- Load User1, User2, Top Module, Main Content & Bottom Module - End -->
                </td>
              </tr>
            </table>
          </td>
          <td width="150" bgcolor="#FFCC33" style="padding: 5px;">
<!-- Load Right Module - Begin -->
	<?php if (mosCountModules('right') > 0) { mosLoadModules ( "right" ); } ?>
<!-- Load Right Module - End -->
          </td>
        </tr>
        <tr bgcolor="#FFFFFF" valign="top"> 
          <td width="150" height="90" bgcolor="#FFCC33">&nbsp;</td>
          <td height="90" align="center" valign="bottom" bgcolor="#FFFFFF" class="forTexts"> 
            <hr width="90%" size="1">
<!-- Credit Line - Begin -->
<div align="center">
Template source from <a href="http://www.adesdesign.net" target="_blank">Ades Design</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
          </td>
          <td width="150" height="90" bgcolor="#FFCC33">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="19" background="templates/business_05/images/top_row_bg.gif">
<!-- Bottom Menu - Begin -->
<div align="center" style="font-size: 11px; font-weight: bold; font-style: italic; letter-spacing: 2px; color: #FCFF00;">
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,8");
	$rows = $database->loadObjectList();
	$i = 0;
	foreach($rows as $row) {
		if ($i == 0) {
			echo "<a href='$row->link&Itemid=$row->id'>$row->name</a>";
		} else {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='$row->link&Itemid=$row->id'>$row->name</a>";
		}
		$i++;
	}
?>
</div>
<!-- Bottom Menu - End -->
    </td>
  </tr>
</table>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>


