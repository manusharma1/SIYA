<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('gradecategories','id',$id,'assessments/manageGradeCategory/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('gradecategories','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$groupid_placeholder = '';
$batchid_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';

global $groupid_tag ,$batchid_tag;
$batchid_tag = '';
$groupid_tag = '';


$columns = array('id','name','description','groupid','batchid');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'gradecategories', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
$groupid_tag =  $sqlObj->getCleanData($resultset->groupid);
$batchid_tag =  $sqlObj->getCleanData($resultset->batchid);
}
}
}


// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
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
$("#editgradecaregoryform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('assessments/saveGradeCategory/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assessments/saveGradeCategory/'.$id.'/');
}
?>
<form id="editgradecaregoryform" name="editgradecaregoryform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['assessments']['EDIT_GRADE_CATEGORY'];?></legend>

	<ol>
		<li>
		<label for="groupid"><?php echo $lang['siya']['assessments']['GROUP'];?>  </label><?php echo $groupid_placeholder; ?>
	    </li>
		
		<li>
		<label for="batchid"><?php echo $lang['siya']['assessments']['BATCH'];?> </label><?php echo $batchid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="name"><?php echo $lang['siya']['assessments']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['assessments']['ENTER_NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['assessments']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['assessments']['ENTER_DESCRIPTION'];?>" rows="5" required="" autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>