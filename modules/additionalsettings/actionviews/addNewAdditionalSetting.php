<?php
if(PROJ_RUN_AJAX==1){
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
}
?>

<script>
$(document).ready(function(){
$("#addnewadditionalsettingform").validate();
});
</script>
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('additionalsettings/saveAdditionalSettings/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('additionalsettings/saveAdditionalSettings/');
	}
	?>

	<form id="addnewadditionalsettingform" name="addnewadditionalsettingform" method="post" action="<?php echo $formaction; ?>">
	
	<fieldset>
	<legend>Add New Additional Settings</legend>	
	<ol>

	
		<li>
			<label for="position"><?php echo $lang['siya']['additionalsettings']['POSITION']; ?></label><br /><select name="position" id="position" <?php echo _FORM_FINAL;?> />
			<option value="">------</option>
			<option value="HEADER">Header</option>
			<option value="BODY">Body</option>
			<option value="FOOTER">Footer</option>
			</select>
			
				
		</li>

		<li>
		<label for="additionalsettingname"><?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_NAME']; ?></label><br />
		<input type="text" name="additionalsettingname" id="additionalsettingname" title="<?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_NAME']; ?>"<?php echo _FORM_FINAL;?>/>
		</li>
  
  		<li>
		<label for="additionalsettingname"><?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_VALUE']; ?></label><br />
		<textarea name="additionalsettingvalue" id="additionalsettingvalue" title="<?php echo $lang['siya']['additionalsettings']['ADDITIONAL_SETTING_VALUE']; ?>" required="" autofocus=""<?php echo _FORM_CLASS;?>></textarea>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>