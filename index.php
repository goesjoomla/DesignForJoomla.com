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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/hosting_01/css/template_css.css" />
</head>

<body bgcolor="silver" leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
<div align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td bgcolor="#4d4d4d" width="100%" height="81">
<!-- Show Logo, Site's Title & Slogan - Begin -->
<table border="0" cellpadding="0" cellspacing="0"><tr>
	<td width="30%" align="center">
		<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
			<IMG border="0" align="absmiddle" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/hosting_01/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
		</a>
	</td>
	<td width="70%" valign="middle">
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
		<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
		<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
	</td>
</tr></table>
<!-- Show Logo, Site's Title & Slogan - End -->
		</td>
	</tr>
	<tr>
		<td width="750" height="30" align="left" valign="middle" background="templates/hosting_01/images/orange_but_spacer.gif" style="background-repeat: repeat-x;">
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
		<td width="100%" bgcolor="white">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="410" height="242" background="templates/hosting_01/images/server.jpg" border="0" style="background-repeat: no-repeat; padding: 5px;" nowrap>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="190" height="232" nowrap></td>
    <td width="210" height="232" valign="top" nowrap>
<!-- Load User1 Module - Begin -->
<?php if (mosCountModules('user1') > 0) { mosLoadModules ( "user1" ); } else { ?>
	<div align="center">
		<img src="templates/hosting_01/images/demo1.gif" align="absmiddle" border="0" />
	</div>
<?php } ?>
<!-- Load User1 Module - End -->
    </td>
  </tr>
</table>
					</td>
					<td width="340" height="242" style="padding: 5px;" nowrap>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="330" height="232" valign="top" style="border: 1px solid #4d4d4d;" nowrap>
<!-- Load User2 Module - Begin -->
<?php if (mosCountModules('user2') > 0) { mosLoadModules ( "user2" ); } else { ?>
	<div align="center">
		<img src="templates/hosting_01/images/demo2.gif" align="absmiddle" border="0" />
	</div>
<?php } ?>
<!-- Load User2 Module - End -->
    </td>
  </tr>
</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="100%" valign="top" bgcolor="white" style="padding: 3px;">
<!-- Load Top Banner, Top Module, Main Content, Bottom Module & Bottom Banner - Begin -->
<table border="0" cellpadding="0" cellspacing="0"><tr><td width="100%" valign="top">
	<?php
		if (mosCountModules('advert1') > 0) { mosLoadModules ( "advert1" ); echo '<hr/>'; }
		if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; }
		mosMainBody();
		if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); }
		if (mosCountModules('advert2') > 0) { echo '<hr/>'; mosLoadModules ( "advert2" ); }
	?>
</td></tr></table>
<!-- Load Top Banner, Top Module, Main Content, Bottom Module & Bottom Banner - End -->
		</td>
	</tr>
	<tr>
		<td width="750" height="30" align="right" valign="middle" background="templates/hosting_01/images/gray_but_spacer.gif" style="background-repeat: repeat-x;">
<!-- Bottom Menu - Start -->
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
<!-- Bottom Menu - End -->
		</td>
	</tr>
	<tr>
		<td width="100%" align="center" valign="middle" bgcolor="#4d4d4d" height="60">
<!-- Credit Line - Begin -->
Template designed by <a href="http://www.templatehunter.com/" target="_blank">templateHunter.com</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
		</td>
	</tr>
</table>
</div>
</body>
<!--/* Joomla Template by DesignForJoomla.com */ -->
</html>
