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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_01/css/template_css.css" />
</head>

<body bgcolor="#c0c0c0" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">

<table border="0" cellspacing="0" cellpadding="0" width="750" bgcolor="#ffffff" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="750" bgcolor="#d8e0e0" valign="bottom">
				<tr>
					<td align="center" height="23" width="606">
<!-- Load Top Menu :: Begin -->
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
			echo "&nbsp;&nbsp;&nbsp;<a class='buttonbar' href='$item_url'>$row->name</a>";
		}
	}
?>
<!-- Load Top Menu :: End -->
					</td>
					<td align="right" height="23" width="144" background="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_01/img/newsflash_header.gif" style="background-repeat: no-repeat;">
<!-- Show Newsflash Title :: Begin -->
	<div style="font: Trebuchet MS, Verdana, sans-serif; font-size: 13px; font-weight: bold; color: #000000; padding-right: 25px;">
		Newsflash
	</div>
<!-- Show Newsflash Title :: End -->
					</td>
				</tr>
			</table>
			
			<table border="0" cellspacing="0" cellpadding="0" width="750" bgcolor="#006060">
				<tr>
					<td align="right" valign="top" height="65" width="605">
						<table align="right" cellspacing="0" cellpadding="0" width="605" bgcolor="#006060" border="0">
							<tr>
								<td width="132" height="65" align="center" valign="middle">
<!-- Load Site's Logo :: Begin -->
<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
<IMG border="0" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_01/img/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
</a>
<!-- Load Site's Logo :: End -->
								</td>
								<td width="473" height="65" align="center" valign="middle">
<!-- Load Top Banner :: Begin -->
	<?php if (mosCountModules('banner') > 0) { mosLoadModules( 'banner', -1 ); } ?>
<!-- Load Top Banner :: End -->
								</td>
							</tr>
						</table>
					</td>
					<td align="right" height="65" width="145" rowspan="2" valign="top">
						<table align="center" cellspacing="0" cellpadding="0" width="143" bgcolor="#006060" border="0">
							<tr>
								<td>
									<table cellpadding="1" cellspacing="2" border="0" width="143">
										<tr>
											<td bgcolor="#008080">
<!-- Load Newsflash :: Begin -->
<marquee scrollamount="2" scrolldelay="50" direction="up" width="98%" height="88" onmouseover="this.stop()" onmouseout="this.start()">
<?php if (mosCountModules('newsflash') > 0) { mosLoadModules ( "newsflash" ); } ?>
</marquee>
<!-- Load Newsflash :: End -->
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="right" height="23">
						<table align="left" cellspacing="0" cellpadding="0" width="605" bgcolor="#006060" border="0">
							<tr>
								<td width="605" height="23" valign="middle" align="left" style="background-color: #ffffff; border-top: 1px solid #FF8000;">
<!-- Pathway :: Begin -->
	&nbsp;<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?>
<!-- Pathway :: End -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			<table border="0" cellspacing="0" cellpadding="0" width="750" bgcolor="#ffffff">
				<tr>
					<td width="542" valign="top">
						<table border="0" cellspacing="0" cellpadding="0" width="542" bgcolor="#008080">
							<tr>
								<td align="center" height="61" width="542" colspan="2">
<!-- Display Page Title :: Begin -->
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<font face="Arial" size="3" color="#ffffff"><?php echo strtoupper($site_title[0]); ?></font><br/>
	<font face="Arial" size="2" color="#c0c0c0"><?php echo $site_title[1]; ?></font>
<!-- Display Page Title :: End -->
								</td>
							</tr>
						</table>
						<table border="0" cellspacing="0" cellpadding="0" width="542" bgcolor="#ffffff">
							<tr>
								<td width="120" bgcolor="#008080" valign="top">
<!-- Load Left Module :: Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module :: End -->
								</td>
								<td width="1" bgcolor="#000000" nowrap></td>
								<td width="420" bgcolor="#ffffff" align="left" valign="top">
									<table width="420" border="0" bgcolor="ffffff" cellspacing="0" cellpadding="0">
										<tr>
											<td>
<!-- Load Top Module :: Begin -->
	<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); ?>
	<br>
	<div align="center">
		<img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_01/img/orange_px.gif" width="390" height="1">
	</div>
	<br>
<?php } ?>
<!-- Load Top Module :: End -->
<!-- Load Main Content :: Begin -->
	<?php mosMainBody(); ?>
<!-- Load Main Content :: End -->
<!-- Load Bottom Module :: Begin -->
	<?php if (mosCountModules('bottom') > 0) { ?>
	<br>
	<div align="center">
		<img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_01/img/orange_px.gif" width="390" height="1">
	</div>
	<br>
<?php mosLoadModules ( "bottom" ); } ?>
<!-- Load Bottom Module :: End -->
											</td>
										</tr>
									</table>
									<div align="center"><img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_01/img/orange_px.gif" width="390" height="1"></div>
								</td>
								<td width="1" bgcolor="#000000" nowrap></td>
							</tr>
						</table>
					</td>
					<td width="208" valign="top" bgcolor="#006060">
						<table border="0" cellspacing="0" cellpadding="0" width="208" bgcolor="#006060">
							<tr>
								<td align="left">
<!-- Load Right Module :: Begin -->
	<?php if (mosCountModules('right') > 0) { mosLoadModules ( "right" ); } ?>
<!-- Load Right Module :: End -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br>
			<div align="center">
				<img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_01/img/aqua_px.gif" width="700" height="1"><br>
<!-- Display Credit :: Begin -->
Template source from <a href="http://www.webhomez.net" target="_blank">www.webhomez.net</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
	</tr>
</table>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>

