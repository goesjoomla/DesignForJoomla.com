<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// Extend mosPageNav class
require_once( str_replace('\\', '/', dirname(__FILE__)).'/../../../../includes/pageNavigation.php' );

// Define new Page Navigation class
class ajaxPageNav extends mosPageNav {
	// Rewrite writePagesLinks() function to build ajax friendly URL
	function writeAjaxLinks( $link ) {
		$txt = '';

		$displayed_pages = 10;
		$total_pages = ceil( $this->total / $this->limit );
		$this_page = ceil( ($this->limitstart+1) / $this->limit );
		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		// prepare for SEF URL
		$canSEF = false;
		if (!preg_match("/^javascript:/i", $link)) {
			$parts = explode('"', $link, 2);
			if (count($parts))
				$canSEF = true;
		}

		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			$txt .= '<a href="'. ($canSEF ? sefRelToAbs(str_replace('__LIMIT_START__', 0, $parts[0])).(isset($parts[1]) ? '"'.str_replace('__LIMIT_START__', 0, $parts[1]) : '') : str_replace('__LIMIT_START__', 0, $link)) .'" class="pagenav" title="first page">&lt;&lt; '. _PN_START .'</a> ';
			$txt .= '<a href="'. ($canSEF ? sefRelToAbs(str_replace('__LIMIT_START__', $page, $parts[0])).(isset($parts[1]) ? '"'.str_replace('__LIMIT_START__', $page, $parts[1]) : '') : str_replace('__LIMIT_START__', $page, $link)) .'" class="pagenav" title="previous page">&lt; '. _PN_PREVIOUS .'</a> ';
		} else {
			$txt .= '<span class="pagenav">&lt;&lt; '. _PN_START .'</span> ';
			$txt .= '<span class="pagenav">&lt; '. _PN_PREVIOUS .'</span> ';
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++) {
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page) {
				$txt .= '<span class="pagenav">'. $i .'</span> ';
			} else {
				$txt .= '<a href="'. ($canSEF ? sefRelToAbs(str_replace('__LIMIT_START__', $page, $parts[0])).(isset($parts[1]) ? '"'.str_replace('__LIMIT_START__', $page, $parts[1]) : '') : str_replace('__LIMIT_START__', $page, $link)) .'" class="pagenav"><strong>'. $i .'</strong></a> ';
			}
		}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$txt .= '<a href="'. ($canSEF ? sefRelToAbs(str_replace('__LIMIT_START__', $page, $parts[0])).(isset($parts[1]) ? '"'.str_replace('__LIMIT_START__', $page, $parts[1]) : '') : str_replace('__LIMIT_START__', $page, $link)) .' " class="pagenav" title="next page">'. _PN_NEXT .' &gt;</a> ';
			$txt .= '<a href="'. ($canSEF ? sefRelToAbs(str_replace('__LIMIT_START__', $end_page, $parts[0])).(isset($parts[1]) ? '"'.str_replace('__LIMIT_START__', $end_page, $parts[1]) : '') : str_replace('__LIMIT_START__', $end_page, $link)) .' " class="pagenav" title="end page">'. _PN_END .' &gt;&gt;</a>';
		} else {
			$txt .= '<span class="pagenav">'. _PN_NEXT .' &gt;</span> ';
			$txt .= '<span class="pagenav">'. _PN_END .' &gt;&gt;</span>';
		}

		return $txt;
	}
}
?>