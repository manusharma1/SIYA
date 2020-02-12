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
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////
class news
{

public function addNewNews(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Add New News';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function saveNews($parameters){

	$id = $parameters[0];

	$data = array();
	$data['id'] = $id;
	$data['newstitle'] = $_POST['newstitle'];
	$data['newstext'] = $_POST['newstext'];
	$datearray = explode('/', $_POST['newsdate']);
	$data['newsdate'] = $datearray[2].'-'.$datearray[0].'-'.$datearray[1];
	if($id == ''){
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
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'news', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'news', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'News Saved';
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('news/editNews/'.$returnid.'/'));
	}else{
	$_SESSION['message'] = 'News cannot be Saved';
	MainSystem::URLForwarder(MainSystem::URLCreator('news/addNewNews/'));
	}
	

}


public function editNews($parameters){	
	
	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Edit News';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}



public function manageNews(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Manage News';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}

public function changeNewsStatus($parameters){

	$id = $parameters[0];

	$columns = array('isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'news', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ // If News Exists
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$change_news_status = ($resultsetnewscontents->isactive==0)?1:0;
	
	$data = array();
	$data['isactive'] = $change_news_status;

	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'news', $data, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'News Status Changed';
	MainSystem::URLForwarder(MainSystem::URLCreator('news/manageNews/'));
	}
	}
	}
	}

}

} // class news