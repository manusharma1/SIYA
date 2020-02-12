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
class leaves
{

private static $lang;

function SIYA__leaves_INIT__(){

global $lang;

self::$lang = $lang;

}

function SIYA__leaves_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addLeaveType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addLeave'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveLeaveType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveLeave'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['manageLeaveType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editLeaveType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeLeaveTypeStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['manageLeaves'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editLeave'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeLeaveStatus'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['deleteLeaveType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteLeaveTypeConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteLeave'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteLeaveConfirmed'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['approveLeave'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['leavetypeMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['leaveMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

public function addLeaveType(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['ADD_ADD_LEAVE_TYPE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addLeave($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['ADD_ADD_LEAVE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addLeave2($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['ADD_ADD_LEAVE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveLeaveType($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	$data['leavetypetag'] = $_POST['leavetypetag'];
	$data['entitytypetag'] = $_POST['entitytypetag'];
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'leavetypes', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'leavetypes', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVE_TYPE_CARD_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/editLeaveType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVE_TYPE_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addLeaveType'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addLeaveType'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['LEAVE_TYPE_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveLeaveType


	public function saveLeave($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	//print_r($_POST);
	$leavedaysandperiodstr = '';

	$leavedays = $_POST['leavedays'];
	
	foreach($leavedays as $key => $value){
	foreach($value as $key2 => $value2){
	$leavedaysandperiodstr .=  $key.':'.$value2.',';
	}
	}
	$leavedaysandperiodstr = substr($leavedaysandperiodstr,0,-1);
	
	$data = array();
	$data['userid'] = $_POST['userid'];
	$data['groupid'] = $_POST['groupid'];
	$data['batchid'] = $_POST['batchid'];
	$data['leavetypeid'] = $_POST['leavetypeid'];
	$data['startdate'] = $_POST['startdate'];
	$data['enddate'] = $_POST['enddate'];
	$data['leavedaysandperiod'] = $leavedaysandperiodstr;
	$data['remarks'] = $_POST['remarks'];
	$data['applicationby'] = $_POST['submitteduserid'];

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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'leaves', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'leaves', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVE_DETAIL_SAVED'];
	
	}else{
	$_SESSION['message'] = 'Leave Detail cannot be Saved';
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addLeave'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addLeave'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['ERROR_:_LEAVE_DETAIL_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveLeave




	static function createDateRangeArray($strDateFrom,$strDateTo)
	{

	// Source : 
	// http://boonedocks.net/mike/archives/137-Creating-a-Date-Range-Array-with-PHP.html
	// Due to Less time taken from the internet will try to implement PHP DateTime
		
		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
	}
	

	public function manageLeaveType($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['MANAGE_LEAVE_TYPE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editLeaveType($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['EDIT_LEAVE_TYPE'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changeLeaveTypeStatus($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'leavetypes', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'leavetypes', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVE_TYPES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));
	}
	}
	}
	}

}



	public function manageLeaves($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['MANAGE_LEAVES'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editLeave($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['EDIT_LEAVE'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changeLeaveStatus($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'leaves', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'leaves', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));
	}
	}
	}
	}

}



public function deleteLeaveType($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteLeaveTypeConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'leavetypes', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function deleteLeave($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['leaves']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteLeaveConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'leaves', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function approveLeave($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	
	$columns = array('id','groupid','batchid','userid','leavetypeid','startdate','enddate','leavedaysandperiod');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'leaves', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$userid = $resultset->userid;
	$groupid = $resultset->groupid;
	$batchid = $resultset->batchid;
	$startdate = $resultset->startdate;
	$enddate = $resultset->enddate;
	$leavedaysandperiod = $resultset->leavedaysandperiod;
	}
	}
	}
	
	
	$leavedaysandperiodarray = explode(',',$leavedaysandperiod);

	
	$data2 = array();
	$data2['userid'] = $userid;
	$data2['groupid'] = $groupid;
	$data2['batchid'] = $batchid;
	$data2['leaveid'] = $id;
	
	foreach($leavedaysandperiodarray as $value)
	{
	
	$valuearray = explode(':',$value);
	$leavedate = $valuearray[0];
	$leavedateperiod = $valuearray[1];

	$data2['absentdate'] = $leavedate;
	$data2['absenttype'] = $leavedateperiod;

	// Conditions in case of Edit //


	$sql2 = $sqlObj->SQLCreator('I', 'attendence', $data2, '', '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){	
	
	}else{
	$_SESSION['message'] = 'Leave Detail cannot be Saved';
	}

	}

	$data3 = array();
	$data3['approvedby'] = MainSystem::GetSessionUserID();
	$data3['approveddate'] = date('Y-m-d H:i:s');

	// Conditions in case of Edit //
	$conditions3 = array();
	$conditions3['=']['id'] = $id;
	
	$sql3 = $sqlObj->SQLCreator('U', 'leaves', $data3, $conditions3, '', '', '');
	if($result3 = $sqlObj->FireSQL($sql3)){
	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));
	}

	
}



public function leavetypeMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'leavetypes', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['leaves']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVETYPES_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'leavetypes', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['leaves']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVETYPES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'leavetypes', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['leaves']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVETYPES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaveType/'));

	}
	

}



public function leaveMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'leaves', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['leaves']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVES_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'leaves', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['leaves']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'leaves', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['leaves']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['leaves']['LEAVES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('leaves/manageLeaves/'));

	}
	

}


} // class leaves