<?php

// no direct access
defined('_VALID_MOS') or die('Restricted access');

// make sure that functions are defined one time only
if (!defined('_D4J_LIST_MENU_FUNC_INCLUDED')) {
        define('_D4J_LIST_MENU_FUNC_INCLUDED', 1);

        /**
        * Function for writing a menu link
        */
        function d4jGetMenuLink($mitem, $level=0, &$params, $open=null) {
                global $Itemid, $mosConfig_live_site, $mainframe;
                $txt = '';

                switch ($mitem->type) {
                        case 'separator':
                        case 'component_item_link':
                                break;

                        case 'url':
                                if (eregi('index.php\?', $mitem->link)) {
                                        if (!eregi('Itemid=', $mitem->link)) {
                                                $mitem->link .= '&Itemid='. $mitem->id;
                                        }
                                }
                                break;

                        case 'content_item_link':
                        case 'content_typed':
                                // load menu params
                                $menuparams = new mosParameters($mitem->params, $mainframe->getPath('menu_xml', $mitem->type), 'menu');
                                $unique_itemid = $menuparams->get('unique_itemid', 1);

                                if ($unique_itemid) {
                                        $mitem->link .= '&Itemid='. $mitem->id;
                                } else {
                                        $temp = split('&task=view&id=', $mitem->link);

                                        if ($mitem->type == 'content_typed') {
                                                $mitem->link .= '&Itemid='. $mainframe->getItemid($temp[1], 1, 0);
                                        } else {
                                                $mitem->link .= '&Itemid='. $mainframe->getItemid($temp[1], 0, 1);
                                        }
                                }
                                break;

                        default:
                                $mitem->link .= '&Itemid='. $mitem->id;
                                break;
                }

                // Active Menu highlighting
                $hl = '"';
                if ($params->get('active_id')) {
                        // determine CSS selector to use for active highlighting
                        if ($params->get('legacy_mode')) {
                                $highlight = '" id="active_menu'. $params->get('menuclass_sfx') .'"';
                        } else {
                                $highlight = ' active_mitem'. $params->get('menuclass_sfx') .'"';
                        }

                        $current_itemid = $Itemid;
                        if (!$current_itemid) {
                                // do nothing
                        } elseif ($current_itemid == $mitem->id) {
                                $hl = $highlight;
                        } elseif ($params->get('activate_parent') && isset($open) && in_array($mitem->id, $open))  {
                                $hl = $highlight;
                        }

                        if ($params->get('full_active_id')) {
                                // support for `active_menu` of `Link - Component Item`
                                if ($hl == '"' && $mitem->type == 'component_item_link') {
                                        parse_str($mitem->link, $url);
                                        if ($url['Itemid'] == $current_itemid) {
                                                $hl = $highlight;
                                        }
                                }

                                // support for `active_menu` of `Link - Url` if link is relative
                                if ($hl == '"' && $mitem->type == 'url' && strpos('http', $mitem->link) === false) {
                                        parse_str($mitem->link, $url);
                                        if (isset($url['Itemid'])) {
                                                if ($url['Itemid'] == $current_itemid) {
                                                        $hl = $highlight;
                                                }
                                        }
                                }
                        }
                }

                // replace & with amp; for xhtml compliance
                $mitem->link = ampReplace($mitem->link);

                // run through SEF convertor
                $mitem->link = sefRelToAbs($mitem->link);

                // remove slashes from escaped characters
                $mitem->name = stripslashes(ampReplace($mitem->name));

                // build <a> tag
                $menuclass = ($level == 0 ? 'mainlevel' : 'sublevel') . $params->get('menuclass_sfx');
                switch ($mitem->browserNav) {
                        // cases are slightly different
                        case 1:
                                // open in a new window
                                $txt = '<a href="'. $mitem->link .'" target="_blank" class="'. $menuclass . $hl .'>'. $mitem->name .'</a>';
                                break;

                        case 2:
                                // open in a popup window
                                $txt = "<a href=\"#\" onclick=\"javascript: window.open('". $mitem->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass". $hl .">". $mitem->name ."</a>\n";
                                break;

                        case 3:
                                // don't link it
                                $txt = '<span class="'. $menuclass . $hl .'>'. $mitem->name .'</span>';
                                break;

                        default:
                                // open in parent window
                                $txt = '<a href="'. $mitem->link .'" class="'. $menuclass . $hl .'>'. $mitem->name .'</a>';
                                break;
                }

                // attach menu image if enable
                if ($params->get('menu_images')) {
                        $menu_params = new mosParameters($mitem->params);
                        $menu_image        = $menu_params->def('menu_image', -1);
                        if (($menu_image != '-1') && $menu_image) {
                                $image = '<img src="'. $mosConfig_live_site .'/images/stories/'. $menu_image .'" border="0" alt="'. $mitem->name .'" />';
                                if ($params->get('menu_images_align')) {
                                        $txt = $txt . $image;
                                } else {
                                        $txt = $image . $txt;
                                }
                        }
                }

                return $txt;
        }

        /**
        * Utility function to recursively work through a multi-level menu system
        */
        function d4jRecurseMenu($id, $level, &$children, &$open, &$params) {
                if (@$children[$id]) { // has child?
                        $tabs = '';
                        if ($level == 0) {
                                // count root-menu items
                                $root_items = 0;

                                // determine CSS selector to use for root <ul> tag
                                if ($params->get('legacy_mode')) {
                                        $menuSign = 'id="mainlevel"';
                                } else {
                                        $menuSign = 'class="list_menu'. $params->get('menuclass_sfx') .'"';
                                }
                        } else {
                                // count tabs
                                for ($i = 0; $i < $level; $i++) {
                                        $tabs .= "\t";
                                }
                        }

                        echo "\n$tabs<ul". ($level == 0 ? " $menuSign" : '') .">";
                        foreach ($children[$id] as $row) { // list all childs
                                // if root-menu items counted reachs limit?
                                if ($level == 0 AND $params->get('rootmenu_count') AND $root_items >= $params->get('rootmenu_count'))
                                        break;

                                $link = d4jGetMenuLink($row, $level, $params, $open);
                                if (preg_match("/active_(mitem|menu)/", $link)) {
                                        // found active menu item, add highlight sign to <li> tag
                                        echo "\n$tabs".'<li class="active_mitem'. $params->get('menuclass_sfx') .'">';
                                } else {
                                        echo "\n$tabs<li>";
                                }
                                echo $link;

                                // is displaying of sub-menu enabled?
                                if ($params->get('submenu_deep') > 0) {
                                        if (!$params->get('expand_all')) {
                                                // show sub-menu only for active root-menu item
                                                if (in_array($row->id, $open)) {
                                                        d4jRecurseMenu($row->id, $level+1, $children, $open, $params);
                                                }
                                        } else {
                                                // show all sub-menus
                                                d4jRecurseMenu($row->id, $level+1, $children, $open, $params);
                                        }
                                }
                                echo "</li>";

                                // count root-menu items
                                if ($level == 0 AND $params->get('rootmenu_count'))
                                        $root_items++;
                        }
                        echo "$tabs</ul>\n";
                }
        }

        /**
        * Function to draw hierarchycal list style menu system
        */
        function d4jShowMenu(&$params) {
                global $database, $mainframe, $my, $cur_template, $Itemid;
                global $mosConfig_live_site, $mosConfig_shownoauth;

                // check if data already queried
                $rows = $mainframe->get($params->get('menutype').'_items');

                // if data not already queried
                if (!$rows) {
                        // get menu data
                        $and = '';
                        if (!$mosConfig_shownoauth) {
                                $and = "\n AND access <= $my->gid";
                        }
                        $sql = "SELECT * FROM #__menu"
                        . "\n WHERE menutype = '". $params->get('menutype') ."'"
                        . "\n AND published = 1"
                        . $and
                        . "\n ORDER BY parent, ordering"
                        ;
                        $database->setQuery($sql);
                        $rows = $database->loadObjectList('id');

                        // store data to mainframe object
                        $mainframe->set($params->get('menutype').'_items', $rows);
                }

                // establish the hierarchy of the menu
                $children = array();
                // first pass - collect children
                foreach ($rows as $v) {
                        $pt                = $v->parent;
                        $list        = @$children[$pt] ? $children[$pt] : array();
                        array_push($list, $v);
                        $children[$pt] = $list;
                }

                // is displaying of sub-menu enabled?
                if ($params->get('submenu_deep') > 0) {
                        // second pass - collect 'open' menus
                        $open        = array($Itemid);
                        $count        = $params->get('submenu_deep'); // max sub-menu deep
                        $id                = $Itemid;
                        while ($count--) {
                                if (isset($rows[$id]) && $rows[$id]->parent > 0) {
                                        $id = $rows[$id]->parent;
                                        $open[] = $id;
                                } else {
                                        break;
                                }
                        }
                }

                // is SuckerFish enabled?
                if ($params->get('sf_menu')) {
                        $elmId = 'sf_dropdown'. $params->get('menuclass_sfx') .'_'. (time() + rand(0,9999));
                        echo '
<script type="text/javascript"><!-- // --><![CDATA[
sfMenus[sfMenus.length] = "'.$elmId.'";
// ]]></script>
'
                        ;
                        $elmId = ' id="'.$elmId.'"';
                        echo '
<div'.$elmId.' class="sf_dropdown'. $params->get('menuclass_sfx') .'">'
                        ;
                }

                // build hierarchycal list
                d4jRecurseMenu(0, 0, $children, $open, $params);

                // is SuckerFish enabled?
                if ($params->get('sf_menu'))
                        echo '</div>';
        }
}

// define parameters
$params->def('menuclass_sfx',                '');

$params->def('menutype',                         'mainmenu');
$params->def('legacy_mode',                        0);
$params->def('active_id',                         1);
$params->def('full_active_id',                1);
$params->def('activate_parent',         1);

$params->def('rootmenu_count',                0);
$params->def('submenu_deep',                1);
$params->def('expand_all',                        1);
$params->def('sf_menu',                                1);

$params->def('menu_images',                 0);
$params->def('menu_images_align',         0);

// include SuckerFish JavaScript fix for IE
if ($params->get('sf_menu') AND !defined('_D4J_LIST_MENU_SFJS_INCLUDED')) {
        define('_D4J_LIST_MENU_SFJS_INCLUDED', 1);
        echo '
<script type="text/javascript"><!-- // --><![CDATA[
var sfMenus = new Array();
sfHover = function() {
        for (var i = 0; i < sfMenus.length; i++) {
                var sfUlEls = document.getElementById(sfMenus[i]).getElementsByTagName("ul");
                for (var j = 0; j < sfUlEls.length; j++) {
                        var sfLiEls = sfUlEls[j].getElementsByTagName("li");
                        for (var k = 0; k < sfLiEls.length; k++) {
                                sfLiEls[k].onmouseover = function() {
                                        this.className += " sfhover";
                                }
                                sfLiEls[k].onmouseout = function() {
                                        this.className = this.className.replace(new RegExp(" sfhover"), "");
                                }
                        }
                }
        }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
// ]]></script>'        ;
}

// show the hierarchycal list menu
d4jShowMenu($params);
?>