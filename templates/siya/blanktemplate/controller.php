<?php
if(_MODULE == ''){
$module = 'admin';
}else{
$module = _MODULE;
}

if(_ACTION == ''){
$action = 'login';
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

define('_TEMPLATE_IMG_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'images');
define('_TEMPLATE_CSS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'css');
define('_TEMPLATE_JS_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'js');
define('_TEMPLATE_THEMES_DIR',PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.PROJ_TEMPLATE_THEMES_DIR);

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
$maincontrollersblock_placeholder = '';
$left_blocks_placeholder = '';
$right_blocks_placeholder = '';
$header_blocks_placeholder = '';
$footer_blocks_placeholder = '';
$beforemiddlecontent_blocks_placeholder = '';
$aftermiddlecontent_blocks_placeholder = '';
$middle_div_class = '';


// SESSION MESSAGE PLACEHOLDER

$session_message_placeholder = '';

if($previous_session_message != ''){
$session_message_placeholder .= $previous_session_message.'</br>';
}

$session_message_placeholder .= MainSystem::GetSessionMsg();

if(isset($_GET['HIDE_TEMPLATE_HEADER_PART']) && $_GET['HIDE_TEMPLATE_HEADER_PART'] == '1'){
$HIDE_TEMPLATE_HEADER_PART = '1';
}else{
$HIDE_TEMPLATE_HEADER_PART = '0';
}


if(isset($_GET['SHOWCONTROLS']) && $_GET['SHOWCONTROLS']==1){
$_SESSION['controllers']['SHOWCONTROLS'] = '1';
}else if(isset($_GET['SHOWCONTROLS']) && $_GET['SHOWCONTROLS']==0){
$_SESSION['controllers']['SHOWCONTROLS'] = '0';
}else if(!isset($_SESSION['controllers']['SHOWCONTROLS'])){
$_SESSION['controllers']['SHOWCONTROLS'] = '0';
}

if(isset($_GET['SCREENGRID']) && $_GET['SCREENGRID']=='960'){
$_SESSION['controllers']['SCREENGRID'] = '960';
}else if(isset($_GET['SCREENGRID']) && $_GET['SCREENGRID']=='1200'){
$_SESSION['controllers']['SCREENGRID'] = '1200';
}else if(!isset($_SESSION['controllers']['SCREENGRID'])){
$_SESSION['controllers']['SCREENGRID'] = '960';
}


if(isset($_GET['SELECTEDTHEME']) && $_GET['SELECTEDTHEME']!=''){
$SELECTEDTHEME = $_GET['SELECTEDTHEME'];
}else if(isset($_GET['SELECTEDTHEME']) && $_GET['SELECTEDTHEME']==''){
$SELECTEDTHEME = '';
}else if(!isset($_GET['SELECTEDTHEME'])){
$SELECTEDTHEME = '';
}



$HIDE_TEMPLATE_LEFT_PART=1;
$HIDE_TEMPLATE_RIGHT_PART=1;

if(isset($_SESSION['controllers']['SCREENGRID']) && $_SESSION['controllers']['SCREENGRID']=='960'){

if($HIDE_TEMPLATE_LEFT_PART && $HIDE_TEMPLATE_RIGHT_PART){
$middle_div_class = 'grid_16';
}else if($HIDE_TEMPLATE_LEFT_PART || $HIDE_TEMPLATE_RIGHT_PART){
$middle_div_class = 'grid_12';
}else{
$middle_div_class = 'grid_8';
}

}else if(isset($_SESSION['controllers']['SCREENGRID']) && $_SESSION['controllers']['SCREENGRID']=='1200'){

if($HIDE_TEMPLATE_LEFT_PART && $HIDE_TEMPLATE_RIGHT_PART){
$middle_div_class = 'grid_15';
}else if($HIDE_TEMPLATE_LEFT_PART || $HIDE_TEMPLATE_RIGHT_PART){
$middle_div_class = 'grid_12';
}else{
$middle_div_class = 'grid_9';
}

}



// SET DEFAULT BATCH //

MainSystem::setDefaultBatch();


//Allowed Modules, Please add your allowed Modules, in the array

//$admin_allowed_modules = array('admin','cms','entities','users','groups','opentadkainstaller','stage','subjects','timetable','attendence','holidays','healthcard','batches','leaves','forums','chat','tests','assessments','questions','assignments','blogs','teachersdiary','meetings','remarks','payments','importexport');

//Allowed Actions, Please add your allowed actions, in the array

//$admin_allowed_actions = array('login','logout','loginCheck','getAdminHome','getContent','errorPage','managePages','savePage','editPage','addNewEntity','saveEntity','manageEntities','editEntity','linkEntities','saveLinkEntities','addNewUserType','saveUserType','getSystemInfo','installModule','installModuleConfirmed','installerResults','uninstallModule','uninstallModuleConfirmed','deactivateModule','deactivateModuleConfirmed','activateModule','activateModuleConfirmed','addNewRegistration','saveRegistration','addStaffRegistration','saveStaffRegistration','addParentRegistration','saveParentRegistration','addNewGroup','saveGroup','addStudentRegistration','saveStudentRegistration','addNewSemester','saveSemester','showStudent','showTeacher','addUserToGroup','saveUserToGroup','showClass','addNewSubject','addNewTopic','saveSubject','showSubject','saveTopic','setBatch','addNewPeriod','savePeriod','updateTimeTable','saveTimeTable','markAttendence','saveAttendence','addHoliday','saveHoliday','addHealthCard','saveHealthCard','addNewBatch','saveBatch','addLeaveType','saveLeaveType','addLeave','saveLeave','addNewForum','saveForum','showForum','addForumCategory','saveForumCategory','addForumTopic','saveForumTopic','showForumTopic','showAllForumTopic','replyForumTopic','saveReplyForumTopic','addNewChat','saveChat','showChat','showChatFrame','showChatWindow','showChatText','showInputChatText','addTest','saveTest','showTest','addAssessment','saveAssessment','showAssessment','addAssessmentType','saveAssessmentType','addGradeCategory','saveGradeCategory','addGrade','saveGrade','saveUsersAssessment','addQuestionsCategory','addQuestions','addQuestionDetails','saveQuestionsCategory','saveQuestions','showQuestions','addQuestionsToTest','saveQuestionsToTest','takeTest','saveTakeTest','addAssignment','saveAssignment','showAssignment','saveUserAnswers','replyAssignment','saveReplyAssignment','addNewBlog','showBlog','saveBlog','addTeachersDiary','showTeachersDiary','saveTeachersDiary','addMeetingType','saveMeetingType','addMeeting','saveMeeting','saveMeetingRemarks','showAllMeeting','showMeeting','addRemark','saveRemark','addPayment','savePayment','addPaymentType','savePaymentType','manageStudents','editStudentRegistration','changeStudentStatus','manageParents','editParentRegistration','changeParentStatus','manageSemesters','editSemesterRegistration','changeSemesterStatus','manageStaff','editStaffRegistration','changeStaffStatus','manageGroups','editGroup','changeGroupStatus','manageSubjects','editSubject','changeSubjectStatus','manageHolidays','editHoliday','changeHolidayStatus','manageHealthCard','editHealthCard','changeHealthCard','manageBatches','editBatches','changeBatchesStatus','manageAssessmentType','editAssessmentType','changeAssessmentTypeStatus','manageGradeCategory','editGradeCategory','changeGradeCategoryStatus','manageGrade','editGrade','changeGradeStatus','manageMeetingTypes','editMeetingTypes','changeMeetingTypeStatus','managePaymentTypes','editPaymentTypes','changePaymentTypeStatus','managePayments','editPayments','changePaymentStatus','manageQuestionCategory','editQuestionCategory','changeQuestionCategoryStatus','manageLeaveType','editLeaveType','changeLeaveTypeStatus','manageLeaves','editLeaves','changeLeaveStatus','deleteStudentRegistration','deleteStudentRegistrationConfirmed','editForum','deleteForum','editForumCategory','deleteForumCategory','editForumTopic','deleteForumTopic','editAssessment','deleteAssessment','showReportCard','addTopicContent','saveTopicContents','importUsersFromExcel','saveUsersFromExcel','showTimeTable');


$admin_allowed_modules = array('admin','cms','entities','users','groups','opentadkainstaller','stage','subjects','timetable','attendence','holidays','healthcard','batches','leaves','forums','chat','tests','assessments','questions','assignments','blogs','teachersdiary','meetings','remarks','payments','topiccontents','importexport','whiteboard','blocksadministration','webconferencing','permissions','friends');

//Allowed Actions, Please add your allowed actions, in the array


$admin_allowed_actions = array('login','logout','loginCheck','getAdminHome','getContent','errorPage','addNewPage','managePages','savePage','editPage','editMenu','managePages','manageMenus','deletePage','deleteMenu','deletePageConfirmed','deleteMenuConfirmed','addNewEntity','saveEntity','manageEntities','editEntity','changeEntityStatus','deleteEntity','deleteEntityConfirmed','linkEntities','saveLinkEntities','addNewUserType','saveUserType','manageUserType','editUserType','changeUserTypeStatus','deleteUserType','deleteUserTypeConfirmed','getSystemInfo','installModule','installModuleConfirmed','installerResults','uninstallModule','uninstallModuleConfirmed','deactivateModule','deactivateModuleConfirmed','activateModule','activateModuleConfirmed','addNewRegistration','saveRegistration','addStaffRegistration','saveStaffRegistration','addParentRegistration','saveParentRegistration','addNewGroup','saveGroup','addStudentRegistration','saveStudentRegistration','addNewSemester','saveSemester','showStudent','showStudentInfo','showTeacher','addUserToGroup','saveUserToGroup','showClass','addNewSubject','addNewTopic','saveSubject','showSubject','saveTopic','setBatch','addNewPeriod','savePeriod','updateTimeTable','saveTimeTable','markAttendence','saveAttendence','addHoliday','saveHoliday','addHealthCard','saveHealthCard','addNewBatch','saveBatch','addLeaveType','saveLeaveType','addLeave','saveLeave','addNewForum','saveForum','showForum','addForumCategory','saveForumCategory','addForumTopic','saveForumTopic','showForumTopic','showAllForumTopic','replyForumTopic','saveReplyForumTopic','addNewChat','saveChat','showChat','showChatFrame','showChatWindow','showChatText','showInputChatText','addTest','saveTest','showTest','addAssessment','saveAssessment','showAssessment','addAssessmentType','saveAssessmentType','addGradeCategory','saveGradeCategory','addGrade','saveGrade','saveUsersAssessment','addQuestionsCategory','addQuestions','addQuestionDetails','saveQuestionsCategory','saveQuestions','showQuestions','addQuestionsToTest','saveQuestionsToTest','takeTest','saveTakeTest','addAssignment','saveAssignment','showAssignment','saveUserAnswers','replyAssignment','saveReplyAssignment','addNewBlog','showBlog','saveBlog','addTeachersDiary','showTeachersDiary','saveTeachersDiary','addMeetingType','saveMeetingType','addMeeting','saveMeeting','saveMeetingRemarks','showAllMeeting','showMeeting','addRemark','saveRemark','addPayment','savePayment','addPaymentType','savePaymentType','manageStudents','editStudentRegistration','changeStudentStatus','manageParents','editParentRegistration','changeParentStatus','manageSemesters','editSemesterRegistration','changeSemesterStatus','manageStaff','editStaffRegistration','changeStaffStatus','manageGroups','editGroup','changeGroupStatus','manageSubjects','editSubject','changeSubjectStatus','manageHolidays','editHoliday','changeHolidayStatus','manageHealthCard','editHealthCard','changeHealthCard','manageBatches','editBatches','changeBatchesStatus','manageAssessmentType','editAssessmentType','changeAssessmentTypeStatus','manageGradeCategory','editGradeCategory','changeGradeCategoryStatus','manageGrade','editGrade','changeGradeStatus','manageMeetingTypes','editMeetingTypes','changeMeetingTypeStatus','managePaymentTypes','editPaymentTypes','changePaymentTypeStatus','managePayments','editPayments','changePaymentStatus','manageQuestionCategory','editQuestionCategory','changeQuestionCategoryStatus','manageLeaveType','editLeaveType','changeLeaveTypeStatus','manageLeaves','editLeaves','changeLeaveStatus','deleteStudentRegistration','deleteStudentRegistrationConfirmed','deleteStaffRegistration','deleteStaffRegistrationConfirmed','deleteParentRegistration','deleteParentRegistrationConfirmed','deleteSemesterRegistration','deleteSemesterRegistrationConfirmed','editForum','deleteForum','editForumCategory','deleteForumCategory','editForumTopic','deleteForumTopic','editAssessment','deleteAssessment','showReportCard','addTopicContent','saveTopicContents','importUsersFromExcel','saveUsersFromExcel','showTimeTable','editChat','deleteChat','deleteGroupRegistration','deleteGroupRegistrationConfirmed','deleteSubject','deleteSubjectConfirmed','deleteHolidays','deleteHolidayConfirmed','deleteHealthCard','deleteHealthCardConfirmed','deleteLeaveType','deleteLeaveTypeConfirmed','deleteLeave','deleteLeaveConfirmed','deleteBatches','deleteBatchConfirmed','deleteGradeCategory','deleteGradeCategoryConfirmed','deleteGrade','deleteGradeConfirmed','deleteAssessmentType','deleteAssessmentTypeConfirmed','deleteAssessment','deleteAssessmentConfirmed','deleteMeetingTypes','deleteMeetingTypeConfirmed','deletePayments','deletePaymentConfirmed','deletePaymentTypes','deletePaymentTypeConfirmed','deleteQuestionCategory','deleteQuestionCategoryConfirmed','deleteChat','deleteChatConfirmed','deleteForum','deleteForumConfirmed','deleteForumCategory','deleteForumCategoryConfirmed','deleteForumTopic','deleteForumTopicConfirmed','showReportCard','addTopicContent','saveTopicContents','importUsersFromExcel','saveUsersFromExcel','importStudentFromExcel','saveStudentFromExcel','importStaffFromExcel','saveStaffFromExcel','importParentFromExcel','saveParentFromExcel','addNewWhiteBoard','showWhiteBoard','editWhiteBoard','saveWhiteBoard','deleteWhiteBoard','deleteWhiteBoardConfirmed','showResult','addNewBlock','saveBlock','manageBlocks','editBlocks','changeBlockStatus','deleteBlock','deleteBlockConfirmed','addWebConferencing','editWebConferencing','showWebConferencing','joinWebConferencing','joinWebConferencingModerator','showWebConferencingWindow','showWebConferencingWindowModerator','saveWebConferencing','deleteWebConferencing','deleteWebConferencingConfirmed','manageTeachersDiary','editTeachersDiary','deleteTeachersDiary','changeTeachersDiaryStatus','deleteTeachersDiaryConfirmed','manageMeetings','editMeetings','deleteMeetings','changeMeetingStatus','deleteMeetingConfirmed','manageRemarks','editRemarks','deleteRemarks','changeRemarkStatus','deleteRemarkConfirmed','manageBlog','editBlog','deleteBlog','changeBlogStatus','deleteBlogConfirmed','openTopicContentFile','viewActionsPermissions','downloadTopicContentFile','studentsMultipleManage','whiteboard','showUserImageByID','addGroupToAnotherGroup','showCampus','showClassInfo','saveGroupToAnotherGroup','whiteboard','editAdminRegistration','sendFriendRequest','saveFriendRequest','changeStatus','saveChangeStatus','moveBlocks','showAttendence','selectDefaultSystemBatch','saveDefaultSystemBatch','showChatUser','showChatText','getNewChatUsersStatus','getNewChatText','saveUserType','sendChatMessage','getNewChatText','getPagesByMenu','showChatUser','showChatText','getNewChatUsersStatus','showChatText','sendChatMessage');


// Main Caller 
$MainSystemObj = new MainSystem();

if(in_array($module,$admin_allowed_modules)){
//if(MainSystem::CheckModuleAccess()==1 || ($module=='admin' && $action == 'login')){

if(in_array($action,$admin_allowed_actions)){


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
}else{
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
}
}else{
MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/1/'));
// Define else
}


if($HIDE_TEMPLATE_HEADER_PART=='0'){
$header_blocks_placeholder = MainSystem::CallBlocks('HEADER');
}




if(MainSystem::IsAdminLogged()){

if($action=='getAdminHome'){
//$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
//$student_list_placeholder = $MainSystemObj->CallBlock('listing','showList', array('@student',$selected_batch_id)); // ClassName , Method Name, Parameters in Array
//$teacher_list_placeholder = $MainSystemObj->CallBlock('listing','showList', array('@teacher',$selected_batch_id)); 
//$class_list_placeholder = $MainSystemObj->CallBlock('listing','showList', array('@class',$selected_batch_id)); 
//$batch_list_placeholder = $MainSystemObj->CallBlock('listing','showBatchList', array('')); 
//$current_selected_batch_placeholder = $MainSystemObj->CallBlock('listing','showCurrentSelectedBatch', array($selected_batch_id)); 
}

$maincontrollersblock_placeholder = $MainSystemObj->CallBlock('controllersblock','showMainControllersBlock', array('')); 


$opentadka_header_navigation_placeholder = $MainSystemObj->CallBlock('opentadkanavigation','showHeaderNavigation', array()); // ClassName , Method Name, Parameters in Array
$opentadka_footer_navigation_placeholder = $MainSystemObj->CallBlock('opentadkanavigation','showFooterNavigation', array()); // ClassName , Method Name, Parameters in Array
}else{
$opentadka_header_navigation_placeholder = '';
$opentadka_footer_navigation_placeholder = '';
}