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
<?php if ( $my->id ) initEditor() ?>
<?php mosShowHead() ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />
	<style type="text/css">
<?php if (mosCountModules('left') AND mosCountModules('right')) { ?>
		#center{width:482px}
		#center div.moduletable{width:482px;background:#EAEAEA url(<?php echo _TEMPLATE_URL ?>/images/img_24s.png) left bottom no-repeat}
		#center div.moduletable h3,#main_top{background:url(<?php echo _TEMPLATE_URL ?>/images/img_22s.png) left top no-repeat}
		#main_rep{background:url(<?php echo _TEMPLATE_URL ?>/images/img_23s.gif) left top repeat-y}
		#main_bottom{background:url(<?php echo _TEMPLATE_URL ?>/images/img_24s.png) left bottom no-repeat}
<?php } elseif (mosCountModules('left') OR mosCountModules('right')) { ?>
		#center{width:641px}
		#center div.moduletable{width:641px;background:#EAEAEA url(<?php echo _TEMPLATE_URL ?>/images/img_24.png) left bottom no-repeat}
		#center div.moduletable h3,#main_top{background:url(<?php echo _TEMPLATE_URL ?>/images/img_22.png) left top no-repeat}
		#main_rep{background:url(<?php echo _TEMPLATE_URL ?>/images/img_23.gif) left top repeat-y}
		#main_bottom{background:url(<?php echo _TEMPLATE_URL ?>/images/img_24.png) left bottom no-repeat}
<?php } else { ?>
		#center{width:800px}
		#center div.moduletable{width:800px;background:#EAEAEA url(<?php echo _TEMPLATE_URL ?>/images/img_24l.png) left bottom no-repeat}
		#center div.moduletable h3,#main_top{background:url(<?php echo _TEMPLATE_URL ?>/images/img_22l.png) left top no-repeat}
		#main_rep{background:url(<?php echo _TEMPLATE_URL ?>/images/img_23l.gif) left top repeat-y}
		#main_bottom{background:url(<?php echo _TEMPLATE_URL ?>/images/img_24l.png) left bottom no-repeat}
<?php } ?>
	</style>
</head>

<body><center>

<div id="container">
	<div id="header">
		<div id="pathway"><?php mosPathway() ?></div>
		<div id="title"><?php if (mosCountModules('header')) mosLoadModules('header', -1); else
		echo '<h1 title="'.$mosConfig_sitename.'"><a href="'.$mosConfig_live_site.'" title="'.$mosConfig_sitename.'">'.$mosConfig_sitename.'</a></h1>';
		?></div>
		<div id="topmenu"><?php
		$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
		if ($rows = $database->loadObjectList()) {
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
				echo '<a href="'.$link.'" class="mainlevel">'.$rows[$i]->name.'</a>';
			}
		} ?></div>
		<div id="date"><?php echo date(_DATE_FORMAT) ?></div>
	</div>

	<div id="body">
		<?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2); ?></div><?php } ?>
		<div id="center">
			<?php if (mosCountModules('top')) mosLoadModules('top', -2); ?>
			<div id="main_rep"><div id="main_top"><div id="main_bottom"><?php
			mosMainBody()
			?><div class="clr"><!-- --></div></div></div></div>
		</div>
		<?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2); ?></div><?php } ?>
		<br class="clr" />
	</div>

	<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -2); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>

</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->