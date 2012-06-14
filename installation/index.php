<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu;

//End Template Settings **********************************************************
$iso = split( '=', _ISO );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) initEditor(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu.css" />
<?php function classifyHeading($module){
ob_start();
mosLoadModules($module,-2);
$content = ob_get_contents();
ob_end_clean();
$patterns = "/&lt;([^\s]+)&gt;([^\/]*)\/([^\s]+)&gt;/";
$replaces = "<\\1>\\2</\\3>";
$iso = split( '=', _ISO );
return str_replace('&lt;</', '</', preg_replace($patterns, $replaces, $content));
}
?>
<style type="text/css">
<?php if (mosCountModules ('user4') OR mosCountModules ('right') OR mosCountModules ('left')) { ?>
<?php } else { ?>
        #lbox,#right,#user4,#left{width:0px;margin:0;height:0}
        #rbox,#top,#bottom,#spacer1,#spacer2{margin:0;width:981px}
        #mainbody{width:905px}
        #rbox{background: url('<?php echo _TEMPLATE_URL ?>/images/right_panel_bg1.gif') top left repeat-y}
        #spacer1{background: url('<?php echo _TEMPLATE_URL ?>/images/right_top1.gif') top left no-repeat}
        #spacer2{background: url('<?php echo _TEMPLATE_URL ?>/images/right_bottom1.gif') -1px 0 no-repeat}
<?php } ?>
<?php if (mosCountModules('user1') AND mosCountModules('user2') AND mosCountModules('user3')) { ?>
<?php } ?>
<?php if (mosCountModules('user1') AND mosCountModules('user2') AND !mosCountModules('user3')) { ?>
        #user1{width:479px}
        #user2{width:468px}
        #user3{width:0;margin:0;height:0}
<?php } ?>
<?php if (mosCountModules('user1') AND !mosCountModules('user2') AND mosCountModules('user3')) { ?>
        #user1{width:723px}
        #user2{width:0px;margin:0;height:0}
<?php } ?>
<?php if (!mosCountModules('user1') AND mosCountModules('user2') AND mosCountModules('user3')) { ?>
        #user2{width:723px}
        #user1{width:0px;margin:0;height:0}
<?php } ?>
<?php if (!mosCountModules('user1') AND mosCountModules('user2') AND !mosCountModules('user3')) { ?>
        #user2{width:962px}
        #user1,#user3{width:0px;margin:0;height:0}
<?php } ?>
<?php if (mosCountModules('user1') AND !mosCountModules('user2') AND !mosCountModules('user3')) { ?>
        #user1{width:962px}
        #user2,#user3{width:0px;margin:0;height:0}
<?php } ?>
<?php if (!mosCountModules('user1') AND !mosCountModules('user2') AND !mosCountModules('user3')) { ?>
        #box2,#user1,#user2,#user3{width:0px;margin:0;height:0;padding:0}
        #footer_box{margin-top:15px;width:980px}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0;margin-top:0}
        #footer{margin-top:0}
        #bottom_right{margin:0}
        #logo2{margin-top:-10px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('user9')) { ?>
<?php } else { ?>
        #user9{margin-top:0}
<?php } ?>
</style>
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<style type="text/css">
</style>
<![endif]-->
</head>
<body><center>
<div id="container">
        <div id="topbox">
                <div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        ?>
                </div>
                <div id="box">
                        <div id="logo1">
                               <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                        </div>
                        <div id="user7"><?php if (mosCountModules('user7')) echo classifyHeading('user7', -2); else
                             echo '<h1>Make a huge difference in <b>1000</b> days</h1><h2>congue eu, aliquet eu, dignissim ac, arcu. <span>Suspendisse</span> posuere eleifend arcu</h2>';?>
                        </div>
                </div>
                <div id="newsflash"><?php if (mosCountModules('newsflash')) mosLoadModules('newsflash', -2); else
                     echo '<h1>Nam adipiscing massa quis neque uisque iaculis, sapien in pulvinar</h1><h2>variusdiam turpis ultricies magna : <span>scipit nonummy, vulputate vitae, ultricies diam lectus</span></h2>';?>
                </div>
        </div>
        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <div id="spacer1"></div>
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
                        <div id="spacer2"></div>
                </div>
        </div>
        <div id="box2">
                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div>
        <div id="footer_box">
                       <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
                       <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
                       <div id="logo2">
                                      <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                       </div>
        </div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->