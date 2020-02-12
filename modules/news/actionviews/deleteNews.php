<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('news','id',$id,'news/manageNews/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('news','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('id','newstitle');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'news', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = 'news id is : '.$sqlObj->getCleanData($resultsetpagecontents->id).'News Title is :'.$sqlObj->getCleanData($resultsetpagecontents->newstitle);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'news/deleteNewsConfirmed/'.$id.'/';

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b><?php echo $lang['siya']['news']['ARE_YOU_SURE_TO_DELETE'];?>"<?php echo $name_placeholder; ?>" ? <br /> <?php echo $lang['siya']['news']['YOU_CANNOT_UNDO'];?> </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="<?php echo $lang['siya']['news']['ARE_YOU_SURE_TO_DELETE'];?> "> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('news/manageBlog/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>