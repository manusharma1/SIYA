<?php
if(_MODULE == ''){
$module = 'chat';
}else{
$module = _MODULE;
}

if(_ACTION == ''){
$action = '';
}else{
$action = _ACTION;
}

if(_PARAMETERS == ''){
$parameters = array();
}else{
$parameters = explode(',', _PARAMETERS);
}

$previous_session_message = '';
if($module == 'admin' && ($action == 'login' || $action == 'loginCheck') && empty($parameters)){
$previous_session_message = MainSystem::GetPreviousSessionMsg();
MainSystem::CreateSession();
}else{
MainSystem::CheckSession();
}

if(!MainSystem::IsAdminLogged() && $module != 'admin' && ($action != 'login' || $action != 'loginCheck') && empty($parameters)){
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
}

define('_TEMPLATE_IMG_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'chat'._WS.'images');
define('_TEMPLATE_CSS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'chat'._WS.'css');
define('_TEMPLATE_JS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'chat'._WS.'js');
//define('_TEMPLATE_CSS_FOR_HTMLEDITOR_CONTENTS',_TEMPLATE_CSS_DIR._WS.'htmleditorstyle.css'); 


// DEFINING THE ADDITIONAL PARAMETERS FOR FORM FIELDS

define('_FORM_REQUIRED','required=""'); 
define('_FORM_AUTOFOCUS','autofocus=""');

if(PROJ_RUN_AJAX==1){
define('_FORM_CLASS','class="'.PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required"'); 
}else{
define('_FORM_CLASS','class="required"'); 
}

define('_FORM_FINAL',_FORM_REQUIRED.' '._FORM_AUTOFOCUS.' '._FORM_CLASS); 

// DEFINING THE ADDITIONAL PARAMETERS FOR FORM FIELDS



// DEFINE PLACEHOLDERS

$title_placeholder='';
$meta_description_placeholder='';
$meta_keywords_placeholder='';
$main_content_placeholder='';
$login_box_placeholder='';
$student_list_placeholder = '';
$teacher_list_placeholder = '';
$class_list_placeholder = '';
$batch_list_placeholder = '';
$current_selected_batch_placeholder = '';
$moreid = '';

// SESSION MESSAGE PLACEHOLDER

$session_message_placeholder = '';

if($previous_session_message != ''){
$session_message_placeholder .= $previous_session_message.'</br>';
}

$session_message_placeholder .= MainSystem::GetSessionMsg();


//Allowed Modules, Please add your allowed Modules, in the array

$admin_allowed_modules = array('admin','cms','entities','users','groups','opentadkainstaller','stage','subjects','timetable','attendence','holidays','healthcard','batches','leaves','forums','chat','tests','assessments','questions','assignments','blogs','teachersdiary','meetings','remarks','payments','topiccontents','importexport','whiteboard');

//Allowed Actions, Please add your allowed actions, in the array

$admin_allowed_actions = array('login','logout','loginCheck','getAdminHome','getContent','errorPage','managePages','savePage','editPage','addNewEntity','saveEntity','manageEntities','editEntity','linkEntities','saveLinkEntities','addNewUserType','saveUserType','getSystemInfo','installModule','installModuleConfirmed','installerResults','uninstallModule','uninstallModuleConfirmed','deactivateModule','deactivateModuleConfirmed','activateModule','activateModuleConfirmed','addNewRegistration','saveRegistration','addStaffRegistration','saveStaffRegistration','addParentRegistration','saveParentRegistration','addNewGroup','saveGroup','addStudentRegistration','saveStudentRegistration','addNewSemester','saveSemester','showStudent','showTeacher','addUserToGroup','saveUserToGroup','showClass','addNewSubject','addNewTopic','saveSubject','showSubject','saveTopic','setBatch','addNewPeriod','savePeriod','updateTimeTable','saveTimeTable','markAttendence','saveAttendence','addHoliday','saveHoliday','addHealthCard','saveHealthCard','addNewBatch','saveBatch','addLeaveType','saveLeaveType','addLeave','saveLeave','addNewForum','saveForum','showForum','addForumCategory','saveForumCategory','addForumTopic','saveForumTopic','showForumTopic','showAllForumTopic','replyForumTopic','saveReplyForumTopic','addNewChat','saveChat','showChat','showChatFrame','showChatWindow','showChatText','showInputChatText','addTest','saveTest','showTest','addAssessment','saveAssessment','showAssessment','addAssessmentType','saveAssessmentType','addGradeCategory','saveGradeCategory','addGrade','saveGrade','saveUsersAssessment','addQuestionsCategory','addQuestions','addQuestionDetails','saveQuestionsCategory','saveQuestions','showQuestions','addQuestionsToTest','saveQuestionsToTest','takeTest','saveTakeTest','addAssignment','saveAssignment','showAssignment','saveUserAnswers','replyAssignment','saveReplyAssignment','addNewBlog','showBlog','saveBlog','addTeachersDiary','showTeachersDiary','saveTeachersDiary','addMeetingType','saveMeetingType','addMeeting','saveMeeting','saveMeetingRemarks','showAllMeeting','showMeeting','addRemark','saveRemark','addPayment','savePayment','addPaymentType','savePaymentType','manageStudents','editStudentRegistration','changeStudentStatus','manageParents','editParentRegistration','changeParentStatus','manageSemesters','editSemesterRegistration','changeSemesterStatus','manageStaff','editStaffRegistration','changeStaffStatus','manageGroups','editGroup','changeGroupStatus','manageSubjects','editSubject','changeSubjectStatus','manageHolidays','editHoliday','changeHolidayStatus','manageHealthCard','editHealthCard','changeHealthCard','manageBatches','editBatches','changeBatchesStatus','manageAssessmentType','editAssessmentType','changeAssessmentTypeStatus','manageGradeCategory','editGradeCategory','changeGradeCategoryStatus','manageGrade','editGrade','changeGradeStatus','manageMeetingTypes','editMeetingTypes','changeMeetingTypeStatus','managePaymentTypes','editPaymentTypes','changePaymentTypeStatus','managePayments','editPayments','changePaymentStatus','manageQuestionCategory','editQuestionCategory','changeQuestionCategoryStatus','manageLeaveType','editLeaveType','changeLeaveTypeStatus','manageLeaves','editLeaves','changeLeaveStatus','deleteStudentRegistration','deleteStudentRegistrationConfirmed','deleteStaffRegistration','deleteStaffRegistrationConfirmed','deleteParentRegistration','deleteParentRegistrationConfirmed','deleteSemesterRegistration','deleteSemesterRegistrationConfirmed','editForum','deleteForum','editForumCategory','deleteForumCategory','editForumTopic','deleteForumTopic','editAssessment','deleteAssessment','showReportCard','addTopicContent','saveTopicContents','importUsersFromExcel','saveUsersFromExcel','showTimeTable','editChat','deleteChat','deleteGroupRegistration','deleteGroupRegistrationConfirmed','deleteSubject','deleteSubjectConfirmed','deleteHolidays','deleteHolidayConfirmed','deleteHealthCard','deleteHealthCardConfirmed','deleteLeaveType','deleteLeaveTypeConfirmed','deleteLeave','deleteLeaveConfirmed','deleteBatches','deleteBatchConfirmed','deleteGradeCategory','deleteGradeCategoryConfirmed','deleteGrade','deleteGradeConfirmed','deleteAssessmentType','deleteAssessmentTypeConfirmed','deleteAssessment','deleteAssessmentConfirmed','deleteMeetingTypes','deleteMeetingTypeConfirmed','deletePayments','deletePaymentConfirmed','deletePaymentTypes','deletePaymentTypeConfirmed','deleteQuestionCategory','deleteQuestionCategoryConfirmed','deleteChat','deleteChatConfirmed','deleteForum','deleteForumConfirmed','deleteForumCategory','deleteForumCategoryConfirmed','deleteForumTopic','deleteForumTopicConfirmed','showReportCard','addTopicContent','saveTopicContents','importUsersFromExcel','saveUsersFromExcel','importStudentFromExcel','saveStudentFromExcel','importStaffFromExcel','saveStaffFromExcel','importParentFromExcel','saveParentFromExcel','addNewWhiteBoard','showWhiteBoard','editWhiteBoard','saveWhiteBoard','deleteWhiteBoard','deleteWhiteBoardConfirmed','getNewChatText','showChatUser','getNewChatUsersStatus');

// Main Caller 
$MainSystemObj = new MainSystem();

$module_accessreturn_array = MainSystem::CheckModuleAccess();


if($module_accessreturn_array['noerror'] != 0 || ($module=='admin' && $action == 'login')){

$module_action_accessreturn_array = MainSystem::CheckModuleActionAccess('admin');


if($module_action_accessreturn_array['noerror'] != 0){


//if(in_array($module,$admin_allowed_modules)){

//if(in_array($action,$admin_allowed_actions)){


/*$module_actions_access = 0;
if($module=='admin' && $action=='login'){
$module_actions_access = 1;
}else{
$module_actions_access = MainSystem::CheckModuleActionAccess('admin');
}
if($module_actions_access==1){
*/

$resultset = array();
$resultset = $MainSystemObj->CallModule($module,$action,$parameters); // ClassName , Method Name, Parameters in Array

	if(isset($resultset['title_placeholder'])){
	$title_placeholder = $resultset['title_placeholder'];
	}else{
	$title_placeholder = '';
	}

	if(isset($resultset['main_content_placeholder'])){
	$main_content_placeholder = $resultset['main_content_placeholder'];
	}else{
	$main_content_placeholder = '';
	}


	if(isset($resultset['main_content2_placeholder'])){ 
	$main_content2_placeholder = $resultset['main_content2_placeholder']; 
	$secondcolumntrue = 1;
	}else{ 
	$main_content2_placeholder = ''; 
	$secondcolumntrue = 0;
	} 

	if(isset($resultset['main_contentmore_placeholder'])){ 
	$main_contentmore_placeholder = $resultset['main_contentmore_placeholder']; 
	}else{ 
	$main_contentmore_placeholder = ''; 
	} 

	if(isset($resultset['main_content2more_placeholder'])){ 
	$main_content2more_placeholder = $resultset['main_content2more_placeholder']; 
	}else{ 
	$main_content2more_placeholder = ''; 
	}


	if(isset($resultset['main_contentmore_url_placeholder'])){ 
	$main_contentmore_url_placeholder = $resultset['main_contentmore_url_placeholder']; 
	}else{ 
	$main_contentmore_url_placeholder = ''; 
	} 

	if(isset($resultset['main_content2more_url_placeholder'])){ 
	$main_content2more_url_placeholder = $resultset['main_content2more_url_placeholder']; 
	}else{ 
	$main_content2more_url_placeholder = ''; 
	} 


	if(isset($resultset['main_contentmore_back_url_placeholder'])){ 
	$main_contentmore_back_url_placeholder = $resultset['main_contentmore_back_url_placeholder']; 
	}else{ 
	$main_contentmore_back_url_placeholder = ''; 
	} 

	if(isset($resultset['main_content2more_back_url_placeholder'])){ 
	$main_content2more_back_url_placeholder = $resultset['main_content2more_back_url_placeholder']; 
	}else{ 
	$main_content2more_back_url_placeholder = ''; 
	} 

	if($moreid !=''){
	$secondcolumntrue = 0;
	$main_content_placeholder = '';
	$main_content2_placeholder = '';
	}

}else{
	//echo 'saddsa33333';die;

//MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
//print_r($module_action_accessreturn_array);
MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$module_action_accessreturn_array['message'].'/'));
}
}else{
	//echo 'saddsa';die;
//MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
//print_r($module_accessreturn_array);
MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$module_accessreturn_array['message'].'/'));
// Define else
}

//}
//}


if(MainSystem::IsAdminLogged()){

if($action=='getAdminHome'){
$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
$student_list_placeholder = $MainSystemObj->CallBlock('listing','showList', array('@student',$selected_batch_id)); // ClassName , Method Name, Parameters in Array
$teacher_list_placeholder = $MainSystemObj->CallBlock('listing','showList', array('@teacher',$selected_batch_id)); 
$class_list_placeholder = $MainSystemObj->CallBlock('listing','showList', array('@class',$selected_batch_id)); 
$batch_list_placeholder = $MainSystemObj->CallBlock('listing','showBatchList', array('')); 
$current_selected_batch_placeholder = $MainSystemObj->CallBlock('listing','showCurrentSelectedBatch', array($selected_batch_id)); 
}

$opentadka_header_navigation_placeholder = $MainSystemObj->CallBlock('opentadkanavigationblock','showHeaderNavigation', array()); // ClassName , Method Name, Parameters in Array
$opentadka_footer_navigation_placeholder = $MainSystemObj->CallBlock('opentadkanavigationblock','showFooterNavigation', array()); // ClassName , Method Name, Parameters in Array
}else{
$opentadka_header_navigation_placeholder = '';
$opentadka_footer_navigation_placeholder = '';
}