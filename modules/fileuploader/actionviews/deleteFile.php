<?php
	$id = _ACTION_VIEW_PARAMETER_ID; // Page ID //
	$_SESSION['deleteconfirmed'] = $id;
	// Define Placeholders
	$page_name_placeholder = '';

	// Get Page Info
	$columns = array('filename','filedescription','filelocationid');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlfilecontents = $sqlObj->SQLCreator('S', 'fileupload', $columns, $conditions, '', '', '');
	if($resultfilecontents = $sqlObj->FireSQL($sqlfilecontents)){
	if($sqlObj->getNumRows($resultfilecontents) !=0){ // If file Exists
	if($resultsetfilecontents = $sqlObj->FetchResult($resultfilecontents)){
	$file_name_placeholder = $sqlObj->getCleanData($resultsetfilecontents->filename);
	$file_description_placeholder = $sqlObj->getCleanData($resultsetfilecontents->filedescription);
	$filelocationid = $resultsetfilecontents->filelocationid;
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorfile/2/')); // Content Not Found error
	}
	}

	
	switch($filelocationid){
	case 1:
	$foldername = 'imageslider';
	break;

	case 2:
	$foldername = 'pictures';
	break;
	
	case 3:
	$foldername = 'videos';
	break;
	
	case 4:
	$foldername = 'website';
	break;
	}

	$path = PROJ_DATA_DIR._S.$foldername;

	$delete_file_url  = 'fileuploader/deleteFileConfirmed/'.$id.'/';

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center"><br /><b>Are you sure you want to delete this File : "<?php echo $file_name_placeholder; ?>" ? Having the Description : <?php echo $file_description_placeholder; ?> <br /> You cannot undo this action once confirmed. </b> <br /><br /> <form id="deletefile" name="deletefile" method="post" action="<?php echo MainSystem::URLCreator('fileuploader/deleteFileConfirmed/'.$id.'/') ?>"><input type="hidden" name="path" value="<?php echo $path; ?>" /><input type="hidden" name="filename" value="<?php echo $file_name_placeholder; ?>" /><input type="Submit" name="Submit" value="Yes delete this File"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('fileuploader/manageFiles/');?>';" value="Cancel">
</form> <br /><br /></td>
</tr>
</table>