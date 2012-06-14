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
<?php if (mosCountModules('user3') AND mosCountModules('user4')) { ?>
                #user3{width: 280px;margin: 10px 0 0 9px}
                #spacer{width:1px;height:82px;background:url('<?php echo _TEMPLATE_URL ?>/images/top-bg.gif') top left repeat-y;margin:10px 0}
                #user4{width: 279px;margin: 10px 10px 0 10px}
                #user4 .moduletable{padding-left:15px}
<?php } elseif (mosCountModules('user3')) { ?>
                #user3{width: 580px;margin: 10px 10px 0 9px}
                #spacer,#user4{width:0px;height:0px;background:none;margin:0}
<?php } elseif (mosCountModules('user4')) { ?>
                #spacer,#user3{width:0px;height:0px;background:none;margin:0}
                #user4{width: 580px;margin: 10px 10px 0 10px}
                #user4 .moduletable{padding-left:0px}
<?php } else { ?>
                #spacer,#user3,#user4,#top{width:0px;height:0px;background:none;margin:0}
                #rbox{background:url('<?php echo _TEMPLATE_URL ?>/images/rheader1.jpg') top left no-repeat}
<?php } ?>
</style>

<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules('user3') AND mosCountModules('user4')) { ?>
                #user3{width: 280px;margin: 10px 0 0 4px}
<?php } elseif (mosCountModules('user3')) { ?>
                #user3{width: 580px;margin: 10px 10px 0 5px}
<?php } elseif (mosCountModules('user4')) { ?>
                #user4{width: 580px;margin: 10px 10px 0 5px}
<?php } else { ?>
                #top,#spacer,#user3,#user4{width:0px;height:0px;background:none;margin:0}
                #rbox{background:url('<?php echo _TEMPLATE_URL ?>/images/rheader1.jpg') top left no-repeat}
<?php } ?>
</style>
<![endif]-->

</head>
<body><center>
<div id="main">
     <div id="lbox">
           <div id="top">
                 <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                 <div id="spacer"><!-- --></div>
                 <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
           </div>
           <div id="header">
                 <div id="logo">
                 <div id="headerlink"><?php
                               if (mosCountModules('user1')) mosLoadModules('user1', -1);
                               else echo '<h1>your community › site one</h1> '?>
                 </div>
                 </div>
           </div>
           <div id="mainbox">
           <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
           <div id="mainbody"><?php mosMainbody() ?></div>
           <div class="clr"><!-- --></div>
           </div>
     </div>
     <div id="rbox">
           <div id="hlogin"><?php if ( $my->id ) {
                                  if ( $name ) {
                                   $name = $my->name;
                                   } else {
                                   $name = $my->username;
                                   } echo "<br />Hi, <b>$name</b>. <br />Click" ?>
                                   <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here" ?></a><?php echo _BUTTON_LOGOUT; }
                                   else {   $validate = josSpoofValue(1);?>
                                   <form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="login" >
                                   <?php echo $pretext; ?>
                                   <div id="sform">
                                   <div id="user">
                                   <div id="user_text">User</div>
                                   <div id="user_form"><input name="username" id="mod_login_username1" type="text" class="inputbox" alt="username" size="10" value="" /></div>
                                   </div>
                                   <div id="pass">
                                   <div id="pass_text"><?php echo _PASSWORD; ?></div>
                                   <div id="pass_form"><input type="password" id="mod_login_password1" name="passwd" class="inputbox" size="10" alt="password" value="" /></div>
                                   </div>
                                   <div id="reg"><a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=register' ); ?>"><?php echo _CREATE_ACCOUNT; ?></a></div>
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
           <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
           <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
           <div class="clr"><!-- --></div>
     </div>
     <div class="clr"><!-- --></div>
     <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->