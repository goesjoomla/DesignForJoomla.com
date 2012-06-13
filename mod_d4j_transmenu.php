<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_offset, $mosConfig_live_site, $gid;

// Module Params
$class_sfx				= $params->get( 'class_sfx', '' );
$moduleclass_sfx		= $params->get( 'moduleclass_sfx', '' );

$menutype				= $params->get( 'menutype', 'mainmenu' );
$menu_style				= $params->get( 'menu_style', 'vertical' );
$show_placeholder		= intval($params->get( 'show_placeholder', 0 ));
$root_placeholder_style	= trim($params->get( 'root_placeholder_style', 'mainlevel' ));
$sub_placeholder_style	= trim($params->get( 'sub_placeholder_style', 'sublevel' ));

$show_separator			= intval($params->get( 'show_separator', 0 ));
$separator_str			= $params->get( 'separator_str', '&nbsp;|&nbsp;' );
$separator_img			= trim($params->get( 'separator_img', '' ));

$submenu_direction		= $params->get( 'submenu_direction', 'right' );
$submenu_position		= $params->get( 'submenu_position', 'topRight' );
$left_offset			= intval($params->get( 'left_offset', 0 ));
$top_offset				= intval($params->get( 'top_offset', 0 ));
$menu_padding			= intval($params->get( 'menu_padding', 3 ));
$item_padding			= intval($params->get( 'item_padding', 1 ));
$dingbatSize			= intval($params->get( 'dingbatSize', 16 ));
$hideDelay				= intval($params->get( 'hideDelay', 1000 ));
$slideTime				= intval($params->get( 'slideTime', 400 ));

$shadowSize				= intval($params->get( 'shadowSize', 2 ));
$shadowOffset			= intval($params->get( 'shadowOffset', 3 ));
$shadowColor			= substr($params->get( 'shadowColor' ), 0, 1) == '#' ? $params->get( 'shadowColor' ) : "#888";
$shadow_opacity			= intval(str_replace('%', '', $params->get( 'shadow_opacity', 40)));

$menu_background		= $params->get( 'menu_background', 'auto' );
$backgroundColor		= substr($params->get( 'backgroundColor' ), 0, 1) == '#' ? $params->get( 'backgroundColor' ) : "#555";
$background_opacity		= intval(str_replace('%', '', $params->get( 'background_opacity', 80)));

$menu_image				= intval($params->get( 'menu_image', 0 ));
$hide_menu_name			= intval($params->get( 'hide_menu_name', 0 ));
$menu_image_alignment	= $params->get( 'menu_image_alignment', 'left' );
$menu_image_width		= intval($params->get( 'menu_image_width', 16 ));
$menu_image_height		= intval($params->get( 'menu_image_height', 16 ));
$menu_image_margin		= intval($params->get( 'menu_image_margin', 5 ));

// test if data is already in mainframe storage
$test = $mainframe->get("d4j_transmenu_totals_$menutype", 0);
if ( !$test ) {
	$query = "SELECT COUNT( id ) AS count, parent"
	. "\n FROM #__menu"
	. "\n WHERE menutype = '$menutype'"
	. "\n AND access <= $gid"
	. "\n AND sublevel = 0"
	. "\n AND published = 1"
	. ($show_placeholder ? '' : "\n AND type != 'separator'")
	. "\n GROUP BY parent"
	;
	$database->setQuery( $query );
	$totals = $database->loadObjectList();

	// store data in mainframe storage
	$mainframe->set( "d4j_transmenu_totals_$menutype", $totals );
}

// test if data is already in mainframe storage
$test = $mainframe->get("d4j_transmenu_items_$menutype", 0);
if ( !$test ) {
	$query = "SELECT id, name, link, type, parent, browserNav, params"
	. "\n FROM #__menu"
	. "\n WHERE menutype = '$menutype'"
	. "\n AND access <= $gid"
	. "\n AND sublevel = 0"
	. "\n AND published = 1"
	. ($show_placeholder ? '' : "\n AND type != 'separator'")
	. "\n ORDER BY ordering"
	;
   	$database->setQuery( $query );
	$items = $database->loadObjectList();

	// store data in mainframe storage
	$mainframe->set( "d4j_transmenu_items_$menutype", $items );
}

if (!defined('_TRANSMENU_FUNCTION_DEFINED')) {
	define('_TRANSMENU_FUNCTION_DEFINED', 1);

	// Functions to retrieve menu items
	function has_child($menu_id, $menutype) {
	    global $mainframe;

		// pull data from mainframe storage
		$totals = $mainframe->get("d4j_transmenu_totals_$menutype");

		$total_count = '';

		foreach( $totals as $total ) {
			// collect data for parent
			if ( $total->parent == $menu_id ) {
				$total_count = $total->count;
			}
		}

		if ($total_count) {
			return true;
		} else {
			return false;
		}
	}

	function get_child_list_menu($parent_id, $menutype, $menu_image, $hide_menu_name, $menu_image_width, $menu_image_height, $menu_image_margin, $menu_image_alignment, $transmenu_id) {
	    global $mainframe;

	    $js_code 	= '';
	    $i 			= 0;

		// pull data from mainframe storage
		$items	= $mainframe->get("d4j_transmenu_items_$menutype");

		$rows = array();
		foreach( $items as $item ) {
			// collect data for parent
			if ( $item->parent == $parent_id ) {
				$rows[] = $item;
			}
		}

		if ( count($rows) ) {
	   		foreach ($rows AS $row) {
	   			$item_params =& new mosParameters($row->params);
	   			if ($menu_image) {
	   				if ($hide_menu_name) {
	   					$item_title = ($item_params->get('menu_image','') != '' AND !is_numeric($item_params->get('menu_image',''))) ? '<img src=\"'.$GLOBALS['mosConfig_live_site'].'/images/stories/'.$item_params->get('menu_image').'\" width=\"'.$menu_image_width.'\" height=\"'.$menu_image_height.'\" border=\"0\" style=\"margin-right:'.$menu_image_margin.'px;\" align=\"absmiddle\" />' : $row->name;
	   				} else {
	   					$item_title = (($item_params->get('menu_image','') != '' AND !is_numeric($item_params->get('menu_image','')) AND $menu_image_alignment == 'left') ? '<img src=\"'.$GLOBALS['mosConfig_live_site'].'/images/stories/'.$item_params->get('menu_image').'\" width=\"'.$menu_image_width.'\" height=\"'.$menu_image_height.'\" border=\"0\" style=\"margin-right:'.$menu_image_margin.'px;\" align=\"absmiddle\" />' : '').$row->name.(($item_params->get('menu_image','') != '' AND !is_numeric($item_params->get('menu_image','')) AND $menu_image_alignment == 'right') ? '<img src=\"'.$GLOBALS['mosConfig_live_site'].'/images/stories/'.$item_params->get('menu_image').'\" width=\"'.$menu_image_width.'\" height=\"'.$menu_image_height.'\" border=\"0\" style=\"margin-left:'.$menu_image_margin.'px;\" align=\"absmiddle\" />' : '').'", "'.($row->type == 'url' ? $row->link : sefRelToAbs($row->link.'&Itemid='.$row->id));
	   				}
	   			} else {
	   				$item_title = $row->name;
	   			}
	   			$js_code .= "\n\t\t".$transmenu_id.'_menu'.$parent_id.'.addItem("'.$item_title.'", "'.($row->type == 'separator' ? '#' : ($row->type == 'url' ? $row->link : sefRelToAbs($row->link.'&Itemid='.$row->id))).'", '.$row->browserNav.');';
	   			if (has_child($row->id, $menutype)) {
	   				$js_code .= "\n\t\t".'var '.$transmenu_id.'_menu'.$row->id.' = '.$transmenu_id.'_menu'.$parent_id.'.addMenu('.$transmenu_id.'_menu'.$parent_id.'.items['.$i.']);';
	   				$js_code .= get_child_list_menu($row->id, $menutype, $menu_image, $hide_menu_name, $menu_image_width, $menu_image_height, $menu_image_margin, $menu_image_alignment, $transmenu_id);
	   			}
	   			$i++;
	   		}
	   	}

	    return $js_code;
	}
}

$transmenu_id = 'transmenu'.rand(0, 100000);
?>

<!-- Initialize TransMenu \-->
<div id="<?php echo $transmenu_id; ?>" style="display:none"></div>

<?php
if (!defined('_TRANSMENU_CSS_INCLUDED')) { define('_TRANSMENU_CSS_INCLUDED', 1);
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site;?>/modules/mod_d4j_transmenu.css" />
	<?php
}
?>

<style type="text/css">
/* this DIV is the semi-transparent white background of each menu. the -moz-opacity is a proprietary way to get transparency in mozilla, the filter is for IE/windows 5.0+. */
/* we set the background color in script because ie mac does not use it; that browser only uses a semi-transparent white PNG that the spacer gif inside this DIV is replaced by */
.transMenu .background {
	position:absolute;
	left:0px; top:0px;
	z-index:1;
	-moz-opacity:<?php echo ($background_opacity / 100); ?>;
	filter:alpha(opacity=<?php echo $background_opacity; ?>);
}
/* same concept as .background, but this is the sliver of shadow on the right of the menu. It's left, height, and background are set by script. In IE5/mac, it uses a PNG */
.transMenu .shadowRight {
	position:absolute;
	z-index:3;
	top:3px; width:2px;
	-moz-opacity:<?php echo ($shadow_opacity / 100); ?>;
	filter:alpha(opacity=<?php echo $shadow_opacity; ?>);
}
/* same concept as .background, but this is the sliver of shadow on the bottom of the menu. It's top, width, and background are set by script. In IE5/mac, it uses a PNG */
.transMenu .shadowBottom {
	position:absolute;
	z-index:1;
	left:3px; height:2px;
	-moz-opacity:<?php echo ($shadow_opacity / 100); ?>;
	filter:alpha(opacity=<?php echo $shadow_opacity; ?>);
}
</style>

<?php
if (!defined('_TRANSMENU_JS_INCLUDED')) {
	define('_TRANSMENU_JS_INCLUDED', 1);
	?>
	<script language="javascript" type="text/javascript">
	function getBgColor(root) {
		var bgColor = '';
		if (typeof root.style != '') {
			if (typeof root.style.backgroundColor != 'undefined' && root.style.backgroundColor != '') {
				bgColor = root.style.backgroundColor;
			}
		} else if (typeof root.bgColor != 'undefined' && root.bgColor != '') {
			bgColor = root.bgColor;
		} else {
			bgColor = getBgColor(root.parentNode);
		}
		return bgColor;
	}
	</script>
	<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/modules/mod_d4j_transmenu/transmenu.compact.js"></script>
	<?php
}
?>

<script language="javascript" type="text/javascript">
	// Menu Class Suffix
	var menu_class_suffix = "<?php echo $class_sfx; ?>";

	// Placeholder CSS class
	var sub_placeholder_style = "<?php echo $sub_placeholder_style; ?>";

	// TransMenu settings
	TransMenu.spacerGif = "modules/mod_d4j_transmenu/img/x.gif";                     // path to a transparent spacer gif
	TransMenu.dingbatOn = "modules/mod_d4j_transmenu/img/submenu-on.gif";            // path to the active sub menu dingbat
	TransMenu.dingbatOff = "modules/mod_d4j_transmenu/img/submenu-off.gif";          // path to the inactive sub menu dingbat
	TransMenu.shadowPng = "modules/mod_d4j_transmenu/img/grey-40.png";               // a PNG graphic to serve as the shadow for mac IE5
	TransMenu.backgroundPng = "modules/mod_d4j_transmenu/img/white-90.png";          // a PNG graphic to server as the background for mac IE5
	TransMenu.dingbatSize = <?php echo $dingbatSize; ?>;
	TransMenu.menuPadding = <?php echo $menu_padding; ?>;
	TransMenu.itemPadding = <?php echo $item_padding; ?>;
	TransMenu.shadowSize = <?php echo $shadowSize; ?>;
	TransMenu.shadowOffset = <?php echo $shadowOffset; ?>;
	TransMenu.shadowColor = "<?php echo $shadowColor; ?>";

<?php
if ($menu_background == 'auto') {
	?>
	TransMenu.backgroundColor = getBgColor(document.getElementById('<?php echo $transmenu_id; ?>'));
	TransMenu.backgroundColor = TransMenu.backgroundColor == '' ? '<?php echo $backgroundColor; ?>' : TransMenu.backgroundColor;
	<?php
} else {
	?>
	TransMenu.backgroundColor = "<?php echo $backgroundColor; ?>";
	<?php
}
?>

	TransMenu.hideDelay = <?php echo $hideDelay; ?>;
	TransMenu.slideTime = <?php echo $slideTime; ?>;

	// if supported, initialize TransMenu
	function initTransMenu() {
		if (TransMenu.isSupported()) {
			TransMenu.initialize();
		}
	}
</script>
<!-- Initialize TransMenu /-->

<!-- Load TransMenu`s top level \-->
<?php
	// pull data from mainframe storage
	$items = $mainframe->get("d4j_transmenu_items_$menutype");

	$top_level = array();
	foreach( $items as $item ) {
		// collect data for top level
		if ( $item->parent == 0 ) {
			$top_level[] = $item;
		}
	}

	echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';

	if ($menu_style == 'horizontal') {
		echo '<tr>';
	}

	if ($show_separator) {
		$top_level_count = count($top_level);
		$current_index = 0;
	}
	foreach ($top_level as $row) {
		$menu_params =& new mosParameters($row->params);

		if ($menu_style == 'vertical') {
			echo '<tr>';
		}

		if ($menu_image) {
			if ($hide_menu_name) {
				$menu_title = ($menu_params->get('menu_image','') != '' AND !is_numeric($menu_params->get('menu_image',''))) ? '<img src="'.$GLOBALS['mosConfig_live_site'].'/images/stories/'.$menu_params->get('menu_image').'" width="'.$menu_image_width.'" height="'.$menu_image_height.'" border="0" style="margin-right:'.$menu_image_margin.'px;" align="absmiddle" />' : $row->name;
			} else {
				$menu_title = (($menu_params->get('menu_image','') != '' AND !is_numeric($menu_params->get('menu_image','')) AND $menu_image_alignment == 'left') ? '<img src="'.$GLOBALS['mosConfig_live_site'].'/images/stories/'.$menu_params->get('menu_image').'" width="'.$menu_image_width.'" height="'.$menu_image_height.'" border="0" style="margin-right:'.$menu_image_margin.'px;" align="absmiddle" />' : '').$row->name.(($menu_params->get('menu_image','') != '' AND !is_numeric($menu_params->get('menu_image','')) AND $menu_image_alignment == 'right') ? '<img src="'.$GLOBALS['mosConfig_live_site'].'/images/stories/'.$menu_params->get('menu_image').'" width="'.$menu_image_width.'" height="'.$menu_image_height.'" border="0" style="margin-left:'.$menu_image_margin.'px;" align="absmiddle" />' : '');
			}
		} else {
			$menu_title = $row->name;
		}

		if ( $row->type == 'separator' ) { // this menu item is a placeholder, dont hyperlink it
			echo '<td valign="middle"><div id="'.$transmenu_id.'_menu'.$row->id.'" class="'.$root_placeholder_style.$class_sfx.'">'.$menu_title.'</div></td>';
		} else {
			if ( $row->type == 'url' ) {
				$url = $row->link;
			} else {
				$url = sefRelToAbs($row->link.'&Itemid='.$row->id);
			}

			if ($row->browserNav == 1) {
				$url .= '" target="_blank';
			} elseif ($row->browserNav == 2) {
				$url .= '" onclick="javascript: window.open(\''.$url.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
			}

			echo '<td valign="middle"><a id="'.$transmenu_id.'_menu'.$row->id.'" class="mainlevel'.$class_sfx.'" href="'.$url.'">'.$menu_title.'</a></td>';
		}

		if ($menu_style == 'vertical') {
			echo '</tr>';
		}

		if ($show_separator) {
			$current_index++;
			if ($current_index < $top_level_count) {
				if ($menu_style == 'vertical') {
					echo '<tr>';
				}
				echo '<td valign="middle">';
				if ($show_separator == 1) {
					echo $separator_str;
				} else {
					echo '<img border="0" src="'.$separator_img.'" align="absmiddle" />';
				}
				echo '</td>';
				if ($menu_style == 'vertical') {
					echo '</tr>';
				}
			}
		}
	}

	if ($menu_style == 'horizontal') {
		echo '</tr>';
	}

	echo '</table>';
?>
<!-- Load TransMenu`s top level /-->

<!-- Load TransMenu`s sub level \-->
<script language="javascript" type="text/javascript">
	if (TransMenu.isSupported()) {
		self['<?php echo $transmenu_id; ?>'] = new TransMenuSet(TransMenu.direction.<?php echo $submenu_direction; ?>, <?php echo $left_offset; ?>, <?php echo $top_offset; ?>, TransMenu.reference.<?php echo $submenu_position; ?>);
<?php
	foreach ($top_level AS $item) {
		if (has_child($item->id, $menutype)) {
			echo "\n\t\t".'var '.$transmenu_id.'_menu'.$item->id.' = self[\''.$transmenu_id.'\'].addMenu(document.getElementById("'.$transmenu_id.'_menu'.$item->id.'"));';
			echo get_child_list_menu($item->id, $menutype, $menu_image, $hide_menu_name, $menu_image_width, $menu_image_height, $menu_image_margin, $menu_image_alignment, $transmenu_id)."\n";
		} else {
			echo "\n\t\t".'document.getElementById(\''.$transmenu_id.'_menu'.$item->id.'\').onmouseover = function() { self[\''.$transmenu_id.'\'].hideCurrent(); }';
		}
	}

	echo "\n";
?>
		TransMenu.renderAll();
	}
	if (window.addEventListener) {
		window.addEventListener('load', initTransMenu, false);
	} else if (window.attachEvent) {
		var tmev = window.attachEvent('onload', initTransMenu);
	} else {
		initTransMenu();
	}
</script>
<!-- Load TransMenu`s sub level /-->