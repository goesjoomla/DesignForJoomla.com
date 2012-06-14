<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php if ($my->id) initEditor() ?>
	<?php mosShowHead() ?>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
	<style type="text/css">
	<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
		#user1{float:left;width:50%}
		#user2{float:none;margin-left:50%}
		#user1 div.moduletable{padding-right:5px}
		#user2 div.moduletable{padding-left:5px}
	<?php } ?>
	<?php if (mosCountModules('left') OR mosCountModules('right')) { ?>
		#main{width:579px;border:none;border-top:1px solid #fff}
		#body{width:769px;border-right:1px solid #fff;background:url(<?php echo _TEMPLATE_URL ?>/images/bg.gif) left top repeat-y}
		#footer{background:url(<?php echo _TEMPLATE_URL ?>/images/footer_bg.gif) left top no-repeat}
		<?php } ?>
	</style>
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css_ie.css" />
	<style type="text/css">
	<?php if (mosCountModules('left') OR mosCountModules('right')) { ?>
		#main{width:578px}
		#footer{width:769px}
	<?php } else { ?>
		#body{margin-top:-14px}
	<?php } ?>
	</style>
		<![endif]-->
</head>

<body><center>
	<div id="container">
		<div id="header">
			<div id="user8"><?php
			if (mosCountModules('user8')) mosLoadModules('user8', -1);
			else echo '<img src="'._TEMPLATE_URL.'/images/0_lion.gif"></img>';?>
			</div>
			<div id="logo">
				<h1 title="<?php echo $mosConfig_sitename ?>"><a href="<?php echo $mosConfig_live_site ?>" title="<?php echo $mosConfig_sitename ?>"><?php echo $mosConfig_sitename ?></a></h1>
			</div>
			<div id="slogan"><?php if (mosCountModules('header')) mosLoadModules('header', -2); else {
				echo '<div class="moduletable"><h3 title="'.$mosConfig_sitename.'">'.$mosConfig_sitename.'</h3>to <b>place</b> for <em>your slogan ...</em></div>';} ?>
			</div>
		</div>
		<div class="clr"> <!-- --> </div>

		<div id="body">
			<div id="left">
				<?php if (mosCountModules ('left')) { ?><div id="left1"><?php mosLoadModules('left', -2) ?></div><?php } ?>
				<?php if (mosCountModules ('right')) { ?><div id="right"><?php echo '<hr/>'; mosLoadModules('right', -2) ?></div><?php } ?>
			</div>
			<div id="main">
				<div id="inner_main">
					<?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2) ?></div><?php } ?>
					<?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2) ?></div><?php } ?>
					<?php if (mosCountModules('user1') OR mosCountModules('user2')) { ?><br class="clr" /><?php } ?>
					<?php if (mosCountModules('advert1')) { ?><div id="advert1"><?php mosLoadModules('advert1', -2); echo '<hr/>' ?></div><?php } ?>
					<?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2); echo '<hr/>' ?></div><?php } ?>
					<?php mosMainbody() ?><div class="clr"><!-- --></div>
    				<?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo '<hr/>'; mosLoadModules('bottom', -2) ?></div><?php } ?>
    				<?php if (mosCountModules('advert2')) { ?><div id="advert2"><?php echo '<hr/>'; mosLoadModules('advert2', -2) ?></div><?php } ?>
    			</div>
			</div>
			<div class="clr"> <!-- --> </div>
		</div>

		<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
	</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->
