<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('blocktitle','blockposition');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'blocksinstances', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->blocktitle).' Position is :'.$sqlObj->getCleanData($resultsetpagecontents->blockposition);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'blocksadministration/deleteBlockConfirmed/'.$id.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="trclass">
<td width="100%" class="tdclass" align="center"><br /><b><?php echo $lang['siya']['blocksadministration']['ARE_YOU_SURE_TO_DELETE'];?> "<?php echo $name_placeholder; ?>" ? <br /> <?php echo $lang['siya']['blocksadministration']['YOU_CANNOT_UNDO'];?></b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="Yes delete this Block"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('blocksadministration/manageBlocks/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>