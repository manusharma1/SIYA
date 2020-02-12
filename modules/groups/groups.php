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
class groups
{

private static $lang;

function SIYA__groups_INIT__(){

global $lang;

self::$lang = $lang;

}
function SIYA__groups_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addUserToGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addUsersToGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addOtherUsersToGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addUsersToGroup2'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveUserToGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveUsersToGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveOtherUsersToGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['removeUserFromGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageGroups'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeGroupStatus'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteGroupRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteGroupRegistrationConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['removeUserFromGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['removeUserFromGroupConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addGroupToAnotherGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveGroupToAnotherGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editGroup'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

public function addNewGroup(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ADD_NEW_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addUserToGroup($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ADD_USER_TO_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}



public function addUsersToGroup($parameters){
	
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ADD_USER_TO_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function addOtherUsersToGroup($parameters){
	
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ADD_USER_TO_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function addUsersToGroup2($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ADD_USER_TO_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}



public function addUserToAnotherGroup($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ADD_USER_TO_ANOTHER_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addGroupToAnotherGroup($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ADD_GROUP_TO_ANOTHER_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function saveGroup($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	
	if(isset($_POST['pid']) && $_POST['pid']  !=''){

	$data['pid'] = $_POST['pid'];
	}
	$data['batchid'] = $_POST['batchid'];
	$data['grouptypetag'] = $_POST['group_tag'].$_POST['grouptypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['name'] = $_POST['name'];
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'groups', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'groups', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['groups']['GROUP_SAVED'];  
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/editGroup/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['GROUP_CANNOT_BE_SAVED'];
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewGroup'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewGroup'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ERROR:GROUP_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}

	
	public function saveUserToGroup($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	$data['userid'] = $_POST['userid'];
	$data['groupid'] = $_POST['groupid'];
	$data['batchid'] = $_POST['batchid'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'usersingroup', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'usersingroup', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUserToGroup'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUserToGroup'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ERROR:Users_To_Group_cannot_be_Saved'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}




	public function saveUsersToGroup(){

	$usersingrouparraywithrollno = (isset($_POST['usersingrouprollno']))?$_POST['usersingrouprollno']:array();
	$usersnotingrouparray = (isset($_POST['usersnotingroup']))?explode(',',$_POST['usersnotingroup']):array();
	$groupid = $_POST['groupid'];
	$batchid = $_POST['batchid'];

	$sqlObj = new MainSQL();


	if(!empty($usersnotingrouparray)){

	$conditions0 = array();
	$conditions0['IN ARR']['userid'] = $usersnotingrouparray;
	$conditions0['AND =']['groupid'] = $groupid;
	$conditions0['AND =']['batchid'] = $batchid;

	$sql0 = $sqlObj->SQLCreator('D', 'usersingroup', '', $conditions0, '', '', '');
	if($result0 = $sqlObj->FireSQL($sql0)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}
	}
	
	}



	foreach($usersingrouparraywithrollno as $userid => $rollno){

	$columns0 = array('userid');

	$conditions0 = array();
	$conditions0['=']['userid'] = $userid;
	$conditions0['AND =']['groupid'] = $groupid;
	$conditions0['AND =']['batchid'] = $batchid;

	$sql0 = $sqlObj->SQLCreator('S', 'usersingroup', $columns0, $conditions0, '', '', '');
	if($result0 = $sqlObj->FireSQL($sql0)){
	if($sqlObj->getNumRows($result0)==0){


	$data = array();
	$data['userid'] = $userid;
	$data['groupid'] = $groupid;
	$data['batchid'] = $batchid;
	$data['rollno'] = $rollno;
	
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['iscore'] = 1;
	$data['isactive'] = 1;
	
	$sql = $sqlObj->SQLCreator('I', 'usersingroup', $data, '', '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}

	
	}else{
	
	$conditions = array();
	$conditions['=']['userid'] = $userid;
	$conditions['AND =']['groupid'] = $groupid;
	$conditions['AND =']['batchid'] = $batchid;

	$data = array();
	$data['rollno'] = $rollno;
	
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	$data['iscore'] = 1;	
	$data['isactive'] = 1;
	
	$sql = $sqlObj->SQLCreator('U', 'usersingroup', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}



	}
	}


	}
	

	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/addUsersToGroup/'.$groupid.'/'));


}




public function saveOtherUsersToGroup(){

	$usersnotingrouparray = (isset($_POST['usersnotingroup']))?$_POST['usersnotingroup']:array();
	$usersingrouparray = (isset($_POST['usersingroup']))?$_POST['usersingroup']:array();

	$groupid = $_POST['groupid'];
	$batchid = $_POST['batchid'];

	$sqlObj = new MainSQL();


	if(!empty($usersnotingrouparray)){

	$conditions0 = array();
	$conditions0['IN ARR']['userid'] = $usersnotingrouparray;
	$conditions0['AND =']['groupid'] = $groupid;
	$conditions0['AND =']['batchid'] = $batchid;

	$sql0 = $sqlObj->SQLCreator('D', 'usersingroup', '', $conditions0, '', '', '');
	if($result0 = $sqlObj->FireSQL($sql0)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addOtherUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addOtherUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}
	}
	
	}



	foreach($usersingrouparray as $userid){

	$columns0 = array('userid');

	$conditions0 = array();
	$conditions0['=']['userid'] = $userid;
	$conditions0['AND =']['groupid'] = $groupid;
	$conditions0['AND =']['batchid'] = $batchid;

	$sql0 = $sqlObj->SQLCreator('S', 'usersingroup', $columns0, $conditions0, '', '', '');
	if($result0 = $sqlObj->FireSQL($sql0)){
	if($sqlObj->getNumRows($result0)==0){


	$data = array();
	$data['userid'] = $userid;
	$data['groupid'] = $groupid;
	$data['batchid'] = $batchid;
	$data['rollno'] = $rollno;
	
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['iscore'] = 0;
	$data['isactive'] = 1;
	
	$sql = $sqlObj->SQLCreator('I', 'usersingroup', $data, '', '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addOtherUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addOtherUsersToGroup',$groupid); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['USERS_TO_GROUP_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}

	
	}
	}


	}
	

	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/addOtherUsersToGroup/'.$groupid.'/'));


}




	public function saveUserToAnotherGroup($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	$data['userid'] = $_POST['userid'];
	$data['groupid'] = $_POST['groupid'];
	$data['batchid'] = $_POST['batchid'];
	$data['usertypetag'] = $_POST['usertypetag'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'otherusersingroup', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'usersingroup', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_ANOTHER_GROUP_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_ANOTHER_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUserToAnotherGroup'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addUserToAnotherGroup'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = 'ERROR : Users To Group cannot be Saved';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}


	public function saveGroupToAnotherGroup($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$userid = $_POST['userid'];
	$groupid = $_POST['groupid'];
	$batchid = $_POST['batchid'];

	foreach($userid as $key=>$value){
	
			
	$columns = array('id');

	$conditions = array();
	$conditions['=']['userid'] = $key;
	$conditions['AND =']['groupid'] = $groupid;
	$conditions['AND =']['batchid'] = $batchid;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'usersingroup', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$_SESSION['message'] = "You are aleardy part of This class and Batch";
	}
	}else{
	
	$data = array();
	$data['userid'] = $key;
	$data['rollno'] = $value;
	$data['groupid'] = $_POST['groupid'];
	$data['batchid'] = $_POST['batchid'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'usersingroup', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'usersingroup', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_GROUP_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/getAdminHome/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['USERS_TO_ANOTHER_GROUP_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addGroupToAnotherGroup'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addGroupToAnotherGroup'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['ERROR:GROUP_TO_GROUP_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}
	
	}
	}
	
	}
	


	public function manageGroups($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['MANAGE_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editGroup($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['MANAGE_GROUP'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changeGroupStatus($parameters){

	if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'groups', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['groups']['USER_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/editGroup/'));
	}
	}
	}
	}

}


public function deleteGroupRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}
public function deleteGroupRegistrationConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'groups', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/manageGroups/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}



public function removeUserFromGroup($parameters){

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['groups']['REMOVE_USER_FROM_GROUP'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function removeUserFromGroupConfirmed($parameters){

	$userid = $parameters[0];
	$groupid = $parameters[1];
	$batchid = $parameters[2];

	
	$columns = array('ug.id');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';
	$tables['batches'] = 'b';

	$conditions['=']['ug.userid'] = $userid;
	$conditions['AND =']['ug.groupid'] = $groupid;
	$conditions['AND =']['ug.batchid'] = $batchid;

	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['K AND =']['ug.batchid'] = 'b.id';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$usersingroupid = $sqlObj->getCleanData($resultset->id);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/'));
	}
	}
	
	$conditions = array();
	$conditions['=']['id'] = $usersingroupid;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'usersingroup', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showClass/'.$groupid.'/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}

public function groupMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'groups', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/manageGroups/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['groups']['GROUP_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/manageGroups/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'groups', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/manageGroups/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['groups']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/manageGroups/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'groups', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/manageGroups/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['groups']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('groups/manageGroups/'));

	}
	

}

} // class groups