var prefsLoaded = false;
var defaultFontSize = 13;
var currentFontSize = defaultFontSize;
//var minWidth = 810;
//var maxWidth = 960;
//var defaultContainerWidth = minWidth;
//var currentContainerWidth = defaultContainerWidth;
var defaultColor = 0;
var currentColor = defaultColor;

var obj = document.getElementById('D4J_Container');

function changeColor(newColor){
	if(currentColor != parseInt(newColor)){
		currentColor = parseInt(newColor);
		createCookie("color", currentColor, 30);		
		window.location.reload();   		
	}
}

function revertStyles(){
	currentFontSize = defaultFontSize;
	changeFontSize(0);
}

function changeFontSize(sizeDifference){
	currentFontSize = parseInt(currentFontSize) + parseInt(sizeDifference);

	if(currentFontSize > 15){
		currentFontSize = 15;
	}else if(currentFontSize < 11){
		currentFontSize = 11;
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
		if(_SITE_TOOLS_WIDTH){
			template_width = readCookie("containerWidth");
			switch(template_width){
				case "narrow":userContainerWidth = minWidth;break;
				case "wide":userContainerWidth = maxWidth;break;
				case "fit":
				default:userContainerWidth = 0;
			}
			currentContainerWidth = userContainerWidth;
			changeContainerWidth(currentContainerWidth);
		}
		if(_SITE_TOOLS_FONT){
			userFontSize = readCookie("fontSize");
			currentFontSize = userFontSize ? userFontSize : defaultFontSize;
			setFontSize(currentFontSize);
		}
		if(_SITE_TOOLS_COLOR){
		userColor = readCookie("color");
		currentColor = userColor ? userColor : defaultColor;
		}
		
		prefsLoaded = true;
	}

}
