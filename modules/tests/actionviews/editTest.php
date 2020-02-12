<script>
$(function() {
	$( "#startdate" ).datepicker();
	$( "#enddate" ).datepicker();
});
</script>
<?php

$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('tests','id',$id,'admin/getAdminHome/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('tests','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$name_placeholder = '';
$description_placeholder = '';
$startdate = '';
$enddate = '';
$duration = '';
$entitytypetag_placeholder = '';
$password = '';
//$assignedtoentitytypetag = '';


global $groupid_tag ,$batchid_tag,$subjectid_tag,$chapterid_tag,$topicid_tag,$semesterid_tag,$assessmenttypeid_tag,$assignedtoentitytypetag;
$batchid_tag = '';
$groupid_tag = '';
$subjectid_tag = '';
$topicid_tag = '';
$semesterid_tag = '';
$assessmenttypeid_tag = '';
$assignedtoentitytypetag = '';

$columns = array('id','groupid','batchid','subjectid','chapterid','topicid','semesterid','assessmenttypeid','reportthis','name','description','startdate','enddate','duration','assignedtoentitytypetag');
$sqlObj = new MainSQL();

$conditions = array();
$conditions['=']['id'] = $id;
$sql = $sqlObj->SQLCreator('S', 'tests', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$groupid_tag =  $sqlObj->getCleanData($resultset->groupid);
$batchid_tag =  $sqlObj->getCleanData($resultset->batchid);
$subjectid_tag =  $sqlObj->getCleanData($resultset->subjectid);
$chapterid_tag =  $sqlObj->getCleanData($resultset->chapterid);
$topicid_tag =  $sqlObj->getCleanData($resultset->topicid);
$assessmenttypeid_tag =  $sqlObj->getCleanData($resultset->assessmenttypeid);
$semesterid_tag =  $sqlObj->getCleanData($resultset->semesterid);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
$reportthis =  $sqlObj->getCleanData($resultset->reportthis);
$startdate =  $sqlObj->getCleanData($resultset->startdate);
$enddate =  $sqlObj->getCleanData($resultset->enddate);
$duration =  $sqlObj->getCleanData($resultset->duration);
$assignedtoentitytypetag =  $sqlObj->getCleanData($resultset->assignedtoentitytypetag);
}
}
}




// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag,$subjectid_tag,$topicid_tag;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'groupid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','grouptypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $groupid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$groupid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


//Batch ID
$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'batchid';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = 'All Batches';
$htmlarray[]['option']['end'] = '';

$columns = array('id','batchcode','title');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
($resultset->id == $batchid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
$htmlarray[]['option']['end'] = '';

}
}
}else{
trigger_error('Data Fetch Error');
}

$htmlarray[]['select']['end'] = '';
$batchid_placeholder = $HTMLObj->HTMLCreator($htmlarray);



// Subject ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'subjectid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','subjectcode','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $subjectid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->subjectcode).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$subjectid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// Chapter ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'chapterid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','description','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'chapters', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $subjectid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name);
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$chapterid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// Topic ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'topicid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','description','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'topics', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $topicid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name);
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$topicid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


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
($resultsetmenu->id == $assessmenttypeid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';

$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
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
$conditions['=']['batchid'] = $batchid_tag;
$conditions['AND =']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'semesters', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $semesterid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';

$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->title).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$semesterid_placeholder = $HTMLObj->HTMLCreator($htmlarray);



$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'assignedtoentitytypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

function recursiveMenu($pid='',$level){
global $htmlarray,$level,$assignedtoentitytypetag;
$level++;
$columns = array('e.id','e.entitytypetag','e.entityname');
$conditions = array();

$tables = array();
$tables['entities'] = 'e';
$tables['entitiesrelationship'] = 'er';

$conditions['=']['er.entitytype1'] = $pid;
$conditions['K AND =']['e.id'] = 'er.pid';
$conditions['AND =']['er.entityrelationtype'] = 'parent';


$sqlObj = new MainSQL();

$sqlmenu = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, 'e.id', '', '');
	
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$str = '';
for($i=0;$i<=$level;$i++){
$str .= '-';
}
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag);
($resultsetmenu->entitytypetag == $assignedtoentitytypetag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu->entityname).')';
$htmlarray[]['option']['end'] = '';
if($resultsetmenu->id != $pid){
recursiveMenu($resultsetmenu->id,$level);
$level--;
}
}
}
}
}

recursiveMenu(0,0);

$htmlarray[]['select']['end'] = '';

$entitytypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST) && isset($_POST['issubmit'])){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
$startdate_placeholder = (isset($_POST['startdate']))?$_POST['startdate']:'';
$enddate_placeholder = (isset($_POST['enddate']))?$_POST['enddate']:'';
$duration_placeholder = (isset($_POST['duration']))?$_POST['duration']:'';
$password_placeholder = (isset($_POST['password']))?$_POST['password']:'';

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
$formaction = MainSystem::URLCreator('tests/saveTest/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('tests/saveTest/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Test</legend>

	<ol>
		
		<li>
		<label for="assignedtoentitytypetag">Assigned To Entity	</label> <?php echo $entitytypetag_placeholder; ?>
		</li>

		<li>
		<label for="groupid">Group</label><?php echo $groupid_placeholder; ?>		
	    </li>
		
		<li>
		<label for="batchid">Batch</label><?php echo $batchid_placeholder; ?>
	    </li>

		<li>
		<label for="subjectid">Subject</label><?php echo $subjectid_placeholder; ?>
	    </li>
		
		<li>
		<label for="subjectid">Chapter</label><?php echo $chapterid_placeholder; ?>
	    </li>		

		<li>
		<label for="topicid">Topic</label><?php echo $topicid_placeholder; ?>
	    </li>
		

		<li>
		<label for="semesterid">Semester</label><?php echo $semesterid_placeholder; ?>
		</li>
			
		<li>
		<label for="assessmenttypeid">Assessment Type Id</label><?php echo $assessmenttypeid_placeholder; ?>
		</li>
		
		<li>
		<label for="name"><?php echo $lang['siya']['tests']['NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['tests']['NAME']; ?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['tests']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['tests']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		</li>
		
		<li>
		<label for="startdate"><?php echo $lang['siya']['tests']['START_DATE']; ?></label>
		<input id="startdate" name="startdate" type="text" placeholder="<?php echo $lang['siya']['tests']['START_DATE']; ?>" value="<?php echo $startdate; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="enddate"><?php echo $lang['siya']['tests']['END_DATE']; ?></label>
		<input id="enddate" name="enddate" type="text" placeholder="<?php echo $lang['siya']['tests']['END_DATE']; ?>" value="<?php echo $enddate; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="duration"><?php echo $lang['siya']['tests']['DURATION']; ?></label>
		<input id="duration" name="duration" type="text" placeholder="<?php echo $lang['siya']['tests']['DURATION']; ?>" value="<?php echo $duration; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="password"><?php echo $lang['siya']['tests']['PASSWORD']; ?></label>
		<input id="password" name="password" type="password" placeholder="<?php echo $lang['siya']['tests']['PASSWORD']; ?>" value="<?php echo $password; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label class="label_radio" for="reportthis">Report This </label><br />
		<input name="reportthis" id="reportthis-01" value="1" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" <?php  echo ($reportthis=='1')?'CHECKED':''; ?> />Yes<br />
		<input name="reportthis" id="reportthis-02" value="0" type="radio" <?php  echo ($reportthis=='0')?'CHECKED':''; ?>/>No<br />
		</li>

	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>