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
class tests
{

public function addTest(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ADD_TEST'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function takeTest(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['TAKE_TEST'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addQuestionsToTest($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ADD_TEST'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function saveUserAnswers($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['SAVE_USER_ANSWERS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showTest($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['SHOW_TEST'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showResult($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['SHOW_RESULT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showQuestions($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	questions::setSeperators();

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['SHOW_QUESTIONS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveTest($parameters){
	
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
	$data['startdate'] = $_POST['startdate'];
	$data['enddate'] = $_POST['enddate'];
	$data['duration'] = $_POST['duration'];
	$data['assignedtoentitytypetag'] = $_POST['assignedtoentitytypetag'];
	$data['password'] = md5($_POST['password']);

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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'tests', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'tests', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['payments']['TEST_SAVED'];
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['payments']['TEST_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addTest'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addTest'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ERROR : Test Cannot be Saved'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveTest




	public function saveQuestionsToTest($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	foreach($_POST['questionid'] as $key => $value){
	
	$data = array();
	$data['questionid'] = $value;
	$data['testid'] = $_POST['testid'];
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'questionsintest', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'questionsintest', $data, $conditions, '', '', '');
	
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['payments']['QUESTIONS_IN_TEST_SAVED'];
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['payments']['QUESTIONS_IN_TEST_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addQuestionsInTest'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addQuestionsInTest'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ERROR_:_QUESTIONS_IN_TEST_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	//return $functionreturnarray;
	}

	}
	
	}
	}// function saveQuestionsToTest



	
} // class chat