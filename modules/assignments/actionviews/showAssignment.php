<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	$groupid = (isset($parameters[1]))?$parameters[1]:'';
	MainSystem::CheckGroupPermissions($groupid,'group');
?>

<p class="buttonsfortitles">Assignment Details</p><br /><br />

	<?php
	$columns = array('id','description','name','startdate','enddate');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'assignments', $columns, $conditions, '', '', '');
	$count = 0;
	
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$description_placeholder = $sqlObj->getCleanData($resultset->description);
	$startdate_placeholder = $sqlObj->getCleanData($resultset->startdate);	
	$enddate_placeholder = $sqlObj->getCleanData($resultset->enddate);
	$url='assignments/showAssignment/'.$id.'/';
	?>
	
	<p class="buttonsfortitles"><?php echo $name_placeholder; ?></p><br /><br />
	<p><?php echo $description_placeholder; ?></p><br />
	<p class="buttonsfortitles5">Start Date: <?php echo $startdate_placeholder; ?></p> <br />
	<p class="buttonsfortitles5">End Date: <?php echo $enddate_placeholder; ?></p><br />
										
	<?php
	
	$columns2 = array('id','description','addedby','modifiedby');
	$conditions2 = array();

	$conditions2['=']['replyid'] = $resultset->id;

	$sql2 = $sqlObj->SQLCreator('S', 'assignments', $columns2, $conditions2, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ 
	while($resultset2 = $sqlObj->FetchResult($result2)){
	$count++;
	$reply_description_placeholder = $sqlObj->getCleanData($resultset2->description);
	$added_user_details = MainSystem::getUserDetailsByID($resultset2->addedby);
	?>
	<p class="buttonsfortitles51"><?php echo '#'.$count; ?> <?php echo $added_user_details->fname.' '.$added_user_details->mname.' '.$added_user_details->lname; ?>
	
	<?php
	$returnarraymanageccess = MainSystem::CheckModuleActionAccess('admin','assignments','editReplyAssignment');
	if($returnarraymanageccess['noerror'] == 1 && MainSystem::CheckOtherUsersActionAccess('assignments','addedby',$resultset2->id)=='OK'){
	?>
	<a href="<?php echo MainSystem::URLCreator('assignments/editReplyAssignment/'.$resultset2->id.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_editblockcontent.png'; ?>" alt="Edit" title="Edit" /></a>
	<?php
	}
	?>

	<?php
	$returnarraymanageccess = MainSystem::CheckModuleActionAccess('admin','assignments','deleteReplyAssignment');
	if($returnarraymanageccess['noerror'] == 1 && MainSystem::CheckOtherUsersActionAccess('assignments','addedby',$resultset2->id)=='OK'){
	?>

	<a href="<?php echo MainSystem::URLCreator('assignments/deleteReplyAssignment/'.$resultset2->id.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_deleteblockcontent.png'; ?>" alt="Delete" title="Delete" /></a></p>
	<?php
	}
	?>
	
	</p>
	<p><?php echo $reply_description_placeholder; ?></p><br />
	<?php
	
	$columns3 = array('id','filename');
	$conditions3 = array();
	$conditions3['=']['assignmentid'] = $resultset2->id;
	$sql3 = $sqlObj->SQLCreator('S', 'assignmentuploads', $columns3, $conditions3, '', '', '');
	if($result3 = $sqlObj->FireSQL($sql3)){
	if($sqlObj->getNumRows($result3) !=0){ 
	while($resultset3 = $sqlObj->FetchResult($result3)){
	$applicationiconfile = topiccontents::returnApplicationIcons($resultset3->filename);
	$filemimetype = MainSystem::returnMIMEType($resultset3->filename);
	$filemimetypearray = explode('/',$filemimetype);
	
	if($filemimetypearray[0]=='video' || $filemimetypearray[0]=='audio'){
	$file_open_url = 'assignments/openAssignmentContentVideo/'.$resultset2->id.'/';
	}else{
	$file_open_url = 'assignments/openAssignmentContentDoc/'.$resultset2->id.'/';
	}
	
	?>
	<a href="#"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'topiccontents'._WS.'images'._WS.$applicationiconfile; ?>" /></a>

	<br /><a class="buttonsfortopiccontents" href="<?php echo MainSystem::URLCreator($file_open_url); ?>">Open</a> <a class="buttonsfortopiccontents" href="<?php echo MainSystem::URLCreator('topiccontents/downloadTopicContentFile/'.$resultset2->id.'/'); ?>">Download</a><br /><br />
	
	<br /><br />
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}
	?>
	<hr />
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}
	
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('assignments/replyAssignment/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('assignments/replyAssignment/');
	}
	?>

	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

		<fieldset>

		<ol>
			<input type="hidden" name="replyby" value="<?php echo MainSystem::GetSessionUserID(); ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
			<input type="hidden" name="replyid" value="<?php echo $id; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
			<input type="hidden" name="groupid" value="<?php echo $groupid; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>

		</ol>
		
		</fieldset>
		
		<fieldset>
		
		<button type="submit"><?php echo $lang['siya']['assignments']['REPLY_TO_ASSIGNMENT'];?></button>

		</fieldset>

	</form>	