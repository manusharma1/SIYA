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
class chat
{
private static $lang;

function SIYA__chat_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addNewChat'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showChat'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showChatUser'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showChatWindow'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showChatText'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showNewChatText'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['showInputChatText'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveChat'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['sendChatMessage'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveUserInChat'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');

$module_installer_info_array['action']['editChat'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteChat'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteChatConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['getNewChatUsersStatus'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['getNewChatText'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;


}

function SIYA__chat_INIT__(){

global $lang;

self::$lang = $lang;

}

public function addNewChat(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['ADD_CHAT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showChat($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['SHOW_CHAT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showChatUser($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['SHOW_CHAT_FRAME'] ;
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showChatWindow($parameters){
	
	self::saveUserInChat($parameters);

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['SHOW_CHAT_WINDOW'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showChatText($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['SHOW_CHAT_TEXT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function showNewChatText($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['SHOW_CHAT_TEXT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function showInputChatText($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['SHOW_INPUT_CHAT_TEXT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function saveChat($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$usersingroup = (isset($_POST['usersingroup']))?implode(',',$_POST['usersingroup']):'';

	$data = array();
	$data['groupid'] = $_POST['groupid'];
	$data['batchid'] = $_POST['batchid'];
	$data['topicid'] = $_POST['topicid'];
	$data['subjectid'] = $_POST['subjectid'];
	$data['userids'] = $usersingroup;
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'chat', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'chat', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['chat']['CHAT_SAVED'];
	
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('chat/editChat/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = self::$lang['siya']['chat']['CHAT_CANNOT_BE_SAVED'];
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewChat'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'addNewChat'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['CHAT_CANNOT_BE_SAVED'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

	}// function saveChat

	public function sendChatMessage(){
	
	$data = array();
	$data['toid'] = $_POST['chatid']; // Till the time we implement one to one chat
	$data['chatid'] = $_POST['chatid'];
	$data['fromid'] = $_POST['fromid'];
	$data['chattext'] = $_POST['chattextareahidden'];
	$data['datetime'] = date('Y-m-d H:i:s');
	$data['timestamp'] = strtotime('now');
	$data['ipaddress'] = '';
	$data['hostname'] = '';
	
	
	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('I', 'chattemprecords', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	//$_SESSION['message'] = self::$lang['siya']['chat']['CHAT_TEMP_RECORD_SAVED'];
	}else{
	//$_SESSION['message'] = self::$lang['siya']['chat']['CHAT_TEMP_RECORD_CANNOT_BE_SAVED'];
	}
	

	}// function sendChatMessage

	

	public function saveUserInChat($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$columns = array('id');
	$conditions = array();
	$conditions['=']['chatid'] = $id;
	$conditions['AND =']['userid'] = MainSystem::GetSessionUserID();
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'usersinchat', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) == 0){ 


	$data = array();
	$data['chatid'] = $id;
	$data['userid'] = MainSystem::GetSessionUserID();
	$data['chatlogintime'] = date('Y-m-d H:i:s');
	$data['chatlogouttime'] = 
	$data['status'] = 'ONLINE';
	$data['isonline'] = '1';
	$data['customisestatustext'] = '';
	
	$sql = $sqlObj->SQLCreator('I', 'usersinchat', $data, '', '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['chat']['USERS_IN_CHAT_SAVED'];		
	}else{
	$_SESSION['message'] = self::$lang['siya']['chat']['USERS_IN_CHAT_NOT_SAVED'];
	}
	
	}
	}

	}// function saveUserInChat



	public function editChat($parameters){

		if(isset($parameters[0])){
		$id = $parameters[0];
		}else{
		$id = '';
		}
		
		$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

		$actionviewresult = MainSystem::CallActionView($id);
		$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['EDIT_CHAT'];
		$functionreturnarray['main_content_placeholder'] = $actionviewresult;
		return $functionreturnarray;
		
	}

	public function deleteChat($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['chat']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteChatConfirmed($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'chat', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showSubject/'));
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}





function getNewChatUsersStatus($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$userid = MainSystem::GetSessionUserID();
	
	$data = array();
	$data['lastactivetime'] = date('Y-m-d H:i:s');
	
	$conditions = array();
	$conditions['=']['chatid'] = $id;
	$conditions['AND =']['userid'] = $userid;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'usersinchat', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	//$_SESSION['message'] = 'Users in Chat Saved';		
	}else{
	//$_SESSION['message'] = 'Users in Chat Not Saved';
	}


	$columns = array('id','description','name','groupid','batchid','subjectid','topicid','userids');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'chat', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$chatid = $sqlObj->getCleanData($resultset->id);
	$name = $sqlObj->getCleanData($resultset->name);	
	$description = $sqlObj->getCleanData($resultset->description);
	$groupid = $sqlObj->getCleanData($resultset->groupid);
	$batchid = $sqlObj->getCleanData($resultset->batchid);
	$subjectid = $sqlObj->getCleanData($resultset->subjectid);
	$topicid = $sqlObj->getCleanData($resultset->topicid);
	$userids = $sqlObj->getCleanData($resultset->userids);
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		

	$columns2 = array('u.id','u.fname','u.mname','u.lname','u.entitytypetag');
	$conditions = array();

	$tables2 = array();
	if($userids==''){
	$tables2['usersingroup'] = 'ug';
	}

	$tables2['users'] = 'u';

	if($userids==''){
	$conditions2['=']['ug.groupid'] = $groupid;
	$conditions2['AND =']['ug.batchid'] = $batchid;
	$conditions2['K AND =']['ug.userid'] = 'u.id';
	}else if($userids!=''){
	$conditions2['IN ARR']['u.id'] = explode(',',$userids);
	}

	$sql2 = $sqlObj->SQLCreatorJ('S', $tables2, $columns2, $conditions2, 'u.fname,u.mname,u.lname', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ 
	while($resultset2 = $sqlObj->FetchResult($result2)){
	$id_placeholder = $sqlObj->getCleanData($resultset2->id);
	$fname_placeholder = $sqlObj->getCleanData($resultset2->fname);
	$mname_placeholder = $sqlObj->getCleanData($resultset2->mname);	
	$lname_placeholder = $sqlObj->getCleanData($resultset2->lname);	
	$entitytypetag_placeholder = $sqlObj->getCleanData($resultset2->entitytypetag);

	$lastactivetime = '';
	$chatstatus = 'OFFLINE';

	$columns = array('id','status');
	$conditions = array();
	$conditions['=']['chatid'] = $id;
	$conditions['AND =']['userid'] = $id_placeholder;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'usersinchat', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$chatstatus = $sqlObj->getCleanData($resultset->status);
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}

	
	$columns3 = array('lastactivetime');
	$conditions3 = array();
	$conditions3['=']['userid'] = $id_placeholder;
	$conditions3['AND =']['chatid'] = $id;

	$sql3 = $sqlObj->SQLCreator('S', 'usersinchat', $columns3, $conditions3, '', '', '');

	if($result3 = $sqlObj->FireSQL($sql3)){
	if($sqlObj->getNumRows($result3) !=0){ // If Exists
	if($resultset3 = $sqlObj->FetchResult($result3)){
	$lastactivetime = $sqlObj->getCleanData($resultset3->lastactivetime);
	}
	}
	}

	$current_time = strtotime(date('Y-m-d H:i:s'));
	$last_time = strtotime($lastactivetime);
	$gap_time = round(abs($current_time - $last_time) / 60,2);
	
	$data4 = array();
	
	if($gap_time > 1){
	
	if($gap_time > 1 && $gap_time <= 2){
	$data4['status'] = 'IDLE';
	$chatclass = 'button orange small';
	}else if($gap_time > 2){
	$data4['status'] = 'OFFLINE';
	$data4['chatlogouttime'] = $lastactivetime;
	$chatclass = 'button small';
	}
	}else{
	$data4['status'] = 'ONLINE';
	$chatclass = 'button green small';
	}


	$conditions4 = array();
	$conditions4['=']['chatid'] = $id;
	$conditions4['AND =']['userid'] = $id_placeholder;

	$sqlObj = new MainSQL();
	
	$sql4 = $sqlObj->SQLCreator('U', 'usersinchat', $data4, $conditions4, '', '', '');

	if($result4 = $sqlObj->FireSQL($sql4)){
	}else{
	trigger_error('Data Save Error');
	}
	
	?>
	
	<br /><p class="<?php echo $chatclass; ?>"><?php echo $fname_placeholder.' '.$mname_placeholder.' '.$lname_placeholder.' '.$entitytypetag_placeholder?> <?php echo $chatstatus; ?></p><br />
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		


}



function getNewChatText2($id, $lastmodif){

	$columns = array('id','fromid','chattext','datetime');
	$conditions = array();
	$conditions['>']['timestamp'] =  $lastmodif;
	$conditions['AND =']['chatid'] =  $id;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'chattemprecords', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){

	$columns2 = array('fname','mname','lname');
	$conditions2 = array();
	$conditions2['=']['id'] =  $resultset->fromid;
	$sql2 = $sqlObj->SQLCreator('S', 'users', $columns2, $conditions2, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ 
	if($resultset2 = $sqlObj->FetchResult($result2)){
	}
	}
	}
	$name_placeholder = $sqlObj->getCleanData($resultset2->fname).' '.$sqlObj->getCleanData($resultset2->mname).' '.$sqlObj->getCleanData($resultset2->lname);
	$datetime_placeholder = $sqlObj->getCleanData($resultset->datetime);	
	$chattext_placeholder = $sqlObj->getCleanData($resultset->chattext);	
	$finalchattext[]  = '<p><img src="'.MainSystem::URLCreator('users/showUserImageByID/'.$resultset->fromid.',1/').'" width="50px" height="50px" />'.$name_placeholder.'-'.$datetime_placeholder.':'.$chattext_placeholder.'</p>';

	list($date, $time) = explode(' ', $sqlObj->getCleanData($resultset->datetime));
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp1 = mktime($hour, $minute, $second, $month, $day, $year);
	


	}
	}
	}

	$returnarray['message'] = implode("",$finalchattext);
	$returnarray['timestamp'] = $timestamp1;

	return $returnarray;


}


function getNewChatText($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}



// infinite loop until the data file is not modified
$lastmodif    = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;

$returndata = self::getNewChatText2($id, $lastmodif);
$currentmodif = $returndata['timestamp'];


if($currentmodif <= $lastmodif) // check if the data file has been modified
{
usleep(10000); // sleep 10ms to unload the CPU
clearstatcache();
$returndata = self::getNewChatText2($id, $lastmodif);
$currentmodif = $returndata['timestamp'];
}


$response = array();
$response['msg']       = $returndata['message'];
$response['timestamp'] = $returndata['timestamp'];
echo json_encode($response);
flush();
die;

}

} // class chat