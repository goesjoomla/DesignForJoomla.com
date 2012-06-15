<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS

//End Template Settings **********************************************************

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFontSize|changeContainerWidth|changeColor)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

$iso = split( '=', _ISO );
echo '<?xml version="2.0" encoding="'. $iso[1] .'"?' .'>';

// count modules for configure positions
$topModules = (mosCountModules('user1') ? 1 : 0) + (mosCountModules('user2') ? 1 : 0) + (mosCountModules('user3') ? 1 : 0) + (mosCountModules('user4') ? 1 : 0);

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
<?php } if ($topModules == 4) { ?>
        #user1,#user2,#user3,#user4{width:24.99%}
<?php } if ($topModules == 3) { ?>
        #user1,#user2,#user3,#user4{width:33.3%}
<?php } elseif ($topModules == 2) { ?>
        #user1,#user2,#user3,#user4{width:49.99%}
<?php } elseif ($topModules == 1) { ?>
        #user1,#user2,#user3,#user4{width:100%}
<?php } elseif ($topModules == 0) { ?>
        #footer{border:none}
<?php } ?>

<?php if (mosCountModules('left') AND mosCountModules('right')) { ?>
        #lbox,#left,#cbox,#right{width:200px}
        #cbox{margin-left:10px}
        #left .moduletable,#right .moduletable{width:168px}
        #rbox,#top,#box1,#banner,#mainbody,#bottom{width:358px}
        #rbox{margin-left:10px}
<?php } elseif (mosCountModules('left')) { ?>
        #lbox,#left{width:200px}
        #cbox,#right{width:0px;height:0px;margin:0}
        #left .moduletable{width:168px}
        #right .moduletable{width:0px;height:0px}
        #rbox,#top,#box1,#banner,#mainbody,#bottom{width:558px}
        #rbox{margin-left:10px}
<?php } elseif (mosCountModules('right')) { ?>
        #cbox,#right{width:200px}
        #lbox,#left{width:0px;height:0px;margin:0}
        #right .moduletable{width:168px}
        #left .moduletable{width:0px;height:0px}
        #rbox,#top,#box1,#banner,#mainbody,#bottom{width:558px}
        #rbox{margin-left:10px}
<?php } else { ?>
        #lbox,#left,#cbox,#right,#left .moduletable,#right .moduletable{width:0px;height:0px;margin:0}
        #rbox,#top,#box1,#banner,#mainbody,#bottom{width:758px}
        #rbox{margin-left:10px}
<?php } ?>
<?php if (mosCountModules('user8') AND mosCountModules('user9')) { ?>
        #user8,#user9{width:50%}
<?php } elseif (mosCountModules('user8')) { ?>
        #user8{width:100%}
        #user9{width:0px;height:0px}
<?php } elseif (mosCountModules('user9')) { ?>
        #user8{width:0px;height:0px}
        #user9{width:100%}
<?php } else { ?>
        #user8,#user9,#box1{width:0px;height:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
        html,body{height:100%;overflow:auto}
        html{overflow:hidden}
<?php if (mosCountModules('left') AND mosCountModules('right')) { ?>
        #left .moduletable,#right .moduletable{width:200px}
<?php } elseif (mosCountModules('left')) { ?>
        #left .moduletable{width:200px}
<?php } elseif (mosCountModules('right')) { ?>
        #right .moduletable{width:200px}
<?php } else { ?>
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
<script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/menu/d4j_menu.compact.js"></script>
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
        <div id="spacer"><!-- --></div>
        <div id="header">
                <div id="user6"><?php if (mosCountModules('user6')) mosLoadModules('user6', -2);
                        else echo '<h1>Pizza Parlor</h1><h2>by Free Css Templates</h2>' ?>
                </div>
                <div id="menu">
                        <div id="nav"><?php include(_TEMPLATE_PATH."/func/menu/d4j_menu.php"); ?></div>
                </div>
        </div>
        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                </div>
                <div id="cbox">
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                        <div id="box1">
                                <?php if (mosCountModules('user8')) { ?><div id="user8"><?php mosLoadModules('user8', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user9')) { ?><div id="user9"><?php mosLoadModules('user9', -2);?></div><?php } ?>
                        </div>
                        <?php if (mosCountModules('banner')) { ?><div id="banner"><?php mosLoadModules('banner', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                </div>
        </div>
        <?php if ($topModules > 0) { ?><div id="box2">
                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div><?php } ?>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->