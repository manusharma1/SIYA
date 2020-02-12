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
///////////////////////////////////////////////////////////////////////////

global $_ACTION_VIEW_PARAMETER_ID;
$blockparameters = explode(',',$_ACTION_VIEW_PARAMETER_ID);

$blockid = (isset($blockparameters[0]))?$blockparameters[0]:'';
$blocktitle = (isset($blockparameters[1]))?$blockparameters[1]:'';

$loggedinuserid = MainSystem::GetSessionUserID();
$loggedinuserdetails = MainSystem::getUserDetailsByID($loggedinuserid);
$loggedinusertypetag = $loggedinuserdetails->usertypetag;

?>

<div class="boxstyle1">
        <div class="boxstyle2">
		
		<?php echo $blocktitle; ?> 
		
		<?php
		if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
		
		$controlsarray = array();
		$controlsarray['editblock']['nameid'] = $blockid.'_edit_block';
		$controlsarray['editblock']['title'] = 'Edit This Block';
		$controlsarray['editblock']['style'] = 'image';
		$controlsarray['editblock']['url'] = 'blocksadministration/editBlocks/'.$blockid.'/';

		$controlsarray['deleteblock']['nameid'] = $blockid.'_delete_block';
		$controlsarray['deleteblock']['title'] = 'Delete This Block';
		$controlsarray['deleteblock']['style'] = 'image';
		$controlsarray['deleteblock']['url'] = 'blocksadministration/deleteBlock/'.$blockid.'/';

		$controlsarray['moveleftblock']['nameid'] = $blockid.'_moveleft_block';
		$controlsarray['moveleftblock']['title'] = 'Move This Block Left';
		$controlsarray['moveleftblock']['style'] = 'image';
		$controlsarray['moveleftblock']['url'] = 'blocksadministration/moveBlocks/left,'.$blockid.'/';

		$controlsarray['moverightblock']['nameid'] = $blockid.'_moveright_block';
		$controlsarray['moverightblock']['title'] = 'Move This Block Right';
		$controlsarray['moverightblock']['style'] = 'image';
		$controlsarray['moverightblock']['url'] = 'blocksadministration/moveBlocks/right,'.$blockid.'/';

		$controlsarray['moveupblock']['nameid'] = $blockid.'_moveup_block';
		$controlsarray['moveupblock']['title'] = 'Move This Block Up';
		$controlsarray['moveupblock']['style'] = 'image';
		$controlsarray['moveupblock']['url'] = 'blocksadministration/moveBlocks/up,'.$blockid.'/';

		$controlsarray['movedownblock']['nameid'] = $blockid.'_movedown_block';
		$controlsarray['movedownblock']['title'] = 'Move This Block Down';
		$controlsarray['movedownblock']['style'] = 'image';
		$controlsarray['movedownblock']['url'] = 'blocksadministration/moveBlocks/down,'.$blockid.'/';

		$controlsarray['moveheaderblock']['nameid'] = $blockid.'_moveheader_block';
		$controlsarray['moveheaderblock']['title'] = 'Move This Block To Header';
		$controlsarray['moveheaderblock']['style'] = 'image';
		$controlsarray['moveheaderblock']['url'] = 'blocksadministration/moveBlocks/header,'.$blockid.'/';

		$controlsarray['movefooterblock']['nameid'] = $blockid.'_movefooter_block';
		$controlsarray['movefooterblock']['title'] = 'Move This Block To Footer';
		$controlsarray['movefooterblock']['style'] = 'image';
		$controlsarray['movefooterblock']['url'] = 'blocksadministration/moveBlocks/footer,'.$blockid.'/';

		$controlsarray['movefooterblock']['nameid'] = $blockid.'_movefooter_block';
		$controlsarray['movefooterblock']['title'] = 'Move This Block To Footer';
		$controlsarray['movefooterblock']['style'] = 'image';
		$controlsarray['movefooterblock']['url'] = 'blocksadministration/moveBlocks/footer,'.$blockid.'/';

		$controlsarray['movebeforemiddlecontentblock']['nameid'] = $blockid.'_beforemiddlecontent_block';
		$controlsarray['movebeforemiddlecontentblock']['title'] = 'Move This Block Before Middle Content';
		$controlsarray['movebeforemiddlecontentblock']['style'] = 'image';
		$controlsarray['movebeforemiddlecontentblock']['url'] = 'blocksadministration/moveBlocks/beforemiddlecontent,'.$blockid.'/';

		$controlsarray['moveaftermiddlecontentblock']['nameid'] = $blockid.'_aftermiddlecontent_block';
		$controlsarray['moveaftermiddlecontentblock']['title'] = 'Move This Block After Middle Content';
		$controlsarray['moveaftermiddlecontentblock']['style'] = 'image';
		$controlsarray['moveaftermiddlecontentblock']['url'] = 'blocksadministration/moveBlocks/aftermiddlecontent,'.$blockid.'/';

		$controlsarray['inactive']['nameid'] = $blockid.'_inactive_block';
		$controlsarray['inactive']['title'] = 'Make this Block Inactive';
		$controlsarray['inactive']['style'] = 'image';
		$controlsarray['inactive']['url'] = 'blocksadministration/changeBlockStatus/0,'.$blockid.'/';

		$controlsarray['hide']['nameid'] = $blockid.'_hide_block';
		$controlsarray['hide']['title'] = 'Hide this Block';
		$controlsarray['hide']['style'] = 'image';
		$controlsarray['hide']['url'] = 'blocksadministration/hideBlock/0,'.$blockid.'/';

		$controls = MainSystem::CreateControls($controlsarray);
		
		?>
		<br />
		<?php echo $controls; ?>
		<?php
		}
		?>
		
		</div>
        <div class="boxstyle3">

<div class="grey">
<ul class="accordion" id="accordion-1">
    <li><a href="#">Home</a></li>
    
	
	<?php
	if($loggedinusertypetag == '#admin'){
	?>
	
	<li class="dcjq-current-parent"><a href="#">OPENTADKA <sup>TM</sup> Installer</a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('opentadkainstaller/getSystemInfo/'); ?>"><?php echo $lang['siya']['GET_SYSTEM_INFORMATION'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>


	<?php
	if($loggedinusertypetag == '#admin'){
	?>
	
	<li class="dcjq-current-parent"><a href="#">Module Actions and Users Permissions</a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('permissions/viewActionsPermissions/'); ?>"><?php echo $lang['siya']['MANAGE_PERMISSIONS'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>

	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>

    <li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['ENTITIES_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('entities/addNewEntity/'); ?>"><?php echo $lang['siya']['ADD_NEW_ENTITY'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('entities/manageEntities/');?>"><?php echo $lang['siya']['MANAGE_ENTITIES'];?></a></li>
					  </ul>
					</li>
	

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>
	 <li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['CMS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('cms/addNewPage/');?>"><?php echo $lang['siya']['ADD_A_NEW_PAGE'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('cms/managePages/');?>"><?php echo $lang['siya']['MANAGE_PAGES'];?></a></li>

	<?php
	}
	?>
	
	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>
			<li><a href="<?php echo MainSystem::URLCreator('cms/addNewMenu/');?>"><?php echo $lang['siya']['ADD_A_MENU'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('cms/manageMenus/');?>"><?php echo $lang['siya']['MANAGE_MENUS'];?></a></li>
					
	<?php
	}
	?>
					  </ul>
					</li>
	

	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>
	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['USER_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('users/addNewUserType/');?>"><?php echo $lang['siya']['ADD_NEW_USER_TYPE'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('users/manageUserType/');?>"><?php echo $lang['siya']['MANAGE_USER_TYPE'];?></a></li>

						 </ul>
						</li>

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['GROUPS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('groups/addNewGroup/');?>"><?php echo $lang['siya']['ADD_NEW_GROUP'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('groups/manageGroups/');?>"><?php echo $lang['siya']['MANAGE_GROUP'];?></a></li>
					  </ul>
					</li>


	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['SUBJECT_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('subjects/addNewSubject/'); ?>"><?php echo $lang['siya']['ADD_NEW_SUBJECT'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('subjects/manageSubjects/');?>"><?php echo $lang['siya']['MANAGE_SUBJECT'];?></a></li>
					  </ul>
					</li>
	
	<?php
	}
	?>

	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>
	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['TIMETABLE_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('timetable/addNewPeriod/'); ?>"><?php echo $lang['siya']['ADD_NEW_PERIOD'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('timetable/managePeriods/');?>"><?php echo $lang['siya']['MANAGE_PERIODS'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>
	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['HOLIDAYS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('holidays/addHoliday/'); ?>"><?php echo $lang['siya']['ADD_HOLIDAY'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('holidays/manageHolidays/');?>"><?php echo $lang['siya']['MANAGE_HOLIDAY'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['REMARKS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('remarks/manageRemarks/');?>"><?php echo $lang['siya']['MANAGE_REMARKS'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>

	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['NEWS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('news/manageNews/');?>"><?php echo $lang['siya']['MANAGE_NEWS'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['HEALTH_CARD_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('healthcard/manageHealthCard/');?>"><?php echo $lang['siya']['MANAGE_HEALTH_CARD'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['LEAVE_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('leaves/addLeaveType/'); ?>"><?php echo $lang['siya']['ADD_LEAVE_TYPE'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('leaves/manageLeaveType/'); ?>"><?php echo $lang['siya']['MANAGE_LEAVE_TYPE'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('leaves/manageLeaves/');?>"><?php echo $lang['siya']['MANAGE_LEAVES'];?></a></li>
					  </ul>
					</li>
		
	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['REGISTRATION'];?></a><ul>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>
		<li><a href="<?php echo MainSystem::URLCreator('users/addNewRegistration/'); ?>"><?php echo $lang['siya']['ADD_NEW_REGISTRATION'];?> </a></li>
		<li><a href="<?php echo MainSystem::URLCreator('users/manageNewRegistration/');?>"><?php echo $lang['siya']['MANAGE_NEW_REGISTRATION'];?></a></li>

		<li><a href="<?php echo MainSystem::URLCreator('users/addStaffRegistration/');?>"><?php echo $lang['siya']['ADD_STAFF_REGISTRATION'];?></a></li>
		<li><a href="<?php echo MainSystem::URLCreator('users/manageStaff/'); ?>"><?php echo $lang['siya']['MANAGE_STAFF'];?> </a></li>

	<?php
	}
	?>

		<li><a href="<?php echo MainSystem::URLCreator('users/addStudentRegistration/');?>"><?php echo $lang['siya']['ADD_STUDENTS_REGISTRATION'];?></a></li>
		<li><a href="<?php echo MainSystem::URLCreator('users/manageStudents/');?>"><?php echo $lang['siya']['MANAGE_STUDENTS'];?></a></li>

		<li><a href="<?php echo MainSystem::URLCreator('users/addParentRegistration/'); ?>"><?php echo $lang['siya']['ADD_PARENTS_REGISTRATION'];?> </a></li>
		<li><a href="<?php echo MainSystem::URLCreator('users/manageParents/');?>"><?php echo $lang['siya']['MANAGE_PARENTS'];?></a></li>
		<li><a href="<?php echo MainSystem::URLCreator('users/addStudentParentRegistration/');?>"><?php echo $lang['siya']['ADD_STUDENT_PARENT_REGISTRATION'];?></a></li>

					  </ul>
					</li>


	<?php
	}
	?>

	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['BULK_REGISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('importexport/importUsersFromExcel/'); ?>"><?php echo $lang['siya']['BULK_USERS_REGISTRATION'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('importexport/importStudentFromExcel/');?>"><?php echo $lang['siya']['BULK_STUDENT_REGISTRATION'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('importexport/importParentFromExcel/'); ?>"><?php echo $lang['siya']['BULK_PARENT_REGISTRATION'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('importexport/importStudentParentFromExcel/');?>"><?php echo $lang['siya']['BULK_STUDENT_PARENT_REGISTRATION'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('importexport/importStaffFromExcel/'); ?>"><?php echo $lang['siya']['BULK_STAFF_REGISTRATION'];?> </a></li>
					  </ul>
					</li>
	
	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['BATCH_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('batches/addNewBatch/'); ?>"><?php echo $lang['siya']['ADD_NEW_BATCH'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('batches/manageBatches/');?>"><?php echo $lang['siya']['MANAGE_BATCH'];?></a></li>
					  </ul>
					</li>
	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['SEMESTERS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('semesters/addNewSemester/'); ?>"><?php echo $lang['siya']['ADD_SEMESTER'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('semesters/manageSemesters/'); ?>"><?php echo $lang['siya']['MANAGE_SEMESTERS'];?> </a></li>
		  </ul>
	</li>


	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>
	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['ASSESSMENT_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('assessments/addGradeCategory/'); ?>"><?php echo $lang['siya']['ADD_GRADE_CATEGORY'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('assessments/addGrade/');?>"><?php echo $lang['siya']['ADD_GRADE'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('assessments/addAssessmentType/'); ?>"><?php echo $lang['siya']['ADD_ASSESSMENT_TYPE'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('assessments/manageGradeCategory/');?>"><?php echo $lang['siya']['MANAGE_GRADE_CATEGORY'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('assessments/manageGrade/');?>"><?php echo $lang['siya']['MANAGE_GRADE'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('assessments/manageAssessmentType/'); ?>"><?php echo $lang['siya']['MANAGE_ASSESSMENT_TYPE'];?> </a></li>
					  </ul>
					</li>

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['MEETING_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('meetings/addMeetingType/'); ?>"><?php echo $lang['siya']['ADD_MEETING_TYPE'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('meetings/manageMeetingTypes/');?>"><?php echo $lang['siya']['MANAGE_MEETING_TYPE'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('meetings/manageMeetings/');?>"><?php echo $lang['siya']['MANAGE_MEETINGS'];?></a></li>
					  </ul>
					</li>
	

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>
	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['PAYMENT_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('payments/addPayment/'); ?>"><?php echo $lang['siya']['ADD_PAYMENT'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('payments/addPaymentType/');?>"><?php echo $lang['siya']['ADD_PAYMENT_TYPE'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('payments/managePayments/'); ?>"><?php echo $lang['siya']['MANAGE_PAYMENT'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('payments/managePaymentTypes/');?>"><?php echo $lang['siya']['MANAGE_PAYMENT_TYPES'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>

	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin') || $loggedinusertypetag == '#teacher'){
	?>


	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['QUESTIONS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('questions/addQuestionsCategory/'); ?>"><?php echo $lang['siya']['ADD_QUESTIONS_CATEGORY'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('questions/addQuestions/');?>"><?php echo $lang['siya']['ADD_QUESTIONS'];?></a></li>
			<li><a href="<?php echo MainSystem::URLCreator('questions/manageQuestionCategory/'); ?>"><?php echo $lang['siya']['MANAGE_QUESTIONS_CATEGORY'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('questions/manageQuestions/');?>"><?php echo $lang['siya']['MANAGE_QUESTIONS'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>


	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['BLOCK_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('blocksadministration/addNewBlock/'); ?>"><?php echo $lang['siya']['ADD_NEW_BLOCK'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('blocksadministration/manageBlocks/');?>"><?php echo $lang['siya']['MANAGE_BLOCKS'];?></a></li>
					  </ul>
					</li>
	
	<?php
	}
	?>

	<?php
	if(($loggedinusertypetag == '#admin' || $loggedinusertypetag == '#subadmin')){
	?>

	<li class="dcjq-current-parent"><a href="#"><?php echo $lang['siya']['ADDITIONAL_SETTINGS_ADMINISTRATION'];?></a><ul>
			<li><a href="<?php echo MainSystem::URLCreator('additionalsettings/addNewAdditionalSetting/'); ?>"><?php echo $lang['siya']['ADD_NEW_ADDITIONAL_SETTINGS'];?> </a></li>
			<li><a href="<?php echo MainSystem::URLCreator('additionalsettings/manageAdditionalSettings/');?>"><?php echo $lang['siya']['MANAGE_ADDITIONAL_SETTINGS'];?></a></li>
					  </ul>
					</li>

	<?php
	}
	?>



</ul>


</div>
<div class="clear"></div>
		</div>
        <div style="clear: both;"></div>
 </div>
<script type="text/javascript">
$(document).ready(function($){
					$('#accordion-1').dcAccordion({
						eventType: 'click',
						autoClose: true,
						saveState: true,
						disableLink: true,
						speed: 'slow',
						showCount: false,
						autoExpand: false,
						cookie	: 'dcjq-accordion-1',
						classExpand	 : 'dcjq-current-parent'
					});
					$('#accordion-2').dcAccordion({
						eventType: 'click',
						autoClose: false,
						saveState: true,
						disableLink: true,
						speed: 'fast',
						classActive: 'test',
						showCount: false
					});
					$('#accordion-3').dcAccordion({
						eventType: 'click',
						autoClose: false,
						saveState: false,
						disableLink: false,
						showCount: false,
						speed: 'slow'
					});
					$('#accordion-4').dcAccordion({
						eventType: 'hover',
						autoClose: true,
						saveState: true,
						disableLink: true,
						menuClose: false,
						speed: 'slow',
						showCount: true
					});
					$('#accordion-5').dcAccordion({
						eventType: 'hover',
						autoClose: false,
						saveState: true,
						disableLink: true,
						menuClose: true,
						speed: 'fast',
						showCount: true
					});
					$('#accordion-6').dcAccordion({
						eventType: 'hover',
						autoClose: false,
						saveState: false,
						disableLink: false,
						showCount: false,
						menuClose: true,
						speed: 'slow'
					});
});
</script>
