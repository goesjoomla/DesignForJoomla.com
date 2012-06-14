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
	<?php if (mosCountModules( 'right' ))  { ?>
		#main{float:left;width:466px}
		#inner_main{width:454px}
	<?php } ?>
</style>
<!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
	<?php if (mosCountModules( 'right' ))  { ?>
		#main{float:left;width:474px}
		#inner_main{width:460px}
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
    	<div id="headlink"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
            else echo '
        	    <h1 title="'.$GLOBALS['mosConfig_sitename'].'">'.$GLOBALS['mosConfig_sitename'].'</h1>
                <h2>to <b>place</b> for <em>your slogan ...</em></h2>'?>
        </div>
	<div id="navbar"><?php
           $database->setQuery("SELECT id,name,link,type FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,7");
               	if ($rows = $database->loadObjectList()) {
                        for ($i = 0, $n = count($rows); $i < $n; $i++) {
                                if ($rows[$i]->type == 'url') {
                                        $link = $rows[$i]->link;
                                } else {
                                        $link = $rows[$i]->link.'&Itemid='.$rows[$i]->id;
                                }
                                $link = ampReplace($link);
                                echo '<a href="'.$link.'"><span>'.$rows[$i]->name.'</span></a>';
                        }
                } ?>
                </div>
        </div>

	<div id="body">
		<div id="main"><div id="inner_main"><?php mosMainbody() ?></div></div>
        <div id="rightcontainer"><?php if (mosCountModules('right')) mosLoadModules('right', -2);?></div>
        <div class="clearer"><!-- --></div>
    </div>

    <div id="footer" ><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>

</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->