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
	var ajaxpostparams = '';
	ajaxpostelements = getElementsByClass('<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL; ?>');
	for($i=0;$i<ajaxpostelements.length;$i++){
	name = ajaxpostelements[$i].name;
	ajaxpostparams = ajaxpostparams + getValues(name);
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
			//if(extrajsfunctioncall!=''){
			//eval(extrajsfunctioncall+'("'+url+'","'+method+'")');
			//eval(extrajsfunctioncall+'()');
			//}
		}
	}

	if(extrajsfunctioncall!='' && extrajsfunctioncall!='getMenuID'){
	eval(extrajsfunctioncall+'("'+url+'","'+method+'")');
	eval(extrajsfunctioncall+'()');
	}else if(extrajsfunctioncall=='getMenuID'){
	selectedmenu = eval(extrajsfunctioncall+'()');
	finalparameters = 'method=get&ajaxcall=1&url='+url+'&isblock=0&menuid='+selectedmenu;
	}else{
	finalparameters = 'method=get&ajaxcall=1&url='+url+'&isblock='+isblock;
	}

	ajaxRequest.open(method, '<?php echo $mainajaxindexfile; ?>?'+finalparameters, true);
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



function getValues(objName) { 
	var arr = new Array(); 
	var checkboxreturnvalue = '&'+objName+'=';
	var checkboxreturnvalue2 = '';
	arr = document.getElementsByName(objName);
	for (var i = 0; i < arr.length; i++) { 
		var obj = document.getElementsByName(objName).item(i); 
		
		if(obj.type=='radio'){
		if(obj.checked){
		return '&'+obj.name+'='+obj.value;
		}
		}
		
		if(obj.type=='checkbox'){
		arr2 = document.getElementsByName(obj.name);
		for (var ii = 0; ii < arr2.length; ii++) { 
		var obj2 = document.getElementsByName(obj.name).item(ii); 
		if(obj2.checked){
		if(checkboxreturnvalue2==''){
		checkboxreturnvalue2 = checkboxreturnvalue2+obj2.value;
		}else{
		checkboxreturnvalue2 = checkboxreturnvalue2+','+obj2.value;		
		}
		}
		}
		return checkboxreturnvalue+checkboxreturnvalue2;
		}


		if(obj.type=='select-one'){
		return '&'+obj.name+'='+obj.value;
		}

		if(obj.type=='text' || obj.type=='textarea' || obj.type=='password' || obj.type=='hidden'){
		return '&'+obj.name+'='+obj.value;
		}

	} 
} 


function getMenuID(){
var returnid;
returnid = document.getElementById('menuid').value;
return returnid;
}

</script>