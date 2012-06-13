<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS
$site_tools_width = 1; // 0:disable all , 1:enable for width changer SITE TOOLS

$d4j_menutype = 1; // 1: d4j_listmenu or default; 2: d4j_transmenu

//End Template Settings **********************************************************

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
		
	$centerusers = 0;
	if(mosCountModules('user3')) { $user3 = 1; $centerusers++;}	
	if(mosCountModules('user4')) { $user4 = 1; $centerusers++;}
	$bottomusers = 0;
	if(mosCountModules('user5')) { $user5 = 1; $bottomusers++;}
	if(mosCountModules('user6')) { $user6 = 1; $bottomusers++;}	
	if(mosCountModules('user8')) { $user8 = 1; $bottomusers++;}
	if(mosCountModules('user9')) { $user9 = 1; $bottomusers++;}
	
	if(!mosCountModules('right')) $right = 0; else $right = 1;
	if(!mosCountModules('left')) $left = 0; else $left = 1;	
	if(mosCountModules('user7')) { $user7 = 1;};
	
	if(!$right) $right_side = 0; else $right_side = 1;	
	if(!$left && !$user7) $left_side = 0; else $left_side = 1;
?>
<?php if($d4j_menutype == 1) {?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu.css" />	
<?php } else if($d4j_menutype == 2) {?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu.css" />	
<?php }?>
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php"); ?>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/style/d4j_stylechanger.js">
</script>
<style type="text/css">
<?php if($topusers > 0) {?>
#D4J_User1,#D4J_User2{width:<?php echo (100 - 4*($topusers - 1))/$topusers."%";?>}
<?php }?>
<?php if($centerusers > 0) {?>
#D4J_User4,#D4J_User3{width:<?php echo (100 - 4*($centerusers - 1))/$centerusers."%";?>}
<?php }?>
<?php if($bottomusers > 0) {?>
#D4J_User5,#D4J_User6,#D4J_User8,#D4J_User9{width:<?php echo ((100 - 4.1*($bottomusers -1))/$bottomusers).'%;'?>}
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
#D4J_MainMenu{margin-top:6px}
#D4J_MainMenu ul.list_menu li{padding:0 0 6px 4px }
#D4J_MainMenu ul.list_menu li .mainlevel{padding:5px 15px 2px 10px}
#D4J_MainMenu ul.list_menu li ul{top:28px}
#D4J_MainMenu ul.list_menu li ul ul{margin-top:-29px}

#D4J_TopUsers,#D4J_CenterUsers{width:100%}
#D4J_BottomUsers{width:95%}
#D4J_LeftSide{margin-left:1.2%}
#D4J_Center{margin-left:3%}
<?php if($topusers > 0) {?>
#D4J_User1,#D4J_User2{width:<?php echo (100 - 5.2*($topusers - 1))/$topusers."%";?>;float:left}
<?php }?>
#D4J_User2{margin-left:5%}
<?php if($centerusers > 0) {?>
#D4J_User4,#D4J_User3{width:<?php echo (100 - 5.2*($centerusers - 1))/$centerusers."%";?>;float:left}
<?php }?>
#D4J_User4{margin-left:5%}
<?php if($bottomusers > 0) {?>
#D4J_User5,#D4J_User6,#D4J_User8,#D4J_User9{width:<?php echo (100 - 3.2*($bottomusers - 1))/$bottomusers."%";?>}
<?php }?>
#D4J_User6,#D4J_User8,#D4J_User9{margin-left:3%}
</style>
<![endif]-->
<style type="text/css">
<?php if(!mosLoadModules('inset')){?>
#D4J_MainMenu{margin-top:54px}
<?php }?>
<?php if(!$right_side && $left_side){?>
#D4J_Center{width:71.6%}
<?php }else if(!$left_side && $right_side){?>
#D4J_Center{width:74.6%;margin-left:1.8%}
#D4J_RightSide{margin-left:2.2%}
<?php } else if(!$left_side && !$right_side) {?>
#D4J_Center{margin-left:1.8%;width:96.4%}
<?php }?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">
<?php if(!$left_side && $right_side){?>
#D4J_Center{margin-left:1.2%}
<?php } else if(!$left_side && !$right_side) {?>
#D4J_Center{margin-left:1.2%}
<?php }?>
</style>
<![endif]-->
</head>
<body>
<center>
<div id="D4J_Container">
	<div id="D4J_TopPage">
		<div id="D4J_Header">
			<div id="D4J_Title">
				<?php if(mosCountModules('header')) mosLoadModules('header',-1); else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">Bright<span class="green">Side</span>Of<span class="grey">Life</span></a></h1>';?>
			</div>
			<div class="clearer"><!-- --></div>
			<div id="D4J_Slogan">
				<?php if(mosCountModules('advert1')) mosLoadModules('advert1',-1);?>
			</div>		
			<div class="clearer"><!-- --></div>
		</div>
		<div id="D4J_Search_Menu">
			<?php if(mosCountModules('inset')){?>
			<div id="D4J_Search">
				<?php mosLoadModules('inset',-1);?>
			</div>
			<?php }?>
			<div class="clearer"><!-- --></div>
			<div id="D4J_MainMenu">
				<?php if($d4j_menutype == 2 && mosCountModules('cpanel')) mosLoadModules('cpanel',-1); else mosLoadModules('toolbar',-1);?>
			</div>
			<div class="clearer"><!-- --></div>
		</div>
	</div>
	<div id="D4J_HeaderImage"><!-- --></div>
	<div id="D4J_MainPage">
		<div id="D4J_Body">
			<?php if($left_side){?>
			<div id="D4J_LeftSide">
				<?php if($left) {?>
				<div id="D4J_Left">
					<?php echo classifyHeading('left');?>
				</div>
				<?php }?>
				<?php if($user7) {?>
				<div id="D4J_User7">
					<?php echo classifyHeading('user7');?>
				</div>
				<?php }?>			
			</div>
			<?php }?>
			<div id="D4J_Center">
				<?php if(mosCountModules('top')){?>			
				<div id="D4J_Top">
					 <?php echo classifyHeading('top');?>
				</div>
				<?php }?>
				<?php if($topusers){?>
				<div id="D4J_TopUsers">
					<?php if($user1){?>
					<div id="D4J_User1">
						<?php echo classifyHeading('user1');?>
					</div>
					<?php }?>
					<?php if($user2){?>
					<div id="D4J_User2" style="<?php if(!$user1) echo 'margin-left:0;'?>">
						<?php echo classifyHeading('user2');?>
					</div>
					<?php }?>					
					<div class="clearer"><!-- --></div>
				</div>
				<?php }?>
				<?php if(mosCountModules('banner')){?>
				<div id="D4J_Banner">
					 <?php echo classifyHeading('banner');?>
				</div>
				<?php }?>
				<div id="D4J_Main">
					<?php mosMainBody();?>
				</div>
				<?php if($centerusers){?>
				<div id="D4J_CenterUsers">
					<?php if($user3){?>
					<div id="D4J_User3">
						<?php echo classifyHeading('user3');?>
					</div>
					<?php }?>
					<?php if($user4){?>
					<div id="D4J_User4" style="<?php if(!$user3) echo 'margin-left:0;'?>">
						<?php echo classifyHeading('user4');?>
					</div>
					<?php }?>					
					<div class="clearer"><!-- --></div>
				</div>
				<?php }?>
				<?php if(mosCountModules('bottom')){?>			
				<div id="D4J_Bottom">
					 <?php echo classifyHeading('bottom');?>
				</div>
				<?php }?>
			</div>
			<?php if($right_side){?>
			<div id="D4J_RightSide">
				<?php echo classifyHeading('right');?>
			</div>
			<?php }?>
			<div class="clearer"><!-- --></div>
		</div>
		<div class="clearer"><!-- --></div>
		<?php if($bottomusers){?>
		<div id="D4J_BottomUsers">
			<?php if($user5){?>
			<div id="D4J_User5" style="">
				<?php echo classifyHeading('user5');?>
			</div>
			<?php }?>
			<?php if($user6){?>
			<div id="D4J_User6" style="<?php if(!$user5) echo 'margin-left:0;'?>">
				<?php echo classifyHeading('user6');?>
			</div>
			<?php }?>
			<?php if($user8){?>
			<div id="D4J_User8" style="<?php if(!$user5 && !$user6) echo 'margin-left:0;'?>">
				<?php echo classifyHeading('user8');?>
				</div>
			<?php }?>
			<?php if($user9){?>
			<div id="D4J_User9" style="<?php if(!$user8 && !$user5 && !$user6) echo 'margin-left:0;'?>">
				<?php echo classifyHeading('user9');?>
			</div>
			<?php }?>
			<div class="clearer"><!-- --></div>
		</div>
		<?php }?>		
	</div>
	<div id="D4J_BottomPage">
		<div id="D4J_Footer">
			<?php if (mosCountModules('footer')) {?>
			<div class="copyright">
				<?php mosLoadModules('footer', -1);?>
			</div>
			<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
		</div>
		<?php if(mosCountModules('debug')){?>			
		<div id="D4J_Debug">
			 <?php mosLoadModules('debug',-1);?>
		</div>
		<?php }?>
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
</body>
</html><!-- Joomla Template by DesignForJoomla.com -->