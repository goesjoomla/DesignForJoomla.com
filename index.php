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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/ecommerce_01/css/template_css.css" />
<script language="JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->
</script>
</head>

<body BgColor="#FFFFFF" LeftMargin="0" TopMargin="0" MarginWidth="0" MarginHeight="0">
<table Id="Table_01" Width="800" Height="600" Border="0" CellPadding="0" CellSpacing="0">
	<tr>
		<td>
			<table Id="Table_02" Width="800" Height="105" Border="0" CellPadding="0" CellSpacing="0">
				<tr>
					<td Width="154" NoWrap></td>
					<td Width="77" NoWrap></td>
					<td Width="49" NoWrap></td>
					<td Width="388" NoWrap></td>
					<td Width="132" NoWrap></td>
				</tr>
				<tr>
					<td RowSpan="3">
						<img Src="templates/ecommerce_01/images/index_01.gif" Width="154" Height="105" /></td>
					<td ColSpan="3" BgColor="#ffffff" Width="514" Height="48">
<!-- Show Logo, Site's Title & Slogan - Begin -->
	<table border="0" cellpadding="0" cellspacing="0" Width="100%"><tr>
		<td Width="90">
			<div align="center"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo strtoupper($GLOBALS['mosConfig_sitename']); ?>">
				<IMG border="0" width="36" height="46" align="absmiddle" SRC="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/ecommerce_01/images/logo.gif" alt="<?php echo $GLOBALS['mosConfig_sitename']; ?> - <?php echo $mosConfig_MetaDesc; ?>"/>
			</a></div>
		</td>
		<td Width="424" valign="middle">
			<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
			<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
			<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
		</td>
	</tr></table>
<!-- Show Logo, Site's Title & Slogan - End -->
					</td>
					<td>
						<img Src="templates/ecommerce_01/images/index_03.gif" Width="132" Height="48" /></td>
				</tr>
				<tr>
					<td>
						<img Src="templates/ecommerce_01/images/index_04.gif" Width="77" Height="25" /></td>
					<td>
						<img Src="templates/ecommerce_01/images/index_05.gif" Width="49" Height="25" /></td>
					<td ColSpan="2" BackGround="templates/ecommerce_01/images/index_06.gif" Width="520" Height="25" Style="background-repeat: repeat-x;" align="center" valign="middle">
<!-- Top Menu - Start -->
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering");
	$rows = $database->loadObjectList();
	$i = 0;
	foreach($rows as $row) {
		$i += 1;
		if ($i == 1) {
			echo "<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
		} else {
			echo "&nbsp;&nbsp;|&nbsp;&nbsp;<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
		}
	}
?>
<!-- Top Menu - End -->
					</td>
				</tr>
				<tr>
					<td ColSpan="4" BackGround="templates/ecommerce_01/images/index_07.gif" Width="646" Height="32" Style="background-repeat: repeat-x;" valign="middle">
<!-- Load Pathway - Begin -->
	<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?>
<!-- Load Pathway - End -->
					</td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td>
			<table Id="Table_03" Width="800" Border="0" CellPadding="0" CellSpacing="0">
				<tr>
					<td Width="153" NoWrap></td>
					<td Width="170" NoWrap></td>
					<td Width="46" NoWrap></td>
					<td Width="299" NoWrap></td>
					<td Width="132" NoWrap></td>
				</tr>
				<tr>
					<td ColSpan="2" BackGround="templates/ecommerce_01/images/index_08.gif" Width="323" Height="23" Style="background-repeat: repeat-x;" align="center" valign="middle">
<!-- Show Current Date - Begin -->
	<?php echo (date(_DATE_FORMAT)); ?>
<!-- Show Current Date - End -->
					</td>
					<td valign="top">
						<img Src="templates/ecommerce_01/images/index_09.gif" Width="46" Height="23" /></td>
					<td BgColor="#ffffff" Width="299" Height="23" nowrap>&nbsp;</td>
					<td RowSpan="3" BackGround="templates/ecommerce_01/images/index_11.gif" Width="132" Style="background-repeat: repeat-y; padding: 3px;" align="center" valign="top">
<!-- Load Right Module - Begin -->
	<?php if (mosCountModules('right') > 0) mosLoadModules("right"); ?>
<!-- Load Right Module - End -->
					</td>
				</tr>
				<tr>
					<td BgColor="#AA94FF" Width="153" Style="padding: 3px;" align="center" valign="top">
<!-- Load Left Module - Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module - End -->
					</td>
					<td ColSpan="3" RowSpan="2" BgColor="#ffffff" Width="515" Style="padding: 3px;" align="center" valign="top">
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
<?php
	if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; }
	mosMainBody();
	if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); }
?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
					</td>
				</tr>
				<tr>
					<td BgColor="#AA94FF" valign="bottom">
						<img Src="templates/ecommerce_01/images/index_14.gif" Width="153" Height="26" /></td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td>
<!-- Credit Line - Begin -->
<br/><hr style="width: 70%;"><br/>
<div align="center">
Template source from <a href="http://www.layouts4free.com" target="_blank">Layouts 4 Free</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
		</td>
	</tr>
</table>
</body>
<!--/* Joomla Template by DesignForJoomla.com */ -->
</html>
