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
<?php if (mosCountModules('user4') OR mosCountModules('user5')) { ?>
<?php } else { ?>
        #lbox1,#user3,#top,#mainbody{width:708px}
        #lbox1 .moduletable,#lbox1 .moduletable_special{padding:0 0 10px}
        #rbox1,#user4,#user5{width:0px;margin:0;height:0}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:auto}
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
        #footer{margin-top:0}
        #footer_box{margin-top:25px}
<?php } ?>
<?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (mosCountModules('right') OR mosCountModules('user2'))) { ?>
<?php } ?>
<?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (!mosCountModules('right') AND !mosCountModules('user2'))) { ?>
         #lbox2,#left,#user1{width:708px}
         #rbox2,#right,#user2{width:0px;height:0}
         #lbox2 .moduletable,#lbox2 .moduletable_special{padding:0}
         #content{background:none}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (mosCountModules('right') OR mosCountModules('user2'))) { ?>
         #lbox2,#left,#user1{width:0px;height:0}
         #rbox2,#right,#user2{width:708px}
         #rbox2 .moduletable,#rbox2 .moduletable_special{padding:0}
         #content{background:none}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (!mosCountModules('right') AND !mosCountModules('user2'))) { ?>
         #lbox2,#left,#user1,#rbox2,#right,#user2{width:0px;height:0}
         #content,#container3,#container31{background:none;height:0;width:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:auto}
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
        #footer{margin-top:0}
        #footer_box{margin-top:25px}
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
<div id="container1">
      <div id="topbox">
                <div id="logo1">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
                ?>
                </div>
        </div>
        <div id="midbox">
                <div id="user7"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
                        else echo '<h1>More advanced</h1><h2>Fusce auctor, risus nec vulputate consectetuer, metus lorem</h2>'?>
                </div>
        </div>
</div>
<div id="container2"><div id="container21">
                <div id="lbox1">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php echo classifyHeading('user3', -2);?></div><?php } ?>
                </div>
                <div id="rbox1">
                       <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
                       <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
                </div>
</div></div>
<div id="container3"><div id="container31"><div id="content">
                <div id="lbox2">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
                </div>
                <div id="rbox2">
                       <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                       <?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
                </div>
</div> </div></div>
<div id="footer_container1"><div id="footer_container2">
      <div id="footer_box">
                <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
                <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div>
        <div id="logo2">
                <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
        </div>
</div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->