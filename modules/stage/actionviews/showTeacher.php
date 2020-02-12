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
	$groupid = (isset($parameters[1]))?$parameters[1]:'';

	MainSystem::CheckGroupPermissions($groupid,'group');

	$id_placeholder = '';
	$fname_placeholder = '';
	$mname_placeholder = '';
	$lname_placeholder = '';
	$groupid_placeholder = '';
	$grouptypetag_placeholder = '';
	$name_placeholder = '';
	
	// Get Users Data
	
	$columns = array('id','fname','mname','lname');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$fname_placeholder = $sqlObj->getCleanData($resultset->fname);
	$mname_placeholder = $sqlObj->getCleanData($resultset->mname);
	$lname_placeholder = $sqlObj->getCleanData($resultset->lname);
	
	?>

	<h3 class="headingh3"><?php echo $fname_placeholder.' '.$mname_placeholder.' '.$lname_placeholder; ?></h3>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}

	

	$columns = array('g.id','g.grouptypetag','g.name');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';

	$conditions['=']['ug.userid'] = $id;
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['AND =']['g.entitytypetag'] = '@class';


	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
		
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$groupid_placeholder = $sqlObj->getCleanData($resultset->id);
	$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	?>

	<br /><p class="button green large"><?php echo $name_placeholder.' ('.$grouptypetag_placeholder.') '; ?></p><br /><br />
	<a class="headingh3" href="<?php echo MainSystem::URLCreator('teachersdiary/addTeachersDiary/'.$groupid.'/');?>">Add Teachers Diary</a><br />
	<a class="headingh3" href="<?php echo MainSystem::URLCreator('teachersdiary/manageTeachersDiary/'.$id_placeholder.'/'); ?>">Manage Teachers Diary</a><br />

	<a class="headingh3" href="<?php echo MainSystem::URLCreator('meetings/addMeeting/'.$id.'/');?>">Add Meeting</a><br />
	<a class="headingh3" href="<?php echo MainSystem::URLCreator('meetings/manageMeetings/'.$id_placeholder.'/'); ?>">Manage Meetings</a><br />

	<a class="headingh3" href="<?php echo MainSystem::URLCreator('meetings/showAllMeeting/');?>">Show All Meetings</a><br />

	<a class="headingh3" href="<?php echo MainSystem::URLCreator('remarks/addRemark/'.$id.'/');?>">Remarks</a>

	<?php

	}
	}else{
	
	?>
	
	<h2>No Class has been Allocated To Teacher, Please Allocate the Class</h2>
	<a href="<?php echo MainSystem::URLCreator('groups/addUserToGroup/'.$id.'/');?>">Add User To Group </a>
	<?php
	}
	}

?>