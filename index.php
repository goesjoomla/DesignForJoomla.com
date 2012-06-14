<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', "$mosConfig_live_site/templates/$cur_template" );
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
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
	<![endif]-->
	<style type="text/css">
<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
		#user1,#user2{width:389px}
<?php } elseif (mosCountModules('user1')) { ?>
		#user1{width:780px}
<?php } elseif (mosCountModules('user2')) { ?>
		#user2{width:780px}
<?php } ?>
<?php if (mosCountModules('left') AND mosCountModules('right')) { ?>
		#body{background:#AFC0D0 url(<?php echo _TEMPLATE_URL ?>/images/left_rep.gif) 362px 298px repeat-y}
		#mainbody{width:362px}
<?php } elseif (mosCountModules('left')) { ?>
		#body{background:#AFC0D0 url(<?php echo _TEMPLATE_URL ?>/images/left_rep.gif) 501px 298px repeat-y}
		#mainbody{width:501px}
<?php } elseif (mosCountModules('right')) { ?>
		#body{background:#AFC0D0}
		#mainbody{width:641px}
<?php } else { ?>
		#body{background:#AFC0D0}
		#mainbody{width:780px}
<?php } ?>
	</style>
	<!--[if gte IE 7]>
	<style type="text/css">
	#body{min-height:320px}
	</style>
	<![endif]-->
</head>

<body><center>

<div id="container">
	<div id="header">
		<div id="logo">
			<h1 title="<?php echo $mosConfig_sitename; ?>"><a href="<?php echo $mosConfig_live_site; ?>" title="<?php echo $mosConfig_sitename; ?>"><?php echo $mosConfig_sitename; ?></a></h1>
		</div>
		<div id="topmodule"><?php if (mosCountModules('top')) mosLoadModules('top', -1); ?></div>
		<div id="headerspacer"><!-- --></div>
		<div id="menubar"><?php
		$database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
		if ($rows = $database->loadObjectList()) {
			echo '<ul>';
			for ($i = 0, $n = count($rows); $i < $n; $i++) {
				if ($rows[$i]->type == 'url') {
					$link = $rows[$i]->link;
				} else {
					$link = $rows[$i]->link.'&Itemid='.$rows[$i]->id;
				}
				$link = ampReplace($link);
				echo '<li><a href="'.$link.'">'.$rows[$i]->name.'</a></li>';
			}
			echo '</ul>';
		} ?></div>
		<?php if (mosCountModules('user1') OR mosCountModules('user2')) { ?>
		<div id="pathway"><?php mosPathway(); ?></div>
		<?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2); ?></div><?php } ?>
		<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?><div id="modulespacer"><!-- --></div><?php } ?>
		<?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2); ?></div><?php } ?>
		<div id="headerseparator"><!-- --></div>
		<?php } else { ?>
		<div id="headerseparator"><?php mosPathway(); ?></div>
		<?php } ?>
		<br class="clr" />
	</div>

	<div id="body">
		<div id="mainbody"><div id="innerbody"><?php mosMainbody() ?></div></div>
		<?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2); ?></div><?php } ?>
		<?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2); ?></div><?php } ?>
		<br class="clr" />
	</div>
	<div id="footer">
		<div id="footerseparator"><!-- --></div>
		<div id="bottom"><?php if (mosCountModules('footer')) mosLoadModules('footer', -2); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
	</div>
</div>

</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->