<?php
$id = _ACTION_VIEW_PARAMETER_ID;

$messagetitle_placeholder = '';
$message_placeholder = '';
$status_placeholder = '';


$columns = array('id','remarksfor','remarksby','messagetitle','message','status','priority');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'remarks', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$remarksfor = $sqlObj->getCleanData($resultset->remarksfor);
$remarksby = $sqlObj->getCleanData($resultset->remarksby);
$messagetitle_placeholder = $sqlObj->getCleanData($resultset->messagetitle);
$message_placeholder =  $sqlObj->getCleanData($resultset->message);
$status_placeholder =  $sqlObj->getCleanData($resultset->status);
$userdetailsfor = MainSystem::getUserDetailsByID($remarksfor);
$userdetailsby = MainSystem::getUserDetailsByID($remarksby);
}
}
}

if(isset($_POST) && isset($_POST['issubmit'])){
$messagetitle_placeholder = (isset($_POST['messagetitle']))?$_POST['messagetitle']:'';
$message_placeholder = (isset($_POST['message']))?$_POST['message']:'';
$status_placeholder = (isset($_POST['status']))?$_POST['status']:'';
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
$("#editremarksform").validate();
});
</script>

<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('remarks','id',$id,'remarks/manageRemarks/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('remarks','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('remarks/saveRemark/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('remarks/saveRemark/'.$id.'/');
}
?>
<form id="editremarksform" name="editremarksform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Remark</legend>

	<ol>
			
		<li>
		<label for="messagefor"><?php echo $lang['siya']['remarks']['REMARKS_FOR']; ?></label>
		<?php echo $userdetailsfor->fname.' '.$userdetailsfor->mname.' '.$userdetailsfor->lname. ' ['.$userdetailsfor->entitytypetag.']'; ?>
		</li>

		<li>
		<label for="messageby"><?php echo $lang['siya']['remarks']['REMARKS_BY']; ?></label>
		<?php echo $userdetailsby->fname.' '.$userdetailsby->mname.' '.$userdetailsby->lname. ' ['.$userdetailsby->entitytypetag.']'; ?>
		</li>

		<li>
		<label for="messagetitle"><?php echo $lang['siya']['remarks']['MESSAGE_TITLE']; ?></label>
		<input id="messagetitle" name="messagetitle" type="text" placeholder="<?php echo $lang['siya']['remarks']['MESSAGE_TITLE']; ?>" value="<?php echo $messagetitle_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="message"><?php echo $lang['siya']['remarks']['MESSAGE']; ?></label>
		<textarea id="message" name="message" placeholder="<?php echo $lang['siya']['remarks']['MESSAGE']; ?>" rows="5"  autofocus=""  <?php echo _FORM_FINAL; ?>><?php echo $message_placeholder; ?></textarea>
		</li>
		
		<li>
		<label for="status"><?php echo $lang['siya']['remarks']['REMARKS_STATUS']; ?></label><select name="status" id="status"  <?php echo _FORM_FINAL; ?> />
		<option value="">------</option>
		<option value="OPEN" <?php  echo ($status_placeholder=='OPEN')?'SELECTED':''; ?>>OPEN</option>
		<option value="CLOSED" <?php  echo ($status_placeholder=='CLOSED')?'SELECTED':''; ?>>CLOSED</option>
		</select>
		</li>

		<li>
		<label for="status"><?php echo $lang['siya']['remarks']['REMARKS_PRIORITY']; ?></label><select name="status" id="status" <?php echo _FORM_FINAL; ?>/>
		<option value="">------</option>
		<option value="LOW" <?php  echo ($status_placeholder=='LOW')?'SELECTED':''; ?>>LOW</option>
		<option value="MEDIUM" <?php  echo ($status_placeholder=='MEDIUM')?'SELECTED':''; ?>>MEDIUM</option>
		<option value="HIGH" <?php  echo ($status_placeholder=='HIGH')?'SELECTED':''; ?>>HIGH</option>
		</select>
		</li>

	<input type="hidden" name="remarksfor" value="<?php echo $remarksfor;?>" />
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>