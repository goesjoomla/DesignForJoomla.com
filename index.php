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
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/templates/general_02/css/template_css.css" />
</head>

  <BODY bgcolor="#F5F5F5" topmargin="1" leftmargin="1" marginwidth="1" marginheight="1">
    <TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
      <TR>
        <TD colspan="2" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" width="1" height="4"></TD>
      </TR>
      <TR>
        <TD width="25%" bgcolor="#ffffff" align="center" valign="middle"><IMG src="templates/general_02/images/logo.gif" align="absmiddle"></TD>
        <TD width="75%" bgcolor="#ffffff" valign="middle" style="background-image: url(templates/general_02/images/head.jpg); background-repeat: no-repeat; background-position: right;">
<!-- Show Site's Title & Slogan - Begin -->
<?php $site_title = explode(' - ', $GLOBALS['mosConfig_sitename']); ?>
<font face="Arial" size="3" color="#ff0000"><?php echo strtoupper($site_title[0]); ?></font><br/>
<font face="Arial" size="2" color="#ff6600"><?php echo $site_title[1]; ?></font>
<!-- Show Site's Title & Slogan - End -->
        </TD>
      </TR>
      <TR>
        <TD colspan="2" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" width="1" height="4"></TD>
      </TR>
      <TR>
        <TD colspan="2" height="10" bgcolor="#f5f5f5">
          &nbsp;
        </TD>
      </TR>
      <TR>
        <TD colspan="2">
          <TABLE width="780" border="0" cellpadding="0" cellspacing="0" align="center">
            <TR>
              <TD align="left" valign="top">
                <TABLE width="160" border="0" cellpadding="0" cellspacing="0">
                  <TR>
                    <TD valign="top">
                      <TABLE border="0" cellspacing="0" cellpadding="0" width="150" align="center" valign="top">
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner_green.jpg" height="4" width="4"></TD>
                          <TD align="left" width="76" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="right" width="76" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner1_green.jpg" height="4" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" valign="top" width="4"><IMG src="templates/general_02/images/ctop_green.jpg" height="11" width="4"></TD>
                          <TD align="center" width="152" bgcolor="#D4E6F8" colspan="2" rowspan="2">
<!-- Load Left Module :: Begin -->
	<?php mosLoadModules("left"); ?>
<!-- Load Left Module :: End -->
                          </TD>
                          <TD align="right" valign="top" width="4"><IMG src="templates/general_02/images/ctop_green.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom_green.jpg" height="11" width="4"></TD>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom_green.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner2_green.jpg" height="4" width="4"></TD>
                          <TD align="left" width="76" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="right" width="76" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner3_green.jpg" height="4" width="4"></TD>
                        </TR>
                      </TABLE>
                    </TD>
                  </TR>
                </TABLE>
              </TD>
              <TD align="center" valign="top">
<!-- Load Top Module :: Begin -->
	<?php if (mosCountModules('top') > 0) { ?>
                <TABLE width="460" border="0" cellpadding="0" cellspacing="0">
                  <TR>
                    <TD valign="top" align="center">
                      <TABLE border="0" cellspacing="0" cellpadding="0" width="450" align="center" valign="top">
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner.jpg" height="4" width="4"></TD>
                          <TD align="left" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="right" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner1.jpg" height="4" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" valign="top" width="4"><IMG src="templates/general_02/images/ctop.jpg" height="11" width="4"></TD>
                          <TD align="center" width="442" bgcolor="#D4E6F8" colspan="2" rowspan="2">
	<?php mosLoadModules("top"); ?>
                          </TD>
                          <TD align="right" valign="top" width="4"><IMG src="templates/general_02/images/ctop.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom.jpg" height="11" width="4"></TD>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner2.jpg" height="4" width="4"></TD>
                          <TD align="left" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="right" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner3.jpg" height="4" width="4"></TD>
                        </TR>
                      </TABLE>
                    </TD>
                  </TR>
                </TABLE><br/>
	<?php } ?>
<!-- Load Top Module :: End -->
                <TABLE width="460" border="0" cellpadding="0" cellspacing="0">
                  <TR>
                    <TD valign="top" align="center">
                      <TABLE border="0" cellspacing="0" cellpadding="0" width="450" align="center" valign="top">
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner_green.jpg" height="4" width="4"></TD>
                          <TD align="left" width="221" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="right" width="221" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner1_green.jpg" height="4" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" valign="top" width="4"><IMG src="templates/general_02/images/ctop_green.jpg" height="11" width="4"></TD>
                          <TD align="center" width="442" bgcolor="#D4E6F8" colspan="2" rowspan="2" style="padding: 3px;">
<!-- Load Main Content :: Begin -->
	<?php mosMainBody(); ?>
<!-- Load Main Content :: End -->
                          </TD>
                          <TD align="right" valign="top" width="4"><IMG src="templates/general_02/images/ctop_green.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom_green.jpg" height="11" width="4"></TD>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom_green.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner2_green.jpg" height="4" width="4"></TD>
                          <TD align="left" width="221" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="right" width="221" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/corner3_green.jpg" height="4" width="4"></TD>
                        </TR>
                      </TABLE>
                    </TD>
                  </TR>
                </TABLE>
<!-- Load Bottom Module :: Begin -->
	<?php if (mosCountModules('bottom') > 0) { ?>
                <br/><TABLE width="460" border="0" cellpadding="0" cellspacing="0">
                  <TR>
                    <TD valign="top" align="center">
                      <TABLE border="0" cellspacing="0" cellpadding="0" width="450" align="center" valign="top">
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner.jpg" height="4" width="4"></TD>
                          <TD align="left" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="right" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner1.jpg" height="4" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" valign="top" width="4"><IMG src="templates/general_02/images/ctop.jpg" height="11" width="4"></TD>
                          <TD align="center" width="442" bgcolor="#D4E6F8" colspan="2" rowspan="2">
	<?php mosLoadModules("bottom"); ?>
                          </TD>
                          <TD align="right" valign="top" width="4"><IMG src="templates/general_02/images/ctop.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom.jpg" height="11" width="4"></TD>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner2.jpg" height="4" width="4"></TD>
                          <TD align="left" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="right" width="221" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner3.jpg" height="4" width="4"></TD>
                        </TR>
                      </TABLE>
                    </TD>
                  </TR>
                </TABLE>
	<?php } ?>
<!-- Load Bottom Module :: End -->
              </TD>
              <TD align="right" valign="top">
                <TABLE width="160" border="0" cellpadding="0" cellspacing="0">
                  <TR>
                    <TD valign="top">
                      <TABLE border="0" cellspacing="0" cellpadding="0" width="150" align="center" valign="top">
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner.jpg" height="4" width="4"></TD>
                          <TD align="left" width="76" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="right" width="76" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner1.jpg" height="4" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" valign="top" width="4"><IMG src="templates/general_02/images/ctop.jpg" height="11" width="4"></TD>
                          <TD align="center" width="152" bgcolor="#D4E6F8" colspan="2" rowspan="2">
<!-- Load Right Module :: Begin -->
	<?php if (mosCountModules('right') > 0) { mosLoadModules ( "right" ); } ?>
<!-- Load Right Module :: End -->
                          </TD>
                          <TD align="right" valign="top" width="4"><IMG src="templates/general_02/images/ctop.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom.jpg" height="11" width="4"></TD>
                          <TD align="left" width="4" valign="bottom"><IMG src="templates/general_02/images/cbottom.jpg" height="11" width="4"></TD>
                        </TR>
                        <TR>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner2.jpg" height="4" width="4"></TD>
                          <TD align="left" width="76" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="right" width="76" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/line_blue.jpg" height="4" width="11"></TD>
                          <TD align="left" width="4" height="4" background="templates/general_02/images/line_blue.jpg"><IMG src="templates/general_02/images/corner3.jpg" height="4" width="4"></TD>
                        </TR>
                      </TABLE>
                    </TD>
                  </TR>
                </TABLE>
              </TD>
            </TR>
          </TABLE>
        </TD>
      </TR>
      <TR>
        <TD colspan="2" height="10" bgcolor="#f5f5f5">
          &nbsp;
        </TD>
      </TR>
      <TR>
        <TD colspan="2" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" width="1" height="4"></TD>
      </TR>
	  <TR>
        <TD colspan="2" align="center">
<!-- Display Credit :: Begin -->
Template source from <a href="http://www.webhomez.net" target="_blank">www.webhomez.net</a>. <a href="http://designforjoomla.com" target="_blank" title="Joomla template by DesignForJoomla.com">Joomla template by DesignForJoomla.com</a>.
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
<!-- Display Credit :: End -->
        </TD>
      </TR>
	  <TR>
        <TD colspan="2" height="4" background="templates/general_02/images/line_green.jpg"><IMG src="templates/general_02/images/line_green.jpg" width="1" height="4"></TD>
      </TR>
    </TABLE>
  </BODY>
</HTML>



