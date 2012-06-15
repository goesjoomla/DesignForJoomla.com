<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $template_font;

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS
$site_tools_width = 0; // 0:disable all , 1:enable for width changer SITE TOOLS

$validate = 1; // Show or Hide validate buttons ( 1: show; 0: hide)

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu
//End Template Settings **********************************************************

define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/trialservices' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/trialservices');
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
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu.css" />
	
<?php if($site_tools) {
	include_once(_TEMPLATE_PATH."/func/style/d4j_sitetools.php");
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
<?php }?>
<script type="text/javascript" language="JavaScript">
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
</script>
<?php
	$topusers = 0;
	if(mosCountModules('user1')) { $user1 = 1; $topusers++;}
	if(mosCountModules('user2')) { $user2 = 1; $topusers++;}
	if(mosCountModules('user3')) { $user3 = 1; $topusers++;}	
		
	
	$bottomusers = 0;
	if(mosCountModules('user4')) { $user4 = 1; $bottomusers++;}
	if(mosCountModules('user5')) { $user5 = 1; $bottomusers++;}
	if(mosCountModules('user6')) { $user6 = 1; $bottomusers++;}	
	
	if(mosCountModules('user7')) { $user7 = 1;}
	if(mosCountModules('user8')) { $user8 = 1;}
	if(mosCountModules('user9')) { $user9 = 1;}
	
	if(!mosCountModules('right')) $right = 0; else $right = 1;
	if(!mosCountModules('left')) $left = 0; else $left = 1;	
	
	if(mosCountModules('newsflash')) { $newsflash = 1; }
	
	if(!$right && !$left) $right_side = 0; else $right_side = 1;
?>

<style type="text/css">
<?php if($bottomusers > 0){?>
#D4J_User4,#D4J_User5,#D4J_User6{width:<?php echo 738/$bottomusers;?>px}
<?php }?>

</style>
<!--[if IE ]>
<style type="text/css">

</style>
<![endif]-->
<!--[if lt IE 7.]>
<style type="text/css">
#D4J_Sitetools{right:auto;bottom:auto;position:absolute;
left: expression((-10 - D4J_Sitetools.offsetWidth + (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) ) + 'px');
top: expression((-5 - D4J_Sitetools.offsetHeight + (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe2 = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) ) + 'px');

}

#D4J_Tools{position:absolute;right:12px;bottom:23px}

#D4J_MainMenu ul{float:right}
#D4J_MainMenu .transMenu .items .item td{
	border-bottom:1px solid #ccc
}
</style>
<![endif]-->
<style type="text/css">
<?php if(!$right_side){?>
#D4J_LeftSide{width:100%}
#D4J_Top .moduletable{background:url(<?php echo _TEMPLATE_URL;?>/images/testimonial-bg2.gif) 0 50px  no-repeat;width:573px}
<?php }?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">

</style>
<![endif]-->
</head>
<body class="<?php echo 'font'.$template_font;?>">
<center>
<div id="D4J_Container">
	<div id="D4J_Header">
		<div id="D4J_Logo">
			<?php echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'"><img src="'._TEMPLATE_URL.'/images/logo.gif" alt=""/></a></h1>';?>
		</div>
		<div id="D4J_MainMenu">
			<?php if($d4j_menutype == 1 && mosCountModules('toolbar')) mosLoadModules('toolbar',-1);
				else if($d4j_menutype == 2 && mosCountModules('advert1')) mosLoadModules('advert1',-1);
				else if($d4j_menutype == 3 && mosCountModules('advert2')) mosLoadModules('advert2',-1);
			?>
		</div>
		
		<div class="clearer"><!-- --></div>
	</div>
	
	<?php if($topusers > 0) {?>
	<div id="D4J_TopUsers">
		<?php if($user1) {?>
		<div id="D4J_User1">
			<?php mosLoadModules('user1',-2);?>
			<a href="#" class="disable">
			</a>
		</div>
		<?php }?>
		<?php if($user2) {?>
		<div id="D4J_User2">
			<?php mosLoadModules('user2',-2);?>
			<a href="#" class="disable">
			</a>
		</div>
		<?php }?>
		<?php if($user3) {?>
		<div id="D4J_User3">
			<?php mosLoadModules('user3',-2);?>
			<a href="#" class="disable">
			</a>
		</div>
		<?php }?>
		<div class="clearer"></div>
	</div>
	<?php }?>
	<?php if($user9) {?>
	<div id="D4J_AboutUs">
		<?php mosLoadModules('user9',-2);?>
		<br/><br/><br/><br/>
	</div>
	<?php }?>
	<div class="clearer"><!-- --></div>
	<?php if($newsflash) {?>
	<div id="D4J_News">
		<?php mosLoadModules('newsflash',-2);?>
	</div>
	<?php }?>
	<div class="clearer"><!-- --></div>
	<div id="D4J_MainBody">
		<div id="D4J_LeftSide">
			<?php if(mosCountModules('top')) {?>
			<div id="D4J_Top">
				<?php mosLoadModules('top',-2); ?>
			</div>
			<?php }?>
			<?php if(mosCountModules('banner')) {?>
			<div id="D4J_Banner">
				<?php mosLoadModules('banner',-1); ?>
			</div>
			<?php }?>
			<div id="D4J_Main">
				<?php mosMainBody();?>
			</div>
			<?php if(mosCountModules('bottom')) {?>
			<div id="D4J_Bottom">
				<?php mosLoadModules('bottom',-2); ?>
			</div>
			<?php }?>
		</div>
		<?php if($right_side){?>
		<div id="D4J_RightSide">
			<?php if($left){?>
			<div id="D4J_Left">
				<?php mosLoadModules('left',-2);?>
			</div>
			<?php }?>
			<?php if($right){?>
			<div id="D4J_Right">
				<?php mosLoadModules('right',-2);?>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<div class="clearer"><!-- --></div>
	</div>
	<div class="clearer"><!-- --></div>
	<?php if($bottomusers > 0) {?>
	<div id="D4J_BottomUsers">
		<?php if($user4){?>
		<div id="D4J_User4">
			<?php mosLoadModules('user4',-2);?>
		</div>
		<?php }?>
		<?php if($user5){?>
		<div id="D4J_User5">
			<?php mosLoadModules('user5',-2);?>
		</div>
		<?php }?>
		<?php if($user6){?>
		<div id="D4J_User6">
			<?php mosLoadModules('user6',-2);?>
		</div>
		<?php }?>
		<div class="clearer"><!-- --></div>
	</div>
	<?php }?>
	<div id="D4J_BottomPage">
		<div id="D4J_Validate">
			<?php if($validate){?>
			<a href="http://validator.w3.org/check?uri=referer" title="Valid XHTML" target="_blank" id="valid_html"> XHTML</a><a title="Valid CSS" target="_blank" href="http://jigsaw.w3.org/css-validator/" id="valid_css">CSS</a><a target="_blank" title="Accessibility 508" href="http://www.contentquality.com/mynewtester/cynthia.exe" id="valid_508">508</a>
			<?php }?>
		</div>
		<div id="D4J_RightBottomPage">
			<?php if($user7){?>
			<div id="D4J_FooterMenu">
				<?php mosLoadModules('user7',-1);?>
			</div>
			<?php }?>
			<?php if (mosCountModules('footer')) {?>
			<div class="copyright">
				<?php mosLoadModules('footer', -1);?>
			</div>
			<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
			<div class="clearer"><!-- --></div>
		</div>
		<div class="clearer"><!-- --></div>
	</div>
</div>
</center>
<?php if($site_tools){?>		
	<div id="D4J_Sitetools" style="">
		<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools.gif" alt="" onmouseover="document.getElementById('D4J_Tools').style.display='block'" onmouseout="document.getElementById('D4J_Tools').style.display='none'"/>		
	</div>
	<div id="D4J_Tools" onmouseover="this.style.display='block'" onmouseout="this.style.display='none'" style="display:none;width:auto;height:auto;background:url(<?php echo _TEMPLATE_URL; ?>/images/blank.gif) repeat">			
		<?php writeTools();?>
	</div>
<?php }?>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
<?php if($site_tools){?>	
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/style/d4j_stylechanger.js">
</script>
<?php }?>
</body>
</html><!-- Joomla Template by DesignForJoomla.com -->