<?php
$id = _ACTION_VIEW_PARAMETER_ID;


	MainSystem::CheckIDExists('questionscategories','id',$id,'questions/manageQuestionCategory/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('questionscategories','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$name_placeholder = '';
$description_placeholder = '';

$columns = array('id','name','description');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'questionscategories', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
}
}
}


if(isset($_POST) && isset($_POST['issubmit'])){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';

}
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
$("#editquestioncategoryform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('questions/saveQuestionsCategory/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('questions/saveQuestionsCategory/'.$id.'/');
}
?>
<form id="editquestioncategoryform" name="editquestioncategoryform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Question Category</legend>

	<ol>
		<li>
		<label for="name"><?php echo $lang['siya']['questions']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['questions']['NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['questions']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['questions']['DESCRIPTION'];?>" rows="5" autofocus="" <?php echo _FORM_CLASS;?>><?php echo $description_placeholder; ?></textarea>
		</li>
	</ol>
<fieldset>
<button type="submit">Save</button>
</fieldset>
</form>