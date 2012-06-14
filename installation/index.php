<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

// count modules for configure positions
$topModules = (mosCountModules('user8') ? 1 : 0) + (mosCountModules('user6') ? 1 : 0) + (mosCountModules('user7') ? 1 : 0);

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
<?php if (mosCountModules('newsflash')) { ?>
<?php } else { ?>
        #newsflash,#midbox{height:0;width:0;padding:0;overflow:hidden}
<?php } ?>
<?php if ((mosCountModules('top') OR mosCountModules('user3') OR mosCountModules('user4')) AND (mosCountModules('right') OR mosCountModules('user5'))){ ?>
        #content{background:url('<?php echo _TEMPLATE_URL ?>/images/content1.gif') 0 0 repeat-y}

        #lbox,#box1,#left,#bottom,#bbox,#bttop,#btbot{width:405px}
        #mainbody{width:365px}
        #bttop{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_top.gif') 0 0 no-repeat}
        #btbot{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_bottom.gif') 0 0 no-repeat}
        #bottom{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_mid.gif') 0 0 repeat-y}
        #bottom .moduletable h3{margin:0 -14px 0 -15px}

        #cbox,#top,#user3,#user4{width:277px}
        #rbox,#right,#user5{width:285px}
<?php } ?>

<?php if ((mosCountModules('top') OR mosCountModules('user3') OR mosCountModules('user4')) AND (!mosCountModules('right') AND !mosCountModules('user5'))){ ?>
        #content{background:url('<?php echo _TEMPLATE_URL ?>/images/content2.gif') 0 0 repeat-y}
        #lbox,#box1,#left,#bottom,#bbox,#bttop,#btbot{width:684px}
        #mainbody{width:644px}
        #bttop{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_top1.gif') 0 0 no-repeat}
        #btbot{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_bottom1.gif') 0 0 no-repeat}
        #bottom{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_mid1.gif') 0 0 repeat-y}
        #cbox,#top,#user3,#user4{width:277px}
        #rbox,#right,#user5{width:0px}
<?php } ?>
<?php if ((!mosCountModules('top') AND !mosCountModules('user3') AND !mosCountModules('user4')) AND (mosCountModules('right') OR mosCountModules('user5'))){ ?>
        #content{background:none}
        #lbox,#box1,#left,#bottom,#bbox,#bttop,#btbot{width:682px}
        #mainbody{width:642px}
        #bttop{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_top1.gif') 0 0 no-repeat}
        #btbot{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_bottom1.gif') 0 0 no-repeat}
        #bottom{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_mid1.gif') 0 0 repeat-y}
        #cbox,#top,#user3,#user4{width:0}
        #rbox,#right,#user5{width:285px}

<?php } ?>

<?php if ((!mosCountModules('top') AND !mosCountModules('user3') AND !mosCountModules('user4')) AND (!mosCountModules('right') AND !mosCountModules('user5'))){ ?>
        #content{background:none}
        #lbox,#box1,#left,#bottom,#bbox,#bttop,#btbot{width:968px}
        #mainbody{width:928px}
        #bttop{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_top2.gif') 0 0 no-repeat}
        #btbot{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_bottom2.gif') 0 0 no-repeat}
        #bottom{background:url('<?php echo _TEMPLATE_URL ?>/images/bt_mid2.gif') 0 0 repeat-y}
        #cbox,#top,#user3,#user4{width:0}
        #rbox,#right,#user5{width:0}

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
<?php if (mosCountModules('user9')) { ?>
<?php } else { ?>
        #user9{height:0;width:0;padding:0;overflow:hidden}
<?php } ?>
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user6,#user7,#user8{width:33.2%}
<?php } elseif ($topModules == 2) { ?>
        #user6,#user7,#user8{width:49.5%}
        #box2{background:url('<?php echo _TEMPLATE_URL ?>/images/box2_1.gif') 0 0 no-repeat}
<?php } elseif ($topModules == 1) { ?>
        #user6,#user7,#user8{width:100%}
        #box2{background:url('<?php echo _TEMPLATE_URL ?>/images/box2_2.gif') 0 0 no-repeat}
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
<div id="container"><div id="container1">
	<div id="topbox">
		<div id="logo">
			<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
		</div>
		<div id="toolbar">
			<?php if($d4j_menutype == 1 && mosCountModules('toolbar')) mosLoadModules('toolbar',-1);
			else if($d4j_menutype == 2 && mosCountModules('advert1')) mosLoadModules('advert1',-1);
			else if($d4j_menutype == 3 && mosCountModules('advert2')) mosLoadModules('advert2',-1);
			?>
		</div>
	</div>
	<div id="midbox">
		<?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php mosLoadModules('newsflash', -2);?></div><?php } ?>
	</div>
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
                    echo '<li><a href="'.$row1->link.'&amp;Itemid='.$row1->id.'">HOME</a></li>';;
                    }
                    echo '</ul>';}?>
            </div>
            <div id="menu2"><?php
                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_content%' ORDER BY ordering LIMIT 0,1");
                    $database->loadObject( $row4 );
                    if (isset($row4)) {
                    echo '<ul>';
                    if ( $row4->type == 'url' ) {
                    echo '<li><a href="'.$row4->link.'">NEWS</a></li>';
                    } else {
                    $link = ampReplace($link);
                    echo '<li><a href="'.$row4->link.'&amp;Itemid='.$row4->id.'">NEWS</a></li>';
                    }
                    echo '</ul>';}?>
            </div>
            <div id="menu3"><?php
                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_search%' ORDER BY ordering LIMIT 0,1");
                    $database->loadObject( $row3 );
                    if (isset($row3)) {
                    echo '<ul>';
                    if ( $row3->type == 'url' ) {
                    echo '<li><a href="'.$row3->link.'">SEARCH</a></li>';
                    } else {
                    $link = ampReplace($link);
                    echo '<li><a href="'.$row3->link.'&amp;Itemid='.$row3->id.'">SEARCH</a></li>';
                    }
                    echo '</ul>';}?>
            </div>
            <div id="menu4"><?php
                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
                    $database->loadObject( $row2 );
                    if (isset($row2)) {
                    echo '<ul>';
                    if ( $row2->type == 'url' ) {
                    echo '<li><a href="'.$row2->link.'">CONTACT</a></li>';
                    } else {
                    $link = ampReplace($link);
                    echo '<li><a href="'.$row2->link.'&amp;Itemid='.$row2->id.'">CONTACT</a></li>';
                    }
                    echo '</ul>';}?>
            </div>
            <div id="menu5"><?php
                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_weblinks%' ORDER BY ordering LIMIT 0,1");
                    $database->loadObject( $row5 );
                    if (isset($row5)) {
                    echo '<ul>';
                    if ( $row4->type == 'url' ) {
                    echo '<li><a href="'.$row5->link.'">LINKS</a></li>';
                    } else {
                    $link = ampReplace($link);
                    echo '<li><a href="'.$row5->link.'&amp;Itemid='.$row5->id.'">LINKS</a></li>';
                    }
                    echo '</ul>';}?>
            </div>
    </div>
	<div id="content">
		<div id="lbox">
			<?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
			<div id="box1">
				<?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
				<?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
			</div>
			<div id="mainbody"><?php mosMainbody() ?></div>
			<div id="bbox">
				<div id="bttop"></div>
					<?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
				<div id="btbot"></div>
			</div>
		</div>
		<div id="cbox">
			<?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
			<?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
			<?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
		</div>
		<div id="rbox">
			<?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
			<?php if (mosCountModules('user5')) { ?><div id="user5"><?php mosLoadModules('user5', -2);?></div><?php } ?>
		</div>
	</div>
	<?php if ($topModules > 0) { ?><div id="box2">
		<?php if (mosCountModules('user6')) { ?><div id="user6"><?php mosLoadModules('user6', -2);?></div><?php } ?>
		<?php if (mosCountModules('user7')) { ?><div id="user7"><?php mosLoadModules('user7', -2);?></div><?php } ?>
		<?php if (mosCountModules('user8')) { ?><div id="user8"><?php mosLoadModules('user8', -2);?></div><?php } ?>
		<div class="clr"><!-- --></div>
	</div><?php } ?>
	<div id="footer_container"><div id="footer_inner">
		<div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
		<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
	</div></div>
</div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->