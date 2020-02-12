<?php
class cms
{
private static $lang;

function SIYA__cms_INIT__(){

global $lang;

self::$lang = $lang;

}

function SIYA__cms_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => 'CMS is the Content Management System, This module help to create Dynamic Pages');

$module_installer_info_array['action']['getContent'] = array('usertypeaccess'=>'*', 'templateaccess'=>'*', 'description' => 'This will fetch Content from the Content Table');
$module_installer_info_array['action']['errorPage'] = array('usertypeaccess'=>'*', 'templateaccess'=>'*', 'description' => 'Show Errors');
$module_installer_info_array['action']['addNewPage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Add New Page');
$module_installer_info_array['action']['managePages'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Manage Pages');
$module_installer_info_array['action']['addNewMenu'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Add New Menu');
$module_installer_info_array['action']['manageMenus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Manage Menus');
$module_installer_info_array['action']['savePage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Save Page');
$module_installer_info_array['action']['saveMenu'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Save Menu');
$module_installer_info_array['action']['editPage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Edit Page');
$module_installer_info_array['action']['editMenu'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Edit Menu');
$module_installer_info_array['action']['deletePage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Delete Page');
$module_installer_info_array['action']['deleteMenu'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Delete Menu');
$module_installer_info_array['action']['deletePageConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Delete Page Confirmed');
$module_installer_info_array['action']['deleteMenuConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Delete Menu Confirmed');

$module_installer_info_array['action']['pagesMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Multiple Pages Manage');
$module_installer_info_array['action']['changePageStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Change Page Status');
$module_installer_info_array['action']['menusMultipleManage'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Multiple Menus Manage');
$module_installer_info_array['action']['changeMenuStatus'] = array('usertypeaccess'=>'#admin,#subadmin', 'templateaccess'=>'admin', 'description' => 'Change Menu Status');


return $module_installer_info_array;

}

public function getContent($parameters){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}


	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$columns = array('title','metadesc','metakeys','data','data2','datamore','data2more','menuid');
	
	$conditions = array();
	$conditions['=']['id'] = $id;
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	$result = $sqlObj->FireSQL($sql);
	if($resultset = $sqlObj->FetchResult($result)){
	if(!empty($resultset)){
	$functionreturnarray['title_placeholder'] = $sqlObj->getCleanData($resultset->title);
	$functionreturnarray['meta_description_placeholder'] = $sqlObj->getCleanData($resultset->metadesc);
	$functionreturnarray['meta_keywords_placeholder'] = $sqlObj->getCleanData($resultset->metakeys);	
	$functionreturnarray['main_content_placeholder'] = $sqlObj->getCleanData($resultset->data);
	$functionreturnarray['main_content2_placeholder'] = $sqlObj->getCleanData($resultset->data2);

	if($sqlObj->getCleanData($resultset->datamore) != ''){
	$functionreturnarray['main_contentmore_placeholder'] = $sqlObj->getCleanData($resultset->datamore);
	$functionreturnarray['main_contentmore_url_placeholder'] = MainSystem::URLCreator('cms/getContent/'.$id.',m1/');
	$functionreturnarray['main_contentmore_back_url_placeholder'] = MainSystem::URLCreator('cms/getContent/'.$id.'/');
	}

	if($sqlObj->getCleanData($resultset->data2more) != ''){
	$functionreturnarray['main_content2more_placeholder'] = $sqlObj->getCleanData($resultset->data2more);
	$functionreturnarray['main_content2more_url_placeholder'] = MainSystem::URLCreator('cms/getContent/'.$id.',m2/');
	$functionreturnarray['main_content2more_back_url_placeholder'] = MainSystem::URLCreator('cms/getContent/'.$id.'/');	
	}
	$functionreturnarray['menuid'] = $sqlObj->getCleanData($resultset->menuid);
	
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
	

public function errorPage($parameters){

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	// 1 = Action Not Found // 2 = Content not Found

	if($id == '1'){
	$title_placeholder_txt = 'Action Not Found';
	$main_content_placeholder_txt = 'We are Sorry, But the Action that you are looking could not be found';
	}else if($id == '2'){
	$title_placeholder_txt = 'Content Not Found';
	$main_content_placeholder_txt = 'We are Sorry, But the Content that you are looking could not be found';
	}
	
	$functionreturnarray['title_placeholder'] = $title_placeholder_txt;
	$functionreturnarray['main_content_placeholder'] = $main_content_placeholder_txt;
	return $functionreturnarray;
	
	}


public function addNewPage(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['ADD_NEW_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}


public function managePages($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['MANAGE_PAGES'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}


public function manageMenus($parameters){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['MANAGE_MENUS'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

public function addNewMenu(){

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['ADD_NEW_MENU'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

public function savePage($parameters){

	$id = $parameters[0];
	$data = array();
	$data['id'] = $id;
	$data['pid'] = $_POST['pid'];
	$data['menuid'] = $_POST['menuid'];
	$data['name'] = $_POST['name'];
	$data['title'] = $_POST['title'];
	$data['data'] = $_POST['data'];
	$data['data2'] = $_POST['data2'];
	$data['datamore'] = $_POST['datamore'];
	$data['data2more'] = $_POST['data2more'];
	$data['metakeys'] = $_POST['metakeys'];
	$data['metadesc'] = $_POST['metadesc'];
	if($id==''){
	$data['addeddate'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modifieddate'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}


	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'content', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'content', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['cms']['PAGE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/editPage/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['PAGE_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/addNewPage/'));
	}
	

}

public function saveMenu($parameters){

	$id = $parameters[0];
	$data = array();
	$data['id'] = $id;
	$data['pid'] = $_POST['pid'];
	$data['name'] = $_POST['name'];
	$data['addeddate'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	$data['isactive'] = 1;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'menu', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'menu', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['cms']['MENU_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/editMenu/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['MENU_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/addNewMenu/'));
	}
	

}

public function editPage($parameters){	

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['EDIT_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editMenu($parameters){	

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['EDIT_MENU'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function deletePage($parameters){

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['DELETE_A_PAGE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteMenu($parameters){
	
	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['cms']['DELETE_A_MENU'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}

public function deletePageConfirmed($parameters){

	$id = $parameters[0];

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'content', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}


public function deleteMenuConfirmed($parameters){

	$id = $parameters[0];

	$conditions = array();
	$conditions['=']['id'] = $id;
	$conditions['OR =']['pid'] = $id;
	
	// We need to make menuid = 0 in content
	$data = array();
	$data['menuid'] = 0;
	// Conditions in case of Edit //
	$conditions2 = array();
	$conditions2['=']['menuid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'menu', '', $conditions, '', '', '');
	$sql2 = $sqlObj->SQLCreator('U', 'content', $data, $conditions2, '', '', '');

	if($result = $sqlObj->FireSQL($sql) && $result2 = $sqlObj->FireSQL($sql2)){ // Consider Revising the code //
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/')); // Change the Error Code //
	}
}




public function pagesMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'content', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['cms']['PAGES_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'content', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['cms']['PAGES_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'content', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['cms']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));

	}
	

}

public function changePageStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'content', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['cms']['PAGE_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));
	}
	}
	}
	}

}





public function menusMultipleManage(){

	if(isset($_POST['IsSubmit']) && isset($_POST['Delete'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'menu', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));
	}
	}

	$_SESSION['message'] = self::$lang['siya']['cms']['MENUS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Inactive'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '0';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'menu', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['cms']['MENUS_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));

	}else if(isset($_POST['IsSubmit']) && isset($_POST['Active'])){
	
	foreach($_POST['checkbox'] as $id => $value){

	$data = array();
	$data['isactive'] = '1';

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'menu', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	}else{
	$_SESSION['message'] = self::$lang['siya']['cms']['SQL_ERROR'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));
	}
	
	}

	$_SESSION['message'] = self::$lang['siya']['cms']['MENU_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));

	}
	

}

public function changeMenuStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'menu', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'menu', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['cms']['MENU_STATUS_CHANGED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));
	}
	}
	}
	}

}


} // class cms
?>