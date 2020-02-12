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
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>


<form id="addform" name="addform" class="has-js" method="post" action="<?php echo MainSystem::URLCreator('users/saveUserType/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false); ?>">

<fieldset>

	<legend>Add New User Type</legend>

	<ol>

		<li>
		<label for="usertypetag"><?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?></label>
		<input id="usertypetag" name="usertypetag" type="text" placeholder="<?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?>" required="" autofocus="" value="<?php echo $user_type_tag_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['users']['USER_NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME']; ?>" required="" autofocus="" value="<?php echo $user_type_name_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required">
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['users']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['users']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $user_type_description_placeholder; ?></textarea>
		</li>

		<li>
		<label class="label_check" for="checkbox-01"><input name="sample-checkbox-01" id="checkbox-01" value="1" type="checkbox" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		 Sample Label</label>
		<label class="label_check" for="checkbox-02"><input name="sample-checkbox-01" id="checkbox-02" value="1" type="checkbox" />Sample Label 2</label>
		</li>

    	<li>
		<label class="label_radio" for="radio-01"><input name="sample-radio" id="radio-01" value="1" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />Sample Label 1</label>
		<label class="label_radio" for="radio-02"><input name="sample-radio" id="radio-02" value="1" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />Sample Label 2</label>
		<label class="label_radio" for="radio-03"><input name="sample-radio" id="radio-03" value="1" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />Sample Label 2</label>
		</li>
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>
