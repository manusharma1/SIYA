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
class attendence
{
private static $lang;

function SIYA__attendence_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['markAttendence'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveAttendence'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showAttendence'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

function SIYA__entities_INIT__(){

global $lang;

self::$lang = $lang;

}

public function markAttendence($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['attendence']['MARK_ATTENDENCE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showAttendence($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['attendence']['SHOW_ATTENDENCE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}



public function saveAttendence($parameters){
	
	$id = (isset($parameters[0]))?$parameters[0]:'';
	$selected_batch_id = (isset($parameters[1]))?$parameters[1]:'';
	$subjectid = (isset($parameters[2]))?$parameters[2]:'';


	$data = array();
	$data['userid'] = $_POST['userid'];
	$data['groupid'] = $id;
	$data['batchid'] = $selected_batch_id;
	$data['batchid'] = $selected_batch_id;
	$data['absentdate'] = $_POST['absentdate'];

	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}


	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('I', 'attendence', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Attendence Saved';
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['attendence']['ATTENDENCE_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'markAttendence'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'markAttendence'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['attendence']['ERROR_ATTENDENCE_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function markAttendence


} // class Attendence