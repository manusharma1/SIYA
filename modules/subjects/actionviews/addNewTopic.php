<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$topiccode_placeholder = '';
$subjectname_placeholder = '';
$subjectcode_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';
$url = '';

$columns = array('c.id','c.chaptercode','c.name = chaptername','s.subjectcode','s.name = subjectname');
$conditions = array();

$tables = array();
$tables['subjects'] = 's';
$tables['chapters'] = 'c';

$conditions['=']['c.id'] = $id;
$conditions['K AND =']['s.id'] = 'c.subjectid';


$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$subjectname_placeholder = $sqlObj->getCleanData($resultset->subjectname);	
$subjectcode_placeholder = $sqlObj->getCleanData($resultset->subjectcode);
$chaptername_placeholder = $sqlObj->getCleanData($resultset->chaptername);	
$chaptercode_placeholder = $sqlObj->getCleanData($resultset->chaptercode);

$url='stage/showSubject/'.$id.'/';

}
}
}else{
trigger_error('Data Fetch Error');
}		

if(isset($_POST)){
$topiccode_placeholder = (isset($_POST['topiccode']))?$_POST['topiccode']:'';
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
$("#addnewtopicform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('subjects/saveTopic/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('subjects/saveTopic/');
}
?>
<form id="addnewtopicform" name="addnewtopicform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add New Topic</legend>

	<ol>
		<li>
		<label for="chaptername">Subject</label> <a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $subjectname_placeholder.' ('.$subjectcode_placeholder.')'; ?></a>
	    </li>
		<li>
		<label for="subjectname">Chapter</label> <a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $chaptername_placeholder.' ('.$chaptercode_placeholder.')'; ?></a>
	    </li>
		<li>
		<label for="topiccode"><?php echo $lang['siya']['subjects']['TOPIC_CODE'];?></label>
		<input id="topiccode" name="topiccode" type="text" placeholder="<?php echo $lang['siya']['subjects']['TOPIC_CODE'];?>" value="<?php echo $topiccode_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['subjects']['TITLE'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['subjects']['TITLE'];?>" required="" autofocus="" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['subjects']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['subjects']['DESCRIPTION'];?>" rows="5" required="" autofocus=""><?php echo $description_placeholder; ?></textarea>
		</li>
		<input type="hidden" name="chapterid" value="<?php echo $id;?>">
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>