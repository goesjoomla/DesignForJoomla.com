<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// define product information
define( '_D4J_PRODUCT_NAME'				, 'D4J User Sync' );
define( '_D4J_PRODUCT_BACKEND_PATH'		, str_replace('\\', '/', dirname(__FILE__)) );
define( '_D4J_PRODUCT_FRONTEND_PATH'	, _D4J_PRODUCT_BACKEND_PATH."/../../../components/$option" );
define( '_D4J_PRODUCT_LICENSE_KEY'		, _D4J_PRODUCT_BACKEND_PATH.'/license_key.php' );
define( '_D4J_PRODUCT_LOCAL_KEY'		, _D4J_PRODUCT_BACKEND_PATH.'/local_key.php' );

/* check for valid license ***************************************************\/
$servers	= array();
$servers[]	= 'http://designforjoomla.com/client/'; // main server

if ( !preg_match("/^(register_step\d)|(requestSupport)|(sendSupportRequest)|(aboutUs)|(update)$/", $func) ) {
	// if not in registration steps, check to see if license key and local key exist
	if (!file_exists(_D4J_PRODUCT_LICENSE_KEY)) {
		$license_key = mosGetParam($_POST, 'license_key', '');
		if ($license_key == '') {
			// license key does not exist, redirect to registration step 1
			mosRedirect( "index2.php?option=$option&task=register_step1" );
		} else {
			$license_file_content = '<?php $license="'.$license_key.'"; ?>';
			$fp = @fopen(_D4J_PRODUCT_LICENSE_KEY, 'w');
			@fputs($fp, $license_file_content, strlen($license_file_content));
			@fclose($fp);
			$msg = '';
			if (!file_exists(_D4J_PRODUCT_LICENSE_KEY))
				$msg = 'Cannot create file &quot;'._D4J_PRODUCT_LICENSE_KEY.'&quot;. Please double check the directory permission to sure that it is writeable.';
			mosRedirect( "index2.php?option=$option", $msg );
		}
	} else {
		require_once( _D4J_PRODUCT_LICENSE_KEY );
	}

	// checking for valid license key
	$query_string = "license=$license";
	list($lic_prefix, $lic_key) = explode('-', $license, 2);
	switch ($lic_prefix) {
		case 'usFull'	: $pid = 4; break;
		case 'usLite'	: $pid = 5; break;
		default			: $pid = 0; break;
	}
	if ($pid == 0) {
		mosRedirect( "index2.php?option=$option&task=register_step3&status=Invalid+License+Key" );
	}
	$query_string .= "&product_id=$pid";

	$per_server		= false;
	$per_install	= false;
	$per_site		= true;

	if ($per_server) {
		$server_array = phpaudit_get_mac_address();
		$query_string .= '&access_host='.@gethostbyaddr(@gethostbyname($server_array[1]));
		$query_string .= '&access_mac='.$server_array[0];
	} elseif ($per_install) {
		$query_string .= '&access_directory='.path_translated();
		$query_string .= '&access_ip='.server_addr();
		$query_string .= '&access_host='.$_SERVER['HTTP_HOST'];
	} elseif ($per_site) {
		$query_string .= '&access_ip='.server_addr();
		$query_string .= '&access_host='.$_SERVER['HTTP_HOST'];
	}

	foreach ($servers as $server) {
		$sinfo	= @parse_url($server);
		$data	= phpaudit_exec_socket($sinfo['host'], $sinfo['path'], '/validate_internal.php', $query_string);
		if ($data)
			break;
	}

	if (!$data) {
		// remote license checking fail, checking local key
		$array['per_server']	= $per_server;
		$array['per_install']	= $per_install;
		$array['per_site']		= $per_site;
		$data = validate_local_key($array);
	}

	$parser = @xml_parser_create('');
	@xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	@xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
	@xml_parse_into_struct($parser, $data, $values, $tags);
	@xml_parser_free($parser);

	$returned = $values[0]['attributes'];

	if (empty($returned))
		$returned['status'] = 'invalid';

	if ($returned['status'] != 'active')
		$sinfo = @parse_url($servers[0]);

	if ($returned['status'] == 'invalid')
		mosRedirect( "index2.php?option=$option&task=register_step3&status=Invalid+License+Key" );
	elseif ($returned['status'] == 'suspended')
		mosRedirect( "index2.php?option=$option&task=register_step3&status=License+Key+Has+Been+Suspended" );
	elseif ($returned['status'] == 'expired')
		mosRedirect( "index2.php?option=$option&task=register_step3&status=License+Key+Has+Been+Expired" );
	elseif ($returned['status'] == 'pending')
		mosRedirect( "index2.php?option=$option&task=register_step3&status=License+Key+Has+Not+Been+Activated" );
	elseif ($returned['status'] == 'invalid_key')
		mosRedirect( "index2.php?option=$option&task=register_step3&status=Invalid+Local+Key" );

	// checking to see if Local Key exists
	if (!file_exists(_D4J_PRODUCT_LOCAL_KEY)) {
		$local_key_uploaded = mosGetParam($_POST, 'local_key_uploaded', '');
		if ($local_key_uploaded == '') {
			// local key does not exist, redirect to registration step 2
			mosRedirect( "index2.php?option=$option&task=register_step2" );
		} else {
			if (@move_uploaded_file($_FILES['local_key_file']['tmp_name'], _D4J_PRODUCT_LOCAL_KEY))
				$msg = 'Your copy of '._D4J_PRODUCT_NAME.' is now registered. Thank you for choosing our product!';
			else
				$msg = 'Cannot create file &quot;'._D4J_PRODUCT_LOCAL_KEY.'&quot;. Please double check the directory permission to sure that it is writeable.';
			mosRedirect( "index2.php?option=$option", $msg );
		}
	}

	// unset parameters
	unset($query_string);
	unset($per_server);
	unset($per_install);
	unset($per_site);
	unset($server);
	unset($data);
	unset($parser);
	unset($values);
	unset($tags);
	unset($sinfo);
}
\/*********************************************** end check for valid license */

class usersync {
	function showConfig() {
		global $database;

		$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'general'");
		$general_settings =& new mosParameters('');
		if ($rows = $database->loadObjectList()) {
			foreach ($rows AS $row) {
				$general_settings->set($row->name, htmlentities($row->value, ENT_QUOTES));
			}
		}

		$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'order'");
		$fields_order = Array();
		if ($rows = $database->loadObjectList()) {
			foreach ($rows AS $row) {
				$fields_order[$row->name] = $row->value;
			}
		}

		$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'fields'");
		$fields_conversion = Array();
		if ($rows = $database->loadObjectList()) {
			foreach ($rows AS $row) {
				$fields_conversion[$row->name] = $row->value;
			}
		}

		$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'groups'");
		$user_groups = Array();
		if ($rows = $database->loadObjectList()) {
			foreach ($rows AS $row) {
				$user_groups[$row->name] = $row->value;
			}
		}

		HTML_usersync::config($general_settings, $fields_order, $fields_conversion, $user_groups);
	}

	function saveConfig() {
		global $option, $database;

		$general_settings = mosGetParam( $_POST, 'general_settings', Array() );
		if (count($general_settings)) {
			foreach ($general_settings AS $k => $v) {
				$v = html_entity_decode($v, ENT_QUOTES);
				$database->setQuery("SELECT COUNT(*) FROM #__usersync_config WHERE `type` = 'general' AND `name` = '$k'");
				if ($database->loadResult() > 0)
					$database->setQuery("UPDATE #__usersync_config SET `value` = '$v' WHERE `type` = 'general' AND `name` = '$k'");
				else
					$database->setQuery("INSERT INTO #__usersync_config (`type`,`name`,`value`) VALUES ('general','$k','$v')");
				if (!$database->query())
					mosRedirect("index2.php?option=$option&task=config", 'Cannot save configuration');
			}
		}

		$csv_fields_order = mosGetParam( $_POST, 'csv_fields_order', Array() );
		$joomla_fields_name = mosGetParam( $_POST, 'joomla_fields_name', Array() );
		if (count($csv_fields_order) AND count($joomla_fields_name)) {
			foreach ($csv_fields_order AS $k => $v) {
				if ($v != '' AND $joomla_fields_name[$k] != '') {
					$database->setQuery("SELECT COUNT(*) FROM #__usersync_config WHERE `type` = 'order' AND `name` = '$v'");
					if ($database->loadResult() > 0)
						$database->setQuery("UPDATE #__usersync_config SET `value` = '$joomla_fields_name[$k]' WHERE `type` = 'order' AND `name` = '$v'");
					else
						$database->setQuery("INSERT INTO #__usersync_config (`type`,`name`,`value`) VALUES ('order','$v','$joomla_fields_name[$k]')");
					if (!$database->query())
						mosRedirect("index2.php?option=$option&task=config", 'Cannot save configuration');
				}
			}
			$database->setQuery("DELETE FROM #__usersync_config WHERE `type` = 'order' AND `name` NOT IN ('".implode("','", $csv_fields_order)."')");
			if (!$database->query())
				mosRedirect("index2.php?option=$option&task=config", 'Cannot save configuration');
		}

		$csv_fields_name = mosGetParam( $_POST, 'csv_fields_name', Array() );
		$joomla_fields_name = mosGetParam( $_POST, 'joomla_fields_name', Array() );
		if (count($csv_fields_name) AND count($joomla_fields_name)) {
			foreach ($csv_fields_name AS $k => $v) {
				if ($v != '' AND $joomla_fields_name[$k] != '') {
					$database->setQuery("SELECT COUNT(*) FROM #__usersync_config WHERE `type` = 'fields' AND `name` = '$v'");
					if ($database->loadResult() > 0)
						$database->setQuery("UPDATE #__usersync_config SET `value` = '$joomla_fields_name[$k]' WHERE `type` = 'fields' AND `name` = '$v'");
					else
						$database->setQuery("INSERT INTO #__usersync_config (`type`,`name`,`value`) VALUES ('fields','$v','$joomla_fields_name[$k]')");
					if (!$database->query())
						mosRedirect("index2.php?option=$option&task=config", 'Cannot save configuration');
				}
			}
			$database->setQuery("DELETE FROM #__usersync_config WHERE `type` = 'fields' AND `name` NOT IN ('".implode("','", $csv_fields_name)."')");
			if (!$database->query())
				mosRedirect("index2.php?option=$option&task=config", 'Cannot save configuration');
		}

		$csv_user_groups = mosGetParam( $_POST, 'csv_user_groups', Array() );
		$joomla_user_groups = mosGetParam( $_POST, 'joomla_user_groups', Array() );
		if (count($csv_user_groups) AND count($joomla_user_groups)) {
			foreach ($csv_user_groups AS $k => $v) {
				if ($v != '' AND $joomla_user_groups[$k] != '') {
					$v = str_replace( ' ', '_', $v );
					$joomla_user_groups[$k] = str_replace( ' ', '_', $joomla_user_groups[$k] );
					$database->setQuery("SELECT COUNT(*) FROM #__usersync_config WHERE `type` = 'groups' AND `name` = '$v'");
					if ($database->loadResult() > 0)
						$database->setQuery("UPDATE #__usersync_config SET `value` = '$joomla_user_groups[$k]' WHERE `type` = 'groups' AND `name` = '$v'");
					else
						$database->setQuery("INSERT INTO #__usersync_config (`type`,`name`,`value`) VALUES ('groups','$v','$joomla_user_groups[$k]')");
					if (!$database->query())
						mosRedirect("index2.php?option=$option&task=config", 'Cannot save configuration');
				}
			}
			$database->setQuery("DELETE FROM #__usersync_config WHERE `type` = 'groups' AND `name` NOT IN ('".implode("','", $csv_user_groups)."')");
			if (!$database->query())
				mosRedirect("index2.php?option=$option&task=config", 'Cannot save configuration');
		}

		mosRedirect("index2.php?option=$option&task=config", 'Configuration successfully saved');
	}

	function importCSV() {
		global $option, $database, $acl, $mosConfig_absolute_path, $returned;

		if (isset($_FILES['csv_file']['tmp_name'])) {
			if (strtoupper(substr($_FILES['csv_file']['name'], -3)) == 'CSV') {
				$path_to_file = $mosConfig_absolute_path.'/cache/'.$_FILES['csv_file']['name'];
				if (!move_uploaded_file($_FILES['csv_file']['tmp_name'], $path_to_file))
					mosRedirect("index2.php?option=$option&task=upload", 'Cannot move uploaded file to cache folder to start import');
			} else
				mosRedirect("index2.php?option=$option&task=upload", 'Please upload file with extension .csv only');
		} else
			mosRedirect("index2.php?option=$option&task=upload", 'Please upload a CSV file first or double-check to sure that the file name does not contain special characters');

		$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'general'");
		$general_settings =& new mosParameters('');
		if ($rows = $database->loadObjectList()) {
			foreach ($rows AS $row) {
				$general_settings->set($row->name, htmlentities($row->value, ENT_QUOTES));
			}
			if ($general_settings->get('group_field', '') == '')
				mosRedirect("index2.php?option=$option&task=upload", 'Please specify which field (either name or order) in CSV file is user group field first');
		} else
			mosRedirect("index2.php?option=$option&task=upload", 'Cannot load general settings');

		if ($general_settings->get('showcsvnames') > 0) { // Fields names at first row, get the fields conversion
			$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'fields'");
			$fields_conversion = Array();
			if ($rows = $database->loadObjectList()) {
				foreach ($rows AS $row) {
					$fields_conversion[$row->name] = $row->value;
				}
			}
			$fields_conversion[$general_settings->get('group_field')] = 'usertype';
		} else { // Fields names not at first row, get the fields order
			$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'order' ORDER BY `name` ASC");
			$fields_order = Array();
			if ($rows = $database->loadObjectList()) {
				foreach ($rows AS $row) {
					$fields_order[$row->name] = $row->value;
				}
				$fields_order[$general_settings->get('group_field')] = 'usertype';
			} else
				mosRedirect("index2.php?option=$option&task=upload", 'Cannot load fields order conversion settings');
		}

		$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'groups'");
		$user_groups = Array();
		if ($rows = $database->loadObjectList()) {
			foreach ($rows AS $row) {
				$user_groups[$row->name] = $row->value;
			}
		}

		// Get filter settings
		$filter_group = mosGetParam( $_POST, 'filter_group', Array() );
		$filter_name = mosGetParam( $_POST, 'filter_name', '' );
		$filter_username = mosGetParam( $_POST, 'filter_username', '' );
		$filter_email = mosGetParam( $_POST, 'filter_email', '' );

		// get joomla fields
		$database->setQuery("SHOW COLUMNS FROM #__users");
		$rows = $database->loadObjectList();
		foreach ($rows AS $row) {
			$joomla_fields[] = $row->Field;
		}

		// get joomla user groups
		$gtree = $acl->get_group_children_tree( null, 'USERS' );
		foreach ($gtree AS $group) {
			$joomla_groups[$group->value] = str_replace( ' ', '_', str_replace('-', '', str_replace('&nbsp;', '', str_replace('.', '', $group->text))) );
		}

		$row			= 0;
		$overwrite		= 0;
		$ignore			= 0;
		$insert			= 0;
		$error			= 0;
		$passFirstRow	= false;
		$handle			= fopen($path_to_file, "r");
		while ($data = fgetcsv($handle, 1024, $general_settings->get('separator', ','), $general_settings->get('enclosed', '"'))) {
			if ($returned['apply_limitation'] == 'yes' AND $row >= 100) // Lite version is allowed to import 100 user accounts only
				break;
			if ($general_settings->get('showcsvnames') > 0) { // Fields names at first row
				if (!$passFirstRow) {
					for ($i = 0, $n = count($data); $i < $n; $i++) {
						$csv_fields[$i] = $data[$i];
					}
					$passFirstRow = true;
					continue;
				} else {
					for ($i = 0, $n = count($data); $i < $n; $i++) {
						$csv_data[$csv_fields[$i]] = preg_replace("/\"|'/", '', $data[$i]);
					}
					// Prepare Joomla data
					foreach ($csv_data AS $k => $v) {
						if (array_key_exists($k, $fields_conversion))
							$joomla_data[$fields_conversion[$k]] = $v;
						elseif (in_array($k, $joomla_fields))
							$joomla_data[$k] = $v;
					}
					if (!count($joomla_data))
						mosRedirect("index2.php?option=$option&task=upload", 'Please define fields name conversion from CSV file to Joomla database first');
				}
			} else { // Fields names not at first row
				for ($i = 0, $n = count($data); $i < $n; $i++) {
					if (array_key_exists($i, $fields_order))
						$csv_data[$fields_order[$i]] = preg_replace("/\"|'/", '', $data[$i]);
				}
				if (!count($csv_data))
					mosRedirect("index2.php?option=$option&task=upload", 'Please define fields order conversion from CSV file to Joomla database first');
				// Prepare Joomla data
				foreach ($csv_data AS $k => $v) {
					$joomla_data[$k] = $v;
				}
			}
			// Get user group
			if (!array_key_exists('usertype', $joomla_data)) // group not specified, use "Registered" as default
				$joomla_data['usertype'] = 'Registered';
			else {
				$joomla_data['usertype'] = str_replace(' ', '_', $joomla_data['usertype']);
				if (!in_array($joomla_data['usertype'], $joomla_groups)) {
					$joomla_data['usertype'] = isset($user_groups[$joomla_data['usertype']]) ? $user_groups[$joomla_data['usertype']] : '';
					if ($joomla_data['usertype'] == '') // group not determined, use "Registered" as default
						$joomla_data['usertype'] = 'Registered';
				}
			}
			$joomla_data['usertype'] = str_replace('_', ' ', $joomla_data['usertype']);
			// Filter user group
			if (count($filter_group)) {
				if (!in_array($joomla_data['usertype'], $filter_group)) {
//					echo "Skipping user #".($general_settings->get('showcsvnames') > 0 ? ($row - 1) : $row)." (not belong to any of selected groups) ... done!<br/>\n";
					$ignore++;
					$row++;
					continue;
				}
			}
			// Filter name
			if ($filter_name != '') {
				if (!preg_match("/".$filter_name."/i", $joomla_data['name'])) {
//					echo "Skipping user #".($general_settings->get('showcsvnames') > 0 ? ($row - 1) : $row)." (name not contain filter string) ... done!<br/>\n";
					$ignore++;
					$row++;
					continue;
				}
			}
			// Filter username
			if ($filter_username != '') {
				if (!preg_match("/".$filter_username."/i", $joomla_data['username'])) {
//					echo "Skipping user #".($general_settings->get('showcsvnames') > 0 ? ($row - 1) : $row)." (username not contain filter string) ... done!<br/>\n";
					$ignore++;
					$row++;
					continue;
				}
			}
			// Filter email
			if ($filter_email != '') {
				if (!preg_match("/".$filter_email."/i", $joomla_data['email'])) {
//					echo "Skipping user #".($general_settings->get('showcsvnames') > 0 ? ($row - 1) : $row)." (email not contain filter string) ... done!<br/>\n";
					$ignore++;
					$row++;
					continue;
				}
			}
			// Duplication check
			$database->setQuery("SELECT COUNT(id) FROM #__users WHERE username = '".$joomla_data['username']."'");
			if ($database->loadResult() > 0) {
				if ($general_settings->get('dupe_action', 'ignore') == 'overwrite')
					$update = true;
				else {
//					echo "Skipping user #".($general_settings->get('showcsvnames') > 0 ? ($row - 1) : $row)." (username: ".$joomla_data['username']."; email: ".$joomla_data['email'].") ... done!<br/>\n";
					$ignore++;
					$row++;
					continue;
				}
			} else
				$update = false;
			$database->setQuery("SELECT group_id FROM #__core_acl_aro_groups WHERE name = '".$joomla_data['usertype']."'");
			$joomla_data['gid'] = $database->loadResult();
			// Encrypt password or not
			if ($general_settings->get('md5_password') > 0) // Encrypt password using MD5
				$joomla_data['password'] = md5($joomla_data['password']);
			// Build query
			$q = ''; $q1 = ''; $q2 = '';
			foreach ($joomla_data AS $k => $v) {
				if ($k != '') {
					if ($update)
						$q .= "$k='$v',";
					else {
						$q1 .= "$k,";
						$q2 .= "'$v',";
					}
				}
			}
			if ($update) {
				$query = "UPDATE #__users SET ".substr($q, 0, strlen($q) - 1)." WHERE username = '".$joomla_data['username']."'";
//				echo "Updating user #".($general_settings->get('showcsvnames') > 0 ? ($row - 1) : $row)." (username: ".$joomla_data['username']."; email: ".$joomla_data['email'].") ... ";
				$overwrite++;
			} else {
				$query = "INSERT INTO #__users (".substr($q1, 0, strlen($q1) - 1).") VALUES (".substr($q2, 0, strlen($q2) - 1).")";
//				echo "Inserting user #".($general_settings->get('showcsvnames') > 0 ? ($row - 1) : $row)." (username: ".$joomla_data['username']."; email: ".$joomla_data['email'].") ... ";
				$insert++;
			}
			$database->setQuery($query);
			if (!$database->query()) {
				$error++;
				$row++;
				continue;
			}
			$database->setQuery("SELECT id FROM #__users WHERE username = '".$joomla_data['username']."'");
			$user_id = $database->loadResult();
			if (!$update) {
				$database->setQuery("INSERT INTO #__core_acl_aro (`section_value`,`value`,`name`) VALUES ('users','$user_id','".(array_key_exists('name', $joomla_data) ? $joomla_data['name'] : '')."')");
				if (!$database->query()) {
					$error++;
					$row++;
					continue;
				}
			}
			$database->setQuery("SELECT aro_id FROM #__core_acl_aro WHERE value = '$user_id'");
			$aro_id = $database->loadResult();
			if ($update)
				$database->setQuery("UPDATE #__core_acl_groups_aro_map SET group_id='".$joomla_data['gid']."' WHERE aro_id='$aro_id'");
			else
				$database->setQuery("INSERT INTO #__core_acl_groups_aro_map (group_id,aro_id) VALUES ('".$joomla_data['gid']."','$aro_id')");
			if (!$database->query()) {
				$error++;
				$row++;
				continue;
			}
//			echo "done!<br/>";
			$row++;
		}
		echo "Users Inserted: $insert<br/>Users Skipped: $ignore<br/>Users Updated: $overwrite<br/>Import Errors: $error";
		if ($returned['apply_limitation'] == 'yes' AND $row >= 100) { // Lite version notice
			echo '<h3><b>'._D4J_PRODUCT_NAME.'</b> Lite license is allowed to import/export 100 user accounts only!!!</h3>';
			echo '<h4><a href="index2.php?option='.$option.'&task=register_step0">Reissue/Upgrade License</a></h4>';
		}
		fclose($handle);
		unlink($path_to_file);
	}

	function exportCSV( $custom_config ) {
		global $option, $database, $returned;

		if (!$custom_config) { // Custom configuration when export not defined
			$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'general'");
			$general_settings =& new mosParameters('');
			if ($rows = $database->loadObjectList()) {
				foreach ($rows AS $row) {
					$general_settings->set($row->name, htmlentities($row->value, ENT_QUOTES));
				}
				if ($general_settings->get('group_field', '') == '')
					mosRedirect("index2.php?option=$option&task=export", 'Please specify which field (either name or order) in CSV file is user group field first');
			} else
				mosRedirect("index2.php?option=$option&task=export", 'Cannot load general settings');

			if ($general_settings->get('export_conversion') == 'same') { // Use same field name/order and user group conversion as import settings
				if ($general_settings->get('showcsvnames') > 0) { // Fields names at first row, get the fields conversion
					$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'fields'");
					$fields_conversion = Array();
					if ($rows = $database->loadObjectList()) {
						foreach ($rows AS $row) {
							$fields_conversion[$row->value] = $row->name;
						}
						$fields_conversion['usertype'] = $general_settings->get('group_field');
					} else
						mosRedirect("index2.php?option=$option&task=export", 'Cannot load fields name conversion settings');
				} else { // Fields names not at first row, get the fields order
					$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'order' ORDER BY `name` ASC");
					$fields_order = Array();
					if ($rows = $database->loadObjectList()) {
						foreach ($rows AS $row) {
							$fields_order[$row->value] = $row->name;
						}
						$fields_order['usertype'] = $general_settings->get('group_field');
					} else
						mosRedirect("index2.php?option=$option&task=export", 'Cannot load fields order conversion settings');
				}

				$database->setQuery("SELECT * FROM #__usersync_config WHERE `type` = 'groups'");
				$user_groups = Array();
				if ($rows = $database->loadObjectList()) {
					foreach ($rows AS $row) {
						$user_groups[$row->value] = $row->name;
					}
				}
			}
		} else { // Define custom configuration when export
			$general_settings_array = mosGetParam( $_POST, 'general_settings', Array() );
			if (count($general_settings_array)) {
				$general_settings =& new mosParameters('');
				foreach ($general_settings_array AS $k => $v) {
					$general_settings->set($k, stripslashes($v));
				}
			} else
				mosRedirect("index2.php?option=$option&task=export", 'Cannot load general settings');

			if ($general_settings->get('showcsvnames') > 0) { // Fields names at first row, get the fields conversion
				$csv_fields_name = mosGetParam( $_POST, 'csv_fields_name', Array() );
				$joomla_fields_name = mosGetParam( $_POST, 'joomla_fields_name', Array() );
				if (count($csv_fields_name) AND count($joomla_fields_name)) {
					$fields_conversion = Array();
					foreach ($csv_fields_name AS $k => $v) {
						if ($v != '' AND $joomla_fields_name[$k] != '')
							$fields_conversion[$joomla_fields_name[$k]] = $v;
					}
					$fields_conversion['usertype'] = $general_settings->get('group_field');
				} else
					mosRedirect("index2.php?option=$option&task=export", 'Cannot load fields name conversion settings');
			} else { // Fields names not at first row, get the fields order
				$csv_fields_order = mosGetParam( $_POST, 'csv_fields_order', Array() );
				$joomla_fields_name = mosGetParam( $_POST, 'joomla_fields_name', Array() );
				if (count($csv_fields_order) AND count($joomla_fields_name)) {
					$fields_order = Array();
					foreach ($csv_fields_order AS $k => $v) {
						if ($v != '' AND $joomla_fields_name[$k] != '')
							$fields_order[$joomla_fields_name[$k]] = $v;
					}
					$fields_order['usertype'] = $general_settings->get('group_field');
				} else
					mosRedirect("index2.php?option=$option&task=export", 'Cannot load fields order conversion settings');
			}

			$csv_user_groups = mosGetParam( $_POST, 'csv_user_groups', Array() );
			$joomla_user_groups = mosGetParam( $_POST, 'joomla_user_groups', Array() );
			if (count($csv_user_groups) AND count($joomla_user_groups)) {
				$user_groups = Array();
				foreach ($csv_user_groups AS $k => $v) {
					$v = str_replace( ' ', '_', $v );
					$joomla_user_groups[$k] = str_replace( ' ', '_', $joomla_user_groups[$k] );
					if ($v != '' AND $joomla_user_groups[$k] != '')
						$user_groups[$joomla_user_groups[$k]] = $v;
				}
			}
		}

		// Joomla fields
		$database->setQuery("SHOW COLUMNS FROM #__users");
		$rows = $database->loadObjectList();
		foreach ($rows AS $row) {
			$joomla_fields[] = $row->Field;
		}

		// Get filter settings
		$filter_group = mosGetParam( $_POST, 'filter_group', Array() );
		$filter_name = mosGetParam( $_POST, 'filter_name', '' );
		$filter_username = mosGetParam( $_POST, 'filter_username', '' );
		$filter_email = mosGetParam( $_POST, 'filter_email', '' );
		$where = Array();

		if (count($filter_group))
			$where[] = "(gid = '".implode("' OR gid = '", $filter_group)."')";
		if ($filter_name != '')
			$where[] = "(`name` LIKE '%$filter_name%')";
		if ($filter_username != '')
			$where[] = "(username LIKE '%$filter_username%')";
		if ($filter_email != '')
			$where[] = "(email LIKE '%$filter_email%')";

		if (count($where))
			$where = implode(" AND ", $where);
		else
			$where = '1';

		// Get user entries to export
		if ($returned['apply_limitation'] == 'yes') // Lite version is allowed to export 100 user accounts only
			$limit = "LIMIT 0,100";
		else
			$limit = '';
		$database->setQuery("SELECT * FROM #__users WHERE $where $limit");
		if ($rows = $database->loadObjectList()) {
			$csv_data = Array();
			if ($general_settings->get('showcsvnames') > 0) {
				$csv_data[0] = '';
				foreach ($joomla_fields AS $field) {
					if ($custom_config OR $general_settings->get('export_conversion') == 'same') {
						if (array_key_exists($field, $fields_conversion))
							$csv_data[0] .= $fields_conversion[$field].$general_settings->get('separator', ',');
					} else {
						if ($field != 'id')
							$csv_data[0] .= $field.$general_settings->get('separator', ',');
					}
				}
				$csv_data[0] = substr($csv_data[0], 0, strlen($csv_data[0]) - strlen($general_settings->get('separator', ',')));
			}
			foreach ($rows AS $row) {
				if ($general_settings->get('export_conversion') == 'default')
					$csv_row = '';
				elseif ($general_settings->get('showcsvnames') > 0)
					$csv_row = '';
				else
					$csv_row = Array();

				if ($general_settings->get('export_conversion') != 'default') {
					foreach ($joomla_fields AS $field) {
						if ($general_settings->get('showcsvnames') > 0) {
							if (array_key_exists($field, $fields_conversion)) {
								if ($field == 'usertype') {
									$row->$field = str_replace( ' ', '_', $row->$field);
									if (array_key_exists($row->$field, $user_groups))
										$row->$field = $user_groups[$row->$field];
								}
								$row->$field = str_replace("\n", '\n', (!preg_match("/\s|\n|=/", $row->$field) ? $row->$field : $general_settings->get('enclosed', '"').$row->$field.$general_settings->get('enclosed', '"')));
								$csv_row .= $row->$field.$general_settings->get('separator', ',');
							}
						} else {
							if (array_key_exists($field, $fields_order)) {
								if ($field == 'usertype') {
									$row->$field = str_replace( ' ', '_', $row->$field);
									if (array_key_exists($row->$field, $user_groups))
										$row->$field = $user_groups[$row->$field];
								}
								$row->$field = str_replace("\n", '\n', (!preg_match("/\s|\n|=/", $row->$field) ? $row->$field : $general_settings->get('enclosed', '"').$row->$field.$general_settings->get('enclosed', '"')));
								$csv_row[$fields_order[$field]] = $row->$field;
							}
						}
					}
					if ($general_settings->get('showcsvnames') > 0)
						$csv_row = substr($csv_row, 0, strlen($csv_row) - strlen($general_settings->get('separator', ',')));
					else {
						$max_key = 1;
						foreach ($csv_row AS $k => $v) {
							if ($max_key <= $k)
								$max_key = $k + 1;
						}
						for ($i = 0; $i < $max_key; $i++) {
							if (isset($csv_row[$i]))
								$temp_row[$i] = $csv_row[$i];
							else
								$temp_row[$i] = '';
						}
						$csv_row = implode($general_settings->get('separator', ','), $temp_row);
					}
				} else {
					foreach ($joomla_fields AS $field) {
						if ($field != 'id') {
							$row->$field = str_replace("\n", '\n', (!preg_match("/\s|\n|=/", $row->$field) ? $row->$field : $general_settings->get('enclosed', '"').$row->$field.$general_settings->get('enclosed', '"')));
							$csv_row .= $row->$field.$general_settings->get('separator', ',');
						}
					}
					$csv_row = substr($csv_row, 0, strlen($csv_row) - strlen($general_settings->get('separator', ',')));
				}
				$csv_data[] = $csv_row;
			}
			$return_data = html_entity_decode(implode("\n", $csv_data));
			clearstatcache();
			//Begin writing headers
			header("Cache-Control: max-age=60");
			header("Cache-Control: private");
			header("Content-Description: File Transfer");
			header("Content-Type: text/csv");
			header("Content-Disposition: attachment; filename=\"users_db.csv\"");
			header("Content-Transfer-Encoding: quoted-printable");
			header("Content-Length: ".strlen($return_data));
			@set_time_limit(0);
			set_magic_quotes_runtime(0);
			print $return_data;
			set_magic_quotes_runtime(get_magic_quotes_gpc());
			exit;
		} else
			mosRedirect("index2.php?option=$option&task=export", 'Not found any user account fit your filter(s)');
	}

	// Registration function
	function register($step) {
		global $option;

		// get license if exists
		$license = '';
		if (file_exists(_D4J_PRODUCT_LICENSE_KEY))
			require_once(_D4J_PRODUCT_LICENSE_KEY);

		// which step to execute?
		if ($step == 'register_step0') {
			$msg = '';
			// reissue or upgrade license
			if (file_exists(_D4J_PRODUCT_LICENSE_KEY)) {
				@unlink(_D4J_PRODUCT_LICENSE_KEY);
				if (file_exists(_D4J_PRODUCT_LICENSE_KEY))
					$msg = 'Cannot remove file &quot;'._D4J_PRODUCT_LICENSE_KEY.'&quot;. Please double check the file permission to sure that it is writeable.';
			}
			if (file_exists(_D4J_PRODUCT_LOCAL_KEY)) {
				@unlink(_D4J_PRODUCT_LOCAL_KEY);
				if (file_exists(_D4J_PRODUCT_LOCAL_KEY))
					$msg = 'Cannot remove file &quot;'._D4J_PRODUCT_LOCAL_KEY.'&quot;. Please double check the file permission to sure that it is writeable.';
			}
			if ($msg != '')
				HTML_usersync::requestSupport($msg, $license);
			else
				mosRedirect("index2.php?option=$option&task=register_step1");
		} elseif ($step == 'register_step3') {
			$msg = mosGetParam( $_GET, 'status', '' );
			HTML_usersync::requestSupport($msg, $license);
		} else
			HTML_usersync::register($step);
	}

	function requestSupport() {
		$msg = '';
		$license = '';
		if (file_exists(_D4J_PRODUCT_LICENSE_KEY))
			include_once(_D4J_PRODUCT_LICENSE_KEY);
		HTML_usersync::requestSupport($msg, $license);
	}

	function sendSupportRequest() {
		global $mosConfig_mailfrom, $mosConfig_fromname;

		$supportRequest = mosGetParam( $_POST, 'support_request', '' );
		if (is_array($supportRequest)) {
			mosMail( $mosConfig_mailfrom, $mosConfig_fromname, 'support@designforjoomla.com', $supportRequest['subject'], $supportRequest['message'] );
			$msg = 'Support Request has been sent. You will soon receive response from The DesignForJoomla.com team. Thank you for choosing our product!';
		} else
			$msg = 'Cannot sending out your message. Please fill in all required information and try again.';
		echo '<script language="javascript" type="text/javascript">alert("'.$msg.'"); window.history.go(-1);</script>';
		exit();
	}

	function aboutUs() {
		global $mosConfig_absolute_path;

		require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
		$xmlFilesInDir = mosReadDirectory( _D4J_PRODUCT_BACKEND_PATH, '.xml$' );

		$row = new stdClass();
		foreach ($xmlFilesInDir AS $xmlfile) {
			// Read the file to see if it's a valid component XML file
			$xmlDoc = new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors( true );

			if (!$xmlDoc->loadXML( _D4J_PRODUCT_BACKEND_PATH.'/'.$xmlfile, false, true )) {
				continue;
			}

			$root = &$xmlDoc->documentElement;

			if ($root->getTagName() != 'mosinstall') {
				continue;
			}
			if ($root->getAttribute( "type" ) != "component") {
				continue;
			}

			$element 			= &$root->getElementsByPath('author', 1);
			$row->author		= $element ? $element->getText() : 'Unknown';

			$element			= &$root->getElementsByPath('creationDate', 1);
			$row->creationDate	= $element ? $element->getText() : 'Unknown';

			$element			= &$root->getElementsByPath('copyright', 1);
			$row->copyright		= $element ? $element->getText() : '';

			$element			= &$root->getElementsByPath('license', 1);
			$row->license		= $element ? $element->getText() : '';

			$element			= &$root->getElementsByPath('authorEmail', 1);
			$row->authorEmail	= $element ? $element->getText() : '';

			$element			= &$root->getElementsByPath('authorUrl', 1);
			$row->authorUrl		= $element ? $element->getText() : '';

			$element			= &$root->getElementsByPath('version', 1);
			$row->version		= $element ? $element->getText() : '';

			$element			= &$root->getElementsByPath('description', 1);
			$row->description	= $element ? $element->getText() : '';
		}

		HTML_usersync::aboutUs($row);
	}

	function update() {
		global $option, $database, $mosConfig_absolute_path;

		require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
		$xmlFilesInDir = mosReadDirectory( _D4J_PRODUCT_BACKEND_PATH, '.xml$' );

		foreach ($xmlFilesInDir AS $xmlfile) {
			// Read the file to see if it's a valid component XML file
			$xmlDoc = new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors( true );

			if (!$xmlDoc->loadXML( _D4J_PRODUCT_BACKEND_PATH.'/'.$xmlfile, false, true )) {
				continue;
			}

			$root = &$xmlDoc->documentElement;

			if ($root->getTagName() != 'mosinstall') {
				continue;
			}
			if ($root->getAttribute( "type" ) != "component") {
				continue;
			}

			// update backend menu items
			$parentItem = &$root->getElementsByPath('administration/menu', 1);
			$database->setQuery( "SELECT id FROM #__components WHERE link = 'option=$option' AND parent = '0' AND admin_menu_link = 'option=$option' AND ordering = '0'" );
			$comID = $database->loadResult();
			if (!$comID) {
				$database->setQuery( "INSERT INTO #__components (name, link, parent, admin_menu_link, admin_menu_alt, `option`, admin_menu_img)"
				."\n VALUES ('".$parentItem->getText()."', 'option=$option', '0', 'option=$option', '".$parentItem->getText()."', '$option', 'js/ThemeOffice/component.png')" );
				if (!$database->query()) {
					echo '<p><h3>Cannot update database.</h3></p>';
					if ($database->getErrorNum())
						echo $database->stderr();
					return;
				}
				$database->setQuery( "SELECT id FROM #__components WHERE link = 'option=$option' AND parent = '0' AND admin_menu_link = 'option=$option' AND ordering = '0'" );
				$comID = $database->loadResult();
			}
			if (!is_null($parentItem)) {
				$subMenu = &$root->getElementsByPath('administration/submenu', 1);
				if (!is_null($subMenu)) {
					$childItems	= $subMenu->childNodes;
					$ordering	= 0;
					foreach ($childItems AS $childItem) {
						if ($childItem->getAttribute("act")) {
							$admin_menu_link = "option=$option&act=" . $childItem->getAttribute("act");
						} elseif ($childItem->getAttribute("task")) {
							$admin_menu_link = "option=$option&task=" . $childItem->getAttribute("task");
						} elseif ($childItem->getAttribute("link")) {
							$admin_menu_link = $childItem->getAttribute("link");
						} else {
							$admin_menu_link = "option=$option";
						}
						// check if exists
						$database->setQuery( "SELECT id, parent FROM #__components WHERE admin_menu_link = '$admin_menu_link'" );
						if ($rows = $database->loadObjectList()) {
							if ($rows[0]->parent != $comID) {
								$database->setQuery( "UPDATE #__components SET parent = '$comID' WHERE id = '".$rows[0]->id."'" );
								if (!$database->query()) {
									echo '<p><h3>Cannot update database.</h3></p>';
									if ($database->getErrorNum())
										echo $database->stderr();
									return;
								}
							}
						} else {
							$database->setQuery( "INSERT INTO #__components (name, parent, admin_menu_link, admin_menu_alt, `option`, ordering, admin_menu_img)"
							."\n VALUES ('".$childItem->getText()."', '$comID', '$admin_menu_link', '".$childItem->getText()."', '$option', '".$ordering."', 'js/ThemeOffice/component.png')" );
							if (!$database->query()) {
								echo '<p><h3>Cannot update database.</h3></p>';
								if ($database->getErrorNum())
									echo $database->stderr();
								return;
							}
						}
						$ordering += 1;
					}
				}
			}
		}
		echo '<p><h3>Update Successful.</h3></p>';
	}
}

/* functions for license checking ********************************************/
function get_key() {
	$data = @file(_D4J_PRODUCT_LOCAL_KEY);

	if (!$data)
		return false;

	$buffer = false;
	foreach ($data as $line)
		$buffer .= $line;

	if (!$buffer)
		return false;

	$buffer = @str_replace("<?PHP", "", $buffer);
	$buffer = @str_replace("?>", "", $buffer);
	$buffer = @str_replace("/*--", "", $buffer);
	$buffer = @str_replace("--*/", "", $buffer);

	return @str_replace("\n", "", $buffer);
}

function parse_local_key() {
	if (!@file_exists(_D4J_PRODUCT_LOCAL_KEY))
		return false;

	$raw_data	= @base64_decode(get_key());
	$raw_array	= @explode("|", $raw_data);
	if (@is_array($raw_array) && @count($raw_array) < 8)
		return false;

	return $raw_array;
}

function validate_local_key($array) {
	$raw_array = parse_local_key();

	if (!@is_array($raw_array) || $raw_array === false)
		return "<verify status='invalid_key' message='Please contact support for a new license key.' />";

	if ($raw_array[9] && @strcmp(@md5("4431028526c96a77528cd67adbdf6275".$raw_array[9]), $raw_array[10]) != 0)
		return "<verify status='invalid_key' message='Please contact support for a new license key.' />";

	if (@strcmp(@md5("4431028526c96a77528cd67adbdf6275".$raw_array[1]), $raw_array[2]) != 0)
		return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

	if ($raw_array[1] < time() && $raw_array[7] != "never")
		return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

	if ($array['per_server']) {
		$server		= phpaudit_get_mac_address();
		$mac_array	= @explode(",", $raw_array[6]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".$server[0]), $mac_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

		$host_array = @explode(",", $raw_array[4]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".@gethostbyaddr(@gethostbyname($server[1]))), $host_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";
	} elseif ($array['per_install'] || $array['per_site']) {
		if ($array['per_install']) {
			$directory_array	= @explode(",", $raw_array[3]);
			$valid_dir			= path_translated();
			$valid_dir			= @md5("4431028526c96a77528cd67adbdf6275".$valid_dir);
			if (!@in_array($valid_dir, $directory_array))
				return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";
		}

		$host_array = @explode(",", $raw_array[4]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".$_SERVER['HTTP_HOST']), $host_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";

		$ip_array = @explode(",", $raw_array[5]);
		if (!@in_array(@md5("4431028526c96a77528cd67adbdf6275".server_addr()), $ip_array))
			return "<verify status='invalid_key' message='Please contact support for a new license key.' ".$raw_array[9]." />";
	}

	return "<verify status='active' message='The license key is valid.' ".$raw_array[9]." />";
}

function phpaudit_exec_socket($http_host, $http_dir, $http_file, $querystring) {
	$fp = @fsockopen($http_host, 80, $errno, $errstr, 10); // was 5
	if (!$fp)
		return false;
	else {
		$header = "POST ".($http_dir.$http_file)." HTTP/1.0\r\n";
		$header .= "Host: ".$http_host."\r\n";
		$header .= "Content-type: application/x-www-form-urlencoded\r\n";
		$header .= "User-Agent: PHPAudit v2 (http://www.phpaudit.com)\r\n";
		$header .= "Content-length: ".@strlen($querystring)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$header .= $querystring;

		$data = false;
		if (@function_exists('stream_set_timeout'))
			stream_set_timeout($fp, 0, 500); // set timeout to 0 second and 500 microseconds
		@fputs($fp, $header);

		if (@function_exists('socket_get_status'))
			$status = @socket_get_status($fp);
		else
			$status = true;

		while (!@feof($fp) && $status) {
			$data .= @fgets($fp, 1024);

			if (@function_exists('socket_get_status'))
				$status = @socket_get_status($fp);
			else {
			    if (@feof($fp) == true)
			    	$status = false;
			    else
			    	$status = true;
			}
		}

		@fclose ($fp);

		if (!strpos($data, '200'))
			return false;

		if (!$data)
			return false;

		$data = @explode("\r\n\r\n", $data, 2);

		if (!$data[1])
			return false;

		if (@strpos($data[1], "verify") === false)
			return false;

		return $data[1];
	}
}

/*
* DOES NOT WORK FOR WINDOWS!!!!!!!
* No good way to get the mac address for win.
*/
function phpaudit_get_mac_address() {
	$fp = @popen("/sbin/ifconfig", "r");

	if (!$fp)
		return -1;

	$res = @fread($fp, 4096);
	@pclose($fp);

	$array = @explode("HWaddr", $res);
	if (@count($array) < 2)
		$array = @explode("ether", $res);
	$array		= @explode("\n", $array[1]);
	$buffer[]	= @trim($array[0]);

	$array = @explode("inet addr:", $res);
	if (@count($array) < 2)
		$array = @explode("inet ", $res);
	$array		= @explode(" ", $array[1]);
	$buffer[]	= @trim($array[0]);

	return $buffer;
}

function path_translated() {
	if (isset($_SERVER['PATH_TRANSLATED']))
		return @substr($_SERVER['PATH_TRANSLATED'], 0, @strrpos($_SERVER['PATH_TRANSLATED'], "/"));

	if ($_SERVER['SCRIPT_FILENAME'])
		return @substr($_SERVER['SCRIPT_FILENAME'], 0, @strrpos($_SERVER['SCRIPT_FILENAME'], "/"));

	return @substr($_SERVER['ORIG_PATH_TRANSLATED'], 0, @strrpos($_SERVER['ORIG_PATH_TRANSLATED'], "\\"));
}

function server_addr() {
	return ($_SERVER['SERVER_ADDR'])?$_SERVER['SERVER_ADDR']:$_SERVER['LOCAL_ADDR'];
}
/**************************************** end functions for license checking */
?>