<?php
/**
* D4J Content Listing Joomla! extension v1.3 :: module file
*
* Author: Nguyen Manh Cuong
* Author Homepage: http://designforjoomla.com/
* Author Email: cuongnm@designforjoomla.com
*
* This Joomla! extension is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 2.5 License.
* To view a copy of this license, visit http://creativecommons.org/licenses/by-nc-sa/2.5/ or
* send a letter to Creative Commons, 543 Howard Street, 5th Floor, San Francisco, California, 94105, USA.
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$settings['class_sfx']			= $params->get('moduleclass_sfx', '');
$settings['handler']			= $params->get('handler', '');

$settings['where']				= $params->get('where', 'category');
$settings['where_id']			= trim( $params->get('where_id', '') );
$settings['nodup']				= intval( $params->get('nodup', 1) );
$settings['ordering']			= $params->get('ordering', 'order');
$settings['count']				= intval( $params->get('count', 5) );
$settings['rowcount']			= intval( $params->get('rowcount', 1) );
$settings['bots']				= intval( $params->get('bots', 1) );

$settings['width']				= trim( $params->get('width', '100%') );
$settings['display']			= intval( $params->get('display', 2) );
$settings['hseparator']			= trim( $params->get('hseparator', '') );
$settings['hleftspace']			= intval( $params->get('hleftspace', 5) );
$settings['hrightspace']		= intval( $params->get('hrightspace', 10) );
$settings['vseparator']			= trim( $params->get('vseparator', '') );
$settings['vtopspace']			= intval( $params->get('vtopspace', 5) );
$settings['vbottomspace']		= intval( $params->get('vbottomspace', 10) );

$settings['showdate']			= intval( $params->get('date', 1) );
$settings['datepos']			= $params->get('datepos', 'after');
$settings['dateform']			= $params->get('dateform', '(d.m.Y)');
$settings['datelinked']			= intval( $params->get('datelinked', 0) );

$settings['showthumb']			= intval( $params->get('thumbnail', 1) );
$settings['thumbpos']			= $params->get('thumbpos', 'float_left');
$settings['thumbdefault']		= trim( $params->get('thumbdefault', 'images/M_images/arrow.png') );
$settings['linkedthumb']		= intval( $params->get('linkedthumb', 0) );
$settings['thumbwidth']			= intval( $params->get('thumbwidth', 64) );
$settings['thumbheight']		= intval( $params->get('thumbheight', 48) );
$settings['thumbmethod']		= intval( $params->get('thumbmethod', 0) );
$settings['thumbratio']			= intval( $params->get('thumbratio', 3) );
$settings['realthumb']			= intval( $params->get('realthumb', 0) );
$settings['thumbpath']			= trim( $params->get('thumbpath', 'images/thumbnails') );
$settings['imagelib']			= trim( $params->get('imagelib', 'gd2') );
$settings['imglibpath']			= trim( $params->get('imglibpath', '') );

$settings['linked']				= intval( $params->get('linked', 0) );
$settings['pdf']				= intval( $params->get('pdf', 0) );
$settings['print']				= intval( $params->get('print', 0) );
$settings['email']				= intval( $params->get('email', 0) );
$settings['icons']				= intval( $params->get('icons', 1) );
$settings['buttonpos']			= $params->get('buttonpos', 'beside');
$settings['buttonarrange']		= $params->get('buttonarrange', 'horizontal');
$settings['author']				= intval( $params->get('author', 0) );
$settings['onlyintro']			= intval( $params->get('onlyintro', 1) );
$settings['chars']				= intval( $params->get('chars', 0) );
$settings['words']				= intval( $params->get('words', 0) );
$settings['more']				= intval( $params->get('more', 1) );
$settings['openin']				= intval( $params->get('openin', 0) );

if (!defined( '_JOOMLA_ROOT' )) define( '_JOOMLA_ROOT', str_replace('\\', '/', dirname(__FILE__)).'/..' );

require_once( _JOOMLA_ROOT.'/modules/mod_d4j_content_listing/d4jGenericImage.php' );
require_once( _JOOMLA_ROOT.'/modules/mod_d4j_content_listing/d4jContentFetching.php' );

// no duplication check
if ($settings['nodup']) {
	// is any article loaded?
	$loaded = $mainframe->get("d4jContentFetching_loaded", false);
	if (!$loaded) {
		$loaded = array();
		$mainframe->set("d4jContentFetching_loaded", $loaded);
	}
} else {
	$loaded = array();
}

$moduleInstance = new d4jContentFetching($settings, _JOOMLA_ROOT, $loaded);
echo $moduleInstance->produceOutput();

// no duplication check
if ($settings['nodup']) {
	// store loaded article
	$loaded = $moduleInstance->loadedArticle();
	$mainframe->set("d4jContentFetching_loaded", $loaded);
}

unset($moduleInstance);
?>