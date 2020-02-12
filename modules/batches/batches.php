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
////////////////////////////////////////////////////////////////////////////
class batches
{

private static $lang;

function SIYA__batches_INIT__(){

global $lang;

self::$lang = $lang;

}

function SIYA__batches_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewBatch'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveBatch'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageBatches'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editBatches'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeBatchesStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteBatches'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteBatchConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['batcheMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

public function addNewBatch(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['batches']['ADD_NEW_USER_TYPE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveBatch($parameters){

	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();

	$data['batchcode'] = $_POST['batchcode'];
	$data['batchstart'] = $_POST['batchstart'];
	$data['batchend'] = $_POST['batchend'];
	$data['title'] = $_POST['title'];
	$data['description'] = $_POST['description'];
	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = 1;


	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'batches', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'batches', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Batch Saved';
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/editBatches/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['batches']['BATCH_CANNOT_BE_SAVED'];
	

	// MORMAL METHOD WITHOUT AJAX //
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewBatch'); // REVIEW ABOUT THE SECURITY HERE//
	// AS WHEN USING AJAX IT IS UNABLE TO FECTCH THE _MODULE VALUE SO CHANGING THE FUNCTION//

	// $actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewUserType'); // IN CASE YOU USE AJAX //

	
	// MORMAL METHOD WITHOUT AJAX //

	$functionreturnarray['title_placeholder'] = self::$lang['siya']['batches']['ERROR_:_BATCH_CANNOT_BE_SAVED'] ;
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	
	return $functionreturnarray;

	// MORMAL METHOD WITHOUT AJAX //


	// AJAX METHOD
	//return $actionviewresult;
	//AJAX METHOD
	
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/addNewUserType/'));
	}
	

}

public function manageBatches(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['batches']['MANAGE_BATCHES'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editBatches($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['batches']['EDIT_BATCHES'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changeBatchesStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_news_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_news_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'batches', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['batches']['BATCHES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
	}
	}
	}

}


public function deleteBatches($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['batches']['DELETE_A_BATCH'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteBatchConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'batches', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function selectDefaultSystemBatch(){

$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

$actionviewresult = MainSystem::CallActionView();
$functionreturnarray['title_placeholder'] = self::$lang['siya']['batches']['SELECT_DEFAULT_SYSTEM_BATCH'];
$functionreturnarray['main_content_placeholder'] = $actionviewresult;
return $functionreturnarray;

}


public function saveDefaultSystemBatch(){

	$data = array();

	$data['issystemdefault'] = '0';
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();


	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'batches', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$data = array();

	$data['issystemdefault'] = '1';
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();

	$conditions = array();
	$conditions['=']['id'] = $_POST['menuid'];

	$sql = $sqlObj->SQLCreator('U', 'batches', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['batches']['BATCH_SAVED'];
	//MainSystem::URLForwarder(MainSystem::URLCreator('batches/addNewBatch/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['batches']['BATCH_CANNOT_BE_SAVED'];
	}
	}else{
	$_SESSION['message'] = self::$lang['siya']['batches']['BATCH_CANNOT_BE_SAVED'];
	}

}
//batcheMultipleManage
public function batcheMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'batches', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['users']['USERS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'batches', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['batches']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'batches', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('batches/manageBatches/'));

	}
	

}


} // class Batches