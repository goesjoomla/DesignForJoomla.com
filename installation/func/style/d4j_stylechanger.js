var prefsLoaded = false;
var defaultFontSize = 11;
var currentFontSize = defaultFontSize;
var defaultContainerWidth = 960;
var currentContainerWidth = defaultContainerWidth;
var defaultColor = 4;
var currentColor = defaultColor;

function changeColor(newColor){
    currentColor = parseInt(newColor)
        if (currentColor == 0) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_light_orange.css" />';
        } else if (currentColor == 1) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_light_violet.css" />';
        } else if (currentColor == 2) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_light_green.css" />';
        } else if (currentColor == 3) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_light_blue.css" />';
        } else if (currentColor == 4) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_orange.css" />';
        } else if (currentColor == 5) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_violet.css" />';
        } else if (currentColor == 6) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_green.css" />';
        } else if (currentColor == 7) {
        document.getElementsByTagName('BODY')[0].innerHTML += '<link rel="stylesheet" type="text/css" href="'+_TEMPLATE_URL+'/css/template_css_blue.css" />';
        }
}

function revertStyles(){

        currentFontSize = defaultFontSize;
        changeFontSize(0);

}
function changeFontSize(sizeDifference){
        currentFontSize = parseInt(currentFontSize) + parseInt(sizeDifference);

        if(currentFontSize > 18){
                currentFontSize = 18;
        }else if(currentFontSize < 6){
                currentFontSize = 6;
        }

        setFontSize(currentFontSize);
}

function setFontSize(fontSize){
        document.body.style.fontSize = fontSize + 'px';
}

function changeContainerWidth(newWidth) {
        var obj1 = document.getElementById('container');
        var obj2 = document.getElementById('box2');
        var obj3 = document.getElementById('box3');
        currentContainerWidth = parseInt(newWidth);
        if (currentContainerWidth == 0)
        {obj1.style.width = '96%';
        obj2.style.width = '97.45%';
        obj3.style.width = '97.38%';}
        else {obj1.style.width = currentContainerWidth + 'px';
              obj2.style.width = (currentContainerWidth-41) + 'px';
        if (currentContainerWidth == defaultContainerWidth)
        {}
        else {
        obj1.style.width=(currentContainerWidth)+'px';
        obj2.style.width=(currentContainerWidth-38)+'px';
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
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

window.onload = setUserOptions;

function setUserOptions(){
        if(!prefsLoaded){
                userFontSize = readCookie("fontSize");
                userContainerWidth = readCookie("containerWidth");
                                userColor = readCookie("color");
                currentFontSize = userFontSize ? userFontSize : defaultFontSize;
                setFontSize(currentFontSize);
                currentContainerWidth = userContainerWidth ? userContainerWidth : defaultContainerWidth;
                changeContainerWidth(currentContainerWidth);
                currentColor = userColor ? userColor : defaultColor;
                                changeColor(currentColor);
                prefsLoaded = true;
        }
}

window.onunload = saveUserOptions;

function saveUserOptions()
{
                createCookie("fontSize", currentFontSize, 30);
                createCookie("containerWidth", currentContainerWidth, 30);
                createCookie("color", currentColor, 30);
}