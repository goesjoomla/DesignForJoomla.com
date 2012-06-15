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
<?php if ( $my->id ) initEditor(); ?>
<?php mosShowHead(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<style type="text/css">
<?php if (mosCountModules ('right')) { ?>
                   #content {width:550px;float:left}
                   #posts fieldset{width:522px;overflow:hidden}
<?php } else { ?>
                   #content {width:750px}
                   #posts fieldset{width:720px;overflow:hidden}
<?php } ?>
<?php if (mosCountModules ('user3') and mosCountModules ('user2')) { ?>
                   #sidebar_left {margin-left:1.2px;width:49.25%}
                   #sidebar_middle {margin-left:5.8px;width:49.45%}
<?php } else { ?>
                   #sidebar_middle, #sidebar_left {margin:7px 0 0 0;width:100%}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
                   #menu_bottom{background:#88ac0b url('<?php echo _TEMPLATE_URL ?>/images/menu-background.png') top left repeat-x}
<?php } else { ?>
                   #menu_bottom{background:none;height:0px}
<?php } ?>
</style>
<!--[if lt IE 7]> 
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
 <style type="text/css">
<?php if (mosCountModules ('right')) { ?>
                  #content {width:560px}
                  #posts fieldset{width:540px;overflow:hidden}
<?php } else { ?>
                  #content {width:760px}
                  #posts fieldset{width:720px;overflow:hidden}
<?php } ?>
</style>
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<![endif]-->
</head>
<body><center>
<div id="container">
          <div id="header">
               <div id="headerlink"><?php if (mosCountModules('user1')) mosLoadModules('user1', -2);
                       else echo '
                       <h1 title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</h1>
                       <h2>to <b>place</b> for <em>your slogan ...</em></h2> '?>
               </div>
               <div id="rheader"><?php $query = "SELECT id"
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
                       <div id="search">
                             <div id="inputbox"><input name="searchword" maxlength="20" alt="search" class="inputbox" type="text" value="<?php echo _SEARCH_TITLE; ?> ..." onfocus="if(this.value=='<?php echo _SEARCH_TITLE; ?> ...'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _SEARCH_TITLE; ?> ...';}"/></div>
                             <div id="button"><input class="button" type="image" src="<?php echo _TEMPLATE_URL ?>/images/go.png" style="height:20px" alt="search" onclick="document.searchForm.submit()" /></div>
                       </div>
                       </form>
               </div>
          </div>
          <div id="menu_container">
               <div id="menu"><?php $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
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
                       echo '</ul>';}?>
               </div>
          </div>
          <div class="clr"><!-- --></div>
          <div id="mainbody">
               <div id="content">
                       <?php if (mosCountModules( "user2" )) { ?>
                       <div class="leftbox">
                       <div id="sidebar_left" class="leftblock">
                       <?php mosLoadModules ( "user2", -3 ); ?>
                       </div>
                       </div>
                       <?php } ?>

                       <?php if (mosCountModules( "user3" )) { ?>
                       <div class="leftbox">
                       <div id="sidebar_middle" class="leftblock">
                       <?php mosLoadModules ( "user3", -3 ); ?>
                       </div>
                       </div>
                       <?php } ?>

                       <div id="posts"><?php mosMainbody() ?></div>
                       <div class="clr"><!-- --></div>
               </div>
               <?php if (mosCountModules( "right" )) { ?>
               <div class="leftbox">
               <div id="sidebar" class="leftblock">
               <?php mosLoadModules ( "right", -3 ); ?>
               </div>
               </div>
               <?php } ?>
               <div class="clr"><!-- --></div>
          </div>
          <div id="menu_container_bottom">
                    <div id="menu_bottom"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
          </div>
          <div class="clr"><!-- --></div>
          <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->