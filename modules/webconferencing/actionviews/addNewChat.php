<?php
$subjectid=$_POST['subjectid'];
$groupid=$_POST['groupid'];
$topicid=$_POST['topicid'];
$batchid=$_POST['batchid'];

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
$formaction = MainSystem::URLCreator('chat/saveChat/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('chat/saveChat/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Chat</legend>

	<ol>
		<li>
		<label for="groupid"><?php echo $lang['siya']['webconferencing']['GROUP']; ?> <?php echo $groupid; ?>
			<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
			</label>
	    </li>
		
		<li>
		<label for="batchid"><?php echo $lang['siya']['webconferencing']['BATCH']; ?> <?php echo $batchid; ?>
			<input id="batchid" name="batchid" type="hidden" value="<?php echo $batchid; ?>" /> 
		</label>
	    </li>

		<li>
		<label for="topicid"><?php echo $lang['siya']['webconferencing']['TOPIC']; ?> <?php echo $topicid; ?>
		<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" /> 
		</label>
	    </li>

		<li>
		<label for="subjectid"><?php echo $lang['siya']['webconferencing']['SUBJECT']; ?><?php echo $subjectid; ?> 
		<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 
		</label>
	    </li>
		
		<li>
		<label for="name"><?php echo $lang['siya']['webconferencing']['NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['NAME']; ?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['webconferencing']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['webconferencing']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
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