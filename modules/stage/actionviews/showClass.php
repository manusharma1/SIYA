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
?>

<?php


	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
	
	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////
	
	$id = (isset($parameters[0]))?$parameters[0]:'';
	MainSystem::CheckGroupPermissions($id,'group');


	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

	$id_placeholder = '';
	$groupid_placeholder = '';
	$grouptypetag_placeholder = '';
	$name_placeholder = '';
	
	// Get Users Data
	$columns = array('id','grouptypetag','name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
	
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$groupid_placeholder = $sqlObj->getCleanData($resultset->id);
	$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	?>

	<h3 class="headingh3"><?php echo $name_placeholder.' ('.$grouptypetag_placeholder.') '; ?></h3>

	<br /> <a class="button blue" href="<?php echo MainSystem::URLCreator('groups/addUsersToGroup/'.$id.'/');?>">Users Management (Core Members)</a><br />

	<br /> <a class="button blue" href="<?php echo MainSystem::URLCreator('groups/addOtherUsersToGroup/'.$id.'/');?>">Users Management (Other Users allowed in this Group)</a><br />

	<br /> <a class="button blue" href="<?php echo MainSystem::URLCreator('groups/addGroupToAnotherGroup/'.$id.'/');?>">Promote This Class to Another Class and Batch</a><br />


	<?php
	}
	}else{
	
	?>
	
	<h3 class="headingh3">No Class with this Id</h3>
	<?php
	}
	}
	?>
	<br /><h3 class="headingh3">Teachers</h3><br />
	<?php
	$columns = array('u.id','u.fname','u.mname','u.lname','u.gender');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';
	
	$conditions['=']['ug.groupid'] = $id;
	$conditions['AND =']['ug.iscore'] = 1;


	if($selected_batch_id!=''){
	$conditions['AND =']['ug.batchid'] = $selected_batch_id;
	}

	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['AND =']['g.entitytypetag'] = '@class';
	$conditions['AND =']['u.entitytypetag'] = '@teacher';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	?>
	<table><tr>
	<?php
	$counter=0;
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder =$sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
	$teacher_icon = ($resultset->gender=='M')?'male_teacher.png':'female_teacher.png';
	?>
	<td><a class="sticky" href="<?php echo MainSystem::URLCreator('stage/showTeacher/'.$id_placeholder.','.$id.'/'); ?>" rel="<?php echo MainSystem::URLCreator('stage/showTeacherInfo/'.$id_placeholder.','.$id.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.$teacher_icon; ?>" alt="<?php echo $name_placeholder; ?>" title="<?php echo $name_placeholder; ?>" /><br /><?php echo $name_placeholder; ?></a></td>
	<?php
	$counter++;
	if($counter>=3){
	$counter = 0;	
	?>
	</tr>
	<tr>
	<?php
	}
	}
	?>
	</tr></table>
	<?php
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	
?>

<br /><h3 class="headingh3">Students</h3><br />

	
	<?php
	$columns = array('u.id','u.fname','u.mname','u.lname','u.gender');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';

	$conditions['=']['ug.groupid'] = $id;
	$conditions['AND =']['ug.iscore'] = 1;

	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['AND =']['ug.batchid'] = $selected_batch_id;
	$conditions['AND =']['g.entitytypetag'] = '@class';
	$conditions['AND =']['u.entitytypetag'] = '@student';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	?>
	<table width="100%"><tr>
	<?php
	$counter = 0;
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder =$sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
	
	$student_icon = ($resultset->gender=='M')?'user_male_white_blue_brown.png':'user_female_white_pink_brown.png';
	?>
	<td width="20%"><a class="sticky" href="<?php echo MainSystem::URLCreator('stage/showStudent/'.$id_placeholder.','.$id.'/'); ?>" rel="<?php echo MainSystem::URLCreator('stage/showStudentInfo/'.$id_placeholder.','.$id.','.$selected_batch_id.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.$student_icon; ?>" alt="<?php echo $name_placeholder; ?>" title="<?php echo $name_placeholder; ?>" /><br /><?php echo $name_placeholder; ?></a></td>
	<?php
	$counter++;
	if($counter>=5){
	$counter = 0;
	?>
	</tr>
	<tr>
	<?php
	}
	}
	?>
	</tr></table>
	<?php
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


	<h3 class="headingh3">Other Users</h3>



<?php
	$columns = array('u.id','u.fname','u.mname','u.lname','u.gender');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';
	
	$conditions['=']['ug.groupid'] = $id;
	$conditions['AND =']['ug.iscore'] = 0;


	if($selected_batch_id!=''){
	$conditions['AND =']['ug.batchid'] = $selected_batch_id;
	}

	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['AND =']['g.entitytypetag'] = '@class';
	$conditions['AND =']['u.entitytypetag'] = '@teacher';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	?>
	<table><tr>
	<?php
	$counter=0;
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder =$sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
	$teacher_icon = ($resultset->gender=='M')?'male_teacher.png':'female_teacher.png';
	?>
	<td><a class="sticky" href="<?php echo MainSystem::URLCreator('stage/showTeacher/'.$id_placeholder.','.$id.'/'); ?>" rel="<?php echo MainSystem::URLCreator('stage/showTeacherInfo/'.$id_placeholder.','.$id.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.$teacher_icon; ?>" alt="<?php echo $name_placeholder; ?>" title="<?php echo $name_placeholder; ?>" /><br /><?php echo $name_placeholder; ?></a></td>
	<?php
	$counter++;
	if($counter>=3){
	$counter = 0;	
	?>
	</tr>
	<tr>
	<?php
	}
	}
	?>
	</tr></table>
	<?php
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	
?>

<br />

	
	<?php
	$columns = array('u.id','u.fname','u.mname','u.lname','u.gender');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';

	$conditions['=']['ug.groupid'] = $id;
	$conditions['AND =']['ug.iscore'] = 0;

	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['AND =']['ug.batchid'] = $selected_batch_id;
	$conditions['AND =']['g.entitytypetag'] = '@class';
	$conditions['AND =']['u.entitytypetag'] = '@student';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	?>
	<table width="100%"><tr>
	<?php
	$counter = 0;
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder =$sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
	
	$student_icon = ($resultset->gender=='M')?'user_male_white_blue_brown.png':'user_female_white_pink_brown.png';
	?>
	<td width="20%"><a class="sticky" href="<?php echo MainSystem::URLCreator('stage/showStudent/'.$id_placeholder.','.$id.'/'); ?>" rel="<?php echo MainSystem::URLCreator('stage/showStudentInfo/'.$id_placeholder.','.$id.','.$selected_batch_id.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.$student_icon; ?>" alt="<?php echo $name_placeholder; ?>" title="<?php echo $name_placeholder; ?>" /><br /><?php echo $name_placeholder; ?></a></td>
	<?php
	$counter++;
	if($counter>=5){
	$counter = 0;
	?>
	</tr>
	<tr>
	<?php
	}
	}
	?>
	</tr></table>
	<?php
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>



	<h3 class="headingh3">Subjects</h3>

	<?php
	$columns = array('id','subjectcode','name');
	$conditions = array();
	$conditions['=']['groupid'] = $id;
	if($selected_batch_id!=''){
	$conditions['AND()']['batchid'] = $selected_batch_id;
	}
	$conditions['OR =']['batchid'] = 0;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$subjectcode_placeholder = $sqlObj->getCleanData($resultset->subjectcode);

	$url='stage/showSubject/'.$id_placeholder.','.$id.'/';

	?>
	
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.'siya_subjects_icon.png'; ?>" alt="<?php echo $name_placeholder; ?>" title="<?php echo $name_placeholder; ?>" /><?php echo $name_placeholder.' ('.$subjectcode_placeholder.')'; ?></a>
	
	<?php 
		if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
		?>
		<a href="<?php echo MainSystem::URLCreator('subjects/editSubject/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_editblockcontent.png'; ?>" alt="Edit" title="Edit" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/deleteSubject/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_deleteblockcontent.png'; ?>" alt="Delete" title="Delete" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/changeSubjectStatus/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_inactive.png'; ?>" alt="Make this inactive" title="Make this inactive" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/moveSubject/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_moveupblock.png'; ?>" alt="Move this up" title="Move this up" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/moveSubject/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_movedownblock.png'; ?>" alt="Move this down" title="Move this down" /></a></p>
		<?php
		}
		?>
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	
?>
	<br /><h3 class="headingh3">Time Table</h3><br />
	<p><a href="<?php echo MainSystem::URLCreator('timetable/updateTimeTable/'.$id.','.$groupid_placeholder.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.'siya_time_table_icon.png'; ?>" alt="Update Time Table" title="Update Time Table" /> Update Time Table</a></p>
	<p><a href="<?php echo MainSystem::URLCreator('timetable/showTimeTable/'.$id.','.$groupid_placeholder.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.'siya_time_table_icon.png'; ?>" alt="Show Time Table" title="Show Time Table" /> Show Time Table</a></p>

	<br /><h3 class="headingh3">Mark Attendence for This Class</h3><br />

	<p><a href="<?php echo MainSystem::URLCreator('attendence/markAttendence/'.$id.','.$groupid_placeholder.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.'siya_attendence_icon.png'; ?>" alt="Mark Attendence" title="Mark Attendence" /> Mark Attendence</a></p>


<script type="text/javascript">
$(function() {
$('.sticky').cluetip({sticky: true, closePosition: 'title', arrows: true, cluetipClass: 'rounded'});
$('a.title').cluetip({splitTitle: '|'});
});
</script>