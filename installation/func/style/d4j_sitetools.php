<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

function writeTools(){	
	?>
		<a href="javascript:void(0);" onclick="changeFontSize(1);return false;" class="font">
			[A+]
		</a>
		<a href="javascript:void(0);" onclick="changeFontSize(-1);return false;" class="font">
			[A-]
		</a>
		<a href="javascript:void(0);" onclick="revertStyles();return false;" class="font">
			[A]
		</a>			
<?php } ?>