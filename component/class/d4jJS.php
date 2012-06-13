<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path, $mosConfig_live_site;

$real_path = str_replace('\\', '/', dirname(__FILE__));

if (!defined('_LIVE_SITE_URL')) {
	define('_LIVE_SITE_URL', 1);
	$live_site_parts = parse_url($mosConfig_live_site);
	echo '
<script type="text/javascript">
	var mosConfig_live_site = "'.((substr($_SERVER['HTTP_HOST'],0,4) == 'www.' AND substr($_SERVER['HTTP_HOST'],4,strlen($_SERVER['HTTP_HOST'])) == $live_site_parts['host']) ? str_replace('http://','http://www.',$mosConfig_live_site) : $mosConfig_live_site).'";
</script>
';
}
if (!defined('_D4J_COMMON_JS') AND file_exists($real_path.'/js/d4j_common_include.compact.js')) {
	define('_D4J_COMMON_JS', 1);
	echo '
<script type="text/javascript" src="'.str_replace($mosConfig_absolute_path, $mosConfig_live_site, $real_path).'/js/d4j_common_include.compact.js"></script>
';
}
if (!defined('_D4J_DISP_JS') AND file_exists($real_path.'/js/d4j_display_engine.compact.js')) {
	define('_D4J_DISP_JS', 1);
	echo '
<script type="text/javascript" src="'.str_replace($mosConfig_absolute_path, $mosConfig_live_site, $real_path).'/js/d4j_display_engine.compact.js"></script>
';
}
if (!defined('_D4J_AJAX_JS') AND file_exists($real_path.'/js/d4j_ajax_engine.compact.js')) {
	define('_D4J_AJAX_JS', 1);
	echo '
<script type="text/javascript" src="'.str_replace($mosConfig_absolute_path, $mosConfig_live_site, $real_path).'/js/d4j_ajax_engine.compact.js"></script>
';
}
?>