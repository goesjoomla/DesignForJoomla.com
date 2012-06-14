<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
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
<?php 
	$showContact=1;//set to 0 to hidden
	
	if($showContact==0){
	echo '<style type="text/css">#contactUs{display:none}
</style>';}
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
<script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/js/imageEnlarge.js"></script>
<style type="text/css">
#showimage{
position:absolute;
visibility:hidden;
border: 1px solid gray;
}
</style>
<script language="JavaScript" type="text/javascript">
		<!--
		function validate(){
			if ( ( document.emailForm.text.value == "" ) || ( document.emailForm.email.value.search("@") == -1 ) || ( document.emailForm.email.value.search("[.*]" ) == -1 ) ) {
				alert( "<?php echo _CONTACT_FORM_NC; ?>" );
			} else if ( ( document.emailForm.email.value.search(";") != -1 ) || ( document.emailForm.email.value.search(",") != -1 ) || ( document.emailForm.email.value.search(" ") != -1 ) ) {
				alert( "<?php echo _CONTACT_ONE_EMAIL; ?>" );			
			} else {
				document.emailForm.action = "<?php echo sefRelToAbs("index.php?option=com_contact&Itemid=$Itemid"); ?>"
				document.emailForm.submit();
			}
		}
		//-->
</script>

<!--[if lt IE 7.]>
<style type="text/css">
#container{background-position:30px 0px}
#left_col{margin-left:15px}
#body{margin-left:10px}
</style>
<![endif]-->

<style type="text/css">
<?php if(!mosCountModules('left') or !mosCountModules('right')){?>
#body{width:420px}
textarea.inputbox#contact_text{width:410px}
<?php };if((!mosCountModules('left')) and (!mosCountModules('right'))){?>
#body{width:560px}
<?php }?>
</style>
</head>
<body>
<div id="showimage"></div>
<div id="container">
	<div id="left_col">
		<div id="user">
		<?php if (mosCountModules('user9')) mosLoadModules('user9', -2);
				else echo'<br /><br />
		<p><b class="yellow">Capture!</b></p>
		<p>Your readers <span class="yellow">attention</span> and tell them something important</p>
		<p>or you could put your <span class="yellow">logo</span> right here.</p><br /><br /><br /><br />';?>
		</div>
		<div id="navigation">
	
			<?php 
			echo '<p><b class="yellow">Navigation</b></p>';
			echo'<ul id="nav_list">';
					$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
					if ($rows = $database->loadObjectList()) {
						for ($i = 0, $n = count($rows); $i < $n; $i++) {						
							$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
							$link = ampReplace($link);
							if ($rows[$i]->browserNav == 1) {
								$link .= '" target="_blank';
							} elseif ($rows[$i]->browserNav == 2) {
								$link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
							}
							if($i<$n-1)
							echo '<li class="li_nav_body"><a href="'.$link.'" >'.$rows[$i]->name.'</a></li>';
							else
							echo '<li class="li_nav_footer"><a href="'.$link.'" >'.$rows[$i]->name.'</a></li>';
					}
					echo '</ul>';} ?>
			<div class="clear"></div>
			<br />
			<br />

			<div id="contactUs">
			<?php echo'<p><b class="yellow">Contact Us</b></p>';?>
			<form action="<?php echo sefRelToAbs( 'index.php?option=com_contact&amp;Itemid='. $Itemid ); ?>" method="post" name="emailForm" target="_top" id="emailForm">				
					<input type="text" name="name" id="contact_name" size="30" class="inputbox" value="<?php echo _CMN_NAME?>" onfocus="if(this.value=='<?php echo _CMN_NAME?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _CMN_NAME ?>';}"/>					
					<input type="text" name="email" id="contact_email" size="30" class="inputbox" value="<?php echo _CMN_EMAIL?>" onfocus="if(this.value=='<?php echo _CMN_EMAIL?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _CMN_EMAIL ?>';}"/>					
					<textarea cols="50" rows="10" name="text" id="contact_text" class="inputbox"></textarea>
					<input type="button" name="send" value="<?php echo(_SEND_BUTTON); ?>" class="button" onclick="validate()" />
					<input type="reset" value="Reset" class="button" />
				<input type="hidden" name="option" value="com_contact" />
				<input type="hidden" name="con_id" value="1" />
				<input type="hidden" name="sitename" value="<?php echo $GLOBALS['mosConfig_sitename']?>" />
				<input type="hidden" name="op" value="sendmail" />
				<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
				</form>				
			</div>
			<div class="clear"></div>
			<br />

			<div id="user_bottom">			
				<?php if(mosCountModules('user8')) mosLoadModules('user8',-2);?>
			</div>	
		</div>		
	</div>
	<div id="right_col">
		<div id="slogan">			
					<?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
						else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>'?>
		</div>
		<div id="content">
			<div id="body">
				<?php if(mosCountModules('top')){?>
					<div id="top">
						<?php mosLoadModules('top',-2)?>
					</div>
					<?php }?>
					<div id="main">
						<?php mosMainBody()?>
					</div>
					<?php if(mosCountModules('bottom')){?>
					<div id="bottom">
						<?php mosLoadModules('bottom',-2)?>
					</div>
					<?php }?>			
			</div>
			<?php if(mosCountModules('left')) {?>
					<div id="left">
						<?php mosLoadModules('left',-2)?>
					</div>
			<?php }?>
			<?php if(mosCountModules('right')) {?>
					<div id="right">
						<?php mosLoadModules('right',-2)?>
					</div>
			<?php }?>
			<div class="clear"></div>
			<div id="footer">
				<?php if (mosCountModules('footer')) {?>
				<div class="copyright">
				<?php mosLoadModules('footer', -1);?>
				</div>
				<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
			</div>
		</div>
</div>
<div class="clear"></div>
</div>
</center>
</body>
</html>