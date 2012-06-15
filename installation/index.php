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
<?php if (mosCountModules('right') ) {?>
		#body{background:url(<?php echo _TEMPLATE_URL ?>/images/content_bg01.gif) repeat-y;}
		#header{background:url(<?php echo _TEMPLATE_URL ?>/images/header.gif) no-repeat}
		#footer{background:url(<?php echo _TEMPLATE_URL ?>/images/footer.gif) no-repeat}
		#center{width:553px;}
		#main_bottom{margin-left:5px;width:518px;}
<?php } else { ?>
		#body{background:url(<?php echo _TEMPLATE_URL ?>/images/content_bg02.gif) repeat-y;}
		#header{background:url(<?php echo _TEMPLATE_URL ?>/images/header_no_right.gif) no-repeat}
		#footer{background:url(<?php echo _TEMPLATE_URL ?>/images/footer_no_right.gif) no-repeat}
		#center{width:580px;}
		#center .moduletable{width:560px;}
		#main_bottom{width:560px;}
<?php } ?>
	</style>
			<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
		<![endif]-->
</head>

<body><center>

<div id="container">

	<div id="header">
		<div id="header_left">
			<?php if (mosCountModules('header')) mosLoadModules('header', -1); else
				echo '<h1 title="'.$mosConfig_sitename.'"><a href="'.$mosConfig_live_site.'" title="'.$mosConfig_sitename.'">'.$mosConfig_sitename.'</a></h1>';?>
		</div>
		<div id="header_right">
			<div class="user1">
			<?php if (mosCountModules('user1')) mosLoadModules('user1',-1); else
				echo '<h2><a href="http://designforjoomla.com">DesignForJoomla</a></h2>';?>
			</div>
		</div>
		<div class="clr"><!-- --></div>
		<div id="topmenu">
			<div id="top">
				<?php
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
			} ?>
			</div>
		</div>
	</div>

	<div id="body">
		<div id="center">
			<div id="main_bottom">
				<?php mosMainBody();?>
			</div>
		</div>
		<?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2); ?></div><?php } ?>
		<div class="clr"><!-- --></div>
	</div>

	<div id="footer">
		<?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/footer.css.php');?>
	</div>
</div>

</center>
<?php if(!mosCountModules('footer')) {?><div id="bottom"><?php include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?></div><?php }?>
</body>

</html><!-- Joomla Template by DesignForJoomla.com -->