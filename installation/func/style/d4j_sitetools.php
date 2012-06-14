<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
global $defaultContainerWidth,$maxWidth;

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
		<a href="javascript:void(0);" onclick="changeContainerWidth(954);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/narrow.gif" title="View in 800x600 screen resolution" alt=""/>
		</a>
		<a href="javascript:void(0);" onclick="changeContainerWidth(0);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/autofit.gif" title="View in Full screen resolution" alt=""/>
		</a>		
		<a href="javascript:void(0);" onclick="changeContainerWidth(960);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/site_tools/expand.gif" title="View in 1024x768 screen resolution" alt=""/>
		</a>
	<?php }} ?>