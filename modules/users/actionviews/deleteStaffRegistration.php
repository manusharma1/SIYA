<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('users','id',$id,'users/manageStaff/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('users','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('fname','mname','lname');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->fname).' '.$sqlObj->getCleanData($resultsetpagecontents->mname).' '.$sqlObj->getCleanData($resultsetpagecontents->lname);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'users/deleteStaffRegistrationConfirmed/'.$id.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="trclass">
<td width="100%" class="tdclass" align="center"><br /><b>Are you sure you want to delete this Staff : "<?php echo $name_placeholder; ?>" ? <br /> You cannot undo this action once confirmed. </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="Yes delete this Staff"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('users/manageStaff/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>