<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	
	MainSystem::CheckIDExists('grades','id',$id,'assessments/manageGrade/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('grades','addedby',$resultset->id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'))
	}

	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('grade','gradepoint');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'grades', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	$name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->grade).' '.$sqlObj->getCleanData($resultsetpagecontents->gradepoint);
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'assessments/deleteGradeConfirmed/'.$id.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="trclass">
<td width="100%" class="tdclass" align="center"><br /><b><?php echo $lang['siya']['assessments']['ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_GRADE'];?>"<?php echo $name_placeholder; ?>" ? <br /> <?php echo $lang['siya']['assessments']['YOU_CANNOT_UNDO_THIS_ACTION_ONCE_CONFIRMED.'];?> </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="<?php echo $lang['siya']['assessments']['YES_DELETE_THIS_GRADE'];?>"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('assessments/manageGrade/');?>';" value="Cancel"> <br /><br /></td>
</tr>
</table>