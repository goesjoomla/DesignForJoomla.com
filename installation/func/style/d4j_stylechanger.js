var prefsLoaded = false;
var defaultFontSize = 12;
var currentFontSize = defaultFontSize;
var minWidth = 810;
var maxWidth = 960;
var defaultContainerWidth = minWidth;
var currentContainerWidth = defaultContainerWidth;

var obj = document.getElementById('D4J_Container');

function revertStyles(){
	currentFontSize = defaultFontSize;
	changeFontSize(0);
}

function changeFontSize(sizeDifference){
	currentFontSize = parseInt(currentFontSize) + parseInt(sizeDifference);

	if(currentFontSize > 15){
		currentFontSize = 15;
	}else if(currentFontSize < 9){
		currentFontSize = 9;
	}

	setFontSize(currentFontSize);
	createCookie("fontSize", currentFontSize, 30);
};

function setFontSize(fontSize){	
	document.body.style.fontSize = fontSize + 'px';
};

function changeContainerWidth(newWidth) {	
	currentContainerWidth = parseInt(newWidth);
		
	if(currentContainerWidth == 0) {
		obj.style.width = '100%';
	}
	else {
		obj.style.width = currentContainerWidth + 'px';
	}
		template_width = "narrow";
	switch(currentContainerWidth){
		case minWidth:break;
		case maxWidth:template_width = "wide";break;
		default:template_width = "fit";
	}
	createCookie("containerWidth", template_width, 30);
};

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
};

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
};

window.onload = setUserOptions;

function setUserOptions(){
	if(!prefsLoaded){

		userFontSize = readCookie("fontSize");
		template_width = readCookie("containerWidth");
		switch(template_width){
			case "narrow":userContainerWidth = minWidth;break;
			case "wide":userContainerWidth = maxWidth;break;
			case "fit":
			default:userContainerWidth = 0;
		}
		currentFontSize = userFontSize ? userFontSize : defaultFontSize;
		setFontSize(currentFontSize);
		currentContainerWidth = userContainerWidth;
		changeContainerWidth(currentContainerWidth);

		prefsLoaded = true;
	}

}
