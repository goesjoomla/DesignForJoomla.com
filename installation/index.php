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

<!--[if IE]>
	<style type="text/css">
		.pollstableborder td{padding:0}
		.poll{margin-top:-15px}
		#center{margin-left:11px;width:332px}
		#right{margin-right:11px;margin-top:0}
	</style>
<![endif]-->
<!--[if gte IE 7.]>
	<style type="text/css">
		#center{margin-left:20px;width:334px}
		#right{margin-right:23px}
	</style>
<![endif]-->
<style type="text/css">
	<?php if(!mosCountModules('left') and !mosCountModules('right')) {?>
		#center{width:700px}
		.contact_email textarea#contact_text{width:680px}
	<?php }?>
	<?php if(!mosCountModules('user9')){?>
		#banner{display:none}
	<?php }?>
	<?php if(!mosCountModules('top')){?>
		#top{display:none}
	<?php }?>
</style>
</head>
<body><center>
	
<div id="container">
	<div id="topmenu">
            <?php echo'<ul id="nav">';
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
	<div id="header">
		<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
			else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>'?>    
	</div>
    <div id="body">
      <div id="toplink">
	  	<div id="statictis">
			<?php if(mosCountModules('user8')) mosLoadModules('user8',-1); else {echo date(_DATE_FORMAT);} ?>
		</div>
		<div id="linkbutton">
        <?php echo'<ul>';
				$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'topmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
				$arrClass = array("blue","red","orange","green");
				if ($rows = $database->loadObjectList()) {
					for ($n = count($rows),$i = $n-1; $i >= $n-4; $i--) {						
						$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
						$link = ampReplace($link);
						if ($rows[$i]->browserNav == 1) {
							$link .= '" target="_blank';
						} elseif ($rows[$i]->browserNav == 2) {
							$link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
						}						
						echo '<li class="'.$arrClass[$n-$i-1].'"><a href="'.$link.'">'.$rows[$i]->name.'</a></li>';
				}
				echo '</ul>';} ?>   
			</div>     
      </div>
      <div id="banner">
			<?php if(mosCountModules('user9')) mosLoadModules('user9',-1)?>
      </div>
      <div id="top">
	  	<div id="intop">
        <?php if(mosCountModules('top')) mosLoadModules('top',-2)?>
		</div>
      </div>
      <div id="inbody">		
		<div id="center">
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
		<div class="clearer"></div>
	</div>
    <div id="footer">
			<?php if (mosCountModules('footer')) {?>
			<div class="copyright">
			<?php mosLoadModules('footer', -1);?>
			</div>
			<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>		
	</div>		
    </div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
  </body>
</html>
