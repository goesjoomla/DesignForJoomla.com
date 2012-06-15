<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

/* Drop down Menu Settings*****************************************************/
$drop_down_menu = 1;  // 1: Enable; 0: Disable

/* Site Tools Settings*****************************************************/
$site_tools = 1;      // 0: disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0: disable     , 1:enable for font changer SITE TOOLS

//End Template Settings **********************************************************

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFontSize|changeContainerWidth|changeColor)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

$iso = split( '=', _ISO );
echo '<?xml version="2.0" encoding="'. $iso[1] .'"?' .'>';

// count modules for configure positions
$topModules = (mosCountModules('user5') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0) + (mosCountModules('user7') ? 1 : 0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) initEditor(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<style type="text/css">
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user5,#user6,#user7{width:33.3%}
<?php } elseif ($topModules == 2) { ?>
        #user5,#user6,#user7{width:49.9%}
<?php } elseif ($topModules == 1) { ?>
        #user5,#user6,#user7{width:100%}
<?php } elseif ($topModules == 0) { ?>
<?php } ?>
<?php if (mosCountModules('advert2') OR mosCountModules('right')) { ?>
        #top,#box1,#banner,#box2,#bottom{width:575px;overflow:hidden}
        #cbox,#hw_toolbar{width:575px}
        #mainbody{width:525px}
<?php } else { ?>
        #top,#box1,#banner,#box2,#bottom{width:760px;overflow:hidden}
        #cbox,#hw_toolbar{width:575px}
        #mainbody{width:710px}
<?php } ?>
<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
        #user1,#user2{width:49.9%}
<?php } elseif (mosCountModules('user1')) { ?>
        #user1{width:100%}
        #user2{width:0px;height:0px}
<?php } elseif (mosCountModules('user2')) { ?>
        #user1{width:0px;height:0px}
        #user2{width:100%}
<?php } else { ?>
        #user1,#user2,#box1{width:0px;height:0}
<?php } ?>
<?php if (mosCountModules('user3') AND mosCountModules('user4')) { ?>
        #user3,#user4{width:49.9%}
<?php } elseif (mosCountModules('user3')) { ?>
        #user3{width:100%}
        #user4{width:0px;height:0px}
<?php } elseif (mosCountModules('user4')) { ?>
        #user3{width:0px;height:0px}
        #user4{width:100%}
<?php } else { ?>
        #user3,#user4,#box2{width:0px;height:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
        html,body{height:100%;overflow:auto}
        html{overflow:hidden}
<?php if (mosCountModules('advert2') OR mosCountModules('right')) { ?>
        #mainbody{width:575px}
<?php } else { ?>
        #mainbody{width:780px}
<?php } ?>
</style>
<![endif]-->
<?php if($site_tools) {
        include_once(_TEMPLATE_PATH."/func/style/d4j_sitetools.php");
?>
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
<?php }?>

<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php"); ?>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/d4jCommonInclude.compact.js"></script>
<script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>
<body><center>
<?php if($site_tools){?>
        <div id="sitetools" style="">
                <img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools.gif" alt="" onmouseover="document.getElementById('tools').style.display='block'" onmouseout="document.getElementById('tools').style.display='none'"/>
        </div>
        <div id="tools" onmouseover="this.style.display='block'" onmouseout="this.style.display='none'" style="">
                <?php writeTools();?>
        </div>
<?php }?>

<div id="container">
        <div id="lbox">
                <div id="logo">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="advert1"><?php if (mosCountModules('advert1')) mosLoadModules('advert1', -2);
                                else echo '<h1>ornate</h1><h2>by free css templates</h2>' ?>
                </div>
                        <?php if (mosCountModules( "left" )) { ?><div class="leftbox">
                                <div id="left" class="leftblock"><?php mosLoadModules ( "left", -3 ); ?></div>
                        </div><?php } ?>
                        <?php if (mosCountModules( "user8" )) { ?><div class="leftbox">
                                <div id="user8" class="leftblock"><?php mosLoadModules ( "user8", -3 ); ?></div>
                        </div><?php } ?>
                        <?php if (mosCountModules( "user9" )) { ?><div class="leftbox">
                                <div id="user9" class="leftblock"><?php mosLoadModules ( "user9", -3 ); ?></div>
                        </div><?php } ?>
        </div>
        <div id="right_box">
                <div id="top_box">
                        <div id="cbox">
                                <div id="hw_toolbar">
                                <?php if ($drop_down_menu) { ?>
                                <?php include(_TEMPLATE_PATH."/func/menu/mod_d4j_list_menu.php"); ?>
                                <?php } ?>
                                </div>
                                <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                                <div id="box1">
                                        <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                                        <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                                </div>
                                <?php if (mosCountModules('banner')) { ?><div id="banner"><?php mosLoadModules('banner', -2);?></div><?php } ?>
                                <div id="mainbody"><?php mosMainbody() ?></div>
                                <div id="box2">
                                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                                        <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                                </div>
                                <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                        </div>
                        <div id="rbox">
                                <?php if (mosCountModules('advert2')) { ?><div id="advert2"><?php mosLoadModules('advert2', -2);?></div><?php } ?>
                                <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                        </div>
                </div>
                <?php if ($topModules > 0) { ?><div id="box3">
                        <?php if (mosCountModules('user5')) { ?><div id="user5"><?php mosLoadModules('user5', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user6')) { ?><div id="user6"><?php mosLoadModules('user6', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user7')) { ?><div id="user7"><?php mosLoadModules('user7', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
                </div><?php } ?>
        </div>
</div>
<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->