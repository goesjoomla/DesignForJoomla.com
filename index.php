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
		#user2 div.moduletable{padding-left:4px}
	<?php } ?>
	</style>
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css_ie.css" />
	<![endif]-->
</head>

<body><center>
	<div id="farouter">
		<div id="sleft">
			<div id="logo">
				<h1 title="<?php echo $mosConfig_sitename ?>"><a href="<?php echo $mosConfig_live_site ?>" title="<?php echo $mosConfig_sitename ?>"><?php echo $mosConfig_sitename ?></a></h1>
			</div>
			<?php if (mosCountModules ('left')) { ?><div id="mleft"><?php mosLoadModules('left', -2) ?></div><?php } ?>
		</div>

		<div id="container">
			<div id="slogan"><?php if (mosCountModules('header')) mosLoadModules('header', -2); else {
				echo '<div class="moduletable"><h3 title="'.$mosConfig_sitename.'">'.$mosConfig_sitename.'</h3>to <b>place</b> for <em>your slogan ...</em></div>';
			} ?></div>
			<div id="main">
				<?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2) ?></div><?php } ?>
				<?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2) ?></div><?php } ?>
				<?php if (mosCountModules('user1') OR mosCountModules('user2')) { ?><br class="clr" /><?php } ?>
				<?php mosMainbody() ?>
    			<?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2) ?></div><?php } ?>
			</div>
		</div>

		<?php if (mosCountModules('right')) { ?><div id="sright"><div id="mright"><?php mosLoadModules('right', -2) ?></div></div><?php } ?>
		<div class="clr"> <!-- --> </div>

		<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -2); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
	</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->