<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $colors;

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

// set container width
$defaultContainerWidth = 767;
$currentContainerWidth = $defaultContainerWidth;

$userOptions['containerWidth'] = intval(mosGetParam($_COOKIE, 'containerWidth', $defaultContainerWidth));

if ($userOptions['containerWidth'] != $defaultContainerWidth) { // user has already interested in a container width
	$currentContainerWidth = $userOptions['containerWidth'];
}
		echo "<style type=\"text/css\">";
		echo "\t#D4J_Container_Out{width:".$currentContainerWidth.'px'."}\n";
		echo "\t#D4J_Container_In{width:".($currentContainerWidth-72).'px'."}\n";
		echo "\t#D4J_Container_In2{background-position:".(($currentContainerWidth-72)*0.69-1).'px 0'."}\n";
		echo "\t#bigimage{width:".($currentContainerWidth-138).'px'."}\n";
		echo "\t#D4J_Header{width:".($currentContainerWidth-138).'px'."}\n";
		echo "\t#D4J_Left{width:".(($currentContainerWidth == 767)? '55.01%':'58%')."}\n";
		if(!mosCountModules('left') && !mosCountModules('right'))
		echo "\t#D4J_Left{width:".($currentContainerWidth-170).'px'."}\n";
		echo "</style>";
	
?>