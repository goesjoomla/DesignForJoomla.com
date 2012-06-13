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
          #lb{width:340px}
          #rb{width:180px}
<?php } else { ?>
          #lb,#top,#bottom{width:540px}
          #mainbody{width:481px}
          #rb{width:0px}
<?php } ?>
</style>

<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lb{width:340px}
          #rb{width:180px}
<?php } else { ?>
          #lb,#top,#bottom{width:540px}
          #mainbody{width:510px}
          #rb{width:0px}
<?php } ?>
</style>
<![endif]-->
</head>
<body><center>
<div id="container">
    <div id="lbox">

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

         <div id="login_box"><?php if ( $my->id ) {
                                  if ( $name ) {
                                   $name = $my->name;
                                   } else {
                                   $name = $my->username;
                                   } echo
                                   "<h1>Login</h1><br /><h2>Hi,<b>$name</b>. <br />Click" ?>
                                   <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here" ?></a><?php echo " to logout.</h2>"; }
                                   else {   $validate = josSpoofValue(1);?>
                                   <form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="login" >
                                   <?php echo $pretext; ?>
                                   <div id="sform">
                                   <div id="user_text"><?php echo "Login" ?></div>
                                   <div id="user"><input name="username" id="mod_login_username1" type="text" class="inputbox" alt="username" size="10" value="username" onfocus="if(this.value=='username'){this.value='';}" onblur="if(this.value==''){this.value='username';}"/></div>
                                   <div id="pass"><input type="password" id="mod_login_password1" name="passwd" class="inputbox" size="10" alt="password" value="password" onfocus="if(this.value=='password'){this.value='';}" onblur="if(this.value==''){this.value='password';}"/></div>
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

    <div id="rbox">
         <div id="header">
               <div id="head"><?php
                               if (mosCountModules('user7')) mosLoadModules('user7', -1);
                               else echo '<h1>to <b>place</b> for <em>your slogan ...</em></h1> '?>
              </div>
         <?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php mosLoadModules('newsflash', -2);?></div><?php } ?>
         </div>
         <div id="lb">
         <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
         <div id="mainbody"><?php mosMainbody() ?></div>
         <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
         </div>
        <div id="rb">
                   <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                   <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                   <div class="clr"><!-- --></div>
        </div>
         <div class="clr"><!-- --></div>
         <div id="footer_container">
               <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
         </div>
   </div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->