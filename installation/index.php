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
<?php if (mosCountModules('advert3') AND mosCountModules('newsflash')) { ?>
<?php } elseif (mosCountModules('newsflash')) { ?>
<?php } elseif (mosCountModules('advert3')) { ?>
        #advert3{margin:22px 0 0 1px;width:665px;height:190px}
        #newsflash{margin:0;width:0px;height:0px}
<?php } else { ?>
        #box2,#advert3,#newsflash{margin:0;height:0;width:0}
        #container2{background:none}
        #container3{width:679px;margin:20px auto 0}
<?php } ?>
<?php if ((mosCountModules('top') OR mosCountModules('user5')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
<?php } ?>
<?php if ((mosCountModules('top') OR mosCountModules('user5')) AND (!mosCountModules('right') AND !mosCountModules('user3'))) { ?>
        #lbox,#user1,#left{width:398px}
        #mainbody{width:365px}
        #cbox,#user2,#top,#user5{width:264px}
        #rbox,#user3,#right{width:0px;height:0px}
<?php } ?>
<?php if ((!mosCountModules('top') AND !mosCountModules('user5')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
        #lbox,#user1,#left{width:470px}
        #mainbody{width:437px}
        #cbox,#top,#user5{width:0px;height:0px;border:none}
        #rbox,#user3,#right{width:207px}
<?php } ?>
<?php if ((!mosCountModules('top') AND !mosCountModules('user5')) AND (!mosCountModules('right') OR !mosCountModules('user3'))) { ?>
        #rbox,#user3,#right{width:0px;height:0px}
        #lbox,#user1,#left{width:679px}
        #mainbody{width:646px}
        #cbox{border:none;height:0;width:0}
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
        <div id="topbox"><div id="topbox1">
                <div id="logo">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="box1">
                        <div id="menuhack">
                                <div id="menu1"><?php
                                        $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,1");
                                        $database->loadObject( $row1 );
                                        if (isset($row1)) {
                                        echo '<ul>';
                                        if ( $row1->type == 'url' ) {
                                        echo '<li><a href="'.$row1->link.'">solution</a></li>';
                                        } else {
                                        $link = ampReplace($link);
                                        echo '<li><a href="'.$row1->link.'&amp;Itemid='.$row1->id.'">solution</a></li>';;
                                        }
                                        echo '</ul>';}?>
                                </div>
                                <div id="menu2"><?php
                                        $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_search%' ORDER BY ordering LIMIT 0,1");
                                        $database->loadObject( $row3 );
                                        if (isset($row3)) {
                                        echo '<ul>';
                                        if ( $row3->type == 'url' ) {
                                        echo '<li><a href="'.$row3->link.'">services</a></li>';
                                        } else {
                                        $link = ampReplace($link);
                                        echo '<li><a href="'.$row3->link.'&amp;Itemid='.$row3->id.'">services</a></li>';
                                        }
                                        echo '</ul>';}?>
                                </div>
                                <div id="menu3"><?php
                                        $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
                                        $database->loadObject( $row2 );
                                        if (isset($row2)) {
                                        echo '<ul>';
                                        if ( $row2->type == 'url' ) {
                                        echo '<li><a href="'.$row2->link.'">support</a></li>';
                                        } else {
                                        $link = ampReplace($link);
                                        echo '<li><a href="'.$row2->link.'&amp;Itemid='.$row2->id.'">support</a></li>';
                                        }
                                        echo '</ul>';}?>
                                </div>
                        </div>
                        <div id="user7"><?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
                                else echo '<h1>The best for your business</h1>'?>
                        </div>
                </div>
                <div id="toolbar1"><div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        ?>
        </div></div>
</div></div>
<div id="box2">
        <div id="advert3"><?php
                if (mosCountModules('advert3')) echo classifyHeading('advert3', -1);
                else echo '<img src="'._TEMPLATE_URL.'/images/who_pic.jpg" width="152" height="104" alt="" />';
                ?></div>
                <?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php echo classifyHeading('newsflash', -2);?></div><?php } ?>
        </div>
</div>
<div id="container2"><div id="container3">
        <div id="lbox">
                <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                <div id="mainbody"><?php mosMainbody() ?></div>
                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
        </div>
        <div id="cbox">
                <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
        </div>
        <div id="rbox">
                <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
                <div id="user3"><?php
                        if (mosCountModules('user3')) echo classifyHeading('user3', -1);
                        else echo '<img src="'._TEMPLATE_URL.'/images/services_pic.gif" width="190" height="276" alt=""/>';
                ?></div>
                </div>
</div></div>
<div id="footer_container">
        <div id="footer_box">
                <div id="user9"><?php if (mosCountModules('user9')) echo classifyHeading('user9', -1); ?></div>
                <div id="footer"><?php if (mosCountModules('footer')) echo classifyHeading('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->