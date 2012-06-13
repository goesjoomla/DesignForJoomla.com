<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
function classifyHeading($module){
	ob_start();
	mosLoadModules($module,-2);
	$content = ob_get_contents();
	ob_end_clean();
	
	$patterns[0] = "/&lt;([^\s]+)\s+class=&quot;green&quot;&gt;([^\/]*)\/([^\s]+)&gt;/";
	$patterns[1] = "/&lt;([^\s]+)\s+class=&quot;grey&quot;&gt;([^\/]*)\/([^\s]+)&gt;/";
	$replaces[1] = "<\\1 class=\"green\">\\2</\\3>";
	$replaces[0] = "<\\1 class=\"grey\">\\2</\\3>";
	
	return str_replace('&lt;</', '</', preg_replace($patterns, $replaces, $content));
}
function writeTools(){	
	global $site_tools_font,$site_tools_width,$site_tools_color,$colors;
	if($site_tools_font){?>
		<a href="javascript:void(0);" onclick="changeFontSize(1);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/biggerFont.gif" alt="" title="Increase font size" />
		</a>
		<a href="javascript:void(0);" onclick="changeFontSize(-1);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/smallerFont.gif" title="Decrease font size" alt=""/>
		</a>
		<a href="javascript:void(0);" onclick="revertStyles();return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/normalFont.gif" title="Revert font size to default" alt=""/>
		</a>	
	<?php };if($site_tools_width){?>
		<a href="javascript:void(0);" onclick="changeContainerWidth(<?php echo _d4j_minWidth;?>);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/narrow.gif" title="View in 800x600 screen resolution" alt=""/>
		</a>
		<a href="javascript:void(0);" onclick="changeContainerWidth(0);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/autofit.gif" title="View in Full screen resolution" alt=""/>
		</a>		
		<a href="javascript:void(0);" onclick="changeContainerWidth(<?php echo _d4j_maxWidth;?>);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/expand.gif" title="View in 1024x768 screen resolution" alt=""/>
		</a>
	<?php };if($site_tools_color){
		for($i=0;$i<count($colors);$i++){		
	?>
		<a href="javascript:void(0);" onclick="changeColor(<?php echo $i;?>);return false;" class="color">
			<img name="<?php echo $colors[$i];?>" src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/<?php echo $colors[$i];?>.gif" alt="Change to <?php echo $colors[$i];?> color" border="0"/>
		</a>
	<?php }	}
} ?>