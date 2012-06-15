<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $template_font;

// set font size
$defaultFontSize = 15;
$template_font = intval(mosGetParam($_COOKIE, 'fontSize', $defaultFontSize));

?>