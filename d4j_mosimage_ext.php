<?php
/**
* D4J Image Extended mambot v1.5
*
* @copyright DesignForJoomla.com
*       Author`s email   : development@designforjoomla.com
*       Author`s hompage : http://designforjoomla.com
*
* @license GNU/GPL
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosImageExt' );

function botMosImageExt( $published, &$row, &$params, $page=0 ) {
	global $database;

 	// expression to search for
	$regex = '/{(mosimage)\s*(.*?)}/i';

	// check whether mosimage has been disabled for page or mambot has been unpublished
	if (!$published OR !$params->get( 'image' )) {
		$row->text = preg_replace( $regex, '', $row->text );
		return true;
	}

	//count how many {mosimage} are in introtext if it is set to hidden.
	$introCount=0;
	if ( !$params->get( 'introtext' ) AND !$params->get( 'intro_only') ) {
		preg_match_all( $regex, $row->introtext, $matches );
		$introCount = count ( $matches[0] );
	}

	// find all instances of mambot and put in $matches
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

 	// Number of mambots
	$count = isset($matches[0]) ? count($matches[0]) : 0;

 	// mambot only processes if there are any instances of the mambot in the text
 	if ( $count ) {
		// load mambot params info
		$query = "SELECT id FROM #__mambots WHERE element = 'd4j_mosimage_ext' AND folder = 'content'";
		$database->setQuery( $query );
	 	$id 	= $database->loadResult();
	 	$mambot = new mosMambot( $database );
	  	$mambot->load( $id );
	 	$botParams =& new mosParameters( $mambot->params );

	 	$botParams->def( 'margin', 5 );
	 	$botParams->def( 'padding', 5 );
	 	$botParams->def( 'process_menthod', 0 );
	 	$botParams->def( 'img_width', 128 );
	 	$botParams->def( 'img_height', 96 );
	 	$botParams->def( 'keep_ratio', 3 );
	 	$botParams->def( 'enable_enlarge', 1 );
	 	$botParams->def( 'enable_enlarge_text', 1 );
	 	$botParams->def( 'enlarge_text', 'Click to see real size' );
	 	$botParams->def( 'enlarge_text_position', 'below' );
	 	$botParams->def( 'enlarge_text_css', 'readon' );
	 	$botParams->def( 'max_width', 640 );
	 	$botParams->def( 'max_height', 480 );
	 	$botParams->def( 'show_print_link', 1 );
	 	$botParams->def( 'print_text', 'Print' );
	 	$botParams->def( 'show_close_link', 1 );
	 	$botParams->def( 'close_text', 'Close' );
	 	$botParams->def( 'print_close_css', 'readon' );

		if ( !defined( '_POP_UP' ) ) {
			define( "_POP_UP", '1' );
			echo '
<!-- Define MosImageExt_popup Function - Begin -->
<script language="JavaScript">
function MosImageExt_popup(URL, width, height, caption, caption_pos, caption_align) {
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
	if (window_width > width && window_height > height) {
		width = parseInt(width) + 10;
		height = parseInt(height) + '
		.(($botParams->get('show_print_link') OR $botParams->get('show_close_link')) ? 70 : 10)
		.';
	} else {
		width = parseInt('.$botParams->get( 'max_width' ).');
		height = parseInt('.$botParams->get( 'max_height' ).');
	}
	var left = Math.round((window_width - width) / 2);
	var top = Math.round((window_height - height) / 2);
	URL = \''
	.$GLOBALS['mosConfig_live_site']
	.'/\' + URL;
	day = new Date();
	id = day.getTime();
	self[\'popup_image_\'+id] = window.open(\'about:blank\',\'popup_image_\'+id,\'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=\' + width + \',height=\' + height + \',left=\' + left + \',top=\' + top);
	self[\'popup_image_\'+id].document.write(\'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; '
	._ISO
	.'" /><title>\'+caption+\'</title><link rel="stylesheet" type="text/css" media="all" href="'
	.$GLOBALS['mosConfig_live_site']
	.'/templates/'
	.$GLOBALS['cur_template']
	.'/css/template_css.css" title="green" /></head><body marginwidth="5" marginheight="5" topmargin="5" leftmargin="5"><center>'
	.'<div class="mosimage" align="center">'
	.'\'+((caption != \'\' && caption != "Image" && caption_pos == "top") ? \'<div class="mosimage_caption" style="text-align: \'+caption_align+\';" align="\'+caption_align+\'">\'+caption+\'</div>\' : \'\')+\''
	.'<img src="\'+URL+\'" border="0" style="margin:0" />'
	.'\'+((caption != \'\' && caption != "Image" && caption_pos == "bottom") ? \'<div class="mosimage_caption" style="text-align: \'+caption_align+\';" align="\'+caption_align+\'">\'+caption+\'</div>\' : \'\')+\''
	.'</div>'
	.(($botParams->get('show_print_link') OR $botParams->get('show_close_link')) ? '<br/>' : '')
	.($botParams->get('show_print_link') ? '<a href="javascript:void(0)" onclick="javascript:window.print(); return false">'.$botParams->get('print_text').'</a>' : '')
	.(($botParams->get('show_print_link') AND $botParams->get('show_close_link')) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '')
	.($botParams->get('show_close_link') ? '<a href="javascript:void(0)" onclick="javascript:window.close(); return false">'.$botParams->get('close_text').'</a>' : '')
	.'</center></body></html>\');
	self[\'popup_image_\'+id].document.close();
}
</script>
<!-- Define MosImageExt_popup Function - End -->
';
		}

 		$images 	= processImagesExt( $row, $botParams, $introCount, $matches );

		// store some vars in globals to access from the replacer
		$GLOBALS['botMosImageCount'] 	= 0;
		$GLOBALS['botMosImageParams'] 	=& $botParams;
		$GLOBALS['botMosImageArray'] 	=& $images;
		//$GLOBALS['botMosImageArray'] 	=& $combine;

		// perform the replacement
		$row->text = preg_replace_callback( $regex, 'botMosImageExt_replacer', $row->text );

		// clean up globals
		unset( $GLOBALS['botMosImageCount'] );
		unset( $GLOBALS['botMosImageParams'] );
		unset( $GLOBALS['botMosImageArray'] );

		return true;
	}
}

function MosImageExt_resizeImage(&$img_size, $w, $h, $keep_ratio, $process_menthod) {
	$new_x = $img_size[0];
	$new_y = $img_size[1];
	switch ($keep_ratio) {
		case '1': // fit predefined width
			if (
				($process_menthod == 0 AND $img_size[0] > $w)
				OR ($process_menthod == 1 AND $img_size[0] < $w)
				OR ($process_menthod == 2 AND $img_size[0] != $w)
			) {
				$new_x = $w;
				$size_ratio = (double) ($w / $img_size[0]);
				$new_y = (int) ($img_size[1] * $size_ratio);
			}
			break;
		case '2': // fit predefined height
			if (
				($process_menthod == 0 AND $img_size[1] > $h)
				OR ($process_menthod == 1 AND $img_size[1] < $h)
				OR ($process_menthod == 2 AND $img_size[1] != $h)
			) {
				$new_y = $h;
				$size_ratio = (double) ($h / $img_size[1]);
				$new_x = (int) ($img_size[0] * $size_ratio);
			}
			break;
		case '3': // fit both predefined width and height
			if (
				($process_menthod == 0 AND ($img_size[0] > $w OR $img_size[1] > $h))
				OR ($process_menthod == 1 AND ($img_size[0] < $w OR $img_size[1] < $h))
				OR ($process_menthod == 2 AND ($img_size[0] != $w OR $img_size[1] != $h))
			) {
				if ($process_menthod == 0) {
					if ($img_size[0] > $w AND $img_size[1] > $h) {
						if ( ($img_size[0] / $img_size[1]) > ($w / $h) ) {
							$new_x = $w;
							$size_ratio = (double) ($w / $img_size[0]);
							$new_y = (int) ($img_size[1] * $size_ratio);
						} elseif ( ($img_size[0] / $img_size[1]) < ($w / $h) ) {
							$new_y = $h;
							$size_ratio = (double) ($h / $img_size[1]);
							$new_x = (int) ($img_size[0] * $size_ratio);
						} else {
							$new_x = $w;
							$new_y = $h;
						}
					} elseif ($img_size[0] > $w) {
						$new_x = $w;
						$size_ratio = (double) ($w / $img_size[0]);
						$new_y = (int) ($img_size[1] * $size_ratio);
					} elseif ($img_size[1] > $h) {
						$new_y = $h;
						$size_ratio = (double) ($h / $img_size[1]);
						$new_x = (int) ($img_size[0] * $size_ratio);
					}
				} elseif ($process_menthod == 1) {
					if ($img_size[0] < $w AND $img_size[1] < $h) {
						if ( ($img_size[0] / $img_size[1]) > ($w / $h) ) {
							$new_x = $w;
							$size_ratio = (double) ($w / $img_size[0]);
							$new_y = (int) ($img_size[1] * $size_ratio);
						} elseif ( ($img_size[0] / $img_size[1]) < ($w / $h) ) {
							$new_y = $h;
							$size_ratio = (double) ($h / $img_size[1]);
							$new_x = (int) ($img_size[0] * $size_ratio);
						} else {
							$new_x = $w;
							$new_y = $h;
						}
					} elseif ($img_size[0] < $w) {
						$new_x = $w;
						$size_ratio = (double) ($w / $img_size[0]);
						$new_y = (int) ($img_size[1] * $size_ratio);
					} elseif ($img_size[1] < $h) {
						$new_y = $h;
						$size_ratio = (double) ($h / $img_size[1]);
						$new_x = (int) ($img_size[0] * $size_ratio);
					}
				} elseif ($process_menthod == 2) {
					if (
						($img_size[0] > $w AND $img_size[1] > $h)
						OR ($img_size[0] < $w AND $img_size[1] < $h)
					) {
						if ( ($img_size[0] / $img_size[1]) > ($w / $h) ) {
							$new_x = $w;
							$size_ratio = (double) ($w / $img_size[0]);
							$new_y = (int) ($img_size[1] * $size_ratio);
						} elseif ( ($img_size[0] / $img_size[1]) < ($w / $h) ) {
							$new_y = $h;
							$size_ratio = (double) ($h / $img_size[1]);
							$new_x = (int) ($img_size[0] * $size_ratio);
						} else {
							$new_x = $w;
							$new_y = $h;
						}
					} elseif ($img_size[0] > $w) {
						$new_x = $w;
						$size_ratio = (double) ($w / $img_size[0]);
						$new_y = (int) ($img_size[1] * $size_ratio);
					} elseif ($img_size[1] > $h) {
						$new_y = $h;
						$size_ratio = (double) ($h / $img_size[1]);
						$new_x = (int) ($img_size[0] * $size_ratio);
					}
				}
			}
			break;
		case '0': // fix to predefined width and height without keeping aspect ratio
		default:
			if (
				($process_menthod == 0 AND ($img_size[0] > $w OR $img_size[1] > $h))
				OR ($process_menthod == 1 AND ($img_size[0] < $w OR $img_size[1] < $h))
				OR ($process_menthod == 2 AND ($img_size[0] != $w OR $img_size[1] != $h))
			) {
				$new_x = $w;
				$new_y = $h;
			}
			break;
	}
	return array($new_x, $new_y);
}

function processImagesExt ( &$row, &$botParams, &$introCount, &$matches ) {
	$images 		= array();

	// split on \n the images fields into an array
	$row->images 	= explode( "\n", $row->images );
	$total 			= count( $row->images );

	$start = $introCount;
	for ( $i = $start; $i < $total; $i++ ) {
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
				$attrib[7] 	= '';
				$width 		= '';
			} else {
				$width 		= ' width: '. $attrib[7] .'px;';
			}

			// image size attibutes
			$size = '';
			if ( function_exists( 'getimagesize' ) ) {
				$size = @getimagesize( $GLOBALS['mosConfig_absolute_path'] .'/images/stories/'. $attrib[0] );
				if (is_array( $size )) {
					$img_size = 'width="'. $size[0] .'" height="'. $size[1] .'"';
					$prefered_width = isset($args['width']) ? $args['width'] : $botParams->get( 'img_width' );
					$prefered_height = isset($args['height']) ? $args['height'] : $botParams->get( 'img_height' );
					if ( $prefered_width > 0 OR $prefered_height > 0 ) {
						list($new_x, $new_y) = MosImageExt_resizeImage(&$size, $prefered_width, $prefered_height, $botParams->get( 'keep_ratio' ), $botParams->get( 'process_menthod' ));
						$img_size = 'width="'. $new_x .'" height="'. $new_y .'"';
						if (($new_x != $size[0] OR $new_y != $size[1]) AND $botParams->get( 'enable_enlarge' )) {
							if ($attrib[2] == 'Image') {
								$attrib[2] = $botParams->get( 'enlarge_text' );
							}
						}
					}
				}
			}

			// assemble the <image> tag
			$image = '<img src="'. $GLOBALS['mosConfig_live_site'] .'/images/stories/'. $attrib[0] .'" '. $img_size;
			// no aligment variable - if caption detected
			if ( !$attrib[4] ) {
				$image .= $attrib[1] ? ' align="'. $attrib[1] .'"' : '';
			}
			$image .=' hspace="6" alt="'. $attrib[2] .'" title="'. $attrib[2] .'" border="'. $border .'" />';

			// wrap with <a> tag if enable enlarge
			if (($new_x != $size[0] OR $new_y != $size[1]) AND $botParams->get( 'enable_enlarge' )) {
				$image = '<a target="_blank" href="'. $GLOBALS['mosConfig_live_site'] .'/images/stories/'. $attrib[0] .'" onclick="MosImageExt_popup(\'images/stories/'.$attrib[0]."','".($size[0])."','".($size[1])."','".$attrib[4]."','".$attrib[5]."','".$attrib[6].'\'); return false;">'.$image.'</a>';
			}

			// assemble caption - if caption detected
			if ( $attrib[4] ) {
				$caption = '<div class="mosimage_caption" style="'.$width.' text-align: '. $attrib[6] .';" align="'. $attrib[6] .'">';
				$caption .= $attrib[4];
				$caption .='</div>';
			}

			// final output
			$img = '<div class="mosimage" style="float: '. $attrib[1] .'; width: '.($attrib[3] + $botParams->get( 'margin' ) + $botParams->get( 'padding' ) + $new_x).'px; border-width: '. $attrib[3] .'px; margin: '. $botParams->get( 'margin' ) .'px; padding: '. $botParams->get( 'padding' ) .'px;" align="center">';

			// add enlarge text if set
			if (($new_x != $size[0] OR $new_y != $size[1]) AND $botParams->get( 'enable_enlarge_text' ) AND $botParams->get( 'enlarge_text_position' ) == 'above') {
				$img .= '<a class="'.$botParams->get( 'enlarge_text_css' ).'" target="_blank" href="'. $GLOBALS['mosConfig_live_site'] .'/images/stories/'. $attrib[0] .'" onclick="MosImageExt_popup(\'images/stories/'.$attrib[0]."','".($size[0])."','".($size[1])."','".$attrib[4]."','".$attrib[5]."','".$attrib[6].'\'); return false;">'.$botParams->get( 'enlarge_text' ).'</a><br/>';
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
			if (($new_x != $size[0] OR $new_y != $size[1]) AND $botParams->get( 'enable_enlarge_text' ) AND $botParams->get( 'enlarge_text_position' ) == 'below') {
				$img .= '<br/><a class="'.$botParams->get( 'enlarge_text_css' ).'" target="_blank" href="'. $GLOBALS['mosConfig_live_site'] .'/images/stories/'. $attrib[0] .'" onclick="MosImageExt_popup(\'images/stories/'.$attrib[0]."','".($size[0])."','".($size[1])."','".$attrib[4]."','".$attrib[5]."','".$attrib[6].'\'); return false;">'.$botParams->get( 'enlarge_text' ).'</a>';
			}

			$img .='</div>';

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
function botMosImageExt_replacer( &$matches ) {
	$i = $GLOBALS['botMosImageCount']++;

	return @$GLOBALS['botMosImageArray'][$i];
}
?>