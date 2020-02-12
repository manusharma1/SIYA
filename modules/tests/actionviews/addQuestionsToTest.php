<?php
$id = _ACTION_VIEW_PARAMETER_ID;

$categoryid = '';

if(isset($_POST)){
if(isset($_POST['categoryid'])){
$categoryid = $_POST['categoryid'];
}
}else{
$categoryid = '';
}

// Category ID //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'categoryid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['onChange'] = 'document.forms[\'changecategoryform\'].submit();';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','name','description');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'questionscategories', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$questioncategory_placeholder = $HTMLObj->HTMLCreator($htmlarray);

?>

<?php
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('tests/addQuestionsToTest/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('tests/addQuestionsToTest/'.$id.'/');
}
?>

<form id="changecategoryform" name="changecategoryform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Select Questions From Category</legend>

	<ol>
				
		<li>
		<label for="typeid">Category :</label>
		<?php echo $questioncategory_placeholder; ?>
			
		</li>
		
	</ol>

</fieldset>

</form>



<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('tests/saveQuestionsToTest/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('tests/saveQuestionsToTest/');
}
?>

	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Question Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Question</p>
	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

	<fieldset>

	<legend>Add Questions To Test</legend>

	<ol>
	<?php 

	// Questions //
	$i=0;
	$columns = array('id','type','question');
	$conditions = array();
	$conditions['=']['categoryid'] = $categoryid;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'questions', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$type_placeholder = $sqlObj->getCleanData($resultset->type);
	$question_placeholder = $sqlObj->getCleanData($resultset->question);
	$i++;
	?>
	
	<li>
	<p>
	<label class="label_check" for="checkbox<?php echo $i; ?>"></label><input name="questionid[]" id="checkbox<?php echo $i; ?>" value="<?php echo $id_placeholder; ?>" type="checkbox" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
	
	<?php echo $type_placeholder.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.strip_tags($question_placeholder); ?>
	</p>

	</li>
								
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}
	?>

	</ol>
	<fieldset>
	<input type="hidden" name="testid" value="<?php echo $id; ?>" />
	<button type="submit">Save</button>

	</fieldset>

	</form>