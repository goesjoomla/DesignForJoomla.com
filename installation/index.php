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
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{width:530px}
          #rbox{width:225px}
          #search_field{margin-top:-2px}
<?php } else { ?>
          #rbox,#search_field{width:0px;height:0px}
          #top,#mainbody{width:730px}
          #lbox,bottom{width:756px}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
          #user9{margin:0 auto 10px}
          #fbox{margin:0;border-top:3px solid #fff}
<?php } else { ?>
          #user9{margin:0 auto;height:0px;width:0px;background:none}
          #fbox{margin:-20px 0 0 0;border-top:none}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{width:530px}
          #rbox{width:224px}
          #search_field{margin-top:-2px}
<?php } else { ?>
          #rbox,#search_field{width:0px;height:0px}
          #top,#mainbody{width:730px}
          #lbox,bottom{width:756px}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
          #user9{margin:0 auto 10px}
          #fbox{margin:0;border-top:3px solid #fff}
<?php } else { ?>
          #user9{margin:0 auto;height:0px;width:0px;background:none}
          #fbox{margin:-34px 0 0 0;border-top:none}
<?php } ?>
</style>
<![endif]-->
</head>
<body><center>
<div id="container">
     <div id="header">
             <div id="logo">
                     <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
             </div>

             <div id="slogan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2); else
                             echo '<h1><b>Connecting Online people</b></h1><h2>Sharing human resources</h2>';?>
             </div>

             <div id="menu"><?php
                               $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,5");
                               if ($rows = $database->loadObjectList()) {
                                       echo'<ul id="mainmenu">';
                                       for ($i = 0, $n = count($rows); $i < $n; $i++) {
                                               $id = $Itemid == $rows[$i]->id ? ' id="active_menu1"' : '';
                                               $link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
                                               $link1 = ampReplace($link);
                                               $link2 = ' onclick="location.href = \''.$link1.'\'"';
                                               if ($rows[$i]->browserNav == 1) {
                                                       $link1 .= '" target="_blank';
                                                       $link2 = ' onclick="window.open(\''.$link1.'\', \'\', \'\')"';
                                               } elseif ($rows[$i]->browserNav == 2) {
                                                       $link1 .= '" onclick="window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
                                                       $link2 = ' onclick="window.open(\''.$link1.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\')"';
                                               }
                                               echo '<li'.$id.$link2.'><a href="'.$link1.'" class="mainlevel">'.$rows[$i]->name.'</a></li>';
                                       }
                                       echo '</ul>';
                               }?>
             </div>

     </div>
     <div id="content">
             <div id="lbox">
                     <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                     <div id="mainbody"><?php mosMainbody() ?></div>
                     <div class="clr"><!-- --></div>
             </div>

             <div id="rbox">
                     <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                     <div id="search_field">
                                        <?php
                                        $query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_search'";
                                        $database->setQuery( $query );
                                        $rows = $database->loadObjectList();
                                        // try to auto detect search component Itemid
                                        if ( count( $rows ) ) {
                                                $_Itemid = $rows[0]->id;
                                                $link = 'index.php?option=com_search&amp;Itemid='. $_Itemid;
                                        } else {
                                                // Assign no Itemid
                                                $_Itemid = '';
                                                $link = 'index.php?option=com_search';
                                        }
                                        ?>
                                        <form name="searchForm" action="<?php echo $link ?>" method="post" style="margin:0px">
                                                <input type="hidden" name="option" value="com_search" />
                                                <input type="hidden" name="Itemid" value="<?php echo $_Itemid ?>"/>
                                                <div id="search">
                                                        <div id="inputbox">
                                                                <input name="searchword" maxlength="40" alt="search" class="inputbox" type="text" value="<?php echo _SEARCH_TITLE; ?>" onfocus="if(this.value=='<?php echo _SEARCH_TITLE; ?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _SEARCH_TITLE; ?>';}"/>
                                                        </div>
                                                        <div id="button">
                                                                <input class="button" type="image" alt="search" src="<?php echo _TEMPLATE_URL ?>/images/button.gif" onclick="document.searchForm.submit();" />
                                                        </div>
                                                </div>
                                        </form>
                     </div>
                     <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                     <div class="clr"><!-- --></div>
                </div>
     </div>
     <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
     <div class="clr"><!-- --></div>
</div>
<div id="footer_container">
      <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
      <div id="fbox">
      <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
      </div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->