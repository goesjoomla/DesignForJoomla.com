<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

$_left = mosCountModules('left');
$_right = mosCountModules('right');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php if ( $my->id ) initEditor() ?>
<?php mosShowHead() ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
<?php if (!$_left AND !$_right) { // both 'left' and 'right' positions empty, dont show right column ?>
	<style type="text/css">
	#col1{float:none;width:700px}
	#col1content {width:670px}
	#wrapper{width: 700px;margin-right: auto;margin-left: auto;background:url(<?php echo _TEMPLATE_URL; ?>/images/column2.jpg) repeat-y;text-align: left;background-color: #FFFFFF}
	#shadow{background:url(<?php echo _TEMPLATE_URL; ?>/images/shadow2.jpg)}
	</style>
<?php } ?>
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
	<?php if (!$_left AND !$_right) { // both 'left' and 'right' positions empty, dont show right column ?>
	<style type="text/css">
	#col1{float:none;width:670px}
</style>
<?php } ?>
	<![endif]-->
</head>

<body><center>
<div id="wrapper">
	<div id="slogan">
		<?php if (mosCountModules('header')) mosLoadModules('header', -2); else
			echo '<h1 title="'.$mosConfig_sitename.'"><a href="'.$mosConfig_live_site.'" title="'.$mosConfig_sitename.'">'.$mosConfig_sitename.'</a></h1>
			<h2 title="Your slogan here">Your slogan here</h2>';
		?>
	</div>
	<div id="mainphoto">
			<?php if (mosCountModules('user9')) { ?><div id="user9"><?php mosLoadModules('user9',-1); ?></div><?php } ?>
			</div>
	<div id="nav">
      	<?php
			$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
			if ($rows = $database->loadObjectList()) {
				echo '<ul id="navlist">';
				for ($i = 0, $n = count($rows); $i < $n; $i++) {
					$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
					$link = ampReplace($link);
					if ($rows[$i]->browserNav == 1) {
						$link .= '" target="_blank';
					} elseif ($rows[$i]->browserNav == 2) {
						$link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
					}
					echo '<li><a href="'.$link.'">'.$rows[$i]->name.'</a></li>';
				}
				echo '</ul>';
			} ?>
    </div>
<!-- end nav -->
	<div id="shadow"></div>
	<div id="col1">
		<div id="col1content">
			<?php mosMainBody() ?>
		</div>
	</div>
<!-- end col1 -->
	<?php if ($_left OR $_right) { ?><div id="col2">
		<div id="col2content">
	<?php if ($_left) mosLoadModules('left', -2); ?>
	<?php if ($_right) mosLoadModules('right', -2); ?>
</div><!-- end col2content -->
</div><!-- end col2 --><?php } ?>

<div id="footer"><p><?php
	$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'topmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
	if ($rows = $database->loadObjectList()) {
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
			$link = ampReplace($link);
			if ($rows[$i]->browserNav == 1) {
				$link .= '" target="_blank';
			} elseif ($rows[$i]->browserNav == 2) {
				$link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
			}
			echo '<a href="'.$link.'">'.$rows[$i]->name."</a>\n";
		}
	}
	echo '&copy; '.$mosConfig_sitename;
	?></p></div>

</div><!-- end wrapper -->
	
	<div id="bottom"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once("$mosConfig_absolute_path/templates/$cur_template/css/bottom.css.php"); ?></div>
</center><?php include_once($GLOBALS['mosConfig_absolute_path'].'/templates/'.$GLOBALS['cur_template'].'/css/footer.css.php') ?>
</body>
</html>
