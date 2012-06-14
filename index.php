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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_03/css/template_css.css" />
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" class="tbl1" width="100%">
  <tr valign="middle"> 
    <td width="100%" height="30" nowrap>
<!-- Load Pathway - Begin -->
	&nbsp;
	<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?>
<!-- Load Pathway - End -->
    </td>
  </tr>
  <tr valign="middle"> 
    <td width="100%" height="170" nowrap>
<!-- Show Logo, Site's Title & Slogan - Begin -->
	<table border="0" cellpadding="0" cellspacing="0" Width="100%"><tr>
		<td align="center" width="140">
			<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
				<IMG border="0" width="119" height="150" align="absmiddle" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_03/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
			</a>
		</td>
		<td valign="middle">
			<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
			<font face="Arial" size="5" color="#ff6600"><?php echo strtoupper($site_title[0]); ?></font><br/>
			<font face="Arial" size="4" color="#00ffff"><?php echo $site_title[1]; ?></font>
		</td>
	</tr></table>
<!-- Show Logo, Site's Title & Slogan - End -->
    </td>
  </tr>
  <tr> 
    <td width="100%" height="1" nowrap>
    	<img src="templates/general_03/images/single_pixel.gif" width="1" height="1">
    </td>
  </tr>
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="5" cellpadding="3">
       <tr>
        <td width="140" align="center" valign="top" nowrap>
<!-- Load Left Module - Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module - End -->
		</td>
    	<td width="7" height="100%" valign="bottom" nowrap>
        	<img src="templates/general_03/images/separator1.gif" width="7" height="100%">
    	</td>
        <td width="100%" align="center" valign="top"> 
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
<?php
	if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; }
	mosMainBody();
	if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); }
?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
		</td>
    	<td width="7" height="100%" valign="bottom" nowrap>
        	<img src="templates/general_03/images/separator2.gif" width="7" height="100%">
    	</td>
        <td width="150" align="center" valign="top" nowrap>
<!-- Load Right Module - Begin -->
	<?php if (mosCountModules('right') > 0) mosLoadModules("right"); ?>
<!-- Load Right Module - End -->
		</td>
       </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td width="100%" align="center" valign="bottom" nowrap>
    	<br/><br/><br/>
<!-- Display Credit :: Begin -->
Template source from <a href="http://www.logodesignweb.com/" target="_blank">Logo Design Web</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
    </td>
  </tr>
</table>
</body> 
</html> 
