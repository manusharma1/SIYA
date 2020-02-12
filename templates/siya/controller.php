<?php 
if(defined('_BLOCK')){ 
if(_BLOCK != ''){ 
$block = _BLOCK; 
} 
}else{ 
$block = ''; 
} 
 
if(defined('_MODULE')){ 
if(_MODULE == ''){ 
$module = 'cms'; 
}else{ 
$module = _MODULE; 
} 
}else{ 
$module = ''; 
} 
 
if(_ACTION == ''){ 
$action = 'getContent'; 
}else{ 
$action = _ACTION; 
} 
 
if(_PARAMETERS == ''){ 
$parameters = array('1'); // Default Value // Home Page ID 
}else{ 
$parameters = explode(',', _PARAMETERS); 
} 
 
define('_TEMPLATE_IMG_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'images'); 
define('_TEMPLATE_CSS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'css'); 
define('_TEMPLATE_JS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'js'); 
 

 
// DEFINE PLACEHOLDERS 
 
$title_placeholder=''; 
$meta_description_placeholder=''; 
$meta_keywords_placeholder=''; 
$main_content_placeholder=''; 
$main_content2_placeholder=''; 
$main_contentmore_placeholder=''; 
$main_content2more_placeholder=''; 
$yuimenu_placeholder=''; 
$smallmenu_placeholder='';
$newssection_placeholder='';
$contact_form_placeholder='';
$volunteer_contact_form_placeholder='';
$endorse_contact_form_placeholder='';
$donate_contact_form_placeholder='';
$picturegallery_placeholder='';
$videogallery_placeholder='';
$facebook_plugin_placeholder='';
$googleanalytics_plugin_placeholder='';
$session_message_placeholder = ''; 
$pageid = $parameters[0];
$circleslider_placeholder = '';

if(isset($parameters[1])){
$moreid = $parameters[1];
}else{
$moreid = '';
}

//Allowed Modules, Please add your allowed Modules, in the array

$allowed_modules_blocks = array('cms','contactform');

//Allowed Actions, Please add your allowed actions, in the array 
 
$allowed_actions = array('getContent','errorPage','contactFormSubmit'); 
 
// Main Caller  
$MainSystemObj = new MainSystem(); 

if(in_array($module,$allowed_modules_blocks)){

if(in_array($action,$allowed_actions)){ 
 
if($block!=''){ 
$MainSystemObj->CallBlock($block,$action,$parameters); // ClassName , Method Name, Parameters in Array 
}else{ 
$resultset = $MainSystemObj->CallModule($module,$action,$parameters); // ClassName , Method Name, Parameters in Array 
} 
	if(isset($resultset['title_placeholder'])){ 
	$title_placeholder = $resultset['title_placeholder']; 
	}else{ 
	$title_placeholder = ''; 
	} 
 
	if(isset($resultset['meta_description_placeholder'])){ 
	$meta_description_placeholder = $resultset['meta_description_placeholder']; 
	}else{ 
	$meta_description_placeholder = ''; 
	} 
 
	if(isset($resultset['meta_keywords_placeholder'])){ 
	$meta_keywords_placeholder = $resultset['meta_keywords_placeholder']; 
	}else{ 
	$meta_keywords_placeholder = ''; 
	} 
 
	if(isset($resultset['main_content_placeholder'])){ 
	$main_content_placeholder = $resultset['main_content_placeholder']; 
	}else{ 
	$main_content_placeholder = ''; 
	} 

	if(isset($resultset['main_content2_placeholder'])){ 
	$main_content2_placeholder = $resultset['main_content2_placeholder']; 
	}else{ 
	$main_content2_placeholder = ''; 
	} 

	if(isset($resultset['main_contentmore_placeholder'])){ 
	$main_contentmore_placeholder = $resultset['main_contentmore_placeholder']; 
	}else{ 
	$main_contentmore_placeholder = ''; 
	} 

	if(isset($resultset['main_content2more_placeholder'])){ 
	$main_content2more_placeholder = $resultset['main_content2more_placeholder']; 
	}else{ 
	$main_content2more_placeholder = ''; 
	} 

	if($moreid !=''){
	$main_content_placeholder = '';
	$main_content2_placeholder = '';
	}

	if($moreid !='' && $moreid == 'm1'){
	$main_content2more_placeholder = '';
	}

	if($moreid !='' && $moreid == 'm2'){
	$main_contentmore_placeholder = '';
	}


	if(isset($resultset['menuid'])){ 
	$menuid = $resultset['menuid']; 
	}else{ 
	$menuid = ''; 
	} 

}else{
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
}
}else{ 
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/')); 
} 
 

if($parameters[0]=='1' && $action=='getContent'){
$circleslider_placeholder = $MainSystemObj->CallBlock('circleslider','showCircleSlider', array()); // ClassName , Method Name, Parameters in Array
}else{
$imageslider_placeholder = '';
$newssection_placeholder = '';
}
 
 
// Facebook Placeholder

$facebook_plugin_placeholder = $MainSystemObj->CallBlock('additionalsettingsblock','showFacebookPlugin', array()); // ClassName , Method Name, Parameters in Array 


$yuimenu_placeholder = $MainSystemObj->CallBlock('menu','showRecursiveYUIMenu', array()); // ClassName , Method Name, Parameters in Array 

$smallmenu_placeholder = $MainSystemObj->CallBlock('menu','showSmallMenu', array('2')); // ClassName , Method Name, Parameters in Array 

// Google Analytics Placeholder

$googleanalytics_plugin_placeholder = $MainSystemObj->CallBlock('additionalsettingsblock','insertGoogleAnalyticsPlugin', array()); // ClassName , Method Name, Parameters in Array 