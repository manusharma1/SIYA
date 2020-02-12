<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	

	MainSystem::CheckIDExists('meetingtypes','id',$id,'meetings/manageMeetingTypes/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('meetingtypes','addedby',$id);
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
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'meetingtypes', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name).' '.$sqlObj->getCleanData($resultsetpagecontents->description);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'meetings/deleteMeetingTypeConfirmed/'.$id.'/';

?>

<table width="100%"  class="tableclass"  align="center">
<tr  class="trclass">
<td width="100%"  class="tdclass" align="center"><br /><b>Are you sure you want to delete this Meeting Types : "<?php echo $name_placeholder; ?>" ? <br /> You cannot undo this action once confirmed. </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="Yes delete this Meeting Types"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('meetings/manageMeetingTypes/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>