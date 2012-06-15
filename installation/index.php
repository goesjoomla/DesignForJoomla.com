<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype1 = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu
$d4j_menutype2 = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu

// count modules for configure positions
$topModules = (mosCountModules('user5') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0) + (mosCountModules('user7') ? 1 : 0);


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
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu1.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu1.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu2.css" />
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
        <?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
<?php } ?>
        <?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (!mosCountModules('right') AND !mosCountModules('user3'))) { ?>
        #content{background: url('<?php echo _TEMPLATE_URL ?>/images/content2.gif') top left repeat-y}
        #lbox2,#left,#user1{width:189px}
        #cbox2,#top,#mainbody,#bottom,#user2{width:537px}
        #cbox{width:589px}
        #rbox2,#right,#user3,#spacer{width:0;height:0}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
        #content{background: url('<?php echo _TEMPLATE_URL ?>/images/content1.gif') top left repeat-y}
        #lbox2,#left,#user1,#spacer{width:0;height:0px}
        #cbox2,#top,#mainbody,#bottom,#user2{width:537px}
        #cbox{width:589px}
        #rbox2,#right,#user3{width:189px}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (!mosCountModules('right') AND !mosCountModules('user3'))) { ?>
        #content{background: url('<?php echo _TEMPLATE_URL ?>/images/content3.gif') top left repeat-y}
        #lbox2,#left,#user1,#spacer,#rbox2,#right,#user3{width:0;height:0px}
        #cbox2,#top,#mainbody,#bottom,#user2{width:726px}
        #cbox{width:778px}
<?php } ?>
<?php if (mosCountModules ('user4')) { ?>
        #user4{height:auto}
<?php } else { ?>
        #user4,#container2{width:0px;height:0px;padding:0}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:auto}
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
        #box{margin-top:41px}
<?php } ?>
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user6,#user7,#user5{width:33%}
<?php } elseif ($topModules == 2) { ?>
        #user6,#user7,#user5{width:49%;text-align:center}
<?php } elseif ($topModules == 1) { ?>
        #user6,#user7,#user5{width:100%;text-align:center}
        #box .moduletable{border:none}
<?php } elseif ($topModules == 0) { ?>
        #user6,#user7,#user5{width:0%;height:0;padding:0}
        #box{border:none;width:0;height:0}
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
        <div id="midbox">
                <div id="lbox1">
                        <div id="menuhack">
                                <div id="menu1"><?php
                                        $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,1");
                                        $database->loadObject( $row1 );
                                        if (isset($row1)) {
                                        echo '<ul>';
                                        if ( $row1->type == 'url' ) {
                                        echo '<li><a href="'.$row1->link.'">HOME</a></li>';
                                        } else {
                                        $link = ampReplace($link);
                                        echo '<li><a href="'.$row1->link.'&amp;Itemid='.$row1->id.'"></a></li>';;
                                        }
                                        echo '</ul>';}?>
                                </div>
                                <div id="menu2"><?php
                                        $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_search%' ORDER BY ordering LIMIT 0,1");
                                        $database->loadObject( $row3 );
                                        if (isset($row3)) {
                                        echo '<ul>';
                                        if ( $row3->type == 'url' ) {
                                        echo '<li><a href="'.$row3->link.'">SEARCH</a></li>';
                                        } else {
                                        $link = ampReplace($link);
                                        echo '<li><a href="'.$row3->link.'&amp;Itemid='.$row3->id.'"></a></li>';
                                        }
                                        echo '</ul>';}?>
                                </div>
                                <div id="menu3"><?php
                                        $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
                                        $database->loadObject( $row2 );
                                        if (isset($row2)) {
                                        echo '<ul>';
                                        if ( $row2->type == 'url' ) {
                                        echo '<li><a href="'.$row2->link.'">CONTACT US</a></li>';
                                        } else {
                                        $link = ampReplace($link);
                                        echo '<li><a href="'.$row2->link.'&amp;Itemid='.$row2->id.'"></a></li>';
                                        }
                                        echo '</ul>';}?>
                                </div>
                        </div>
                        <div id="toolbar1">
                                <?php if($d4j_menutype1 == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                                else if($d4j_menutype1 == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                                else if($d4j_menutype1 == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
                                ?>
                        </div>
                </div>
                <div id="cbox1">
                        <div id="logo">
                                <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                        </div>
                        <div id="advert3"><?php
                                if (mosCountModules('advert3')) mosLoadModules('advert3', -1);
                                else echo '<img src="'._TEMPLATE_URL.'/images/header_pic.jpg" width="332" height="150" alt="" />';
                        ?></div>
                </div>
                <div id="rbox1">
                        <?php if (mosCountModules('user8')) { ?><div id="user8"><?php echo classifyHeading('user8', -2);?></div><?php } ?>
                        <div id="toolbar2">
                                <?php if($d4j_menutype2 == 1 && mosCountModules('cpanel')) echo classifyHeading('cpanel',-1);
                                else if($d4j_menutype2 == 2 && mosCountModules('inset')) echo classifyHeading('inset',-1);
                                else if($d4j_menutype2 == 3 && mosCountModules('legals')) echo classifyHeading('legals',-1);
                                ?>
                        </div>
                </div>
        </div>
        <div id="content">
                <div id="lbox2">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
                </div>
                <div id="cbox"><div id="cbox2">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
                </div></div>
                <div id="rbox2">
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php echo classifyHeading('user3', -2);?></div><?php } ?>
                </div>
        </div>
        <div id="spacer"></div>
</div>
<div id="container2">
        <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
</div>
<div id="footer_container"><div id="footer_box">
        <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
        <?php if ($topModules > 0) { ?><div id="box">
                <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
                <?php if (mosCountModules('user6')) { ?><div id="user6"><?php echo classifyHeading('user6', -2);?></div><?php } ?>
                <?php if (mosCountModules('user7')) { ?><div id="user7"><?php echo classifyHeading('user7', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div><?php } ?>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->