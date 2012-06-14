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
<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
          #lsheader{margin:0px 2px 2px 2px;width:510px}
          #rsheader{margin:0px 2px 2px 0px;width:219px}
<?php } elseif (mosCountModules('user1')) { ?>
          #lsheader{margin:0px 2px 2px 2px;width:731px}
          #rsheader{margin:0px;width:0}
<?php } elseif (mosCountModules('user2')) { ?>
          #lsheader{margin:0;width:0px}
          #rsheader{margin:0px 2px 2px 2px;width:731px}
          #rsheader .moduletable h3{padding:0 0 4px 5px}
<?php } else { ?>
          #sheader,#lsheader,#rsheader{margin:0;width:0px;height:0}
          #main{margin:1px 0 0 0}
<?php } ?>
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{margin:0 2px;width:176px}
          #rbox{margin:0 2px 0 0;width:549px}
<?php } else { ?>
          #lbox{margin:0;width:0;height:0}
          #rbox{margin:0 2px 0 2px;width:727px}
          #top,#bottom{margin:1px 0 0 0;width:725px}
          #bottom{margin:0}
          #mainbody{width:693px}
          #pathway{width:709px}
<?php } ?>
<?php if (mosCountModules ('footer')) { ?>
          #footer_container,#footer_container_inner{height:24px}
<?php } else { ?>
          #footer_container,#footer_container_inner{height:48px}
<?php } ?>


</style>

<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules('user1') AND mosCountModules('user2')) { ?>
          #lsheader{margin:1px 2px 2px 1px;width:510px}
          #rsheader{width:218px;margin:1px 2px 2px 0px}
<?php } elseif (mosCountModules('user1')) { ?>
          #lsheader{margin:1px 2px 2px 1px;width:730px}
          #rsheader{margin:0px;width:0}
<?php } elseif (mosCountModules('user2')) { ?>
          #lsheader{margin:0;width:0px}
          #rsheader{margin:1px 2px 2px 1px;width:730px}
<?php } else { ?>
          #sheader,#lsheader,#rsheader{margin:0;width:0px;height:0}
<?php } ?>

<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{margin:0 1px;width:176px}
          #rbox{margin:0 2px 0 1px;width:552px}
<?php } else { ?>
          #lbox{margin:0;width:0;height:0}
          #rbox{margin:0 2px 0 1px;width:729px}
          #top{margin:1px 0 0 0;width:723px}
          #bottom{margin:0}
          #mainbody,#pathway,#bottom{width:723px}
          #main{background:#fff}
<?php } ?>
</style>
<![endif]-->

</head>
<body><center>
<div id="bodyWrap_container">
<div id="bodyWrap">
        <div id="header">
                <div id="logo">
                             <h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
                </div>
                <div id="heading">
                       <div id="head"><?php
                        if (mosCountModules('user9')) mosLoadModules('user9', -1);
                        else echo '<img src="'._TEMPLATE_URL.'/images/header.jpg" width="514" height="80" border="0" alt="picture" />';?>
                       </div>

                       <div id="navbar"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,6");
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

                       <div id="sub"><?php
                                   if ( $my->id ) {
                                        if ( $name ) {
                                                   $name = $my->name;
                                           } else {
                                                   $name = $my->username;
                                           } echo "<h2>Hi, <b>$name</b>. Click" ?>
                                           <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here" ?></a><?php echo " to logout.</h2>"; }
                                                      else { echo "" ?>
                                             <a href="<?php echo sefRelToAbs( 'index.php?option=com_login&amp;Itemid=4' ); ?>">
                                           <?php echo "My Account" ?></a>

                                           <a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=register' ); ?>">
                                           <?php echo "Register" ?></a>
                                           <?php }?>
                       </div>
                </div>
        </div>

        <div id="content">
        <div id="sheader">
                 <?php if (mosCountModules('user1')) { ?><div id="lsheader"><?php mosLoadModules('user1', -2);?></div><?php } ?>
                 <?php if (mosCountModules('user2')) { ?><div id="rsheader"><?php mosLoadModules('user2', -2);?></div><?php } ?>
        </div>
        <div id="main">
                <div id="lbox">
                   <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                   <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                   <div class="clr"><!-- --></div>
                </div>

                <div id="rbox">
                    <div id="pathway"><?php mosPathway() ?></div>
                    <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                    <div id="mainbody"><?php mosMainbody() ?></div>
                    <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                    <div class="clr"><!-- --></div>
                </div>
        </div>
        <div class="clr"><!-- --></div>
        <div id="footer_container">
        <div id="footer_container_inner">
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div>
        </div>
</div>
</div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->