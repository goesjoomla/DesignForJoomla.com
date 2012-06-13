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
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
		<style type="text/css">
<?php if ((mosCountModules ('right')) OR (mosCountModules ('left'))) { ?>
		#mainbody{width:536px}
		#inner_body{margin:21px 0 58px 14px}
<?php } ?>
<?php if (!mosCountModules ('footer')) { ?>
		 #footer{height:35px;padding-top:10px}
		 #footer *{font-size:11px}
<?php } ?>
</style>
		<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
		<style type="text/css">
<?php if ((mosCountModules ('right')) OR (mosCountModules ('left'))) { ?>
		#mainbody{width:536px}
		#inner_body{margin:21px 0px 58px 16px}
<?php } ?>
</style>
	<![endif]-->
</head>
	<body> <center>
<div id="container">
	<div id="header">
		<div id="slogan">
			<?php if (mosCountModules('user1')) mosLoadModules('user1', -2);
			else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</h1>
			<h2>to <b>place</b> for <em>your slogan ...</em></h2>';?>
		</div>
		<div class="clearer"><!-- --></div>
		<div id="hmenu"><?php
		$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
		if ($rows = $database->loadObjectList()) {
			?><ul id="mainmenu"><?php
			for ($i = 0, $n = count($rows); $i < $n; $i++) {
				//$id = $Itemid == $rows[$i]->id ? ' id="active_menu"' : '';
				$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
				$link = ampReplace($link);
				if ($rows[$i]->browserNav == 1) {
					$link .= '" target="_blank';
				} elseif ($rows[$i]->browserNav == 2) {
					$link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
				}
					//echo '<a href="'.$link.'" class="mainlevel"'.$id.'>'.$rows[$i]->name.'</a>';
				if ($i==0) {
                                echo '<li><a href="'.$link.'" class="first">'.$rows[$i]->name.'</a></li>';
                                } else {
				echo '<li><a href="'.$link.'" class="mainlevel">'.$rows[$i]->name.'</a></li>';}
			} ?></ul><?php } ?>
		</div>
	</div>

	<div id="body">
		<div id="mainbody"><div id="inner_body"><?php mosMainbody() ?></div></div>
		<div id="right">
		<?php if (mosCountModules('left')) { ?><div id="inner_left"><?php mosLoadModules('left',-2); ?></div><?php } ?>
		<?php if (mosCountModules('right')) { ?><div id="inner_right"><?php mosLoadModules('right',-2); ?></div><?php } ?>
		</div>
		<div class="clearer"><!-- --></div>
	</div>

	<div id="footer" ><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>

</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->