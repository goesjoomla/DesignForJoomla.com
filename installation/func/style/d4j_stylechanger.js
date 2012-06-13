var prefsLoaded = false;
var defaultFontSize = 12;
var currentFontSize = defaultFontSize;
var minWidth = 767;
var maxWidth = 960;
var defaultContainerWidth = minWidth;
var currentContainerWidth = defaultContainerWidth;

function revertStyles(){
	currentFontSize = defaultFontSize;
	changeFontSize(0);
}

function changeFontSize(sizeDifference){
	currentFontSize = parseInt(currentFontSize) + parseInt(sizeDifference);

	if(currentFontSize > 14){
		currentFontSize = 14;
	}else if(currentFontSize < 9){
		currentFontSize = 9;
	}

	setFontSize(currentFontSize);
};

function setFontSize(fontSize){
	document.body.style.fontSize = fontSize + 'px';
};

function changeContainerWidth(newWidth) {
	var obj1 = document.getElementById('D4J_Container_Out');
	var obj2 = document.getElementById('D4J_Container_In');
	var obj3 = document.getElementById('D4J_Container_In2');
	var objLeft = document.getElementById('D4J_Left');	
	var objRight = document.getElementById('D4J_Right');	
	var objImage = document.getElementById('bigimage');	
	var objHeader = document.getElementById('D4J_Header');											
	currentContainerWidth = parseInt(newWidth);
	
	if(objImage != null && typeof objImage != 'undefined') objImage.style.width = (currentContainerWidth -138)+ 'px';
	objHeader.style.width = (currentContainerWidth -138)+ 'px';
	obj1.style.width = currentContainerWidth + 'px';					
	obj2.style.width = (currentContainerWidth -72)+ 'px';					
	obj3.style.backgroundPosition = (currentContainerWidth-72)*0.69-1 +"px 0";		
	if(currentContainerWidth == 960) objLeft.style.width = "58%";
	else objLeft.style.width = "55.01%";
	if(_noRightCol){
		objLeft.style.width = (currentContainerWidth -170)+ 'px';
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
