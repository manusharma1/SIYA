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
class blocksadministration
{

private static $lang;

function SIYA__blockadministration_INIT__(){

global $lang;

self::$lang = $lang;

}

function SIYA__blocksadministration_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewBlock'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveBlock'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageBlocks'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editBlocks'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['changeBlockStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteBlock'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteBlockConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['moveBlocks'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['blocksMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;

}


public function addNewBlock(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['blockadministration']['ADD_NEW_BLOCK'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveBlock($parameters){


	$userstypetagstr = '';

	$usertypetagingroup = (isset($_POST['usertypetagingroup']))?$_POST['usertypetagingroup']:array();

	foreach($usertypetagingroup as $userstypetag){
	$userstypetagstr .= $userstypetag.',';
	}
	
	$userstypetagstr = substr($userstypetagstr,0,-1);



	$entitytypetagstr = '';

	$entitytypetagingroup = (isset($_POST['entitytypetagingroup']))?$_POST['entitytypetagingroup']:array();

	foreach($entitytypetagingroup as $entitytypetag){
	$entitytypetagstr .= $entitytypetag.',';
	}
	
	$entitytypetagstr = substr($entitytypetagstr,0,-1);

	
	$grouptypetagstr = '';

	$grouptypetagingroup = (isset($_POST['grouptypetagingroup']))?$_POST['grouptypetagingroup']:array();

	foreach($grouptypetagingroup as $grouptypetag){
	$grouptypetagstr .= $grouptypetag.',';
	}
	
	$grouptypetagstr = substr($grouptypetagstr,0,-1);
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$data = array();
	
	$data['block'] = $_POST['block'];
	$data['blockaction'] = $_POST['blockaction'];
	$data['blocktitle'] = $_POST['blocktitle'];
	$data['blockposition'] = $_POST['blockposition'];
	$data['blockdisplay'] = $_POST['blockdisplay'];
	$data['blockdirection'] = $_POST['blockdirection'];
	$data['issticky'] = $_POST['issticky'];
	
	if($id == ''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}
	
	$data['isactive'] = 1;

	$sqlObj = new MainSQL();


	// MAXIMUM ORDERID //
	$columns_orderid = array('MAX(`orderid`)=maxorderid');

	$conditions_orderid = array();
	$conditions_orderid['=']['blockposition'] = $_POST['blockposition'];

	$sql_orderid= $sqlObj->SQLCreator('SF', 'blocksinstances', $columns_orderid, $conditions_orderid, '', '', '');


	if($result_orderid = $sqlObj->FireSQL($sql_orderid)){
	if($sqlObj->getNumRows($result_orderid) !=0){
	if($resultset_orderid = $sqlObj->FetchResult($result_orderid)){
	
	$data['orderid'] = $resultset_orderid->maxorderid+1;
	
	}
	}
	}

	// MAXIMUM ORDERID //


	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;


	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'blocksinstances', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'blocksinstances', $data, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['blockadministration']['BLOCK_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	

	$data2 = array();
	
	$data2['blocksinstancesid'] = $returnid;
	$data2['type'] = $_POST['type'];
	$data2['userids'] = $_POST['userids'];
	$data2['actionview'] = $_POST['actionview'];
	$data2['entitytypetag'] = $entitytypetagstr;
	$data2['usertypetag'] = $userstypetagstr;
	$data2['grouptypetag'] = $grouptypetagstr;
	
	if($id == ''){
	$data2['added'] = date('Y-m-d H:i:s');
	$data2['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data2['modified'] = date('Y-m-d H:i:s');
	$data2['modifiedby'] = MainSystem::GetSessionUserID();
	}
	
	$data2['isactive'] = 1;

	// Conditions in case of Edit //
	$conditions2 = array();
	$conditions2['=']['blocksinstancesid'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'blocksinstancessettings', $data2, '', '', '', ''):$sqlObj->SQLCreator('U', 'blocksinstancessettings', $data2, $conditions2, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['blockadministration']['BLOCKS_INSTANCES_SETTINGS_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/editBlocks/'.$returnid.'/'));
	}
	}else{
	$_SESSION['message'] = self::$lang['siya']['blockadministration']['BLOCKS_INSTANCES_SETTINGS_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewBlock'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewBlock'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = 'ERROR : Blocksinstancessettings cannot be Saved';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	
	}


	public function manageBlocks($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['blockadministration']['MANAGE_BLOCKS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

	
	public function moveBlocks($parameters){
	
	if(isset($parameters[0])){
	$blockposition = $parameters[0];
	}else{
	$blockposition = '';
	}

	if(isset($parameters[1])){
	$id = $parameters[1];
	}else{
	$id = '';
	}
	
	if($blockposition == 'up' || $blockposition == 'down'){
	
	$columns = array('orderid','blockposition');

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'blocksinstances', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$changedorderid = ($blockposition == 'up')?	$resultset->orderid-1:$resultset->orderid+1;
	}
	}
	}
	$data = array();
	$data['orderid'] = ($blockposition == 'up')?$resultset->orderid+1:$resultset->orderid-1;
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['orderid'] = ($blockposition == 'up')?$resultset->orderid-1:$resultset->orderid+1;
	$conditions['AND =']['blockposition'] = $resultset->blockposition;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'blocksinstances', $data, $conditions, '', '', '');

	}

	$data = array();
	
	if($blockposition == 'up' || $blockposition == 'down'){
	$data2['orderid'] = $changedorderid;
	$data2['blockposition'] = $resultset->blockposition;
	}else{
	$data2['blockposition'] = $blockposition;
	}
	$data2['modified'] = date('Y-m-d H:i:s');
	$data2['modifiedby'] = MainSystem::GetSessionUserID();


	// Conditions in case of Edit //
	$conditions2 = array();
	$conditions2['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql2 = $sqlObj->SQLCreator('U', 'blocksinstances', $data2, $conditions2, '', '', '');
	
	
	if($result2 = $sqlObj->FireSQL($sql2)){
	$_SESSION['message'] = self::$lang['siya']['blockadministration']['BLOCK_SAVED'];
	}
	else{
	$_SESSION['message'] = self::$lang['siya']['blockadministration']['BLOCK_NOT_SAVED'];
	}
	
	}

	public function editBlocks($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); //array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['blockadministration']['EDIT_BLOCKS'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function changeBlockStatus($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	
	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'blocksinstances', $columns, $conditions, '', '', '');
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
	
	$sql = $sqlObj->SQLCreator('U', 'blocksinstances', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['blockadministration']['BLOCK_INSTANCES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));
	}
	}
	}
	}
	}
	

	public function deleteBlock($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['blockadministration']['DELETE_A_BLOCK'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteBlockConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'blocksinstances', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}
//blocksMultipleManage
public function blocksMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'blocksinstances', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['groups']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['blocksadministration']['BLOCK_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'blocksinstances', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['blocksadministration']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['blocksadministration']['BLOCK_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'blocksinstances', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['blocksadministration']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['blocksadministration']['BLOCK_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('blocksadministration/manageBlocks/'));

	}
	

}


} // class Blocks