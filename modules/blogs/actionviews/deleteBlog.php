<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('blogs','id',$id,'blogs/manageBlog/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('blogs','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('userid','title');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = 'user id is : '.$sqlObj->getCleanData($resultsetpagecontents->userid).' Title is :'.$sqlObj->getCleanData($resultsetpagecontents->title);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'blogs/deleteBlogConfirmed/'.$id.'/';

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b><?php echo $lang['siya']['blogs']['ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_BLOG'];?>"<?php echo $name_placeholder; ?>" ? <br /> <?php echo $lang['siya']['blogs']['YOU_CANNOT_UNDO_THIS_ACTION_ONCE_CONFIRMED'];?> </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="<?php echo $lang['siya']['blogs']['YES_DELETE_THIS_BLOG'];?> "> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('blogs/manageBlog/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>