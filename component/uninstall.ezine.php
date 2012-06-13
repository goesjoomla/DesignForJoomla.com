<?php
/**
* eZine component :: uninstallation
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function com_uninstall() {
	global $database, $mosConfig_absolute_path, $mosConfig_live_site;
	if (file_exists($mosConfig_absolute_path.'/blank.html')) {
		echo 'Removing file ...';
		if (!unlink($mosConfig_absolute_path.'/components/com_ezine/blank.html')) {
			echo ' done!<br/>';
		} else {
			echo ' fail! You need to delete manually.<br/>';
		}
	}
	echo '<hr/><br/>';
}
?>