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
          #lbox{width:175px}
          #rbox{width:557px}
<?php } else { ?>
          #rbox,#top,#bottom{margin:0;width:740px}
          #top .moduletable,#bottom .moduletable{padding:0 10px 22px 10px}
          #mainbody{margin:0;width:720px;padding:0 10px 22px 10px}
          #lbox{width:0px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{width:175px}
          #rbox{width:557px}
<?php } else { ?>
          #rbox,#top,#bottom{margin:0;width:740px}
          #top .moduletable,#bottom .moduletable{padding:0 10px 22px 10px}
          #mainbody{margin:0;width:740px;padding:0 10px 22px 10px}
          #lbox{width:0px}
<?php } ?>
</style>

<![endif]-->
</head>
<body><center>
<div id="container">
        <div id="header">
                 <div id="title"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
                           else echo '<h1>Company Name</h1><h2>to place for your slogan</h2>' ?>
                 </div>
        </div>

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
        <div id="content">
                <div id="lbox">
                           <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
                           <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
                </div>

                <div id="rbox">
                            <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                            <div id="mainbody"><?php mosMainbody() ?></div>
                            <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                </div>
        </div>

        <div class="clr"><!-- --></div>
        <div id="footer_container">
        <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
        </div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->