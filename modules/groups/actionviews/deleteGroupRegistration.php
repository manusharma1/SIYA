<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('groups','id',$id,'groups/manageGroups/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('groups','addedby',$id);
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
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name).' '.$sqlObj->getCleanData($resultsetpagecontents->description);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'groups/deleteGroupRegistrationConfirmed/'.$id.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="trclass">
<td width="100%" class="tdclass" align="center"><br /><b><?php echo $lang['siya']['groups']['ARE_YOU_SURE_YOU_WANT_TO_DELETE'];?> "<?php echo $name_placeholder; ?>" ? <br /> <?php echo $lang['siya']['groups']['YOU_CAN_T_UNDO'];?> </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="<?php echo $lang['siya']['groups']['DELETE_THIS_GROUP'];?>"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('groups/manageGroups/');?>';" value="<?php echo $lang['siya']['groups']['CANCEL'];?>"> <br /><br /></td>
</tr>
</table>