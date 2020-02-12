<?php
$subjectid=$_POST['subjectid'];
$groupid=$_POST['groupid'];
$batchid=$_POST['batchid'];
$chapteridid=$_POST['chapterid'];
$topicid=$_POST['topicid'];

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
$("addnewforumform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('forums/saveForum/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('forums/saveForum/');
}
?>
<form id="addnewforumform" name="addnewforumform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['forums']['ADD_NEW_FORUM']; ?></legend>

	<ol>
		<li>
		<label for="name"><?php echo $lang['siya']['forums']['NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['forums']['NAME']; ?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['forums']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['forums']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>
		
	</ol>
<fieldset>
	<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
	<input id="batchid" name="batchid" type="hidden" value="<?php echo $batchid; ?>" /> 
	<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 
	<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" /> 
<button type="submit">Save</button>

</fieldset>

</form>