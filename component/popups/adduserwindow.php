<?php
/**
* eZine component :: add user popup
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// check user for correct permisson
$database->setQuery( "SELECT id AS value, menu_name AS `text` FROM #__ezine_page ORDER BY id" );
$pages = $database->loadObjectList();
$lists['pages'] = '';
$row = 0;
foreach ($pages AS $page) {
	$lists['pages'] .= '<tr><td width="10%">'.mosHTML::idBox( $row, $page->value, false, 'pages' ).'</td>';
	$lists['pages'] .= '<td width="90%">&nbsp;'.$page->text.'</td></tr>';
	$row++;
}
?>

<br />
<div align="center">
<div class="main">
<table width="100%" border="0">
	<tr>
		<td valign="middle" align="center">
<script type="text/javascript">
var page_found = <?php echo count($pages); ?>;
var user_found = 0;
var _FILTER_EMPTY = "<?php echo _FILTER_EMPTY; ?>";
var _SUBSCRIBE_EMPTY = "<?php echo _SUBSCRIBE_EMPTY; ?>";
</script>
		<form onsubmit="if (document.adminForm.filter.value != '') call_getUsers(document.adminForm.filter.value);" method="post" name="adminForm">
		<table width="100%" class="adminheading">
		<tr>
			<th>
			eZine <small><small>[ <?php echo _ADD_SUBSCRIBERS; ?> ]</small></small>
			</th>
		</tr>
		</table><br/>
		<script type="text/javascript">
		function addUsers() {
			var thisform = document.adminForm;
			var thatform = opener.document.adminForm;
			for (var i = 0; i < user_found; i++) {
				cb = eval( 'thisform.user' + i );
				if (cb.checked == true) {
					var user = opener.document.createElement('input');
					user.setAttribute('type', 'hidden');
					user.setAttribute('name', 'users[]');
					user.setAttribute('value', cb.value);
					thatform.appendChild(user);
				}
			}
			for (var i = 0; i < page_found; i++) {
				cb = eval( 'thisform.cb' + i );
				if (cb.checked == true) {
					var page = opener.document.createElement('input');
					page.setAttribute('type', 'hidden');
					page.setAttribute('name', 'pages[]');
					page.setAttribute('value', cb.value);
					thatform.appendChild(page);
				}
			}
			thatform.task.value = 'addusers';
			thatform.submit();
			window.close();
		}
		</script>
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr><td width="100%" colspan="2" valign="top">
			<table width="100%" class="adminlist">
			<tr><td style="text-align:center">
			<strong><?php echo _FILTER_USERS; ?></strong>&nbsp;
			<input type="text" size="50" value="" class="inputbox" name="filter" onkeyup="if (document.adminForm.filter.value != '') call_getUsers(document.adminForm.filter.value);" />
			</td></tr>
			</table><br/>
			</td></tr>
			<tr><td width="60%" valign="top" id="user_list">
				<table class="adminlist"><tr>
					<th class="title" width="10">
					#
					</th>
					<th align="center" width="35">
					<input name="toggle" value="" onclick="isChecked(this.checked); checkAll(0);" type="checkbox">
					</th>
					<th class="title" width="25%">
					<?php echo _NAME; ?>
					</th>
					<th class="title" width="25%">
					<?php echo _USERNAME; ?>
					</th>
					<th class="title" width="50%">
					<?php echo _EMAIL; ?>
					</th>
				</tr></table>
			</td><td width="40%" valign="top">
			<table width="100%" class="adminlist">
			<tr><th colspan="2"><?php echo _SELECT_PAGE; ?></th></tr>
			<?php echo $lists['pages']; ?>
			</table>
			</td></tr>
			<tr><td width="100%" colspan="2" valign="top" style="text-align:center">
			<br/><input type="button" class="button" name="Add" value="<?php echo _ADD_SUBSCRIBERS; ?>" onclick="addUsers();" />
			</td></tr>
		</table><br/>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="adduser" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		</td>
	</tr>
</table>
</div>
</div>
<br/>