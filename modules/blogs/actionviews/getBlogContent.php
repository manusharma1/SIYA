<?php
$parameter = _ACTION_VIEW_PARAMETER_ID;
$result = explode(',',$parameter);

$id = (isset($result[0]))?$result[0]:'';
$more = (isset($result[1]))?$result[1]:'';

	$columns = array('id','userid','title','data','datamore');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$conditions['AND =']['pid'] = 0;
	$conditions['AND =']['isactive'] = 1;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, 'id', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	while($resultset = $sqlObj->FetchResult($result)){
	$id = $sqlObj->getCleanData($resultset->id);
	$userid = $sqlObj->getCleanData($resultset->userid);
	$title = $sqlObj->getCleanData($resultset->title);
	$data = $sqlObj->getCleanData($resultset->data);
	$datamore = $sqlObj->getCleanData($resultset->datamore);
	?>
	<h1 class="blogtitleclass"><?php echo $title; ?> </h1>
	<hr/> 

	<?php
	if($more == 'more'){
	?>

	<p class="blogpclass"><?php echo $datamore; ?></p><br />

	<?php 
	}else{
	?>

	<p class="blogpclass"><?php echo $data; ?></p>

	<?php 
	}
	?>
	<p class="authorclass"> Posted By: 
	<?php 
	$userDetails = MainSystem::getUserDetailsByID($userid);
	echo $autherName = $userDetails->fname.' '.$userDetails->mname.' '.$userDetails->lname;
	?>
	</p>
	<?php

	}
	}
	}
?>