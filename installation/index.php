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
<?php if (mosCountModules('left') == 1) { ?>
                #div1,#div2{height:0px}
<?php } else { ?>
                #div1{height:0px}
                #div2{height:24px}
<?php } ?>
<?php if (mosCountModules('user3') == 1) { ?>
                #div1,#div3{height:0px}
<?php } else { ?>
                #div1{height:0px}
                #div3{height:24px}
<?php } ?>
<?php if (mosCountModules('left') == 1  OR mosCountModules('right')) { ?>
                #rbox,#user3,#user4,#div3,#footer{width:570px}
                #mainbody{width:550px}
                #lbox,#left,#right{width:200px}
<?php } else { ?>
                #rbox,#user3,#user4,#div3,#footer{width:770px}
                #mainbody{width:750px}
                #lbox,#left,#right,#div2,#div1{width:0px}

<?php } ?>
<?php if (mosCountModules('footer')) { ?>
#footer{width:570px}
<?php } else { ?>
#footer{width:770px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<![endif]-->
</head>
<body><center>
<div id="container">
     <div id="topbar_container">
     <div id="topbar"><?php if (mosCountModules('user1')) mosLoadModules('user1', -1);
                        else echo '<h1>to <b>place</b> for your language modules.
                        <img src="'._TEMPLATE_URL.'/images/russian.gif" alt="russian" class="languageimg" title="Russian" />
                        <img src="'._TEMPLATE_URL.'/images/french.gif" alt="french" class="languageimg" title="French" />
                        <img src="'._TEMPLATE_URL.'/images/english.gif" alt="english" class="languageimg" title="English" /></h1>'; ?>
     </div>
     </div>
     <div id="header">
             <div id="logo">
                      <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
             </div>

             <div id="hlogin"><?php if ( $my->id ) {
                                  if ( $name ) {
                                   $name = $my->name;
                                   } else {
                                   $name = $my->username;
                                   } echo "<br />Hi, <b>$name</b>. <br />Click" ?>
                                   <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here " ?></a><?php echo _BUTTON_LOGOUT; }
                                   else {   $validate = josSpoofValue(1);?>
                                   <form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="login" >
                                   <?php echo $pretext; ?>
                                   <div id="sform">
                                   <div id="user"><input name="username" id="mod_login_username" type="text" class="inputbox" alt="username" size="10" value="<?php echo _BUTTON_LOGIN; ?>" onfocus="if(this.value=='<?php echo _BUTTON_LOGIN; ?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _BUTTON_LOGIN; ?>';}"/></div>
                                   <div id="pass"><input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" alt="password" value="<?php echo _PASSWORD; ?>" onfocus="if(this.value=='<?php echo _PASSWORD; ?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _PASSWORD; ?>';}"/></div>
                                   <div id="go"><input class="button" type="image" src="<?php echo _TEMPLATE_URL ?>/images/login.jpg" alt="Click here" value="<?php echo _BUTTON_LOGIN; ?>" /> </div>
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
     </div>
     <div id="navbar"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
                        if ($rows = $database->loadObjectList()) {
                        echo'<ul>';
                        for ($i = 0, $n = count($rows); $i < $n; $i++) {
                                $id = $Itemid == $rows[$i]->id ? ' id="active_menu2"' : '';
                                $link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
                                $link = ampReplace($link);
                                if ($rows[$i]->browserNav == 1) {
                                        $link .= '" target="_blank';
                                } elseif ($rows[$i]->browserNav == 2) {
                                        $link .= '" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
                                }
                                echo '<li><span>></span><a href="'.$link.'" class="mainlevel"'.$id.'>'.$rows[$i]->name.'</a></li>';

                        }
                        echo '</ul>';} ?>
     </div>

     <div id="top">
           <div id="headerlink"><?php
                               if (mosCountModules('user2')) mosLoadModules('user2', -1);
                               else echo '<h2>Want to make the most of your savings?<br />
                                           We can help your money grow.</h2> '?>
           </div>
           <div id="user9"><?php
                        if (mosCountModules('user9')) mosLoadModules('user9', -1);
                        else echo '<img src="'._TEMPLATE_URL.'/images/siteimage.jpg" width="350" height="200" alt="siteimage" />';?>
           </div>
     </div>

     <div id="main">
          <div id="div1"><!-- --></div>
     <div id="lbox">
          <div id="div2"><!-- --></div>
          <?php if (mosCountModules('left')== 1) {?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
          <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
          <div class="clr"><!-- --></div>
     </div>
     <div id="rbox">
          <div id="div3"><!-- --></div>
          <?php if (mosCountModules('user3') == 1) {?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
          <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
          <div id="mainbody"><?php mosMainbody() ?></div>
          <div class="clr"><!-- --></div>
     </div>
     </div>

     <div class="clr"><!-- --></div>
     <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->