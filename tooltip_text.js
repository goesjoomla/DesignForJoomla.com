
function getImageTip(varName, desc){
	return '<p align="justify"><b>STATIC IMAGE</b><hr/>To change image here follow these steps:<br/>1. Login to your Mambo administration section<br/>2. Go to <b>Site</b> -> <b>Template Manager</b> -> <b>Site Templates</b><br/>3. In the template listing page, check the box beside the template name, then click the <b>Edit HTML</b> button at top of that page<br/>4. In the <b>Edit HTML</b> page, find the variable <b>$' + varName + '</b> in the text area and set its value to the absolute path from Mambo root directory or full URL to your logo image file<br/>5. Finally, click the <b>Save</b> button at top of the <b>Edit HTML</b> page</p>' + ((desc!=undefined)?'<br/><br/><b>Description</b>: ' + desc:'');
}

function getTextTip(varName, desc){
	return '<b>STATIC TEXT</b><hr/>To change text here follow these steps:<br/>1. Login to your Mambo administration section<br/>2. Go to <b>Site</b> -> <b>Template Manager</b> -> <b>Site Templates</b><br/>3. In the template listing page, check the box beside the template name then click the <b>Edit HTML</b> button at top of that page<br/>4. In the <b>Edit HTML</b> page, find the variable <b>$' + varName + '</b> in the text area and set its value to your copyright text<br/>5. Finally, click the <b>Save</b> button at top of the <b>Edit HTML</b> page' + ((desc!=undefined)?'<br/><br/><b>Description</b>: ' + desc:'');
}

function getPositionTip(positionName, desc){
	return '<b>STANDARD POSITION</b><hr/><b>Position Name</b>: ' + positionName + ((desc!=undefined)?'<br/><br/><b>Description</b>: ' + desc:'');
}

function getCustomPositionTip(positionName, desc){
	return '<b>CUSTOM POSITION</b><hr/><b>Position Name</b>: ' + positionName + '<br/><br/><b>Attention</b>: To create custom position  follow these steps:<br/>1. Login to your Mambo administration section<br/>2. Go to <b>Site</b> -> <b>Template Manager</b> -> <b>Module Positions</b><br/>3. In the <b>Module Positions</b> page, input new position name into any empty field in "Position" column (not "Description" one)<br/>4. Finally, click the <b>Save</b> button at top of the <b>Module Positions</b> page' + ((desc!=undefined)?'<br/><br/><b>Description</b>: ' + desc:'');
}

function getMainBodyTip(desc){
	return '<b>MAIN BODY</b><hr/>' + ((desc!=undefined)?'<br/><br/><b>Description</b>: ' + desc:'');
}

function getPathwayTip(desc){
	return '<b>PATH WAY</b><hr/>' + ((desc!=undefined)?'<br/><br/><b>Description</b>: ' + desc:'');	
}