<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path, $mosConfig_live_site;

$real_path = str_replace('\\', '/', dirname(__FILE__));

if (!defined('_D4J_CSS_INC') AND file_exists($real_path.'/css/d4jCommonCss.css')) {
	define('_D4J_CSS_INC', 1);
	$lib_header = '
<link rel="stylesheet" type="text/css" media="all" href="'.str_replace($mosConfig_absolute_path, $mosConfig_live_site, $real_path).'/css/d4jCommonCss.css" />
';
	if (isset($mainframe) AND !defined('_IN_EZINE_ADMIN') AND !defined('_IN_EZINE_MODULE')) {
		$mainframe->addCustomHeadTag($lib_header);
	} else {
		echo $lib_header;
	}
}
?>