<?php
$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'categoryid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
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
$categoryid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


?>

<?php
if(PROJ_RUN_AJAX==1){
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
}
?>

<script>
$(document).ready(function(){
$("#addquestionform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('questions/addQuestionDetails/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('questions/addQuestionDetails/');
}
?>
<form id="addquestionform" name="addquestionform" method="post" action="<?php echo $formaction; ?>">

<fieldset>
	
	<p><a href="<?php echo MainSystem::URLCreator('questions/showQuestions/');?>" > show Questions </a></p>
	
	<legend>Add Question</legend>

	<ol>
		<li><label class="label_categoryid" for="label_categoryid">Select Category : </label><?php echo $categoryid_placeholder; ?></li>
		<li>
		<label class="label_radio" for="radio-01">Type : </label><br />
		<input name="sample-radio" id="radio-01" value="MC" type="radio" <?php echo _FORM_FINAL; ?> />Multiple Choice<br />
		<input name="sample-radio" id="radio-02" value="TF" type="radio" />True False<br />
		<input name="sample-radio" id="radio-03" value="MTF" type="radio" />Match the Following<br />
		<input name="sample-radio" id="radio-04" value="FITB" type="radio" />Fill in the blanks<br />
		</li> 
	</ol>
<fieldset>

<button type="submit">Next</button>

</fieldset>

</form>