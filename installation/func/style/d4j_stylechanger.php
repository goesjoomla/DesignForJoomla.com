<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );

// set font size
$defaultFontSize = 11;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
        $currentFontSize = $userOptions['fontSize'];
}
        echo "<style type=\"text/css\">\tbody{font-size:".$currentFontSize."px}\n</style>";

// set container width
$defaultContainerWidth = 960;
$currentContainerWidth = $defaultContainerWidth;

$userOptions['containerWidth'] = intval(mosGetParam($_COOKIE, 'containerWidth', $defaultContainerWidth));

if ($userOptions['containerWidth'] != $defaultContainerWidth) { // user has already interested in a container width
        $currentContainerWidth = $userOptions['containerWidth'];
}
        echo "<style type=\"text/css\">";
        echo "\t#container{width:".($currentContainerWidth == 0 ? '96%' : $currentContainerWidth.'px')."}\n";
        echo "</style>";
?>
<!--[if lt IE 7]>
<?php
        echo "<style type=\"text/css\">";
        echo "\t#box2{width:".($currentContainerWidth == 0 ? '100%' :($currentContainerWidth-14).'px')."}\n";
        echo "\t#box3{width:".($currentContainerWidth == 0 ? '100%' :($currentContainerWidth).'px')."}\n";
        echo "</style>";?>
<![endif]-->
<?php
        echo "<style type=\"text/css\">";
        echo "\t#box2{width:".($currentContainerWidth == 0 ? '97.45%' :($currentContainerWidth-41).'px')."}\n";
        echo "\t#box3{width:".($currentContainerWidth == 0 ? '97.38%' :($currentContainerWidth-38).'px')."}\n";
        if ($currentContainerWidth == $defaultContainerWidth) {
        } else {
        echo "\t#box2{width:".($currentContainerWidth == 0 ? '90%' : ($currentContainerWidth-38).'px')."}\n";
        }

        echo "</style>";

//set color
$defaultColor = 4;
$currentColor = $defaultColor;

$userOptions['color']= intval (mosGetParam($_COOKIE, 'color', $defaultColor));

if ($userOptions['color'] != $defaultColor) { //user has already interested in this color
        $currentColor = $userOptions['color'];
        }

if ($currentColor == 0) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_light_orange.css" />';
}
else if ($currentColor == 1) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_light_violet.css" />';
}
else if ($currentColor == 2) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_light_green.css" />';
}
else if ($currentColor == 3) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_light_blue.css" />';
}
else if ($currentColor == 4) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_orange.css" />';
}
else if ($currentColor == 5) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_violet.css" />';
}
else if ($currentColor == 6) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_green.css" />';
}
else if ($currentColor == 7) {
        echo '<link rel="stylesheet" type="text/css" href="'._TEMPLATE_URL.'/css/template_css_blue.css" />';
}
?>