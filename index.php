<?php /* Joomla Template by DesignForJoomla.com */

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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_01/css/template_css.css" />
</head>

<BODY BGCOLOR="#FFFFFF" TOPMARGIN="0" LEFTMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
<TR><TD WIDTH="100%" HEIGHT="75" BGCOLOR="#FFFFFF" valign="top">
<!--Start Top-->
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="75">
<TR>
<TD WIDTH="70%" HEIGHT="75">
	<table BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
	<tr><td valign="middle">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
<IMG border="0" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_01/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
</a>
	</td><td valign="middle">
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
		<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
		<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
	</td></tr>
	</table>
</TD>
<TD WIDTH="30%" HEIGHT="75" ALIGN="right"><IMG SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_01/images/tc.gif" WIDTH="250" HEIGHT="75"></TD>
</TR>
</TABLE>
<!--End Top-->
</TD></TR>
<TR><TD WIDTH="100%" HEIGHT="30" BACKGROUND="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_01/images/mbg.gif" ALIGN="center" valign="middle">
<!--Start Top Menu-->
          <?php
            # Vertical Menu V2.0 - by Arthur Konze - www.mamboportal.com
            $database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' ORDER BY ordering");
            $rows = $database->loadObjectList();
            echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
            $num_rows  = count($rows);
            $tab_width = floor(100 / $num_rows);
            foreach($rows as $row) {
              echo "<td width='$tab_width%' align='center'><a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a></td>";
            }
            echo "</tr></table>";
          ?>
<!--End Top Menu-->
</TD></TR>
<TR><TD WIDTH="100%" BGCOLOR="#FFFFFF">
<!--Start Main-->
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
<TR><TD WIDTH="80%" BGCOLOR="#FFFFFF">
<!--Start Content-->
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0">
<TR><TD WIDTH="30%" ALIGN="center" valign="top" style="padding: 3px;">
<!--Start Left-->
<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0"><tr><td align="center">
<IMG SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_01/images/man.gif" WIDTH="153" HEIGHT="331">
</td></tr><tr><td BgColor="#FEC722" align="center">
<?php if (mosCountModules('left') > 0) { mosLoadModules ( "left" ); } ?>
</td></tr></table>
<!--End Left-->
</TD>
<TD WIDTH="70%" valign="top" style="padding: 3px;">
<IMG SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_01/images/welcome.gif"><br/>
<!-- Load Top Banner -->
			<?php if (mosCountModules('advert1') > 0) { mosLoadModules ( "advert1" ); echo '<br/>'; } ?>
<!-- Load Top Module -->
			<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<br/>'; } ?>
<!-- Load Main Content -->
			<?php mosMainBody(); ?>
<!-- Load Bottom Module -->
			<?php if (mosCountModules('bottom') > 0) { echo '<br/>'; mosLoadModules ( "bottom" ); } ?>
<!-- Load Bottom Banner -->
			<?php if (mosCountModules('advert2') > 0) { echo '<br/>'; mosLoadModules ( "advert2" ); } ?>
</TD></TR>
</TABLE>
<!--End Content-->
</TD>
<!--Start Right-->
<TD WIDTH="20%" BgColor="#FEC722" ALIGN="center" valign="top">
<!-- Load Right Module -->
			<?php if (mosCountModules('right') > 0) { mosLoadModules ( "right" ); echo '<br/>'; } ?>
<!-- Load Right Banner -->
			<?php if (mosCountModules('advert3') > 0) { mosLoadModules ( "advert3" ); } ?>
</TD>
<!--End Right-->
</TR>
</TABLE>
<!--End Main-->
</TD></TR>
<TR><TD WIDTH="100%" HEIGHT="30" BGCOLOR="#666666" ALIGN="center" valign="bottom">
<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
</TD>
</TR>
</TABLE>
</BODY>
<!--  Joomla Template by DesignForJoomla.com  -->
</HTML>

