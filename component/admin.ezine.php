<?php
/**
* eZine component :: public switch
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define('_IN_EZINE_ADMIN', 1);

// parse parameters
$option	= mosGetParam( $_REQUEST, 'option', 'com_ezine' );
$task	= mosGetParam( $_REQUEST, 'task', '' );
$act	= mosGetParam( $_REQUEST, 'act', '' );
$func	= mosGetParam( $_REQUEST, 'func', '' );

$func = $task != '' ? $task : ($act != '' ? $act : $func);

// require classes files
$admin_html_path = $mainframe->getPath('admin_html');
require_once(str_replace('.html.php', '.func.php', $admin_html_path));

switch ($func) {
	// Global settings
	case 'config':
		showGlobalSettings();
		break;
	case 'saveconfig':
		saveGlobalSettings();
		break;

	// Page management functions
	case 'managepage':
		showPage();
		break;
	case 'newpage':
	case 'editpage':
		editPage();
		break;
	case 'savepage':
		savePage();
		break;
	case 'delpage':
		removePage();
		break;
	case 'swap_page_status':
		swapPageStatus();
		break;

	// SEF URL management functions
	case 'managesef':
		showSefUrl();
		break;
	case 'newsef':
	case 'editsef':
		editSefUrl();
		break;
	case 'savesef':
		saveSefUrl();
		break;
	case 'delsef':
		removeSefUrl();
		break;

	// Category management functions
	case 'managecat':
		showCategory();
		break;
	case 'addcontent':
		addContent();
		break;
	case 'add_content_to_page':
		addContentToPage();
		break;
	case 'editcat':
		editCategory();
		break;
	case 'savecat':
		saveCategory();
		break;
	case 'delcat':
		removeCategory();
		break;
	case 'addseparator':
		addSeparator();
		break;
	case 'editseparator':
		editSeparator();
		break;
	case 'saveseparator':
		saveSeparator();
		break;
	case 'swap_category_status':
		swapCategoryStatus();
		break;
	case 'orderup':
		reorderCategories(-1);
		break;
	case 'orderdown':
		reorderCategories();
		break;
	case 'saveorder':
		saveCategoriesOrder();
		break;

	// Newsletter management functions
	case 'manageletter':
		showNewsletter();
		break;
	case 'newletter':
	case 'editletter':
		editNewsletter();
		break;
	case 'saveletter':
		saveNewsletter();
		break;
	case 'delletter':
		removeNewsletter();
		break;
	case 'sendletter':
		sendNewsletter();
		break;
	case 'manageusers':
		showSubscribers();
		break;
	case 'addusers':
		addUsers();
		break;
	case 'delusers':
		removeUsers();
		break;


	// Other functions
	case 'editcss':
		editCSS();
		break;
	case 'savecss':
		saveCSS();
		break;
	case 'editlang':
		editLang();
		break;
	case 'savelang':
		saveLang();
		break;

	// Registration
	case 'register':
		register();
		break;

	case 'requestSupport':
		requestSupport();
		break;
	case 'sendSupportRequest':
		sendSupportRequest();
		break;

	case 'update':
		updateComponent();
		break;

	case 'aboutUs':
	default:
		aboutUs();
		break;
}

?>