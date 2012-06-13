<?php
/**
* eZine component :: main and server-side ajax functions
**/

/** ensure this file is being included by a parent file */
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

// define product information
define( '_D4J_PRODUCT_NAME'				, 'D4J eZine' );
define( '_D4J_PRODUCT_FRONTEND_PATH'	, str_replace('\\', '/', dirname(__FILE__)) );
define( '_D4J_PRODUCT_BACKEND_PATH'		, _D4J_PRODUCT_FRONTEND_PATH."/../../administrator/components/$option" );
define( '_D4J_PRODUCT_LICENSE_KEY'		, _D4J_PRODUCT_BACKEND_PATH.'/license_key.php' );
define( '_D4J_PRODUCT_LOCAL_KEY'		, _D4J_PRODUCT_BACKEND_PATH.'/local_key.php' );

/* check for valid license ***************************************************\/
if ($task != 'ajax_call') {
	// licensing servers
	$servers	= array();
	$servers[]	= 'http://designforjoomla.com/client/'; // main server

	// licensing type?
	if (file_exists(_D4J_PRODUCT_LICENSE_KEY)) {
		require_once(_D4J_PRODUCT_LICENSE_KEY);
		list($lic_prefix, $lic_key) = explode('-', $license, 2);
		if ($lic_prefix == 'ezServer') {
			// server license
			$per_server		= true;
			$per_install	= false;
			$per_site		= false;
		} else {
			// site license
			$per_server		= false;
			$per_install	= false;
			$per_site		= true;
		}
		$enable_dns_spoof	= 'no';
		$token				= make_token();
	}

	// check local key first then license key if local key is either missing or invalid
	$array['per_server']	= $per_server;
	$array['per_install']	= $per_install;
	$array['per_site']		= $per_site;
	$skip_dns_spoof			= true;
	$returned = validate_license_data(validate_local_key($array));

	if ($returned['status'] == 'invalid_key') {
		// the local key is either missing or invalid, check if license key exists
		if (!file_exists(_D4J_PRODUCT_LICENSE_KEY)) {
			die('<p style="text-align:left">Please login to your Joomla! administration panel and activate your installation of D4J eZine Joomla! news portal extension first.<br/><br/>Thank you for choosing our product!<br/><br/>--<br/>The DesignForJoomla.com team</p>');
		}

		// checking for valid license key
		$query_string = "license=$license";
		switch ($lic_prefix) {
			case 'ezTrial'	: $pid = 3; break;
			case 'ezFull'	: $pid = 2; break;
			case 'ezOwn'	: $pid = 1; break;
			case 'ezServer'	: $pid = 13; break;
			default			: $pid = 0; break;
		}
		if ($pid == 0) {
			die('Invalid License Key');
		}
		$query_string .= "&product_id=$pid";

		if ($per_server) {
			$server_array = phpaudit_get_mac_address();
			$query_string .= '&access_host='.@gethostbyaddr(@gethostbyname($server_array[1]));
			$query_string .= '&access_mac='.$server_array[0];
		} elseif ($per_install) {
			$query_string .= '&access_directory='.path_translated();
			$query_string .= '&access_ip='.server_addr();
			$query_string .= '&access_host='.$_SERVER['HTTP_HOST'];
		} elseif ($per_site) {
			$query_string .= '&access_ip='.server_addr();
			$query_string .= '&access_host='.$_SERVER['HTTP_HOST'];
		}

		$query_string .= '&access_token=';
		$query_string .= $token;

		foreach ($servers as $server) {
			$sinfo	= @parse_url($server);
			$data	= phpaudit_exec_socket($sinfo['host'], $sinfo['path'], '/validate_internal.php', $query_string);
			if ($data) break;
		}

		if (!$data) {
			// either user is cheating or the internet connection of user's server is disconnected
			$mosSystemError = 'D4J eZine Temporary Error';
			require_once(_D4J_PRODUCT_FRONTEND_PATH.'/../../offline.php');
		} else {
			$skip_dns_spoof	= false;
			$returned		= validate_license_data($data);

			if ($returned['status'] == 'invalid')
				die('Invalid License Key');
			elseif ($returned['status'] == 'suspended')
				die('License Key Has Been Suspended');
			elseif ($returned['status'] == 'expired')
				die('License Key Has Been Expired');
			elseif ($returned['status'] == 'pending')
				die('License Key Has Not Been Activated');
		}

		// checking to see if local key file exists
		if (file_exists(_D4J_PRODUCT_LOCAL_KEY))
			unlink(_D4J_PRODUCT_LOCAL_KEY);

		// get local key content
		$RPC		= 'http://designforjoomla.com/phpaudit/rpc.php';
		$api_key	= 'c0754300081f7af5d07eca131cb6c368';
		$local_key	= grab_local_key($RPC, $api_key, $license);

		// create local key file
		$fp = @fopen(_D4J_PRODUCT_LOCAL_KEY, 'w');
		@fputs($fp, $local_key, strlen($local_key));
		@fclose($fp);

		// unset parameters
		unset($query_string);
		unset($server);
		unset($sinfo);
		unset($data);
		unset($RPC);
		unset($api_key);
		unset($local_key);
	}

	// unset parameters
	unset($servers);
	unset($per_server);
	unset($per_install);
	unset($per_site);
	unset($enable_dns_spoof);
	unset($skip_dns_spoof);
	unset($token);
	unset($array);
}
\/*********************************************** end check for valid license */

// no duplication
$loadedArticle = array();

$return_html = '';

// require frontend html class
require_once($html_path);

// if not an ajax call, require display engine
if ($task != 'ajax_call')
	require_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/php/d4jDisplayEngine.php');

// require language file
if (file_exists('language/'.$mosConfig_lang.'.php') AND file_exists('components/'.$option.'/language/'.$mosConfig_lang.'.php'))
	require_once('components/'.$option.'/language/'.$mosConfig_lang.'.php');
else
	require_once('components/'.$option.'/language/english.php');

// initiate some required variables
$now	= defined(_CURRENT_SERVER_TIME) ? _CURRENT_SERVER_TIME : date('Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60);
$noauth	= !$mainframe->getCfg('shownoauth');

// Editor usertype check
$access = new stdClass();
$access->canEdit	= $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'all');
$access->canEditOwn	= $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'own');
$access->canPublish	= $acl->acl_check('action', 'publish', 'users', $my->usertype, 'content', 'all');

// Menu Parameters
$Itemid = intval(mosGetParam( $_REQUEST, 'Itemid', '' ));
if ($Itemid) {
	$menu = new mosMenu($database);
	$menu->load($Itemid);
	$params = new mosParameters($menu->params);
} else {
	$menu = '';
	$params = new mosParameters('');
}
$pageid = intval($params->get('page_id', mosGetParam($_REQUEST, 'page', 0)));
$params->def('pageclass_sfx', '');
$params->def('back_button', 0);

$params->def('article_title', 1);
$params->def('article_title_linkable', 1);
$params->def('category_title', 0);
$params->def('category_title_linkable', 0);
$params->def('section_title', 0);
$params->def('section_title_linkable', 0);

$params->def('readmore', 1);
$params->def('rating', 0);
$params->def('author', 1);
$params->def('createdate', 1);
$params->def('modifydate', 0);

$params->def('pdf', 1);
$params->def('print', 1);
$params->def('email', 1);
$params->def('icons', 1);

// Dynamic Page Title
if ($menu) {
	$mainframe->setPageTitle($menu->name);
}

// eZine Global Settings
$database->setQuery("SELECT * FROM #__ezine_config WHERE `name` NOT LIKE 'sef_%'");
$settings = $database->loadObjectList();
for ($i = 0, $n = count($settings); $i < $n; $i++) {
	$params->set($settings[$i]->name, $settings[$i]->value);
}
$params->def('category_open_ajax_enable', 0);
$params->def('content_open_ajax_enable', 0);
$params->def('ajax_sef_url_enable', 1);

$params->def('hide_first_mosimage', 0);
$params->def('create_real_thumb', 1);
$params->def('thumb_directory', 'images/thumbnails');
$params->def('image_library', 'gd2');
$params->def('image_library_path', '');

$params->def('thumbnail_image_link', 1);
$params->def('thumbnail_process_menthod', 2);
$params->def('thumbnail_keep_ratio', 0);
$params->def('featured_image_left_width', 128);
$params->def('featured_image_left_height', 96);
$params->def('featured_image_right_width', 128);
$params->def('featured_image_right_height', 96);
$params->def('featured_image_top_width', 468);
$params->def('featured_image_top_height', 60);
$params->def('featured_image_bottom_width', 468);
$params->def('featured_image_bottom_height', 60);
$params->def('thumbnail_image_left_width', 128);
$params->def('thumbnail_image_left_height', 96);
$params->def('thumbnail_image_right_width', 128);
$params->def('thumbnail_image_right_height', 96);
$params->def('thumbnail_image_top_width', 468);
$params->def('thumbnail_image_top_height', 60);
$params->def('thumbnail_image_bottom_width', 468);
$params->def('thumbnail_image_bottom_height', 60);

$params->def('link_image_type', 1);
$params->def('link_image_process_menthod', 2);
$params->def('link_image_keep_ratio', 0);
$params->def('link_image_width', 50);
$params->def('link_image_height', 50);
$params->def('link_image_default', '');

$params->def('content_image_processor', 0);
$params->def('margin', 5);
$params->def('padding', 3);
$params->def('process_menthod', 0);
$params->def('keep_ratio', 3);
$params->def('img_width', 150);
$params->def('img_height', 112);
$params->def('enable_enlarge', 1);
$params->def('enable_enlarge_text', 0);
$params->def('enlarge_text', 'Click to see real size');
$params->def('enlarge_text_position', 'below');
$params->def('enlarge_text_css', 'readon');
$params->def('max_popup_width', 640);
$params->def('max_popup_height', 480);
$params->def('show_print_link', 1);
$params->def('print_text', 'Print');
$params->def('show_close_link', 1);
$params->def('close_text', 'Close');
$params->def('print_close_css', 'readon');

$params->def('article_inherit_itemid', 1);
$params->def('article_icon_position', 'topright');
$params->def('article_top_icon_arrangement', 'horizontal');
$params->def('article_bottom_icon_arrangement', 'horizontal');
$params->def('article_top_icon_display', 'icon');
$params->def('article_bottom_icon_display', 'both');
$params->def('article_pdf_icon_text', 'Create PDF document');
$params->def('article_print_icon_text', 'Printer-friendly version');
$params->def('article_email_icon_text', 'Tell you friend this article');

$params->def('subscribe_title', 'Newsletter Subscribe/Unsubscribe Form');
$params->def('pre_text', 'Newsletter(s) you have subscribed to has/have check box checked');
$params->def('post_text', '');
$params->def('list_page', 1);
$params->def('newsletter_page', '');

// if not an ajax call, include css stylesheets
if ($task != 'ajax_call') {
	$lib_header = '
<link rel="stylesheet" type="text/css" media="all" href="'.$mosConfig_live_site.'/components/'.$option.'/css/ezine.css" />
';
	$mainframe->addCustomHeadTag($lib_header);

	// Check if frontend ajax is enable or not?
	if ($params->get('category_open_ajax_enable') OR $params->get('content_open_ajax_enable') OR $task == 'newsletter_subscribe') {
		include_required();
	}
}


/* Main functions */

// function to include required files
function include_required() {
	global $option, $mainframe, $mosConfig_live_site, $return_html;

	include_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/d4jCSS.php');
	include_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/d4jJS.php');

	$mainframe->addCustomHeadTag( '
<script type="text/javascript" src="'.$mosConfig_live_site.'/components/'.$option.'/class/js/dhtmlHistory.compact.js"></script>
<script language="JavaScript">
	function initialize() {
		// initialize RSH
		dhtmlHistory.initialize();

		// add ourselves as a listener for history
		// change events
		dhtmlHistory.addListener(handleHistoryChange);

		// determine our current location so we can
		// initialize ourselves at startup
		var initialLocation = dhtmlHistory.getCurrentLocation();

		// now initialize our starting UI
		if (initialLocation) updateUI(initialLocation, null);
	}

	/* A function that is called whenever the user
	presses the back or forward buttons. This
	function will be passed the newLocation,
	as well as any history data we associated
	with the location. */
	function handleHistoryChange(newLocation, historyData) {
		// use the history data to update our UI
		if (newLocation) updateUI(newLocation, historyData); else window.location.reload();
	}

	// A simple method that updates our user interface using the new location
	function updateUI(newLocation, historyData) {
		var args = newLocation.split(\',\');
		if (args[0] == \'article\') {
			if (args.length == 6) {
				call_showContent(args[1], args[2], args[3], args[4], args[5], true);
			} else {
				call_showContent(args[1], args[2], args[3], args[4], null, true);
			}
		} else if (args[0] == \'category\') {
			call_showCategory(args[1], args[2], args[3], args[4], true);
		}
	}

	// RSH must be initialized after the page is finished loading
	if (addEvent(window, "load", initialize) == false) initialize();
</script>
<script type="text/javascript" src="'.$mosConfig_live_site.'/components/'.$option.'/ezine.ajax.compact.js"></script>
' );
}

// function to output html for newsletter subscribe page
function newsletterSubsribe(&$params) {
	global $option, $database, $mainframe, $my, $return_html;
	$uid = intval(mosGetParam($_GET, 'uid', ''));
	$email = mosGetParam( $_GET, 'email', null );

	$subscribe_title	= $params->get('subscribe_title');
	$pre_text			= $params->get('pre_text');
	$post_text			= $params->get('post_text');
	$list_page			= $params->get('list_page');
	$newsletter_page	= $params->get('newsletter_page');

	if ($uid) {
		$database->setQuery("SELECT subcribed_pages FROM #__ezine_newsletter_users WHERE uid = '$uid' LIMIT 0,1");
		$subcribed_pages = explode(',', $database->loadResult());
	} elseif ($email) {
		$database->setQuery("SELECT name, subcribed_pages FROM #__ezine_newsletter_users WHERE email = '$email' LIMIT 0,1");
		$database->loadObject($user);
		$subcribed_pages = explode(',', $user->subcribed_pages);
	} elseif ($my->id) {
		$database->setQuery("SELECT subcribed_pages FROM #__ezine_newsletter_users WHERE uid = '".$my->id."' LIMIT 0,1");
		$subcribed_pages = explode(',', $database->loadResult());
	} else {
		$subcribed_pages = array();
	}

	$k = 0;
	// get list of published eZine pages
	if ($list_page) {
		$database->setQuery("SELECT id AS value, menu_name, page_title FROM #__ezine_page ORDER BY id");
		if ($pages = $database->loadObjectList()) {
			$lists['pages'] = '';
			$row = 0;
			foreach ($pages AS $page) {
				$lists['pages'] .= '<tr class="sectiontableentry'.($k + 1).'"><td width="10%" style="text-align:center">'.str_replace('onclick="isChecked(this.checked);"', (in_array($page->value, $subcribed_pages) ? 'checked=checked' : ''), mosHTML::idBox($row, $page->value, false, 'pages')).'</td>';
				$lists['pages'] .= '<td width="20%">&nbsp;'.stripslashes($page->menu_name).'</td>';
				$lists['pages'] .= '<td width="70%">&nbsp;'.stripslashes($page->page_title).'</td></tr>';
				$row++;
				$k = 1 - $k;
			}
		}
	} else {
		$pages = explode(', ', $newsletter_page);
		$row = 0;
		$lists['pages'] = '<div style="display:none">';
		foreach ($pages AS $page) {
			$lists['pages'] .= str_replace('onclick="isChecked(this.checked);"', 'checked="checked"', mosHTML::idBox($row, $page, false, 'pages'));
			$row++;
		}
		$lists['pages'] .= '</div>';
	}

	$lib_header = '
<script type="text/javascript">
var _SELECT_PAGE_TO_SUBSCRIBE_TO = \''._SELECT_PAGE_TO_SUBSCRIBE_TO.'\';
var _SELECT_PAGE_TO_UNSUBSCRIBE_FROM = \''._SELECT_PAGE_TO_UNSUBSCRIBE_FROM.'\';
var _FORGOT_INPUT_EMAIL_ADDRESS = \''._FORGOT_INPUT_EMAIL_ADDRESS.'\';
var _SUBSCRIBE_SUCCESS = \''._SUBSCRIBE_SUCCESS.'\';
var _SUBSCRIBE_FAIL = \''._SUBSCRIBE_FAIL.'\';
var _UNSUBSCRIBE_SUCCESS = \''._UNSUBSCRIBE_SUCCESS.'\';
var _UNSUBSCRIBE_FAIL = \''._UNSUBSCRIBE_FAIL.'\';
</script>
';
	$mainframe->addCustomHeadTag($lib_header);

	$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - Begin -->";

	$return_html .= '
<div class="page_title'.$params->get('pageclass_sfx').'">'.$subscribe_title.'</div>

<form name="'.$option.'_newsletter" method="post">
	<table border="0" cellspacing="1" cellpadding="1" width="100%">
	<tr><td'.($list_page ? ' colspan="3"' : ' colspan="2"').'>
		'.$pre_text.'
	</td></tr>
	'.($list_page ? $lists['pages'] : '').'
	'.((!$my->id AND !$uid) ? '
	<tr class="sectiontableentry'.($k + 1).'"><td>
		Name:
	</td><td'.($list_page ? ' colspan="2"' : ' width="85%"').'>
		<input type="text" class="inputbox" name="name" value="'.($email ? $user->name : '').'" style="width:99%" />
	</td></tr><tr class="sectiontableentry'.($k + 1).'"><td>
		Email:
	</td><td'.($list_page ? ' colspan="2"' : ' width="85%"').'>
		<input type="text" class="inputbox" name="email" value="'.($email ? $email : '').'" style="width:99%" />
	</td></tr>
	' : '').'
	<tr><td'.($list_page ? ' colspan="3"' : ' colspan="2"').'>
		'.$post_text.'
	</td></tr>
	<tr><td'.($list_page ? ' colspan="3"' : ' colspan="2"').' align="center">
		'.(!$list_page ? $lists['pages'] : '').'<br/>
		<input type="button" onclick="call_newsletter_subscribe()" class="button" name="subscribe_button" value="'._SUBSCRIBE_BUTTON.'" />
		&nbsp;
		<input type="button" onclick="call_newsletter_unsubscribe()" class="button" name="unsubscribe_button" value="'._UNSUBSCRIBE_BUTTON.'" />
		<input type="hidden" name="checkbox" value="'.count($pages).'" />
		'.(($my->id OR $uid) ? '
		<input type="hidden" name="uid" value="'.($uid ? $uid : $my->id).'" />
		' : '').'
	</td></tr>
	</table>
</form>
';

	back_button($params);

	$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - End -->\n";
}

// function to show cover page
function showCover($pageid, &$params) {
	global $option, $database, $Itemid, $mosConfig_live_site, $return_html;

	// link to eZine page
	$link = sefRelToAbs("index.php?option=$option&task=index&Itemid=$Itemid");

	$database->setQuery("SELECT `page_title`,`params` FROM #__ezine_page WHERE id = '$pageid' AND published = '1' LIMIT 0, 1");
	if ( $page = $database->loadObjectList() ) {
		$page_title = stripslashes($page[0]->page_title);
		$page_params = new mosParameters($page[0]->params);
		$params->set('cover_auto_redirect', $page_params->get('cover_auto_redirect', 0));
		$params->set('cover_image', $page_params->get('cover_image', ''));
		$params->set('cover_html', $page_params->get('cover_html', ''));

		// page found, show cover
		$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - Begin -->";
		if ($params->get('cover_auto_redirect')) {
			$return_html .= '<script>function redirect() { window.location.href = "'.$link.'"; } setTimeout("redirect()", '.($params->get('cover_auto_redirect') * 1000).');</script>';
		}
		if ($params->get('cover_image')) {
			$return_html .= '<center><img src="'.$mosConfig_live_site.'/'.$params->get('cover_image').'" border="0" align="absmiddle" alt="'.$page_title.'" /></center>';
		} else {
			$return_html .= str_replace('-newline-', "\n", $params->get('cover_html'));
		}
		$return_html .= '<p align="center"><a href="'.$link.'" title="'.str_replace('%CAT_NAME%', $page_title, _CLICK_TO_VIEW_NEWS_PAGE).'">'.str_replace('%CAT_NAME%', $page_title, _CLICK_TO_VIEW_NEWS_PAGE).'</a></p>';
		$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - End -->\n";
	} else {
		$return_html .= "\n"._PAGE_NOT_FOUND;
	}
}

// function to output html for eZine page
function showPage($pageid, &$params) {
	global $option, $task, $database, $Itemid, $mosConfig_live_site, $return_html;

	$database->setQuery("SELECT * FROM #__ezine_page WHERE id = '$pageid' AND published = '1' LIMIT 0, 1");
	if ($page = $database->loadObjectList()) {
		// Page Parameters
		$page_params = new mosParameters($page[0]->params);
		$params->set('show_page_title', $page_params->get('show_page_title', 1));
		$params->set('subscribe_link', $page_params->get('subscribe_link', 0));

		$params->set('featured_article', $page_params->get('featured_article', 1));
		$params->set('show_featured_title', $page_params->get('show_featured_title', 1));
		$params->set('featured_title_text', $page_params->get('featured_title_text', 'Featured Article'));
		$params->set('limit_featured_to_sec', $page_params->get('limit_featured_to_sec', ''));
		$params->set('limit_featured_to_cat', $page_params->get('limit_featured_to_cat', ''));
		$params->set('words_count', $page_params->get('featured_words_count', 0));
		$params->set('featured_leading', $page_params->get('featured_leading', 1));
		$params->set('leading_thumbnail_position', $page_params->get('featured_leading_thumb_pos', ''));
		$params->set('featured_intro', $page_params->get('featured_intro', 0));
		$params->set('featured_intro_cols', $page_params->get('featured_intro_cols', 0));
		$params->set('intro_thumbnail_position', $page_params->get('featured_intro_thumb_pos', ''));
		$params->set('featured_order_by', $page_params->get('featured_order_by', 'rdate'));

		$params->set('block1', $page_params->get('block1', 1));
		$params->set('block1_cols', $page_params->get('block1_cols', 1));
		$params->set('block2', $page_params->get('block2', 2));
		$params->set('block2_cols', $page_params->get('block2_cols', 1));
		$params->set('block3', $page_params->get('block3', 5));
		$params->set('block3_cols', $page_params->get('block3_cols', 1));

		$params->set('cover_enable', $page_params->get('cover_enable', 0));
		$params->set('cover_output', $page_params->get('cover_output', 'joomla'));

		// if cover set and not loaded load the cover, otherwise clear the cookie
		if ($params->get('cover_enable') AND $task == '') {
			if ($params->get('cover_output') == 'alone')
				mosRedirect( "$mosConfig_live_site/index2.php?option=$option&task=cover&Itemid=$Itemid" );
			else
				mosRedirect( sefRelToAbs("index.php?option=$option&task=cover&Itemid=$Itemid") );
		}

		// blocks count and columns
		$block1_cats = $params->get('block1');
		$block1_cols = $params->get('block1_cols');
		if ($block1_cols == 0) {
			$block1_cols = 1;
		}
		$block2_cats = $params->get('block2');
		$block2_cols = $params->get('block2_cols');
		if ($block2_cols == 0) {
			$block2_cols = 1;
		}
		$block3_cats = $params->get('block3');
		$block3_cols = $params->get('block3_cols');
		if ($block3_cols == 0) {
			$block3_cols = 1;
		}

		// show page content
		$query = "SELECT * FROM #__ezine_category WHERE pageid = '$pageid' AND published = '1' ORDER BY `ordering`";
		$database->setQuery($query);
		$cats = $database->loadObjectList();
		$total_cats = count($cats);
		$i = 0;

		// Page Output
		$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - Begin -->";

		if ($params->get('category_open_ajax_enable')) {
			// Begin placefolder for ajax engine
			$return_html .= "\n".'<div id="ezine_content">';
		}

		// page header
		if ($params->get('show_page_title') AND $page[0]->page_title) {
			$return_html .= "\n".'<div class="page_title'.$params->get('pageclass_sfx').'">'.stripslashes($page[0]->page_title).'</div>';
		}

		$return_html .= "\n".'<div class="page_body'.$params->get('pageclass_sfx').'">';

		// produce featured article
		if ( $params->get('featured_article') ) {
			showFeaturedArticle($params);
		}

		// checks to see if there is any category to display
		if ($total_cats) {
			// Block1 output
			if ($block1_cats) {
				$col_width = floor(100 / $block1_cols); // width of each column
				$width_remain = 100;
				$total_sep = 0;

				$return_html .= "\n\t".'<div class="block1'.$params->get('pageclass_sfx').'">';
				for ($z = 0; $z < $block1_cats; $z++) {
					$cur_index = ($z + 1) - $total_sep;
					if (($i + 1) == $total_cats) {
						// stops loop if total number of items is less than the number set to display
						$return_html .= "\n\t\t<div style=\"float:left;width:$width_remain%\">";
						showCategory($cats[$i], $params);
						$return_html .= "\n\t\t</div><br class=\"clr\" />";
						$i++;
						break;
					} else {
						if ( ($cats[$i]->content_type != 'separator' AND ($cur_index % $block1_cols) == 0) OR $cats[$i+1]->content_type == 'separator' ) {
							$return_html .= "\n\t\t<div style=\"float:left;width:$width_remain%\">";
						} else {
							if ( $cats[$i]->content_type == 'separator' ) {
								$return_html .= "\n\t\t".'<div class="separator_block'.$params->get('pageclass_sfx').'">';
								$total_sep++;
							} else {
								$return_html .= "\n\t\t<div style=\"float:left;width:$col_width%\">";
							}
						}
						showCategory($cats[$i], $params);
						$return_html .= "\n\t\t</div>";

						// begin new row?
						if ( ($cats[$i]->content_type != 'separator' AND ($cur_index % $block1_cols) == 0) OR $cats[$i+1]->content_type == 'separator' ) {
							$return_html .= "<br class=\"clr\" />";
							$width_remain = 100;
						} elseif ( $cats[$i]->content_type != 'separator' ) {
							$width_remain -= $col_width;
						}
						$i++;
					}
				}
				$return_html .= "\n\t</div>";
			}

			// Block2 output
			if ($block2_cats && ($i < $total_cats)) {
				$col_width = floor(100 / $block2_cols); // width of each column
				$width_remain = 100;
				$total_sep = 0;

				$return_html .= "\n\t".'<div class="block2'.$params->get('pageclass_sfx').'">';
				for ($z = 0; $z < $block2_cats; $z++) {
					$cur_index = ($z + 1) - $total_sep;
					if (($i + 1) == $total_cats) {
						// stops loop if total number of items is less than the number set to display
						$return_html .= "\n\t\t<div style=\"float:left;width:$width_remain%\">";
						showCategory($cats[$i], $params);
						$return_html .= "\n\t\t</div><br class=\"clr\" />";
						$i++;
						break;
					} else {
						if ( ($cats[$i]->content_type != 'separator' AND ($cur_index % $block2_cols) == 0) OR $cats[$i+1]->content_type == 'separator' ) {
							$return_html .= "\n\t\t<div style=\"float:left;width:$width_remain%\">";
						} else {
							if ( $cats[$i]->content_type == 'separator' ) {
								$return_html .= "\n\t\t".'<div class="separator_block'.$params->get('pageclass_sfx').'">';
								$total_sep++;
							} else {
								$return_html .= "\n\t\t<div style=\"float:left;width:$col_width%\">";
							}
						}
						showCategory($cats[$i], $params);
						$return_html .= "\n\t\t</div>";

						// begin new row?
						if ( ($cats[$i]->content_type != 'separator' AND ($cur_index % $block2_cols) == 0) OR $cats[$i+1]->content_type == 'separator' ) {
							$return_html .= "<br class=\"clr\" />";
							$width_remain = 100;
						} elseif ( $cats[$i]->content_type != 'separator' ) {
							$width_remain -= $col_width;
						}
						$i++;
					}
				}
				$return_html .= "\n\t</div>";
			}

			// Block3 output
			if ($block3_cats && ($i < $total_cats)) {
				$col_width = floor(100 / $block3_cols); // width of each column
				$width_remain = 100;
				$total_sep = 0;

				$return_html .= "\n\t".'<div class="block3'.$params->get('pageclass_sfx').'">';
				for ($z = 0; $z < $block3_cats; $z++) {
					$cur_index = ($z + 1) - $total_sep;
					if (($i + 1) == $total_cats) {
						// stops loop if total number of items is less than the number set to display
						$return_html .= "\n\t\t<div style=\"float:left;width:$width_remain%\">";
						showCategory($cats[$i], $params);
						$return_html .= "\n\t\t</div><br class=\"clr\" />";
						$i++;
						break;
					} else {
						if ( ($cats[$i]->content_type != 'separator' AND ($cur_index % $block3_cols) == 0) OR $cats[$i+1]->content_type == 'separator' ) {
							$return_html .= "\n\t\t<div style=\"float:left;width:$width_remain%\">";
						} else {
							if ( $cats[$i]->content_type == 'separator' ) {
								$return_html .= "\n\t\t".'<div class="separator_block'.$params->get('pageclass_sfx').'">';
								$total_sep++;
							} else {
								$return_html .= "\n\t\t<div style=\"float:left;width:$col_width%\">";
							}
						}
						showCategory($cats[$i], $params);
						$return_html .= "\n\t\t</div>";

						// begin new row?
						if ( ($cats[$i]->content_type != 'separator' AND ($cur_index % $block3_cols) == 0) OR $cats[$i+1]->content_type == 'separator' ) {
							$return_html .= "<br class=\"clr\" />";
							$width_remain = 100;
						} elseif ( $cats[$i]->content_type != 'separator' ) {
							$width_remain -= $col_width;
						}
						$i++;
					}
				}
				$return_html .= "\n\t</div>";
			}

			// newsletter subsribe link
			if ($params->get('subscribe_link')) {
				$return_html .= "\n\t<div class=\"newsletter_subscribe\">";
				$return_html .= "\n\t<a href=\"".sefRelToAbs("index.php?option=$option&task=newsletter_subscribe&Itemid=$Itemid")."\" title=\""._NEWSLETTER_SUBSCRIBE."\">"._NEWSLETTER_SUBSCRIBE."</a>";
				$return_html .= "\n\t</div>";
			}
		} else {
			$return_html .= "\n\t"._NO_CATEGORY_FOUND;
		}
		$return_html .= "\n</div>";

		back_button($params);

		if ($params->get('category_open_ajax_enable')) {
			// End placefolder for ajax engine
			$return_html .= "\n".'</div>';
		}

		$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - End -->\n";
	} else {
		$return_html .= "\n"._PAGE_NOT_FOUND;
	}
}

// function to produce featured article
function showFeaturedArticle( &$params ) {
	global $loadedArticle, $database, $noauth, $gid, $now, $return_html;

	$params->set('intro_only', 1);
	$params->set('ezine_cat_id', 'featured');

	if ($params->get('limit_featured_to_sec')) {
		$where = "\n AND a.sectionid IN (".$params->get('limit_featured_to_sec').")";
	} elseif ($params->get('limit_featured_to_cat')) {
		$where = "\n AND a.catid IN (".$params->get('limit_featured_to_cat').")";
	} else {
		$where = '';
	}

	// add order control
	switch ($params->get('featured_order_by')) {
		case 'date':
			$orderby = 'a.created';
			break;
		case 'rdate':
			$orderby = 'a.created DESC';
			break;
		case 'alpha':
			$orderby = 'a.title';
			break;
		case 'ralpha':
			$orderby = 'a.title DESC';
			break;
		case 'author':
			$orderby = 'a.created_by, u.name';
			break;
		case 'rauthor':
			$orderby = 'a.created_by DESC, u.name DESC';
			break;
		case 'hits':
			$orderby = 'a.hits DESC';
			break;
		case 'rhits':
			$orderby = 'a.hits ASC';
			break;
		case 'order':
			$orderby = 'a.ordering';
			break;
		default:
			$orderby = 'a.created DESC';
			break;
	}

	$featured_leading = $params->get('featured_leading');
	$featured_intro = $params->get('featured_intro');
	$featured_intro_cols = $params->get('featured_intro_cols');
	if ($featured_intro_cols == 0) {
		$featured_intro_cols = 1;
	}
	$total_count = $featured_leading + $featured_intro;

	// query records
	$query = "SELECT a.*, u.name AS author, s.name AS section, cc.name AS category, g.name AS groups"
	. "\n FROM #__content AS a"
	. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id"
	. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
	. "\n INNER JOIN #__sections AS s ON s.id = a.sectionid"
	. "\n INNER JOIN #__users AS u ON u.id = a.created_by"
	. "\n INNER JOIN #__groups AS g ON a.access = g.id"
	. "\n WHERE a.state = '1'"
	. ($noauth ? "\n AND a.access <= '". $gid ."'" : '')
	. "\n AND (a.publish_up = '0000-00-00 00:00:00' OR a.publish_up <= '$now')"
	. "\n AND (a.publish_down = '0000-00-00 00:00:00' OR a.publish_down >= '$now')"
	. $where . (count($loadedArticle) ? " AND a.id NOT IN ('".implode("','", $loadedArticle)."')" : '')
	. "\n ORDER BY " . $orderby
	. "\n LIMIT 0,$total_count"
	;
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	$total_rows = count($rows);
	$i = 0;

	// checks to see if there is any item to display
	if ($total_rows) {
		$return_html .= "\n\t".'<div class="featured_block'.$params->get('pageclass_sfx').'">';
		// show Featured Article title
		if ($params->get('show_featured_title')) {
			$return_html .= "\n\t\t".'<div class="featured_title'.$params->get('pageclass_sfx').'">'.stripslashes($params->get('featured_title_text')).'</div>';
		}
		$return_html .= "\n\t\t".'<div class="featured_body'.$params->get('pageclass_sfx').'">';
		$params->set('in_featured_block', 1);
		outputBlogLayout( $rows, $params, $total_rows, $featured_leading, $featured_intro, $featured_intro_cols );
		$params->set('in_featured_block', 0);
		$return_html .= "\n\t\t".'</div>';
		$return_html .= "\n\t".'</div>';
	}
}

// function to output html for eZine category
function showCategory(&$category, &$params, $category_page = 0) {
	global $loadedArticle, $database, $task, $func, $access, $gid, $mainframe, $now, $noauth, $mosConfig_MetaTitle, $mosConfig_MetaAuthor, $return_html;

	// Category Parameters
	$cat_params = new mosParameters($category->params);
	$params->set('show_cat_title', $cat_params->get('show_cat_title', 1));

	$params->set('words_count', $cat_params->get('words_count', 0));
	$params->set('leading_news', $cat_params->get('leading_news', 1));
	$params->set('intro_news', $cat_params->get('intro_news', 2));
	$params->set('intro_cols', $cat_params->get('intro_cols', 2));
	$params->set('links', $cat_params->get('links', 5));
	$params->set('link_cols', $cat_params->get('link_cols', 1));

	$params->set('linked_cat_title', $cat_params->get('linked_cat_title', 0));
	$params->set('frontpage_only', $cat_params->get('frontpage_only', 0));
	$params->set('intro_only', $cat_params->get('intro_only', 1));
	$params->set('order_news_by', $cat_params->get('order_news_by', 'rdate'));
	$params->set('show_more_cat_news', $cat_params->get('show_more_cat_news', 1));

	$params->set('leading_thumbnail_position', $cat_params->get('leading_thumbnail_position', ''));
	$params->set('intro_thumbnail_position', $cat_params->get('intro_thumbnail_position', ''));
	$params->set('cat_title_img', $cat_params->get('cat_title_img', ''));
	$params->set('more_cat_news_img', $cat_params->get('more_cat_news_img', ''));
	$params->set('intro_with_img', $cat_params->get('intro_with_img', 1));
	$params->set('link_with_img', $cat_params->get('link_with_img', 1));

	$params->def('pagination', 0);

	// More In page parameters
	if ($params->get('pagination')) {
		$params->set('pageclass_sfx', $cat_params->get('morein_pageclass_sfx', ''));
		$params->set('back_button', $cat_params->get('morein_back_button', 1));

		$params->set('article_title', $cat_params->get('morein_article_title', 1));
		$params->set('article_title_linkable', $cat_params->get('morein_article_title_linkable', 1));
		$params->set('category_title', $cat_params->get('morein_category_title', 0));
		$params->set('category_title_linkable', $cat_params->get('morein_category_title_linkable', 0));
		$params->set('section_title', $cat_params->get('morein_section_title', 0));
		$params->set('section_title_linkable', $cat_params->get('morein_section_title_linkable', 0));

		$params->set('readmore', $cat_params->get('morein_readmore', 1));
		$params->set('rating', $cat_params->get('morein_rating', 0));
		$params->set('author', $cat_params->get('morein_author', 1));
		$params->set('createdate', $cat_params->get('morein_createdate', 1));
		$params->set('modifydate', $cat_params->get('morein_modifydate', 0));

		$params->set('pdf', $cat_params->get('morein_pdf', 1));
		$params->set('print', $cat_params->get('morein_print', 1));
		$params->set('email', $cat_params->get('morein_email', 1));

		$params->set('show_cat_title', $cat_params->get('morein_show_cat_title', $params->get('show_cat_title')));
		$params->set('leading_thumbnail_position', $cat_params->get('morein_leading_thumbnail_position', ''));
		$params->set('intro_thumbnail_position', $cat_params->get('morein_intro_thumbnail_position', ''));

		$params->set('leading_news', $cat_params->get('morein_leading_news', $params->get('leading_news')));
		$params->set('intro_news', $cat_params->get('morein_intro_news', $params->get('intro_news')));
		$params->set('intro_cols', $cat_params->get('morein_intro_cols', $params->get('intro_cols')));
		$params->set('links', $cat_params->get('morein_links', $params->get('links')));
		$params->set('link_cols', $cat_params->get('morein_link_cols', $params->get('link_cols')));
	}

	if ($category->content_type == 'separator') {
		// Show separator
		$database->setQuery("SELECT * FROM #__ezine_separator WHERE id = '$category->contentid' LIMIT 0, 1");
		$database->loadObject($separator);
		switch ($separator->type) {
			case 'content_item':
			case 'static_content':
				if ($access->canEdit) {
					$xwhere='';
				} else {
					$xwhere = "AND (a.state = '1' OR a.state = '-1')"
					. "\n	AND (a.publish_up = '0000-00-00 00:00:00' OR a.publish_up <= '$now')"
					. "\n	AND (a.publish_down = '0000-00-00 00:00:00' OR a.publish_down >= '$now')"
					;
				}
				$query = "SELECT a.*, u.name AS author, cc.name AS category, s.name AS section, g.name AS groups"
				. "\n FROM #__content AS a"
				. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
				. "\n LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope='content'"
				. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
				. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
				. "\n WHERE a.id='". $separator->content_id ."' ". $xwhere
				. "\n AND a.access <= ". $gid;
				$database->setQuery($query);
				if ($database->loadObject($separator_content)) {
					if ($mosConfig_MetaTitle == '1') {
						$mainframe->addMetaTag('title' , $separator_content->title);
					}
					if ($mosConfig_MetaAuthor == '1') {
						$mainframe->addMetaTag('author' , $separator_content->author);
					}
					showArticle($separator_content, $params);
				}
				break;
			case 'html_code':
				$return_html .= "\n\t\t\t".$separator->html_code;
				break;
			default:
				break;
		}
	} elseif (($category->content_type == 'section') OR ($category->content_type == 'category')) {
		// Show category news
		$leading_news	= $params->get('leading_news');
		$intro_news		= $params->get('intro_news');
		$intro_cols		= $params->get('intro_cols');
		if ($intro_cols == 0) {
			$intro_cols = 1;
		}
		$links			= $params->get('links');
		$link_cols		= $params->get('link_cols');
		if ($link_cols == 0) {
			$link_cols = 1;
		}

		// retrieve news based on content section or content category
		if ($category->content_type == 'section') {
			$where = "\n AND a.sectionid = '".$category->contentid."'";
			$database->setQuery("SELECT name FROM #__sections WHERE id = '".$category->contentid."'");
			$cat_name = $database->loadResult();
		} else {
			$where = "\n AND a.catid = '".$category->contentid."'";
			$database->setQuery("SELECT name FROM #__categories WHERE id = '".$category->contentid."'");
			$cat_name = $database->loadResult();
		}
		$cat_name = stripslashes($cat_name);

		// show frontpage item only or not?
		if ($params->get('frontpage_only')) {
			$frontpage = "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id";
		} else {
			$frontpage = '';
		}

		// add order control
		switch ($params->get('order_news_by')) {
			case 'date':
				$orderby = 'a.created';
				break;
			case 'rdate':
				$orderby = 'a.created DESC';
				break;
			case 'alpha':
				$orderby = 'a.title';
				break;
			case 'ralpha':
				$orderby = 'a.title DESC';
				break;
			case 'author':
				$orderby = 'a.created_by, u.name';
				break;
			case 'rauthor':
				$orderby = 'a.created_by DESC, u.name DESC';
				break;
			case 'hits':
				$orderby = 'a.hits DESC';
				break;
			case 'rhits':
				$orderby = 'a.hits ASC';
				break;
			case 'order':
				$orderby = 'a.ordering';
				break;
			default:
				$orderby = 'a.created DESC';
				break;
		}

		// how to join table in query?
		$joinDirection = $frontpage == '' ? 'LEFT' : 'INNER';

		// limit control
		$limitstart = $category_page ? $category_page : intval(mosGetParam($_REQUEST, 'limitstart', 0));
		$limit = $leading_news + $intro_news + $links;
		$params->set('limitation_per_category', $limit);

		// pagination support
		if ($params->get('pagination')) {
			$database->setQuery("SELECT COUNT(a.id) AS total_count"
			. "\n FROM #__content AS a"
			. $frontpage
			. "\n $joinDirection JOIN #__categories AS cc ON cc.id = a.catid"
			. "\n $joinDirection JOIN #__sections AS s ON s.id = a.sectionid"
			. "\n $joinDirection JOIN #__users AS u ON u.id = a.created_by"
			. "\n $joinDirection JOIN #__groups AS g ON a.access = g.id"
			. "\n WHERE a.state = '1'"
			. ($noauth ? "\n AND a.access <= '". $gid ."'" : '')
			. "\n AND (a.publish_up = '0000-00-00 00:00:00' OR a.publish_up <= '$now')"
			. "\n AND (a.publish_down = '0000-00-00 00:00:00' OR a.publish_down >= '$now')"
			. $where);
			$total = $database->loadResult();
			if ($total <= $limit) {
				$limitstart = 0;
			}
		}

		// query records
		$query = "SELECT a.*, u.name AS author, s.name AS section, cc.name AS category, g.name AS groups"
		. "\n FROM #__content AS a"
		. $frontpage
		. "\n $joinDirection JOIN #__categories AS cc ON cc.id = a.catid"
		. "\n $joinDirection JOIN #__sections AS s ON s.id = a.sectionid"
		. "\n $joinDirection JOIN #__users AS u ON u.id = a.created_by"
		. "\n $joinDirection JOIN #__groups AS g ON a.access = g.id"
		. "\n WHERE a.state = '1'"
		. ($noauth ? "\n AND a.access <= '". $gid ."'" : '')
		. "\n AND (a.publish_up = '0000-00-00 00:00:00' OR a.publish_up <= '$now')"
		. "\n AND (a.publish_down = '0000-00-00 00:00:00' OR a.publish_down >= '$now')"
		. $where . (count($loadedArticle) ? " AND a.id NOT IN ('".implode("','", $loadedArticle)."')" : '')
		. "\n ORDER BY " . $orderby
		. "\n LIMIT $limitstart, $limit"
		;
		$database->setQuery($query);
		$news = $database->loadObjectList();
		$total_news = count($news);

		$more_news_link = getCategoryLink($category->id, $params);

		// Category Output
		if ($task == 'view') {
			$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - Begin -->";
			 if ($params->get('content_open_ajax_enable')) {
				// Begin placefolder for ajax engine
				$return_html .= "\n".'<div id="ezine_content">';
			}
		}

		if ($params->get('show_cat_title')) {
			$return_html .= "\n\t\t".'<div class="category_title'.$params->get('pageclass_sfx').'">';
			if ($params->get('linked_cat_title') AND $task != 'view' AND $func != 'showCategoryAJAX') {
				$return_html .= "\n\t\t".'<a href="'.$more_news_link.'" title="'.str_replace('%CAT_NAME%', $cat_name, _MORE_CATEGORY_NEWS).'">';
			}
			if ($params->get('cat_title_img')) {
				$return_html .= '<img src="'.$params->get('cat_title_img').'" border="0" alt="'.$cat_name.'" />';
			} else {
				$return_html .= $cat_name;
			}
			if ($params->get('linked_cat_title') AND $task != 'view' AND $func != 'showCategoryAJAX') {
				$return_html .= "</a>\n\t\t";
			}
			$return_html .= '</div>';
		}

		// checks to see if there is any item to display
		if ($total_news) {
			$return_html .= "\n\t\t".'<div class="category_body'.$params->get('pageclass_sfx').'">';
			outputBlogLayout( $news, $params, $total_news, $leading_news, $intro_news, $intro_cols, $links, $link_cols );

			// Pagination output
			if ($params->get('pagination')) {
				if ($total <= $limit) {
					// not visible when the total number of article is less than the article limitation per page
				} else {
					require_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/php/d4jAjaxPagenav.php');
					$pageNav = new ajaxPageNav($total, $limitstart, $limit);
					$navLink = getCategoryLink($category->id, $params, '__LIMIT_START__');
					$return_html .= "\n\t\t\t".'<div class="category_pagination'.$params->get('pageclass_sfx').'">';
					$return_html .= $pageNav->writeAjaxLinks($navLink);
					if ($params->get('pagination_results')) {
						$return_html .= '<br/>';
						$return_html .= $pageNav->writePagesCounter();
					}
					$return_html .= "\n\t\t\t".'</div>';
				}
			} elseif ($params->get('show_more_cat_news')) {
				$return_html .= "\n\t\t\t".'<div class="more_articles'.$params->get('pageclass_sfx').'">';
				$return_html .= "\n\t\t\t".'<a href="'.$more_news_link.'" title="'. str_replace('%CAT_NAME%', $cat_name, _MORE_CATEGORY_NEWS) .'">';
				if ($params->get('more_cat_news_img')) {
					$return_html .= '<img src="'.$params->get('more_cat_news_img').'" border="0" alt="'.str_replace('%CAT_NAME%', $cat_name, _MORE_CATEGORY_NEWS).'" />';
				} else {
					$return_html .= str_replace('%CAT_NAME%', $cat_name, _MORE_CATEGORY_NEWS);
				}
				$return_html .= "</a>\n\t\t\t</div>";
			}

			$return_html .= "\n\t\t".'</div>';
		} else {
			// Generic blog empty display
			$return_html .= "\n"._EMPTY_BLOG;
		}
	}

	if ($task == 'view' OR $func == 'showCategoryAJAX') {
		back_button($params);
	}

	if ($task == 'view') {
		if ($params->get('content_open_ajax_enable')) {
			// End placefolder for ajax engine
			$return_html .= "\n".'</div>';
		}
		$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - End -->\n";
	}
}

function outputBlogLayout( &$rows, &$params, $total, $leading, $intro, $intro_cols, $links = 0, $link_cols = 0 ) {
	global $return_html;

	$i = 0;
	// Leading article output
	if ($leading) {
		$params->set('thumbnail_position', 'leading');
		$return_html .= "\n\t\t\t".'<div class="leading_articles'.$params->get('pageclass_sfx').'">';
		for ($z = 0; $z < $leading; $z++) {
			if ($i >= $total) {
				// stops loop if total number of categories is less than the number set to display as leading
				break;
			}
			showArticle($rows[$i], $params);
			$i++;
		}
		$return_html .= "\n\t\t\t</div>";
	}

	// Intro article output
	if ($intro && ($i < $total)) {
		$params->set('thumbnail_position', 'intro');
		$col_width = floor(100 / $intro_cols); // width of each column
		$width_remain = 100;

		$return_html .= "\n\t\t\t".'<div class="intro_articles'.$params->get('pageclass_sfx').'">';
		for ($z = 0; $z < $intro; $z++) {
			$cur_index = $z + 1;
			if (($i + 1) == $total) {
				// stops loop if total number of items is less than the number set to display as intro + leading
				$return_html .= "\n\t\t\t\t<div style=\"float:left;width:$width_remain%\">";
				showArticle($rows[$i], $params);
				$return_html .= "\n\t\t\t\t</div><br class=\"clr\" />";
				$i++;
				break;
			} else {
				if ( ($cur_index % $intro_cols) == 0 ) {
					$return_html .= "\n\t\t\t\t<div style=\"float:left;width:$width_remain%\">";
				} else {
					$return_html .= "\n\t\t\t\t<div style=\"float:left;width:$col_width%\">";
				}
				showArticle($rows[$i], $params);
				$return_html .= "\n\t\t\t\t</div>";

				// begin new row?
				if ( ($cur_index % $intro_cols) == 0 ) {
					$return_html .= "<br class=\"clr\" />";
					$width_remain = 100;
				} else {
					$width_remain -= $col_width;
				}
				$i++;
			}
		}
		$return_html .= "\n\t\t\t</div>";
	}

	// Links output
	if ($links && ($i < $total)) {
		$col_width = floor(100 / $link_cols); // width of each column
		$width_remain = 100;

		$return_html .= "\n\t\t\t".'<div class="blog_more'.$params->get('pageclass_sfx').'">';
		$return_html .= "<div><strong>"._MORE.'</strong></div>';
		for ($z = 0; $z < $links; $z++) {
			$cur_index = $z + 1;
			if (($i + 1) == $total) {
				// stops loop if total number of items is less than the number set to display as intro + leading
				$return_html .= "\n\t\t\t\t<div class=\"articles_link".$params->get('pageclass_sfx')."\" style=\"float:left;width:$width_remain%\">";
				HTML_ezine::showLink($rows[$i], $params);
				$return_html .= "\n\t\t\t\t</div><br class=\"clr\" />";
				$i++;
				break;
			} else {
				if ( ($cur_index % $link_cols) == 0 ) {
					$return_html .= "\n\t\t\t\t<div class=\"articles_link".$params->get('pageclass_sfx')."\" style=\"float:left;width:$width_remain%\">";
				} else {
					$return_html .= "\n\t\t\t\t<div class=\"articles_link".$params->get('pageclass_sfx')."\" style=\"float:left;width:$col_width%\">";
				}
				HTML_ezine::showLink($rows[$i], $params);
				$return_html .= "\n\t\t\t\t</div>";

				// begin new row?
				if ( ($cur_index % $link_cols) == 0 ) {
					$return_html .= "<br class=\"clr\" />";
					$width_remain = 100;
				} else {
					$width_remain -= $col_width;
				}
				$i++;
			}
		}
		$return_html .= "\n\t\t\t</div>";
	}
}

function showFullArticle($article_id, &$params, $article_page = 0) {
	global $task, $database, $mainframe, $now, $gid, $access, $mosConfig_MetaTitle, $mosConfig_MetaAuthor, $return_html;

	// get eZine category details
	global $category_id;
	if (is_numeric($category_id)) {
		$database->setQuery("SELECT content_type, contentid, params FROM #__ezine_category WHERE id = '$category_id' LIMIT 0, 1");
		$database->loadObject($category_details);

		// Category Parameters
		$cat_params = new mosParameters($category_details->params);
		$params->set('frontpage_only', $cat_params->get('frontpage_only', 0));
		$params->set('order_news_by', $cat_params->get('order_news_by', 'rdate'));
	} elseif ($category_id == 'featured') {
		global $pageid;

		$params->set('frontpage_only', 1);
		$database->setQuery("SELECT params FROM #__ezine_page WHERE id = '$pageid' AND published = '1' LIMIT 0, 1");
		$page_params = $database->loadResult();

		// Page Parameters
		$page_params = new mosParameters($page_params);
		$params->set('show_featured_title', $page_params->get('show_featured_title', 1));
		$params->def('featured_title_text', $page_params->get('featured_title_text', 'Featured Article'));
		$params->set('limit_featured_to_sec', $page_params->get('limit_featured_to_sec', ''));
		$params->set('limit_featured_to_cat', $page_params->get('limit_featured_to_cat', ''));
		$params->set('order_news_by', $page_params->get('featured_order_by', 'rdate'));

		// show Featured Article title
		if ($params->get('show_featured_title')) {
			global $return_html;
			$return_html .= "\n\t".'<div class="featured_title'.$params->get('pageclass_sfx').'">'.stripslashes($params->get('featured_title_text')).'</div>';
		}
	}

	$nullDate = method_exists($database, 'getNullDate') ? $database->getNullDate() : '0000-00-00 00:00:00';
	if ($access->canEdit) {
		$xwhere = '';
	} else {
		$xwhere = " AND (a.state = 1 OR a.state = -1)"
		. "\n AND (publish_up = '$nullDate' OR publish_up <= '$now')"
		. "\n AND (publish_down = '$nullDate' OR publish_down >= '$now')"
		;
	}

	$query = "SELECT a.*, u.name AS author, cc.name AS category, s.name AS section, g.name AS groups, "
	. "\n s.published AS sec_pub, cc.published AS cat_pub, s.access AS sec_access, cc.access AS cat_access"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
	. "\n LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = 'content'"
	. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
	. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
	. "\n WHERE a.id = '$article_id'"
	. $xwhere
	. "\n AND a.access <= $gid"
	;
	$database->setQuery($query);
	$row = NULL;

	if ($database->loadObject($row)) {
		/*
		* check whether category is published
		*/
		if (!$row->cat_pub && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section is published
		*/
		if (!$row->sec_pub && $row->sectionid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether category access level allows access
		*/
		if (($row->cat_access > $gid) && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section access level allows access
		*/
		if (($row->sec_access > $gid) && $row->sectionid) {
			mosNotAuth();
			return;
		}

		// Content Item page parameters
		$article_params = new mosParameters($row->attribs);
		$params->set('intro_only', 0);

		$params->set('pageclass_sfx', $article_params->get('pageclass_sfx', ''));
		$params->set('back_button', $article_params->get('back_button', $mainframe->getCfg('back_button')));

		$params->set('article_title', $article_params->get('item_title', 1));
		$params->set('article_title_linkable', $article_params->get('link_titles', $mainframe->getCfg( 'link_titles' )));
		$params->set('introtext', $article_params->get('introtext', 1));

		$params->set('category_title', $article_params->get('category', 0));
		$params->set('category_title_linkable', $article_params->get('category_link', 0));
		$params->set('section_title', $article_params->get('section', 0));
		$params->set('section_title_linkable', $article_params->get('section_link', 0));

		$params->set('rating', $article_params->get('rating', $mainframe->getCfg( 'vote' )));
		$params->set('author', $article_params->get('author', !$mainframe->getCfg( 'hideAuthor' )));
		$params->set('createdate', $article_params->get('createdate', !$mainframe->getCfg( 'hideCreateDate' )));
		$params->set('modifydate', $article_params->get('modifydate', !$mainframe->getCfg( 'hideModifyDate' )));

		$params->set('pdf', $article_params->get('pdf', !$mainframe->getCfg( 'hidePdf' )));
		$params->set('print', $article_params->get('print', !$mainframe->getCfg( 'hidePrint' )));
		$params->set('email', $article_params->get('email', !$mainframe->getCfg( 'hideEmail' )));

		if ($row->sectionid == 0) {
			$params->set('item_navigation', 0);
		} else {
			$params->set('item_navigation', $mainframe->getCfg('item_navigation'));
		}

		// loads the links for Next & Previous Button
		if ( (is_numeric($category_id) AND ($category_details->content_type == 'section' OR $category_details->content_type == 'category') AND $params->get('item_navigation')) OR $category_id == 'featured' ) {
			if (is_numeric($category_id)) {
				// query from section or category?
				if ($category_details->content_type == 'section') {
					$location = "a.sectionid = $row->sectionid AND ";
				} else {
					$location = "a.catid = $row->catid AND ";
				}
			} elseif ($category_id == 'featured') {
				// query from section or category?
				if ($params->get('limit_featured_to_sec')) {
					$location = "a.sectionid IN (".$params->get('limit_featured_to_sec').") AND ";
				} elseif ($params->get('limit_featured_to_cat')) {
					$location = "a.catid IN (".$params->get('limit_featured_to_cat').") AND ";
				} else {
					$location = '';
				}
			}

			// show frontpage item only or not?
			if ($params->get('frontpage_only')) {
				$frontpage = "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id";
			} else {
				$frontpage = '';
			}

			// add order control
			switch ($params->get('order_news_by')) {
				case 'date':
					$orderby = 'a.created';
					break;
				case 'rdate':
					$orderby = 'a.created DESC';
					break;
				case 'alpha':
					$orderby = 'a.title';
					break;
				case 'ralpha':
					$orderby = 'a.title DESC';
					break;
				case 'author':
					$orderby = 'a.created_by, u.name';
					break;
				case 'rauthor':
					$orderby = 'a.created_by DESC, u.name DESC';
					break;
				case 'hits':
					$orderby = 'a.hits DESC';
					break;
				case 'rhits':
					$orderby = 'a.hits ASC';
					break;
				case 'order':
					$orderby = 'a.ordering';
					break;
				default:
					$orderby = 'a.created DESC';
					break;
			}

			// array of content items in same category correctly ordered
			$query = "SELECT a.id"
			. "\n FROM #__content AS a"
			. $frontpage
			. "\n WHERE $location"
			. "\n a.state = $row->state"
			. $xwhere
			. "\n AND a.access <= $gid"
			. "\n ORDER BY $orderby"
			;
			$database->setQuery($query);
			$list = $database->loadResultArray();

			// this check needed if incorrect Itemid is given resulting in an incorrect result
			if (!is_array($list)) {
				$list = array();
			}
			// location of current content item in array list
			$location = array_search($article_id, $list);

			$row->prev = '';
			$row->next = '';
			if ($location - 1 >= 0) {
			// the previous content item cannot be in the array position -1
				$row->prev = $list[$location - 1];
			}
			if (($location + 1) < count($list)) {
			// the next content item cannot be in an array position greater than the number of array postions
				$row->next = $list[$location + 1];
			}
		}

		// page title
		$mainframe->setPageTitle($row->title);
		if ($mosConfig_MetaTitle=='1') {
			$mainframe->addMetaTag('title' , $row->title);
		}
		if ($mosConfig_MetaAuthor=='1') {
			$mainframe->addMetaTag('author' , $row->author);
		}

		if ($task == 'read') {
			$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - Begin -->";
		}

		showArticle($row, $params, $article_page);
		back_button($params);

		if ($task == 'read') {
			$return_html .= "\n<!-- D4J eZine Joomla! extension v2.8 output - End -->\n";
		}
	} else {
		mosNotAuth();
		return;
	}
}

function showArticle(&$row, &$params, $article_page = 0) {
	global $loadedArticle, $database, $mainframe, $noauth, $gid, $access, $task, $func;

	if ($access->canEdit) {
		if ($row->id === null || $row->access > $gid) {
			mosNotAuth();
			return;
		}
	} else {
		if ($row->id === null || $row->state == 0) {
			mosNotAuth();
			return;
		}
		if ($row->access > $gid) {
			if ($noauth) {
				mosNotAuth();
				return;
			} else {
				if (!($params->get('intro_only'))) {
					mosNotAuth();
					return;
				}
			}
		}
	}

	// Other content item parameters
	$params->def('image', 1);
	$params->def('section', $params->get('section_title'));
	$params->def('section_link', $params->get('section_title_linkable'));
	$params->def('category', $params->get('category_title'));
	$params->def('category_link', $params->get('category_title_linkable'));
	$params->def('item_title', $params->get('article_title'));
	$params->def('link_titles', $params->get('article_title_linkable'));
	$params->def('introtext', 1);

	// loads the link for Section name
	if ($params->get('section_link')) {
		$query = "SELECT id"
		. "\n FROM #__menu"
		. "\n WHERE componentid = ". $row->sectionid.""
		;
		$database->setQuery($query);
		$_Itemid = $database->loadResult();

		if ($_Itemid) {
			$_Itemid = '&Itemid='. $_Itemid;
		}

		$link 			= sefRelToAbs('index.php?option=com_content&task=section&id='. $row->sectionid . $_Itemid);
		$row->section 	= '<a href="'. $link .'">'. $row->section .'</a>';
	}

	// loads the link for Category name
	if ($params->get('category_link')) {
		$query = "SELECT id"
		. "\n FROM #__menu"
		. "\n WHERE componentid = $row->catid"
		;
		$database->setQuery($query);
		$_Itemid = $database->loadResult();

		if ($_Itemid) {
			$_Itemid = '&Itemid='. $_Itemid;
		}

		$link 			= sefRelToAbs('index.php?option=com_content&task=category&sectionid='. $row->sectionid .'&id='. $row->catid . $_Itemid);
		$row->category 	= '<a href="'. $link .'">'. $row->category .'</a>';
	}

	// show intro text only or not
	if ($params->get('intro_only')) {
		$row->text = $row->introtext;
	} else {
		// show/hides the intro text
		if ($params->get('introtext')) {
			$row->text = $row->introtext . chr(13) . chr(13) . $row->fulltext;
		} else {
			$row->text = $row->fulltext;
		}
	}

	// deal with the {mospagebreak} mambots
	// only permitted in the full text area
	$article_page = $article_page ? $article_page : intval(mosGetParam($_REQUEST, 'limitstart', 0));

	// apply words limitation when not reading full article
	if ($params->get('intro_only') AND $params->get('words_count')) {
		$words = str_word_count($row->text, 2);
		$pos = 0;
		foreach ($words AS $k => $v) {
			if ($pos == $params->get('words_count')) {
				$row->text = substr($row->text, 0, $k - 1).'...';
				$row->fulltext = true;
				break;
			}
			$pos++;
		}
	}

	if ($task == 'read' OR $func == 'showFullArticleAJAX') {
		// Hide first {mosimage} if set
		if ($params->get('hide_first_mosimage')) {
			$row->text = preg_replace('/{(mosimage)\s*(.*?)}/i', '', $row->text, 1);
			$img_parts = explode( "\n", $row->images, 2 );
			$row->images = isset( $img_parts[1] ) ? $img_parts[1] : '';
		}

		// record the hit
		$obj = new mosContent($database);
		$obj->hit($row->id);
	}

	$loadedArticle[] = $row->id;
	HTML_ezine::show($row, $params, $access, $article_page);
}

function getCategoryLink($categoryid, &$params, $category_page = 0) {
	global $option, $database, $pageid;

	// define more news link
	$more_in_link = 'index.php?option='.$option.'&task=view&page='.$pageid.'&category='.$categoryid;
	$database->setQuery("SELECT id FROM #__menu WHERE link = '$more_in_link' AND published > -2 LIMIT 0, 1");
	$item_id = $database->loadResult();
	$more_in_link = ampReplace($more_in_link.'&Itemid='.$item_id.($category_page ? '&limit='.$params->get('limitation_per_category').'&limitstart='.$category_page : ''));
	if (is_numeric($category_page))
		$more_in_link = sefRelToAbs($more_in_link);

	// Create ajax function call or URL?
	if ($params->get('category_open_ajax_enable')) {
		if ($params->get('ajax_sef_url_enable')) {
			$more_in_link .= '" onclick="call_showCategory('.$pageid.', '.$categoryid.', '.$item_id.', '.$category_page.'); return false;';
		} else {
			$more_in_link = 'javascript: call_showCategory('.$pageid.', '.$categoryid.', '.$item_id.', '.$category_page.')';
		}
	}

	$params->set('ezine_cat_id', $categoryid);
	$params->set('ezine_cat_Itemid', $item_id);

	return $more_in_link;
}

function getArticleLink($rowid, &$params, $article_page = 0) {
	global $option, $pageid;

	$article_link = ampReplace('index.php?option='.$option.'&task=read&page='.$pageid.'&category='.$params->get('ezine_cat_id').'&article='.$rowid.($params->get('article_inherit_itemid') ? '&Itemid='.$params->get('ezine_cat_Itemid') : '').($article_page ? '&limit=1&limitstart='.$article_page : ''));
	if (is_numeric($article_page))
		$article_link = sefRelToAbs($article_link);

	// Create javascript function call if ajax is enable, else create URL
	if ($params->get('content_open_ajax_enable')) {
		if ($params->get('ajax_sef_url_enable')) {
			$article_link .= '" onclick="call_showContent('.$pageid.', \''.$params->get('ezine_cat_id').'\', '.$rowid.', '.$params->get('ezine_cat_Itemid').($article_page ? ', '.$article_page : '').'); return false;';
		} else {
			$article_link = 'javascript:call_showContent('.$pageid.', \''.$params->get('ezine_cat_id').'\', '.$rowid .', '.$params->get('ezine_cat_Itemid').($article_page ? ', '.$article_page : '').');';
		}
	}

	return $article_link;
}

function back_button(&$params) {
	global $option, $task, $return_html, $returned;

	// powered by
	if (isset($returned['copyright_removal']) AND $returned['copyright_removal'] != 'yes') {
		include_once( _D4J_PRODUCT_BACKEND_PATH.'/version.php' );
		$return_html .= '<br style="line-height:15px" />'
		. '<center>Powered by <a href="http://designforjoomla.com/" target="_blank">D4J eZine '._EZINE_VERSION.'</a></center>';
	}

	// display back button if set
	if ($params->get('back_button') OR $task == 'newsletter_subscribe') {
		$return_html .= '<div class="back_button"><a href="javascript:history.go(-1)">'._BACK.'</a></div>';
	}
}


/* Server-side AJAX functions */

function showFullArticleAJAX( &$vars ) {
	global $params, $Itemid, $return_html;

	$GLOBALS['category_id'] = intval($vars['category']);
	$article_id = intval($vars['article']);
	$article_page = isset($vars['article_page']) ? $vars['article_page'] : 0;

	$params->set('ezine_cat_id', $GLOBALS['category_id']);
	$params->set('ezine_cat_Itemid', $Itemid);

	showFullArticle($article_id, $params, $article_page);

	return $return_html;
}

function showCategoryAJAX( &$vars ) {
	global $database, $params, $Itemid, $return_html;

	$GLOBALS['pageid'] = intval($vars['page']);
	$GLOBALS['category_id'] = intval($vars['category']);
	$category_page = isset($vars['LimitStart']) ? $vars['LimitStart'] : 0;

	$params->set('ezine_cat_id', $GLOBALS['category_id']);
	$params->set('ezine_cat_Itemid', $Itemid);
	$params->set('pagination', 1);

	$query = "SELECT * FROM #__ezine_category WHERE id = '".$GLOBALS['category_id']."' AND published = '1' LIMIT 0, 1";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	showCategory($rows[0], $params, $category_page);

	return $return_html;
}

function subscribe( &$vars ) {
	$pages = $vars['pages'];
	$uid = intval($vars['uid'] ? $vars['uid'] : '');
	$email = $vars['email'] ? $vars['email'] : '';
	$name = $vars['name'] ? $vars['name'] : '';

	global $database, $ajax_engine;

	if ($uid > 0) {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE uid = '$uid' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($selected_pages); $i < $n; $i++) {
				$selected_pages[$i] = intval($selected_pages[$i]);
				if (!in_array($selected_pages[$i], $subcribed_pages)) {
					$subcribed_pages[] = $selected_pages[$i];
				}
			}
			$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
		} else {
			$database->setQuery("INSERT INTO #__ezine_newsletter_users (uid,subcribed_pages,date_join) VALUES ('$uid','$pages','".date( 'Y-m-d H:i:s' )."')");
		}
		if (!$database->query()) {
			$ajax_engine->setAttribute('success', 'false');
			return;
		}
	}

	if ($email != '') {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE email = '$email' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($selected_pages); $i < $n; $i++) {
				if (!in_array($selected_pages[$i], $subcribed_pages)) {
					$subcribed_pages[] = $selected_pages[$i];
				}
			}
			$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
		} else {
			$database->setQuery("INSERT INTO #__ezine_newsletter_users (name,email,subcribed_pages,date_join) VALUES ('$name','$email','$pages','".date( 'Y-m-d H:i:s' )."')");
		}
		if (!$database->query()) {
			$ajax_engine->setAttribute('success', 'false');
			return;
		}
	}

	$ajax_engine->setAttribute('success', 'true');
	return $user->id ? implode(',', $subcribed_pages) : $pages;
}

function unsubscribe( &$vars ) {
	$pages = $vars['pages'];
	$uid = intval($vars['uid'] ? $vars['uid'] : '');
	$email = $vars['email'] ? $vars['email'] : '';

	global $database, $ajax_engine;

	if ($uid > 0) {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE uid = '$uid' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($subcribed_pages); $i < $n; $i++) {
				$subcribed_pages[$i] = intval($subcribed_pages[$i]);
				if (in_array($subcribed_pages[$i], $selected_pages)) {
					unset($subcribed_pages[$i]);
					$i--;
				}
			}
			if (count($subcribed_pages)) {
				$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
			} else {
				$database->setQuery("DELETE FROM #__ezine_newsletter_users WHERE id = '".$user->id."' LIMIT 1");
			}
			if (!$database->query()) {
				$ajax_engine->setAttribute('success', 'false');
				return;
			}
		}
	}

	if ($email != '') {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE email = '$email' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($subcribed_pages); $i < $n; $i++) {
				if (in_array($subcribed_pages[$i], $selected_pages)) {
					unset($subcribed_pages[$i]);
					$i--;
				}
			}
			if (count($subcribed_pages)) {
				$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
			} else {
				$database->setQuery("DELETE FROM #__ezine_newsletter_users WHERE id = '".$user->id."' LIMIT 1");
			}
			if (!$database->query()) {
				$ajax_engine->setAttribute('success', 'false');
				return;
			}
		}
	}

	$ajax_engine->setAttribute('success', 'true');
	return count($subcribed_pages) ? implode(',', $subcribed_pages) : '0';
}

/* functions for license checking ********************************************/
function get_key() {
	$data = @file(_D4J_PRODUCT_LOCAL_KEY);

	if (!$data)
		return false;

	$buffer = false;
	foreach ($data as $line)
		$buffer .= $line;

	if (!$buffer)
		return false;

	$buffer = @str_replace("<?PHP", "", $buffer);
	$buffer = @str_replace("?>", "", $buffer);
	$buffer = @str_replace("/*--", "", $buffer);
	$buffer = @str_replace("--*/", "", $buffer);

	return @str_replace("\n", "", $buffer);
}

function parse_local_key() {
	if (!@file_exists(_D4J_PRODUCT_LOCAL_KEY))
		return false;

	$raw_data	= @base64_decode(get_key());
	$raw_array	= @explode("|", $raw_data);
	if (@is_array($raw_array) && @count($raw_array) < 8)
		return false;

	return $raw_array;
}

function validate_local_key($array) {
	$raw_array = parse_local_key();

	if (!@is_array($raw_array) || $raw_array === false)
		return "<verify status='invalid_key' message='Please contact support for a new license key.' />";

	if ($raw_array[9] && @strcmp(@md5("4431028526c96a77528cd67adbdf6275".$raw_array[9]), $raw_array[10]) != 0)
		return "<verify status='invalid_key' message='Please contact support for a new license key.' />";

	if (@strcmp(@md5("4431028526c96a77528cd67adbdf6275".$raw_array[1]), $raw_array[2]) != 0)
		return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

	if ($raw_array[1] < time() && $raw_array[1] != 'never')
		return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

	if ($array['per_server']) {
		$server		= phpaudit_get_mac_address();
		$mac_array	= @explode(",", $raw_array[6]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".$server[0]), $mac_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

		$host_array = @explode(",", $raw_array[4]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".@gethostbyaddr(@gethostbyname($server[1]))), $host_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";
	} elseif ($array['per_install'] || $array['per_site']) {
		if ($array['per_install']) {
			$directory_array	= @explode(",", $raw_array[3]);
			$valid_dir			= path_translated();
			$valid_dir			= @md5("4431028526c96a77528cd67adbdf6275".$valid_dir);
			if (!@in_array($valid_dir, $directory_array))
				return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";
		}

		$host_array = @explode(",", $raw_array[4]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".$_SERVER['HTTP_HOST']), $host_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

		$ip_array = @explode(",", $raw_array[5]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".server_addr()), $ip_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";
	}

	return "<verify status='active' message='The license key is valid.' ".$raw_array[9]." />";
}

function validate_license_data($data) {
	global $token, $enable_dns_spoof, $skip_dns_spoof;

	$parser = @xml_parser_create('');
	@xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	@xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
	@xml_parse_into_struct($parser, $data, $values, $tags);
	@xml_parser_free($parser);

	$returned = $values[0]['attributes'];

	if (empty($returned))
		$returned['status'] = 'invalid_key';

	if ($returned['status'] == 'active' && $enable_dns_spoof == 'yes' && !$skip_dns_spoof) {
		if (strcmp(md5('4431028526c96a77528cd67adbdf6275'.$token), $returned['access_token']) != 0)
			$returned['status'] = 'invalid';
	}

	return $returned;
}

function phpaudit_exec_socket($http_host, $http_dir, $http_file, $querystring) {
	$fp = @fsockopen($http_host, 80, $errno, $errstr, 5); // original was 10
	if (!$fp)
		return false;
	else {
		$header = "POST ".($http_dir.$http_file)." HTTP/1.0\r\n";
		$header .= "Host: ".$http_host."\r\n";
		$header .= "Content-type: application/x-www-form-urlencoded\r\n";
		$header .= "User-Agent: PHPAudit v2 (http://www.phpaudit.com)\r\n";
		$header .= "Content-length: ".@strlen($querystring)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$header .= $querystring;

		$data = false;
		if (@function_exists('stream_set_timeout'))
			stream_set_timeout($fp, 0, 500); // set timeout to 0 second and 500 microseconds
		@fputs($fp, $header);

		if (@function_exists('socket_get_status'))
			$status = @socket_get_status($fp);
		else
			$status = true;

		while (!@feof($fp) && $status) {
			$data .= @fgets($fp, 1024);

			if (@function_exists('socket_get_status'))
				$status = @socket_get_status($fp);
			else {
			    if (@feof($fp) == true)
			    	$status = false;
			    else
			    	$status = true;
			}
		}

		@fclose ($fp);

		if (!strpos($data, '200'))
			return false;

		if (!$data)
			return false;

		$data = @explode("\r\n\r\n", $data, 2);

		if (!$data[1])
			return false;

		if (@strpos($data[1], "verify") === false)
			return false;

		return $data[1];
	}
}

/*
* DOES NOT WORK FOR WINDOWS!!!!!!!
* No good way to get the mac address for win.
*/
function phpaudit_get_mac_address() {
	$fp = @popen("/sbin/ifconfig", "r");

	if (!$fp)
		return -1;

	$res = @fread($fp, 4096);
	@pclose($fp);

	$array = @explode("HWaddr", $res);
	if (@count($array) < 2)
		$array = @explode("ether", $res);
	$array		= @explode("\n", $array[1]);
	$buffer[]	= @trim($array[0]);

	$array = @explode("inet addr:", $res);
	if (@count($array) < 2)
		$array = @explode("inet ", $res);
	$array		= @explode(" ", $array[1]);
	$buffer[]	= @trim($array[0]);

	return $buffer;
}

function path_translated() {
	if (isset($_SERVER['PATH_TRANSLATED']))
		return @substr($_SERVER['PATH_TRANSLATED'], 0, @strrpos($_SERVER['PATH_TRANSLATED'], "/"));

	if ($_SERVER['SCRIPT_FILENAME'])
		return @substr($_SERVER['SCRIPT_FILENAME'], 0, @strrpos($_SERVER['SCRIPT_FILENAME'], "/"));

	return @substr($_SERVER['ORIG_PATH_TRANSLATED'], 0, @strrpos($_SERVER['ORIG_PATH_TRANSLATED'], "\\"));
}

function server_addr() {
	return ($_SERVER['SERVER_ADDR'])?$_SERVER['SERVER_ADDR']:$_SERVER['LOCAL_ADDR'];
}

function make_token() {
	return md5('4431028526c96a77528cd67adbdf6275'.time());
}

/**
* Make a remote call to the local key API server.
*
* @param string $RPC                The full URL to the admin rpc.php file.
* @param string $api_fingerprint    Admin -> Configuration -> API Fingerprint.
* @param string $license            The license key to validate.
* @return string The local key string.
*/
function grab_local_key($RPC, $api_fingerprint, $license) {
	// Assumes XMLRPC.class.php is in the same directory as this file.
	// You can get a copy of this file from the admin or client area of your PHPAudit install.
	require_once(_D4J_PRODUCT_BACKEND_PATH.'/rpc/XMLRPC.class.php');

    $api		= new IXR_Client($RPC);
    $keydata	= array('api_key' => $api_fingerprint, 'license_key' => $license);
    $api->query('license.get_local_key', $keydata);

    return $api->getResponse();
}
/**************************************** end functions for license checking */
?>