<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $template_font;

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS
$site_tools_width = 0; // 0:disable all , 1:enable for width changer SITE TOOLS

//End Template Settings **********************************************************

define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/breakingontop' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/breakingontop');
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
<?php include_once(_TEMPLATE_PATH.'/func/style/d4j_sitetools.php') ?>	
 
<script type="text/javascript" language="JavaScript">
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
</script>
<?php
	
	if(mosCountModules('user1')) { $user1 = 1; $topusers++;}
	if(mosCountModules('user2')) { $user2 = 1; $topusers++;}
	if(mosCountModules('user3')) { $user3 = 1; $topusers++;}
	if(mosCountModules('user4')) { $user4 = 1; $bottomusers++;}	
?>

<style type="text/css">
<?php if(!$user1){?>
#D4J_Header{margin-top:25px}
<?php }?>
<?php if(!$user3){?>
#D4J_MainMenu{margin-top:175px}	
<?php }?>
<?php if(!mosCountModules('left')){?>
#D4J_Right{margin-left:164px}
<?php }?>
</style>


<!--[if IE ]>
<style type="text/css">
#D4J_Container{margin-top:0}
#D4J_Contact .moduletable h3{float:left}
#D4J_Header{margin-top:25px}
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

</style>
<!--[if lt IE 7.]>
<style type="text/css">
<?php if(!mosCountModules('left')){?>
#D4J_Right{margin-left:82px}
<?php }?>
</style>
<![endif]-->
</head>
<body class="<?php echo 'font'.$template_font;?>">
<center>
<div id="D4J_Container">
	<div id="D4J_TopPage">
		<div id="D4J_LeftSide">
			<div style="height:334px">
			<?php if(mosCountModules('user1')){?>
			<div id="D4J_Login">
				<?php mosLoadModules('user1',-2);?>
			</div>
			<?php }?>
			</div>
			<div id="D4J_Header">
				<?php if(mosCountModules('header')){ mosLoadModules('header',-2); } else {?>
				<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><img src="<?php echo _TEMPLATE_URL;?>/images/braking.gif" alt=""/></a></h1>
					<?php }?>
			</div>
			<div class="clearer"><!-- --></div>
			<div id="D4J_Contact">
				<?php if(mosCountModules('user2')){ mosLoadModules('user2',-1);} else {?>
				<div class="moduletable">
					<h3>Contact Info</h3>
						<form action="<?php echo sefRelToAbs( 'index.php?option=com_contact&amp;Itemid='. $Itemid ); ?>" method="post" name="emailForm" target="_top" id="emailForm">
							<table>
								<tr valign="top">
								<td><label><?php echo _CMN_NAME?>:</label></td>
								<td><input type="text" name="name" id="contact_name" size="30" class="inputbox" value=""/>
								</td>
								</tr>
								<tr valign="top">
								<td><label><?php echo _CMN_EMAIL?>:</label></td>	
								<td><input type="text" name="email" id="contact_email" size="30" class="inputbox" value=""/></td>
								</tr>
								<tr valign="top">
								<td><label class="comment">Comments:</label></td>
								<td>
								<textarea cols="50" rows="10" name="text" id="contact_text" class="inputbox"></textarea></td>
								</tr>
								<tr valign="top">
								<td></td>
								<td align="right">
								<input type="button" name="send" value="<?php echo(_SEND_BUTTON); ?>" class="button" onclick="validate()" />
								</td>
								</tr>
							</table>
							<input type="hidden" name="option" value="com_contact" />
							<input type="hidden" name="con_id" value="1" />
							<input type="hidden" name="sitename" value="<?php echo $GLOBALS['mosConfig_sitename']?>" />
							<input type="hidden" name="op" value="sendmail" />
							<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
						</form>
				</div>
				<div class="clearer"><!-- --></div>
				<?php }?>
			</div>			
		</div>
		<div id="D4J_RightSide">
			<?php if(mosCountModules('left')){?>
			<div id="D4J_Left">
				<p class="top"><!-- --></p>
				<?php mosLoadModules('left',-2);?>
				<p class="bottom"><!-- --></p>
			</div>
			<?php }?>
			<div id="D4J_Right">
				<?php if(mosCountModules('user3')){?>
				<div id="D4J_Search">
					<?php mosLoadModules('user3',-2);?>
				</div>
				<?php }?>
				<?php if(mosCountModules('toolbar')){?>
				<div id="D4J_MainMenu">
					<?php mosLoadModules('toolbar',-1);?>
				</div>
				<?php }?>
				<?php if(mosCountModules('top')){?>
				<div id="D4J_Top">
					<?php mosLoadModules('top',-2);?>
				</div>
				<?php }?>					
				<div id="D4J_Body">
					<?php mosMainBody();?>
				</div>
				<?php if(mosCountModules('bottom')){?>
				<div id="D4J_Bottom">
					<?php mosLoadModules('bottom',-2);?>
				</div>
				<?php }?>
			</div>
			<div class="clearer"><!-- --></div>
		</div>
		<div class="clearer"><!-- --></div>
	</div>
	<div class="clearer"><!-- --></div>
	<div id="D4J_BottomPage">
		<?php if(mosCountModules('user4')){?>
		<div id="D4J_BottomNav">
			<?php mosLoadModules('user4',-1);?>
		</div>
		<div class="clearer"><!-- --></div>
		<?php }?>		
		<div id="D4J_Footer">
			<?php if(mosCountModules('footer')) mosLoadModules('footer'); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
		</div>
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