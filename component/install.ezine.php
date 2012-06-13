<?php
/**
* eZine component :: installation
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function com_install() {
	global $database, $mosConfig_absolute_path, $mosConfig_live_site;

	echo 'Importing old data if exist ...';
	$success = true;
	$database->setQuery("SELECT * FROM `#__mamboezine_page` WHERE 1");
	if ($database->query() AND ($rows = $database->loadObjectList())) {
		foreach ($rows AS $row) {
			$params = 'show_title='.$row->show_title."\n";
			$database->setQuery("INSERT INTO `#__ezine_page`
				(`id`,`menu_name`,`page_title`,`params`) VALUES
				('".$row->id."','".$row->menu_name."','".$row->page_title."','".$params."')");
			if (!$database->query()) {
				$success = false;
			}
		}
	}
	$database->setQuery("SELECT * FROM `#__mamboezine_category` WHERE 1");
	if ($database->query() AND ($rows = $database->loadObjectList())) {
		foreach ($rows AS $row) {
			$params = 'intro_news='.$row->intros."\n";
			$params .= 'intro_cols='.$row->columns."\n";
			$params .= 'links='.$row->links."\n";
			$params .= 'intro_only='.$row->intro_only."\n";
			$params .= 'frontpage_only='.$row->frontpage_only."\n";
			$params .= 'intro_with_img='.$row->img_in_intro."\n";
			$params .= 'link_with_img='.$row->img_in_link."\n";
			$params .= 'cat_title_img='.$row->img_cat_title."\n";
			$params .= 'more_cat_news_img='.$row->img_cat_more."\n";
			$params .= 'order_news_by='.$row->news_order."\n";
			$database->setQuery("INSERT INTO `#__ezine_category`
				(`id`,`pageid`,`contentid`,`content_type`,`ordering`,`params`) VALUES
				('".$row->id."','".$row->pageid."','".$row->catid."','".(($row->is_separator) <> 0 ? 'separator' : 'category')."','".$row->ordering."','".$params."')");
			if (!$database->query()) {
				$success = false;
			}
		}
	}
	$database->setQuery("SELECT * FROM `#__mamboezine_separator` WHERE 1");
	if ($database->query() AND ($rows = $database->loadObjectList())) {
		foreach ($rows AS $row) {
			if ($row->type == 'content_item') {
				$content_id = $row->content_item_id;
			} elseif ($row->type == 'static_content') {
				$content_id = $row->$row->typed_content_id;
			} else {
				$content_id = 0;
			}
			$database->setQuery("INSERT INTO `#__ezine_separator`
				(`id`,`type`,`content_id`,`html_code`) VALUES
				('".$row->id."','".$row->type."','".$content_id."','".$row->html_code."')");
			if (!$database->query()) {
				$success = false;
			}
		}
	}
	if ($success) {
		echo '... done!<br/>';
	} else {
		echo '... fail!<br/>';
	}

	echo 'Creating eZineMenu if not exist ...';
	// check if eZineMenu is created or not?
	$query = "SELECT params FROM #__modules WHERE module = 'mod_mainmenu'";
	$database->setQuery( $query );
	$menus = $database->loadResultArray();
	$menu_exist = false;
	foreach ( $menus as $menu ) {
		$params = mosParseParams( $menu );
		if ( $params->menutype == 'ezinemenu' ) {
			echo '... done!<br/>';
			$menu_exist = true;
			break;
		}
	}
	// if eZineMenu is not created, create now
	if (!$menu_exist) {
		$success = true;
		$row = new mosModule( $database );
		$row->title = 'eZineMenu';
		$row->iscore = 0;
		$row->published = 0;
		$row->position = 'left';
		$row->module = 'mod_mainmenu';
		$row->params = 'menutype=ezinemenu';

		// check then store data in db
		if (!$row->check()) {
			$success = false;
		}
		if (!$row->store()) {
			$success = false;
		}

		$row->checkin();
		$row->updateOrder( "position='". $row->position ."'" );

		// module assigned to show on All pages by default
		$query = "INSERT INTO #__modules_menu VALUES ( $row->id, 0 )";
		$database->setQuery( $query );
		if ( !$database->query() ) {
			$success = false;
		}

		if ( $success ) {
			echo '... done!<br/>';
		} else {
			echo '... fail!<br/>';
		}
	}

	echo 'Copying required files ...';
	if (!copy($mosConfig_absolute_path.'/components/com_ezine/blank.html', $mosConfig_absolute_path.'/blank.html')) {
		echo '<p>You need to manually copy the file <b style="font-size:125%; color:#ff6600">blank.html</b><br/>from folder <b style="font-size:125%; color:#ff6600">'.$mosConfig_absolute_path.'/components/com_ezine</b><br/>to your Joomla root directory.</p>';
		$success = false;
	} else {
		unlink($mosConfig_absolute_path.'/components/com_ezine/blank.html');
	}
	if ($success) {
		echo '... done!<br/>';
	} else {
		echo '... fail!<br/>';
	}

	// support for Artio JoomSef
	if (file_exists($mosConfig_absolute_path.'/components/com_sef/joomsef.php') AND is_dir($mosConfig_absolute_path.'/components/com_sef/sef_ext')) {
		echo 'Copying SEF Extension for ARTIO JoomSEF v1.3.2 ...';
		if (!copy($mosConfig_absolute_path.'/components/com_ezine/joomsef_ext/com_ezine.php', $mosConfig_absolute_path.'/components/com_sef/sef_ext/com_ezine.php')) {
			echo '<p>You need to manually copy the file <b style="font-size:125%; color:#ff6600">com_ezine.php</b><br/>from folder <b style="font-size:125%; color:#ff6600">'.$mosConfig_absolute_path.'/components/com_ezine/joomsef_ext</b><br/>to folder <b style="font-size:125%; color:#ff6600">'.$mosConfig_absolute_path.'/components/com_sef/sef_ext</b>.</p>';
			$success = false;
		} else {
			unlink($mosConfig_absolute_path.'/components/com_ezine/joomsef_ext/com_ezine.php');
		}
		if (!copy($mosConfig_absolute_path.'/components/com_ezine/joomsef_ext/com_ezine.xml', $mosConfig_absolute_path.'/components/com_sef/sef_ext/com_ezine.xml')) {
			echo '<p>You need to manually copy the file <b style="font-size:125%; color:#ff6600">com_ezine.xml</b><br/>from folder <b style="font-size:125%; color:#ff6600">'.$mosConfig_absolute_path.'/components/com_ezine/joomsef_ext</b><br/>to folder <b style="font-size:125%; color:#ff6600">'.$mosConfig_absolute_path.'/components/com_sef/sef_ext</b>.</p>';
			$success = false;
		} else {
			unlink($mosConfig_absolute_path.'/components/com_ezine/joomsef_ext/com_ezine.xml');
		}
		if ($success) {
			rmdir($mosConfig_absolute_path.'/components/com_ezine/joomsef_ext');
			echo '... done!<br/>';
		} else {
			echo '... fail!<br/>';
		}
	}
}
?>