<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path, $mosConfig_live_site;

$real_path = str_replace('\\', '/', dirname(__FILE__));

if (!defined('_LIVE_SITE_URL')) {
	define('_LIVE_SITE_URL', 1);
	$live_site_parts = parse_url($mosConfig_live_site);
	$lib_header = '
<script type="text/javascript">
	var mosConfig_live_site = "'.$live_site_parts['path'].'";
</script>
';
	if (isset($mainframe) AND !defined('_IN_EZINE_ADMIN') AND !defined('_IN_EZINE_MODULE')) {
		$mainframe->addCustomHeadTag($lib_header);
	} else {
		echo $lib_header;
	}
}
if (!defined('_D4J_COMMON_JS') AND file_exists($real_path.'/js/d4jCommonInclude.compact.js')) {
	define('_D4J_COMMON_JS', 1);
	$lib_header = '
<script type="text/javascript" src="'.str_replace($mosConfig_absolute_path, $mosConfig_live_site, $real_path).'/js/d4jCommonInclude.compact.js"></script>
';
	if (isset($mainframe) AND !defined('_IN_EZINE_ADMIN') AND !defined('_IN_EZINE_MODULE')) {
		$mainframe->addCustomHeadTag($lib_header);
	} else {
		echo $lib_header;
	}
}
if (!defined('_D4J_DISP_JS') AND file_exists($real_path.'/js/d4jDisplayEngine.compact.js')) {
	define('_D4J_DISP_JS', 1);
	$lib_header = '
<script type="text/javascript" src="'.str_replace($mosConfig_absolute_path, $mosConfig_live_site, $real_path).'/js/d4jDisplayEngine.compact.js"></script>
';
	if (isset($mainframe) AND !defined('_IN_EZINE_ADMIN') AND !defined('_IN_EZINE_MODULE')) {
		$mainframe->addCustomHeadTag($lib_header);
	} else {
		echo $lib_header;
	}
}
if (!defined('_D4J_AJAX_JS') AND file_exists($real_path.'/js/d4jAjaxEngine.compact.js')) {
	define('_D4J_AJAX_JS', 1);
	$lib_header = '
<script type="text/javascript" src="'.str_replace($mosConfig_absolute_path, $mosConfig_live_site, $real_path).'/js/d4jAjaxEngine.compact.js"></script>
';
	if (isset($mainframe) AND !defined('_IN_EZINE_ADMIN') AND !defined('_IN_EZINE_MODULE')) {
		$mainframe->addCustomHeadTag($lib_header);
	} else {
		echo $lib_header;
	}
}
?>