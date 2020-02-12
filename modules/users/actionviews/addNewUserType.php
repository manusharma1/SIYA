<?php

$user_type_tag_placeholder = '';
$user_type_name_placeholder = '';
$user_type_description_placeholder = '';

if(isset($_POST)){
$user_type_tag_placeholder = (isset($_POST['usertypetag']))?$_POST['usertypetag']:'';
$user_type_name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$user_type_description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
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
$("#addnewuserform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveUserType/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveUserType/');
}
?>
<form id="addnewuserform" name="addnewuserform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add New User Type</legend>

	<ol>

		<li>
		<label for="usertypetag"><?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?></label>
        <input name="hash" id="hash" type="text" value="#" size="1" maxlength="1" readonly="true" />
		<input id="usertypetag" name="usertypetag" type="text" placeholder="<?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?>" value="<?php echo $user_type_tag_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['users']['TITLE']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['users']['TITLE']; ?>" required="" autofocus="" value="<?php echo $user_type_name_placeholder; ?>" <?php echo _FORM_FINAL; ?> >
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['users']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['users']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $user_type_description_placeholder; ?></textarea>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>