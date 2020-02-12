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
	
	
	$sid_placeholder = '';
	$gid_placeholder = '';
	$tid_placeholder = '';
	
	$subjectcode_placeholder = '';
	$name_placeholder = '';
	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

	$columns = array('id','subjectcode','name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$sid_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$subjectcode_placeholder = $sqlObj->getCleanData($resultset->subjectcode);
	$url='stage/showSubject/'.$sid_placeholder.'/';
	?>

	<h3 class="headingh3">Subject : <?php echo $name_placeholder.' ['.$subjectcode_placeholder.']'; ?></h3>

										
	<?php
	}
	}else{
	trigger_error('Data Fetch Error');
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>

	<?php
	$columns = array('g.id','g.grouptypetag','g.name');
	$conditions = array();

	$tables = array();
	$tables['subjects'] = 's';
	$tables['groups'] = 'g';

	$conditions['=']['s.id'] = $id;
	$conditions['K AND =']['s.groupid'] = 'g.id';
	
	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$gid_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
	$url='stage/showClass/'.$gid_placeholder.'/';
	
	MainSystem::CheckGroupPermissions($gid_placeholder,'group');

	?>
	
	<br /><a class="buttonsfortitles" href="<?php echo MainSystem::URLCreator($url); ?>">Class : <?php echo $grouptypetag_placeholder.' ['.$name_placeholder.']'; ?></a><br />
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}	
	?>


	<br /><p class="buttonsfortitles">Table of Contents</p><br />

	<?php
	
	$columns = array('c.id','c.chaptercode','c.name');
	$conditions = array();

	$tables = array();
	$tables['subjects'] = 's';
	$tables['chapters'] = 'c';

	$conditions['=']['s.id'] = $id;
	$conditions['K AND =']['s.id'] = 'c.subjectid';
	
	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$chapterid = $sqlObj->getCleanData($resultset->id);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$chaptercode_placeholder = $sqlObj->getCleanData($resultset->chaptercode);
	//$url='stage/showSubject/'.$id.'/';
	?>
	
	<br /><p class="buttonsfortitles2"><?php echo $chaptercode_placeholder.' ['.$name_placeholder.']'; ?>
	<?php 
		if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
		?>
		<a href="<?php echo MainSystem::URLCreator('subjects/editChapter/'.$chapterid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_editblockcontent.png'; ?>" alt="Edit" title="Edit" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/deleteChapter/'.$chapterid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_deleteblockcontent.png'; ?>" alt="Delete" title="Delete" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/changeChapterStatus/'.$chapterid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_inactive.png'; ?>" alt="Make this inactive" title="Make this inactive" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/moveChapter/'.$chapterid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_moveupblock.png'; ?>" alt="Move this up" title="Move this up" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/moveChapter/'.$chapterid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_movedownblock.png'; ?>" alt="Move this down" title="Move this down" /></a></p>
		<?php
		}
		?>
	</p><br />



	<?php
	$columns2 = array('id','topiccode','name','description');
	$conditions2 = array();
	$conditions2['=']['chapterid'] = $chapterid;
	$sql2 = $sqlObj->SQLCreator('S', 'topics', $columns2, $conditions2, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ 
	while($resultset2 = $sqlObj->FetchResult($result2)){
	$topicid = $sqlObj->getCleanData($resultset2->id);
	$topicname_placeholder = $sqlObj->getCleanData($resultset2->name);	
	$topiccode_placeholder = $sqlObj->getCleanData($resultset2->topiccode);
	$url2='stage/showTopic/'.$topicid.'/';
	?>

	<a href="<?php echo MainSystem::URLCreator($url2); ?>" class="buttonsfortitles3"><?php echo $topicname_placeholder.' ['.$topiccode_placeholder.']'; ?></a>
	<?php 
		if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
		?>
		<a href="<?php echo MainSystem::URLCreator('subjects/editTopic/'.$topicid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_editblockcontent.png'; ?>" alt="Edit" title="Edit" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/deleteTopic/'.$topicid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_deleteblockcontent.png'; ?>" alt="Delete" title="Delete" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/changeTopicStatus/'.$topicid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_inactive.png'; ?>" alt="Make this inactive" title="Make this inactive" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/moveTopic/'.$topicid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_moveupblock.png'; ?>" alt="Move this up" title="Move this up" /></a>
		<a href="<?php echo MainSystem::URLCreator('subjects/moveTopic/'.$topicid.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_movedownblock.png'; ?>" alt="Move this down" title="Move this down" /></a>
		<?php
		}
		?>
		<br />								
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>

	
	<a class="button1" href="<?php echo MainSystem::URLCreator('subjects/addNewTopic/'.$chapterid.'/');?>">Add New Topic</a>
	
	<hr />


	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}	
	
	?>

	<br /><br />

	<h3 class="headingh3">Need New Chapter?</h3><br />

	<form id="addform2" name="addform2" method="get" action="<?php echo MainSystem::URLCreator('subjects/addNewChapter/'.$id.','.$groupid.'/');?>">

	<fieldset>
	<button type="submit"> Add New Chapter</button>
	</fieldset>

	</form>