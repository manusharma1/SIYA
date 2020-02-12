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
class assignments
{

private static $lang;

function SIYA__assignments_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showAssignment'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['replyAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher,#student', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveReplyAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher,#student', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['openAssignmentContentVideo'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['openAssignmentContentDoc'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['openAssignmentContentFile'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteAssignmentConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editReplyAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher,#student', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['deleteReplyAssignment'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteReplyAssignmentConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

function SIYA__assignments_INIT__(){

global $lang;

self::$lang = $lang;

}


public function addAssignment(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['assignments']['ADD_ASSIGNMENTS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showAssignment($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['assignments']['SHOW_ASSIGNMENTS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function replyAssignment($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['assignments']['REPLY_ASSIGNMENTS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function saveAssignment($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	$data['groupid'] = $_POST['groupid'];
	$data['batchid'] = $_POST['batchid'];
	$data['topicid'] = $_POST['topicid'];
	$data['subjectid'] = $_POST['subjectid'];
	$data['chapterid'] = $_POST['chapterid'];
	$data['name'] = $_POST['name'];
	$data['description'] = $_POST['description'];
	$data['startdate'] = $_POST['startdate'];
	$data['enddate'] = $_POST['enddate'];
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'assignments', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'assignments', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('assignments/editAssignment/'.$returnid.'/'));

	
	$columns = array('batchid','groupid','subjectid','chapterid','topicid','semesterid');
	$conditions = array();
	
	$conditions['=']['id'] = $returnid;

	
	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('S', 'assignments', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	
	}
	}
	}
	
	// FILE UPLOAD START HERE //


	foreach($_POST['chosenfile'] as $key => $value)
	{

	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']['name'][$key])  !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'][$key];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid);
	}

	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid);
	}


	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid);
	}


	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid);
	}

	$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid;

	$foldername2db = 'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid;


	$uploadreturnarray= MainSystem::FileUploaderMultiple($originalfilename,$key,$foldername,$finalfilename,false,'',true);
	$_SESSION['message'] .= '<br />'.$uploadreturnarray['output'];
	
	// Image Upload Ends Here //

	$data = array();
	$data['assignmentid'] = $returnid;
	$data['filename'] = $uploadreturnarray['finalfilename'];
	$data['filepath'] = $foldername2db;
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'assignmentuploads', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'assignmentuploads', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_SAVED'];
	}

	}
	
	}


	
	}else{
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_CANNOT_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addAssignment'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addAssignment'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['assignments']['ERROR_ASSIGNMENT_CANNOT_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveAssignments


	public function saveReplyAssignment($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	
	if(isset($_POST['replyid'])){
	$replyid = $_POST['replyid'];
	}else{
	$replyid = '';
	}
	
	if(isset($_POST['groupid'])){
	$groupid = $_POST['groupid'];
	}else{
	$groupid = '';
	}

	$data = array();
	$data['replyid'] = $replyid;
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'assignments', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'assignments', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_REPLY_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;

	MainSystem::URLForwarder(MainSystem::URLCreator('assignments/showAssignment/'.$replyid.','.$groupid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_REPLY_CANNOT_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'replyAssignment'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'replyAssignment'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['assignments']['ERROR_ASSIGNMENT_REPLY_CANNOT_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}


	$columns = array('batchid','groupid','subjectid','chapterid','topicid','semesterid');
	$conditions = array();
	
	$conditions['=']['id'] = $replyid;

	
	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('S', 'assignments', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	
	}
	}
	}


// FILE UPLOAD START HERE //


	foreach($_POST['chosenfile'] as $key => $value)
	{

	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']['name'][$key])  !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'][$key];
	
	$foldername = '';

	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid);
	}

	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid);
	}


	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid);
	}


	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid);
	}

	$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid;

	$foldername2db = 'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid;

	$uploadreturnarray= MainSystem::FileUploaderMultiple($originalfilename,$key,$foldername,$finalfilename,false,'',true);
	$_SESSION['message'] .= '<br />'.$uploadreturnarray['output'];
	
	// Image Upload Ends Here //

	$data = array();
	$data['assignmentid'] = $returnid;
	$data['filename'] = $uploadreturnarray['finalfilename'];
	$data['filepath'] = $foldername2db;
	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = 1;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('I', 'assignmentuploads', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_SAVED'];
	}

	}
	
	}


	}// function saveReplyAssignment



public function openAssignmentContentVideo($parameters = ''){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['assignments']['OPEN_VIDEO_FILE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}

public function openAssignmentContentDoc($parameters = ''){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Open Doc File';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


static function openAssignmentContentFile($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	/*
	$columns = array('a2.batchid','a2.groupid','a2.semesterid','a2.subjectid','a2.topicid','a2.chapterid','au.');
	$conditions = array();

	$tables = array();
	$tables['assignments'] = 'a1,a2'; // FOR SELF JOIN PASS THE VALUES OF ALIAS COMMA SEPERATED //
	$tables['assignmentuploads'] = 'au';

	$conditions['=']['au.id'] = $id;
	$conditions['K AND =']['au.assignmentid'] = 'a1.id';
	$conditions['K AND =']['a1.replyid'] = 'a2.id';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	//print_r($resultset);
	$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid;
	$filename = $resultset->filename;
	}
	}
	}
	*/


	$columns = array('id','filename','filepath');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'assignmentuploads', $columns, $conditions, '', '', '');
	
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$filename = $resultset->filename;
	$filepath = $resultset->filepath;
	$filefullpath = PROJ_DATA_DIR._S.$filepath._S.$filename;
	}
	}
	}

	if (file_exists($filefullpath)) {

	header('Content-Type:'.MainSystem::returnMIMEType($filename));
	header("Content-length: ". filesize($filefullpath));
	readfile($filefullpath);
	exit;


	}


	}
public function editAssignment($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Edit Assignment';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}

//deleteAssignment
public function deleteAssignment($parameters){
	

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = 'Delete Assignment';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteAssignmentConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	$topicid = $parameters[1];
	}else{
	$id = '';
	$topicid='';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'assignments', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showTopic/'.$topicid.'/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}



public function editReplyAssignment($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Edit Assignment Replys';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
}



public function deleteReplyAssignment($parameters){
	

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = 'Delete Assignment';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}



public function deleteReplyAssignmentConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	$topicid = $parameters[1];
	}else{
	$id = '';
	$topicid='';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'assignments', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['assignments']['ASSIGNMENT_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showTopic/'.$topicid.'/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


} // class assignments