<?php /* Joomla Template by DesignForJoomla.com */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************
$site_tools = 1; // 0:disable all , 1:enable for SITE TOOLS
$site_tools_font = 1; // 0:disable , 1:enable for font changer SITE TOOLS

/* Image switching settings*/
$enable        = true;         // enable or not
$images        = array('header.gif','header1.gif','header2.gif','header3.gif','header4.gif','header5.gif','header6.gif'); // name of the images
$time          = 6;                // time delay (s)

$topModules = (mosCountModules('user3') ? 1 : 0) + (mosCountModules('user4') ? 1 : 0) + (mosCountModules('user5') ? 1 : 0);

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
<style type="text/css">
<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
        #user1,#user2{width:49%}
<?php } elseif (mosCountModules('user1')) { ?>
        #user1{width:100%}
        #user2{width:0px;height:0px}
<?php } elseif (mosCountModules('user2')) { ?>
        #user1{width:0px;height:0px}
        #user2{width:100%}
<?php } else { ?>
        #user1,#user2,#box1{width:0px;height:0}
<?php } ?>
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user3,#user4,#user5{width:33%}
<?php } elseif ($topModules == 2) { ?>
        #user3,#user4,#user5{width:49%}
<?php } elseif ($topModules == 1) { ?>
        #user3,#user5,#user4{width:100%}
<?php } ?>
<?php if (mosCountModules('left') OR mosCountModules('right') OR mosCountModules('user8')) { ?>
        #lbox{width:270px}
        #rbox{width:442px}
<?php } else { ?>
        #lbox{width:0%;height:0}
        #rbox,#top,#box1,#banner,#mainbody,#bottom{width:712px}
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
<?php if($site_tools) {
        include_once(_TEMPLATE_PATH."/func/style/d4j_sitetools.php");
?>
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL ?>/css/D4J_sitetools/site_tools.css" />
<?php }?>
<?php include_once(_TEMPLATE_PATH."/func/style/d4j_stylechanger.php"); ?>
<script type="text/javascript" src="<?php echo _TEMPLATE_URL?>/func/d4jCommonInclude.compact.js"></script>
<script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
<script language="javascript" type="text/javascript">
var enable = <?php echo (($enable)? '1' : '0');?>;
var images = new Array("<?php $str =  join('","',$images);echo $str;?>");
var time = <?php echo $time;?>;
var _TEMPLATE_URL = "<?php echo _TEMPLATE_URL;?>";
var currentImage = 0;
function changeImage() {
        var image = document.getElementById("advert1").getElementsByTagName("IMG")[0];
        if(image != null || image != 'undefined') {
                image.src = _TEMPLATE_URL+"/images/"+images[currentImage];
        }
        /* Random */
        currentImage = parseInt(Math.random()*images.length);
        /* Sequence */
        setTimeout(changeImage,time*1000);
}
</script>
</head>
<body><center>
<?php if($site_tools){?>
        <div id="sitetools" style="">
                <img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools.gif" alt="" onmouseover="document.getElementById('tools').style.display='block'" onmouseout="document.getElementById('tools').style.display='none'"/>
        </div>
        <div id="tools" onmouseover="this.style.display='block'" onmouseout="this.style.display='none'" style="">
                <?php writeTools();?>
        </div>
<?php }?>
<div id="container_outter"><div id="container_inner"><div id="container">
        <div id="header">
                <div id="user7"><?php if (mosCountModules('user7')) mosLoadModules('user7', -1);
                                else echo '<h1>D4J Mike</h1>' ?>
                </div>
                <?php if (mosCountModules('toolbar')) { ?><div id="toolbar"><?php mosLoadModules('toolbar', -1);?></div><?php } ?>
        </div>
        <div id="content">
                <div id="advert1"><?php if (mosCountModules('advert1')) mosLoadModules('advert1', -1);
                        else echo '<img src="'._TEMPLATE_URL.'/images/header.gif" width="712" height="184" alt="" />';?></div>
                <div id="lbox">
                        <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user8')) { ?><div id="user8"><?php mosLoadModules('user8', -2);?></div><?php } ?>
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                        <div id="box1">
                                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php mosLoadModules('user2', -2);?></div><?php } ?>
                        </div>
                        <?php if (mosCountModules('banner')) { ?><div id="banner"><?php mosLoadModules('banner', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                </div>
                <div id="spacer"><!-- --></div>
                        <?php if ($topModules > 0) { ?><div id="box3">
                        <?php if (mosCountModules('user3')) { ?><div id="user3"><?php mosLoadModules('user3', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user4')) { ?><div id="user4"><?php mosLoadModules('user4', -2);?></div><?php } ?>
                        <?php if (mosCountModules('user5')) { ?><div id="user5"><?php mosLoadModules('user5', -2);?></div><?php } ?>
                        <div class="clr"><!-- --></div>
                </div><?php } ?>
                <div id="spacer1"><!-- --></div>
        </div>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        <script language="javascript" type="text/javascript">
                if(enable) changeImage();
        </script>
</div></div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->