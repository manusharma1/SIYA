<?php


		$subjectid	=	(isset($_POST['subjectid']))?$_POST['subjectid']:'';
		$chapterid	=	(isset($_POST['chapterid']))?$_POST['chapterid']:'';
		$groupid	=	(isset($_POST['groupid']))?$_POST['groupid']:'';
		$topicid	=	(isset($_POST['topicid']))?$_POST['topicid']:'';
		$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
		
	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////
		
		MainSystem::CheckGroupPermissions($groupid,'group');

		$name_placeholder = '';
		$description_placeholder = '';
		$startdate_placeholder = '';
		$enddate_placeholder = '';
		
		
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

<script>
$(function() {
	$( "#startdate" ).datepicker({dateFormat:'yy-mm-dd'});
	$( "#enddate" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('assignments/saveAssignment/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assignments/saveAssignment/');
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



<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend><?php echo $lang['siya']['assignments']['ADD_ASSIGNMENTS'];?></legend>

	<ol>
		<li>
		<label for="groupid"><?php echo $lang['siya']['GROUP'];?> </label><?php echo MainSystem::getGroupInfobyID($groupid)->name; ?>
			
	    </li>
		
		<li>
		<label for="batchid"><?php echo $lang['siya']['BATCH'];?> </label><?php echo MainSystem::getBatchInfobyID($selected_batch_id)->title; ?>
		
	    </li>

		<li>
		<label for="subjectid"><?php echo $lang['siya']['SUBJECT'];?> </label><?php echo MainSystem::getSubjectInfobyID($subjectid)->name; ?>
	    </li>

		<li>
		<label for="chapter"><?php echo $lang['siya']['CHAPTER'];?> </label><?php echo MainSystem::getChapterInfobyID($subjectid)->name; ?>
	    </li>

		<li>
		<label for="topicid"><?php echo $lang['siya']['TOPIC'];?> </label><?php echo MainSystem::getTopicInfobyID($chapterid)->name; ?>
	    </li>
		
		<li>
		<label for="name"><?php echo $lang['siya']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['ENTER_NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['assignments']['ENTER_DESCRIPTION'];?>" rows="5" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>

		<li>
		<label for="startdate"><?php echo $lang['siya']['assignments']['START_DATE'];?></label>
		<input id="startdate" name="startdate" type="text" placeholder="<?php echo $lang['siya']['assignments']['ENTER_START_DATE'];?>" value="<?php echo $startdate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="endate"><?php echo $lang['siya']['assignments']['END_DATE'];?></label>
		<input id="enddate" name="enddate" type="text" placeholder="<?php echo $lang['siya']['assignments']['ENTER_END_DATE'];?>" value="<?php echo $enddate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
				
		<div id="additionalfields">

		</div>
		<input type="button" onclick="addOptions()" name="addbutton" value="Upload File" />
		

	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
<input id="batchid" name="batchid" type="hidden" value="<?php echo $selected_batch_id; ?>" /> 
<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" />
<input id="chapterid" name="chapterid" type="hidden" value="<?php echo $chapterid; ?>" />
<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 

</form>