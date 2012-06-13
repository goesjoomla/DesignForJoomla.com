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
          #lbox{width:410px}
          #rbox{width:150px}
<?php } else { ?>
          #rbox{width:0px;height:0px}
          #top,#bottom{width:565px}
          #mainbody{width:550px}
          #lbox{width:580px}
          #footer_container,#content{background:none}
          #footer{width:562px}
<?php } ?>
</style>
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
<style type="text/css">
<?php if (mosCountModules ('left') OR mosCountModules ('right')) { ?>
          #lbox{width:410px}
          #rbox{width:150px}
<?php } else { ?>
          #rbox{width:0px;height:0px}
          #top,#bottom{width:565px}
          #mainbody{width:580px}
          #lbox{width:580px}
          #footer_container,#content{background:none}
          #footer_container{margin-top:-35px}
          #footer{width:574px}
<?php } ?>
</style>
<![endif]-->

</head>
<body><center>
<div id="container">
    <div id="header">
               <div id="logan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2);
                           else echo '<h1>Blue blog <b>template</b></h1>
                                      <h2>Soft color blog template...</h2>'?>
               </div>
    </div>
    <div id="subheader">
    <div id="menu"><?php $database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,7");
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

    </div>
    <div id="content">
        <div id="lbox">
                    <?php if (mosCountModules('top')) { ?><div id="top"><?php mosLoadModules('top', -2);?></div><?php } ?>
                    <div id="mainbody"><?php mosMainbody() ?></div>
                    <?php if (mosCountModules('bottom')) { ?><div id="bottom"><?php mosLoadModules('bottom', -2);?></div><?php } ?>
                    <div class="clr"><!-- --></div>
        </div>

        <div id="rbox">
               <div id="search_field"><?php $query = "SELECT id"
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
                                               <div id="search1">
                                                        <div id="inputbox">
                                                                <input name="searchword" maxlength="40" alt="search" class="inputbox" type="text" value="<?php echo _SEARCH_TITLE; ?>" onfocus="if(this.value=='<?php echo _SEARCH_TITLE; ?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _SEARCH_TITLE; ?>';}"/>
                                                        </div>
                                                        <div id="button">
                                                                <input class="button" type="image" alt="search" src="<?php echo _TEMPLATE_URL ?>/images/button.gif" onclick="document.searchForm.submit();" />
                                                        </div>
                                               </div>
                                            </form>
               </div>
               <?php if (mosCountModules('left')) { ?><div id="left"><?php mosLoadModules('left', -2);?></div><?php } ?>
               <?php if (mosCountModules('right')) { ?><div id="right"><?php mosLoadModules('right', -2);?></div><?php } ?>
               <div class="clr"><!-- --></div>
         </div>
    </div>
    <div id="footer_container">
    <div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
    </div>
</div>
</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>
</html><!-- Joomla Template by DesignForJoomla.com -->