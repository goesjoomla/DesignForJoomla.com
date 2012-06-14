<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu

//End Template Settings **********************************************************
$iso = split( '=', _ISO );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) initEditor(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_dropdownmenu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/d4j_transmenu.css" />
<?php function classifyHeading($module){
ob_start();
mosLoadModules($module,-2);
$content = ob_get_contents();
ob_end_clean();
$patterns = "/&lt;([^\s]+)&gt;([^\/]*)\/([^\s]+)&gt;/";
$replaces = "<\\1>\\2</\\3>";
$iso = split( '=', _ISO );
return str_replace('&lt;</', '</', preg_replace($patterns, $replaces, $content));
}
?>
<style type="text/css">
<?php if (mosCountModules ('user4')) { ?>
<?php } else { ?>
        #u4,#u5,#u6,#user4{width:0;height:0}
        #rbox{margin-top:2px}
<?php } ?>
<?php if (mosCountModules ('user1')) { ?>
<?php } else { ?>
        #u1,#u2,#u3,#user1{width:0;height:0}
<?php } ?>
<?php if (mosCountModules ('user4') OR mosCountModules ('right')) { ?>
<?php } else { ?>
        #lbox,#left,#mainbody,#bottom{width:690px}
        #user1,#u1,#u2,#u3{width:652px}
        #mainbody{width:644px}
        #rbox,#user4,#right,#user2,#u4,#u5,#u6{width:0;margin:0;height:0}
        #u1{background:url('<?php echo _TEMPLATE_URL ?>/images/u11.gif') top left repeat-y}
        #u2{background:url('<?php echo _TEMPLATE_URL ?>/images/u22.gif') top left no-repeat}
        #u3{background:url('<?php echo _TEMPLATE_URL ?>/images/u33.gif') top left no-repeat}
        .readon{width:95%}
<?php } ?>
<?php if (mosCountModules ('newsflash')) { ?>
<?php } else { ?>
        #box2{margin-top:18px}
<?php } ?>
<?php if (mosCountModules ('user9')) { ?>
        #user9{height:auto}
<?php } else { ?>
        #user9{width:0px;height:0px;padding:0}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
</style>
<![endif]-->
<!--[if gte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
<style type="text/css">
</style>
<![endif]-->
</head>
<body><center>
<div id="container">
        <div id="topbox">
                <div id="logo">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="toolbar1"><div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
                        ?>
                </div></div>
        </div>
        <div id="content">
                <div id="spacer1"></div>
                        <div id="content1">
                                <div id="box1">
                                        <div id="login_box"><?php if ( $my->id ) {
                                                if ( $name ) {
                                                $name = $my->name;
                                                } else {
                                                $name = $my->username;
                                                } echo
                                                "<br /><h2>Hi,<b>$name</b>. <br />Click" ?>
                                                <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here" ?></a><?php echo " to logout.</h2>"; }
                                                else {   $validate = josSpoofValue(1);?>
                                                <form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="login" >
                                                <?php echo $pretext; ?>
                                                <div id="sform">
                                                <div id="user_text"><?php echo "" ?></div>
                                                <div id="b1">
                                                <div id="name1"><?php echo "Your Name" ?></div>
                                                <div id="user"><input name="username" id="mod_login_username" type="text" class="inputbox" alt="username" size="10" value="username" onfocus="if(this.value=='username'){this.value='';}" onblur="if(this.value==''){this.value='username';}"/></div>
                                                </div>
                                                <div id="b2">
                                                <div id="name2"><?php echo "Password" ?></div>
                                                <div id="user"><input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" alt="password" value="password" onfocus="if(this.value=='password'){this.value='';}" onblur="if(this.value==''){this.value='password';}"/></div>
                                                </div>
                                                <div id="b3">
                                                <div id="name3"><?php echo "remember my password" ?></div>
                                                <div id="check"><input name="remember" id="mod_login_remember" class="inputbox" value="yes" alt="Remember Me" type="checkbox" /></div>
                                                <div id="go"><input class="button" type="image" src="<?php echo _TEMPLATE_URL ?>/images/login.jpg" alt="Click here" value="<?php echo _BUTTON_LOGIN; ?>" /> </div>
                                                </div>
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
                                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php echo classifyHeading('user3', -2);?></div><?php } ?>
                                </div>
                                <div id="advert3"><?php
                                        if (mosCountModules('advert3')) mosLoadModules('advert3', -1);
                                        else echo '<img src="'._TEMPLATE_URL.'/images/picture.gif" width="700" height="253" alt="" />';
                                        ?></div>
                                <?php if (mosCountModules('newsflash')) { ?><div id="newsflash"><?php echo classifyHeading('newsflash', -2);?></div><?php } ?>
                        <div id="box2">
                                <div id="lbox">
                                        <?php if (mosCountModules('left')) { ?><div id="left"><?php echo classifyHeading('left', -2);?></div><?php } ?>
                                        <div id="u1">
                                                <div id="u2"></div>
                                                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
                                                <div id="u3"></div>
                                        </div>
                                        <div id="mainbody"><?php mosMainbody() ?></div>
                                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
                                </div>
                                <div id="rbox">
                                        <div id="u4">
                                                <div id="u5"></div>
                                                <?php if (mosCountModules('user4')) { ?><div id="user4"><?php echo classifyHeading('user4', -2);?></div><?php } ?>
                                                <div id="u6"></div>
                                        </div>
                                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                                </div>
                        </div>
                </div>
                <div id="spacer2"></div>
        </div>
        <div id="footer_container"><div id="footer_box">
                <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
                <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div></div>
</div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->