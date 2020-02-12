<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	MainSystem::CheckIDExists('additionalsettings','id',$id,'admin/getAdminHome/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('additionalsettings','addedby',$resultset->id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'))
	}
	
	// Define PlaceHolders
	$additionalsettingname_placeholder = '';
	$additionalsettingvalue_placeholder = '';

	// Get News Data
	$columns = array('id','position','name','value','isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'additionalsettings', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	
	$additionalsettingname_placeholder = $sqlObj->getCleanData($resultset->name);
	$additionalsettingvalue_placeholder = $sqlObj->getCleanData($resultset->value);
	$position = $sqlObj->getCleanData($resultset->position);

	}else{
	trigger_error('Data Fetch Error');
	}
	}else{ // if Doesn't Exists
	$_SESSION['message'] = $lang['siya']['additionalsettings']['ADDITIONAL_SETTINGS_DOES_NOT_EXISTS'];
	MainSystem::URLForwarder(MainSystem::URLCreator('admin/getAdminHome/'));
	}
	}else{
	trigger_error('SQL Error');
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
$("#editadditionalsettingform").validate();
});
</script>



	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('additionalsettings/saveAdditionalSettings/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('additionalsettings/saveAdditionalSettings/'.$id.'/');
	}
	?>

	<form id="editadditionalsettingform" name="editadditionalsettingform" method="post" action="<?php echo $formaction; ?>">
	
	<fieldset>
	<legend>Add New Additional Settings</legend>	
	<ol>

	
		<li>
			<label for="position"><?php echo $lang['siya']['additionalsettings']['POSITION']; ?></label><br /><select name="position" id="position" <?php echo _FORM_FINAL;?> />
			<option value="">------</option>
			<option value="HEADER" <?php echo ($position=='HEADER')?'SELECTED':'';?>>Header</option>
			<option value="BODY" <?php echo ($position=='BODY')?'SELECTED':'';?>>Body</option>
			<option value="FOOTER" <?php echo ($position=='FOOTER')?'SELECTED':'';?>>Footer</option>
			</select>
		</li>

		<li>
		<label for="additionalsettingname"><?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_NAME']; ?></label><br />
		<input type="text" name="additionalsettingname" id="additionalsettingname" title="<?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_NAME']; ?>" <?php echo _FORM_FINAL;?> value="<?php echo $additionalsettingname_placeholder; ?>"/>
		</li>
  
  		<li>
		<label for="additionalsettingname"><?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_VALUE']; ?></label><br />
		<textarea name="additionalsettingvalue" id="additionalsettingvalue" title="<?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_VALUE']; ?>" required="" autofocus="" <?php echo _FORM_CLASS;?>><?php echo $additionalsettingvalue_placeholder; ?></textarea>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>
</form>