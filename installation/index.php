<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu

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
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu.css" />
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
<?php if ((mosCountModules('left') OR mosCountModules('user5')) AND (mosCountModules('right') OR mosCountModules('user4'))) { ?>
        #lbox,#user3,#top,#bottom{width:352px}
        #mainbody{width:288px}
        #cbox,#left,#spacer,#left,#user5{width:192px}
        #rbox,#user4,#right{width:215px}
<?php } ?>
<?php if ((mosCountModules('left') OR mosCountModules('user5')) AND (!mosCountModules('right') AND !mosCountModules('user4'))) { ?>
        #lbox,#user3,#top,#bottom{width:567px}
        #mainbody{width:503px}
        #cbox,#left,#spacer,#left,#user5{width:192px}
        #rbox,#user4,#right{width:0px}
        #content{background: url('<?php echo _TEMPLATE_URL ?>/images/content1.gif') top left repeat-y}
        #lbox .moduletable h3,#lbox .moduletable_special h3,#mainbody .contentheading,#mainbody .componentheading{background: url('<?php echo _TEMPLATE_URL ?>/images/top-shadow1.jpg') bottom center no-repeat}
        #lbox .moduletable_special h3{background: url('<?php echo _TEMPLATE_URL ?>/images/icon1.gif') bottom center no-repeat}
        #lbox .moduletable,#mainbody,#lbox .moduletable_special{background: url('<?php echo _TEMPLATE_URL ?>/images/top-shadow1.jpg') bottom center no-repeat}
        #toolbar{margin:0 12px 0 22px;float:right;background: url('<?php echo _TEMPLATE_URL ?>/images/services-bg1.gif') top left no-repeat}
        #topbox{background: url('<?php echo _TEMPLATE_URL ?>/images/header1.jpg') top left no-repeat}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user5')) AND (mosCountModules('right') OR mosCountModules('user4'))) { ?>
        #lbox,#user3,#top,#bottom{width:544px}
        #mainbody{width:480px}
        #cbox,#left,#spacer,#left,#user5{width:0}
        #rbox,#user4,#right{width:215px}
        #content{background:none}
        #lbox .moduletable h3,#lbox .moduletable_special h3,#mainbody .contentheading,#mainbody .componentheading{background: url('<?php echo _TEMPLATE_URL ?>/images/top-shadow1.jpg') bottom center no-repeat}
        #lbox .moduletable_special h3{background: url('<?php echo _TEMPLATE_URL ?>/images/icon1.gif') bottom center no-repeat}
        #lbox .moduletable,#mainbody,#lbox .moduletable_special{background: url('<?php echo _TEMPLATE_URL ?>/images/top-shadow1.jpg') bottom center no-repeat}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user5')) AND (!mosCountModules('right') AND !mosCountModules('user4'))) { ?>
        #lbox,#user3,#top,#bottom{width:778px}
        #mainbody{width:714px}
        #cbox,#left,#spacer,#left,#user5,#rbox,#user4,#right{width:0px}
        #lbox .moduletable h3,#lbox .moduletable_special h3,#mainbody .contentheading,#mainbody .componentheading{background: url('<?php echo _TEMPLATE_URL ?>/images/top-shadow2.jpg') bottom center no-repeat}
        #lbox .moduletable_special h3{background: url('<?php echo _TEMPLATE_URL ?>/images/icon2.gif') bottom center no-repeat}
        #lbox .moduletable,#mainbody,#lbox .moduletable_special{background: url('<?php echo _TEMPLATE_URL ?>/images/top-shadow2.jpg') bottom center no-repeat}
        #content{background:none}
        #toolbar{margin:0 12px 0 22px;float:right;background: url('<?php echo _TEMPLATE_URL ?>/images/services-bg1.gif') top left no-repeat}
        #topbox{background: url('<?php echo _TEMPLATE_URL ?>/images/header1.jpg') top left no-repeat}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:auto}
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if ((mosCountModules('left') OR mosCountModules('user5')) AND (!mosCountModules('right') AND !mosCountModules('user4'))) { ?>
        #toolbar{margin:0 6px 0 22px;float:right}
<?php } ?>
</style>
<![endif]-->
</head>
<body><center>
<div id="container">
        <div id="topbox">
                <div id="logo1">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="user7"><?php if (mosCountModules('user7')) echo classifyHeading('user7', -2);
                        else echo '<h1>ntech <span>blog</span></h1><h2>mauris eros, ornare nec, auctor quis, dignissim</h2>' ?>
                </div>
                <div id="toolbar">
                <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-2);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-2);
                        else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-2);
                ?>
                </div>
        </div>
        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php echo classifyHeading('user3', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
                </div>
                <div id="cbox">
                        <div id="spacer"></div>
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
                </div>
        </div>
</div>
<div id="footer_container">
        <div id="box1"><div id="box2">
                <div id="user9"><?php if (mosCountModules('user9')) echo classifyHeading('user9', -1); ?></div>
                <div id="footer"><?php if (mosCountModules('footer')) echo classifyHeading('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div>
        <div id="logo2">
                <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
        </div>
</div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->