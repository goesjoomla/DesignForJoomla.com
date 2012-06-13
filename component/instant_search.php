<?php

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$task = mosGetParam($_REQUEST, 'task', '');

if ($task != 'ajaxcall') {
	echo 'This component contains the core AJAX engine for D4J Instant Search module and cannot run stand-alone.';
} else {
	require_once($GLOBALS['mosConfig_absolute_path']."/components/com_instant_search/class/php/d4j_ajax_engine.php");
	$ajax_engine = new d4j_ajax_engine();
	$ajax_engine->return_data();
}

if (!function_exists('ampReplace')) {
	/**
	* Replaces &amp; with & for xhtml compliance
	*
	* Needed to handle unicode conflicts due to unicode conflicts
	*/
	function ampReplace( $text ) {
		$text = str_replace( '&#', '*-*', $text );
		$text = preg_replace( '|&(?![\w]+;)|', '&amp;', $text );
	    $text = str_replace( '&amp;amp;', '&amp;', $text );
		$text = str_replace( '*-*', '&#', $text );
		return $text;
	}
}

function doSearch( &$vars ) {
	$keyword = $vars['keyword'];
	$limitStart = $vars['limitStart'] ? $vars['limitStart'] : 0;
	$limit = $vars['limit'] ? $vars['limit'] : 5;
	$phrase = $vars['phrase'] ? $vars['phrase'] : 'any';
	$ordering = $vars['ordering'] ? $vars['ordering'] : 'newest';
	$min_chars = $vars['min_chars'] ? $vars['min_chars'] : 1;
	$max_chars = $vars['max_chars'] ? $vars['max_chars'] : 20;
	$result_length = $vars['result_length'] ? $vars['result_length'] : 200;
	$enable_sef = $vars['enable_sef'] ? $vars['enable_sef'] : 0;
	$result_nav = $vars['result_nav'];
	$search_order = $vars['search_order'];
	$return_xml = '';

	global $mainframe, $mosConfig_absolute_path, $mosConfig_lang, $my, $gid;
	global $database, $_MAMBOTS;
	global $ajax_engine;

	$searchword = $database->getEscaped( trim( $keyword ) );
	if ( strlen( $searchword ) < $min_chars )
		return false;
	elseif ( strlen( $searchword ) >= $max_chars ) {
		// limit searchword
		$searchword 	= substr( $searchword, 0, $max_chars - 1 );
	}
	$search_ignore = array();
	@include "$mosConfig_absolute_path/language/$mosConfig_lang.ignore.php";

	$ajax_engine->setAttribute('keyword', stripslashes($searchword));
	if ($searchword AND !in_array( $searchword, $search_ignore ) ) {
		$_MAMBOTS->loadBotGroup( 'search' );
		$results 	= $_MAMBOTS->trigger( 'onSearch', array( $searchword, $phrase, $ordering ) );
		$totalRows 	= 0;
		$rows = array();
		for ($i = 0, $n = count( $results); $i < $n; $i++) {
			$rows = array_merge( (array)$rows, (array)$results[$i] );
		}
		$totalRows = count( $rows );

		for ($i=0; $i < $totalRows; $i++) {
			$row = &$rows[$i]->text;
			if ($phrase == 'exact') {
				$searchwords = array($searchword);
				$needle = $searchword;
			} else {
				$searchwords = explode(' ', $searchword);
				$needle = $searchwords[0];
			}

			$row = mosPrepareSearchContent( $row, $result_length, $needle );

		  	foreach ($searchwords as $hlword) {
				$hlword = htmlspecialchars( stripslashes( $hlword ) );
				$row = eregi_replace( $hlword, '<span class="highlight">\0</span>', $row );
			}

			if (!eregi( '^http', $rows[$i]->href )) {
				// determines Itemid for Content items
				if ( strstr( $rows[$i]->href, 'view' ) ) {
					// tests to see if itemid has already been included - this occurs for typed content items
					if ( !strstr( $rows[$i]->href, 'Itemid' ) ) {
						$temp = explode( 'id=', $rows[$i]->href );
						@$rows[$i]->href = $rows[$i]->href. '&amp;Itemid='. $mainframe->getItemid($temp[1]);
					}
				}
			}
		}

		if ( $totalRows ) {
			$ajax_engine->setAttribute('found', $totalRows);
			// xml return
			$return_xml .= "\n";
			for ($i = $limitStart; ($i < ($limitStart + $limit)) AND ($i < $totalRows); $i++) {
				$return_xml .= '<result>' . "\n";
				$return_xml .= "\t" . '<url target="' . $rows[$i]->browsernav . '"><![CDATA[' . ($enable_sef ? sefRelToAbs(ampReplace($rows[$i]->href)) : ampReplace($rows[$i]->href)) . ']]></url>' . "\n";
				$return_xml .= "\t" . '<title><![CDATA[' . ampReplace($rows[$i]->title) . ']]></title>' . "\n";
				$return_xml .= "\t" . '<section><![CDATA[' . $rows[$i]->section . ']]></section>' . "\n";
				$return_xml .= "\t" . '<text><![CDATA[' . ampReplace($rows[$i]->text) . ']]></text>' . "\n";
				$return_xml .= "\t" . '<created><![CDATA[' . ($rows[$i]->created ? mosFormatDate($rows[$i]->created, _DATE_FORMAT_LC) : '-') . ']]></created>' . "\n";
				$return_xml .= '</result>' . "\n";
			}

			if ($result_nav) {
				// write page navigation
				if ($limit < $totalRows) {
					$pageNav = new ajaxPageNav( $totalRows, $limitStart, $limit );
					$link = 'javascript: void(0);" onclick="limitStart = %LIMITSTART%; call_dosearch(document.instantSearchForm.searchword.value);';
					$return_xml .= '<pagenav><![CDATA[' . $pageNav->writeAjaxLinks( $link ) . ']]></pagenav>';
				} else {
					$return_xml .= '<pagenav>-</pagenav>';
				}
			}
			$return_xml .= "\n";
		} else {
			$ajax_engine->setAttribute('found', 0);
		}
	} else {
		$ajax_engine->setAttribute('found', 0);
	}
	$ajax_engine->setAttribute('search_order', $search_order);
	return $return_xml;
}
?>