<?php
/**
* eZine component :: SEF extension
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class sef_ezine {
	/**
	* Creates the SEF Advance URL out of the Joomla! request
	**/
	function create($string) {
		global $database;
		$string = str_replace( '&amp;', '&', $string );
		$sefstring = '';

		// check for existed SEF URL
		$database->setQuery("SELECT sef_url FROM #__ezine_sef WHERE original_url = '$string' LIMIT 0,1");
		if ($rows = $database->loadObjectList()) {
			$sefstring = $rows[0]->sef_url;
		} else { // SEF URL not existed yet
			// get the SEF Extension configuration of eZine
			$database->setQuery("SELECT * FROM #__ezine_config WHERE `name` LIKE 'sef_%'");
			$settings = $database->loadObjectList();
			$params = new mosParameters('');
			for ($i = 0, $n = count($settings); $i < $n; $i++) {
				$params->set($settings[$i]->name, $settings[$i]->value);
			}
			$params->def('sef_lowercase_all', 1);
			$params->def('sef_replace_char', '_');
			$params->def('sef_url_format', 2); // http://mosConfig_live_site/eZine_page/eZine_category/article_title/
			$params->def('sef_page_field', 0);
			$params->def('sef_category_field', 0);
			$params->def('sef_article_field', 0);
			$params->def('sef_multipage_form', '%s_page_%d');

			// parse GET variables
			parse_str($string, $getv);
			if (!isset($getv['task'])) $getv['task'] = '';
			if (!isset($getv['Itemid']) OR $getv['Itemid'] == '') {
				// no Itemid present, try to determine if any menu item exists for this link
				$stringParts = explode('&', preg_replace("/&Itemid=/", '', $string));
				for ($i1 = count($stringParts) - 1; $i1 >= 0; $i1--) {
					$tmpStr = '';
					for ($i2 = 0; $i2 <= $i1; $i2++) {
						$tmpStr .= ($i2 == 0 ? '' : '&').$database->getEscaped($stringParts[$i2]);
					}
					if (preg_match("/article=/", $tmpStr)) {
						if (!preg_match("/task=read/", $tmpStr)) {
							$tmpStr = preg_replace("/task=[^&]*/", 'task=read', $tmpStr);
						}
					} elseif (preg_match("/category=/", $tmpStr)) {
						if (!preg_match("/task=view/", $tmpStr)) {
							$tmpStr = preg_replace("/task=[^&]*/", 'task=view', $tmpStr);
						}
					}
					$database->setQuery("SELECT id FROM #__menu WHERE link = '$tmpStr'", 0, 1);
					if ($rows = $database->loadObjectList()) {
						$getv['Itemid'] = $rows[0]->id;
						if (!isset($getv['Itemid'])) {
							$string .= '&Itemid='.$getv['Itemid'];
						} else {
							$string = preg_replace("/&Itemid=/", '&Itemid='.$getv['Itemid'], $string);
						}
						break;
					}
				}
			}

			// create SEF URL
			switch ($getv['task']) {
				case 'cover': // eZine cover output
					$sefstring .= createEzineCoverSefUrl($params, intval($getv['Itemid']));
					break;
				case 'view': // eZine category output
					$sefstring .= createEzineCategorySefUrl($params, intval($getv['page']), intval($getv['category']));
					break;
				case 'read': // eZine article output
					if ($getv['category'] != 'featured') {
						$getv['category'] = intval($getv['category']);
					}
					$sefstring .= createEzineArticleSefUrl($params, intval($getv['page']), $getv['category'], intval($getv['article']));
					break;
				case 'newsletter_subscribe': // eZine newsletter subscribe output
					$sefstring .= createEzineSubscribeSefUrl();
					break;
				case 'index': // eZine page output
				default:
					$sefstring .= createEzinePageSefUrl($params, intval($getv['Itemid']), $getv['task']);
					break;
			}

			// multi-page support
			if (isset($getv['limit']) AND isset($getv['limitstart']) AND $getv['limitstart'] > 0) {
				$sefstring = sprintf($params->get('sef_multipage_form'), $sefstring, ($getv['limitstart']/$getv['limit']) + 1);
			}

			// final SEF URL
			if ($params->get('sef_lowercase_all'))
				$sefstring = strtolower($sefstring);
			if ($sefstring != '') {
				$sefstring .= '/';
				// if SEF URL not stored, store SEF URL to db table now
				$database->setQuery("SELECT id FROM #__ezine_sef WHERE sef_url = '$sefstring' LIMIT 0,1");
				if ($existed = $database->loadObjectList()) {
					// SEF URL existed
				} else {
					// store SEF URL
					$database->setQuery("INSERT INTO #__ezine_sef (original_url, sef_url) VALUES ('$string', '$sefstring')");
					$database->query();
				}
			}
		}

		return $sefstring;
	}

 	/**
	* Reverts to the Joomla query string out of the SEF advance URL
	**/
 	function revert($url_array, $pos) {
		global $database, $mosConfig_live_site, $sefconfig, $sefConfig;
		$url_suffix = isset($sefconfig) ? $sefconfig->suffix : (isset($sefConfig) ? $sefConfig->suffix : '');

		$QUERY_STRING = '';
		// get requested URL
		if (isset($_SERVER['REQUEST_URI'])) {
			$requestedString = $_SERVER['REQUEST_URI'];
		} else {
			$requestedString = '/';
			for ($i = 0, $n = count($url_array); $i < $n; $i++) {
				$requestedString .= $url_array[$i] != '' ? $url_array[$i].'/' : '';
			}
		}

		// check if Joomla is not installed in virtual host root directory
		$liveSiteParts = explode('/', preg_replace("/^(http)s?(:\/\/)/", '', $mosConfig_live_site));
		$liveSiteVPath = '/';
		if (count($liveSiteParts) > 1) {
			for ($i = 1, $n = count($liveSiteParts); $i < $n; $i++) {
				$liveSiteVPath .= $liveSiteParts[$i].'/';
			}
		}
		// clear the folder where Joomla is installed in from the request URL
		if (preg_match("/".str_replace('/', '\/', $liveSiteVPath)."/", $requestedString))
			$requestedString = substr($requestedString, strlen($liveSiteVPath), strlen($requestedString));

		// store the component name or menu item title for further reference
		list($menu_title, $requestedString) = explode('/', $requestedString, 2);

		// clear the URL suffix from the request URL
		$requestedString = str_replace($url_suffix, '/', $requestedString);
		if ($requestedString == '/')
			$requestedString = '';

		if ($requestedString != '') {
			// get original URL
			$database->setQuery("SELECT original_url FROM #__ezine_sef WHERE sef_url = '$requestedString' LIMIT 0,1");
		} else {
			// get menu item URL and ID
			$database->setQuery("SELECT CONCAT(`link`, '&Itemid=', `id`) AS original_url FROM #__menu WHERE"
			. "\n `link` = 'index.php?option=com_ezine' AND"
			. "\n (`name` = '$menu_title' OR LOWER(`name`) = '$menu_title' OR REPLACE(`name`, ' ', '') = '$menu_title'"
			. "\n OR REPLACE(`name`, ' ', '-') = '$menu_title' OR REPLACE(`name`, ' ', '_') = '$menu_title')");
		}
		if ($rows = $database->loadObjectList()) {
			$originalString = substr($rows[0]->original_url, strpos($rows[0]->original_url, '&') + 1, strlen($rows[0]->original_url));
		} elseif (preg_match("/^(index)2?(\.php)\??(.*?)$/", $requestedString)) {
			$originalString = substr($requestedString, strpos($requestedString, '&') + 1, strlen($requestedString));
		}

		// parse original string
		if (isset($originalString)) {
			parse_str($originalString, $getv);
			foreach ($getv AS $k => $v) {
				$GLOBALS[$k] = $_GET[$k] = $_REQUEST[$k] = $v;
			}
			$QUERY_STRING = '&'.$originalString;
		}

		return $QUERY_STRING;
	}
}

// create eZine page output URL
function createEzinePageSefUrl($params, $Itemid, $task = '') {
	global $database;
	$pageStr = '';

	if ($params->get('sef_url_format') == '2') {
		// get menu item parameters
		$database->setQuery("SELECT params FROM #__menu WHERE id = '$Itemid' LIMIT 0,1");
		if ($rows = $database->loadObjectList()) {
			$page_params = new mosParameters($rows[0]->params);
			if ($page_params->get('page_id') != '') {
				// get menu_name/page_title for making SEF URL
				$q = "SELECT ".($params->get('sef_page_field') == 0 ? 'menu_name' : 'page_title')." AS pageStr FROM #__ezine_page WHERE id = '".intval( $page_params->get('page_id') )."' LIMIT 0,1";
				$database->setQuery($q);
				if ($rows = $database->loadObjectList()) {
					$pageStr .= preg_replace("/\W/", $params->get('sef_replace_char'), $rows[0]->pageStr);
				}
			}
		}
	}

	if ($task == 'index')
		$pageStr .= ($pageStr == '' ? '' : '/').'Index';

	return $pageStr;
}

// create eZine cover output URL
function createEzineCoverSefUrl($params, $Itemid) {
	global $database;
	$pageStr = '';

	if ($params->get('sef_url_format') == '2') {
		$pageStr .= createEzinePageSefUrl($params, $Itemid);
	}

	return ($pageStr == '' ? 'Cover' : $pageStr.'/Cover');
}

// create eZine category output URL
function createEzineCategorySefUrl($params, $page, $category) {
	global $database;
	$pageStr = '';

	if ($params->get('sef_url_format') == '2') {
		// get menu_name/page_title for making SEF URL
		$q = "SELECT ".($params->get('sef_page_field') == 0 ? 'menu_name' : 'page_title')." AS pageStr FROM #__ezine_page WHERE id = '$page' LIMIT 0,1";
		$database->setQuery($q);
		if ($rows = $database->loadObjectList()) {
			$pageStr .= preg_replace("/\W/", $params->get('sef_replace_char'), $rows[0]->pageStr);
		}
	}

	if ($params->get('sef_url_format') != '0') {
		if ($category == 'featured') {
			$pageStr .= ($pageStr != '' ? '/' : '').'Featured_Articles';
		} else {
			// get category name/title for making SEF URL
			$database->setQuery("SELECT contentid, content_type FROM #__ezine_category WHERE pageid = '$page' AND id = '$category' LIMIT 0,1");
			if ($rows = $database->loadObjectList()) {
				$q = "SELECT ".($params->get('sef_category_field') == 0 ? 'name' : 'title')." AS categoryStr FROM #__".($rows[0]->content_type == 'category' ? 'categories' : 'sections')." WHERE id = '".$rows[0]->contentid."' LIMIT 0,1";
				$database->setQuery($q);
				if ($rows = $database->loadObjectList()) {
					$pageStr .= ($pageStr != '' ? '/' : '').preg_replace("/\W/", $params->get('sef_replace_char'), $rows[0]->categoryStr);
				}
			}
		}
	}

	return $pageStr;
}

// create eZine article output URL
function createEzineArticleSefUrl($params, $page, $category, $article) {
	global $database;
	$pageStr = createEzineCategorySefUrl($params, $page, $category);

	// get article title/alias for making SEF URL
	$q = "SELECT ".($params->get('sef_article_field') == 0 ? 'title' : 'title_alias')." AS articleStr FROM #__content WHERE id = '$article' LIMIT 0,1";
	$database->setQuery($q);
	if ($rows = $database->loadObjectList()) {
		$pageStr .= ($pageStr != '' ? '/' : '').preg_replace("/\W/", $params->get('sef_replace_char'), $rows[0]->articleStr);
	}

	return $pageStr;
}

// create eZine newsletter subscribe output URL
function createEzineSubscribeSefUrl() {
	return 'Newsletter_Subscribe';
}
?>