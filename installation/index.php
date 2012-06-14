<?php /* Joomla Template by DesignForJoomla.com */
/* Custom Settings Begin *****************************************************/
$texteffect = 1;// 1: Enable; 0: Disable
/******************************************************* Custom Settings End */

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
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
<style type="text/css">
<?php if(!mosCountModules('left') and !mosCountModules('right')) {?>
#center,#bottom,#top{width:590px}
#right{display:none}
textarea#contact_text.inputbox{width:500px}
<?php }?>
</style>
<!--[if gte IE 7.]>
<style type="text/css">
#menu ul{padding-bottom:14px}
</style>
<![endif]-->
	<?php if ($texteffect) { ?>
	<script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
	<?php } ?>
</head>

<body>
<center>
<div id="container">	
	<div id="header">
		<div id="logo">
			<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>'?>
		</div>
	</div>	
	<div id="menu">
		<?php 
			echo '<ul>';
				$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
				if ($rows = $database->loadObjectList()) {
					for ($i = 0, $n = count($rows); $i < $n; $i++) {
						$id = $Itemid == $rows[$i]->id ? ' class="current"' : '';
						$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
						$link = ampReplace($link);
						if ($rows[$i]->browserNav == 1) {
							$link .= '" target="_blank';
						} elseif ($rows[$i]->browserNav == 2) {
							$link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
						}
						echo '<li><a href="'.$link.'" class="mainlevel">'.$rows[$i]->name.'</a></li>';
				}
				} 
				echo '</ul>';
				?>
	</div>
	<div id="roundedheader">&nbsp;</div>	
	<div id="body">
		<div id="center">
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
		<div id="right">
			<?php if(mosCountModules('left')){?>
			<div id="right_top">
				<?php mosLoadModules('left',-2)?>
			</div>
			<?php }?>
			<?php if(mosCountModules('right')){?>
			<div id="right_bottom">
				<?php mosLoadModules('right',-2)?>
			</div>
			<?php }?>
		</div>		
		<div class="clearer"></div>
		
	</div>
	<div id="roundedfooter">&nbsp;</div>	
	<div id="footer">
		<?php if (mosCountModules('footer')) {?>
		<div class="copyright">
		<?php mosLoadModules('footer', -1);?>
		</div>
		<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
	</div>	
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
</body>
</html><!-- Joomla Template by DesignForJoomla.com -->