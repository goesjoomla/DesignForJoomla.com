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

// count modules for configure positions
$topModules = (mosCountModules('user1') ? 1 : 0) + (mosCountModules('user2') ? 1 : 0) + (mosCountModules('user3') ? 1 : 0) + (mosCountModules('user4') ? 1 : 0);
$bottomModules = (mosCountModules('user5') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0) + (mosCountModules('user7') ? 1 : 0);

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
<?php if (mosCountModules('user8') AND mosCountModules('user9')) { ?>
        #user8,#user9{width:49.4%}
        #user8 .moduletable{margin:18px 9px 19px 19px}
        #user9 .moduletable{margin:18px 19px 19px 9px}
<?php } elseif (mosCountModules('user8')) { ?>
        #user8{width:100%}
        #user9{width:0%}
        #user9 .moduletable{margin:0}
        #user8 .moduletable{margin:18px 19px 19px 19px}
<?php } elseif (mosCountModules('user9')) { ?>
        #user9{width:100%}
        #user8{width:0%}
        #user9 .moduletable{margin:18px 19px 19px 19px}
        #user8 .moduletable{margin:0}
<?php } else { ?>
        #box1,#user8,#user9,#user8 .moduletable,#user9 .moduletable{margin:0;padding:0;height:0px;width:0px}
<?php } ?>

<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('newsflash')) { ?>
        #lbox{width:71.2%}
        #rbox{width:28.8%}
<?php } else { ?>
        #lbox{width:100%}
        #mainbody{width:95.3%;margin:18px 19px 19px 17px}
        #rbox{width:0px;height:0px}
<?php } ?>

<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 4) { ?>
        #user1,#user2,#user3,#user4{width:24.97%}
<?php } elseif ($topModules == 3) { ?>
        #user1,#user2,#user3,#user4{width:33.32%}
<?php } elseif ($topModules == 2) { ?>
        #user1,#user2,#user3,#user4{width:49.97%}
<?php } elseif ($topModules == 1) { ?>
        #user1,#user2,#user3,#user4{width:99.97%}
<?php } ?>

<?php if ($bottomModules > 0) { ?>
<?php } if ($bottomModules == 3) { ?>
        #user5,#user6,#user7{width:33.32%}
<?php } elseif ($bottomModules == 2) { ?>
        #user5,#user6,#user7{width:49.97%}
<?php } elseif ($bottomModules == 1) { ?>
        #user5,#user5,#user7{width:99.97%}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('newsflash')) { ?>
        #mainbody{margin:18px 9px 19px}
<?php } else { ?>
        #mainbody{margin:18px 9px 19px 8px}
<?php } ?>
</style>
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<![endif]-->
<script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
// ]]></script>
        <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
<!--[if lt IE 7]> <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger_ie6.js"></script> <![endif]-->
        <script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/menu/d4j_menu.compact.js"></script>
</head>
<body><center>
<div id="container"><div id="container_left"><div id="container_right">
        <div id="header">
                <div id="toolbar"><?php if (mosCountModules('toolbar')) mosLoadModules('toolbar', -1);?></div>
        </div>

        <div id="subheader">
                <div id="logo"><?php if (mosCountModules('inset')) mosLoadModules('inset', -1);
                        else {?> <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1><?php } ?>
                </div>
                <div id="slogan"><?php if (mosCountModules('advert1')) mosLoadModules('advert1', -2);
                        else echo '<h1>Tick_Tock</h1><h2>"as queer as a clockwork orange"</h2>   ' ?>
                </div>
                <div id="color">
                        <div id="tool1">
                                <div id="button1"><a href="javascript:void(0)" onclick="changeColor(0);return false;"><img name="light_orange" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Change to light orange color" border="0"></img></a></div>
                                <div id="button2"><a href="javascript:void(0)" onclick="changeColor(1);return false;"><img name="light_violet" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Change to light violet color" border="0"></img></a></div>
                                <div id="button3"><a href="javascript:void(0)" onclick="changeColor(2);return false;"><img name="light_green" src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Change to light green color" border="0"></img></a></div>
                                <div id="button4"><a href="javascript:void(0)" onclick="changeColor(3);return false;"><img name="light_blue" src="<?php echo _TEMPLATE_URL ?>/images/b4.gif" alt="Change to light blue color" border="0"></img></a></div>
                                <div id="button5"><a href="javascript:void(0)" onclick="changeColor(4);return false;"><img name="orange" src="<?php echo _TEMPLATE_URL ?>/images/b5.gif" alt="Change to orange color" border="0"></img></a></div>
                                <div id="button6"><a href="javascript:void(0)" onclick="changeColor(5);return false;"><img name="violet" src="<?php echo _TEMPLATE_URL ?>/images/b6.gif" alt="Change to violet color" border="0"></img></a></div>
                                <div id="button7"><a href="javascript:void(0)" onclick="changeColor(6);return false;"><img name="green" src="<?php echo _TEMPLATE_URL ?>/images/b7.gif" alt="Change to green color" border="0"></img></a></div>
                                <div id="button8"><a href="javascript:void(0)" onclick="changeColor(7);return false;"><img name="blue" src="<?php echo _TEMPLATE_URL ?>/images/b8.gif" alt="Change to blue color" border="0"></img></a></div>
                        </div>
                </div>
                <div id="nav"><?php include(_TEMPLATE_PATH."/func/menu/d4j_menu.php"); ?></div>
        </div>

        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                        <div id="box1">
                                <?php if (mosCountModules('user8')) { ?><div id="user8"><?php mosLoadModules('user8', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user9')) { ?><div id="user9"><?php mosLoadModules('user9', -2);?></div><?php } ?>
                        </div>
                        <?php if (mosCountModules('banner')) { ?><div id="banner"><?php mosLoadModules('banner', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <div id="tool2">
                                <div id="button14"><a href="javascript:void(0)" onclick="changeContainerWidth(0); return false;"><img name="fit" src="<?php echo _TEMPLATE_URL ?>/images/b14.gif" alt="Auto fit in browser window" border="0"></img></a></div>
                                <div id="button13"><a href="javascript:void(0)" onclick="changeContainerWidth(960);return false;"><img name="large" src="<?php echo _TEMPLATE_URL ?>/images/b13.gif" alt="View in 1024x768 screen resolution" border="0"></img></a></div>
                                <div id="button12"><a href="javascript:void(0)" onclick="changeContainerWidth(780);return false;"><img name="medium"  src="<?php echo _TEMPLATE_URL ?>/images/b12.gif" alt="View in 800x600 screen resolution" border="0"></img></a></div>
                                <div id="spacer"><!-- --></div>
                                <div id="button11"><a href="javascript:void(0)" onclick="revertStyles();return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b11.gif" alt="Revert font size to default" border="0"></img></a></div>
                                <div id="button10"><a href="javascript:void(0)" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b10.gif" alt="Decrease font size" border="0"></img></a></div>
                                <div id="button9"><a href="javascript:void(0)" onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b9.gif" alt="Increase font size" border="0"></img></a></div>
                        </div>
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php mosLoadModules('newsflash', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>
        </div>

        <?php if ($topModules > 0) { ?><div id="box2">
                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div><?php } ?>

        <div id="box">
                <?php if ($bottomModules > 0) { ?><div id="box3">
                        <?php if (mosCountModules('user5')) { ?><div id="user5"><?php mosLoadModules('user5', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user6')) { ?><div id="user6"><?php mosLoadModules('user6', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user7')) { ?><div id="user7"><?php mosLoadModules('user7', -2);?></div><?php } ?>
                        <div class="clr"><!-- --></div>
                </div><?php } ?>
                <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div>
</div></div></div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->