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
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php");?>
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{width:64%}
          #rbox{width:29%}
<?php } else { ?>
          #rbox{width:0%}
          #lbox{width:92%}
          #mainbody{width:96%}
<?php } ?>
</style>
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{width:64%}
          #rbox{width:29%}
<?php } else { ?>
          #rbox{width:0%}
          #lbox{width:92%}
          #mainbody{width:96%}
<?php } ?>
</style>
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
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
<div id="container"><div id="container_outer"><div id="container_inner">
         <div id="header_outer"><div id="header_inner">
               <div id="header">
                      <div id="slogan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
                                         else echo '<h1><span>terra</span>firma<sup>1.0</sup></h1>
                                                    <h2>by nodethirtythree</h2> '?>
                      </div>

                      <div id="button">
                              <div id="button1"><a href="javascript:void(0)" onclick="changeFontSize(1);"><img name="Increase" src="<?php echo _TEMPLATE_URL ?>/images/b1.gif" alt="Increase font size" border="0"></img></a></div>
                              <div id="button2"><a href="javascript:void(0)" onclick="changeFontSize(-1);"><img name="Decrease" src="<?php echo _TEMPLATE_URL ?>/images/b2.gif" alt="Decrease font size" border="0"></img></a></div>
                              <div id="button3"><a href="javascript:void(0)" onclick="revertStyles();"><img name="Revert"  src="<?php echo _TEMPLATE_URL ?>/images/b3.gif" alt="Revert font size to default" border="0"></img></a></div>
                              <div id="button4"><a href="javascript:void(0)" onclick="changeContainerWidth(747);"><img name="medium"  src="<?php echo _TEMPLATE_URL ?>/images/b4.gif" alt="View in 800x600 screen resolution" border="0"></img></a></div>
                              <div id="button5"><a href="javascript:void(0)" onclick="changeContainerWidth(960);"><img name="large" src="<?php echo _TEMPLATE_URL ?>/images/b5.gif" alt="View in 1024x768 screen resolution" border="0"></img></a></div>
                              <div id="button6"><a href="javascript:void(0)" onclick="changeContainerWidth(0);"><img name="fit" src="<?php echo _TEMPLATE_URL ?>/images/b6.gif" alt="Auto fit in browser window" border="0"></img></a></div>
                      </div>
               </div>
               <div id="subheader">
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
                       <div id="date"><?php echo date(_DATE_FORMAT) ?></div>
               </div>
         </div>
         </div>
         <div id="content">
                  <div id="lbox">
                           <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                           <div id="mainbody"><?php mosMainbody() ?></div>
                           <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                  </div>
                  <div id="rbox">
                           <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                           <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                  </div>
         </div>
         <div class="clr"><!-- --></div>
         <div id="footer_outer"><div id="footer_inner">
         <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
         </div></div>
</div></div></div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->