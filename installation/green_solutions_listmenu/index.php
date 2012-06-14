<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype = 2; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu

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
<?php if (mosCountModules ('user4') OR mosCountModules ('right') OR mosCountModules ('left')) { ?>
<?php } else { ?>
        #lbox,#right,#user4,#left{width:0px;margin:0;height:0}
        #rbox{width:748px}
        #rbox,#top,#bottom,#user6,#spacer1,#spacer2{margin:0 0 0 8px;width:756px}
        #rbox{background: url('<?php echo _TEMPLATE_URL ?>/images/right-bg1.gif') top left repeat-y}
        #top,#bottom,#user6,#spacer1,#spacer2{margin:0}
        #mainbody{width:576px}
        .readon{width:94%}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
        #footer{margin-top:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('user4') OR mosCountModules ('right') OR mosCountModules ('left')) { ?>
<?php } else { ?>
        #rbox,#top,#bottom,#user6,#spacer1,#spacer2{margin:0 0 0 4px}
        #top,#bottom,#user6,#spacer1,#spacer2{margin:0}
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
        <div id="topbox1">
                <div id="logo">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
                        ?>
                </div>
        </div>
        <div id="topbox2">
                <div id="menuhack">
                        <div id="menu1"><?php
                                $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,1");
                                $database->loadObject( $row1 );
                                if (isset($row1)) {
                                echo '<ul>';
                                if ( $row1->type == 'url' ) {
                                echo '<li><a href="'.$row1->link.'">OUR BLOG <br/><span>Desktop publishing</span></a></li>';
                                } else {
                                $link = ampReplace($link);
                                echo '<li><a href="'.$row1->link.'&amp;Itemid='.$row1->id.'">OUR BLOG <br/><span>Desktop publishing</span></a></li>';;
                                }
                                echo '</ul>';}?>
                        </div>
                        <div id="menu2"><?php
                                $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_search%' ORDER BY ordering LIMIT 0,1");
                                $database->loadObject( $row3 );
                                if (isset($row3)) {
                                echo '<ul>';
                                if ( $row3->type == 'url' ) {
                                echo '<li><a href="'.$row3->link.'">POSSIBILITIES <br/><span>Desktop publishing</span></a></li>';
                                } else {
                                $link = ampReplace($link);
                                echo '<li><a href="'.$row3->link.'&amp;Itemid='.$row3->id.'">POSSIBILITIES <br/><span>Desktop publishing</span></a></li>';
                                }
                                echo '</ul>';}?>
                        </div>
                        <div id="menu3"><?php
                                $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
                                $database->loadObject( $row2 );
                                if (isset($row2)) {
                                echo '<ul>';
                                if ( $row2->type == 'url' ) {
                                echo '<li><a href="'.$row2->link.'">SOLUTIONS <br/><span>Desktop publishing</span></a></li>';
                                } else {
                                $link = ampReplace($link);
                                echo '<li><a href="'.$row2->link.'&amp;Itemid='.$row2->id.'">SOLUTIONS <br/><span>Desktop publishing</span></a></li>';
                                }
                                echo '</ul>';}?>
                        </div>
                </div>
                <div id="advert3"><?php
                        if (mosCountModules('advert3')) mosLoadModules('advert3', -1);
                        else echo '<img src="'._TEMPLATE_URL.'/images/header-img.jpg" width="525" height="236" alt="" />';
                        ?></div>

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
                        <?php if (mosCountModules('user6')) { ?><div id="user6"><?php echo classifyHeading('user6', -2);?></div><?php } ?>
                        <div id="spacer2"></div>
                </div>
        </div>
        <div id="footer_box">
                <div id="spacer3"></div>
                <div id="box1">
                <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
                <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
                </div>
        </div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->