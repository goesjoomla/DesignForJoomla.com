showTips = function(elm) {
	for (var i=0; i < elm.childNodes.length; i++) {
		if (elm.childNodes[i].className=='tips') {
			document.getElementById('tips').innerHTML=elm.childNodes[i].innerHTML;
			break;
		}
	}
}
clearTips = function() {
	document.getElementById('tips').innerHTML='';
}
sfHover = function() {
	var sfEls = document.getElementById("mainmenu").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);