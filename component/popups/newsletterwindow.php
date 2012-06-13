<?php
/**
* eZine component :: newsletter preview popup
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$iso = split( '=', _ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Newsletter Preview</title>
	<script>
		var form = window.opener.document.adminForm
		var alltext = form.newsletter_content.value;
		var theme = form.template_name.value;
		document.write('<link rel="stylesheet" href="../templates/'+theme+'/css/template_css.css" type="text/css" />');
		document.write('<link rel="stylesheet" href="../components/<?php echo $option; ?>/css/ezine.css" type="text/css" />');
	</script>
</head>
<body>
<script>
	document.write(alltext);
</script>
</body>
</html>