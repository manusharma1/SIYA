<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //

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

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b>Are you sure you want to delete this Page : "<?php echo $page_name_placeholder; ?>" ? <br /> You cannot undo this action once confirmed. </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_page_url);?>';" value="Yes delete this Page"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('cms/managePages/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>