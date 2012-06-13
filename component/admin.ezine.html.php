<?php
/**
* eZine component :: html output functions
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/d4jCSS.php');
include_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/d4jJS.php');
?>

<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/<?php echo $option; ?>/admin.ezine.ajax.compact.js"></script>
<div id="old_value" style="display: none;"></div>

<?php
class HTML_ezine {

// Global Settings configuration
	function showGlobalSettings( &$params ) {
		global $option, $func, $database;
		mosCommonHTML::loadOverlib();
		$tabs = new mosTabs(1);
		?>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo _GLOBAL_SETTINGS; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<?php
			$tabs->startPane("ezine-global-settings");
			$tabs->startTab(substr(_AJAX_SET, 0, strpos(_AJAX_SET, ' ')),"ajax-page");
			?>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _AJAX_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<B><?php echo _CATEGORY_OPEN_AJAX_ENABLE; ?></B>&nbsp;
					</TD>
					<TD width="55%">
						<SELECT NAME="params[category_open_ajax_enable]">
							<option <?php if ($params->get('category_open_ajax_enable') == '1') echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('category_open_ajax_enable') == '0') echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_OPEN_AJAX_ENABLE; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[content_open_ajax_enable]">
							<option <?php if ($params->get('content_open_ajax_enable') == '1') echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('content_open_ajax_enable') == '0') echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _AJAX_SEF_URL_ENABLE; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[ajax_sef_url_enable]">
							<option <?php if ($params->get('ajax_sef_url_enable') == '1') echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('ajax_sef_url_enable') == '0') echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
			</table>
			<?php
			$tabs->endTab();
			$tabs->startTab(substr(_IMAGE_SET, 0, strpos(_IMAGE_SET, ' ')),"image-page");
			?>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _GENERAL_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _HIDE_FIRST_MOSIMAGE_TIPS; ?>', CAPTION, '<?php echo _HIDE_FIRST_MOSIMAGE; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _HIDE_FIRST_MOSIMAGE; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD width="55%">
						<SELECT NAME="params[hide_first_mosimage]">
							<option <?php if ($params->get('hide_first_mosimage') == '0') echo 'selected'; ?> value="0">No</option>
							<option <?php if ($params->get('hide_first_mosimage') == '1') echo 'selected'; ?> value="1">Yes</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _REAL_THUMBNAIL_TIPS; ?>', CAPTION, '<?php echo _REAL_THUMBNAIL; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _REAL_THUMBNAIL; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[create_real_thumb]" onchange="if (this.options[this.selectedIndex].value == 1) document.getElementById('real_thumbnail').style.display='block'; else document.getElementById('real_thumbnail').style.display='none';">
							<option <?php if ($params->get('create_real_thumb') == '0') echo 'selected'; ?> value="0">No</option>
							<option <?php if ($params->get('create_real_thumb') == '1') echo 'selected'; ?> value="1">Yes</option>
						</SELECT>
					</TD>
				</TR>
			</table>
			<div id="real_thumbnail" style="display:<?php echo $params->get('create_real_thumb') == '1' ? 'block' : 'none'; ?>">
			<TABLE class="adminform">
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _THUMBNAIL_DIR_TIPS; ?>', CAPTION, '<?php echo _THUMBNAIL_DIR; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _THUMBNAIL_DIR; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD width="55%">
						<INPUT CLASS="inputbox" TYPE="text" name="params[thumb_directory]" value="<?php echo $params->get('thumb_directory'); ?>" size="20">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _IMAGE_LIB_TIPS; ?>', CAPTION, '<?php echo _IMAGE_LIB; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _IMAGE_LIB; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[image_library]">
							<option <?php if ($params->get('image_library') == 'gd2') echo 'selected'; ?> value="0">GD2</option>
							<option <?php if ($params->get('image_library') == 'imagemagick') echo 'selected'; ?> value="1">ImageMagick</option>
							<option <?php if ($params->get('image_library') == 'netpbm') echo 'selected'; ?> value="2">NetPBM</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _IMAGE_LIB_PATH_TIPS; ?>', CAPTION, '<?php echo _IMAGE_LIB_PATH; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _IMAGE_LIB_PATH; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[image_library_path]" value="<?php echo $params->get('image_library_path'); ?>" size="20">
					</TD>
				</TR>
			</table>
			</div>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _THUMBNAIL_IMAGE_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<B><?php echo _THUMBNAIL_IMAGE_LINK; ?></B>&nbsp;
					</TD>
					<TD width="55%">
						<SELECT NAME="params[thumbnail_image_link]">
							<option <?php if ($params->get('thumbnail_image_link') == '0') echo 'selected'; ?> value="0">No Hyper-link</option>
							<option <?php if ($params->get('thumbnail_image_link') == '1') echo 'selected'; ?> value="1">Link to News Item</option>
							<option <?php if ($params->get('thumbnail_image_link') == '2') echo 'selected'; ?> value="2">Link to Image (popup)</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_PROCESS_MENTHOD; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[thumbnail_process_menthod]" class="inputbox">
							<option value="0" <?php if ($params->get('thumbnail_process_menthod') == 0) echo 'selected'; ?>><?php echo _REDUCE_LARGE_IMG_ONLY; ?></option>
							<option value="1" <?php if ($params->get('thumbnail_process_menthod') == 1) echo 'selected'; ?>><?php echo _ENLARGE_SMALL_IMG_ONLY; ?></option>
							<option value="2" <?php if ($params->get('thumbnail_process_menthod') == 2) echo 'selected'; ?>><?php echo _BOTH_REDUCE_ENLARGE; ?></option>
						</select>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_KEEP_RATIO; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[thumbnail_keep_ratio]" class="inputbox">
							<option value="0" <?php if ($params->get('thumbnail_keep_ratio') == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if ($params->get('thumbnail_keep_ratio') == 1) echo 'selected'; ?>><?php echo _FIT_WIDTH; ?></option>
							<option value="2" <?php if ($params->get('thumbnail_keep_ratio') == 2) echo 'selected'; ?>><?php echo _FIT_HEIGHT; ?></option>
							<option value="3" <?php if ($params->get('thumbnail_keep_ratio') == 3) echo 'selected'; ?>><?php echo _FIT_BOTH; ?></option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _LEFT_FEATURED_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_left_width]" value="<?php echo $params->get('featured_image_left_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_left_height]" value="<?php echo $params->get('featured_image_left_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _RIGHT_FEATURED_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_right_width]" value="<?php echo $params->get('featured_image_right_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_right_height]" value="<?php echo $params->get('featured_image_right_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _TOP_FEATURED_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_top_width]" value="<?php echo $params->get('featured_image_top_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_top_height]" value="<?php echo $params->get('featured_image_top_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _BOTTOM_FEATURED_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_bottom_width]" value="<?php echo $params->get('featured_image_bottom_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[featured_image_bottom_height]" value="<?php echo $params->get('featured_image_bottom_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _LEFT_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_left_width]" value="<?php echo $params->get('thumbnail_image_left_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_left_height]" value="<?php echo $params->get('thumbnail_image_left_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _RIGHT_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_right_width]" value="<?php echo $params->get('thumbnail_image_right_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_right_height]" value="<?php echo $params->get('thumbnail_image_right_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _TOP_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_top_width]" value="<?php echo $params->get('thumbnail_image_top_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_top_height]" value="<?php echo $params->get('thumbnail_image_top_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _BOTTOM_THUMBNAIL_DIMENSION; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_bottom_width]" value="<?php echo $params->get('thumbnail_image_bottom_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[thumbnail_image_bottom_height]" value="<?php echo $params->get('thumbnail_image_bottom_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<tr><th colspan="2"><?php echo _LINK_IMAGE_PROCESSOR_SET; ?></th></tr>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _LINK_IMAGE_TYPE; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[link_image_type]">
							<option <?php if ($params->get('link_image_type') == '0') echo 'selected'; ?> value="0">No Hyper-link</option>
							<option <?php if ($params->get('link_image_type') == '1') echo 'selected'; ?> value="1">Link to News Item</option>
							<option <?php if ($params->get('link_image_type') == '2') echo 'selected'; ?> value="2">Link to Image (popup)</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_PROCESS_MENTHOD; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[link_image_process_menthod]" class="inputbox">
							<option value="0" <?php if ($params->get('link_image_menthod') == 0) echo 'selected'; ?>><?php echo _REDUCE_LARGE_IMG_ONLY; ?></option>
							<option value="1" <?php if ($params->get('link_image_process_menthod') == 1) echo 'selected'; ?>><?php echo _ENLARGE_SMALL_IMG_ONLY; ?></option>
							<option value="2" <?php if ($params->get('link_image_process_menthod') == 2) echo 'selected'; ?>><?php echo _BOTH_REDUCE_ENLARGE; ?></option>
						</select>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_KEEP_RATIO; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[link_image_keep_ratio]" class="inputbox">
							<option value="0" <?php if ($params->get('link_image_keep_ratio') == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if ($params->get('link_image_keep_ratio') == 1) echo 'selected'; ?>><?php echo _FIT_WIDTH; ?></option>
							<option value="2" <?php if ($params->get('link_image_keep_ratio') == 2) echo 'selected'; ?>><?php echo _FIT_HEIGHT; ?></option>
							<option value="3" <?php if ($params->get('link_image_keep_ratio') == 3) echo 'selected'; ?>><?php echo _FIT_BOTH; ?></option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _LINK_IMAGE_RESIZE_TO; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[link_image_width]" value="<?php echo $params->get('link_image_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[link_image_height]" value="<?php echo $params->get('link_image_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _LINK_IMAGE_DEFAULT_TIPS; ?>', CAPTION, '<?php echo _LINK_IMAGE_DEFAULT; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _LINK_IMAGE_DEFAULT; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[link_image_default]" value="<?php echo $params->get('link_image_default'); ?>" size="20">
					</TD>
				</TR>
				<tr><th colspan="2"><?php echo _CONTENT_IMAGE_PROCESSOR_SET; ?></th></tr>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_PROCESSOR; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[content_image_processor]" onchange="if (this.options[this.selectedIndex].value == 0) document.getElementById('ezine_mosimage').style.display='block'; else document.getElementById('ezine_mosimage').style.display='none';">
							<option <?php if ($params->get('content_image_processor') == '0') echo 'selected'; ?> value="0">eZine</option>
							<option <?php if ($params->get('content_image_processor') == '1') echo 'selected'; ?> value="1">Mambot</option>
						</SELECT>
					</TD>
				</TR>
			</table>
			<div id="ezine_mosimage" style="display:<?php echo $params->get('content_image_processor') == '0' ? 'block' : 'none'; ?>">
			<TABLE class="adminform">
				<TR class="row1">
					<td width="45%" style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_MARGIN; ?></B>&nbsp;
					</TD>
					<TD width="55%">
						<INPUT CLASS="inputbox" TYPE="text" name="params[margin]" value="<?php echo $params->get('margin'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_PADDING; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[padding]" value="<?php echo $params->get('padding'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_PROCESS_MENTHOD; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[process_menthod]" class="inputbox">
							<option value="0" <?php if ($params->get('process_menthod') == 0) echo 'selected'; ?>><?php echo _REDUCE_LARGE_IMG_ONLY; ?></option>
							<option value="1" <?php if ($params->get('process_menthod') == 1) echo 'selected'; ?>><?php echo _ENLARGE_SMALL_IMG_ONLY; ?></option>
							<option value="2" <?php if ($params->get('process_menthod') == 2) echo 'selected'; ?>><?php echo _BOTH_REDUCE_ENLARGE; ?></option>
						</select>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_KEEP_RATIO; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[keep_ratio]" class="inputbox">
							<option value="0" <?php if ($params->get('keep_ratio') == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if ($params->get('keep_ratio') == 1) echo 'selected'; ?>><?php echo _FIT_WIDTH; ?></option>
							<option value="2" <?php if ($params->get('keep_ratio') == 2) echo 'selected'; ?>><?php echo _FIT_HEIGHT; ?></option>
							<option value="3" <?php if ($params->get('keep_ratio') == 3) echo 'selected'; ?>><?php echo _FIT_BOTH; ?></option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_RESIZE_TO; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[img_width]" value="<?php echo $params->get('img_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[img_height]" value="<?php echo $params->get('img_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_ENABLE_ENLARGE; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[enable_enlarge]" class="inputbox">
							<option value="0" <?php if ($params->get('enable_enlarge') == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if ($params->get('enable_enlarge') == 1) echo 'selected'; ?>>Yes</option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_ENABLE_ENLARGE_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[enable_enlarge_text]" class="inputbox">
							<option value="0" <?php if ($params->get('enable_enlarge_text') == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if ($params->get('enable_enlarge_text') == 1) echo 'selected'; ?>>Yes</option>
						</select>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_ENLARGE_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[enlarge_text]" value="<?php echo $params->get('enlarge_text'); ?>" size="30">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_ENLARGE_TEXT_POS; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[enlarge_text_position]" class="inputbox">
							<option value="above" <?php if ($params->get('enlarge_text_position') == 'above') echo 'selected'; ?>>Above Thumbnail</option>
							<option value="below" <?php if ($params->get('enlarge_text_position') == 'below') echo 'selected'; ?>>Below Thumbnail</option>
						</select>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_TEXT_CSS; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[enlarge_text_css]" value="<?php echo $params->get('enlarge_text_css'); ?>" size="30">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _POPUP_WIN_MAX_SIZE; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[max_popup_width]" value="<?php echo $params->get('max_popup_width'); ?>" size="5">&nbsp;x&nbsp;<INPUT CLASS="inputbox" TYPE="text" name="params[max_popup_height]" value="<?php echo $params->get('max_popup_height'); ?>" size="5">&nbsp;px
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_POPUP_SHOW_PRINT; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[show_print_link]" class="inputbox">
							<option value="0" <?php if ($params->get('show_print_link') == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if ($params->get('show_print_link') == 1) echo 'selected'; ?>>Yes</option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_POPUP_PRINT_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[print_text]" value="<?php echo $params->get('print_text'); ?>" size="30">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_POPUP_SHOW_CLOSE; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[show_close_link]" class="inputbox">
							<option value="0" <?php if ($params->get('show_close_link') == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if ($params->get('show_close_link') == 1) echo 'selected'; ?>>Yes</option>
						</select>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_POPUP_CLOSE_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[close_text]" value="<?php echo $params->get('close_text'); ?>" size="30">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _CONTENT_IMAGE_POPUP_PRINT_CLOSE_CSS; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[print_close_css]" value="<?php echo $params->get('print_close_css'); ?>" size="30">
					</TD>
				</TR>
			</table>
			</div>
			<?php
			$tabs->endTab();
			$tabs->startTab(substr(_ARTICLE_LINK_SET, 0, strpos(_ARTICLE_LINK_SET, ' ')),"article-page");
			?>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _ARTICLE_LINK_SET; ?></th></tr>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _ARTICLE_LINK_ITEMID_TIPS; ?>', CAPTION, '<?php echo _ARTICLE_LINK_ITEMID; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _ARTICLE_LINK_ITEMID; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[article_inherit_itemid]">
							<option <?php if ($params->get('article_inherit_itemid') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('article_inherit_itemid') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<tr><th colspan="2"><?php echo _ARTICLE_ICON_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _ARTICLE_ICON_POSITION_TIPS; ?>', CAPTION, '<?php echo _ARTICLE_ICON_POSITION; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _ARTICLE_ICON_POSITION; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD width="55%">
						<SELECT NAME="params[article_icon_position]">
							<option <?php if ($params->get('article_icon_position') == 'topright') echo 'selected'; ?> value="topright">Top Right</option>
							<option <?php if ($params->get('article_icon_position') == 'bottomleft') echo 'selected'; ?> value="bottomleft">Bottom Left</option>
							<option <?php if ($params->get('article_icon_position') == 'bottomright') echo 'selected'; ?> value="bottomright">Bottom Right</option>
							<option <?php if ($params->get('article_icon_position') == 'topright-bottomleft') echo 'selected'; ?> value="topright-bottomleft">Top Right & Bottom Left</option>
							<option <?php if ($params->get('article_icon_position') == 'topright-bottomright') echo 'selected'; ?> value="topright-bottomright">Top Right & Bottom Right</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _ARTICLE_ICON_ARRANGEMENT_TOP_TIPS; ?>', CAPTION, '<?php echo _ARTICLE_ICON_ARRANGEMENT_TOP; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _ARTICLE_ICON_ARRANGEMENT_TOP; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[article_top_icon_arrangement]">
							<option <?php if ($params->get('article_top_icon_arrangement') == 'horizontal') echo 'selected'; ?> value="horizontal">Horizontal</option>
							<option <?php if ($params->get('article_top_icon_arrangement') == 'vertical') echo 'selected'; ?> value="vertical">Vertical</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _ARTICLE_ICON_ARRANGEMENT_BOTTOM_TIPS; ?>', CAPTION, '<?php echo _ARTICLE_ICON_ARRANGEMENT_BOTTOM; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _ARTICLE_ICON_ARRANGEMENT_BOTTOM; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[article_bottom_icon_arrangement]">
							<option <?php if ($params->get('article_bottom_icon_arrangement') == 'horizontal') echo 'selected'; ?> value="horizontal">Horizontal</option>
							<option <?php if ($params->get('article_bottom_icon_arrangement') == 'vertical') echo 'selected'; ?> value="vertical">Vertical</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _ARTICLE_ICON_DISPLAY_TOP_TIPS; ?>', CAPTION, '<?php echo _ARTICLE_ICON_DISPLAY_TOP; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _ARTICLE_ICON_DISPLAY_TOP; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[article_top_icon_display]">
							<option <?php if ($params->get('article_top_icon_display') == 'icon') echo 'selected'; ?> value="icon">Icon Only</option>
							<option <?php if ($params->get('article_top_icon_display') == 'text') echo 'selected'; ?> value="text">Text Only</option>
							<option <?php if ($params->get('article_top_icon_display') == 'both') echo 'selected'; ?> value="both">Icon & Text</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _ARTICLE_ICON_DISPLAY_BOTTOM_TIPS; ?>', CAPTION, '<?php echo _ARTICLE_ICON_DISPLAY_BOTTOM; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _ARTICLE_ICON_DISPLAY_BOTTOM; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[article_bottom_icon_display]">
							<option <?php if ($params->get('article_bottom_icon_display') == 'icon') echo 'selected'; ?> value="icon">Icon Only</option>
							<option <?php if ($params->get('article_bottom_icon_display') == 'text') echo 'selected'; ?> value="text">Text Only</option>
							<option <?php if ($params->get('article_bottom_icon_display') == 'both') echo 'selected'; ?> value="both">Icon & Text</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _ARTICLE_PDF_ICON_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[article_pdf_icon_text]" value="<?php echo $params->get('article_pdf_icon_text'); ?>" size="30" />
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _ARTICLE_PRINT_ICON_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[article_print_icon_text]" value="<?php echo $params->get('article_print_icon_text'); ?>" size="30" />
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _ARTICLE_EMAIL_ICON_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[article_email_icon_text]" value="<?php echo $params->get('article_email_icon_text'); ?>" size="30" />
					</TD>
				</TR>
			</TABLE>
			<?php
			$tabs->endTab();
			$tabs->startTab(substr(_NEWSLETTER_SUBSCRIBE_SET, 0, strpos(_NEWSLETTER_SUBSCRIBE_SET, ' ')),"newsletter-page");
			?>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _NEWSLETTER_SUBSCRIBE_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<B><?php echo _SUBSCRIBE_PAGE_TITLE; ?></B>&nbsp;
					</TD>
					<TD width="55%">
						<INPUT CLASS="inputbox" TYPE="text" name="params[subscribe_title]" value="<?php echo $params->get('subscribe_title'); ?>" size="30" />
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _SUBSCRIBE_PRE_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<textarea name="params[pre_text]" rows="10" cols="30"><?php echo $params->get('pre_text'); ?></textarea>
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _SUBSCRIBE_POST_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<textarea name="params[post_text]" rows="10" cols="30"><?php echo $params->get('post_text'); ?></textarea>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _SHOW_LIST_OF_PAGE; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[list_page]" onchange="if (this.options[this.selectedIndex].value == 0) document.getElementById('newsletter_list_page').style.display='block'; else document.getElementById('newsletter_list_page').style.display='none';">
							<option <?php if ($params->get('list_page') == '0') echo 'selected'; ?> value="0">No</option>
							<option <?php if ($params->get('list_page') == '1') echo 'selected'; ?> value="1">Yes</option>
						</SELECT>
					</TD>
				</TR>
			</table>
			<div id="newsletter_list_page" style="display:<?php echo $params->get('list_page') == '0' ? 'block' : 'none'; ?>">
			<TABLE class="adminform">
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _EZINE_NEWSLETTER_PAGE; ?></B>&nbsp;
					</TD>
					<TD width="55%">
					<?php
						if ($params->get('newsletter_page') != '') {
							$selected_pages = explode(',', $params->get('newsletter_page'));
						} else {
							$selected_pages = array();
						}
						$selected = array();
						foreach ($selected_pages AS $selected_page) {
							$selected[]->value = $selected_page;
						}
						$database->setQuery( "SELECT id AS value, menu_name AS `text` FROM #__ezine_page ORDER BY id" );
						$pages = $database->loadObjectList();
						if (count($pages))
							$pagelist = mosHTML::selectList( $pages, 'params[newsletter_page][]', 'class="inputbox" size="'.(count($pages) > 10 ? '10' : count($pages)).'" multiple="multiple"', 'value', 'text', $selected );
						else
							$pagelist = _ADD_AT_LEAST_ONE_PAGE_FIRST;
						echo $pagelist;
					?>
					</TD>
				</TR>
			</TABLE>
			</div>
			<?php
			$tabs->endTab();
			$tabs->startTab(substr(_SEF_SET, 0, strpos(_SEF_SET, ' ')),"sef-page");
			?>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _SEF_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _SEF_LOWERCASE_ALL_TIPS; ?>', CAPTION, '<?php echo _SEF_LOWERCASE_ALL; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _SEF_LOWERCASE_ALL; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD width="55%">
						<SELECT NAME="params[sef_lowercase_all]">
							<option <?php if ($params->get('sef_lowercase_all') == '0') echo 'selected'; ?> value="0">No</option>
							<option <?php if ($params->get('sef_lowercase_all') == '1') echo 'selected'; ?> value="1">Yes</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _SEF_REPLACE_CHAR; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[sef_replace_char]" value="<?php echo $params->get('sef_replace_char'); ?>" size="5" />
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _SEF_URL_FORM; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[sef_url_format]">
							<option <?php if ($params->get('sef_url_format') == '0') echo 'selected'; ?> value="0">/article/</option>
							<option <?php if ($params->get('sef_url_format') == '1') echo 'selected'; ?> value="1">/eZine_categry/article/</option>
							<option <?php if ($params->get('sef_url_format') == '2') echo 'selected'; ?> value="2">/eZine_page/eZine_categry/article/</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _SEF_PAGE_FIELD; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[sef_page_field]">
							<option <?php if ($params->get('sef_page_field') == '0') echo 'selected'; ?> value="0">Menu Name</option>
							<option <?php if ($params->get('sef_page_field') == '1') echo 'selected'; ?> value="1">Page Title</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _SEF_CAT_FIELD; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[sef_category_field]">
							<option <?php if ($params->get('sef_category_field') == '0') echo 'selected'; ?> value="0">Section/Category Name</option>
							<option <?php if ($params->get('sef_category_field') == '1') echo 'selected'; ?> value="1">Section/Category Title</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _SEF_ARTICLE_FIELD; ?></B>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[sef_article_field]">
							<option <?php if ($params->get('sef_article_field') == '0') echo 'selected'; ?> value="0">Article Title</option>
							<option <?php if ($params->get('sef_article_field') == '1') echo 'selected'; ?> value="1">Article Title Alias</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _SEF_MULTI_FORM; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[sef_multipage_form]" value="<?php echo $params->get('sef_multipage_form'); ?>" size="10" />
					</TD>
				</TR>
			</TABLE>
			</div>
			<?php
			$tabs->endTab();
			$tabs->endPane();
			?>
			<BR>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="<?php echo $func; ?>" />
		</FORM>
		<?php
	}

// Functions act with Page Management
	function showPage( &$rows, &$pageNav, &$link_to_menu ) {
		global $option, $func;
		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();
		$tabs = new mosTabs(1);
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			eZine <small><small>[ <?php echo _PAGE_MAN; ?> ]</small></small>
			</th>
		</tr>
		</table>
		<br/>
		<?php echo $pageNav->getListFooter(); ?>
		<br/>
		<?php
		$tabs->startPane("ezine-page-settings");
		$tabs->startTab(_GENERAL_SET,"general-page");
		?>
		<script type="text/javascript">
			if (typeof _SET_MENU_LINKS == 'undefined') _SET_MENU_LINKS = '<?php echo _SET_MENU_LINKS; ?>';
		</script>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle" value="" onclick="isChecked(this.checked); document.adminForm.toggle2.checked = this.checked; document.adminForm.toggle3.checked = this.checked; checkAll(<?php echo count( $rows );?>); checkAll(<?php echo count( $rows );?>, 'cb2'); checkAll(<?php echo count( $rows );?>, 'cb3');" />
			</th>
			<th class="title" width="15%">
			<?php echo _PAGE_NAME; ?>
			</th>
			<th class="title" width="25%">
			<?php echo _PAGE_TITLE; ?>
			</th>
			<th width="15%">
			<?php echo _PAGE_SHOW_TITLE; ?>
			</th>
			<th width="15%">
			<?php echo _PUBLISHED; ?>
			</th>
			<th width="15%">
			<?php echo _SUBSCRIBE_LINK; ?>
			</th>
			<th width="15%">
			<?php echo _LINK_TO_MENU; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			$params->def('show_page_title', 1);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked); document.adminForm.cb2<?php echo $i;?>.checked = this.checked; document.adminForm.cb3<?php echo $i;?>.checked = this.checked;" />
				</td>
				<td>
				<a id="menu_name_<?php echo $row->id; ?>" href="index2.php?option=<?php echo $option; ?>&task=editpage&pageid=<?php echo $row->id; ?>"><?php echo $row->menu_name == ''? '-' : $row->menu_name; ?></a>
				</td>
				<td>
				<a id="page_title_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _PAGE_TITLE; ?>', document.getElementById('page_title_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'page_title', confirmed_value, 1);"><?php echo $row->page_title == ''? '-' : $row->page_title; ?></a>
				</td>
				<td align="center">
				<a href="javascript: void(0)" onclick="call_toggle('page', <?php echo $row->id; ?>, 'show_page_title', 0, 0)">
				<img id="show_page_title_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('show_page_title') ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a href="javascript: void(0)" onclick="call_toggle('page', <?php echo $row->id; ?>, 'published', 1, 1)">
				<img id="published_<?php echo $row->id; ?>" src="images/<?php echo $row->published ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a href="javascript: void(0)" onclick="call_toggle('page', <?php echo $row->id; ?>, 'subscribe_link', 1, 0)">
				<img id="subscribe_link_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('subscribe_link') ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a id="link_to_menu_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="if (document.getElementById('link_to_menu_<?php echo $row->id; ?>_form').style.display == 'none') { PopupContent('link_to_menu', '<?php echo $row->id; ?>', '<?php echo _MENU_SELECTOR; ?>', '', '', 350, 320, closeImg, true); listExistedMenuLink(<?php echo $row->id; ?>); } else { document.getElementById('link_to_menu_<?php echo $row->id; ?>_form').style.display = 'none'; }">
				<?php $menu_links = checkMenuLink($row->id); echo $menu_links == '-' ? _SET_MENU_LINKS : $menu_links; ?>
				</a>
				<?php
					$popup = '
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr><td valign="top" width="30%">
						'._SELECT_MENU.'
					</td><td width="30%">
						'.str_replace('name="menuselect"', 'name="link_to_menu_'.$row->id.'_menuselect"', $link_to_menu).'
					</td><td valign="top" width="40%">
						<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
						<td align="right" width="70%" nowrap="nowrap">
							'._PUBLISHED.'
						</td><td align="left" width="30%">
							<input id="link_to_menu_'.$row->id.'_published" type="checkbox" name="published" checked="checked" />
						</td></tr><tr><td align="right" width="70%">
							'._FRONTPAGE.'
						</td><td align="left" width="30%">
							<input id="link_to_menu_'.$row->id.'_frontpage" type="checkbox" name="frontpage" />
						</td></tr></table>
					</td></tr><tr><td colspan="3">
						<br/><center>
						<input type="button" onclick="if (document.adminForm.link_to_menu_'.$row->id.'_menuselect.value != \'\') { if (document.getElementById(\'link_to_menu_'.$row->id.'_published\').checked) { document.getElementById(\'link_to_menu_'.$row->id.'_published\').value = 1; } else { document.getElementById(\'link_to_menu_'.$row->id.'_published\').value = 0; } if (document.getElementById(\'link_to_menu_'.$row->id.'_frontpage\').checked) { document.getElementById(\'link_to_menu_'.$row->id.'_frontpage\').value = 1; } else { document.getElementById(\'link_to_menu_'.$row->id.'_frontpage\').value = 0; } call_linkToMenu('.$row->id.', document.adminForm.link_to_menu_'.$row->id.'_menuselect.value, document.getElementById(\'link_to_menu_'.$row->id.'_published\').value, document.getElementById(\'link_to_menu_'.$row->id.'_frontpage\').value); }" value="'._LINK_TO_MENU.'" style="margin-top: 5px;" />
						</center><br/>
					</td></tr><tr><td colspan="3" valign="top" width="100%">
						<hr/><br/><table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tr><td width="50%" style="text-align:center" valign="top">'._EXISTED_MENU_ITEM.'</td>
						<td width="50%" id="link_to_menu_'.$row->id.'_existed"></td></tr></table>
					</td></tr>
				</table>
					';
					writePopupCode( 'link_to_menu', $row->id, $popup );
				?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="7" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab(_LAYOUT_SET,"layout-page");
		?>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle2" value="" onclick="isChecked(this.checked); document.adminForm.toggle.checked = this.checked; document.adminForm.toggle3.checked = this.checked; checkAll(<?php echo count( $rows );?>); checkAll(<?php echo count( $rows );?>, 'cb2'); checkAll(<?php echo count( $rows );?>, 'cb3');" />
			</th>
			<th width="13%">
			<?php echo _FEATURED_ARTICLE_SET; ?>
			</th>
			<th width="14%">
			<?php echo _PAGE_BLOCK1; ?>
			</th>
			<th width="15%">
			<?php echo _PAGE_BLOCK1_COLS; ?>
			</th>
			<th width="14%">
			<?php echo _PAGE_BLOCK2; ?>
			</th>
			<th width="15%">
			<?php echo _PAGE_BLOCK2_COLS; ?>
			</th>
			<th width="14%">
			<?php echo _PAGE_BLOCK3; ?>
			</th>
			<th width="15%">
			<?php echo _PAGE_BLOCK3_COLS; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			$params->def('block1', 1);
			$params->def('block1_cols', 1);
			$params->def('block2', 2);
			$params->def('block2_cols', 1);
			$params->def('block3', 5);
			$params->def('block3_cols', 1);
			$params->def('subscribe_link', 0);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb2<?php echo $i;?>" name="cid2[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked); document.adminForm.cb<?php echo $i;?>.checked = this.checked; document.adminForm.cb3<?php echo $i;?>.checked = this.checked;" />
				</td>
				<td align="center">
				<a href="index2.php?option=<?php echo $option; ?>&task=editpage&pageid=<?php echo $row->id; ?>">
				<?php echo _CLICK_TO_SET; ?>
				</a>
				</td>
				<td align="center">
				<a id="block1_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _PAGE_BLOCK1_TIPS; ?>', document.getElementById('block1_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'block1', confirmed_value, 0);"><?php echo $params->get('block1'); ?></a>
				</td>
				<td align="center">
				<a id="block1_cols_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _PAGE_BLOCK1_COLS_TIPS; ?>', document.getElementById('block1_cols_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'block1_cols', confirmed_value, 0);"><?php echo $params->get('block1_cols'); ?></a>
				</td>
				<td align="center">
				<a id="block2_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _PAGE_BLOCK2_TIPS; ?>', document.getElementById('block2_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'block2', confirmed_value, 0);"><?php echo $params->get('block2'); ?></a>
				</td>
				<td align="center">
				<a id="block2_cols_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _PAGE_BLOCK2_COLS_TIPS; ?>', document.getElementById('block2_cols_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'block2_cols', confirmed_value, 0);"><?php echo $params->get('block2_cols'); ?></a>
				</td>
				<td align="center">
				<a id="block3_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _PAGE_BLOCK3_TIPS; ?>', document.getElementById('block3_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'block3', confirmed_value, 0);"><?php echo $params->get('block3'); ?></a>
				</td>
				<td align="center">
				<a id="block3_cols_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _PAGE_BLOCK3_COLS_TIPS; ?>', document.getElementById('block3_cols_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'block3_cols', confirmed_value, 0);"><?php echo $params->get('block3_cols'); ?></a>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="5" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab(_COVER_SET,"cover-page");
		?>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle3" value="" onclick="isChecked(this.checked); document.adminForm.toggle.checked = this.checked; document.adminForm.toggle2.checked = this.checked; checkAll(<?php echo count( $rows );?>); checkAll(<?php echo count( $rows );?>, 'cb2'); checkAll(<?php echo count( $rows );?>, 'cb3');" />
			</th>
			<th width="20%">
			<?php echo _PAGE_ENABLE_COVER; ?>
			</th>
			<th width="20%">
			<?php echo _PAGE_COVER_OUTPUT; ?>
			</th>
			<th width="20%">
			<?php echo _PAGE_COVER_AUTO_REDIRECT; ?>
			</th>
			<th width="20%">
			<?php echo _PAGE_COVER_IMAGE; ?>
			</th>
			<th width="20%">
			<?php echo _PAGE_COVER_HTML_CODE; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			$params->def('cover_enable', 0);
			$params->def('cover_output', 'joomla');
			$params->def('cover_auto_redirect', 0);
			$params->def('cover_image', '');
			$params->def('cover_html', '');
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb3<?php echo $i;?>" name="cid3[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked); document.adminForm.cb<?php echo $i;?>.checked = this.checked; document.adminForm.cb2<?php echo $i;?>.checked = this.checked;" />
				</td>
				<td align="center">
				<a href="javascript: void(0)" onclick="call_toggle('page', <?php echo $row->id; ?>, 'cover_enable', 1, 0)">
				<img id="cover_enable_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('cover_enable') ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a id="cover_output_<?php echo $row->id; ?>" href="javascript: void(0)" onclick="call_toggle('page', <?php echo $row->id; ?>, 'cover_output', 'alone', 0)">
				<?php echo ( $params->get('cover_output') == 'joomla' ) ? 'Joomla Part' : 'Stand Alone'; ?>
				</a>
				</td>
				<td align="center">
				<input type="hidden" name="cover_auto_redirect_<?php echo $row->id; ?>_value" id="cover_auto_redirect_<?php echo $row->id; ?>_value" value="<?php echo $params->get('cover_auto_redirect'); ?>" />
				<a href="javascript: void(0)" onclick="confirmed_value = prompt('<?php echo _TIMEOUT_IN_SECONDS_FOR_AUTO_REDIRECT; ?>', document.getElementById('cover_auto_redirect_<?php echo $row->id; ?>_value').value); if (confirmed_value) call_update('page', <?php echo $row->id; ?>, 'cover_auto_redirect', confirmed_value, 0);">
				<img id="cover_auto_redirect_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('cover_auto_redirect') ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<script type="text/javascript">
					var cover_image_<?php echo $row->id; ?>_toolbar = '<a id="cover_image_<?php echo $row->id; ?>_remove" class="trash_button" href="javascript:void(0)" onclick="call_update(\'page\',<?php echo $row->id; ?>,\'cover_image\',\'\',0);" title=""><?php echo _REMOVE_IMAGE; ?></a>';
				</script>
				<input type="hidden" name="cover_image_<?php echo $row->id; ?>_value" id="cover_image_<?php echo $row->id; ?>_value" value="<?php echo $params->get('cover_image'); ?>" />
				<a href="javascript:void(0)" onclick="if (document.getElementById('cover_image_<?php echo $row->id; ?>_form').style.display == 'none') { PopupContent('cover_image', '<?php echo $row->id; ?>', '<?php echo _IMAGE_SELECTOR; ?>', cover_image_<?php echo $row->id; ?>_toolbar, 'Loading...', 350, 350); call_listDir('cover_image', <?php echo $row->id; ?>, ''); } else { document.getElementById('cover_image_<?php echo $row->id; ?>_form').style.display = 'none'; }">
				<img id="cover_image_<?php echo $row->id; ?>" src="images/<?php echo $params->get('cover_image') == ''? 'publish_x.png' : 'tick.png'; ?>" width="12" height="12" border="0" onmouseover="showImage('<?php echo _IMAGE_PREVIEW; ?>', '../'+document.getElementById('cover_image_<?php echo $row->id; ?>_value').value)" onmouseout="return nd();" />
				</a>
				<?php writePopupCode( 'cover_image', $row->id ); ?>
				</td>
				<td align="center">
				<a href="javascript:void(0)" onclick="window.open('index3.php?option=<?php echo $option; ?>&task=popup&popup=coverhtmlwindow&pageid=<?php echo $row->id; ?>', 'cover_html_popup', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');">
				<img id="cover_html_<?php echo $row->id; ?>" src="images/<?php echo $params->get('cover_html') == '' ? 'publish_x.png' : 'tick.png'; ?>" width="12" height="12" border="0" />
				</a>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="8" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->endPane();
		?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function editPage( $func, $pageid, &$row, &$params, &$link_to_menu ) {
		global $option, $func, $database;
		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();
		$tabs = new mosTabs(1);
		?>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo $func == 'newpage' ? _ADD_PAGE : _EDIT_PAGE.': '.$row->menu_name; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<?php
			$tabs->startPane("ezine-page-settings");
			$tabs->startTab(_GENERAL_SET,"general-page");
			?>
			<TABLE class="adminform">
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<B><?php echo _PAGE_NAME; ?></B>&nbsp;
					</TD>
					<TD width="55%">
						<INPUT CLASS="inputbox" TYPE="text" name="menu_name" value="<?php echo $func == 'newpage' ? '' : $row->menu_name; ?>" size="20">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _PAGE_TITLE; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="page_title" value="<?php echo $func == 'newpage' ? '' : $row->page_title; ?>" size="40">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _PAGE_SHOW_TITLE; ?></b>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[show_page_title]" class="inputbox">
							<option value="1" <?php echo $params->get('show_page_title') == 1 ? 'selected' : ''; ?>>Show</option>
							<option value="0" <?php echo $params->get('show_page_title') == '0' ? 'selected' : ''; ?>>Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _SUBSCRIBE_LINK; ?></b>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[subscribe_link]" class="inputbox">
							<option value="1" <?php echo $params->get('subscribe_link') == 1 ? 'selected' : ''; ?>>Yes</option>
							<option value="0" <?php echo $params->get('subscribe_link') == 0 ? 'selected' : ''; ?>>No</option>
						</SELECT>
					</TD>
				</TR>
<?php if ($func == 'newpage') { ?>
				<tr class="row1"><td colspan="2" style="text-align:center">
					<?php echo _UNPUBLISHED_BY_DEFAULT; ?>
				</td></tr>
<?php } ?>
				<tr><th colspan="2"><?php echo _LINK_TO_MENU; ?></th></tr>
<?php if (is_numeric($pageid) AND $pageid > 0) { ?>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _EXISTED_MENU_ITEM; ?></B>&nbsp;
					</TD>
					<TD>
						<b id="link_to_menu_<?php echo $pageid; ?>"><?php echo checkMenuLink($pageid); ?></b>
					</TD>
				</TR>
				<TR class="row1">
					<td>&nbsp;</td>
					<TD>
					<input type="button" class="button" name="<?php echo _LINK_TO_MENU; ?>" value="<?php echo _LINK_TO_MENU; ?>" onclick="if (document.getElementById('link_to_menu_<?php echo $pageid; ?>_form').style.display == 'none') { PopupContent('link_to_menu', '<?php echo $pageid; ?>', '<?php echo _MENU_SELECTOR; ?>', '', '', 350, 320, closeImg, true); listExistedMenuLink(<?php echo $pageid; ?>); }">
					<?php
						$popup = '
					<table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tr><td width="30%" style="text-align:right">
							'._SELECT_MENU.'
						</td><td width="30%">
							'.str_replace('name="menuselect"', 'name="link_to_menu_'.$pageid.'_menuselect"', $link_to_menu).'
						</td><td width="40%">
							<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
							<td style="text-align:right" width="70%" nowrap="nowrap">
								'._PUBLISHED.'
							</td><td align="left" width="30%">
								<input id="link_to_menu_'.$pageid.'_published" type="checkbox" name="published" checked="checked" />
							</td></tr><tr><td style="text-align:right" width="70%">
								'._FRONTPAGE.'
							</td><td align="left" width="30%">
								<input id="link_to_menu_'.$pageid.'_frontpage" type="checkbox" name="frontpage" />
							</td></tr></table>
						</td></tr><tr><td colspan="3">
							<br/><center>
							<input type="button" onclick="if (document.adminForm.link_to_menu_'.$pageid.'_menuselect.value != \'\') { if (document.getElementById(\'link_to_menu_'.$pageid.'_published\').checked) { document.getElementById(\'link_to_menu_'.$pageid.'_published\').value = 1; } else { document.getElementById(\'link_to_menu_'.$pageid.'_published\').value = 0; } if (document.getElementById(\'link_to_menu_'.$pageid.'_frontpage\').checked) { document.getElementById(\'link_to_menu_'.$pageid.'_frontpage\').value = 1; } else { document.getElementById(\'link_to_menu_'.$pageid.'_frontpage\').value = 0; } call_linkToMenu('.$pageid.', document.adminForm.link_to_menu_'.$pageid.'_menuselect.value, document.getElementById(\'link_to_menu_'.$pageid.'_published\').value, document.getElementById(\'link_to_menu_'.$pageid.'_frontpage\').value); }" value="'._LINK_TO_MENU.'" style="margin-top: 5px;" />
							</center><br/>
						</td></tr><tr><td colspan="3" width="100%">
							<hr/><br/><table border="0" cellspacing="0" cellpadding="0" width="100%">
							<tr><td width="50%" style="text-align:center">'._EXISTED_MENU_ITEM.'</td>
							<td width="50%" id="link_to_menu_'.$pageid.'_existed"></td></tr></table>
						</td></tr>
					</table>
						';
						writePopupCode( 'link_to_menu', $pageid, $popup );
					?>
					</td>
				</TR>
<?php } else { ?>
				<tr class="row0"><td colspan="2"><?php echo _AVAILABLE_WHEN_SAVED; ?></td></tr>
<?php } ?>
			</table>
			<?php
			$tabs->endTab();
			$tabs->startTab(_LAYOUT_SET,"layout-page");
			?>
			<table class="adminform">
				<tr><th colspan="2"><?php echo _FEATURED_ARTICLE_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _SHOW_FEATURED_ARTICLE_TIPS; ?>', CAPTION, '<?php echo _SHOW_FEATURED_ARTICLE; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _SHOW_FEATURED_ARTICLE; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD width="55%">
						<SELECT NAME="params[featured_article]" class="inputbox">
							<option value="1" <?php echo $params->get('featured_article') == 1 ? 'selected' : ''; ?>>Yes</option>
							<option value="0" <?php echo $params->get('featured_article') == 0 ? 'selected' : ''; ?>>No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _SHOW_FEATURED_TITLE; ?></b>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[show_featured_title]" class="inputbox">
							<option value="1" <?php echo $params->get('show_featured_title') == 1 ? 'selected' : ''; ?>>Yes</option>
							<option value="0" <?php echo $params->get('show_featured_title') == 0 ? 'selected' : ''; ?>>No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _FEATURED_TITLE_TEXT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_title_text]" value="<?php echo $params->get('featured_title_text'); ?>" size="40">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _LIMIT_FEATURED_TO_SECTION_TIPS; ?>', CAPTION, '<?php echo _LIMIT_FEATURED_TO_SECTION; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _LIMIT_FEATURED_TO_SECTION; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<?php
						$database->setQuery( "SELECT id, title FROM #__sections WHERE scope = 'content' ORDER BY id" );
						$row1s = $database->loadObjectList();
						$selected = explode(',', $params->get('limit_featured_to_sec'));
						?>
						<SELECT NAME="params[limit_featured_to_sec][]" class="inputbox" multiple="multiple">
						<?php
						foreach ($row1s AS $row1) {
							?>
							<option value="<?php echo $row1->id; ?>" <?php echo in_array($row1->id, $selected) ? 'selected' : ''; ?>><?php echo $row1->title; ?></option>
							<?php
						}
						?>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _LIMIT_FEATURED_TO_CATEGORY_TIPS; ?>', CAPTION, '<?php echo _LIMIT_FEATURED_TO_CATEGORY; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _LIMIT_FEATURED_TO_CATEGORY; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<?php
						$database->setQuery( "SELECT id, title FROM #__categories WHERE section NOT LIKE 'com_%' ORDER BY id" );
						$row1s = $database->loadObjectList();
						$selected = explode(',', $params->get('limit_featured_to_cat'));
						?>
						<SELECT NAME="params[limit_featured_to_cat][]" class="inputbox" multiple="multiple">
						<?php
						foreach ($row1s AS $row1) {
							?>
							<option value="<?php echo $row1->id; ?>" <?php echo in_array($row1->id, $selected) ? 'selected' : ''; ?>><?php echo $row1->title; ?></option>
							<?php
						}
						?>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _FEATURED_WORD_COUNT_TIPS; ?>', CAPTION, '<?php echo _FEATURED_WORD_COUNT; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _FEATURED_WORD_COUNT; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_words_count]" value="<?php echo $params->get('featured_words_count'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _FEATURED_LEADING_TIPS; ?>', CAPTION, '<?php echo _FEATURED_LEADING; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _FEATURED_LEADING; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_leading]" value="<?php echo $params->get('featured_leading'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _FEATURED_LEADING_THUMBNAIL_POSITION_TIPS; ?>', CAPTION, '<?php echo _FEATURED_LEADING_THUMBNAIL_POSITION; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _FEATURED_LEADING_THUMBNAIL_POSITION; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[featured_leading_thumb_pos]">
							<option <?php if ($params->get('featured_leading_thumb_pos') == 'left') echo 'selected'; ?> value="left">Left-side</option>
							<option <?php if ($params->get('featured_leading_thumb_pos') == 'right') echo 'selected'; ?> value="right">Right-side</option>
							<option <?php if ($params->get('featured_leading_thumb_pos') == 'above_title') echo 'selected'; ?> value="above_title">Above Title</option>
							<option <?php if ($params->get('featured_leading_thumb_pos') == 'above_intro') echo 'selected'; ?> value="above_intro">Above Intro</option>
							<option <?php if ($params->get('featured_leading_thumb_pos') == 'below_intro') echo 'selected'; ?> value="below_intro">Below Intro</option>
							<option <?php if ($params->get('featured_leading_thumb_pos') == 'below_readon') echo 'selected'; ?> value="below_readon">Below Read More</option>
							<option <?php if ($params->get('featured_leading_thumb_pos') == '') echo 'selected'; ?> value="">Joomla Default</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _FEATURED_INTRO_TIPS; ?>', CAPTION, '<?php echo _FEATURED_INTRO; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _FEATURED_INTRO; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_intro]" value="<?php echo $params->get('featured_intro'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _FEATURED_INTRO_COLS_TIPS; ?>', CAPTION, '<?php echo _FEATURED_INTRO_COLS; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _FEATURED_INTRO_COLS; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[featured_intro_cols]" value="<?php echo $params->get('featured_intro_cols'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _FEATURED_INTRO_THUMBNAIL_POSITION_TIPS; ?>', CAPTION, '<?php echo _FEATURED_INTRO_THUMBNAIL_POSITION; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _FEATURED_INTRO_THUMBNAIL_POSITION; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[featured_intro_thumb_pos]">
							<option <?php if ($params->get('featured_intro_thumb_pos') == 'left') echo 'selected'; ?> value="left">Left-side</option>
							<option <?php if ($params->get('featured_intro_thumb_pos') == 'right') echo 'selected'; ?> value="right">Right-side</option>
							<option <?php if ($params->get('featured_intro_thumb_pos') == 'above_title') echo 'selected'; ?> value="above_title">Above Title</option>
							<option <?php if ($params->get('featured_intro_thumb_pos') == 'above_intro') echo 'selected'; ?> value="above_intro">Above Intro</option>
							<option <?php if ($params->get('featured_intro_thumb_pos') == 'below_intro') echo 'selected'; ?> value="below_intro">Below Intro</option>
							<option <?php if ($params->get('featured_intro_thumb_pos') == 'below_readon') echo 'selected'; ?> value="below_readon">Below Read More</option>
							<option <?php if ($params->get('featured_intro_thumb_pos') == '') echo 'selected'; ?> value="">Joomla Default</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _FEATURED_ORDER; ?></B>&nbsp;
					</TD>
					<TD>
						<select name="params[featured_order_by]" class="inputbox">
							<option <?php if ($params->get('featured_order_by') == 'date') echo 'selected'; ?> value="date">Oldest first</option>
							<option <?php if ($params->get('featured_order_by') == 'rdate') echo 'selected'; ?> value="rdate">Most recent first</option>
							<option <?php if ($params->get('featured_order_by') == 'alpha') echo 'selected'; ?> value="alpha">Title Alphabetical</option>
							<option <?php if ($params->get('featured_order_by') == 'ralpha') echo 'selected'; ?> value="ralpha">Title Reverse-Alphabetical</option>
							<option <?php if ($params->get('featured_order_by') == 'author') echo 'selected'; ?> value="author">Author Alphabetical</option>
							<option <?php if ($params->get('featured_order_by') == 'rauthor') echo 'selected'; ?> value="rauthor">Author Reverse-Alphabetical</option>
							<option <?php if ($params->get('featured_order_by') == 'hits') echo 'selected'; ?> value="hits">Most Hits</option>
							<option <?php if ($params->get('featured_order_by') == 'rhits') echo 'selected'; ?> value="rhits">Least Hits</option>
							<option <?php if ($params->get('featured_order_by') == 'order') echo 'selected'; ?> value="order">Ordering</option>
						</select>
					</TD>
				</TR>
				<tr><th colspan="2"><?php echo _LAYOUT_SET; ?></th></tr>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _PAGE_BLOCK1_TIPS; ?>', CAPTION, '<?php echo _PAGE_BLOCK1; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _PAGE_BLOCK1; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD width="55%">
						<INPUT CLASS="inputbox" TYPE="text" name="params[block1]" value="<?php echo $params->get('block1'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _PAGE_BLOCK1_COLS_TIPS; ?>', CAPTION, '<?php echo _PAGE_BLOCK1_COLS; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _PAGE_BLOCK1_COLS; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[block1_cols]" value="<?php echo $params->get('block1_cols'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _PAGE_BLOCK2_TIPS; ?>', CAPTION, '<?php echo _PAGE_BLOCK2; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _PAGE_BLOCK2; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[block2]" value="<?php echo $params->get('block2'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _PAGE_BLOCK2_COLS_TIPS; ?>', CAPTION, '<?php echo _PAGE_BLOCK2_COLS; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _PAGE_BLOCK2_COLS; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[block2_cols]" value="<?php echo $params->get('block2_cols'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _PAGE_BLOCK3_TIPS; ?>', CAPTION, '<?php echo _PAGE_BLOCK3; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _PAGE_BLOCK3; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[block3]" value="<?php echo $params->get('block3'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _PAGE_BLOCK3_COLS_TIPS; ?>', CAPTION, '<?php echo _PAGE_BLOCK3_COLS; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _PAGE_BLOCK3_COLS; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[block3_cols]" value="<?php echo $params->get('block3_cols'); ?>" size="10">
					</TD>
				</TR>
			</table>
			<?php
			$tabs->endTab();
			$tabs->startTab(_COVER_SET,"cover-page");
			?>
			<script type="text/javascript">
				if (typeof _SET_MENU_LINKS == 'undefined') _SET_MENU_LINKS = '<?php echo _SET_MENU_LINKS; ?>';
			</script>
			<table class="adminform">
<?php if (is_numeric($pageid) AND $pageid > 0) { ?>
				<TR class="row0">
					<td width="45%" style="text-align: right">
						<B><?php echo _PAGE_ENABLE_COVER; ?></b>&nbsp;
					</TD>
					<TD width="55%">
						<SELECT NAME="params[cover_enable]" class="inputbox">
							<option value="1" <?php echo $params->get('cover_enable') == 1 ? 'selected' : ''; ?>>Yes</option>
							<option value="0" <?php echo $params->get('cover_enable') == 0 ? 'selected' : ''; ?>>No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _PAGE_COVER_OUTPUT; ?></b>&nbsp;
					</TD>
					<TD>
						<SELECT NAME="params[cover_output]" class="inputbox">
							<option value="joomla" <?php echo $params->get('cover_output') == 'joomla' ? 'selected' : ''; ?>>Joomla Part</option>
							<option value="alone" <?php echo $params->get('cover_output') == 'alone' ? 'selected' : ''; ?>>Stand Alone</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _PAGE_COVER_AUTO_REDIRECT; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[cover_auto_redirect]" value="<?php echo $params->get('cover_auto_redirect'); ?>" size="10">
					</TD>
				</TR>
				<TR class="row1">
					<td style="text-align: right">
						<B><?php echo _PAGE_COVER_IMAGE; ?></B>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="params[cover_image]" value="<?php echo $params->get('cover_image'); ?>" size="50">
						<?php if ($params->get('cover_image') != '') { ?>
						<br/><div style="margin: 10px 5px 5px 10px;"><?php echo _CURRENT_IMG; ?><br/><img src="<?php echo $params->get('cover_image'); ?>" border="0" /></div>
						<?php } ?>
					</TD>
				</TR>
				<TR class="row0">
					<td style="text-align: right">
						<B><?php echo _PAGE_COVER_HTML_CODE; ?></B>&nbsp;
					</TD>
					<TD>
						<?php
						// parameters : areaname, content, hidden field, width, height, cols, rows
						editorArea( '_cover_html', htmlspecialchars(str_replace('-newline-', "\n", $params->get('cover_html'))), 'params[cover_html]', '610', '300', '89', '19' );
						?>
					</TD>
				</TR>
<?php } else { ?>
				<tr class="row0"><td colspan="2"><?php echo _AVAILABLE_WHEN_SAVED; ?></td></tr>
<?php } ?>
				<tr><td colspan="2">&nbsp;</td></tr>
			</TABLE>
			<?php
			$tabs->endTab();
			$tabs->endPane();
			?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="<?php echo $func; ?>" />
			<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
		</FORM>
		<?php
	}

// Functions act with SEF URL Management
	function showSefUrl( &$rows, &$pageNav ) {
		global $option, $func;
		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			eZine <small><small>[ <?php echo _SEF_URL_MAN; ?> ]</small></small>
			</th>
		</tr>
		</table>
		<br/>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle" value="" onclick="isChecked(this.checked);  checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title" width="50%">
			<?php echo _SEF_ORG_URL; ?>
			</th>
			<th class="title" width="50%">
				<span class="editlinktip">
				<span onmouseover="return overlib('<?php echo _SEF_SEO_URL_TIPS; ?>', CAPTION, '<?php echo _SEF_SEO_URL; ?>', BELOW, RIGHT);" onmouseout="return nd();">
				<B><?php echo _SEF_SEO_URL; ?></B>
				</span></span>&nbsp;
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td>
				<a id="org_url_<?php echo $row->id; ?>" href="index2.php?option=<?php echo $option; ?>&task=editsef&sefid=<?php echo $row->id; ?>"><?php echo $row->original_url; ?></a>
				</td>
				<td>
				<a id="sef_url_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo str_replace('%ORG_URL%', $row->original_url, _SEF_INPUT_SEO_URL); ?>', document.getElementById('sef_url_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('sef', <?php echo $row->id; ?>, 'sef_url', confirmed_value, 1);"><?php echo $row->sef_url; ?></a>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="7" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<br/>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function editSefUrl( &$row ) {
		global $option, $func;
		mosCommonHTML::loadOverlib();
		?>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo $func == 'newsef' ? _ADD_SEF : _EDIT_SEF; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminform">
				<TR class="row0">
					<td width="15%">
						<B><?php echo _SEF_ORG_URL; ?></B>&nbsp;
					</TD>
					<TD width="85%">
						<INPUT CLASS="inputbox" TYPE="text" name="original_url" value="<?php echo $func == 'newsef' ? 'index.php?option='.$option.'&' : $row->original_url; ?>" style="width:95%">
					</TD>
				</TR>
				<TR class="row1">
					<td>
						<span class="editlinktip">
						<span onmouseover="return overlib('<?php echo _SEF_SEO_URL_TIPS; ?>', CAPTION, '<?php echo _SEF_SEO_URL; ?>', BELOW, RIGHT);" onmouseout="return nd();">
						<B><?php echo _SEF_SEO_URL; ?></B>
						</span></span>&nbsp;
					</TD>
					<TD>
						<INPUT CLASS="inputbox" TYPE="text" name="sef_url" value="<?php echo $func == 'newsef' ? '/' : $row->sef_url; ?>" style="width:95%">
					</TD>
				</TR>
			</TABLE>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="<?php echo $func; ?>" />
			<input type="hidden" name="sefid" value="<?php echo $func == 'newsef' ? 0 : $row->id; ?>" />
		</FORM>
		<?php
	}

// Functions act with Category Management
	function showCategory( $pageid, &$rows, &$pageNav, $pagelist ) {
		global $option, $func, $database;
		mosCommonHTML::loadOverlib();
		$tabs = new mosTabs(1);
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th colspan="2">
			eZine <small><small>[ <?php echo _CAT_MAN; ?> ]</small></small>
			</th>
		</tr>
		</table>
		<br/>
		<table class="adminlist">
			<tr>
				<td width="80%" style="text-align:right; font-weight:bold">
					<?php echo _SELECT_PAGE; ?>
				</td>
				<td width="20%" style="text-align:left">
					<?php echo str_replace('onchange', 'style="width:100%" onchange', $pagelist); ?>
				</td>
			</tr>
		</table>
		<br/>
		<?php echo $pageNav->getListFooter(); ?>
		<br/>
		<?php
		$tabs->startPane("ezine-category-settings");
		$tabs->startTab(_GENERAL_SET,"general-page");
		?>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle" value="" onclick="isChecked(this.checked); document.adminForm.toggle1.checked = this.checked; document.adminForm.toggle2.checked = this.checked; document.adminForm.toggle3.checked = this.checked; checkAll(<?php echo count( $rows );?>); checkAll(<?php echo count( $rows );?>, 'cb1'); checkAll(<?php echo count( $rows );?>, 'cb2'); checkAll(<?php echo count( $rows );?>, 'cb3');" />
			</th>
			<th class="title" width="30%">
			<?php echo _CONTENT_CAT; ?>
			</th>
			<th width="18%">
			<?php echo _CAT_SHOW_TITLE; ?>
			</th>
			<th width="18%">
			<?php echo _PUBLISHED; ?>
			</th>
			<th colspan="2" width="17%">
			<?php echo _REORDER; ?>
			</th>
			<th width="9%" align="right">
			<?php echo _ORDER; ?>
			</th>
			<th width="8%" align="left">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			$params->def('show_cat_title', 1);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked); document.adminForm.cb1<?php echo $i;?>.checked = this.checked; document.adminForm.cb2<?php echo $i;?>.checked = this.checked; document.adminForm.cb3<?php echo $i;?>.checked = this.checked;" />
				</td>
<?php if ($row->content_type == 'separator') {
	$query = "SELECT * FROM #__ezine_separator WHERE id = '$row->contentid' LIMIT 0,1";
	$database->setQuery( $query );
	$database->loadObject( $separator );
	switch($separator->type) {
		case 'content_item':
			$query = "SELECT `title` FROM #__content WHERE id = '$separator->content_id' LIMIT 0,1";
			$database->setQuery( $query );
			$database->loadObject( $extra_info );
			echo '<td>';
			echo '<a href="index2.php?option=com_content&sectionid=0&task=edit&hidemainmenu=1&id='.$separator->content_id.'">';
			echo _SEPARATOR_NEWS_INFO . $extra_info->title;
			echo '</a>';
			echo '</td>';
			break;
		case 'static_content':
			$query = "SELECT `title` FROM #__content WHERE id = '$separator->content_id' LIMIT 0,1";
			$database->setQuery( $query );
			$database->loadObject( $extra_info );
			echo '<td>';
			echo '<a href="index2.php?option=com_typedcontent&task=edit&hidemainmenu=1&id='.$separator->content_id.'">';
			echo _SEPARATOR_TYPED_INFO . $extra_info->title;
			echo '</a>';
			echo '</td>';
			break;
		case 'html_code':
			echo '<td>';
			echo '<a href="index2.php?option='.$option.'&task=editcat&pageid='.$pageid.'&catid='.$row->id.'">';
			echo _SEPARATOR_HTML_INFO;
			echo '</a>';
			echo '</td>';
			break;
		default:
			break;
	}
	echo '<td align="center">-</td>';
} else { ?>
				<td>
				<a href="index2.php?option=<?php echo $option; ?>&task=editcat&pageid=<?php echo $pageid; ?>&catid=<?php echo $row->id; ?>">
				<?php echo ($row->content_type == 'category') ? _CONTENT_CAT.': '.$row->cat_name : _CONTENT_SEC.': '.$row->sec_name; ?>
				</a>
				</td>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'show_cat_title', 0, 0)">
				<img id="show_cat_title_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('show_cat_title') == 1 ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
<?php } ?>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'published', 1, 1)">
				<img id="published_<?php echo $row->id; ?>" src="images/<?php echo $row->published ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td style="text-align: right">
				<?php echo $pageNav->orderUpIcon( $i ); ?>
				</td>
				<td align="left">
				<?php echo $pageNav->orderDownIcon( $i, $n ); ?>
				</td>
				<td align="center" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="8" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab(_LAYOUT_SET,"layout-page");
		?>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle1" value="" onclick="isChecked(this.checked); document.adminForm.toggle.checked = this.checked; document.adminForm.toggle2.checked = this.checked; document.adminForm.toggle3.checked = this.checked; checkAll(<?php echo count( $rows );?>); checkAll(<?php echo count( $rows );?>, 'cb1'); checkAll(<?php echo count( $rows );?>, 'cb2'); checkAll(<?php echo count( $rows );?>, 'cb3');" />
			</th>
			<th width="17%">
			<?php echo _WORDS_PER_ARTICLE; ?>
			</th>
			<th width="16%">
			<?php echo _NUMBER_OF_LEADING; ?>
			</th>
			<th width="17%">
			<?php echo _NUMBER_OF_INTRO; ?>
			</th>
			<th width="17%">
			<?php echo _NUMBER_OF_INTRO_COLS; ?>
			</th>
			<th width="16%">
			<?php echo _NUMBER_OF_LINK; ?>
			</th>
			<th width="17%">
			<?php echo _NUMBER_OF_LINK_COLS; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			$params->def('words_count', 0);
			$params->def('leading_news', 1);
			$params->def('intro_news', 2);
			$params->def('intro_cols', 2);
			$params->def('links', 5);
			$params->def('link_cols', 1);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb1<?php echo $i;?>" name="cid1[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked); document.adminForm.cb<?php echo $i;?>.checked = this.checked; document.adminForm.cb2<?php echo $i;?>.checked = this.checked; document.adminForm.cb3<?php echo $i;?>.checked = this.checked;" />
				</td>
<?php if ($row->content_type == 'separator') {
	for ($z = 0; $z < 6; $z++) {
		echo '<td align="center">-</td>';
	}
} else { ?>
				<td align="center">
				<a id="words_count_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _WORDS_PER_ARTICLE_TIPS; ?>', document.getElementById('words_count_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('category', <?php echo $row->id; ?>, 'words_count', confirmed_value, 0);"><?php echo $params->get('words_count'); ?></a>
				</td>
				<td align="center">
				<a id="leading_news_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _NUMBER_OF_LEADING; ?>', document.getElementById('leading_news_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('category', <?php echo $row->id; ?>, 'leading_news', confirmed_value, 0);"><?php echo $params->get('leading_news'); ?></a>
				</td>
				<td align="center">
				<a id="intro_news_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _NUMBER_OF_INTRO; ?>', document.getElementById('intro_news_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('category', <?php echo $row->id; ?>, 'intro_news', confirmed_value, 0);"><?php echo $params->get('intro_news'); ?></a>
				</td>
				<td align="center">
				<a id="intro_cols_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _NUMBER_OF_INTRO_COLS; ?>', document.getElementById('intro_cols_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('category', <?php echo $row->id; ?>, 'intro_cols', confirmed_value, 0);"><?php echo $params->get('intro_cols'); ?></a>
				</td>
				<td align="center">
				<a id="links_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _NUMBER_OF_LINK; ?>', document.getElementById('links_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('category', <?php echo $row->id; ?>, 'links', confirmed_value, 0);"><?php echo $params->get('links'); ?></a>
				</td>
				<td align="center">
				<a id="link_cols_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="confirmed_value = prompt('<?php echo _NUMBER_OF_LINK_COLS; ?>', document.getElementById('link_cols_<?php echo $row->id; ?>').innerHTML); if (confirmed_value) call_update('category', <?php echo $row->id; ?>, 'link_cols', confirmed_value, 0);"><?php echo $params->get('link_cols'); ?></a>
				</td>
<?php } ?>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="8" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab(_CONTENT_SET,"content-page");
		?>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle2" value="" onclick="isChecked(this.checked); document.adminForm.toggle.checked = this.checked; document.adminForm.toggle1.checked = this.checked; document.adminForm.toggle3.checked = this.checked; checkAll(<?php echo count( $rows );?>); checkAll(<?php echo count( $rows );?>, 'cb1'); checkAll(<?php echo count( $rows );?>, 'cb2'); checkAll(<?php echo count( $rows );?>, 'cb3');" />
			</th>
			<th width="20%">
			<?php echo _PAGE_LINKED_CAT_TITLE; ?>
			</th>
			<th width="20%">
			<?php echo _FRONTPAGE_ONLY; ?>
			</th>
			<th width="20%">
			<?php echo _INTRO_ONLY; ?>
			</th>
			<th width="20%">
			<?php echo _NEWS_ORDER; ?>
			</th>
			<th width="20%">
			<?php echo _PAGE_SHOW_MORE_CAT_NEWS; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			$params->def('linked_cat_title', 0);
			$params->def('frontpage_only', 0);
			$params->def('intro_only', 1);
			$params->def('order_news_by', 'rdate');
			$params->def('show_more_cat_news', 1);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb2<?php echo $i;?>" name="cid2[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked); document.adminForm.cb<?php echo $i;?>.checked = this.checked; document.adminForm.cb1<?php echo $i;?>.checked = this.checked; document.adminForm.cb3<?php echo $i;?>.checked = this.checked;" />
				</td>
<?php if ($row->content_type == 'separator') {
	$query = "SELECT * FROM #__ezine_separator WHERE id = '$row->contentid' LIMIT 0,1";
	$database->setQuery( $query );
	$database->loadObject( $separator );
	switch($separator->type) {
		case 'content_item':
			for ($z = 0; $z < 2; $z++) {
				echo '<td align="center">-</td>';
			} ?>
			<td align="center">
			<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'intro_only', 0, 0)">
			<img id="intro_only_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('intro_only') == 1 ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
			</a>
			<?php
			for ($z = 0; $z < 2; $z++) {
				echo '<td align="center">-</td>';
			}
			break;
		case 'static_content':
			for ($z = 0; $z < 5; $z++) {
				echo '<td align="center">-</td>';
			}
			break;
		case 'html_code':
			for ($z = 0; $z < 5; $z++) {
				echo '<td align="center">-</td>';
			}
			break;
		default:
			break;
	}
} else { ?>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'linked_cat_title', 1, 0)">
				<img id="linked_cat_title_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('linked_cat_title') ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'frontpage_only', 1, 0)">
				<img id="frontpage_only_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('frontpage_only') == 1 ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'intro_only', 0, 0)">
				<img id="intro_only_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('intro_only') == 1 ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a id="order_news_by_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="if (document.getElementById('order_news_by_<?php echo $row->id; ?>_form').style.display == 'none') { PopupContent('order_news_by', '<?php echo $row->id; ?>', '<?php echo _ORDER_SELECTOR; ?>', '', '', 190, 130, closeImg, true); } else { document.getElementById('order_news_by_<?php echo $row->id; ?>_form').style.display = 'none'; }">
				<?php
					switch ($params->get('order_news_by')) {
						case 'date': echo 'Oldest first'; break;
						case 'rdate': echo 'Most recent first'; break;
						case 'alpha': echo 'Title Alphabetical'; break;
						case 'ralpha': echo 'Title Reverse-Alphabetical'; break;
						case 'author': echo 'Author Alphabetical'; break;
						case 'rauthor': echo 'Author Reverse-Alphabetical'; break;
						case 'hits': echo 'Most Hits'; break;
						case 'rhits': echo 'Least Hits'; break;
						case 'order': echo 'Ordering'; break;
						default: echo 'Most recent first'; break;
					}
				?>
				</a>
				<?php
				$popup = '
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'date\', 0);">Oldest first</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'rdate\', 0);">Most recent first</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'alpha\', 0);">Title Alphabetical</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'ralpha\', 0);">Title Reverse-Alphabetical</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'author\', 0);">Author Alphabetical</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'rauthor\', 0);">Author Reverse-Alphabetical</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'hits\', 0);">Most Hits</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'rhits\', 0);">Least Hits</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'order_news_by\', \'order\', 0);">Ordering</a><br/>
				';
				writePopupCode( 'order_news_by', $row->id, $popup );
				?>
				</td>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'show_more_cat_news', 0, 0)">
				<img id="show_more_cat_news_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('show_more_cat_news') ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
<?php } ?>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="7" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab(_DISPLAY_SET,"display-page");
		?>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle3" value="" onclick="isChecked(this.checked); document.adminForm.toggle.checked = this.checked; document.adminForm.toggle1.checked = this.checked; document.adminForm.toggle2.checked = this.checked; checkAll(<?php echo count( $rows );?>); checkAll(<?php echo count( $rows );?>, 'cb1'); checkAll(<?php echo count( $rows );?>, 'cb2'); checkAll(<?php echo count( $rows );?>, 'cb3');" />
			</th>
			<th width="15%">
			<?php echo _LEADING_THUMBNAIL_IMAGE_POSITION; ?>
			</th>
			<th width="15%">
			<?php echo _INTRO_THUMBNAIL_IMAGE_POSITION; ?>
			</th>
			<th width="14%">
			<?php echo _CAT_TITLE_IMG; ?>
			</th>
			<th width="14%">
			<?php echo _MORE_NEWS_IMG; ?>
			</th>
			<th width="14%">
			<?php echo _INTRO_IMG; ?>
			</th>
			<th width="14%">
			<?php echo _LINK_IMG; ?>
			</th>
			<th width="14%">
			<?php echo _MORE_IN_PARAMS; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			$params->def('leading_thumbnail_position', '');
			$params->def('intro_thumbnail_position', '');
			$params->def('cat_title_img', '');
			$params->def('more_cat_news_img', '');
			$params->def('intro_with_img', 1);
			$params->def('link_with_img', 1);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb3<?php echo $i;?>" name="cid3[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked); document.adminForm.cb<?php echo $i;?>.checked = this.checked; document.adminForm.cb1<?php echo $i;?>.checked = this.checked; document.adminForm.cb2<?php echo $i;?>.checked = this.checked;" />
				</td>
<?php if ($row->content_type == 'separator') {
	for ($z = 0; $z < 7; $z++) {
		echo '<td align="center">-</td>';
	}
} else { ?>
				<td align="center">
				<a id="leading_thumbnail_position_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="if (document.getElementById('leading_thumbnail_position_<?php echo $row->id; ?>_form').style.display == 'none') { PopupContent('leading_thumbnail_position', '<?php echo $row->id; ?>', '<?php echo _THUMBNAIL_POSITION_SELECTOR; ?>', '', '', 210, 100, closeImg, true); } else { document.getElementById('leading_thumbnail_position_<?php echo $row->id; ?>_form').style.display = 'none'; }">
				<?php
				switch ($params->get('leading_thumbnail_position')) {
					case 'left': echo 'Left-side'; break;
					case 'right': echo 'Right-side'; break;
					case 'above_title': echo 'Above Title'; break;
					case 'above_intro': echo 'Above Intro'; break;
					case 'below_intro': echo 'Below Intro'; break;
					case 'below_readon': echo 'Below Read More'; break;
					default: echo 'Joomla Default'; break;
				}
				?>
				</a>
				<?php
				$popup = '
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'leading_thumbnail_position\', \'left\', 0);">Left-side</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'leading_thumbnail_position\', \'right\', 0);">Right-side</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'leading_thumbnail_position\', \'above_title\', 0);">Above Title</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'leading_thumbnail_position\', \'above_intro\', 0);">Above Intro</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'leading_thumbnail_position\', \'below_intro\', 0);">Below Intro</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'leading_thumbnail_position\', \'below_readon\', 0);">Below Read More</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'leading_thumbnail_position\', \'\', 0);">Joomla Default</a><br/>
				';
				writePopupCode( 'leading_thumbnail_position', $row->id, $popup );
				?>
				</td>
				<td align="center">
				<a id="intro_thumbnail_position_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="if (document.getElementById('intro_thumbnail_position_<?php echo $row->id; ?>_form').style.display == 'none') { PopupContent('intro_thumbnail_position', '<?php echo $row->id; ?>', '<?php echo _THUMBNAIL_POSITION_SELECTOR; ?>', '', '', 210, 100, closeImg, true); } else { document.getElementById('intro_thumbnail_position_<?php echo $row->id; ?>_form').style.display = 'none'; }">
				<?php
				switch ($params->get('intro_thumbnail_position')) {
					case 'left': echo 'Left-side'; break;
					case 'right': echo 'Right-side'; break;
					case 'above_title': echo 'Above Title'; break;
					case 'above_intro': echo 'Above Intro'; break;
					case 'below_intro': echo 'Below Intro'; break;
					case 'below_readon': echo 'Below Read More'; break;
					default: echo 'Joomla Default'; break;
				}
				?>
				</a>
				<?php
				$popup = '
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'intro_thumbnail_position\', \'left\', 0);">Left-side</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'intro_thumbnail_position\', \'right\', 0);">Right-side</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'intro_thumbnail_position\', \'above_title\', 0);">Above Title</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'intro_thumbnail_position\', \'above_intro\', 0);">Above Intro</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'intro_thumbnail_position\', \'below_intro\', 0);">Below Intro</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'intro_thumbnail_position\', \'below_readon\', 0);">Below Read More</a><br/>
				<a href="javascript:void(0)" onclick="call_update(\'category\', '.$row->id.', \'intro_thumbnail_position\', \'\', 0);">Joomla Default</a><br/>
				';
				writePopupCode( 'intro_thumbnail_position', $row->id, $popup );
				?>
				</td>
				<td align="center">
				<script type="text/javascript">
					var cat_title_img_<?php echo $row->id; ?>_toolbar = '<a id="cat_title_img_<?php echo $row->id; ?>_remove" class="trash_button" href="javascript:void(0)" onclick="call_update(\'category\',<?php echo $row->id; ?>,\'cat_title_img\',\'\',0);" title=""><?php echo _REMOVE_IMAGE; ?></a>';
				</script>
				<input type="hidden" name="cat_title_img_<?php echo $row->id; ?>_value" id="cat_title_img_<?php echo $row->id; ?>_value" value="<?php echo $params->get('cat_title_img'); ?>" />
				<a href="javascript:void(0)" onclick="if (document.getElementById('cat_title_img_<?php echo $row->id; ?>_form').style.display == 'none') { PopupContent('cat_title_img', '<?php echo $row->id; ?>', '<?php echo _IMAGE_SELECTOR; ?>', cat_title_img_<?php echo $row->id; ?>_toolbar, 'Loading...', 350, 350); call_listDir('cat_title_img', <?php echo $row->id; ?>, ''); } else { document.getElementById('cat_title_img_<?php echo $row->id; ?>_form').style.display = 'none'; }">
				<img id="cat_title_img_<?php echo $row->id; ?>" src="images/<?php echo $params->get('cat_title_img') == ''? 'publish_x.png' : 'tick.png'; ?>" width="12" height="12" border="0" onmouseover="showImage('<?php echo _IMAGE_PREVIEW; ?>',document.getElementById('cat_title_img_<?php echo $row->id; ?>_value').value)" onmouseout="return nd();" />
				</a>
				<?php writePopupCode( 'cat_title_img', $row->id ); ?>
				</td>
				<td align="center">
				<script type="text/javascript">
					var more_cat_news_img_<?php echo $row->id; ?>_toolbar = '<a id="more_cat_news_img_<?php echo $row->id; ?>_remove" class="trash_button" href="javascript:void(0)" onclick="call_update(\'category\',<?php echo $row->id; ?>,\'more_cat_news_img\',\'\',0);" title=""><?php echo _REMOVE_IMAGE; ?></a>';
				</script>
				<input type="hidden" name="more_cat_news_img_<?php echo $row->id; ?>_value" id="more_cat_news_img_<?php echo $row->id; ?>_value" value="<?php echo $params->get('more_cat_news_img'); ?>" />
				<a href="javascript:void(0)" onclick="if (document.getElementById('more_cat_news_img_<?php echo $row->id; ?>_form').style.display == 'none') { PopupContent('more_cat_news_img', '<?php echo $row->id; ?>', '<?php echo _IMAGE_SELECTOR; ?>', more_cat_news_img_<?php echo $row->id; ?>_toolbar, 'Loading...', 350, 350); call_listDir('more_cat_news_img', <?php echo $row->id; ?>, ''); } else { document.getElementById('more_cat_news_img_<?php echo $row->id; ?>_form').style.display = 'none'; }">
				<img id="more_cat_news_img_<?php echo $row->id; ?>" src="images/<?php echo $params->get('more_cat_news_img') == ''? 'publish_x.png' : 'tick.png'; ?>" width="12" height="12" border="0" onmouseover="showImage('<?php echo _IMAGE_PREVIEW; ?>',document.getElementById('more_cat_news_img_<?php echo $row->id; ?>_value').value)" onmouseout="return nd();" />
				</a>
				<?php writePopupCode( 'more_cat_news_img', $row->id ); ?>
				</td>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'intro_with_img', 0, 0)">
				<img id="intro_with_img_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('intro_with_img') == 1 ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a href="javascript:void(0)" onclick="call_toggle('category', <?php echo $row->id; ?>, 'link_with_img', 0, 0)">
				<img id="link_with_img_<?php echo $row->id; ?>" src="images/<?php echo ( $params->get('link_with_img') == 1 ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</a>
				</td>
				<td align="center">
				<a href="index2.php?option=<?php echo $option; ?>&task=editcat&pageid=<?php echo $pageid; ?>&catid=<?php echo $row->id; ?>">
				<?php echo _CLICK_TO_SET; ?>
				</a>
				</td>
<?php } ?>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="8" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->endPane();
		?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function selectContentType( $pageid ) {
		global $option, $func;
		?>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo _SELECT_CONTENT_TYPE; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminlist">
				<TR>
					<td width="30%" nowrap>&nbsp;</td>
					<TD>
						<input type="radio" name="content_type" value="section" onclick="document.adminForm.boxchecked.value = 1;" />&nbsp;<?php echo _CONTENT_SECTION; ?>
					</TD>
					<td width="30%" nowrap>&nbsp;</td>
				</TR>
				<TR>
					<td width="30%" nowrap>&nbsp;</td>
					<TD>
						<input type="radio" name="content_type" value="category" onclick="document.adminForm.boxchecked.value = 1;" />&nbsp;<?php echo _CONTENT_CATEGORY; ?>
					</TD>
					<td width="30%" nowrap>&nbsp;</td>
				</TR>
			</TABLE>
			<BR>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="<?php echo $func; ?>" />
			<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
			<input type="hidden" name="boxchecked" value="0" />
		</FORM>
		<?php
	}

	function addSection( &$rows, &$pageNav, $pageid ) {
		global $option, $func, $my, $database;

		$database->setQuery( "SELECT menu_name FROM #__ezine_page WHERE id = '$pageid'" );
		$page_name = $database->loadResult();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="sections">
			eZine <small><small>[ <?php echo str_replace('%CAT_NAME%', $page_name, _ADD_SEC_MAN); ?> ]</small></small>
			</th>
		</tr>
		</table><br/>
		<table class="adminlist">
		<tr>
			<th width="10" align="center">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title" width="40%">
			<?php echo _CONTENT_SEC; ?>
			</th>
			<th width="20%" nowrap>
			<?php echo _ID; ?>
			</th>
			<th width="20%">
			<?php echo _NUMBER_OF_ACT_ITEM; ?>
			</th>
			<th width="20%">
			<?php echo _NUMBER_OF_TRASH_ITEM; ?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td>
				<?php echo $row->name .' ( '. $row->title .' )'; ?>
				</td>
				<td align="center">
				<?php echo $row->id; ?>
				</td>
				<td align="center">
				<?php echo $row->active; ?>
				</td>
				<td align="center">
				<?php echo $row->trash; ?>
				</td>
				<?php $k = 1 - $k; ?>
			</tr>
			<?php
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="content_type" value="section" />
		<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function addCategory( &$rows, &$pageNav, &$lists, $pageid ) {
		global $option, $func, $my, $database;

		$database->setQuery( "SELECT menu_name FROM #__ezine_page WHERE id = '$pageid'" );
		$page_name = $database->loadResult();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="categories">
			eZine <small><small>[ <?php echo str_replace('%CAT_NAME%', $page_name, _ADD_CAT_MAN); ?> ]</small></small>
			</th>
			<td width="right">
			<?php echo $lists;?>
			</td>
		</tr>
		</table><br/>
		<table class="adminlist">
		<tr>
			<th width="10" align="center">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title" width="40%">
			<?php echo _CONTENT_CAT; ?>
			</th>
			<th width="15%" align="center">
			<?php echo _CONTENT_SEC; ?>
			</th>
			<th width="15%" nowrap>
			<?php echo _ID; ?>
			</th>
			<th width="15%">
			<?php echo _NUMBER_OF_ACT_ITEM; ?>
			</th>
			<th width="15%">
			<?php echo _NUMBER_OF_TRASH_ITEM; ?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td>
				<?php echo $row->name .' ( '. $row->title .' )'; ?>
				</td>
				<td align="center">
				<?php echo $row->section_name; ?>
				</td>
				<td align="center">
				<?php echo $row->id; ?>
				</td>
				<td align="center">
				<?php echo $row->active; ?>
				</td>
				<td align="center">
				<?php echo $row->trash; ?>
				</td>
				<?php $k = 1 - $k; ?>
			</tr>
			<?php
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="content_type" value="category" />
		<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function editCategory( $catid, &$row, &$params, $pageid ) {
		global $option, $func;
		$tabs = new mosTabs(1);
		?>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo _EDIT_CAT_MAN . ': ' . $row->name . ' <i>( '. $row->content_type . ' )</i>'; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<?php
			$tabs->startPane("ezine-cat-settings");
			$tabs->startTab(_LAYOUT_SET,"layout-page");
			?>
			<TABLE class="adminform">
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _CAT_SHOW_TITLE; ?></b>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[show_cat_title]">
							<option <?php if ($params->get('show_cat_title') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('show_cat_title') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _WORDS_PER_ARTICLE; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[words_count]" value="<?php echo $params->get('words_count'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_LEADING; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[leading_news]" value="<?php echo $params->get('leading_news'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_INTRO; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[intro_news]" value="<?php echo $params->get('intro_news'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_INTRO_COLS; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[intro_cols]" value="<?php echo $params->get('intro_cols'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_LINK; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[links]" value="<?php echo $params->get('links'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_LINK_COLS; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[link_cols]" value="<?php echo $params->get('link_cols'); ?>" size="5">
					</TD>
				</TR>
			</table>
			<?php
			$tabs->endTab();
			$tabs->startTab(_CONTENT_SET,"content-page");
			?>
			<TABLE class="adminform">
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _PAGE_LINKED_CAT_TITLE; ?></b>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[linked_cat_title]">
							<option <?php if ($params->get('linked_cat_title') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('linked_cat_title') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _FRONTPAGE_ONLY; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[frontpage_only]">
							<option <?php if ($params->get('frontpage_only') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('frontpage_only') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _INTRO_ONLY; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[intro_only]">
							<option <?php if ($params->get('intro_only') == 1) echo 'selected'; ?> value="1">Intro Only</option>
							<option <?php if ($params->get('intro_only') == 0) echo 'selected'; ?> value="0">Full News</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _NEWS_ORDER; ?></B>&nbsp;
					</TD>
					<TD valign="top">
<select name="params[order_news_by]" class="inputbox">
	<option <?php if ($params->get('order_news_by') == 'date') echo 'selected'; ?> value="date">Oldest first</option>
	<option <?php if ($params->get('order_news_by') == 'rdate') echo 'selected'; ?> value="rdate">Most recent first</option>
	<option <?php if ($params->get('order_news_by') == 'alpha') echo 'selected'; ?> value="alpha">Title Alphabetical</option>
	<option <?php if ($params->get('order_news_by') == 'ralpha') echo 'selected'; ?> value="ralpha">Title Reverse-Alphabetical</option>
	<option <?php if ($params->get('order_news_by') == 'author') echo 'selected'; ?> value="author">Author Alphabetical</option>
	<option <?php if ($params->get('order_news_by') == 'rauthor') echo 'selected'; ?> value="rauthor">Author Reverse-Alphabetical</option>
	<option <?php if ($params->get('order_news_by') == 'hits') echo 'selected'; ?> value="hits">Most Hits</option>
	<option <?php if ($params->get('order_news_by') == 'rhits') echo 'selected'; ?> value="rhits">Least Hits</option>
	<option <?php if ($params->get('order_news_by') == 'order') echo 'selected'; ?> value="order">Ordering</option>
</select>
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _PAGE_SHOW_MORE_CAT_NEWS; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[show_more_cat_news]">
							<option <?php if ($params->get('show_more_cat_news') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('show_more_cat_news') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
			</table>
			<?php
			$tabs->endTab();
			$tabs->startTab(_DISPLAY_SET,"display-page");
			?>
			<TABLE class="adminform">
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _LEADING_THUMBNAIL_IMAGE_POSITION; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[leading_thumbnail_position]">
							<option <?php if ($params->get('leading_thumbnail_position') == 'left') echo 'selected'; ?> value="left">Left-side</option>
							<option <?php if ($params->get('leading_thumbnail_position') == 'right') echo 'selected'; ?> value="right">Right-side</option>
							<option <?php if ($params->get('leading_thumbnail_position') == 'above_title') echo 'selected'; ?> value="above_title">Above Title</option>
							<option <?php if ($params->get('leading_thumbnail_position') == 'above_intro') echo 'selected'; ?> value="above_intro">Above Intro</option>
							<option <?php if ($params->get('leading_thumbnail_position') == 'below_intro') echo 'selected'; ?> value="below_intro">Below Intro</option>
							<option <?php if ($params->get('leading_thumbnail_position') == 'below_readon') echo 'selected'; ?> value="below_readon">Below Read More</option>
							<option <?php if ($params->get('leading_thumbnail_position') == '') echo 'selected'; ?> value="">Joomla Default</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _INTRO_THUMBNAIL_IMAGE_POSITION; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[intro_thumbnail_position]">
							<option <?php if ($params->get('intro_thumbnail_position') == 'left') echo 'selected'; ?> value="left">Left-side</option>
							<option <?php if ($params->get('intro_thumbnail_position') == 'right') echo 'selected'; ?> value="right">Right-side</option>
							<option <?php if ($params->get('intro_thumbnail_position') == 'above_title') echo 'selected'; ?> value="above_title">Above Title</option>
							<option <?php if ($params->get('intro_thumbnail_position') == 'above_intro') echo 'selected'; ?> value="above_intro">Above Intro</option>
							<option <?php if ($params->get('intro_thumbnail_position') == 'below_intro') echo 'selected'; ?> value="below_intro">Below Intro</option>
							<option <?php if ($params->get('intro_thumbnail_position') == 'below_readon') echo 'selected'; ?> value="below_readon">Below Read More</option>
							<option <?php if ($params->get('intro_thumbnail_position') == '') echo 'selected'; ?> value="">Joomla Default</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _CAT_TITLE_IMG; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[cat_title_img]" value="<?php echo $params->get('cat_title_img'); ?>" size="50">
						<?php if ($params->get('cat_title_img') != '') { ?>
						<br/><div style="margin: 10px 5px 5px 10px;"><?php echo _CURRENT_IMG; ?><br/><img src="<?php echo $params->get('cat_title_img'); ?>" border="0" /></div>
						<?php } ?>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _MORE_NEWS_IMG; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[more_cat_news_img]" value="<?php echo $params->get('more_cat_news_img'); ?>" size="50">
						<?php if ($params->get('more_cat_news_img') != '') { ?>
						<br/><div style="margin: 10px 5px 5px 10px;"><?php echo _CURRENT_IMG; ?><br/><img src="<?php echo $params->get('more_cat_news_img'); ?>" border="0" /></div>
						<?php } ?>
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _INTRO_WITH_IMG; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[intro_with_img]">
							<option <?php if ($params->get('intro_with_img') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('intro_with_img') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _LINK_WITH_IMG; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[link_with_img]">
							<option <?php if ($params->get('link_with_img') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('link_with_img') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
			</table>
			<?php
			$tabs->endTab();
			$tabs->startTab(_MORE_IN_SET.' 1/2',"morein1-page");
			?>
			<TABLE class="adminform">
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _PAGE_CLASS_SFX; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[morein_pageclass_sfx]" value="<?php echo $params->get('morein_pageclass_sfx'); ?>" size="50">
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _BACK_BUTTON; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_back_button]">
							<option <?php if ($params->get('morein_back_button') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_back_button') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _ARTICLE_TITLE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_article_title]">
							<option <?php if ($params->get('morein_article_title') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_article_title') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _LINKED_ARTICLE_TITLE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_article_title_linkable]">
							<option <?php if ($params->get('morein_article_title_linkable') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('morein_article_title_linkable') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _CAT_TITLE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_category_title]">
							<option <?php if ($params->get('morein_category_title') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_category_title') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _LINKED_CAT_TITLE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_category_title_linkable]">
							<option <?php if ($params->get('morein_category_title_linkable') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('morein_category_title_linkable') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _SEC_TITLE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_section_title]">
							<option <?php if ($params->get('morein_section_title') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_section_title') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _LINKED_SEC_TITLE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_section_title_linkable]">
							<option <?php if ($params->get('morein_section_title_linkable') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('morein_section_title_linkable') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _READ_MORE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_readmore]">
							<option <?php if ($params->get('morein_readmore') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_readmore') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _ITEM_RATING; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_rating]">
							<option <?php if ($params->get('morein_rating') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_rating') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _AUTHOR_NAME; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_author]">
							<option <?php if ($params->get('morein_author') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_author') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _CREATED_DATE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_createdate]">
							<option <?php if ($params->get('morein_createdate') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_createdate') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _MODIFY_DATE; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_modifydate]">
							<option <?php if ($params->get('morein_modifydate') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_modifydate') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _PDF_ICON; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_pdf]">
							<option <?php if ($params->get('morein_pdf') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_pdf') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _PRINT_ICON; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_print]">
							<option <?php if ($params->get('morein_print') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_print') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _EMAIL_ICON; ?></B>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_email]">
							<option <?php if ($params->get('morein_email') == 1) echo 'selected'; ?> value="1">Show</option>
							<option <?php if ($params->get('morein_email') == 0) echo 'selected'; ?> value="0">Hide</option>
						</SELECT>
					</TD>
				</TR>
			</table>
			<?php
			$tabs->endTab();
			$tabs->startTab(_MORE_IN_SET.' 2/2',"morein2-page");
			?>
			<TABLE class="adminform">
				<TR class="row0">
					<td width="45%" valign="top" style="text-align: right">
						<B><?php echo _CAT_SHOW_TITLE; ?></b>&nbsp;
					</TD>
					<TD width="55%" valign="top">
						<SELECT NAME="params[morein_show_cat_title]">
							<option <?php if ($params->get('morein_show_cat_title') == 1) echo 'selected'; ?> value="1">Yes</option>
							<option <?php if ($params->get('morein_show_cat_title') == 0) echo 'selected'; ?> value="0">No</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _LEADING_THUMBNAIL_IMAGE_POSITION; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[morein_leading_thumbnail_position]">
							<option <?php if ($params->get('morein_leading_thumbnail_position') == 'left') echo 'selected'; ?> value="left">Left-side</option>
							<option <?php if ($params->get('morein_leading_thumbnail_position') == 'right') echo 'selected'; ?> value="right">Right-side</option>
							<option <?php if ($params->get('morein_leading_thumbnail_position') == 'above_title') echo 'selected'; ?> value="above_title">Above Title</option>
							<option <?php if ($params->get('morein_leading_thumbnail_position') == 'above_intro') echo 'selected'; ?> value="above_intro">Above Intro</option>
							<option <?php if ($params->get('morein_leading_thumbnail_position') == 'below_intro') echo 'selected'; ?> value="below_intro">Below Intro</option>
							<option <?php if ($params->get('morein_leading_thumbnail_position') == 'below_readon') echo 'selected'; ?> value="below_readon">Below Read More</option>
							<option <?php if ($params->get('morein_leading_thumbnail_position') == '') echo 'selected'; ?> value="">Joomla Default</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _INTRO_THUMBNAIL_IMAGE_POSITION; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<SELECT NAME="params[morein_intro_thumbnail_position]">
							<option <?php if ($params->get('morein_intro_thumbnail_position') == 'left') echo 'selected'; ?> value="left">Left-side</option>
							<option <?php if ($params->get('morein_intro_thumbnail_position') == 'right') echo 'selected'; ?> value="right">Right-side</option>
							<option <?php if ($params->get('morein_intro_thumbnail_position') == 'above_title') echo 'selected'; ?> value="above_title">Above Title</option>
							<option <?php if ($params->get('morein_intro_thumbnail_position') == 'above_intro') echo 'selected'; ?> value="above_intro">Above Intro</option>
							<option <?php if ($params->get('morein_intro_thumbnail_position') == 'below_intro') echo 'selected'; ?> value="below_intro">Below Intro</option>
							<option <?php if ($params->get('morein_intro_thumbnail_position') == 'below_readon') echo 'selected'; ?> value="below_readon">Below Read More</option>
							<option <?php if ($params->get('morein_intro_thumbnail_position') == '') echo 'selected'; ?> value="">Joomla Default</option>
						</SELECT>
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_LEADING; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[morein_leading_news]" value="<?php echo $params->get('morein_leading_news'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_INTRO; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[morein_intro_news]" value="<?php echo $params->get('morein_intro_news'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_INTRO_COLS; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[morein_intro_cols]" value="<?php echo $params->get('morein_intro_cols'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row0">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_LINK; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[morein_links]" value="<?php echo $params->get('morein_links'); ?>" size="5">
					</TD>
				</TR>
				<TR class="row1">
					<td valign="top" style="text-align: right">
						<B><?php echo _NUMBER_OF_LINK_COLS; ?></b>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="params[morein_link_cols]" value="<?php echo $params->get('morein_link_cols'); ?>" size="5">
					</TD>
				</TR>
			</TABLE>
			<?php
			$tabs->endTab();
			$tabs->endPane();
			?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="<?php echo $func; ?>" />
			<input type="hidden" name="func" value="savecat" />
			<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
			<input type="hidden" name="catid" value="<?php echo $catid; ?>" />
		</FORM>
		<?php
	}

// Functions act with Newsletter Management
	function showNewsletter( &$rows, &$pageNav ) {
		global $option, $func;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			eZine <small><small>[ <?php echo _NEWSLETTER_MAN; ?> ]</small></small>
			</th>
		</tr>
		</table><br/>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle" value="" onclick="isChecked(this.checked); checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title" width="40%">
			<?php echo _PAGE_NAME; ?>
			</th>
			<th class="title" width="20%">
			<?php echo _DATE_CREATED; ?>
			</th>
			<th width="20%">
			<?php echo _ALREADY_SEND; ?>
			</th>
			<th width="20%">
			<?php echo _DATE_SEND; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			$params =& new mosParameters( $row->params );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td>
				<a href="index2.php?option=<?php echo $option; ?>&task=editletter&nid=<?php echo $row->id; ?>">
				<?php echo $row->menu_name; ?>
				</a>
				</td>
				<td>
				<?php echo $row->date_created; ?>
				</td>
				<td align="center">
				<img src="images/<?php echo $row->already_send ? 'tick.png' : 'publish_x.png'; ?>" width="12" height="12" border="0" />
				</td>
				<td align="center">
				<?php echo $row->date_sent; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="6" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table><br/><br/>
		<?php echo $pageNav->getListFooter(); ?>
		<br/>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function editNewsletter( $func, $nid, &$row, &$params, &$lists ) {
		global $option, $func;
		?>
		<script type="text/javascript">
			function submitbutton(pressbutton) {
				if (pressbutton == 'manageletter') {
					document.adminForm.task.value = pressbutton;
					document.adminForm.submit();
				} else if (document.adminForm.item_id.value == '0') {
					alert('<?php echo _SELECT_PAGE_TO_GET_CONTENT; ?>');
				} else {
					if (document.adminForm.newsletter_content.value == '' && typeof tinyMCE != 'undefined') {
						tinyMCE.triggerSave();
					}
					document.adminForm.task.value = pressbutton;
					document.adminForm.submit();
				}
			}
			// Language Constant
			var _PAGE_TO_GET_CONTENT = '<?php echo _PAGE_TO_GET_CONTENT; ?>';
			var _NEWSLETTER_TEMPLATE = '<?php echo _NEWSLETTER_TEMPLATE; ?>';
		</script>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo $func == 'newletter' ? _NEW_NEWSLETTER : _EDIT_NEWSLETTER; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _NEWSLETTER_CONFIG; ?></th></tr>
				<TR class="row0">
					<td width="40%" style="text-align: right">
						<B><?php echo _PAGE_TO_GET_CONTENT; ?></B>&nbsp;
					</TD>
					<TD>
						<?php echo $lists['pages']; ?>
					</TD>
				</TR>
				<TR class="row1">
					<td width="40%" style="text-align: right">
						<B><?php echo _NEWSLETTER_TEMPLATE; ?></B>&nbsp;
					</TD>
					<TD>
						<?php echo $lists['templates']; ?>
					</TD>
				</TR>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><th colspan="2"><?php echo _NEWSLETTER_CONTENT; ?></th></tr>
				<TR class="row0">
					<TD colspan="2">
					<table border="0" cellspacing="0" cellpadding="0">
					<tr><td width="10%">&nbsp;</td><td>
					<?php
						// parameters : areaname, content, hidden field, width, height, cols, rows
						editorArea( 'newsletter_content_editor', ($func == 'newletter' ? '' : $row->content), 'newsletter_content', '610', '300', '89', '19' );
					?>
					</td><td width="90%" valign="top">
					<?php echo _PREDEFINED_PLACEHOLDER; ?>
					</td></tr>
					</table>
					</TD>
				</TR>
			</TABLE>

			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="<?php echo $func; ?>" />
			<input type="hidden" name="nid" value="<?php echo $nid; ?>" />
		</FORM>
		<?php
	}

	function showSubscribers( &$rows, &$pageNav, $seclist ) {
		global $option, $func, $database;
		$filter = mosGetParam($_POST, 'filter', '');
		$database->setQuery( "SELECT id AS value, menu_name AS `text` FROM #__ezine_page ORDER BY id" );
		$pages = $database->loadObjectList();
		?>
		<script type="text/javascript">
			var page_found = <?php echo count($pages); ?>;
			var _SUBSCRIBE_EMPTY = '<?php echo _SUBSCRIBE_EMPTY; ?>';
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th colspan="2">
			eZine <small><small>[ <?php echo _SUBSCRIBERS_MAN; ?> ]</small></small>
			</th>
		</tr>
		</table><br/>
		<table class="adminlist">
			<tr>
				<td width="70%" style="text-align:right; font-weight:bold">
					<?php echo _FILTER; ?>&nbsp;
				</td>
				<td width="30%" style="text-align:left">
					<div width="50%" style="float:left">
					<input type="text" size="10" value="<?php echo $filter; ?>" class="inputbox" name="filter" />&nbsp;
					</div><div width="50%" style="float:right">
					<?php echo $seclist; ?>
					</div>
				</td>
			</tr>
		</table>
		<br/><br/>
		<table class="adminlist">
		<tr>
			<th class="title" width="10">
			#
			</th>
			<th align="center" width="35">
			<input type="checkbox" name="toggle" value="" onclick="isChecked(this.checked); checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title" width="20%">
			<?php echo _USER_NAME; ?>
			</th>
			<th class="title" width="30%">
			<?php echo _USER_EMAIL; ?>
			</th>
			<th width="20%">
			<?php echo _DATE_JOIN; ?>
			</th>
			<th width="30%">
			<?php echo _SUBSCRIBED_TO; ?>
			</th>
		</tr>
		<?php if (count($rows)) {
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td>
				<?php echo $row->uid > 0 ? $row->u_name : $row->name; ?>
				</td>
				<td>
				<a href="mailto:<?php echo $row->uid > 0 ? $row->u_email : $row->email; ?>">
				<?php echo $row->uid > 0 ? $row->u_email : $row->email; ?>
				</a>
				</td>
				<td align="center">
				<?php echo $row->date_join; ?>
				</td>
				<td align="center">
				<a id="subcribed_pages_<?php echo $row->id; ?>" href="javascript:void(0)" onclick="PopupContent('subcribed_pages', '<?php echo $row->id; ?>', '', '', '', 300, 200, closeImg, true);">
				<?php echo $row->subcribed_pages ? $row->subcribed_pages : '-'; ?>
				</a>
				<?php
					$subcribed_pages = explode(', ', $row->subcribed_pages);
					$list_pages = '';
					$index = 0;
					foreach ($pages AS $page) {
						$list_pages .= '<tr><td width="10%"><input id="ep'.$row->id.$index.'" name="pages'.$row->id.'[]" value="'.$page->value.'" onclick="isChecked(this.checked);" type="checkbox"'.(in_array($page->text, $subcribed_pages) ? ' checked' : '').'></td>';
						$list_pages .= '<td width="90%">&nbsp;'.$page->text.'</td></tr>';
						$index++;
					}
					$popup = '
					<table width="100%" class="adminlist">
					<tr><th colspan="2">'._SELECT_PAGE.'</th></tr>
					'.$list_pages.'
					</table>
					<p align="center">
					<input type="button" class="button" name="'._UPDATE.'" value="'._UPDATE.'" onclick="call_updateSubscribe('.$row->id.')" />
					</p>
					';
					writePopupCode( 'subcribed_pages', $row->id, $popup );
				?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} } else {
			?>
			<tr class="row0"><td colspan="6" align="center">
				<?php echo _NOT_FOUND_ANY; ?>
			</td></tr>
			<?php
		}
		?>
		</table><br/><br/>
		<?php echo $pageNav->getListFooter(); ?>
		<br/>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function sendNewsletter( $letter, $total ) {
		global $option, $func;
		?>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<script type="text/javascript">
				var _SEND_SUCCESS = "<?php echo _SEND_SUCCESS; ?>";
				var total_email = <?php echo $total; ?>;
				var email_per_block = 0;
				var total_block = 0;
				var this_block = 0;
				var interval_time = 0;
				function startSending() {
					if (document.adminForm.email_per_block.value != '' && document.adminForm.email_per_block.value > 0) {
						email_per_block = document.adminForm.email_per_block.value;
						total_block = Math.round(total_email / email_per_block);
						total_block = ((email_per_block * total_block) < total_email) ? (total_block + 1) : total_block;
					}
					if (document.adminForm.interval_between_block.value != '' && document.adminForm.interval_between_block.value > 0) {
						interval_time = document.adminForm.interval_between_block.value;
					}
					if (email_per_block > 0 && total_block > 0 && interval_time > 0) {
						if (document.getElementById('sending_status').style.display == 'none') {
							document.getElementById('sending_status').style.display = 'block';
						}
						document.getElementById('current_block').innerHTML = String(this_block + 1);
						if (document.getElementById('total_block').innerHTML == '') {
							document.getElementById('total_block').innerHTML = total_block;
						}
						call_sendNewsletterOut();
					}
				}
			</script>
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo _SEND_NEWSLETTER; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminform">
				<tr><th colspan="2"><?php echo _SENDING_SET; ?></th></tr>
				<TR class="row0">
					<td width="50%" valign="top" style="text-align: right">
						<B><?php echo _EMAIL_PER_BLOCK; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="email_per_block" value="1" size="20">
					</TD>
				</TR>
				<TR class="row1">
					<td width="50%" valign="top" style="text-align: right">
						<B><?php echo _INTERVAL_BETWEEN_BLOCK; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="interval_between_block" value="18" size="20">
					</TD>
				</TR>
				<TR class="row0">
					<td width="50%" valign="top" style="text-align: right">
						<B><?php echo _NEWSLETTER_SUBJECT; ?></B>&nbsp;
					</TD>
					<TD valign="top">
						<INPUT CLASS="inputbox" TYPE="text" name="newsletter_subject" value="" size="20">
					</TD>
				</TR>
				<tr><td colspan="2">
				<p style="text-align:center"><input type="button" class="button" name="Send" value="<?php echo _SEND; ?>" onclick="startSending();" /></p>
				</td></tr>
				<tr><td colspan="2">
				<p id="sending_status" style="text-align:center; display:none; font-size:200%">
					<?php echo _SENDING_STATUS; ?>
				</p>
				</td></tr>
			</table><br/>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="newsletter" value="<?php echo $letter; ?>" />
		</form>
		<?php
	}

// Functions act with editing CSS / Language file
	function editCSS( &$content ) {
		global $option, $func;
		?>
		<form action="index2.php" method="post" name="adminForm">
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td width="40%"><table class="adminheading"><tr><th class="templates">eZine <small><small>[ <?php echo _EDIT_CSS; ?> ]</small></small></th></tr></table></td>
	        <td width="30%" align="center">
	            <span class="componentheading"><?php echo str_replace('%FILE_NAME%', 'ezine.css', _FILE_IS); ?>
	            <b><?php echo is_writable(_D4J_PRODUCT_FRONTEND_PATH.'/css/ezine.css') ? '<font color="green"> '._WRITEABLE.'</font>' : '<font color="red"> '._UNWRITEABLE.'</font>' ?></b>
	            </span>
	        </td>
<?php
	        if (mosIsChmodable(_D4J_PRODUCT_FRONTEND_PATH.'/css/ezine.css')) {
	            if (is_writable(_D4J_PRODUCT_FRONTEND_PATH.'/css/ezine.css')) {
?>
	        <td width="30%" style="text-align: right">
	            <input type="checkbox" id="disable_write" name="disable_write" value="1"/>
	            <label for="disable_write"><?php echo _MAKE_UNWRITEABLE; ?></label>
	        </td>
<?php
	            } else {
?>
	        <td width="30%" style="text-align: right">
	            <input type="checkbox" id="enable_write" name="enable_write" value="1"/>
	            <label for="enable_write"><?php echo _OVERRIDE_UNWRITEABLE; ?></label>
	        </td>
<?php
	            } // if
	        } // if
?>
	    </tr>
	    </table><br/>
		<table class="adminform">
	        <tr><th><?php echo _D4J_PRODUCT_FRONTEND_PATH.'/css/ezine.css'; ?></th></tr>
	        <tr><td><textarea style="width:100%" cols="110" rows="25" name="filecontent" class="inputbox"><?php
				echo $content;
	        ?></textarea></td></tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="func" value="savecss" />
		</form>
	<?php
	}

	function editLang( &$content ) {
		global $option, $func, $mosConfig_lang;
		?>
		<form action="index2.php" method="post" name="adminForm">
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td width="40%"><table class="adminheading"><tr><th class="langmanager">eZine <small><small>[ <?php echo _EDIT_LANG; ?> ]</small></small></th></tr></table></td>
	        <td width="30%" align="center">
	            <span class="componentheading"><?php echo str_replace('%FILE_NAME%', $mosConfig_lang.'.php', _FILE_IS); ?>
	            <b>
<?php
	if (!file_exists(_D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php')) {
		echo '<font color="black"> '._NOT_CREATED.'</font>';
	} else {
		echo is_writable(_D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php') ? '<font color="green"> '._WRITEABLE.'</font>' : '<font color="red"> '._UNWRITEABLE.'</font>';
	}
?>
	            </b>
	            </span>
	        </td>
<?php
	        if (mosIsChmodable(_D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php')) {
	            if (is_writable(_D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php')) {
?>
	        <td width="30%" style="text-align: right">
	            <input type="checkbox" id="disable_write" name="disable_write" value="1"/>
	            <label for="disable_write"><?php echo _MAKE_UNWRITEABLE; ?></label>
	        </td>
<?php
	            } else {
?>
	        <td width="30%" style="text-align: right">
	            <input type="checkbox" id="enable_write" name="enable_write" value="1"/>
	            <label for="enable_write"><?php echo _OVERRIDE_UNWRITEABLE; ?></label>
	        </td>
<?php
	            } // if
	        } // if
?>
	    </tr>
	    </table><br/>
		<table class="adminform">
	        <tr><th><?php echo _D4J_PRODUCT_FRONTEND_PATH.'/language/'.$mosConfig_lang.'.php'; ?></th></tr>
	        <tr><td><textarea style="width:100%" cols="110" rows="25" name="filecontent" class="inputbox"><?php
				echo $content;
			?></textarea></td></tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="func" value="savelang" />
		</form>
	<?php
	}

// Functions act with adding separator between contents in news page
	function selectSeparatorType( $pageid ) {
		global $option, $func;
		?>
		<FORM METHOD=POST NAME="adminForm" ACTION="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				eZine <small><small>[ <?php echo _SELECT_SEPARATOR_TYPE; ?> ]</small></small>
				</th>
			</tr>
			</table><br/>
			<TABLE class="adminlist">
				<TR>
					<td width="30%" nowrap>&nbsp;</td>
					<TD>
						<input type="radio" name="separator_type" value="content_item" onclick="document.adminForm.boxchecked.value = 1;" />&nbsp;<?php echo _CONTENT_ITEM; ?>
					</TD>
					<td width="30%" nowrap>&nbsp;</td>
				</TR>
				<TR>
					<td width="30%" nowrap>&nbsp;</td>
					<TD>
						<input type="radio" name="separator_type" value="static_content" onclick="document.adminForm.boxchecked.value = 1;" />&nbsp;<?php echo _TYPED_CONTENT; ?>
					</TD>
					<td width="30%" nowrap>&nbsp;</td>
				</TR>
				<TR>
					<td width="30%" nowrap>&nbsp;</td>
					<TD>
						<input type="radio" name="separator_type" value="html_code" onclick="document.adminForm.boxchecked.value = 1;" />&nbsp;<?php echo _HTML_CODE; ?>
					</TD>
					<td width="30%" nowrap>&nbsp;</td>
				</TR>
			</TABLE>
			<BR>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="<?php echo $func; ?>" />
			<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
			<input type="hidden" name="boxchecked" value="0" />
		</FORM>
		<?php
	}

	function showContentItem( &$rows, $section, &$lists, $search, $pageNav, $all=NULL, $pageid ) {
		global $option, $func, $mosConfig_offset;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit" rowspan="2" nowrap>
			eZine <small><small>[ <?php echo _NEWS_SEPARATOR; ?> ]</small></small>
			</th>
			<?php
			if ( $all ) {
				?>
				<td width="right" rowspan="2" valign="top">
				<?php echo $lists['sectionid'];?>
				</td>
				<?php
			}
			?>
			<td width="right" valign="top">
			<?php echo $lists['catid'];?>
			</td>
			<td width="right" valign="top">
			<?php echo $lists['authorid'];?>
			</td>
		</tr>
		<tr>
			<td style="text-align: right">
			<?php echo _FILTER; ?>
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table><br/>
		<table class="adminlist">
		<tr>
			<th width="1%" align="center" nowrap>
			#
			</th>
			<th width="1%" align="center" nowrap>
			&nbsp;
			</th>
			<th width="1%" align="center" nowrap>
			<?php echo _ID; ?>
			</th>
			<th class="title" width="40%">
			<?php echo _TITLE; ?>
			</th>
			<th width="10%" align="center">
			<?php echo _PUBLISHED; ?>
			</th>
			<th width="10%" align="center">
			<?php echo _FRONTPAGE; ?>
			</th>
			<th width="10%" align="center">
			<?php echo _ACCESS; ?>
			</th>
			<?php
			if ( $all ) {
				?>
				<th align="center" width="15%">
				<?php echo _CONTENT_SEC; ?>
				</th>
				<?php
			}
			?>
			<th align="center" width="15%">
			<?php echo _CONTENT_CAT; ?>
			</th>
			<th align="center" width="10%">
			<?php echo _AUTHOR; ?>
			</th>
			<th align="center" width="10">
			<?php echo _DATE; ?>
			</th>
		  </tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			$now = defined(_CURRENT_SERVER_TIME) ? _CURRENT_SERVER_TIME : date('Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60);
			if ( $now <= $row->publish_up && $row->state == "1" ) {
				$img = 'publish_y.png';
				$alt = 'Published';
			} else if ( ( $now <= $row->publish_down || $row->publish_down == "0000-00-00 00:00:00" ) && $row->state == "1" ) {
				$img = 'publish_g.png';
				$alt = 'Published';
			} else if ( $now > $row->publish_down && $row->state == "1" ) {
				$img = 'publish_r.png';
				$alt = 'Expired';
			} elseif ( $row->state == "0" ) {
				$img = "publish_x.png";
				$alt = 'Unpublished';
			}
			$date = mosFormatDate( $row->created, '%x' );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="radio" id="cb<?php echo $i;?>" name="cid" value="<?php echo $row->id; ?>" onclick="document.adminForm.boxchecked.value = 1;" />
				</td>
				<td align="center">
				<?php echo $row->id; ?>
				</td>
				<td>
				<?php echo $row->title; ?>
				</td>
				<td align="center">
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" />
				</td>
				<td align="center">
				<img src="images/<?php echo ( $row->frontpage ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" />
				</td>
				<td align="center">
				<?php
					if ( !$row->access ) {
						$color_access = 'style="color: green;"';
					} else if ( $row->access == 1 ) {
						$color_access = 'style="color: red;"';
					} else {
						$color_access = 'style="color: black;"';
					}
					echo "<font $color_access>$row->groupname</font>";
				?>
				</td>
				<?php
				if ( $all ) {
					?>
					<td align="center">
					<?php echo $row->section_name; ?>
					</td>
					<?php
				}
				?>
				<td align="center">
				<?php echo $row->name; ?>
				</td>
				<td align="center">
				<?php
					if ( $row->created_by_alias ) {
						echo $row->created_by_alias;
					} else {
						echo $row->author;
					}
				?>
				</td>
				<td align="center">
				<?php echo $date; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $section->id;?>" />
		<input type="hidden" name="separator_type" value="content_item" />
		<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function showStaticContent( &$rows, &$pageNav, $search, &$lists, $pageid ) {
		global $option, $func, $mosConfig_offset;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit">
			eZine <small><small>[ <?php echo _TYPED_SEPARATOR; ?> ]</small></small>
			</th>
			<td>
			<?php echo _FILTER; ?>
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
			<td>
			&nbsp;&nbsp;&nbsp;<?php echo _SEARCH_ORDER; ?>
			</td>
			<td>
			<?php echo $lists['order']; ?>
			</td>
			<td width="right">
			<?php echo $lists['authorid'];?>
			</td>
		</tr>
		</table><br/>
		<table class="adminlist">
		<tr>
			<th width="2%" align="center" nowrap>
			#
			</th>
			<th width="2%" align="center" nowrap>
			&nbsp;
			</th>
			<th width="2%" align="center" nowrap>
			<?php echo _ID; ?>
			</th>
			<th class="title" width="30%">
			<?php echo _TITLE; ?>
			</th>
			<th width="10%" align="center">
			<?php echo _PUBLISHED; ?>
			</th>
			<th width="10%" align="center">
			<?php echo _ACCESS; ?>
			</th>
			<th width="10%" align="center">
			<?php echo _LINK; ?>
			</th>
			<th align="center" width="10%">
			<?php echo _AUTHOR; ?>
			</th>
			<th align="center" width="10">
			<?php echo _DATE; ?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			$now = defined(_CURRENT_SERVER_TIME) ? _CURRENT_SERVER_TIME : date('Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60);
			if ( $now <= $row->publish_up && $row->state == "1" ) {
				$img = 'publish_y.png';
				$alt = 'Published';
			} else if ( ( $now <= $row->publish_down || $row->publish_down == "0000-00-00 00:00:00" ) && $row->state == "1" ) {
				$img = 'publish_g.png';
				$alt = 'Published';
			} else if ( $now > $row->publish_down && $row->state == "1" ) {
				$img = 'publish_r.png';
				$alt = 'Expired';
			} elseif ( $row->state == "0" ) {
				$img = "publish_x.png";
				$alt = 'Unpublished';
			}
			if ( !$row->access ) {
				$color_access = 'style="color: green;"';
			} else if ( $row->access == 1 ) {
				$color_access = 'style="color: red;"';
			} else {
				$color_access = 'style="color: black;"';
			}
			if ( $row->created_by_alias ) {
				$author = $row->created_by_alias;
			} else {
				$author = $row->creator;
			}
			$date = mosFormatDate( $row->created, '%x' );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<input type="radio" id="cb<?php echo $i;?>" name="cid" value="<?php echo $row->id; ?>" onclick="document.adminForm.boxchecked.value = 1;" />
				</td>
				<td align="center">
				<?php echo $row->id;?>
				</td>
				<td>
				<?php
					echo $row->title;
					if ( $row->title_alias ) {
						echo ' (<i>'. $row->title_alias .'</i>)';
					}
				?>
				</td>
				<td align="center">
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" />
				</td>
				<td align="center">
				<?php echo "<font $color_access>$row->groupname</font>"; ?>
				</td>
				<td align="center">
				<?php echo $row->links; ?>
				</td>
				<td align="center">
				<?php echo $author; ?>
				</td>
				<td align="center">
				<?php echo $date; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="separator_type" value="static_content" />
		<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function htmlSeparator( $pageid, $separatorid = '', $html_code = '<hr>' ) {
		global $option, $func;
		?>
		<form action="index2.php" method="post" name="adminForm">
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td width="100%"><table class="adminheading"><tr><th class="edit">eZine <small><small>[ <?php echo ($separatorid <> '') ? _EDIT_HTML_SEPARATOR : _ADD_HTML_SEPARATOR; ?> ]</small></small></th></tr></table></td>
	    </tr>
	    </table><br/>
		<table class="adminform">
	        <tr><th><?php echo _HTML_CODE_INPUT; ?></th></tr>
	        <tr><td>
				<?php
				// parameters : areaname, content, hidden field, width, height, cols, rows
				editorArea( '_html_separator', htmlspecialchars($html_code), 'htmlcontent', '610', '300', '89', '19' );
				?>
	        </td></tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $func; ?>" />
		<input type="hidden" name="separator_type" value="html_code" />
		<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
		<?php if ($separatorid) { ?>
			<input type="hidden" name="separatorid" value="<?php echo $separatorid; ?>" />
		<?php } ?>
		</form>
		<?php
	}

// Registration, Request Support and About Us functions
	function register() {
		global $option;
		?>
		<form method="post" name="adminForm" action="index2.php">
			<table class="adminheading">
			<tr>
				<th>
				<?php echo _D4J_PRODUCT_NAME; ?> <small><small>[ Register ]</small></small>
				</th>
			</tr>
			</table><br/>
			<table class="adminform">
				<tr><th>Input your License Key</th></tr>
				<tr class="row0">
					<td width="100%" style="text-align:center">
					<input class="inputbox" type="text" name="license_key" value="" style="width:69%" />
					</td>
				</tr>
				<TR class="row1">
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