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

define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/business_event' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/business_event');
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

	if(mosCountModules('user3')) { $user3 = 1;}	
	if(mosCountModules('user4')) { $user4 = 1;}
	if(mosCountModules('user5')) { $user5 = 1;}
	if(mosCountModules('user6')) { $user6 = 1;}	
	
	if(mosCountModules('user7')) { $user7 = 1;}
	if(mosCountModules('user8')) { $user8 = 1;}
	if(mosCountModules('user9')) { $user9 = 1;}
?>

<style type="text/css">

</style>
<!--[if IE ]>
<style type="text/css">
#D4J_NewsIn .moduletable .readon a{float:left;margin-left:605px}
#D4J_User1 .moduletable,#D4J_User2 .moduletable{float:left}
#D4J_User1 .moduletable h3,#D4J_User2 .moduletable h3{float:left;display:block;margin:-84px 0 0 0}
</style>
<![endif]-->
<!--[if lt IE 7.]>
<style type="text/css">
#D4J_Sitetools{right:auto;bottom:auto;position:absolute;
left: expression((-10 - D4J_Sitetools.offsetWidth + (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) ) + 'px');
top: expression((-5 - D4J_Sitetools.offsetHeight + (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe2 = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) ) + 'px');

}

#D4J_Tools{position:absolute;right:12px;bottom:23px}

#D4J_RedPan,#D4J_News,#D4J_NewsIn{width:688px}

#D4J_NewsIn .moduletable h3{margin:48px 27px 0 18px}
#D4J_NewsIn .moduletable{width:688px}
#D4J_NewsIn .moduletable .news{width:263px}
#D4J_NewsIn .moduletable .readon a{margin:18px 0 0 0;background:#FEFDF1 url(<?php echo _TEMPLATE_URL;?>/images/headermore-normal.gif) no-repeat;}

#D4J_Footer .xhtml{margin-left:160px}
#D4J_Footer a.css{margin-left:3px}
</style>
<![endif]-->
<style type="text/css">

</style>
<!--[if gte IE 7.]>
<style type="text/css">
#D4J_NewsIn .moduletable .readon a{margin:18px 0 0 0px}
</style>
<![endif]-->
</head>
<body class="<?php echo 'font'.$template_font;?>">
<div id="D4J_Wrapper1">
<div id="D4J_Wrapper2">
<center>
<div id="D4J_Container">
	<div id="D4J_TopNav">
		<?php if($user9) mosLoadModules('user9',-1);?>		
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_Header">
		<?php if(mosCountModules('header')) mosLoadModules('header',-2); else {?>
			<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><img src="<?php echo _TEMPLATE_URL;?>/images/logo.gif" alt=""/></a></h1>
		<?php }?>
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_TopPage">
		<div id="D4J_TopPageLeft"><img src="<?php echo _TEMPLATE_URL;?>/images/leftfolder.gif" alt=""/></div>
		<div id="D4J_TopPageCenter">
			<div id="D4J_MainMenu">
				<?php if(mosCountModules('toolbar')) mosLoadModules('toolbar',-1);?>
			</div>
			<div class="clearer"><!-- --></div>
			<div id="D4J_RedPan">
				<div id="D4J_News">
					<div id="D4J_NewsIn">
						<?php if(mosCountModules('newsflash')) echo classifyHeading('newsflash');?>
					</div>
					<div class="clearer"><!-- --></div>
				</div>
				<div class="clearer"><!-- --></div>
			</div>
			<div class="clearer"><!-- --></div>
		</div>		
		<div id="D4J_TopPageRight"><img src="<?php echo _TEMPLATE_URL;?>/images/rightfolder.gif" alt=""/></div>		
		<div class="clearer"><!-- --></div>
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_MainPage">
		<?php if(mosCountModules('top')){?>
		<div id="D4J_Top">
			<?php mosLoadModules('top',-2);?>
		</div>
		<div class="clearer"><!-- --></div>
		<?php }?>
		<div id="D4J_MainBody">
			<?php mosMainBody();?>
		</div>
		<div class="clearer"><!-- --></div>
		<?php if(mosCountModules('bottom')){?>
		<div id="D4J_Bottom">
			<?php mosLoadModules('bottom',-2);?>
		</div>
		<?php }?>
	</div>
	<div class="clearer"><!-- --></div>
	<?php if($users > 0){?>	
	<div id="D4J_BottomPage">
		<table border="0px" cellpadding="0px" cellspacing="0px" width="100%"><tr valign="top">
			<?php if($user1){?>
			<td id="D4J_User1">
				<?php echo classifyHeading('user1');?>
			</td>
			<?php }?>
			<?php if($user2){?>
			<td width="20px">
				<!-- -->
			</td>
			<td id="D4J_User2">
				<?php echo classifyHeading('user2');?>
			</td>
			<?php }?>
		</tr></table>
	</div>
	<div class="clearer"><!-- --></div>
	<?php }?>
	<div id="D4J_FooterPage">
		<?php if($user8){?>
		<div id="D4J_FooterNav">
			<?php mosLoadModules('user8',-1);?>
		</div>
		<div class="clearer"><!-- --></div>	
		<?php }?>
		<div id="D4J_Footer">
			<?php if(mosCountModules('footer')) mosLoadModules('footer',-1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
		</div>
		<div class="clearer"><!-- --></div>
	</div>
</div>
</center>
<div class="clearer"><!-- --></div>
</div>
<div class="clearer"><!-- --></div>
</div>

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