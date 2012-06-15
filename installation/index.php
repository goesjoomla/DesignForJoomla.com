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
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{width:550px}
          #rbox{width:220px}
<?php } else { ?>
          #lbox,#top,#bottom{width:780px}
          #mainbody{width:760px;padding:10px 10px 2px}
          #top .moduletable,#bottom .moduletable{padding:10px 10px 2px}
          #rbox{width:0px;height:0px}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
                  #user9{height:auto}
<?php } else { ?>
                  #user9{height:0px;width:0px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
<?php } else { ?>
          #mainbody{width:780px}
<?php } ?>
</style>

<![endif]-->
        <script type="text/javascript" language="JavaScript"><!-- // --><![CDATA[
                var _TEMPLATE_URL = '<?php echo _TEMPLATE_URL; ?>';
                        // ]]></script>
        <script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>
<body><center>
<div id="container">
          <div id="header">
                   <div id="button">
                        <div id="button1"><a href="javascript:void(0)"  onclick="changeFontSize(1);return false;"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Increase font size" border="0"></img></a></div>
                        <div id="button2"><a href="javascript:void(0)" onclick="changeFontSize(-1);return false;"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Decrease font size" border="0"></img></a></div>
                        <div id="button3"><a href="javascript:void(0)"  onclick="revertStyles(); return false;"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Revert font size to default" border="0"></img></a></div>
                   </div>
                   <div id="slogan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
                                 else echo '<h1><span>culture shock:</span> prozac afternoon</h1> '?>
                   </div>
          </div>
          <div id="menu"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
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
         <div id="content">
                  <div id="lbox">
                           <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                           <div id="mainbody"><?php mosMainbody() ?></div>
                  </div>
                  <div id="rbox">
                           <?php if (mosCountModules( "left" )) { ?>
                                       <div class="leftbox">
                                       <div id="left" class="leftblock">
                                                     <?php mosLoadModules ( "left", -3 ); ?>
                                       </div>
                                       </div>
                                       <?php } ?>
                           <?php if (mosCountModules( "right" )) { ?>
                                       <div class="leftbox">
                                       <div id="right" class="leftblock">
                                                  <?php mosLoadModules ( "right", -3 ); ?>
                                       </div>
                                       </div>
                                       <?php } ?>
                  </div>
         </div>
         <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
         <div class="clr"><!-- --></div>
         <div id="footer_container">
                  <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
                  <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
         </div>
</div>
<div id="spacer"><!-- --></div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->