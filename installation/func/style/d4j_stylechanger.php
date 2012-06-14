<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $colors;

// set font size
$defaultFontSize = 11;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
	$currentFontSize = $userOptions['fontSize'];
}

if ($currentFontSize != $defaultFontSize) {
	echo "<style type=\"text/css\">";
	echo "\tbody{font-size:".$currentFontSize."px}\n";
	echo "</style>";
}

// set container width
$defaultContainerWidth = 760;
$currentContainerWidth = $defaultContainerWidth;
$maxWidth = 960;

$userOptions['containerWidth'] = intval(mosGetParam($_COOKIE, 'containerWidth', $defaultContainerWidth));

if ($userOptions['containerWidth'] != $defaultContainerWidth) { // user has already interested in a container width
	$currentContainerWidth = $userOptions['containerWidth'];
}
		echo "<style type=\"text/css\">";
		if($currentContainerWidth == 0) {
			echo "\t#D4J_Container{width:100%}\n";			
			echo "\t#D4J_Header{background:url("._TEMPLATE_URL."/images/img02_2.jpg) repeat}\n";
		}
		else {
			echo "\t#D4J_Container{width:".$currentContainerWidth.'px'."}\n";
			if($currentContainerWidth == $maxWidth) {
				echo "\t#D4J_Header{background:url("._TEMPLATE_URL."/images/img02_2.jpg) no-repeat}\n";
			}
		}
		echo "</style>";
	
?>