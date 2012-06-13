<?php

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

	case 'upload':
		TOOLBAR_content::_UPLOAD();
		break;

	case 'export':
		TOOLBAR_content::_EXPORT();
		break;

	default:
		TOOLBAR_content::_DEFAULT();
		break;
}
?>
