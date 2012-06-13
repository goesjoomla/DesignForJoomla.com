<?php
/**
* eZine component :: public switch
**/

/** ensure this file is being included by a parent file */
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

// parse parameters
$option	= mosGetParam( $_REQUEST, 'option', 'com_ezine' );
$task	= mosGetParam( $_REQUEST, 'task', '' );
$act	= mosGetParam( $_REQUEST, 'act', '' );
$func	= mosGetParam( $_REQUEST, 'func', '' );

$func = $task != '' ? $task : ($act != '' ? $act : $func);

// require classes files
$html_path = $mainframe->getPath('front_html', $option);
require_once(str_replace('.html.php', '.func.php', $html_path));

// determine which task to execute
switch ($task) {
	case 'cover':
		showCover($pageid, $params);
		break;
	case 'view':
		$category_id = intval(mosGetParam($_REQUEST, 'category', ''));
		$query = "SELECT * FROM #__ezine_category WHERE id = '$category_id' AND published = '1' LIMIT 0, 1";
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		$params->set('pagination', 1);
		showCategory($rows[0], $params);
		break;
	case 'read':
		$category_id = mosGetParam($_REQUEST, 'category', 0);
		if ($category_id != 'featured') {
			$category_id = intval($category_id);
		}
		$article_id = intval(mosGetParam($_REQUEST, 'article', ''));
		$params->set('ezine_cat_id', $category_id);
		$params->set('ezine_cat_Itemid', $Itemid);
		showFullArticle($article_id, $params);
		break;
	case 'newsletter_subscribe':
		newsletterSubsribe($params);
		break;
	case 'ajax_call':
		require_once( _D4J_PRODUCT_FRONTEND_PATH.'/class/php/d4jAjaxEngine.php' );
		$ajax_engine = new d4j_ajax_engine();
		$ajax_engine->return_data();
		break;
	case 'index':
	default:
		showPage($pageid, $params);
		break;
}

if ($task != 'ajax_call') {
	echo $return_html;
}
?>