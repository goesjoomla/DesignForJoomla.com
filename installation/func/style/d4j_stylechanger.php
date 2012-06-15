<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// set font size
$defaultFontSize = 14;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
	$currentFontSize = $userOptions['fontSize'];
}
	echo "<style type=\"text/css\">";
	echo "\tbody{font-size:".$currentFontSize."px}\n";
	echo "</style>";

// set container width
$defaultContainerWidth = 764;
$currentContainerWidth = $defaultContainerWidth;

$userOptions['containerWidth'] = intval(mosGetParam($_COOKIE, 'containerWidth', $defaultContainerWidth));

if ($userOptions['containerWidth'] != $defaultContainerWidth) { // user has already interested in a container width
	$currentContainerWidth = $userOptions['containerWidth'];
}
	echo "<style type=\"test/css\">";
	echo "\t#Jcontainer{width:".($currentContainerWidth == 0 ? '100%' : $currentContainerWidth.'px')."}\n";
	echo "</style>";
	
?>