<?php /* Joomla Template by DesignForJoomla.com */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFontSize|changeContainerWidth)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

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
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<!--[if lt IE 7.]>
<style type="text/css">
#content{margin-left:9px}
#left{width:62%;margin-left:10px}
#right{width:30%;margin-right:0;padding-right:10px}
</style>
<![endif]-->
<style type="text/css">
<?php if(!mosCountModules('left') and !mosCountModules('right')){?>
#right{display:none;width:0}
#left{border:none;width:90%}
<?php } else {?>
#left{width:60%}
<?php } ?>
</style>

<script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
		var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
<?php if (!mosCountModules('left') and !mosCountModules('right')) { ?>
		var _noRightCol = true;
<?php } else { ?>
		var _noRightCol = false;
<?php } ?>
// ]]></script>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>
<body>
<center>
<div id="container">
	<div id="border">	
	<div id="content">
	<div id="header">
		<div id="title">
			<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>'?>
		</div>
		<div id="tools">
			<a href="<?php echo $CURRENT_URL; ?>changeFontSize=1" title="Increase font size" onclick="changeFontSize(1);return false;">A+</a><a href="<?php echo $CURRENT_URL; ?>changeFontSize=-1" title="Decrease font size" onclick="changeFontSize(-1);return false;">A-</a><a href="<?php echo $CURRENT_URL; ?>changeFontSize=0" title="Revert font size to default" onclick="revertStyles(); return false;">A</a>&nbsp;<br />
			<a href="<?php echo $CURRENT_URL; ?>changeContainerWidth=761" title="View in 800x600 screen resolution" onclick="changeContainerWidth(761);return false;">&gt;&lt;</a><a href="<?php echo $CURRENT_URL; ?>changeContainerWidth=960" title="View in 1024x768 screen resolution" onclick="changeContainerWidth(960);return false;">&lt;&gt;</a><a href="<?php echo $CURRENT_URL; ?>changeContainerWidth=0" title="Auto fit in browser window" onclick="changeContainerWidth(0); return false;">||</a>
	</div>
	</div>
	<div id="nav">
		<?php 
		echo'<ul>';
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
						echo '<li><a href="'.$link.'" class="mainlevel">'.$rows[$i]->name.'</a></li>';
				}
				} 
				echo'</ul>';?>
	</div>
	<div id="body">
		<div id="left">
		<?php if(mosCountModules('top')){?>
			<div id="top">
				<?php mosLoadModules('top',-2)?>
			</div>
		<?php }?>
			<div id="main">
				<?php mosMainBody()?>				
			</div>
		<?php if(mosCountModules('bottom')){?>
			<div id="bottom">
				<?php mosLoadModules('bottom',-2)?>
			</div>
		<?php }?>
		</div>
		<div id="right">
		<?php if(mosCountModules('left')){?>
				<div id="right_top">
					<?php mosLoadModules('left',-2)?>
				</div>
				<?php }?>	
				<?php if(mosCountModules('right')){?>
				<div id="right_bottom">
					<?php mosLoadModules('right',-2)?>
				</div>
				<?php }?>
		</div>	
	</div>
	<div class="clearer"><!-- --></div>
	<div id="footer">
		<?php if (mosCountModules('footer')) {?>
		<div class="copyright">
			<?php mosLoadModules('footer', -1);?>
		</div>
		<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
	</div>
	</div>		
	</div>	
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
</body>
</html>

