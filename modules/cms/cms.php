<?php
class cms
{

public function getContent($parameters){
	
	$id = $parameters[0];

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
	$functionreturnarray['main_contentmore_placeholder'] = $sqlObj->getCleanData($resultset->datamore);
	$functionreturnarray['main_content2more_placeholder'] = $sqlObj->getCleanData($resultset->data2more);
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
	$functionreturnarray['title_placeholder'] = 'Add New Page';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}


public function managePages(){

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Manage Pages';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}


public function manageMenus(){

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Manage Menus';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

public function addNewMenu(){

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Add New Menu';
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
	$_SESSION['message'] = 'Page Saved';
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/editPage/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = 'Page cannot be Saved';
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
	$_SESSION['message'] = 'Menu Saved';
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/editMenu/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = 'Menu cannot be Saved';
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/addNewMenu/'));
	}
	

}

public function editPage($parameters){	

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Edit Page';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function editMenu($parameters){	

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Edit Menu';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function deletePage($parameters){

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Delete a Page';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteMenu($parameters){
	
	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Delete a Menu';
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

} // class cms
?>