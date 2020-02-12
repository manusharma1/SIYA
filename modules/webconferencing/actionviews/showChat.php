<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

<h3>Chat Detail</h3>

	<?php
	$columns = array('id','description','name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'chat', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$sid_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$description_placeholder = $sqlObj->getCleanData($resultset->description);
	$url='chat/showChatFrame/'.$sid_placeholder.'/';
	?>
	
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $name_placeholder.' ('.$description_placeholder.')'; ?></a></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


