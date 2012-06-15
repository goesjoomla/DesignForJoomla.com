<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
$header_flash = "/templates/".$mainframe->getTemplate()."/header.swf";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if( $my->id ) {
	initEditor();
}
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/templates/<?php echo $mainframe->getTemplate(); ?>/swfobject.js"></script>
<style type="text/css">
<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
		#user1{float:left;width:254px;}
		#user2{float:right;width:248px;}
<?php } ?>
</style>
</head>
<body>
<center>
	<div id="container">
		<div id="left_column">
			<div id="left_top">
				<?php if (mosCountModules('user8') == 0){ ?>
					<div id="logo">
						<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
					</div>
				<?php } else {
				mosLoadModules('user8');
				 } ?>
			</div>
			<div id="left">
				<? mosLoadModules('left', -2); ?>
			</div>
		</div>
		<div id="right_column">
			<div id="header">
				<img src="templates/warm_christmas/images/header_image.jpg" width="549" height="185" alt=""/>
			</div>
			<script type="text/javascript">
		// <![CDATA[

		var so = new SWFObject("<?php echo $mosConfig_live_site.$header_flash; ?>", "header_flash", "549", "185", "8", "#FFFFFF");
		so.write("header");

		// ]]>
			</script>
			<div id="right_main">
				<div class="clr"></div>
				<div id="pathway">
					<div class="path">
						<?php mosPathWay(); ?>
					</div>
				</div>
				<div id="body">
					<?php mosMainBody(); ?>
				</div>
				<?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2) ?></div><?php } ?>
				<?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2) ?></div><?php } ?>
				<?php if (mosCountModules('user1') OR mosCountModules('user2')) { ?><div class="clr"></div><?php } ?>
				<div id="banner">
					<?php mosLoadModules('banner'); ?>
				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div id="footer">
		<?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?>
	</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
</body>
</html>