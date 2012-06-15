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
<style type="text/css">
	<?php if(!mosCountModules('left')) {?>
		#center_column{width:750px;border-left:none}
	<?php } ?>
</style>
<!--[if lt IE 7.]>
<style type="text/css">
	#nav{width:742px}
	#header{margin-top:-7px}
	#footer_text{height:86px}
<?php if((mosCountModules('right')) AND (mosCountModules('left'))){?>
	#bottom{width:400px}
<?php }?>
</style>
<![endif]-->

</head>
<body>
<center>
<div id="container">
	<div id="top_page"></div>
 	<div id="header">    
		<div id="logo"><h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
		</div>	
		<div id="slogan">			
				<?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
					else echo '<h1 title="'.$GLOBALS['mosConfig_sitename'].'"><a href="'.$GLOBALS['mosConfig_live_site'].'" title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</a></h1>Your company slogan goes here'?>						
		</div>	
	</div>
    <div id="nav">
    <?php 
			echo '<ul>';
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
						echo '<li><a href="'.$link.'" >'.$rows[$i]->name.'</a></li>';
				}
				} 
				echo '</ul>';
				?>
    </div>
    <div id="body">
    	<?php if(mosCountModules('left')){?>
			<div id="left">
				<?php mosLoadModules('left',-2)?>
			</div>
		<?php }?>
    	<div id="center_column">
      		<?php if(mosCountModules('right')){?>
				<div id="right">
					<?php mosLoadModules('right',-2)?>
				</div>
		<?php }?>
    			<?php if (mosCountModules('top')) mosLoadModules('top', -2); ?>
				<?php mosMainBody()?>
		<?php if(mosCountModules('bottom')){?>
				<div id="bottom">
					<?php mosLoadModules('bottom',-2)?>
				</div>
			<?php }?>
    	</div>
    </div> 
	<div class="clearer"><!-- --></div>
 	<div id="footer">
		<div id="footer_text">
    		<?php if (mosCountModules('footer')) {?>
			<div class="copyright">
				<?php mosLoadModules('footer', -1);?>
			</div>
			<?php } else include_once(_TEMPLATE_PATH.'/css/bottom.css.php');?>
		</div>
	 	<div class="clearer"><!-- --></div>
	</div>	
<div id="bottom_page"><!-- --></div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?>
</body>
</html><!-- Joomla Template by DesignForJoomla.com -->