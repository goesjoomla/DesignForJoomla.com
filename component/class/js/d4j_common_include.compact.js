if(typeof d4j_common_include_included=='undefined'){function clearChildNodes(node){while(node.hasChildNodes()){node.removeChild(node.firstChild);}}
function getTextNode(node){var txt="";if(node.nodeType==3)txt+=node.nodeValue;for(var i=0;i<node.childNodes.length;i++){txt+=getTextNode(node.childNodes[i]);}
return txt;}
function setTextNode(node,txt){clearChildNodes(node);var txtNode=document.createTextNode(txt);node.appendChild(txtNode);}
function addEvent(obj,evType,func){if(obj.addEventListener){obj.addEventListener(evType,func,false);return true;}else if(obj.attachEvent){var r=obj.attachEvent("on"+evType,func);return r;}else{return false;}}
document.getElementsByClassName=function(needle){var my_array=document.getElementsByTagName("*");var returns=new Array();var i,j;for(i=0,j=0;i<my_array.length;i++){var c=" "+my_array[i].className+" ";if(c.indexOf(" "+needle+" ")!=-1)returns[j++]=my_array[i];}
return returns;}
function getAllChildren(e){return e.all?e.all:e.getElementsByTagName('*');}
document.getElementsBySelector=function(selector){if(!document.getElementsByTagName){return new Array();}
var tokens=selector.split(' ');var currentContext=new Array(document);for(var i=0;i<tokens.length;i++){token=tokens[i].replace(/^\s+/,'').replace(/\s+$/,'');;if(token.indexOf('#')>-1){var bits=token.split('#');var tagName=bits[0];var id=bits[1];var element=document.getElementById(id);if(tagName&&element.nodeName.toLowerCase()!=tagName){return new Array();}
currentContext=new Array(element);continue;}
if(token.indexOf('.')>-1){var bits=token.split('.');var tagName=bits[0];var className=bits[1];if(!tagName){tagName='*';}
var found=new Array;var foundCount=0;for(var h=0;h<currentContext.length;h++){var elements;if(tagName=='*'){elements=getAllChildren(currentContext[h]);}else{elements=currentContext[h].getElementsByTagName(tagName);}
for(var j=0;j<elements.length;j++){found[foundCount++]=elements[j];}}
currentContext=new Array;var currentContextIndex=0;for(var k=0;k<found.length;k++){if(found[k].className&&found[k].className.match(new RegExp('\\b'+className+'\\b'))){currentContext[currentContextIndex++]=found[k];}}
continue;}
if(token.match(/^(\w*)\[(\w+)([=~\|\^\$\*]?)=?"?([^\]"]*)"?\]$/)){var tagName=RegExp.$1;var attrName=RegExp.$2;var attrOperator=RegExp.$3;var attrValue=RegExp.$4;if(!tagName){tagName='*';}
var found=new Array;var foundCount=0;for(var h=0;h<currentContext.length;h++){var elements;if(tagName=='*'){elements=getAllChildren(currentContext[h]);}else{elements=currentContext[h].getElementsByTagName(tagName);}
for(var j=0;j<elements.length;j++){found[foundCount++]=elements[j];}}
currentContext=new Array;var currentContextIndex=0;var checkFunction;switch(attrOperator){case'=':checkFunction=function(e){return(e.getAttribute(attrName)==attrValue);};break;case'~':checkFunction=function(e){return(e.getAttribute(attrName).match(new RegExp('\\b'+attrValue+'\\b')));};break;case'|':checkFunction=function(e){return(e.getAttribute(attrName).match(new RegExp('^'+attrValue+'-?')));};break;case'^':checkFunction=function(e){return(e.getAttribute(attrName).indexOf(attrValue)==0);};break;case'$':checkFunction=function(e){return(e.getAttribute(attrName).lastIndexOf(attrValue)==e.getAttribute(attrName).length-attrValue.length);};break;case'*':checkFunction=function(e){return(e.getAttribute(attrName).indexOf(attrValue)>-1);};break;default:checkFunction=function(e){return e.getAttribute(attrName);};}
currentContext=new Array;var currentContextIndex=0;for(var k=0;k<found.length;k++){if(checkFunction(found[k])){currentContext[currentContextIndex++]=found[k];}}
continue;}
tagName=token;var found=new Array;var foundCount=0;for(var h=0;h<currentContext.length;h++){var elements=currentContext[h].getElementsByTagName(tagName);for(var j=0;j<elements.length;j++){found[foundCount++]=elements[j];}}
currentContext=found;}
return currentContext;}
function getBackgroundColor(root){var bgColor='';if(typeof root.style!=''){if(typeof root.style.backgroundColor!='undefined'&&root.style.backgroundColor!=''){bgColor=root.style.backgroundColor;}}else if(typeof root.bgColor!='undefined'&&root.bgColor!=''){bgColor=root.bgColor;}else{bgColor=getBackgroundColor(root.parentNode);}
return bgColor;}
var d4j_common_include_included=1;}