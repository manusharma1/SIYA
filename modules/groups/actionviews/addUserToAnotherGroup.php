<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>


<?php

	$id = _ACTION_VIEW_PARAMETER_ID;

	$userdetails = MainSystem::getUserDetailsByID($id);
	$batch_placeholder = '';
	$grouptypetag_placeholder = '';
	$name_placeholder = '';
	$username_placeholder = $userdetails->fname.' '.$userdetails->mname.' '.$userdetails->lname;
	$i=1;

	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('groups/saveUserToAnotherGroup/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('groups/saveUserToAnotherGroup/');
	}



	$HTMLObj = new MainHTML();
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'batchid';
	$htmlarray[]['select']['onChange'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	$columns = array('id','batchcode','title');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultset->id;
	($resultset->id == $id)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
	$htmlarray[]['option']['end'] = '';

	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}


	$htmlarray[]['select']['end'] = '';
	$batch_placeholder = $HTMLObj->HTMLCreator($htmlarray);
	
	// Get Users Data


	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'groupid';
	$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';



	$columns = array('groupid');
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('SD', 'usersingroup', $columns, $conditions, '', '', '');


	$columns = array('g.id','g.grouptypetag','g.name');

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';

	$conditions = array();
	$conditions['!INCON']['g.id']  = $sql;
	$conditions['AND =']['g.entitytypetag'] = '@class';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('SD', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultset->id;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->name).' ('.$sqlObj->getCleanData($resultset->grouptypetag).')';
	$htmlarray[]['option']['end'] = '';

	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}

	$htmlarray[]['select']['end'] = '';
	$group_placeholder = $HTMLObj->HTMLCreator($htmlarray);



	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'usertypetag';
	$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	$sqlObj = new MainSQL();
	$columns = array('id','usertypetag','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND !=']['usertypetag'] = '#admin';

	$sqlmenu = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
	if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
	if($sqlObj->getNumRows($resultmenu)!=0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->usertypetag);
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->usertypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
	$htmlarray[]['option']['end'] = '';
	}
	}
	}

	$htmlarray[]['select']['end'] = '';
	$usertypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);

	?>


	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

	<fieldset>
	<legend><?php echo $lang['siya']['groups']['ADD_USER_TO_ANOTHER_GROUP'];?></legend>	
	<ol>
	<li>
	<label for="username"><?php echo $lang['siya']['groups']['USER_NAME'];?></label> <?php echo $username_placeholder; ?>
	</li>

	

	<li>
	<label for="groupid"><?php echo $lang['siya']['groups']['GROUP'];?></label><?php echo $group_placeholder; ?> 
	</li>

	
	
	<li>
	<label for="groupid"><?php echo $lang['siya']['groups']['BATCH'];?></label><?php echo $batch_placeholder; ?> 
	</li>



	<li>
	<label for="groupid"><?php echo $lang['siya']['groups']['USERS_TYPE'];?><br /><?php echo $lang['siya']['groups']['BE_CAREFULL'];?></label><br /><?php echo $usertypetag_placeholder; ?> 
	</li>
	
	</ol>
   
   </fieldset>

		
	<fieldset>
	<button type="submit"><?php echo $lang['siya']['groups']['SAVE'];?></button>
	</fieldset>

	<input name="userid" type="hidden" value="<?php echo $id; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />

	</form>