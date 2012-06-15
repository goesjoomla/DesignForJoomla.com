  <?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/travelportal' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/travelportal');

$iso = split( '=', _ISO );

/* =============== Site tools ============== */
$site_tools = 1; // 1 : enable ; 0 : disable


/* 
	Image switching settings 
*/
$D4J_IS_enable 	= true; 	// enable or not

$changing_type = 'random';// random,sequence

$images		= array('header.jpg'); // name of the images
$time 		= 3;		// time delay (s)
					
//End Template Settings **********************************************************

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
<?php if($d4j_menu_type == 1) {
?>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu.css" />		
<?php }?>
<?php if($site_tools) {
	include_once(_TEMPLATE_PATH."/func/style/d4j_sitetools.php");
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
<?php }?>
<?php 
	$topusers = 0;
	if(mosCountModules('user1')) { $user1 = 1; $topusers++;}
	if(mosCountModules('user2')) { $user2 = 1; $topusers++;}
	$centerusers = 0;
	if(mosCountModules('user3')) { $user3 = 1; $centerusers++;}
	if(mosCountModules('user4')) { $user4 = 1; $centerusers++;}
	if(mosCountModules('user5')) { $user5 = 1; $centerusers++;}
	$bottomusers = 0;
	if(mosCountModules('user8')) { $user8 = 1; $bottomusers++;}
	if(mosCountModules('user9')) { $user9 = 1; $bottomusers++;}	
	$footerusers = 0;
	if(mosCountModules('user6')) { $user6 = 1; $footerusers++;}
	if(mosCountModules('user7')) { $user7 = 1; $footerusers++;}	
	if(mosCountModules('advert2')) { $advert2 = 1; $footerusers++;}
	if(mosCountModules('advert3')) { $advert3 = 1; $footerusers++;}
	$usersLength = 680;	
		
	if(mosCountModules('left')) $left = 1; else $left = 0;
	if(mosCountModules('right')) $right = 1; else $right = 0;
	if(!$left && !$right) {$left_side = 0;$usersLength = 920;} else $left_side = 1;
?>
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/style/d4j_stylechanger.js">
</script>
<script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
// ]]></script>
<style type="text/css">
<?php if($bottomusers == 1) {?>
#D4J_User8 .moduletable,#D4J_User8 .moduletable-oreange,#D4J_User8 .moduletable-green,#D4J_User8 .moduletable-blue,
#D4J_User9 .moduletable,#D4J_User9 .moduletable-oreange,#D4J_User9 .moduletable-green,#D4J_User9 .moduletable-blue{padding:18px 20px 40px 20px}
<?php }?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">
html,body{height:100%;overflow:auto}
html{overflow:hidden}
#D4J_Sitetools{position:absolute;right:30px}
#D4J_Tools{position:absolute;right:30px}
#D4J_MainPage{margin-top:-3px}
</style>
<![endif]-->
<!--[if gte IE 7.]>
<style type="text/css">

</style>
<![endif]-->

<script type="text/javascript">
var changing_type = "<?php echo $changing_type;?>";
var images = new Array("<?php $str =  join('","',$images);echo $str;?>");
var time = <?php echo $time;?>;

var _TEMPLATE_URL = "<?php echo _TEMPLATE_URL;?>";
var currentImage = 0;

function changeImage() {
	var image = document.getElementById("D4J_Header").getElementsByTagName("IMG")[0];
	if(image != null || image != 'undefined') {
		image.src = _TEMPLATE_URL+"/images/header/"+images[currentImage];	
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
<div id="D4J_Container">
	<div id="D4J_TopPage">
		<div id="D4J_Logo">
			<?php echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'"><img src="'._TEMPLATE_URL.'/images/logo.gif" alt=""/></a></h1>';?>
			<?php if(mosCountModules('advert1')) {?>
			<div id="D4J_Title"> 
				<?php mosLoadModules('advert1',-2);?>
			</div>
			<?php }?>		
		</div>	
		<div id="D4J_Header">	
			<?php if(mosCountModules('header')) mosLoadModules('header',-1); else echo '<img src="'._TEMPLATE_URL.'/images/header/header.jpg" alt=""/>';?>
		</div>
	</div>	
	<div id="D4J_MainPage">	
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr valign="top">
			<?php if($left_side) {?>
			<td id="D4J_LeftSide" height="auto">
				<?php if($left) {?>
				<div id="D4J_Left">					
					<?php mosLoadModules('left',-2);?>
				</div>
				<?php }?>
				<?php if($right) {?>
				<div id="D4J_Right">					
					<?php mosLoadModules('right',-2);?>
				</div>
				<?php }?>
			</td>
			<?php }?>
			<td id="D4J_RightSide">
			<div id="D4J_MainBody">
				<?php if(mosCountModules('newsflash')) {?>
				<div id="D4J_Newsflash">
					<?php mosLoadModules('newsflash',-2);?>				
				</div>
				<?php }?>	
				<?php if($topusers > 0) {?>	
				<div id="D4J_TopUsers">
					<?php if($user1) {?>
					<div id="D4J_User1" style="width:<?php echo (($usersLength - 40*($topusers - 1))/$topusers).'px';?>">
						<?php mosLoadModules('user1',-2);?>
					</div>
					<?php }?>
					<?php if($user2) {?>
					<div id="D4J_User2" style="width:<?php echo (($usersLength - 40*($topusers - 1))/$topusers).'px';?>;<?php if($user1) echo 'margin-left:40px';?>">
						<?php mosLoadModules('user2',-2);?>
					</div>
					<?php }?>	
					<div class="clearer"><!-- --></div>			
				</div>
				<?php }?>
				<?php if(mosCountModules('top')) {?>
				<div id="D4J_Top">
					<?php mosLoadModules('top',-2);?>				
				</div>
				<?php }?>
				<?php if($centerusers > 0) {?>		
				<div id="D4J_CenterUsers">
					<?php if($user3) {?>
					<div id="D4J_User3" style="width:<?php echo (($usersLength - 30*($centerusers - 1))/$centerusers).'px';?>">
						<?php mosLoadModules('user3',-2);?>
					</div>
					<?php }?>
					<?php if($user4) {?>
					<div id="D4J_User4" style="width:<?php echo (($usersLength - 30*($centerusers - 1))/$centerusers).'px';?>;<?php if($user3) echo 'margin-left:30px';?>">
						<?php mosLoadModules('user4',-2);?>
					</div>
					<?php }?>
					<?php if($user5) {?>
					<div id="D4J_User5" style="width:<?php echo (($usersLength - 30*($centerusers - 1))/$centerusers).'px';?>;<?php if($user3 || $user4) echo 'margin-left:30px';?>">
						<?php mosLoadModules('user5',-2);?>
					</div>
					<?php }?>
					<div class="clearer"><!-- --></div>			
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
				<div class="clearer"><!-- --></div>
				<?php if($bottomusers > 0) {?>				
				<table id="D4J_BottomUsers" cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<?php if($user8) {?>
						<td valign="top" id="D4J_TD_User8">
						<div id="D4J_User8" style="width:<?php echo ($usersLength / $bottomusers - 40).'px';?>" >
							<?php mosLoadModules('user8',-2);?>
						</div>
						</td >
						<?php }?>
						<?php if($user9) {?>
						<td valign="top" id="D4J_TD_User9">
						<div id="D4J_User9" style="width:<?php echo ($usersLength / $bottomusers - 40).'px';?>">
							<?php mosLoadModules('user9',-2);?>
						</div>
						</td>
						<?php }?>	
					</tr>
				</table>
				<?php }?>
				<?php if(mosCountModules('banner')) {?>
				<div id="D4J_Banner">
					<?php mosLoadModules('banner',-2);?>
				</div>
				<?php }?>
				<?php if($footerusers > 0) {?>		
				<div id="D4J_FooterUsers">
					<?php if($user6) {?>
					<div id="D4J_User6" style="width:<?php echo (($usersLength - 20*($footerusers - 1))/$footerusers).'px';?>">
						<?php mosLoadModules('user6',-2);?>
					</div>
					<?php }?>
					<?php if($user7) {?>
					<div id="D4J_User7" style="width:<?php echo (($usersLength - 20*($footerusers - 1))/$footerusers).'px';?>;<?php if($user6) echo 'margin-left:20px';?>">
						<?php mosLoadModules('user7',-2);?>
					</div>
					<?php }?>
					<?php if($advert2) {?>
					<div id="D4J_Advert2" style="width:<?php echo (($usersLength - 20*($footerusers - 1))/$footerusers).'px';?>;<?php if($user6 || $user7) echo 'margin-left:20px';?>">
						<?php mosLoadModules('advert2',-2);?>
					</div>
					<?php }?>
					<?php if($advert3) {?>
					<div id="D4J_Advert3" style="width:<?php echo (($usersLength - 20*($footerusers - 1))/$footerusers).'px';?>;<?php if($user6 || $user7 || $advert2) echo 'margin-left:20px';?>">
						<?php mosLoadModules('advert3',-2);?>
					</div>
					<?php }?>
					<div class="clearer"><!-- --></div>			
				</div>
				<?php }?>		
			</div>	
			</td>
		</tr>
	</table>
	</div>
	<div id="D4J_BottomPage">
	<table id="D4J_BottomPage_Tbl" cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr valign="top">
		<td id="D4J_Debug">
				<?php if(mosCountModules('debug')) mosLoadModules('debug');?>				
		</td>
		<td id="D4J_Footer">				
			<div class="copyright">
				<?php if (mosCountModules('footer')) { mosLoadModules('footer', -1);}
			else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
			</div>				
		</td>
		</tr>
	</table>
	</div>
<script type="text/javascript">
	<?php if(!mosCountModules('header') && $D4J_IS_enable) {?> changeImage();<?php }?>
		<?php if($left_side) {?>
		// get last Module to indentify the color for D4J_LeftSide
		var LeftSide = document.getElementById("D4J_LeftSide");
		var divModule = LeftSide.getElementsByTagName("div");		
		var color = '<?php if($right) echo "#4096ee"; else echo "#85c329";?>';
		var i = divModule.length - 1;
		var stop = 0;			
		while(i >= 0 && !stop) {						
			switch(divModule[i].className) {				
				case "moduletable-green": color="#85c329";stop = true;break;
				case "moduletable-blue": color="#4096ee";stop = true;break;
				case "moduletable-orange": color="#ff9523";stop = true;break;
				case "moduletable": stop = true;break;
				default: break;
			}
			i --;
		}		
		LeftSide.bgColor = color;
		<?php }?>
		
		<?php if($user8) {?>
		// get last Module to indentify the color for D4J_User8		
		divModule = document.getElementById("D4J_User8").getElementsByTagName("div");		
		color = '#ff9523';
		i = divModule.length - 1;
		stop = 0;			
		while(i >= 0 && !stop) {						
			switch(divModule[i].className) {				
				case "moduletable-green": color="#85c329";stop = true;break;
				case "moduletable-blue": color="#4096ee";stop = true;break;
				case "moduletable-orange": color="#ff9523";stop = true;break;
				case "moduletable": stop = true;break;
				default: break;
			}
			i --;
		}		
		document.getElementById("D4J_TD_User8").bgColor = color;
		<?php }?>
		
		<?php if($user9) {?> 
		// get last Module to indentify the color for D4J_User9
		divModule = document.getElementById("D4J_User9").getElementsByTagName("div");
		color = '#ff9523';
		i = divModule.length - 1;
		stop = 0;			
		while(i >= 0 && !stop) {						
			switch(divModule[i].className) {				
				case "moduletable-green": color="#85c329";stop = true;break;
				case "moduletable-blue": color="#4096ee";stop = true;break;
				case "moduletable-orange": color="#ff9523";stop = true;break;
				case "moduletable": stop = true;break;
				default: break;
			}
			i --;
		}		
		document.getElementById("D4J_TD_User9").bgColor = color;
		<?php }?>
</script>
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
</html>