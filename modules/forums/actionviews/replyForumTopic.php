<?php
$replyid = $_POST['forumtopicid'];
$forumcatid = $_POST['forumcatid'];
$title_placeholder = '';
$content_placeholder = '';


if(isset($_POST)){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$content_placeholder = (isset($_POST['content']))?$_POST['content']:'';
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
$formaction = MainSystem::URLCreator('forums/saveReplyForumTopic/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('forums/saveReplyForumTopic/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Reply Forum Topic</legend>

	<ol>
		
		<li>
		<label for="title"><?php echo $lang['siya']['forums']['TITLE']; ?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['forums']['TITLE']; ?>" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="content"><?php echo $lang['siya']['forums']['CONTENT']; ?></label>
		<textarea id="content" name="content" placeholder="<?php echo $lang['siya']['forums']['CONTENT']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $content_placeholder; ?></textarea>
		
		</li>

		<input id="replyid" name="replyid" type="hidden" value="<?php echo $replyid; ?>"/>
		<input id="forumcatid" name="forumcatid" type="hidden" value="<?php echo $forumcatid; ?>"/>

		</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>