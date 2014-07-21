
function ajaxLoad(method, URL, data, displayId) {
	var AJAX = null;
	if(window.ActiveXObject) {		
		AJAX = new ActiveXObject("Microsoft.XMLHTTP");	
	}
	else if(window.XMLHttpRequest) {		
		AJAX = new XMLHttpRequest();	
	}
	else {
		alert("Your browser doesn't support AJAX");
		return;
	}

	method = method.toLowerCase();
	URL += "?dummy=" + (new Date()).getTime();
	if(method=="get") {
		URL += "&" + data;
		data = null;
	}

	AJAX.open(method, URL);

	if(method=="post") {
		AJAX.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	}
	
	AJAX.onreadystatechange = function() {
		if(AJAX.readyState==4 && AJAX.status==200) {
			var ctype = AJAX.getResponseHeader("Content-Type").toLowerCase();
			ajaxCallback(ctype, displayId, AJAX.responseText);

			delete AJAX;
			AJAX = null;
		}
	}

	AJAX.send(data);
}

function ajaxCallback(contentType, displayId, responseText) {
	if(contentType.match("text/javascript")) {
		eval(responseText);
	}
	else {
		if(displayId==null) {
			return;
		}
		var el = document.getElementById(displayId);
		el.innerHTML = responseText;
	}
}

function getFormData(form_name_or_id) {
	
	var frm = document.forms[form_name_or_id];
	if(frm==null) {
		alert("Form: '" + form_name_or_id + "' not found!");
		return;
	}

	var data = "";
	var num_el = frm.elements.length;
	for(i=0; i<num_el; i++) {
		var el = frm.elements[i];
		if(el.name=="" && el.id=="") {
			continue;
		}
		var param_name = "";
		if(el.name!="") {
			param_name = el.name;
		}
		else if(el.id!="") {
			param_name = el.id;
		}

		var t = frm.elements[i].type;
		var value = "";
		if(t=="text"||t=="password"||t=="hidden"||t=="textarea") {
			value = encodeURIComponent(el.value);
		}
		else if(t=="radio"||t=="checkbox") {
			if(el.checked) {
				value = encodeURIComponent(el.value);
			}
			else {
				continue;
			}
		}
		else if(t=="select-one") {
			value = encodeURIComponent(el.options[el.selectedIndex].value);
		}
		else if(t=="select-multiple") {
			for(j=0; j<el.length; j++) {
				if(el.options[j].selected) {
					if(data!="") {
						data += "&";
					}
					data += param_name + "=";
					data += encodeURIComponent(el.options[j].value);
				}
			}
			
			continue;
		}
		if(data!="") {
			data += "&";
		}
		data += param_name + "=" + value;
	}

	return data;
}
