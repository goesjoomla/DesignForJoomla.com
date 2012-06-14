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
	<?php if(!mosCountModules('left') or !mosCountModules('right')){?>
		#center{width:534px}
	<?php } ;if(!mosCountModules('left') and !mosCountModules('right')){?>
		#center{width:690px}
<?php }?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">
	body,form,div,p,table,td,tr{font-size:10px}
	#left{margin-left:5px}
	<?php if(!mosCountModules('left') and mosCountModules('right')){?>
		#center{margin-left:5px}
	<?php };if(!mosCountModules('left') and !mosCountModules('right')){?>
	#center{margin-left:5px}
	<?php }?>
</style>
<![endif]-->

</head>
<body>
<center>
<div id="container">
	<div id="header">
		<div id="title">
		<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>A short slogan goes here'?>
		</div>
	</div>
	<div id="body">
		<?php if(mosCountModules('left')){?>
		<div id="left">
			<?php mosLoadModules('left',-2)?>
		</div>
	    <?php }?>
		<div id="center">
			<?php if(mosCountModules('top')){?>
			<div id="top">
				<?php mosLoadModules('top',-2)?>
			</div>
			<?php }?>
			<div id="main">
				<?php mosMainBody()?>
			</div>
			<?php if(mosCountModules('bottom')){?>
			<div id="bottom">
				<?php mosLoadModules('bottom',-2)?>
			</div>
			<?php }?>
	    </div>
		<?php if(mosCountModules('right')){?>
		<div id="right">
			<?php mosLoadModules('right',-3)?>
		</div>	
		<?php }?>	
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
