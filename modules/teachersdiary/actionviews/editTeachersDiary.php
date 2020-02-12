<script>
	$(function() {
		$( "#startdate" ).datepicker();
		$( "#enddate" ).datepicker();
	});
</script>
<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('teachersdiary','id',$id,'teachersdiary/manageTeachersDiary/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('teachersdiary','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}


$startdate_placeholder = '';
$enddate_placeholder = '';
$objective_placeholder = '';
$content_placeholder = '';
$homework_placeholder = '';


$columns = array('id','userid','groupid','batchid','subjectid','topicid','day','startdate','enddate','content','objective','homework');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'teachersdiary', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$userid = $sqlObj->getCleanData($resultset->userid);
$groupid = $sqlObj->getCleanData($resultset->groupid);
$batchid = $sqlObj->getCleanData($resultset->batchid);
$subjectid = $sqlObj->getCleanData($resultset->subjectid);
$topicid = $sqlObj->getCleanData($resultset->topicid);

$day_placeholder =  $sqlObj->getCleanData($resultset->day);
$startdate_placeholder =  $sqlObj->getCleanData($resultset->startdate);
$enddate_placeholder =  $sqlObj->getCleanData($resultset->enddate);
$content_placeholder =  $sqlObj->getCleanData($resultset->content);
$objective_placeholder =  $sqlObj->getCleanData($resultset->objective);
$homework_placeholder =  $sqlObj->getCleanData($resultset->homework);
}
}
}



if(isset($_POST) && isset($_POST['issubmit'])){
$day_placeholder = (isset($_POST['day']))?$_POST['day']:'';
$startdate_placeholder = (isset($_POST['startdate']))?$_POST['startdate']:'';
$enddate_placeholder = (isset($_POST['enddate']))?$_POST['enddate']:'';
$content_placeholder = (isset($_POST['content']))?$_POST['content']:'';
$objective_placeholder = (isset($_POST['objective']))?$_POST['objective']:'';
$homework_placeholder = (isset($_POST['homework']))?$_POST['homework']:'';
}


$content_placeholder = MainSystem::HTMLEditorInit('content',$content_placeholder); 
$objective_placeholder = MainSystem::HTMLEditorInit('objective',$objective_placeholder); 
$homework_placeholder = MainSystem::HTMLEditorInit('homework',$homework_placeholder); 
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
$formaction = MainSystem::URLCreator('teachersdiary/saveTeachersDiary/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('teachersdiary/saveTeachersDiary/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Teachers Diary</legend>

	<ol>
		
		<li>
		<label for="day">Days </label>
		<select name="day" id="day">

			<option value="">--------------------</option>
			<option value="MON" <?php  echo ($day_placeholder=='MON')?'SELECTED':''; ?> >MONDAY</option>
			<option value="TUE" <?php  echo ($day_placeholder=='TUE')?'SELECTED':''; ?> >TUESDAY</option>
			<option value="WED" <?php  echo ($day_placeholder=='WED')?'SELECTED':''; ?> >WEDNESDAY</option>
			<option value="THU" <?php  echo ($day_placeholder=='THU')?'SELECTED':''; ?> >THURSDAY</option>
			<option value="FRI" <?php  echo ($day_placeholder=='FRI')?'SELECTED':''; ?> >FRIDAY</option>
			<option value="SAT" <?php  echo ($day_placeholder=='SAT')?'SELECTED':''; ?> >SATURDAY</option>
			<option value="SUN" <?php  echo ($day_placeholder=='SUN')?'SELECTED':''; ?> >SUNDAY</option>

		</select>
	    </li>

		
		<li>
		<label for="startdate"><?php echo $lang['siya']['teachersdiary']['START_DATE']; ?></label>
		<input id="startdate" name="startdate" type="text" placeholder="<?php echo $lang['siya']['teachersdiary']['START_DATE']; ?>" required="" autofocus="" value="<?php echo $startdate_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" >
		</li>

		<li>
		<label for="enddate"><?php echo $lang['siya']['teachersdiary']['END_DATE']; ?></label>
		<input id="enddate" name="enddate" type="text" placeholder="<?php echo $lang['siya']['teachersdiary']['END_DATE']; ?>" required="" autofocus="" value="<?php echo $enddate_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" >
		</li>

		
		<li>
		<label for="content">Content </label><br />
		<?php echo $content_placeholder; ?>
		</li>

		<li>
		<label for="objective">Objective</label><br />
		<?php echo $objective_placeholder; ?>
		</li>

		<li>
		<label for="homework">Home Work </label><br />
		<?php echo $homework_placeholder; ?>
		</li>

		<input type="hidden" name="userid" value="<?php echo $userid; ?> ">
		<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
		<input id="batchid" name="batchid" type="hidden" value="<?php echo $batchid; ?>" /> 
		<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" /> 
		<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>