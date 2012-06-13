var prefsLoaded = false;
var defaultFontSize = 11;
var currentFontSize = defaultFontSize;
var minWidth = 820;
var maxWidth = 960;
var defaultContainerWidth = minWidth;
var currentContainerWidth = defaultContainerWidth;

function revertStyles(){
	currentFontSize = defaultFontSize;
	changeFontSize(0);
}

function changeFontSize(sizeDifference){
	currentFontSize = parseInt(currentFontSize) + parseInt(sizeDifference);

	if(currentFontSize > 13){
		currentFontSize = 13;
	}else if(currentFontSize < 9){
		currentFontSize = 9;
	}

	setFontSize(currentFontSize);
};

function setFontSize(fontSize){	
	document.body.style.fontSize = fontSize + 'px';
};

function changeContainerWidth(newWidth) {
	var obj = document.getElementById('D4J_Container');
	var objLeftSide = document.getElementById("D4J_LeftSide");
	var objHeader = document.getElementById('D4J_Header');
	
	currentContainerWidth = parseInt(newWidth);
		
	if(currentContainerWidth == 0) {
		obj.style.width = '100%';
		objHeader.style.background = 'url('+_TEMPLATE_URL+'/images/img02_2.jpg) repeat';
	}
	else {
		obj.style.width = currentContainerWidth + 'px';
		//objLeftSide.style.marginLeft = '1.5%';
		if(currentContainerWidth == maxWidth) {
			objHeader.style.background = 'url('+_TEMPLATE_URL+'/images/img02_2.jpg) no-repeat';
		}
	}
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
		userContainerWidth = readCookie("containerWidth");		

		currentFontSize = userFontSize ? userFontSize : defaultFontSize;
		setFontSize(currentFontSize);
		currentContainerWidth = userContainerWidth ? userContainerWidth : defaultContainerWidth;
		changeContainerWidth(currentContainerWidth);		

		prefsLoaded = true;
	}

}

window.onunload = saveUserOptions;

function saveUserOptions()
{
	createCookie("fontSize", currentFontSize, 30);
	createCookie("containerWidth", currentContainerWidth, 30);		
	
}
