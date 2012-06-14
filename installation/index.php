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
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
                   #leftbox{width: 200px}
                   #rightbox{width: 550px}
                   #pathway{width:550px;margin:14px 0 0 20px}
                   #user2{width:500px;margin:0 30px 0 20px}
                   #mainbody{width:508px;margin:0 30px 0 16px}
                   #visual{background:#1F7A2A url('<?php echo _TEMPLATE_URL ?>/images/bg_visual.jpg') top left repeat-y}
<?php } else { ?>
                   #leftbox,#left_footer{width:0}
                   #rightbox{width:750px}
                   #pathway{width:710px;margin:14px 20px 0 25px}
                   #user2,#mainbody{width:710px;margin:0 20px 0 20px}
                   #visual{background:#1F7A2A url('<?php echo _TEMPLATE_URL ?>/images/bg_visual1.jpg') top left repeat-y}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
                  #lfooter{width:325px;margin:9px 0 0 5px}
                  #footer{width:420px}
                  #bottom_left{margin:40px 0 0 0;padding:3px 5px 0 10px}
                  #bottom_right{margin:-79px 0 0 0;padding:0px 10px 2px 10px}
<?php } else { ?>
                  #lfooter{width:0px;margin:0}
                  #footer{width:750px}
                  #bottom_left{margin:-12px 0 0 0;padding:5px 5px 0 10px}
                  #bottom_right{margin:-12px 0 0 0;padding:5px 10px 2px 10px}

<?php } ?>
<?php if (mosCountModules('footer') == 0) { ?>
                #footer{padding-top:12px}
<?php } ?>
</style>


<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('user9')) { ?>
                  #lfooter{width:320px}
                  #footer{width:420px}
<?php } else { ?>
                  #lfooter{width:0px}
                  #footer{width:750px}
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
              <div id="logo">
        <?php if (mosCountModules('user7')) { ?><div id="user7"><?php mosLoadModules('user7', -1); ?></div><?php } ?>
              	  	  	  <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1></div>
              
          
              	  	  <div id="headerlink">
              	   <?php if (mosCountModules('user8')) { ?><div id="user8"><?php mosLoadModules('user8', -1); ?></div><?php } 
                      else echo '<h2>to <b>place</b> for <em>your slogan ...</em></h2> '?>
              </div>
        </div>

        <div id="navigation">
               <div id="lmenu"><?php $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
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
              <div id="spacer"></div>
              <div id="rmenu1"><?php
                                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,1");
                                    $database->loadObject( $row1 );
                                    if (isset($row1)) {
                                            echo '<ul>';
                                            if ( $row1->type == 'url' ) {
                                                    echo '<li><a href="'.$row1->link.'"><img src="'._TEMPLATE_URL.'/images/btn_home.gif" width="35" height="22" alt="Home" border="0"/></a></li>';
                                            } else {
                                            $link = ampReplace($link);
                                                    echo '<li><a href="'.$row1->link.'&amp;Itemid='.$row1->id.'"><img src="'._TEMPLATE_URL.'/images/btn_home.gif" width="35" height="22" alt="Home" border="0"/></a></li>';;
                                            }
                                   echo '</ul>';}?>
              </div>
              <div id="rmenu2"><?php
                                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
                                    $database->loadObject( $row2 );
                                    if (isset($row2)) {
                                       echo '<ul>';
                                            if ( $row2->type == 'url' ) {
                                                    echo '<li><a href="'.$row2->link.'"><img src="'._TEMPLATE_URL.'/images/btn_mail.gif" width="35" height="22" alt="Email" border="0"/></a></li>';
                                            } else {
                                            $link = ampReplace($link);
                                                    echo '<li><a href="'.$row2->link.'&amp;Itemid='.$row2->id.'"><img src="'._TEMPLATE_URL.'/images/btn_mail.gif" width="35" height="22" alt="Email" border="0"/></a></li>';
                                            }
                              echo '</ul>';}?>
              </div>
              <div id="rmenu3"><?php
                                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_search%' ORDER BY ordering LIMIT 0,1");
                                    $database->loadObject( $row3 );
                                    if (isset($row3)) {
                                      echo '<ul>';
                                            if ( $row3->type == 'url' ) {
                                                    echo '<li><a href="'.$row3->link.'"><img src="'._TEMPLATE_URL.'/images/btn_login.gif" width="35" height="22" alt="Search" border="0"/></a></li>';
                                            } else {
                                            $link = ampReplace($link);
                                                    echo '<li><a href="'.$row3->link.'&amp;Itemid='.$row3->id.'"><img src="'._TEMPLATE_URL.'/images/btn_login.gif" width="35" height="22" alt="Search" border="0"/></a></li>';
                                            }
                             echo '</ul>';}?>
              </div>

        </div>

        <div id="visual">
              <div id="lnav"><?php if ( $my->id ) {
                                    if ( $name ) {
                                    $name = $my->name;
                                    } else {
                                    $name = $my->username;
                                    } echo "<h4>Hi, <b>$name</b>. Welcome to our site.<br />Click" ?>
                                    <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here " ?></a><?php echo _BUTTON_LOGOUT; }
                                    else { echo "<h2>Stop spending hours searching for business partners!</h2>
                                    <h1><b>Partner with us - your online helper!</b></h1>" ?>
                                      <a href="<?php echo sefRelToAbs( 'index.php?option=com_login&amp;Itemid=4' ); ?>">
                                      <?php echo _BUTTON_LOGIN; ?></a>
                                      <?php echo "or " ?>
                                      <a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=register' ); ?>">
                                      <?php echo _CREATE_ACCOUNT; ?></a>
                                      <?php }?>
              </div>
        </div>

        <div id="content">
             <div id="leftbox">
                 <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                 <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                 <div id="left_footer"></div>
             </div>

             <div id="rightbox">
                 <div id="pathway"><?php mosPathway() ?></div>
                 <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                 <div id="mainbody"><?php mosMainbody() ?></div>
             </div>
             <div class="clr"><!-- --></div>
        </div>

        <div class="clr"><!-- --></div>
        <div id="footer_container">
        <div id="lfooter"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->