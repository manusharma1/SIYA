<?php
	//define placeholders
	$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('assignments','id',$id,'admin/getAdminHome/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('assignments','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}


	$subjectid='';
	$chapterid='';
	$groupid='';
	$topicid='';
	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

	$name_placeholder = '';
	$description_placeholder = '';
	$startdate_placeholder = '';
	$enddate_placeholder = '';
?>
<?php
$columns = array('a.id','a.name','a.description','a.startdate','a.enddate','c.id=chapterid','s.id=subjectid','t.id=topicid','g.id=groupid','t.name = topictname','g.name = groupname','s.name = subjectname','c.name = chaptername');
$conditions = array();

$tables = array();

$tables['assignments']  = 'a';
$tables['chapters']		= 'c';
$tables['topics']		= 't';
$tables['groups']		= 'g';
$tables['subjects']		= 's';
$conditions['=']['a.id'] = $id;
$conditions['K AND =']['c.id'] = 'a.chapterid';
$conditions['K AND =']['g.id'] = 'a.groupid';
$conditions['K AND =']['s.id'] = 'a.subjectid';
$conditions['K AND =']['t.id'] = 'a.topicid';


$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
//print_r($sql);
//die;
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset= $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$subjectid	=  $sqlObj->getCleanData($resultset->subjectid);
$chapterid	= $sqlObj->getCleanData($resultset->chapterid);	
$groupid = $sqlObj->getCleanData($resultset->groupid);
$topicid = $sqlObj->getCleanData($resultset->topicid);	
$name_placeholder = $sqlObj->getCleanData($resultset->name);
$description_placeholder = $sqlObj->getCleanData($resultset->description);
$startdate_placeholder	= $sqlObj->getCleanData($resultset->startdate);
$enddate_placeholder = $sqlObj->getCleanData($resultset->enddate);
}
}
}

if(isset($_POST) && isset($_POST['issubmit'])){

$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder =(isset($_POST['description']))?$_POST['description']:'';
$startdate_placeholder = (isset($_POST['startdate']))?$_POST['startdate']:'';
$enddate_placeholder = (isset($_POST['enddate']))?$_POST['enddate']:'';
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

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('assignments/saveAssignment/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assignments/saveAssignment/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend><?php echo $lang['siya']['assignments']['EDIT_ASSIGNMENTS'];?></legend>

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
		<label for="chapter"><?php echo $lang['siya']['CHAPTER'];?></label><?php echo MainSystem::getChapterInfobyID($chapterid)->name; ?>
	    </li>

		<li>
		<label for="topicid"><?php echo $lang['siya']['TOPIC'];?></label><?php echo MainSystem::getTopicInfobyID($topicid)->name; ?>
	    </li>
		
		<li>
		<label for="name"><?php echo $lang['siya']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['ENTER_NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['assignments']['ENTER_DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
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