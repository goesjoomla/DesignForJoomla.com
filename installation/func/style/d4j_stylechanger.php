<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $colors;

// set font size
$defaultFontSize = 16;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
        $currentFontSize = $userOptions['fontSize'];
}
{
        echo "<style type=\"text/css\">";
        echo "\tbody{font-size:".$currentFontSize."px}\n";
        echo "</style>";
}
if ($currentFontSize != $defaultFontSize) {
        echo "<style type=\"text/css\">\tbody{font-size:".$currentFontSize."px}\n</style>";
}
setcookie( 'fontSize', $currentFontSize, time() + 30*24*60*60, '/' );
