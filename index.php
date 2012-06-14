<?php	/* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

// Custom Settings - Begin
$custom_settings['demo'] = 1;
$custom_settings['logo'] = "templates/business_06/images/logo.jpg"; // URL or absolute path to your company`s logo (39x54 pixel)
$custom_settings['title'] = 'Your Mambo Design';
$custom_settings['slogan'] = 'Make your Mambo website your speciality';
$custom_settings['navigation'] = 'Website Navigation';
$custom_settings['support'] = 'Live Support';
$custom_settings['support_url'] = 'http://url/to/your/live/support/system';
// Custom Settings - End

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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/business_06/css/template_css.css" />
</head>

<body bgcolor="#000000">

<table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1">
  <tr> 
    <td align="center" valign="middle"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr> 
          <td><table width="780" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="447" height="113" rowspan="3" background="templates/business_06/images/header.jpg" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
	<tr height="11">
		<td colspan="2" height="11" nowrap></td>
		<td rowspan="2" valign="top">
    			  <div style="padding-top: 10px; padding-left: 7px;">
                    <span class="logo"><?php echo $custom_settings['title']; ?></span><br>
                    <span class="tagline"><?php echo $custom_settings['slogan']; ?></span>
                  </div>
		</td>
	</tr>
	<tr>
		<td width="11" nowrap></td>
		<td>
			<img src="<?php echo $custom_settings['logo']; ?>" width="39" height="54" alt="<?php echo $custom_settings['title']; ?>" />
		</td>
	</tr>
</table>
                </td>
                <td width="333" height="30" background="templates/business_06/images/tnav.jpg"><table border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="111" nowrap>&nbsp;</td>
                      <td align="center" width="62" style="padding-left: 9px; padding-top: 7px;">
<?php
	$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,1");
	$database->loadObject( $row1 );
	if (isset($row1)) {
		if ( $row1->type == 'url' ) {
			echo '<a class="tnav" href="'.$row1->link.'">Home</a>';
		} else {
			echo '<a class="tnav" href="'.$row1->link.'&Itemid='.$row1->id.'">Home</a>';
		}
	}
?>
                      </td>
                      <td align="center" width="87" style="padding-left: 11px; padding-top: 7px;">
<?php
	$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
	$database->loadObject( $row2 );
	if (isset($row2)) {
		if ( $row2->type == 'url' ) {
			echo '<a class="tnav" href="'.$row2->link.'">Contacts</a>';
		} else {
			echo '<a class="tnav" href="'.$row2->link.'&Itemid='.$row2->id.'">Contacts</a>';
		}
	}
?>
                      </td>
                      <td align="center" width="73" style="padding-left: 11px; padding-top: 7px;">
<?php
	$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_search%' ORDER BY ordering LIMIT 0,1");
	$database->loadObject( $row3 );
	if (isset($row3)) {
		if ( $row3->type == 'url' ) {
			echo '<a class="tnav" href="'.$row3->link.'">Search</a>';
		} else {
			echo '<a class="tnav" href="'.$row3->link.'&Itemid='.$row3->id.'">Search</a>';
		}
	}
?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td width="333" height="83"><img name="n3" src="templates/business_06/images/3.jpg" width="333" height="83" border="0" alt=""></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td> <table width="780" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="172" height="211" valign="top"> <table width="172" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="172" height="211" background="templates/business_06/images/lnav.jpg"><table width="150" height="210" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="hdr-nav"><?php echo $custom_settings['navigation']; ?></td>
                          </tr>
                          <tr> 
<!-- Top Menu - Begin -->
<?php
	$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering");
	$rows = $database->loadObjectList();
	$i = 0;
?>
                            <td width="36" height="30">
<?php if (isset($rows[$i])) {
	if ( $rows[$i]->type == 'url' ) {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'">'.$rows[$i]->name.'</a>';
	} else {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'&Itemid='.$rows[$i]->id.'">'.$rows[$i]->name.'</a>';
	}
} $i += 1; ?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="30">
<?php if (isset($rows[$i])) {
	if ( $rows[$i]->type == 'url' ) {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'">'.$rows[$i]->name.'</a>';
	} else {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'&Itemid='.$rows[$i]->id.'">'.$rows[$i]->name.'</a>';
	}
} $i += 1; ?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="29">
<?php if (isset($rows[$i])) {
	if ( $rows[$i]->type == 'url' ) {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'">'.$rows[$i]->name.'</a>';
	} else {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'&Itemid='.$rows[$i]->id.'">'.$rows[$i]->name.'</a>';
	}
} $i += 1; ?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="32">
<?php if (isset($rows[$i])) {
	if ( $rows[$i]->type == 'url' ) {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'">'.$rows[$i]->name.'</a>';
	} else {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'&Itemid='.$rows[$i]->id.'">'.$rows[$i]->name.'</a>';
	}
} $i += 1; ?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="29">
<?php if (isset($rows[$i])) {
	if ( $rows[$i]->type == 'url' ) {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'">'.$rows[$i]->name.'</a>';
	} else {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'&Itemid='.$rows[$i]->id.'">'.$rows[$i]->name.'</a>';
	}
} $i += 1; ?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="27">
<?php if (isset($rows[$i])) {
	if ( $rows[$i]->type == 'url' ) {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'">'.$rows[$i]->name.'</a>';
	} else {
		echo '<a class="buttonbar" href="'.$rows[$i]->link.'&Itemid='.$rows[$i]->id.'">'.$rows[$i]->name.'</a>';
	}
} $i += 1; ?>
                            </td>
                          </tr>
<!-- Top Menu - End -->
                        </table></td>
                    </tr>
                  </table></td>
                <td width="608" height="211" valign="top"> <table width="608" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="608"><img name="n4" src="templates/business_06/images/4.jpg" width="275" height="96" border="0" alt=""><img name="n5" src="templates/business_06/images/5.jpg" width="333" height="96" border="0" alt=""></td>
                    </tr>
                    <tr> 
                      <td><table border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="205" height="115" align="left" valign="top" background="templates/business_06/images/box-mini1.jpg"> 
<!-- Login Form - Begin -->
<?php if (!$my->id) { ?>
<table width="205" border="0" cellpadding="0" cellspacing="0" style="padding-top: 13px; padding-left: 37px;">
<form action="index.php" method="post" name="login">
<tr>
	<td><input name="username" type="text" class="inputbox" alt="Username" value="Username" size="19" /></td>
</tr>
<tr>
	<td style="padding-top: 3px;"><input type="password" name="passwd" class="inputbox" alt="Password" value="Password" size="13" />
		&nbsp;&nbsp;<input type="Image" src="templates/business_06/images/btn.jpg" alt="Login" border="0" align="absmiddle" />
		<input type="hidden" name="option" value="login" />
	</td>
</tr>
</form>
<?php } else { ?>
<table width="205" border="0" cellpadding="0" cellspacing="0" style="padding-top: 15px; padding-left: 30px; padding-right: 21px;">
<form action="index.php?option=logout" method="post" name="logout">
<tr>
	<td align="left" width="100%">
		<font size="3">Hello, </font><a href="index.php?option=com_user&amp;task=UserDetails" title="View Your Profile"><font size="3"><?php echo $my->username; ?></font></a><font size="3">.</font>
	</td>
</tr>
<tr>
	<td align="right" width="100%">
		<a href="javascript: document.logout.submit();" title="Click to Logout"><font size="3">[ Logout ]</font></a>
	</td>
</tr>
</form>
<?php } ?>
</table>
<!-- Login Form - End -->
                            </td>
                            <td width="199" height="115" align="left" valign="top" background="templates/business_06/images/box-mini2.jpg"> 
<!-- Search Form - Begin -->
<table width="199" border="0" cellpadding="0" cellspacing="0" style="padding-top: 23px; padding-left: 25px;">
<form action="index.php" method="post" name="search">
<tr>
	<td><input type="text" name="searchword" size="15" value="Search..." onblur="if(this.value=='') this.value='Search...';" onfocus="if(this.value=='Search...') this.value='';" class="inputbox" />
		&nbsp;&nbsp;<input type="Image" src="templates/business_06/images/btn.jpg" alt="Search" border="0" align="absmiddle" />
	<input type="hidden" name="option" value="search" /></td>
</tr>
</form>
</table>
<!-- Search Form - End -->
                            </td>
                            <td width="204" height="115" background="templates/business_06/images/box-mini3.jpg"> 
                              <table border="0" cellpadding="0" cellspacing="0">
                                <tr align="right"> 
                                  <td height="30" colspan="2" class="hdr-sub">
                                  <?php echo strtoupper($custom_settings['support']); ?>&nbsp;&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td width="80" nowrap>&nbsp;</td>
                                  <td width="109" align="right"><a href="<?php echo $custom_settings['support_url']; ?>"><img name="btnr" src="templates/business_06/images/btn-clickhere.jpg" width="76" height="22" border="0" alt=""></a></td>
                                </tr>
                              </table>
                              <p>&nbsp;</p></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td> <table width="780" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="248" align="center" valign="top">
<!-- Load Left, Right Module - Begin -->
	<?php if (mosCountModules('left') > 0) mosLoadModules("left"); ?>
	<?php if (mosCountModules('right') > 0) mosLoadModules("right"); ?>
<!-- Load Left, Right Module - End -->
                </td>
                <td width="532" valign="top"> <table width="510" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="431"> <table width="431" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="431" height="139" background="templates/business_06/images/box-main.jpg" style="background-repeat: no-repeat;"><table width="430" border="0" cellspacing="3" cellpadding="3">
                                <tr> 
                                  <td>&nbsp;</td>
                                  <td width="200">
<!-- Load Newsflash Module - Begin -->
<?php if (mosCountModules('newsflash') > 0) mosLoadModules("newsflash"); elseif ($custom_settings['demo']) { ?>
	<table class="moduletable_newsflash"  border="0" cellspacing="0" cellpadding="0">
		<tr><th>Module Position: Newsflash</th></tr>
		<tr><td>Please use <b>_newsflash</b> Module Class Suffix for all module configured to show in this position.</td></tr>
	</table>
<?php } ?>
<!-- Load Newsflash Module - End -->
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td width="431">
<!-- Load Top Module - Begin -->
<?php if (mosCountModules('top') > 0) mosLoadModules("top"); elseif ($custom_settings['demo']) { ?>
	<table class="moduletable_top"  border="0" cellspacing="0" cellpadding="0">
		<tr><th>Module Position: Top</th></tr>
		<tr><td>Please use <b>_top</b> Module Class Suffix for all module configured to show in this position.</td></tr>
	</table>
<?php } ?>
<!-- Load Top Module - End -->
                            </td>
                          </tr>
                          <tr> 
                            <td width="431">
								<?php mosMainBody(); ?>
                            </td>
                          </tr>
                          <tr> 
                            <td width="431">
<!-- Load Top Module - Begin -->
<?php if (mosCountModules('bottom') > 0) mosLoadModules("bottom"); elseif ($custom_settings['demo']) { ?>
	<table class="moduletable_top"  border="0" cellspacing="0" cellpadding="0">
		<tr><th>Module Position: Bottom</th></tr>
		<tr><td>Please use <b>_top</b> Module Class Suffix for all module configured to show in this position.</td></tr>
	</table>
<?php } ?>
<!-- Load Top Module - End -->
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td valign="bottom">
<table width="780" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="templates/business_06/images/92067601_02.gif" width="780" height="36" alt="" /></td>
	</tr>
	<tr>
		<td background="templates/business_06/images/92067601_03.gif" width="780" height="45" align="center" valign="middle">
			<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
		</td>
	</tr>
	<tr>
		<td background="templates/business_06/images/92067601_04.gif" width="780" height="31" align="center" valign="middle">
<!-- Credit Line - Begin -->
Template source from <a href="http://www.TemplatesResource.com" target="_blank">Templates Resource</a>.<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<!-- Credit Line - End -->
		</td>
	</tr>
</table>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
