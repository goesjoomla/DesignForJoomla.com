<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $template_width,$template_font,$site_tools_font;

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS

$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS

$site_tools_color = 1;
$colors = array('dark','light');

$d4j_menutype = 1; // 1:dropdown menu; 2:transmenu; 3:suckermenu; 0:uses joomla MainMenu

// Joomla MainMenu is putted at toolbar position. Please user Flat List style for this menu
// D4J_ListMenu (dropdown menu) is putted at advert1 module. Please config for Sub-menu Deep Parameter to use drop down submenu.
// D4J_TransMenu (transmenu) is putted at advert2 module. Please use Horizontal menu style.
// SuckerMenu (default) is loaded automatically. You need to create some submenu to use the in all the menu style.

//End Template Settings **********************************************************

define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/aqueous' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/aqueous');
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
	include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
<?php }?>
<script type="text/javascript" language="JavaScript">
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
		var _SITE_TOOLS_WIDTH = '<?php echo $site_tools_width;?>';
		var _SITE_TOOLS_FONT = '<?php echo $site_tools_font;?>';
		var _SITE_TOOLS_COLOR = '<?php echo $site_tools_color;?>';
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
	if(mosCountModules('user7')) { $user7 = 1; $bottomusers++;};
	if(mosCountModules('user8')) { $user8 = 1; $bottomusers++;}		
	
	if(!mosCountModules('right')) $right = 0; else $right = 1;
	if(!mosCountModules('left')) $left = 0; else $left = 1;	
	
	if(mosCountModules('user9')) { $user9 = 1; }
	
	if(!$right) $right_side = 0; else $right_side = 1;
	if(!$left) $left_side = 0; else $left_side = 1;
?>
<?php if($d4j_menutype == 1) {?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu.css" />	
<?php } else if($d4j_menutype == 2) {?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu.css" />	
<?php } else if($d4j_menutype == 3) {?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_suckermenu.css" />	
<?php }?>
<style type="text/css">
<?php if($topusers > 0) {?>
#D4J_User1,#D4J_User2{width:<?php echo (100 - 4*($topusers - 1))/$topusers."%";?>}
<?php }?>
<?php if($centerusers > 0) {?>
#D4J_User4,#D4J_User3{width:<?php echo (100 - 4*($centerusers - 1))/$centerusers."%";?>}
<?php }?>
<?php if($bottomusers > 0) {?>
#D4J_User5,#D4J_User6,#D4J_User7,#D4J_User8{width:<?php echo ((100 - 4.1*($bottomusers -1))/$bottomusers).'%;'?>}
<?php }?>
</style>
<!--[if IE ]>
<style type="text/css">
#D4J_SubMenu li a{padding:2px 5px}
#D4J_LeftSide .contentheading{padding-bottom:10px}
</style>
<![endif]-->
<!--[if lt IE 7.]>
<style type="text/css">
#D4J_Sitetools{right:auto;bottom:auto;position:absolute;
left: expression((-10 - D4J_Sitetools.offsetWidth + (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) ) + 'px');
top: expression((-5 - D4J_Sitetools.offsetHeight + (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe2 = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) ) + 'px');

}

#D4J_Tools{position:absolute;right:12px;bottom:23px}
</style>
<![endif]-->
<style type="text/css">
<?php if($left_side && !$right_side){?>
#D4J_Center{width:670px}
<?php } else if(!$left_side && $right_side){?>
#D4J_Center{width:694px;margin-left:-2px}

<?php } else if(!$left_side && !$right_side){?>
#D4J_Center{width:890px;margin-left:-2px}

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
	<div id="D4J_TopPage">
		<div id="D4J_Title">
			<?php if(mosCountModules('header')) mosLoadModules('header',-2); else echo '<h3 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">Aqueous</a></h3>A joomla template by <a href="http://designforjoomla.com">designforjoomla</a>';?>
		</div>
		<?php if(mosCountModules('inset')) {?>
		<div id="D4J_Search">
			<?php mosLoadModules('inset',-2);?>
		</div>
		<?php }?>
	</div>	
	<div id="D4J_MainPage">
		<div id="D4J_MainMenu">
			<?php if($d4j_menutype == 0){
				if(mosCountModules('toolbar')) mosLoadModules('toolbar',-1);
			}else if($d4j_menutype == 1){
				if(mosCountModules('advert1')) mosLoadModules('advert1',-1);
			}else if($d4j_menutype == 2){
				if(mosCountModules('advert2')) mosLoadModules('advert2',-1);
			}else if($d4j_menutype == 3) include_once(_TEMPLATE_PATH."/func/menu/d4j_sucker_menu.php");?>
		</div>
		<div class="clearer"><!-- --></div>
		<div id="D4J_Body">
			<?php if($left_side){?>
			<div id="D4J_LeftSide">
				<?php if($left){?>
				<div id="D4J_Left">
					<?php mosLoadModules('left',-2);?>
				</div>
				<?php }?>
			</div>
			<?php }?>
			<div id="D4J_Center">
				<?php if(mosCountModules('top')){?>			
				<div id="D4J_Top">
					 <?php mosLoadModules('top',-2);?>
				</div>
				<?php }?>
				<?php if($topusers){?>
				<div id="D4J_TopUsers">
					<?php if($user1){?>
					<div id="D4J_User1">
						<?php mosLoadModules('user1',-2);?>
					</div>
					<?php }?>
					<?php if($user2){?>
					<div id="D4J_User2" style="<?php if(!$user1) echo 'margin-left:0;'?>">
						<?php mosLoadModules('user2',-2);?>
					</div>
					<?php }?>					
					<div class="clearer"><!-- --></div>
				</div>
				<?php }?>
				<?php if(mosCountModules('banner')){?>
				<div id="D4J_Banner">
					 <?php mosLoadModules('banner',-2);?>
				</div>
				<?php }?>
				<div id="D4J_Main">
					<?php mosMainBody();?>
				</div>
				<?php if($centerusers){?>
				<div id="D4J_CenterUsers">
					<?php if($user3){?>
					<div id="D4J_User3">
						<?php mosLoadModules('user3',-2);?>
					</div>
					<?php }?>
					<?php if($user4){?>
					<div id="D4J_User4" style="<?php if(!$user3) echo 'margin-left:0;'?>">
						<?php mosLoadModules('user4',-2);?>
					</div>
						<?php }?>					
					<div class="clearer"><!-- --></div>
				</div>
				<?php }?>
				<?php if(mosCountModules('bottom')){?>			
				<div id="D4J_Bottom">
					 <?php mosLoadModules('bottom',-2);?>
				</div>
				<?php }?>
			</div>
			<?php if($right_side){?>
			<div id="D4J_RightSide">
				<?php if($right){?>
				<div id="D4J_Right">
				<?php mosLoadModules('right',-2);?>
				</div>
				<?php }?>
			</div>
			<?php }?>
			<div class="clearer"><!-- --></div>
		</div>
	</div>
	<div class="clearer"><!-- --></div>
	<?php if($bottomusers){?>
	<div id="D4J_BottomUsers">
		<?php if($user5){?>
		<div id="D4J_User5" style="">
			<?php echo mosLoadModules('user5',-2);?>
		</div>
		<?php }?>
		<?php if($user6){?>
		<div id="D4J_User6" style="<?php if(!$user5) echo 'margin-left:0;'?>">
			<?php echo mosLoadModules('user6',-2);?>
		</div>
		<?php }?>
		<?php if($user7){?>
		<div id="D4J_User7" style="<?php if(!$user5 && !$user6) echo 'margin-left:0;'?>">
			<?php echo mosLoadModules('user7',-2);?>
			</div>
		<?php }?>
		<?php if($user8){?>
		<div id="D4J_User8" style="<?php if(!$user7 && !$user5 && !$user6) echo 'margin-left:0;'?>">
			<?php echo mosLoadModules('user8',-2);?>
		</div>
		<?php }?>
		<div class="clearer"><!-- --></div>
	</div>
	<?php }?>
	<div id="D4J_BottomPage">
		<div id="D4J_Footer">
			<?php if (mosCountModules('footer')) {?>
			<div class="copyright">
				<?php mosLoadModules('footer', -1);?>
			</div>
			<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
		</div>
		<?php if($user9){?>
		<div id="D4J_User9">
			<?php mosLoadModules('user9',-1);?>
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
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/style/d4j_stylechanger.js">
</script>
</body>
</html><!-- Joomla Template by DesignForJoomla.com -->