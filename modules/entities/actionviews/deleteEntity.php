<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('entities','id',$id,'entities/manageEntities/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('entities','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('entityname','entitydescription');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'entities', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->entityname).' '.$sqlObj->getCleanData($resultsetpagecontents->entitydescription);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'entities/deleteEntityConfirmed/'.$id.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="tableclass">
<td width="100%" class="tdclass" align="center"><br /><b><?php echo$lang['siya']['entities']['SURE_TO_DELETE'];?>"<?php echo $name_placeholder; ?>" ? <br /> <?php echo$lang['siya']['entities']['CANT_UNDO_ACTION'];?> </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="Yes delete this Entity"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('entities/manageEntities/');?>';" value="<?php echo $lang['siya']['entities']['CANCEL'];?>"> <br /><br /></td>
</tr>
</table>