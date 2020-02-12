<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
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

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b>Are you sure you want to delete this Menu : "<?php echo $menu_name_placeholder; ?>" ? <br /> IMPORTANT : This action will also delete all Sub-Menus under this Menu, This will also unlink any Page linked with this menu.<br />You cannot undo this action once confirmed. </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_menu_url);?>';" value="Yes delete this Menu"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('cms/manageMenus');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>