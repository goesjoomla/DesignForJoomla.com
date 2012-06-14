<?php	/* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-------This site template was created by Geesh.com Website Templates. ©2002.  Please leave this header intact.  Want more templates? We are always adding more to our collection.  Visit us at http://www.geesh.com------->
<head>
	<?php if ($my->id) { initEditor(); } ?>
	<?php mosShowHead(); ?>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>">
	<META NAME="revisit-after" CONTENT="1 days">
	<meta name="Copyright" content="(c) Ju+Ju Group">
	<meta name="Publisher" content="Your Mambo Design">
	<meta name="Language" content="en">
	<link rel="shortcut icon" href="<?php echo $GLOBALS['mosConfig_live_site'];?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/car-motor_02/css/template_css.css" />
</head>

<body bgcolor="#860000" text="#000000" link="#666666" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
<CENTER>
<table cellspacing="0" cellpadding="0" border="0" width="700" bgcolor="#C1291E">
	<tr>
		<td width="700">
			<table cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td width="482">
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="97" align="center" valign="middle">
<!-- Show Company Logo - Begin -->
	<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
		<img border="0" src="templates/car-motor_02/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>" />
	</a>
<!-- Show Company Logo - End -->
								</td>
								<td width="385" valign="middle">
<!-- Show Site's Title & Slogan - Begin -->
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
	<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
<!-- Show Site's Title & Slogan - End -->
								</td>
							</tr>
						</table>
					</td>
					<td width="218" height="97" background="templates/car-motor_02/images/1001.gif" style="background-repeat: no-repeat;"></td>
				</tr>
				<tr>
					<td width="482" height="61" valign="top">
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="482" height="31" background="templates/car-motor_02/images/1002a.gif" style="background-repeat: no-repeat;" valign="middle">
<!-- Load Pathway - Begin -->
	&nbsp;<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?>
<!-- Load Pathway - End -->
								</td>
							</tr>
							<tr>
								<td width="482" height="30" background="templates/car-motor_02/images/1002b.gif" style="background-repeat: no-repeat;" valign="middle">
<!-- Show Current Date - Begin -->
	&nbsp;&nbsp;&nbsp;<?php echo (date(_DATE_FORMAT)); ?>
<!-- Show Current Date - End -->
								</td>
							</tr>
						</table>
					</td>
					<td width="218" height="61" background="templates/car-motor_02/images/1003.gif" style="background-repeat: no-repeat;"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="700">
			<table cellspacing="0" cellpadding="0" border="0">
				<tr><td width="181" background="templates/car-motor_02/images/menubg.gif" height="100%" valign="top">
					<table cellspacing="0" cellpadding="0" border="0" width="181">
						<tr><td width="10">
							<img src="templates/car-motor_02/images/spacer.gif" width="10" height="347">
						</td>
						<td width="144" valign="top">
<!-- Load Left & Right Module - Begin -->
	<?php 
		mosLoadModules("left");
		if (mosCountModules('right') > 0) { echo '<hr/>'; mosLoadModules ( "right" ); }
	?>
<!-- Load Left & Right Module - End -->
							<br>
						</td>
						<td width="27">
							<img src="templates/car-motor_02/images/spacer.gif" width="27" height="1">
						</td></tr>
					</table>
				</td>
				<td width="483" valign="top" bgcolor="#FFFFFF">
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
	<?php
		if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; }
		mosMainBody();
		if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); }
	?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
				</td>
				<td width="36" background="templates/car-motor_02/images/3002.gif">
					<img src="templates/car-motor_02/images/spacer.gif" width="36" height="1">
				</td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="700">
			<img src="templates/car-motor_02/images/4000.gif" width="700" height="35">
		</td>
	</tr>
	<tr>
		<td width="700" bgcolor="#FFFFFF" align="center" valign="middle">
			<div style="padding: 7px;">
<!-- Bottom Menu - Start -->
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
<!-- Bottom Menu - End -->
			</div>
		</td>
	</tr>
	<tr>
		<td width="700">
			<center><br>
<!-- Footer - Begin -->
Template source from <a title="Geesh Website Templates" href="http://www.geesh.com" target="_blank">Geesh Website Templates</a>.<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Footer - End -->
			</center>
			<img src="templates/car-motor_02/images/http://www.geesh.com/spacer.gif" width="1" height="1">
		</td>
	</tr>
</table>
</CENTER>
</body>
<!-- c/* Joomla Template by DesignForJoomla.com */ -->
</html>

