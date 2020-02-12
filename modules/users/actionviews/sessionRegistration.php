<?php

$sessioncode_placeholder = '';
$title_placeholder = '';
$description_placeholder = '';

if(isset($_POST)){
$sessioncode_placeholder = (isset($_POST['sessioncode']))?$_POST['sessioncode']:'';
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
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

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveSession/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveSession/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add New User Type</legend>

	<ol>

		<li>
		<label for="sessioncode"><?php $lang['siya']['users']['SESSION_CODE'];?></label>
		<input id="sessioncode" name="sessioncode" type="text" placeholder="<?php $lang['siya']['users']['SESSION_CODE'];?>" value="<?php echo $sessioncode_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="title"><?php $lang['siya']['users']['TITLE'];?></label>
		<input id="title" name="title" type="text" placeholder="Enter Title" required="" autofocus="" value="<?php echo $title_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required">
		</li>

		<li>
		<label for="description"><?php $lang['siya']['users']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php $lang['siya']['users']['DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>

<?php
/*$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=newstitle,newstext,newsdate:onsubmit=addnewnews:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;*/
?>