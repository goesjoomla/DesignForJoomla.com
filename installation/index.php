<?php /* Joomla Template by DesignForJoomla.com */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

//D4J Template Settings *********************************************************

$d4j_menutype = 1; // 1: default joomla menu; 2: d4j_list_menu; 3: d4j_transmenu

// name of tabs
$_tab1        = 'community';
$_tab2        = 'solution';
$_tab3        = 'meetings';
$_user4       = mosCountModules( 'user4' );
$_user5       = mosCountModules( 'user5' );
$_user6       = mosCountModules( 'user6' );

// count modules for configure positions
$topModules = (mosCountModules('user1') ? 1 : 0) + (mosCountModules('user2') ? 1 : 0) + (mosCountModules('user3') ? 1 : 0);

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
<script type="text/javascript" src="<?php echo _TEMPLATE_URL; ?>/js/tabcontent.js"></script>
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
<?php if (mosCountModules ('top')) { ?>
<?php } else { ?>
        #mainbody .contentheading,#mainbody .componentheading{padding-top:7px}
<?php } ?>
<?php if ($topModules > 0) { ?>
<?php } if ($topModules == 3) { ?>
        #user1,#user2,#user3{width:33%}
<?php } elseif ($topModules == 2) { ?>
        #user1,#user2,#user3{width:49%}
<?php } elseif ($topModules == 1) { ?>
        #user1,#user2,#user3{width:100%}
<?php } elseif ($topModules == 0) { ?>
        #user1,#user2,#user3{width:0%;height:0;padding:0}
        #box{border:none;width:0;height:0}
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
        <div id="spacer"></div>
        <div id="topbox">
                <div id="logo">
                        <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="toolbar">
                        <?php if($d4j_menutype == 1 && mosCountModules('toolbar')) echo classifyHeading('toolbar',-1);
                        else if($d4j_menutype == 2 && mosCountModules('advert1')) echo classifyHeading('advert1',-1);
                        else if($d4j_menutype == 3 && mosCountModules('advert2')) echo classifyHeading('advert2',-1);
                        ?>
                </div>
        </div>
        <div id="midbox">
                <div id="user8"><?php if (mosCountModules('advert3')) mosLoadModules('advert3', -2);
                        else echo '<h1>The vision of future</h1><h2>Lorem ipsum dolor sit amet, consectetuer adipiscingelit. Ut pretium dignissim</h2>'?>
                </div>
                <div id="user7"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
                        else echo '<h1>what special</h1><h2>Lorem ipsum dolor sit amet,consectetuer <a href="">view more</a></h2>'?>
                </div>
        </div>
        <div id="content">
                <div id="cbox">
                        <?php if (mosCountModules('top')) { ?><div id="top"><?php echo classifyHeading('top', -2);?></div><?php } ?>
                        <div id="mainbody"><?php mosMainbody() ?></div>
                        <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php echo classifyHeading('bottom', -2);?></div><?php } ?>
                </div>
                <div id="lbox">
                        <!-- Tabs -->
                        <?php if ($_user4 OR $_user5 OR $_user6) { ?><div id="tabs">
                        <ul id="maintab" class="shadetabs"><?php
                        $_tabs = array();
                        if ($_user4) $_tabs[] = $_tab1;
                        if ($_user5) $_tabs[] = $_tab2;
                        if ($_user6) $_tabs[] = $_tab3;
                        for ($i = 0, $n = count($_tabs); $i < $n; $i++) {
                        if ($i == 0) {
                        echo '<li class="selected"><a href="javascript:void(0)" rel="tcontent'.($i+1).'">';
                        } else {
                        echo '<li><a href="javascript:void(0)" rel="tcontent'.($i+1).'">';
                        }
                        echo $_tabs[$i];
                        echo '</a></li>';
                        }
                        ?></ul>
                        <div class="tabcontentstyle"><?php
                        if ($_user4) {
                        echo '<div id="tcontent1" class="tabcontent">';
                        echo classifyHeading('user4', -2);
                        echo '</div>';
                        }
                        if ($_user5) {
                        echo '<div id="tcontent2" class="tabcontent">';
                        echo classifyHeading('user5', -2);
                        echo '</div>';
                        }
                        if ($_user6) {
                        echo '<div id="tcontent3" class="tabcontent">';
                        echo classifyHeading('user6', -2);
                        echo '</div>';
                        }
                        ?></div>
                        <script type="text/javascript">
                        //Start Tab Content script for UL with id="maintab" Separate multiple ids each with a comma.
                        initializetabcontent("maintab")
                        </script>
                        </div><?php } ?>
                        <!-- End Tabs -->
                </div>
                <div id="rbox">
                        <?php if (mosCountModules('right')) { ?><div id="right"><?php echo classifyHeading('right', -2);?></div><?php } ?>
                </div>
        </div>
</div>
<div id="footer_container"><div id="footer_box">
        <div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
        <?php if ($topModules > 0) { ?><div id="box">
                <?php if (mosCountModules('user1')) { ?><div id="user1"><?php echo classifyHeading('user1', -2);?></div><?php } ?>
                <?php if (mosCountModules('user2')) { ?><div id="user2"><?php echo classifyHeading('user2', -2);?></div><?php } ?>
                <?php if (mosCountModules('user3')) { ?><div id="user3"><?php echo classifyHeading('user3', -2);?></div><?php } ?>
                <div class="clr"><!-- --></div>
        </div><?php } ?>
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
</div></div>
</center>
<?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->