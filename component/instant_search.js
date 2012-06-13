var instant_search_ajax_engine = '';
var last_keyword = '';
var reset_index = false;

function initIsAjaxEngine() {
	if (instant_search_ajax_engine == '') {
		instant_search_ajax_engine = new d4j_ajax_engine();
		instant_search_ajax_engine.setPersistent(persistent);
		instant_search_ajax_engine.setResponseUpdate('function');
		if (loading_status > 0) {
			instant_search_ajax_engine.setLoadingText(loading_text);
			instant_search_ajax_engine.setLoadingStatus(true);
		}
	}
}

function call_dosearch(keyword) {
	initIsAjaxEngine();
	if (typeof document.instantSearchForm.ordering != 'undefined') {
		ordering = document.instantSearchForm.ordering.options[document.instantSearchForm.ordering.selectedIndex].value;
	}
	if (keyword == last_keyword) {
		limit_start = limitStart;
		reset_index = false;
	} else {
		limit_start = 0;
		reset_index = true;
		last_keyword = keyword;
	}
	if (document.getElementById('instant_search_close'))
		document.getElementById('instant_search_close').src = mosConfig_live_site + '/components/com_instant_search/class/images/loadingcircle.gif';
	instant_search_ajax_engine.sendRequest(instant_search_backend_script, response_dosearch, 'func=doSearch', 'keyword='+keyword, 'limitStart='+limit_start, 'limit='+limit, 'phrase='+phrase, 'ordering='+ordering, 'min_chars='+min_chars, 'max_chars='+max_chars, 'result_length='+result_length, 'enable_sef='+enable_sef, 'result_nav='+result_nav, 'search_order='+search_order);
}

function response_dosearch(result) {
	if (reset_index == true)
		limitStart = 0;
	var show_result = true;
	var this_search_order = Math.round(result.getElementsByTagName('ajaxResponse').item(0).getAttribute('search_order'));
	if (final_result == true && this_search_order < search_order) {
		show_result = false;
	}
	if (final_result == false && this_search_order < display_order_id) {
		show_result = false;
	}
	if (show_result == true) {
		display_order_id = this_search_order;
		var search_results = '';
		var k = 0;
		var this_result = '';
		var option_fields = '';
		if (show_option) {
			if (option_display == 'vertical') {
				option_fields += '<table border="0" cellspacing="1" cellpadding="1" width="100%"><tr class="sectiontableentry1"><td>Search Phrase:</td></tr>';
				option_fields += '<tr class="sectiontableentry2"><td>';
				option_fields += '<input' + (auto_refresh == true ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + ' name="searchphrase" value="any" type="radio"' + (phrase == 'any' ? ' checked="checked"' : '') + '>Any words<br/>';
				option_fields += '<input' + (auto_refresh == true ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + ' name="searchphrase" value="all" type="radio"' + (phrase == 'all' ? ' checked="checked"' : '') + '>All words<br/>';
				option_fields += '<input' + (auto_refresh == true ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + ' name="searchphrase" value="exact" type="radio"' + (phrase == 'exact' ? ' checked="checked"' : '') + '>Exact phrase';
				option_fields += '</td></tr><tr class="sectiontableentry1"><td>Result Ordering:</td></tr>';
				option_fields += '<tr class="sectiontableentry2"><td>';
				option_fields += '<select name="ordering" class="inputbox"' + (auto_refresh == true ? ' onchange="if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + '>';
				option_fields += '<option value="newest"' + (ordering == 'newest' ? ' selected="selected"' : '') + '>Newest first</option>';
				option_fields += '<option value="oldest"' + (ordering == 'oldest' ? ' selected="selected"' : '') + '>Oldest first</option>';
				option_fields += '<option value="popular"' + (ordering == 'popular' ? ' selected="selected"' : '') + '>Most popular</option>';
				option_fields += '<option value="alpha"' + (ordering == 'alpha' ? ' selected="selected"' : '') + '>Alphabetical</option>';
				option_fields += '<option value="category"' + (ordering == 'category' ? ' selected="selected"' : '') + '>Section/Category</option>';
				option_fields += '</select>';
				option_fields += '</td></tr></table>';
			} else { // display options horizontally
				option_fields += '<table border="0" cellspacing="1" cellpadding="1"><tr><td class="sectiontableentry1">Search Phrase:&nbsp;</td>';
				option_fields += '<td class="sectiontableentry2">';
				option_fields += '<input' + (auto_refresh == true ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + ' name="searchphrase" value="any" type="radio"' + (phrase == 'any' ? ' checked="checked"' : '') + '>Any words&nbsp;';
				option_fields += '<input' + (auto_refresh == true ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + ' name="searchphrase" value="all" type="radio"' + (phrase == 'all' ? ' checked="checked"' : '') + '>All words&nbsp;';
				option_fields += '<input' + (auto_refresh == true ? ' onclick="phrase = this.value; if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + ' name="searchphrase" value="exact" type="radio"' + (phrase == 'exact' ? ' checked="checked"' : '') + '>Exact phrase';
				option_fields += '</td><td class="sectiontableentry1">Result Ordering:&nbsp;</td>';
				option_fields += '<td class="sectiontableentry2">';
				option_fields += '<select name="ordering" class="inputbox"' + (auto_refresh == true ? ' onchange="if (document.instantSearchForm.searchword.value != \'\' && document.instantSearchForm.searchword.value != \'' + text + '\' && document.instantSearchForm.searchword.value.length >= ' + min_chars + ') { limitStart = 0; call_dosearch(document.instantSearchForm.searchword.value); }"' : '') + '>';
				option_fields += '<option value="newest"' + (ordering == 'newest' ? ' selected="selected"' : '') + '>Newest first</option>';
				option_fields += '<option value="oldest"' + (ordering == 'oldest' ? ' selected="selected"' : '') + '>Oldest first</option>';
				option_fields += '<option value="popular"' + (ordering == 'popular' ? ' selected="selected"' : '') + '>Most popular</option>';
				option_fields += '<option value="alpha"' + (ordering == 'alpha' ? ' selected="selected"' : '') + '>Alphabetical</option>';
				option_fields += '<option value="category"' + (ordering == 'category' ? ' selected="selected"' : '') + '>Section/Category</option>';
				option_fields += '</select>';
				option_fields += '</td></tr></table>';
			}
		}
		if (show_option && option_pos == 'result_top') {
			search_results += option_fields;
		}
		search_results += '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		search_results += '<tr><td class="sectiontableheader" align="center">';
		search_results += _PROMPT_KEYWORD + ' &quot;' + result.getElementsByTagName('ajaxResponse').item(0).getAttribute('keyword') + '&quot; ';
		search_results += _SEARCH_MATCHES.replace('%d', result.getElementsByTagName('ajaxResponse').item(0).getAttribute('found'));
		search_results += '<br/></td></tr></table><br/>';
		if (show_option && option_pos == 'result_above') {
			search_results += option_fields;
		}
		if (result.getElementsByTagName('ajaxResponse').item(0).getAttribute('found') != '0') {
			if (display == 'table') {
				search_results += '<table class="contentpaneopen" width="100%">';
			}
			for (var i = 0; i < result.getElementsByTagName('result').length; i++) {
				this_result = result.getElementsByTagName('result').item(i);
				if (display == 'table') {
					search_results += '<tr class="sectiontableentry' + String(k + 1) + '">';
					search_results += '<td><span class="small">' + String(limitStart + i + 1) + '. </span>';
					search_results += '<a href="' + this_result.getElementsByTagName('url').item(0).firstChild.data + '"' + (this_result.getElementsByTagName('url').item(0).getAttribute('target') == '1' ? ' target="_blank"' : '') + '>';
					search_results += this_result.getElementsByTagName('title').item(0).firstChild.data + '</a>';
					search_results += (this_result.getElementsByTagName('section').item(0).firstChild.data != '' ? ('&nbsp;<span class="small">(' + this_result.getElementsByTagName('section').item(0).firstChild.data + ')</span>') : '') + '</td></tr>';
					search_results += '<tr class="sectiontableentry' + (k + 1) + '"><td>';
					search_results += this_result.getElementsByTagName('text').item(0).firstChild.data + '</td></tr>';
					search_results += (this_result.getElementsByTagName('created').item(0).firstChild.data != '-' ? ('<tr><td class="small">' + this_result.getElementsByTagName('created').item(0).firstChild.data + '</td></tr>') : '');
					search_results += (result.getElementsByTagName('result').length == (i + 1) ? '' : '<tr><td>&nbsp;</td></tr>');
					k = 1 - k;
				} else { // display results in field style
					search_results += '<fieldset style="text-align: left"><div><span class="small">' + String(limitStart + i + 1) + '. </span>';
					search_results += '<a href="' + this_result.getElementsByTagName('url').item(0).firstChild.data + '"' + (this_result.getElementsByTagName('url').item(0).getAttribute('target') == '1' ? ' target="_blank"' : '') + '>';
					search_results += this_result.getElementsByTagName('title').item(0).firstChild.data + '</a>';
					search_results += (this_result.getElementsByTagName('section').item(0).firstChild.data != '' ? ('<br/><span class="small">(' + this_result.getElementsByTagName('section').item(0).firstChild.data + ')</span>') : '');
					search_results += '</div><div>' + this_result.getElementsByTagName('text').item(0).firstChild.data + '</div>';
					search_results += (this_result.getElementsByTagName('created').item(0).firstChild.data != '-' ? ('<div class="small">' + this_result.getElementsByTagName('created').item(0).firstChild.data + '</div>') : '') + '</fieldset>';
					search_results += (result.getElementsByTagName('result').length == (i + 1) ? '' : '<br/>');
				}
			}
			if (display == 'table') {
				search_results += '</table>';
			}
			if (show_option && option_pos == 'result_below') {
				search_results += option_fields;
			}
			if (result_nav == 1) {
				if (result.getElementsByTagName('pagenav').item(0).firstChild.data != '-') {
					search_results += '<br/><table width="100%" border="0" cellspacing="0" cellpadding="0">';
					search_results += '<tr><td class="sectiontablefooter" align="center">';
					search_results += result.getElementsByTagName('pagenav').item(0).firstChild.data;
					search_results += '</td></tr></table><br/>';
				}
			}
		}
		if (show_option && option_pos == 'result_bottom') {
			search_results += option_fields;
		}
		if (showhideresult)
			document.getElementById('showhideresult').style.display = 'block';
		PopupContent('instant_search', '', '', '', search_results, result_width, result_height, mosConfig_live_site + '/components/com_instant_search/class/images/close.png', null, padding_to, padding_width);
		if (result_bgcolor != '') {
			document.getElementById('instant_search_list').style.backgroundColor = result_bgcolor;
		} else {
			document.getElementById('instant_search_list').style.backgroundColor = getBackgroundColor(document.getElementById('instant_search_node'));
		}
	}
	if (document.getElementById('instant_search_close'))
		document.getElementById('instant_search_close').src = mosConfig_live_site + '/components/com_instant_search/class/images/close.png';
}

function prepareSearch(keyword) {
	if (keyword != '' && keyword != text && keyword.length >= min_chars && keyword != last_keyword) {
		search_order++;
		if (delay_time == 0)
			doSearch(search_order);
		else
			setTimeout('doSearch('+search_order+')', delay_time);
	}
}

function doSearch(search_id) {
	if (search_id == search_order)
		call_dosearch(document.instantSearchForm.searchword.value);
}