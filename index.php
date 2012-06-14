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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/design_01/css/template_css.css" />
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

<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0"><a name="top"></a>

<table width="750" height="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<td valign="top" height="52">
<table border="0" cellpadding="0" cellspacing="0" height="52">
<tr>
<td><img src="templates/design_01/images/logo.gif" width="170" height="52"></td>
<td><img src="templates/design_01/images/gtx_des_02.jpg" width="17" height="52"></td>
<td background="templates/design_01/images/gtx_des_03.jpg" width="471" height="52" valign="middle">
	<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font>
	</a><br/>
	<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
</td>
<td><img src="templates/design_01/images/gtx_des_04.gif" width="90" height="52"></td>
<td><img src="templates/design_01/images/gtx_des_05.gif" width="2" height="52"></td>
</tr>
</table>
</td>
</tr><tr>
<td valign="top" height="100%">
<table border="0" cellpadding="0" cellspacing="0" height="100%">
<tr>
<td background="templates/design_01/images/bg_panel.jpg" width="170" height="100%" valign="top">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="top"><img src="templates/design_01/images/bg_flash.jpg" width="170" height="78"></td>
</tr><tr>
<td valign="top"><img src="templates/design_01/images/gtx_des_13.jpg" width="170" height="39"></td>
</tr>
<tr>
<td valign="top">
<!-- Load Left Module :: Begin -->
	<?php mosLoadModules("left"); ?>
	<?php if (mosCountModules('right') > 0) { echo '<hr/>'; mosLoadModules ( "right" ); } ?>
<!-- Load Left Module :: End -->
</td>
</tr>
</table>
</td>
<td background="templates/design_01/images/bg_mid.jpg" width="17" height="100%" valign="top">
<img src="templates/design_01/images/gtx_des_07.jpg" width="17" height="24" border="0">
</td>
<td bgcolor="#FFFFFF" width="561" height="100%" valign="top">
<table border="0" cellpadding="0" cellspacing="0" height="100%">
<tr>
<td valign="top"><img src="templates/design_01/images/gtx_des_08.jpg" width="561" height="24"></td>
</tr>
<tr><td bgcolor="#E0EBFE" width="561" height="75" align="center">
<!-- Load Top Banner :: Begin -->
<?php if (mosCountModules('banner') > 0) { mosLoadModules( 'banner', -1 ); } ?>
<!-- Load Top Banner :: End -->
</td></tr>
<tr><td valign="top" height="100%">
<table width="561" height="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<td valign="top">
<table border="0" cellpadding="0" cellspacing="0"><tr>
<td colspan="2"><img src="templates/design_01/images/pg_01.gif" width="561" height="1"></td>
</tr><tr>
<td><img src="templates/design_01/images/pg_02.gif" width="43" height="24"></td>
<td width="518" height="24" bgcolor="#FFFFFF">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%"><tr>
<td class="title">
<!-- Load Page Title :: Begin -->
<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>
<!-- Load Page Title :: End -->
</td></tr></table></td>
</tr><tr>
<td colspan="2"><img src="templates/design_01/images/pg_04.gif" width="561" height="7"></td>
</tr></table></td>
</tr><tr>
<td valign="top" height="100%">
<table border="0" cellpadding="0" cellspacing="0" height="100%"><tr>
<td bgcolor="#7F7F7F" height="100%"><img src="templates/design_01/images/spacer.gif" width="1" height="100%"></td>
<td width="560" height="239">
<table border="0" cellpadding="6" cellspacing="0" width="100%" height="100%"><tr>
<td height="239" valign="top">
<!-- Load Page Content :: Begin -->
<!-- Load Top Module -->
	<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; } ?>
<!-- Load Main Content -->
	<?php mosMainBody(); ?>
<!-- Load Bottom Module -->
	<?php if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); } ?>
<!-- Load Page Content :: End -->
</td></tr></table>
</td></tr></table></td>
</tr><tr>
<td valign="top">
<table border="0" cellpadding="0" cellspacing="0"><tr>
<td><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>"><img src="templates/design_01/images/fbutt_home.gif" width="43" height="16" border="0" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - Home Page"></a></td>
<td width="465" height="16" align="center" valign="middle">
<!-- Load Bottom Menu :: Begin -->
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' AND name!='Home' AND parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering");
	$rows = $database->loadObjectList();
	$first = TRUE;
	foreach($rows as $row) {
		if (!preg_match("/Itemid=/", $row->link)) {
			$item_url = "$row->link&Itemid=$row->id";
		} else {
			$item_url = $row->link;
		}
		if ($first) {
			echo "<a class='buttonbar' href='$item_url'>$row->name</a>";
			$first = FALSE;
		} else {
			echo "&nbsp;|&nbsp;<a class='buttonbar' href='$item_url'>$row->name</a>";
		}
	}
?>
<!-- Load Bottom Menu :: End -->
</td>
<td><a href="#top"><img src="templates/design_01/images/butt_top.gif" width="53" height="16" border="0" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - Top of Page"></a></td>
</tr></table>
</td></tr></table>
</td></tr>
</table>
</td>
<td background="templates/design_01/images/bg_rside.gif" width="2" height="100%"></td>
</tr>
</table>
</td>
</tr><tr>
<td valign="top" height="61">
<table border="0" cellpadding="0" cellspacing="0" height="61">
<tr>
<td><img src="templates/design_01/images/gtx_des_24.jpg" width="170" height="61"></td>
<td><img src="templates/design_01/images/gtx_des_25.jpg" width="17" height="61"></td>
<td><img src="templates/design_01/images/bg_footer.jpg" width="1" height="61"></td>
<td background="templates/design_01/images/bg_footer2.jpg" width="470" height="61" align="center" valign="bottom">
<!-- Display Credit :: Begin -->
Template source from <a href="http://www.supremetemplates.com" target="_blank">Supreme Templates</a>.<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Display Credit :: End -->
</td>
<td background="templates/design_01/images/butt_footerlogo.jpg" width="90" height="61" style="background-repeat: repeat-x;"></td>
<td background="templates/design_01/images/bg_rside.gif" width="2" height="61"></td>
</tr>
</table>
</td></tr></table>

</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>



