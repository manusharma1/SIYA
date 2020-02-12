<?php
$id = '';
?>

<h3>Meeting Detail</h3>

	<?php
	$columns = array('id','date','name','description');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'meetings', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$date_placeholder = $sqlObj->getCleanData($resultset->date);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$description_placeholder = $sqlObj->getCleanData($resultset->description);
	$url='meetings/showMeeting/'.$id_placeholder.'/';
	?>
	
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $name_placeholder.' ('.$description_placeholder.' On :'.$date_placeholder.')'; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?php echo MainSystem::URLCreator('meetings/manageAllMeetings/'.$id_placeholder.'/'); ?>">Manage This Meetings</p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


