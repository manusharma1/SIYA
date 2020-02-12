<script>
	$(function() {
		$( "#startdate" ).datepicker();
		$( "#enddate" ).datepicker();
	});
</script>
<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	MainSystem::CheckGroupPermissions($id,'group');

	$groupid=(isset($_POST['subjectid']))?$_POST['subjectid']:(isset($parameters[1]))?$parameters[1]:'';
	$subjectid=(isset($_POST['subjectid']))?$_POST['subjectid']:'';
	$topicid=(isset($_POST['topicid']))?$_POST['topicid']:'';
	$batchid=(isset($_POST['batchid']))?$_POST['batchid']:(isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

	$startdate = '';
	$enddate = '';
	$objective = '';
	$content = '';
	$homework = '';




if(isset($_POST)){
$startdate = (isset($_POST['startdate']))?$_POST['startdate']:'';
$enddate = (isset($_POST['enddate']))?$_POST['enddate']:'';
$content = (isset($_POST['content']))?$_POST['content']:'';
$objective = (isset($_POST['objective']))?$_POST['objective']:'';
$homework = (isset($_POST['homework']))?$_POST['homework']:'';

}

$content = MainSystem::HTMLEditorInit('content'); 
$objective = MainSystem::HTMLEditorInit('objective'); 
$homework = MainSystem::HTMLEditorInit('homework'); 
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
$formaction = MainSystem::URLCreator('teachersdiary/saveTeachersDiary/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('teachersdiary/saveTeachersDiary/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Teachers Diary</legend>

	<ol>
		
		<li>
		<label for="day">Days </label>
		<select name="day" id="day">

			<option value="">--------------------</option>
			<option value="MON">MONDAY</option>
			<option value="TUE">TUESDAY</option>
			<option value="WED">WEDNESDAY</option>
			<option value="THU">THURSDAY</option>
			<option value="FRI">FRIDAY</option>
			<option value="SAT">SATURDAY</option>
			<option value="SUN">SUNDAY</option>

		</select>
	    </li>

		<li>
		<label for="startdate"><?php echo $lang['siya']['teachersdiary']['START_DATE']; ?></label>
		<input id="startdate" name="startdate" type="text" placeholder="<?php echo $lang['siya']['teachersdiary']['START_DATE']; ?>" required="" autofocus="" value="<?php echo $startdate; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required">
		</li>

		<li>
		<label for="enddate"><?php echo $lang['siya']['teachersdiary']['END_DATE']; ?></label>
		<input id="enddate" name="enddate" type="text" placeholder="<?php echo $lang['siya']['teachersdiary']['END_DATE']; ?>" required="" autofocus="" value="<?php echo $enddate; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required">
		</li>
		
		<li>
		<label for="content">Content </label><br />
		<?php echo $content; ?>
		</li>

		<li>
		<label for="objective">Objective</label><br />
		<?php echo $objective; ?>
		</li>

		<li>
		<label for="homework">Home Work </label><br />
		<?php echo $homework; ?>
		</li>
		
		<input id="userid" name="userid" type="hidden" value="<?php echo MainSystem::GetSessionUserID(); ?>"/>
		<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
		<input id="batchid" name="batchid" type="hidden" value="<?php echo $batchid; ?>" /> 
		<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" /> 
		<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>