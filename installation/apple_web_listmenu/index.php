<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype = 2; // 1: default joomla menu; 2: d4j_list_menu

// count modules for configure positions
$topModules = (mosCountModules('user4') ? 1 : 0) + (mosCountModules('user5') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0);

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
<?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (mosCountModules('user2') OR mosCountModules('newsflash') OR mosCountModules('advert2')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (mosCountModules('user2') OR mosCountModules('newsflash') OR mosCountModules('advert2')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
        #lbox,#user1,#left{width:0px;margin:0;height:0}
        #user2,#newsflash{width:335px}
        #advert2{width:290px}
        #cbox{width:363px}
        #rbox,#user3,#right{width:335px}
<?php } ?>
<?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (!mosCountModules('user2') AND !mosCountModules('newsflash') AND !mosCountModules('advert2')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
        #user1,#left{width:335px}
        #lbox{width:360px}
        #user2,#newsflash,#advert2,#cbox{width:0px;height:0px;margin:0}
        #rbox,#user3,#right{width:335px}
<?php } ?>
<?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (mosCountModules('user2') OR mosCountModules('newsflash') OR mosCountModules('advert2')) AND (!mosCountModules('right') AND !mosCountModules('user3'))) { ?>
        #user1,#left{width:330px}
        #lbox{width:355px}
        #user2,#newsflash{width:325px}
        #advert2{width:290px}
        #cbox{width:343px}
        #rbox,#user3,#right{width:0;height:0}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (!mosCountModules('user2') AND !mosCountModules('newsflash') AND !mosCountModules('advert2')) AND (mosCountModules('right') OR mosCountModules('user3'))) { ?>
        #lbox,#user1,#left{width:0px;margin:0;height:0}
        #user2,#newsflash,#advert2,#cbox{width:0px;height:0px;margin:0}
        #rbox,#user3,#right{width:724px}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (mosCountModules('user2') OR mosCountModules('newsflash') OR mosCountModules('advert2')) AND (!mosCountModules('right') AND !mosCountModules('user3'))) { ?>
        #lbox,#user1,#left{width:0px;margin:0;height:0}
        #rbox,#user3,#right{width:0;height:0}
        #user2,#newsflash,#cbox{width:724px}
        #advert2{width:700px}
<?php } ?>
<?php if ((mosCountModules('left') OR mosCountModules('user1')) AND (!mosCountModules('user2') AND !mosCountModules('newsflash') AND !mosCountModules('advert2')) AND (!mosCountModules('right') AND !mosCountModules('user3'))) { ?>
        #rbox,#user3,#right{width:0;height:0}
        #user2,#newsflash,#advert2,#cbox{width:0px;height:0px;margin:0}
        #lbox,#user1,#left{width:724px}
<?php } ?>
<?php if ((!mosCountModules('left') AND !mosCountModules('user1')) AND (!mosCountModules('user2') AND !mosCountModules('newsflash') AND !mosCountModules('advert2')) AND (!mosCountModules('right') AND !mosCountModules('user3'))) { ?>
        #rbox,#user3,#right,#user2,#newsflash,#advert2,#cbox,#topbox3,#lbox,#user1,#left{width:0px;height:0px;margin:0;padding:0}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:auto}
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
        #footer_container{padding-top:15px}
<?php } ?>
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user6,#user4,#user5{width:33%}
<?php } elseif ($topModules == 2) { ?>
        #user6,#user4,#user5{width:49%;text-align:center}
<?php } elseif ($topModules == 1) { ?>
        #user6,#user4,#user5{width:100%;text-align:center}
        #box .moduletable{border:none}
<?php } elseif ($topModules == 0) { ?>
        #user6,#user4,#user5{width:0%;height:0;padding:0}
        #box{border:none;width:0;height:0}
        #footer_container{padding-top:25px}
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
        <div id="topbox1">
                <div id="box1"><div id="menuhack">
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
                <div id="advert3"><?php if (mosCountModules('advert3')) mosLoadModules('advert3', -2); else
                     echo '<h1>800-121-4545</h1><h2>759-121-5454</h2>';?>
                </div>
                </div>
                <div id="logo">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        ?>
                </div>
        </div>
        <div id="topbox2">
                <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                <div id="mainbody"><?php mosMainbody() ?></div>
                <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
        </div>
        <div id="topbox3">
                <div id="lbox">
                        <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                </div>
                <div id="cbox">
                        <?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
                        <?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php echo classifyHeading('newsflash', -2);?></div><?php } ?>
                        <?php if (mosCountModules('advert2')) { ?><div id="advert2"><?php echo classifyHeading('advert2', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php echo classifyHeading('user3', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
                </div>
        </div>
</div>
<div id="footer_container"><div id="footer_box">
        <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
        <?php if ($topModules > 0) { ?><div id="box">
                <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
                <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
                <?php if (mosCountModules('user6')) { ?><div id="user6"><?php echo classifyHeading('user6', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div><?php } ?>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->