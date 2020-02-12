<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	
	MainSystem::CheckIDExists('content','id',$id,'cms/managePages/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('content','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$page_name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_page_url  = 'cms/deletePageConfirmed/'.$id.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="trclass">
<td width="100%" class="tdclass" align="center"><br /><b><?php echo $lang['siya']['cms']['ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_PAGE'];?> "<?php echo $page_name_placeholder; ?>" ? <br /><?php echo $lang['siya']['cms']['ACTION_CANNOT_UNDO'];?></b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_page_url);?>';" value="Yes delete this Page"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('cms/managePages/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>