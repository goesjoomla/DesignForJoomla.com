<?php	/* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- service_01 - Converted to Mambo template by Your Mambo Design - http://your-mambo-design.com -->
<head>
	<?php if ($my->id) { initEditor(); } ?>
	<?php mosShowHead(); ?>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>">
	<META NAME="revisit-after" CONTENT="1 days">
	<meta name="Copyright" content="(c) Ju+Ju Group">
	<meta name="Publisher" content="Your Mambo Design">
	<meta name="Language" content="en">
	<link rel="shortcut icon" href="<?php echo $GLOBALS['mosConfig_live_site'];?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/service_01/css/template_css.css" />
</head>

<BODY BGCOLOR=#F2F4DF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 rightmargin=0 bottommargin=0>
<TABLE WIDTH=778 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD>
			<IMG SRC="templates/service_01/images/index_01.jpg" ALT="" width="286" height="109"></TD>
		<TD background="templates/service_01/images/index_02.jpg" width="409" height="109" valign="top" style="padding-left: 80px; padding-top: 10px;">
<!-- Show Site's Title - Begin -->
	<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_MetaDesc']; ?>" style="border-bottom: none;"><font face="Arial" size="5" color="#ff6600"><?php echo strtoupper($site_title[0]); ?></font></a><br/>
	<font face="Arial" size="3" color="#ff6600"><?php echo $site_title[1]; ?></font>
<!-- Show Site's Title - End -->
		</TD>
		<TD>
			<IMG SRC="templates/service_01/images/index_03.jpg" ALT="" width="83" height="109"></TD>
	</TR>
	<TR>
		<TD valign="top" bgcolor="#F2F4DF" background="templates/service_01/images/blank_04.jpg" style="background-repeat: no-repeat;">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="100%">
              <tr>
                <td align="center" style="padding-top: 195px; padding-left: 28px; padding-right: 27px;">
<!-- Load Left & Right Module - Begin -->
	<?php mosLoadModules("left"); ?>
	<?php if (mosCountModules('right') > 0) mosLoadModules("right"); ?>
<!-- Load Left & Right Module - End -->
                </td>
              </tr>
            </table>
        </TD>
		<TD WIDTH=409 HEIGHT=411 BGCOLOR=#F2F4DF valign="top">
<!-- Load User1, User2, Top Module, Main Content & Bottom Module - Begin -->
<?php if ( (mosCountModules('user1') > 0) OR (mosCountModules('user2') > 0) ) { ?>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
<?php if ( (mosCountModules('user1') > 0) AND (mosCountModules('user2') > 0) ) { ?>
	<td width='50%' align='center' valign='top'><?php mosLoadModules("user1"); ?></td>
	<td width="3" height="100%" nowrap></td>
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
<!-- Load User1, User2, Top Module, Main Content & Bottom Module - End -->        </TD>
		<TD valign="top" background="templates/service_01/images/cell_back.gif">
			<IMG SRC="templates/service_01/images/index_06.gif" ALT="" width="83" height="411"></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 BGCOLOR=#E5B488>
			&nbsp;</TD>
	</TR>
	<TR>
		<TD COLSPAN=3 BGCOLOR=#BA6F2C>
<!-- Credit Line :: Begin -->
<div align="center" style="padding: 3px;">
Template source from <a href="http://www.aplustemplates.com/" target="_blank">www.aplustemplates.com</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
</div>
<!-- Credit Line - End -->
		</TD>
	</TR>
</TABLE>
</BODY>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</HTML>