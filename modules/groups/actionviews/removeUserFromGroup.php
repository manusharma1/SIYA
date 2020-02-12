<?php
	$ids = _ACTION_VIEW_PARAMETER_ID;
	
	MainSystem::CheckIDExists('usersingroup','id',$id,'groups/manageGroups/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('usersingroup','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	
	$idsarray = explode(',',$ids);
	
	$userid = $idsarray[0];
	$groupid = $idsarray[1];
	$batchid = $idsarray[2];

	
	$columns = array('u.id','u.fname','u.mname','u.lname','g.grouptypetag','g.name','b.batchcode','b.title');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';
	$tables['batches'] = 'b';

	$conditions['=']['ug.userid'] = $userid;
	$conditions['AND =']['ug.groupid'] = $groupid;
	$conditions['AND =']['ug.batchid'] = $batchid;

	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['K AND =']['ug.batchid'] = 'b.id';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$username_placeholder = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);

	$batchname_placeholder = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).' )';

	$groupname_placeholder = $sqlObj->getCleanData($resultset->name).' ('.$sqlObj->getCleanData($resultset->grouptypetag).' )';
	}
	}else{
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/errorPage/2/')); // Content Not Found error
	}
	}

	$delete_url  = 'groups/removeUserFromGroupConfirmed/'.$userid.','.$groupid.','.$batchid.'/';

?>

<table width="100%" class="tableclass" align="center">
<tr class="trclass">
<td width="100%" class="tdclass" align="center"><br /><b><?php echo $lang['siya']['groups']['ARE_YOU_SURE_YOU_WANT_TO_DELETE'];?> : "<?php echo $username_placeholder; ?>" <?php echo $lang['siya']['groups']['FROM_GROUP'];?> : "<?php echo $groupname_placeholder; ?>" <?php echo $lang['siya']['groups']['AND_BATCH'];?> "<?php echo $batchname_placeholder; ?>" ? <br /><?php echo $lang['siya']['groups']['YOU_CAN_T_UNDO'];?>
 </b> <br /><br /> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($delete_url);?>';" value="<?php echo $lang['siya']['groups']['DELETE_THIS_GROUP'];?>"> <input type="button" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator('stage/showClass/'.$groupid.'/');?>';" value="<?php echo $lang['siya']['groups']['CANCEL'];?>"> <br /><br /></td>
</tr>
</table>