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
///////////////////////////////////////////////////////////////////////////
class additionalsettings
{

public function addNewAdditionalSetting(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Add New Additional Settings';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveAdditionalSettings($parameters=''){

	if(!isset($parameters[0])){
	$id = '';
	}else{
	$id = $parameters[0];
	}

	$sqlObj = new MainSQL();

// Check for Duplicate Value//
	$columns0 = array('id','name');
	$conditions0 = array();
	$conditions0['=']['name'] = $_POST['additionalsettingname'];
	$sql0 = $sqlObj->SQLCreator('S', 'additionalsettings', $columns0, $conditions0, '', '', '');
	if($result0 = $sqlObj->FireSQL($sql0)){
	if($sqlObj->getNumRows($result0) !=0){ // If Rows Exists
	if($resultset0 = $sqlObj->FetchResult($result0)){
	$name0 = $resultset0->name;
	$id0 = $resultset0->id;
	}
	}else{
	$name0 = '';
	$id0 = '';
	}
	}


	$data = array();
	$data['id'] = $id;
	$data['name'] = $_POST['additionalsettingname'];
	$data['value'] = $_POST['additionalsettingvalue'];
	if($id == ''){
	if($name0 == $_POST['additionalsettingname']){
	$_SESSION['message'] = 'This Additional Setting Name aleady exists in the Database, Please modify the exixting value or add new entry with new name';
	MainSystem::URLForwarder(MainSystem::URLCreator('additionalsettings/addNewAdditionalSetting/'));
	}
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	if($name0 == $_POST['additionalsettingname'] && $id0 != $id){
	$_SESSION['message'] = 'This Additional Setting Name aleady exists in the Database, Please modify the exixting value or add new entry';
	MainSystem::URLForwarder(MainSystem::URLCreator('additionalsettings/editAdditionalSetting/'.$id.'/'));
	}
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = 0;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;
	

	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'additionalsettings', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'additionalsettings', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Additional Settings Saved';
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('additionalsettings/editAdditionalSetting/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = 'Additional Settings cannot be Saved';
	MainSystem::URLForwarder(MainSystem::URLCreator('additionalsettings/addNewAdditionalSetting/'));
	}
	

}


public function editAdditionalSetting($parameters){	
	
	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Edit Additional Settings';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}



public function manageAdditionalSettings(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Manage Additional Settings';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function changeAdditionalSettingsStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'additionalsettings', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If AdditionalSettings Exists
	if($resultset = $sqlObj->FetchResult($result)){
	$change_additionalsettings_status = ($resultset->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_additionalsettings_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'additionalsettings', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Additional Settings Status Changed';
	MainSystem::URLForwarder(MainSystem::URLCreator('additionalsettings/manageAdditionalSettings/'));
	}
	}
	}
	}

}



public function deleteAdditionalSetting($parameters){

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Delete Additional Setting';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteAdditionalSettingConfirmed($parameters){

	$id = $parameters[0];

	if(isset($_SESSION['deleteconfirmed']) && $_SESSION['deleteconfirmed'] == $id){
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'additionalsettings', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	unset($_SESSION['deleteconfirmed']);
	MainSystem::URLForwarder(MainSystem::URLCreator('additionalsettings/manageAdditionalSettings/'));
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


} // class additionalsettings