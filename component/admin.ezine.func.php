<?php
/**
* eZine component :: main and server-side ajax functions
**/

/** ensure this file is being included by a parent file */
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

// define product information
define('_D4J_PRODUCT_NAME'			, 'D4J eZine');
define('_D4J_PRODUCT_BACKEND_PATH'	, str_replace('\\', '/', dirname(__FILE__)));
define('_D4J_PRODUCT_FRONTEND_PATH'	, _D4J_PRODUCT_BACKEND_PATH."/../../../components/$option");
define('_D4J_PRODUCT_LICENSE_KEY'	, _D4J_PRODUCT_BACKEND_PATH.'/license_key.php');
define('_D4J_PRODUCT_LOCAL_KEY'		, _D4J_PRODUCT_BACKEND_PATH.'/local_key.php');

// require language file
if (file_exists(_D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php'))
	require_once(_D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php');
else
	require_once(_D4J_PRODUCT_FRONTEND_PATH.'/language/english.php');

// ajax call or normal call?
if ($func != 'ajaxcall') {
	require_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/php/d4jDisplayEngine.php'); // display engine
	require_once($admin_html_path); // frontend html class
} else {
	require_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/php/d4jAjaxEngine.php'); // ajax engine
	$ajax_engine = new d4j_ajax_engine();
	$ajax_engine->return_data();
	exit();
}

// if popup detected
if ($func == 'popup') {
	$popup = mosGetParam($_GET, 'popup', '');
	// because Joomla! automatically add extra '?tp=template_name' to end of popup URL so we must strip it out
	$popup2 = explode('?', $popup, 2);
	$popup = $popup2[0];
	// just to sure that we can correct file name?
	if (!preg_match("/\.php$/", $popup))
		$popup .= '.php';
	if (file_exists(_D4J_PRODUCT_BACKEND_PATH.'/popups/'.$popup)) {
		require_once(_D4J_PRODUCT_BACKEND_PATH.'/popups/'.$popup);
	}
	exit();
}

// get parameters from the URL or submitted form
$cid = mosGetParam($_POST, 'cid', array(0));
if (!is_array($cid)) {
	$cid = array(0);
}

/* check for valid license ***************************************************\/
if (!preg_match("/^(register)|(requestSupport)|(sendSupportRequest)|(aboutUs)|(update)$/", $func)) {
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
			$license_key = mosGetParam($_POST, 'license_key', '');
			if ($license_key == '') {
				// license key does not exist, redirect to registration page
				mosRedirect("index2.php?option=$option&task=register");
			} else {
				$license_file_content = '<?php $license="'.$license_key.'"; ?>';
				$fp = @fopen(_D4J_PRODUCT_LICENSE_KEY, 'w');
				@fputs($fp, $license_file_content, strlen($license_file_content));
				@fclose($fp);
				$msg = '';
				if (!file_exists(_D4J_PRODUCT_LICENSE_KEY))
					$msg = 'Cannot create file &quot;'._D4J_PRODUCT_LICENSE_KEY.'&quot;. Please double check the directory permission to sure that it is writeable.';
				mosRedirect("index2.php?option=$option", $msg);
			}
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
			mosRedirect("index2.php?option=$option&task=requestSupport", 'Invalid License Key');
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
			echo '<p style="text-align:left">If your server is disconnected from the internet at the moment please reconnect and refresh this page.<br/><br/>Otherwise, please wait for a few minutes then try to refresh this page.<br/><br/>We are very sorry for the inconvenience.<br/><br/>--<br/>The DesignForJoomla.com team</p>';
			exit;
		} else {
			$skip_dns_spoof	= false;
			$returned		= validate_license_data($data);

			if ($returned['status'] == 'invalid')
				mosRedirect("index2.php?option=$option&task=requestSupport", 'Invalid License Key');
			elseif ($returned['status'] == 'suspended')
				mosRedirect("index2.php?option=$option&task=requestSupport", 'License Key Has Been Suspended');
			elseif ($returned['status'] == 'expired')
				mosRedirect("index2.php?option=$option&task=requestSupport", 'License Key Has Been Expired');
			elseif ($returned['status'] == 'pending')
				mosRedirect("index2.php?option=$option&task=requestSupport", 'License Key Has Not Been Activated');
		}

		// checking to see if local key file exists
		if (file_exists(_D4J_PRODUCT_LOCAL_KEY))
			unlink(_D4J_PRODUCT_LOCAL_KEY);
		else
			$thankYouMsg = 'Your copy of D4J eZine Joomla! news portal extension is activated successful. Thank you for choosing our product!';

		// get local key content
		$RPC		= 'http://designforjoomla.com/phpaudit/rpc.php';
		$api_key	= 'c0754300081f7af5d07eca131cb6c368';
		$local_key	= grab_local_key($RPC, $api_key, $license);

		// create local key file
		$fp = @fopen(_D4J_PRODUCT_LOCAL_KEY, 'w');
		@fputs($fp, $local_key, strlen($local_key));
		@fclose($fp);
		if (!file_exists(_D4J_PRODUCT_LOCAL_KEY))
			mosRedirect("index2.php?option=$option", 'Cannot create file &quot;'._D4J_PRODUCT_LOCAL_KEY.'&quot;. Please double check the directory permission to sure that it is writeable.');

		// if activated the first time, show thank you message
		if (isset($thankYouMsg))
			mosRedirect("index2.php?option=$option", $thankYouMsg);

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


/* Main functions */

// Global Settings configuration
function showGlobalSettings() {
	global $option, $database;
	$params =& new mosParameters('');
	$database->setQuery("SELECT * FROM #__ezine_config WHERE 1");
	$rows = $database->loadObjectList();
	for ($i = 0, $n = count($rows); $i < $n; $i++) {
		$params->set($rows[$i]->name, $rows[$i]->value);
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

	$params->def('sef_lowercase_all', 1);
	$params->def('sef_replace_char', '_');
	$params->def('sef_url_format', 2); // http://mosConfig_live_site/eZine_page/eZine_category/article_title/
	$params->def('sef_page_field', 0);
	$params->def('sef_category_field', 0);
	$params->def('sef_article_field', 0);
	$params->def('sef_multipage_form', '%s_page_%d');

	HTML_ezine::showGlobalSettings($params);
}

function saveGlobalSettings() {
	global $database, $option;
	$parameters = mosGetParam($_POST, 'params');
	if (!is_array($parameters)) {
		mosRedirect("index2.php?option=$option&act=config", _INVALID_PARAMS);
	}
	foreach ($parameters AS $k => $v) {
		if (is_array($v)) $v = implode(',', $v);
		$database->setQuery("SELECT `value` FROM #__ezine_config WHERE `name` = '$k' LIMIT 0,1");
		if ($rows = $database->loadObjectList()) {
			$database->setQuery("UPDATE #__ezine_config SET `value` = '$v' WHERE `name` = '$k' LIMIT 1");
		} else {
			$database->setQuery("INSERT INTO #__ezine_config (`name`,`value`) VALUES ('$k','$v')");
		}
		if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=config", _ERROR_QUERY_DB);
		}
	}
	mosRedirect("index2.php?option=$option&act=config", _CONFIG_SAVED);
}

// Functions act with Page Management
function showPage() {
	global $option, $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	// get the total number of records
	$database->setQuery("SELECT count(*) FROM #__ezine_page WHERE 1");
	$total = $database->loadResult();

	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT * FROM #__ezine_page"
	. "\n ORDER BY id LIMIT $pageNav->limitstart, $pageNav->limit";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	$link_to_menu = mosAdminMenus::MenuSelect();

	HTML_ezine::showPage($rows, $pageNav, $link_to_menu);
}

function editPage() {
	global $option, $func;
	$pageid = intval(mosGetParam($_GET, 'pageid', 0));
	if (!$pageid) {
		$cid = mosGetParam($_POST, 'cid', null);
		if (is_array($cid)) {
			$pageid = $cid[0];
		}
	}

	if ($func == 'editpage') {
		global $database;

		// check if requested page exist or not, if not then select the first defined page
		$database->setQuery("SELECT id FROM #__ezine_page WHERE id = $pageid");
		if (!$database->loadResult()) {
			mosRedirect("index2.php?option=$option&act=managepage", _REQUESTED_PAGE_NOT_EXIST);
		}

		$query = "SELECT * FROM #__ezine_page"
		. "\n WHERE id = '$pageid' LIMIT 0,1";
		$database->setQuery($query);
		$database->loadObject($row);
		$params =& new mosParameters($row->params);
	} else {
		$row = new stdClass();
		$params =& new mosParameters('');
	}

	$params->def('show_page_title', 1);

	$params->def('featured_article', 1);
	$params->def('show_featured_title', 1);
	$params->def('featured_title_text', 'Featured Article');
	$params->def('limit_featured_to_sec', '');
	$params->def('limit_featured_to_cat', '');
	$params->def('featured_words_count', 0);
	$params->def('featured_leading', 1);
	$params->def('featured_leading_thumb_pos', '');
	$params->def('featured_intro', 0);
	$params->def('featured_intro_cols', 0);
	$params->def('featured_intro_thumb_pos', '');
	$params->def('featured_order_by', 'rdate');

	$params->def('block1', 1);
	$params->def('block1_cols', 1);
	$params->def('block2', 2);
	$params->def('block2_cols', 1);
	$params->def('block3', 5);
	$params->def('block3_cols', 1);
	$params->def('subscribe_link', 0);

	$params->def('cover_enable', 0);
	$params->def('cover_output', 'joomla');
	$params->def('cover_auto_redirect', 0);
	$params->def('cover_image', '');
	$params->def('cover_html', '');

	$link_to_menu = mosAdminMenus::MenuSelect();

	HTML_ezine::editPage($func, $pageid, $row, $params, $link_to_menu);
}

function savePage() {
	global $option, $database;
	$pageid = intval(mosGetParam($_POST, 'pageid', 0));
	$menu_name = mosGetParam($_POST, 'menu_name', '');
	$page_title = mosGetParam($_POST, 'page_title', '');
	$params = mosGetParam($_POST, 'params');
	if (!is_array($params)) {
		mosRedirect("index2.php?option=$option&act=managepage", _INVALID_PARAMS);
	}

	foreach ($params AS $k=>$v) {
		if (is_array($v)) {
			$v = implode(',', $v);
		}
		$p[] = "$k=$v";
	}
	$p = implode("\n", $p);
	if ($pageid > 0) {
		$sql="UPDATE #__ezine_page SET `menu_name`='$menu_name',`page_title`='$page_title',`params`='$p' WHERE `id`='$pageid' LIMIT 1";
	} else {
		$sql="INSERT INTO #__ezine_page (`menu_name`,`page_title`,`params`) VALUES ('$menu_name','$page_title','$p')";
	}
	$database->setQuery($sql);
	if (!$database->query()) {
		mosRedirect("index2.php?option=$option&act=editpage&pageid=$pageid", _ERROR_QUERY_DB);
	}
	mosRedirect("index2.php?option=$option&act=managepage", _PAGE_PARAMS_SAVED);
}

function removePage() {
	global $option, $database;
	$pages = mosGetParam($_POST, 'cid');
	if (!is_array($pages)) {
		mosRedirect("index2.php?option=$option&act=managepage", _INVALID_PARAMS);
	}

	foreach ($pages AS $page) {
		$database->setQuery("DELETE FROM #__ezine_category WHERE `pageid`='$page'");
		if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=managepage", _ERROR_QUERY_DB);
		}
		$database->setQuery("DELETE FROM #__ezine_page WHERE `id`='$page'");
		if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=managepage", _ERROR_QUERY_DB);
		}
	}

	mosRedirect("index2.php?option=$option&act=managepage");
}

function swapPageStatus() {
	global $option, $database;
	$pages = mosGetParam($_POST, 'cid');
	if (!is_array($pages)) {
		mosRedirect("index2.php?option=$option&act=managepage", _INVALID_PARAMS);
	}

	foreach ($pages AS $page) {
		$database->setQuery("SELECT `published` FROM #__ezine_page WHERE id = '$page' LIMIT 0,1");
		$status = $database->loadResult();

		$database->setQuery("UPDATE #__ezine_page SET `published` = '".($status == 0 ? 1 : 0)."' WHERE id = '$page' LIMIT 1");
    	if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=managepage", _ERROR_QUERY_DB);
		}
	}

	mosRedirect("index2.php?option=$option&act=managepage");
}

// Functions act with SEF URL Management
function showSefUrl() {
	global $option, $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	// get the total number of records
	$database->setQuery("SELECT count(*) FROM #__ezine_sef WHERE 1");
	$total = $database->loadResult();

	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT * FROM #__ezine_sef"
	. "\n ORDER BY id LIMIT $pageNav->limitstart, $pageNav->limit";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	HTML_ezine::showSefUrl($rows, $pageNav);
}

function editSefUrl() {
	global $option, $func;
	$sefid = intval(mosGetParam($_GET, 'sefid', 0));
	if (!$sefid) {
		$cid = mosGetParam($_POST, 'cid', null);
		if (is_array($cid)) {
			$sefid = $cid[0];
		}
	}

	$row = '';
	if ($func == 'editsef') {
		global $database;
		$database->setQuery("SELECT * FROM #__ezine_sef WHERE id = '$sefid' LIMIT 0,1");
		$rows = $database->loadObjectList();
		$row = count($rows) ? $rows[0] : '';
	}

	HTML_ezine::editSefUrl($row);
}

function saveSefUrl() {
	global $option, $database;
	$sefid = intval(mosGetParam($_POST, 'sefid', 0));
	$original_url	= mosGetParam($_POST, 'original_url', '');
	$sef_url		= mosGetParam($_POST, 'sef_url', '');

	if ($sefid > 0) {
		$sql="UPDATE #__ezine_sef SET `original_url`='$original_url',`sef_url`='$sef_url' WHERE `id`='$sefid' LIMIT 1";
	} else {
		$sql="INSERT INTO #__ezine_sef (`original_url`,`sef_url`) VALUES ('$original_url','$sef_url')";
	}
	$database->setQuery($sql);
	if (!$database->query()) {
		mosRedirect("index2.php?option=$option&act=managesef", _ERROR_QUERY_DB);
	}
	mosRedirect("index2.php?option=$option&act=managesef", _SEF_URL_SAVED);
}

function removeSefUrl() {
	global $option, $database;
	$sefurls = mosGetParam($_POST, 'cid');
	if (!is_array($sefurls)) {
		mosRedirect("index2.php?option=$option&act=managesef", _INVALID_PARAMS);
	}

	$database->setQuery("DELETE FROM #__ezine_sef WHERE `id` IN ('".implode("', '", $sefurls)."')");
	if (!$database->query()) {
		mosRedirect("index2.php?option=$option&act=managepage", _ERROR_QUERY_DB);
	}

	mosRedirect("index2.php?option=$option&act=managesef", _SEF_URL_REMOVED);
}

// Functions act with Category Management
function showCategory() {
	global $option, $database, $mainframe, $mosConfig_list_limit;
	$pageid = intval(mosGetParam($_POST, 'page_id', 0));
	if (!$pageid) {
		$pageid = intval(mosGetParam($_GET, 'pageid', 0));
	}

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	// check if requested page exist or not, if not then select the first defined page
	$database->setQuery("SELECT id FROM #__ezine_page WHERE id = $pageid");
	if (!$database->loadResult()) {
		$database->setQuery("SELECT id FROM #__ezine_page WHERE 1 ORDER BY id LIMIT 0,1");
		if (!($pageid = $database->loadResult())) {
			mosRedirect("index2.php?option=$option&act=managepage", _ADD_AT_LEAST_ONE_PAGE_FIRST);
		}
	}

	// get the total number of records
	$database->setQuery("SELECT count(*) FROM #__ezine_category WHERE pageid='$pageid'");
	$total = $database->loadResult();

	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$database->setQuery("SELECT id AS value, menu_name AS `text` FROM #__ezine_page ORDER BY id");
	$secs = $database->loadObjectList();
	$seclist = mosHTML::selectList($secs, 'page_id', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $pageid);

	$query = "SELECT e.*,c.name AS cat_name,c.title AS cat_title,s.name AS sec_name,s.title AS sec_title"
	. "\n FROM #__ezine_category AS e"
	. "\n LEFT JOIN #__categories AS c ON e.content_type = 'category' AND c.id = e.contentid"
	. "\n LEFT JOIN #__sections AS s ON e.content_type = 'section' AND s.id = e.contentid"
	. "\n WHERE e.pageid = '$pageid'"
	. "\n ORDER BY e.ordering LIMIT $pageNav->limitstart, $pageNav->limit";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	HTML_ezine::showCategory($pageid, $rows, $pageNav, $seclist);
}

function addContent() {
	global $option;

	$page_id = intval(mosGetParam($_POST, 'page_id', 0));
	if (!$page_id) {
		$page_id = intval(mosGetParam($_POST, 'pageid', 0));
	}
	$content_type = mosGetParam($_POST, 'content_type', '');
	if (!$page_id) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	switch($content_type) {
		case 'section':
			addSection($page_id);
			break;
		case 'category':
			addCategory($page_id);
			break;
		default:
			HTML_ezine::selectContentType($page_id);
			break;
	}
}

function addSection($pageid) {
	global $option, $database, $my, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	// Not show categories already added to news page
	$fcatsql = "SELECT contentid FROM #__ezine_category WHERE pageid = '$pageid' AND `content_type` = 'section'";
	$database->setQuery($fcatsql);
	$fcats = $database->loadObjectList();
	if (count($fcats) > 0) {
		foreach ($fcats AS $fcat) {
			$fcats_id[] = "'$fcat->contentid'";
		}
	}

	// get the total number of records
	$database->setQuery("SELECT count(*) FROM #__sections WHERE scope='content'");
	$total = $database->loadResult();
	if (count($fcats) > 0) {
		$database->setQuery("SELECT count(*) FROM #__sections WHERE id IN (".(implode(',',$fcats_id)).")");
		$total = $total - $database->loadResult();
	}

	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT c.*"
	. "\n FROM #__sections AS c"
	. "\n LEFT JOIN #__content AS cc ON c.id = cc.sectionid"
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__groups AS g ON g.id = c.access"
	. "\n WHERE scope='content'"
	. ((count($fcats) > 0) ? "\n AND c.id NOT IN (".implode(',',$fcats_id).")" : '')
	. "\n GROUP BY c.id"
	. "\n ORDER BY c.ordering, c.name"
	. "\n LIMIT $pageNav->limitstart,$pageNav->limit"
	;
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$count = count($rows);
	// number of Active Items
	for ($i = 0; $i < $count; $i++) {
		$query = "SELECT COUNT(a.id)"
		. "\n FROM #__categories AS a"
		. "\n WHERE a.section = ". $rows[$i]->id
		. "\n AND a.published != '-2'"
		;
		$database->setQuery($query);
		$active = $database->loadResult();
		$rows[$i]->categories = $active;
	}
	// number of Active Items
	for ($i = 0; $i < $count; $i++) {
		$query = "SELECT COUNT(a.id)"
		. "\n FROM #__content AS a"
		. "\n WHERE a.sectionid = ". $rows[$i]->id
		. "\n AND a.state != '-2'"
		;
		$database->setQuery($query);
		$active = $database->loadResult();
		$rows[$i]->active = $active;
	}
	// number of Trashed Items
	for ($i = 0; $i < $count; $i++) {
		$query = "SELECT COUNT(a.id)"
		. "\n FROM #__content AS a"
		. "\n WHERE a.sectionid = ". $rows[$i]->id
		. "\n AND a.state = '-2'"
		;
		$database->setQuery($query);
		$trash = $database->loadResult();
		$rows[$i]->trash = $trash;
	}

	HTML_ezine::addSection($rows, $pageNav, $pageid);
}

function addCategory($pageid) {
	global $option, $database, $mainframe, $mosConfig_list_limit;

	$sectionid      = intval(mosGetParam($_POST, 'sectionid', 0));
	$limit 			= $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart 	= $mainframe->getUserStateFromRequest("view{content}limitstart", 'limitstart', 0);

	$content_add 	= '';
	$content_join 	= '';
	$order 			= "\n ORDER BY c.ordering, c.name";

	// Not show categories already added to news page
	$fcatsql = "SELECT contentid FROM #__ezine_category WHERE pageid = '$pageid' AND `content_type` = 'category'";
	$database->setQuery($fcatsql);
	$fcats = $database->loadObjectList();
	if (count($fcats) > 0) {
		foreach ($fcats AS $fcat) {
			$fcats_id[] = "'$fcat->contentid'";
		}
	}

	// used by filter
	if ($sectionid > 0) {
		$filter = "\n AND c.section = '$sectionid'";
	} else {
		$filter = '';
	}

	$table 			= 'content';
	$content_add 	= "\n , z.title AS section_name";
	$content_join 	= "\n LEFT JOIN #__sections AS z ON z.id = c.section";
	$where 			= "\n WHERE c.section NOT LIKE '%com_%'";
	$order 			= "\n ORDER BY c.section, c.ordering, c.name";
	// get the total number of records
	$database->setQuery("SELECT count(*) FROM #__categories INNER JOIN #__sections AS s ON s.id = section".(($filter != '') ? " WHERE section = '$sectionid'" : ''));
	$total = $database->loadResult();
	if (count($fcats) > 0) {
		$database->setQuery("SELECT count(*) FROM #__categories WHERE section NOT LIKE '%com_%' AND id IN (".(implode(',',$fcats_id)).")".(($filter != '') ? " AND section = '$sectionid'" : ''));
		$total = $total - $database->loadResult();
	}

	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT c.*"
	. $content_add
	. "\n FROM #__categories AS c"
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__groups AS g ON g.id = c.access"
	. "\n LEFT JOIN #__$table AS s2 ON s2.catid = c.id AND s2.checked_out > 0"
	. $content_join
	. $where
	. $filter
	. ((count($fcats) > 0) ? "\n AND c.id NOT IN (".implode(',',$fcats_id).")" : '')
	. "\n AND c.published != -2"
	. "\n GROUP BY c.id"
	. $order
	. "\n LIMIT $pageNav->limitstart, $pageNav->limit"
	;
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}

	$count = count($rows);
	// number of Active Items
	for ($i = 0; $i < $count; $i++) {
		$query = "SELECT COUNT(a.id)"
		. "\n FROM #__content AS a"
		. "\n WHERE a.catid = ". $rows[$i]->id
		. "\n AND a.state != '-2'"
		;
		$database->setQuery($query);
		$active = $database->loadResult();
		$rows[$i]->active = $active;
	}
	// number of Trashed Items
	for ($i = 0; $i < $count; $i++) {
		$query = "SELECT COUNT(a.id)"
		. "\n FROM #__content AS a"
		. "\n WHERE a.catid = ". $rows[$i]->id
		. "\n AND a.state = '-2'"
		;
		$database->setQuery($query);
		$trash = $database->loadResult();
		$rows[$i]->trash = $trash;
	}

	// get list of sections for dropdown filter
	$database->setQuery("SELECT id AS value, `title` AS `text` FROM #__sections ORDER BY id");
	$secs = $database->loadObjectList();
	$addon[] = mosHTML::makeOption('0', '- Select Section -');
	$secs = array_merge($addon, $secs);
	$lists = mosHTML::selectList($secs, 'sectionid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $sectionid);

	HTML_ezine::addCategory($rows, $pageNav, $lists, $pageid);
}

function addContentToPage() {
	global $option, $database;
	$cid = mosGetParam($_POST, 'cid');
	$pageid = intval(mosGetParam($_POST, 'pageid', 0));
	$content_type = mosGetParam($_POST, 'content_type', '');
	if (!is_array($cid) OR !$pageid OR $content_type == '') {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	$query = "SELECT ordering FROM #__ezine_category WHERE pageid='$pageid' ORDER BY ordering DESC LIMIT 0,1";
	$database->setQuery($query);
	$total = $database->loadResult();

	foreach ($cid AS $id) {
		$total++;
		$query = "INSERT INTO #__ezine_category (`pageid`,`contentid`,`content_type`,`ordering`,`params`) VALUES ('$pageid','$id','$content_type','$total','')";
		$database->setQuery($query);
		if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
		}
		if ($content_type == 'section' OR $content_type == 'category') {
			$database->setQuery("SELECT id FROM #__ezine_category WHERE `pageid` = '$pageid' AND `contentid` = '$id' AND `content_type` = '$content_type' AND `ordering` = '$total' AND `params` = '' LIMIT 0,1");
			$catid = $database->loadResult();
			$more_news_link = 'index.php?option='.$option.'&task=view&page='.$pageid.'&category='.$catid;
			$menutype = 'ezinemenu';

			// check if exist?
			$database->setQuery("SELECT id FROM #__menu WHERE link = '$more_news_link' AND menutype = '$menutype' AND published > -2 LIMIT 0,1");
			if (!($item_id = $database->loadResult())) {
				$database->setQuery("SELECT ordering FROM #__menu WHERE menutype = '$menutype' ORDER BY ordering DESC LIMIT 0,1");
				$highest = $database->loadResult() + 1;
				$database->setQuery("SELECT name FROM #__".($content_type == 'section' ? 'sections' : 'categories')." WHERE id = $id LIMIT 0,1");
				$cat_name = $database->loadResult();
				$database->setQuery("INSERT INTO #__menu (`menutype`,`name`,`link`,`type`,`published`,`ordering`)"
				. "\n VALUES ('$menutype','".str_replace('%CAT_NAME%', $cat_name, _MORE_CATEGORY_NEWS)."','$more_news_link','url','1','$highest');"
);
				if (!$database->query()) {
					mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
				}
			}
		}
	}

	mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid");
}

function editCategory() {
	global $option, $database;
	$cat = intval(mosGetParam($_GET, 'catid', 0));
	$pageid = intval(mosGetParam($_REQUEST, 'pageid', 0));
	if (!$cat) {
		$cid = mosGetParam($_POST, 'cid');
		if (is_array($cid)) {
			$cat = $cid[0];
		}
	}
	if (!$pageid OR !$cat) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	$database->setQuery("SELECT contentid,`content_type` FROM #__ezine_category WHERE id = '$cat' LIMIT 0,1");
	if (!$database->loadObject($detect)) {
		mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _REQUESTED_CAT_NOT_EXIST);
	}
	if ($detect->content_type == 'separator') {
		mosRedirect("index2.php?option=$option&act=editseparator&pageid=$pageid&separatorid=$detect->contentid");
	} else {
		if ($detect->content_type == 'category') {
			$query = "SELECT e.*, cat.name, cat.title FROM #__ezine_category AS e LEFT JOIN #__categories AS cat ON cat.id = e.contentid WHERE e.id = '$cat' LIMIT 0,1";
			$database->setQuery($query);
			if (!$database->loadObject($row)) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
		} elseif ($detect->content_type == 'section') {
			$query = "SELECT e.*, sec.name, sec.title FROM #__ezine_category AS e LEFT JOIN #__sections AS sec ON sec.id = e.contentid WHERE e.id = '$cat' LIMIT 0,1";
			$database->setQuery($query);
			if (!$database->loadObject($row)) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
		}

		$params =& new mosParameters($row->params);
		$params->def('show_cat_title', 1);

		$params->def('words_count', 0);
		$params->def('leading_news', 1);
		$params->def('intro_news', 2);
		$params->def('intro_cols', 2);
		$params->def('links', 5);
		$params->def('link_cols', 1);

		$params->def('linked_cat_title', 0);
		$params->def('frontpage_only', 0);
		$params->def('intro_only', 1);
		$params->def('order_news_by', 'rdate');
		$params->def('show_more_cat_news', 1);

		$params->def('leading_thumbnail_position', '');
		$params->def('intro_thumbnail_position', '');
		$params->def('cat_title_img', '');
		$params->def('more_cat_news_img', '');
		$params->def('intro_with_img', 1);
		$params->def('link_with_img', 1);

		$params->def('morein_pageclass_sfx', '');
		$params->def('morein_back_button', 1);

		$params->def('morein_article_title', 1);
		$params->def('morein_article_title_linkable', 1);
		$params->def('morein_category_title', 0);
		$params->def('morein_category_title_linkable', 0);
		$params->def('morein_section_title', 0);
		$params->def('morein_section_title_linkable', 0);

		$params->def('morein_readmore', 1);
		$params->def('morein_rating', 0);
		$params->def('morein_author', 1);
		$params->def('morein_createdate', 1);
		$params->def('morein_modifydate', 0);

		$params->def('morein_pdf', 1);
		$params->def('morein_print', 1);
		$params->def('morein_email', 1);

		$params->def('morein_show_cat_title', $params->get('show_cat_title'));
		$params->def('morein_leading_thumbnail_position', $params->get('leading_thumbnail_position'));
		$params->def('morein_intro_thumbnail_position', $params->get('intro_thumbnail_position'));

		$params->def('morein_leading_news', $params->get('leading_news'));
		$params->def('morein_intro_news', $params->get('intro_news'));
		$params->def('morein_intro_cols', $params->get('intro_cols'));
		$params->def('morein_links', $params->get('links'));
		$params->def('morein_link_cols', $params->get('link_cols'));

		HTML_ezine::editCategory($cat, $row, $params, $pageid);
	}
}

function saveCategory() {
	global $option, $database;
	$pageid = intval(mosGetParam($_POST, 'pageid', 0));
	$catid = intval(mosGetParam($_POST, 'catid', 0));
	$params = mosGetParam($_POST, 'params');
	if (!$pageid OR !$catid OR !is_array($params)) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	foreach ($params AS $k=>$v) {
		$p[] = "$k=$v";
	}
	$params = implode("\n", $p);
	$sql="UPDATE #__ezine_category SET `params`='$params' WHERE id = '$catid' LIMIT 1";
	$database->setQuery($sql);
	if (!$database->query()) {
		mosRedirect("index2.php?option=$option&act=editcat&pageid=$pageid&catid=$catid", _ERROR_QUERY_DB);
	}

	mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _CAT_PARAMS_SAVED);
}

function removeCategory() {
	global $option, $database;
	$cid = mosGetParam($_POST, 'cid');
	$pageid = intval(mosGetParam($_POST, 'pageid'));
	if (!is_array($cid)) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	foreach ($cid AS $cat) {
		$query = "SELECT contentid,`content_type`,params FROM #__ezine_category WHERE id='$cat' LIMIT 0,1";
		$database->setQuery($query);
		$database->loadObject($detect);
		if ($detect->content_type == 'separator') {
			$database->setQuery("DELETE FROM #__ezine_separator WHERE id = '$detect->contentid'");
			if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
		} elseif ($detect->content_type == 'section' OR $detect->content_type == 'category') {
			$database->setQuery("SELECT id FROM #__ezine_category WHERE `pageid` = '$pageid' AND `contentid` = '$detect->contentid' AND `content_type` = '$detect->content_type' LIMIT 0,1");
			$catid = $database->loadResult();
			$more_news_link = 'index.php?option='.$option.'&task=view&page='.$pageid.'&category='.$catid;
			$menutype = 'ezinemenu';

			// check if exist?
			$database->setQuery("DELETE FROM #__menu WHERE link = '$more_news_link' AND menutype = '$menutype' AND published > -2 LIMIT 1");
			if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
		}
		$database->setQuery("DELETE FROM #__ezine_category WHERE id = '$cat'");
		if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
		}
	}

	mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid");
}

function swapCategoryStatus() {
	global $option, $database;
	$pageid = intval(mosGetParam($_POST, 'pageid', 0));
	$cats = mosGetParam($_POST, 'cid');
	if (!$pageid OR !is_array($cats)) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	foreach ($cats AS $cat) {
		$database->setQuery("SELECT `published` FROM #__ezine_category WHERE id = '$cat' LIMIT 0,1");
		$status = $database->loadResult();

		$database->setQuery("UPDATE #__ezine_category SET `published` = '".($status == 0 ? 1 : 0)."' WHERE id = '$cat' LIMIT 1");
    	if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
		}
	}

	mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid");
}

function reorderCategories($direction = 1) {
	global $option, $database;
	$cid = mosGetParam($_POST, 'cid');
	if (is_array($cid)) {
		$catid = $cid[0];
	}
	$pageid = intval(mosGetParam($_POST, 'pageid', 0));
	if (!isset($catid) OR !$pageid) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	$database->setQuery("SELECT `ordering` FROM #__ezine_category WHERE id = '$catid' LIMIT 0,1");
	$row1 = $database->loadObjectList();

	if ($direction == -1) $neworder = $row1[0]->ordering - 1;
	elseif ($direction == 1) $neworder = $row1[0]->ordering + 1;

	$database->setQuery("SELECT `id` FROM #__ezine_category WHERE `ordering` = '$neworder' AND pageid = '$pageid' LIMIT 0,1");
	$row2 = $database->loadObjectList();

	$database->setQuery("UPDATE #__ezine_category SET `ordering` = '".$row1[0]->ordering."' WHERE id = '".$row2[0]->id."' LIMIT 1");
    if (!$database->query()) {
		mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
	}

	$database->setQuery("UPDATE #__ezine_category SET `ordering` = '$neworder' WHERE id = '$catid' LIMIT 1");
    if (!$database->query()) {
		mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
	}

	mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid");
}

function saveCategoriesOrder() {
	global $option, $database;
	$cid = mosGetParam($_POST, 'cid');
	$pageid = intval(mosGetParam($_POST, 'pageid', 0));
	if (!is_array($cid) OR !$pageid) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	$total		= count($cid);
	$order 		= mosGetParam($_POST, 'order', array(0));

    // update ordering values
	for($i=0; $i < $total; $i++) {
		$database->setQuery("SELECT `ordering` FROM #__ezine_category WHERE id = '$cid[$i]' LIMIT 0,1");
		$row = $database->loadObjectList();
		if ($row[0]->ordering != $order[$i]) {
			$database->setQuery("UPDATE #__ezine_category SET `ordering` = '$order[$i]' WHERE id = '$cid[$i]' LIMIT 1");
	        if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
	        }
		}
	}

	mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid");
}

// Functions act with Newsletter Management
function showNewsletter() {
	global $option, $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	// get the total number of records
	$database->setQuery("SELECT count(*) FROM #__ezine_newsletter_contents WHERE 1");
	$total = $database->loadResult();

	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT nc.*,CONCAT(m.menutype,' - ',m.name) AS menu_name FROM #__ezine_newsletter_contents AS nc"
	. "\n LEFT JOIN #__menu AS m ON m.id = nc.page_id"
	. "\n LIMIT $pageNav->limitstart, $pageNav->limit";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	HTML_ezine::showNewsletter($rows, $pageNav);
}

function editNewsletter() {
	global $option, $database, $func;
	$nid = intval(mosGetParam($_GET, 'nid', 0));
	if (!$nid) {
		$cid = mosGetParam($_POST, 'cid');
		if (is_array($cid)) {
			$nid = $cid[0];
		}
	}

	// build eZine menu links list
	$database->setQuery("SELECT id AS value,CONCAT(menutype,' - ',name) AS `text` FROM #__menu WHERE link = 'index.php?option=$option' AND params LIKE '%page_id=%' AND published > -2 ORDER BY id");
	$pages = $database->loadObjectList();
	if (!count($pages)) {
		mosRedirect("index2.php?option=$option&act=managepage", _ADD_AT_LEAST_ONE_PAGE_FIRST);
	}
	$tmp[] = mosHTML::makeOption('0', '- '._SELECT_PAGE.' -');
	$pages = array_merge($tmp, $pages);

	// build Joomla templates list
	$templateBaseDir = mosPathName(_D4J_PRODUCT_FRONTEND_PATH.'/../../templates');
	// Read the template dir to find templates
	$templateDirs		= mosReadDirectory($templateBaseDir);
	$database->setQuery("SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'");
	$cur_template = $database->loadResult();
	$i = 0;
	foreach ($templateDirs AS $templateDir) {
		if (is_dir($templateBaseDir . '/' . $templateDir)) {
			$templates[$i]->value = $templateDir;
			$templates[$i]->text = $templateDir;
			$i++;
		}
	}

	if ($func == 'editletter') {
		// check if requested newsletter exist or not
		$database->setQuery("SELECT id FROM #__ezine_newsletter_contents WHERE id = $nid");
		if (!$database->loadResult()) {
			mosRedirect("index2.php?option=$option&act=manageletter", _REQUESTED_LETTER_NOT_EXIST);
		}

		$query = "SELECT * FROM #__ezine_newsletter_contents"
		. "\n WHERE id = '$nid' LIMIT 0,1";
		$database->setQuery($query);
		$database->loadObject($row);
		$params =& new mosParameters($row->params);

		$lists['pages'] = mosHTML::selectList($pages, 'item_id', 'class="inputbox" size="1" onchange="if (this.value != \'0\') call_getNewsletterContent(this.value, document.adminForm.template_name.value);"', 'value', 'text', $row->page_id);
		$lists['templates'] = mosHTML::selectList($templates, 'template_name', 'class="inputbox" size="1" onchange="if (document.adminForm.item_id.value != \'0\') call_getNewsletterContent(document.adminForm.item_id.value, this.value);"', 'value', 'text', $params->get('template_name', $cur_template));
	} else {
		$row = '';
		$params = '';

		$lists['pages'] = mosHTML::selectList($pages, 'item_id', 'class="inputbox" size="1" onchange="if (this.value != \'0\') call_getNewsletterContent(this.value, document.adminForm.template_name.value);"', 'value', 'text');
		$lists['templates'] = mosHTML::selectList($templates, 'template_name', 'class="inputbox" size="1" onchange="if (document.adminForm.item_id.value != \'0\') call_getNewsletterContent(document.adminForm.item_id.value, this.value);"', 'value', 'text', $cur_template);
	}

	HTML_ezine::editNewsletter($func, $nid, $row, $params, $lists);
}

function saveNewsletter() {
	global $option, $database;

	$nid = mosGetParam($_POST, 'nid', 0);

	$item_id = mosGetParam($_POST, 'item_id', 0);
	$params = 'template_name='.mosGetParam($_POST, 'template_name', '');

	$newsletter_content = str_replace("'", "\\'", stripslashes(mosGetParam($_POST, 'newsletter_content', '', _MOS_ALLOWHTML)));
	$newsletter_content = str_replace("\\\\'", "\\'", $newsletter_content);

	if ($nid > 0) {
		$sql="UPDATE #__ezine_newsletter_contents SET `page_id`='$item_id',`date_created`='".date("Y-m-d H:i:s")."',`content`='$newsletter_content',`params`='$params' WHERE `id`='$nid' LIMIT 1";
	} else {
		$sql="INSERT INTO #__ezine_newsletter_contents (`page_id`,`date_created`,`content`,`params`) VALUES ('$item_id','".date("Y-m-d H:i:s")."','$newsletter_content','$params')";
	}
	$database->setQuery($sql);
	if (!$database->query()) {
		mosRedirect("index2.php?option=$option&act=manageletter", _ERROR_QUERY_DB);
	} else {
		mosRedirect("index2.php?option=$option&act=manageletter");
	}
}

function removeNewsletter() {
	global $option, $database;
	$cid = mosGetParam($_POST, 'cid');
	if (!is_array($cid)) {
		mosRedirect("index2.php?option=$option&act=manageletter", _INVALID_PARAMS);
	}

	foreach ($cid AS $letter) {
		$database->setQuery("DELETE FROM #__ezine_newsletter_contents WHERE `id`='$letter'");
		if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=manageletter", _ERROR_QUERY_DB);
		}
	}

	mosRedirect("index2.php?option=$option&act=manageletter");
}

function showSubscribers() {
	global $option, $database, $mainframe, $mosConfig_list_limit;

	$pageid = mosGetParam($_POST, 'pages', 0);
	if ($pageid == 0) {
		$where = "nu.subcribed_pages != ''";
	} else {
		$where = "(nu.subcribed_pages = '$pageid' OR nu.subcribed_pages LIKE '$pageid,%' OR nu.subcribed_pages LIKE '%,$pageid,%' OR nu.subcribed_pages LIKE '%,$pageid')";
	}

	$filter = mosGetParam($_POST, 'filter', '');
	if ($filter != '') {
		$where .= " AND ((nu.uid = 0 AND (nu.name LIKE '%$filter%' OR nu.email LIKE '%$filter%')) OR (nu.uid > 0 AND (u.name LIKE '%$filter%' OR u.email LIKE '%$filter%')))";
	}

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);
	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');

	// get the total number of records
	$database->setQuery("SELECT count(*) AS total"
	. "\n FROM #__ezine_newsletter_users AS nu"
	. "\n LEFT JOIN #__users AS u ON nu.uid > 0 AND u.id = nu.uid"
	. "\n WHERE $where");
	$total = $database->loadResult();
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$database->setQuery("SELECT id AS value, menu_name AS `text` FROM #__ezine_page ORDER BY id");
	$secs = $database->loadObjectList();
	$tmp[] = mosHTML::makeOption('0', '- '._SELECT_PAGE.' -');
	$secs = array_merge($tmp, $secs);
	$seclist = mosHTML::selectList($secs, 'pages', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $pageid);

	$query = "SELECT nu.*,u.name AS u_name,u.email AS u_email"
	. "\n FROM #__ezine_newsletter_users AS nu"
	. "\n LEFT JOIN #__users AS u ON nu.uid > 0 AND u.id = nu.uid"
	. "\n WHERE $where"
	. "\n ORDER BY nu.id LIMIT $pageNav->limitstart, $pageNav->limit";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	for ($i = 0, $n = count($rows); $i < $n; $i++) {
		$row = &$rows[$i];
		$database->setQuery("SELECT menu_name FROM #__ezine_page WHERE id IN (".$row->subcribed_pages.")");
		$subscribed_pages = $database->loadObjectList();
		$subscribed_list = '';
		foreach ($subscribed_pages AS $subscribed_page) {
			$subscribed_list .= $subscribed_page->menu_name.', ';
		}
		$subscribed_list = substr($subscribed_list, 0, strlen($subscribed_list) - 2);
		$row->subcribed_pages = $subscribed_list;
	}

	HTML_ezine::showSubscribers($rows, $pageNav, $seclist);
}

function addUsers() {
	global $option, $database;
	$users = mosGetParam($_POST, 'users', '');
	$pages = mosGetParam($_POST, 'pages', '');
	if (is_array($users) AND is_array($pages)) {
		foreach ($users AS $user) {
			$database->setQuery("SELECT id FROM #__ezine_newsletter_users WHERE uid = '$user'");
			$check = $database->loadResult();
			if (is_numeric($check)) {
				$query = "UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $pages)."' WHERE id = '$check' LIMIT 1";
			} else {
				$query = "INSERT INTO #__ezine_newsletter_users (uid,subcribed_pages,date_join) VALUES ('$user','".implode(',', $pages)."','".date("Y-m-d H:i:s")."')";
			}
			$database->setQuery($query);
			if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=manageusers", _ERROR_QUERY_DB);
			}
		}
	} else {
		mosRedirect("index2.php?option=$option&act=manageusers", _SELECT_USER_PAGE_FIRST);
	}
	mosRedirect("index2.php?option=$option&act=manageusers");
}

function removeUsers() {
	global $option, $database;
	$cid = mosGetParam($_POST, 'cid');
	if (!is_array($cid)) {
		mosRedirect("index2.php?option=$option&act=manageletter", _INVALID_PARAMS);
	}

	foreach ($cid AS $user) {
		$database->setQuery("DELETE FROM #__ezine_newsletter_users WHERE `id`='$user'");
		if (!$database->query()) {
			mosRedirect("index2.php?option=$option&act=manageusers", _ERROR_QUERY_DB);
		}
	}

	mosRedirect("index2.php?option=$option&act=manageusers");
}

function sendNewsletter() {
	global $option, $database;
	$cid = mosGetParam($_POST, 'cid');
	if (!is_array($cid)) {
		mosRedirect("index2.php?option=$option&act=manageletter", _INVALID_PARAMS);
	} else {
		$letter = $cid[0];
	}

	$database->setQuery("SELECT page_id FROM #__ezine_newsletter_contents WHERE id = '$letter' LIMIT 0,1");
	$item_id = $database->loadResult();
	$database->setQuery("SELECT params FROM #__menu WHERE id = '$item_id' LIMIT 0,1");
	$params =& new mosParameters($database->loadResult());
	$page_id = intval($params->get('page_id', 0));
	$database->setQuery("SELECT COUNT(id) FROM #__ezine_newsletter_users WHERE `subcribed_pages` = '$page_id' OR `subcribed_pages` LIKE '$page_id,%' OR `subcribed_pages` LIKE '%,$page_id,%' OR `subcribed_pages` LIKE '%,$page_id'");
	$total_subscribers = $database->loadResult();

	if (!$total_subscribers) {
		mosRedirect("index2.php?option=$option&act=manageletter", _PAGE_HAS_NO_SUBSCRIBER);
	} else {
		HTML_ezine::sendNewsletter($letter, $total_subscribers);
	}
}

// Functions act with editing CSS / Language file
function editCSS() {
	global $option;
	if ($fp = fopen(_D4J_PRODUCT_FRONTEND_PATH.'/css/ezine.css', "r")) {
		$content = fread($fp, filesize(_D4J_PRODUCT_FRONTEND_PATH.'/css/ezine.css'));
		$content = htmlspecialchars($content);
		fclose($fp);
		HTML_ezine::editCSS($content);
	} else {
		mosRedirect("index2.php?option=$option", _CANNOT_OPEN_CSS_FILE);
	}
}

function saveCSS() {
	global $option;
	$filecontent = mosGetParam($_POST, 'filecontent', '', _MOS_ALLOWHTML);
	if (!$filecontent) {
		mosRedirect("index2.php?option=$option&act=editcss", _CSS_CONTENT_EMPTY);
	}

	$file = _D4J_PRODUCT_FRONTEND_PATH.'/css/ezine.css';
    $enable_write = mosGetParam($_POST,'enable_write',0);
	$oldperms = fileperms($file);
	if ($enable_write) @chmod($file, $oldperms | 0222);

	clearstatcache();
	if (is_writable($file) == false) {
		mosRedirect("index2.php?option=$option&act=editcss", _FILE_NOT_WRITABLE);
	}

	if ($fp = fopen ($file, "w")) {
		fputs($fp, stripslashes($filecontent));
		fclose($fp);
		if ($enable_write) {
			@chmod($file, $oldperms);
		} else {
			if (mosGetParam($_POST,'disable_write',0))
				@chmod($file, $oldperms & 0777555);
		} // if
		mosRedirect('index2.php?option='.$option.'&act=editcss', str_replace('%FILE_NAME%', 'ezine.css', _FILE_SAVED));
	} else {
		if ($enable_write) @chmod($file, $oldperms);
		mosRedirect("index2.php?option=$option&act=editcss", _CANNOT_OPEN_FILE_TO_WRITE);
	}
}

function editLang() {
	global $option, $mosConfig_lang;
	if(file_exists(_D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php'))
		$file = _D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php';
	else
		if (!copy(_D4J_PRODUCT_FRONTEND_PATH.'/language/english.php', _D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php'))
			$file = _D4J_PRODUCT_FRONTEND_PATH.'/language/english.php';
		else
			$file = _D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php';
	if ($fp = fopen($file, "r")) {
		$content = fread($fp, filesize($file));
		$content = htmlspecialchars($content);
		fclose($fp);
		HTML_ezine::editLang($content);
	} else {
		mosRedirect("index2.php?option=$option", _CANNOT_OPEN_LANG_FILE);
	}
}

function saveLang() {
	global $option, $mosConfig_lang;

	$filecontent = mosGetParam($_POST, 'filecontent', '', _MOS_ALLOWHTML);
	if (!$filecontent) {
		mosRedirect("index2.php?option=$option&act=editlang", _LANG_CONTENT_EMPTY);
	}

	$file = _D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php';
    $enable_write = mosGetParam($_POST,'enable_write',0);
	$oldperms = fileperms($file);
	if ($enable_write) @chmod($file, $oldperms | 0222);

	clearstatcache();
	if (is_writable($file) == false) {
		mosRedirect("index2.php?option=$option&act=editlang", _FILE_NOT_WRITABLE);
	}

	if ($fp = fopen ($file, "w")) {
		fputs($fp, stripslashes($filecontent));
		fclose($fp);
		if ($enable_write) {
			@chmod($file, $oldperms);
		} else {
			if (mosGetParam($_POST,'disable_write',0))
				@chmod($file, $oldperms & 0777555);
		} // if
		mosRedirect('index2.php?option='.$option.'&act=editlang', str_replace('%FILE_NAME%', $mosConfig_lang.'.php', _FILE_SAVED));
	} else {
		if ($enable_write) @chmod($file, $oldperms);
		mosRedirect("index2.php?option=$option&act=editlang", _CANNOT_OPEN_FILE_TO_WRITE);
	}
}

// Functions act with adding separator between categories in news page
function addSeparator() {
	global $option;
	$page_id = intval(mosGetParam($_POST, 'page_id', 0));
	if (!$page_id) {
		$page_id = intval(mosGetParam($_POST, 'pageid', 0));
	}
	$separator_type = mosGetParam($_POST, 'separator_type', '');
	if (!$page_id) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	switch($separator_type) {
		case 'content_item':
			if (!isset($sectionid)) $sectionid = 0;
			viewContentD($sectionid, $page_id);
			break;
		case 'static_content':
			viewContentS($page_id);
			break;
		case 'html_code':
			HTML_ezine::htmlSeparator($page_id);
			break;
		default:
			HTML_ezine::selectSeparatorType($page_id);
			break;
	}
}

function editSeparator() {
	global $option, $database;
	$separator_id = intval(mosGetParam($_GET, 'separatorid', 0));
	$page_id = intval(mosGetParam($_GET, 'pageid', 0));
	if (!$separator_id OR !$page_id) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	$database->setQuery("SELECT * FROM #__ezine_separator WHERE id = '$separator_id' LIMIT 0,1");
	if (!$database->loadObject($row)) {
		mosRedirect("index2.php?option=$option&act=managecat&pageid=$page_id", _ERROR_QUERY_DB);
	}
	if ($row->type != 'html_code') {
		mosRedirect("index2.php?option=$option&act=managecat&pageid=$page_id", _EDIT_HTML_SEPARATOR_ONLY);
	}
	HTML_ezine::htmlSeparator($page_id, $separator_id, $row->html_code);
}

function viewContentD($sectionid, $page_id) {
	global $option, $database, $mainframe, $mosConfig_list_limit;

	$catid 				= $mainframe->getUserStateFromRequest("catid{$option}{$sectionid}", 'catid', 0);
	$filter_authorid 	= $mainframe->getUserStateFromRequest("filter_authorid{$option}{$sectionid}", 'filter_authorid', 0);
	$filter_sectionid 	= $mainframe->getUserStateFromRequest("filter_sectionid{$option}{$sectionid}", 'filter_sectionid', 0);
	$limit 				= $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart 		= $mainframe->getUserStateFromRequest("view{$option}{$sectionid}limitstart", 'limitstart', 0);
	$search 			= $mainframe->getUserStateFromRequest("search{$option}{$sectionid}", 'search', '');
	$search 			= $database->getEscaped(trim(strtolower($search)));
	$redirect 			= $sectionid;
	$filter 			= ''; //getting a undefined variable error

	if ($sectionid == 0) {
		// used to show All content items
		$where = array(
		"c.state >= 0",
		"c.catid=cc.id",
		"cc.section=s.id",
		"s.scope='content'",
);
		$order = "\n ORDER BY s.title, c.catid, cc.ordering, cc.title, c.ordering";
		$all = 1;
		//$filter = "\n , #__sections AS s WHERE s.id = c.section";

		if ($filter_sectionid > 0) {
		    $filter = "\nWHERE cc.section=$filter_sectionid";
		}
		$section->title = 'All Content Items';
		$section->id = 0;
	} else {
		$where = array(
		"c.state >= 0",
		"c.catid=cc.id",
		"cc.section=s.id",
		"s.scope='content'",
		"c.sectionid='$sectionid'"
);
		$order = "\n ORDER BY cc.ordering, cc.title, c.ordering";
		$all = NULL;
		$filter = "\n WHERE cc.section = '$sectionid'";
		$section = new mosSection($database);
		$section->load($sectionid);
	}

	// used by filter
	if ($filter_sectionid > 0) {
		$where[] = "c.sectionid = '$filter_sectionid'";
	}
	if ($catid > 0) {
		$where[] = "c.catid = '$catid'";
	}
	if ($filter_authorid > 0) {
		$where[] = "c.created_by = '$filter_authorid'";
	}

	if ($search) {
		$where[] = "LOWER(c.title) LIKE '%$search%'";
	}

	// get the total number of records
	$database->setQuery("SELECT count(*) FROM #__content AS c, #__categories AS cc, #__sections AS s"
	. (count($where) ? "\nWHERE " . implode(' AND ', $where) : "")
);
	$total = $database->loadResult();
	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT c.*, g.name AS groupname, cc.name, u.name AS editor, f.content_id AS frontpage, s.title AS section_name, v.name AS author"
	. "\n FROM #__categories AS cc, #__sections AS s, #__content AS c"
	. "\n LEFT JOIN #__groups AS g ON g.id = c.access"
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__users AS v ON v.id = c.created_by"
	. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = c.id"
	. (count($where) ? "\nWHERE " . implode(' AND ', $where) : '')
	. $order
	. "\n LIMIT $pageNav->limitstart,$pageNav->limit"
	;
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// get list of categories for dropdown filter
	$query = "SELECT cc.id AS value, cc.title AS `text`, section"
	. "\n FROM #__categories AS cc"
	. "\n INNER JOIN #__sections AS s ON s.id=cc.section "
	. $filter
	. "\n ORDER BY s.ordering, cc.ordering"
	;
	$lists['catid'] 	= filterCategory($query, $catid);

	// get list of sections for dropdown filter
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sectionid']	= mosAdminMenus::SelectSection('filter_sectionid', $filter_sectionid, $javascript);

	// get list of Authors for dropdown filter
	$query = "SELECT c.created_by AS value, u.name AS `text`"
	. "\n FROM #__content AS c"
	. "\n INNER JOIN #__sections AS s ON s.id = c.sectionid"
	. "\n LEFT JOIN #__users AS u ON u.id = c.created_by"
	. "\n WHERE c.state != '-1'"
	. "\n AND c.state != '-2'"
	. "\n GROUP BY u.name"
	. "\n ORDER BY u.name"
	;
	$authors[] = mosHTML::makeOption('0', _SEL_AUTHOR);
	$database->setQuery($query);
	$authors = array_merge($authors, $database->loadObjectList());
	$lists['authorid']	= mosHTML::selectList($authors, 'filter_authorid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter_authorid);

	HTML_ezine::showContentItem($rows, $section, $lists, $search, $pageNav, $all, $page_id);
}

function filterCategory($query, $active=NULL) {
	global $option, $database;

	$categories[] = mosHTML::makeOption('0', _SEL_CATEGORY);
	$database->setQuery($query);
	$categories = array_merge($categories, $database->loadObjectList());

	$category = mosHTML::selectList($categories, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $active);

	return $category;
}

function viewContentS($page_id) {
	global $option, $database, $mainframe, $mosConfig_list_limit;

	$filter_authorid 	= $mainframe->getUserStateFromRequest("filter_authorid{$option}", 'filter_authorid', 0);
	$order 				= $mainframe->getUserStateFromRequest("zorder", 'zorder', 'c.ordering DESC');
	$limit 				= $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart 		= $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);
	$search 			= $mainframe->getUserStateFromRequest("search{$option}", 'search', '');
	$search 			= $database->getEscaped(trim(strtolower($search)));

	// used by filter
	if ($search) {
		$search_query = "\n AND (LOWER(c.title) LIKE '%$search%' OR LOWER(c.title_alias) LIKE '%$search%')";
	} else {
		$search_query = '';
	}

	$filter = '';
	if ($filter_authorid > 0) {
		$filter = "\n AND c.created_by = '$filter_authorid'";
	}

	// get the total number of records
	$query = "SELECT count(*)"
	. "\n FROM #__content AS c"
	. "\n WHERE c.sectionid = '0'"
	. "\n AND c.catid = '0'"
	. "\n AND c.state != '-2'"
	. $filter
	;
	$database->setQuery($query);
	$total = $database->loadResult();
	require_once(_D4J_PRODUCT_BACKEND_PATH.'/../../includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT c.*, g.name AS groupname, u.name AS editor, z.name AS creator"
	. "\n FROM #__content AS c"
	. "\n LEFT JOIN #__groups AS g ON g.id = c.access"
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__users AS z ON z.id = c.created_by"
	. "\n WHERE c.sectionid = '0'"
	. "\n AND c.catid = '0'"
	. "\n AND c.state != '-2'"
	. $search_query
	. $filter
	. "\n ORDER BY ". $order
	. "\n LIMIT $pageNav->limitstart,$pageNav->limit"
	;
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$count = count($rows);
	for($i = 0; $i < $count; $i++) {
		$query = "SELECT COUNT(id)"
		. "\n FROM #__menu"
		. "\n WHERE componentid = ". $rows[$i]->id
		. "\n AND type = 'content_typed'"
		. "\n AND published != '-2'"
		;
		$database->setQuery($query);
		$rows[$i]->links = $database->loadResult();
	}

	$ordering[] = mosHTML::makeOption('c.ordering ASC', 'Ordering asc');
	$ordering[] = mosHTML::makeOption('c.ordering DESC', 'Ordering desc');
	$ordering[] = mosHTML::makeOption('c.id ASC', 'ID asc');
	$ordering[] = mosHTML::makeOption('c.id DESC', 'ID desc');
	$ordering[] = mosHTML::makeOption('c.title ASC', 'Title asc');
	$ordering[] = mosHTML::makeOption('c.title DESC', 'Title desc');
	$ordering[] = mosHTML::makeOption('c.created ASC', 'Date asc');
	$ordering[] = mosHTML::makeOption('c.created DESC', 'Date desc');
	$ordering[] = mosHTML::makeOption('z.name ASC', 'Author asc');
	$ordering[] = mosHTML::makeOption('z.name DESC', 'Author desc');
	$ordering[] = mosHTML::makeOption('c.state ASC', 'Published asc');
	$ordering[] = mosHTML::makeOption('c.state DESC', 'Published desc');
	$ordering[] = mosHTML::makeOption('c.access ASC', 'Access asc');
	$ordering[] = mosHTML::makeOption('c.access DESC', 'Access desc');
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['order'] = mosHTML::selectList($ordering, 'zorder', 'class="inputbox" size="1"'. $javascript, 'value', 'text', $order);

	// get list of Authors for dropdown filter
	$query = "SELECT c.created_by AS value, u.name AS `text`"
	. "\n FROM #__content AS c"
	. "\n LEFT JOIN #__users AS u ON u.id = c.created_by"
	. "\n WHERE c.sectionid = 0"
	. "\n GROUP BY u.name"
	. "\n ORDER BY u.name"
	;
	$authors[] = mosHTML::makeOption('0', _SEL_AUTHOR);
	$database->setQuery($query);
	$authors = array_merge($authors, $database->loadObjectList());
	$lists['authorid']	= mosHTML::selectList($authors, 'filter_authorid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter_authorid);

	HTML_ezine::showStaticContent($rows, $pageNav, $search, $lists, $page_id);
}

function saveSeparator() {
	global $option, $database;
	$separator_type = mosGetParam($_POST, 'separator_type', '');
	$pageid = intval(mosGetParam($_POST, 'pageid', 0));
	if ($separator_type == '' OR !$pageid) {
		mosRedirect("index2.php?option=$option&act=managecat", _INVALID_PARAMS);
	}

	switch($separator_type) {
		case 'content_item':
			$cid = mosGetParam($_POST, 'cid', '');
			if (!$cid) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _CONTENT_EMPTY);
			}
			$separator_id = time() + rand(1, 99);
			$database->setQuery("INSERT INTO #__ezine_separator (`id`,`type`,`content_id`) VALUES ('$separator_id','content_item','$cid')");
    		if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
			$query = "SELECT COUNT(*) FROM #__ezine_category WHERE pageid='$pageid'";
			$database->setQuery($query);
			$total = $database->loadResult();
			$total += 1;
			$sql="INSERT INTO #__ezine_category (`pageid`,`contentid`,`ordering`,`content_type`) VALUES ('$pageid','$separator_id','$total','separator')";
			$database->setQuery($sql);
			if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
			break;
		case 'static_content':
			$cid = mosGetParam($_POST, 'cid', '');
			if (!$cid) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _CONTENT_EMPTY);
			}
			$separator_id = time() + rand(1, 99);
			$database->setQuery("INSERT INTO #__ezine_separator (`id`,`type`,`content_id`) VALUES ('$separator_id','static_content','$cid')");
    		if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
			$query = "SELECT COUNT(*) FROM #__ezine_category WHERE pageid='$pageid'";
			$database->setQuery($query);
			$total = $database->loadResult();
			$total += 1;
			$sql="INSERT INTO #__ezine_category (`pageid`,`contentid`,`ordering`,`content_type`) VALUES ('$pageid','$separator_id','$total','separator')";
			$database->setQuery($sql);
			if (!$database->query()) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
			}
			break;
		case 'html_code':
			$htmlcode = mosGetParam($_POST, 'htmlcontent', '', _MOS_ALLOWHTML);
			if (!$htmlcode) {
				mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _CONTENT_EMPTY);
			}
			$separator_id = mosGetParam($_POST, 'separatorid', 0);
			if ($separator_id > 0) {
				$database->setQuery("UPDATE #__ezine_separator SET `html_code` = '$htmlcode' WHERE id = '$separator_id' LIMIT 1");
	    		if (!$database->query()) {
					mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
				}
			} else {
				$separator_id = time() + rand(1, 99);
				$database->setQuery("INSERT INTO #__ezine_separator (`id`,`type`,`html_code`) VALUES ('$separator_id','html_code','$htmlcode')");
	    		if (!$database->query()) {
					mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
				}
				$query = "SELECT COUNT(*) FROM #__ezine_category WHERE pageid='$pageid'";
				$database->setQuery($query);
				$total = $database->loadResult();
				$total += 1;
				$sql="INSERT INTO #__ezine_category (`pageid`,`contentid`,`ordering`,`content_type`) VALUES ('$pageid','$separator_id','$total','separator')";
				$database->setQuery($sql);
				if (!$database->query()) {
					mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid", _ERROR_QUERY_DB);
				}
			}
			break;
		default:
			break;
	}
	mosRedirect("index2.php?option=$option&act=managecat&pageid=$pageid");
}


/* Server-side AJAX functions */

function checkMenuLink($page_id) {
	global $option, $database;
	$database->setQuery("SELECT id,menutype,componentid FROM #__menu WHERE link = 'index.php?option=$option' AND params LIKE '%page_id=$page_id<-%' AND published > -2 ORDER BY id");
	$menu_name = '';
	if ($rows = $database->loadObjectList()) {
		$database->setQuery("SELECT id FROM #__components WHERE link = 'option=$option' AND parent = 0 LIMIT 0,1");
		$componentid = $database->loadResult();
		foreach ($rows AS $row) {
			$menu_name .= $row->menutype.', ';
			if ($row->componentid != $componentid) {
				$database->setQuery("UPDATE #__menu SET componentid = '$componentid' WHERE id = '".$row->id."' LIMIT 1");
				$database->query();
			}
		}
		$menu_name = substr($menu_name, 0, strlen($menu_name) - 2);
	}
	return $menu_name ? $menu_name : '-';
}

// swap value of a parameter
function toggleParam($where, $id, $variable, $default_value, $dbTableCol) {
	global $option, $database, $ajax_engine;

	if ($dbTableCol) {
		$database->setQuery("SELECT `$variable` FROM #__ezine_$where WHERE id = '$id' LIMIT 0,1");
		$status = $database->loadResult();
		$newValue = ($status == 0 ? 1 : 0);
		$database->setQuery("UPDATE #__ezine_$where SET `$variable` = '".$newValue."' WHERE id = '$id' LIMIT 1");
	    if (!$database->query()) {
			$ajax_engine->setAttribute('valid', 'false');
	    	return(_SQL_QUERY_ERROR);
		}
	} else {
		$database->setQuery("SELECT `params` FROM #__ezine_$where WHERE id = '$id' LIMIT 0,1");
		$params = explode("\n", trim($database->loadResult()));
		$new_params = array();
		$found = false;
		foreach ($params AS $param) {
			list($k, $v) = split("=", $param, 2);
			if (strtolower($k) == strtolower($variable)) {
				if (strtolower($k) == 'cover_output') {
					$v = ($v == 'joomla') ? 'alone' : 'joomla';
				} else {
					$v = ($v == 0) ? 1 : 0;
				}
				$found = true;
				$newValue = $v;
			}
			if ("$k=$v" <> "=")
				$new_params[] = "$k=$v";
		}
		if (!$found) {
			$new_params[] = "$variable=$default_value";
			$newValue = $default_value;
		}

		$database->setQuery("UPDATE #__ezine_$where SET `params` = '".implode("\n",$new_params)."' WHERE id = '$id' LIMIT 1");
	    if (!$database->query()) {
			$ajax_engine->setAttribute('valid', 'false');
	    	return(_SQL_QUERY_ERROR);
		}
	}

	$ajax_engine->setAttribute('valid', 'true');
	return($newValue);
}

// update value of a parameter
function updateParam($where, $id, $variable, $newValue, $dbTableCol) {
	global $option, $database, $ajax_engine;

	if ($newValue == null OR $newValue == 'null') {
		$newValue = '';
	}
	if ($dbTableCol) {
		$database->setQuery("UPDATE #__ezine_$where SET `$variable` = '$newValue' WHERE id = '$id' LIMIT 1");
	    if (!$database->query()) {
			$ajax_engine->setAttribute('valid', 'false');
	    	return(_SQL_QUERY_ERROR);
		}
	} else {
		$database->setQuery("SELECT `params` FROM #__ezine_$where WHERE id = '$id' LIMIT 0,1");
		$params = explode("\n", trim($database->loadResult()));
		$new_params = array();
		$found = false;
		foreach ($params AS $param) {
			list($k, $v) = split("=", $param, 2);
			if (strtolower($k) == strtolower($variable)) {
				$v = $newValue;
				$found = true;
			}
			if ("$k=$v" <> "=")
				$new_params[] = "$k=$v";
		}
		if (!$found) {
			$new_params[] = "$variable=$newValue";
		}

		$database->setQuery("UPDATE #__ezine_$where SET `params` = '".implode("\n",$new_params)."' WHERE id = '$id' LIMIT 1");
	    if (!$database->query()) {
			$ajax_engine->setAttribute('valid', 'false');
	    	return(_SQL_QUERY_ERROR);
		}
	}

	$ajax_engine->setAttribute('valid', 'true');
	return(($newValue == '' OR ($variable == 'cover_auto_redirect' AND $newValue == 0)) ? '-' : $newValue);
}

// frontend call-back func to toggle value of a parameter
function toggle(&$vars) {
	// get variable
	$where			= $vars['where'];
	$id				= $vars['id'];
	$action			= $vars['action'];
	$defaultValue	= $vars['value'];
	$dbTableCol		= $vars['isDBTableCol'];

	global $option, $database, $ajax_engine;
	$ajax_engine->setAttribute('action', $action);
	$ajax_engine->setAttribute('affected', $id);
	if ($where == 'page' OR $where == 'category' OR $where == 'sef') {
		return toggleParam($where, $id, $action, $defaultValue, $dbTableCol);
	} else {
		$ajax_engine->setAttribute('valid', 'false');
		return(_INVALID_PARAMETER);
	}
}

// frontend call-back func to update value of a parameter
function update(&$vars) {
	// get variable
	$where		= $vars['where'];
	$id			= $vars['id'];
	$action		= $vars['action'];
	$value		= $vars['value'];
	$dbTableCol	= $vars['isDBTableCol'];

	global $option, $database, $ajax_engine;
	$ajax_engine->setAttribute('action', $action);
	$ajax_engine->setAttribute('affected', $id);
	if ($where == 'page' OR $where == 'category' OR $where == 'sef') {
		return updateParam($where, $id, $action, str_replace("\n", '-newline-', $value), $dbTableCol);
	} else {
		$ajax_engine->setAttribute('valid', 'false');
		return(_INVALID_PARAMETER);
	}
}

// frontend call-back func to get list of dirs & files
function listDir(&$vars) {
	// get variable
	$action		= $vars['action'];
	$id			= $vars['id'];
	$dir		= $vars['dir'];

	global $option, $ajax_engine;
	$ajax_engine->setAttribute('action', $action);
	$ajax_engine->setAttribute('affected', $id);
	$root = _D4J_PRODUCT_FRONTEND_PATH.'/../../images/';
	$parts = explode('/', $dir);
	if ($parts[count($parts)-1] == '..') {
		unset($parts[count($parts)-1]);
		unset($parts[count($parts)-1]);
		$dir = implode('/', $parts);
	}
	$found = 0;
	$folders = array();
	$files = array();
	if ($handle = opendir($root.$dir)) {
	    while (false !== ($file = readdir($handle))) {
	    	if (is_dir($root."$dir/$file") AND $file != '.') {
	    		if ($file == '..') {
	    			if ($dir != '') {
	    				$folders[] = "$dir/$file";
	    				$found++;
	    			}
	    		} else {
	    			$folders[] = "$dir/$file";
		    		$found++;
	    		}
	    	} else {
	        	$file_parts = explode('.', $file);
	        	if (strtoupper($file_parts[count($file_parts)-1]) == 'JPG' OR strtoupper($file_parts[count($file_parts)-1]) == 'GIF' OR strtoupper($file_parts[count($file_parts)-1]) == 'PNG') {
	    			$files[] = "$dir/$file";
	    			$found++;
	    		}
	    	}
	    }
	    closedir($handle);
    	sort($folders);
    	sort($files);
    	foreach ($folders AS $folder) {
			$folder_node[] = '<dir permission="'.(is_writable($root."$dir/$file") ? 'WRITABLE' : 'UNWRITABLE').'">'
				. $folder . '</dir>';
    	}
   		// return files only if not called to build page cover
    	foreach ($files AS $file) {
   			$file_node[] = '<file>' . $file . '</file>';
   		}
		$ajax_engine->setAttribute('valid', 'true');
		return implode("\n", $folder_node)."\n".implode("\n", $file_node);
	} else {
		$ajax_engine->setAttribute('valid', 'false');
		return(_CANNOT_OPEN_DIR.": $dir");
	}
}

// frontend call-back func to create new menu item links to an eZine page
function linkToMenu(&$vars) {
	// get variable
	$page_id	= $vars['id'];
	$menu		= $vars['menu_name'];
	$published	= $vars['published'];
	$frontpage	= $vars['frontpage'];

	global $option, $database, $ajax_engine;
	$ajax_engine->setAttribute('affected', $page_id);
	$check = checkMenuLink($page_id);
	$existed = explode(', ', $check);
	if ($check == '-' OR !in_array($menu, $existed)) {
		$query = "SELECT menu_name,params FROM #__ezine_page"
		. "\n WHERE id = '$page_id' LIMIT 0,1";
		$database->setQuery($query);
		$database->loadObject($menu_data);
		$page_params =& new mosParameters($menu_data->params);

		$query = "SELECT id FROM #__components"
		. "\n WHERE `link` = 'option=$option' LIMIT 0,1";
		$database->setQuery($query);
		$componentid = $database->loadResult();

		$row 				= new mosMenu($database);
		$row->menutype 		= $menu;
		$row->name 			= $menu_data->menu_name;
		$row->type 			= 'components';
		$row->published		= $published;
		$row->componentid	= $componentid;
		$row->link			= 'index.php?option='.$option.'';
		if ($frontpage) {
			$database->setQuery("SELECT ordering FROM #__menu WHERE menutype = '$menu' ORDER BY ordering LIMIT 0,1");
			$lowest = $database->loadResult();
			$row->ordering = $lowest - 1;
		} else {
			$database->setQuery("SELECT ordering FROM #__menu WHERE menutype = '$menu' ORDER BY ordering DESC LIMIT 0,1");
			$highest = $database->loadResult();
			$row->ordering = $highest + 1;
		}
		// the trailing '<-' is to separate 'page_id=1' and 'page_id=11' (or similar) when selecting menu item for a specific eZine page
		$row->params        = 'page_id='.$page_id.'<-';

		if (!$row->check()) {
			$ajax_engine->setAttribute('valid', 'false');
			$ajax_engine->setAttribute('affected', $page_id);
			return(_DB_QUERY_ERROR);
		}
		if (!$row->store()) {
			$ajax_engine->setAttribute('valid', 'false');
			$ajax_engine->setAttribute('affected', $page_id);
			return(_DB_QUERY_ERROR);
		}
		$row->checkin();

		$ajax_engine->setAttribute('valid', 'true');
		return(checkMenuLink($page_id));
	} else {
		$ajax_engine->setAttribute('valid', 'false');
		return(_DUPLICATE_MENU_LINK);
	}
}

// frontend call-back func to remove an existed menu item links to an eZine page
function removeMenuLink(&$vars) {
	// get variable
	$page_id	= $vars['id'];
	$menu_type	= $vars['menu'];

	global $option, $database, $ajax_engine;
	$ajax_engine->setAttribute('affected', $page_id);
	$database->setQuery("DELETE FROM #__menu WHERE menutype = '$menu_type' \n"
	. "AND link = 'index.php?option=$option' AND params LIKE '%page_id=$page_id<-%'");
    if (!$database->query()) {
		$ajax_engine->setAttribute('valid', 'false');
    	return(_SQL_QUERY_ERROR);
	} else {
		$ajax_engine->setAttribute('valid', 'true');
		return(checkMenuLink($page_id));
	}
}

function getUsers(&$vars) {
	$filter = $vars['filter'];

	global $option, $database;
	if ($filter != '') {
		$database->setQuery("SELECT id,name,username,email FROM #__users WHERE name LIKE '%$filter%' OR username LIKE '%$filter%' OR email LIKE '%$filter%'");
		$rows = $database->loadObjectList();
		$html = '
		'.count($rows).'<-|->
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle" value="" onClick="isChecked(this.checked); checkAll('.count($rows).',\'user\');" />
			</th>
			<th class="title" width="25%">
			'._NAME.'
			</th>
			<th class="title" width="25%">
			'._USERNAME.'
			</th>
			<th class="title" width="50%">
			'._EMAIL.'
			</th>
		</tr>
		';
		if (count($rows)) {
			$k = 0;
			for ($i=0, $n=count($rows); $i < $n; $i++) {
				$row = &$rows[$i];
				$html .= '
				<tr class="row'.$k.'">
					<td>
					'.($i + 1).'
					</td>
					<td align="center">
					<input type="checkbox" id="user'.$i.'" name="uid[]" value="'.$row->id.'" onclick="isChecked(this.checked);" />
					</td>
					<td>
					'.$row->name.'
					</td>
					<td>
					'.$row->username.'
					</td>
					<td>
					<a href="mailto:'.$row->email.'">
					'.$row->email.'
					</a>
					</td>
				</tr>
				';
				$k = 1 - $k;
			}
		} else {
			$html .= '
			<tr class="row0"><td colspan="5" align="center">
				'._NOT_FOUND_ANY.'
			</td></tr>
			';
		}
		$html .= '</table>';
	} else {
		$html = 'FILTER_EMPTY';
	}

	return $html;
}

function updateSubscribe(&$vars) {
	$id = $vars['id'];
	$pages = $vars['pages'];

	global $option, $database, $ajax_engine;
	$ajax_engine->setAttribute('affected', $id);
	$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '$pages' WHERE id = '$id' LIMIT 1");
	if (!$database->query()) {
		$ajax_engine->setAttribute('valid', 'false');
		return(_DB_QUERY_ERROR);
	} else {
		$ajax_engine->setAttribute('valid', 'true');
		$database->setQuery("SELECT menu_name FROM #__ezine_page WHERE id IN ($pages)");
		$rows = $database->loadObjectList();
		$subscribed_pages = '';
		foreach ($rows AS $row) {
			$subscribed_pages .= $row->menu_name.', ';
		}
		$subscribed_pages = substr($subscribed_pages, 0, strlen($subscribed_pages) - 2);
		return str_replace(',', ', ', $subscribed_pages);
	}
}

function sendNewsletterOut(&$vars) {
	$email_per_block	= $vars['email_per_block'];
	$this_block			= $vars['this_block'];
	$letter_id			= $vars['letter_id'];
	$newsletter_subject	= $vars['newsletter_subject'];

	global $option, $database, $mosConfig_live_site, $mosConfig_sitename, $ajax_engine;
	global $mosConfig_mailfrom, $mosConfig_fromname;

	$database->setQuery("SELECT page_id,content,params FROM #__ezine_newsletter_contents WHERE id = '$letter_id' LIMIT 0,1");
	$newsletter = false;
	$database->loadObject($newsletter);
	if (!$newsletter) {
		$ajax_engine->setAttribute('valid', 'false');
		return _DB_QUERY_ERROR;
	}
	$params =& new mosParameters($newsletter->params);
	$selected_template = $params->get('template_name', '');
	$newsletter_content = '<?xml version="1.0" encoding="iso-8859-1"?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'.$mosConfig_sitename.' - '.$newsletter_subject.'</title>
<link rel="stylesheet" href="'.$mosConfig_live_site.'/templates/'.$selected_template.'/css/template_css.css" type="text/css" />
<link rel="stylesheet" href="'.$mosConfig_live_site.'/components/'.$option.'/css/ezine.css" type="text/css" />
<base href="'.$mosConfig_live_site.'/" />
</head>
<body>
'.$newsletter->content;

	$item_id = $newsletter->page_id;
	$database->setQuery("SELECT params FROM #__menu WHERE id = '$item_id' LIMIT 0,1");
	$params =& new mosParameters($database->loadResult());
	$page_id = intval($params->get('page_id', 0));
	$database->setQuery("SELECT nu.uid,nu.name,nu.email,u.name AS u_name,u.email AS u_email FROM #__ezine_newsletter_users AS nu LEFT JOIN #__users AS u ON nu.uid > 0 AND u.id = nu.uid WHERE nu.subcribed_pages = '$page_id' OR nu.subcribed_pages LIKE '$page_id,%' OR nu.subcribed_pages LIKE '%,$page_id,%' OR nu.subcribed_pages LIKE '%,$page_id' LIMIT ".($this_block * $email_per_block).",".(($this_block * $email_per_block) + $email_per_block));
	if ($rows = $database->loadObjectList()) {
		$ajax_engine->setAttribute('valid', 'true');
		// Update database
		if ($this_block == 0) {
			$database->setQuery("UPDATE #__ezine_newsletter_contents SET already_send = '1', date_sent = '".date("Y-m-d H:i:s")."' LIMIT 1");
			if (!$database->query()) {
				$ajax_engine->setAttribute('valid', 'false');
				return _DB_QUERY_ERROR;
			}
		}
		// Send email
		foreach ($rows as $row) {
			$row->name = $row->uid > 0 ? $row->u_name : $row->name;
			$row->email = $row->uid > 0 ? $row->u_email : $row->email;

			// Replace placeholders with detailed information
			$newsletter_content = str_replace('%NAME%', $row->name, $newsletter_content);
			$newsletter_content = str_replace('%EMAIL%', $row->email, $newsletter_content);
			$unsubscribe_link = $mosConfig_live_site."/index.php?option=$option&task=newsletter_subscribe&".($row->uid > 0 ? "uid=".$row->uid : "email=".$row->email);
			if (preg_match("/%UNSUBSCRIBE%/", $newsletter_content)) {
				$newsletter_content = str_replace('%UNSUBSCRIBE%', str_replace('%UNSUBCRIBE_LINK%', $unsubscribe_link, _NEWSLETTER_UNSUBSCRIBE));
			} else {
				$newsletter_content .= '<p align="right">'.str_replace('%UNSUBCRIBE_LINK%', $unsubscribe_link, _NEWSLETTER_UNSUBSCRIBE).'</p>';
			}
			$newsletter_content .= '
</body>
</html>';

			$mail = mosCreateMail($mosConfig_mailfrom, $mosConfig_fromname, $newsletter_subject, $newsletter_content);

			// activate HTML formatted emails
			$mail->IsHTML(true);

			$mail->AddAddress($row->email);

			$mailssend = $mail->Send();

			if($mail->error_count > 0) {
				$ajax_engine->setAttribute('valid', 'false');
				return ('Cannot send email to '.$row->email);
			}
		}
		return;
	} else {
		$ajax_engine->setAttribute('valid', 'false');
		return _DB_QUERY_ERROR;
	}
}

// Registration function
function register() {
	global $option;

	$msg = '';
	// reissue or upgrade license
	if (file_exists(_D4J_PRODUCT_LICENSE_KEY)) {
		@unlink(_D4J_PRODUCT_LICENSE_KEY);
		if (file_exists(_D4J_PRODUCT_LICENSE_KEY))
			$msg = 'Cannot remove file &quot;'._D4J_PRODUCT_LICENSE_KEY.'&quot;. Please double check the file permission to sure that it is writeable.';
	}
	if (file_exists(_D4J_PRODUCT_LOCAL_KEY)) {
		@unlink(_D4J_PRODUCT_LOCAL_KEY);
		if (file_exists(_D4J_PRODUCT_LOCAL_KEY))
			$msg = 'Cannot remove file &quot;'._D4J_PRODUCT_LOCAL_KEY.'&quot;. Please double check the file permission to sure that it is writeable.';
	}
	if ($msg != '')
		mosRedirect("index2.php?option=$option", $msg);

	HTML_ezine::register();
}

function requestSupport($msg = '') {
	$msg = empty($msg) ? mosGetParam($_REQUEST, 'mosmsg', '') : $msg;
	$license = '';
	if (file_exists(_D4J_PRODUCT_LICENSE_KEY))
		include_once(_D4J_PRODUCT_LICENSE_KEY);
	HTML_ezine::requestSupport($msg, $license);
}

function sendSupportRequest() {
	global $mosConfig_mailfrom, $mosConfig_fromname;

	$supportRequest = mosGetParam($_POST, 'support_request', '');
	if (is_array($supportRequest)) {
		mosMail($mosConfig_mailfrom, $mosConfig_fromname, 'support@designforjoomla.com', $supportRequest['subject'], $supportRequest['message']);
		$msg = 'Support Request has been sent. You will soon receive response from The DesignForJoomla.com team. Thank you for choosing our product!';
	} else
		$msg = 'Cannot sending out your message. Please fill in all required information and try again.';
	echo '<script language="javascript" type="text/javascript">alert("'.$msg.'"); window.history.go(-1);</script>';
	exit();
}

function aboutUs() {
	global $mosConfig_absolute_path;

	require_once($mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php');
	$xmlFilesInDir = mosReadDirectory(_D4J_PRODUCT_BACKEND_PATH, '.xml$');

	$row = new stdClass();
	foreach ($xmlFilesInDir AS $xmlfile) {
		// Read the file to see if it's a valid component XML file
		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors(true);

		if (!$xmlDoc->loadXML(_D4J_PRODUCT_BACKEND_PATH.'/'.$xmlfile, false, true)) {
			continue;
		}

		$root = &$xmlDoc->documentElement;

		if ($root->getTagName() != 'mosinstall') {
			continue;
		}
		if ($root->getAttribute("type") != "component") {
			continue;
		}

		$element 			= &$root->getElementsByPath('author', 1);
		$row->author		= $element ? $element->getText() : 'Unknown';

		$element			= &$root->getElementsByPath('creationDate', 1);
		$row->creationDate	= $element ? $element->getText() : 'Unknown';

		$element			= &$root->getElementsByPath('copyright', 1);
		$row->copyright		= $element ? $element->getText() : '';

		$element			= &$root->getElementsByPath('license', 1);
		$row->license		= $element ? $element->getText() : '';

		$element			= &$root->getElementsByPath('authorEmail', 1);
		$row->authorEmail	= $element ? $element->getText() : '';

		$element			= &$root->getElementsByPath('authorUrl', 1);
		$row->authorUrl		= $element ? $element->getText() : '';

		$element			= &$root->getElementsByPath('version', 1);
		$row->version		= $element ? $element->getText() : '';

		$element			= &$root->getElementsByPath('description', 1);
		$row->description	= $element ? $element->getText() : '';
	}

	HTML_ezine::aboutUs($row);
}

function updateComponent() {
	global $option, $database, $mosConfig_absolute_path;

	require_once($mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php');
	$xmlFilesInDir = mosReadDirectory(_D4J_PRODUCT_BACKEND_PATH, '.xml$');

	foreach ($xmlFilesInDir AS $xmlfile) {
		// Read the file to see if it's a valid component XML file
		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors(true);

		if (!$xmlDoc->loadXML(_D4J_PRODUCT_BACKEND_PATH.'/'.$xmlfile, false, true)) {
			continue;
		}

		$root = &$xmlDoc->documentElement;

		if ($root->getTagName() != 'mosinstall') {
			continue;
		}
		if ($root->getAttribute("type") != "component") {
			continue;
		}

		// update backend menu items
		$parentItem = &$root->getElementsByPath('administration/menu', 1);
		$database->setQuery("SELECT id FROM #__components WHERE link = 'option=$option' AND parent = '0' AND admin_menu_link = 'option=$option' AND ordering = '0'");
		$comID = $database->loadResult();
		if (!$comID) {
			$database->setQuery("INSERT INTO #__components (name, link, parent, admin_menu_link, admin_menu_alt, `option`, admin_menu_img)"
			."\n VALUES ('".$parentItem->getText()."', 'option=$option', '0', 'option=$option', '".$parentItem->getText()."', '$option', 'js/ThemeOffice/component.png')");
			if (!$database->query()) {
				echo '<p><h3>Cannot update database.</h3></p>';
				if ($database->getErrorNum())
					echo $database->stderr();
				return;
			}
			$database->setQuery("SELECT id FROM #__components WHERE link = 'option=$option' AND parent = '0' AND admin_menu_link = 'option=$option' AND ordering = '0'");
			$comID = $database->loadResult();
		}
		if (!empty($parentItem)) {
			$subMenu = &$root->getElementsByPath('administration/submenu', 1);
			if (!empty($subMenu)) {
				$childItems		= $subMenu->childNodes;
				$ordering		= 0;
				$childItemLinks	= array();
				foreach ($childItems AS $childItem) {
					if ($childItem->getAttribute("act")) {
						$admin_menu_link = "option=$option&act=" . $childItem->getAttribute("act");
					} elseif ($childItem->getAttribute("task")) {
						$admin_menu_link = "option=$option&task=" . $childItem->getAttribute("task");
					} elseif ($childItem->getAttribute("link")) {
						$admin_menu_link = $childItem->getAttribute("link");
					} else {
						$admin_menu_link = "option=$option";
					}
					$admin_menu_text = $childItem->getText();
					// check if exists
					$database->setQuery("SELECT id, name, parent, admin_menu_link FROM #__components WHERE admin_menu_link = '$admin_menu_link' OR (name = '$admin_menu_text' AND `option` = '$option')");
					if ($rows = $database->loadObjectList()) {
						if ($rows[0]->name != $admin_menu_text OR $rows[0]->admin_menu_link != $admin_menu_link OR $rows[0]->parent != $comID) {
							$database->setQuery("UPDATE #__components SET name = '$admin_menu_text', admin_menu_link = '$admin_menu_link', parent = '$comID', ordering = '$ordering' WHERE id = '".$rows[0]->id."'");
							if (!$database->query()) {
								echo '<p><h3>Cannot update database.</h3></p>';
								if ($database->getErrorNum())
									echo $database->stderr();
								return;
							}
						}
					} else {
						$database->setQuery("INSERT INTO #__components (name, parent, admin_menu_link, admin_menu_alt, `option`, ordering, admin_menu_img)"
						."\n VALUES ('$admin_menu_text', '$comID', '$admin_menu_link', '$admin_menu_text', '$option', '$ordering', 'js/ThemeOffice/component.png')");
						if (!$database->query()) {
							echo '<p><h3>Cannot update database.</h3></p>';
							if ($database->getErrorNum())
								echo $database->stderr();
							return;
						}
					}
					$ordering += 1;
					$childItemLinks[] = $admin_menu_link;
				}
				// remove old child menu items
				$database->setQuery("SELECT id, admin_menu_link FROM #__components WHERE parent > 0 AND `option` = '$option'");
				if ($rows = $database->loadObjectList()) {
					foreach ($rows AS $row) {
						if (!in_array($row->admin_menu_link, $childItemLinks)) {
							$database->setQuery("DELETE FROM #__components WHERE id = '$row->id'");
							if (!$database->query()) {
								echo '<p><h3>Cannot update database.</h3></p>';
								if ($database->getErrorNum())
									echo $database->stderr();
								return;
							}
						}
					}
				}
			}
		}
	}
	echo '<p><h3>Update Successful.</h3></p>';
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