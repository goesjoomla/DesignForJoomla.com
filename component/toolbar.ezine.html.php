<?php
/**
* eZine component :: toolbar output
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class ezineMenuBar extends mosMenuBar {
	function popup( $popup, $name, $img, $img_f2='' ) {
		global $option;
		$image = mosAdminMenus::ImageCheckAdmin( $img, '/administrator/images/', NULL, NULL, $name, strtolower($name) );
		if ($img_f2 != '')
			$image2 = mosAdminMenus::ImageCheckAdmin( $img_f2, '/administrator/images/', NULL, NULL, $name, strtolower($name), 0 );
		?>
		<td>
		<script language="javascript">
		function popupWindow() {
			window.open('index3.php?option=<?php echo $option; ?>&task=popup&popup=<?php echo $popup; ?>', '<?php echo $name; ?>', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
		}
		</script>
	 	<a class="toolbar" href="#" onclick="popupWindow();"<?php echo ($img_f2 != '') ? ' onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage(\''.strtolower($name).'\',\'\',\''.$image2.'\',1);"' : ''; ?>>
		<?php echo $image; ?>&nbsp;&nbsp;&nbsp;<?php echo $name; ?>
		</a>
		</td>
		<?php
	}
}

class TOOLBAR_content {
	function _CONFIG() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'saveconfig', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _PAGE() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'newpage', 'new.png', 'new_f2.png', 'New', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'editpage', 'edit.png', 'edit_f2.png', 'Edit', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'swap_page_status', 'switch.png', 'switch_f2.png', 'Publish / Unpublish', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'delpage', 'delete.png', 'delete_f2.png', 'Remove', true );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _EDITPAGE() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'savepage', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'managepage', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _SEFURL() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'newsef', 'new.png', 'new_f2.png', 'Add URL', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'editsef', 'edit.png', 'edit_f2.png', 'Edit URL', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'delsef', 'delete.png', 'delete_f2.png', 'Remove', true );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _EDITSEFURL() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'savesef', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'managesef', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _NEWSLETTER() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'newletter', 'new.png', 'new_f2.png', 'New', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'editletter', 'edit.png', 'edit_f2.png', 'Edit', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'manageusers', 'groups.png', 'groups_f2.png', 'Subcribers', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'sendletter', 'publish.png', 'publish_f2.png', 'Send', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'delletter', 'delete.png', 'delete_f2.png', 'Remove', true );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _EDITNEWSLETTER() {
		global $option;
		mosMenuBar::startTable();
		mosMenuBar::preview( '../index3.php?option='.$option.'&task=popup&popup=newsletterwindow', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'saveletter', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'manageletter', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _SUBSCRIBERS() {
		mosMenuBar::startTable();
		ezineMenuBar::popup( 'adduserwindow', 'Add', 'new_f2.png', '' );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'delusers', 'delete.png', 'delete_f2.png', 'Remove', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'manageletter', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _CATEGORY() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'addcontent', 'new.png', 'new_f2.png', 'Add Content', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'addseparator', 'new.png', 'new_f2.png', 'Add Separator', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'editcat', 'edit.png', 'edit_f2.png', 'Edit', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'swap_category_status', 'switch.png', 'switch_f2.png', 'Publish / Unpublish', true );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'delcat', 'delete.png', 'delete_f2.png', 'Remove', true );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _ADDCONTENT() {
		$content_type = mosGetParam( $_POST, 'content_type', '' );
		mosMenuBar::startTable();
		if ($content_type == '') {
			mosMenuBar::custom( 'addcontent', 'next.png', 'next_f2.png', 'Next', true );
		} else {
			mosMenuBar::custom( 'add_content_to_page', 'save.png', 'save_f2.png', 'Add', true );
		}
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _EDITCAT() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'savecat', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'managecat', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _EDITCSS() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'savecss', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _EDITLANG() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'savelang', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _ADDSEPARATOR() {
		$separator_type = mosGetParam( $_POST, 'separator_type', '' );
		mosMenuBar::startTable();
		if ($separator_type == '') {
			mosMenuBar::custom( 'addseparator', 'next.png', 'next_f2.png', 'Next', true );
		} elseif ($separator_type == 'html_code') {
			mosMenuBar::custom( 'saveseparator', 'save.png', 'save_f2.png', 'Add', false );
		} else {
			mosMenuBar::custom( 'saveseparator', 'save.png', 'save_f2.png', 'Add', true );
		}
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _EDITSEPARATOR() {
		global $separator_type;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'saveseparator', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'managecat', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _ABOUT() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
}
?>
