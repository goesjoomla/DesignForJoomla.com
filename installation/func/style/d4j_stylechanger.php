<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );

// set font size
$defaultFontSize = 13;
$currentFontSize = $defaultFontSize;
$userOptions['fontSize'] = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

if ($userOptions['fontSize'] != $defaultFontSize) { // user has already interested in a font size
        $currentFontSize = $userOptions['fontSize'];
}
        echo "<style type=\"text/css\">\tbody{font-size:".$currentFontSize."px}\n</style>";

// set container width
$defaultContainerWidth = 850;
$currentContainerWidth = $defaultContainerWidth;

$userOptions['containerWidth'] = intval(mosGetParam($_COOKIE, 'containerWidth', $defaultContainerWidth));

if ($userOptions['containerWidth'] != $defaultContainerWidth) { // user has already interested in a container width
        $currentContainerWidth = $userOptions['containerWidth'];
}
        echo "<style type=\"text/css\">";
        echo "\t#container{width:".($currentContainerWidth == 0 ? '95.7%' : $currentContainerWidth.'px')."}\n";
        echo "</style>";
?>
<!--[if IE]>
<?php  
        echo "<style type=\"text/css\">";
        echo "\t#container{width:".($currentContainerWidth == 0 ? '96%' : $currentContainerWidth.'px')."}\n";
        echo "</style>";?>
<![endif]-->
<?php  
		echo "<style type=\"text/css\">";
        echo "\t#rbox{width:".($currentContainerWidth == 0 ? '60.5%' :($currentContainerWidth-380).'px')."}\n";
        echo "</style>";
?>