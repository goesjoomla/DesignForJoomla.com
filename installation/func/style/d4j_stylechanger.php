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
	echo "<style type=\"text/css\">";
	echo "\tbody{font-size:".$currentFontSize."px}\n";
	echo "</style>";

// set container width
$defaultContainerWidth = 820;
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
		
		
function classifyHeading($module){
	ob_start();
	mosLoadModules($module,-2);
	$content = ob_get_contents();
	ob_end_clean();
	
	$patterns[0] = "/&lt;([^\s]+)\s+class=&quot;green&quot;&gt;([^\/]*)\/([^\s]+)&gt;/";
	$patterns[1] = "/&lt;([^\s]+)\s+class=&quot;grey&quot;&gt;([^\/]*)\/([^\s]+)&gt;/";
	$replaces[1] = "<\\1 class=\"green\">\\2</\\3>";
	$replaces[0] = "<\\1 class=\"grey\">\\2</\\3>";
	
	return str_replace('&lt;</', '</', preg_replace($patterns, $replaces, $content));
}
?>