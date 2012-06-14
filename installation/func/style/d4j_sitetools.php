<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

function writeTools(){
        global $site_tools_font;
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
        <?php }} ?>