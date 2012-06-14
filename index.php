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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/hi-tech_01se/css/template_css.css" />
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

<body BgColor="#FFFFFF" LeftMargin="3" TopMargin="3" MarginWidth="3" MarginHeight="3">
<a name="up" id="up"></a>
<center>
<table Width="800" Border="0" CellPadding="0" CellSpacing="0">
	<tr>
		<td ColSpan="<?php echo (mosCountModules('right') > 0) ? 5 : 3; ?>">
			<table Width="800" Height="110" Border="0" CellPadding="0" CellSpacing="0">
				<tr>
					<td BackGround="templates/hi-tech_01se/images/img_01.gif" Style="background-repeat: no-repeat;" Width="800" Height="21">
<!-- Load Pathway - Begin -->
<div style="padding-left: 10px;">
	<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?>
</div>
<!-- Load Pathway - End -->
					</td>
				</tr>
				<tr>
					<td BackGround="templates/hi-tech_01se/images/img_02.gif" Style="background-repeat: no-repeat;" Width="800" Height="48">
<!-- Show Logo, Site's Title & Slogan - Begin -->
	<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<div align="left" style="padding-left: 10px; letter-spacing: 3px;"><font face="Arial" size="4" color="#ff0000"><strong><?php echo strtoupper($site_title[0]); ?></strong></font></div>
	<div align="right" style="padding-right: 10px;"><font face="Arial" size="3" color="#ffffff"><strong><?php echo $site_title[1]; ?></strong></font></div>
<!-- Show Logo, Site's Title & Slogan - End -->
					</td>
				</tr>
				<tr>
					<td BackGround="templates/hi-tech_01se/images/img_03.gif" Style="background-repeat: no-repeat;" Width="800" Height="21" align="center">
<!-- Top Menu - Start -->
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering");
	$rows = $database->loadObjectList();
	foreach($rows as $row) {
		echo "<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
	}
?>
<!-- Top Menu - End -->
					</td>
				</tr>
				<tr>
					<td BackGround="templates/hi-tech_01se/images/img_04.gif" Style="background-repeat: no-repeat;" Width="800" Height="20" align="right">
<!-- Show Current Date - Begin -->
<div style="padding-right: 10px; font-weight: bold; font-style: italic;">
	<?php echo (date(_DATE_FORMAT)); ?>
</div>
<!-- Show Current Date - End -->
					</td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td ColSpan="<?php echo (mosCountModules('right') > 0) ? 5 : 3; ?>" BackGround="templates/hi-tech_01se/images/img_05.gif" Style="background-repeat: repeat-x;" Width="800" Height="3" nowrap></td>
	</tr>
	<tr>
		<td vAlign="top">
<!-- Load Left Module - Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module - End -->
		</td>
		<td BackGround="templates/hi-tech_01se/images/img_21.gif" Style="background-repeat: repeat-y;" Width="6" Height="100%" nowrap></td>
		<td vAlign="top">
			<table Width="<?php echo (mosCountModules('right') > 0) ? 482 : 641; ?>" Border="0" CellPadding="0" CellSpacing="0">
				<tr>
					<td>
						<img Src="templates/hi-tech_01se/images/<?php echo (mosCountModules('right') > 0) ? 'img_22s.gif' : 'img_22.gif'; ?>" Width="<?php echo (mosCountModules('right') > 0) ? 482 : 641; ?>" Height="21" /></td>
				</tr>
				<tr>
					<td BackGround="templates/hi-tech_01se/images/<?php echo (mosCountModules('right') > 0) ? 'img_23s.gif' : 'img_23.gif'; ?>" Style="background-repeat: repeat-y; padding: 3px;" Width="<?php echo (mosCountModules('right') > 0) ? 482 : 641; ?>">
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
<?php
	if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<br/>'; }
	mosMainBody();
	if (mosCountModules('bottom') > 0) { echo '<br/>'; mosLoadModules ( "bottom" ); }
?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
					</td>
				</tr>
				<tr>
					<td BackGround="templates/hi-tech_01se/images/<?php echo (mosCountModules('right') > 0) ? 'img_24s.gif' : 'img_24.gif'; ?>" Width="<?php echo (mosCountModules('right') > 0) ? 482 : 641; ?>" Height="21">
						<div align="center"><a href='<?php echo sefRelToAbs($_SERVER['REQUEST_URI']); ?>#up'><strong>Top of Page</strong></a></div>
					</td>
				</tr>
			</table>
		</td>
<!-- Load Right Module - Begin -->
<?php
	if (mosCountModules('right') > 0) {
		echo '<td BackGround="templates/hi-tech_01se/images/img_21.gif" Style="background-repeat: repeat-y;" Width="6" Height="100%" nowrap></td>';
		echo '<td vAlign="top">';
		mosLoadModules("right");
		echo '</td>';
	}
?>
<!-- Load Right Module - End -->
	</tr>
	<tr>
		<td ColSpan="<?php echo (mosCountModules('right') > 0) ? 5 : 3; ?>">
<!-- Credit Line - Begin -->
<div align="center" style="padding-top: 15px; padding-bottom: 5px;">
<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>" style="border: none;">
	<img border="0" src="templates/hi-tech_01se/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>" />
</a>
</div>
<div align="center">
Template source from <a href="mailto:tarasbuljba@gmail.com" target="_blank">TARASBULJBA</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
</div>
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
		</td>
	</tr>
</table>
</center>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */	-->
</html>