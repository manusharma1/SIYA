<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

	<h3>Remarks Detail</h3>

	<?php

	$columns = array('id','message','messagetitle','remarksfor','remarksby');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'remarks', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$message = $sqlObj->getCleanData($resultset->message);	
	$messagetitle = $sqlObj->getCleanData($resultset->messagetitle);
	$remarksfor = MainSystem::getUserDetailsByID($sqlObj->getCleanData($resultset->remarksfor));
	$remarksby = MainSystem::getUserDetailsByID($sqlObj->getCleanData($resultset->remarksby));
	?>
	<br /><br />
	<hr />
	<h3><?php echo $messagetitle; ?></h3><br />
	<p>Remarks For : <?php echo $remarksfor->fname.' '.$remarksfor->mname.' '.$remarksfor->lname; ?></p>
	<p>Remarks By : <?php echo $remarksby->fname.' '.$remarksby->mname.' '.$remarksby->lname; ?></p>
	<br /><br />
	<p><?php echo $message; ?></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>