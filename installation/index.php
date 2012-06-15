<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS
$site_tools_width = 1; // 0:disable all , 1:enable for width changer SITE TOOLS

//End Template Settings **********************************************************

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
<?php if(!mosCountModules('user1') || !mosCountModules('user2')){?>
#D4J_User1,#D4J_User2{width:100%}
<?php }?>
<?php if(!mosCountModules('user3') || !mosCountModules('user4')){?>
#D4J_User3,#D4J_User4{width:100%}
<?php }?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">
html,body{height:100%;overflow:auto}
html{overflow:hidden}
#sitetools{position:absolute;right:30px}
#tools{position:absolute;right:30px}

</style>
<![endif]-->
<?php if($site_tools) {
	include_once(_TEMPLATE_PATH."/func/style/d4j_sitetools.php");
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
	<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php"); ?>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/style/d4j_stylechanger.js">
</script>
<?php }?>
</head>
<body>
<center>
<div id="D4J_Container">
<div id="D4J_Container2">
	<div id="D4J_Container3">
		<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
		<td width="240px" valign="top" style="padding-top:20px">
			<div id="D4J_LeftSide">			
				<div id="D4J_User7">
					<?php if(mosCountModules('user7')) { mosLoadModules('user7',-2); } else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1><h2>a slogan here</h2>';?>
				</div>
				<?php if(mosCountModules('user8')) {?>
				<div id="D4J_User8">
					<?php mosLoadModules('user8',-2); ?>
				</div>
				<?php }?>
				<?php if(mosCountModules('left')){?>
				<div id="D4J_Left">
					<?php mosLoadModules('left',-2);?>
				</div>
				<?php }?>
				<?php if(mosCountModules('right')){?>
				<div id="D4J_Right">
					<?php mosLoadModules('right',-2);?>
				</div>	
				<?php }?>	

<div class="clearer"><!-- --></div>		</div>

		</td>
		<td valign="top" id="D4J_TD_RightSide"style="Width:auto;padding:0 44px;overflow:hidden">
			<div id="D4J_RightSide">
				<?php if(mosCountModules('toolbar')) {?>
				<center>
				<div id="D4J_MainMenu">
					<?php mosLoadModules('toolbar',-1); ?>
				</div>
				</center>

				<?php }?>
				<?php if(mosCountModules('newsflash')) {?>
				<div id="D4J_Newsflash">
					<?php mosLoadModules('newsflash',-2);?>
				</div>

				<?php }?>
				<?php if(mosCountModules('user1') || mosCountModules('user2')) {?>
				<div id="D4J_TopUsers">
					<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
					<?php if(mosCountModules('user1')) {?>
					<td <?php if(mosCountModules('user2')) echo 'width="50%"';?> valign="top">
					<div id="D4J_User1">
						<?php mosLoadModules('user1',-2);?>
					</div>
					</td>
					<?php }?>
					<?php if(mosCountModules('user2')) {?>
					<td valign="top">
					<div id="D4J_User2">
						<?php mosLoadModules('user2',-2);?>
					</div>
					</td>
					<?php }?>	
					</tr></table>		

				</div>

				<?php }?>
				<?php if(mosCountModules('top')) {?>
				<div id="D4J_Top">
					<?php mosLoadModules('top',-2);?>
				</div>

				<?php }?>
				<div id="D4J_Main">
					<?php mosMainBody();?>
				</div>

				<?php if(mosCountModules('bottom')) {?>
				<div id="D4J_Bottom">
					<?php mosLoadModules('bottom',-2);?>
				</div>

				<?php }?>
				<?php if(mosCountModules('user3') || mosCountModules('user4')) {?>
				<div id="D4J_BottomUsers">		
					<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
					<?php if(mosCountModules('user3')) {?>
					<td <?php if(mosCountModules('user4')) echo 'width="50%"';?> valign="top">
					<div id="D4J_User3">
						<?php mosLoadModules('user3',-2);?>
					</div>
					</td>
					<?php }?>
					<?php if(mosCountModules('user4')) {?>
					<td valign="top">
					<div id="D4J_User4">
						<?php mosLoadModules('user4',-2);?>
					</div>
					</td>
					<?php }?>		
					</tr></table>	

				</div>

				<?php }?>
				<?php if(mosCountModules('banner')) {?>
				<center>
				<div id="D4J_Banner">
					<?php mosLoadModules('banner',-1);?>
				</div>
				</center>

				<?php }?>
			</div>			

		</td></tr></table>
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_Footer">
	<?php if (mosCountModules('footer')) { mosLoadModules('footer', -1); } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>	
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
</body>
</html>