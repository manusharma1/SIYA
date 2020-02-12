<?php
$id = _ACTION_VIEW_PARAMETER_ID;

MainSystem::CheckIDExists('chapters','id',$id,'subjects/manageSubjects/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('chapters','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$topiccode_placeholder = '';
$subjectname_placeholder = '';
$subjectcode_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';
$subjectid_placeholder = '';
$url = '';

$columns = array('c.id','c.chaptercode','c.subjectid','c.description','c.name = chaptername');
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
$subjectid_placeholder = $sqlObj->getCleanData($resultset->subjectid);
$chaptername_placeholder = $sqlObj->getCleanData($resultset->chaptername);	
$chaptercode_placeholder = $sqlObj->getCleanData($resultset->chaptercode);
$chapter_description_placeholder = $sqlObj->getCleanData($resultset->description);

}
}
}else{
trigger_error('Data Fetch Error');
}		



//Batch ID
$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'subjectid';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$columns = array('id','name','subjectcode');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
($resultset->id == $subjectid_placeholder)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->name).' ('.$sqlObj->getCleanData($resultset->subjectcode).')';
$htmlarray[]['option']['end'] = '';

}
}
}else{
trigger_error('Data Fetch Error');
}


$htmlarray[]['select']['end'] = '';
$subjectmenu_placeholder = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST) && isset($_POST['issubmit'])){
$chaptercode_placeholder = (isset($_POST['chaptercode']))?$_POST['chaptercode']:'';
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
$("#editChapterform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('subjects/saveChapter/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('subjects/saveChapter/'.$id.'/');
}
?>
<form id="editChapterform" name="editChapterform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Chapter</legend>

	<ol>
		<li>
		<label for="subjectid"><?php echo $lang['siya']['subjects']['EDIT_SUBJECT'];?></label><?php echo $subjectmenu_placeholder; ?> 
	    </li>
		
		<li>
		<label for="chaptercode"><?php echo $lang['siya']['subjects']['CHAPTER_CODE'];?></label>
		<input id="chaptercode" name="chaptercode" type="text" placeholder="<?php echo $lang['siya']['subjects']['CHAPTER_CODE']; ?>" value="<?php echo $chaptercode_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['subjects']['CHAPTER_NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['subjects']['CHAPTER_NAME']; ?>" value="<?php echo $chaptername_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['subjects']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" type="text"  rows="5"  autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $chapter_description_placeholder; ?></textarea>
		</li>
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>