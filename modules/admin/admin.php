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

class admin 
{

private static $username, $password, $lang;

function SIYA__admin_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['getContent'] = array('usertypeaccess'=>'*', 'templateaccess'=>'default', 'description' => '');
$module_installer_info_array['action']['login'] = array('usertypeaccess'=>'*', 'templateaccess'=>'default', 'description' => '');
$module_installer_info_array['action']['logout'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['loginCheck'] = array('usertypeaccess'=>'*', 'templateaccess'=>'default', 'description' => '');
$module_installer_info_array['action']['getAdminHome'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showhideControllers'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

function SIYA__admin_INIT__(){

global $lang;

self::$lang = $lang;

}



public function getContent($id){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$columns = array('title','data');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	if($resultset = $sqlObj->FetchResult($result)){
	if(!empty($resultset)){
	$functionreturnarray['title_placeholder'] = $sqlObj->getCleanData($resultset->title);
	$functionreturnarray['main_content_placeholder'] = $sqlObj->getCleanData($resultset->data);
	return $functionreturnarray;
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/'));
	}
	}else{
	trigger_error('DB Fetch Error');
	// Trigger DB Error // Code Needs to be Updated //
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/'));
	return 0;
	}
}
	


public function getAdminHome(){
	
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['admin']['WELCOME_TO_THE_ADMIN_HOME'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}


public function getSiyaSetupHome(){
	
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['admin']['WELCOME_TO_THE_SIYA_SETUP_ADMIN_HOME'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

public function login(){

	$HTMLObj = new MainHTML();
	$htmlarray = array();

	$htmlarray[]['div']['nameid'] = 'divtest';
	$htmlarray[]['div']['close'] = '';
	$htmlarray[]['form']['nameid'] = 'login';
	$htmlarray[]['form']['method'] = 'post';
	$htmlarray[]['form']['action'] = MainSystem::URLCreator('admin/loginCheck/');
	$htmlarray[]['form']['onSubmit'] = 'return JSMainFunction();';
	$htmlarray[]['form']['close'] = '';
	//$htmlarray[]['input']['name'] = 'q';
	//$htmlarray[]['input']['type'] = 'hidden';
	//$htmlarray[]['input']['value'] = MainSystem::URLCreator('admin/loginCheck/1');
	//$htmlarray[]['input']['end'] = '';
	$htmlarray[]['p']['start'] = '';
	$htmlarray[]['p']['close'] = '';
	$htmlarray[]['p']['data'] = 'Username:';
	$htmlarray[]['p']['end'] = '';
	$htmlarray[]['input']['nameid'] = 'username';
	$htmlarray[]['input']['title'] = 'Username';
	$htmlarray[]['input']['type'] = 'text';
	$htmlarray[]['input']['size'] = '20';
	$htmlarray[]['input']['end'] = '';
	$htmlarray[]['p']['start'] = '';
	$htmlarray[]['p']['close'] = '';
	$htmlarray[]['p']['data'] = 'Password:';
	$htmlarray[]['p']['end'] = '';
	$htmlarray[]['input']['nameid'] = 'password';
	$htmlarray[]['input']['title'] = 'Password';
	$htmlarray[]['input']['type'] = 'password';
	$htmlarray[]['input']['size'] = '30';
	$htmlarray[]['input']['end'] = '';
	$htmlarray[]['br']['start'] = '';
	$htmlarray[]['br']['end'] = '';
	$htmlarray[]['br']['start'] = '';
	$htmlarray[]['br']['end'] = '';
	$htmlarray[]['input']['name'] = 'Submit';
	$htmlarray[]['input']['type'] = 'submit';
	$htmlarray[]['input']['value'] = 'Login';
	$htmlarray[]['input']['close'] = '';
	$htmlarray[]['input']['name'] = 'LoginForm';
	$htmlarray[]['input']['type'] = 'hidden';
	$htmlarray[]['input']['value'] = '1';
	$htmlarray[]['input']['close'] = '';
	$htmlarray[]['form']['end'] = ''; 
	$htmlarray[]['div']['end'] = '';
	$htmlarray[]['js']['js'] = 'notempty=username,password:onsubmit=login:alert:default';

	$functionreturnarray['title_placeholder'] = self::$lang['siya']['admin']['PLEASE_LOGIN'];
	$functionreturnarray['main_content_placeholder'] = $HTMLObj->HTMLCreator($htmlarray);
	return $functionreturnarray;
}



public function setupLogin(){

	$HTMLObj = new MainHTML();
	$htmlarray = array();

	$htmlarray[]['div']['nameid'] = 'divtest';
	$htmlarray[]['div']['close'] = '';
	$htmlarray[]['form']['nameid'] = 'login';
	$htmlarray[]['form']['method'] = 'post';
	$htmlarray[]['form']['action'] = MainSystem::URLCreator('admin/loginCheck/');
	$htmlarray[]['form']['onSubmit'] = 'return JSMainFunction();';
	$htmlarray[]['form']['close'] = '';
	$htmlarray[]['p']['start'] = '';
	$htmlarray[]['p']['close'] = '';
	$htmlarray[]['p']['data'] = 'Username:';
	$htmlarray[]['p']['end'] = '';
	$htmlarray[]['input']['nameid'] = 'username';
	$htmlarray[]['input']['title'] = 'Username';
	$htmlarray[]['input']['type'] = 'text';
	$htmlarray[]['input']['size'] = '20';
	$htmlarray[]['input']['end'] = '';
	$htmlarray[]['p']['start'] = '';
	$htmlarray[]['p']['close'] = '';
	$htmlarray[]['p']['data'] = 'Password:';
	$htmlarray[]['p']['end'] = '';
	$htmlarray[]['input']['nameid'] = 'password';
	$htmlarray[]['input']['title'] = 'Password';
	$htmlarray[]['input']['type'] = 'password';
	$htmlarray[]['input']['size'] = '30';
	$htmlarray[]['input']['end'] = '';
	$htmlarray[]['br']['start'] = '';
	$htmlarray[]['br']['end'] = '';
	$htmlarray[]['br']['start'] = '';
	$htmlarray[]['br']['end'] = '';
	$htmlarray[]['input']['name'] = 'Submit';
	$htmlarray[]['input']['type'] = 'submit';
	$htmlarray[]['input']['value'] = 'Login';
	$htmlarray[]['input']['close'] = '';
	$htmlarray[]['input']['name'] = 'LoginForm';
	$htmlarray[]['input']['type'] = 'hidden';
	$htmlarray[]['input']['value'] = '1';
	$htmlarray[]['input']['close'] = '';

	$htmlarray[]['input']['name'] = 'SiyaSetupLogin';
	$htmlarray[]['input']['type'] = 'hidden';
	$htmlarray[]['input']['value'] = 'true';
	$htmlarray[]['input']['close'] = '';

	$htmlarray[]['form']['end'] = ''; 
	$htmlarray[]['div']['end'] = '';
	$htmlarray[]['js']['js'] = 'notempty=username,password:onsubmit=login:alert:default';

	$functionreturnarray['title_placeholder'] = self::$lang['siya']['admin']['PLEASE_LOGIN'];
	$functionreturnarray['main_content_placeholder'] = $HTMLObj->HTMLCreator($htmlarray);
	return $functionreturnarray;
}




public function loginCheck(){

	$_SESSION['LoginForm'] = "1"; // security //
	if(isset($_POST['Submit']) && isset($_POST['LoginForm']) && $_POST['LoginForm']=="1" && isset($_SESSION['LoginForm']) && $_SESSION['LoginForm']=="1"){
	
	if(isset($_POST['SiyaSetupLogin'])){
	if($_POST['SiyaSetupLogin'] == 'true'){
	$_SESSION['SiyaSetupLogin'] = 'true';
	}
	}


	self::setUserLoginDetails($_POST['username'], $_POST['password']);
	self::LoginAuthentication();
	}
}

private static function setUserLoginDetails($username='', $password=''){
self::$username = $username;
self::$password = $password;
}

private static function LoginAuthentication(){
	$password =  MainSystem::SystemPasswordReturn(self::$password);
	$columns = array('id','username');
	$conditions = array();
	$conditions['=']['username'] = self::$username;
	$conditions['AND =']['password'] = $password;
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$resultset = $sqlObj->FetchResult($result);
		if(!empty($resultset)){
		$usernamestr = str_replace('.', '', $resultset->username);
		$_COOKIE = array();
		$_SESSION['username'] = $usernamestr;
		$_SESSION['id'] = $resultset->id;
		$_SESSION['UserLoGGedIn'] = 'true';
		$_SESSION['WSName'] = PROJ_NAME;
		$_SESSION['admin'] = 'true';
		$_SESSION['message'] = '';
		
		$cookiename = 'ProjectAdmin_'.$usernamestr;
		setcookie($cookiename, 'PA'.$usernamestr.'pa', time()+PROJ_SESSION_TIME_LIMIT, '/');

		// SET USER LOGIN FLAG == ON

		$data['isonline'] = '1';

			$conditions = array();
			$conditions['=']['id'] = MainSystem::GetSessionUserID();

			$sqlObj = new MainSQL();
			
			$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

			if($result = $sqlObj->FireSQL($sql)){
			}else{
			trigger_error(self::$lang['siya']['ERROR_SQL_CANNOT_BE_EXECUTED'],E_USER_ERROR);	
			}
		
		// SET USER LOGIN FLAG == ON

		if(isset($_SESSION['SiyaSetupLogin']) && $_SESSION['SiyaSetupLogin'] == 'true'){
		MainSystem::URLForwarder(MainSystem::URLCreator('admin/getSiyaSetupHome/'));
		}else{
		MainSystem::URLForwarder(MainSystem::URLCreator('admin/getAdminHome/'));
		}
		}else{
		$_SESSION['message'] = self::$lang['siya']['admin']['UNABLE_TO_LOGIN'];
		MainSystem::URLForwarder(MainSystem::URLCreator('admin/'));
		}
	}else{
	trigger_error(self::$lang['siya']['admin']['ERROR_SQL_CANNOT_BE_EXECUTED'],E_USER_ERROR);
	}

}


public function logout(){


// SET USER LOGIN FLAG == OFF

	$data['isonline'] = '0';

	$conditions = array();
	$conditions['=']['id'] = MainSystem::GetSessionUserID();

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	}else{
	trigger_error('ERROR : SQL cannot be executed',E_USER_ERROR);	
	}

// SET USER LOGIN FLAG == OFF


MainSystem::DestroySession();
MainSystem::URLForwarder(MainSystem::URLCreator('admin/'));

}



public function getUserDetails(){
	
	$id =  MainSystem::GetSessionUserID();
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['admin']['USER_DETAILS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}



public function saveUserDetails($parameters = ''){

	$id = $parameters[0];
	$data = array();
	$data['id'] = $id;
	$password = $_POST['password'];
	if($password !=''){
	self::setUserLoginDetails($_POST['username'], $_POST['password']);
	$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
	$data['password'] = $saltpassword;
	}
	$data['fname'] = $_POST['fname'];
	$data['lname'] = $_POST['lname'];
	$data['email'] = $_POST['email'];
	$data['phone'] = $_POST['phone'];
	$data['addressline1'] = $_POST['addressline1'];
	$data['addressline2'] = $_POST['addressline2'];
	$data['city'] = $_POST['city'];
	$data['state'] = $_POST['state'];
	$data['country'] = $_POST['country'];
	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}
	//$data['isactive'] = 1;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'users', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'users', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['admin']['USER_DETAILS_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('admin/getUserDetails/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['admin']['USER_DETAILS_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('admin/getAdminHome/'));
	}
	

}


static function readFileContents($file){

$filecontents = '';

$validfiles = array(SIYA_ADMIN_SQL_FILE_BLOCKSINSTANCESSETTINGS_DATA,SIYA_ADMIN_SQL_FILE_BLOCKSINSTANCES_DATA);
$path = PROJ_MODULES_DIR._S.'admin'._S.SIYA_ADMIN_SQL_FILES_FOLDER._S.$file;

if(in_array($file,$validfiles)){
if (file_exists($path)) {

$filecontents = file_get_contents($path);

}

}else{

trigger_error('Invalid File Input Type Error : '.$file);

}

return $filecontents;

}


public function showhideControllers($parameters = ''){

$returnurl = $parameters[0].'/'.$parameters[1].'/';


$usertypetag = MainSystem::getUserDetailsbyID(MainSystem::GetSessionUserID())->usertypetag;

$allowedusertypetagarray = array('#admin','#subadmin','#teacher');

if(in_array($usertypetag,$allowedusertypetagarray)){
$_SESSION['controllers']['SHOWCONTROLS'] = ($_SESSION['controllers']['SHOWCONTROLS']==1)?0:1;
}else{
$_SESSION['controllers']['SHOWCONTROLS'] = 0;
}

MainSystem::URLForwarder(MainSystem::URLCreator($returnurl));

}


} // class admin