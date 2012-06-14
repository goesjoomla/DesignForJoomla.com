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
	<style type="text/css"><!--
	div#content{float:none;width:700px}
	--></style>
<?php } else { // show right column ?>
	<!--[if gte IE 7]>
	<style type="text/css">
	div.moduletable img{margin-left:10px}
	select#mod_templatechooser_jos_change_template{width:133px}
	</style>
	<![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
	<![endif]-->
	
<?php } ?>
</head>

<body>

<div id="container">
	<div id="header"><?php if (mosCountModules('header')) { ?><div id="inner_header"><?php mosLoadModules('header',-1); ?></div><?php } 
		else echo '<h1 title="'.$mosConfig_sitename.'"><a href="'.$mosConfig_live_site.'" title="'.$mosConfig_sitename.'">'.$mosConfig_sitename.'</a></h1>';
	?></div>

	<div id="wrapper">
		<div id="content">
			<div id="linkbar"><p><?php
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
					echo '<a href="'.$link.'">'.$rows[$i]->name."</a>\n";
				}
			} ?></p></div>
			<?php mosMainBody() ?>
		</div>

		<?php if ($_left OR $_right) { ?><div id="sidebar">
			<?php if ($_left) { ?><div id="navigation">
				<?php mosLoadModules('left', -2); ?>
			</div><?php } ?>

			<?php if ($_right) { ?><div id="extra">
				<?php mosLoadModules('right', -2); ?>
			</div><?php } ?>
		</div><?php } ?>
	</div>

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
		?></p>
<div class="clearer"><!-- --></div>
<div id="footer2" ><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div></div>
</div>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html>