<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	$groupid = (isset($parameters[1]))?$parameters[1]:'';
	MainSystem::CheckGroupPermissions($groupid,'group');

$topiccode_placeholder = '';
$subjectname_placeholder = '';
$subjectcode_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';
$url = '';

$columns = array('subjectcode','name');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$subjectname_placeholder = $sqlObj->getCleanData($resultset->name);	
$subjectcode_placeholder = $sqlObj->getCleanData($resultset->subjectcode);
$url='stage/showSubject/'.$id.'/';

}
}
}else{
trigger_error('Data Fetch Error');
}		

if(isset($_POST)){
$chaptercode_placeholder = (isset($_POST['topiccode']))?$_POST['topiccode']:'';
$chaptername_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$chapterdescription_placeholder = (isset($_POST['description']))?$_POST['description']:'';
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
$("#addnewchapterform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('subjects/saveChapter/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('subjects/saveChapter/');
}
?>
<form id="addnewchapterform" name="addnewchapterform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add New Chapter</legend>

	<ol>
		<li>
		<label for="subjectname"><?php echo $lang['siya']['subjects']['SUBJECT']; ?></label> <a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $subjectname_placeholder.' ('.$subjectcode_placeholder.')'; ?></a>
	    </li>
		<li>
		<label for="chaptercode"><?php echo $lang['siya']['subjects']['CHAPTER_CODE']; ?></label>
		<input id="chaptercode" name="chaptercode" type="text" placeholder="<?php echo $lang['siya']['subjects']['CHAPTER_CODE']; ?>" value="<?php echo $chaptercode_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['subjects']['CHAPTER_NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['subjects']['CHAPTER_NAME']; ?>" required="" autofocus="" value="<?php echo $chaptername_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['subjects']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['subjects']['DESCRIPTION']; ?>" rows="5" required="" autofocus=""><?php echo $chapterdescription_placeholder; ?></textarea>
		</li>
		<input type="hidden" name="subjectid" value="<?php echo $id;?>">
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>