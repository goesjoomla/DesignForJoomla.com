<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS
$site_tools_width = 1; // 0:disable all , 1:enable for width changer SITE TOOLS

//End Template Settings **********************************************************

define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );
$iso = split( '=', _ISO );

/* 
	Image switching settings 
*/
$changing_type = 'random';// random,sequence
$enable 	= true; 	// enable or not
$images		= array('header.jpg'); // name of the images
$time 		= 3;		// time delay (s)

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
<?php if (!mosCountModules('left') and !mosCountModules('right')) { ?>
#D4J_Container_In2{background:none}
<?php }?>
</style>
<!--[if IE ]>
<style type="text/css">
#D4J_Title h1{font-size:2em}
</style>
<![endif]-->
<!--[if lt IE 7.]>
<style type="text/css">
html,body{height:100%;overflow:auto}
html{overflow:hidden}
#sitetools{position:absolute;right:30px}
#tools{position:absolute;right:30px}
#D4J_Container_Out{margin-top:0}
#D4J_Header{margin-left:33px;width:629px}
<?php if (!mosCountModules('left') and !mosCountModules('right')) { ?>
#D4J_Left{margin-top:-20px}
<?php }?>
</style>
<![endif]-->


<?php if($site_tools) {
	include_once(_TEMPLATE_PATH."/func/style/d4j_sitetools.php");
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
<?php }?>
<script type="text/javascript" language="JavaScript">
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
<?php if (!mosCountModules('left') and !mosCountModules('right')) { ?>
		var _noRightCol = true;
<?php } else { ?>
		var _noRightCol = false;
<?php } ?>
</script>
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php"); ?>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/d4jCommonInclude.compact.js">
</script>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/style/d4j_stylechanger.js">
</script>
<script language="javascript">
var changing_type = "<?php echo $changing_type;?>";
var enable = <?php echo (($enable)? '1' : '0');?>;
var images = new Array("<?php $str =  join('","',$images);echo $str;?>");
var time = <?php echo $time;?>;

var _TEMPLATE_URL = "<?php echo _TEMPLATE_URL;?>";
var currentImage = 0;

function changeImage() {
	var image = document.getElementById("D4J_Banner").getElementsByTagName("IMG")[0];
	if(image != null || image != 'undefined') {
		image.src = _TEMPLATE_URL+"/images/"+images[currentImage];	
		if(changing_type == 'random') {
			currentImage = parseInt(Math.random()*images.length);
		} else if(changing_type == 'sequence') {
			if(currentImage < images.length - 1) currentImage++;	
				else currentImage = 0;
		}		
		setTimeout(changeImage,time*1000);
	}
}
</script>
</head>
<body>
<center>
<div id="D4J_Container_Out">
<div id="D4J_Container_In">
<div id="D4J_Container_In2">
	<div id="D4J_Header">
		<div id="D4J_Title" onmouseover="this.style.background='#688B00';" onmouseout="this.style.background='#567300';">
			<?php if(mosCountModules('user7')) mosLoadModules('user7',-2); else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>';?>
		</div>
		<div id="D4J_Banner">
			<?php if(mosCountModules('user9')) mosLoadModules('user9',-1); else echo'<center><img id="bigimage" height="180px" src="'._TEMPLATE_URL.'/images/header.jpg" alt=""/></center>';?>
		</div>		
	</div>
	<div id="D4J_Body">		
		<div id="D4J_Right">
			<?php if(mosCountModules('left')) mosLoadModules('left',-2);?>
			<?php if(mosCountModules('right')) mosLoadModules('right',-2);?>
		</div>
		<div id="D4J_Left">
			<?php if(mosCountModules('top')){?>			
			<div id="top">
				 <?php mosLoadModules('top',-2);?>
			</div>
			<?php }?>
			<div id="main">
				<?php mosMainBody();?>
			</div>
			<?php if(mosCountModules('bottom')){?>			
			<div id="bottom">
				 <?php mosLoadModules('bottom',-2);?>
			</div>
			<?php }?>
		</div>		
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_Footer">
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
<?php if($site_tools){?>		
	<div id="sitetools" style="">
		<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools.gif" alt="" onmouseover="document.getElementById('tools').style.display='block'" onmouseout="document.getElementById('tools').style.display='none'"/>		
	</div>
	<div id="tools" onmouseover="this.style.display='block'" onmouseout="this.style.display='none'" style="display:none;width:auto;height:auto;background:url(<?php echo _TEMPLATE_URL; ?>/images/blank.gif) repeat">			
		<?php writeTools();?>
	</div>
<?php }?>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
<script language="javascript">
if(enable) changeImage();
</script>
</body>
</html><!-- Joomla Template by DesignForJoomla.com -->