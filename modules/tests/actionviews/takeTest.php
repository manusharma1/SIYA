<?php

	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id = '';
	}
	

	$testid = $_POST['testid'];
	$data = array();
	$data['userid'] = MainSystem::GetSessionUserID();
	$data['testid'] = $testid;
	$data['attempteddatetime'] = date('Y-m-d H:i:s');
	$data['completed'] = '0';
	$conditions = array();
	
	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('I', 'testattempts', $data, '', '', '', '');
	
	
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Test Attemptes Saved';

	
	$returnid = $sqlObj->getLastInsertID();
	$_SESSION['uniquetestattemptid'] = $returnid;
	//echo $returnid;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = 'Test Attemptes cannot be Saved';
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'takeTest'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'takeTest'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = 'ERROR : Test Attemptes Cannot be Saved';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	//return $functionreturnarray;
	}

	}


	//retrieve id from testattempts





	$sqlObj = new MainSQL();
	$columns = array('q.categoryid','q.type','q.leveltype','q.question','q.options','q.answer','q.feedback');
	$conditions = array();

	$tables = array();
	$tables['questionsintest'] = 'qt';
	$tables['questions'] = 'q';

	$conditions['=']['qt.testid'] = $testid ;
	$conditions['K AND =']['qt.questionid'] = 'q.id';

	$conditions['AND =']['q.isactive'] = '1';
	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	while($resultset = $sqlObj->FetchResult($result)){
	$categoryid	= $sqlObj->getCleanData($resultset->categoryid);
	$type = $sqlObj->getCleanData($resultset->type);
	$leveltype = $sqlObj->getCleanData($resultset->leveltype);
	$question = $sqlObj->getCleanData($resultset->question);
	$options = $sqlObj->getCleanData($resultset->options);
	$answer = $sqlObj->getCleanData($resultset->answer);
	$feedback = $sqlObj->getCleanData($resultset->feedback);
		
		
	$data = array();
	$data['uniquetestattemptid'] = $returnid;
	$data['categoryid'] = $categoryid;
	$data['type'] = $type;
	$data['leveltype'] = $leveltype;
	$data['question'] = $question;
	$data['options'] = $options;
	$data['answer'] = $answer;
	$data['feedback'] = $feedback;

	$data['added'] = date('Y-m-d H:i:s');

	// Conditions in case of Edit //
	$conditions = array();
	
	$sqlObj = new MainSQL();
	
	$sql2 = $sqlObj->SQLCreator('I', 'testquestionssnapshots', $data, '', '', '', '');
	if($result2 = $sqlObj->FireSQL($sql2)){
		//we need to add something here
	}
	}
	}
	}
	
?>


<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('tests/saveUserAnswers/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('tests/saveUserAnswers/');
}
?>

<form id="taketestform" name="taketestform" method="post" action="<?php echo $formaction; ?>">
<fieldset>

	<legend>Questions - Answer these Questions</legend>

	<ol>

	<?php

	questions::setSeperators();
	$columns = array('id','type','question','options');
	$conditions = array();
	$conditions['=']['uniquetestattemptid'] = $_SESSION['uniquetestattemptid'];
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'testquestionssnapshots', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$type_placeholder = $sqlObj->getCleanData($resultset->type);	
	$question_placeholder = $sqlObj->getCleanData($resultset->question);
	$options = $sqlObj->getCleanData($resultset->options);
	
	if($type_placeholder!='FITB'){
	?>
	<p><?php echo 'Question :'.$question_placeholder.'  <br />Options: '; ?></p>
	
	<?php
	}
	if($type_placeholder=='MC'){
	$optionsseperatorarray = array();
	$optionsarray = array();
	$optionsseperatorarray = explode(questions::$seprator, $options);

	//print_r($optionsseperatorarray);
	
	// There needs to be changes in this as the last seperator should not go while adding the question, changes should be done

	foreach($optionsseperatorarray as $key => $value){
	$optionssubseperatorarray = explode(questions::$subseprator, $value);
	$optionsarray[] = $optionssubseperatorarray;
	}
	
	foreach($optionsarray as $key => $value){
	?>
	<input type="radio" name="<?php echo $id_placeholder; ?>" value="<?php echo $value[0]; ?>"> <?php echo $value[1]; ?> <br />
	<?php
	}
	}
	if($type_placeholder=='TF'){
	?>
	<input type="radio" name="<?php echo $id_placeholder; ?>" value="true" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL; ?>" />True <br />
	<input type="radio" name="<?php echo $id_placeholder; ?>" value="false">False
	<?php
	}

	if($type_placeholder=='MTF'){
	
	$optionsseperatorarray = array();
	$optionsarray = array();
	$optionspartsseperatorarray = explode(questions::$partsseprator, $options);

	//print_r($optionspartsseperatorarray);die;
	// There needs to be changes in this as the last seperator should not go while adding the question, changes should be done
	
	$optionsseperatorarray = explode(questions::$seprator, $optionspartsseperatorarray[0]);
	$counta = count($optionsseperatorarray);
	
	?>
  <table width = "100%">
  <tr>
  <td width = "50%"><h3>Part A</h3></td>
  <td width = "50%"><h3>Part B</h3></td>
  </tr>
  <tr>
  <td width = "50%">
	
	<?php 
	for($c=1;$c<=$counta;$c++)
	{
	?>	
	<select name="<?php echo $id_placeholder.'[parta]['.$c.']'; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
	
	<?php
	foreach($optionsseperatorarray as $key => $value){
	$optionssubseperatorarray = explode(questions::$subseprator, $value);
	
	?>
	
	<option value="<?php echo $optionssubseperatorarray[0]; ?>"><?php echo $optionssubseperatorarray[1]; ?></option>
	
	<?php
	}
	?>
	</select>
	<br/>
	<?php
	}
	?>
	</td>
	<td width = "50%">
	<?php
	$optionsseperatorarray = explode(questions::$seprator, $optionspartsseperatorarray[1]);
	//print_r($optionsseperatorarray);die;
	
	?>
	<?php 
	$countb = count($optionsseperatorarray);
	for($c=1;$c<=$countb;$c++)
	{
	?>	

	<select name="<?php echo $id_placeholder.'[partb]['.$c.']'; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
	
	<?php
	foreach($optionsseperatorarray as $key => $value){
	$optionssubseperatorarray = explode(questions::$subseprator, $value);
	?>
	
	<option value="<?php echo $optionssubseperatorarray[0]; ?>"><?php echo $optionssubseperatorarray[1]; ?></option>
	
	<?php
	}
	?>
	
	</select>
	<br/>
	<?php
     }
	?>
	</td>
	</tr>
	</table>
	<?php
	}

	if($type_placeholder == 'FITB'){
	$userAnswer = str_replace(questions::$fillinblanksquestionseperator,'<input type="Text" name="'.$id_placeholder.'[]" />',$question_placeholder);
	?>
	
	<p>Questions :</p>
	<p><?php echo $userAnswer; ?></p>
		
	<?php
	}
	?>
	<hr />
	<?php
	}
	?>
	
	<?php
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>
	</li>	
	</ol>
	</fieldset>
<fieldset>

<input type ="hidden" name="testid" value="<?php echo $testid; ?>">
<button type="submit">Save</button>

</fieldset>


</form>