<?php
$name_placeholder = '';
$description_placeholder = '';
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
$("#addquestioncategoryform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('questions/saveQuestionsCategory/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('questions/saveQuestionsCategory/');
}
?>
<form id="addquestioncategoryform" name="addquestioncategoryform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Question Category</legend>

	<ol>
		
		<li>
		<label for="name"><?php echo $lang['siya']['questions']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['questions']['NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="<?php echo $lang['siya']['questions']['DESCRIPTION'];?>"></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['questions']['DESCRIPTION'];?>" rows="5" required="" autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>