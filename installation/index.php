<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu

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

<?php if (mosCountModules ('user4') OR mosCountModules ('right')) { ?>
<?php } else { ?>
	#lbox,#left,#box1,#top,#bottom,#main{width:749px}
	#mainbody{width:687px}
	#rbox,#user4,#right{width:0;margin:0;height:0}
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
<div id="container1"><div id="container11">
	<div id="topbox">
		<div id="logo">
			<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
		</div>
		<div id="user7"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
			else echo '<h1>Lorem ipsum dolorsit</h1><h2>nunc. Lorem ipsum</h2>'?>
		</div>
	</div>
</div></div>
<div id="container2"><div id="container21">
	<div id="box"><div id="toolbar">
		<?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
			else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
			else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
		?>
	</div></div>
	<?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php echo classifyHeading('newsflash', -2);?></div><?php } ?>
	<div id="user3"><?php
		if (mosCountModules('user3')) mosLoadModules('user3', -1);
		else echo '<img src="'._TEMPLATE_URL.'/images/image1.jpg" width="193" height="112" alt="" />';
	?></div>
</div></div>
<div id="container3"><div id="container31">
	<div id="content">
		<div id="lbox">
			<?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
			<div id="box1">
				<?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
				<?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
			</div>
			<div id="main">
				<?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
				<div id="mainbody"><?php mosMainbody() ?></div>
				<?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
			</div>
		</div>
		<div id="rbox">
			<?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
			<?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
		</div>
	</div>
</div></div>
<div id="footer_container">
	<div id="footer_box">
		<div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
		<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
	</div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->