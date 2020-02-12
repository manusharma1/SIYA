<?php
		$subjectid	=	(isset($_POST['subjectid']))?$_POST['subjectid']:'';
		$chapterid	=	(isset($_POST['chapterid']))?$_POST['chapterid']:'';
		$groupid	=	(isset($_POST['groupid']))?$_POST['groupid']:'';
		$topicid	=	(isset($_POST['topicid']))?$_POST['topicid']:'';
		
	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////
		
		MainSystem::CheckGroupPermissions($groupid,'group');



$semesterid = '';
$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
$assessmenttypeid_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';



$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'assessmenttypeid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','name','description');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'assessmenttypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name);
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$assessmenttypeid_placeholder = $HTMLObj->HTMLCreator($htmlarray);



$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'semesterid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','title','description');
$conditions = array();
$conditions['=']['batchid'] = $selected_batch_id;
$conditions['AND =']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'semesters', $columns, $conditions, 'semestercode', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->title).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$semesterid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST)){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';

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
$("#addassessmentform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('assessments/saveAssessment/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assessments/saveAssessment/');
}
?>
<form id="addassessmentform" name="addassessmentform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['assessments']['ADD_ASSESSMENT'];?></legend>

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
		<label for="chapter"><?php echo $lang['siya']['CHAPTER'];?> </label><?php echo MainSystem::getChapterInfobyID($chapterid)->name; ?>
	    </li>

		<li>
		<label for="topicid"><?php echo $lang['siya']['TOPIC'];?> </label><?php echo MainSystem::getTopicInfobyID($topicid)->name; ?>
	    </li>

		<li>
		<label for="semesterid"><?php echo $lang['siya']['assessments']['SEMESTER'];?></label>
		<?php echo $semesterid_placeholder; ?>
		</li>
	
		
		<li>
		<label for="assessmenttypeid"><?php echo $lang['siya']['assessments']['ASSESSMENT_TYPE'];?></label>
		<?php echo $assessmenttypeid_placeholder; ?>
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['assessments']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['assessments']['ENTER_NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['assessments']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['assessments']['ENTER_DESCRIPTION'];?>" rows="5" required="" autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>

		<li>
		<label class="label_radio" for="reportthis">Report This </label><br />
		<input name="reportthis" id="reportthis-01" value="1" type="radio" <?php echo _FORM_FINAL; ?> />Yes<br />
		<input name="reportthis" id="reportthis-02" value="0" type="radio" />No<br />
		</li>
	
		<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
		<input id="batchid" name="batchid" type="hidden" value="<?php echo $selected_batch_id; ?>" />
		<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" />
		<input id="chapterid" name="chapterid" type="hidden" value="<?php echo $chapterid; ?>" />
		<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" />
	
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>