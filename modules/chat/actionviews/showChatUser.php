<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

<div id="chatusersdiv">
	<?php
	$columns = array('id','description','name','groupid','batchid','subjectid','topicid','userids');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'chat', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$chatid = $sqlObj->getCleanData($resultset->id);
	$name = $sqlObj->getCleanData($resultset->name);	
	$description = $sqlObj->getCleanData($resultset->description);
	$groupid = $sqlObj->getCleanData($resultset->groupid);
	$batchid = $sqlObj->getCleanData($resultset->batchid);
	$subjectid = $sqlObj->getCleanData($resultset->subjectid);
	$topicid = $sqlObj->getCleanData($resultset->topicid);
	$userids = $sqlObj->getCleanData($resultset->userids);
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		

	$columns = array('u.id','u.fname','u.mname','u.lname','u.entitytypetag');
	$conditions = array();

	$tables = array();
	if($userids==''){
	$tables['usersingroup'] = 'ug';
	}

	$tables['users'] = 'u';

	if($userids==''){
	$conditions['=']['ug.groupid'] = $groupid;
	$conditions['AND =']['ug.batchid'] = $batchid;
	$conditions['K AND =']['ug.userid'] = 'u.id';
	}else if($userids!=''){
	$conditions['IN ARR']['u.id'] = explode(',',$userids);
	}



	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, 'u.fname,u.mname,u.lname', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$fname_placeholder = $sqlObj->getCleanData($resultset->fname);
	$mname_placeholder = $sqlObj->getCleanData($resultset->mname);	
	$lname_placeholder = $sqlObj->getCleanData($resultset->lname);	
	$entitytypetag_placeholder = $sqlObj->getCleanData($resultset->entitytypetag);

	$chatstatus = 'OFFLINE';
	
	$columns2 = array('id','status');
	$conditions2 = array();
	$conditions2['=']['chatid'] = $id;
	$conditions2['AND =']['userid'] = $id_placeholder;
	$sql2 = $sqlObj->SQLCreator('S', 'usersinchat', $columns2, $conditions2, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ 
	if($resultset2 = $sqlObj->FetchResult($result2)){
	$chatstatus = $sqlObj->getCleanData($resultset2->status);
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}

	if($chatstatus=='IDLE'){
	$chatclass = 'button orange small';
	}else if($chatstatus=='OFFLINE'){
	$chatclass = 'button small';
	}else if($chatstatus=='ONLINE'){
	$chatclass = 'button green small';
	}else{
	$chatclass = 'button small';
	}

	
	?>
	
	<br /><p class="<?php echo $chatclass; ?>"><?php echo $fname_placeholder.' '.$mname_placeholder.' '.$lname_placeholder.' '.$entitytypetag_placeholder?> <?php echo $chatstatus; ?></p><br />
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


</div>


<script type="text/javascript">

$(document).ready(function(){
	
	//Load the file containing the chat log
	function getNewChatUsersStatus(){		

		$.ajax({
			url: "<?php echo MainSystem::URLCreator('chat/getNewChatUsersStatus/'.$id.'/'); ?>",
			cache: false,
			success: function(html){		
				$("#chatusersdiv").html(html);				
		  	},
		});
	}
	setInterval (getNewChatUsersStatus, 3000);	
	

});

</script>