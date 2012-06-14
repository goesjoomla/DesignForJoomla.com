<?php /* Joomla Template by DesignForJoomla.com */

	defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
	define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
	define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

	/* Image switching settings*/
	$enable        = true;         // enable or not
	$images        = array('header_pic1.jpg','header_pic2.jpg','header_pic3.jpg','header_pic4.jpg','header_pic5.jpg'); // name of the images
	$time          = 5;                // time delay (s)

	//End Template Settings **********************************************************

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
	<?php if (mosCountModules('top') AND mosCountModules('left') AND mosCountModules('right')) { ?>
	        #top{width:490px}
	        #left{width:230px}
	        #right{width:212px}
	<?php } ?>
	<?php if (mosCountModules('top') AND !mosCountModules('left') AND mosCountModules('right')) { ?>
	        #top{width:720px}
	        #left{width:0px}
	        #right{width:212px}
	        #content1{background:none}
	        #cbox{margin-top:15px}
	        #content2{margin:15px auto 0}
	<?php } ?>
	<?php if (mosCountModules('top') AND mosCountModules('left') AND !mosCountModules('right')) { ?>
	        #top{width:730px}
	        #left{width:230px}
	        #right{width:0px}
	        #content1{background: url('<?php echo _TEMPLATE_URL ?>/images/content1.gif') 240px 0 repeat-y}
	<?php } ?>
	<?php if (!mosCountModules('top') AND mosCountModules('left') AND mosCountModules('right')) { ?>
	        #top{width:0px}
	        #left{width:730px;background:none}
	        #left .moduletable,#left .moduletable h3,#left .moduletable_special,#left .moduletable_special h3{background:none}
	        #left .moduletable_special h3,#left .moduletable h3{color:#202020}
	        #right{width:230px}
	        #content1{background: none;padding-bottom:15px}
	<?php } ?>
	<?php if (mosCountModules('top') AND !mosCountModules('left') AND !mosCountModules('right')) { ?>
	        #top{width:961px}
	        #left{width:0px}
	        #right{width:0px}
	        #content1{background:none}
	<?php } ?>
	<?php if (!mosCountModules('top') AND !mosCountModules('left') AND mosCountModules('right')) { ?>
	        #right{width:961px}
	        #right .moduletable h3{text-align:left}
	        #left{width:0px}
	        #top{width:0px}
	        #content1{background: none}
	<?php } ?>
	<?php if (!mosCountModules('top') AND !mosCountModules('left') AND !mosCountModules('right')) { ?>
	        #container2,#container3,#top,#left,#right{width:0px;height:0}
	        body{background: url('<?php echo _TEMPLATE_URL ?>/images/main_bg.gif') 0 0 repeat-x}
	        #cbox{margin-top:15px}
	        #content2{margin:15px auto 0}
	<?php } ?>
	<?php if (mosCountModules('user9')) { ?>
	        #footer_container{padding-top:20px}
	<?php } else { ?>
	        #footer_container{padding-top:10px}
	        #user9{height:0;width:0;padding:0;overflow:hidden}
	<?php } ?>
	<?php if (mosCountModules('user5') AND mosCountModules('user6')) { ?>
	        #cbox,#user5{width:230px}
	        #rbox,#user6{width:212px}
	        #lbox,#box1,#user1,#user2,#banner,#mainbody,#box2,#user3,#user4,#bottom{width:490px}
	        #mainbody{width:444px}
	<?php } elseif (mosCountModules('user5')) { ?>
	        #cbox,#user5{width:230px}
	        #rbox,#user6{width:0px}
	        #lbox,#box1,#user1,#user2,#banner,#box2,#user3,#user4,#bottom{width:730px}
	        #mainbody{width:684px}
	        #content2{background: url('<?php echo _TEMPLATE_URL ?>/images/content2.gif') 240px 0 repeat-y}
	<?php } elseif (mosCountModules('user6')) { ?>
	        #cbox,#user5{width:0px}
	        #rbox,#user6{width:212px}
	        #lbox,#box1,#user1,#user2,#banner,#box2,#user3,#user4,#bottom{width:720px}
	        #mainbody{width:674px}
	        #content2{background:none}
	<?php } else { ?>
	        #cbox,#user5,#rbox,#user6{width:0px}
	        #lbox,#box1,#user1,#user2,#banner,#box2,#user3,#user4,#bottom{width:961px}
	        #mainbody{width:915px}
	        #content2{background:none}
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
	<?php if (!mosCountModules('top') AND !mosCountModules('left') AND mosCountModules('right')) { ?>
	        #content1{padding-bottom:15px}
	<?php } ?>
	</style>
	<![endif]-->
	<!--[if gte IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
	<style type="text/css">
	<?php if (!mosCountModules('top') AND !mosCountModules('left') AND mosCountModules('right')) { ?>
	        #content1{padding-bottom:15px}
	<?php } ?>
	</style>
	<![endif]-->
	<script language="javascript" type="text/javascript">
	var enable = <?php echo (($enable)? '1' : '0');?>;
	var images = new Array("<?php $str =  join('","',$images);echo $str;?>");
	var time = <?php echo $time;?>;
	var _TEMPLATE_URL = "<?php echo _TEMPLATE_URL;?>";
	var currentImage = 0;
	function changeImage() {
	        var image = document.getElementById("advert1").getElementsByTagName("IMG")[0];
	        if(image != null || image != 'undefined') {
	                image.src = _TEMPLATE_URL+"/images/"+images[currentImage];
	        }
	        /* Random */
	        currentImage = parseInt(Math.random()*images.length);
	        /* Sequence */
	        setTimeout(changeImage,time*1000);
	}
	</script>
	</head>
	<body><center>
	<div id="container1">
	        <div id="content">
	                <div id="head">
	                        <div id="tophead">
	                                <div id="logo">
	                                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
	                                </div>
	                                <div id="header"><?php if (mosCountModules('header')) echo classifyHeading('header', -2);
	                                        else echo '<h1>Morbi in turpis Nullavulputate</h1>
	                                        <h2>Donec convallis nisl sed nequemauris vulputate leo sit Quisque consequat lacus nec nunc aenean</h2>'?>
	                                </div>
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
	                        <div id="menu3"><?php
	                                $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
	                                $database->loadObject( $row2 );
	                                if (isset($row2)) {
	                                echo '<ul>';
	                                if ( $row2->type == 'url' ) {
	                                echo '<li><a href="'.$row2->link.'">CONTACT US</a></li>';
	                                } else {
	                                $link = ampReplace($link);
	                                echo '<li><a href="'.$row2->link.'&amp;Itemid='.$row2->id.'">CONTACT US</a></li>';
	                                }
	                                echo '</ul>';}?>
	                        </div>
	                </div>
	                <div id="advert1"><?php if (mosCountModules('advert1')) echo classifyHeading('advert1', -1);
	                                else echo '<img src="'._TEMPLATE_URL.'/images/header_pic1.jpg" width="458" height="221" alt="" />';?></div>
	                <?php if (mosCountModules('toolbar')) { ?><div id="toolbar"><?php echo classifyHeading('toolbar', -1);?></div><?php } ?>
	                </div>
	                <script language="javascript" type="text/javascript">
	                if(enable) changeImage();
	                </script>
	        </div>
	</div>
	<div id="container2"><div id="container3">
	        <div id="content1">
	                <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
	                <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
	                <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
	        </div>
	</div></div>
	<div id="container4">
	        <div id="content2">
	                <div id="lbox">
	                        <?php if (mosCountModules('banner')) { ?><div id="banner"><?php echo classifyHeading('banner', -2);?></div><?php } ?>
	                        <div id="box1">
	                                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
	                                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
	                        </div>
	                        <div id="mainbody"><?php mosMainbody() ?></div>
	                        <div id="box2">
	                                <?php if (mosCountModules('user3')) { ?><div id="user3"><?php echo classifyHeading('user3', -2);?></div><?php } ?>
	                                <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
	                        </div>
	                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
	                </div>
	                <div id="cbox">
	                        <?php if (mosCountModules('user5')) { ?><div id="user5"><?php echo classifyHeading('user5', -2);?></div><?php } ?>
	                </div>
	                <div id="rbox">
	                        <?php if (mosCountModules('user6')) { ?><div id="user6"><?php echo classifyHeading('user6', -2);?></div><?php } ?>
	                </div>
	        </div>
	</div>
	<div id="footer_container">
	        <div id="user9"><?php if (mosCountModules('user9')) echo classifyHeading('user9', -1); ?></div>
	        <div id="footer"><?php if (mosCountModules('footer')) echo classifyHeading('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
	</div>
	</center>
	<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
	</html><!-- Joomla Template by DesignForJoomla.com -->