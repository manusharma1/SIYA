<?php
$batchcode_placeholder = '';
$title_placeholder = '';
$description_placeholder = '';
$batchstart_placeholder = '';
$batchend_placeholder = '';


if(isset($_POST)){
$batchcode_placeholder = (isset($_POST['batchcode']))?$_POST['batchcode']:'';
$batchstart_placeholder = (isset($_POST['batchcode']))?$_POST['batchcode']:'';
$batchend_placeholder = (isset($_POST['batchcode']))?$_POST['batchcode']:'';
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
}
?>

<?php
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}

if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('batches/saveBatch/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('batches/saveBatch/');
	}
?>

<script>
$(document).ready(function(){
$("#addnewbatchform").validate();
});
</script>


<form id="addnewbatchform" name="addnewbatchform" class="has-js" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add New Batch</legend>

	<ol>

		<li>
		<label for="batchcode"><?php echo $lang['siya']['batches']['BATCH_CODE'];?></label>
		<input id="batchcode" name="batchcode" type="text" placeholder="<?php echo $lang['siya']['batches']['BATCH_CODE'];?>"  autofocus="" value="<?php echo $batchcode_placeholder; ?>" <?php echo _FORM_FINAL;?> />
		</li>

		<li>
		<label for="batchstart"><?php echo $lang['siya']['batches']['BATCH_START_TIME_PERIOD'];?></label>
		<input id="batchstart" name="batchstart" type="text" placeholder="<?php echo $lang['siya']['batches']['BATCH_START_TIME_PERIOD'];?>" autofocus="" value="<?php echo $batchstart_placeholder; ?>" <?php echo _FORM_FINAL;?>/>
		</li>

		<li>
		<label for="batchend"><?php echo $lang['siya']['batches']['BATCH_END_TIME_PERIOD']; ?></label>
		<input id="batchend" name="batchend" type="text" placeholder="<?php echo $lang['siya']['batches']['BATCH_END_TIME_PERIOD']; ?>"autofocus="" value="<?php echo $batchend_placeholder; ?>" <?php echo _FORM_FINAL;?> />
		</li>

		

		<li>
		<label for="title"><?php echo $lang['siya']['batches']['BATCH_TITLE']; ?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['batches']['BATCH_TITLE']; ?>"  autofocus="" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL;?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['batches']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['batches']['DESCRIPTION']; ?>" rows="5" autofocus="" <?php echo _FORM_CLASS;?>><?php echo $description_placeholder; ?></textarea>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>