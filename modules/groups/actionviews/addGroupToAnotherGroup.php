<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	MainSystem::CheckGroupPermissions($id,'group');
	
	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
?>

	<script>
	$(document).ready(function(){
	$("#addgrouptoanothergroupform").validate();
	});
	</script>
	
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('groups/saveGroupToAnotherGroup/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('groups/saveGroupToAnotherGroup/');
	}
	?>

	<form id="addgrouptoanothergroupform" name="addgrouptoanothergroupform" method="post" action="<?php echo $formaction; ?>">
	
	<fieldset>
	<legend><?php echo $lang['siya']['groups']['ADD_GROUP_TO_ANOTHER_GROUP'];?></legend>	
	<ol>
	<?php
	$columns = array('ug.userid','ug.rollno','u.fname','u.mname','u.lname');

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['users'] = 'u';

	$conditions = array();
	$conditions['=']['ug.groupid'] = $id;
	$conditions['K AND =']['u.id'] = 'ug.userid';
	$conditions['AND =']['ug.isactive'] = '1';
	$conditions['AND =']['ug.iscore'] = '1';

	$conditions['AND =']['ug.batchid'] = $selected_batch_id; 
	
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
	$i=0;
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	while($resultset = $sqlObj->FetchResult($result)){
	$i++;
	?>
	<li><label for="rollno<?php echo $i; ?>">Roll No.</label><input type="text" name="userid[<?php echo $resultset->userid; ?>]" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" value="<?php echo $resultset->rollno; ?>" size="5"/> <?php echo $resultset->fname.' '.$resultset->mname.' '.$resultset->lname; ?> 
	</li>
	<?php
	}
	}
	}


	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'groupid';
	$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	$sqlObj = new MainSQL();
	$columns = array('id','grouptypetag','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND =']['entitytypetag']  = '@class';
	$conditions['AND !=']['id']  = $id;
	$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
	if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
	if($sqlObj->getNumRows($resultmenu)!=0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
	$htmlarray[]['option']['end'] = '';
	}
	}
	}

	$htmlarray[]['select']['end'] = '';
	$groupid = $HTMLObj->HTMLCreator($htmlarray);


		
	$HTMLObj = new MainHTML();
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'batchid';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	$columns = array('id','batchcode','title');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND !=']['id']  = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultset->id;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
	$htmlarray[]['option']['end'] = '';

	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}


	$htmlarray[]['select']['end'] = '';
	$selected_batchid = $HTMLObj->HTMLCreator($htmlarray);

	

	if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	}
	?>


	
		<li>
		<label for="groupid"><?php echo $lang['siya']['groups']['GROUP'];?></label><?php echo $groupid; ?>
	    </li>
		
		<li>
		<label for="batchid"><?php echo $lang['siya']['groups']['BATCH'];?></label><?php echo $selected_batchid; ?> 
	    </li>
		

	</fieldset>


	</ol>
	
	<fieldset>
	<button type="submit"><?php echo $lang['siya']['groups']['SAVE'];?></button>
	</fieldset>

	</form>