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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_04/css/template_css.css" />
</head>

<body>
<table width="760" height="100%" border="0" cellpadding="0" cellspacing="0" background="templates/general_04/images/bg_main.gif">
  <tr>
    <td background="templates/general_04/images/head.gif" width="760" height="65">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    		<tr><td width="100%" height="10" nowrap></td></tr>
    		<tr><td width="100%" valign="middle">
<!-- Show Logo, Site's Title & Slogan - Begin -->
<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
	<td align="center" width="25%">
		<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
			<IMG border="0" align="absmiddle" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_04/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
		</a>
	</td>
	<td valign="middle" width="75%">
		<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
		<font face="Arial" size="4" color="#ff3300" style="letter-spacing: 3px;"><?php echo strtoupper($site_title[0]); ?></font><br/>
		<font face="Arial" size="3" color="#ff6600"><?php echo $site_title[1]; ?></font>
	</td>
</tr></table>
<!-- Show Logo, Site's Title & Slogan - End -->
    		</td></tr>
    	</table>
    </td>
  </tr>
  <tr>
    <td height="37" background="templates/general_04/images/menu_bg.gif" align="center" valign="middle">
<!-- Top Menu - Begin -->
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
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr valign="top">
        <td width="170"><table width="98%"  border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#AD9C80">
                <tr>
                  <td>
<!-- Load Left & Right Module - Begin -->
	<?php mosLoadModules("left"); ?>
	<?php if (mosCountModules('right') > 0) mosLoadModules("right"); ?>
<!-- Load Left & Right Module - End -->
                  </td>
                </tr>
              </table></td>
            </tr>
        </table></td>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="15">
            <tr>
              <td class="forTexts">
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
<?php if ( (mosCountModules('user1') > 0) OR (mosCountModules('user2') > 0) ) { ?>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
<?php if ( (mosCountModules('user1') > 0) AND (mosCountModules('user2') > 0) ) { ?>
	<td width='50%' align='center' valign='top'><?php mosLoadModules("user1"); ?></td>
	<td width="3" height="100%" bgcolor="#FEF1D7" nowrap></td>
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
<!-- Load Top Module, Main Content & Bottom Module - End -->
              </td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100%" valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    		<tr><td width="100%" height="6" background="templates/general_04/images/down_bg1.gif" nowrap></td></tr>
    		<tr><td width="100%" bgcolor="#21665E" style="padding: 7px;">
<!-- Credit Line - Begin -->
<div align="center" class="style1">
	Template source by <a href="http://www.adesdesign.net" target="_blank" class="style11">AdesDesign.net</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
</div>
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
    		</td></tr>
    		<tr><td width="100%" height="6" background="templates/general_04/images/down_bg2.gif" nowrap></td></tr>
    	</table>
	</td>
  </tr>
</table>
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>
