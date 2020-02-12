<?php
	$parameters = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('tests','id',$id,'admin/getAdminHome/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('tests','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	
	$ids=explode(',',$parameters);
	
	$id = $ids[0];
	$topicid = $ids[1];
	
	
	$page_name_placeholder = '';


	$columns = array('name','description');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'tests', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name).' '.$sqlObj->getCleanData($resultsetpagecontents->description);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'tests/deleteTestConfirmed/'.$id.','.$topicid.'/';
	$cancel_url  = 'stage/showTopic/'.$topicid.'/';

?>

<table width="100%" class="tableclass"  align="center">
<tr class="trclass" >
<td width="100%" class="tdclass"  align="center"><br /><b>Are you sure you want to delete this test : "<?php echo $name_placeholder; ?>" ? <br /> You cannot undo this action once confirmed. </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="Yes delete this Test"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($cancel_url);?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>