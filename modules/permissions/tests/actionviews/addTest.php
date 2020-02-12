<script>
$(function() {
	$( "#startdate" ).datepicker();
	$( "#enddate" ).datepicker();
});
</script>
<?php
$subjectid=$_POST['subjectid'];
$groupid=$_POST['groupid'];
$topicid=$_POST['topicid'];
$batchid=$_POST['batchid'];

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
		<label for="groupid"><?php echo $lang['siya']['tests']['GROUP'];?> <?php echo $groupid; ?>
			<input id="groupid" name="<?php echo $lang['siya']['tests']['GROUP'];?>" type="hidden" value="<?php echo $groupid; ?>"/>
			</label>
	    </li>
		
		<li>
		<label for="batchid"><?php echo $lang['siya']['tests']['BATCH'];?><?php echo $batchid; ?>
			<input id="batchid" name="<?php echo $lang['siya']['tests']['BATCH'];?>" type="hidden" value="<?php echo $batchid; ?>" /> 
		</label>
	    </li>

		<li>
		<label for="topicid"><?php echo $lang['siya']['tests']['TOPIC'];?><?php echo $topicid; ?>
		<input id="topicid" name="<?php echo $lang['siya']['tests']['TOPIC'];?>" type="hidden" value="<?php echo $topicid; ?>" /> 
		</label>
	    </li>

		<li>
		<label for="subjectid"><?php echo $lang['siya']['tests']['SUBJECT'];?><?php echo $subjectid; ?> 
		<input id="subjectid" name="<?php echo $lang['siya']['tests']['SUBJECT'];?>" type="hidden" value="<?php echo $subjectid; ?>" /> 
		</label>
	    </li>
		
		<li>
		<label for="assignedtoentitytypetag"><?php echo $lang['siya']['tests']['ASSIGNED_TO_ENTITY'];?><?php echo $entitytypetag_placeholder; ?>
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