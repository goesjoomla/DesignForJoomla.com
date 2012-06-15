var prefsLoaded = false;
var defaultFontSize = 16;
var currentFontSize = defaultFontSize;
var defaultContainerWidth = 764;
var currentContainerWidth = defaultContainerWidth;

function revertStyles(){

	currentFontSize = defaultFontSize;
	changeFontSize(0);

}

function changeFontSize(sizeDifference){
	currentFontSize = parseInt(currentFontSize) + parseInt(sizeDifference);

	if(currentFontSize > 20){
		currentFontSize = 20;
	}else if(currentFontSize < 12){
		currentFontSize = 12;
	}

	setFontSize(currentFontSize);
};

function setFontSize(fontSize){
	document.body.style.fontSize = fontSize + 'px';
};

function changeContainerWidth(newWidth) {
	var obj1 = document.getElementById('Jcontainer');
	currentContainerWidth = parseInt(newWidth);
	if (currentContainerWidth == 0)
	{
		obj1.style.width = '100%';		
	}
	else 
	{
		obj1.style.width = currentContainerWidth + 'px';					
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
