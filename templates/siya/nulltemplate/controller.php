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


define('_TEMPLATE_CSS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'css');

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



$resultset = array();
$resultset = $MainSystemObj->CallModule($module,$action,$parameters); // ClassName , Method Name, Parameters in Array

	if(isset($resultset['main_content_placeholder'])){
	$main_content_placeholder = $resultset['main_content_placeholder'];
	}else{
	$main_content_placeholder = '';
	}

}else{

MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$module_action_accessreturn_array['message'].'/'));
}
}else{

MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$module_accessreturn_array['message'].'/'));

}