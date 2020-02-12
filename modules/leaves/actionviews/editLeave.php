<script>
$(function() {
	$( "#startdate" ).datepicker({dateFormat:'yy-mm-dd'});
	$( "#enddate" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>

<?php

$id = _ACTION_VIEW_PARAMETER_ID;

MainSystem::CheckIDExists('leaves','id',$id,'leaves/manageLeaves/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('leaves','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}


$entitytypetag= '';
$userid= '';
$leavetypeid= '';
$startdate= '';
$enddate= '';
$starttimeperiod= '';
$endtimeperiod= '';
$applicationby= '';
$approvedby= '';
$remarks= '';





global $leavetypeid_tag;
$leavetypeid_tag = '';



$columns = array('id','userid','leavetypeid','startdate','enddate','starttimeperiod','endtimeperiod','applicationby','approvedby','remarks');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'leaves', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$userid =  $sqlObj->getCleanData($resultset->userid);
$leavetypeid_tag =  $sqlObj->getCleanData($resultset->leavetypeid);
$startdate =  $sqlObj->getCleanData($resultset->startdate);
$enddate =  $sqlObj->getCleanData($resultset->enddate);
$starttimeperiod =  $sqlObj->getCleanData($resultset->starttimeperiod);
$endtimeperiod =  $sqlObj->getCleanData($resultset->endtimeperiod);
$applicationby =  $sqlObj->getCleanData($resultset->applicationby);
$approvedby =  $sqlObj->getCleanData($resultset->approvedby);
$remarks =  $sqlObj->getCleanData($resultset->remarks);

$user = MainSystem::getUserDetailsByID($userid);
$userdetails = $user->fname.' '.$user->mname.' '.$user->lname;
$usertype = '['.$user->usertypetag.' '.$user->entitytypetag.']';

$addedbyuser = MainSystem::getUserDetailsByID($applicationby);
$addedbyuserdetails = $addedbyuser->fname.' '.$addedbyuser->mname.' '.$addedbyuser->lname;
$addedbyusertype = '['.$addedbyuser->usertypetag.' '.$addedbyuser->entitytypetag.']';

if($approvedby != 0){
$approvedbyuser = MainSystem::getUserDetailsByID($approvedby);
$approvedbyuserdetails = $user->fname.' '.$user->mname.' '.$user->lname;
$approvedbyusertype = '['.$user->usertypetag.' '.$user->entitytypetag.']';
}else{
$approvedbyuserdetails = 'Not Approved';
$approvedbyusertype = '';
}

}
}
}


// Leave Type Tag //

$HTMLObj = new MainHTML();
global $htmlarray;
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
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->leavetypetag);
($resultsetmenu->id == $leavetypeid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->leavetypetag).' ('.$sqlObj->getCleanData($resultsetmenu->title).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$leavetypeid= $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST) && isset($_POST['issubmit'])){

$entitytypetag= (isset($_POST['entitytypetag']))?$_POST['entitytypetag']:'';
$userid= (isset($_POST['userid']))?$_POST['userid']:'';
$leavetypeid= (isset($_POST['leavetypeid']))?$_POST['leavetypeid']:'';
$startdate= (isset($_POST['startdate']))?$_POST['startdate']:'';
$enddate= (isset($_POST['enddate']))?$_POST['enddate']:'';
$starttimeperiod= (isset($_POST['starttimeperiod']))?$_POST['starttimeperiod']:'';
$endtimeperiod= (isset($_POST['endtimeperiod']))?$_POST['endtimeperiod']:'';
$applicationby= (isset($_POST['applicationby']))?$_POST['applicationby']:'';
$approvedby= (isset($_POST['approvedby']))?$_POST['approvedby']:'';
$remarks= (isset($_POST['remarks']))?$_POST['remarks']:'';

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
$("#editleaveform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('leaves/saveLeave/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('leaves/saveLeave/'.$id.'/');
}
?>
<form id="editleaveform" name="editleaveform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Leave </legend>

	<ol>
		
		<li>
		<label for="userid"><?php echo $lang['siya']['leaves']['USER_ID'];?></label>
		<?php echo $userdetails.' '.$usertype; ?>
		</li>
		

		<li>
		<label for="leavetypeid"><?php echo $lang['siya']['leaves']['LEAVE_TYPE_ID'];?></label><?php echo $leavetypeid; ?>
		</li>
		
		<li>
		<label for="startdate"><?php echo $lang['siya']['leaves']['START_DATE'];?></label>
		<input id="startdate" name="startdate" type="text" placeholder="<?php echo $lang['siya']['leaves']['START_DATE'];?> " value="<?php echo $startdate; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="enddate"><?php echo $lang['siya']['leaves']['END_DATE'];?></label>
		<input id="enddate" name="enddate" type="text" placeholder="<?php echo $lang['siya']['leaves']['END_DATE'];?>" value="<?php echo $enddate; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		
		<li>
		<label for="starttimeperiod"><?php echo $lang['siya']['leaves']['START_TIME_PERIOD'];?></label>
		<input id="starttimeperiod" name="starttimeperiod" type="text" placeholder="<?php echo $lang['siya']['leaves']['START_TIME_PERIOD'];?>" value="<?php echo $starttimeperiod; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="endtimeperiod"><?php echo $lang['siya']['leaves']['END_TIME_PERIOD'];?></label>
		<input id="endtimeperiod" name="endtimeperiod" type="text" placeholder="<?php echo $lang['siya']['leaves']['END_TIME_PERIOD'];?>" value="<?php echo $endtimeperiod; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="applicationby"><?php echo $lang['siya']['leaves']['APPLICATION_BY'];?></label>
		<!-- <input id="applicationby" name="applicationby" type="text" placeholder="<?php echo $lang['siya']['leaves']['APPLICATION_BY'];?>" value="<?php echo $applicationby; ?>" <?php echo _FORM_FINAL; ?> /> -->
		<?php echo $addedbyuserdetails.' '.$addedbyusertype; ?>
		</li>

		<li>
		<label for="approvedby"><?php echo $lang['siya']['leaves']['APPROVED_BY'];?></label>
		<!-- <input id="approvedby" name="approvedby" type="text" placeholder="<?php echo $lang['siya']['leaves']['APPROVED_BY'];?>" value="<?php echo $approvedby; ?>" <?php echo _FORM_FINAL; ?> /> -->
		<?php echo $approvedbyuserdetails.' '.$approvedbyusertype; ?>
		</li>
		
		<li>
		<label for="remarks"><?php echo $lang['siya']['leaves']['REMARKS']; ?></label>
		<input id="remarks" name="remarks" type="text" placeholder="<?php echo $lang['siya']['leaves']['REMARKS']; ?>" value="<?php echo $remarks; ?>" <?php echo _FORM_FINAL; ?> />
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