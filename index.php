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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/nature_01/css/template_css.css" />
</head>

<body BgColor="#FFFFFF" LeftMargin="0" TopMargin="0" MarginWidth="0" MarginHeight="0">

<table Id="Table_01" Width="780" Height="560" Border="0" CellPadding="0" CellSpacing="0" BackGround="templates/nature_01/images/10026901_21.gif" Style="background-position: right; background-repeat: repeat-y;">
	<tr>
		<td ColSpan="<?php echo (mosCountModules('right') > 0) ? '7' : '5'; ?>">
			<table Id="Table_06" Width="780" Height="211" Border="0" CellPadding="0" CellSpacing="0">
				<tr>
					<td Width="170" NoWrap></td>
					<td Width="28" NoWrap></td>
					<td Width="191" NoWrap></td>
					<td Width="391" NoWrap></td>
				</tr>
				<tr>
					<td ColSpan="3" RowSpan="2" Align="right" BackGround="templates/nature_01/images/10026901_01.gif" Width="389" Height="73" nowrap>
<!-- Show Site's Title - Begin -->
	<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<font face="impact" size="5" color="#ABD5D4" style="letter-spacing: 3px; padding-right: 27px;"><?php echo strtoupper($site_title[0]); ?></font><br/>
<!-- Show Site's Title - End -->
					</td>
					<td Align="center" BackGround="templates/nature_01/images/10026901_02.gif" Style="background-repeat: repeat-x;" Width="391" Height="32" nowrap>
<!-- Show Site's Slogan - Begin -->
	<font face="impact" size="3" color="#ABD5D4"><?php echo $site_title[1]; ?></font>
<!-- Show Site's Slogan - End -->
					</td>
				</tr>
				<tr>
					<td Align="center" vAlign="middle" BackGround="templates/nature_01/images/10026901_03.gif" Width="391" Height="41" nowrap>
<!-- Top Menu - Begin -->
	<?php
		$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,5");
		$rows = $database->loadObjectList();
		foreach($rows as $row) {
			if ( $row->type == 'url' ) {
				echo "<a class='buttonbar' href='$row->link'>$row->name</a>";
			} else {
				echo "<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
			}
		}
	?>
<!-- Top Menu - End -->
					</td>
				</tr>
				<tr>
					<td vAlign="top" BackGround="templates/nature_01/images/10026901_04.gif" Width="170" Height="34" nowrap>
<!-- Show Current Date - Begin -->
	<div style="padding-left: 7px; padding-top: 7px; font-weight: bold; font-style: italic;">
		<?php echo (date(_DATE_FORMAT)); ?>
	</div>
<!-- Show Current Date - End -->	</td>
					</td>
					<td>
						<img Src="templates/nature_01/images/10026901_05.gif" Width="28" Height="34" /></td>
					<td align="right" vAlign="top" style="padding-top: 10px; padding-right: 10px;" ColSpan="2" BackGround="templates/nature_01/images/10026901_06.gif" Width="582" Height="34" nowrap>
<!-- Load Pathway - Begin -->
	<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?>
<!-- Load Pathway - End -->
					</td>
				</tr>
				<tr>
					<td ColSpan="4">
						<img Src="templates/nature_01/images/10026901_07.gif" Width="780" Height="101" /></td>
				</tr>
				<tr>
					<td ColSpan="4">
						<img Src="templates/nature_01/images/10026901_08.gif" Width="780" Height="3" /></td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td Width="1" Height="100%" nowrap></td>
		<td Width="145" Align="center" vAlign="top">
<!-- Load Left Modules - Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Modules - End -->
		</td>
		<td Width="2" Height="100%" background="templates/nature_01/images/spacer.gif" style="background-position: right; background-repeat: repeat-y;" nowrap></td>
		<td vAlign="top"><div style="padding: 1px;">
<!-- Load Top Modules, Main Content & Bottom Modules - Begin -->
	<?php
		if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; }
		mosMainBody();
		if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); }
	?>
<!-- Load Top Modules, Main Content & Bottom Modules - End -->
		</div></td>
<!-- Load Right Modules - Begin -->
	<?php if (mosCountModules('right') > 0) { ?>
		<td Width="2" Height="100%" background="templates/nature_01/images/spacer.gif" style="background-position: left; background-repeat: repeat-y;" nowrap></td>
		<td Width="154" Align="center" vAlign="top">
	 		<?php mosLoadModules("right"); ?>
		</td>
	<?php } ?>
<!-- Load Right Modules - End -->
		<td Width="4" Height="100%" nowrap></td>
	</tr>
	<tr>
		<td ColSpan="<?php echo (mosCountModules('right') > 0) ? '7' : '5'; ?>">
			<table Id="Table_02" Width="780" Height="48" Border="0" CellPadding="0" CellSpacing="0">
				<tr>
					<td>
						<img Src="templates/nature_01/images/10026901_22.gif" Width="389" Height="16" /></td>
					<td RowSpan="2" Align="right" vAlign="bottom" BackGround="templates/nature_01/images/10026901_23.gif" Style="padding-right: 7px; padding-bottom: 7px;" Width="391" Height="45" nowrap>
<!-- Credit Line - Begin -->
	Template source from <a href="http://www.TemplatesResource.com" target="_blank">TemplatesResource</a>.<br/>Customized & converted to Mambo template by <a href="http://your-mambo-design.my-juju.com" title="Your Mambo Design - Offer free Mambo template, low cost Mambo template conversion from others service & professional web design.">Your Mambo Design</a>.
<!-- Credit Line - End -->
					</td>
				</tr>
				<tr>
					<td vAlign="middle" BackGround="templates/nature_01/images/10026901_24.gif" Width="389" Height="29" nowrap>
<!-- Bottom Menu - Begin -->
	<?php
		$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 5,5");
		$rows = $database->loadObjectList();
		foreach($rows as $row) {
			if ( $row->type == 'url' ) {
				echo "<a class='bottom_menu' href='$row->link'>$row->name</a>";
			} else {
				echo "<a class='bottom_menu' href='$row->link&Itemid=$row->id'>$row->name</a>";
			}
		}
	?>
<!-- Bottom Menu - End -->
					</td>
				</tr>
				<tr>
					<td ColSpan="2">
						<img Src="templates/nature_01/images/10026901_25.gif" Width="780" Height="3" /></td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td ColSpan="<?php echo (mosCountModules('right') > 0) ? '7' : '5'; ?>" BackGround="templates/nature_01/images/10026901_02.gif" Style="padding-top: 7px;">
<!-- Include Footer - Begin -->
	<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Include Footer - End -->
		</td>
	</tr>
</table>

</body>
<!-- nature_01 - Converted to Joomla template by DesignfForJoomla.com - http://designforjoomla.com -->
</html>