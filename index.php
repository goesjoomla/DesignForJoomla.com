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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/animal_01/css/template_css.css" />
</head>

<body bgcolor="#000000" topmargin="0" leftmargin="0" MARGINHEIGHT="0" MARGINWIDTH="0">

<table border="0" width="770" cellspacing="0" cellpadding="0">
  <tr>
    <td width="190" height="126" background="templates/animal_01/images/0_lion.gif" style="background-repeat: no-repeat;"></td>
    <td width="580" height="126" background="templates/animal_01/images/header_bg.gif" style="background-repeat: repeat-y;">
<!-- Show Logo, Site's Title & Slogan - Begin -->
		<table border="0" cellpadding="0" cellspacing="0"><tr>
			<td width="170">
				<div align="center"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
					<IMG border="0" width="126" height="126" align="absmiddle" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/animal_01/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
				</a></div>
			</td>
			<td width="410" valign="middle">
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
				<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
				<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
			</td>
		</tr></table>
<!-- Show Logo, Site's Title & Slogan - End -->
    </td>
  </tr>
  <tr>
    <td width="190" valign="top" background="templates/animal_01/images/left_col_bg.gif" style="background-repeat: repeat-x; padding: 5px;">
<!-- Load Left & Right Modules - Begin -->
	<?php
		mosLoadModules ( "left" );
		if (mosCountModules('right') > 0) { echo '<hr/>'; mosLoadModules ( "right" ); }
	?>
<!-- Load Left & Right Modules - End -->
    </td>
    <td width="580" valign="top" style="padding: 5px; border-left: 1px solid #ffffff; border-top: 1px solid #ffffff; border-right: 1px solid #ffffff; border-bottom: 1px solid #ffffff;">
<!-- Load User 1 & User 2 Modules - Begin -->
<?php
	if ( (mosCountModules('user1') > 0) OR (mosCountModules('user2') > 0) ) {
		echo '<table border="0" width="580" cellpadding="0" cellspacing="0"><tr>';
		if ( (mosCountModules('user1') > 0) AND (mosCountModules('user2') > 0) ) {
?>
    		<td valign="top" width="287"><?php mosLoadModules ( "user1" ); ?></td>
    		<td width="5" height="100%" background="templates/animal_01/images/spacer.gif" style="background-repeat: repeat-y;">
    			<img src="templates/animal_01/images/spacer.gif" width="5" height="100%" />
    		</td>
      		<td width="287" valign="top"><?php mosLoadModules ( "user2" ); ?></td>
<?php
		} elseif (mosCountModules('user1') > 0) {
?>
    		<td valign="top" width="100%"><?php mosLoadModules ( "user1" ); ?></td>
<?php
		} elseif (mosCountModules('user2') > 0) {
?>
      		<td width="100%" valign="top"><?php mosLoadModules ( "user2" ); ?></td>
<?php
		}
		echo '</tr></table>';
	}
?>
<!-- Load User 1 & User 2 Modules - End -->
<!-- Load Top Banner, Top Module, Main Content, Bottom Module & Bottom Banner - Begin -->
		<table border="0" width="580" cellpadding="0" cellspacing="0"><tr><td width="100%" valign="top">
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
<!-- Credit Line - Begin -->
  <tr><td colspan="2" align="center" valign="bottom">
<br/>
Template source from <a href="http://freesitetemplates.com" target="_blank">Free Site Templates</a> by <a href="mailto:jim@jimworld.com" target="_blank">JimWORLD</a>.<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
  </td></tr>
<!-- Credit Line - End -->
</table>
</body>
</html><!-- Joomla Template by DesignForJoomla.com -->

