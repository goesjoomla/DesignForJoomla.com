menuHover = function() {
	var menuEls = document.getElementById("mainmenu").getElementsByTagName("LI");
	for (var i=0; i<menuEls.length; i++) {
		menuEls[i].onmouseover=function() {
			this.className+=" menuhover";
		}
		menuEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" menuhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", menuHover);

// Removes leading and ending whitespaces
function trim(sInString) {
	sInString = sInString.replace(/^\s+/g, ''); // strip leading
	return sInString.replace(/\s+$/g, ''); // strip trailing
}

function pageHeaderStyle() {
	var pageDivs = document.getElementsByTagName('DIV');
	for (var i=0; i<pageDivs.length; i++) {
		if (pageDivs[i].className == 'componentheading') {
			pageDivs[i].innerHTML = '<div>' + trim(pageDivs[i].innerHTML) + '</div>';
			return;
		}
	}
}

function leftHeaderStyle() {
	var pageH3s = document.getElementById('left').getElementsByTagName('DIV');
	for (var i=0; i<pageH3s.length; i++) {
		pageH3s[i].innerHTML = '<h3>' + trim(pageH3s[i].innerHTML) + '</h3>';
	}
}

var prefsLoaded = false;
var defaultFont = 12;
var currentFont = defaultFont;

function revertStyles(){
	currentFont = defaultFont;
	changeFont(0);
}

function changeFont(sizeDifference){
	currentFont = parseInt(currentFont) + parseInt(sizeDifference);
	if(currentFont > 18){
		currentFont = 18;
	}else if(currentFont < 6){
		currentFont = 6;
	}
	setFont(currentFont);
}

function setFont(fontSize){
	document.body.style.fontSize = fontSize + 'px';
}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	} else expires = "";
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
	pageHeaderStyle();


	if(!prefsLoaded){
		userFont = readCookie("fontSize");
		currentFont = userFont ? userFont : defaultFont;
		setFont(currentFont);
		prefsLoaded = true;
	}
}

window.onunload = saveUserOptions;

function saveUserOptions(){
	if (currentFont != defaultFont)
		createCookie("fontSize", currentFont, 30);
}