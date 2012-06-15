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
$topModules = (mosCountModules('user1') ? 1 : 0) + (mosCountModules('user2') ? 1 : 0) + (mosCountModules('user3') ? 1 : 0);

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
<?php if ($topModules > 0) { ?>
        #subheader{width:100%}
<?php } if ($topModules == 3) { ?>
        #user1,#user2,#user3{width:33%}
<?php } elseif ($topModules == 2) { ?>
        #user1,#user2,#user3{width:49%}
        #user1 .moduletable,#user2 .moduletable,#user3 .moduletable{padding:0px 20px 15px}
<?php } elseif ($topModules == 1) { ?>
        #user1,#user2,#user3{width:100%}
        #user1 .moduletable,#user2 .moduletable,#user3 .moduletable{padding:0px 20px 15px}
<?php } ?>
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
        #lbox{width:67%}
        #rbox{width:33%}
<?php } else { ?>
        #lbox{width:100%}
        #mainbody{width:95%}
        #rbox{width:0px;height:0px}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:26px}
<?php } else { ?>
        #user9{height:5px;margin:0;padding:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user1,#user2,#user3{width:32%}
<?php } elseif ($topModules == 2) { ?>
        #user1,#user2,#user3{width:48%}
<?php } elseif ($topModules == 1) { ?>
        #user1,#user2,#user3{width:100%}
        #user1 .moduletable,#user2 .moduletable,#user3 .moduletable{padding:0px 26px 15px}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
<?php } else { ?>
        #user9{height:5px;margin:0;padding:0}
<?php } ?>
</style>
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<![endif]-->
        <script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
                var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
                        // ]]></script>
        <script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
        <script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/menu/d4j_menu.compact.js"></script>
</head>
<body><center>
<div id="container"><div id="container_inner">
        <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
        <div id="header">
                <div id="slogan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
                                    else echo '<h1>Visual Tom Foolery!</h1>
                                           <h2>Tag Line Goes Here</h2>'?>
                </div>
                <div id="buttons">
                        <div id="button1"><a href="javascript:void(0)"  onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Increase font size" border="0"></img></a></div>
                        <div id="button2"><a href="javascript:void(0)" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Decrease font size" border="0"></img></a></div>
                        <div id="button3"><a href="javascript:void(0)"  onclick="revertStyles(); return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Revert font size to default" border="0"></img></a></div>
                        <div id="button4"><a href="javascript:void(0)" onclick="changeContainerWidth(812);return false;"><img name="medium"  src="<?php echo _TEMPLATE_URL ?>/images/b4.gif" alt="View in 800x600 screen resolution" border="0"></img></a></div>
                        <div id="button5"><a href="javascript:void(0)" onclick="changeContainerWidth(960);return false;"><img name="large" src="<?php echo _TEMPLATE_URL ?>/images/b5.gif" alt="View in 1024x768 screen resolution" border="0"></img></a></div>
                        <div id="button6"><a href="javascript:void(0)"  onclick="changeContainerWidth(0); return false;"><img name="fit" src="<?php echo _TEMPLATE_URL ?>/images/b6.gif" alt="Auto fit in browser window" border="0"></img></a></div>
                </div>
        </div>

        <div id="mainmenu"><?php include(_TEMPLATE_PATH."/func/menu/d4j_menu.php"); ?></div>
        <?php if ($topModules > 0) { ?><div id="subheader">
                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2); ?></div><?php } ?>
                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2); ?></div><?php } ?>
                <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2); ?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div><?php } ?>

        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>
        </div>
        <div class="clr"><!-- --></div>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div></div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->