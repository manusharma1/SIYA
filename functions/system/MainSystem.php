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

class MainSystem
{

private static $lang;

static function IncludeSystemLanguage(){

	if(file_exists(PROJ_MAIN_DIR._S.PROJ_DEFAULT_LANGUAGE_FOLDER._S.'siya.'.PROJ_LANGUAGE.'.php')){
	include_once(PROJ_MAIN_DIR._S.PROJ_DEFAULT_LANGUAGE_FOLDER._S.'siya.'.PROJ_LANGUAGE.'.php');	
	}
	
	global $lang;
	self::$lang = $lang;
}



static function checkSIYASetup(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = 'SIYA_SETUP_DONE';
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'mainsystemconfig', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	if($resultset->value == 1){
	return 1;
	}
	}else{
	return 0;
	}
	}else{
	return 0;
	}
	}else{
	return 0;
	}
}


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


static function SelectTemplatePDO(){
	
	$columns = array('value');
	$conditions = array();
	$conditions['=']['name'] = array('template','STR');
	$conditions['AND =']['isactive'] = array(1,'BOOL');
	$sqlObj = new MainSQL();
	$sqlreturnarray = $sqlObj->SQLCreatorPDO('S', 'config', $columns, $conditions, '', '', '');

	$sth = $sqlObj->FireSQL($sqlreturnarray['sql']);
	$sqlObj->PDOBindValues($sth,$sqlreturnarray['valuearray']);
	$sth->execute();
	
	$values = $sth->fetch(PDO::FETCH_OBJ);

	if($resultset = $sth->fetch(PDO::FETCH_OBJ)){
	if(is_dir(PROJ_TEMPLATES_DIR._S.$resultset->value)){
	define('PROJ_DEFAULT_TEMPLATE_DIR',$resultset->value);
	}else{
	$pdoerror = $sth->errorInfo();
	print_r($pdoerror);
	return 0;
	}
	}
	else{
	// Trigger Error
	return 0;
	}
}


static function SelectTemplatePDO2(){
	
	
	$columns = array('g.id','g.grouptypetag','g.name');
	$conditions = array();

	$tables = array();
	$tables['subjects'] = 's';
	$tables['groups'] = 'g';

	$conditions['=']['s.id'] = array(3,'INT');
	$conditions['K AND =']['s.groupid'] = array('g.id');

	$sqlObj = new MainSQL();

	$sqlreturnarray = $sqlObj->SQLCreatorJPDO('S', $tables, $columns, $conditions, '', '', '');

	$sth = $sqlObj->FireSQL($sqlreturnarray['sql']);
	$sqlObj->PDOBindValues($sth,$sqlreturnarray['valuearray']);
	$sth->execute();
	
	$resultset = $sth->fetch(PDO::FETCH_OBJ);

	print_r($resultset);die;

	if($resultset = $sth->fetch(PDO::FETCH_OBJ)){
	if(is_dir(PROJ_TEMPLATES_DIR._S.$resultset->value)){
	define('PROJ_DEFAULT_TEMPLATE_DIR',$resultset->value);
	}else{
	$pdoerror = $sth->errorInfo();
	print_r($pdoerror);
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
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_NOT_EXISTS'],array($resultset->value)));
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
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_NOT_EXISTS'],array($resultset->value)));
	// Trigger Non Existing Block Directory Error
	return 0;
	}
	}
}



static function CallBlocks($blockposition='',$blockdisplay='ALL'){

	$blocksdata = '';

	$columns = array('id','block','blockaction','blocktitle');
	$conditions = array();
	$conditions['=']['blockposition'] = $blockposition;
	$conditions['AND =']['isactive'] = '1';
	$conditions['AND ()']['blockdisplay'] = 'ALL';
	$conditions['OR =']['blockdisplay'] = $blockdisplay;
	$sqlObj = new MainSQL();
	$MainSystemObj = new MainSystem();
	$sql = $sqlObj->SQLCreator('SD', 'blocksinstances', $columns, $conditions, 'orderid', '', '');
	$result = $sqlObj->FireSQL($sql);
	while($resultset = $sqlObj->FetchResult($result)){
	
	$columns2 = array('type','userids','actionview','entitytypetag','usertypetag','grouptypetag');
	$conditions2 = array();
	$conditions2['=']['blocksinstancesid'] = $resultset->id;
	$conditions2['AND =']['isactive'] = '1';
	$sql2 = $sqlObj->SQLCreator('S', 'blocksinstancessettings', $columns2, $conditions2, '', '', '');
	$result2 = $sqlObj->FireSQL($sql2);
	while($resultset2 = $sqlObj->FetchResult($result2)){

	$useridarray = explode(',',$resultset2->userids);
	$grouparray = explode(',',$resultset2->grouptypetag);
	$usertypetagarray = explode(',',$resultset2->usertypetag);
	$entitytypetagarray = explode(',',$resultset2->entitytypetag);
	$actionviewarray = explode(',',$resultset2->actionview);


	$loggedinuserdetailsarray = self::getLoggedinUserDetails();
	$usergroupid = self::getUserSelectedGroupIDBySelectedBatchID();


	if($resultset2->type=='SHOW'){
	
	$show = 0;

	if(isset($_SESSION['UserLoGGedIn'])){
	if(in_array($loggedinuserdetailsarray->id, $useridarray)){
	$show = 1;
	}else if(in_array($usergroupid, $grouparray)){
	$show = 1;
	}else if(in_array($loggedinuserdetailsarray->entitytypetag, $entitytypetagarray)){
	$show = 1;
	}else if(in_array($loggedinuserdetailsarray->usertypetag, $usertypetagarray)){
	$show = 1;
	}
	}

	if(in_array(_ACTION, $actionviewarray)){
	$show = 1;
	}

	if($resultset2->userids == '' && $resultset2->actionview == '' && $resultset2->entitytypetag == '' && $resultset2->usertypetag == '' && $resultset2->grouptypetag == ''){ // If nothing has been specified, so the SHOW is applicable for Everyone //
	$show = 1;
	}
	
	}

	

	if($resultset2->type=='HIDE'){
	
	$show = 1;

	if(isset($_SESSION['UserLoGGedIn'])){
	if(in_array($loggedinuserdetailsarray->id, $useridarray)){
	$show = 0;
	}else if(in_array($usergroupid, $grouparray)){
	$show = 0;
	}else if(in_array($loggedinuserdetailsarray->entitytypetag, $entitytypetagarray)){
	$show = 0;
	}else if(in_array($loggedinuserdetailsarray->usertypetag, $usertypetagarray)){
	$show = 0;
	}
	}

	if(in_array(_ACTION, $actionviewarray)){
	$show = 0;
	}
	
	if($resultset2->userids == '' && $resultset2->actionview == '' && $resultset2->entitytypetag == '' && $resultset2->usertypetag == '' && $resultset2->grouptypetag == ''){ // If nothing has been specified, so the HIDE is applicable for Everyone //
	$show = 0;
	}

	}


	}
	

	if(isset($show) && $show==1){

	$blockaction = ($resultset->blockaction=='')?'SIYA__Default_'.$resultset->block.'_Action':$resultset->blockaction;
	$blocksdata .= $MainSystemObj->CallBlock($resultset->block,$blockaction, array($resultset->id,$resultset->blocktitle));

	}


	}

	return $blocksdata;
}



static function getUserSelectedGroupIDBySelectedBatchID(){

	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
	$loggedinuserid = self::GetSessionUserID();

	$columns = array('groupid');
	$conditions = array();
	$conditions['=']['userid'] = $loggedinuserid;
	$conditions['AND =']['batchid'] = $selected_batch_id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'usersingroup', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	if($resultset = $sqlObj->FetchResult($result)){
	return $resultset->groupid;
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
	self::IncludeModuleLanguage($module);
	$module_init_method = 'SIYA__'.$module.'_INIT__';
	if(method_exists($moduleObj, $module_init_method)){
	call_user_func_array(array($moduleObj,$module_init_method),array());
	}
	$ModuleResultset = call_user_func_array(array($moduleObj,$method),array($parameters));
	$parametersstr = implode(',',$parameters);
	self::SystemLogRecorder('module',(string)$module,(string)$method,(string)$parametersstr);
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['FOUNCTION_NOT_FOUND'],array()));
	//trigger function not found error
	}
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_CLASS_NOT_EXISTS'],array($module)));
	//trigger class not found error
	}
	
	return $ModuleResultset;

}


public function CallBlock($block = '', $method = '', $parameters = ''){
	
	$BlockResultset = 0;

	if(class_exists($block)){
	$blockObj = new $block;
	if(method_exists($block, $method)){
	self::IncludeBlockLanguage($block);
	$BlockResultset = call_user_func_array(array($blockObj,$method),array($parameters));
	$parametersstr = implode(',',$parameters);
	self::SystemLogRecorder('block',(string)$block,(string)$method,(string)$parametersstr);
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['FOUNCTION_NOT_FOUND'],array()));
	//trigger function not found error
	}
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_CLASS_NOT_EXISTS'],array($block)));
	//trigger class not found error
	}
	
	return $BlockResultset;

}


protected static function SystemInstallModule($module){
	
	require_once(PROJ_MODULES_DIR._S.$module._S.$module.'.php');
	
	// This function may be changed in later stages, Please review the technical and other aspects //

	if(class_exists($module)){
	$module_installer_method = 'SIYA__'.$module.'_INSTALLER__';
	$moduleInstallerObj = new $module;

	if(method_exists($module, $module_installer_method)){
	$ModuleInstallerResultset = call_user_func_array(array($moduleInstallerObj,$module_installer_method),array());
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['INSTALLER_FOUNCTION_NOT_FOUND'],array($module)));
	die;
	//trigger function not found error
	}
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_CLASS_NOT_EXISTS'],array($module)));
	die;
	//trigger class not found error
	}
	

	$mainallowedtagsarray = array('module','action');
	
	$moduleallowedtagsarray = array('info');

	$methodsallowedarray = array_diff(get_class_methods($module),array($module_installer_method));

	$sqlarray = array();
	
	foreach($ModuleInstallerResultset as $modulekey1 => $modulevalue1){
	$module_tags = $modulekey1; // (example module or action) // module specific information or action specific information //
	
	if(in_array($module_tags,$mainallowedtagsarray)){

	foreach($modulevalue1 as $modulekey2 => $modulevalue2){
	$module_tags_key = $modulekey2; // (info for Module and actionnames for action)

	if($module_tags=='module' && in_array($module_tags_key,$moduleallowedtagsarray) || $module_tags=='action' && in_array($module_tags_key,$methodsallowedarray)){
	
	if($module_tags=='module'){
	$moduledescription = $modulevalue2['description'];
	}else{
	$moduledescription = '';
	}

	if($module_tags=='action'){
	$actionusertypeaccess = $modulevalue2['usertypeaccess'];
	$actiontemplateaccess = $modulevalue2['templateaccess'];
	$actiondescription = $modulevalue2['description'];
	}else{
	$actionusertypeaccess = '';
	$actiontemplateaccess = '';
	$actiondescription = '';
	}
	

	}else{
	if($module_tags=='module'){
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_INSTALLER_METHOD_NOT_FOUND'],array($module,$module_installer_method)));
	die;
	}
	
	if($module_tags=='action'){
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_ACTION_INSTALLER_METHOD_NOT_FOUND'],array($module,$module_installer_method)));
	die;
	}
	}
	

	if($module_tags=='action'){
	$data = array();	
	$data['type'] = 'module';
	$data['typename'] = $module;
	$data['actionname'] = $module_tags_key;
	$data['usertypeaccess'] = $actionusertypeaccess;
	$data['templateaccess'] = $actiontemplateaccess;
	$data['description'] = $actiondescription;
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = self::GetSessionUserID();
	$data['isactive'] = '1';
	

	$sqlObj = new MainSQL();
	$sqlarray[] = array('modulefunction'=>$module_tags_key,'sql'=>$sqlObj->SQLCreator('I', 'actionsconfig', $data, '', '', '', ''));
	}
	
	}
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_TAG_INSTALLER_METHOD_NOT_FOUND'],array($module,$module_installer_method)));
	die;
	}
		
	}
	

	$returnmessage = '';

	foreach($sqlarray as $sqlkey => $sqlvalue){
	foreach($sqlvalue as $sqlkey2 => $sqlvalue2){
	}	
	if($result = $sqlObj->FireSQL($sqlvalue2)){
	$returnmessage .= $sqlvalue2.'<br />';
	$returnmessage .= $sqlvalue['modulefunction'] .self::ReturnLocalisationString(self::$lang['siya']['ACTION_ADDED_INTO_THE_DATABASE'],array()).'<br /><hr />';
	}else{
	$returnmessage .= $sqlvalue2.'<br />';
	$returnmessage .= $sqlvalue['modulefunction'].trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_ADDING_ACTION_INTO_THE_DATABASE'],array())).'<br /><hr />';
	//return $returnmessage;
	// Delete all the added values when this error comes, ROLLBACK //
	}
	}

	// CHECK IF THE MODULE ENTRY EXIST IN THE CONFIG FILE //

	$columns = array('value');
	$data = array();	
	$data['name'] = 'module';
	$data['value'] = $module;

	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['value'] = $module;
	$conditions['AND =']['iscore'] = '0';

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)==0){

	$data = array();	
	$data['name'] = 'module';
	$data['value'] = $module;
	$data['description'] = $moduledescription;
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = self::GetSessionUserID();
	$data['isinstalled'] = '1';
	$data['isactive'] = '1';
	
	$sql2 = $sqlObj->SQLCreator('I', 'config', $data, '', '', '', '');
	
	}else{

	$data = array();
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = self::GetSessionUserID();
	$data['isinstalled'] = '1';
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['value'] = $module;
	$conditions['AND =']['iscore'] = '0';

	$sql2 = $sqlObj->SQLCreator('U', 'config', $data, $conditions, '', '', '');
	

	}

	$returnmessage .= '<br /><br /><br /><br /><hr />';

	if($result2 = $sqlObj->FireSQL($sql2)){
	$returnmessage .= $sql2.'<br />';
	$returnmessage .= self::ReturnLocalisationString(self::$lang['siya']['MODULE_HAS_BEEN_SUCCESSFULLY_INSTALLED'],array($module)).'<br /><hr />';
	}else{
	$returnmessage .= $sql2.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_INSTALLING_MODULE_INTO_THE_DATABASE'],array())).'<br /><hr />';
	}

	
	}


	return $returnmessage;

}




protected static function SystemInstallBlock($block){
	
	require_once(PROJ_BLOCKS_DIR._S.$block._S.$block.'.php');
	
	// This function may be changed in later stages, Please review the technical and other aspects //

	if(class_exists($block)){
	$block_installer_method = 'SIYA__'.$block.'_INSTALLER__';
	$blockInstallerObj = new $block;

	if(method_exists($block, $block_installer_method)){
	$BlockInstallerResultset = call_user_func_array(array($blockInstallerObj,$block_installer_method),array());
	}else{
	trigger_error($block.self::ReturnLocalisationString(self::$lang['siya']['INSTALLER_FOUNCTION_NOT_FOUND'],array()));
	die;
	//trigger function not found error
	}
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_CLASS_NOT_FOUND'],array()));
	die;
	//trigger class not found error
	}
	
	// Modified 09 Oct 2013

	$blockdescription = ''; 
	$actionusertypeaccess = '';
	$actiontemplateaccess = '';
	$actiondescription = '';

	// Modified 09 Oct 2013

	$mainallowedtagsarray = array('block','action');
	
	$blockallowedtagsarray = array('info');

	$methodsallowedarray = array_diff(get_class_methods($block),array($block_installer_method));

	$sqlarray = array();
	
	foreach($BlockInstallerResultset as $blockkey1 => $blockvalue1){
	$block_tags = $blockkey1; // (example module or action) // module specific information or action specific information //
	
	if(in_array($block_tags,$mainallowedtagsarray)){

	foreach($blockvalue1 as $blockkey2 => $blockvalue2){
	$block_tags_key = $blockkey2; // (info for Block and actionnames for action)

	if($block_tags=='block' && in_array($block_tags_key,$blockallowedtagsarray) || $block_tags=='action' && in_array($block_tags_key,$methodsallowedarray)){
	
	if($block_tags=='block'){
	$blockdescription = $blockvalue2['description'];
	}


	if($block_tags=='action'){
	$actionusertypeaccess = $blockvalue2['usertypeaccess'];
	$actiontemplateaccess = $blockvalue2['templateaccess'];
	$actiondescription = $blockvalue2['description'];
	}else{
	$actionusertypeaccess = '';
	$actiontemplateaccess = '';
	$actiondescription = '';
	}
	

	}else{
	if($block_tags=='block'){
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_INSTALLER_METHOD_NOT_FOUND'],array($block,$block_installer_method)));
	die;
	}

	if($block_tags=='action'){
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_ACTION_INSTALLER_METHOD_NOT_FOUND'],array($block,$block_installer_method)));
	die;
	}
	}
	

	if($block_tags=='action'){
	$data = array();	
	$data['type'] = 'block';
	$data['typename'] = $block;
	$data['actionname'] = $block_tags_key;
	$data['usertypeaccess'] = $actionusertypeaccess;
	$data['templateaccess'] = $actiontemplateaccess;
	$data['description'] = $actiondescription;
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = self::GetSessionUserID();
	$data['isactive'] = '1';


	$sqlObj = new MainSQL();
	$sqlarray[] = array('blockfunction'=>$block_tags_key,'sql'=>$sqlObj->SQLCreator('I', 'actionsconfig', $data, '', '', '', ''));
	}
	
	}
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_TAG_INSTALLER_METHOD_NOT_FOUND'],array($block,$block_installer_method)));
	die;
	}
		
	}
	

	$returnmessage = '';

	foreach($sqlarray as $sqlkey => $sqlvalue){
	foreach($sqlvalue as $sqlkey2 => $sqlvalue2){
	}	
	if($result = $sqlObj->FireSQL($sqlvalue2)){
	$returnmessage .= $sqlvalue2.'<br />';
	//$returnmessage .= $sqlvalue['blockfunction'] .trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ACTION_ADDED_INTO_THE_DATABASE'],array())).'<br /><hr />';
	}else{
	//$returnmessage .= $sqlvalue2.'<br />';
	$returnmessage .= $sqlvalue['blockfunction'].trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_ADDING_ACTION_INTO_THE_DATABASE'],array())).'<br /><hr />';
	//return $returnmessage;
	// Delete all the added values when this error comes, ROLLBACK //
	}
	}


	$data = array();	
	$data['name'] = 'block';
	$data['value'] = $block;
	$data['description'] = $blockdescription;
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = self::GetSessionUserID();
	$data['isinstalled'] = '1';
	$data['isactive'] = '1';

	
	$sql2 = $sqlObj->SQLCreator('I', 'config', $data, '', '', '', '');

	$returnmessage .= '<br /><br /><br /><br /><hr />';

	if($result2 = $sqlObj->FireSQL($sql2)){
	$returnmessage .= $sql2.'<br />';
	$returnmessage .= self::ReturnLocalisationString(self::$lang['siya']['BLOCK_HAS_BEEN_SUCCESSFULLY_INSTALLED'],array($block)).'<br /><hr />';
	}else{
	$returnmessage .= $sql2.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_INSTALLING_BLOCK_INTO_THE_DATABASE'],array())).'<br /><hr />';
	}

	return $returnmessage;

}



protected static function SystemUnInstallModule($module){
	

	$returnmessage = '';
	$returnmessage .= '<br /><hr />';	

	$conditions = array();
	$conditions['=']['type'] = 'module';
	$conditions['AND =']['typename'] = $module;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'actionsconfig', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$returnmessage .= $sql.'<br />';
	$returnmessage .= self::ReturnLocalisationString(self::$lang['siya']['ACTIONS_ENTRIES_HAS_BEEN_SUCCESSFULLY_UNINSTALLED'],array($module)).'<br /><hr />';
	

	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['value'] = $module;
	$conditions['AND =']['iscore'] = '0';


	$sql2 = $sqlObj->SQLCreator('D', 'config', '', $conditions, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	$returnmessage .= $sql.'<br />';
	$returnmessage .= self::ReturnLocalisationString(self::$lang['siya']['MODULE_ENTRIES_HAS_BEEN_SUCCESSFULLY_UPDATED'],array($module)).'<br /><hr />';
	}else{
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_UNINSTALLING_MODULE_FROM_THE_DATABASE'],array())).'<br /><hr />';
	}
	
	}else{
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_UNINSTALLING_MODULE_ACTIONS_FROM_THE_DATABASE'],array())).'<br /><hr />';
	}

	return $returnmessage;

}



protected static function SystemUnInstallBlock($block){
	

	$returnmessage = '';
	$returnmessage .= '<br /><hr />';	

	$conditions = array();
	$conditions['=']['type'] = 'block';
	$conditions['AND =']['typename'] = $block;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'actionsconfig', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$returnmessage .= $sql.'<br />';
	$returnmessage .= self::ReturnLocalisationString(self::$lang['siya']['ACTIONS_ENTRIES_HAS_BEEN_SUCCESSFULLY_UNINSTALLED'],array($block)).'<br /><hr />';
	

	$conditions = array();
	$conditions['=']['name'] = 'block';
	$conditions['AND =']['value'] = $block;
	$conditions['AND =']['iscore'] = '0';

	$sql2 = $sqlObj->SQLCreator('D', 'config', '', $conditions, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	$returnmessage .= $sql2.'<br />';
	$returnmessage .= self::ReturnLocalisationString(self::$lang['siya']['BLOCK_HAS_BEEN_SUCCESSFULLY_UNINSTALLED'],array($block)).'<br /><hr />';
	}else{
	$returnmessage .= $sql2.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_UNINSTALLING_BLOCK_FROM_THE_DATABASE'],array())).'<br /><hr />';
	}
	
	}else{
	$returnmessage .= $sql2.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_UNINSTALLING_BLOCK_ACTIONS_FROM_THE_DATABASE'],array())).'<br /><hr />';
	}

	return $returnmessage;

}


protected static function SystemDeactivateModule($module){
	

	$returnmessage = '';
	$returnmessage .= '<br /><hr />';	

	$data = array();
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = self::GetSessionUserID();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['value'] = $module;
	$conditions['AND =']['iscore'] = '0';

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('U', 'config', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_HAS_BEEN_SUCCESSFULLY_DEACTIVATED'],array($module))).'<br /><hr />';
	}else{
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_DEACTIVATING_MODULE'],array())).'<br /><hr />';
	}

	return $returnmessage;

}



protected static function SystemDeactivateBlock($block){
	

	$returnmessage = '';
	$returnmessage .= '<br /><hr />';	

	$data = array();
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = self::GetSessionUserID();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['name'] = 'block';
	$conditions['AND =']['value'] = $block;
	$conditions['AND =']['iscore'] = '0';

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('U', 'config', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_HAS_BEEN_SUCCESSFULLY_DEACTIVATED'],array($block))).'<br /><hr />';
	}else{
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_DEACTIVATING_BLOCK'],array())).'<br /><hr />';
	}

	return $returnmessage;

}



protected static function SystemActivateModule($module){
	

	$returnmessage = '';
	$returnmessage .= '<br /><hr />';	

	$data = array();
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = self::GetSessionUserID();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['name'] = 'module';
	$conditions['AND =']['value'] = $module;
	$conditions['AND =']['iscore'] = '0';

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('U', 'config', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['MODULE_HAS_BEEN_SUCCESSFULLY_ACTIVATED'],array($module))).'<br /><hr />';
	}else{
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_ACTIVATING_MODULE'],array())).'<br /><hr />';
	}

	return $returnmessage;

}



protected static function SystemActivateBlock($block){
	

	$returnmessage = '';
	$returnmessage .= '<br /><hr />';	

	$data = array();
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = self::GetSessionUserID();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['name'] = 'block';
	$conditions['AND =']['value'] = $block;
	$conditions['AND =']['iscore'] = '0';

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('U', 'config', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['BLOCK_HAS_BEEN_SUCCESSFULLY_ACTIVATED'],array($block))).'<br /><hr />';
	}else{
	$returnmessage .= $sql.'<br />';
	$returnmessage .= trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ERROR_WHILE_ACTIVATING_BLOCK'],array())).'<br /><hr />';
	}

	return $returnmessage;

}


static private function getActionViewFileContents($actionviewfilename){

	ob_start();
	global $lang;
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
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ACTION_VIEWER_FILE_IS_NOT_PRESENT_FOR_THE_MODULE'],array()));	
	}
	}


	if($block!=false && $blockaction!=false && is_dir(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER)){
	if(file_exists(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php')){
	$actionviewfileresults = self::getActionViewFileContents(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php');
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ACTION_VIEWER_FILE_IS_NOT_PRESENT_FOR_THE_BLOCK'],array()));	
	}
	}

	return $actionviewfileresults;

}


public static function CallOtherActionView($module = '', $otheraction = '', $actionviewparameter = ''){

	if(is_array($actionviewparameter)){
	$actionviewparameters = implode(',',$actionviewparameter);
	}else{
	$actionviewparameters = $actionviewparameter;
	}
	
	if(!defined('_ACTION_VIEW_PARAMETER_ID')){
	define('_ACTION_VIEW_PARAMETER_ID', $actionviewparameters);
	}
	
	if($module!='' && is_dir(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER)){
	if(file_exists(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$otheraction.'.php')){
	$actionviewfileresults = self::getActionViewFileContents(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$otheraction.'.php');
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ACTION_VIEWER_FILE_IS_NOT_PRESENT'],array()));	
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
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ACTION_VIEWER_FILE_IS_NOT_PRESENT_FOR_THE_MODULE'],array()));	
	}
	}


	if($block!=false && is_dir(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER)){
	if(file_exists(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php')){
	$actionviewfileresults = self::getActionViewFileContents(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_ACTIONVIEWS_FOLDER._S.$blockaction.'.php');
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['ACTION_VIEWER_FILE_IS_NOT_PRESENT_FOR_THE_BLOCK'],array()));	
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


static function IncludeModuleLanguage($module=''){
	global $lang;
	if(file_exists(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_LANGUAGE_FOLDER._S.$module.'.'.PROJ_LANGUAGE.'.php')){
	include_once(PROJ_MODULES_DIR._S.$module._S.PROJ_DEFAULT_LANGUAGE_FOLDER._S.$module.'.'.PROJ_LANGUAGE.'.php');	
	}
}



static function IncludeBlockLanguage($block=''){
	global $lang;
	if(file_exists(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_LANGUAGE_FOLDER._S.$block.'.'.PROJ_LANGUAGE.'.php')){
	include_once(PROJ_BLOCKS_DIR._S.$block._S.PROJ_DEFAULT_LANGUAGE_FOLDER._S.$block.'.'.PROJ_LANGUAGE.'.php');	
	}
}


static function SystemLogRecorder($type='', $name='', $action='', $parameters=''){
	
	if(PROJ_RECORD_LOGS==1){

	$data = array();	
	$data['type'] = $type;
	$data['name'] = $name;
	$data['action'] = $action;
	$data['parameters'] = $parameters;
	$data['userid'] = self::GetSessionUserID();
	$data['datetime'] = date('Y-m-d H:i:s');
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$data['ipaddress'] = $ipaddress;	
	$data['hostname'] = $hostname;
	
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('I', 'logs', $data, '', '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	trigger_error(__FUNCTION__.trigger_error(self::ReturnLocalisationString(self::$lang['siya']['LOGS_RECORDING_NOT_SAVED'],array())));
	}
	}else{
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['LOGS_RECORDING_SETTINGS_IS_NOT_ON'],array()));
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

	global $lang;


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

	if(isset($_GET['USE_TEMPLATE']) && $_GET['USE_TEMPLATE'] != ''){
	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.$_GET['USE_TEMPLATE']._S.PROJ_DEFAULT_CONTROLLER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.$_GET['USE_TEMPLATE']._S.PROJ_DEFAULT_CONTROLLER_FILE);
	}
	}else{
	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_DEFAULT_CONTROLLER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_DEFAULT_CONTROLLER_FILE);
	}else if(self::IsAdminLogged() && PROJ_OVERRIDE_ADMIN_TEMPLATE == 1 && $PROJ_NON_OVERRIDE_CONDITION==false){
	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_DEFAULT_CONTROLLER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_DEFAULT_CONTROLLER_FILE);
	}
	}else{
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_DEFAULT_CONTROLLER_FILE);
	}
	}

	if(isset($_GET['USE_TEMPLATE']) && $_GET['USE_TEMPLATE'] != ''){
	if(file_exists(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.$_GET['USE_TEMPLATE']._S.PROJ_DEFAULT_FOLDER_FILE)){
	include_once(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.$_GET['USE_TEMPLATE']._S.PROJ_DEFAULT_FOLDER_FILE);
	}
	}else{
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

}



static function URLCreator($string, $method = 'get', $ajaxmethod = 'get', $extrajsfunctioncall = '', $ajaxhtmlelementid = PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE, $isblock = false){
	
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
	$urlwithpagetitle = '';
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
	}else if($module=='blogs' && $action=='getBlogContent'){
	$urlwithpagetitle = '';
	$columns = array('title','userid');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	if($resultset = $sqlObj->FetchResult($result)){
	$urlwithpagetitle = str_replace(' ', '_', $resultset->title);
	$urlwithpagetitle = str_replace('?', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace(',', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace('&', '', $urlwithpagetitle);	
	$urlwithpagetitle = str_replace('-', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace(':', '', $urlwithpagetitle);
	$urlwithpagetitle = str_replace('__', '_', $urlwithpagetitle);
	$userdetails = MainSystem::getUserDetailsByID($resultset->userid);
	$authorname = $userdetails->fname.'_'.$userdetails->mname.'_'.$userdetails->lname;
	}
	$url = $url.$authorname.'/'.$urlwithpagetitle.'/';
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
	trigger_error(self::ReturnLocalisationString(self::$lang['siya']['HEADERS_ALREADY_SENT'],array($filename,$linenum)));
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


static function CreateFronendSession(){
	
	if(!self::IsSessionStarted()){
	session_start();
	$_SESSION['frontuser'] = 'true';
	}
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
	$cookiename = 'ProjectAdmin_'.$_SESSION['username'];
	if(isset($_COOKIE) && $_COOKIE[$cookiename]=='PA'.$_SESSION['username'].'pa'){
	setcookie($cookiename, 'PA'.$_SESSION['username'].'pa', time()+PROJ_SESSION_TIME_LIMIT);
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

	$cookiename = 'ProjectAdmin_'.$_SESSION['username'];

	setcookie($cookiename, 'PA'.$_SESSION['username'].'pa', time()-(PROJ_SESSION_TIME_LIMIT+3600)); // Delete Cookie

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



static function getLoggedinUserDetails(){

$columns = array('id','usertypetag','entitytypetag','username','fname','mname','lname','email');
$conditions = array();
$conditions['=']['id'] = self::GetSessionUserID();
$conditions['AND =']['isactive'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
if(!empty($resultset)){
return $resultset;
}
}

}


static function getUserDetailsByID($id = ''){

$columns = array('id','usertypetag','entitytypetag','username','fname','mname','lname','email');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
if(!empty($resultset)){
return $resultset;
}
}

}



static function isUserExistsbyGroupandBatch($userid = '', $groupid = '', $batchid = ''){

$columns = array('id');
$conditions = array();
$conditions['=']['userid'] = $userid;
$conditions['AND =']['batchid'] = $groupid;
$conditions['AND =']['groupid'] = $batchid;

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'usersingroup', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
if($sqlObj->getNumRows($result)!=0){
return 1;
}else{
return 0;
}
}

}


static function getUserDetailsbyGroupandBatch($userid = '', $groupid = '', $batchid = ''){

$columns = array('rollno');
$conditions = array();
$conditions['=']['userid'] = $userid;
$conditions['AND =']['batchid'] = $batchid;
$conditions['AND =']['groupid'] = $groupid;

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'usersingroup', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
if(!empty($resultset)){
return $resultset;
}
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


static private function IsFrontUser(){
if(!self::IsSessionStarted()){
session_start();
}

if(isset($_SESSION['frontuser']) && $_SESSION['frontuser'] == 'true'){
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
$CKEditor->config['width'] = 450;
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


static function FileUploader($originalfilename='', $pathtoupload='', $finalfilename='', $createthumb=false, $thumbwidth='100'){

			$output = '';
			$uploaded_file_name = $_FILES[$originalfilename]["name"];
			$uploaded_file_temp_name = $_FILES[$originalfilename]["tmp_name"];

			//echo self::returnMIMEType($uploaded_file_name);die;

			$extension = explode(".",$uploaded_file_name);
			$ext_type = strtolower(end($extension));
			
			$allowed_files_array = explode(',',PROJ_ALLOWED_UPLOAD_FILE_TYPES);

			if(in_array($ext_type,$allowed_files_array)){
			$target_path = $pathtoupload._S.$finalfilename;

			if(move_uploaded_file($uploaded_file_temp_name, $target_path)) {
				$output .= 'The file '.  basename($uploaded_file_name). 
				' has been uploaded as ' .$finalfilename. '<br />';
			
			if($createthumb==true){
			$sourcefile = $target_path;
			$thumbdestination = $pathtoupload._S.'thumbs';

			if(!is_dir($thumbdestination)){
			mkdir($thumbdestination);
			}

			$thumbdestinationfile = $thumbdestination._S.$finalfilename;

			self::createThumbImage($sourcefile,$thumbdestinationfile,$thumbwidth);
			}
			
			}else{
				$output .= 'There was an error uploading the file: '.basename($uploaded_file_name).', please try again! : <br /> ERROR = '.$_FILES[$originalfilename]["error"].'<br />';
			}

			}else{ // if not the correct file type
			$output .= 'The file type for: '.basename($uploaded_file_name).' is invalid, please try again!, Please upload only '.PROJ_ALLOWED_UPLOAD_FILE_TYPES.' files. <br />';
			}
			
			return $output;
			
	}

static function FileUploaderMultiple($originalfilename='', $key='', $pathtoupload='', $finalfilename='', $createthumb=false, $thumbwidth='100',$addcurrentdateafterfilename=false){

			$output = '';
			$uploaded_file_name = $_FILES[$originalfilename]["name"][$key];
			$uploaded_file_temp_name = $_FILES[$originalfilename]["tmp_name"][$key];

			//echo self::returnMIMEType($uploaded_file_name);die;

			$extension = explode(".",$uploaded_file_name);
			$ext_type = strtolower(end($extension));
			$file_name = '';

			$allowed_files_array = explode(',',PROJ_ALLOWED_UPLOAD_FILE_TYPES);
			


			if(in_array($ext_type,$allowed_files_array)){

			if($addcurrentdateafterfilename==true){
			for($i=0;$i<count($extension)-1;$i++){
			$file_name .= $extension[$i];
			}
			
			}

			$finalfilename = $file_name.'_'.date('d-m-Y-H-i-s').'.'.$ext_type;
			$returnarray['finalfilename'] = $finalfilename;

			$target_path = $pathtoupload._S.$finalfilename;

			if(move_uploaded_file($uploaded_file_temp_name, $target_path)) {
				$output .= 'The file '.  basename($uploaded_file_name). 
				' has been uploaded as ' .$finalfilename. '<br />';
			
			if($createthumb==true){
			$sourcefile = $target_path;
			$thumbdestination = $pathtoupload._S.'thumbs';

			if(!is_dir($thumbdestination)){
			mkdir($thumbdestination);
			}

			$thumbdestinationfile = $thumbdestination._S.$finalfilename;

			self::createThumbImage($sourcefile,$thumbdestinationfile,$thumbwidth);
			}
			
			}else{
				$output .= 'There was an error uploading the file: '.basename($uploaded_file_name).', please try again! : <br /> ERROR = '.$_FILES[$originalfilename][$key]["error"].'<br />';
			}

			}else{ // if not the correct file type
			$output .= 'The file type for: '.basename($uploaded_file_name).' is invalid, please try again!, Please upload only '.PROJ_ALLOWED_UPLOAD_FILE_TYPES.' files. <br />';
			}
			
			$returnarray['output'] = $output;

			return $returnarray;
			
	}


static function createThumbImage($sourcefile,$thumbdestination,$newwidth){

	$file = imagecreatefromjpeg($sourcefile);
	$width = imagesx($file);
	$height = imagesy($file);

	$newheight = floor($height*($newwidth/$width));
	
	$thumbimage = imagecreatetruecolor($newwidth,$newheight);
	
	imagecopyresized($thumbimage,$file,0,0,0,0,$newwidth,$newheight,$width,$height);
	
	imagejpeg($thumbimage,$thumbdestination);
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



static function CheckModuleAccess($template='', $module=''){

$userdetailsarray = self::getLoggedinUserDetails();
$selectedmodule = ($module=='')?_MODULE:$module;

$columns = array('isinstalled','isactive');
$conditions = array();
$conditions['=']['name'] = 'module';
$conditions['AND =']['value'] = $selectedmodule;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
if(!empty($resultset)){

if($resultset->isactive != '1'){
$module_accessreturn_array['noerror'] = 0;
$module_accessreturn_array['message'] = 'ERROR002';
return $module_accessreturn_array;
}

if($resultset->isinstalled != '1'){
$module_accessreturn_array['noerror'] = 0;
$module_accessreturn_array['message'] = 'ERROR001';
return $module_accessreturn_array;
}

}else{
$module_accessreturn_array['noerror'] = 0;
$module_accessreturn_array['message'] = 'ERROR011';
return $module_accessreturn_array;
}
}else{
$module_accessreturn_array['noerror'] = 0;
$module_accessreturn_array['message'] = 'ERROR011';
return $module_accessreturn_array;
}

$module_accessreturn_array['noerror'] = 1;
$module_accessreturn_array['message'] = '';
return $module_accessreturn_array;

}



static function CheckModuleActionAccess($template='', $module='', $action=''){ // Modified on 05 Dec 2013, Due to Block Level Buttons

if(MainSystem::IsAdminLogged()){
$userdetailsarray = self::getLoggedinUserDetails();
}else{
$userdetailsarray = self::getNonLoggedinUserDetails();
}

$selectedmodule = ($module=='')?_MODULE:$module;
$selectedaction = ($action=='')?_ACTION:$action;


$usertypeaccessarray = array();
$usertypeaccessoverridesarray = array();
$templateaccessarray = array();

$columns = array('usertypeaccess','usertypeaccessoverrides','templateaccess','isactive');
$conditions = array();
$conditions['=']['type'] = 'module';
$conditions['AND =']['typename'] = $selectedmodule;
$conditions['AND =']['actionname'] = $selectedaction;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'actionsconfig', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
if(!empty($resultset)){

if($resultset->isactive == 0){
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR003';

return $module_action_accessreturn_array;
}

if($resultset->usertypeaccess != '*' || $resultset->usertypeaccess != ''){
$usertypeaccessarray = explode(',',$resultset->usertypeaccess);
}
// Now Check the Override Permissions //

if($resultset->usertypeaccessoverrides != ''){
$usertypeaccessoverridesarray = explode(',',$resultset->usertypeaccessoverrides);
}

if($resultset->templateaccess != '*' || $resultset->templateaccess != ''){
$templateaccessarray = explode(',',$resultset->templateaccess);
}

if($resultset->usertypeaccess != '*'){

if(in_array($userdetailsarray->usertypetag,$usertypeaccessarray) && (!in_array($userdetailsarray->usertypetag,$usertypeaccessoverridesarray) && !empty($usertypeaccessoverridesarray))){
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR004_1'; // Here the User Has the permissions, but Override Permissions is set to OFF, so now even originally had the permissions, but now unable to access this due to override permissions.//
return $module_action_accessreturn_array;
}else if(!in_array($userdetailsarray->usertypetag,$usertypeaccessarray) && !in_array($userdetailsarray->usertypetag,$usertypeaccessoverridesarray)){
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR004';

return $module_action_accessreturn_array;
}else{
	// To Be Removed //
$module_action_accessreturn_array['noerror'] = 1;
$module_action_accessreturn_array['message'] = '<<--------------Override Access------------>>';
return $module_action_accessreturn_array;

}

}else if($resultset->usertypeaccess == '*' && !empty($usertypeaccessoverridesarray)){

//print_r($usertypeaccessoverridesarray);die;
if(!in_array($userdetailsarray->usertypetag,$usertypeaccessoverridesarray) && !empty($usertypeaccessoverridesarray)){
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR004_1'; // Here the User Has the permissions, but Override Permissions is set to OFF, so now even originally had the permissions, but now unable to access this due to override permissions.//
return $module_action_accessreturn_array;
}

}

if($resultset->templateaccess != '*'){
if(!in_array($resultset->templateaccess,$templateaccessarray)){
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR005';

return $module_action_accessreturn_array;
}
}

}else{

	echo 'Data Fetch Error 1122';die;


$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR011';

return $module_action_accessreturn_array;
}
}else{

//self::CheckUsersActionAccess();

$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR011';

return $module_action_accessreturn_array;
}


$module_action_accessreturn_array['noerror'] = 1;
$module_action_accessreturn_array['message'] = '';

return $module_action_accessreturn_array;

}


static function CheckOtherUsersActionAccess($table = '', $column = '', $recordid = ''){

$loggedinuserdetailsarray = self::getLoggedinUserDetails();

$column = $column.' = ownerid';
$columns = array('id',$column);
$conditions = array();
$conditions['=']['id'] = $recordid;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', $table, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
if($resultset = $sqlObj->FetchResult($result)){

$owneruserdetailsarray = self::getUserDetailsByID($resultset->ownerid);

$usertypeaccessvalue = '';
$otheruserstypeaccessvalue = '';
$otheruserstypeaccessarray3 = array();

$columns2 = array('id','actionname','otheruserstypeaccessoverrides');
$conditions2 = array();
$conditions2['=']['type'] = 'module';
$conditions2['AND =']['typename'] = _MODULE;
$conditions2['AND =']['actionname'] = _ACTION;

$sql2 = $sqlObj->SQLCreator('S', 'actionsconfig', $columns2, $conditions2, '', '', '');
if($result2 = $sqlObj->FireSQL($sql2)){
if($sqlObj->getNumRows($result2)!=0){
if($resultset2 = $sqlObj->FetchResult($result2)){


if($resultset2->otheruserstypeaccessoverrides==''){
$otheruserstypeaccess = PROJ_DEFAULT_OTHERUSERS_PERMISSIONS;
}else{
$otheruserstypeaccess = $resultset2->otheruserstypeaccessoverrides;
}

$otheruserstypeaccessarray = explode(';',$otheruserstypeaccess);
foreach($otheruserstypeaccessarray as $key => $value){
$otheruserstypeaccessvalue = '';
if(strstr($value, '=')){
$otheruserstypeaccessarray2 = explode('=',$value);

if($otheruserstypeaccessarray2[0]==$loggedinuserdetailsarray->usertypetag){
$usertypeaccessvalue = $otheruserstypeaccessarray2[1];

if(strstr($usertypeaccessvalue, ',')){
$otheruserstypeaccessarray3 = explode(',',$otheruserstypeaccessarray2[1]);
}else{
$otheruserstypeaccessarray3[] = $usertypeaccessvalue;
}

if(in_array('self',$otheruserstypeaccessarray3) && $loggedinuserdetailsarray->id != $resultset->ownerid){

//self::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/ERROR008/')); 
return 'ERROR008';
}if(in_array('self',$otheruserstypeaccessarray3) && $loggedinuserdetailsarray->id == $resultset->ownerid){
return 'OK';
}


if(!in_array('self',$otheruserstypeaccessarray3)){
if(in_array($owneruserdetailsarray->usertypetag,$otheruserstypeaccessarray3)){
//echo $loggedinuserdetailsarray->usertypetag.' can access this Action';
return 'OK';
}else{
//self::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/ERROR009/'));
return 'ERROR009';
}
}

}else{
// Still to find User
}
}


} // foreach


}
}
}


}
}
}

//die;
}



static function CheckIDExists($table = '', $column = '', $id = '', $url = 'admin/getAdminHome/'){

$columnalias = $column.' = idtocheck';
$columns = array('id',$columnalias);
$conditions = array();
$conditions['='][$column] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', $table, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
if($resultset = $sqlObj->FetchResult($result)){

if($resultset->idtocheck != $id){

$_SESSION['message'] = self::$lang['siya']['THIS_RESOURCE_DOESNT_EXISTS'];
MainSystem::URLForwarder(MainSystem::URLCreator($url));


}

}

}else{
$_SESSION['message'] = self::$lang['siya']['THIS_RESOURCE_DOESNT_EXISTS'];
MainSystem::URLForwarder(MainSystem::URLCreator($url));
}
}


}




static function CheckGroupPermissions($id, $relationtype){
	
	$userdetailsarray = self::getLoggedinUserDetails();
	
	if(($userdetailsarray->usertypetag != '#admin') && ($userdetailsarray->usertypetag != '#subadmin')){
	
	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
	$loggedinuserid = self::GetSessionUserID();

	if($relationtype=='group'){


		$columns = array('userid');
		$conditions = array();
		$conditions['=']['groupid'] = $id;
		$conditions['AND =']['batchid'] = $selected_batch_id;
		$conditions['AND =']['userid'] = $loggedinuserid;

		$sqlObj = new MainSQL();
		$sql = $sqlObj->SQLCreator('S', 'usersingroup', $columns, $conditions, '', '', '');
		if($result = $sqlObj->FireSQL($sql)){
		if($sqlObj->getNumRows($result) !=0){
		if($resultset = $sqlObj->FetchResult($result)){
		if($resultset->userid == $loggedinuserid){
		
		//echo 'Access to Group Allowed - Own Group'; 
		}
		}
		}else{
		
		
		$columns = array('userid','usertypetag');
		$conditions = array();
		$conditions['=']['groupid'] = $id;
		$conditions['AND =']['batchid'] = $selected_batch_id;
		$conditions['AND =']['userid'] = $loggedinuserid;

		$sqlObj = new MainSQL();
		$sql = $sqlObj->SQLCreator('S', 'otherusersingroup', $columns, $conditions, '', '', '');
		if($result = $sqlObj->FireSQL($sql)){
		if($sqlObj->getNumRows($result) !=0){
		if($resultset = $sqlObj->FetchResult($result)){
		if($resultset->userid == $loggedinuserid){
		
		$usertypetag = $resultset->usertypetag;

		//echo 'Access to Group Allowed - But Member of Other Group';

		$returnarray = self::CheckModuleActionAccessforGroup('admin',$usertypetag);

		}else{
		self::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/ERROR010/')); 
		}
		}
		}else{
		self::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/ERROR010/')); 
		}
		}
		
		}
		}else{
		//echo 'DB Error';
		}


	}
	
	}


}



static function CheckModuleActionAccessforGroup($template = 'admin', $usertypetag){

$userdetailsarray = self::getLoggedinUserDetails();

$columns = array('usertypeaccess','usertypeaccessoverrides','templateaccess','isactive');
$conditions = array();
$conditions['=']['type'] = 'module';
$conditions['AND =']['typename'] = _MODULE;
$conditions['AND =']['actionname'] = _ACTION;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'actionsconfig', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
if(!empty($resultset)){

if($resultset->isactive == 0){
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR003';

return $module_action_accessreturn_array;
}

$usertypeaccessarray = explode(',',$resultset->usertypeaccess);
// Now Check the Override Permissions //
$usertypeaccessoverridesarray = explode(',',$resultset->usertypeaccessoverrides);

$templateaccessarray = explode(',',$resultset->templateaccess);

if($resultset->usertypeaccess != '*'){
if(!in_array($usertypetag,$usertypeaccessarray)){
if(!in_array($usertypetag,$usertypeaccessoverridesarray)){

$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR004';

return $module_action_accessreturn_array;
}else{
	// To Be Removed //
$module_action_accessreturn_array['noerror'] = 1;
$module_action_accessreturn_array['message'] = '<<--------------Override Access------------>>';
return $module_action_accessreturn_array;

}
}
}

if($resultset->templateaccess != '*'){
if(!in_array($resultset->templateaccess,$templateaccessarray)){
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR005';

return $module_action_accessreturn_array;
}
}

}else{
$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR0011';

return $module_action_accessreturn_array;
}
}else{

//self::CheckUsersActionAccess();

$module_action_accessreturn_array['noerror'] = 0;
$module_action_accessreturn_array['message'] = 'ERROR0011';

return $module_action_accessreturn_array;
}


$module_action_accessreturn_array['noerror'] = 1;
$module_action_accessreturn_array['message'] = '';

return $module_action_accessreturn_array;

}


static function returnMIMEType($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );



			$extension = explode(".",$filename);
			$ext_type = strtolower(end($extension));

        if (array_key_exists($ext_type, $mime_types)) {
            return $mime_types[$ext_type];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    
	
}


static public function ReturnLocalisationString($string='', $variablearray='', $lang=''){


	foreach($variablearray as $rep) {
	$string = preg_replace('~\{%%\}~',$rep,$string,1);
	}

	return $string;

}

static public function LocalisationInit(){

global $lang;

}


static public function CreateControls($controlsarray = ''){

$return_str = '';

//print_r($controlsarray);die;

foreach($controlsarray as $key => $value){
foreach($value as $key2 => $value2){
}

if(isset($controlsarray[$key]['title'])){
$title = $controlsarray[$key]['title'];
}else{
$title = $key;
}

$return_str .= ($controlsarray[$key]['style']=='text')?' <a href="'.self::URLCreator(_TEMPLATE_IMG_DIR).'">'.$title.'</a>':'<a href="'.self::URLCreator($controlsarray[$key]['url']).'"><img src="'._TEMPLATE_IMG_DIR._WS.'siya_'.$key.'.png" alt="'.$title.'" title="'.$title.'" /></a> ';

}

return $return_str;

}


public static function CreateNoofRecordsDropDown($noofrecordstodisplay){

$return_str = '';

$return_str = '<form name="changenoofrecord" id="changenoofrecord" method="GET"><select name="noofrecords" id="noofrecords" onChange="JavaScript:document.forms[\'changenoofrecord\'].submit();">
<option value=""> No of Records </option>';
$return_str .= '<option value="5" ';
$return_str .= ($noofrecordstodisplay==5)?'SELECTED':'';
$return_str .='>5</option>';
$return_str .= '<option value="10" ';
$return_str .= ($noofrecordstodisplay==10)?'SELECTED':'';
$return_str .='>10</option>';
$return_str .= '<option value="20" ';
$return_str .= ($noofrecordstodisplay==20)?'SELECTED':'';
$return_str .='>20</option>';
$return_str .= '<option value="100" ';
$return_str .= ($noofrecordstodisplay==100)?'SELECTED':'';
$return_str .='>100</option>';
$return_str .= '<option value="200" ';
$return_str .= ($noofrecordstodisplay==200)?'SELECTED':'';
$return_str .='>200</option>';
$return_str .= '<option value="500" ';
$return_str .= ($noofrecordstodisplay==500)?'SELECTED':'';
$return_str .='>500</option>';
$return_str .= '<option value="ALL" ';
$return_str .= ($noofrecordstodisplay=='ALL')?'SELECTED':'';
$return_str .='>ALL</option>';
$return_str .='</select></form>';

return $return_str;

}


static function CreateAllAvailableThemesSelector(){

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

if(self::IsFrontUser()){
$dirs = glob(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_TEMPLATE_THEMES_DIR._S.'*',GLOB_ONLYDIR);
}else if(self::IsAdminLogged() && PROJ_OVERRIDE_ADMIN_TEMPLATE == 1 && $PROJ_NON_OVERRIDE_CONDITION==false){
$dirs = glob(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_TEMPLATE_THEMES_DIR._S.'*',GLOB_ONLYDIR);
}else{
$dirs = glob(PROJ_TEMPLATES_DIR._S.PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_TEMPLATE_THEMES_DIR._S.'*',GLOB_ONLYDIR);
}

$return_str = '';

if(isset($_SESSION['controllers']['SELECTEDTHEME'])){
$selected_theme_value = $_SESSION['controllers']['SELECTEDTHEME'];
}else{
$selected_theme_value = '';
}


$return_str .= '<form class="themeform" name="selecttheme" id="selecttheme" method="GET"><select name="SELECTEDTHEME" id="SELECTEDTHEME" onChange="JavaScript:document.forms[\'selecttheme\'].submit();">
<option value="">Select Theme</option>';


foreach ($dirs as $dir){
if(self::IsFrontUser()){
$dirarray = explode(PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_TEMPLATE_THEMES_DIR._S,$dir);
}else if(self::IsAdminLogged() && PROJ_OVERRIDE_ADMIN_TEMPLATE == 1 && $PROJ_NON_OVERRIDE_CONDITION==false){
$dirarray = explode(PROJ_DEFAULT_TEMPLATE_DIR._S.PROJ_ADMIN_TEMPLATE_DIR._S.PROJ_TEMPLATE_THEMES_DIR._S,$dir);
}else{
$dirarray = explode(PROJ_DEFAULT_TEMPLATE_DIR._S._MODULE._S.PROJ_TEMPLATE_THEMES_DIR._S,$dir);
}
$theme_dir_name = end($dirarray);
$theme_display_title = ucwords(str_replace('_', ' ', $theme_dir_name));

$selectedtext = ($selected_theme_value == $theme_dir_name)?'SELECTED':'';

$return_str .= '<option value="'.$theme_dir_name.'" '.$selectedtext.'>'.$theme_display_title.'</option>';

}

$return_str .= '</select></form>';

return $return_str;

}


static function setDefaultBatch(){

$columns = array('id');
$conditions = array();
$conditions['=']['issystemdefault'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$_SESSION['defaultbatchid'] = $resultset->id;
}
}
}

}


static function getGroupInfobyID($id){

$columns = array('pid','grouptypetag','entitytypetag','name','description');
$conditions = array();
$conditions['=']['id'] = $id;
$conditions['AND =']['isactive'] = '1';

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
return $resultset;
}
}
}

}

static function getBatchInfobyID($id){

$columns = array('batchcode','title','description');
$conditions = array();
$conditions['=']['id'] = $id;
$conditions['AND =']['isactive'] = '1';

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
return $resultset;
}
}
}

}


static function getTopicInfobyID($id){

$columns = array('topiccode','name','description');
$conditions = array();
$conditions['=']['id'] = $id;
$conditions['AND =']['isactive'] = '1';

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'topics', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
return $resultset;
}
}
}

}

static function getSubjectInfobyID($id){

$columns = array('subjectcode','name','description');
$conditions = array();
$conditions['=']['id'] = $id;
$conditions['AND =']['isactive'] = '1';

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
return $resultset;
}
}
}

}


static function getChapterInfobyID($id){

$columns = array('chaptercode','name','description');
$conditions = array();
$conditions['=']['id'] = $id;
$conditions['AND =']['isactive'] = '1';

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'chapters', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
return $resultset;
}
}
}

}


static function randomValue($size = 40) {

	$returnstr = '';
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()<>,.?~`;:';
    for ($i = 0; $i < $size; $i++) {
        $returnstr .= $charset[rand(0, strlen($charset) - 1)];
    }
    return $returnstr;
}



static function getNonLoggedinUserDetails(){
$nonloggeedinuserObj = new stdClass();
$nonloggeedinuserObj->entitytype = '@nonloggeginuser';
$nonloggeedinuserObj->usertypetag = '#nonloggeginuser';
return $nonloggeedinuserObj;
}

} // class MainSystem