<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// set font size
$defaultFont = 12;
$currentFont = $defaultFont;
$userFont = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFont));
$changeFont = mosGetParam($_GET, 'changeFont', null);

if ($userFont != $defaultFont) { // user has already interested in a font size
	$currentFont = $userFont;
}

if ($changeFont != null) {
	if ($changeFont == 0) { // default font size
		$currentFont = $defaultFont;
	} else { // change font size
		$currentFont = $currentFont + $changeFont;
		if ($currentFont > 18) {
			$currentFont = 18;
		} elseif ($currentFont < 6) {
			$currentFont = 6;
		}
	}
}

if ($currentFont != $defaultFont) {
	echo "\tbody{font-size:".$currentFont."px}\n";
}

setcookie( 'fontSize', $currentFont, time() + 30*24*60*60, '/' );
?>