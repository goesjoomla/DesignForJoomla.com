<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
/* ================== D4J Template Size Changer Settings ================ */
define("_d4j_minWidth",810);// min width (800x600 resolution)
define("_d4j_maxWidth",960);//max width (1024x768 resolution

/* ================== DO NOT CHANGE ANY THING BELOW ===================== */
global $template_width,$template_font,$site_tools_width,$site_tools_font,$colors,$currentColor;

// set font size
if($site_tools_font) {
$defaultFontSize = 12;
$template_font = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));
}

// set container width
if($site_tools_width) {
$defaultContainerWidth = "narrow";
$template_width = mosGetParam($_COOKIE,'containerWidth',$defaultContainerWidth);
}

//set color
if($site_tools_color){
$defaultColor = 0;
$currentColor = $defaultColor;

$userOptions['color']= intval (mosGetParam($_COOKIE, 'color', $defaultColor));

if ($userOptions['color'] != $defaultColor) { //user has already interested in this color
	$currentColor = $userOptions['color'];
	}

echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_'.$colors[$currentColor].'.css" />';
}
?>
