<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

// count modules for configure positions
$topModules = (mosCountModules('user5') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0) + (mosCountModules('user7') ? 1 : 0);

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
<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
        #user1,#user2{width:49%}
<?php } elseif (mosCountModules('user1')) { ?>
        #user1{width:100%}
        #user2{width:0%}
<?php } elseif (mosCountModules('user2')) { ?>
        #user2{width:100%}
        #user1{width:0%}
<?php } else { ?>
        #box1,#user2,#user1{background:none;margin:0;padding:0;height:0px;width:0px}
<?php } ?>
<?php if (mosCountModules('user3') AND mosCountModules('user4')) { ?>
        #user3,#user4{width:49%}
<?php } elseif (mosCountModules('user3')) { ?>
        #user3{width:100%}
        #user4{width:0%}
<?php } elseif (mosCountModules('user4')) { ?>
        #user4{width:100%}
        #user3{width:0%}
<?php } else { ?>
        #box2,#user3,#user4{background:none;margin:0;padding:0;height:0px;width:0px}
<?php } ?>
<?php if (mosCountModules ('banner')) { ?>
        #banner{padding:15px 0 5px}
<?php } else { ?>
        #banner{padding:0;margin:0;height:0;width:0}
<?php } ?>
<?php if ($topModules > 0) { ?>
        #box3{width:100%}
<?php } if ($topModules == 3) { ?>
        #user5,#user6,#user7{width:33.3%}
<?php } elseif ($topModules == 2) { ?>
        #user5,#user6,#user7{width:49.5%}
<?php } elseif ($topModules == 1) { ?>
        #user5,#user6,#user7{width:100%}
<?php } elseif ($topModules == 0) { ?>
        #box3,#user5,#user6,#user7{width:0;height:0;margin:0;padding:0;background:none}
        #footer{margin-top:-4px;background:url('<?php echo _TEMPLATE_URL ?>/images/img06.gif') top left repeat-x}
<?php } ?>
<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('user8')) { ?>
        #lbox{width:34.28%}
        #rbox{width:62.85%}
<?php } else { ?>
        #lbox{width:0;width:0;height:0}
        #rbox{width:100%;padding:20px 0 0 0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('user8')) { ?>
        #rbox{width:65.72%}
<?php } else { ?>
        #rbox{width:100%;padding:20px 0 0 0}
<?php } ?>
</style>
<![endif]-->
        <script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
                var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
                        // ]]></script>
        <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
        <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/menu/d4j_menu.compact.js"></script>
</head>
<body><center>
<div id="container">
        <div id="header">
                <div id="logo"><?php if (mosCountModules('header')) mosLoadModules('header', -1);
                                                        else {?>
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1><?php } ?>
                </div>
                <div id="rheader">
                        <div id="subheader">
                                <div id="inset"><?php if (mosCountModules('inset')) mosLoadModules('inset', -1);?></div>
                                <div id="buttons">
                                        <div id="button1"><a href="javascript:void(0)" onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.jpg" alt="Increase font size" border="0"></img></a></div>
                                        <div id="button2"><a href="javascript:void(0)" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.jpg" alt="Decrease font size" border="0"></img></a></div>
                                        <div id="button3"><a href="javascript:void(0)" onclick="revertStyles();return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.jpg" alt="Revert font size to default" border="0"></img></a></div>
                                        <div id="spacer"><!-- --></div>
                                        <div id="button4"><a href="javascript:void(0)" onclick="changeContainerWidth(700);return false;"><img name="medium"  src="<?php echo _TEMPLATE_URL ?>/images/b4.jpg" alt="View in 800x600 screen resolution" border="0"></img></a></div>
                                        <div id="button5"><a href="javascript:void(0)" onclick="changeContainerWidth(960);return false;"><img name="large" src="<?php echo _TEMPLATE_URL ?>/images/b5.jpg" alt="View in 1024x768 screen resolution" border="0"></img></a></div>
                                        <div id="button6"><a href="javascript:void(0)" onclick="changeContainerWidth(0); return false;"><img name="fit" src="<?php echo _TEMPLATE_URL ?>/images/b6.jpg" alt="Auto fit in browser window" border="0"></img></a></div>
                                </div>
                        </div>
                        <div id="nav"><?php include(_TEMPLATE_PATH."/func/menu/d4j_menu.php"); ?></div>
                        <div id="spacer1"><!-- --></div>
                </div>
        </div>
        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user8')) { ?><div id="user8"><?php mosLoadModules('user8', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1);
                                                        else echo '<img src="'._TEMPLATE_URL.'/images/user9.jpg" width="616" height="200" alt="" />';?></div>
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                        <div id="box1">
                                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                        </div>
                        <div id="banner"><?php if (mosCountModules('banner')) mosLoadModules('banner', -1);?></div>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                        <div id="box2">
                                <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                        </div>
                </div>
        </div>
        <?php if ($topModules > 0) { ?><div id="box3">
                <?php if (mosCountModules('user5')) { ?><div id="user5"><?php mosLoadModules('user5', -2); ?></div><?php } ?>
                <?php if (mosCountModules('user6')) { ?><div id="user6"><?php mosLoadModules('user6', -2); ?></div><?php } ?>
                <?php if (mosCountModules('user7')) { ?><div id="user7"><?php mosLoadModules('user7', -2); ?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div><?php } ?>
        <div class="clr"><!-- --></div>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->