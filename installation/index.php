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

define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/education_zone' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/education_zone');
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
	<?php if($d4J_menutype == 3){?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu.css" />	
	<?php }?>
<?php if($site_tools) {
	include_once(_TEMPLATE_PATH."/func/style/d4j_sitetools.php");
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
<?php }?>
<script type="text/javascript" language="JavaScript">
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
</script>
<?php
	$users = 0;
	if(mosCountModules('user1')) { $user1 = 1; $users++;}
	if(mosCountModules('user2')) { $user2 = 1; $users++;}
	if(mosCountModules('user3')) { $user3 = 1; $users++;}	
	
	if(!mosCountModules('right')) $right = 0; else $right = 1;
	if(!mosCountModules('left')) $left = 0; else $left = 1;	
	
	if($right || $left) $rightside = 1;
?>

<style type="text/css">
<?php if(!$user1){?>
#D4J_User2{margin-left:0}
<?php }?>
<?php if(!$user1&&!$user2){?>
#D4J_User3{margin-left:0}
<?php }?>
<?php if(!$rightside){?>
#D4J_LeftSide{width:680px}
<?php }?>
<?php if(!$user9){?>
#D4J_Footer{margin-top:30px}
<?php }?>
</style>
<!--[if IE ]>
<style type="text/css">


#D4J_Footer_Right{}
</style>
<![endif]-->
<!--[if lt IE 7.]>
<style type="text/css">
#D4J_Sitetools{right:auto;bottom:auto;position:absolute;
left: expression((-10 - D4J_Sitetools.offsetWidth + (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) ) + 'px');
top: expression((-5 - D4J_Sitetools.offsetHeight + (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe2 = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) ) + 'px');

}

#D4J_Tools{position:absolute;right:12px;bottom:23px}


#D4J_MainMenu_In{margin-left:40px}
#D4J_MainMenu ul.list_menu li ul{margin-top:1px}
#D4J_FootNav{margin-left:10px}
</style>
<![endif]-->
<style type="text/css">

</style>
<!--[if lt IE 7.]>
<style type="text/css">

</style>
<![endif]-->
</head>
<body class="<?php echo 'font'.$template_font;?>">
<center>
<div id="D4J_Wrapper1">
<center>
<div id="D4J_Container">
	<div id="D4J_Header">
		<?php if(!mosCountModules('header')){?>
			<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><img src="<?php echo _TEMPLATE_URL;?>/images/logo.gif" alt=""/></a></h1><p>Your cool punch line</p>
		<?php } else mosLoadModules('header',-2);?>
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_MainMenu">
		<div id="D4J_MainMenu_In">
			<?php if(mosCountModules('toolbar')) mosLoadModules('toolbar',-1);?>
		</div>
		<div class="clearer"><!-- --></div>
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_Body">
		<div id="D4J_LeftSide">
			<?php if(mosCountModules('top')){?>
			<div id="D4J_Top">
				<?php echo classifyHeading('top');?>
			</div>
			<?php }?>
			<div id="D4J_Main">
				<?php mosMainBody();?>
			</div>
			<?php if(mosCountModules('bottom')){?>
			<div id="D4J_Bottom">
				<?php echo classifyHeading('bottom');?>
			</div>
			<?php }?>	
		</div>
		<?php if($rightside){?>
		<div id="D4J_RightSide">
			<?php if($left){?>
			<div id="D4J_Left">
				<?php echo classifyHeading('left');?>
			</div>
			<?php }?>
			<?php if($right){?>
			<div id="D4J_Right">
				<?php echo classifyHeading('right');?>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<div class="clearer"><!-- --></div>
	</div>
	<div class="clearer"><!-- --></div>
	<?php if($users){?>
	<div id="D4J_Users">
		<?php if($user1){?>
		<div id="D4J_User1" style="width:<?php echo ((690 - ($users-1)*10)/$users).'px'?>">
			<?php mosLoadModules('user1',-2);?>
		</div>
		<?php }?>
		<?php if($user2){?>
		<div id="D4J_User2" style="width:<?php echo ((690 - ($users-1)*10)/$users).'px'?>">
			<?php mosLoadModules('user2',-2);?>
		</div>
		<?php }?>
		<?php if($user3){?>
		<div id="D4J_User3" style="width:<?php echo ((690 - ($users-1)*10)/$users).'px'?>">
			<?php mosLoadModules('user3',-2);?>
		</div>
		<?php }?>
		<div class="clearer"><!-- --></div>
	</div>
	<?php }?>
	<div class="clearer"><!-- --></div>	
</div>
<div id="D4J_FootPage">
<center>
		<div id="D4J_FootPage_In">
	<?php if(mosCountModules('user9')){?>
	<div id="D4J_FootNav">
		<?php mosLoadModules('user9',-1);?>
	</div>
	<div class="clearer"><!-- --></div>
	<?php }?>
	<div id="D4J_Footer">
		<?php if(mosCountModules('footer')) mosLoadModules('footer',-1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
	</div>
		</div>
		<div class="clearer"><!-- --></div>
</center>
</div>
</center>
<div class="clearer"><!-- --></div>
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