<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('teachersdiary','id',$id,'teachersdiary/manageTeachersDiary/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('teachersdiary','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('userid','day');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'teachersdiary', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = 'user id is : '.$sqlObj->getCleanData($resultsetpagecontents->userid).' day is :'.$sqlObj->getCleanData($resultsetpagecontents->day);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'teachersdiary/deleteTeachersDiaryConfirmed/'.$id.'/';

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b>Are you sure you want to delete this Teachers Diary : "<?php echo $name_placeholder; ?>" ? <br /> You cannot undo this action once confirmed. </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="Yes delete this Teachers Diary"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('teachersdiary/manageTeachersDiary/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>