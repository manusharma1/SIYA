<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('forums','id',$id,'forums/showForum/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('forums','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('name','description');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'forums', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name).' '.$sqlObj->getCleanData($resultsetpagecontents->description);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'forums/deleteForumConfirmed/'.$id.'/';

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b>Are you sure you want to delete this Forum : "<?php echo $name_placeholder; ?>" ? <br /> You cannot undo this action once Forum. </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="Yes delete this Forum"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('stage/showSubject/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>