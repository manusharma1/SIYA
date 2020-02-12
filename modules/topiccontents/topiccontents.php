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
class topiccontents
{

private static $lang;


function SIYA__topiccontents_INSTALLER__(){

$module_installer_info_array = array();

$module_installer_info_array['module']['info'] = array('description' => '');

$module_installer_info_array['action']['addTopicContent'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['editTopicContent'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['saveTopicContent'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['downloadTopicContentFile'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['openTopicContentHTML'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['openTopicContentDoc'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['openTopicContentVideo'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['manageFiles'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['deleteFileConfirmed'] = array('usertypeaccess'=>'#admin,#subadmin,#teacher', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['returnApplicationIcons'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['returnApplicationType'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['openTopicContentFile'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');
$module_installer_info_array['action']['downloadTopicContentFile'] = array('usertypeaccess'=>'*', 'templateaccess'=>'admin', 'description' => '');

return $module_installer_info_array;
}


function SIYA__topiccontents_INIT__(){

global $lang;

self::$lang = $lang;

}


public function addTopicContent($parameters){
	
	

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['topiccontents']['ADD_TOPIC_CONTENT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}

//editTopicContent
public function editTopicContent($parameters = ''){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($id);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['topiccontents']['ADD_TOPIC_CONTENT'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
	}


public function saveTopicContent($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	
	$data = array();
	
	$data['title'] = $_POST['title'];
	$data['description'] = $_POST['description'];
	$topicid = $data['topicid'] = $_POST['topicid'];
	$data['contenttype'] = $_POST['contenttype'];
	

	if($_POST['contenttype'] == 'HTML' || $_POST['contenttype'] == 'LINK'){
	$data['data'] = $_POST['data'];
	}

	if($id==''){
	$data['added'] = date('Y-m-d H:i:s');
	$data['addedby'] = MainSystem::GetSessionUserID();
	}else{
	$data['modified'] = date('Y-m-d H:i:s');
	$data['modifiedby'] = MainSystem::GetSessionUserID();
	}

	$data['isactive'] = 1;

	//Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $id;


	// Image Upload Start Here //
	if(isset($_FILES['chosenfile']) && $_FILES['chosenfile']['name'] !=''){
	$originalfilename = 'chosenfile';

	$finalfilename = $_FILES['chosenfile']['name'];
	
	$foldername = '';

	$columns = array('s.batchid','s.groupid','s.semesterid','s.id = subjectid','c.id = chapterid');
	$conditions = array();

	$tables = array();
	$tables['subjects'] = 's';
	$tables['chapters'] = 'c';
	$tables['topics'] = 't';

	$conditions['=']['t.id'] = $topicid;
	$conditions['K AND =']['c.id'] = 't.chapterid';
	$conditions['K AND =']['s.id'] = 'c.subjectid';

	
	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){

	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid);
	}

	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid);
	}
	
	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid);
	}


	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid);
	}


	if(is_dir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$topicid)){
	}else{
	mkdir(PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$topicid);
	}

	$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$topicid;

	}
	}
	}


	$uploadmessage = MainSystem::FileUploader($originalfilename,$foldername,$finalfilename);
	$_SESSION['message'] .= '<br />'.$uploadmessage;

	
	// Image Upload Ends Here //
	
	$data['filename'] = $finalfilename;
	
	}

	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();
	if($_POST['contenttype'] == 'HTML' || $_POST['contenttype'] == 'LINK'){
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'topiccontentsdata', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'topiccontentsdata', $data, $conditions, '', '', '');
	}else{
	$sql = ($id=='')?$sqlObj->SQLCreator('I', 'topiccontentsuploads', $data, '', '', '', ''):$sqlObj->SQLCreator('U', 'topiccontentsuploads', $data, $conditions, '', '', '');
	}

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] .= self::$lang['siya']['topiccontents']['FILE_SAVED'];
	$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showTopic/'.$topicid.'/'));
	}else{
	$_SESSION['message'] .= self::$lang['siya']['topiccontents']['FILE_CANNOT_BE_SAVED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showTopic/'.$topicid.'/'));
	}




}

public function manageFiles(){	
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView();
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['topiccontents']['MANAGE_FILES'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;
	
}


public function deleteTopicContent($parameters){
	
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders

	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['topiccontents']['DELETE_A_FILE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	
	return $functionreturnarray;

}

//deleteTopicContentConfirmed
public function deleteTopicContentConfirmed($parameters){
	

	if(isset($parameters[0])){
	$topicid = $parameters[0];
	}else{
	$topicid='';
	}
	
	$id = $_SESSION['deleteconfirmed'];


	$filename = '';
	$foldername = '';

	$columns = array('s.batchid','s.groupid','s.semesterid','s.id = subjectid','c.id = chapterid','tu.filename');
	$conditions = array();
	
	$tables = array();
	$tables['subjects'] = 's';
	$tables['chapters'] = 'c';
	$tables['topics'] = 't';
	$tables['topiccontentsuploads'] = 'tu';
	$conditions['=']['tu.id'] = $id;
	$conditions['K AND =']['t.id'] = $topicid;
	$conditions['K AND =']['c.id'] = 't.chapterid';
	$conditions['K AND =']['s.id'] = 'c.subjectid';

	$sqlObj = new MainSQL();
	$sqlfilecontents = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
	if($resultfilecontents = $sqlObj->FireSQL($sqlfilecontents)){
	if($sqlObj->getNumRows($resultfilecontents) !=0){ // If file Exists
	if($resultsetfilecontents = $sqlObj->FetchResult($resultfilecontents)){
	$filename = $sqlObj->getCleanData($resultsetfilecontents->filename);	
	$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultsetfilecontents->batchid._S.'Group_'.$resultsetfilecontents->groupid._S.'Semester_'.$resultsetfilecontents->semesterid._S.'Subject_'.$resultsetfilecontents->subjectid._S.'Chapter_'.$resultsetfilecontents->chapterid._S.'Topic_'.$topicid; 
	 
	MainSystem::FileDelete($foldername,$filename); 
	
	
	$_SESSION['message'] .= self::$lang['siya']['topiccontents']['TOPIC_CONTENTS_DELETED'];
	
	}
	}
	}
	else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorfile/2/')); // Content Not Found error
	}



	$conditions = array();
	$conditions['=']['id'] = $id;
	$sql = $sqlObj->SQLCreator('D', 'topiccontentsuploads', '', $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = self::$lang['siya']['topiccontents']['TOPIC_CONTENTS_DELETED'];
	MainSystem::URLForwarder(MainSystem::URLCreator('stage/showTopic/'.$topicid.'/'));

	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorfile/2/')); // Content Not Found error
	}

	}


public function openTopicContentVideo($parameters){
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['topiccontents']['OPEN_VIDEO_FILE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}

public function openTopicContentDoc($parameters){
	

	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['topiccontents']['OPEN_DOC_FILE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function openTopicContentHTML($parameters){
	
	
	$functionreturnarray = array(); // array that will return to the controller, having all the required data of the placeholders
	
	$actionviewresult = MainSystem::CallActionView($parameters);
	$functionreturnarray['title_placeholder'] = self::$lang['siya']['topiccontents']['OPEN_VIDEO_FILE'];
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;
	return $functionreturnarray;

}


public function deleteFileConfirmed($parameters = ''){
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}

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


static function returnApplicationIcons($filename) {

        $mime_types = array(

            'txt' => 'file_extension_txt.png',
            'htm' => 'file_extension_html.png',
            'html' => 'file_extension_html.png',
            'php' => 'file_extension_php.png',
            'css' => 'file_extension_css.png',
            'js' => 'file_extension_js.png',
            'json' => 'file_extension_json.png',
            'xml' => 'file_extension_xml.png',
            'swf' => 'file_extension_swf.png',
            'flv' => 'file_extension_flv.png',

            // images
            'png' => 'file_extension_png.png',
            'jpe' => 'file_extension_jpeg.png',
            'jpeg' => 'file_extension_jpeg.png',
            'jpg' => 'file_extension_jpeg.png',
            'gif' => 'file_extension_gif.png',
            'bmp' => 'file_extension_bmp.png',
            'ico' => 'file_extension_ico.png',
            'tiff' => 'file_extension_tiff.png',
            'tif' => 'file_extension_tif.png',
            'svg' => 'file_extension_svg.png',
            'svgz' => 'file_extension_svgz.png',

            // archives
            'zip' => 'file_extension_zip.png',
            'rar' => 'file_extension_rar.png',
            'exe' => 'file_extension_exe.png',
            'msi' => 'file_extension_msi.png',
            'cab' => 'file_extension_cab.png',

            // audio/video
            'mp3' => 'file_extension_mp3.png',
            'qt' => 'file_extension_qt.png',
            'mov' => 'file_extension_mov.png',

            // adobe
            'pdf' => 'file_extension_pdf.png',
            'psd' => 'file_extension_psd.png',
            'ai' => 'file_extension_ai.png',
            'eps' => 'file_extension_eps.png',
            'ps' => 'file_extension_ps.png',

            // ms office
            'doc' => 'file_extension_doc.png',
            'rtf' => 'file_extension_rtf.png',
            'xls' => 'file_extension_xls.png',
            'ppt' => 'file_extension_ppt.png',
			'docx' => 'file_extension_doc.png',
            'xlsx' => 'file_extension_xls.png',
            'pptx' => 'file_extension_ppt.png',

            // open office
            'odt' => 'file_extension_odt.png',
            'ods' => 'file_extension_ods.png',
        );

			$extension = explode(".",$filename);
			$ext_type = strtolower(end($extension));

			if(isset($mime_types[$ext_type])){
            $icon = $mime_types[$ext_type];
			}
			else{
			$icon = '';
			}
      		return $icon;


		}



static function returnApplicationType($filename) {

			$extension = explode(".",$filename);
			$ext_type = strtolower(end($extension));

      		return $ext_type;


		}

static function openTopicContentFile($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}



	$columns = array('s.batchid','s.groupid','s.semesterid','s.id = subjectid','tcu.title','tcu.description','tcu.filename','tcu.topicid','t.chapterid');
	$conditions = array();

	$tables = array();
	$tables['subjects'] = 's';
	$tables['topics'] = 't';
	$tables['chapters'] = 'c';
	$tables['topiccontentsuploads'] = 'tcu';

	$conditions['=']['tcu.id'] = $id;
	$conditions['K AND =']['tcu.topicid'] = 't.id';
	$conditions['K AND =']['c.id'] = 't.chapterid';
	$conditions['K AND =']['s.id'] = 'c.subjectid';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	//print_r($resultset);
	$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid;
	$filename = $resultset->filename;
	}
	}
	}


		/*if (file_exists($foldername._S.$filename)) {
		//header('Content-Description: File Transfer');
		header('Content-Type: MainSystem::returnMIMEType($filename)');
		//header('Content-Disposition: attachment; filename='.basename($foldername._WS.$filename));
		//header('Content-Transfer-Encoding: binary');
		//header('Expires: 0');
		//header('Cache-Control: must-revalidate');
		//header('Pragma: public');
		$contents = file_get_contents($foldername._S.$filename);
		echo $contents;
		exit;
		}
		



		$file = @fopen($foldername._S.$filename, 'rb');
        $speed = (isset($speed) === true) ? round($speed * 1024) : 524288;

        if (is_resource($file) === true)
        {
            set_time_limit(0);
            ignore_user_abort(false);

            while (ob_get_level() > 0)
            {
                ob_end_clean();
            }

            header('Expires: 0');
            header('Pragma: public');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Cache-Control: must-revalidate');
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . sprintf('%u', filesize($foldername._S.$filename)));
            header('Content-Disposition: attachment; filename="' . basename($foldername._S.$filename) . '"');
            header('Content-Transfer-Encoding: binary');

            while (feof($file) !== true)
            {
                echo fread($file, $speed);

                while (ob_get_level() > 0)
                {
                    ob_end_flush();
                }

                flush();
                sleep(1);
            }

            fclose($file);
        }

        exit();*/
    

        
	   

if (file_exists($foldername._S.$filename)) {

header('Content-Type:'.MainSystem::returnMIMEType($filename));
header("Content-length: ". filesize($foldername._S.$filename));
readfile($foldername._S.$filename);
exit;


}


}	



static function downloadTopicContentFile($parameters = ''){

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}



	$columns = array('s.batchid','s.groupid','s.semesterid','s.id = subjectid','tcu.title','tcu.description','tcu.filename','tcu.topicid','t.chapterid');
	$conditions = array();

	$tables = array();
	$tables['subjects'] = 's';
	$tables['topics'] = 't';
	$tables['chapters'] = 'c';
	$tables['topiccontentsuploads'] = 'tcu';

	$conditions['=']['tcu.id'] = $id;
	$conditions['K AND =']['tcu.topicid'] = 't.id';
	$conditions['K AND =']['c.id'] = 't.chapterid';
	$conditions['K AND =']['s.id'] = 'c.subjectid';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	//print_r($resultset);
	$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->subjectid._S.'Chapter_'.$resultset->chapterid._S.'Topic_'.$resultset->topicid;
	$filename = $resultset->filename;
	}
	}
	}


		/*if (file_exists($foldername._S.$filename)) {
		//header('Content-Description: File Transfer');
		header('Content-Type: MainSystem::returnMIMEType($filename)');
		//header('Content-Disposition: attachment; filename='.basename($foldername._WS.$filename));
		//header('Content-Transfer-Encoding: binary');
		//header('Expires: 0');
		//header('Cache-Control: must-revalidate');
		//header('Pragma: public');
		$contents = file_get_contents($foldername._S.$filename);
		echo $contents;
		exit;
		}
		



		$file = @fopen($foldername._S.$filename, 'rb');
        $speed = (isset($speed) === true) ? round($speed * 1024) : 524288;

        if (is_resource($file) === true)
        {
            set_time_limit(0);
            ignore_user_abort(false);

            while (ob_get_level() > 0)
            {
                ob_end_clean();
            }

            header('Expires: 0');
            header('Pragma: public');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Cache-Control: must-revalidate');
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . sprintf('%u', filesize($foldername._S.$filename)));
            header('Content-Disposition: attachment; filename="' . basename($foldername._S.$filename) . '"');
            header('Content-Transfer-Encoding: binary');

            while (feof($file) !== true)
            {
                echo fread($file, $speed);

                while (ob_get_level() > 0)
                {
                    ob_end_flush();
                }

                flush();
                sleep(1);
            }

            fclose($file);
        }

        exit();*/
    

        
	   

if (file_exists($foldername._S.$filename)) {

header('Content-Type:'.MainSystem::returnMIMEType($filename));
header("Content-length: ". filesize($foldername._S.$filename));
header('Content-Description: File Transfer');
header('Content-Type: MainSystem::returnMIMEType($filename)');
header('Content-Disposition: attachment; filename='.basename($foldername._WS.$filename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
readfile($foldername._S.$filename);
exit;


}


}


} // class topiccontents