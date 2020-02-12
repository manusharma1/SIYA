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
class questions
{

private static $lang;

function SIYA__questions_INIT__(){

global $lang;

self::$lang = $lang;

}


public static $seprator, $subseprator, $partsseprator,$fillinblanksquestionseperator,$fillinblanksanswerseperator;

function SIYA__questions_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addQuestionsCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addQuestions'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addQuestionDetails'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showQuestions'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveQuestionsCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveQuestions'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageQuestionCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editQuestionCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeQuestionCategoryStatus'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageQuestions'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editQuestions'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteQuestionCategory'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteQuestionCategoryConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['questionsMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['questionsCategoryMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

public static function setSeperators(){
self::$partsseprator = '==PARTSSEP== @@@@#~~~~PARTSSEPERATOR~~~~#@@@@ ==PARTSSEP=='; 
self::$seprator = '==SEP== ^^^^#~~~~SEPERATOR~~~~#^^^^ ==SEP=='; 
self::$subseprator = '==@!SUBSEP!@ ^^^^#~~~~SUBSEPERATOR~~~~#^^^^ @!SUBSEP!@==';
self::$fillinblanksquestionseperator = '{{____}}';
self::$fillinblanksanswerseperator = '####';
}

public function addQuestionsCategory(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['ADD_QUESTIONS_CATEGORY'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addQuestions(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['ADD_QUESTIONS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addQuestionDetails(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['ADD_QUESTION_DETAILS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showQuestions($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	self::setSeperators();

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['SHOW_QUESTIONS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}



public function saveQuestionsCategory($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'questionscategories', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'questionscategories', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_CATEGORY_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/editQuestionCategory/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_CATEGORY_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addQuestionsCategory'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addQuestionsCategory'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['QUESTIONS_CATEGORY_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveQuestionsCategory
	



	public function saveQuestions($parameters){
	
	$options_str = '';
	$answers_str = '';

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	

	$data = array();
	if($_POST['type']=='MC'){
		self::setSeperators();

		foreach($_POST['options']['options'] as $key => $value){
		$options_str .= $key.self::$subseprator.$value.self::$seprator;
		}

		$options_str = self::stringLastSeperatorReplace(self::$seprator,'',$options_str);

		
		foreach($_POST['options']['answers'] as $key => $value){
		$answers_str .= $key.self::$subseprator.$value.self::$seprator;
		}

		$answers_str = self::stringLastSeperatorReplace(self::$seprator,'',$answers_str);

		$data['options'] = $options_str;
		$data['answer'] = $answers_str;
	}
	
	if($_POST['type']=='TF'){
		$data['options'] = '';
		$data['answer'] =  $_POST['answer'];
		
	}
	
	if($_POST['type']=='MTF'){
		
		self::setSeperators();
		$options1_str = '';
		$options2_str = '';
		$answers1_str = '';
		

		foreach($_POST['optionsa']['options'] as $key => $value){
		$options1_str .= $key.self::$subseprator.$value.self::$seprator;
		}
		foreach($_POST['optionsb']['options'] as $key => $value){
		$options2_str .= $key.self::$subseprator.$value.self::$seprator;
		}
		
		$options1_str = self::stringLastSeperatorReplace(self::$seprator,'',$options1_str);
		$options2_str = self::stringLastSeperatorReplace(self::$seprator,'',$options2_str);

		$options_str = $options1_str.self::$partsseprator.$options2_str;

		
		foreach($_POST['answersb']['answers'] as $key => $value){
		$answers1_str .= $key.self::$subseprator.$value.self::$seprator;
		}
		
		$answers_str = self::stringLastSeperatorReplace(self::$seprator,'',$answers1_str);

		$data['options'] = $options_str;
		$data['answer'] = $answers_str;
	}
	
	if($_POST['type']=='FITB'){
		$data['options'] = '';
		$data['answer'] =  $_POST['answer'];
		
	}

	$data['type'] = $_POST['type'];
	$data['leveltype'] = $_POST['leveltype'];
	$data['categoryid'] = $_POST['categoryid'];
	$data['question'] = $_POST['question'];
	
	$data['feedback'] = $_POST['feedback'];

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
	
	 $sql = ($id=='')?$sqlObj->SQLCreator('I', 'questions', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'questions', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_SAVED'];
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addQuestionDeatils'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addQuestionDeatils'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['QUESTIONS_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveQuestions


	

public static function stringLastSeperatorReplace($substringtoreplace, $replacingvalue, $string){
   
	$position = strrpos($string, $substringtoreplace);

    if($position !== false){
        $string = substr_replace($string, $replacingvalue, $position, strlen($substringtoreplace));
    }

    return $string;
}




	public function manageQuestionCategory($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['MANAGE_QUESTIONS_CATEGORY'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editQuestionCategory($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['EDIT_QUESTION_CATEGORY'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}


	public function editQuestion($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		self::setSeperators();

		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['EDIT_QUESTION'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changeQuestionCategoryStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'questionscategories', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'questionscategories', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTION_CATEGORY_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));
	}
	}
	}
	}

	}




	public function manageQuestions($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['MANAGE_QUESTIONS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editQuestions($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['questions']['EDIT_QUESTIONS'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changeQuestionStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'questions', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'questions', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTION_CATEGORY_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestions/'));
	}
	}
	}
	}

	}

public function deleteQuestionCategory($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] =self::$lang['siya']['questions']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteQuestionCategoryConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'questionscategories', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}
//questionsMultipleManage
public function questionsMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'questions', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestions/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestions/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'questions', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestions/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestions/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'questions', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestions/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestions/'));

	}
	

}
//questionsCategoryMultipleManage
public function questionsCategoryMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'questionscategories', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_CAT_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'questionscategories', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_CAT_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'questionscategories', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['questions']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['questions']['QUESTIONS_CAT_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('questions/manageQuestionCategory/'));

	}
	

}

} // class questions