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
class webconferencing
{

private static $lang;


function SIYA__webconferencing_INIT__(){

global $lang;

self::$lang = $lang;

}

function SIYA__webconferencing_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addWebConferencing'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showWebConferencing'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveWebConferencing'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editWebConferencing'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteWebConferencing'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteWebConferencingConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

public function addWebConferencing(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['ADD_A_WEB_CONFERENCING'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showWebConferencing($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['SHOW_WEB_CONFERENCING'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function joinWebConferencing($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['JOIN_WEB_CONFERENCING'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function joinWebConferencingModerator($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['JOIN_WEB_CONFERENCING'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showWebConferencingWindow($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['WEB_CONFERENCING_WINDOW'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function showWebConferencingWindowModerator($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['WEB_CONFERENCING_WINDOW'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveWebConferencing($parameters){
	
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
	$data['meetingid'] = $_POST['meetingid'];
	$data['meetingname'] = $_POST['meetingname'];
	$data['attendeepw'] = $_POST['attendeepw'];
	$data['moderatorpw'] = $_POST['moderatorpw'];
	$data['welcomemsg'] = $_POST['welcomemsg'];
	$data['dialnumber'] = $_POST['dialnumber'];
	$data['voicebridge'] = $_POST['voicebridge'];
	$data['description'] = $_POST['description'];
	$data['webvoice'] = $_POST['webvoice'];
	$data['logouturl'] = $_POST['logouturl'];
	$data['maxparticipants'] = $_POST['maxparticipants'];
	$data['record'] = $_POST['record'];
	$data['duration'] = $_POST['duration'];

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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'webconferencing', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'webconferencing', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['webconferencing']['WEB_CONFERENCING_SAVED'];
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['webconferencing']['WEB_CONFERENCING_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addWebConferencing'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addWebConferencing'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['ERROR_:_WEB_CONFERENCING_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveChat

	

	public function editWebConferencing($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['EDIT_WEB_CONFERENCING'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function deleteWebConferencing($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['webconferencing']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteWebConferencingConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'webconferencing', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showSubject/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}

} // class Web Conferencing