<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFontSize|changeContainerWidth|changeColor)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) initEditor(); ?>
<?php mosShowHead(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<style type="text/css">
<?php if (mosCountModules ('user7')) { ?>
      #user7{height:auto;width:160px;padding:10px 10px 0}
      #box1{background:none}
      #lbox{background:url('<?php echo _TEMPLATE_URL ?>/images/img04.gif') 0 5px  repeat-x}
<?php } else { ?>
<?php } ?>
<?php if (mosCountModules ('user8')) { ?>
      #user8{height:auto;width:160px;padding:10px 10px 0}
      #box2{background:none}
      #cbox{background:url('<?php echo _TEMPLATE_URL ?>/images/img07.gif') 0 5px  repeat-x}
<?php } else { ?>
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
      #user9{height:auto;width:94%;padding:10px 10px 0}
      #box3{background:none}
      #rbox{background:url('<?php echo _TEMPLATE_URL ?>/images/img10.gif') 0 5px  repeat-x}
<?php } else { ?>
<?php } ?>
<?php if (mosCountModules ('banner')) { ?>
      #banner{padding:8px}
<?php } else { ?>
      #banner{padding:0px;height:0;width:0;margin:0}
<?php } ?>
<?php if (mosCountModules('user5') AND mosCountModules('user6')) { ?>
      #user5,#user6{width:49%}
<?php } elseif (mosCountModules('user5')) { ?>
      #user5{width:100%}
      #user6{width:0%}
<?php } elseif (mosCountModules('user6')) { ?>
      #user6{width:100%}
      #user5{width:0%}
<?php } else { ?>
      #box,#user5,#user6{background:none;margin:0;padding:0;height:0px;width:0px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('user7')) { ?>
      #user7{width:180px}
<?php } else { ?>
<?php } ?>
<?php if (mosCountModules ('user8')) { ?>
      #user8{width:180px}
<?php } else { ?>
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
      #user9{width:100%}
<?php } else { ?>
<?php } ?>
</style>
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<![endif]-->
        <script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
                var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
                        // ]]></script>
        <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
<!--[if IE]> <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger_ie6.js"></script> <![endif]-->
        <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/menu/d4j_menu.compact.js"></script>
</head>
<body><center>
<div id="container">
        <div id="header">
                <div id="logo"><?php if (mosCountModules('advert1')) mosLoadModules('advert1', -1);
                                else {?> <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1><?php } ?>
                </div>

                <div id="rheader">
                        <div id="tool">
                                <div id="buttons">
                                                <div id="button1"><a href="javascript:void(0)" onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Increase font size" border="0"></img></a></div>
                                                <div id="button2"><a href="javascript:void(0)" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Decrease font size" border="0"></img></a></div>
                                                <div id="button3"><a href="javascript:void(0)" onclick="revertStyles();return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Revert font size to default" border="0"></img></a></div>
                                                <div id="spacer"><!-- --></div>
                                                <div id="button4"><a href="javascript:void(0)" onclick="changeContainerWidth(680);return false;"><img name="medium"  src="<?php echo _TEMPLATE_URL ?>/images/b4.gif" alt="View in 800x600 screen resolution" border="0"></img></a></div>
                                                <div id="button5"><a href="javascript:void(0)" onclick="changeContainerWidth(850);return false;"><img name="large" src="<?php echo _TEMPLATE_URL ?>/images/b5.gif" alt="View in 1024x768 screen resolution" border="0"></img></a></div>
                                                <div id="button6"><a href="javascript:void(0)" onclick="changeContainerWidth(0); return false;"><img name="fit" src="<?php echo _TEMPLATE_URL ?>/images/b6.gif" alt="Auto fit in browser window" border="0"></img></a></div>
                                </div>
                        </div>
                        <div id="nav"><?php include(_TEMPLATE_PATH."/func/menu/d4j_menu.php"); ?></div>
                </div>
        </div>

        <div id="content">
                <div id="lbox">
                        <div id="spacer1"><!-- --></div>
                        <div id="user7"><?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
                                        else echo '<img src="'._TEMPLATE_URL.'/images/img03.jpg" width="180" height="150" alt="" />';?></div>
                        <div id="box1">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                        </div>
                </div>

                <div id="cbox">
                        <div id="spacer2"><!-- --></div>
                        <div id="user8"><?php if (mosCountModules('user8')) mosLoadModules('user8', -1);
                                        else echo '<img src="'._TEMPLATE_URL.'/images/img06.jpg" width="180" height="150" alt="" />';?></div>
                        <div id="box2">
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                        </div>
                </div>

                <div id="rbox">
                        <div id="box_spacer">
                        <div id="spacer3"><!-- --></div>
                        <div id="spacer4"><!-- --></div>
                        </div>
                        <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1);
                                        else echo '<img src="'._TEMPLATE_URL.'/images/img09_1.jpg" width="700" height="150" alt="" />';?></div>
                        <div id="box3">
                        <div id="banner"><?php if (mosCountModules('banner')) mosLoadModules('banner', -1);?></div>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                        <div id="box">
                                <?php if (mosCountModules('user5')) { ?><div id="user5"><?php mosLoadModules('user5', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user6')) { ?><div id="user6"><?php mosLoadModules('user6', -2);?></div><?php } ?>
                        </div>
                        </div>
                </div>
        </div>

        <div class="clr"><!-- --></div>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->