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
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<style type="text/css">
<?php if (mosCountModules ('right')) { ?>
                   #left {width:490px;float:left}
                   #lbox_header,#top_header{background:url('<?php echo _TEMPLATE_URL ?>/images/lt.gif') left top no-repeat}
                   #lbox_footer,#top_footer{background:url('<?php echo _TEMPLATE_URL ?>/images/lb.gif') left bottom no-repeat;margin-bottom:15px}
<?php } else { ?>
                   #left {width:760px}
                   #lbox_header,#top_header{background:url('<?php echo _TEMPLATE_URL ?>/images/vlt.gif') left top no-repeat}
                   #lbox_footer,#top_footer{background:url('<?php echo _TEMPLATE_URL ?>/images/vlb.gif') left bottom no-repeat;margin-bottom:15px}
<?php } ?>
<?php if (mosCountModules ('top')) { ?>
                   #top_header{margin:0}
                   #top_footer{margin-bottom:15px}
<?php } else { ?>
                   #top_main,#top_header,#top_footer{background:none;height:1px;overflow:hidden}
<?php } ?>
</style>

<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<![endif]-->
</head>
<body><center>
<div id="content">
         <div id="header">
                    <div id="logo">
                             <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                    </div>
                    <div id="header_right">
                            <div id="top_info_right"> <?php
                                   if ( $my->id ) {
                                        if ( $name ) {
                                                   $name = $my->name;
                                           } else {
                                                   $name = $my->username;
                                           } echo "Hi, <b>$name</b>. Welcome to our site. Click" ?>
                                           <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here " ?></a><?php echo _BUTTON_LOGOUT; }
                                                      else { echo '<b>You are not '._BUTTON_LOGIN.' !</b>' ?>
                                             <a href="<?php echo sefRelToAbs( 'index.php?option=com_login&amp;Itemid=4' ); ?>">
                                           <?php echo _BUTTON_LOGIN; ?></a>
                                           <?php echo " or" ?>
                                           <a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=register' ); ?>">
                                           <?php echo _CREATE_ACCOUNT; ?></a>
                                           <?php }?>
                                 </div>

                                 <div id="bar"><?php $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
                                                            if ($rows = $database->loadObjectList()) {
                        echo'<ul>';
                        for ($i = 0, $n = count($rows); $i < $n; $i++) {
                                $id = $Itemid == $rows[$i]->id ? ' id="active_menu1"' : '';
                                $link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
                                $link = ampReplace($link);
                                if ($rows[$i]->browserNav == 1) {
                                        $link .= '" target="_blank';
                                } elseif ($rows[$i]->browserNav == 2) {
                                        $link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
                                }
                                echo '<li><a href="'.$link.'" class="mainlevel"'.$id.'>'.$rows[$i]->name.'</a></li>';
                                }
                        echo '</ul>';} ?></div>
                    </div>
                </div>

         <div id="field">
                         <div id="newsletter"><?php if (mosCountModules('user1')) mosLoadModules('user1', -1); ; ?></div>
                         <div id="text"><?php echo '<h4>'._SEARCH_TITLE.' Example: </h4>' ?></div>
                         <div id="search_field"><?php $query = "SELECT id"
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
                                                    <div id="inputbox"><input name="searchword" maxlength="20" alt="search" class="inputbox" type="text" value="" /></div>
                                                    <div id="button"><input class="button" type="image" alt="search" src="<?php echo _TEMPLATE_URL ?>/images/button.gif" onclick="document.searchForm.submit();" /></div>
                                               </div>
                                            </form>
                            </div>
         </div>
         <?php if (mosCountModules('user2')) { ?><div id="subheader"><?php mosLoadModules('user2', -2);?></div><?php } ?>
         <div id="mainbody">
                  <div id="left">
                         <?php if (mosCountModules('user3')) { ?><div id="left_articles"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                         <div id="top_main"><div id="top_header"><div id="top_footer"><div id="top">
                              <?php if (mosCountModules('top')) mosLoadModules('top', -2); ?></div>
                              <div class="clr"><!-- --></div></div></div>
                         </div>
                         <div id="lbox_main"><div id="lbox_header"><div id="lbox_footer">
                              <div id="lbox"><?php mosMainbody() ?></div>
                              </div></div>
                         </div>
                  </div>

                  <?php if (mosCountModules( "right" )) { ?>
                         <div class="leftbox">
                         <div id="right" class="leftblock">
                                            <?php mosLoadModules ( "right", -3 ); ?>
                         </div>
                         </div>
                         <?php } ?>

         <div class="clr"><!-- --></div>
         </div>
         <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->