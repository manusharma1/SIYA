<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

<h3>Online Test Detail</h3>

	<?php
	$columns = array('id','description','name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'tests', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
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

	
	<p><a href="<?php echo MainSystem::URLCreator('tests/showQuestions/'.$id.'/'); ?>">Show Questions in this Test</a></p>
	<p><a href="<?php echo MainSystem::URLCreator('tests/addQuestionsToTest/'.$id.'/'); ?>">Add Questions to this Test</a></p>
	


	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction3 = MainSystem::URLCreator('tests/takeTest/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction3 = MainSystem::URLCreator('tests/takeTest/');
	}
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