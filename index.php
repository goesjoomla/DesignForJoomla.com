<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- business_04 - Converted to Mambo template by Your Mambo Design - http://your-mambo-design.com -->
<head>
	<?php if ($my->id) { initEditor(); } ?>
	<?php mosShowHead(); ?>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>">
	<META NAME="revisit-after" CONTENT="1 days">
	<meta name="Copyright" content="(c) Ju+Ju Group">
	<meta name="Publisher" content="Your Mambo Design">
	<meta name="Language" content="en">
	<link rel="shortcut icon" href="<?php echo $GLOBALS['mosConfig_live_site'];?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_04/css/template_css.css" />
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

<body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#ffffff">
<center>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
	<td width="50%" background="templates/business_04/images/bg.gif"><img src="templates/business_04/images/px1.gif" width="1" height="1" alt="" border="0"></td>
	<td valign="bottom" background="templates/business_04/images/bg_left.gif"><img src="templates/business_04/images/bg_left.gif" alt="" width="17" height="16" border="0"></td>
	<td>
<table border="0" cellpadding="0" cellspacing="0" width="780">
<tr>
	      <td rowspan="2" width="100%" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="templates/business_04/images/main_logo.jpg" width="377" height="61"></td>
              </tr>
              <tr>
                <td><img src="templates/business_04/images/main01.jpg" width="377" height="203"></td>
              </tr>
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" background="templates/business_04/images/fon04.gif">
                    <tr> 
                      <td width="35"><img src="templates/business_04/images/fon04.gif" width="35" height="61"></td>
                      <td width="116" background="templates/business_04/images/but01.gif">
                        <table width="116" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="45"></td>
                            <td class="menu01"><a href="index.php">HOME</a></td>
                          </tr>
                        </table>
                      </td>
                      <td width="113" background="templates/business_04/images/but02.gif">
                        <table width="113" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="45"></td>
                            <td class="menu01"><a href="index.php?option=com_sitemap"><font color="#000000">SITE 
                              MAP </font></a></td>
                          </tr>
                        </table>
                      </td>
                      <td background="templates/business_04/images/but03.gif" width="113">
                        <table width="113" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="45"></td>
                            <td class="menu01"><a href="index.php?option=com_search"><font color="#000000">SEARCH</font></a></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
	<td valign="top" bgcolor="#0A64AA" background="templates/business_04/images/fon_menu02.gif" style="background-repeat: repeat-y;">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
<!-- Top Menu - Begin -->
<?php
	$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering");
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
</table>
	</td>
	<td><img src="templates/business_04/images/top01.jpg" width="247" height="264" alt="" border="0"></td>
</tr>
<tr>
	<td><img src="templates/business_04/images/top03.jpg" width="156" height="61" alt="" border="0"></td>
	<td background="templates/business_04/images/top02.jpg" width="247" height="61" nowrap>
<!-- Show Current Date - Begin -->
<div align="right" style="padding-right: 5px; font-weight: bold; font-style: italic;">
	<?php echo (date(_DATE_FORMAT)); ?>
</div>
<!-- Show Current Date - End -->	</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="780">
<tr>
	<td colspan="4" height="19" background="templates/business_04/images/fon01.gif"><img src="templates/business_04/images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
<tr>
	<td background="templates/business_04/images/fon02.gif" height="87" align="center" width="377">
<table border="0" cellpadding="0" cellspacing="0" background="">
<!-- Login Form - Begin -->
<?php if (!$my->id) { ?>
<form action="index.php" method="post" name="login">
<tr>
	<td rowspan="2" width="130"><p><img src="templates/business_04/images/e06.gif" width="16" height="9" alt="" border="0">&nbsp;&nbsp;<b>Members Login</b></p></td>
	<td><input name="username" type="text" class="inputbox" alt="username" value="Username" size="15" /></td>
</tr>
<tr>
	<td><input type="password" name="passwd" class="inputbox" alt="password" value="Password" size="10" />
		<input type="hidden" name="option" value="login" />
		<input type="Image" src="templates/business_04/images/b_go.gif" width="19" height="25" alt="Login" border="0" hspace="10" align="absbottom" />
	</td>
</tr>
</form>
<?php } else { ?>
<tr>
	<td align="center" valign="middle">
		<font size="3">Hello, </font><a href="index.php?option=com_user&amp;task=UserDetails" title="View Your Profile"><font size="3"><?php echo $my->username; ?></font></a><font size="3">. Have a good day!</font><br/><br/>
		<form action="index.php?option=logout" method="post" name="logout">
			<input type="hidden" name="op2" value="logout" />
			<input type="hidden" name="lang" value="english" />
			<input type="hidden" name="return" value="/my-mambo/index.php" />
			<input type="hidden" name="message" value="0" />
			<input type="submit" name="Submit" class="button" value="Logout" />
		</form>
	</td>
</tr>
<?php } ?>
<!-- Login Form - End -->
</table>
	</td>
	<td background="templates/business_04/images/fon02.gif" height="87"><img src="templates/business_04/images/e01.gif" width="2" height="87" alt="" border="0"></td>
	<td background="templates/business_04/images/fon02.gif" height="87" align="center" width="380">
<table border="0" cellpadding="0" cellspacing="0" background="">
<form action="" method="post">
<tr>
<td width="100"><p><img src="templates/business_04/images/e06.gif" width="16" height="9" alt="" border="0">&nbsp;&nbsp;<b>Search</b></p></td>
<td><input type="Text" name="" value="" size="12"></td>
<td><input type="Image" src="templates/business_04/images/b_go.gif" width="19" height="25" alt="" border="0" hspace="10" align="absbottom"></td></tr></form>
</table></td><td background="templates/business_04/images/fon02.gif" height="87" align="right"><img src="templates/business_04/images/e02.gif" width="21" height="87" alt="" border="0"></td>
</tr>
<tr>
	<td colspan="4" height="21" background="templates/business_04/images/fon03.gif"><img src="templates/business_04/images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="780">
<tr bgcolor="#AFC0D0" valign="top">
	<td width="362">
<!-- Load Top Module, Main Content & Bottom Module - Begin -->
	<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; } ?>
	<?php mosMainBody(); ?>
	<?php if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); } ?>
<!-- Load Top Module, Main Content & Bottom Module - End -->
	</td>
	<td><img src="templates/business_04/images/e03.gif" width="15" height="298" alt="" border="0"></td>
	<td bgcolor="#D1D6DB" background="templates/business_04/images/fon01.jpg" width="250" style="background-position: top; background-repeat: repeat-x;">
<!-- Load Left & Right Module - Begin -->
	<?php mosLoadModules("left"); ?>
	<?php if (mosCountModules('right') > 0) { mosLoadModules ( "right" ); } ?>
<!-- Load Left & Right Module - End -->
	</td>
	<td><img src="templates/business_04/images/e04.gif" width="14" height="298" alt="" border="0"></td>
	<td width="139" align="center" nowrap>
<!-- Load Advertisement Modules - Begin -->
<?php if ( (mosCountModules('advert1') > 0) OR (mosCountModules('advert2') > 0) OR (mosCountModules('advert3') > 0) ) {
	if (mosCountModules('advert1') > 0) { mosLoadModules ( "advert1" ); }
	if (mosCountModules('advert2') > 0) { mosLoadModules ( "advert2" ); }
	if (mosCountModules('advert3') > 0) { mosLoadModules ( "advert3" ); }
} else {
	echo '<div style="padding: 5px;"><div align="center" style="border: 1px solid; font-size: 20px;">Put<br/><br/>ad<br/><br/>banners<br/><br/>here<br/><br/>...<br/><br/>Available<br/><br/>module<br/><br/>positions<br/><br/>are:<br/><br/>advert1,<br/><br/>advert2<br/><br/>and<br/><br/>advert3.</div></div>';
} ?>
<!-- Load Advertisement Modules - End -->
	</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="780">
<tr>
	<td><img src="templates/business_04/images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
<tr bgcolor="#EE7B10">
	<td height="19"><img src="templates/business_04/images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
<tr>
	<td height="70" align="center">
<!-- Credit Line - Begin -->
Template source from <a href="http://www.proeffect.com/" target="_blank">Proeffect.com</a>. Converted to Mambo template by <a href="http://your-mambo-design.com" title="Your Mambo Design - Offer free Mambo template, low cost Mambo template conversion from others & professional web design.">Your Mambo Design</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Credit Line - End -->
	</td>
</tr>
</table>
	</td>
	<td valign="bottom" background="templates/business_04/images/bg_right.gif"><img src="templates/business_04/images/bg_right.gif" alt="" width="17" height="16" border="0"></td>
	<td width="50%" background="templates/business_04/images/bg.gif"><img src="templates/business_04/images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
</table>
</center>
</body>
</html>


