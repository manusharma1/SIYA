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
class entities
{

private static $lang;

function SIYA__entities_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewEntity'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['linkEntities'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'default', 'description' => '');
$module_installer_info_array['action']['saveEntity'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['savelinkEntities'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageEntities'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editEntity'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteEntityConfirmed'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteEntity'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeEntityStatus'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['entityMultipleManage'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');


return $module_installer_info_array;

}

function SIYA__entities_INIT__(){

global $lang;

self::$lang = $lang;

}

public function addNewEntity(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['entities']['ADD_NEW_ENTITY'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function linkEntities(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['entities']['LINK_ENTITIES'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveEntity($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id='';
	}
		
	$data = array();
	$data['entitytypetag'] = $_POST['entity_tag'].$_POST['entitytypetag'];
	$data['entityname'] = $_POST['entityname'];
	$data['entitydescription'] = $_POST['entitydescription'];
	if($id==''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = '1';

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'entities', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'entities', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['entities']['ENTITY_VALUE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/editEntities/'.$returnid.'/'));

	// Now insert these values in the entity relationship table//

	$data = array();
	$data['pid'] = $returnid;
	$data['entitytype1'] = $_POST['pid'];
	$data['entitytype2'] = $returnid;
	$data['entityrelationtype'] = $_POST['entityrelationtype'];
	if($id==''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = '1';

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['pid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'entitiesrelationship', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'entitiesrelationship', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] .= self::$lang['siya']['entities']['Entity_Relationship_Value_Saved'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/editEntities/'));
	}else{
	$_SESSION['message'] .= self::$lang['siya']['entities']['ENTITY_RELATIONSHIP_VALUE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/addNewEntity/'));
	}
	}else{
	$_SESSION['message'] .= self::$lang['siya']['entities']['ENTITY_VALUE_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/addNewEntity/'));
	}
	

}



public function savelinkEntities($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id='';
	}
		
	$data = array();
	$data['entitytype1'] = $_POST['entitytype1'];
	$data['entitytype2'] = $_POST['entitytype2'];
	$data['entityrelationtype'] = $_POST['entityrelationtype'];
	$data['pid'] = 0;
	if($id==''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = '1';

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'entitiesrelationship', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'entitiesrelationship', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Link Entity Value Saved';
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));
	}else{
	$_SESSION['message'] .= 'Entity Value cannot be Saved';
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));
	}
	

}



public function manageEntities(){

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['entities']['MANAGE_ENTITIES'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}



public function editEntity($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id='';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['entities']['EDIT_ENTITY'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function changeEntityStatus($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	
	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'entities', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'entities', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['entities']['ENTITIES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/editEntities/'));
	}
	}
	}
	}
	}
	

	public function deleteEntity($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['entities']['ENTITY_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteEntityConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'entities', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}
public function entityMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'entities', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['entities']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['entities']['ENTITY_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'entities', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['entities']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['entities']['ENTITY_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'entities', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['entities']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['entities']['ENTITY_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('entities/manageEntities/'));

	}
	

}

} // class entities