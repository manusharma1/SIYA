<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>


<?php

	$id = _ACTION_VIEW_PARAMETER_ID;

	$userdetails = MainSystem::getUserDetailsByID($id);

	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('groups/saveUserToGroup/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('groups/saveUserToGroup/');
	}



	$HTMLObj = new MainHTML();
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'batchid';
	$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';


	$columns = array('batchid');
	$conditions = array();
	$conditions['=']['userid'] = $id;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('SD', 'usersingroup', $columns, $conditions, '', '', '');


	$columns = array('b.id','b.batchcode','b.title');

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['batches'] = 'b';

	$conditions = array();
	$conditions['!INCON']['b.id']  = $sql;

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('SD', $tables, $columns, $conditions, '', '', '');


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
	$menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);

	?>
	
	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

	<fieldset>
	<legend><?php echo $lang['siya']['groups']['ADD_USER_TO_GROUP'];?></legend>	
	<ol>
	<li>
	<label for="username"><?php echo $lang['siya']['groups']['USER_NAME'];?></label> <?php echo $userdetails->fname.' '.$userdetails->mname.' '.$userdetails->lname; ?>
	</li>
	</ol>

	<?php
	
	$id = _ACTION_VIEW_PARAMETER_ID;
	$id_placeholder = '';
	$grouptypetag_placeholder = '';
	$name_placeholder = '';
	$i=1;
	
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
	$i++;	
	
	
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

	?>

	<ol>
	<li>
	<label for="groupid"><?php echo $lang['siya']['groups']['GROUP'];?></label><?php echo $group_placeholder; ?> 
	</li>
	</ol>

	<ol>
	<li>
	<label for="groupid"><?php echo $lang['siya']['groups']['BATCH'];?></label><?php echo $menu_placeholder; ?> 
	</li>
	</ol>
		
	<fieldset>
	<button type="submit"><?php echo $lang['siya']['groups']['SAVE'];?></button>
	</fieldset>

	<input name="userid" type="hidden" value="<?php echo $id; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />

	</form>