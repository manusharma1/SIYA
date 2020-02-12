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
class payments
{

private static $lang;

function SIYA__payments_INIT__(){

global $lang;

self::$lang = $lang;

}

function SIYA__payments_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addPayment'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['addPaymentType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showPayment'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['savePayment'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['savePaymentType'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['managePaymentTypes'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editPaymentTypes'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changePaymentTypeStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['managePayments'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editPayments'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changePaymentStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deletePayments'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deletePaymentConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deletePaymentTypes'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deletePaymentTypeConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['paymentTypesMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['paymentsMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}

public function addPayment(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ADD_PAYMENT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function addPaymentType(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ADD_PAYMENT_TYPE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function showPayment($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['SHOW_PAYMENT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function savePayment($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();

	$data['userid'] = $_POST['userid'];
	$data['paymenttypeid'] = $_POST['paymenttypeid'];
	$data['title'] = $_POST['title'];
	$data['description'] = $_POST['description'];

	$data['paymentdate'] = $_POST['paymentdate'];
	$data['paymentvalue'] = $_POST['paymentvalue'];
	$data['paymentmode'] = $_POST['paymentmode'];
	$data['checkddnumber'] = $_POST['checkddnumber'];
	$data['bankdetails'] = $_POST['bankdetails'];
	$data['carddetails'] = $_POST['carddetails'];
	$data['discount'] = $_POST['discount'];
	$data['tax'] = $_POST['tax'];	

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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'payments', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'payments', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['payments']['PAYMENT_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('payment/editPayments/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['payments']['PAYMENT_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addPayment'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addPayment'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ERROR_:_PAYMENT_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function savePayment




	public function savePaymentType($parameters){
	
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'paymenttypes', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'paymenttypes', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['payments']['PAYMENT_TYPE_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/editPaymentTypes/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['payments']['PAYMENT_TYPE_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addPaymentType'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addPaymentType'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['ERROR_:_PAYMENT_TYPE_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function savePaymentType


	


	public function managePaymentTypes($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['MANAGE_PAYMENT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editPaymentTypes($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['EDIT_PAYMENTS'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changePaymentTypeStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'paymenttypes', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'paymenttypes', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['payments']['PAYMENT_TYPES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));
	}
	}
	}
	}

}



	public function managePayments($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['MANAGE_PAYMENT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	public function editPayments($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['EDIT_PAYMENTS'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changePaymentStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'payments', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'payments', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['payments']['PAYMENT_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));
	}
	}
	}
	}

}


public function deletePayments($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deletePaymentConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'payments', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function deletePaymentTypes($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['payments']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deletePaymentTypeConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'paymenttypes', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}

public function paymentsMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'payments', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['payments']['GROUP_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'payments', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['groups']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'payments', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['groups']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePayments/'));

	}
	

}
//paymentTypesMultipleManage
public function paymentTypesMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'paymenttypes', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['payments']['GROUP_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'paymenttypes', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['groups']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'paymenttypes', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['groups']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('payments/managePaymentTypes/'));

	}
	

}
	
} // class payments