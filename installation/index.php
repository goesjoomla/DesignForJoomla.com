  <?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/thecoffeeshop' );
define( '_TEMPLATE_PATH', $mosConfig_absolute_path.'/templates/thecoffeeshop');

$iso = split( '=', _ISO );

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS

//--------- Menu Settings -------------//
$d4j_menu_type = 1; // 1: dropdown menu ( suckerfish menu ); 2: transmenu.
					
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
	$bottomusers = 0;
	if(mosCountModules('user5')) { $user5 = 1; $bottomusers++;}
	if(mosCountModules('user6')) { $user6 = 1; $bottomusers++;}
	if(mosCountModules('user7')) { $user7 = 1; $bottomusers++;}
	$footerusers = 0;
	if(mosCountModules('user8')) { $user8 = 1; $footerusers++;}
	if(mosCountModules('user9')) { $user9 = 1; $footerusers++;}
	if(mosCountModules('advert1')) { $advert1 = 1; $footerusers++;}
	if(mosCountModules('advert2')) { $advert2 = 1; $footerusers++;}
	if(mosCountModules('advert3')) { $advert3 = 1; $footerusers++;}
	$usersLength = 474;
	$usersLength2 = 750;	
		
	if(!mosCountModules('left') && !mosCountModules('right')) $left_side = 0; else $left_side = 1;
?>
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/style/d4j_stylechanger.js">
</script>
<script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
// ]]></script>
<style type="text/css">
<?php if(!$left_side) {
$usersLength = 714;
?>
#D4J_LeftSide{display:none}
#D4J_RightSide{margin-left:0;width:100%}
#D4J_TopUsers,#D4J_CenterUsers,#D4J_Main{margin:20px 0 0 20px;width:715px}
#D4J_Top,#D4J_Newsflash,#D4J_Bottom{width:755px;margin-left:0}
<?php }?>
<?php if(!mosCountModules('toolbar')) {?>
#D4J_TopPage{height:250px;background-position:0 -60px}
#D4J_Inset{top:180px}
#D4J_SiteTools{top:205px}
<?php }?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">
<?php if($left_side){?>
#D4J_RightSide{margin-left:25px}
<?php }?>
</style>
<![endif]-->
<!--[if ge IE 7.]>
<style type="text/css">
#D4J_Container{margin-top:-20px}
#D4J_MainMenu ul.list_menu li li:hover ul,
#D4J_MainMenu ul.list_menu li li li:hover ul,
#D4J_MainMenu ul.list_menu li li li li:hover ul,
#D4J_MainMenu ul.list_menu li li li li li:hover ul,
#D4J_MainMenu ul.list_menu li li.sfhover ul,
#D4J_MainMenu ul.list_menu li li li.sfhover ul,
#D4J_MainMenu ul.list_menu li li li li.sfhover ul,
#D4J_MainMenu ul.list_menu li li li li li.sfhover ul{/* pull-out sub-menu :: active state */	
	float:none
}
</style>
<![endif]-->
</head>
<body>
<center>
<div id="D4J_Container">
	<div id="D4J_TopPage">
		<?php if(mosCountModules('toolbar')) {?>
		<div id="D4J_MainMenu">
			<center>
			<table><tr><td>
			<?php mosLoadModules('toolbar',-1);?>
			</td></tr></table>
			</center>
		</div>
		<?php }?>
		<div id="D4J_HeaderImages">					
			<div id="D4J_Header">
				<?php if(mosCountModules('header')) { mosLoadModules('header',-1); } else echo '<img src="'._TEMPLATE_URL.'/images/header.gif" alt=""/>';?>
			</div>
			<div id="D4J_Banner">				
				<?php if(mosCountModules('banner')) { mosLoadModules('banner',-1); } else echo '<img src="'._TEMPLATE_URL.'/images/banner.jpg" alt=""/>';?>

			</div>			
			<div class="clearer"><!-- --></div>
		</div>
		<div id="D4J_Inset">
			<?php if(mosCountModules('inset')) {mosLoadModules('inset',-1);}?>
		</div>
		<div class="clearer"><!-- --></div>
	</div>	
	<div id="D4J_MainPage">
	<div id="D4J_MainPage_In">
		<div id="D4J_LeftSide">
			<?php if(mosCountModules('left')) {?>
			<div id="D4J_Left">
				<?php mosLoadModules('left',-2);?>
			</div>
			<?php }?>
			<?php if(mosCountModules('right')) {?>
			<div id="D4J_Right">
				<?php mosLoadModules('right',-2);?>
			</div>
			<?php }?>
		</div>
		<div id="D4J_RightSide">
			<?php if(mosCountModules('newsflash')) {?>
			<div id="D4J_Newsflash">
				<?php mosLoadModules('newsflash',-2);?>				
			</div>
			<?php }?>	
			<?php if($topusers > 0) {?>	
			<div id="D4J_TopUsers">
				<?php if($user1) {?>
				<div id="D4J_User1" style="width:<?php echo (($usersLength - 10*($topusers - 1))/$topusers).'px';?>">
					<?php mosLoadModules('user1',-2);?>
				</div>
				<?php }?>
				<?php if($user2) {?>
				<div id="D4J_User2" style="width:<?php echo (($usersLength - 10*($topusers - 1))/$topusers).'px';?>;<?php if($user1) echo 'margin-left:10px';?>">
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
				<div id="D4J_User3" style="width:<?php echo (($usersLength - 10*($centerusers - 1))/$centerusers).'px';?>">
					<?php mosLoadModules('user3',-2);?>
				</div>
				<?php }?>
				<?php if($user4) {?>
				<div id="D4J_User4" style="width:<?php echo (($usersLength - 10*($centerusers - 1))/$centerusers).'px';?>;<?php if($user1) echo 'margin-left:10px';?>">
					<?php mosLoadModules('user4',-2);?>
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
		</div>
		<div class="clearer"><!-- --></div>
		<?php if($bottomusers > 0) {?>
		<div id="D4J_BottomUsers">
			<?php if($user5) {?>
			<div id="D4J_User5" style="width:<?php echo (($usersLength2 - 10*($bottomusers - 1))/$bottomusers).'px';?>">
				<?php mosLoadModules('user5',-2);?>
			</div>
			<?php }?>				
			<?php if($user6) {?>
				<div id="D4J_User6" style="width:<?php echo (($usersLength2 - 10*($bottomusers - 1))/$bottomusers).'px';?>;<?php if($user5) echo 'margin-left:10px';?>">
					<?php mosLoadModules('user6',-2);?>
				</div>
				<?php }?>				
			<?php if($user7) {?>
				<div id="D4J_User7" style="width:<?php echo (($usersLength2 - 10*($bottomusers - 1))/$bottomusers).'px';?>;<?php if($user5 || $user6) echo 'margin-left:10px';?>">
					<?php mosLoadModules('user7',-2);?>
				</div>
			<?php }?>				
		</div>
		<?php }?>
	</div>
	<div class="clearer"><!-- --></div>
	</div>
</div>
<div id="D4J_BottomPage">
		<?php if($footerusers > 0) {?>
			<table id="D4J_FooterUsers" cellspacing="20px" cellpadding="10px">			
			<tr>
				<?php if($user8) {?>				
				<td width="<?php echo (100/$footerusers).'%';?>" valign="top">
				<div id="D4J_User8" >
					<?php mosLoadModules('user8',-2);?>
				</div>
				</td>
				<?php }?>				
				<?php if($user9) {?>
					<td width="<?php echo (100/$footerusers).'%';?>" valign="top">
					<div id="D4J_User9">
						<?php mosLoadModules('user9',-2);?>
					</div>
					</td>
					<?php }?>				
				<?php if($advert1) {?>
					<td width="<?php echo (100/$footerusers).'%';?>" valign="top">					
					<div id="D4J_Advert1">
						<?php mosLoadModules('advert1',-2);?>
					</div>
					</td>
				<?php }?>
				<?php if($advert2) {?>
					<td width="<?php echo (100/$footerusers).'%';?>" valign="top">
					<div id="D4J_Advert2">
						<?php mosLoadModules('advert2',-2);?>
					</div>
					</td>
					<?php }?>				
				<?php if($advert3) {?>
					<td width="<?php echo (100/$footerusers).'%';?>" valign="top">
					<div id="D4J_Advert3">
						<?php mosLoadModules('advert3',-2);?>
					</div>
					</td>
				<?php }?>	
			</tr>
			</table>			
		<?php }?>
		<div class="clearer"><!-- --></div>
		<div id="D4J_Footer">	
			<div class="copyright">
				<?php if (mosCountModules('footer')) { mosLoadModules('footer', -1);}
			else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
			</div>
		</div>
	</div>
<?php if($site_tools) {?>
<div id="D4J_SiteTools">
	<?php writetools();?>
</div>
<?php }?>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
</body>
</html>