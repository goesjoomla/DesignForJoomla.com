<?php
/**
* eZine component :: toolbar switch
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

if ($task <> ''){
	$func = $task;
} elseif ($act <> '') {
	$func = $act;
} elseif (!isset($func)) {
	$func = '';
}

switch ($func) {
	case 'config':
		TOOLBAR_content::_CONFIG();
		break;

	case 'managepage':
		TOOLBAR_content::_PAGE();
		break;

	case 'newpage':
	case 'editpage':
		TOOLBAR_content::_EDITPAGE();
		break;

	case 'managecat':
		TOOLBAR_content::_CATEGORY();
		break;

	case 'addcontent':
		TOOLBAR_content::_ADDCONTENT();
		break;

	case 'editcat':
		TOOLBAR_content::_EDITCAT();
		break;

	case 'managesef':
		TOOLBAR_content::_SEFURL();
		break;

	case 'newsef':
	case 'editsef':
		TOOLBAR_content::_EDITSEFURL();
		break;

	case 'manageletter':
		TOOLBAR_content::_NEWSLETTER();
		break;

	case 'newletter':
	case 'editletter':
		TOOLBAR_content::_EDITNEWSLETTER();
		break;

	case 'manageusers':
		TOOLBAR_content::_SUBSCRIBERS();
		break;

	case 'editcss':
		TOOLBAR_content::_EDITCSS();
		break;

	case 'editlang':
		TOOLBAR_content::_EDITLANG();
		break;

	case 'addseparator':
		TOOLBAR_content::_ADDSEPARATOR();
		break;

	case 'editseparator':
		TOOLBAR_content::_EDITSEPARATOR();
		break;

	case 'aboutcom':
		TOOLBAR_content::_ABOUT();
		break;

	default:
		TOOLBAR_content::_DEFAULT();
		break;
}
?>
