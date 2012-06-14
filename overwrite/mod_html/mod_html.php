<?php
/*
(c) Copyright: www.fijiwebdesign.com. Distribution is prohibited!
*/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$html = $params->get( 'fwd_html' );

preg_match("/<script(.*)>(.*)<\/script>/", $html, $matches);
if ($matches) {
foreach ($matches as $i=>$match) {
  $clean_js = preg_replace("/<br \/>/", "", $match);
  $html = str_replace($match, $clean_js, $html);
                                }
}

echo $html;

 ?>
