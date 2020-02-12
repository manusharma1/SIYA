<?php
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$daysarray = leaves::createDateRangeArray($startdate,$enddate);

$userid = $_POST['userid'];
$groupid = $_POST['groupid'];
$submitteduserid = $_POST['submitteduserid'];
$batchid = $_POST['batchid'];
$leavetypeid = $_POST['leavetypeid'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$remarks = $_POST['remarks'];

$userdetails = MainSystem::getUserDetailsByID($userid);
$userfullname = $userdetails->fname.' '.$userdetails->mname.' '.$userdetails->lname;
$submitteduserdetailsarray = MainSystem::getUserDetailsByID($submitteduserid);
$submitteduserfullname = $submitteduserdetailsarray->fname.' '.$submitteduserdetailsarray->mname.' '.$submitteduserdetailsarray->lname;

// Leave Type Tag //


$sqlObj = new MainSQL();
$columns = array('id','leavetypetag','title');
$conditions = array();
$conditions['=']['id'] = $leavetypeid;
$sqlmenu = $sqlObj->SQLCreator('S', 'leavetypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
if($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$leavetype_placeholder = $sqlObj->getCleanData($resultsetmenu->leavetypetag).' ('.$sqlObj->getCleanData($resultsetmenu->title).')';
}
}
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
$formaction = MainSystem::URLCreator('leaves/saveLeave/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('leaves/saveLeave/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Leave </legend>

	<ol>
		
		<li>
		<label for="username"><?php echo $lang['siya']['leaves']['USER']; ?></label><?php echo $userfullname;?>
		</li>
		

		<li>
		<label for="leavetypeid"><?php echo $lang['siya']['leaves']['LEAVE_TYPE_TAG']; ?></label><?php echo $leavetype_placeholder; ?>
		</li>
		
		<?php

		foreach($daysarray as $value)
		{
		?>
		<li>
		<b><?php echo $value; ?></b> 
		<select name="leavedays[<?php echo $value; ?>][leavedaysperiod]" id="leavedaysperiod">
		<option value="">--------------------</option>
		<option value="SL">SHORT LEAVE</option>
		<option value="HL">HALF LEAVE</option>
		<option value="FL">FULL LEAVE</option>
		</select>
		</li>
		<?php
		}
		?>
		<li>
		<label for="startdate"><?php echo $lang['siya']['leaves']['START_DATE']; ?></label><?php echo $startdate;?>
		</li>

		<li>
		<label for="enddate"><?php echo $lang['siya']['leaves']['END_DATE']; ?></label><?php echo $enddate;?>
		</li>


		<li>
		<label for="applicationby"><?php echo $lang['siya']['leaves']['APPLICATION_BY']; ?></label><?php echo $submitteduserfullname;?>
		</li>
		
		<li>
		<label for="remarks"><?php echo $lang['siya']['leaves']['REMARKS'];?></label><?php echo $remarks;?>
		</li>
		<input type="hidden" name="userid" value="<?php echo $userid;?>" />
		<input type="hidden" name="groupid" value="<?php echo $groupid;?>" />
		<input type="hidden" name="batchid" value="<?php echo $batchid;?>" />
		<input type="hidden" name="submitteduserid" value="<?php echo $submitteduserid;?>" />
		<input type="hidden" name="leavetypeid" value="<?php echo $leavetypeid;?>" />
		<input type="hidden" name="startdate" value="<?php echo $startdate;?>" />
		<input type="hidden" name="enddate" value="<?php echo $enddate;?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks;?>" />
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>