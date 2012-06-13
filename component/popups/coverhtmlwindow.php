<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// get parameters
$pageid = mosGetParam( $_REQUEST, 'pageid' );
if (!$pageid) {
	echo _INVALID_PARAMS;
	exit();
}
$task = mosGetParam( $_REQUEST, 'go', '' );

$database->setQuery("SELECT params FROM #__ezine_page WHERE id = $pageid LIMIT 0,1");
if (!($p = $database->loadResult())) {
	echo _ERROR_QUERY_DB;
	exit();
}

if ($task == 'update') {
	$cover_html_code = stripslashes( str_replace( "\n", "-newline-", mosGetParam( $_REQUEST, 'cover_html_code', '', _MOS_ALLOWHTML) ) );
	$params = explode( "\n", $p );
	$new_params = '';
	foreach ($params AS $param) {
		if (preg_match("/cover_html=/", $param)) {
			$new_params .= "cover_html=$cover_html_code\n";
		} else {
			$new_params .= "$param\n";
		}
	}
	$database->setQuery("UPDATE #__ezine_page SET params = '".stripslashes( $new_params )."' WHERE id = $pageid LIMIT 1");
	if (!($database->query())) {
		echo _ERROR_QUERY_DB;
		exit();
	} else { ?>
<script type="text/javascript">
	opener.document.getElementById('cover_html_<?php echo $pageid; ?>').src = '<?php echo ($cover_html_code == "") ? "images/publish_x.png" : "images/tick.png"; ?>';
	window.close();
</script>
<?php
	}
} elseif ($task == 'remove') {
	$cover_html_code = '';
	$params = explode( "\n", $p );
	$new_params = '';
	foreach ($params AS $param) {
		if (preg_match("/cover_html=/", $param)) {
			$new_params .= "cover_html=$cover_html_code\n";
		} else {
			$new_params .= "$param\n";
		}
	}
	$database->setQuery("UPDATE #__ezine_page SET params = '".stripslashes( $new_params )."' WHERE id = $pageid LIMIT 1");
	if (!($database->query())) {
		echo _ERROR_QUERY_DB;
		exit();
	} else { ?>
<script type="text/javascript">
	opener.document.getElementById('cover_html_<?php echo $pageid; ?>').src = 'images/publish_x.png';
	window.close();
</script>
<?php
	}
} else {
	// init editor
	include_once( _EZINE_ADMIN_PATH.'/../../../editor/editor.php' );
	initEditor();

	// get current param
	$params =& new mosParameters( $p );
	$cover_html_code = str_replace("-newline-", "\n", $params->get("cover_html", ''));
?>
<br />
<div align="center">
<div class="main">
<table width="100%" border="0">
	<tr>
		<td valign="middle" align="center">
		<form name="adminForm" method="post" action="index3.php?option=<?php echo $option; ?>&task=popup&popup=coverhtmlwindow&pageid=<?php echo $pageid; ?>">
		<table width="100%" class="adminheading">
		<tr>
			<th>
			eZine <small><small>[ <?php echo _PAGE_COVER_HTML_CODE; ?> ]</small></small>
			</th>
		</tr>
		</table><br/>
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
				<td colspan="2"><table border="0">
				<tr><td width="20%">&nbsp;</td><td width="60%">
				<?php
				// parameters : areaname, content, hidden field, width, height, cols, rows
				editorArea( 'cover_html_editor', $cover_html_code, 'cover_html_code', '500', '300', '89', '19' );
				?>
				</td><td width="20%">&nbsp;</td></tr>
				</table></td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td align="center">
				<input type="button" class="button" onclick="document.adminForm.action = document.adminForm.action + '&go=update'; document.adminForm.submit();" value="<?php echo _UPDATE_HTML; ?>" />
				</td>
				<td align="center">
				<input type="button" class="button" onclick="document.adminForm.action = document.adminForm.action + '&go=remove'; document.adminForm.submit();" value="<?php echo _REMOVE_HTML; ?>" />
				</td>
			</tr>
		</table><br/>
		</form>
		</td>
	</tr>
</table>
</div>
</div>
<br/>
<?php
}
?>