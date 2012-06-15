<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';

$custom_settings['support'] = 'Live Support';
$custom_settings['support_url'] = 'http://url/to/your/live/support/system';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <?php if ($my->id) initEditor() ?>
        <?php mosShowHead() ?>
        <meta http-equiv="Content-Type" content="text/html; <?php echo _ISO ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css.css" />

        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/template_css_ie.css" />
                <![endif]-->
</head>

<body><center>
<div id="container">
         <div id="header">
                  <div id="logo"><h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1></div>
                  <div id="headerlink"><?php if (mosCountModules('user1')) mosLoadModules('user1', -2);
                  else echo '
                  <h1 title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</h1>
                  <h2>to <b>place</b> for <em>your slogan ...</em></h2>'?>
                  </div>
                  <div id="rmenu">
                        <div id="tnav">
                            <?php
                                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' ORDER BY ordering LIMIT 0,1");
                                    $database->loadObject( $row1 );
                                    if (isset($row1)) {
                                            echo '<ul>';
                                            if ( $row1->type == 'url' ) {
                                                    echo '<li><a href="'.$row1->link.'">Home</a></li>';
                                            } else {
                                            $link = ampReplace($link);
                                                    echo '<li><a href="'.$row1->link.'&amp;Itemid='.$row1->id.'">Home</a></li>';;
                                            }
                                   echo '</ul>';}?>
                            <?php
                                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_contact%' ORDER BY ordering LIMIT 0,1");
                                    $database->loadObject( $row2 );
                                    if (isset($row2)) {
                                       echo '<ul>';
                                            if ( $row2->type == 'url' ) {
                                                    echo '<li><a href="'.$row2->link.'">Contacts</a></li>';
                                            } else {
                                            $link = ampReplace($link);
                                                    echo '<li><a href="'.$row2->link.'&amp;Itemid='.$row2->id.'">Contacts</a></li>';
                                            }
                              echo '</ul>';}?>

                            <?php
                                    $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype='mainmenu' and parent='0' AND access<='$gid' AND sublevel='0' AND published='1' AND link LIKE 'index.php?option=com_search%' ORDER BY ordering LIMIT 0,1");
                                    $database->loadObject( $row3 );
                                    if (isset($row3)) {
                                      echo '<ul>';
                                            if ( $row3->type == 'url' ) {
                                                    echo '<li><a href="'.$row3->link.'">Search</a></li>';
                                            } else {
                                            $link = ampReplace($link);
                                                    echo '<li><a href="'.$row3->link.'&amp;Itemid='.$row3->id.'">Search</a></li>';
                                            }
                             echo '</ul>';}?>
                        </div>
                  </div>
                  <div id="logo3"><!-- --></div>
         </div>
         <div id="logo4"><!-- --></div>
         <div id="hdr-nav"><?php echo "<h6>Website Navigation</h6>" ?>
                           <?php $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
                                 if ($rows = $database->loadObjectList()) {
                                 echo '<ul>';
                                 for ($i = 0, $n = count($rows); $i < $n; $i++) {
                                 if ($rows[$i]->type == 'url') {
                                 $link = $rows[$i]->link;
                                 } else {
                                 $link = $rows[$i]->link.'&Itemid='.$rows[$i]->id;}
                                 $link = ampReplace($link);
                                 echo '<li><a href="'.$link.'">'.$rows[$i]->name.'</a></li>';}
                                 echo '</ul>';}?>
         </div>
         <div id="login"> <?php if ( $my->id ) {
                                  if ( $name ) {
                                   $name = $my->name;
                                   } else {
                                   $name = $my->username;
                                   } echo "<h4>Hi, <b>$name</b>.</h4><h5> Click" ?>
                                   <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here" ?></a><?php echo " to logout.</h5>"; }
                                   else {   $validate = josSpoofValue(1);?>
                                   <form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="login" >
                                   <?php echo $pretext; ?>
                                   <div id="sform">
                                   <div id="user"><input name="username" id="mod_login_username" type="text" class="inputbox" alt="username" size="10" value="Username" onfocus="if(this.value=='Username'){this.value='';}" onblur="if(this.value==''){this.value='Username';}"/></div>
                                   <div id="pass"><input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" alt="password" value="Password" onfocus="if(this.value=='Password'){this.value='';}" onblur="if(this.value==''){this.value='Password';}"/></div>
                                   <div id="go"><input class="button" type="image" src="<?php echo _TEMPLATE_URL ?>/images/btn.jpg" alt="Click here" value="<?php echo _BUTTON_LOGIN; ?>" /> </div>
                                   </div>
                                   <?php echo $posttext;?>
                                   <input type="hidden" name="option" value="login" />
                                   <input type="hidden" name="op2" value="login" />
                                   <input type="hidden" name="lang" value="<?php echo $mosConfig_lang; ?>" />
                                   <input type="hidden" name="return" value="<?php echo sefRelToAbs( $login ); ?>" />
                                   <input type="hidden" name="message" value="<?php echo $message_login; ?>" />
                                   <input type="hidden" name="<?php echo $validate; ?>" value="1" />
                                   </form>
                                   <?php }?>
         </div>
         <div id="search"><?php $query = "SELECT id"
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
                           <div id="searchbox">
                           <div id="inputbox"><input name="searchword" maxlength="20" alt="search" class="inputbox" type="text" value="Search..." onfocus="if(this.value=='Search...'){this.value='';}" onblur="if(this.value==''){this.value='Search...';}"/></div>
                           <div id="button"><input class="button" type="image" src="<?php echo _TEMPLATE_URL ?>/images/btn.jpg" alt="Click here" onclick="document.searchForm.submit();" /></div>
                           </div>
                           </form>
         </div>
         <div id="link">
         <div id="text"><?php echo strtoupper($custom_settings['support']); ?></div>
         <div id="connect"><a href="<?php echo $custom_settings['support_url']; ?>"><img name="btnr" src="templates/tower_eye/images/btn-clickhere.jpg" alt="Click here" border="0"></img></a></div>
         </div>
         <div id="mainbody">
                  <div id="lbox"><?php if (mosCountModules( "left" )) { ?>
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
                                 <div class="clr"><!-- --></div>
                  </div>

                  <div id="rbox">
                           <div id="newsmain">
                                <div id="news"><?php if (mosCountModules('newsflash')) mosLoadModules('newsflash', -2);
                                else echo '
                                <h1 title="test">Module Position: Newsflash</h1>
                                <h2>You can use <b>_newsflash</b> Module Class Suffix for all module configured to show in this position.</h2>'?>
                                </div>
                           </div>

                                 <?php if (mosCountModules( "top" )) { ?>
                                 <div class="leftbox">
                                 <div id="top" class="leftblock">
                                 <?php mosLoadModules ( "top", -3 ); ?>
                                 </div>
                                 </div>
                                 <?php } ?>

                                 <div id="main"><?php mosMainbody() ?></div>

                                 <?php if (mosCountModules( "bottom" )) { ?>
                                 <div class="leftbox">
                                 <div id="bottom" class="leftblock">
                                 <?php mosLoadModules ( "bottom", -3 ); ?>
                                 </div>
                                 </div>
                                 <?php } ?>
                  </div>
         </div>
         <div id="logo5"><!-- --></div>
         <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html>