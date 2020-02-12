<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$remarks_placeholder = '';
$title_placeholder = '';

if(isset($_POST)){
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$remarks_placeholder = (isset($_POST['remarks']))?$_POST['remarks']:'';
}
?>

<h3>Meeting Details</h3>
<hr />
	<?php

	$columns = array('m.id','mt.name = meetingtypename','m.date','m.name = meetingname','m.description','m.addedby');
	$conditions = array();

	$tables = array();
	$tables['meetings'] = 'm';
	$tables['meetingtypes'] = 'mt';

	$conditions['=']['m.id'] = $id;
	$conditions['K AND =']['m.meetingtypeid'] = 'mt.id';

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id = $sqlObj->getCleanData($resultset->id);
	$date = $sqlObj->getCleanData($resultset->date);
	$meetingtypename = $sqlObj->getCleanData($resultset->meetingtypename);
	$meetingname = $sqlObj->getCleanData($resultset->meetingname);	
	$description = $sqlObj->getCleanData($resultset->description);
	$addedby = $resultset->addedby;

	$addedbyuser = MainSystem::getUserDetailsByID($addedby);
	$addedbyuserdetails = $addedbyuser->fname.' '.$addedbyuser->mname.' '.$addedbyuser->lname;
	$addedbyusertype = '['.$addedbyuser->usertypetag.' '.$addedbyuser->entitytypetag.']';
	?>
	
	<p><?php echo '<b>Meeting Type : </b>'.$meetingtypename.'<br /><b>Meeting Name : </b>'.$meetingname.'<br /><b>Meeting Description: </b>'.$description.' <br /><b>On : </b>'.$date.'<br /> <b>Added By : </b> '.$addedbyuserdetails.' '.$addedbyusertype; ?></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


	<script>
	$(document).ready(function(){
	$("#addform").validate();
	});
	</script>

	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('meetings/saveMeetingRemarks/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('meetings/saveMeetingRemarks/');
	}
	?>
	
	
	<br /><br /><hr />



	<h3>Meeting Remarks</h3>

	<?php

	$columns = array('id','title','remarks','added','addedby');
	$conditions = array();
	$conditions['=']['meetingid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'meetingremarks', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id = $sqlObj->getCleanData($resultset->id);
	$title = $sqlObj->getCleanData($resultset->title);	
	$remarks = $sqlObj->getCleanData($resultset->remarks);
	$added = $sqlObj->getCleanData($resultset->added);
	$addedby = $sqlObj->getCleanData($resultset->addedby);

	$addedbyuser = MainSystem::getUserDetailsByID($addedby);
	$addedbyuserdetails = $addedbyuser->fname.' '.$addedbyuser->mname.' '.$addedbyuser->lname;
	$addedbyusertype = '['.$addedbyuser->usertypetag.' '.$addedbyuser->entitytypetag.']';
	?>
	
	<br /><hr /><br /><p><?php echo '<b>Remarks Title : </b>'.$title.'<br /><b>Remarks: </b>'.$remarks.' <br /><b>On : </b>'.$added.'<br /> <b>Added By : </b> '.$addedbyuserdetails.' '.$addedbyusertype; ?></p>
									
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>




	<script>
	$(document).ready(function(){
	$("#addform").validate();
	});
	</script>

	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('meetings/saveMeetingRemarks/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('meetings/saveMeetingRemarks/');
	}
	?>

	<br />

	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

	<fieldset>

		<legend>Remarks</legend>

		<ol>


		<input id="meetingid" name="meetingid" type="hidden" value="<?php echo $id; ?>" <?php echo _FORM_FINAL; ?> />
		
					
		<label for="title">Title</label>
		<input id="title" name="title" type="text" placeholder="Enter Title" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		
		<br />

		<label for="remarks">Remarks Description</label>
		<textarea id="remarks" name="remarks" placeholder="Enter Remarks" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $remarks_placeholder; ?></textarea>
		
		
		</ol>
	<fieldset>

	<button type="submit">Add Remarks</button>

	</fieldset>

	</form>

	

