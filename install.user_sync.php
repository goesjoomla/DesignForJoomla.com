<?php
function com_install() {
	global $database;
	
	echo 'Creating database table ...';
	$query = "CREATE TABLE IF NOT EXISTS #__usersync_config ("
		. "\n `id` TINYINT( 11 ) NOT NULL AUTO_INCREMENT ,"
		. "\n `type` VARCHAR( 11 ) NOT NULL ,"
		. "\n `name` VARCHAR( 255 ) NOT NULL ,"
		. "\n `value` VARCHAR( 255 ) NOT NULL ,"
		. "\n PRIMARY KEY ( `id` )"
		. "\n );";
	$database->setQuery($query);
	if (!$database->query()) {
		echo ' fail!';
	} else {
		echo ' done!';
	}
}
?>