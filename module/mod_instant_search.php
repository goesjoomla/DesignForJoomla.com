<?php
/**
* Instant Search module v1.4
*
* @copyright Nguyen Manh Cuong
*       Author`s email   : cuongnm@designforjoomla.com
*       Author`s hompage : http://designforjoomla.com
*
* @license Commercial Product - Single Site License  or  Free to Use with Limitation
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path, $mosConfig_live_site;
if (!file_exists($mosConfig_absolute_path."/components/com_instant_search/instant_search.php")) {
	echo 'D4J Instant Search module require D4J Instant Search component to run properly. Please install D4J Instant Search component first.';
	return;
}

// module setting
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );
// connection setting
$persistent = intval( $params->get( 'persistent', 0 ) );
// option settings
$show_option	= intval( $params->get( 'show_option', 0 ) );
$option_display	= $params->get( 'option_display', 'vertical' );
$option_pos		= $params->get( 'option_pos', 'form_top' );
$auto_refresh	= intval( $params->get( 'auto_refresh', 1 ) );
// search box settings
$width 			= intval( $params->get( 'width', 20 ) );
$text 			= $params->get( 'text', _SEARCH_BOX );
$button			= intval( $params->get( 'button', 0 ) );
$button_pos		= $params->get( 'button_pos', 'left' );
$button_text	= $params->get( 'button_text', _SEARCH_TITLE );
$showhideresult	= intval( $params->get( 'showhideresult', 1 ) );
$showhideresult_text	= $params->get( 'showhideresult_text', 'Show/Hide Result' );
// search settings
$delay_time		= intval( $params->get( 'delay_time', 300 ) );
$chars_needed	= intval( $params->get( 'chars_needed', 1 ) );
$keyword_length	= intval( $params->get( 'keyword_length', 20 ) );
$search_type	= $params->get( 'search_type', 'any' );
$ordering		= $params->get( 'ordering', 'newest' );
$result_length	= intval( $params->get( 'result_length', 200 ) );
$total_result	= intval( $params->get( 'total_result', 10 ) );
$enable_sef		= intval( $params->get( 'enable_sef', 0 ) );
$display_type	= $params->get( 'display_type', 'table' );
$final_result	= intval( $params->get( 'final_result', 0 ) );
$result_navigation	= intval( $params->get( 'result_navigation', 1 ) );
// result box settings
$result_bgcolor	= $params->get( 'result_bgcolor', '' );
$result_width	= intval( $params->get( 'result_width', 500 ) );
$result_height	= intval( $params->get( 'result_height', 300 ) );
$padding_to		= $params->get( 'padding_to', 'right' );
$padding_width	= intval( $params->get( 'padding_width', 0 ) );
// searching settings
$loading_status	= intval( $params->get( 'loading_status', 0 ) );
$loading_text	= $params->get( 'loading_text', 'Searching... Please wait...' );

require_once("$mosConfig_absolute_path/components/com_instant_search/class/php/d4j_display_engine.php");
require_once("$mosConfig_absolute_path/components/com_instant_search/class/d4jCSS.php");
require_once("$mosConfig_absolute_path/components/com_instant_search/class/d4jJS.php");
?>

<!-- Initiate AJAX engine for instant search form \-->
<div id="instant_search_node" style="display:none"></div>
<script type="text/javascript">
// Path to ajax backend script
var instant_search_backend_script = mosConfig_live_site+'/index2.php?option=com_instant_search&task=ajaxcall&no_html=1';
// connection setting
var persistent = <?php echo $persistent ? 'true' : 'false'; ?>;
// option settings
var show_option = <?php echo $show_option ? 'true' : 'false'; ?>;
var option_display = '<?php echo $option_display; ?>';
var option_pos = '<?php echo $option_pos; ?>';
var auto_refresh = <?php echo $auto_refresh ? 'true' : 'false'; ?>;
// search box settings
var text = '<?php echo $text; ?>';
var showhideresult = <?php echo $showhideresult ? 'true' : 'false'; ?>;
// search settings
var delay_time = <?php echo $delay_time; ?>;
var min_chars = <?php echo $chars_needed; ?>;
var max_chars = <?php echo $keyword_length; ?>;
var phrase = '<?php echo $search_type; ?>';
var ordering = '<?php echo $ordering; ?>';
var result_length = <?php echo $result_length; ?>;
var limit = <?php echo $total_result; ?>;
var enable_sef = <?php echo $enable_sef; ?>;
var display = '<?php echo $display_type; ?>';
var final_result = <?php echo $final_result ? 'true' : 'false'; ?>;
var result_nav = <?php echo $result_navigation; ?>;
var limitStart = 0;
// result box settings
var result_bgcolor = '<?php echo $result_bgcolor; ?>';
var result_width = <?php echo $result_width; ?>;
var result_height = <?php echo $result_height; ?>;
var padding_to = '<?php echo $padding_to; ?>';
var padding_width = <?php echo $padding_width; ?>;
// searching settings
var loading_status = <?php echo $loading_status; ?>;
var loading_text = '<?php echo $loading_text; ?>';
// language settings
var _PROMPT_KEYWORD = '<?php echo _PROMPT_KEYWORD; ?>';
var _SEARCH_MATCHES = '<?php echo _SEARCH_MATCHES; ?>';
// current search #
var search_order = 0;
var display_order_id = 0;
</script>
<script type="text/javascript" src="<?php echo "$mosConfig_live_site/components/com_instant_search/instant_search.compact.js"; ?>"></script>
<!-- Initiate AJAX engine for instant search form /-->

<?php
$search_field = '<input alt="search" class="inputbox'. $moduleclass_sfx .'" type="text" name="searchword" size="'. $width .'" value="'. $text .'"  onblur="if(this.value==\'\') this.value=\''. $text .'\';" onfocus="if(this.value==\''. $text .'\') this.value=\'\';" onkeyup="if (this.value.length < max_chars) { prepareSearch(this.value); } else { this.value = this.value.substring(0, max_chars - 1); }" />';

if ( $button ) {
	$search_button = '<input type="submit" value="'. $button_text .'" class="button'. $moduleclass_sfx .'"/>';
} else {
	$search_button = '';
}

switch ( $button_pos ) {
	case 'top':
		$search_button = $search_button .'<br/>';
		$search_field = $search_button . $search_field;
		break;

	case 'bottom':
		$search_button =  '<br/>'. $search_button;
		$search_field = $search_field . $search_button;
		break;

	case 'right':
		$search_field = $search_field . $search_button;
		break;

	case 'left':
	default:
		$search_field = $search_button . $search_field;
		break;
}

if ($show_option AND ($option_pos == 'form_top' OR $option_pos == 'form_bottom' OR $option_pos == 'form_left' OR $option_pos == 'form_right')) {
	if ($option_display == 'vertical') {
		$option_fields = '
		<table border="0" cellspacing="1" cellpadding="1" width="100%"><tr class="sectiontableentry1"><td>Search Phrase:</td></tr>
		<tr class="sectiontableentry2"><td>
		<input'.($auto_refresh ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').' name="searchphrase" value="any" type="radio"'.($search_type == 'any' ? ' checked="checked"' : '').'>Any words<br/>
		<input'.($auto_refresh ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').' name="searchphrase" value="all" type="radio"'.($search_type == 'all' ? ' checked="checked"' : '').'>All words<br/>
		<input'.($auto_refresh ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').' name="searchphrase" value="exact" type="radio"'.($search_type == 'exact' ? ' checked="checked"' : '').'>Exact phrase
		</td></tr><tr class="sectiontableentry1"><td>Result Ordering:</td></tr>
		<tr class="sectiontableentry2"><td>
		<select name="ordering" class="inputbox"'.($auto_refresh ? ' onchange="if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').'>
			<option value="newest"'.($ordering == 'newest' ? ' selected="selected"' : '').'>Newest first</option>
			<option value="oldest"'.($ordering == 'oldest' ? ' selected="selected"' : '').'>Oldest first</option>
			<option value="popular"'.($ordering == 'popular' ? ' selected="selected"' : '').'>Most popular</option>
			<option value="alpha"'.($ordering == 'alpha' ? ' selected="selected"' : '').'>Alphabetical</option>
			<option value="category"'.($ordering == 'category' ? ' selected="selected"' : '').'>Section/Category</option>
		</select>
		</td></tr></table>
		';
	} else { // display options horizontally
		$option_fields = '
		<table border="0" cellspacing="1" cellpadding="1"><tr><td class="sectiontableentry1">Search Phrase:&nbsp;</td>
		<td class="sectiontableentry2">
		<input'.($auto_refresh ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').' name="searchphrase" value="any" type="radio"'.($search_type == 'any' ? ' checked="checked"' : '').'>Any words&nbsp;
		<input'.($auto_refresh ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').' name="searchphrase" value="all" type="radio"'.($search_type == 'all' ? ' checked="checked"' : '').'>All words&nbsp;
		<input'.($auto_refresh ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').' name="searchphrase" value="exact" type="radio"'.($search_type == 'exact' ? ' checked="checked"' : '').'>Exact phrase
		</td><td class="sectiontableentry1">Result Ordering:&nbsp;</td>
		<td class="sectiontableentry2">
		<select name="ordering" class="inputbox"'.($auto_refresh ? ' onchange="if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \''.$text.'\' && document.instantSearchForm.searchword.value.length >= '.$chars_needed.') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '').'>
			<option value="newest"'.($ordering == 'newest' ? ' selected="selected"' : '').'>Newest first</option>
			<option value="oldest"'.($ordering == 'oldest' ? ' selected="selected"' : '').'>Oldest first</option>
			<option value="popular"'.($ordering == 'popular' ? ' selected="selected"' : '').'>Most popular</option>
			<option value="alpha"'.($ordering == 'alpha' ? ' selected="selected"' : '').'>Alphabetical</option>
			<option value="category"'.($ordering == 'category' ? ' selected="selected"' : '').'>Section/Category</option>
		</select>
		</td></tr></table>
		';
	}
	switch ($option_pos) {
		case 'form_bottom':
			$search_field = '<table border="0" cellspacing="0" cellpadding="0"><tr class="sectiontableentry2"><td>'.$search_field.'</td></tr><tr><td>'.$option_fields.'</td></tr></table>';
			break;
		case 'form_left':
			$search_field = '<table border="0" cellspacing="0" cellpadding="0"><tr><td>'.$option_fields.'</td><td class="sectiontableentry1">'.$search_field.'</td></tr></table>';
			break;
		case 'form_right':
			$search_field = '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="sectiontableentry2">'.$search_field.'</td><td>'.$option_fields.'</td></tr></table>';
			break;
		case 'form_top':
		default:
			$search_field = '<table border="0" cellspacing="0" cellpadding="0"><tr><td>'.$option_fields.'</td></tr><tr class="sectiontableentry1"><td>'.$search_field.'</td></tr></table>';
			break;
	}
}
if ($showhideresult) {
	$search_field .= '
<div id="showhideresult" style="display:none; width:100%; text-align:center">
<a href="javascript:void(0)" onclick="if (document.getElementById(\'instant_search_form\').style.display == \'block\') document.getElementById(\'instant_search_form\').style.display = \'none\'; else document.getElementById(\'instant_search_form\').style.display = \'block\';" class="small">'.$showhideresult_text.'</a>
</div>
	';
}
?>

<form action="<?php echo sefRelToAbs("index.php"); ?>" method="post" name="instantSearchForm">
<div class="search<?php echo $moduleclass_sfx; ?>">
<?php echo $search_field; writePopupCode( 'instant_search' ); ?>
</div>
<input type="hidden" name="option" value="search" />
</form>
