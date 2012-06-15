<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFontSize|changeContainerWidth|changeColor)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

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
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('user6')) { ?>
          #lbox{width:19%}
          #rbox{width:79%}
<?php } else { ?>
          #rbox,#top,#topbox{width:100%;border:none}
          #mainbody{width:97.3%}
          #lbox{width:0px;height:0px}
<?php } ?>
<?php if (mosCountModules('user3') AND mosCountModules('user4')) { ?>
          #user3,#user4{width:49.99%}
<?php } elseif (mosCountModules('user3')) { ?>
          #user3{width:100%}
          #user4{width:0px;height:0px}
          #topbox{background:none}
<?php } elseif (mosCountModules('user4')) { ?>
          #user3{width:0px;height:0px}
          #user4{width:100%}
          #topbox{background:none}
<?php } else { ?>
          #user3,#user4,#topbox{width:0px;height:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right') OR mosCountModules ('user6')) { ?>
<?php } else { ?>
          #mainbody{width:100%}
<?php } ?>
</style>

<![endif]-->
        <script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
                var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
                        // ]]></script>
        <script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>
<body><center>
<div id="container"><div id="container_outer"><div id="inner1"><div id="inner2">
         <div id="header">
                  <div id="logo">
                       <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                  </div>
                  <div id="slogan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
                                   else echo '<h1>Web Design</h1>' ?>
                  </div>
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
                                                     $_Itemid         = '';
                                                     $link                 = 'index.php?option=com_search';}?>
                                                               <form name="searchForm" action="<?php echo $link ?>" method="post" style="margin:0px">
                                                               <input type="hidden" name="option" value="com_search" />
                                                               <input type="hidden" name="Itemid" value="<?php echo $_Itemid ?>"/>
                                                                   <div id="search1">
                                                                       <div id="text"><?php echo "Search our site:" ?></div>
                                                                       <div id="inputbox"><input name="searchword" maxlength="40" alt="search" class="inputbox" type="text" value="Search for..." onfocus="if(this.value=='Search for...'){this.value='';}" onblur="if(this.value==''){this.value='Search for...';}"/></div>
                                                                       <div id="button"><input class="button" type="image" alt="search" src="<?php echo _TEMPLATE_URL ?>/images/button.gif" onclick="document.searchForm.submit();" /></div>
                                                                  </div>
                                       </form>
                  </div>
         </div>
         <div id="subheader">
                  <div id="menu"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,5");
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
                                   echo '</ul>';} ?>
                  </div>
                  <div id="top1"><div id="top2">
                           <div id="buttons">
                                    <div id="button1"><a href="javascript:void(0)"  onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Increase font size" border="0"></img></a></div>
                                    <div id="button2"><a href="javascript:void(0)" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Decrease font size" border="0"></img></a></div>
                                    <div id="button3"><a href="javascript:void(0)"  onclick="revertStyles(); return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Revert font size to default" border="0"></img></a></div>
                                    <div id="button4"><a href="javascript:void(0)" onclick="changeContainerWidth(760);return false;"><img name="medium"  src="<?php echo _TEMPLATE_URL ?>/images/b4.gif" alt="View in 800x600 screen resolution" border="0"></img></a></div>
                                    <div id="button5"><a href="javascript:void(0)" onclick="changeContainerWidth(960);return false;"><img name="large" src="<?php echo _TEMPLATE_URL ?>/images/b5.gif" alt="View in 1024x768 screen resolution" border="0"></img></a></div>
                                    <div id="button6"><a href="javascript:void(0)"  onclick="changeContainerWidth(0); return false;"><img name="fit" src="<?php echo _TEMPLATE_URL ?>/images/b6.gif" alt="Auto fit in browser window" border="0"></img></a></div>
                           </div>
                           <?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php mosLoadModules('newsflash', -2);?></div><?php } ?>
                  </div></div>
         </div>
         <div id="content">
                  <div id="lbox">
                           <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                           <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                           <?php if (mosCountModules('user6')) { ?><div id="user6"><?php mosLoadModules('user6', -2);?></div><?php } ?>
                  </div>
                  <div id="rbox">
                           <div id="topbox">
                                    <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                                    <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                           </div>
                           <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                           <div id="mainbody"><?php mosMainbody() ?></div>

                  </div>
         </div>
         <div id="bottombox">
                  <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
         </div>
         <div class="clr"><!-- --></div>
         <div id="footer_right"><div id="footer_left">
         <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
         </div></div>
</div></div></div></div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->