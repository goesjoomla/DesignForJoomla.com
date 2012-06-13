<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// include D4J generic image library
require_once(_D4J_PRODUCT_FRONTEND_PATH.'/class/php/d4jGenericImage.php');

global $mosConfig_live_site, $cur_template;

if ( !defined( '_EZINE_JS_POPUP' ) ) {
	define( '_EZINE_JS_POPUP', '1' );
	$mainframe->addCustomHeadTag('
<!-- Define ezineMosImage_popup Function - Begin -->
<script type="text/javascript"><!-- // --><![CDATA[
function ezineMosImage_popup(URL, width, height, caption, caption_pos, caption_align) {
	if (typeof window_width == \'undefined\' || typeof window_height == \'undefined\') {
		var window_width;
		var window_height;
		if( typeof( window.innerWidth ) == \'number\' ) {
		  window_width = window.innerWidth;
		  window_height = window.innerHeight;
		} else if( document.documentElement &&
		    ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
		  window_width = document.documentElement.clientWidth;
		  window_height = document.documentElement.clientHeight;
		} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		  window_width = document.body.clientWidth;
		  window_height = document.body.clientHeight;
		}
	}
	var scroll = (window_width <= width || window_height <= height) ? 1 : 0;
	var resizable = (window_width <= width || window_height <= height) ? 1 : 0;
	width = (window_width <= width) ? '.intval($params->get('max_popup_width')).' : (parseInt(width) + 30);
	height = (window_height <= height) ? '.intval($params->get('max_popup_height')).' : (parseInt(height) + '.(($params->get('show_print_link') OR $params->get('show_close_link')) ? 60 : 30).');

	var left = Math.round((window_width - width) / 2);
	var top = Math.round((window_height - height) / 2);
	URL = \''
	.$mosConfig_live_site
	.'/\' + URL;
	day = new Date();
	id = day.getTime();
	self[\'popup_image_\'+id] = window.open(\'about:blank\',\'popup_image_\'+id,\'toolbar=0,location=0,statusbar=0,menubar=0,scrollbars=\' + scroll + \',resizable=\' + resizable + \',width=\' + width + \',height=\' + height + \',left=\' + left + \',top=\' + top);
	self[\'popup_image_\'+id].document.write(\'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; '
	._ISO
	.'" /><title>\'+caption+\'</title><link rel="stylesheet" type="text/css" media="all" href="'
	.$mosConfig_live_site
	.'/templates/'
	.$cur_template
	.'/css/template_css.css" /></head><body style="margin:10px 0"><center>'
	.'<div class="mosimage" align="center">'
	.'\'+((caption != \'\' && caption != "Image" && caption_pos == "top") ? \'<div class="mosimage_caption" style="text-align: \'+caption_align+\';" align="\'+caption_align+\'">\'+caption+\'</div>\' : \'\')+\''
	.'<img src="\'+URL+\'" border="0" style="margin:0" />'
	.'\'+((caption != \'\' && caption != "Image" && caption_pos == "bottom") ? \'<div class="mosimage_caption" style="text-align: \'+caption_align+\';" align="\'+caption_align+\'">\'+caption+\'</div>\' : \'\')+\''
	.'</div>'
	.(($params->get('show_print_link') OR $params->get('show_close_link')) ? '<br/>' : '')
	.($params->get('show_print_link') ? '<a href="javascript:void(0)" onclick="javascript:window.print(); return false">'.$params->get('print_text').'</a>' : '')
	.(($params->get('show_print_link') AND $params->get('show_close_link')) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '')
	.($params->get('show_close_link') ? '<a href="javascript:void(0)" onclick="javascript:window.close(); return false">'.$params->get('close_text').'</a>' : '')
	.'</center></body></html>\');
	self[\'popup_image_\'+id].document.close();
}
// ]]></script>
<!-- Define ezineMosImage_popup Function - End -->
');
}

function ezineMosImage( &$row, &$params ) {
	global $database;

 	// expression to search for
	$regex = '/{(mosimage)\s*(.*?)}/i';

	//count how many {mosimage} are in introtext if it is set to hidden.
	$introCount = 0;
	if ( !$params->get( 'introtext' ) AND !$params->get( 'intro_only') ) {
		preg_match_all( $regex, $row->introtext, $matches );
		$introCount = count ( $matches[0] );
	}

	// find all instances of mambot and put in $matches
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

 	// Number of mambots
	$count = isset( $matches[0] ) ? count( $matches[0] ) : 0;

 	// mambot only processes if there are any instances of the mambot in the text
 	if ( $count ) {
 		$images 	= ezineMosImage_processImages( $row, $params, $matches, $introCount );

		// store some vars in globals to access from the replacer
		$GLOBALS['botMosImageCount'] 	= 0;
		$GLOBALS['botMosImageParams'] 	=& $params;
		$GLOBALS['botMosImageArray'] 	=& $images;

		// perform the replacement
		$row->text = preg_replace_callback( $regex, 'ezineMosImage_replacer', $row->text );

		// clean up globals
		unset( $GLOBALS['botMosImageCount'] );
		unset( $GLOBALS['botMosImageParams'] );
		unset( $GLOBALS['botMosImageArray'] );

		return true;
	}
}

// create popup image HTML code
function ezineMosImage_popup($img_code, $attrib, $img_size, $caption = '') {
	global $mosConfig_live_site;
	$image = '<a href="'.$mosConfig_live_site.'/images/stories/'.$attrib[0].'" target="_blank" onclick="ezineMosImage_popup(\'images/stories/'. $attrib[0]."','".($img_size[0])."','".($img_size[1])."','".$caption."','top','left'".'); return false;">'.$img_code.'</a>';
	return $image;
}

function ezineMosImage_processImages ( &$row, &$params, &$matches, &$introCount ) {
	global $mosConfig_live_site;

	$images 		= array();

	// split on \n the images fields into an array
	$row->images 	= explode( "\n", $row->images );
	$total 			= count( $row->images );

	for ( $i = $introCount; $i < $total; $i++ ) {
		$img = trim( $row->images[$i] );

		// split on pipe the attributes of the image
		if ( $img ) {
			if (isset($matches[$i][2])) {
	 			parse_str( str_replace( '&amp;', '&', $matches[$i][2] ), $args );
	 		}

			$attrib = explode( '|', trim( $img ) );
			// $attrib[0] image name and path from /images/stories

			// $attrib[1] alignment
			if ( !isset($attrib[1]) || !$attrib[1] ) {
				$attrib[1] = '';
			}

			// $attrib[2] alt & title
			if ( !isset($attrib[2]) || !$attrib[2] ) {
				$attrib[2] = 'Image';
			} else {
				$attrib[2] = htmlspecialchars( $attrib[2] );
			}

			// $attrib[3] border
			if ( !isset($attrib[3]) || !$attrib[3] ) {
				$attrib[3] = '0';
			}

			// $attrib[4] caption
			if ( !isset($attrib[4]) || !$attrib[4] ) {
				$attrib[4]	= '';
				$border 	= $attrib[3];
			} else {
				$border 	= 0;
			}

			// $attrib[5] caption position
			if ( !isset($attrib[5]) || !$attrib[5] ) {
				$attrib[5] = '';
			}

			// $attrib[6] caption alignment
			if ( !isset($attrib[6]) || !$attrib[6] ) {
				$attrib[6] = '';
			}

			// $attrib[7] caption width
			if ( !isset($attrib[7]) || !$attrib[7] ) {
				$attrib[7] = '';
				$mosimage_cation_width = 0;
			} else {
				$mosimage_cation_width = $attrib[7];
			}

			// image size attibutes
			$img_size = '';
			$prefered_width = isset($args['width']) ? $args['width'] : $params->get( 'img_width' );
			$prefered_height = isset($args['height']) ? $args['height'] : $params->get( 'img_height' );
			$img_size_details = d4jGenericImage::resizeImage(_D4J_PRODUCT_FRONTEND_PATH.'/../../images/stories/'.$attrib[0], $prefered_width, $prefered_height, $params->get( 'keep_ratio' ), $params->get( 'process_menthod' ));
			$img_size = ' width="'.$img_size_details[1][0].'" height="'.$img_size_details[1][1].'"';
			if (($img_size_details[1][0] != $img_size_details[0][0] OR $img_size_details[1][1] != $img_size_details[0][1]) AND $params->get( 'enable_enlarge' )) {
				if ($attrib[2] == '' OR $attrib[2] == 'Image') {
					$attrib[2] = $params->get( 'enlarge_text' );
				}
			}
			$mosimage_width = $img_size_details[1][0] >= $mosimage_cation_width ? $img_size_details[1][0] : $mosimage_cation_width;
			$mosimage_cation_width = $mosimage_cation_width == 0 ? $mosimage_width : $mosimage_cation_width;
			// mosimage_width = (image_width OR caption_width) + (border_size * 2) + (padding * 2)
			$mosimage_width += ($attrib[3] * 2) + ($params->get( 'padding' ) * 2);

			// assemble the <image> tag
			$image = '<img src="'.$mosConfig_live_site.'/images/stories/'.$attrib[0].'"'.$img_size;
			if ($params->get( 'create_real_thumb' )) {
				$thumbPath = _D4J_PRODUCT_FRONTEND_PATH.'/../../'.$params->get( 'thumb_directory' ).'/'.preg_replace("/(\.\w{3,4})$/i", '_'.$img_size_details[1][0].'x'.$img_size_details[1][1].'.jpg', basename($attrib[0]));
				if (d4jGenericImage::createThumbnail(_D4J_PRODUCT_FRONTEND_PATH.'/../../images/stories/'.$attrib[0], $thumbPath, $img_size_details[1], $params->get('image_library'), $params->get('image_library_path'))) {
					$image = '<img src="'.$mosConfig_live_site.'/'.$params->get( 'thumb_directory' ).'/'.basename($thumbPath).'"'.$img_size;
				}
			}

			// no aligment variable - if caption detected
			if ( !$attrib[4] ) {
				$image .= $attrib[1] ? ' align="'. $attrib[1] .'"' : '';
			}
			$image .= ' alt="'. $attrib[2] .'" border="'. $border .'" />';

			// wrap with <a> tag if enable enlarge
			if (($img_size_details[1][0] != $img_size_details[0][0] OR $img_size_details[1][1] != $img_size_details[0][1]) AND $params->get( 'enable_enlarge' )) {
				$image = '<a target="_blank" href="'. $mosConfig_live_site .'/images/stories/'. $attrib[0] .'" onclick="ezineMosImage_popup(\'images/stories/'.$attrib[0]."','".$img_size_details[0][0]."','".$img_size_details[0][1]."','".$attrib[4]."','".$attrib[5]."','".$attrib[6].'\'); return false;">'.$image.'</a>';
			}

			// assemble caption - if caption detected
			if ( $attrib[4] ) {
				$caption = '<div class="mosimage_caption" style="'.(($attrib[1] == 'left' OR $attrib[1] == 'right') ? 'width:'.$mosimage_cation_width.'px; ' : '').'text-align: '. $attrib[6] .';" align="'. $attrib[6] .'">';
				$caption .= $attrib[4];
				$caption .='</div>';
			}

			// final output
			if ( $attrib[4] OR (($img_size_details[1][0] != $img_size_details[0][0] OR $img_size_details[1][1] != $img_size_details[0][1]) AND $params->get( 'enable_enlarge_text' )) ) {
				$img = '<div class="mosimage" style="'.(($attrib[1] == 'left' OR $attrib[1] == 'right') ? 'float: '.$attrib[1].'; width:'.$mosimage_width.'px; ' : '').(($attrib[1] == 'left' OR $attrib[1] == 'right' OR $attrib[1] == 'center') ? 'text-align:center; ' : '').'border-width: '. $attrib[3] .'px; margin'.($attrib[1] == 'left' ? '-right' : ($attrib[1] == 'right' ? '-left' : '')).': '. $params->get( 'margin' ) .'px; padding: '. $params->get( 'padding' ) .'px;">';
			} else {
				$img = '';
				$image = str_replace('" />', '" style="'.(($attrib[1] == 'left' OR $attrib[1] == 'right') ? 'float: '.$attrib[1].'; ' : '').'border-width: '. $attrib[3] .'px; margin'.($attrib[1] == 'left' ? '-right' : ($attrib[1] == 'right' ? '-left' : '')).': '. $params->get( 'margin' ) .'px;" />', $image);
			}

			// add enlarge text if set
			if (($img_size_details[1][0] != $img_size_details[0][0] OR $img_size_details[1][1] != $img_size_details[0][1]) AND $params->get( 'enable_enlarge_text' ) AND $params->get( 'enlarge_text_position' ) == 'above') {
				$img .= '<a class="'.$params->get( 'enlarge_text_css' ).'" target="_blank" href="'. $mosConfig_live_site .'/images/stories/'. $attrib[0] .'" onclick="ezineMosImage_popup(\'images/stories/'.$attrib[0]."','".$img_size_details[0][0]."','".$img_size_details[0][1]."','".$attrib[4]."','".$attrib[5]."','".$attrib[6].'\'); return false;">'.$params->get( 'enlarge_text' ).'</a><br/>';
			}

			if ( $attrib[4] ) {
				// display caption in top position
				if ( $attrib[5] == 'top' ) {
					$img .= $caption;
				}
			}

			$img .= $image;

			if ( $attrib[4] ) {
				// display caption in bottom position
				if ( $attrib[5] == 'bottom' ) {
					$img .= $caption;
				}
			}

			// add enlarge text if set
			if (($img_size_details[1][0] != $img_size_details[0][0] OR $img_size_details[1][1] != $img_size_details[0][1]) AND $params->get( 'enable_enlarge_text' ) AND $params->get( 'enlarge_text_position' ) == 'below') {
				$img .= '<br/><a class="'.$params->get( 'enlarge_text_css' ).'" target="_blank" href="'. $mosConfig_live_site .'/images/stories/'. $attrib[0] .'" onclick="ezineMosImage_popup(\'images/stories/'.$attrib[0]."','".$img_size_details[0][0]."','".$img_size_details[0][1]."','".$attrib[4]."','".$attrib[5]."','".$attrib[6].'\'); return false;">'.$params->get( 'enlarge_text' ).'</a>';
			}

			if ( $attrib[4] OR (($img_size_details[1][0] != $img_size_details[0][0] OR $img_size_details[1][1] != $img_size_details[0][1]) AND $params->get( 'enable_enlarge_text' )) ) {
				$img .='</div>';
			}

			$images[] = $img;
		}
	}

	return $images;
}

/**
* Replaces the matched tags an image
* @param array An array of matches (see preg_match_all)
* @return string
*/
function ezineMosImage_replacer( &$matches ) {
	$i = $GLOBALS['botMosImageCount']++;

	return @$GLOBALS['botMosImageArray'][$i];
}
?>