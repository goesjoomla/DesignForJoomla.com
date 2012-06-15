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
	<?php if ($my->id) initEditor() ?>
	<?php mosShowHead() ?>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />

	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css_ie.css" />
		<style type="text/css">
			<?php if(mosCountModules('footer')) {?>
				#footer{padding:7px}
			<?php }?>
		</style>
		<![endif]-->
</head>

<body><center>
<div id="container">

	<div id="header">
		<div id="user8"><?php
			if (mosCountModules('user8')) mosLoadModules('user8', -1);
			else echo '<img src="'._TEMPLATE_URL.'/images/header.jpg" width="320" height="300" alt="" />';?>
		</div>
		<div id="user1">
			<?php if (mosCountModules('user1')) mosLoadModules('user1', -2);
	else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'">'.'Rose Kist'.'<a href="<?php echo $mosConfig_live_site ?>" title="<?php echo $mosConfig_sitename ?>"><?php echo $mosConfig_sitename ?></a></h1>
			<h2>to <b>place</b> for <em>your slogan ...</em></h2>';?>
		</div>
		<div id="pathway">
			<?php mosPathway() ?>
		</div>
	</div>
	<div class="clr"> <!-- --> </div>

	<div id="body">
		<div id="spacer1"> <!-- --> </div>
		<div id="navigation"><?php
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
					echo '<li><a href="'.$link.'" class="mainlevel">'.$rows[$i]->name.'</a></li>';
			} ?></ul><?php } ?>
		</div>
		<div id="spacer2"> <!-- --> </div>
		<?php if (mosCountModules ('top')) { ?><div id="top"><?php mosLoadModules('top', -2) ?></div><?php } ?>
		<div id="main">	<?php mosMainbody() ?> </div>
		<?php if (mosCountModules ('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2) ?></div><?php } ?>
		<div class="clr"> <!-- --> </div>
	</div>

	<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>

</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->