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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/css/template_css.css" />
</head>

<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
<table width="780" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
		<td valign="top">
<!-- Header - Begin -->
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="220" height="177">
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="220" height="17" BgColor="#d0d0d0" align="center" valign="middle">
<!-- Current Date -->
			<strong><?php echo (date(_DATE_FORMAT)); ?></strong>
		</td>
	</tr>
	<tr>
		<td width="220" height="69">
			<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
			<img border="0" src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>">
			</a>
		</td>
	</tr>
	<tr>
		<td background="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/images/header-left_04.jpg" width="220" height="84" style="background-repeat: no-repeat;"></td>
	</tr>
	<tr>
		<td width="220" height="7" BgColor="#FDBD03"></td>
	</tr>
</table>
		</td>
		<td width="1" height="177" BgColor="#ffffff"></td>
		<td width="559" height="177">
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td background="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/images/header-right_02.gif" width="559" height="73" style="background-repeat: repeat-x;" align="center" valign="middle">
<!-- Top Menu - Start -->
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering");
	$rows = $database->loadObjectList();
	$i = 0;
	foreach($rows as $row) {
		$i += 1;
		if ($i == 1) {
			echo "<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
		} else {
			echo "&nbsp;|&nbsp;<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
		}
	}
?>
<!-- Top Menu - End -->
		</td>
	</tr>
	<tr>
		<td background="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/images/header-right_03.jpg" width="559" height="98" style="background-repeat: no-repeat;"></td>
	</tr>
	<tr>
		<td BgColor="#d0d0d0" width="559" height="6"></td>
	</tr>
</table>
		</td>
	</tr>
</table>
<!-- Header - End -->
		</td>
	</tr>
	<tr>
		<td valign="top">
<!-- Main Content - Begin -->
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="220" valign="top">
<!-- Load Left Module -->
			<?php mosLoadModules("left"); ?>
		</td>
		<td width="1" height="100%" BgColor="#d0d0d0"></td>
		<?php if (mosCountModules('right') > 0) { ?>
			<td width="420" valign="top">
		<?php } else { ?>
			<td width="559" valign="top">
		<?php } ?>
<!-- Load Pathway -->
			<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?><hr/>
<!-- Load Top Module -->
			<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; } ?>
<!-- Load Main Content -->
			<?php mosMainBody(); ?>
<!-- Load Bottom Module -->
			<?php if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); } ?>
		</td>
		<?php if (mosCountModules('right') > 0) { ?>
			<td width="1" height="100%" BgColor="#d0d0d0"></td>
			<td width="138" valign="top">
			<center><img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/images/6.jpg" border="0" /><br/><img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/images/7.jpg" border="0" /><br/></center>
<!-- Load Right Module -->
			<?php mosLoadModules ( "right" ); ?>
			</td>
		<?php } ?>
	</tr>
</table>
<!-- Main Content - End -->
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td width="100%" height="31" align="center" valign="middle" background="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_01/images/header-right_02.gif" style="background-repeat: repeat-x;">
<!-- Footer - Begin -->
Template source from <a title="Lauhost.Com - One stop web resources directory" href="http://www.lauhost.com" target="_blank">Lauhost.Com</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Footer - End -->
		</td>
	</tr>
</table>
</div>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>
