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
class users
{

private static $username, $password;

private static $lang;

function SIYA__users_INIT__(){

global $lang;

self::$lang = $lang;

}

function SIYA__users_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewUserType'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addNewRegistration'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addNewRegistrationStudentFront'] = array('usertypeaccess'=>'*', 'templateaccess'=>'*', 'description' => '');
$module_installer_info_array['action']['addNewRegistrationTeacherFront'] = array('usertypeaccess'=>'*', 'templateaccess'=>'*', 'description' => '');
$module_installer_info_array['action']['addStaffRegistration'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addParentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addStudentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addStudentParentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['saveUserType'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveStaffRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveParentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveRegistration'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveRegistrationStudentFront'] = array('usertypeaccess'=>'*', 'templateaccess'=>'*', 'description' => '');
$module_installer_info_array['action']['saveRegistrationTeacherFront'] = array('usertypeaccess'=>'*', 'templateaccess'=>'*', 'description' => '');
$module_installer_info_array['action']['saveStudentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveBatch'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['setBatch'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageStudents'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editStudentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher,#student', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageParents'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editParentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher,#parent', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageNewRegistration'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageStaff'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editStaffRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeStudentStatus'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeStaffStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeParentStatus'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteStudentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteStudentRegistrationConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteStaffRegistration'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteStaffRegistrationConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteParentRegistration'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteParentRegistrationConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['downloadStaffResumeFile'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['newRegistrationMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['staffMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['usersMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editAdminRegistration'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showUserImageByID'] = array('usertypeaccess'=>'*', 'templateaccess'=>'*', 'description' => '');
$module_installer_info_array['action']['manageUserType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showTeachersbyUser'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showParentsbyUser'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

private static function setUsersLoginDetails($username='', $password=''){
self::$username = $username;
self::$password = $password;
}


public function addNewUserType(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_NEW_USER_TYPE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addNewRegistration(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_NEW_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function addNewRegistrationStudentFront(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_NEW_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function addNewRegistrationTeacherFront(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_NEW_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function addStaffRegistration(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_STAFF_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addParentRegistration(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_PARENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addStudentParentRegistration(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_STUDENT_PARENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addStudentRegistration(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ADD_STUDENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function sessionRegistration(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['SESSION_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveUserType($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();

	$data['usertypetag'] = $_POST['hash'].$_POST['usertypetag'];
	$data['name'] = $_POST['name'];
	$data['description'] = $_POST['description'];
	if($id == ''){
	$data['addeddate'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modifieddate'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = 1;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'usertypes', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'usertypes', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['USER_TYPE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['USER_TYPE_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewUserType'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewUserType'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ERROR_:_USER_TYPE_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

}

public function saveStaffRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$finalfilename = '';
	$finalfilename2 = '';

	$data = array();

	if(isset($_POST['password']) && $_POST['password'] !=''){
	self::setUsersLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	if($id==''){
	$data['username'] = self::$username;
	}else{
	$data['username'] = $_POST['username'];
	}

	$sqlObj = new MainSQL();


	if($id == ''){


	//Check if Employee ID exists

	$columns = array('empid');
	$conditions = array();
	$conditions['=']['empid'] = $_POST['empid'];
	$sql= $sqlObj->SQLCreator('S', 'staff', $columns, $conditions, '', '', '');

	if($result= $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	if($_POST['empid'] == $resultset->empid){
	
	$_SESSION['message'] = self::$lang['siya']['users']['EMPLOYEE_ID_ALREADY_EXISTS'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STAFF_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}
	
	}
	}
	}
	}
	//


	//Check if Username exists


	$columns = array('username');
	$conditions = array();
	$conditions['=']['username'] = $_POST['username'];

	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');

	if($result= $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	if($_POST['username'] == $resultset->username){
	
	$_SESSION['message'] = self::$lang['siya']['users']['USERNAME_ALREADY_EXISTS'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STAFF_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}
	
	}
	}
	}
	}
	//

	}


	$data['usertypetag'] = $_POST['usertypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['fname'] = $_POST['fname'];
	$data['mname'] = $_POST['mname'];
	$data['lname'] = $_POST['lname'];
	$data['gender'] = $_POST['gender'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	$data['nationality'] = $_POST['nationality'];
	$data['dob'] = $_POST['dob'];
	
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

	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['ENTITY_VALUE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	
	
	
	$entitytypetag = str_replace("@","_",$_POST['entitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['photofile']) && $_FILES['photofile']['name'] !=''){
	$originalfilename = 'photofile';

	$finalfilename = $returnid.'_PhotoFile_'.$_FILES['photofile']['name'];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	}


	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename;	
	$conditions = array();
	$conditions['=']['id'] = $returnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STAFF_REGISTRATION_SAVED_COMPLETELY'];
	}



	if(isset($_FILES['resumefile']) && $_FILES['resumefile']['name'] !=''){
	$originalfilename2 = 'resumefile';

	$finalfilename2 = $returnid.'_ResumeFile_'.$_FILES['resumefile']['name'];
	
	$foldername2 = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume');
	}

	$foldername2 = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume';

	$uploadmessage2 = MainSystem::FileUploader($originalfilename2,$foldername2,$finalfilename2);
	$_SESSION['message'] .= '<br />'.$uploadmessage2;

	}


	// Image Upload Ends Here //
	
	$data = array();
	$data['resumefile'] = $finalfilename2;

	$data['userid'] = $returnid;
	$data['empid'] = $_POST['empid'];
	$data['doj'] = $_POST['doj'];
	$data['bloodgroup'] = $_POST['bloodgroup'];
	$data['emergencycontactname'] = $_POST['emergencycontactname'];
	$data['emergencycontactnumber'] = $_POST['emergencycontactnumber'];
	$data['qualifications'] = $_POST['qualifications'];
	

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'staff', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'staff', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STAFF_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editStaffRegistration/'.$returnid.'/'));

	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['STAFF_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STAFF_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}

}



public function saveParentRegistration($parameters){

	$finalfilename = '';
	$finalfilename2 = '';

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();

	if(isset($_POST['password']) && $_POST['password'] !=''){
	self::setUsersLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	if($id==''){
	$data['username'] = self::$username;
	}else{
	$data['username'] = $_POST['username'];
	}


	$data['usertypetag'] = $_POST['usertypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['fname'] = $_POST['fname'];
	$data['mname'] = $_POST['mname'];
	$data['lname'] = $_POST['lname'];
	$data['gender'] = $_POST['gender'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	$data['nationality'] = $_POST['nationality'];
	$data['dob'] = $_POST['dob'];
	




	if($id == ''){

	//Check if Username exists


	$columns = array('username');
	$conditions = array();
	$conditions['=']['username'] = $_POST['username'];

	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');

	if($result= $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	if($_POST['username'] == $resultset->username){
	
	$_SESSION['message'] = self::$lang['siya']['users']['USERNAME_ALREADY_EXISTS'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addParentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addParentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['PARENTS_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}
	
	}
	}
	}
	}
	//

	}



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
	
	 $sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');



	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['ENTITY_VALUE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	


	$entitytypetag = str_replace("@","_",$_POST['entitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['photofile']) && $_FILES['photofile']['name'] !=''){

	$originalfilename = 'photofile';

	$finalfilename = $returnid.'_PhotoFile_'.$_FILES['photofile']['name'];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage;

	}
	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename;	
	$conditions = array();
	$conditions['=']['id'] = $returnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['PARENT_REGISTRATION_SAVED_COMPLETELY'];
	}



	if(isset($_FILES['resumefile']) && $_FILES['resumefile']['name'] !=''){
	$originalfilename2 = 'resumefile';

	$finalfilename2 = $returnid.'_ResumeFile_'.$_FILES['resumefile']['name'];
	
	$foldername2 = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume');
	}

	$foldername2 = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume';

	$uploadmessage2 = MainSystem::FileUploader($originalfilename2,$foldername2,$finalfilename2);
	$_SESSION['message'] .= '<br />'.$uploadmessage2;

	}

	// Image Upload Ends Here //
	

	$data = array();
	$data['resumefile'] = $finalfilename2;

	$data['userid'] = $returnid;
	$data['occupation'] = $_POST['occupation'];
	$data['officeaddressline1'] = $_POST['officeaddressline1'];
	$data['officeaddressline2'] = $_POST['officeaddressline2'];
	$data['officecity'] = $_POST['officecity'];
	$data['officestate'] = $_POST['officestate'];
	$data['officecountry'] = $_POST['officecountry'];
	$data['officephone'] = $_POST['officephone'];
	

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'parents', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'parents', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['PARENTS_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editParentRegistration/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['PARENTS_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addParentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addParentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ERROR_:_PARENTS_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}

}

public function saveRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	
	if($_POST['password'] !=''){
	self::setUsersLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	$data['username'] = $_POST['username'];

	$data['usertypetag'] = $_POST['usertypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['fname'] = $_POST['fname'];
	$data['mname'] = $_POST['mname'];
	$data['lname'] = $_POST['lname'];
	$data['gender'] = $_POST['gender'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	$data['nationality'] = $_POST['nationality'];
	$data['dob'] = $_POST['dob'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	$entitytypetag = str_replace("@","_",$_POST['entitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['photofile']) && $_FILES['photofile']['name'] !=''){
	$originalfilename = 'photofile';

	$finalfilename = $returnid.'_PhotoFile_'.$_FILES['photofile']['name'];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	}
	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename;

	$conditions = array();
	$conditions['=']['id'] = $returnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['NEW_REGISTRATION_SAVED_COMPLETELY'];
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));

	}

	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['NEW_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ERROR_:_NEW_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}




public function saveRegistrationStudentFront($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$finalfilename = '';

	$data = array();
	
	if(isset($_POST['password']) && $_POST['password']  !=''){
	self::setUsersLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	if($id==''){
	$data['username'] = self::$username;
	}else{
	$data['username'] = $_POST['username'];
	}
	

	$data['usertypetag'] = $_POST['usertypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['fname'] = $_POST['fname'];
	$data['mname'] = $_POST['mname'];
	$data['lname'] = $_POST['lname'];
	$data['gender'] = $_POST['gender'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	$data['nationality'] = $_POST['nationality'];
	$data['dob'] = $_POST['dob'];
	
	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}
	
	$data['isactive'] = 1;


	if($id == ''){

	//Check if Username exists


	$columns = array('username');
	$conditions = array();
	$conditions['=']['username'] = $_POST['username'];

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');

	if($result= $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	if($_POST['username'] == $resultset->username){
	
	$_SESSION['message'] = self::$lang['siya']['users']['USERNAME_ALREADY_EXISTS'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistrationStudentFront'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistrationStudentFront'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}
	
	}
	}
	}
	}
	//

	}


	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['ENTITY_VALUE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	
	$entitytypetag = str_replace("@","_",$_POST['entitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['photofile']) && $_FILES['photofile']['name'] !=''){
	$originalfilename = 'photofile';

	$finalfilename = $returnid.'_PhotoFile_'.$_FILES['photofile']['name'];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	}


	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename;	
	$data['addedby'] = $returnid;	
	$conditions = array();
	$conditions['=']['id'] = $returnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_SAVED_COMPLETELY'];
	}



	$data = array();

	$data['userid'] = $returnid;
	$data['registrationno'] = $_POST['registrationno'];
	$data['doa'] = $_POST['doa'];
	$data['emergencycontactname'] = $_POST['emergencycontactname'];
	$data['emergencycontactnumber'] = $_POST['emergencycontactnumber'];
	$data['status'] = '1';
	

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'students', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'students', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator(''));

	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistrationStudentFront'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistrationStudentFront'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}
	
	}




public function saveRegistrationTeacherFront($parameters){


	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	
	if($_POST['password'] !=''){
	self::setUsersLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	$data['username'] = $_POST['username'];

	$data['usertypetag'] = $_POST['usertypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['fname'] = $_POST['fname'];
	$data['mname'] = $_POST['mname'];
	$data['lname'] = $_POST['lname'];
	$data['gender'] = $_POST['gender'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	$data['nationality'] = $_POST['nationality'];
	$data['dob'] = $_POST['dob'];
	
	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = 1;

	$finalfilename = '';

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	$entitytypetag = str_replace("@","_",$_POST['entitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['photofile']) && $_FILES['photofile']['name'] !=''){
	$originalfilename = 'photofile';

	$finalfilename = $returnid.'_PhotoFile_'.$_FILES['photofile']['name'];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	}
	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename;
	$data['addedby'] = $returnid;

	$conditions = array();
	$conditions['=']['id'] = $returnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['NEW_REGISTRATION_SAVED_COMPLETELY'];
	MainSystem::URLForwarder(MainSystem::URLCreator('/'));
	}

	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['NEW_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistrationTeacherFront'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewRegistrationTeacherFront'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ERROR_:_NEW_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}


public function saveStudentRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$finalfilename = '';

	$data = array();
	
	if(isset($_POST['password']) && $_POST['password']  !=''){
	self::setUsersLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	if($id==''){
	$data['username'] = self::$username;
	}else{
	$data['username'] = $_POST['username'];
	}
	

	$data['usertypetag'] = $_POST['usertypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['fname'] = $_POST['fname'];
	$data['mname'] = $_POST['mname'];
	$data['lname'] = $_POST['lname'];
	$data['gender'] = $_POST['gender'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	$data['nationality'] = $_POST['nationality'];
	$data['dob'] = $_POST['dob'];
	
	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}
	
	$data['isactive'] = 1;


	if($id == ''){

	//Check if Username exists


	$columns = array('username');
	$conditions = array();
	$conditions['=']['username'] = $_POST['username'];

	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');

	if($result= $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	if($_POST['username'] == $resultset->username){
	
	$_SESSION['message'] = self::$lang['siya']['users']['USERNAME_ALREADY_EXISTS'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStaffRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}
	
	}
	}
	}
	}
	//

	}


	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['ENTITY_VALUE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	
	$entitytypetag = str_replace("@","_",$_POST['entitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['photofile']) && $_FILES['photofile']['name'] !=''){
	$originalfilename = 'photofile';

	$finalfilename = $returnid.'_PhotoFile_'.$_FILES['photofile']['name'];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	}


	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename;	
	$conditions = array();
	$conditions['=']['id'] = $returnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_SAVED_COMPLETELY'];
	}



	$data = array();

	$data['userid'] = $returnid;
	$data['registrationno'] = $_POST['registrationno'];
	$data['doa'] = $_POST['doa'];
	$data['emergencycontactname'] = $_POST['emergencycontactname'];
	$data['emergencycontactnumber'] = $_POST['emergencycontactnumber'];
	$data['status'] = '1';
	

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'students', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'students', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editStudentRegistration/'.$returnid.'/'));

	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStudentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStudentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STAFF_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}

}


public function saveStudentParentRegistration($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}


	$finalfilename = '';
	$finalfilename2 = '';
	$finalfilename3 = '';
	$finalfilename4 = '';
	
	$data = array();
	
	if(isset($_POST['password']) && $_POST['password']  !=''){
	self::setUsersLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	if($id==''){
	$data['username'] = self::$username;
	}else{
	$data['username'] = $_POST['username'];
	}
	

	$data['usertypetag'] = $_POST['usertypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
	$data['fname'] = $_POST['fname'];
	$data['mname'] = $_POST['mname'];
	$data['lname'] = $_POST['lname'];
	$data['gender'] = $_POST['gender'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	$data['nationality'] = $_POST['nationality'];
	$data['dob'] = $_POST['dob'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');



	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['ENTITY_VALUE_SAVED'];
	$studentreturnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	
	$entitytypetag = str_replace("@","_",$_POST['entitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['photofile']) && $_FILES['photofile']['name'] !=''){
	$originalfilename = 'photofile';

	$finalfilename = $studentreturnid.'_PhotoFile_'.$_FILES['photofile']['name'];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	}


	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename;

	$conditions = array();
	$conditions['=']['id'] = $studentreturnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['NEW_REGISTRATION_SAVED_COMPLETELY'];
	}



	$data = array();

	$data['userid'] = $studentreturnid;
	$data['registrationno'] = $_POST['registrationno'];
	$data['doa'] = $_POST['doa'];
	$data['emergencycontactname'] = $_POST['emergencycontactname'];
	$data['emergencycontactnumber'] = $_POST['emergencycontactnumber'];
	$data['status'] = '1';
	

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'students', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'students', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;


	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));

	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['STUDENT_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStudentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addStudentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['STAFF_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}


	$data = array();

	if(isset($_POST['ppassword']) && $_POST['ppassword'] !=''){
	self::setUsersLoginDetails($_POST['pusername'], $_POST['ppassword']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}

	
	if($id==''){
	$data['username'] = self::$username;
	}else{
	$data['username'] = $_POST['pusername'];
	}


	$data['usertypetag'] = $_POST['pusertypetag'];
	$data['entitytypetag'] = $_POST['pentitytypetag'];
	$data['fname'] = $_POST['pfname'];
	$data['mname'] = $_POST['pmname'];
	$data['lname'] = $_POST['plname'];
	$data['gender'] = $_POST['pgender'];
	$data['email'] = $_POST['pemail'];
	$data['phone'] = $_POST['pphone'];
	$data['addressline1'] = $_POST['paddressline1'];
	$data['addressline2'] = $_POST['paddressline2'];
	$data['city'] = $_POST['pcity'];
	$data['state'] = $_POST['pstate'];
	$data['country'] = $_POST['pcountry'];
	$data['nationality'] = $_POST['pnationality'];
	$data['dob'] = $_POST['pdob'];
	
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
	
	 $sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');



	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['ENTITY_VALUE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	


	$entitytypetag = str_replace("@","_",$_POST['pentitytypetag']);

	// Image Upload Start Here //
	if(isset($_FILES['pphotofile']) && $_FILES['pphotofile']['name'] !=''){
	
	$originalfilename3 = 'pphotofile';

	$finalfilename3 = $returnid.'_PhotoFile_'.$_FILES['pphotofile']['name'];
	
	$foldername3 = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos');
	}

	$foldername3 = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Photos';

	$uploadmessage3 = MainSystem::FileUploader($originalfilename3,$foldername3,$finalfilename3,1);
	$_SESSION['message'] .= '<br />'.$uploadmessage3;
	}


	
	// Image Upload Ends Here //
	
	$data = array();
	$data['photofile'] = $finalfilename3;	
	$conditions = array();
	$conditions['=']['id'] = $returnid;

	$sqlObj = new MainSQL();
	
	$sql =$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['PARENT_REGISTRATION_SAVED_COMPLETELY'];
	}



	if(isset($_FILES['presumefile']) && $_FILES['presumefile']['name'] !=''){
	$originalfilename4 = 'presumefile';

	$finalfilename4 = $returnid.'_ResumeFile_'.$_FILES['presumefile']['name'];
	
	$foldername4 = '';

	if(is_dir(PROJ_DATA_DIR._S.'Users')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users');
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume')){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume');
	}

	$foldername4 = PROJ_DATA_DIR._S.'Users'._S.$entitytypetag._S.'Resume';

	$uploadmessage4 = MainSystem::FileUploader($originalfilename4,$foldername4,$finalfilename4);
	$_SESSION['message'] .= '<br />'.$uploadmessage4;
	}


	
	// Image Upload Ends Here //
	

	

	$data = array();
	$data['resumefile'] = $finalfilename4;

	$data['userid'] = $returnid;
	$data['parentof'] = $studentreturnid;
	$data['occupation'] = $_POST['poccupation'];
	$data['officeaddressline1'] = $_POST['pofficeaddressline1'];
	$data['officeaddressline2'] = $_POST['pofficeaddressline2'];
	$data['officecity'] = $_POST['pofficecity'];
	$data['officestate'] = $_POST['pofficestate'];
	$data['officecountry'] = $_POST['pofficecountry'];
	$data['officephone'] = $_POST['pofficephone'];
	

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'parents', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'parents', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['PARENTS_REGISTRATION_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageNewRegistration/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['PARENTS_REGISTRATION_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addParentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addParentRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ERROR_:_PARENTS_REGISTRATION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}

}



public function saveBatch($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();

	$data['batchcode'] = $_POST['batchcode'];
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
	$_SESSION['message'] = self::$lang['siya']['users']['BATCH_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editBatch/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['BATCH_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'batchRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'batchRegistration'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['ERROR_:_SESSION_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

}// function saveSession


public function setBatch(){

$_SESSION['batchid'] = $_POST['menuid'];

MainSystem::URLForwarder(MainSystem::URLCreator('admin/getAdminHome/'));

}

public function manageStudents($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['MANAGE_STUDENTS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editAdminRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['EDIT_ADMIN_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editStudentRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['EDIT_STUDENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function manageParents($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['MANAGE_PARENTS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editParentRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['EDIT_PARENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


	public function manageStaff($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['MANAGE_STAFF'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editStaffRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['EDIT_STAFF_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function manageUserType($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['MANAGE_USER_TYPE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editUserType($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['EDIT_USER_TYPE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function manageNewRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['MANAGE_NEW_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editNewRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	

	$columns = array('usertypetag');
	$sqlObj = new MainSQL();
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	
	if($resultset = $sqlObj->FetchResult($result)){
	$usertypetag = ($resultset->usertypetag=='')?'':$sqlObj->getCleanData($resultset->usertypetag);
	}
	}
	}

	if($usertypetag == '#admin'){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editAdminRegistration/'.$id.'/'));
	}else if($usertypetag == '#teacher' || $usertypetag == '#staff'){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editStaffRegistration/'.$id.'/'));
	}else if($usertypetag == '#student'){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editStudentRegistration/'.$id.'/'));
	}else if($usertypetag == '#parent'){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editParentRegistration/'.$id.'/'));
	}

	
}


public function changeStudentStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['USER_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));
	}
	}
	}
	}

}

public function changeStaffStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['USER_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));
	}
	}
	}
	}

}

public function changeParentStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['USER_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));
	}
	}
	}
	}

}


public function deleteStudentRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteStudentRegistrationConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'users', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['userid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'students', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['userid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'healthcard', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));
	}
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}

	
public function deleteStaffRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteStaffRegistrationConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'users', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['userid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'staff', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function deleteParentRegistration($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteParentRegistrationConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'users', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['userid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'parents', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function changeUserTypeStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'usertypes', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['users']['USER_TYPE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));
	}
	}
	}
	}

}

public function deleteUserType($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}



public function deleteUserTypeConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'usertypes', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));
	}
	else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));
	}
}


	public function studentsMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'users', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['userid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'students', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));
	}
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['users']['USERS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));

	}else{

	if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['USER_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStudents/'));

	}
	
	}

}



public function showUserImageByID($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}


	if(isset($parameters[1])){
	$thumb = $parameters[1];
	}else{
	$thumb = '';
	}


$columns = array('photofile','entitytypetag','gender');
$conditions = array();
$conditions['=']['id'] = $id;
$conditions['AND =']['isactive'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
$result = $sqlObj->FireSQL($sql);
if($resultset = $sqlObj->FetchResult($result)){
}


//$foldername = PROJ_DATA_DIR._S.str_replace("@","_",$resultset->entitytypetag)._S.'thumb';die;
$foldername = ($thumb=='1')?PROJ_DATA_DIR._S.'Users'._S.str_replace("@","_",$resultset->entitytypetag)._S.'Photos'._S.'thumbs':PROJ_DATA_DIR._S.'Users'._S.str_replace("@","_",$resultset->entitytypetag)._S.'Photos';

$filename = $resultset->photofile;

if($filename != ''){
if(file_exists($foldername._S.$filename)){
header('Content-Type: MainSystem::returnMIMEType($filename)');
$contents = file_get_contents($foldername._S.$filename);
}else{
$photofile = ($resultset->gender=='M')?PROJ_MODULES_DIR._S.'users'._S.'images'._S.'siya_no_user_male.png':PROJ_MODULES_DIR._S.'users'._S.'images'._S.'siya_no_user_female.png';
$contents = file_get_contents($photofile);
}
}else{
$photofile = ($resultset->gender=='M')?PROJ_MODULES_DIR._S.'users'._S.'images'._S.'siya_no_user_male.png':PROJ_MODULES_DIR._S.'users'._S.'images'._S.'siya_no_user_female.png';
$contents = file_get_contents($photofile);
}
echo $contents;
die;
}



static function downloadStaffResumeFile($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}



	$columns = array('s.resumefile','u.entitytypetag');
	$conditions = array();

	$tables = array();
	$tables['staff'] = 's';
	$tables['users'] = 'u';


	$conditions['=']['s.userid'] = $id;
	$conditions['K AND =']['u.id'] = 's.userid';


	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){

	$foldername = PROJ_DATA_DIR._S.'Users'._S.str_replace("@","_",$resultset->entitytypetag)._S.'Resume';	
	$filename = $resultset->resumefile;
	}
	}
	}


if (file_exists($foldername._S.$filename)) {

header('Content-Type:'.MainSystem::returnMIMEType($filename));
header("Content-length: ". filesize($foldername._S.$filename));
header('Content-Description: File Transfer');
header('Content-Type: MainSystem::returnMIMEType($filename)');
header('Content-Disposition: attachment; filename='.basename($foldername._S.$filename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
readfile($foldername._S.$filename);
exit;


}


}



static function downloadParentResumeFile($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}



	$columns = array('p.resumefile','u.entitytypetag');
	$conditions = array();

	$tables = array();
	$tables['parents'] = 'p';
	$tables['users'] = 'u';


	$conditions['=']['p.userid'] = $id;
	$conditions['K AND =']['u.id'] = 'p.userid';


	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){

	$foldername = PROJ_DATA_DIR._S.'Users'._S.str_replace("@","_",$resultset->entitytypetag)._S.'Resume';	
	$filename = $resultset->resumefile;
	}
	}
	}


if (file_exists($foldername._S.$filename)) {

header('Content-Type:'.MainSystem::returnMIMEType($filename));
header("Content-length: ". filesize($foldername._S.$filename));
header('Content-Description: File Transfer');
header('Content-Type: MainSystem::returnMIMEType($filename)');
header('Content-Disposition: attachment; filename='.basename($foldername._S.$filename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
readfile($foldername._S.$filename);
exit;


}


}

public function usersMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'usertypes', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['users']['USERS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'content', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'content', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageUserType/'));

	}
	

}


public function parentMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'users', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['users']['USERS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageParents/'));

	}
	

}
//staffMultipleManage
public function staffMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'users', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['users']['USERS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageStaff/'));

	}
	

}
//newRegistrationMultipleManage
public function newRegistrationMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'users', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageNewRegistration/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['users']['USERS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageNewRegistration/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageNewRegistration/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageNewRegistration/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['users']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageNewRegistration/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['users']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/manageNewRegistration/'));

	}
	

}


public function showTeachersbyUser(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['SHOW_TEACHERS_BY_USER'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showParentsbyUser(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['users']['SHOW_PARENTS_BY_USER'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


} // class users

