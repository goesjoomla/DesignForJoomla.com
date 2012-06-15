<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFontSize|changeContainerWidth)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

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
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<?php if(!mosCountModules('left') and !mosCountModules('right')){?>
#Jright{display:none;width:0}
#Jleft{width:97%}
#content{background:#FFFFFF}
<?php }?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">
#Jleft{margin-left:5px}
#Jright{margin-right:5px}
</style>
<![endif]-->
<script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
<?php if (!mosCountModules('left') and !mosCountModules('right')) { ?>
		var _noRightCol = true;
<?php } else { ?>
		var _noRightCol = false;
<?php } ?>
// ]]></script>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>
<body>
<center>
<div id="Jcontainer">
	<div id="border">	
	<div id="content">
	<div id="Jheader">
		<div id="Jtitle">
			<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>'?>
		</div>
		<div id="flower">
			<div id="tools">
			<a href="javascript:void(0)" title="Increase font size" onclick="changeFontSize(1);return false;">A+</a>
			<a href="javascript:void(0)" title="Decrease font size" onclick="changeFontSize(-1);return false;">A-</a>
			<a href="javascript:void(0)" title="Revert font size to default" onclick="revertStyles(); return false;">A</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0)" title="View in 800x600 screen resolution" onclick="changeContainerWidth(761);return false;">&gt;&lt;</a>
			<a href="javascript:void(0)" title="View in 1024x768 screen resolution" onclick="changeContainerWidth(960);return false;">&lt;&gt;</a>
			<a href="javascript:void(0)" title="Auto fit in browser window" onclick="changeContainerWidth(0); return false;">||</a>
			</div>	
		</div>
	</div>	
	<div id="Jbody">
		<div id="Jleft">
		<?php if(mosCountModules('top')) mosLoadModules('top',-2);?>
			<div id="main">
				<?php mosMainBody()?>				
			</div>
		<?php if(mosCountModules('bottom')) mosLoadModules('bottom',-2);?>
		</div>
		<div id="Jright">
		<?php 
			if(mosCountModules('left')) mosLoadModules('left',-2);
			if(mosCountModules('right'))mosLoadModules('right',-2);
		?>
		</div>	
	</div>
	<div class="clearer"><!-- --></div>
	<div id="footer">
		<?php if (mosCountModules('footer')) {?>
		<div class="copyright">
			<?php mosLoadModules('footer', -1);?>
		</div>
		<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
	</div>
	</div>		
		<div class="clearer"><!-- --></div>
	</div>	
	<div class="clearer"><!-- --></div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
</body>
</html>

