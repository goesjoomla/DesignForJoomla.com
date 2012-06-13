<?php
/* ==========================================================
     Design for Joomla php common ajax engine v1.0

     Author  : Nguyen Manh Cuong
     Email   : cuongnm@designforjoomla.com
     Homepage: http://designforjoomla.com
========================================================== */

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!defined('_D4J_AJAX_ENGINE_INCLUDED')) {
	define('_D4J_AJAX_ENGINE_INCLUDED', 1);

	class d4j_ajax_engine {
		// response type, either XML or TEXT
		var $response_type = 'XML';
		var $response_node = 'ajaxResponse'; // XML root node
		// response node attribute
		var $response_node_attribute = Array();
		// character encode
		var $char_encode = 'UTF-8';

		function d4j_ajax_engine( $charEncode = '' ) {
			if ($charEncode != '') {
				$this->char_encode = strtoupper($charEncode);
			} elseif (defined('_ISO')) { // get the constant defined in Joomla language file
				$iso = explode('=', _ISO, 2);
				$this->char_encode = strtoupper($iso[1]);
			}
		}

		function setAttribute($name, $value) { // function to set response node attribute
			$this->response_node_attribute[$name] = $value;
		}

		function writeAttribute() {
			$attributes = '';
			foreach ($this->response_node_attribute AS $k => $v) {
				$attributes .= "$k=\"$v\" ";
			}
			return trim($attributes);
		}

		function decode($data) {
			// convert string
			if (function_exists('iconv')) {
				// iconv is by far the most flexible approach, try this first
				$return_value = iconv('UTF-8', $this->char_encode, $data);
			} elseif ($this->char_encode == 'ISO-8859-1') {
				// for ISO-8859-1 we can use utf8-decode()
				$return_value = utf8_decode($data);
			} else {
				// give up. if data was supplied in the correct format everything is fine!
				$return_value = $data;
			} /* end: if */
			return $return_value;
		}

		function decode_array($data) {
			$return_value = array();
			foreach ($data as $key => $value) {
				if (!is_array($value)) {
					$return_value[$key] = $this->decode($value);
				} else {
					$return_value[$key] = $this->decode_array($value);
				}
			}
			return $return_value;
		}

		// Function to return data to client-side ajax engine
		function return_data() {
			// open output buffer so no output is sent back to the client
			ob_start();

			if (count($_GET) AND isset($_GET['func'])) { // GET menthod in use
				$pairs = $this->decode_array( $_GET );
			} elseif (count($_POST) AND isset($_POST['func'])) { // POST menthod in use
				$pairs = $this->decode_array( $_POST );
			}

			if (isset($pairs['response_type'])) // if response type is passed, update
				$this->response_type = $pairs['response_type'];
			if (isset($pairs['response_node'])) // if response node is passed, update
				$this->response_node = $pairs['response_node'];

			if (!isset($pairs['func'])) // handle function not passed, return error msg
				$data = 'Call without server-side handle function';
			else {
				$func = $pairs['func'];
				if (!function_exists($func)) // handle function not exist, return error msg
					$data = 'Requested server-side handle function not defined';
				else { // call the server-side function with passed variables to get the return data
					unset($pairs['response_node']);
					unset($pairs['response_type']);
					unset($pairs['func']);
					$data = $func( $pairs );
				}
			}
			$returns = $this->response_type == 'XML' ? '<'.$this->response_node.(count($this->response_node_attribute) ? ' '.$this->writeAttribute() : '').'>' : '';
			$returns .= $data;
			$returns .= $this->response_type == 'XML' ? '</'.$this->response_node.'>' : '';

			// delete output buffer
			ob_end_clean();

			// send appropriate headers to avoid caching
			header ('Expires: Fri, 14 Mar 1980 20:53:00 GMT');
			header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			header ('Cache-Control: no-cache, must-revalidate');
			header ('Pragma: no-cache');
			header ('Content-type: text/' . ($this->response_type == 'XML' ? 'xml' : 'plain') . '; charset=' . $this->char_encode);
			if ($this->response_type == 'XML')
				echo '<?xml version="1.0" encoding="' . $this->char_encode . '"?>'."\n";

			echo $returns;
		}
	}

	if (file_exists(dirname(__FILE__).'/d4j_ajax_pagenav.php'))
		require_once(dirname(__FILE__).'/d4j_ajax_pagenav.php');
}
?>