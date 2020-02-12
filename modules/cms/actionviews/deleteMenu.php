<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	
	MainSystem::CheckIDExists('menu','id',$id,'cms/manageMenus/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('menu','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	
	// define placeholders
	
	$menu_name_placeholder = '';

	// Get Menu Info
	$columns = array('name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'menu', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$menu_name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_menu_url  = 'cms/deleteMenuConfirmed/'.$id.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="trclass">
<td width="100%" class="tdclass" align="center"><br /><b><?php echo $lang['siya']['cms']['ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_MENU'];?> "<?php echo $menu_name_placeholder; ?>" <br /> <?php echo $lang['siya']['cms']['THIS_WILL_ALSO_DELETE_SUBMENU'];?><br /><?php echo $lang['siya']['cms']['ACTION_CANNOT_UNDO'];?></b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_menu_url);?>';" value="Yes delete this Menu"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('cms/manageMenus/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>