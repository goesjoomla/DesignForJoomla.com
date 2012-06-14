<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );

// set font size
$defaultFontSize = 12;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
        $currentFontSize = $userOptions['fontSize'];
}
        echo "<style type=\"text/css\">\tbody{font-size:".$currentFontSize."px}\n</style>";

// set container width
$defaultContainerWidth = 770;
$currentContainerWidth = $defaultContainerWidth;

$userOptions['containerWidth'] = intval(mosGetParam($_COOKIE, 'containerWidth', $defaultContainerWidth));

if ($userOptions['containerWidth'] != $defaultContainerWidth) { // user has already interested in a container width
        $currentContainerWidth = $userOptions['containerWidth'];
}

if ($currentContainerWidth != $defaultContainerWidth) {
	$currentContainerWidth = $userOptions['containerWidth'];
}
	echo "<style type=\"text/css\">\t#Jcontainer{width:".($currentContainerWidth == 0 ? '96%' : $currentContainerWidth.'px')."}\n</style>";

?>