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
	<?php if(mosCountModules('left') and !mosCountModules('right')) {?>
		#left{width:756px}
		#right_side{float:right;width:570px}
		#user2 .module{width:569px !important;width:569px}
	<?php } else if(mosCountModules('right') and !mosCountModules('left')) {?>
		#left{width:590px}
		#top .moduletable{margin-left:1px !important;margin-left:16px}
		#main{margin-left:1px !important;margin-left:16px}
		#right_side{float:right;width:570px !important;width:585px}
		#user2 .module{width:569px !important;width:569px;margin-left:1px !important;margin-left:16px}
	<?php } else if(!mosCountModules('right') and !mosCountModules('left')) {?>
		#left{width:755px}
		#right_side{float:right;width:737px}
		#user2 .module{width:740px !important;width:740px}
	<?php } ?>
</style>
</head>

<body><center>
<div id="container">
		<div class="table_top"></div>

		<div id="header">
			<div id="header_left">
				<div class="logo">
					<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a>
					</h1>
				</div>
			</div>
			<div id="header_right">
				<div id="topmenu">
					<?php echo'<ul>';
						$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
					if ($rows = $database->loadObjectList()) {
						for ($i = 0, $n = count($rows); $i < $n; $i++) {
							$id = $Itemid == $rows[$i]->id ? ' class="active_menu"' : '';
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
				<div id="searchform">
					<?php $query = "SELECT id"
                          . "\n FROM #__menu"
                          . "\n WHERE link = 'index.php?option=com_search'";
                          $database->setQuery( $query );
                          $rows = $database->loadObjectList();
                          // try to auto detect search component Itemid
                          if ( count( $rows ) ) {
                                  $_Itemid        = $rows[0]->id;
                                  $link                 = 'index.php?option=com_search&amp;Itemid='. $_Itemid;
                          } else {
                          // Assign no Itemid
                                  $_Itemid         = '';
                                  $link                 = 'index.php?option=com_search';}?>
					 <form name="searchForm" action="<?php echo $link ?>" method="post" style="margin:0px">
						<input type="hidden" name="option" value="com_search" />
						<input type="hidden" name="Itemid" value="<?php echo $_Itemid ?>"/>
						<?php echo'<p><b>'._SEARCH_TITLE.'</b>';?>
						<input type="text" name="search" class="search" alt="enter keyword"/>
						<input type="submit" value="Go" class="submit" />
						<?php echo'&nbsp; Explore the possibilities!</p>';?>
					 </form>
				</div>
			</div>

		</div>
		<div class="table_bottom"></div>
		<?php if(mosCountModules('user1')) {?>
		<div id="user1"><?php mosLoadModules('user1',-1) ?></div>
		<?php }else {?><div id="grey"></div><?php }?>
		<div class="table_top"></div>
			<div id="left">
				<?php if (mosCountModules('left')) { ?><div id="left_side"><?php mosLoadModules('left', -3); ?></div><?php } ?>
			<div id="right_side">
				<?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2); ?></div><?php } ?>
				<div id="main">
					<?php mosMainBody() ?>
				</div>
				<?php if(mosCountModules('user2')) {?>
				<div id="user2"><?php mosLoadModules('user2',-3)?>
				</div>
				<?php }?>
			</div>
		</div>
		<?php if(mosCountModules('right')) {?><div id="right"><? mosLoadModules('right',-3)?></div><?php }?>
		<div class="table_bottom"></div>
	</div>
		<div id="footer">
			<?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?>
		</div>
</center>
	<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->
