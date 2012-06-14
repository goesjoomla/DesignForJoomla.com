function imgEffect()
{	
	if(document.getElementById('right')){
		var rightImgs  = document.getElementById('right').getElementsByTagName('IMG');
		for (var i=0; i<rightImgs.length; i++)
		{
			rightImgs[i].onmouseover = enlargeImg;
			rightImgs[i].onmouseout = hideImg;
		}
	}
}
function hideImg(evnt)
{
	obj=document.getElementById? document.getElementById("showimage") : document.all.showimage;
	obj.style.visibility="hidden";
}
function enlargeImg(evt) {
	var ie=document.all;
	crossobj=document.getElementById? document.getElementById("showimage") : document.all.showimage
	if(ie)
	{
    evt = (evt) ? evt : ((window.event) ? event : null);
    if (evt) {
       var elem = (evt.target) ? evt.target : 
          ((evt.srcElement) ? evt.srcElement : null);
       if (elem ) {
           enlarge(elem.src,evt);
		   
       }
    }
	}
	else//if it FireFox
	{
			enlarge(evt.target.src,evt);
	}
}
var ie=document.all
var ns6=document.getElementById&&!document.all
function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat" && !window.opera)? document.documentElement : document.body
}
function enlarge(which,e){
if (ie||ns6){
crossobj=document.getElementById? document.getElementById("showimage") : document.all.showimage

var horzpos=ns6? pageXOffset+e.clientX : ietruebody().scrollLeft+event.clientX
var vertpos=ns6? pageYOffset+e.clientY : ietruebody().scrollTop+event.clientY

crossobj.style.left=horzpos+"px"
crossobj.style.top=vertpos+"px"

crossobj.innerHTML='<div align="right" id="dragbar"></div><img src="'+which+'">'
crossobj.style.visibility="visible"
return false
}
else 
return true
}

var prefsLoaded = false;


window.onload = setUserOptions;

function setUserOptions(){
	imgEffect();

	if(!prefsLoaded){
		prefsLoaded = true;
	}
}