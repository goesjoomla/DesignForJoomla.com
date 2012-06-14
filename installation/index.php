 <?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

$iso = split( '=', _ISO );

//choose between Image or Text header
$headertype=1; 
//------>user 7
//$headertype=0 
//------>user 9

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
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<!--[if lt IE 7.]>
<style type="text/css">
#Jheader{padding-left:0}
#Jtitle{margin-left:30px}
#Jleft{margin-left:1em}
#Jright{margin-right:1.3em}
#tools{margin-right:0}
</style>
<![endif]-->
<style type="text/css">
<?php if(!mosCountModules('left') and !mosCountModules('right')){?>
#Jright{display:none;width:0}
#Jleft{width:93%}
textarea.inputbox#contact_text{width:50%}
<?php }?>
</style>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>
<body>
<center>
<div id="Jcontainer">
	<div id="toppage"><div id="toppage1"><div id="toppage2"><!-- --></div></div></div>
	<div id="border_l">	
	<div id="border_r">
	<div id="content">
	<div id="Jheader">
		<div id="Jtitle">
			<?php if($headertype==1) {
					if (mosCountModules('user7')) mosLoadModules('user7', -2);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>A short slogan here';
					}
				else
					if (mosCountModules('user9')) mosLoadModules('user9', -1);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>A short slogan here';
			?>
		</div>
		<div id="tools">
			<a href="javascript:void(0)" onclick="changeFontSize(1);">A+</a><a href="javascript:void(0)" onclick="changeFontSize(-1);">A-</a><a href="javascript:void(0)" onclick="revertStyles();">A</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0)" onclick="changeContainerWidth(774);">&gt;&lt;</a><a href="javascript:void(0)" onclick="changeContainerWidth(960);">&lt;&gt;</a><a href="javascript:void(0)" onclick="changeContainerWidth(0);">||</a>
			</div>				
	</div>
	<?php if(mosCountModules('toolbar')){?>
	<div id="nav">
		<div id="navinner">
			<?php mosLoadModules('toolbar',-1); ?>			
		</div>
	</div>
	<?php }?>
	<div class="clearer"><!-- --></div>	
	<div id="Jbody">
		<div id="Jleft">
			<div id="images">
				<?php if(mosCountModules('user8')) mosLoadModules('user8',-1); else echo '<img src="'._TEMPLATE_URL.'/images/board.jpg" alt="" />'; ?>
			</div>
		
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
	</div><!--end content-->
	</div><!--end border left-->
	<div class="clearer"><!-- --></div>
	</div><!--end border right-->	
	<div class="clearer"><!-- --></div>
	<div id="bottompage"><div id="bottompage1"><div id="bottompage2"><!-- --></div></div></div>
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

