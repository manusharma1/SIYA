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
class forums
{
private static $lang;

function SIYA__forums_INIT__(){

global $lang;

self::$lang = $lang;

}
function SIYA__forums_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewForum'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showForum'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showForumTopic'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showAllForumTopic'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['replyForumTopic'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addForumCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addForumTopic'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['saveForum'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveForumCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveForumTopic'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveReplyForumTopic'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editForum'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editForumCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editForumTopic'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['deleteForum'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteForumConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'default', 'description' => '');
$module_installer_info_array['action']['deleteForumCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'default', 'description' => '');
$module_installer_info_array['action']['deleteForumCategoryConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteForumTopic'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteForumTopicConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

public function addNewForum(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['ADD_A_FORUM'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showForum($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['SHOW_FORUM'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showForumTopic($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['SHOW_FORUM_TOPIC'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showAllForumTopic($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['SHOW_FORUM_TOPIC'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function replyForumTopic($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['REPLY_FORUM_TOPIC'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addForumCategory($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['ADD_A_FORUM_CATEGORY'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addForumTopic($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['ADD_A_FORUM_TOPIC'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function saveForum($parameters){
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'forums', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'forums', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editForum/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewForum'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewForum'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['ERROR_:_FORUM_TOPIC_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveForum



	public function saveForumCategory($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	$data['forumid'] = $_POST['forumid'];
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
	
	 $sql = ($id=='')?$sqlObj->SQLCreator('I', 'forumcategories', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'forumcategories', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_CATEGORY_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editForumCategory/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_CATEGORY_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addForumCategory'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addForumCategory'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['ERROR:FORUM_CATEGORY_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveForum



	public function saveForumTopic($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	$data['forumcatid'] = $_POST['forumcatid'];
	$data['title'] = $_POST['title'];
	$data['content'] = $_POST['content'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'forumtopics', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'forumtopics', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_TOPICS_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editForumTopic/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_TOPICS_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addForumTopic'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addForumTopic'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['ERROR_:_FORUM_TOPIC_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveForumTopic

	
	
	public function saveReplyForumTopic($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	$data['replyid'] = $_POST['replyid'];
	$data['forumcatid'] = $_POST['forumcatid'];
	$data['title'] = $_POST['title'];
	$data['content'] = $_POST['content'];
	
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
	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'forumtopics', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'forumtopics', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_TOPICS_SAVED'] ;
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('users/editForumTopic/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['forums']['FORUM_TOPICS_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addForumTopic'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addForumTopic'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['ERROR_:_FORUM_TOPIC_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveForumTopic



	public function editForum($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['EDIT_FORUM'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function editForumCategory($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['EDIT_FORUM_CATEGORY'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function editForumTopic($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['EDIT_FORUM_TOPIC'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}
	


public function deleteForum($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteForumConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'forums', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['forumid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'forumcategories', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['forumcatid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'forumtopics', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showSubject/'));
	}
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function deleteForumCategory($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteForumCategoryConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'forumcategories', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$conditions = array();
	$conditions['=']['forumcatid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'forumtopics', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('forums/showForum/'));
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function deleteForumTopic($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['forums']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteForumTopicConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'forumtopics', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('forums/showAllForumTopic/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}



} // class forums