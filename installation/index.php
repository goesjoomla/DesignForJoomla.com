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
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
<style type="text/css">
<?php if(mosCountModules('left') and mosCountModules('right')) {?>
	#center{background:#ffffff url(<?php echo _TEMPLATE_URL ?>/images/innerbg.gif) repeat-y}
	#centerIn{background:url(<?php echo _TEMPLATE_URL ?>/images/header.jpg) top left no-repeat}
	#main{margin-right:9px}
<?php } else if(mosCountModules('left') and !mosCountModules('right')) {?>
	#main{width:538px;margin-right:12px}
<?php } else if(!mosCountModules('left') and mosCountModules('right')) {?>
	#center{background:#ffffff url(<?php echo _TEMPLATE_URL ?>/images/innerbg2.jpg) repeat-y}
	#centerIn{background:url(<?php echo _TEMPLATE_URL ?>/images/header2.jpg) top left no-repeat}
	#main{float:left;width:563px;margin-left:14px}

<?php } else if(!mosCountModules('left') and !mosCountModules('right')) {?>
	#center{background:#ffffff url(<?php echo _TEMPLATE_URL ?>/images/innerbg2.jpg) repeat-y}
	#centerIn{background:url(<?php echo _TEMPLATE_URL ?>/images/header2.jpg) top left no-repeat}
	#main{float:left;width:700px;margin-left:17px}
<?php }?>
</style>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if(mosCountModules('left') and !mosCountModules('right')) {?>
	#main{margin-right:6px}
<?php } else if(!mosCountModules('left') and mosCountModules('right')) {?>
	#main{width:550px;margin-left:10px}
<?php } else if(!mosCountModules('left') and !mosCountModules('right')) {?>
	#main{width:675px}
<?php }?>
</style>

<![endif]-->
<!--[if gte IE 7.]>
<style type="text/css">
#center{margin-top:90px}
<?php if(mosCountModules('left') and !mosCountModules('right')) {?>
	#main{width:535px;margin-right:14px}
<?php } else if(!mosCountModules('left') and mosCountModules('right')) {?>
	#main{margin-left:18px}
<?php } else if(!mosCountModules('left') and !mosCountModules('right')) {?>
	#main{width:693px}
<?php } else {?>
	#main{margin-right:13px}
<?php }?>
</style>
<![endif]-->
</head>

<body><center>

<div id="container">
	<div id="header">
		<div id="logo">
		<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
			else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>
			<h2>to <b>place</b> for <em>your slogan ...</em></h2>';?>
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
	<div id="center">
		<div id="centerIn">
			<div id="pathway">
				<?php mosPathWay(); ?>
			</div>
			<?php if(mosCountModules('right')) {?>
			<div id="rightside">
				<?php mosLoadModules('right',-2);?>
			</div>
			<?php }?>
			<div id="main">
				<?php mosMainBody();?>
				<?php if(mosCountModules('bottom')) {?><div id="bottom"><?php mosLoadModules('bottom', -2)?></div><?php }?>
			</div>
			<?php if(mosCountModules('left')) {?>
			<div id="leftside">
				<?php mosLoadModules('left',-2);?>
			</div>
			<?php }?>
			<div class="clr"></div>
			<div id="footer">
	<?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?>
			</div>

		</div>
	</div>
</div>

<div class="clr"></div>
	</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->