<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('additionalsettings','id',$id,'admin/getAdminHome/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('additionalsettings','addedby',$resultset->id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'))
	}
	
	$_SESSION['deleteconfirmed'] = $id;
	// Define Placeholders
	$additionalsetting_name_placeholder = '';

	// Get Page Info
	$columns = array('name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'additionalsettings', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If file Exists
	if($resultset = $sqlObj->FetchResult($result)){
	$additionalsetting_name_placeholder = $sqlObj->getCleanData($resultset->name);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorfile/2/')); // Content Not Found error
	}
	}

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b>Are you sure you want to delete this Additional Setting : "<?php echo $additionalsetting_name_placeholder; ?>" ? <br /> You cannot undo this action once confirmed. </b> <br /><br /> <form id="deletefile" name="deletefile" method="post" action="<?php echo MainSystem::URLCreator('additionalsettings/deleteAdditionalSettingConfirmed/'.$id.'/') ?>"><input type="Submit" name="Submit" value="Yes delete this Additional Setting"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('additionalsettings/manageAdditionalSettings/');?>';" value="Cancel">
</form> <br /><br /></td>
</tr>
</table>