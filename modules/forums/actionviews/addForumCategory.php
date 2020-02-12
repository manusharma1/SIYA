<?php
$id = $_POST['forumcatid'];

$name_placeholder = '';
$description_placeholder = '';


if(isset($_POST)){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
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
$formaction = MainSystem::URLCreator('forums/saveForumCategory/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('forums/saveForumCategory/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Forum Category</legend>

	<ol>
		<li>
		<label for="name"><?php echo $lang['siya']['forums']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="Enter Name" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['forums']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" placeholder="Enter Description" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>
		
		<input id="forumid" name="forumid" type="hidden" value="<?php echo $id; ?>"/>
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>