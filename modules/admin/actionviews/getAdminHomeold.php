<?php
// OPENTADKA FRAMEWORK		http://www.opentadka.org
?>


<a name="user_administration"><h2><?php echo $lang['siya']['admin']['OPENTADKA_INSTALLER']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="50%" bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('opentadkainstaller/getSystemInfo/');?>">Get System Information </a></td>
    <td width="50%" bgcolor="#CCCC66"></td>
  </tr>
</table>

<a name="user_administration"><h2><?php echo $lang['siya']['admin']['USER_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="50%" bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('admin/getUserDetails/');?>">Edit Your Details </a></td>
    <td width="50%" bgcolor="#CCCC66"></td>
  </tr>
</table>

<a name="additionalsettings_administration"><br /><h2><?php echo $lang['siya']['admin']['ENTITIES_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('entities/addNewEntity/');?>">Add New Entity </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('entities/manageEntities/');?>">Manage Entities </a></td>
  </tr>

  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('entities/linkEntities/');?>">Link Entities </a></td>
  </tr>

</table>



<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['USERS_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/addNewUserType/');?>">Add New User Type </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/manageUserType/');?>">Manage User Type </a></td>
  </tr>

</table>

<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['GROUPS_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('groups/addNewGroup/');?>">Add New Group </a></td>
	 <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('groups/addUserToGroup/');?>">Add User To Group </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('groups/manageGroups/');?>">Manage Group </a></td>
  </tr>

</table>

<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['SUBJECT_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('subjects/addNewSubject/');?>">Add New Subject </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('subjects/manageSubjects/');?>">Manage Subject </a></td>
  </tr>

</table>

<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['TIMETABLE_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('timetable/addNewPeriod/');?>">Add New Period </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('timetable/managePeriods/');?>">Manage Period </a></td>
  </tr>

</table>

<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['HOLIDAYS_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('holidays/addHoliday/');?>">Add Holiday </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('holidays/manageHolidays/');?>">Manage Holiday </a></td>
  </tr>

</table>

<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['HEALTH_CARD_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('healthcard/addHealthCard/');?>">Add Health Card  </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('healthcard/manageHealthCard/');?>">Manage Health Card </a></td>
  </tr>

</table>

<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['LEAVE_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('leaves/addLeaveType/');?>">Add Leave Type  </a></td>
	 <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('leaves/addLeave/');?>">Add Leave  </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('leaves/manageLeaves/');?>">Manage Leave </a></td>
  </tr>

</table>

<a name="users_administration"><br /><h2><?php echo $lang['siya']['admin']['REGISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/addNewRegistration/');?>">Add New Registration </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/manageNewRegistration/');?>">Manage New Registration </a></td>
  </tr>
	<tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/addStaffRegistration/');?>">Add Staff Registration </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/manageStaff/');?>">Manage Staff </a></td>
  </tr>
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/addParentRegistration/');?>">Add Parents Registration </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/manageParents/');?>">Manage Parents </a></td>
  </tr>
	<tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/addStudentRegistration/');?>">Add Students Registration </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/manageStudents/');?>">Manage Students </a></td>
  </tr>
   <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/addNewSemester/');?>">Add Semester Code </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('users/manageSemesters/');?>">Manage Semesters </a></td>
  </tr>

</table>

<a name="batch_administration"><br /><h2><?php echo $lang['siya']['admin']['BATCH_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('batches/addNewBatch/');?>">Add New Batch </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('batches/manageBatches/');?>">Manage Batch </a></td>
  </tr>

</table>

<a name="forum_administration"><br /><h2><?php echo $lang['siya']['admin']['FORUMS_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('forums/addNewForum/');?>">Add New Forum </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('forums/manageForums/');?>">Manage Forum </a></td>
  </tr>

</table>

<a name="forum_assessments"><br /><h2><?php echo $lang['siya']['admin']['ASSESSMENT_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('assessments/addGradeCategory/');?>">Add Grade Category </a></td>
	<td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('assessments/addGrade/');?>">Add Grade  </a></td>
	<td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('assessments/addAssessmentType/');?>">Add Assessment Type  </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('assessments/manageGrade/');?>">Manage Grade</a></td>
  </tr>

</table>

<a name="forum_meetings"><br /><h2><?php echo $lang['siya']['admin']['MEETING_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
	<td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('meetings/addMeetingType/');?>">Add Meeting Type  </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('meetings/manageMeetingTypes/');?>">Manage Meeting Type  </a></td>
  </tr>

</table>

<a name="forum_payment"><br /><h2><?php echo $lang['siya']['admin']['PAYMENT_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('payments/addPayment/');?>">Add Payment </a></td>
	<td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('payments/addPaymentType/');?>">Add Payment Type  </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('payments/managePayments/');?>">Manage Payment </a></td>
  </tr>

</table>
<a name="forum_questions"><br /><h2><?php echo $lang['siya']['admin']['QUESTIONS_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('questions/addQuestionsCategory/');?>">Add Questions Category </a></td>
	<td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('questions/addQuestions/');?>">Add Questions  </a></td>
   <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('questions/manageQuestions/');?>">Manage questions </a></td>
  </tr>

</table>

<a name="additionalsettings_administration"><br /><h2><?php echo $lang['siya']['admin']['ADDITIONAL_SETTINGS_ADMINISTRATION']; ?></h2><hr /><br /></a>
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('additionalsettings/addNewAdditionalSetting/');?>">Add New Additional Settings </a></td>
    <td bgcolor="#CCCC66"><a href="<?php echo MainSystem::URLCreator('additionalsettings/manageAdditionalSettings/');?>">Manage Additional Settings </a></td>
  </tr>
</table>
<br /><br />