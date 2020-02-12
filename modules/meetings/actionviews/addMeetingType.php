<?php

$name_placeholder = '';
$description_placeholder = '';


if(isset($_POST)){
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
$("#addmeetingtypeform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('meetings/saveMeetingType/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('meetings/saveMeetingType/');
}
?>
<form id="addmeetingtypeform" name="addmeetingtypeform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Meeting Type</legend>

	<ol>
		<li>
		<label for="name"><?php echo $lang['siya']['meetings']['NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['meetings']['NAME']; ?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['meetings']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['meetings']['DESCRIPTION']; ?>" rows="5" autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>
		
	
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>