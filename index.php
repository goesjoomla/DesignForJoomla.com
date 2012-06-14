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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_03/css/template_css.css" />
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

<body bgcolor="#dddddd" text="#000000">
<table cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
  <tr> 
    <td width="115" rowspan="4" valign="top" background="templates/business_03/images/LeftTab.jpg" style="background-repeat: repeat-x;">
<!-- Load Site's Logo - Begin -->
				<br/>
				<div align="center"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
					<IMG border="0" align="absmiddle" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_03/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
				</a></div>
				<br/>
<!-- Load Site's Logo - End -->
      <table width="100%" border="0">
        <tr> 
          <td valign="top" style="padding: 3px;">
<!-- Load Left Module - Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module - End -->
          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </td>
    <td width="648" colspan="7" align="center" valign="middle" background="templates/business_03/images/bar1.jpg" style="background-repeat: no-repeat; padding: 2px;">
<!-- Top Menu - Start -->
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering");
	$rows = $database->loadObjectList();
	$i = 0;
	echo '&nbsp;&nbsp;&nbsp;';
	foreach($rows as $row) {
		$i += 1;
		if ($i == 1) {
			echo "<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
		} else {
			echo "&nbsp;&nbsp;&nbsp;<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
		}
	}
	echo '&nbsp;&nbsp;&nbsp;';
?>
<!-- Top Menu - End -->
    </td>
  </tr>
  <tr> 
    <td width="648" colspan="7" align="center" valign="top">
<!-- Load Site's Title and Slogan - Begin -->
<br/>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="17" nowrap>&nbsp;</td>
    <td width="615" height="86" valign="middle" background="templates/business_03/images/Bannert.jpg" style="background-repeat: no-repeat;">
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
&nbsp;&nbsp;&nbsp;<font face="Arial" size="4" color="#ff6600"><?php echo strtoupper($site_title[0]); ?></font><br/>
&nbsp;&nbsp;&nbsp;<font face="Arial" size="3" color="#ff9900"><?php echo $site_title[1]; ?></font>
    </td>
    <td width="16" nowrap>&nbsp;</td>
  </tr>
</table>
<br/>
<!-- Load Site's Title and Slogan - End -->
    </td>
  </tr>
  <tr> 
    <td width="27" valign="top"></td>
    <td width="243" colspan="2" valign="top"> 
      <img src="templates/business_03/images/STL1.jpg" width="243" align="center"><br/><br/>
<!-- Load Right Module - Begin -->
		<div align="center" style="background-color: #DEDDED; padding: 1px;"><?php mosLoadModules ( "right" ); ?></div>
<!-- Load Right Module - End -->
    </td>
    <td width="14" valign="top"></td>
    <td width="333" colspan="2" valign="top"> 
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
	<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; } ?>
	<?php mosMainBody(); ?>
	<?php if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); } ?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
    </td>
    <td width="31" valign="top"></td>
  </tr>
  <tr> 
    <td width="27" valign="top"></td>
    <td width="54" valign="top"></td>
    <td width="504" colspan="3" valign="top">
      <img src="templates/business_03/images/bar2.jpg" width="504" align="center">
<!-- Load Banner Module - Begin -->
	<div align="center" style="padding: 10px;">
		<?php if (mosCountModules('banner') > 0) { mosLoadModules( 'banner', -1 ); } ?>
	</div>
<!-- Load Banner Module - End -->
    </td>
  </tr>
  <tr height="2">
    <td width="115" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
    <td width="27" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
    <td width="54" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
    <td width="189" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
    <td width="14" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
    <td width="301" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
    <td width="32" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
    <td width="31" valign="top" background="templates/business_03/images/LeftTab.jpg"></td>
  </tr>
  <tr>
  	<td colspan="8" align="center" style="padding: 5px;">
<!-- Credit Line - Begin -->
Template source from <a href="http://freesitetemplates.com" target="_blank">Free Site Templates</a> by <a href="mailto:jim@jimworld.com" target="_blank">JimWORLD</a>.<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
  	</td>
  </tr>
</table>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>
