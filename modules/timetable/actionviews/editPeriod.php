<?php
$id = _ACTION_VIEW_PARAMETER_ID;

MainSystem::CheckIDExists('periods','id',$id,'cms/managePages/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('periods','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$groupid = '';
$periodnumber = '';
$groupid = '';
$batchid = '';
$starttime = '';
$title_placeholder = '';
$starthour_placeholder = '';
$startminute_placeholder = '';
$endhour_placeholder = '';
$endminute_placeholder = '';


$columns = array('id','periodnumber','title','groupid','batchid','starttime','endtime','day');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'periods', $columns, $conditions, '', '', '');
if($result= $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
if($resultset = $sqlObj->FetchResult($result)){
$periodnumber = $resultset->periodnumber;
$groupid = $resultset->groupid;
$batchid = $resultset->batchid;
$title_placeholder = $resultset->title;
$starttime = $resultset->starttime;
$endtime = $resultset->endtime;

$starttimearray = explode(':',$starttime);

$starttimehr = $starttimearray[0];
$starttimemin = $starttimearray[1];

$endtimearray = explode(':',$endtime);

$endtimehr = $endtimearray[0];
$endtimemin = $endtimearray[1];


$day = $resultset->day;
}else{
trigger_error('Data Fetch Error');
}
}else{ // if Page Doesn't Exists
$_SESSION['message'] = 'Period Does Not Exists';
MainSystem::URLForwarder(MainSystem::URLCreator('timetable/managePeriods/'));
}
}else{
trigger_error('SQL Error');
}


// Semester ID //

$HTMLObj = new MainHTML();
global $htmlarray;
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
($resultsetmenu->id == $groupid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$groupid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


	
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
$htmlarray[]['option']['value'] = $resultset->id;
($resultset->id == $batchid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
$htmlarray[]['option']['end'] = '';

}
}
}else{
trigger_error('Data Fetch Error');
}


$htmlarray[]['select']['end'] = '';
$menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);




$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'starthour';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '--';
$htmlarray[]['option']['end'] = '';


for($i=1;$i<=24;$i++){

if($i<10){
$hr = '0'.$i;
}
else{ 
$hr = $i;
}

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $hr;
($i == $starttimehr)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $hr;
$htmlarray[]['option']['end'] = '';

}

$htmlarray[]['select']['end'] = '';
$starthour_placeholder = $HTMLObj->HTMLCreator($htmlarray);


$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'startminute';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '--';
$htmlarray[]['option']['end'] = '';


for($i=0;$i<=59;$i++){

if($i<10){
$min = '0'.$i;
}
else{ 
$min = $i;
}

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $min;
($i == $starttimemin)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $min;
$htmlarray[]['option']['end'] = '';

}

$htmlarray[]['select']['end'] = '';
$startminute_placeholder = $HTMLObj->HTMLCreator($htmlarray);



$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'endhour';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '--';
$htmlarray[]['option']['end'] = '';


for($i=1;$i<=24;$i++){

if($i<10){
$hr = '0'.$i;
}
else{ 
$hr = $i;
}

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $hr;
($i == $endtimehr)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $hr;
$htmlarray[]['option']['end'] = '';

}

$htmlarray[]['select']['end'] = '';
$endhour_placeholder = $HTMLObj->HTMLCreator($htmlarray);


$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'endminute';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '--';
$htmlarray[]['option']['end'] = '';


for($i=0;$i<=59;$i++){

if($i<10){
$min = '0'.$i;
}
else{ 
$min = $i;
}

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $min;
($i == $endtimemin)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $min;
$htmlarray[]['option']['end'] = '';

}

$htmlarray[]['select']['end'] = '';
$endminute_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST)){
$subjectcode_placeholder = (isset($_POST['subjectcode']))?$_POST['subjectcode']:'';
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
$("#editperiodform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('timetable/savePeriod/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('timetable/savePeriod/');
}
?>
<form id="editperiodform" name="editperiodform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['timetable']['EDIT_PERIOD']; ?></legend>

	<ol>
		<li>
		<label for="periodnumber"><?php echo $lang['siya']['timetable']['PERIOD_NUMBER']; ?></label>
		<select name="periodnumber" id="periodnumber" <?php echo _FORM_FINAL;?>>

			<option value="">--------------------</option>
			<option value="1" <?php echo (1 == $periodnumber)?'SELECTED':'';?>>Period 1</option>
			<option value="2" <?php echo (2 == $periodnumber)?'SELECTED':'';?>>Period 2</option>
			<option value="3" <?php echo (3 == $periodnumber)?'SELECTED':'';?>>Period 3</option>
			<option value="4" <?php echo (4 == $periodnumber)?'SELECTED':'';?>>Period 4</option>
			<option value="5" <?php echo (5 == $periodnumber)?'SELECTED':'';?>>Period 5</option>
			<option value="6" <?php echo (6 == $periodnumber)?'SELECTED':'';?>>Period 6</option>
			<option value="7" <?php echo (7 == $periodnumber)?'SELECTED':'';?>>Period 7</option>
			<option value="8" <?php echo (8 == $periodnumber)?'SELECTED':'';?>>Period 8</option>
			<option value="9" <?php echo (9 == $periodnumber)?'SELECTED':'';?>>Period 9</option>
			<option value="10" <?php echo (10 == $periodnumber)?'SELECTED':'';?>>Period 10</option>
			<option value="11" <?php echo (11 == $periodnumber)?'SELECTED':'';?>>Period 11</option>
			<option value="12" <?php echo (12 == $periodnumber)?'SELECTED':'';?>>Period 12</option>
			<option value="13" <?php echo (13 == $periodnumber)?'SELECTED':'';?>>Period 13</option>
			<option value="14" <?php echo (14 == $periodnumber)?'SELECTED':'';?>>Period 14</option>
			<option value="15" <?php echo (15 == $periodnumber)?'SELECTED':'';?>>Period 15</option>

		</select>
	    </li>

		<li>
		<label for="groupid">Group </label><?php echo $groupid_placeholder; ?>
	    </li>
		
		<li>
		<label for="batchid">Batch </label><?php echo $menu_placeholder; ?> 
	    </li>
		
		<li>
		<label for="title"><?php echo $lang['siya']['timetable']['TITLE']; ?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['timetable']['TITLE']; ?>"  autofocus="" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL;?>>
		</li>
		
		<li>
		<label for="start"><?php echo $lang['siya']['timetable']['START_TIME']; ?></label> <?php echo $starthour_placeholder.' : '.$startminute_placeholder; ?> 
		</select>
	    </li>

		<li>
		<label for="end"><?php echo $lang['siya']['timetable']['END_TIME']; ?></label><?php echo $endhour_placeholder.' : '.$endminute_placeholder; ?> 
	    </li>

		<li>
		<label for="day"><?php echo $lang['siya']['timetable']['DAYS']; ?></label>
		<select name="day" id="day" <?php echo _FORM_FINAL;?>>

			<option value="">--------------------</option>
			<option value="MON" <?php echo ($day == 'MON')?'SELECTED':'';?>>MONDAY</option>
			<option value="TUE" <?php echo ($day == 'TUE')?'SELECTED':'';?>>TUESDAY</option>
			<option value="WED" <?php echo ($day == 'WED')?'SELECTED':'';?>>WEDNESDAY</option>
			<option value="THU" <?php echo ($day == 'THU')?'SELECTED':'';?>>THURSDAY</option>
			<option value="FRI" <?php echo ($day == 'FRI')?'SELECTED':'';?>>FRIDAY</option>
			<option value="SAT" <?php echo ($day == 'SAT')?'SELECTED':'';?>>SATURDAY</option>
			<option value="SUN" <?php echo ($day == 'SUN')?'SELECTED':'';?>>SUNDAY</option>

		</select>
	    </li>
		</ol>

<fieldset>
<input type="hidden" name="periodid" value="<?php echo $id?>" />

<button type="submit">Save</button>

</fieldset>

</form>