<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS
$site_tools_width = 1; // 0:disable all , 1:enable for width changer SITE TOOLS

//End Template Settings **********************************************************

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFontSize|changeContainerWidth|changeColor)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

$iso = split( '=', _ISO );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) initEditor(); ?>

<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<style type="text/css">
<?php if($d4j_menu_type == 1) {
?>
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu.css" />
<?php }?>

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
<?php if (mosCountModules('user5') AND mosCountModules('user6')) { ?>
        #user5,#user6{width:49.9%}
<?php } elseif (mosCountModules('user5')) { ?>
        #user5{width:100%}
        #user6{width:0px;height:0px}
<?php } elseif (mosCountModules('user6')) { ?>
        #user5{width:0px;height:0px}
        #user6{width:100%}
<?php } else { ?>
        #user5,#user6,#box2{width:0px;height:0}
<?php } ?>
<?php if (mosCountModules('left') OR mosCountModules('right') OR mosCountModules('user4') OR mosCountModules('user8')) { ?>
        #lbox{width:65%}
        #rbox{width:30%}
<?php } else { ?>
        #rbox{width:0%;height:0}
        #lbox{width:100%}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
        html,body{height:100%;overflow:auto}
        html{overflow:hidden}
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
<div id="container_center">
<div id="container">
        <div id="header">
                <div id="user7"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
                        else echo '<h1>fotoladia</h1><h2>by free css templates</h2>' ?>
                </div>
        </div>
        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                        <div id="box1">
                                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                        </div>
                        <?php if (mosCountModules('banner')) { ?><div id="banner"><?php mosLoadModules('banner', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                        <div id="box2">
                                <?php if (mosCountModules('user5')) { ?><div id="user5"><?php mosLoadModules('user5', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user6')) { ?><div id="user6"><?php mosLoadModules('user6', -2);?></div><?php } ?>
                        </div>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user8')) { ?><div id="user8"><?php mosLoadModules('user8', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>
        </div>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->