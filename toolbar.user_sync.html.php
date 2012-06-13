<?php

/**
* @package Joomla
* @subpackage Content
*/
class TOOLBAR_content {
	function _CONFIG() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'saveConfig', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}

	function _UPLOAD() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'import', 'save.png', 'save_f2.png', 'Import', false );
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}

	function _EXPORT() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'download', 'save.png', 'save_f2.png', 'Download', false );
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}

	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}
}
?>
