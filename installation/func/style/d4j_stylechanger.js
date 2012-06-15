var prefsLoaded = false;
var defaultFontSize = 13;
var currentFontSize = defaultFontSize;
var defaultContainerWidth = 960;
var currentContainerWidth = defaultContainerWidth;

function revertStyles(){

	currentFontSize = defaultFontSize;
	changeFontSize(0);

}

function changeFontSize(sizeDifference){
	currentFontSize = parseInt(currentFontSize) + parseInt(sizeDifference);

	if(currentFontSize > 18){
		currentFontSize = 18;
	}else if(currentFontSize < 10){
		currentFontSize = 10;
	}

	setFontSize(currentFontSize);
};

function setFontSize(fontSize){
	document.body.style.fontSize = fontSize + 'px';
	var obj = document.getElementById('toplink');
	obj.style.fontSize = (parseInt(fontSize) + 7) + 'px';
};

function changeContainerWidth(newWidth) {
	var obj1 = document.getElementById('Jcontainer');
	var obj2 = document.getElementById('Jright');
	currentContainerWidth = parseInt(newWidth);
	if (currentContainerWidth == 0)
	{
		obj1.style.width = '96%';		
		if(_noRightCol)
		{			
			obj2.style.width = '96%';				
		}
	}
	else 
	{
		obj1.style.width = currentContainerWidth + 'px';	
		if(_noRightCol)
		{			
			obj2.style.width = (currentContainerWidth-55) + 'px';				
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
