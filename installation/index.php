<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );
$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) initEditor(); ?>
<?php mosShowHead(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
<style type="text/css">
<?php if(!mosCountModules('left') and !mosCountModules('right')) {?>
	#center{width:750px;clear:both}
	#center .module{background:url(<?php echo _TEMPLATE_URL ?>/images/box_long_middle.gif) repeat-y center;width:700px}
	#center .module div{background:url(<?php echo _TEMPLATE_URL ?>/images/box_long_bottom.gif) no-repeat bottom center}
	#center .module div div{background:url(<?php echo _TEMPLATE_URL ?>/images/box_long_top.gif) no-repeat top}
	#center .module div div div{width:670px;padding:57px 0 10px 15px}
	#center .module div div div h3{margin:-47px 0 15px -10px;height:33px;overflow:hidden}
<?php } else {?>
	
<?php } ?>
</style>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<![endif]-->
<!--[if gte IE 7.]>
<style type="text/css">
#logo{margin-left:18px}
</style>
<![endif]-->

</head>
<body>
<center>
<div id="container">
	<div id="header">
		<div id="topheader">
			<div id="logo"><h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
			</div>
			<div id="slogan">			
				<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1><h2>A short slogan thing here</h2>'?>
			</div>
			<br/>        
		</div>
		<div id="user9">
			<div class="text">
				<?php if (mosCountModules('user9')) mosLoadModules('user9', -1);
				else echo'user 9 module position<br/>to place for your slogan...<br/>';?>
			</div>
		</div>
		<div id="topmenu">
			  <?php echo'<ul>';
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
						echo '<li '.$id.'><a href="'.$link.'" class="mainlevel">'.$rows[$i]->name.'</a></li>';
				}
				echo '</ul>';} ?>
		</div>
	</div>	
	<div id="body">
		<div id="center">
			<?php if (mosCountModules('top')) {?>
			<div id="top">
				<?php  mosLoadModules('top', -3);?>
			</div>
			<?php }?>
			<div id="main">
				<div class="module">
					<div>
						<div>
							<div>
								<?php mosMainBody()?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if(mosCountModules('bottom')){?>
			<div id="bottom">
				<?php mosLoadModules('bottom',-3)?>		
			</div>
			<?php }?>	
		</div>
		<?php if(mosCountModules('left') or mosCountModules('right')) {?>
		<div id="right">
			<?php if(mosCountModules('left')) {?>
			<div id="right_top">
				<?php mosLoadModules('left',-3)?>
			</div>
			<?php }?>
			<?php if(mosCountModules('right')) {?>
			<div id="right_bottom">
				<?php mosLoadModules('right',-3)?>
			</div>
			<?php }?>
		</div>
		<div class="clr"></div>
		<?php }?>
	</div>
	<div class="clr"></div>
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
</html>
