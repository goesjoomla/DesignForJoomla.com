// Removes leading and ending whitespaces
function trim(sInString) {
	sInString = sInString.replace(/^\s+/g, ''); // strip leading
	return sInString.replace(/\s+$/g, ''); // strip trailing
}

function pageHeaderStyle() {
	var pageDivs = document.getElementsByTagName('DIV');
	var pageH3s  = document.getElementById('right').getElementsByTagName('H3');
	for (var i=0; i<pageDivs.length; i++) {
		if (pageDivs[i].className == 'componentheading'){
			pageDivs[i].innerHTML = '<h1>' + trim(pageDivs[i].innerHTML) + '</h1>' + '<h2>' + trim(pageDivs[i].innerHTML) + '</h2>';
			break;
		}
	}
	for (var i=0; i<pageH3s.length; i++) {
		pageH3s[i].innerHTML = '<h1>' + trim(pageH3s[i].innerHTML) + '</h1>' + '<h2>' + trim(pageH3s[i].innerHTML) + '</h2>';
	}
}


var prefsLoaded = false;


window.onload = setUserOptions;

function setUserOptions(){
	pageHeaderStyle();



	if(!prefsLoaded){
		prefsLoaded = true;
	}
}

