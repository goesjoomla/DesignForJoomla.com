<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// set font size
$defaultFontSize = 12;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
	$currentFontSize = $userOptions['fontSize'];
}
	echo "<style type=\"text/css\">";
	echo "\tbody{font-size:".$currentFontSize."px}\n";
	echo "</style>";

?>