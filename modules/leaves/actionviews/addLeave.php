	<script>
	$(function() {
		$( "#startdate" ).datepicker({dateFormat:'yy-mm-dd'});
		$( "#enddate" ).datepicker({dateFormat:'yy-mm-dd'});
	});
	</script>
<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$idsarray = explode(',',$id);
$userid = $idsarray[0];
$groupid = $idsarray[1];
$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
$userdetails = MainSystem::getUserDetailsByID($userid);
$userfullname = $userdetails->fname.' '.$userdetails->mname.' '.$userdetails->lname;
$submitteduserid = MainSystem::GetSessionUserID();
$submitteduserdetailsarray = MainSystem::getUserDetailsByID($submitteduserid);
$submitteduserfullname = $submitteduserdetailsarray->fname.' '.$submitteduserdetailsarray->mname.' '.$submitteduserdetailsarray->lname;


$entitytypetag_placeholder = '';
$userid_placeholder = '';
$leavetypeid_placeholder = '';
$startdate_placeholder = '';
$enddate_placeholder = '';
$starttimeperiod_placeholder = '';
$endtimeperiod_placeholder = '';
$applicationby_placeholder = '';
$approvedby_placeholder = '';
$remarks_placeholder = '';


// Leave Type Tag //

$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'leavetypeid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','leavetypetag','title');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'leavetypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->leavetypetag).' ('.$sqlObj->getCleanData($resultsetmenu->title).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$leavetypeid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

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
$("#addleaveform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('leaves/addLeave2/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('leaves/addLeave2/');
}
?>
<form id="addleaveform" name="addleaveform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Leave </legend>

	<ol>
		
		<li>
		<label for="username"><?php echo $lang['siya']['leaves']['USER']; ?></label><?php echo $userfullname;?>
		</li>
		

		<li>
		<label for="leavetypeid"><?php echo $lang['siya']['leaves']['LEAVE_TYPE_TAG']; ?></label><?php echo $leavetypeid_placeholder; ?>
		</li>
		
		<li>
		<label for="startdate"><?php echo $lang['siya']['leaves']['START_DATE']; ?></label>
		<input id="startdate" name="startdate" type="text" placeholder="<?php echo $lang['siya']['leaves']['START_DATE']; ?>" value="<?php echo $startdate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="enddate"><?php echo $lang['siya']['leaves']['END_DATE']; ?></label>
		<input id="enddate" name="enddate" type="text" placeholder="<?php echo $lang['siya']['leaves']['END_DATE']; ?>" value="<?php echo $enddate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="applicationby"><?php echo $lang['siya']['leaves']['APPLICATION_BY']; ?></label><?php echo $submitteduserfullname;?>
		</li>
		
		<li>
		<label for="remarks"><?php echo $lang['siya']['leaves']['REMARKS'];?></label>
		<textarea id="remarks" name="remarks" type="text" placeholder="Enter Remarks" rows="5" required="" autofocus="" class="<?php echo $remarks_placeholder; ?>" <?php echo _FORM_FINAL; ?> /></textarea>
		</li>
		<input type="hidden" name="userid" value="<?php echo $userid;?>" />
		<input type="hidden" name="groupid" value="<?php echo $groupid;?>" />
		<input type="hidden" name="batchid" value="<?php echo $selected_batch_id;?>" />
		<input type="hidden" name="submitteduserid" value="<?php echo $submitteduserid;?>" />
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>