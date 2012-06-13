<?php
/**
* D4J Content Embedding Joomla! extension v1.0 :: plugin file
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

$_MAMBOTS->registerFunction( 'onPrepareContent', 'botContentEmbedding' );

if (!defined( '_JOOMLA_ROOT' )) define( '_JOOMLA_ROOT', str_replace('\\', '/', dirname(__FILE__)).'/../..' );

require_once( _JOOMLA_ROOT.'/mambots/content/d4j_content_embedding/d4jGenericImage.php' );
require_once( _JOOMLA_ROOT.'/mambots/content/d4j_content_embedding/d4jContentFetching.php' );

function botContentEmbedding( $published, &$row, &$params, $page=0 ) {
	global $_MAMBOTS, $database, $option, $task;

 	// expression to search for
	$regex = '/{(contentembedding)\s*(.*?)}/i';

	// if mambot is not published, clear all bot tags then return
	if (!$published) {
		$row->text = preg_replace( $regex, '', $row->text );
		return false;
	}

	// find all instances of mambot and put in $matches
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

 	// Number of mambots
	$count = count($matches);

 	// mambot only processes if there are any instances of the mambot in the text
 	if ( $count ) {
		// no duplication
		if ( !isset($_MAMBOTS->_content_mambot_params['contentembedding_loaded']) )
			$_MAMBOTS->_content_mambot_params['contentembedding_loaded'] = array();
		$_MAMBOTS->_content_mambot_params['contentembedding_loaded'][] = $row->id;

		// check if param query has previously been processed
		if ( !isset($_MAMBOTS->_content_mambot_params['contentembedding']) ) {
			// load mambot params info
			$query = "SELECT params"
			. "\n FROM #__mambots"
			. "\n WHERE element = 'd4j_content_embedding'"
			. "\n AND folder = 'content'"
			;
			$database->setQuery( $query );
			$database->loadObject($mambot);

			// save query to class variable
			$_MAMBOTS->_content_mambot_params['contentembedding'] = $mambot;
		}

		// pull query data from class variable
		$mambot = $_MAMBOTS->_content_mambot_params['contentembedding'];

	 	$botParams = new mosParameters( $mambot->params );
	 	$botParams->def( 'processon', 'article' );

	 	if ( ( $option == 'com_content' AND (
	 		($botParams->get('processon') == 'blog' AND ($task == 'blogsection' OR $task == 'blogcategory'))
	 		OR
	 		($botParams->get('processon') == 'article' AND $task == 'view')
	 		OR
	 		($botParams->get('processon') == 'both' AND ($task == 'blogsection' OR $task == 'blogcategory' OR $task == 'view'))
	 	) ) OR ( $option == 'com_ezine' AND (
	 		($botParams->get('processon') == 'blog' AND ($task != 'read'))
	 		OR
	 		($botParams->get('processon') == 'article' AND $task == 'read')
	 		OR
	 		($botParams->get('processon') == 'both')
	 	) ) ) {
	 		$articles = processContentEmbedding( $row, $botParams, $matches, $count );

			// store some vars in globals to access from the replacer
			$GLOBALS['botContentEmbeddingCount']		= 0;
			$GLOBALS['botContentEmbeddingArray']		=& $articles;

			// perform the replacement
			$row->text = preg_replace_callback( $regex, 'replaceContentEmbedding', $row->text );

			// clean up globals
			unset( $GLOBALS['botContentEmbeddingCount'] );
			unset( $GLOBALS['botContentEmbeddingArray'] );

			return true;
		} else {
			$row->text = preg_replace( '/{contentembedding\s*.*?}/i', '', $row->text );
		}
	}

	return false;
}

function processContentEmbedding( &$row, &$botParams, &$matches, $count ) {
	global $_MAMBOTS;
	$articles = array();

	for ( $i = 0; $i < $count; $i++ ) {
		// get params defined in bot tag
		if (isset($matches[$i][2])) {
 			parse_str( str_replace( '&amp;', '&', $matches[$i][2] ), $args );
 		}

		$settings['class_sfx'] =
			trim( isset($args['class_sfx'])		? $args['class_sfx']	: $botParams->get('class_sfx', '') );
		$settings['handler'] =
			trim( isset($args['handler'])		? $args['handler']		: $botParams->get('handler', '') );

		$settings['where'] =
			trim( isset($args['where'])			? $args['where']		: $botParams->get('where', 'category') );
		$settings['where_id'] =
			trim( isset($args['where_id'])		? $args['where_id']		: $botParams->get('where_id', '') );
		$settings['nodup'] =
			trim( isset($args['nodup'])			? $args['nodup']		: $botParams->get('nodup', 1) );
		$settings['ordering'] =
			trim( isset($args['ordering'])		? $args['ordering']		: $botParams->get('ordering', 'order') );
		$settings['count'] =
			intval( isset($args['count'])		? $args['count']		: $botParams->get('count', 5) );
		$settings['rowcount'] =
			intval( isset($args['rowcount'])	? $args['rowcount']		: $botParams->get('rowcount', 1) );
		$settings['bots'] =
			intval( isset($args['bots'])		? $args['bots']			: $botParams->get('bots', 1) );

		$settings['width'] =
			trim( isset($args['width'])				? $args['width']		: $botParams->get('width', '100%') );
		$settings['display'] =
			intval( isset($args['display'])			? $args['display']		: $botParams->get('display', 2) );
		$settings['hseparator'] =
			trim( isset($args['hseparator'])		? $args['hseparator']	: $botParams->get('hseparator', '') );
		$settings['hleftspace'] =
			intval( isset($args['hleftspace'])		? $args['hleftspace']	: $botParams->get('hleftspace', 5) );
		$settings['hrightspace'] =
			intval( isset($args['hrightspace'])		? $args['hrightspace']	: $botParams->get('hrightspace', 10) );
		$settings['vseparator'] =
			trim( isset($args['vseparator'])		? $args['vseparator']	: $botParams->get('vseparator', '') );
		$settings['vtopspace'] =
			intval( isset($args['vtopspace'])		? $args['vtopspace']	: $botParams->get('vtopspace', 5) );
		$settings['vbottomspace'] =
			intval( isset($args['vbottomspace'])	? $args['vbottomspace']	: $botParams->get('vbottomspace', 10) );

		$settings['showdate'] =
			intval( isset($args['showdate'])	? $args['showdate']		: $botParams->get('date', 1) );
		$settings['datepos'] =
			trim( isset($args['datepos'])		? $args['datepos']		: $botParams->get('datepos', 'after') );
		$settings['dateform'] =
			trim( isset($args['dateform'])		? $args['dateform']		: $botParams->get('dateform', '(d.m.Y)') );
		$settings['datelinked'] =
			intval( isset($args['datelinked'])	? $args['datelinked']	: $botParams->get('datelinked', 0) );

		$settings['showthumb'] =
			intval( isset($args['showthumb'])	? $args['showthumb']	: $botParams->get('thumbnail', 1) );
		$settings['thumbpos'] =
			trim( isset($args['thumbpos'])		? $args['thumbpos']		: $botParams->get('thumbpos', 'float_left') );
		$settings['thumbdefault'] =
			trim( isset($args['thumbdefault'])	? $args['thumbdefault']	: $botParams->get('thumbdefault', 'images/M_images/arrow.png') );
		$settings['linkedthumb'] =
			intval( isset($args['linkedthumb'])	? $args['linkedthumb']	: $botParams->get('linkedthumb', 0) );
		$settings['thumbwidth'] =
			intval( isset($args['thumbwidth'])	? $args['thumbwidth']	: $botParams->get('thumbwidth', 64) );
		$settings['thumbheight'] =
			intval( isset($args['thumbheight'])	? $args['thumbheight']	: $botParams->get('thumbheight', 48) );
		$settings['thumbmethod'] =
			intval( isset($args['thumbmethod'])	? $args['thumbmethod']	: $botParams->get('thumbmethod', 0) );
		$settings['thumbratio'] =
			intval( isset($args['thumbratio'])	? $args['thumbratio']	: $botParams->get('thumbratio', 3) );
		$settings['realthumb'] =
			intval( isset($args['realthumb'])	? $args['realthumb']	: $botParams->get('realthumb', 0) );
		$settings['thumbpath'] =
			trim( isset($args['thumbpath'])		? $args['thumbpath']	: $botParams->get('thumbpath', 'images/thumbnails') );
		$settings['imagelib'] =
			trim( isset($args['imagelib'])		? $args['imagelib']		: $botParams->get('imagelib', 'gd2') );
		$settings['imglibpath'] =
			trim( isset($args['imglibpath'])	? $args['imglibpath']	: $botParams->get('imglibpath', '') );

		$settings['linked'] =
			intval( isset($args['linked'])		? $args['linked']			: $botParams->get('linked', 0) );
		$settings['pdf'] =
			intval( isset($args['pdf'])			? $args['pdf']				: $botParams->get('pdf', 0) );
		$settings['print'] =
			intval( isset($args['print'])		? $args['print']			: $botParams->get('print', 0) );
		$settings['email'] =
			intval( isset($args['email'])		? $args['email']			: $botParams->get('email', 0) );
		$settings['icons'] =
			intval( isset($args['icons'])		? $args['icons']			: $botParams->get('icons', 1) );
		$settings['buttonpos'] =
			trim( isset($args['buttonpos'])		? $args['buttonpos']		: $botParams->get('buttonpos', 'beside') );
		$settings['buttonarrange'] =
			trim( isset($args['buttonarrange'])	? $args['buttonarrange']	: $botParams->get('buttonarrange', 'horizontal') );
		$settings['author'] =
			intval( isset($args['author'])		? $args['author']			: $botParams->get('author', 0) );
		$settings['onlyintro'] =
			intval( isset($args['onlyintro'])	? $args['onlyintro']		: $botParams->get('onlyintro', 1) );
		$settings['chars'] =
			intval( isset($args['chars'])		? $args['chars']			: $botParams->get('chars', 0) );
		$settings['words'] =
			intval( isset($args['words'])		? $args['words']			: $botParams->get('words', 0) );
		$settings['more'] =
			intval( isset($args['more'])		? $args['more']				: $botParams->get('more', 1) );
		$settings['openin'] =
			intval( isset($args['openin'])		? $args['openin']			: $botParams->get('openin', 0) );

		// no duplication check
		if ($settings['nodup']) {
			// is any article loaded?
			global $mainframe;
			$loaded = $mainframe->get("d4jContentFetching_loaded", false);
			if (!$loaded) {
				$loaded = $_MAMBOTS->_content_mambot_params['contentembedding_loaded'];
				$mainframe->set("d4jContentFetching_loaded", $loaded);
			} else
				$loaded = array_merge($loaded, $_MAMBOTS->_content_mambot_params['contentembedding_loaded']);
		} else {
			// prevent loading of current article to ignore forever loop
			$loaded = $_MAMBOTS->_content_mambot_params['contentembedding_loaded'];
		}

		$retrieving = new d4jContentFetching($settings, _JOOMLA_ROOT, $loaded);
		$articles[] = $retrieving->produceOutput();

		// no duplication check
		if ($settings['nodup']) {
			// store loaded article
			$loaded = $retrieving->loadedArticle();
			$mainframe->set("d4jContentFetching_loaded", $loaded);
		}

		unset($retrieving);
	}

	return $articles;
}

function replaceContentEmbedding( &$matches ) {
	$i = $GLOBALS['botContentEmbeddingCount']++;

	return @$GLOBALS['botContentEmbeddingArray'][$i];
}
?>