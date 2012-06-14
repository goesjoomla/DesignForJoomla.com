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
           #container {background:url('<?php echo _TEMPLATE_URL ?>/images/bg.gif') left top repeat-y}
           #left {width: 593px}
           #newsitem{border-bottom:none}
           #menu_container{background:url('<?php echo _TEMPLATE_URL ?>/images/header.gif') left top no-repeat   }
           #footer_container{width:581px;margin:0 6px 0 7px;border-top:1px solid #ddd;overflow:hidden}
<?php } else { ?>
           #container{background:url('<?php echo _TEMPLATE_URL ?>/images/bg1.gif') left top repeat-y}
           #left{width: 937px}
           #newsitem{border-bottom:1px solid #ddd}
           #menu_container{background:url('<?php echo _TEMPLATE_URL ?>/images/header1.gif') left top no-repeat   }
           #footer_container{width:937px;margin:0 1px 0 1px;border-bottom:2px solid #444}
<?php } ?>
<?php if (mosCountModules('user3') AND mosCountModules('user4')) { ?>
          #spacer1,#spacer2,#spacer3{height:5px}
<?php } elseif (mosCountModules('user3') OR mosCountModules('user4')) { ?>
          #spacer1,#spacer3{height:5px}
          #spacer2{height:1px}
<?php } else { ?>
          #spacer1,#spacer2{height:1px}
          #spacer3{height:3px}
<?php } ?>

</style>

<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('right')) { ?>
           #container {background:url('<?php echo _TEMPLATE_URL ?>/images/bg2.gif') left top repeat-y}
           #footer_container{width:580px;margin:0 1px 0 4px;border-top:1px solid #ddd;overflow:hidden}
           #bottom_right{padding:50px 10px 2px 10pxt}
<?php } else { ?>
           #container{background:url('<?php echo _TEMPLATE_URL ?>/images/bg1.gif') left top repeat-y}
           #footer_container{width:938px;margin:0px;border-bottom:2px solid #444;border-left:1px solid #000}
<?php } ?>
</style>
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<![endif]-->
</head>
<body><center>
<div id="container">
<div id="content">
       <div id="header">
              <div id="top"><?php if (mosCountModules('user1')) mosLoadModules('user1', -2);
                       else echo '
                               <h1 title="'.$GLOBALS['mosConfig_sitename'].'" >'.$GLOBALS['mosConfig_sitename'].' <span class="tiny">to <b>place</b> for <em>your slogan ...</em></span></h1>
                               '?>
              </div>
       </div>
       <div id="menu_container">
       <div id="menu1"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,12");
                            if ($rows = $database->loadObjectList()) {
                                    echo'<ul>';
                                    for ($i = 0, $n = 4; $i < $n; $i++) {
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
       <div id="menu2"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,12");
                        if ($rows = $database->loadObjectList()) {
                                echo'<ul>';
                                for ($i = 4, $n = 8; $i < $n; $i++) {
                                        $id = $Itemid == $rows[$i]->id ? ' id="active_menu2"' : '';
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
       <div id="menu3"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,12");
                         if ($rows = $database->loadObjectList()) {
                                 echo'<ul>';
                                 for ($i = 8, $n = 12; $i < $n; $i++) {
                                         $id = $Itemid == $rows[$i]->id ? ' id="active_menu3"' : '';
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
       </div>
       <div id="left">
              <div id="user2"><?php echo date(_DATE_FORMAT) ?></div>
              <div id="spacer1"><!-- --></div>
              <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
              <div id="spacer2"><!-- --></div>
              <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
              <div id="spacer3"><!-- --></div>
              <div id="newsitem"><?php mosMainbody() ?></div>
              <div class="clr"><!-- --></div>
       </div>
       <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
       <div class="clr"><!-- --></div>
       <div id="footer_container">
       <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
       </div>
</div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->