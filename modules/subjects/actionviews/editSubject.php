<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('subjects','id',$id,'subjects/manageSubjects/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('subjects','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$subjectid_placeholder = '';
$batchid_placeholder = '';
$subjectcode_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';


$columns = array('id','groupid','semesterid','subjectcode','batchid','name','description','isactive');
$sqlObj = new MainSQL();

$conditions = array();
$conditions['=']['id'] = $id;
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$groupid_tag =  $sqlObj->getCleanData($resultset->groupid);
$semesterid_tag =  $sqlObj->getCleanData($resultset->semesterid);
$batchid_tag =  $sqlObj->getCleanData($resultset->batchid);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$subjectcode_placeholder =  $sqlObj->getCleanData($resultset->subjectcode);

}
}
}



// Group ID //

$HTMLObj = new MainHTML();

$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'groupid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','grouptypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $groupid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$groupid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


//Batch ID
$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'batchid';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = 'All Batches';
$htmlarray[]['option']['end'] = '';

$columns = array('id','batchcode','title');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
($resultset->id == $batchid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
$htmlarray[]['option']['end'] = '';

}
}
}else{
trigger_error('Data Fetch Error');
}


$htmlarray[]['select']['end'] = '';
$batchid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

if(isset($_POST) && isset($_POST['issubmit'])){
$subjectcode_placeholder = (isset($_POST['subjectcode']))?$_POST['subjectcode']:'';
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
$("#editsubjectform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('subjects/saveSubject/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('subjects/saveSubject/'.$id.'/');
}
?>
<form id="editsubjectform" name="editsubjectform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['subjects']['EDIT_SUBJECT'];?></legend>

	<ol>
		<li>
		<label for="groupid"><?php echo $lang['siya']['GROUP'];?></label> <?php echo $groupid_placeholder; ?>
	    </li>

		<li>
		<label for="batchid"><?php echo $lang['siya']['BATCH'];?></label><?php echo $batchid_placeholder; ?> 
	    </li>

		<li>
		<label for="subjectcode"><?php echo $lang['siya']['subjects']['SUBJECT_CODE'];?></label>
		<input id="subjectcode" name="subjectcode" type="text" value="<?php echo $subjectcode_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['subjects']['TITLE'];?></label>
		<input id="name" name="name" type="text" required="" autofocus="" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['subjects']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" rows="5" required="" autofocus="" <?php echo _FORM_CLASS;?> ><?php echo $description_placeholder; ?></textarea>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>