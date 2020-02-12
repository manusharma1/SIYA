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
class timetable
{

private static $lang;

function SIYA__timetable_INIT__(){

global $lang;

self::$lang = $lang;

}


function SIYA__timetable_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewPeriod'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['updateTimeTable'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showTimeTable'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['savePeriod'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveTimeTable'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['managePeriods'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editPeriod'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['usersMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
 

return $module_installer_info_array;

}

public function addNewPeriod(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['timetable']['SUBJECT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function  updateTimeTable($parameters){
	

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['timetable']['UPDATE_TIME_TABLE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function showTimeTable($parameters){
	

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['timetable']['UPDATE_TIME_TABLE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function savePeriod(){
	
	if(isset($_POST['periodid'])){
	$id = $_POST['periodid'];
	}else{
	$id = '';
	}
	
	$periodnumber1 = '';

	$data = array();
	$data['groupid'] = $_POST['groupid'];
	$data['batchid'] = $_POST['batchid'];
	$data['day'] = $_POST['day'];



	$columns1 = array('periodnumber');
	$conditions1 = array();


	$conditions1['=']['id'] = $id;


	$sqlObj = new MainSQL();

	$sql1 = $sqlObj->SQLCreator('S', 'periods', $columns1, $conditions1, '', '', '');

	if($result1 = $sqlObj->FireSQL($sql1)){
	if($resultset1 = $sqlObj->FetchResult($result1)){
	$periodnumber1 = $resultset1->periodnumber;
	}
	}

	
	if($_POST['periodnumber'] != $periodnumber1){ // in case of edit

	$columns2 = array('id');
	$conditions2 = array();


	$conditions2['=']['periodnumber'] = $_POST['periodnumber'];
	$conditions2['AND =']['groupid'] = $_POST['groupid'];
	$conditions2['AND =']['batchid'] = $_POST['batchid'];

	$sql2 = $sqlObj->SQLCreator('S', 'periods', $columns2, $conditions2, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){
	$_SESSION['message'] = self::$lang['siya']['timetable']['THIS_PERIOD_NUMBER_ALREADY_EXITS'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/addNewPeriod/'));
	}
	}
	
	
	}

	$starttime = $_POST['starthour'].':'.$_POST['startminute'].':'.'00';
	
	$endtime = $_POST['endhour'].':'.$_POST['endminute'].':'.'00';
	
	
	$columns = array('id','starttime','endtime');
	$conditions = array();
	
	$conditions['=']['groupid'] = $_POST['groupid'];
	$conditions['AND =']['batchid'] = $_POST['batchid'];
	$conditions['AND =']['day'] = $_POST['day'];
	$conditions['AND >=']['starttime'] = $starttime;
	$conditions['AND <=']['starttime'] = $endtime;

	if($_POST['periodnumber'] == $periodnumber1){ // case of edit
	$conditions['AND !=']['id'] = $id;
	}
	
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'periods', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$_SESSION['message'] = self::$lang['siya']['timetable']['SORRY_PERIOD_CANNOT_BE_SAVED_AS_A_PERIOD_WITH_SAME_DAY_TIME_BATCH_AND_SESSION_EXISTS'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/addNewPeriod/'));
	}
	}else{

	$conditions2 = array();



	$conditions2['=']['groupid'] = $_POST['groupid'];
	$conditions2['AND =']['batchid'] = $_POST['batchid'];
	$conditions2['AND =']['day'] = $_POST['day'];
	$conditions2['AND >=']['endtime'] = $starttime;
	$conditions2['AND <=']['endtime'] = $endtime;
	if($_POST['periodnumber'] == $periodnumber1){ // case of edit
	$conditions2['AND !=']['id'] = $id;
	}


	$sql = $sqlObj->SQLCreator('S', 'periods', $columns, $conditions2, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$_SESSION['message'] = self::$lang['siya']['timetable']['SORRY_PERIOD_CANNOT_BE_SAVED_AS_A_PERIOD_WITH_SAME_DAY_TIME_BATCH_AND_SESSION_EXISTS'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/addNewPeriod/'));
	}
	}else{
	
	
	$data['title'] = $_POST['title'];
	$data['periodnumber'] = $_POST['periodnumber'];
	$data['starttime'] = $starttime;
	$data['endtime'] = $endtime;
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'periods', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'periods', $data, $conditions, '', '', '');

	$sql;
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['timetable']['PERIOD_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/addNewPeriod/'));
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['timetable']['PERIOD_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/addNewPeriod/'));
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewPeriod'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewPeriod'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['timetable']['ERROR_PERIOD_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}

	}
	}

	}
	}


	}// function savePeriod


	
public function saveTimeTable($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$data = array();
	$data['periodid'] = $_POST['periodid'];
	$data['subjectid'] = $_POST['subjectid'];
	$data['teacherid'] = $_POST['teacherid'];
	$data['coteacherid'] = $_POST['coteacherid'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'timetable', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'timetable', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['timetable']['TIME_TABLE_SAVED'];
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['timetable']['TIME_TABLE_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'updateTimeTable'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'updateTimeTable'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['timetable']['ERROR_TIME_TABLE_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}	
	}
	

	//echo $_SESSION['message'];	

}// function saveTimeTable



public function managePeriods($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['timetable']['MANAGE_PERIODS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editPeriod($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['timetable']['EDIT_PERIOD'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function usersMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'periods', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['timetable']['ERROR_TIME_TABLE_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/managePeriods/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['timetable']['USERS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/managePeriods/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'periods', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['timetable']['ERROR_TIME_TABLE_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('users/managePeriods/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['timetable']['STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePeriods/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'periods', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['timetable']['ERROR_TIME_TABLE_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/managePeriods/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['timetable']['STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('timetable/managePeriods/'));

	}
	

}
	


} // class timetable