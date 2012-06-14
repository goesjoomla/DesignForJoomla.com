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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/fantasy_01/css/template_css.css" />
</head>

<body bgcolor="#000000" text="#000000" background="templates/fantasy_01/images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFF33">
<table width="777" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td width="636" valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="4">
    		<tr>
    			<td width="180" height="79" align="center" valign="middle">
<!-- Show Company Logo - Begin -->
	<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
		<img border="0" src="templates/fantasy_01/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>" />
	</a>
<!-- Show Company Logo - End -->
			    </td>
    			<td width="456" valign="middle">
<!-- Show Site's Title & Slogan - Begin -->
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
	<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
<!-- Show Site's Title & Slogan - End -->
    			</td>
    		</tr>
    		<tr> 
    			<td width="180" valign="top"> 
<!-- Load Left Module - Begin -->
	<?php 
		mosLoadModules("left");
	?>
<!-- Load Left Module - End -->
    			</td>
    			<td width="456" align="justify" valign="top">
<!-- Load User1, User2, Top Module, Main Content & Bottom Module - Begin -->
	<?php if ( (mosCountModules('user1') > 0) OR (mosCountModules('user2') > 0) ) { ?>
		<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
	<?php if ( (mosCountModules('user1') > 0) AND (mosCountModules('user2') > 0) ) { ?>
		<td width='50%' align='center' valign='top'><?php mosLoadModules("user1"); ?></td>
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
<!-- Credit Line - Begin -->
<br/><br/><br/><br/><br/><br/><br/>
<div align="center">
Site template designed by <a href="http://www.petelove.com" target="_blank">PeteLove.com</a>.<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.</div>
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
</div>
<!-- Credit Line - End -->
    </td>
    <td rowspan="2" width="141" align="justify" valign="top">
<!-- Load Right Module - Begin -->
	<?php 
		if (mosCountModules('right') > 0) { mosLoadModules ( "right" ); }
	?>
<!-- Load Right Module - End -->
    </td>
  </tr>
</table>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>


