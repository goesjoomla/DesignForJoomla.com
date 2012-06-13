<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $template_font;

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS
$site_tools_width = 0; // 0:disable all , 1:enable for width changer SITE TOOLS

$validate = 1; // Show or Hide validate buttons ( 1: show; 0: hide)

$d4j_menutype = 3; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu
//End Template Settings **********************************************************

define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/blogdivision' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/blogdivision');
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
<?php if($d4j_menutype == 3){?>
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
	if(mosCountModules('user1')) { $user1 = 1;}
	if(mosCountModules('user2')) { $user2 = 1;}
	if(mosCountModules('user3')) { $user3 = 1;}	
	
	if(!mosCountModules('right')) $right = 0; else $right = 1;
	
	if(!$right && !$user2 && !$user3){$fullbody = 1;}
?>

<style type="text/css">
<?php if(!$right && !$user2 && !$user3){?>
#D4J_Top,#D4J_Main,#D4J_Bottom{width:100%}
<?php }?>
</style>
<!--[if IE ]>
<style type="text/css">
#D4J_Header{margin-top:31px}
#D4J_Right{margin-top:5px}
</style>
<![endif]-->
<!--[if lt IE 7.]>
<style type="text/css">
#D4J_Sitetools{right:auto;bottom:auto;position:absolute;
left: expression((-10 - D4J_Sitetools.offsetWidth + (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) ) + 'px');
top: expression((-5 - D4J_Sitetools.offsetHeight + (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe2 = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) ) + 'px');

}

#D4J_Tools{position:absolute;right:12px;bottom:23px}

#D4J_Header{margin-top:0}
#D4J_Form .moduletable form #mod_login_remember{margin-left:8px}
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
	<div id="D4J_LeftSide">
		<div id="D4J_MainMenu">
		<?php if(mosCountModules('toolbar')) mosLoadModules('toolbar',-1);?>
		</div>
		<div id="D4J_Header">
			<?php if(mosCountModules('header')) mosLoadModules('header',-2); else {?>
			<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><img src="<?php echo _TEMPLATE_URL;?>/images/logo.jpg" alt=""/></a></h1><?php }?>
		</div>
		<?php if(!$fullbody){?>
		<?php if(mosCountModules('top')){?>
		<div id="D4J_Top">
			<?php mosLoadModules('top',-2);?>
		</div>
		<?php }?>
		<div id="D4J_Main">
			<?php mosMainBody();?>
		</div>
		<?php if(mosCountModules('bottom')){?>
		<div id="D4J_Bottom">
			<?php mosLoadModules('bottom',-2);?>
		</div>
		<?php }?>
		<?php }?>
	</div>
	<div id="D4J_RightSide">
		<div id="D4J_Buttons">
			<?php 
				$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,10");
				$itemClass = array("home","about","contact");
				if ($rows = $database->loadObjectList()) {
					for ($n = count($rows),$i = $n-1; $i >= $n-3; $i--) {						
						$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
						$link = ampReplace($link);
						if ($rows[$i]->browserNav == 1) {
							$link .= '" target="_blank';
						} elseif ($rows[$i]->browserNav == 2) {
							$link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
						}			
						if($rows[$i]->id == $Itemid) {
							echo '<p id="active'.$itemClass[$n - $i - 1].'">'.$rows[$i]->name.'</p>';
						} else {
							echo '<a class="'.$itemClass[$n - $i - 1].'" href="'.$link.'">'.$rows[$i]->name.'</a>';
						}
				}
					} ?>
		</div>			
		<div id="D4J_Form">
			<?php if($user2) echo classifyHeading('user2');?>
			<span id="D4J_Box_Bottom"><!-- --></span>
		</div>
		<?php if($user3){?>
		<div id="D4J_User3">
			<?php mosLoadModules('user3',-1);?>
		</div>
		<?php }?>
		<div class="clearer"><!-- --></div>
		<?php if(mosCountModules('right')){?>
		<div id="D4J_Right">
			<span id="D4J_Right_Top">&nbsp;<!-- --></span>
			<?php mosLoadModules('right',-2);?>
			<span id="D4J_Right_Bottom">&nbsp;<!-- --></span>
		</div>
		<?php }?>
		<div class="clearer"><!-- --></div>
	</div>
	<div class="clearer"><!-- --></div>
	<?php if($fullbody){?>
	<div id="D4J_MainPage">
		<?php if(mosCountModules('top')){?>
		<div id="D4J_Top">
			<?php mosLoadModules('top',-2);?>
		</div>
		<?php }?>
		<div id="D4J_Main">
			<?php mosMainBody();?>
		</div>
		<?php if(mosCountModules('bottom')){?>
		<div id="D4J_Bottom">
			<?php mosLoadModules('bottom',-2);?>
		</div>
		<?php }?>
	</div>
	<?php }?>
</div>
<div class="clearer"><!-- --></div>
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