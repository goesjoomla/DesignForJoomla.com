<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

$iso = split( '=', _ISO );
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
<style type="text/css">
<?php if(!mosCountModules('left') and !mosCountModules('right')) {?>
	#left{display:none}
	#right{width:765px}
	#top .module div,#bottom .module div,#main div{background:#FFFFFF url(<?php echo _TEMPLATE_URL ?>/images/content_mid_l.gif) repeat-y center}
	#top .module div div,#bottom .module div div,#main div div{background:url(<?php echo _TEMPLATE_URL ?>/images/content_btm_l.gif) no-repeat bottom center}
	#top .module div div div,#bottom .module div div div,#main div div div{background:url(<?php echo _TEMPLATE_URL ?>/images/content_top_l.gif) no-repeat top center}
<?php } else {?>
	#top .module div,#bottom .module div,#main div{background:#FFFFFF url(<?php echo _TEMPLATE_URL ?>/images/content_mid.gif) repeat-y center}
	#top .module div div,#bottom .module div div,#main div div{background:url(<?php echo _TEMPLATE_URL ?>/images/content_btm.gif) no-repeat bottom center}
	#top .module div div div,#bottom .module div div div,#main div div div{background:url(<?php echo _TEMPLATE_URL ?>/images/content_top.gif) no-repeat top center}
<?php } ?>
</style>
</head>
<body>
<center>
<div id="container">
	<div id="header">
		<div id="title">
		<?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>'?>						
		</div>
		<div id="user">
		<?php if (mosCountModules('user8')) mosLoadModules('user8', -1);?>
		</div>
	</div>
	<div id="body">
		<div id="left">
			<div id="left_head"></div>
				<?php if(mosCountModules('left')){?>
				<div id="left_top">
					<?php mosLoadModules('left',-2)?>
				</div>
				<?php }?>	
				<?php if(mosCountModules('right')){?>
				<div id="left_bottom">
					<?php mosLoadModules('right',-2)?>
				</div>
				<?php }?>
			<div id="left_foot"></div>
		</div>
		<div id="right">				
		<?php if(mosCountModules('top')){?>
			<div id="top">
				<?php mosLoadModules('top',-3)?>
			</div>
		<?php }?>
			<div id="main">
				<div>
					<div>
						<div>
							<?php mosMainBody()?>
						</div>
					</div>
				</div>				
			</div>
		<?php if(mosCountModules('bottom')){?>
			<div id="bottom">
				<?php mosLoadModules('bottom',-3)?>
			</div>
		<?php }?>
		</div>
		<div class="clearer"></div>
	</div>	
	<div id="footer">
		<?php if (mosCountModules('footer')) {?>
		<div class="copyright">
			<?php mosLoadModules('footer', -1);?>
		</div>
		<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
	</div>
</div>
</center> 
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
</body>
</html>