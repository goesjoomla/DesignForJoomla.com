var prefsLoaded = false;
var defaultFontSize = 13;
var currentFontSize = defaultFontSize;
var defaultColor = 0;
var currentColor = defaultColor;

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

	if(currentFontSize > 17){
		currentFontSize = 17;
	}else if(currentFontSize < 10){
		currentFontSize = 10;
	}

	setFontSize(currentFontSize);
};

function setFontSize(fontSize){
	document.body.style.fontSize = fontSize + 'px';
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
		currentFontSize = userFontSize ? userFontSize : defaultFontSize;
		setFontSize(currentFontSize);		
		prefsLoaded = true;
	}

}

window.onunload = saveUserOptions;

function saveUserOptions()
{
	createCookie("fontSize", currentFontSize, 30);
}
