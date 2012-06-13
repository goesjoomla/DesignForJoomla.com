<?php
/**
* eZine component :: html output functions
**/

/** ensure this file is being included by a parent file */
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

class HTML_ezine {
	/**
	* Display link to a content item
	*/
	function showLink(&$row, &$params) {
		global $mainframe, $mosConfig_live_site, $return_html;

		$link = getArticleLink($row->id, $params);
		$image_code = '';
		$thumbnail_cell_width = 0;

		if ($params->get('link_with_img')) {
			// show links with the first image of news item
			require_once(_D4J_PRODUCT_FRONTEND_PATH.'/ezine.mosimage.php');

			$images = explode("\n", $row->images);
			$image = trim($images[0]);
			if ($image) { // resizing first image
				$temp = explode('|', trim($image));
				if (isset($temp[0]) AND ($temp[0] != '')) {
					$img_size_details = d4jGenericImage::resizeImage(_D4J_PRODUCT_FRONTEND_PATH.'/../../images/stories/'.$temp[0], $params->get('link_image_width'), $params->get('link_image_height'), $params->get('link_image_keep_ratio'), $params->get('link_image_process_menthod'));
					$size = ' width="'.$img_size_details[1][0].'" height="'.$img_size_details[1][1].'"';
					$image_code = '<img src="'.$mosConfig_live_site.'/images/stories/'.$temp[0].'"'.$size.' alt="'.($temp[2] != '' ? $temp[2] : htmlentities($row->title)).'" border="0" class="articles_image'.$params->get('pageclass_sfx').'" />';
					if ($params->get('create_real_thumb')) {
						$thumbPath = _D4J_PRODUCT_FRONTEND_PATH.'/../../'.$params->get('thumb_directory').'/'.preg_replace("/(\.\w{3,4})$/i", '_'.$img_size_details[1][0].'x'.$img_size_details[1][1].'.jpg', basename($temp[0]));
						if (d4jGenericImage::createThumbnail(_D4J_PRODUCT_FRONTEND_PATH.'/../../images/stories/'.$temp[0], $thumbPath, $img_size_details[1], $params->get('image_library'), $params->get('image_library_path'))) {
							$image_code = '<img src="'.$mosConfig_live_site.'/'.$params->get('thumb_directory').'/'.basename($thumbPath).'"'.$size.' alt="'.($temp[2] != '' ? $temp[2] : htmlentities($row->title)).'" border="0" class="articles_image'.$params->get('pageclass_sfx').'" />';
						}
					}
					$thumbnail_cell_width = $thumbnail_cell_width < $img_size_details[1][0] ? $img_size_details[1][0] : $thumbnail_cell_width;
				}
			} elseif ($params->get('link_image_default') != '') { // article does not have image embedded via {mosimage} bot tag, use default image
				$default_image_path = str_replace($mosConfig_live_site, '', $params->get('link_image_default'));
				$img_size_details = d4jGenericImage::resizeImage(_D4J_PRODUCT_FRONTEND_PATH.'/../../'.$default_image_path, $params->get('link_image_width'), $params->get('link_image_height'), $params->get('link_image_keep_ratio'), $params->get('link_image_process_menthod'));
				$size = ' width="'.$img_size_details[1][0].'" height="'.$img_size_details[1][1].'"';
				$image_code = '<img src="'.$params->get('link_image_default').'"'.$size.' alt="'.htmlentities($row->title).'" border="0" class="articles_image'.$params->get('pageclass_sfx').'" />';
				if ($params->get('create_real_thumb')) {
					$thumbPath = _D4J_PRODUCT_FRONTEND_PATH.'/../../'.$params->get('thumb_directory').'/'.preg_replace("/(\.\w{3,4})$/i", '_'.$img_size_details[1][0].'x'.$img_size_details[1][1].'.jpg', basename($params->get('link_image_default')));
					if (d4jGenericImage::createThumbnail(_D4J_PRODUCT_FRONTEND_PATH.'/../../'.$default_image_path, $thumbPath, $img_size_details[1], $params->get('image_library'), $params->get('image_library_path'))) {
						$image_code = '<img src="'.$mosConfig_live_site.'/'.$params->get('thumb_directory').'/'.basename($thumbPath).'"'.$size.' alt="'.htmlentities($row->title).'" border="0" class="articles_image'.$params->get('pageclass_sfx').'" />';
					}
				}
				$thumbnail_cell_width = $thumbnail_cell_width < $img_size_details[1][0] ? $img_size_details[1][0] : $thumbnail_cell_width;
			} else {
				$thumbnail_cell_width = $thumbnail_cell_width < $params->get('link_image_width') ? $params->get('link_image_width') : $thumbnail_cell_width;
			}
			if ($image_code) {
				switch ($params->get('link_image_type')) {
					case '1': $image_code = '<a href="' . $link . '">' . $image_code . '</a>'; break;
					case '2': $image_code = ezineMosImage_popup($image_code, $temp, $img_size_details[0]); break;
					case '0':
					default: break;
				}
			}
		}

	    $return_html .= '<table cellspacing="3" cellpadding="3" border="0"><tr>';
	    $return_html .= '<td width="'.$thumbnail_cell_width.'" valign="middle">'.$image_code.'</td>';
	    $return_html .= '<td valign="middle"><a href="' . $link . '" class="contentpagetitle'.$params->get('pageclass_sfx').'" title="'.htmlentities($row->title).'">' . $row->title . '</a>';
		// displays Author Name
		HTML_ezine::Author($row, $params);
		// displays Created Date
		HTML_ezine::CreateDate($row, $params);
		// displays Modified Date
		HTML_ezine::ModifiedDate($row, $params);
	    $return_html .= '</td></tr></table>';
	}

	/**
	* Show a content item
	*/
	function show(&$row, &$params, &$access, $article_page=0) {
		global $mainframe, $gid, $mosConfig_sitename, $Itemid, $mosConfig_live_site, $_MAMBOTS;
		global $task, $func, $return_html;

		$mainframe->appendMetaTag('description', $row->metadesc);
		$mainframe->appendMetaTag('keywords', $row->metakey);

		$params->def('ezine_cat_Itemid', $Itemid);
		$link_on 	= '';
		$link_text 	= '';

		$thumbnail_position = $params->get($params->get('thumbnail_position').'_thumbnail_position');

		// determines the link and link text of the readmore button
		if ($row->access <= $gid) { // public access
			$link_on = getArticleLink($row->id, $params);
			if (strlen(trim($row->fulltext))) {
				$link_text = _READ_MORE;
			}
		} else { // registered/special access
			$link_on = sefRelToAbs("index.php?option=com_registration&amp;task=register");
			if (strlen(trim($row->fulltext))) {
				$link_text = _READ_MORE_REGISTER;
			}
		}

		if ($thumbnail_position != '' OR $params->get('content_image_processor','0') == '0') {
			require_once(_D4J_PRODUCT_FRONTEND_PATH.'/ezine.mosimage.php');
		}

		// process with first image
		if ($thumbnail_position != '') {
			$first_img_code = '';
			$img_parts = explode("\n", $row->images, 2);
			$first_image = $img_parts[0];
			$row->images = isset($img_parts[1]) ? $img_parts[1] : '';
			if ($first_image) {
				$temp = explode('|', trim($first_image));
				if (isset($temp[0]) AND ($temp[0] != '')) {
					if ($params->get('in_featured_block')) {
						$this_block = 'featured';
					} else {
						$this_block = 'thumbnail';
					}
					$posi = ($thumbnail_position == 'above_title' OR $thumbnail_position == 'above_intro') ? 'top' : (($thumbnail_position == 'below_intro' OR $thumbnail_position == 'below_readon') ? 'bottom' : $thumbnail_position);
					$img_size_details = d4jGenericImage::resizeImage(_D4J_PRODUCT_FRONTEND_PATH.'/../../images/stories/'. $temp[0], $params->get($this_block.'_image_'.$posi.'_width'), $params->get($this_block.'_image_'.$posi.'_height'), $params->get('thumbnail_keep_ratio'), $params->get('thumbnail_process_menthod'));
					$size = ' width="'.$img_size_details[1][0].'" height="'.$img_size_details[1][1].'"';
					$align = '';
					if ($thumbnail_position == 'left') {
						$align = ' align="left"';
					} elseif ($thumbnail_position == 'right') {
						$align = ' align="right"';
					}
					$first_img_code = '<img src="'.$mosConfig_live_site.'/images/stories/'.$temp[0].'"'.$size.' alt="'.($temp[2] != '' ? $temp[2] : htmlentities($row->title)).'" border="0"'.$align.' class="thumbnail_'.$posi.'" />';
					if ($params->get('create_real_thumb')) {
						$thumbPath = _D4J_PRODUCT_FRONTEND_PATH.'/../../'.$params->get('thumb_directory').'/'.preg_replace("/(\.\w{3,4})$/i", '_'.$img_size_details[1][0].'x'.$img_size_details[1][1].'.jpg', basename($temp[0]));
						if (d4jGenericImage::createThumbnail(_D4J_PRODUCT_FRONTEND_PATH.'/../../images/stories/'.$temp[0], $thumbPath, $img_size_details[1], $params->get('image_library'), $params->get('image_library_path'))) {
							$first_img_code = '<img src="'.$mosConfig_live_site.'/'.$params->get('thumb_directory').'/'.basename($thumbPath).'"'.$size.' alt="'.($temp[2] != '' ? $temp[2] : htmlentities($row->title)).'" border="0"'.$align.' class="thumbnail_'.$posi.'" />';
						}
					}
					switch ($params->get('thumbnail_image_link')) {
						case '1': $first_img_code = '<a href="' . $link_on . '" title="'.htmlentities($row->title).'">' . $first_img_code . '</a>'; break;
						case '2': $first_img_code = ezineMosImage_popup($first_img_code, $temp, $img_size_details[0]); break;
						case '0':
						default: break;
					}
					// clear first {mosimage} bot tag
					$row->text = preg_replace('/{(mosimage)\s*(.*?)}/i', '', $row->text, 1);
				}
			}
		}

		// show {mosimage} in intro or not
		if ($params->get('intro_only') AND !$params->get('intro_with_img')) {
			$row->text = preg_replace('/{(mosimage)\s*(.*?)}/i', '', $row->text);
		}

		// process with {mosimage} bot tags if set
		if ($params->get('content_image_processor','0') == '0') {
			ezineMosImage($row, $params);
		}

		// process with {mospagebreak} bot tags
		if (preg_match('/{(mospagebreak)\s*(.*?)}/i', $row->text)) {
			require_once(_D4J_PRODUCT_FRONTEND_PATH.'/ezine.mospagebreak.php');
			ezineMosPaging($row, $params, $article_page);
		}

		// process the new bots
		$_MAMBOTS->loadBotGroup('content');
		$results = $_MAMBOTS->trigger('onPrepareContent', array(&$row, &$params, $article_page), true);

		// adds mospagebreak heading or title to <site> Title
		if (isset($row->page_title)) {
			$mainframe->setPageTitle($row->title .': '. $row->page_title);
		}

		// determines links to next and prev content items within category
		if ($params->get('item_navigation')) {
			global $pageid, $category_id;
			if ($row->prev) {
				$row->prev = getArticleLink($row->prev, $params);
			} else {
				$row->prev = 0;
			}
			if ($row->next) {
				$row->next = getArticleLink($row->next, $params);
			} else {
				$row->next = 0;
			}
		}

		$return_html .= '<table class="contentpaneopen'.$params->get('pageclass_sfx').'"><tr>';
		$return_html .= '<td valign="top">';
		if ($params->get('intro_only') AND $thumbnail_position == 'left' OR $thumbnail_position == 'right') {
			$return_html .= $first_img_code;
		}

		if ($params->get('intro_only') AND $thumbnail_position == 'above_title') {
			$return_html .= '<div class="thumbnail_top">'.$first_img_code.'</div>';
		}

		if ($params->get('article_title') || $params->get('pdf')  || $params->get('print') || $params->get('email')) {
			// link used by print button
			$print_link = $mosConfig_live_site. '/index2.php?option=com_content&amp;task=view&amp;id='. $row->id .'&amp;Itemid='. $params->get('ezine_cat_Itemid') .'&amp;pop=1&amp;page=0';
			$return_html .= '<table border="0" cellspacing="0" cellpadding="0"><tr>';

			// displays Item Title
			HTML_ezine::Title($row, $params, $link_on);

			// displays Edit Icon
			HTML_ezine::EditIcon($row, $params, $access, false);

			if (($params->get('pdf')  || $params->get('print') || $params->get('email')) AND (($task != 'read' AND $func != 'showFullArticleAJAX') OR (($task == 'read' OR $func == 'showFullArticleAJAX') AND ($params->get('article_icon_position') == 'topright' OR $params->get('article_icon_position') == 'topright-bottomleft' OR $params->get('article_icon_position') == 'topright-bottomright')))) {
				$return_html .= '<td width="100%" align="right">';
				$return_html .= '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>';
				$params->set('current_icon_pos', 'top');

				if (($task == 'read' OR $func == 'showFullArticleAJAX') AND $params->get('article_top_icon_arrangement') == 'horizontal') {
					$return_html .= '<td width="100%">&nbsp;</td>';
				}

				// displays PDF Icon
				HTML_ezine::PdfIcon($row, $params, $link_on);

				// displays Print Icon
				HTML_ezine::PrintIcon($row, $params, $print_link, null);

				// displays Email Icon
				HTML_ezine::EmailIcon($row, $params);

				$return_html .= '</tr></table></td>';
			}

			$return_html .= '</tr></table>';
 		} else if ($access->canEdit) {
 			// edit icon when item title set to hide
 			$return_html .= '<table border="0" cellspacing="0" cellpadding="0"><tr>';
			HTML_ezine::EditIcon($row, $params, $access, true);
 			$return_html .= '</tr></table>';
  		}

		if (!$params->get('intro_only')) {
			$results = $_MAMBOTS->trigger('onAfterDisplayTitle', array(&$row, &$params, $article_page));
			$return_html .= trim(implode("\n", $results));
		}

		$results = $_MAMBOTS->trigger('onBeforeDisplayContent', array(&$row, &$params, $article_page));
		$return_html .= trim(implode("\n", $results));

		// displays Section & Category
		HTML_ezine::Section_Category($row, $params);

		// displays Author Name
		HTML_ezine::Author($row, $params);

		// displays Created Date
		HTML_ezine::CreateDate($row, $params);

		// displays Table of Contents
		HTML_ezine::TOC($row);

		if ($params->get('intro_only') AND $thumbnail_position == 'above_intro') {
			$return_html .= '<div class="thumbnail_top">'.$first_img_code.'</div>';
		}

		// displays Item Text
		$return_html .= $row->text;

		if ($params->get('intro_only') AND $thumbnail_position == 'below_intro') {
			$return_html .= '<div class="thumbnail_bottom">'.$first_img_code.'</div>';
		}

		// displays Modified Date
		HTML_ezine::ModifiedDate($row, $params);

		// displays Readmore button
		HTML_ezine::ReadMore($params, $link_on, $link_text);

		if ($params->get('intro_only') AND $thumbnail_position == 'below_readon') {
			$return_html .= '<div class="thumbnail_bottom">'.$first_img_code.'</div>';
		}

		$results = $_MAMBOTS->trigger('onAfterDisplayContent', array(&$row, &$params, $article_page));
		$return_html .= trim(implode("\n", $results));

		$return_html .= '</td>';
		if ($params->get('intro_only') AND $params->get('first_image_position','default') == 'right') {
			$return_html .= '<td valign="top" class="first_image'.$params->get('pageclass_sfx').'">';
			$return_html .= $first_img_code.'</td>';
		}
		$return_html .= '</tr></table>';

		if ($task == 'read' OR $func == 'showFullArticleAJAX') {
			if ($params->get('pdf')  || $params->get('print') || $params->get('email')) {
				if ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'bottomright' OR $params->get('article_icon_position') == 'topright-bottomleft' OR $params->get('article_icon_position') == 'topright-bottomright') {
					$return_html .= '<table border="0" cellspacing="3" cellpadding="3" width="100%"><tr>';
					$params->set('current_icon_pos', 'bottom');

					// displays PDF Icon
					HTML_ezine::PdfIcon($row, $params, $link_on);

					// displays Print Icon
					HTML_ezine::PrintIcon($row, $params, $print_link, null);

					// displays Email Icon
					HTML_ezine::EmailIcon($row, $params);

					$return_html .= '</tr></table>';
				}
			}
		} else {
			$return_html .= '<span class="article_seperator">&nbsp;</span>';
		}

		// displays the next & previous buttons
		HTML_ezine::Navigation($row, $params);
	}

	/**
	* Writes PDF icon
	*/
	function PdfIcon($row, $params, $link_on) {
		global $mosConfig_live_site, $task, $func, $return_html;

		if ($params->get('pdf')) {
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
			$link = $mosConfig_live_site. '/index2.php?option=com_content&amp;do_pdf=1&amp;id='. $row->id;
			if ($params->get('article_icon_display') != 'text') {
				$image = mosAdminMenus::ImageCheck('pdf_button.png', '/images/M_images/', NULL, NULL, _CMN_PDF);
			}
			$return_html .= '<td '.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'align="left"' : 'align="right"').' class="buttonheading'.$params->get('pageclass_sfx').'">';
			$return_html .= '<a href="javascript:void window.open(\''.$link.'\', \'win2\', \''.$status.'\');" title="'._CMN_PDF.'">';
			if ($params->get('article_'.$params->get('current_icon_pos').'_icon_display') != 'text') {
				$return_html .= preg_replace("/align\=\".*?\"/", 'align="'.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'left' : 'right').'" style="margin-'.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'right' : 'left').': 5px;"', $image);
			}
			if ($params->get('article_'.$params->get('current_icon_pos').'_icon_display') != 'icon') {
				$return_html .= $params->get('article_pdf_icon_text');
			}
			$return_html .= '</a></td>';
			if (($task == 'read' OR $func == 'showFullArticleAJAX') AND $params->get('article_'.$params->get('current_icon_pos').'_icon_arrangement') == 'vertical') {
				$return_html .= '</tr><tr>';
			}
		}
	}

	/**
	* Writes Print icon
	*/
	function PrintIcon(&$row, &$params, $link, $status=NULL) {
		global $task, $func, $return_html;

		if ($params->get('print')) {
			// use default settings if none declared
			if (!$status) {
				$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
			}

			// checks template image directory for image, if non found default are loaded
			if ($params->get('article_icon_display') != 'text') {
				$image = mosAdminMenus::ImageCheck('printButton.png', '/images/M_images/', NULL, NULL, _CMN_PRINT);
			}
			$return_html .= '<td '.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'align="left"' : 'align="right"').' class="buttonheading'.$params->get('pageclass_sfx').'">';
			$return_html .= '<a href="javascript:void window.open(\''.$link.'\', \'win2\', \''.$status.'\');" title="'._CMN_PRINT.'">';
			if ($params->get('article_'.$params->get('current_icon_pos').'_icon_display') != 'text') {
				$return_html .= preg_replace("/align\=\".*?\"/", 'align="'.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'left' : 'right').'" style="margin-'.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'right' : 'left').': 5px;"', $image);
			}
			if ($params->get('article_'.$params->get('current_icon_pos').'_icon_display') != 'icon') {
				$return_html .= $params->get('article_print_icon_text');
			}
			$return_html .= '</a></td>';
			if (($task == 'read' OR $func == 'showFullArticleAJAX') AND $params->get('article_'.$params->get('current_icon_pos').'_icon_arrangement') == 'vertical') {
				$return_html .= '</tr><tr>';
			}
		}
	}

	/**
	* Writes Email icon
	*/
	function EmailIcon($row, $params) {
		global $mosConfig_live_site, $task, $func, $return_html;

		if ($params->get('email')) {
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=400,height=250,directories=no,location=no';
			$link = $mosConfig_live_site .'/index2.php?option=com_content&amp;task=emailform&amp;id='. $row->id;
			if ($params->get('article_icon_display') != 'text') {
				$image = mosAdminMenus::ImageCheck('emailButton.png', '/images/M_images/', NULL, NULL, _CMN_EMAIL);
			}
			$return_html .= '<td '.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'align="left"' : 'align="right"').' class="buttonheading'.$params->get('pageclass_sfx').'">';
			$return_html .= '<a href="javascript:void window.open(\''.$link.'\', \'win2\', \''.$status.'\');" title="'._CMN_EMAIL.'">';
			if ($params->get('article_'.$params->get('current_icon_pos').'_icon_display') != 'text') {
				$return_html .= preg_replace("/align\=\".*?\"/", 'align="'.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'left' : 'right').'" style="margin-'.(($params->get('current_icon_pos') == 'bottom' AND ($params->get('article_icon_position') == 'bottomleft' OR $params->get('article_icon_position') == 'topright-bottomleft')) ? 'right' : 'left').': 5px;"', $image);
			}
			if ($params->get('article_'.$params->get('current_icon_pos').'_icon_display') != 'icon') {
				$return_html .= $params->get('article_email_icon_text');
			}
			$return_html .= '</a></td>';
			if (($task == 'read' OR $func == 'showFullArticleAJAX') AND $params->get('article_'.$params->get('current_icon_pos').'_icon_arrangement') == 'vertical') {
				$return_html .= '</tr><tr>';
			}
		}
	}

	/**
	* Writes Title
	*/
	function Title($row, $params, $link_on) {
		global $return_html;

		if ($params->get('article_title')) {
			$return_html .= '<td width="100%" class="contentheading'.$params->get('pageclass_sfx').'" valign="top">';
			if ($params->get('article_title_linkable') AND $link_on != '') {
				$return_html .= '<a href="'.$link_on.'" class="contentpagetitle'.$params->get('pageclass_sfx').'">';
				$return_html .= $row->title;
				$return_html .= '</a>';
			} else {
				$return_html .= $row->title;
			}
			$return_html .= '</td>';
		}
	}

	/**
	* Writes Edit icon that links to edit page
	*/
	function EditIcon($row, $params, $access, $show_status = false) {
		global $my, $return_html;

		if ($params->get('popup')) {
			return;
		}
		if ($row->state < 0) {
			return;
		}
		if (!$access->canEdit AND !($access->canEditOwn AND $row->created_by == $my->id)) {
			return;
		}
		$link = 'index.php?option=com_content&amp;task=edit&amp;id='. $row->id .'&amp;Itemid='. $params->get('ezine_cat_Itemid') .'&amp;Returnid='. $params->get('ezine_cat_Itemid');
		$image = mosAdminMenus::ImageCheck('edit.png', '/images/M_images/', NULL, NULL, _E_EDIT);
		$return_html .= '<td align="right" class="buttonheading'.$params->get('pageclass_sfx').'">';
		$return_html .= '<a href="'.sefRelToAbs($link).'" title="'._E_EDIT.'">';
		$return_html .= $image;
		$return_html .= '</a>';
		if ($show_status) {
			if ($row->state == 0) {
				$return_html .= '('. _CMN_UNPUBLISHED .')';
			}
			$return_html .= '  ('. $row->groups .')';
		}
		$return_html .= '</td>';
	}

	/**
	* Writes Container for Section & Category
	*/
	function Section_Category($row, $params) {
		global $return_html;

		if ($params->get('section') || $params->get('category')) {
			$return_html .= '<div style="width:100%;text-align:left">';
		}

		// displays Section Name
		HTML_ezine::Section($row, $params);

		// displays Section Name
		HTML_ezine::Category($row, $params);

		if ($params->get('section') || $params->get('category')) {
			$return_html .= '</div>';
		}
	}

	/**
	* Writes Section
	*/
	function Section($row, $params) {
		global $return_html;

		if ($params->get('section')) {
			$return_html .= '<span class="small'.$params->get('pageclass_sfx').'">';
			$return_html .= $row->section;
			// writes dash between section & Category Name when both are active
			if ($params->get('category')) {
				$return_html .= ' - ';
			}
			$return_html .= '</span>';
		}
	}

	/**
	* Writes Category
	*/
	function Category($row, $params) {
		global $return_html;

		if ($params->get('category')) {
			$return_html .= '<span class="small'.$params->get('pageclass_sfx').'">';
			$return_html .= $row->category;
			$return_html .= '</span>';
		}
	}

	/**
	* Writes Author name
	*/
	function Author($row, $params) {
		global $acl, $return_html;

		if (($params->get('author')) AND ($row->author != "")) {
			$grp = $acl->getAroGroup($row->created_by);
			$is_frontend_user = $acl->is_group_child_of(intval($grp->group_id), 'Public Frontend', 'ARO');
			$by = $is_frontend_user ? _AUTHOR_BY : _WRITTEN_BY;
			$return_html .= '<div style="width:100%;text-align:left"><span class="small'.$params->get('pageclass_sfx').'">';
			$return_html .= $by. ' '.($row->created_by_alias ? $row->created_by_alias : $row->author);
			$return_html .= '</span>&nbsp;&nbsp;</div>';
		}
	}

	/**
	* Writes Create Date
	*/
	function CreateDate($row, $params) {
		global $return_html;

		$create_date = null;
		if (intval($row->created) != 0) {
			$create_date = mosFormatDate($row->created);
		}
		if ($params->get('createdate')) {
			$return_html .= '<div class="createdate'.$params->get('pageclass_sfx').'">';
			$return_html .= $create_date;
			$return_html .= '</div>';
		}
	}

	/**
	* Writes TOC
	*/
	function TOC($row) {
		global $return_html;

		if (isset($row->toc)) {
			$return_html .= $row->toc;
		}
	}

	/**
	* Writes Modified Date
	*/
	function ModifiedDate($row, $params) {
		global $return_html;

		$mod_date = null;
		if (intval($row->modified) != 0) {
			$mod_date = mosFormatDate($row->modified);
		}
		if (($mod_date != '') AND $params->get('modifydate')) {
			$return_html .= '<div align="left" class="modifydate'.$params->get('pageclass_sfx').'">';
			$return_html .= _LAST_UPDATED.' ('.$mod_date.')</div>';
		}
	}

	/**
	* Writes Readmore Button
	*/
	function ReadMore($params, $link_on, $link_text) {
		global $return_html;

		if ($params->get('readmore')) {
			if ($params->get('intro_only') AND $link_text) {
				$return_html .= '<div style="width:100%;text-align:left"><a href="'.$link_on.'" class="readon'.$params->get('pageclass_sfx').'">';
				$return_html .= $link_text;
				$return_html .= '</a></div>';
			}
		}
	}

	/**
	* Writes Next & Prev navigation button
	*/
	function Navigation($row, $params) {
		global $return_html;

		if ($params->get('item_navigation') AND ($row->prev OR $row->next)) {
			$return_html .= '<table align="center" style="margin-top: 25px;"><tr>';
			if ($row->prev) {
				$return_html .= '<th class="pagenav_prev"><a href="'.$row->prev.'">'._ITEM_PREVIOUS.'</a></th>';
			}
			if ($row->prev AND $row->next) {
				$return_html .= '<td width="50">&nbsp;</td>';
			}
			if ($row->next) {
				$return_html .= '<th class="pagenav_next"><a href="'.$row->next.'">'._ITEM_NEXT.'</a></th>';
			}
			$return_html .= '</tr></table>';
		}
	}
}
?>