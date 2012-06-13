var backend_script='index3.php?option=com_ezine&task=ajaxcall&no_html=1'
var processing=mosConfig_live_site+'/components/com_ezine/class/images/loadingcircle.gif'
var closeImg='../components/com_ezine/class/images/close.png'
var dirImg='../components/com_ezine/class/images/folder.gif'
var ajax_engine=new d4j_ajax_engine()
ajax_engine.setMenthod('post')
ajax_engine.setResponseType('xml')
ajax_engine.setResponseUpdate('function')
ajax_engine.setDebug(false)
function call_toggle(where,id,action,value,isDBTableCol){
if(action=='type_of_more_cat_news' || action=='cover_output'){
swapElementStatus(action+'_'+id,false,'','processing...')
}else{
swapElementStatus(action+'_'+id,true,'',processing)}
ajax_engine.sendRequest(backend_script,response_toggle,'func=toggle','where='+where,'id='+id,'action='+action,'value='+value,'isDBTableCol='+isDBTableCol)}
function response_toggle(result){
var ret=result.getElementsByTagName('ajaxResponse').item(0)
var act=ret.getAttribute('action')
var aid=ret.getAttribute('affected')
var id=act+'_'+aid
if(ret.getAttribute('valid')=='false'){
alert(ret.firstChild.data)
if(act=='type_of_more_cat_news' || act=='cover_output'){
swapElementStatus(document.getElementById(id),false,'','processing...')
}else{
swapElementStatus(document.getElementById(id),true,'',processing)}
}else{
if(act=='type_of_more_cat_news'){
document.getElementById(id).innerHTML=ret.firstChild.data
}else if(act=='cover_output'){
if(ret.firstChild.data=='joomla'){
swapElementStatus(document.getElementById(id),false,'Joomla Part','processing...')
}else{
swapElementStatus(document.getElementById(id),false,'Stand Alone','processing...')}
}else{
if(ret.firstChild.data==0){
swapElementStatus(document.getElementById(id),true,'images/publish_x.png',processing)
}else{
swapElementStatus(document.getElementById(id),true,'images/tick.png',processing)}}}}
function call_update(where,id,action,value,isDBTableCol){
value=value.replace('<a>','')
value=value.replace('</a>','')
if(action=='more_cat_news_img' || action=='cat_title_img' || action=='cover_image' || action=='cover_html' || action=='cover_auto_redirect'){
if(action !='cover_auto_redirect'&&action !='cover_html'){
document.getElementById(action+'_'+id+'_form').style.display='none'}
if(document.getElementById(action+'_'+id)){
swapElementStatus(action+'_'+id,true,'',processing)}
}else{
if(action=='order_news_by' || action=='leading_thumbnail_position' || action=='intro_thumbnail_position'){
document.getElementById(action+'_'+id+'_form').style.display='none'}
swapElementStatus(action+'_'+id,false,'','processing...')}
ajax_engine.sendRequest(backend_script,response_update,'func=update','where='+where,'id='+id,'action='+action,'value='+value,'isDBTableCol='+isDBTableCol)}
function response_update(result){
var ret=result.getElementsByTagName('ajaxResponse').item(0)
var act=ret.getAttribute('action')
var aid=ret.getAttribute('affected')
var id=act+'_'+aid
if(ret.getAttribute('valid')=='false'){
alert(ret.firstChild.data)
if(act=='more_cat_news_img' || act=='cat_title_img' || act=='cover_image' || act=='cover_html' || act=='cover_auto_redirect'){
if(document.getElementById(id)){
swapElementStatus(id,true,'',processing)}
}else{
swapElementStatus(id,false,'','processing...')}
}else{
if(act=='more_cat_news_img' || act=='cat_title_img' || act=='cover_image' || act=='cover_html' || act=='cover_auto_redirect'){
if(document.getElementById(id)){
if(ret.firstChild.data=='-'){
swapElementStatus(id,true,'images/publish_x.png',processing)
if(document.getElementById(id+'_value')){
document.getElementById(id+'_value').value=''}
}else{
swapElementStatus(id,true,'images/tick.png',processing)
if(document.getElementById(id+'_value')){
document.getElementById(id+'_value').value=ret.firstChild.data}}
}else{
document.getElementById(id+'_value').value=ret.firstChild.data=='-' ? '' : ret.firstChild.data}
}else if(act=='order_news_by'){
if(ret.firstChild.data=='date'){
swapElementStatus(id,false,'Oldest first','processing...')
}else if(ret.firstChild.data=='rdate'){
swapElementStatus(id,false,'Most recent first','processing...')
}else if(ret.firstChild.data=='alpha'){
swapElementStatus(id,false,'Title Alphabetical','processing...')
}else if(ret.firstChild.data=='ralpha'){
swapElementStatus(id,false,'Title Reverse-Alphabetical','processing...')
}else if(ret.firstChild.data=='author'){
swapElementStatus(id,false,'Author Alphabetical','processing...')
}else if(ret.firstChild.data=='rauthor'){
swapElementStatus(id,false,'Author Reverse-Alphabetical','processing...')
}else if(ret.firstChild.data=='hits'){
swapElementStatus(id,false,'Most Hits','processing...')
}else if(ret.firstChild.data=='rhits'){
swapElementStatus(id,false,'Least Hits','processing...')
}else if(ret.firstChild.data=='order'){
swapElementStatus(id,false,'Ordering','processing...')
}else{
swapElementStatus(id,false,'Most recent first','processing...')}
}else if(act=='leading_thumbnail_position' || act=='intro_thumbnail_position'){
if(ret.firstChild.data=='left'){
swapElementStatus(id,false,'Left-side','processing...')
}else if(ret.firstChild.data=='right'){
swapElementStatus(id,false,'Right-side','processing...')
}else if(ret.firstChild.data=='above_title'){
swapElementStatus(id,false,'Above Title','processing...')
}else if(ret.firstChild.data=='above_intro'){
swapElementStatus(id,false,'Above Intro','processing...')
}else if(ret.firstChild.data=='below_intro'){
swapElementStatus(id,false,'Below Intro','processing...')
}else if(ret.firstChild.data=='below_readon'){
swapElementStatus(id,false,'Below Read More','processing...')
}else{
swapElementStatus(id,false,'Joomla Default','processing...')}
}else{
swapElementStatus(id,false,ret.firstChild.data,'processing...')}
if(document.getElementById('current_cover_path')){
if(ret.firstChild.data=='-'){
document.getElementById('current_cover_path').innerHTML=''
}else{
document.getElementById('current_cover_path').innerHTML=ret.firstChild.data}}}}
function call_listDir(action,id,dir){
swapElementStatus(action+'_'+id+'_close',true,'',processing)
document.getElementById(action+'_'+id+'_remove').title=document.getElementById(action+'_'+id+'_value').value
ajax_engine.sendRequest(backend_script,response_listDir,'func=listDir','action='+action,'id='+id,'dir='+dir)}
function response_listDir(result){
var ret=result.getElementsByTagName('ajaxResponse').item(0)
var act=ret.getAttribute('action')
var aid=ret.getAttribute('affected')
var id=act+'_'+aid
if(ret.getAttribute('valid')=='false'){
alert(ret.firstChild.data)
document.getElementById(id+'_list').innerHTML=document.getElementById('old_value').innerHTML
if(document.getElementById(id+'_form').style.display=='none'){
PopupPosition(document.getElementById(id+'_form'),350,350)}
}else{
var listDir=''
var listFile=''
var dirs=result.getElementsByTagName('dir')
for(var i=0;i<dirs.length;i++){
if(dirs[i].firstChild.data.substr(dirs[i].firstChild.data.length-2,dirs[i].firstChild.data.length)=='..'){
listDir+='<span class="folder"><a href="javascript: void(0)" onclick="call_listDir(\''+act+'\','+aid+',\''+dirs[i].firstChild.data+'\');"><img src="'+'images/restore_f2.png" border="0" width="15" height="15" /></a></span><br/>'
}else{
listDir+='<span class="folder"><a href="javascript: void(0)" onclick="call_listDir(\''+act+'\','+aid+',\''+dirs[i].firstChild.data+'\');">'+dirs[i].firstChild.data+'</a></span><br/>'}}
var files=result.getElementsByTagName('file')
for(var i=0;i<files.length;i++){
if(act=='cover_image'){
listFile=listFile+'<span class="file"><a href="javascript: void(0)" onclick="call_update(\'page\','+aid+',\''+act+'\',\''+'images'+files[i].firstChild.data+'\',0); return nd();" onmouseover="showImage(\'Preview\',\''+'../images'+files[i].firstChild.data+'\')" onmouseout="return nd();">'+files[i].firstChild.data+'</a></span><br/>'
}else{
listFile=listFile+'<span class="file"><a href="javascript: void(0)" onclick="call_update(\'category\','+aid+',\''+act+'\',\''+'images'+files[i].firstChild.data+'\',0); return nd();" onmouseover="showImage(\'Preview\',\''+'../images'+files[i].firstChild.data+'\')" onmouseout="return nd();">'+files[i].firstChild.data+'</a></span><br/>'}}
document.getElementById(id+'_list').innerHTML=listDir+listFile
if(document.getElementById(id+'_form').style.display=='none'){
PopupPosition(document.getElementById(id+'_form'),350,350)}}
swapElementStatus(id+'_close',true,closeImg,processing)}
function call_linkToMenu(id,menu_name,published,frontpage){
swapElementStatus('link_to_menu_'+id,false,'','processing...')
ajax_engine.sendRequest(backend_script,response_linkToMenu,'func=linkToMenu','id='+id,'menu_name='+menu_name,'published='+published,'frontpage='+frontpage)}
function response_linkToMenu(result){
var ret=result.getElementsByTagName('ajaxResponse').item(0)
var act=ret.getAttribute('action')
var aid=ret.getAttribute('affected')
var id='link_to_menu_'+aid
if(ret.getAttribute('valid')=='false'){
alert(ret.firstChild.data)
swapElementStatus(id,false,'','processing...')
}else{
swapElementStatus(id,false,ret.firstChild.data,'processing...')
listExistedMenuLink(aid)}}
function call_removeMenuLink(id,menu){
if(menu !=''&&menu !=null){
swapElementStatus('link_to_menu_'+id,false,'','processing...')
ajax_engine.sendRequest(backend_script,response_removeMenuLink,'func=removeMenuLink','id='+id,'menu='+menu)}}
function response_removeMenuLink(result){
var ret=result.getElementsByTagName('ajaxResponse').item(0)
var act=ret.getAttribute('action')
var aid=ret.getAttribute('affected')
var id='link_to_menu_'+aid
if(ret.getAttribute('valid')=='false'){
alert(ret.firstChild.data)
swapElementStatus(id,false,'','processing...')
}else{
swapElementStatus(id,false,ret.firstChild.data,'processing...')
listExistedMenuLink(aid)}}
function listExistedMenuLink(pageid){
var existed=document.getElementById('link_to_menu_'+pageid).innerHTML
existed=existed.replace('<a>','')
existed=existed.replace('</a>','')
existed=existed.replace(/[\s]*/g,'')
var link_existed=(existed !='-')? existed.split(','): false
var existed_menu_item=''
if(link_existed&&link_existed[0] !=_SET_MENU_LINKS.replace(/[\s]*/g,'')){
for(var i=0;i<link_existed.length;i++){
existed_menu_item+=link_existed[i]+' (<a href="javascript: void(0)" onclick="call_removeMenuLink('+pageid+', \''+link_existed[i]+'\')">remove</a>)<br/>'}
existed_menu_item=existed_menu_item.substr(0,existed_menu_item.length-5,existed_menu_item)
}else{
existed_menu_item='-'}
document.getElementById('link_to_menu_'+pageid+'_existed').innerHTML=existed_menu_item}
var editor_func_loaded=false
function call_getNewsletterContent(itemid,templatename){
ajax_engine.setMenthod('get')
ajax_engine.setResponseType('text')
ajax_engine.setCallOutside(true)
ajax_engine.setLoadingStatus(true)
ajax_engine.setLoadingText('Loading data... Please do not press the `Save` button until this text disappear...')
if(!editor_func_loaded){
if(typeof tinyMCE !='undefined'){
tinyMCE.execInstanceCommand('mce_editor_0','Bold',false)}
editor_func_loaded=true}
if(typeof TMEdit !='undefined' || typeof HTMLArea !='undefined'){
if(!confirm('WARNING FOR TMEdit/HTMLArea USER: For add/edit eZine newsletter feature works properly, you need to switch your TMEdit/HTMLArea editor to TEXT MODE before choosing either '+_PAGE_TO_GET_CONTENT+' or '+_NEWSLETTER_TEMPLATE+'. Have you switched your editor to TEXT MODE yet?')){
return false}}
ajax_engine.sendRequest('../index2.php',response_getNewsletterContent,'option=com_ezine','Itemid='+itemid,'page=true','no_html=1','jos_change_template='+templatename)}
function response_getNewsletterContent(result){
ajax_engine.setMenthod('post')
ajax_engine.setResponseType('xml')
ajax_engine.setCallOutside(false)
ajax_engine.setLoadingStatus(false)
ajax_engine.setLoadingText('Loading...')
if(typeof tinyMCE !='undefined'){
tinyMCE.setContent(result)}
document.adminForm.newsletter_content.value=result}
function call_getUsers(filter){
ajax_engine.setResponseType('text')
ajax_engine.setLoadingStatus(true)
ajax_engine.sendRequest(backend_script,response_getUsers,'func=getUsers','filter='+filter)}
function response_getUsers(result){
ajax_engine.setResponseType('xml')
ajax_engine.setLoadingStatus(false)
if(result=='FILTER_EMPTY'){
alert(_FILTER_EMPTY)
}else{
var data=result.split('<-|->')
user_found=data[0]
document.getElementById('user_list').innerHTML=data[1]}}
function call_updateSubscribe(id){
var pages=''
for(var i=0;i<page_found;i++){
cb=eval('document.adminForm.ep'+id+''+i)
if(cb.checked==true){
pages+=cb.value+','}}
if(pages==''){
alert(_SUBSCRIBE_EMPTY)
}else{
pages=pages.substring(0,pages.length-1)
swapElementStatus('subcribed_pages_'+id,false,'','processing...')
ajax_engine.sendRequest(backend_script,response_updateSubscribe,'func=updateSubscribe','id='+id,'pages='+pages)}}
function response_updateSubscribe(result){
var ret=result.getElementsByTagName('ajaxResponse').item(0)
var act=ret.getAttribute('action')
var aid=ret.getAttribute('affected')
var id='subcribed_pages_'+aid
if(ret.getAttribute('valid')=='false'){
alert(ret.firstChild.data)
swapElementStatus(id,false,'','processing...')
}else{
document.getElementById(id+'_form').style.display='none'
swapElementStatus(id,false,ret.firstChild.data,'processing...')}}
function call_sendNewsletterOut(){
ajax_engine.sendRequest(backend_script,response_sendNewsletterOut,'func=sendNewsletterOut','email_per_block='+email_per_block,'this_block='+this_block,'letter_id='+document.adminForm.newsletter.value,'newsletter_subject='+document.adminForm.newsletter_subject.value)}
function response_sendNewsletterOut(result){
var ret=result.getElementsByTagName('ajaxResponse').item(0)
if(ret.getAttribute('valid')=='false'){
document.getElementById('sending_status').innerHTML=ret.firstChild.data
}else{
this_block++
if(this_block<total_block){
setTimeout(startSending,interval_time*1000)
}else{
document.getElementById('sending_status').innerHTML=_SEND_SUCCESS}}}
