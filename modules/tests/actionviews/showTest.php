<?php
		$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

		//////////////////////////////////////////////////////////////////////////////////////
		// 	Action Permissions can be controlled by the Controller, but here the 			//
		//  Group Permissions can be checked and the action can be taken accordingly 		//
		//////////////////////////////////////////////////////////////////////////////////////

		$id = (isset($parameters[0]))?$parameters[0]:'';
		$groupid = (isset($parameters[1]))?$parameters[1]:'';
		MainSystem::CheckGroupPermissions($groupid,'group');
	
$cannottaketest = 0;
$userid = MainSystem::GetSessionUserID();
$userdetails = MainSystem::getUserDetailsByID($userid);
$userentitytypetag = $userdetails->entitytypetag;
?>

<h3>Online Test Detail</h3>

	<?php
	$columns = array('id','description','name','startdate','enddate','duration','assignedtoentitytypetag','password');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'tests', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If News Exists
	if($resultset = $sqlObj->FetchResult($result)){
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$description_placeholder = $sqlObj->getCleanData($resultset->description);
	$startdate = $sqlObj->getCleanData($resultset->startdate);
	$enddate = $sqlObj->getCleanData($resultset->enddate);
	$duration = $sqlObj->getCleanData($resultset->duration);
	$assignedtoentitytypetag = $sqlObj->getCleanData($resultset->assignedtoentitytypetag);
	$password = $sqlObj->getCleanData($resultset->password);

	$url='tests/showTest/'.$id.'/';
	?>
	
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $name_placeholder.' ('.$description_placeholder.')'; ?></a></p>
	
	<p><a href="<?php echo MainSystem::URLCreator('tests/showQuestions/'.$id.'/'); ?>">Show Questions in this Test</a></p>
	<p><a href="<?php echo MainSystem::URLCreator('tests/addQuestionsToTest/'.$id.'/'); ?>">Add Questions to this Test</a></p>									
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}
	


// Validate the Date

$todayDate = date('Y-m-d H:i:s');
$startDatecFF = DateTime::createFromFormat('Y-m-d H:i:s', $startdate);
$endDatecFF = DateTime::createFromFormat('Y-m-d H:i:s', $enddate);

if (!(($todayDate >= $startDatecFF->format('Y-m-d H:i:s')) && ($todayDate <= $endDatecFF->format('Y-m-d H:i:s'))))
{
$cannottaketest = 1; // 1 = Time Over 
$testerrormessage = 'Test Time Over';
}else if($userentitytypetag != $assignedtoentitytypetag){
$cannottaketest = 2; // 1 = Time Over 
$testerrormessage = 'Entity Type Doesn\'t Match';
}

//



	$columns = array('id','description','name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'tests', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If News Exists
	if($resultset = $sqlObj->FetchResult($result)){
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$description_placeholder = $sqlObj->getCleanData($resultset->description);
	$url='tests/showTest/'.$id.'/';
	?>
	
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $name_placeholder.' ('.$description_placeholder.')'; ?></a></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}	


	?>

	

	


	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction3 = MainSystem::URLCreator('tests/takeTest/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction3 = MainSystem::URLCreator('tests/takeTest/');
	}
	?>

<?php
if($cannottaketest==0){
?>

	<form id="addform2" name="addform2" method="post" action="<?php echo $formaction3; ?>">

		<fieldset>

		<legend>Take This Test</legend>

		<ol>
		
			<input type="hidden" name="testid" value="<?php echo $id; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
			
		</ol>
		
		</fieldset>
		
		<fieldset>

		<button type="submit">Take Test</button>

		</fieldset>

	</form>

<?php
}else{
?>
<br /><br />
<hr /><h3><?php echo $testerrormessage; ?></h3><hr />
<?php
}
?>