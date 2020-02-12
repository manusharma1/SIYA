<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

	<?php
	$columns = array('day','startdate','enddate','content','objective','homework','addedby');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'teachersdiary', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$day = $sqlObj->getCleanData($resultset->day);	
	$startdate = $sqlObj->getCleanData($resultset->startdate);
	$enddate = $sqlObj->getCleanData($resultset->enddate);
	$content = $sqlObj->getCleanData($resultset->content);
	$objective = $sqlObj->getCleanData($resultset->objective);
	$homework = $sqlObj->getCleanData($resultset->homework);
	$addedby = MainSystem::getUserDetailsByID($sqlObj->getCleanData($resultset->addedby));
	$url='teachersdiary/showTeachersDiary/'.$id.'/';
	?>
	
	<h3>Teachers Diary Details</h3><br />
	
	<p><b>Added By :</b> <?php echo $addedby->fname.' '.$addedby->mname.' '.$addedby->lname; ?></p>
	<p><b>Day : </b><?php echo $day; ?></p>
	<p><b>Start Date :</b> <?php echo $startdate; ?> - End Date : <?php echo $enddate; ?></p>
	<hr />
	<p><b>Content :</b> <?php echo $content; ?></p><hr />
	<p><b>Objective :</b> <?php echo $objective; ?></p><hr />
	<p><b>Home Work :</b> <?php echo $homework; ?></p><hr />

										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


