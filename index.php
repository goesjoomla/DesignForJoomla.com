<?php	/* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
echo '<?xml version="1.0" encoding="'. _ISO .'"?' .'>';

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
	<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/templates/travel_01/css/template_css.css" />
</head>

<body leftmargin="0" topmargin="0">

<div align="center">
  <center>
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CCCCCC" width="780" id="AutoNumber1">
    <tr>
      <td width="100%" valign="top">
      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
        <tr>
          <td width="100%">
          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber3">
            <tr>
              <td width="590" background="templates/travel_01/images/header_bg.jpg" align="center" valign="middle" style="background-repeat: repeat-x;">
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
			echo "&nbsp;|&nbsp;<a class='buttonbar' href='$row->link&Itemid=$row->id'>$row->name</a>";
		}
	}
?>
<!-- Top Menu - End -->
              </td>
              <td width="190">
    <table border="0" cellpadding="0" cellspacing="0">
    	<tr>
    		<td height="18" width="100%" background="templates/travel_01/images/search_bg.gif" style="background-repeat: repeat-y;"></td>
    	</tr>
    	<tr>
    		<td height="56" width="100%" align="right">
    			<img border="0" src="templates/travel_01/images/company_logo.gif" width="190" height="56">
    		</td>
    	</tr>
    </table>
              </td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td width="100%">
          <img border="0" src="templates/travel_01/images/page_header.jpg" width="780" height="114"></td>
        </tr>
        <tr>
          <td width="100%">
          <div align="right">
          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="780" id="AutoNumber4">
            <tr>
              <td width="581" valign="top">
              <div align="right">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="98%" id="AutoNumber7">
                  <tr>
                    <td width="100%">
<!-- Load Pathway -->
	<?php include $GLOBALS['mosConfig_absolute_path'] . '/pathway.php'; ?><br><br>
<!-- Load Top Module -->
	<?php if (mosCountModules('top') > 0) { mosLoadModules ( "top" ); echo '<hr/>'; } ?>
<!-- Load Main Content -->
	<?php mosMainBody(); ?>
<!-- Load Bottom Module -->
	<?php if (mosCountModules('bottom') > 0) { echo '<hr/>'; mosLoadModules ( "bottom" ); } ?>
                    </td>
                  </tr>
                </table>
              </div>
              </td>
              <td width="199" valign=top>
              <div align="left">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="190" id="AutoNumber5">
                  <tr>
                    <td width="10%" background="templates/travel_01/images/separator_colume.jpg" style="background-repeat: repeat-y;"></td>
                    <td width="90%">
<!-- Load Left Module -->
	<?php mosLoadModules("left"); ?>
<!-- Load Right Module -->
	<?php if (mosCountModules('right') > 0) { echo '<hr/>'; mosLoadModules ( "right" ); } ?>
                    </td>
                  </tr>
                </table>
              </div>
              </td>
            </tr>
          </table>
          </div>
          </td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber6">
        <tr>
          <td width="100%" background="templates/travel_01/images/header_bg.jpg" style="background-repeat: repeat-x;">
<!-- Footer - Begin -->
<div align="center" style="padding: 3px;"><font face="Verdana" size="1">
Template source from <a title="Lauhost.Com - One stop web resources directory" href="http://www.lauhost.com" target="_blank">Lauhost.Com</a>.<a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
</font></div>
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Footer - End -->
          </td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
  </center>
</div>

</body>
<!-- /* Joomla Template by DesignForJoomla.com */ -->
</html>

