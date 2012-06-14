<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

// count modules for configure positions
$topModules = (mosCountModules('user5') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0) + (mosCountModules('user7') ? 1 : 0);

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu

/* Image switching settings*/
$enable        = false;         // enable or not
$images        = array('header.jpg','header1.jpg','header2.jpg','header3.jpg','header4.jpg'); // name of the images
$time          = 5;                // time delay (s)

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
<script language="javascript" type="text/javascript">
var enable = <?php echo (($enable)? '1' : '0');?>;
var images = new Array("<?php $str =  join('","',$images);echo $str;?>");
var time = <?php echo $time;?>;
var _TEMPLATE_URL = "<?php echo _TEMPLATE_URL;?>";
var currentImage = 0;
function changeImage() {
        var image = document.getElementById("advert3").getElementsByTagName("IMG")[0];
        if(image != null || image != 'undefined') {
                image.src = _TEMPLATE_URL+"/images/"+images[currentImage];
        }
        /* Random */
        currentImage = parseInt(Math.random()*images.length);
        /* Sequence */
        setTimeout(changeImage,time*1000);
}
</script>
<style type="text/css">
<?php if (mosCountModules('left') OR mosCountModules('right') ) { ?>
<?php } else { ?>
        #rbox{width:0%;height:0}
        #lbox,#top,#box1,#bottom,#mainbody{width:588px}
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
<?php if (mosCountModules ('newsflash')) { ?>
<?php } else { ?>
        #midbox,#newsflash{height:0;width:0}
        #container2{background:none}
        #content{margin-top:0px}
<?php } ?>
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user6,#user7,#user5{width:33.2%}
<?php } elseif ($topModules == 2) { ?>
        #user6,#user7,#user5{width:49.5%}
<?php } elseif ($topModules == 1) { ?>
        #user6,#user7,#user5{width:100%}
<?php } elseif ($topModules == 0) { ?>
        #user6,#user7,#user5{width:0%;height:0;padding:0}
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
<div id="container1">
        <div id="topbox">
                <div id="logo">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="boxa">
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
                        <div id="advert3"><?php if (mosCountModules('advert3')) echo classifyHeading('advert3', -1);
                                else echo '<img src="'._TEMPLATE_URL.'/images/header.jpg" width="570" height="189" alt="" />';?></div>
                </div>
                <div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
                        ?>
                </div>
        </div>
        <script language="javascript" type="text/javascript">
                if(enable) changeImage();
        </script>
</div>
<div id="midbox">
        <?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php echo classifyHeading('newsflash', -2);?></div><?php } ?>
</div>
<div id="container2">
        <div id="content">
                <div id="lbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                        <div id="box1">
                                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
                        </div>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
                        <div id="spacer"></div>
                </div>
        </div>
        <div id="content1">
                <?php if ($topModules > 0) { ?><div id="box2">
                <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
                <?php if (mosCountModules('user6')) { ?><div id="user6"><?php echo classifyHeading('user6', -2);?></div><?php } ?>
                <?php if (mosCountModules('user7')) { ?><div id="user7"><?php echo classifyHeading('user7', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
                </div><?php } ?>
        </div>
</div>
<div id="footer_container">
        <div id="user9"><?php if (mosCountModules('user9')) echo classifyHeading('user9', -1); ?></div>
        <div id="footer"><?php if (mosCountModules('footer')) echo classifyHeading('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->