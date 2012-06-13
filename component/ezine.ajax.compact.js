var ezine_backend_script=mosConfig_live_site+'/index2.php?option=com_ezine&task=ajax_call&no_html=1'
var ezine_ajax_engine=''
function initEzAjaxEngine(){
if(ezine_ajax_engine==''){
ezine_ajax_engine=new d4j_ajax_engine()
ezine_ajax_engine.setMenthod('post')
ezine_ajax_engine.setResponseType('text')
ezine_ajax_engine.setResponseUpdate('function')
ezine_ajax_engine.setLoadingStatus(true)
ezine_ajax_engine.setLoadingText('Loading... Please wait...')
ezine_ajax_engine.setDebug(false)}}
function call_showContent(page_id,category_id,content_id,Itemid){
initEzAjaxEngine()
if(arguments.length>5&&arguments[5]==true){
}else{
if(arguments[4] !=null)
dhtmlHistory.add('article,'+page_id+','+category_id+','+content_id+','+Itemid+','+arguments[4],null)
else
dhtmlHistory.add('article,'+page_id+','+category_id+','+content_id+','+Itemid,null)}
if(arguments[4] !=null)
ezine_ajax_engine.sendRequest(ezine_backend_script,response_showContent,'func=showFullArticleAJAX','page='+page_id,'category='+category_id,'article='+content_id,'article_page='+arguments[4],'Itemid='+Itemid)
else
ezine_ajax_engine.sendRequest(ezine_backend_script,response_showContent,'func=showFullArticleAJAX','page='+page_id,'category='+category_id,'article='+content_id,'Itemid='+Itemid)}
function response_showContent(result){
if(result !=''&&result !=null){
document.getElementById('ezine_content').innerHTML=result
scrollToTop()}}
function call_showCategory(page_id,category_id,Itemid,LimitStart){
initEzAjaxEngine()
if(arguments.length>4&&arguments[4]==true){
}else{
dhtmlHistory.add('category,'+page_id+','+category_id+','+Itemid+','+LimitStart,null)}
ezine_ajax_engine.sendRequest(ezine_backend_script,response_showCategory,'func=showCategoryAJAX','page='+page_id,'category='+category_id,'Itemid='+Itemid,'LimitStart='+LimitStart)}
function response_showCategory(result){
if(result !=''&&result !=null){
document.getElementById('ezine_content').innerHTML=result
scrollToTop()}}
function call_newsletter_subscribe(){
initEzAjaxEngine()
var this_form=document.com_ezine_newsletter
var selected_pages=''
for(var i=0;i<document.com_ezine_newsletter.checkbox.value;i++){
var cb=eval('this_form.cb'+i+'')
if(cb.checked==true){
selected_pages+=cb.value+','}}
selected_pages=selected_pages.substring(0,selected_pages.length-1)
if(selected_pages==''){
alert(_SELECT_PAGE_TO_SUBSCRIBE_TO)
return false}
if(typeof this_form.uid !='undefined'){
var query='uid='+this_form.uid.value
}else if(typeof this_form.email !='undefined'&&this_form.email.value !=''){
var query='email='+this_form.email.value
}else{
alert(_FORGOT_INPUT_EMAIL_ADDRESS)
return false}
this_form.subscribe_button.setAttribute('title',this_form.subscribe_button.value)
this_form.subscribe_button.value='Processing...'
ezine_ajax_engine.setResponseType('xml')
ezine_ajax_engine.setLoadingStatus(false)
ezine_ajax_engine.sendRequest(ezine_backend_script,response_newsletter_subscribe,'func=subscribe','pages='+selected_pages,query,'name='+this_form.name.value)}
function response_newsletter_subscribe(result){
var this_form=document.com_ezine_newsletter
if(result.getElementsByTagName('ajaxResponse').item(0).getAttribute('success')=='true'){
var subscribed_pages=result.getElementsByTagName('ajaxResponse').item(0).firstChild.data.split(',')
for(var i=0;i<document.com_ezine_newsletter.checkbox.value;i++){
var cb=eval('this_form.cb'+i+'')
var found=false
for(var j=0;j<subscribed_pages.length;j++){
if(cb.value==subscribed_pages[j]){
cb.checked=true
found=true}
if(found==false){
cb.checked=false}}}
alert(_SUBSCRIBE_SUCCESS)
}else{
alert(_SUBSCRIBE_FAIL)}
this_form.subscribe_button.value=this_form.subscribe_button.getAttribute('title')
this_form.subscribe_button.removeAttribute('title')
ezine_ajax_engine.setResponseType('text')
ezine_ajax_engine.setLoadingStatus(true)}
function call_newsletter_unsubscribe(){
initEzAjaxEngine()
var this_form=document.com_ezine_newsletter
var selected_pages=''
for(var i=0;i<document.com_ezine_newsletter.checkbox.value;i++){
var cb=eval('this_form.cb'+i+'')
if(cb.checked==true){
selected_pages+=cb.value+','}}
selected_pages=selected_pages.substring(0,selected_pages.length-1)
if(selected_pages==''){
alert(_SELECT_PAGE_TO_UNSUBSCRIBE_FROM)
return false}
if(typeof this_form.uid !='undefined'){
var query='uid='+this_form.uid.value
}else if(typeof this_form.email !='undefined'&&this_form.email.value !=''){
var query='email='+this_form.email.value
}else{
alert(_FORGOT_INPUT_EMAIL_ADDRESS)
return false}
this_form.unsubscribe_button.setAttribute('title',this_form.unsubscribe_button.value)
this_form.unsubscribe_button.value='Processing...'
ezine_ajax_engine.setResponseType('xml')
ezine_ajax_engine.setLoadingStatus(false)
ezine_ajax_engine.sendRequest(ezine_backend_script,response_newsletter_unsubscribe,'func=unsubscribe','pages='+selected_pages,query)}
function response_newsletter_unsubscribe(result){
var this_form=document.com_ezine_newsletter
if(result.getElementsByTagName('ajaxResponse').item(0).getAttribute('success')=='true'){
var subscribed_pages=result.getElementsByTagName('ajaxResponse').item(0).firstChild.data.split(',')
for(var i=0;i<document.com_ezine_newsletter.checkbox.value;i++){
var cb=eval('this_form.cb'+i+'')
var found=false
for(var j=0;j<subscribed_pages.length;j++){
if(cb.value==subscribed_pages[j]){
cb.checked=true
found=true}
if(found==false){
cb.checked=false}}}
alert(_UNSUBSCRIBE_SUCCESS)
}else{
alert(_UNSUBSCRIBE_FAIL)}
this_form.unsubscribe_button.value=this_form.unsubscribe_button.getAttribute('title')
this_form.unsubscribe_button.removeAttribute('title')
ezine_ajax_engine.setResponseType('text')
ezine_ajax_engine.setLoadingStatus(true)}
