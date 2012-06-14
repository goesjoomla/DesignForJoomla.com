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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_02/css/template_css.css" />
</head>

<BODY text="#999999" bottomMargin="0" vLink="#ffFFFF" bgColor="#003333" leftMargin="0" topMargin="0" rightMargin="0" MARGINHEIGHT="0" MARGINWIDTH="0" background="templates/business_02/images/page_bg.gif" link="#ffffff">

<TABLE cellSpacing=0 cellPadding=0 border=0 height="120" width="100%">
  <tr>
    <td background="templates/business_02/images/header_img.gif" style="background-repeat: no-repeat;" width="291" height="120" nowrap></td>
    <td width="100%" background="templates/business_02/images/header_bg2.gif" style="background-repeat: repeat-x;">
<!-- Show Logo, Site's Title & Slogan - Begin -->
		<table border="0" cellpadding="0" cellspacing="0"><tr>
			<td width="25%">
				<div align="center"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
					<IMG border="0" width="89" height="89" align="absmiddle" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_02/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
				</a></div>
			</td>
			<td width="75%" valign="middle">
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
				<font face="Arial" size="3" color="#ffffff"><?php echo strtoupper($site_title[0]); ?></font><br/>
				<font face="Arial" size="2" color="#c0c0c0"><?php echo $site_title[1]; ?></font>
			</td>
		</tr></table>
<!-- Show Logo, Site's Title & Slogan - End -->
    </td>
  </tr>
  <tr>
  	<td background="templates/business_02/images/header_img2.gif" style="background-repeat: no-repeat;" width="291" height="54" nowrap></td>
    <td width="100%" background="templates/business_02/images/header_bg.gif" style="background-repeat: repeat-x;" align="right" valign="middle">
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
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0 height="100%" width="100%">
  <TR>
    <TD valign=top> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="20%" valign="top" style="border-right: 1px solid #c0c0c0; border-bottom: 1px solid #c0c0c0;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr><td valign="top" style="padding: 5px;">
<!-- Load Left Module - Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module - End -->
			  </td></tr>
			</table>
          </td>
          <td width="80%" valign="top"> 
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr><td colspan=2 align="center" valign="middle">
<!-- Load Banner Module - Begin -->
	<div style="padding: 5px;">
		<?php if (mosCountModules('banner') > 0) { mosLoadModules( 'banner', -1 ); } ?>
	</div>
<!-- Load Banner Module - End -->
			  </td></tr>
			  <tr><td valign="top" style="padding: 5px;" width="75%">
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
	<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; } ?>
	<?php mosMainBody(); ?>
	<?php if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); } ?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
			  </td>
			  <td valign="top" style="padding: 5px; border-left: 1px solid #c0c0c0; border-top: 1px solid #c0c0c0; border-bottom: 1px solid #c0c0c0;" width="25%">
<!-- Load Right Module - Begin -->
	<?php mosLoadModules ( "right" ); ?>
<!-- Load Right Module - End -->
			  </td></tr>
			</table>
          </td>
        </tr>
        <tr><td colspan=2 align="center" valign="middle">
<!-- Credit Line - Begin -->
<div style="padding: 5px;">
	<br/>Template source from <a href="http://freesitetemplates.com" target="_blank">Free Site Templates</a> by <a href="mailto:jim@jimworld.com" target="_blank">JimWORLD</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<!-- Credit Line - End -->
        </td></tr>
      </table>
    </TD>
  </TR>
</TABLE>

</BODY>

</HTML>

