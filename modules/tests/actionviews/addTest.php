<script>
$(function() {
	$( "#startdate" ).datepicker({dateFormat:'yy-mm-dd'});
	$( "#enddate" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>
<?php
		
	$subjectid	=	(isset($_POST['subjectid']))?$_POST['subjectid']:'';
	$chapterid	=	(isset($_POST['chapterid']))?$_POST['chapterid']:'';
	$groupid	=	(isset($_POST['groupid']))?$_POST['groupid']:'';
	$topicid	=	(isset($_POST['topicid']))?$_POST['topicid']:'';
	$batchid = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////
		
	MainSystem::CheckGroupPermissions($groupid,'group');

	$name_placeholder = '';
	$description_placeholder = '';
	$startdate_placeholder = '';
	$enddate_placeholder = '';
	$duration_placeholder = '';
	$entitytypetag_placeholder = '';
	$password_placeholder = '';


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
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$assessmenttypeid = $HTMLObj->HTMLCreator($htmlarray);



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
$conditions['=']['batchid'] = $batchid;
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
$semesterid = $HTMLObj->HTMLCreator($htmlarray);



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
global $htmlarray,$level;
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



if(isset($_POST)){
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
$formaction = MainSystem::URLCreator('tests/saveTest/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('tests/saveTest/');
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
		<label for="semesterid">Semester ID</label>
		<?php echo $semesterid; ?>
		</li>
	
		
		<li>
		<label for="assessmenttypeid">Assessment Type</label>
		<?php echo $assessmenttypeid; ?>
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
		<input id="startdate" name="startdate" type="text" placeholder="<?php echo $lang['siya']['tests']['START_DATE']; ?>" value="<?php echo $startdate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="enddate"><?php echo $lang['siya']['tests']['END_DATE']; ?></label>
		<input id="enddate" name="enddate" type="text" placeholder="<?php echo $lang['siya']['tests']['END_DATE']; ?>" value="<?php echo $enddate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="duration"><?php echo $lang['siya']['tests']['DURATION']; ?></label>
		<input id="duration" name="duration" type="text" placeholder="<?php echo $lang['siya']['tests']['DURATION']; ?>" value="<?php echo $duration_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="password"><?php echo $lang['siya']['tests']['PASSWORD']; ?></label>
		<input id="password" name="password" type="password" placeholder="<?php echo $lang['siya']['tests']['PASSWORD']; ?>" value="<?php echo $password_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label class="label_radio" for="reportthis">Report This </label><br />
		<input name="reportthis" id="reportthis-01" value="1" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />Yes<br />
		<input name="reportthis" id="reportthis-02" value="0" type="radio" />No<br />
		</li>

		<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
		<input id="batchid" name="batchid" type="hidden" value="<?php echo $batchid; ?>" /> 
		<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" /> 
		<input id="chapterid" name="chapterid" type="hidden" value="<?php echo $chapterid; ?>" /> 
		<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 

	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>