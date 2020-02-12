<?php
$replyid = $_POST['replyid'];
$groupid = $_POST['groupid'];

$description_placeholder = '';


if(isset($_POST)){
$description_placeholder = (isset($_POST['content']))?$_POST['content']:'';
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
$formaction = MainSystem::URLCreator('assignments/saveReplyAssignment/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assignments/saveReplyAssignment/');
}
?>


<script language="javascript">
fields = 1;
function addOptions() {
if (fields < 6) {
var content
content = '<li><label for="chosenfile'+fields+'">Upload File '+fields+' :</label><input type="file" id="chosenfile'+fields+'"  name="chosenfile[file'+fields+']" value="model.jpg"/><input type="hidden" id="chosenfile'+fields+'"  name="chosenfile[file'+fields+']" /></li>';
$("#additionalfields").append(content);
fields += 1;
} else {
alert("Upto 5 File Uploads are allowed.");
document.form.addbutton.disabled=true;
}

}

</script>



<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>"  enctype="multipart/form-data">

<fieldset>

	<legend><?php echo $lang['siya']['assignments']['REPLY_TO_ASSIGNMENT'];?></legend>

	<ol>
			
		<li>
		<label for="description"><?php echo $lang['siya']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['ENTER_DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>	
		</li>

	
		<div id="additionalfields">

		</div>
		<input type="button" onclick="addOptions()" name="addbutton" value="Add File" />


		<input id="replyid" name="replyid" type="hidden" value="<?php echo $replyid; ?>"/>
		<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>

		

		</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>