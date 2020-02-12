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
class importexport
{
private static $username, $password, $lang;


function SIYA__importexport_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['saveUsersFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveStudentFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveParentFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveStaffFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['importUsersFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['importStudentFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['importParentFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['importStaffFromExcel'] = array('usertypeaccess'=>'#admin', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}


function SIYA__importexport_INIT__(){

global $lang;

self::$lang = $lang;

}


private static function setUsersLoginDetails($username='', $password=''){
self::$username = $username;
self::$password = $password;
}

public function saveUsersFromExcel($parameters = ''){
	//print_r($_POST);
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']) && $_FILES['chosenfile']['name'] !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'];
	
	$foldername = PROJ_DATA_DIR._S.'importexport'._S;

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	
	// Image Upload Ends Here //
	
	}


	/** PHPExcel */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel.php');

	/** PHPExcel_Writer_Excel2007 */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel/Writer/Excel2007.php');

	/** PHPExcel_IOFactory */
	include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel'._S.'IOFactory.php');

	$objPHPExcel = PHPExcel_IOFactory::load($foldername._S.$finalfilename);

	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


	$users_table_colums =  array('usertypetag','entitytypetag','username','fname','mname','lname','gender','email','phone','addressline1','addressline2','city','state','country','nationality','dob');
	$users_password_colums =  array('password');

	foreach($sheetData as $key => $value){
		$data = array();
	foreach($value as $key2 => $value2){

	  if(in_array($_POST[$key2],$users_table_colums)){
		$data[$_POST[$key2]] = $value2;
	  }

	  if(in_array($_POST[$key2],$users_password_colums)){
		if($value2 !=''){
		self::setUsersLoginDetails($value2);
		$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
		}
		$data[$_POST[$key2]] = $saltpassword;
	  }

	}

	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['isactive'] = 1;

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('I', 'users', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
		$_SESSION['message'] = self::$lang['siya']['importexport']['REGISTRATION_VALUE_SAVED'];
	}

	}

	}


	public function saveStudentFromExcel($parameters = ''){
	//print_r($_POST);
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']) && $_FILES['chosenfile']['name'] !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'];
	
	$foldername = PROJ_DATA_DIR._S.'importexport'._S;

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	
	// Image Upload Ends Here //
	
	}


	/** PHPExcel */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel.php');

	/** PHPExcel_Writer_Excel2007 */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel/Writer/Excel2007.php');

	/** PHPExcel_IOFactory */
	include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel'._S.'IOFactory.php');

	$objPHPExcel = PHPExcel_IOFactory::load($foldername._S.$finalfilename);

	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


	$users_table_colums =  array('usertypetag','entitytypetag','username','fname','mname','lname','gender','email','phone','addressline1','addressline2','city','state','country','nationality','dob');
	$users_password_colums =  array('password');
	$student_table_colums = array('registrationno','doa','emergencycontactname','emergencycontactnumber');

	foreach($sheetData as $key => $value){
		$data = array();
		$data2 = array();
	foreach($value as $key2 => $value2){

	  if(in_array($_POST[$key2],$users_table_colums)){
		$data[$_POST[$key2]] = $value2;
	  }

	  if(in_array($_POST[$key2],$users_password_colums)){
		if($value2 !=''){
		self::setUsersLoginDetails($value2);
		$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
		}
		$data[$_POST[$key2]] = $saltpassword;
	  }

	  if(in_array($_POST[$key2],$student_table_colums)){
		$data2[$_POST[$key2]] = $value2;
	  }
	}

	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['isactive'] = 1;

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('I', 'users', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
		$_SESSION['message'] = self::$lang['siya']['importexport']['REGISTRATION_VALUE_SAVED'];
		$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	}

	$data2['userid'] = $returnid;
	$sqlObj2 = new MainSQL();

	$sql2 = $sqlObj2->SQLCreator('I', 'students', $data2, '', '', '', '');

	if($result2 = $sqlObj2->FireSQL($sql2)){
	$_SESSION['message'] = self::$lang['siya']['importexport']['STUDENT_REGISTRATION_SAVED'];
	}
	}

}




public function saveParentFromExcel($parameters = ''){
	//print_r($_POST);
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']) && $_FILES['chosenfile']['name'] !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'];
	
	$foldername = PROJ_DATA_DIR._S.'importexport'._S;

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	
	// Image Upload Ends Here //
	
	}


	/** PHPExcel */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel.php');

	/** PHPExcel_Writer_Excel2007 */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel/Writer/Excel2007.php');

	/** PHPExcel_IOFactory */
	include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel'._S.'IOFactory.php');

	$objPHPExcel = PHPExcel_IOFactory::load($foldername._S.$finalfilename);

	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


	$users_table_colums =  array('usertypetag','entitytypetag','username','fname','mname','lname','gender','email','phone','addressline1','addressline2','city','state','country','nationality','dob');
	$users_password_colums =  array('password');
	$parent_table_colums = array('occupation','officeaddressline1','officeaddressline2','emergencycontactnumber','officecity','officestate','officecountry','officephone');

	foreach($sheetData as $key => $value){
		$data = array();
		$data2 = array();
	foreach($value as $key2 => $value2){

	  if(in_array($_POST[$key2],$users_table_colums)){
		$data[$_POST[$key2]] = $value2;
	  }

	  if(in_array($_POST[$key2],$users_password_colums)){
		if($value2 !=''){
		self::setUsersLoginDetails($value2);
		$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
		}
		$data[$_POST[$key2]] = $saltpassword;
	  }

	  if(in_array($_POST[$key2],$parent_table_colums)){
		$data2[$_POST[$key2]] = $value2;
	  }
	}

	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['isactive'] = 1;

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('I', 'users', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
		$_SESSION['message'] = self::$lang['siya']['importexport']['REGISTRATION_VALUE_SAVED'];
		$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	}

	$data2['userid'] = $returnid;
	$sqlObj2 = new MainSQL();

	$sql2 = $sqlObj2->SQLCreator('I', 'parents', $data2, '', '', '', '');

	if($result2 = $sqlObj2->FireSQL($sql2)){
	$_SESSION['message'] = self::$lang['siya']['importexport']['PARENTS_REGISTRATION_SAVED'];
	}
	}

}






public function saveStudentParentFromExcel($parameters = ''){
	print_r($_POST);die;
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']) && $_FILES['chosenfile']['name'] !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'];
	
	$foldername = PROJ_DATA_DIR._S.'importexport'._S;

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	
	}

	include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel'._S.'IOFactory.php');

	$objPHPExcel = PHPExcel_IOFactory::load($foldername._S.$finalfilename);

	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


	$users_table_colums =  array('usertypetag','entitytypetag','username','fname','mname','lname','gender','email','phone','addressline1','addressline2','city','state','country','nationality','dob');
	$users_password_colums =  array('password');
	$student_table_colums = array('registrationno','doa','emergencycontactname','emergencycontactnumber');
	$parent_table_colums = array('occupation','officeaddressline1','officeaddressline2','emergencycontactnumber','officecity','officestate','officecountry','officephone');

	foreach($sheetData as $key => $value){
		$data = array();
		$data2 = array();
	foreach($value as $key2 => $value2){
		if($_POST[$key2] == 'A'){
			
	  if(in_array($_POST[$key2],$users_table_colums)){
		$data[$_POST[$key2]] = $value2;
	  }

	  if(in_array($_POST[$key2],$users_password_colums)){
		if($value2 !=''){
		self::setUsersLoginDetails($value2);
		$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
		}
		$data[$_POST[$key2]] = $saltpassword;
	  }

	  if(in_array($_POST[$key2],$student_table_colums)){
		$data2[$_POST[$key2]] = $value2;
	  }
	}

	if($_POST[$key2] == 'V'){
			
	  if(in_array($_POST[$key2],$users_table_colums)){
		$data[$_POST[$key2]] = $value2;
	  }

	  if(in_array($_POST[$key2],$users_password_colums)){
		if($value2 !=''){
		self::setUsersLoginDetails($value2);
		$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
		}
		$data[$_POST[$key2]] = $saltpassword;
	  }

	  if(in_array($_POST[$key2],$parent_table_colums)){
		$data2[$_POST[$key2]] = $value2;
	  }
	}
	
	}

	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['isactive'] = 1;

	$sqlObj = new MainSQL();

	echo $sql = $sqlObj->SQLCreator('I', 'users', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
		$_SESSION['message'] = self::$lang['siya']['importexport']['REGISTRATION_VALUE_SAVED'];
		$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	}

	$data2['userid'] = $returnid;
	$sqlObj2 = new MainSQL();

	echo $sql2 = $sqlObj2->SQLCreator('I', 'students', $data2, '', '', '', '');

	if($result2 = $sqlObj2->FireSQL($sql2)){
	$_SESSION['message'] = self::$lang['siya']['importexport']['STUDENT_REGISTRATION_SAVED'];
	}
	}
}




public function saveStaffFromExcel($parameters = ''){
	//print_r($_POST);
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']) && $_FILES['chosenfile']['name'] !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'];
	
	$foldername = PROJ_DATA_DIR._S.'importexport'._S;

	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	
	// Image Upload Ends Here //
	
	}


	/** PHPExcel */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel.php');

	/** PHPExcel_Writer_Excel2007 */
	//include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel/Writer/Excel2007.php');

	/** PHPExcel_IOFactory */
	include(PROJ_3RDPARTY_DIR._S.'phpexcel'._S.'Classes'._S.'PHPExcel'._S.'IOFactory.php');

	$objPHPExcel = PHPExcel_IOFactory::load($foldername._S.$finalfilename);

	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


	$users_table_colums =  array('usertypetag','entitytypetag','username','fname','mname','lname','gender','email','phone','addressline1','addressline2','city','state','country','nationality','dob');
	$users_password_colums =  array('password');
	$student_table_colums = array('empid','doj','bloodgroup','emergencycontactname','emergencycontactnumber','qualifications');

	foreach($sheetData as $key => $value){
		$data = array();
		$data2 = array();
	foreach($value as $key2 => $value2){

	  if(in_array($_POST[$key2],$users_table_colums)){
		$data[$_POST[$key2]] = $value2;
	  }

	  if(in_array($_POST[$key2],$users_password_colums)){
		if($value2 !=''){
		self::setUsersLoginDetails($value2);
		$saltpassword = MainSystem::SystemPasswordReturn(self::$password);
		}
		$data[$_POST[$key2]] = $saltpassword;
	  }

	  if(in_array($_POST[$key2],$student_table_colums)){
		$data2[$_POST[$key2]] = $value2;
	  }
	}

	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['isactive'] = 1;

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('I', 'users', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
		$_SESSION['message'] = self::$lang['siya']['importexport']['REGISTRATION_VALUE_SAVED'];
		$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	}

	$data2['userid'] = $returnid;
	$sqlObj2 = new MainSQL();

	$sql2 = $sqlObj2->SQLCreator('I', 'staff', $data2, '', '', '', '');

	if($result2 = $sqlObj2->FireSQL($sql2)){
	$_SESSION['message'] = self::$lang['siya']['importexport']['STAFF_REGISTRATION_SAVED'];
	}
	}

}




public function importUsersFromExcel(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['importexport']['ADD_NEW_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function importStudentFromExcel(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['importexport']['ADD_STUDENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function importStaffFromExcel(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['importexport']['ADD_STAFF_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function importParentFromExcel(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['importexport']['ADD_PARENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function importStudentParentFromExcel(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['importexport']['ADD_STUDENTS_PARENT_REGISTRATION'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}



} // class importexport