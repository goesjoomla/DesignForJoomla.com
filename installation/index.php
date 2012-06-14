<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

// count modules for configure positions
$topModules = (mosCountModules('user8') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0) + (mosCountModules('user7') ? 1 : 0);

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_tr
// Joomla MainMenu is putted at toolbar position. Please user Flat List style for this menu
// D4J_ListMenu (dropdown menu) is putted at advert1 module. Please config for Sub-menu Deep Parameter to use drop down submenu.
// D4J_TransMenu (transmenu) is putted at advert2 module. Please use Horizontal menu style.

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
<?php if (mosCountModules('left') OR mosCountModules('right') OR mosCountModules('user5')) { ?>
<?php } else { ?>
        #lbox{width:0%;height:0}
        #rbox,#top,#box1,#user1,#user2,#mainbody,#bottom{width:610px}
        #box2{width:608px}
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
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:auto}
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
<?php } ?>
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user6,#user7,#user8{width:33.2%}
<?php } elseif ($topModules == 2) { ?>
        #user6,#user7,#user8{width:49.5%}
<?php } elseif ($topModules == 1) { ?>
        #user6,#user7,#user8{width:100%}
<?php } elseif ($topModules == 0) { ?>
        #user6,#user7,#user8{width:0%;height:0;padding:0}
        #box2{border:none;width:0;height:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
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
        <div id="topbox"><div id="toolbar">
                 <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                       else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                       else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
                        ?>
        </div></div>
        <div id="head">
                <div id="header"><?php if (mosCountModules('header')) echo classifyHeading('header', -2);
                        else echo '<h1>dark</h1><h2>dimension <span>lastest for web....</span></h2>'?>
                </div>
                <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
        </div>
        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
                        <div id="spacer"></div>
                </div>
                <div id="rbox">
                        <div id="box1">
                                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
                        </div>
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
                        <?php if ($topModules > 0) { ?><div id="box2">
                                <?php if (mosCountModules('user6')) { ?><div id="user6"><?php echo classifyHeading('user6', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user7')) { ?><div id="user7"><?php echo classifyHeading('user7', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user8')) { ?><div id="user8"><?php echo classifyHeading('user8', -2);?></div><?php } ?>
                                <div class="clr"><!-- --></div>
                                <?php if (mosCountModules('debug')) { ?><div id="debug"><?php echo classifyHeading('debug', -1);?></div><?php } ?>
                        </div><?php } ?>
                </div>
        </div>
</div>
<div id="footer_container"><div id="footer_inner">
        <div id="user9"><?php if (mosCountModules('user9')) echo classifyHeading('user9', -1); ?></div>
        <div id="footer"><?php if (mosCountModules('footer')) echo classifyHeading('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->