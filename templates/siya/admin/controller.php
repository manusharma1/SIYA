<?php
if(_MODULE == ''){
$module = 'admin';
}else{
$module = _MODULE;
}

if(_ACTION == ''){
$action = 'login';
}else{
$action = _ACTION;
}

if(_PARAMETERS == ''){
$parameters = array();
}else{
$parameters = explode(',', _PARAMETERS);
}

$previous_session_message = '';
if($module == 'admin' && ($action == 'login' || $action == 'loginCheck') && empty($parameters)){
$previous_session_message = MainSystem::GetPreviousSessionMsg();
MainSystem::CreateSession();
}else{
MainSystem::CheckSession();
}

if(!MainSystem::IsAdminLogged() && $module != 'admin' && ($action != 'login' || $action != 'loginCheck') && empty($parameters)){
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
}

define('_TEMPLATE_IMG_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'images');
define('_TEMPLATE_CSS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'css');
define('_TEMPLATE_JS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'js');
//define('_TEMPLATE_CSS_FOR_HTMLEDITOR_CONTENTS',_TEMPLATE_CSS_DIR._WS.'htmleditorstyle.css'); 



// DEFINE PLACEHOLDERS

$title_placeholder='';
$meta_description_placeholder='';
$meta_keywords_placeholder='';
$main_content_placeholder='';
$login_box_placeholder='';

// SESSION MESSAGE PLACEHOLDER

$session_message_placeholder = '';

if($previous_session_message != ''){
$session_message_placeholder .= $previous_session_message.'</br>';
}

$session_message_placeholder .= MainSystem::GetSessionMsg();


//Allowed Modules, Please add your allowed Modules, in the array

$admin_allowed_modules = array('admin','cms','entities','users');

//Allowed Actions, Please add your allowed actions, in the array

$admin_allowed_actions = array('login','logout','loginCheck','getAdminHome','getContent','errorPage','managePages','savePage','editPage','addNewEntity','saveEntity','manageEntities','editEntity','linkEntities','saveLinkEntities','addNewUserType','saveUserType');

// Main Caller 
$MainSystemObj = new MainSystem();

if(in_array($module,$admin_allowed_modules)){

if(in_array($action,$admin_allowed_actions)){

$resultset = $MainSystemObj->CallModule($module,$action,$parameters); // ClassName , Method Name, Parameters in Array

	if(isset($resultset['title_placeholder'])){
	$title_placeholder = $resultset['title_placeholder'];
	}else{
	$title_placeholder = '';
	}

	if(isset($resultset['main_content_placeholder'])){
	$main_content_placeholder = $resultset['main_content_placeholder'];
	}else{
	$main_content_placeholder = '';
	}
}else{
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
}
}else{
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
// Define else
}

if(MainSystem::IsAdminLogged()){
$opentadka_header_navigation_placeholder = $MainSystemObj->CallBlock('opentadkanavigation','showHeaderNavigation', array()); // ClassName , Method Name, Parameters in Array
$opentadka_footer_navigation_placeholder = $MainSystemObj->CallBlock('opentadkanavigation','showFooterNavigation', array()); // ClassName , Method Name, Parameters in Array
}else{
$opentadka_header_navigation_placeholder = '';
$opentadka_footer_navigation_placeholder = '';
}