<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// parse parameters
$option	= mosGetParam( $_REQUEST, 'option', 'com_user_sync' );
$task	= mosGetParam( $_REQUEST, 'task', '' );
$act	= mosGetParam( $_REQUEST, 'act', '' );
$func	= mosGetParam( $_REQUEST, 'func', '' );

$func = $task != '' ? $task : ($act != '' ? $act : $func);

// require classes files
$admin_html_path = $mainframe->getPath('admin_html');
require_once($admin_html_path);
require_once(str_replace('.html.php', '.func.php', $admin_html_path));

switch ($func) {
	case 'config':
		usersync::showConfig();
		break;
	case 'saveConfig':
		usersync::saveConfig();
		break;

	case 'upload':
		HTML_usersync::upload();
		break;
	case 'import':
		HTML_usersync::import();
		break;

	case 'export':
		$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'general'");
		$general_settings =& new mosParameters('');
		if ($rows = $database->loadObjectList()) {
			foreach ($rows AS $row) {
				$general_settings->set($row->name, htmlentities($row->value, ENT_QUOTES));
			}
		}
		HTML_usersync::export( $general_settings );
		break;
	case 'download':
		$custom_config = mosGetParam( $_POST, 'custom_config', '' );
		usersync::exportCSV( $custom_config );
		break;

	// Registration tasks
	case 'register_step0':
	case 'register_step1':
	case 'register_step2':
	case 'register_step3':
		usersync::register( $func );
		break;

	case 'requestSupport':
		usersync::requestSupport();
		break;
	case 'sendSupportRequest':
		usersync::sendSupportRequest();
		break;

	case 'update':
		usersync::update();
		break;

	case 'aboutUs':
	default:
		usersync::aboutUs();
		break;
}
?>