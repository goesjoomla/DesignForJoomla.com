<?php
/**
* Instant Search module v1.3
*
* @copyright Nguyen Manh Cuong
*       Author`s email   : cuongnm@designforjoomla.com
*       Author`s hompage : http://designforjoomla.com
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
**/

/** Set flag that this is a parent file */
define( '_VALID_MOS', 1 );

include_once( '../globals.php' );
require_once( '../configuration.php' );
require_once( '../includes/joomla.php' );

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );

function subscribe( &$vars ) {
	$pages = $vars['pages'];
	$uid = $vars['uid'] ? $vars['uid'] : 0;
	$email = $vars['email'] ? $vars['email'] : '';
	$name = $vars['name'] ? $vars['name'] : '';

	global $database, $ajax_engine;

	if (is_numeric($uid) AND $uid > 0) {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE uid = '$uid' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($selected_pages); $i < $n; $i++) {
				if (!in_array($selected_pages[$i], $subcribed_pages)) {
					$subcribed_pages[] = $selected_pages[$i];
				}
			}
			$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
		} else {
			$database->setQuery("INSERT INTO #__ezine_newsletter_users (uid,subcribed_pages,date_join) VALUES ('$uid','$pages','".date( 'Y-m-d H:i:s' )."')");
		}
		if (!$database->query()) {
			$ajax_engine->setAttribute('success', 'false');
			return;
		}
	}

	if ($email != '') {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE email = '$email' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($selected_pages); $i < $n; $i++) {
				if (!in_array($selected_pages[$i], $subcribed_pages)) {
					$subcribed_pages[] = $selected_pages[$i];
				}
			}
			$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
		} else {
			$database->setQuery("INSERT INTO #__ezine_newsletter_users (name,email,subcribed_pages,date_join) VALUES ('$name','$email','$pages','".date( 'Y-m-d H:i:s' )."')");
		}
		if (!$database->query()) {
			$ajax_engine->setAttribute('success', 'false');
			return;
		}
	}

	$ajax_engine->setAttribute('success', 'true');
	return $user->id ? implode(',', $subcribed_pages) : $pages;
}

function unsubscribe( &$vars ) {
	$pages = $vars['pages'];
	$uid = $vars['uid'] ? $vars['uid'] : 0;
	$email = $vars['email'] ? $vars['email'] : '';

	global $database, $ajax_engine;

	if (is_numeric($uid) AND $uid > 0) {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE uid = '$uid' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($subcribed_pages); $i < $n; $i++) {
				if (in_array($subcribed_pages[$i], $selected_pages)) {
					unset($subcribed_pages[$i]);
					$i--;
				}
			}
			if (count($subcribed_pages)) {
				$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
			} else {
				$database->setQuery("DELETE FROM #__ezine_newsletter_users WHERE id = '".$user->id."' LIMIT 1");
			}
			if (!$database->query()) {
				$ajax_engine->setAttribute('success', 'false');
				return;
			}
		}
	}

	if ($email != '') {
		$database->setQuery("SELECT id,subcribed_pages FROM #__ezine_newsletter_users WHERE email = '$email' LIMIT 0,1");
		$database->loadObject($user);
		if ($user->id) {
			$selected_pages = explode(',', $pages);
			$subcribed_pages = explode(',', $user->subcribed_pages);
			for ($i = 0, $n = count($subcribed_pages); $i < $n; $i++) {
				if (in_array($subcribed_pages[$i], $selected_pages)) {
					unset($subcribed_pages[$i]);
					$i--;
				}
			}
			if (count($subcribed_pages)) {
				$database->setQuery("UPDATE #__ezine_newsletter_users SET subcribed_pages = '".implode(',', $subcribed_pages)."' WHERE id = '".$user->id."' LIMIT 1");
			} else {
				$database->setQuery("DELETE FROM #__ezine_newsletter_users WHERE id = '".$user->id."' LIMIT 1");
			}
			if (!$database->query()) {
				$ajax_engine->setAttribute('success', 'false');
				return;
			}
		}
	}

	$ajax_engine->setAttribute('success', 'true');
	return count($subcribed_pages) ? implode(',', $subcribed_pages) : '0';
}

if (file_exists(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_d4j_ezine/class/php/d4jAjaxEngine.php'))
	require_once(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_d4j_ezine/class/php/d4jAjaxEngine.php');
elseif (file_exists(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_ezine/class/php/d4jAjaxEngine.php'))
	require_once(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_ezine/class/php/d4jAjaxEngine.php');

$ajax_engine = new d4j_ajax_engine();
$ajax_engine->return_data();
?>