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
class fileuploader
{

public function uploadNewFile(){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Add New File';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}


public function saveFile($parameters = ''){

	//$id = $parameters[0];
	$data = array();
	$filelocationid = $_POST['filelocationid'];
	$data['filelocationid'] = $filelocationid;

	$data['filedescription'] = $_POST['filedescription'];
	//if($id==''/){
	$data['addeddate'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	//}else{
	//$data['modifieddate'] = date('Y-m-d H:i:s');
	//$data['modifiedby'] = MainSystem::GetSessionUserID();
	//}

	$data['isactive'] = 1;

	// Conditions in case of Edit //
	//$conditions = array();
	//$conditions['=']['id'] = $id;


	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']) && $_FILES['chosenfile']['name'] !=''){
	$originalfilename = 'chosenfile';
	$extension = explode('.',$_FILES['chosenfile']['name']);
	$ext_type = strtolower(end($extension));
	
	$filename = str_replace(' ', '_', $_POST['filename']);

	$finalfilename = $filename.'_'.$filelocationid.'____'.date('Y_m_d_H_i_s').'.'.$ext_type;
	//productimage_{productid}____{datetime} //

	switch($filelocationid){
	case 1:
	$foldername = 'imageslider';
	break;

	case 2:
	$foldername = 'pictures';
	break;
	
	case 3:
	$foldername = 'videos';
	break;
	
	case 4:
	$foldername = 'website';
	break;
	}
	$uploadmessage = MainSystem::FileUploader($originalfilename,PROJ_DATA_DIR._S.$foldername,$finalfilename);
	$_SESSION['message'] .= '<br />'.$uploadmessage;
	// Image Upload Start Here //
	
	$data['filename'] = $finalfilename;

	$sqlObj = new MainSQL();
	
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'fileupload', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'fileupload', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] .= 'File Saved';
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	
	MainSystem::URLForwarder(MainSystem::URLCreator('fileuploader/manageFiles/'));
	}else{
	$_SESSION['message'] .= 'File cannot be Saved';
	MainSystem::URLForwarder(MainSystem::URLCreator('fileuploader/addNewFile/'));
	}

	}

}


public function manageFiles(){	
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = 'Manage Files';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function deleteFile($parameters){

	$id = $parameters[0];

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = 'Delete a File';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteFileConfirmed($parameters){

	$id = $parameters[0];

	if(isset($_SESSION['deleteconfirmed']) && $_SESSION['deleteconfirmed'] == $id){
	$path = $_POST['path'];
	$filename = $_POST['filename'];
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('D', 'fileupload', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	MainSystem::FileDelete($path,$filename);
	unset($_SESSION['deleteconfirmed']);
	MainSystem::URLForwarder(MainSystem::URLCreator('fileuploader/manageFiles/'));
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
	}
}



} // class fileuploader