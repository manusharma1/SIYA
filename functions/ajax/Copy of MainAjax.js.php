<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT  - DO NOT REMOVE THIS NOTICE                      //
//                                                                       //
// OPENTADKA FRAMEWORK											         //
//          http://www.opentadka.org                                     //
//                                                                       //
// Copyright (C) 2010 onwards  Manu Sharma  http://www.opentadka.org     //
//                                                                       //
// STUDENT INFORMATION YARN (SIYA)								         //
//          http://www.siya.org.in                                       //
//                                                                       //
// Copyright (C) 2012 onwards  Manu Sharma  http://www.siya.org.in       //
//                                                                       //
// OPENTADKA FRAMEWORK LICENSE :                                         //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
// STUDENT INFORMATION YARN (SIYA) LICENSE :                             //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//   OPENTADKA FRAMEWORK & STUDENT INFORMATION YARN (SIYA)               //
//   FOR LICENCESPLEASE REFER LICENCE PAGE                               //
//   FOR MORE DETAILS                                                    //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

$mainajaxindexfile = PROJ_MAINSYSTEM_AJAX_WWW_DIR._WS.PROJ_DEFAULT_CONTROLLER_FILE;
?>

<script>

var editor,ajaxpostelements,ajaxpostparams;

// Main Ajax Function

function MainAjaxFunction(url,method,isblock,extrajsfunctioncall,ajaxhtmlelementid)
{

	if(method=='post'){
	ajaxpostparams = '';
	//ajaxpostelements = document.getElementsByClassName('<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL; ?>');
	ajaxpostelements = getElementsByClass('<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL; ?>');
	for($i=0;$i<ajaxpostelements.length;$i++){
	alert(ajaxpostelements[$i].type);
	//type = document.getElementById(ajaxpostelements[$i]).type;
	//name = document.getElementById(ajaxpostelements[$i]).name;
	type = ajaxpostelements[$i].type;
	name = ajaxpostelements[$i].name;
	if(type == 'text'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}else if(type == 'textarea'){
		if(name=='data'){
		value = encodeURIComponent(document.getElementById(ajaxpostelements[$i]).value); // For CKEditor as the special character in the data for Ajax Post giving issues
		}else{
		value = document.getElementById(ajaxpostelements[$i]).value;
		}
	}else if(type == 'select-one'){
	value = document.getElementById(ajaxpostelements[$i]).selectedIndex;
	}else if(type == 'password'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}else if(type == 'hidden'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}else if(type == 'checkbox'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}else if(type == 'radio'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}
	ajaxpostparams = ajaxpostparams+'&'+name+'='+value;
	}


	ajaxpostelements = getElementsByClass('<?php echo PROJ_AJAX_HTML_POST_CLASS_TEXT; ?>');
	for($i=0;$i<ajaxpostelements.length;$i++){
	name = ajaxpostelements[$i];
	type = document.getElementById(ajaxpostelements[$i]).type;
	name = document.getElementById(ajaxpostelements[$i]).name;
	if(type == 'text'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}else if(type == 'password'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}
	ajaxpostparams = ajaxpostparams+'&'+name+'='+value;
	}


	ajaxpostelements = getElementsByClass('<?php echo PROJ_AJAX_HTML_POST_CLASS_TEXTAREA; ?>');
	for($i=0;$i<ajaxpostelements.length;$i++){
	name = ajaxpostelements[$i];
	type = document.getElementById(ajaxpostelements[$i]).type;
	name = document.getElementById(ajaxpostelements[$i]).name;
	if(type == 'textarea'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}
	ajaxpostparams = ajaxpostparams+'&'+name+'='+value;
	}


	ajaxpostelements = getElementsByClass('<?php echo PROJ_AJAX_HTML_POST_CLASS_HIDDEN; ?>');
	for($i=0;$i<ajaxpostelements.length;$i++){
	name = ajaxpostelements[$i];
	type = document.getElementById(ajaxpostelements[$i]).type;
	name = document.getElementById(ajaxpostelements[$i]).name;
	if(type == 'hidden'){
	value = document.getElementById(ajaxpostelements[$i]).value;
	}
	ajaxpostparams = ajaxpostparams+'&'+name+'='+value;
	}


	finalajaxpostparams = 'method='+method+'&ajaxcall=1&url='+url+ajaxpostparams+'&isblock='+isblock;
	//alert(ajaxpostparams);
	
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	
		ajaxRequest.open(method, '<?php echo $mainajaxindexfile; ?>', true);

		//Send the proper header information along with the request
		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxRequest.setRequestHeader("Content-length", finalajaxpostparams.length);
		ajaxRequest.setRequestHeader("Connection", "close");

		ajaxRequest.onreadystatechange = function() {//Call a function when the state changes.
			if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
				document.getElementById(ajaxhtmlelementid).innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.send(finalajaxpostparams);
	
	
	}else{

	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.getElementById(ajaxhtmlelementid).innerHTML = ajaxRequest.responseText;
			if(extrajsfunctioncall!=''){
			//eval(extrajsfunctioncall+'("'+url+'","'+method+'")');
			eval(extrajsfunctioncall+'()');
			}
		}
	}
	ajaxRequest.open(method, '<?php echo $mainajaxindexfile; ?>?method=get&ajaxcall=1&url='+url+'&isblock='+isblock, true);
	ajaxRequest.send(null); 

	}


}


function createAjaxCKEditor()
{
			if ( editor )
			return;
			var config = {};
			CKEDITOR.replace( 'data', config);
}


function getElementsByClass2(searchClass, domNode, tagName) 
{ 
	if (domNode == null) domNode = document;
	if (tagName == null) tagName = '*';
	var el = new Array();
	var tags = domNode.getElementsByTagName(tagName);
	var tcl = " "+searchClass+" ";
	for(i=0,j=0; i<tags.length; i++) { 
		var test = " " + tags[i].className + " ";
		if (test.indexOf(tcl) != -1) 
			el[j++] = tags[i].name;
	} 
	return el;
}


/*document.getElementsByClassName = function(cl) {
var retnode = [];
var myclass = new RegExp('\\b'+cl+'\\b');
var elem = this.getElementsByTagName('*');
for (var i = 0; i < elem.length; i++) {
var classes = elem[i].className;
if (myclass.test(classes)) retnode.push(elem[i]);
}
return retnode;
};
*/

function getElementsByClass(className, tag, elm){
	var testClass = new RegExp("(^|\\s)" + className + "(\\s|$)");
	var tag = tag || "*";
	var elm = elm || document;
	var elements = (tag == "*" && elm.all)? elm.all : elm.getElementsByTagName(tag);
	var returnElements = [];
	var current;
	var length = elements.length;
	for(var i=0; i<length; i++){
		current = elements[i];
		if(testClass.test(current.className)){
			returnElements.push(current);
		}
	}
	return returnElements;
}

</script>