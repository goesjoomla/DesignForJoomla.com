<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/php/d4jAjaxPagenav.php');

function ezineMosPaging( &$row, &$params, $page=0 ) {
	global $mainframe, $database;

 	// expression to search for
 	$regex = '/{(mospagebreak)\s*(.*?)}/i';

	// find all instances of mambot and put in $matches
	$matches = array();
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

	// split the text around the mambot
	$text = preg_split( $regex, $row->text );

	// count the number of pages
	$n = count( $text );

	// we have found at least one mambot, therefore at least 2 pages
	if ($n > 1) {
		// load mambot params info
		$query = "SELECT id"
		. "\n FROM #__mambots"
		. "\n WHERE element = 'mospaging'"
		. "\n AND folder = 'content'"
		;
		$database->setQuery( $query );
	 	$id 	= $database->loadResult();
	 	$mambot = new mosMambot( $database );
	  	$mambot->load( $id );
	 	$botParams = new mosParameters( $mambot->params );

	 	$title	= $botParams->def( 'title', 1 );

	 	// adds heading or title to <site> Title
	 	if ( $title ) {
			$page_text = $page + 1;
			$row->page_title = _PN_PAGE .' '. $page_text;
			if ( !$page ) {
				// processing for first page
				parse_str( str_replace( '&amp;', '&', $matches[0][2] ), $args );

				if ( @$args['heading'] ) {
					$row->page_title = $args['heading'];
				} else {
					$row->page_title = '';
				}
			} else if ( $matches[$page-1][2] ) {
				parse_str(  str_replace( '&amp;', '&', $matches[$page-1][2] ), $args );

				if ( @$args['title'] ) {
					$row->page_title = stripslashes( $args['title'] );
				}
			}
	 	}

		// reset the text, we already hold it in the $text array
		$row->text = '';

		$hasToc = $mainframe->getCfg( 'multipage_toc' );

		if ( $hasToc ) {
			// display TOC
			ezineMosPaging_createTOC( $row, $params, $matches, $page );
		} else {
			$row->toc = '';
		}

		// ajax page navigation
		$pageNav = new ajaxPageNav( $n, $page, 1 );

		// page counter
		$row->text .= '<div class="pagenavcounter">';
		$row->text .= $pageNav->writeLeafsCounter();
		$row->text .= '</div>';

		// page text
		$row->text .= $text[$page];

		$row->text .= '<div class="pagenavbar">';

		// adds navigation between pages to bottom of text
		if ( $hasToc ) {
			ezineMosPaging_createNavigation( $row, $params, $page, $n );
		}

		// page links shown at bottom of page if TOC disabled
		if (!$hasToc) {
			$link = getArticleLink($row->id, $params, '__LIMIT_START__');
			$row->text .= $pageNav->writeAjaxLinks( $link );
		}

		$row->text .= '</div>';
	}

	return true;
}

function ezineMosPaging_createTOC( &$row, &$params, &$matches, &$page ) {
	$link = getArticleLink($row->id, $params);

	$heading = $row->title;
	// allows customization of first page title by checking for `heading` attribute in first bot
	if ( @$matches[0][2] ) {
		parse_str( str_replace( '&amp;', '&', $matches[0][2] ), $args );

		if ( @$args['heading'] ) {
			$heading = $args['heading'];
			$row->title .= ': '. $heading;
		}
	}

	// TOC Header
	$row->toc = '
	<table cellpadding="0" cellspacing="0" class="contenttoc" align="right">
	<tr>
		<th>'
		. _TOC_JUMPTO .
		'</th>
	</tr>
	';

	// TOC First Page link
	$row->toc .= '
	<tr>
		<td>
		<a href="'. $link .'" class="toclink">'
		. $heading .
		'</a>
		</td>
	</tr>
	';

	$i = 2;
	$args2 = array();

	foreach ( $matches as $bot ) {
		$link = getArticleLink($row->id, $params, ($i-1));

		if ( @$bot[2] ) {
			parse_str( str_replace( '&amp;', '&', $bot[2] ), $args2 );

			if ( @$args2['title'] ) {
				$row->toc .= '
				<tr>
					<td>
					<a href="'. $link .'" class="toclink">'
					. stripslashes( $args2['title'] ) .
					'</a>
					</td>
				</tr>
				';
			} else {
				$row->toc .= '
				<tr>
					<td>
					<a href="'. $link .'" class="toclink">'
					. _PN_PAGE .' '. $i .
					'</a>
					</td>
				</tr>
				';
			}
		} else {
			$row->toc .= '
			<tr>
				<td>
				<a href="'. $link .'" class="toclink">'
				. _PN_PAGE .' '. $i .
				'</a>
				</td>
			</tr>
			';
		}
		$i++;
	}

	$row->toc .= '</table>';
}

function ezineMosPaging_createNavigation( &$row, &$params, $page, $n, $sef = 0 ) {
	if ( $page < $n-1 ) {
		$link_next = getArticleLink($row->id, $params, ($page + 1));
		$next = '<a href="'. $link_next .'">' ._CMN_NEXT . _CMN_NEXT_ARROW .'</a>';
	} else {
		$next = _CMN_NEXT;
	}

	if ( $page > 0 ) {
		$link_prev = getArticleLink($row->id, $params, ($page - 1));
		$prev = '<a href="'. $link_prev .'">'. _CMN_PREV_ARROW . _CMN_PREV .'</a>';
	} else {
		$prev = _CMN_PREV;
	}

	$row->text .= '<div>' . $prev . ' - ' . $next .'</div>';
}
?>