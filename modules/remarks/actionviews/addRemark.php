<?php
$id = _ACTION_VIEW_PARAMETER_ID;

$userdetails = MainSystem::getUserDetailsByID($id);


if(isset($_SESSION['message'])){
echo $_SESSION['message'];
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
$("#addremarksform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('remarks/saveRemark/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('remarks/saveRemark/');
}
?>
<form id="addremarksform" name="addremarksform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Remark</legend>

	<ol>

		<li>
		<label for="messagefor"><?php echo $lang['siya']['remarks']['REMARKS_FOR']; ?></label>
		<?php echo $userdetails->fname.' '.$userdetails->mname.' '.$userdetails->lname. ' ['.$userdetails->entitytypetag.']'; ?>
		</li>

		<li>
		<label for="messagetitle"><?php echo $lang['siya']['remarks']['MESSAGE_TITLE']; ?></label>
		<input id="messagetitle" name="messagetitle" type="text" placeholder="<?php echo $lang['siya']['remarks']['MESSAGE_TITLE']; ?>"<?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="message"><?php echo $lang['siya']['remarks']['MESSAGE']; ?></label>
		<textarea id="message" name="message" placeholder="<?php echo $lang['siya']['remarks']['MESSAGE']; ?>" rows="5"  autofocus="" <?php echo _FORM_FINAL; ?>></textarea>
		</li>
		
		<li>
		<label for="status"><?php echo $lang['siya']['remarks']['REMARKS_STATUS']; ?></label><select name="status" id="status" <?php echo _FORM_FINAL; ?>/>
		<option value="OPEN">OPEN</option>
		</select>
		</li>

		
		<li>
		<label for="status"><?php echo $lang['siya']['remarks']['REMARKS_PRIORITY']; ?></label><select name="status" id="status" <?php echo _FORM_FINAL; ?>/>
		<option value="">------</option>
		<option value="LOW">LOW</option>
		<option value="CLOSED">MEDIUM</option>	
		<option value="OPEN">HIGH</option>
		</select>
		</li>
	
		
		<input id="remarksfor" name="remarksfor" type="hidden" value="<?php echo $id; ?>" />
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>