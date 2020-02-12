<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('topics','id',$id,'subjects/manageSubjects/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('topics','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$topicid_placeholder = '';
$chaptername_placeholder = '';
$chaptercode_placeholder = '';
$topic_name_placeholder = '';
$chapterid_placeholder = '';
$topic_code_placeholder = '';
$topic_description_placeholder = '';
$url='';


$columns = array('t.id','t.topiccode','t.name = topictname','t.chapterid','t.description','c.chaptercode','c.name = chaptername','s.subjectcode','s.name = subjectname','g.id = groupid');
$conditions = array();

$tables = array();

$tables['chapters'] = 'c';
$tables['topics'] = 't';
$tables['subjects'] = 's';
$tables['groups'] = 'g';

$conditions['=']['t.id'] = $id;
$conditions['K AND =']['c.id'] = 't.chapterid';
$conditions['K AND =']['s.id'] = 'c.subjectid';
$conditions['K AND =']['g.id'] = 's.groupid';


$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$chapterid_placeholder =  $sqlObj->getCleanData($resultset->chapterid);
$subjectname_placeholder = $sqlObj->getCleanData($resultset->subjectname);	
$subjectcode_placeholder = $sqlObj->getCleanData($resultset->subjectcode);
$chaptername_placeholder = $sqlObj->getCleanData($resultset->chaptername);	
$chaptercode_placeholder = $sqlObj->getCleanData($resultset->chaptercode);
$topic_name_placeholder = $sqlObj->getCleanData($resultset->topictname);	
$topic_code_placeholder = $sqlObj->getCleanData($resultset->topiccode);
$groupid = $sqlObj->getCleanData($resultset->groupid);

$topic_description_placeholder = $sqlObj->getCleanData($resultset->description);

MainSystem::CheckGroupPermissions($groupid,'group');

$url='subject/editTopic/'.$id.'/';

}
}
}else{
trigger_error('Data Fetch Error');
}		

if(isset($_POST) && isset($_POST['issubmit'])){
$topic_code_placeholder = (isset($_POST['topiccode']))?$_POST['topiccode']:'';
$topic_name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$topic_description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
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
$("#edittopicform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('subjects/saveTopic/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('subjects/saveTopic/'.$id.'/');
}
?>
<form id="edittopicform" name="edittopicform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Topic</legend>

	<ol>
		<li>
		<label for="subjectname"><?php echo $lang['siya']['subjects']['SUBJECT_NAME']; ?></label> <?php echo $subjectname_placeholder.' ('.$subjectcode_placeholder.')'; ?>
	    </li>
		<li>
		<label for="chaptername"><?php echo $lang['siya']['subjects']['CHAPTER_NAME']; ?></label> <?php echo $chaptername_placeholder.' ('.$chaptercode_placeholder.')'; ?>
	    </li>
		<li>
		<label for="topiccode"><?php echo $lang['siya']['subjects']['TOPIC_CODE']; ?></label>
		<input id="topiccode" name="topiccode" type="text" placeholder="<?php echo $lang['siya']['subjects']['TOPIC_CODE']; ?>" value="<?php echo $topic_code_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['subjects']['TOPIC_NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['subjects']['TOPIC_NAME']; ?>" required="" autofocus="" value="<?php echo $topic_name_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['subjects']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['subjects']['DESCRIPTION']; ?>" rows="5" required="" autofocus=""><?php echo $topic_description_placeholder; ?></textarea>
		</li>
		<input type="hidden" name="chapterid" value="<?php echo $chapterid_placeholder;?>">
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>