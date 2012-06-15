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
<?php if (mosCountModules('user1') AND mosCountModules('user2') AND mosCountModules('user3')) { ?>
          #user1{width:179px}
          #box{width:475px;background:#32556B}
          #user2,#user3{width:49.9%}
<?php } elseif (mosCountModules('user1') AND (mosCountModules('user2') OR mosCountModules('user3'))) { ?>
          #subheader{width:654px;background: url('<?php echo _TEMPLATE_URL ?>/images/subheader.gif') top left repeat-y}
          #user1{width:179px}
          #box,#user2,#user3{width:475px}
<?php } elseif (!mosCountModules('user1') AND mosCountModules('user2') AND mosCountModules('user3')) { ?>
          #user1{width:0px}
          #box{width:654px}
          #subheader{width:654px;background: url('<?php echo _TEMPLATE_URL ?>/images/subheader.gif') top left repeat-y}
          #user2{width:179px}
          #user3{width:475px}
<?php } elseif (!mosCountModules('user1') AND !mosCountModules('user2') AND !mosCountModules('user3')) { ?>
          #subheader{width:0px;height:0px}
<?php } else { ?>
          #user1,#box,#user2,#user3{width:654px}
          #user1 .moduletable,#user2 .moduletable,#user3 .moduletable{padding:0 20px 10px}
<?php } ?>
<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('toolbar')) { ?>
          #lbox,#right,#left{width:179px}
          #toolbar{width:174px}
          #lbox{margin-top:40px}
<?php } else { ?>
          #content,#subheader,#header{background:#32556B}
          #lbox,#right,#left,#toolbar{margin:0;width:0px;height:0px}
          #rbox,#top,#bottom{width:654px}
          #mainbody{width:614px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('toolbar')) { ?>
<?php } else { ?>
          #mainbody{width:654px}
<?php } ?>
</style>

<![endif]-->

        <script type="text/javascript"><!-- // --><![CDATA[
                var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
                        // ]]></script>
        <script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>
<body><center>
<div id="container">
        <div id="header">
                <div id="slogan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
                                  else echo '<h1>web<span>ain</span></h1>'?>
                </div>
                <div id="buttons">
                        <div id="button1"><a href="<?php echo $CURRENT_URL; ?>changeFontSize=1"  onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Increase font size" border="0"></img></a></div>
                        <div id="button2"><a href="<?php echo $CURRENT_URL; ?>changeFontSize=-1" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Decrease font size" border="0"></img></a></div>
                        <div id="button3"><a href="<?php echo $CURRENT_URL; ?>changeFontSize=0"  onclick="revertStyles(); return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Revert font size to default" border="0"></img></a></div>
                </div>
        </div>

        <div id="subheader">
                <?php if (mosCountModules('user1')== 1) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                <div id="box">
                <?php if (mosCountModules('user2')== 1) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                <?php if (mosCountModules('user3')== 1) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                </div>
        </div>

        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('toolbar')) { ?><div id="toolbar"><?php mosLoadModules('toolbar', -2);?></div><?php } ?>
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                </div>
        </div>
        <div class="clr"><!-- --></div>
<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->