<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

if (!defined('_D4J_MENU_FUNC_INCLUDED')) {
	define('_D4J_MENU_FUNC_INCLUDED', 1);

	/**
	* Utility function for writing a menu link
	*/
	function d4jGetMenuLink( $mitem, $level=0, &$params, &$menu_trans, $open=null ) {
		global $Itemid, $mosConfig_live_site, $mainframe;

		$txt = '';

		switch ($mitem->type) {
			case 'separator':
			case 'component_item_link':
				break;

			case 'url':
				if ( eregi( 'index.php\?', $mitem->link ) ) {
					if ( !eregi( 'Itemid=', $mitem->link ) ) {
						$mitem->link .= '&Itemid='. $mitem->id;
					}
				}
				break;

			case 'content_item_link':
			case 'content_typed':
				// load menu params
				$menuparams = new mosParameters( $mitem->params, $mainframe->getPath( 'menu_xml', $mitem->type ), 'menu' );

				$unique_itemid = $menuparams->get( 'unique_itemid', 1 );

				if ( $unique_itemid ) {
					$mitem->link .= '&Itemid='. $mitem->id;
				} else {
					$temp = split('&task=view&id=', $mitem->link);

					if ( $mitem->type == 'content_typed' ) {
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
		$id = '';
		if ($params->get( 'active_id' )) {
			$current_itemid = $Itemid;
			if ( !$current_itemid ) {
				// do nothing
			} else if ( $current_itemid == $mitem->id ) {
				$id = 'id="active_menu_' .'"';
			} else if( $params->get( 'activate_parent' ) && isset( $open ) && in_array( $mitem->id, $open ) )  {
				$id = 'id="active_menu_' .'"';
			} else {
				// do nothing
			}

			if ( $params->get( 'full_active_id' ) ) {
				// support for `active_menu` of 'Link - Component Item'
				if ( $id == '' && $mitem->type == 'component_item_link' ) {
					parse_str( $mitem->link, $url );
					if ( $url['Itemid'] == $current_itemid ) {
						$id = 'id="active_menu_' .'"';
					}
				}

				// support for `active_menu` of 'Link - Url' if link is relative
				if ( $id == '' && $mitem->type == 'url' && strpos( 'http', $mitem->link ) === false) {
					parse_str( $mitem->link, $url );
					if ( isset( $url['Itemid'] ) ) {
						if ( $url['Itemid'] == $current_itemid ) {
							$id = 'id="active_menu_' .'"';
						}
					}
				}
			}
		}

		// replace & with amp; for xhtml compliance
		$mitem->link = ampReplace( $mitem->link );

		// run through SEF convertor
		$mitem->link = sefRelToAbs( $mitem->link );

		// replace menu title with menu alias		
		if (count( $menu_trans )) {
			if (isset($menu_trans[$mitem->name]) AND $menu_trans[$mitem->name] != '') {
				$mitem->name = $menu_trans[$mitem->name];				
			}
		}

		// replace & with amp; for xhtml compliance
		// remove slashes from escaped characters
		$mitem->name = stripslashes( ampReplace($mitem->name) );

		$menuclass = $level == 0 ? 'mainlevel' : 'sublevel';
		switch ($mitem->browserNav) {
			// cases are slightly different
			case 1:
				// open in a new window
				$txt = '<a href="'. $mitem->link .'" target="_blank" class="'. $menuclass .'" '. $id .'>'. $mitem->name .'</a>';
				break;

			case 2:
				// open in a popup window
				$txt = "<a href=\"#\" onclick=\"javascript: window.open('". $mitem->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\" ". $id .">". $mitem->name ."</a>\n";
				break;

			case 3:
				// don't link it
				$txt = '<span class="'. $menuclass .'" '. $id .'>'. $mitem->name .'</span>';
				break;

			default:
				// open in parent window
				$txt = '<a href="'. $mitem->link .'" class="'. $menuclass .'" '. $id .'>'. $mitem->name .'</a>';
				break;
		}

		// add onMouseOver and onMouseOut action for popup tips
		

		if ( $params->get( 'menu_images' ) ) {
			$menu_params 	= new stdClass();
			$menu_params 	= new mosParameters( $mitem->params );
			$menu_image 	= $menu_params->def( 'menu_image', -1 );
			if ( ( $menu_image != '-1' ) && $menu_image ) {
				$image = '<img src="'. $mosConfig_live_site .'/images/stories/'. $menu_image .'" border="0" alt="'. $mitem->name .'"/>';
				if ( $params->get( 'menu_images_align' ) ) {
					$txt = $txt .' '. $image;
				} else {
					$txt = $image .' '. $txt;
				}
			}
		}

		return $txt;
	}

	/**
	* Draws a single/full level list style menu system
	*/
	function d4jShowMenu( &$params, &$menu_trans) {
		global $database, $my, $cur_template, $Itemid;
		global $mosConfig_live_site, $mosConfig_shownoauth;

		$and = '';
		if ( !$mosConfig_shownoauth ) {
			$and = "\n AND access <= $my->gid";
		}
		if($params->get( 'parentlimit' )){
			$sql = "SELECT m.id"
			."\n FROM #__menu AS m"
			."\n WHERE menutype = '". $params->get( 'menutype' ) ."'"
			. "\n AND published = 1 "
			. "\n AND parent = 0 "
			. "\n ORDER BY ordering"		
			. "\n LIMIT 0,".$params->get( 'parentlimit' )
			; 
			$database->setQuery( $sql );
			$rowsID = $database->loadResultArray();
			$rowsIDs = "(".implode(",",$rowsID).")";
		}
		$sql = "SELECT m.*"
		. "\n FROM #__menu AS m"
		. "\n WHERE menutype = '". $params->get( 'menutype' ) ."'"
		. "\n AND published = 1 "
		. $and
		. ($params->get( 'expand_menu' ) ? "" : "\n AND parent = 0")
		. (($params->get( 'parentlimit' ))? "\n AND ((parent <> 0) AND (parent IN $rowsIDs)) OR ((parent = 0) AND (id IN $rowsIDs))":"")
		. ($params->get( 'expand_menu' ) ? "\n ORDER BY parent, ordering" : "\n ORDER BY ordering")		
		;
		$database->setQuery( $sql );		
		$rows = $database->loadObjectList( 'id' );

		$menuclass = 'mainlevel';
		if ($params->get( 'expand_menu' )) {
			// establish the hierarchy of the menu
			$children = array();
			// first pass - collect children
			foreach ($rows as $v ) {
				$pt 	= $v->parent;
				$list 	= @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}

			// second pass - collect 'open' menus
			$open 	= array( $Itemid );
			$count 	= 20; // maximum levels - to prevent runaway loop
			$id 	= $Itemid;

			while (--$count) {
				if (isset($rows[$id]) && $rows[$id]->parent > 0) {
					$id = $rows[$id]->parent;
					$open[] = $id;
				} else {
					break;
				}
			}

			d4jRecurseMenu( 0, 0, $children, $open, $params, $menu_trans,1);
		} else { // output Joomla standard singe-level flat list
			$links = array();
			foreach ($rows as $row) {
				$links[] = d4jGetMenuLink( $row, 0, $params, $menu_trans );
			}

			if (count( $links )) {
				echo '<ul id="'.$menuclass.'">';
				foreach ($links as $link) {
					echo '<li>'.$link.'</li>';
				}
				echo '</ul>';
			}
		}
	}

	/**
	* Utility function to recursively work through a multi-level menu system
	*/
	function d4jRecurseMenu( $id, $level, &$children, &$open, &$params, &$menu_trans,$first_link) {		
		
		if (@$children[$id]) { // has child?
			echo "\n<ul" . ($level == 0 ? ' id="'.$params->get('menutype').'"' : '') . ">";
			$i = $first_link;
			foreach ($children[$id] as $row) { // list all childs
				$link = d4jGetMenuLink( $row, $level, $params, $menu_trans, $open );
				$pattern = "/\s*?id=\"active_menu_" ."\"\s*?/";
				if (preg_match($pattern, $link)) {
					echo "\n<li class=\"active\"".(($i)?" id=\"navlinkfirst\">":">");
				} else {
					echo "\n<li".(($i)?" id=\"navlinkfirst\">":">");
				}
				$i=0;
				if (@$children[$row->id]) {
					if ($level == 0) {
						$link = str_replace('class="mainlevel"', 'class="mainlevel topdaddy"', $link);
						
					} else {
						$link = str_replace('class="sublevel"', 'class="sublevel daddy"', $link);
					}
				}
				echo $link;

				// show menu with menu expanded of active menu
				if (preg_match($pattern, $link)) {
					$active_id = $row->id;					
				}

				echo "</li>";
			}

			echo "\n</ul>";
			if($level == 0) {
				echo "<div class='clearer'><!-- --></div><div id='D4J_SubMenu'>";
				d4jRecurseMenu( $active_id, $level+1, $children, $open, $params, &$menu_trans,0);			
				echo "</div>\n";
			}
		}		
	}

	function parseMenuTitleAliasArray($cur_node, &$menu_trans) {
		if (isset($cur_node['item']) AND is_array($cur_node['item'])) {
			$title = isset($cur_node['item'][0]['title'][0]) ? $cur_node['item'][0]['title'][0] : '';
			$alias = isset($cur_node['item'][1]['alias'][0]) ? $cur_node['item'][1]['alias'][0] : '';
			if ($title) $menu_trans[$title] = str_replace('<![CDATA[', '', str_replace(']]>', '', $alias));
		} elseif (is_array($cur_node)) {
			foreach ($cur_node AS $node) {
				parseMenuTitleAliasArray($node, &$menu_trans);
			}
		} else {
			return;
		}
	}
}

$params->def('menutype', 			'mainmenu');
$params->def('active_id', 			1);
$params->def('full_active_id',		0);
$params->def('activate_parent', 	1);

$params->def('menu_images', 		0);
$params->def('menu_images_align', 	0);

$params->def('expand_menu',			1);
$params->def('parentlimit',			8);//number of parent link

// parse menu item aliases from xml file
$menu_trans = array();
if (file_exists(dirname(__FILE__).'/'.$params->get('menutype').'.xml')) {
	require_once($GLOBALS['mosConfig_absolute_path']."/includes/domit/xml_domit_parser.php");
	$menu_items =& new DOMIT_Document();
	if ($success = $menu_items->loadXML(dirname(__FILE__).'/'.$params->get('menutype').'.xml', false)) {
		parseMenuTitleAliasArray($menu_items->toArray(), &$menu_trans);
	}
}

d4jShowMenu( $params, $menu_trans);

?>