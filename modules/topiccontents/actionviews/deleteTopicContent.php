<?php
	$parameters = _ACTION_VIEW_PARAMETER_ID; 
	
	MainSystem::CheckIDExists('topiccontentsuploads','id',$id,'admin/getAdminHome/');
	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('topiccontentsuploads','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	
	$ids = explode(',',$parameters);
	$id = $ids[0];
	$topicid = $ids[1];
	$_SESSION['deleteconfirmed'] = $id;
	
	$filename = '';

	$title = '';

	$columns = array('title','filename');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'topiccontentsuploads', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$title = $sqlObj->getCleanData($resultsetpagecontents->title);
	$filename = $sqlObj->getCleanData($resultsetpagecontents->filename);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_file_url  = 'topiccontents/deleteTopicContentConfirmed/'.$topicid.'/';
	$cancel_file_url  = 'stage/showTopic/'.$topicid.'/';

?>

<table width="100%" border="0"  align="center">
<tr>
<td width="100%" align="center"><br /><b>Are you sure you want to delete this Content &amp; File : "<?php echo $title.' &amp; '.$filename; ?>" ?  <br /> You cannot undo this action once confirmed. </b> <br /><br /> <form id="deletefile" name="deletefile" method="post" action="<?php echo MainSystem::URLCreator($delete_file_url) ?>"><input type="Submit" name="Submit" value="Yes delete this File"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($cancel_file_url);?>';" value="Cancel">
</form> <br /><br /></td>
</tr>
</table>