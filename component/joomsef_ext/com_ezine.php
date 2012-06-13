<?php
/**
 * ARTIO JoomSEF support for eZine component
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

global $mosConfig_absolute_path, $sefConfig;

// JF translate extension
$jfTranslate = $sefConfig->translateNames ? ', id' : '';

// prepare eZine SEF URL
require_once($mosConfig_absolute_path.'/components/com_ezine/sef_ext.php');
$eZineSefClass = new sef_ezine();
$title = explode('/', $eZineSefClass->create(&$string));

if (isset($vars['limitstart']) AND $vars['limitstart'] == 0) {
	$limitPerPage = $vars['limit'];
	$limitStart = 0;
} else {
	$limitPerPage = $limitStart = null;
}
if (preg_match("/task=newsletter_subscribe/", $string)) {
	$string = preg_replace("/(&amp;|&)Itemid=\d+/", '', $string);
}
$string = sef_404::sefGetLocation($string, $title, null, $limitPerPage, $limitStart, @$lang);
?>