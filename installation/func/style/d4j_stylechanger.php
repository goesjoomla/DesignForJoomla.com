<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// set font size
$defaultFontSize = 13;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
	$currentFontSize = $userOptions['fontSize'];
}

if ($currentFontSize != $defaultFontSize) {
	echo "\tbody{font-size:".$currentFontSize."px}\n";
	echo "\t#Jtitle h1 a{font-size:".($currentFontSize+7)."px}\n";	
}

// set container width
$defaultContainerWidth = 960;
$currentContainerWidth = $defaultContainerWidth;

$userOptions['containerWidth'] = intval(mosGetParam($_COOKIE, 'containerWidth', $defaultContainerWidth));

if ($userOptions['containerWidth'] != $defaultContainerWidth) { // user has already interested in a container width
	$currentContainerWidth = $userOptions['containerWidth'];
}

	echo "\t#Jcontainer{width:".($currentContainerWidth == 0 ? '96%' : $currentContainerWidth.'px')."}\n";
?>