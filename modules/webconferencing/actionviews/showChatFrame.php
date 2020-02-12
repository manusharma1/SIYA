<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

<h3>Users Detail</h3>

	<?php
	
	$columns = array('u.id','u.fname','u.mname','u.lname','u.entitytypetag','u.isonline');
	$conditions = array();

	$tables = array();
	$tables['topics'] = 't';
	$tables['subjects'] = 's';
	$tables['usersingroup'] = 'ug';
	$tables['users'] = 'u';

	$conditions['=']['t.id'] = $id;
	$conditions['K AND =']['t.subjectid'] = 's.id';
	$conditions['K AND =']['s.groupid'] = 'ug.groupid';
	$conditions['K AND =']['ug.userid'] = 'u.id';


	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$fname_placeholder = $sqlObj->getCleanData($resultset->fname);
	$mname_placeholder = $sqlObj->getCleanData($resultset->mname);	
	$lname_placeholder = $sqlObj->getCleanData($resultset->lname);	
	$entitytypetag_placeholder = $sqlObj->getCleanData($resultset->entitytypetag);
	$isonline_placeholder = $sqlObj->getCleanData($resultset->isonline);

	?>
	
	<p><a href="#" OnClick="JavaScript:window.open ('<?php echo MainSystem::URLCreator('chat/showChatWindow/'.$id_placeholder.'/');?>','Chat Window','menubar=1,resizable=1,width=350,height=250');"><?php echo $fname_placeholder.' '.$mname_placeholder.' '.$lname_placeholder.' ('.$entitytypetag_placeholder.' '.$isonline_placeholder.')'; ?></a></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


