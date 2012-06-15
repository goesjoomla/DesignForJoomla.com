<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

function writeTools(){	
	global $site_tools_font,$site_tools_width;
	if($site_tools_font){?>
		<a href="javascript:void(0);" onclick="changeFontSize(1);return false;" class="font">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools/biggerFont.gif" alt="" title="Increase font size" />
		</a>
		<a href="javascript:void(0);" onclick="changeFontSize(-1);return false;" class="font">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools/smallerFont.gif" title="Decrease font size" alt=""/>
		</a>
		<a href="javascript:void(0);" onclick="revertStyles();return false;" class="font">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools/normalFont.gif" title="Revert font size to default" alt=""/>
		</a>	
		<br/>
	<?php };if($site_tools_width){?>
		<a href="javascript:void(0);" onclick="changeContainerWidth(767);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools/narrow.gif" title="View in 800x600 screen resolution" onclick="changeContainerWidth(767);" alt=""/>
		</a>		
		<a href="javascript:void(0);" onclick="changeContainerWidth(0);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools/autofit.gif" title="View in Auto Fit mode" onclick="changeContainerWidth(0);" alt=""/>
		</a>
		<a href="javascript:void(0);" onclick="changeContainerWidth(960);return false;">
			<img src="<?php echo _TEMPLATE_URL; ?>/images/sitetools/expand.gif" title="View in 1024x768 screen resolution" onclick="changeContainerWidth(960);" alt=""/>
		</a>
	<?php }} ?>