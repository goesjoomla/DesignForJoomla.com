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
	<?php if(mosCountModules('right')) { ?>
		#center{width:507px !important;width:505px}
	<?php } else { ?>
		#center{width:100%}
	<?php } ?>
	</style>
		<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
		<style type="text/css">
	<?php if(mosCountModules('right')) { ?>
.contentpaneopen,.component,.contentpane,.contentpane table{margin:0 10px 0 5px;width:96%}
	<?php } ?>
	</style>
	<![endif]-->
</head>
<body>
<center>
<div id="container">
	<div id="header">
		<div id="header_left">
			<div class="logo"><h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1></div>
		</div>
		<div id="header_info">
			<div id="user1">
				<?php
				echo '<b>';
				echo date(_DATE_FORMAT);
				echo '</b><br/>';
				if(mosCountModules('user1')) mosLoadModules('user1',-1);
						 ?>
			</div>
			<div id="loginform">
				<?php
					   $name = $params->def('name',1);
                       if ( $my->id )
					   {
					      if ($name)
						  {
						        $name = $my->name;
                          }   else
						  	  {
                              	   $name = $my->username;
                              }
						   echo "Hi, <b>$name</b>. Welcome to our site.<br/> Click ";
                           echo '<a href="';
						   echo sefRelToAbs( 'index.php?option=logout' );
						   echo '">here</a> to logout!!';
                       }else
					   		{
								echo "<b>You are not Logged in! </b>";
                                echo '<a href="';
								echo sefRelToAbs( 'index.php?option=com_login&amp;Itemid=4' );
								echo '">'._BUTTON_LOGIN.' </a>to check your messages.';
								echo "<br/>Do you want to ";
								echo '<a href="';
								echo sefRelToAbs( 'index.php?option=com_login&amp;Itemid=4' );
								echo '">'._BUTTON_LOGIN.'</a>';
								$registration_enabled         = $mainframe->getCfg( 'allowUserRegistration' );
                                if ( $registration_enabled ) {
                                echo ' or ';
								echo '<a href="';
								echo sefRelToAbs('index.php?option=com_registration&amp;task=register' );
								echo '">'._CREATE_ACCOUNT.'</a>?';
														}                           }
						?>

			</div>
		</div>
	</div>
	<div id="topmenu">
		<div class="link">
		<?php echo '<ul><li class="browse_category">Select '._SEARCH_TITLE.' Category:</li>'?>
		<?php
		$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
		if ($rows = $database->loadObjectList()) {
			for ($i = 0, $n = count($rows); $i < $n; $i++) {
				$id = $Itemid == $rows[$i]->id ? ' class="active_menu1"' : '';
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
			<div class="clr"></div>
			<div class="text">
			 <?php
					   $name = $params->def('name',1);
                       if ( $my->id )
					   {
					      if ($name)
						  {
						        $name = $my->name;
                          }   else
						  	  {
                              	   $name = $my->username;
                              }
						   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hi, $name !!!";
                       } else {
								echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please '?>
								<a href="<?php echo sefRelToAbs( 'index.php?option=com_login&amp;Itemid=4' ); ?>">
                                <?php echo _BUTTON_LOGIN; ?></a>
								<?php echo " or"?>
                                <?php
									  $registration_enabled         = $mainframe->getCfg( 'allowUserRegistration' );
                                      if ( $registration_enabled ) { ?>
                              	<a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=register' ); ?>">
                                <?php echo _CREATE_ACCOUNT; ?></a>
                                <?php } }?>
			</div>
			<div class="search">
				<div class="text">
				<?php echo _SEARCH_TITLE.' the web:&nbsp;'?>
				</div>
				<div class="input">
				<input type="text" name="searchword" class="inputbox" value="" alt="enter keyword"/>
				</div>
				<div class="button">
				<?php echo '&nbsp;&nbsp;'?><input type="submit" value="<?php echo _SEARCH_TITLE ?>" class="submit" alt="" onfocus="if(this.value=='<?php echo _SEARCH_TITLE ?>...'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _SEARCH_TITLE ?>...';}"/>
				</div>

			</div>
         </form>
	</div>
	<div id="body">
		<div id="center">
			<?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2); ?></div><?php } ?>
			<div id="main">
				<?php
					mosMainBody()
				?>
			</div>
			<div class="clr"><!-- --></div>
		</div>
		<?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2); ?></div><?php } ?>
	</div>
	<div id="footer">
		<?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?>
	</div>

</div>

</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->