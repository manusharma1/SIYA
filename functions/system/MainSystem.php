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

class MainSystem
{

static function SelectTemplate(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'template';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	if($resultset = $sqlObj->FetchResult($result)){
	if(is_dir(PROJ_TEMPLATES_DIR._S.$resultset->value)){
	define('PROJ_DEFAULT_TEMPLATE_DIR',$resultset->value);
	}else{
	// Trigger Non Existing Directory Error
	return 0;
	}
	}
	else{
	// Trigger Error
	return 0;
	}
}

static function IncludeModules(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	while($resultset = $sqlObj->FetchResult($result)){
	if(is_dir(PROJ_MODULES_DIR._S.$resultset->value)){
	include_once(PROJ_MODULES_DIR._S.$resultset->value._S.$resultset->value.'.php');
	}else{
	// Trigger Non Existing Module Directory Error
	return 0;
	}
	}

}


static function IncludeModulesCSS(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	while($resultset = $sqlObj->FetchResult($result)){
	if(is_dir(PROJ_MODULES_DIR._S.$resultset->value._S.PROJ_DEFAULT_CSS_FOLDER)){
	if(is_file(PROJ_MODULES_DIR._S.$resultset->value._S.PROJ_DEFAULT_CSS_FOLDER._S.$resultset->value.'.css')){
	echo('<link rel="stylesheet" type="text/css" href="'.PROJ_MODULES_WWW_DIR._WS.$resultset->value._WS.PROJ_DEFAULT_CSS_FOLDER._WS.$resultset->value.'.css" />');	
	}
	}
	}

}


static function IncludeModulesJS(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	while($resultset = $sqlObj->FetchResult($result)){
	if(is_dir(PROJ_MODULES_DIR._S.$resultset->value._S.PROJ_DEFAULT_JS_FOLDER)){
	if(is_file(PROJ_MODULES_DIR._S.$resultset->value._S.PROJ_DEFAULT_JS_FOLDER._S.$resultset->value.'.js')){
	echo('<script type="text/javascript" src="'.PROJ_MODULES_WWW_DIR._WS.$resultset->value._WS.PROJ_DEFAULT_JS_FOLDER._WS.$resultset->value.'.js"><script>');	
	}
	}
	}

}


static function IncludeBlocks(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'block';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	while($resultset = $sqlObj->FetchResult($result)){
	if(is_dir(PROJ_BLOCKS_DIR._S.$resultset->value)){
	include_once(PROJ_BLOCKS_DIR._S.$resultset->value._S.$resultset->value.'.php');
	}else{
	// Trigger Non Existing Module Directory Error
	return 0;
	}
	}
}


static function IncludeBlocksCSS(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'block';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	while($resultset = $sqlObj->FetchResult($result)){
	if(is_dir(PROJ_BLOCKS_DIR._S.$resultset->value._S.PROJ_DEFAULT_CSS_FOLDER)){
	if(is_file(PROJ_BLOCKS_DIR._S.$resultset->value._S.PROJ_DEFAULT_CSS_FOLDER._S.$resultset->value.'.css')){
	echo('<link rel="stylesheet" type="text/css" href="'.PROJ_BLOCKS_WWW_DIR._WS.$resultset->value._WS.PROJ_DEFAULT_CSS_FOLDER._WS.$resultset->value.'.css" />');	
	}
	}
	}
}



static function IncludeBlocksJS(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'block';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	while($resultset = $sqlObj->FetchResult($result)){
	if(is_dir(PROJ_BLOCKS_DIR._S.$resultset->value._S.PROJ_DEFAULT_JS_FOLDER)){
	if(is_file(PROJ_BLOCKS_DIR._S.$resultset->value._S.PROJ_DEFAULT_JS_FOLDER._S.$resultset->value.'.js')){
	echo('<script type="text/javascript" src="'.PROJ_BLOCKS_WWW_DIR._WS.$resultset->value._WS.PROJ_DEFAULT_JS_FOLDER._WS.$resultset->value.'.js"></script>');	
	}
	}
	}
}


static function IncludeMainJSFunctions(){
	if(file_exists(PROJ_MAINSYSTEM_JS_DIR._S.'MainJS.js')){
	echo('<script type="text/javascript" src="'.PROJ_MAINSYSTEM_JS_WWW_DIR._WS.'MainJS.js"'.'></script>');
	}
	if(file_exists(PROJ_3RDPARTY_DIR._S.'ckeditor'._S.'ckeditor.js')){
	echo('<script type="text/javascript" src="'.PROJ_3RDPARTY_WWW_DIR._WS.'ckeditor'._WS.'ckeditor.js"'.'></script>');
	}

	if(file_exists(PROJ_3RDPARTY_DIR._S.'ckeditor'._S.'_samples'._S.'sample.js')){
	echo('<script type="text/javascript" src="'.PROJ_3RDPARTY_WWW_DIR._WS.'ckeditor'._WS.'_samples'._WS.'sample.js"'.'></script>');
	}

}


static function IncludeMainAjaxFunctions(){
	if(file_exists(PROJ_MAINSYSTEM_AJAX_DIR._S.'MainAjax.js.php')){
	//echo('<script type="text/javascript" src="'.PROJ_MAINSYSTEM_AJAX_WWW_DIR._WS.'MainAjax.js.php"'.'></script>');
	include_once(PROJ_MAINSYSTEM_AJAX_DIR._S.'MainAjax.js.php'); // needs to be improved //

	}
}


public function CallModule($module = '', $method = '', $parameters = ''){
	
	$ModuleResultset = 0;
	if(class_exists($module)){
	$moduleObj = new $module;
	if(method_exists($moduleObj, $method)){
	$ModuleResultset = call_user_func_array(array($moduleObj,$method),array($parameters));
	}else{
	trigger_error('Function Not Found');
	//trigger function not found error
	}
	}else{
	trigger_error('Class Not Found');
	//trigger class not found error
	}
	
	return $ModuleResultset;

}


function CallBlock($block = '', $method = '', $parameters = ''){
	
	$BlockResultset = 0;

	if(class_exists($block)){
	$blockObj = new $block;
	if(method_exists($block, $method)){
	$BlockResultset = call_user_func_array(array($blockObj,$method),array($parameters));
	}else{
	trigger_error('Function Not Found');
	//trigger function not found error
	}
	}else{
	trigger_error('Class Not Found');
	//trigger class not found error
	}
	
	return $BlockResultset;

}


private static function getActionViewFileContents($actionviewfilename){

	ob_start();
	include($actionviewfilename);
	$contents = ob_get_contents();
	ob_end_clean();
	return $contents;

}


public static function CallActionView($actionviewparameter = '', $block=false, $blockaction=false){
	
	if($block!=false){
	$block = strtolower($block);
	}

	if(is_array($actionviewparameter)){
	$actionviewparameters = implode(',',$actionviewparameter);
	}else{
	$actionviewparameters = $actionviewparameter;
	}
	
	if($block==false){
	if(!defined('_ACTION_VIEW_PARAMETER_ID')){
	define('_ACTION_VIEW_PARAMETER_ID', $actionviewparameters);
	}
	}else{
	// use of global variable as we can have more than 1 block at a time so we cannot redeclare constant
	global $_ACTION_VIEW_PARAMETER_ID;
	$_ACTION_VIEW_PARAMETER_ID = $actionviewparameters;
	}

	if(_MODULE!='' && $block==false && $blockaction==false && is_dir(PROJ_MODULES_DIR._S._MODULE._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER)){
	if(file_exists(PROJ_MODULES_DIR._S._MODULE._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S._ACTION.'.php')){
	$actionviewfileresults = self::getActionViewFileContents(PROJ_MODULES_DIR._S._MODULE._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S._ACTION.'.php');
	}else{
	trigger_error('Action Viewer File is not Present for the Module');
	}
	}


	if($block!=false && $blockaction!=false && is_dir(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER)){
	if(file_exists(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php')){
	$actionviewfileresults = self::getActionViewFileContents(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php');
	}else{
	trigger_error('Action Viewer File is not Present for the Block');
	}
	}

	return $actionviewfileresults;

}


public static function CallAjaxActionView($module, $action, $actionviewparameterid = '', $block=false){
	
	$actionviewfileresults = '';

	//if(!defined('_ACTION_VIEW_PARAMETER_ID')){
	define('_ACTION_VIEW_PARAMETER_ID', $actionviewparameterid);
	//}

	if($module!='' && is_dir(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER)){
	if(file_exists(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$action.'.php')){
	$actionviewfileresults = self::getActionViewFileContents(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$action.'.php');
	}else{
	trigger_error('Action Viewer File is not Present for the Module');
	}
	}


	if($block!=false && is_dir(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER)){
	if(file_exists(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php')){
	$actionviewfileresults = self::getActionViewFileContents(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php');
	}else{
	trigger_error('Action Viewer File is not Present for the Block');
	}
	}

	return $actionviewfileresults;

}


static function MainActionCaller(){
	if(isset($_GET)){
	if(isset($_GET['q'])){
	$q = htmlspecialchars_decode($_GET['q']);
	}else{
	$q = '';
	}
	
	$querystring = explode('/', $q);

	if(isset($querystring[0])){
	define('_MODULE', $querystring[0]);
	}else{
	define('_MODULE', '');
	}
	if(isset($querystring[1])){
	define('_ACTION', $querystring[1]);
	}else{
	define('_ACTION', '');
	}
	if(isset($querystring[2])){
	define('_PARAMETERS', $querystring[2]);
	}else{
	define('_PARAMETERS', '');
	}
	}
}



static function GetCurrentURL($fullurl = 0){
	$url = '';

	if(_MODULE!=''){
	$url = _MODULE;
	}
	if(_ACTION!=''){
	$url .= '/'._ACTION;
	}
	if(_PARAMETERS!=''){
	$url .= '/'._PARAMETERS;
	}

	
	if($fullurl == 1){
	return PROJ_MAIN_WWW_DIR._WS.self::URLCreator($url);
	}else{
	return self::URLCreator($url);
	}
}



static function MainTemplateControllerViewCaller(){

	$PROJ_NON_OVERRIDE_CONDITION = false;

	$use_main_template_modules_and_actions_array = explode(',',PROJ_MODULES_AND_ACTIONS_USEONLY_MAIN_TEMPLATE);

	for($i=0;$i<count($use_main_template_modules_and_actions_array);$i++){
	$use_main_template_modules_and_actions_subarray = explode('/',$use_main_template_modules_and_actions_array[$i]);
	$module_to_use_only_main_templete = $use_main_template_modules_and_actions_subarray[0];
	$action_to_use_only_main_templete = $use_main_template_modules_and_actions_subarray[1];
	if(_MODULE==$module_to_use_only_main_templete && _ACTION==$action_to_use_only_main_templete){
	$PROJ_NON_OVERRIDE_CONDITION = true;
	}
	}

	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_DEFAULT_CONTROLLER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_DEFAULT_CONTROLLER_FILE);
	}else if(self::IsAdminLogged() && PROJ_OVERRIDE_ADMIN_TEMPLATE == 1 && $PROJ_NON_OVERRIDE_CONDITION==false){
	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_DEFAULT_CONTROLLER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_DEFAULT_CONTROLLER_FILE);
	}
	}else{
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_DEFAULT_CONTROLLER_FILE);
	}

	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_DEFAULT_FOLDER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_DEFAULT_FOLDER_FILE);
	}else if(self::IsAdminLogged() && PROJ_OVERRIDE_ADMIN_TEMPLATE == 1 && $PROJ_NON_OVERRIDE_CONDITION==false){
	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_DEFAULT_FOLDER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_DEFAULT_FOLDER_FILE);
	}
	}else{
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_DEFAULT_FOLDER_FILE);
	}
}



static function URLCreator($string, $method = 'get', $ajaxmethod = 'get', $extrajsfunctioncall = '', $ajaxhtmlelementid = PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE, $isblock = false){
	
	$urlwithpagetitle = '';
	$stringbreak = explode('/',$string);
	$module = (isset($stringbreak[0]))?$stringbreak[0]:'';
	$action = (isset($stringbreak[1]))?$stringbreak[1]:'';
	$id = (isset($stringbreak[2]))?$stringbreak[2]:'';


	if(PROJ_FOLDERNAME==''){
	$urlpefix = PROJ_HOSTNAME._WS;
	}else{
	$urlpefix = PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS;	
	}

	switch($method){
	
	case 'post' :

	if(PROJ_SEO_FRIENDLY_URLS == 0){
	$url = $urlpefix.'?q='.$string;
	}else{
	$url = $urlpefix.$string;
	}
	break;

	case 'get' : 

	if(PROJ_SEO_FRIENDLY_URLS == 0){
	$url = $urlpefix.'?q='.$string;
	}else{
	$url = $urlpefix.$string;
	}
	break;

	case 'ajax' :
	$url = self::AjaxCaller($string, $ajaxmethod, $extrajsfunctioncall, $ajaxhtmlelementid, $isblock);
	break;
	
	}

	switch(PROJ_SEO_FRIENDLY_URLS_SETTINGS){
	
	case 1 :
	if($module=='cms' && $action=='getContent'){
	$columns = array('title');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	if($resultset = $sqlObj->FetchResult($result)){
	$urlwithpagetitle = str_replace(' ', '_', $resultset->title);
	$urlwithpagetitle = str_replace('?', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace(',', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace('&', '', $urlwithpagetitle);	
	$urlwithpagetitle = str_replace('-', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace(':', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace('__', '_', $urlwithpagetitle);
	}
	$url = $url.$urlwithpagetitle.'/';
	}
	break;

	}

	return $url;
	}



private static function AjaxCaller($url, $ajaxmethod, $extrajsfunctioncall, $ajaxhtmlelementid, $isblock){

$ajaxurl = '';

$ajaxurl = 'JavaScript:MainAjaxFunction(\''.$url.'\',\''.$ajaxmethod.'\',\''.$isblock.'\',\''.$extrajsfunctioncall.'\',\''.$ajaxhtmlelementid.'\')';

return $ajaxurl;

}


static function URLForwarder($url){
	if (!headers_sent($filename, $linenum)) {
	header('Location:'.$url);
	exit;
	}else{
	trigger_error('Headers already sent in'.$filename.'on line'.$linenum);
	exit;
	}

}


static function GetPreviousSessionMsg(){
	
	if(!self::IsSessionStarted()){
	session_start();
	}

	if(isset($_SESSION['message'])){
	$session_msg = $_SESSION['message'];
	}else{
	$session_msg = '';
	}
	session_unset();
	session_destroy();
	return $session_msg;

}


static function GetSessionMsg(){
	
	if(!self::IsSessionStarted()){
	session_start();
	}

	if(isset($_SESSION['message']) && $_SESSION['session_message_display_counter'] == 0 && $_SESSION['message'] !=''){
	$session_msg = $_SESSION['message'];
	$_SESSION['session_message_display_counter'] = 1;
	}else{
	$session_msg = '';
	$_SESSION['message'] = '';
	$_SESSION['session_message_display_counter'] = 0;
	}
return $session_msg;
}


static function CreateSession(){

	session_start();
	session_regenerate_id();
	$_SESSION['message'] = '';
	$_SESSION['session_message_display_counter'] = 0;

}

static function CheckSession(){

	if(!self::IsSessionStarted()){
	session_start();
	}

	header("cache-control: private"); //IE 6 Fix
	header("cache-Control: no-store, no-cache, must-revalidate");
	header("cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache"); 
	header("Expires: Sat, 01 Jan 1997 11:00:00 GMT"); // Date in the past

	if(isset($_SESSION['UserLoGGedIn']) && $_SESSION['UserLoGGedIn'] == 'true' && isset($_SESSION['id']) && isset($_SESSION['WSName']) && $_SESSION['WSName'] == PROJ_NAME){
	if(isset($_COOKIE) && $_COOKIE['ProjectAdmin']=='PA'.$_SESSION['username'].'pa'){
	setcookie('ProjectAdmin', 'PA'.$_SESSION['username'].'pa', time()+PROJ_SESSION_TIME_LIMIT);
	}else{
	self::DestroySession();
	self::URLForwarder(self::URLCreator('admin/'));
	}
	}else{
	self::DestroySession();
	self::URLForwarder(self::URLCreator('admin/'));
	}

}


static function DestroySession(){

	MainDB::closeDBConnection(); // Close DB Connection

	setcookie("ProjectAdmin", "PA".$_SESSION['username']."pa", time()-3600); // Delete Cookie

	unset($_SESSION['LoginForm']);
	unset($_SESSION['username']);
	unset($_SESSION['id']);
	unset($_SESSION['UserLoGGedIn']);
	unset($_SESSION['message']);
	unset($_SESSION['session_message_display_counter']);


	$_SESSION = array();
	$_COOKIE = array();

	session_unset();
	session_destroy();

}


static function GetSessionUserID(){
if(isset($_SESSION['id'])){
return $_SESSION['id'];
}
}


static private function IsAdminLogged(){
if(!self::IsSessionStarted()){
session_start();
}

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'true'){
return 1;
}else{
return 0;
}

}


static private function IsSessionStarted(){
    
return (isset($_SESSION))?true:false;

}



static function SystemPasswordReturn($password){

return(sha1(PROJ_SEC_SALT.$password.PROJ_SEC_SALT));

}


static function HTMLEditorInit($name = 'projeditor', $value = '', $css=''){

if(PROJ_HTML_EDITOR == 'ckeditor'){

echo $ajaxurl = '<script>createAjaxCKEditor();</script>';

// Include CKEditor class.
include_once(PROJ_3RDPARTY_DIR._S.'ckeditor'._S.'ckeditor.php');

// Create class instance.
$CKEditor = new CKEditor();

// Do not print the code directly to the browser, return it instead
$CKEditor->returnOutput = true;

// Path to CKEditor directory, ideally instead of relative dir, use an absolute path:
//   $CKEditor->basePath = '/ckeditor/'
// If not set, CKEditor will try to detect the correct path.

$CKEditor->basePath = PROJ_3RDPARTY_WWW_DIR._WS.'ckeditor'._WS;

// Set global configuration (will be used by all instances of CKEditor).
$CKEditor->config['width'] = 600;
$CKEditor->config['height'] = 300;

// Other Settings
$CKEditor->config['entities'] = false;
$CKEditor->config['htmlEncodeOutput'] = false;

	
if(defined('_TEMPLATE_CSS_FOR_HTMLEDITOR_CONTENTS')){
$CKEditor->config['contentsCss'] = _TEMPLATE_CSS_FOR_HTMLEDITOR_CONTENTS;
}

//$CKEditor->config['language'] = 'hi';


//Set formatting options
$CKEditor->config['toolbar'] = array(
    array( 'Source','-',
          'Cut','Copy','Paste','PasteText','PasteFromWord','-',
          'Undo','Redo','-',
          'Find','Replace','-',
          'SelectAll','RemoveFormat','-',
          'Maximize', 'ShowBlocks'),
    '/',
    array('Bold','Italic','Underline','Strike','-',
          'Subscript','Superscript','-',
          'NumberedList','BulletedList','-',
          'Outdent','Indent','Blockquote','-',
          'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-',
          'Link','Unlink','Anchor'
          ),
    '/',
    array('Image','Flash','Table','HorizontalRule','SpecialChar','Format','Font','FontSize','-','TextColor','BGColor')
);


// 3rd Party File Browser and File Uploader//
$CKEditor->config['filebrowserBrowseUrl'] = PROJ_3RDPARTY_WWW_DIR.'/kcfinder/browse.php?type=files';
$CKEditor->config['filebrowserImageBrowseUrl'] = PROJ_3RDPARTY_WWW_DIR.'/kcfinder/browse.php?type=images';
$CKEditor->config['filebrowserFlashBrowseUrl'] = PROJ_3RDPARTY_WWW_DIR.'/kcfinder/browse.php?type=flash';
$CKEditor->config['filebrowserUploadUrl'] = PROJ_3RDPARTY_WWW_DIR.'/kcfinder/upload.php?type=files';
$CKEditor->config['filebrowserImageUploadUrl'] = PROJ_3RDPARTY_WWW_DIR.'/kcfinder/upload.php?type=images';
$CKEditor->config['filebrowserFlashUploadUrl'] = PROJ_3RDPARTY_WWW_DIR.'/kcfinder/upload.php?type=flash';
// 3rd Party File Browser and File Uploader//


// Change default textarea attributes
$CKEditor->textareaAttributes = array("cols" => 80, "rows" => 20);


// Create first instance.
return $CKEditor->editor($name, $value);


}else if(PROJ_HTML_EDITOR == 'tinymce'){

echo '<!-- TinyMCE -->
<script type="text/javascript" src="'.PROJ_3RDPARTY_WWW_DIR._WS.'tinymce'._WS.'jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		editor_selector : "'.$name.'"
	});
</script>
<!-- /TinyMCE -->';

}
return '<textarea name="'.$name.'" class="'.$name.'" style="width:100%">
        </textarea>';
}


static function SyntaxHighlighterInit(){
	if(file_exists(PROJ_3RDPARTY_DIR._S.'syntaxhighlighter'._S.'scripts'._S.'shCore.js')){
	echo('<script type="text/javascript" src="'.PROJ_3RDPARTY_WWW_DIR._WS.'syntaxhighlighter'._WS.'scripts'._WS.'shCore.js"'.'></script>');
	}
	if(file_exists(PROJ_3RDPARTY_DIR._S.'syntaxhighlighter'._S.'scripts'._S.'shBrushPhp.js')){
	echo('<script type="text/javascript" src="'.PROJ_3RDPARTY_WWW_DIR._WS.'syntaxhighlighter'._WS.'scripts'._WS.'shBrushPhp.js"'.'></script>');
	}
	if(file_exists(PROJ_3RDPARTY_DIR._S.'syntaxhighlighter'._S.'styles'._S.'shCoreDefault.css')){
	echo('<link rel="stylesheet" type="text/css" href="'.PROJ_3RDPARTY_WWW_DIR._WS.'syntaxhighlighter'._WS.'styles'._WS.'shCoreDefault.css" />');
	}

	echo '<script type="text/javascript">SyntaxHighlighter.all();</script>';
}


static function FileUploader($originalfilename='', $pathtoupload='', $finalfilename=''){

			$output = '';
			$uploaded_file_name = $_FILES[$originalfilename]["name"];
			$uploaded_file_temp_name = $_FILES[$originalfilename]["tmp_name"];

			$extension = explode(".",$uploaded_file_name);
			$ext_type = strtolower(end($extension));
			
			$allowed_files_array = explode(',',PROJ_ALLOWED_UPLOAD_FILE_TYPES);

			if(in_array($ext_type,$allowed_files_array)){
			$target_path = $pathtoupload._S.$finalfilename;

			if(move_uploaded_file($uploaded_file_temp_name, $target_path)) {
				$output .= 'The file '.  basename($uploaded_file_name). 
				' has been uploaded as ' .$finalfilename. '<br />';
			}else{
				$output .= 'There was an error uploading the file: '.basename($uploaded_file_name).', please try again! : <br /> ERROR = '.$_FILES[$originalfilename]["error"].'<br />';
			}

			}else{ // if not the correct file type
			$output .= 'The file type for: '.basename($uploaded_file_name).' is invalid, please try again!, Please upload only '.PROJ_ALLOWED_UPLOAD_FILE_TYPES.' files. <br />';
			}
			
			return $output;
			
	}



static function FileDelete($path='', $filename=''){

			$output = '';
			$extension = explode(".",$filename);
			$ext_type = strtolower(end($extension));
			$allowed_files_array = explode(',',PROJ_ALLOWED_UPLOAD_FILE_TYPES);

			if(in_array($ext_type,$allowed_files_array)){
			$target_path = $path._S.$filename;

			if(unlink($target_path)) {
				$output .= 'The file '.  basename($filename). 
				' has been Deleted<br />';
			}else{
				$output .= 'There was an error in Deleting the File: '.basename($filename).', please try again!';
			}

			}else{ // if not the correct file type
			$output .= 'The file type for: '.basename($uploaded_file_name).' is invalid, please try again!, You Can Delete only '.PROJ_ALLOWED_UPLOAD_FILE_TYPES.' files. <br />';
			}
			
			return $output;
			
	}



} // class MainSystem