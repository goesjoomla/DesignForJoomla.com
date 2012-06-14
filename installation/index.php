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
<?php if (mosCountModules('user4') == 1) { ?>
                #user4{width:100%}
<?php } else { ?>
                #user4{width:0px;height:0px}
<?php } ?>
<?php if (mosCountModules('bottom')) { ?>
                #spacer{height:40px}
<?php } else { ?>
                #spacer{width:0px;height:0px}
<?php } ?>
<?php if ((mosCountModules('left') OR mosCountModules('toolbar')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
                 #lbox{width:19.66%}
                 #cbox{width:60.3%}
                 #rbox{width:19.5%}
<?php } elseif (mosCountModules('left') OR mosCountModules('toolbar') AND !mosCountModules('right') AND !mosCountModules('user3')) { ?>
                 #lbox{width:19.66%}
                 #cbox{width:80.093%;border-right:none;float:right}
                 #rbox{width:0px;height:0px}
<?php } elseif (!mosCountModules('left') AND !mosCountModules('toolbar') AND mosCountModules('right') OR mosCountModules('user3')) { ?>
                 #rbox{width:19.5%}
                 #cbox{width:79.96%}
                 #lbox{width:0px;height:0px}
                 #lbox_footer{height:0px;width:0px}
<?php } elseif (!mosCountModules('left') AND !mosCountModules('toolbar') AND !mosCountModules('right') AND !mosCountModules('user3')) { ?>
                 #cbox{width:100%;border:none}
                 #lbox,#rbox{width:0px;height:0px}
                 #rbox_footer,#lbox_footer{height:0px;width:0px}
<?php } ?>
<?php if (mosCountModules('user3')) { ?>
                #rbox_footer{height:160px}
<?php } else { ?>
                #rbox_footer{height:0px;width:0px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if ((mosCountModules('left') OR mosCountModules('toolbar')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
                 #cbox{width:60.7%}
<?php } elseif (mosCountModules('left') OR mosCountModules('toolbar') AND !mosCountModules('right') AND !mosCountModules('user3')) { ?>
                 #cbox{width:80.3%}
<?php } elseif (!mosCountModules('left') AND !mosCountModules('toolbar') AND mosCountModules('right') OR mosCountModules('user3')) { ?>
                 #cbox{width:80.3%}
<?php } elseif (!mosCountModules('left') AND !mosCountModules('toolbar') AND !mosCountModules('right') AND !mosCountModules('user3')) { ?>
                 #cbox{width:100%;border:none}
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
                  <div id="logo">
                             <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                  </div>
                  <div id="button">
                        <div id="button1"><a href="<?php echo $CURRENT_URL; ?>changeFontSize=1"  onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Increase font size" border="0"></img></a></div>
                        <div id="button2"><a href="<?php echo $CURRENT_URL; ?>changeFontSize=-1" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Decrease font size" border="0"></img></a></div>
                        <div id="button3"><a href="<?php echo $CURRENT_URL; ?>changeFontSize=0"  onclick="revertStyles(); return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Revert font size to default" border="0"></img></a></div>
                  </div>
         </div>
         <div id="content">
                  <div id="lbox">
                           <?php if (mosCountModules('toolbar')) { ?><div id="toolbar"><?php mosLoadModules('toolbar', -2);?></div><?php } ?>
                           <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                           <div id="lbox_footer"></div>
                  </div>

                  <div id="cbox">
                           <?php if (mosCountModules('user4') == 1) {?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                           <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                            <div id="mainbody"><?php mosMainbody() ?></div>
                           <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                           <div id="spacer"></div>
                  </div>

                  <div id="rbox">
                           <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                           <div id="rbox_footer"></div>
                           <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                  </div>

         </div>

          <div class="clr"><!-- --></div>
          <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->