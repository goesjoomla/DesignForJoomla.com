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
	<meta name="Publisher" content="Mambo Tempplate Creation and Conversion from Others team">
	<meta name="Language" content="en">
	<link rel="shortcut icon" href="<?php echo $GLOBALS['mosConfig_live_site'];?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/fantasy_02/css/template_css.css" />
</head>

<BODY text="white" vLink="white" link="#bccbdc" bgColor="black" leftMargin="0" topMargin="0" MarginWidth="0" MarginHeight="0">
<table width="777" border="0" cellspacing="0" cellpadding="0" valign="top">
  <tr>
    <td background="templates/fantasy_02/images/logo.jpg" width="777" height="104">
<!-- Site's Logo and Title - Begin -->
<table BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
	<tr><td align="center" width="25%">
<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
<IMG align="absmiddle" border="0" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/fantasy_02/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
</a>
	</td><td valign="middle" width="75%">
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
		<font face="Arial" size="3" style="line-height: 30px; border: 1px solid #ffffff; padding: 3px; color: #ffffff; background-color: #FE8402;"><?php echo strtoupper($site_title[0]); ?></font>
		<br/><br/>
		<font face="Arial" size="2" style="border: 1px solid #ffffff; padding: 3px; color: #ffffff; background-color: #FE8402;"><?php echo $site_title[1]; ?></font>
	</td></tr>
</table>
<!-- Site's Logo and Title - End -->
    </td>
  </tr>
</table><br/>
<table width="777" border="0" cellspacing="0" cellpadding="0" valign="top">
  <tr>
    <td width="130" valign="top" style="border-right: 1px solid #3399cc;">
<!-- Load Left Module - Begin -->
<?php 
	mosLoadModules("left");
?>
<!-- Load Left Module - End -->
    </td>
    <td width="3">&nbsp;</td>
    <td width="484" valign="top">
<!-- Load Banner - Begin -->
<?php
	if (mosCountModules('banner') > 0) { mosLoadModules( 'banner', -1 ); } else { ?>
		<img src="templates/fantasy_02/images/adbanner.jpg" border="1" borderColor="#3296CA" width="468" height="60">
<?php } ?>
<!-- Load Banner - End -->
      <table width="484" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top" style="padding: 5px;">
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
<?php
	if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="justify" valign="top" style="border: 1px solid #3399cc;">
<?php
	mosMainBody();
?>
		</td>
	</tr>
</table>
<?php
	if (mosCountModules('bottom') > 0) { echo '<br/>'; mosLoadModules ( "bottom" ); }
?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
          </td>
        </tr>
      </table>
    </td>
    <td width="3">&nbsp;</td>
    <td width="157" valign="top" style="border-left: 1px solid #3399cc;">
<!-- Load Right Module - Begin -->
<?php
	if (mosCountModules('right') > 0) { mosLoadModules ( "right" ); }
?>
<!-- Load Right Module - End -->
	</td>
  </tr>
</table>
<br>
<table width="777" border="0" cellspacing="0" cellpadding="0" valign="bottom">
  <tr> 
    <td height="20" valign="center">
<!-- Credit Line - Begin -->
<div align="center">
	<font color="#bccbdc" face="verdana" size="1">
		Template Source from <a href="http://www.gnext.vze.com" target="_blank">GeneatioNext GFXs</a>.
		<br/><a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
	</font>
</div>
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
    </td>
  </tr>
</table>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>