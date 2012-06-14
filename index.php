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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_05/css/template_css.css" />
</head>

<body bgcolor="#5f9ea0" topmargin="0" marginheight="0">
	<div align="center">
		<table border="0" cellpadding="0" cellspacing="0" width="758" background="templates/general_05/images/bg.jpg">
			<tr>
				<td>
					<div align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="750">
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="573">
													<tr>
														<td><img src="templates/general_05/images/t1.jpg" width="293" height="153" border="0"></td>
														<td background="templates/general_05/images/t2.jpg" width="280" height="153" align="right" valign="top" style="padding: 5px; padding-top: 65px;">
<!-- Show Site's Title & Slogan - Begin -->
	<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
	<font face="impact" size="5" color="#ABD5D4" style="letter-spacing: 3px;"><?php echo strtoupper($site_title[0]); ?></font><br/>
	<font face="impact" size="3" color="#f0f0f0"><?php echo $site_title[1]; ?></font>
<!-- Show Site's Title & Slogan - End -->
														</td>
													</tr>
													<tr>
														<td colspan="2">
															<div align="center">
																<table border="0" cellpadding="0" cellspacing="0" width="561">
																	<tr>
																		<td>
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
<!-- Load User1, User2, Top Module, Main Content & Bottom Module - End -->
																		</td>
																	</tr>
																</table>
															</div>
														</td>
													</tr>
												</table>
											</td>
											<td width="177" valign="top">
												<div align="center">
													<table border="0" cellpadding="0" cellspacing="0" width="177">
														<tr>
															<td><img src="templates/general_05/images/tr.jpg" width="177" height="65" border="0"></td>
														</tr>
														<tr>
															<td style="padding-left: 17px; padding-right: 3px;">
<!-- Load Left & Right Module - Begin -->
	<?php mosLoadModules("left"); ?>
	<?php if (mosCountModules('right') > 0) mosLoadModules("right"); ?>
<!-- Load Left & Right Module - End -->
															</td>
														</tr>
													</table>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr height="34">
								<td height="34" background="templates/general_05/images/bottom.jpg">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="center">
<!-- Bottom Menu - Begin -->
<?php
	$database->setQuery("SELECT id, name, link FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0, 7");
	$rows = $database->loadObjectList();
	foreach($rows as $row) {
		echo "<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
	}
?>
<!-- Bottom Menu - End -->
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
		<p></p>
	</div>
<!-- Credit Line - Begin -->
<div align="center" class="style1">
	Template source from <a href="http://www.royalty-free.org" target="_blank">ROYALTY-FREE.ORG</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
</div>
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>
