<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_usersync {
	function common_js() {
		global $option, $database, $acl;
		?>
		<script type="text/javascript" src="components/<?php echo $option; ?>/js/selectbox.js"></script>
		<script type="text/javascript">
			var row_index = 0;
			function addField(where) {
				var div1 = document.createElement('div');
				div1.setAttribute('id', 'src_'+row_index);
				div1.setAttribute('style', 'width: 44%; float: left; text-align: right; margin-top: 1px; margin-bottom: 1px');
				var input1 = document.createElement('input');
				input1.setAttribute('type', 'text');
				input1.setAttribute('name', 'csv_'+where+'['+row_index+']');
				input1.setAttribute('value', '');
				input1.setAttribute('size', '40');
				input1.setAttribute('style', 'text-align:right"');
				var div2 = document.createElement('div');
				div2.setAttribute('id', 'dst_'+row_index);
				div2.setAttribute('style', 'width: 54%; float: right; text-align: left; margin-top: 1px; margin-bottom: 1px');
				var input2 = document.createElement('select');
				if (where == 'user_groups')
					input2.setAttribute('name', 'joomla_user_groups['+row_index+']');
				else
					input2.setAttribute('name', 'joomla_fields_name['+row_index+']');
				input2.setAttribute('value', '');
				var container = document.getElementById(where);
				if (container.innerHTML.match(/No any defined/))
					container.innerHTML = '';
				container.appendChild(div1);
				div1.appendChild(input1);
				container.appendChild(div2);
				div2.appendChild(input2);
				addOption(input2,'------------ c.l.i.c.k..t.o..s.e.l.e.c.t -------------','',true);
				if (where == 'user_groups') {
				<?php
					$groups = $acl->get_group_children_tree( null, 'USERS' );
					foreach ($groups AS $group) {
						if (!preg_match("/\bUSERS\b/", $group->text)) {
				?>
				addOption(input2,'<?php echo str_replace("&nbsp;", "-", str_replace('.', '', $group->text)); ?>','<?php echo str_replace('-', '', str_replace('&nbsp;', '', str_replace('.', '', $group->text))); ?>',false);
				<?php
						}
					}
				?>
				} else {
				<?php
					$database->setQuery("SHOW COLUMNS FROM #__users");
					$fields = $database->loadObjectList();
					foreach ($fields AS $field) {
						if (!preg_match("/\bid\b/", $field->Field)) {
				?>
				addOption(input2,'<?php echo $field->Field; ?>','<?php echo $field->Field; ?>',false);
				<?php
						}
					}
				?>
				}
				var btn = document.createElement('input');
				btn.setAttribute('type', 'button');
				btn.setAttribute('name', 'Remove');
				btn.setAttribute('value', 'Remove');
				btn.setAttribute('style', 'margin-left:10px');
				btn.setAttribute('onclick', 'removeRow('+row_index+')');
				btn.className = 'button';
				div2.appendChild(btn);
				row_index += 1;
			}
			function removeRow(index) {
				document.getElementById('src_'+index).style.display = 'none';
				var src_childs = document.getElementById('src_'+index).childNodes;
				for (var i = 0; i < src_childs.length; i++) {
					if (src_childs[i].nodeName == 'INPUT' || src_childs[i].nodeName == 'SELECT') {
						src_childs[i].value = '';
					}
				}
				document.getElementById('dst_'+index).style.display = 'none';
				var dst_childs = document.getElementById('dst_'+index).childNodes;
				for (var i = 0; i < dst_childs.length; i++) {
					if (dst_childs[i].nodeName == 'INPUT' || dst_childs[i].nodeName == 'SELECT') {
						dst_childs[i].value = '';
					}
				}
			}
		</script>
		<?php
	}

	function config(&$general_settings, &$fields_order, &$fields_conversion, &$user_groups) {
		global $option, $database, $acl;
		HTML_usersync::common_js();
		$row_index = 0;
		?>
		<FORM METHOD="POST" NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ Global Settings ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminform">
				<tr><th colspan="2">General Settings</th></tr>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Fields terminated by&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="general_settings[separator]" size="5" value="<?php echo $general_settings->get('separator', ','); ?>" />
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						Fields enclosed by&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="general_settings[enclosed]" size="5" value="<?php echo $general_settings->get('enclosed'); ?>" />
					</TD>
				</TR>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Fields names at first row&nbsp;
					</TD>
					<TD width="60%">
						<select name="general_settings[showcsvnames]" onchange="if (this.value == 0) { document.getElementById('fields_name_container').style.display = 'none'; document.getElementById('fields_order_container').style.display = 'block'; } else { document.getElementById('fields_order_container').style.display = 'none'; document.getElementById('fields_name_container').style.display = 'block'; }">
							<option value="0"<?php echo $general_settings->get('showcsvnames') == 0 ? ' selected' : ''; ?>>No</option>
							<option value="1"<?php echo $general_settings->get('showcsvnames') == 1 ? ' selected' : ''; ?>>Yes</option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						User group field&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="general_settings[group_field]" size="15" value="<?php echo $general_settings->get('group_field', ''); ?>" />
					</TD>
				</TR>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Action on duplicate&nbsp;
					</TD>
					<TD width="60%">
						<select name="general_settings[dupe_action]">
							<option value="ignore"<?php echo $general_settings->get('dupe_action', 'ignore') == 'ignore' ? ' selected' : ''; ?>>Ignore</option>
							<option value="overwrite"<?php echo $general_settings->get('dupe_action', 'ignore') == 'overwrite' ? ' selected' : ''; ?>>Overwrite</option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						Encrypt password (MD5)&nbsp;
					</TD>
					<TD width="60%">
						<select name="general_settings[md5_password]">
							<option value="0"<?php echo $general_settings->get('md5_password', '0') == '0' ? ' selected' : ''; ?>>No</option>
							<option value="1"<?php echo $general_settings->get('md5_password', '0') == '1' ? ' selected' : ''; ?>>Yes</option>
						</select>
					</TD>
				</TR>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Fields to export&nbsp;
					</TD>
					<TD width="60%">
						<select name="general_settings[export_conversion]">
							<option value="same"<?php echo $general_settings->get('export_conversion', 'same') == 'same' ? ' selected' : ''; ?>>Same as import</option>
							<option value="default"<?php echo $general_settings->get('export_conversion', 'same') == 'default' ? ' selected' : ''; ?>>All fields</option>
							<option value="custom"<?php echo $general_settings->get('export_conversion', 'same') == 'custom' ? ' selected' : ''; ?>>Manual select when export</option>
						</select>
					</TD>
				</TR>
			</table><br/>
			<?php
				$database->setQuery("SHOW COLUMNS FROM #__users");
				$fields = $database->loadObjectList();
			?>
			<div id="fields_order_container" style="display:<?php echo $general_settings->get('showcsvnames') == 0 ? 'block' : 'none'; ?>">
			<TABLE class="adminform">
				<tr>
					<th>Fields Order Settings</th>
					<th style="text-align: right" valign="middle">
						<input type="button" class="button" name="add_fields_order" value="Add" onclick="addField('fields_order');" />
					</th>
				</tr>
				<TR class="row1">
					<td width="45%" style="text-align: right">
						CSV Field Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</TD>
					<TD width="55%" style="text-align: left">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joomla Field Name
					</TD>
				</TR>
				<TR class="row0">
					<td width="100%" colspan="2" id="fields_order">
					<?php if (!count($fields_order)) { ?>
						No any defined
					<?php } else { foreach ($fields_order AS $k => $v) { ?>
					<div id="src_<?php echo $row_index; ?>" style="width: 44%; float: left; text-align: right; margin-top: 1px; margin-bottom: 1px">
						<input type="text" name="csv_fields_order[<?php echo $row_index; ?>]" value="<?php echo $k; ?>" size="40" style="text-align: right" />
					</div>
					<div id="dst_<?php echo $row_index; ?>" style="width: 54%; float: right; text-align: left; margin-top: 1px; margin-bottom: 1px">
						<select name="joomla_fields_name[<?php echo $row_index; ?>]">
							<option value="">------------ c.l.i.c.k..t.o..s.e.l.e.c.t -------------</option>
							<?php
								foreach ($fields AS $field) {
									if (!preg_match("/\bid\b/", $field->Field)) {
							?>
							<option value="<?php echo $field->Field; ?>"<?php echo $v == $field->Field ? ' selected' : ''; ?>><?php echo $field->Field; ?></option>
							<?php
									}
								}
							?>
						</select>
						<input type="button" class="button" style="margin-left:10px" name="Remove" value="Remove" onclick="removeRow(<?php echo $row_index; ?>)" />
					</div>
					<script type="text/javascript">row_index += 1;</script>
					<?php $row_index++; } } ?>
					</TD>
				</TR>
			</table>
			</div>
			<div id="fields_name_container" style="display:<?php echo $general_settings->get('showcsvnames') == 1 ? 'block' : 'none'; ?>">
			<TABLE class="adminform">
				<tr>
					<th>Fields Name Settings</th>
					<th style="text-align: right" valign="middle">
						<input type="button" class="button" name="add_fields_conversion" value="Add" onclick="addField('fields_name');" />
					</th>
				</tr>
				<TR class="row1">
					<td width="45%" style="text-align: right">
						CSV Field Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</TD>
					<TD width="55%" style="text-align: left">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joomla Field Name
					</TD>
				</TR>
				<TR class="row0">
					<td width="100%" colspan="2" id="fields_name">
					<?php if (!count($fields_conversion)) { ?>
						No any defined
					<?php } else { foreach ($fields_conversion AS $k => $v) { ?>
					<div id="src_<?php echo $row_index; ?>" style="width: 44%; float: left; text-align: right; margin-top: 1px; margin-bottom: 1px">
						<input type="text" name="csv_fields_name[<?php echo $row_index; ?>]" value="<?php echo $k; ?>" size="40" style="text-align: right" />
					</div>
					<div id="dst_<?php echo $row_index; ?>" style="width: 54%; float: right; text-align: left; margin-top: 1px; margin-bottom: 1px">
						<select name="joomla_fields_name[<?php echo $row_index; ?>]">
							<option value="">------------ c.l.i.c.k..t.o..s.e.l.e.c.t -------------</option>
							<?php
								foreach ($fields AS $field) {
									if (!preg_match("/\bid\b/", $field->Field)) {
							?>
							<option value="<?php echo $field->Field; ?>"<?php echo $v == $field->Field ? ' selected' : ''; ?>><?php echo $field->Field; ?></option>
							<?php
									}
								}
							?>
						</select>
						<input type="button" class="button" style="margin-left:10px" name="Remove" value="Remove" onclick="removeRow(<?php echo $row_index; ?>)" />
					</div>
					<script type="text/javascript">row_index += 1;</script>
					<?php $row_index++; } } ?>
					</TD>
				</TR>
			</table>
			</div><br/>
			<TABLE class="adminform">
				<tr>
					<th>User Groups Settings</th>
					<th style="text-align: right" valign="middle">
						<input type="button" class="button" name="add_user_groups_conversion" value="Add" onclick="addField('user_groups');" />
					</th>
				</tr>
				<TR class="row1">
					<td width="45%" style="text-align: right">
						CSV User Groups&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</TD>
					<TD width="55%" style="text-align: left">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joomla User Groups
					</TD>
				</TR>
				<TR class="row0">
					<td width="100%" colspan="2" id="user_groups">
					<?php if (!count($user_groups)) { ?>
						No any defined
					<?php } else {
						$groups = $acl->get_group_children_tree( null, 'USERS' );
						foreach ($user_groups AS $k => $v) {
					?>
					<div id="src_<?php echo $row_index; ?>" style="width: 44%; float: left; text-align: right; margin-top: 1px; margin-bottom: 1px">
						<input type="text" name="csv_user_groups[<?php echo $row_index; ?>]" value="<?php echo $k; ?>" size="40" style="text-align: right" />
					</div>
					<div id="dst_<?php echo $row_index; ?>" style="width: 54%; float: right; text-align: left; margin-top: 1px; margin-bottom: 1px">
						<select name="joomla_user_groups[<?php echo $row_index; ?>]">
							<option value="">------------ c.l.i.c.k..t.o..s.e.l.e.c.t -------------</option>
							<?php
								foreach ($groups AS $group) {
									if (!preg_match("/\bUSERS\b/", $group->text)) {
							?>
							<option value="<?php echo str_replace('-', '', str_replace('&nbsp;', '', str_replace('.', '', $group->text))); ?>"<?php echo $v == str_replace('-', '', str_replace('&nbsp;', '', str_replace('.', '', $group->text))) ? ' selected' : ''; ?>><?php echo str_replace("&nbsp;", "-", str_replace('.', '', $group->text)); ?></option>
							<?php
									}
								}
							?>
						</select>
						<input type="button" class="button" style="margin-left:10px" name="Remove" value="Remove" onclick="removeRow(<?php echo $row_index; ?>)" />
					</div>
					<script type="text/javascript">row_index += 1;</script>
					<?php $row_index++; } } ?>
					</TD>
				</TR>
			</table>
			<br/>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
		</FORM>
		<?php
	}

	function upload() {
		global $option, $acl;
		?>
		<FORM METHOD="POST" NAME="adminForm" ACTION="index2.php" enctype="multipart/form-data">
			<table class="adminheading">
			<tr>
				<th>
				<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ Upload CSV file to import ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminform">
				<tr><th colspan="2">Filter Settings</th></tr>
				<TR class="row0">
					<td width="40%" valign="top" style="text-align: right">
						User Groups&nbsp;
					</TD>
					<TD width="60%">
						<?php
							$groups = $acl->get_group_children_tree( null, 'USERS' );
						?>
						<select name="filter_group[]" size="<?php echo (count($groups) - 1); ?>" multiple="multiple">
							<?php
								foreach ($groups AS $group) {
									if (!preg_match("/\bUSERS\b/", $group->text)) {
							?>
							<option value="<?php echo str_replace('-', '', str_replace('&nbsp;', '', str_replace('.', '', $group->text))); ?>"><?php echo str_replace("&nbsp;", "-", str_replace('.', '', $group->text)); ?></option>
							<?php
									}
								}
							?>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						Name Like&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="filter_name" value="" size="40" />
					</TD>
				</TR>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Username Like&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="filter_username" value="" size="40" />
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						Email Like&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="filter_email" value="" size="40" />
					</TD>
				</TR>
			</table>
			<br/>
			<TABLE class="adminform">
				<tr><th>Select File</th></tr>
				<TR class="row0"><td style="text-align:center">
	            	<input class="inputbox" type="file" name="csv_file" size="60" />
	            	&nbsp;&nbsp;<input type="button" class="button" name="Import" value="Import" onclick="document.adminForm.task.value='import'; document.adminForm.submit();" />
	            	&nbsp;&nbsp;(Max size = <?php echo ini_get( 'post_max_size' );?>)
				</td></tr>
			</table>
			<br/>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
		</form>
		<?php
	}

	function import() {
		global $option;
		?>
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ Import CSV file to Joomla database ]</small></small>
			</th>
		</tr>
		</table><br/>
		<TABLE class="adminform">
			<tr><th>Import Results</th></tr>
			<TR class="row0"><td style="text-align:center">
				<?php usersync::importCSV(); ?>
			</td></tr>
		</table>
		<br/>
		<?php
	}

	function export( &$params ) {
		global $option, $database, $acl;
		if ($params->get('export_conversion', 'same') == 'custom') {
			HTML_usersync::common_js();
			$row_index = 0;
		}
		?>
		<FORM METHOD="POST" NAME="adminForm" ACTION="index3.php?no_html=1'; ?>">
			<table class="adminheading">
			<tr>
				<th>
				<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ Export Joomla database to CSV file ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminform">
				<tr><th colspan="2">Filter Settings</th></tr>
				<TR class="row0">
					<td width="40%" valign="top" style="text-align: right">
						User Groups&nbsp;
					</TD>
					<TD width="60%">
						<?php
							$groups = $acl->get_group_children_tree( null, 'USERS' );
						?>
						<select name="filter_group[]" size="<?php echo (count($groups) - 1); ?>" multiple="multiple">
							<?php
								foreach ($groups AS $group) {
									if (!preg_match("/\bUSERS\b/", $group->text)) {
							?>
							<option value="<?php echo $group->value; ?>"><?php echo str_replace("&nbsp;", "-", str_replace('.', '', $group->text)); ?></option>
							<?php
									}
								}
							?>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						Name Like&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="filter_name" value="" size="40" />
					</TD>
				</TR>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Username Like&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="filter_username" value="" size="40" />
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						Email Like&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="filter_email" value="" size="40" />
					</TD>
				</TR>
				<?php
				if ($params->get('export_conversion', 'same') != 'custom') {
				?>
			</table>
			<br/>
			<TABLE class="adminform">
				<tr><th>Save File</th></tr>
				<tr class="row0"><td style="text-align:center">
					<input type="button" class="button" name="Download" value="Download" onclick="document.adminForm.task.value='download'; document.adminForm.submit();" />
				</td></tr>
				<?php
				}
				?>
			</table><br/>
			<?php
			if ($params->get('export_conversion', 'same') == 'custom') {
			?>
			<TABLE class="adminform">
				<tr><th colspan="2">General Settings</th></tr>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Fields terminated by&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="general_settings[separator]" size="5" value="<?php echo $params->get('separator', ','); ?>" />
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						Fields enclosed by&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="general_settings[enclosed]" size="5" value="<?php echo $params->get('enclosed'); ?>" />
					</TD>
				</TR>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						Fields names at first row&nbsp;
					</TD>
					<TD width="60%">
						<select name="general_settings[showcsvnames]" onchange="if (this.value == 0) { document.getElementById('fields_name_container').style.display = 'none'; document.getElementById('fields_order_container').style.display = 'block'; } else { document.getElementById('fields_order_container').style.display = 'none'; document.getElementById('fields_name_container').style.display = 'block'; }">
							<option value="0"<?php echo $params->get('showcsvnames') == 0 ? ' selected' : ''; ?>>No</option>
							<option value="1"<?php echo $params->get('showcsvnames') == 1 ? ' selected' : ''; ?>>Yes</option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						User group field&nbsp;
					</TD>
					<TD width="60%">
						<input type="text" name="general_settings[group_field]" size="15" value="<?php echo $params->get('group_field', ''); ?>" />
					</TD>
				</TR>
			</table><br/>
			<div id="fields_order_container" style="display:<?php echo $params->get('showcsvnames') == 0 ? 'block' : 'none'; ?>">
			<TABLE class="adminform">
				<tr>
					<th>Fields Order Settings</th>
					<th style="text-align: right" valign="middle">
						<input type="button" class="button" name="add_fields_order" value="Add" onclick="addField('fields_order');" />
					</th>
				</tr>
				<TR class="row1">
					<td width="45%" style="text-align: right">
						CSV Field Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</TD>
					<TD width="55%" style="text-align: left">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joomla Field Name
					</TD>
				</TR>
				<TR class="row0">
					<td width="100%" colspan="2" id="fields_order">
						No any defined
					</TD>
				</TR>
			</table>
			</div>
			<div id="fields_name_container" style="display:<?php echo $params->get('showcsvnames') == 1 ? 'block' : 'none'; ?>">
			<TABLE class="adminform">
				<tr>
					<th>Fields Name Settings</th>
					<th style="text-align: right" valign="middle">
						<input type="button" class="button" name="add_fields_conversion" value="Add" onclick="addField('fields_name');" />
					</th>
				</tr>
				<TR class="row1">
					<td width="45%" style="text-align: right">
						CSV Field Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</TD>
					<TD width="55%" style="text-align: left">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joomla Field Name
					</TD>
				</TR>
				<TR class="row0">
					<td width="100%" colspan="2" id="fields_name">
						No any defined
					</TD>
				</TR>
			</table>
			</div><br/>
			<TABLE class="adminform">
				<tr>
					<th>User Groups Settings</th>
					<th style="text-align: right" valign="middle">
						<input type="button" class="button" name="add_user_groups_conversion" value="Add" onclick="addField('user_groups');" />
					</th>
				</tr>
				<TR class="row1">
					<td width="45%" style="text-align: right">
						CSV User Groups&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</TD>
					<TD width="55%" style="text-align: left">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joomla User Groups
					</TD>
				</TR>
				<TR class="row0">
					<td width="100%" colspan="2" id="user_groups">
						No any defined
					</TD>
				</TR>
			</table>
			<br/>
			<TABLE class="adminform">
				<tr><th>Save File</th></tr>
				<tr class="row0"><td style="text-align:center">
					<input type="button" class="button" name="Download" value="Download" onclick="document.adminForm.task.value='download'; document.adminForm.submit();" />
				</td></tr>
			</table>
			<br/>
			<?php
			}
			?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="download" />
			<?php
			if ($params->get('export_conversion', 'same') == 'custom') {
			?>
			<input type="hidden" name="custom_config" value="1" />
			<?php
			} else {
			?>
			<input type="hidden" name="custom_config" value="0" />
			<?php
			}
			?>
		</form>
		<?php
	}

	function register($step) {
		global $option;
		?>
		<FORM METHOD="POST" NAME="adminForm" ACTION="index2.php" enctype="multipart/form-data">
			<table class="adminheading">
			<tr>
				<th>
				<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ <?php echo 'Registration Step '.($step == 'register_step1' ? '1' : '2'); ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<table class="adminform">
			<?php if ($step == 'register_step1') { ?>
				<tr><th>Input your License Key</th></tr>
				<tr class="row1">
					<td width="100%" style="text-align:center">
					<input class="inputbox" type="text" name="license_key" value="" style="width:69%" />
					</td>
				</tr>
			<?php } else { ?>
				<tr><th>Upload your Local Key</th></tr>
				<tr class="row0">
					<td>You will soon receive your Local Key via email. If in any bad case you not receive the Local Key via email within 5 minutes then please login to our client area and download it from there:<br/><br/>
					<a href="http://designforjoomla.com/client/client_area.php" target="_blank">http://designforjoomla.com/client/client_area.php</a><br/><br/>
					After logging in, please click the menu item named <strong>View Your Licenses</strong> then <strong>View &amp; Download</strong> button in the opened page. Finally, at the <b>Viewing License Details</b> page, please click the <b>Download Local Key</b> button to download the issued Local Key.<br/><br/>
					After saving the Local Key into a folder in your local PC, please use the <strong>Browse</strong> button below to select it.</td>
				</tr>
				<tr class="row1">
					<td width="100%" style="text-align:center">
					<input type="hidden" name="local_key_uploaded" value="1" />
					<input name="local_key_file" type="file" size="80" />
					</td>
				</tr>
			<?php } ?>
				<TR class="row0">
					<TD style="text-align:center">
						<input class="inputbox" type="submit" name="submit" value="Submit" />
					</TD>
				</TR>
			</table><br/>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
		</form>
		<?php
	}

	function requestSupport($msg = '', $license = '') {
		global $option, $mosConfig_sitename, $mosConfig_live_site;
		?>
		<FORM METHOD="POST" NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ <?php echo $msg != '' ? 'Error Occured: '.$msg : 'Request Support'; ?> ]</small></small>
				</th>
			</tr>
			<?php if ($msg != '') { ?>
			<tr>
				<td align="left" style="font-weight:normal">
				<?php if (preg_match("/^Invalid.*$/i", $msg)) { ?>
				If you have already used the License Key <b><?php echo $license; ?></b> to activate our product before then please login to our client area and set it to <b>Reissued</b> status:<br/><br/>
				<a href="http://designforjoomla.com/client/client_area.php" target="_blank">http://designforjoomla.com/client/client_area.php</a><br/><br/>
				After logging in, please click the menu item named <strong>View Your Licenses</strong> then <strong>View &amp; Download</strong> button in the opened page. Finally, at the <b>Viewing License Details</b> page, please click the <b>Reissue License</b> button to reissue your License Key.<br/><br/>
				<?php } ?>
				If you feel this error is not dedicated to your usage or your hosting environment then please use the form below to send support request to <b>The DesignForJoomla.com team</b>.
				</td>
			</tr>
			<?php } ?>
			</table><br/>
			<TABLE class="adminform">
				<tr><th colspan="2">Support Request Details</th></tr>
				<TR class="row0">
					<td width="25%" style="text-align: right">
						Subject&nbsp;
					</TD>
					<TD width="75%">
						<input class="inputbox" type="text" name="support_request[subject]" value="<?php echo 'Support Request from '.$mosConfig_sitename.' ( '.$mosConfig_live_site.' )'; ?>" maxlength="255" style="width:69%" />
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						Message&nbsp;
					</TD>
					<TD>
						<textarea class="inputbox" name="support_request[message]" rows="60" cols="20" style="width:69%;height:300px"><?php
							echo 'Product Name: '._D4J_PRODUCT_NAME."\n\n";
							if ($license != '') {
								echo "License Key: $license\n\n";
							}
							if ($msg != '') {
								echo "Error Occured: $msg\n\n";
							}
							echo 'Your Message: ';
						?></textarea>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						&nbsp;
					</TD>
					<TD>
						<input class="inputbox" type="submit" name="support_request[send]" value="Send" />
					</TD>
				</TR>
			</table><br/>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="sendSupportRequest" />
		</form>
		<?php
	}

	function aboutUs( $row ) {
		global $option;
		?>
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ About ]</small></small>
			</th>
		</tr>
		</table><br/>
		<TABLE class="adminform">
			<tr><th colspan="2">Product Details</th></tr>
			<TR class="row0">
				<td width="35%" style="text-align: right">
					Name:&nbsp;
				</TD>
				<TD width="65%">
					<?php echo _D4J_PRODUCT_NAME; ?>
				</TD>
			</TR>
			<TR class="row1">
				<td style="text-align: right">
					Product Version:&nbsp;
				</TD>
				<TD>
					<?php echo $row->version; ?>
				</TD>
			</TR>
			<TR class="row0">
				<td style="text-align: right">
					Build On:&nbsp;
				</TD>
				<TD>
					<?php echo $row->creationDate; ?>
				</TD>
			</TR>
			<TR class="row1">
				<td style="text-align: right">
					Description:&nbsp;
				</TD>
				<TD>
					<?php echo $row->description; ?>
				</TD>
			</TR>
			<TR class="row0">
				<td style="text-align: right">
					Author:&nbsp;
				</TD>
				<TD>
					<?php echo $row->author; ?>
				</TD>
			</TR>
			<TR class="row1">
				<td style="text-align: right">
					Author Email:&nbsp;
				</TD>
				<TD>
					<a href="index2.php?option=<?php echo $option; ?>&amp;task=requestSupport"><?php echo $row->authorEmail; ?></a>
				</TD>
			</TR>
			<TR class="row0">
				<td style="text-align: right">
					Author Homepage:&nbsp;
				</TD>
				<TD>
					<a href='<?php echo !preg_match("/^http:\/\//i", $row->authorUrl) ? "http://$row->authorUrl" : $row->authorUrl; ?>' target="_blank"><?php echo $row->authorUrl; ?></a>
				</TD>
			</TR>
			<TR class="row1">
				<td style="text-align: right">
					Copyright:&nbsp;
				</TD>
				<TD>
					<?php echo $row->copyright; ?>
				</TD>
			</TR>
			<TR class="row0">
				<td style="text-align: right">
					License:&nbsp;
				</TD>
				<TD>
					<?php echo $row->license; ?>
				</TD>
			</TR>
		</table><br/>
		<?php
	}
}
?>