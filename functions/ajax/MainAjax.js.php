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
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//////////////////////////////////////////////////////////////////////////

$mainajaxindexfile = PROJ_MAINSYSTEM_AJAX_WWW_DIR._WS.PROJ_DEFAULT_CONTROLLER_FILE;
?>

<script>

var editor,ajaxpostelements,ajaxpostparams,finalparameters;

// Main Ajax Function

function MainAjaxFunction(url,method,isblock,extrajsfunctioncall,ajaxhtmlelementid)
{
	var selectedmenu; 
	selectedmenu = eval(extrajsfunctioncall+'()');

	if(method=='post'){
	ajaxpostparams = '';
	ajaxpostelements = getElementsByClass('<?php echo PROJ_AJAX_HTML_POST_CLASS_FOR_TEMPLATE; ?>');
	for($i=0;$i<ajaxpostelements.length;$i++){
	name = ajaxpostelements[$i];
	type = document.getElementById(ajaxpostelements[$i]).type;
	name = document.getElementById(ajaxpostelements[$i]).name;
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
				alert(ajaxRequest.responseText);
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
	
	if(extrajsfunctioncall=='getMenuID'){
	finalparameters = 'method=get&ajaxcall=1&url='+url+'&isblock='+isblock+'&menuid='+selectedmenu;
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


/*function createAjaxCKEditor(url, method)
{
	urlarray = url.split('/');
	pageid = urlarray[2];

	ajaxnewurl = 'cms/ajaxGetPageContent/'+pageid;
	isblock = false;
	
	var ajaxRequest1;  // The variable that makes Ajax possible!
		
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest1 = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest1 = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest1 = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest1.onreadystatechange = function(){
			if(ajaxRequest1.readyState == 4){
			if ( editor )
			return;
			var config = {};
			CKEDITOR.replace( 'data', config);
			//CKEDITOR.appendTo( 'editor', config, ajaxRequest1.responseText );
			}
		}


		ajaxRequest1.open(method, '<?php echo $mainajaxindexfile; ?>?method=get&ajaxcall=1&url='+ajaxnewurl+'&isblock='+isblock, true);
		ajaxRequest1.send(null); 	

}*/



function getElementsByClass(searchClass, domNode, tagName) { 
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


function getMenuID() { 
	var retrunid;
	retrunid =  document.getElementById('menuid').value;
	return retrunid;
}


</script>