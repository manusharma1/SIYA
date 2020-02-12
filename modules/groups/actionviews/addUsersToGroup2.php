<?php

	$usersingrouparray = (isset($_POST['usersingroup']))?$_POST['usersingroup']:array();
	$usersnotingrouparray = (isset($_POST['usersnotingroup']))?$_POST['usersnotingroup']:array();
	$usersnotingroup = implode(',',$usersnotingrouparray);
	$groupid = $_POST['groupid'];
	$batchid = $_POST['batchid'];
	$fullname = '';
	$rollno = '';

?>


	<script>
	$(document).ready(function(){
	$("#adduserstogroup2form").validate();
	});
	</script>
	
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('groups/saveUsersToGroup/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('groups/saveUsersToGroup/');
	}
	?>

	<form id="adduserstogroup2form" name="adduserstogroup2form" method="post" action="<?php echo $formaction; ?>">
	
	<fieldset>
	<legend><?php echo $lang['siya']['groups']['ADD_GROUP_TO_ANOTHER_GROUP'];?></legend>	
	<ol>
	<?php
	foreach($usersingrouparray as $key => $value){

	$fullname = '';
	$rollno = '';


	$columns = array('fname','mname','lname','entitytypetag');

	$conditions = array();
	$conditions['=']['id'] = $value;
 	
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	$i=0;
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$i++;
	$fullname = $resultset->fname.' '.$resultset->mname.' '.$resultset->lname;
	$entitytypetag = $resultset->entitytypetag;
	}
	}
	}

	
	if($entitytypetag == '@student'){

	$columns = array('rollno');

	$conditions = array();
	$conditions['=']['userid'] = $value;
	$conditions['AND =']['batchid'] = $batchid;
	$conditions['AND =']['groupid'] = $groupid;

 	
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'usersingroup', $columns, $conditions, '', '', '');
	$i=0;
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$rollno = $resultset->rollno;
	}
	}
	}
	
	}
	?>
	<li>


	<label for="rollno<?php echo $i; ?>">Roll No.</label><input type="text" name="usersingrouprollno[<?php echo $value; ?>]" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" size="5" value="<?php echo $rollno; ?>" <?php echo ($entitytypetag != '@student')?'readonly':''?>/> 
	
	<?php echo $fullname .' ('.$entitytypetag.')'; ?> 
	</li>
	<?php

	
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
	$sql = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	while($resultset = $sqlObj->FetchResult($result)){
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
	($resultset->id == $groupid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->grouptypetag).' ('.$sqlObj->getCleanData($resultset->name).')';
	$htmlarray[]['option']['end'] = '';
	}
	}
	}

	$htmlarray[]['select']['end'] = '';
	$selected_groupid = $HTMLObj->HTMLCreator($htmlarray);


		
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
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultset->id;
	($resultset->id == $batchid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
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
		<label for="groupid"><?php echo $lang['siya']['groups']['GROUP'];?></label><?php echo $selected_groupid; ?>
	    </li>
		
		<li>
		<label for="batchid"><?php echo $lang['siya']['groups']['BATCH'];?></label><?php echo $selected_batchid; ?> 
	    </li>
		

	</fieldset>


	</ol>
	
	<fieldset>
	<button type="submit"><?php echo $lang['siya']['groups']['SAVE'];?></button>
	</fieldset>
	
	<input type="hidden" name="usersnotingroup" value="<?php echo $usersnotingroup; ?>">

	</form>