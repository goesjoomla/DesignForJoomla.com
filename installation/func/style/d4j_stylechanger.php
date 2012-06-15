<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// set font size
$defaultFontSize = 12;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

	echo "<style type=\"text/css\">";
	echo "\tbody{font-size:".$currentFontSize."px}\n";
	echo "</style>";
?>