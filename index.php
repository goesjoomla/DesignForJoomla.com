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
	<style type="text/css">
		<?php if (mosCountModules('left')) { ?>
			#main{width:536px;float:left}
			#left{width:181px;float:left}
		<?php } else { ?>
			#main{width:536px;float:right}
		<?php } ?>
	</style>

	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css_ie.css" />
	<style type="text/css">

	</style>
		<![endif]-->
</head>

<body><center>
	<div id="container">
		<div id="header">
			<div id="logo"><h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1></div>
			<div id="slogan"><?php if (mosCountModules('header')) mosLoadModules('header', -2); else {
				echo '<div class="moduletable"><h3 title="'.$mosConfig_sitename.'">'.$mosConfig_sitename.'</h3>to <b>place</b> for <em>your slogan ...</em></div>';} ?>
			</div>
			<div class="clr"> <!-- --> </div>
			<div id="pathway"><?php mosPathway() ?></div>
			<div class="clr"> <!-- --> </div>
			<div id="date"><?php echo date(_DATE_FORMAT) ?></div>
		</div>
		<div class="clr"> <!-- --> </div>

		<div id="body"><div id="sub_body">
			<div id="left">
				<div id="leftcol">
					<?php if (mosCountModules ('left')) mosLoadModules('left', -2)?>
					<?php if (mosCountModules ('right')) { echo '<hr/>'; mosLoadModules('right', -2) ;} ?>
				</div>
			</div>
			<div id="main">
				<?php if (mosCountModules ('top')) { ?><div id="top"><?php mosLoadModules('top', -2) ;echo '<hr/>'?></div><?php } ?>
				<div id="inner"><?php mosMainbody() ?></div>
    			<?php if (mosCountModules('bottom')) { ?><div id="lower"><?php  echo '<hr/>'; mosLoadModules('bottom', -2)?></div><?php } ?>
    		</div>

			<div class="clr"> <!-- --> </div>
			<div id="footer_main"></div>
		</div></div>
		<div class="clr"> <!-- --> </div>

		<div id="bottom">
			<div id="navbar"><?php
		$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'topmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
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
				if ($i==0) {
                                echo '<a href="'.$link.'" class="buttonbar">'.$rows[$i]->name.'</a>';
                                } else {
                                echo '&nbsp;|&nbsp;<a href="'.$link.'" class="buttonbar">'.$rows[$i]->name.'</a>';}
                           }
		} ?>

        	</div>
			<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
		</div>
	</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->
