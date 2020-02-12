<?php
$id = _ACTION_VIEW_PARAMETER_ID;
MainSystem::CheckIDExists('usertypes','id',$id,'admin/getAdminHome/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('usertypes','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$edit_usertypetag='';
$usertypetag = '';
$name = '';
$description = '';



$columns = array('id','usertypetag','name','description');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$edit_usertypetag =  $sqlObj->getCleanData($resultset->usertypetag);
$usertypetag = substr($edit_usertypetag,1);
$name =  $sqlObj->getCleanData($resultset->name);
$description =  $sqlObj->getCleanData($resultset->description);
}
}
}

if(isset($_POST) && isset($_POST['issubmit'])){
$usertypetag = (isset($_POST['usertypetag']))?$_POST['usertypetag']:'';
$name = (isset($_POST['name']))?$_POST['name']:'';
$description = (isset($_POST['description']))?$_POST['description']:'';
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
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveUserType/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveUserType/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit User Type</legend>

	<ol>

		<li>
		<label for="usertypetag"><?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?></label>
        <input name="hash" id="hash" type="text" value="#" size="1" maxlength="1" readonly="true" />
		<input id="usertypetag" name="usertypetag" type="text" placeholder="<?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?>" value="<?php echo $usertypetag; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['users']['NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['users']['NAME']; ?>" required="" autofocus="" value="<?php echo $name; ?>" <?php echo _FORM_CLASS; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['users']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['users']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $description; ?></textarea>
		</li>
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>