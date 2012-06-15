<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
/* ================== D4J Template Size Changer Settings ================ */
define("_d4j_minWidth",810);// min width (800x600 resolution)
define("_d4j_maxWidth",960);//max width (1024x768 resolution

/* ================== DO NOT CHANGE ANY THING BELOW ===================== */
global $template_width,$template_font;

// set font size
$defaultFontSize = 12;
$template_font = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

// set container width
$defaultContainerWidth = "narrow";

$template_width = mosGetParam($_COOKIE,'containerWidth',$defaultContainerWidth);

?>
