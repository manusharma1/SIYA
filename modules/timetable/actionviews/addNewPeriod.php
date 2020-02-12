<?php
$groupid_placeholder = '';
$periodid_placeholder = '';
$menu_placeholder = '';
$title_placeholder = '';
$starthour_placeholder = '';
$startminute_placeholder = '';
$endhour_placeholder = '';
$endminute_placeholder = '';

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
$("#addnewperiodform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('timetable/savePeriod/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('timetable/savePeriod/');
}
?>
<form id="addnewperiodform" name="addnewperiodform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add New Period</legend>

	<ol>
		<li>
		<label for="periodnumber"><?php echo $lang['siya']['timetable']['PERIOD_NUMBER']; ?></label>
		<select name="periodnumber" id="periodnumber">

			<option value="">--------------------</option>
			<option value="1">Period 1</option>
			<option value="2">Period 2</option>
			<option value="3">Period 3</option>
			<option value="4">Period 4</option>
			<option value="5">Period 5</option>
			<option value="6">Period 6</option>
			<option value="7">Period 7</option>
			<option value="8">Period 8</option>
			<option value="9">Period 9</option>
			<option value="10">Period 10</option>
			<option value="11">Period 11</option>
			<option value="12">Period 12</option>
			<option value="13">Period 13</option>
			<option value="14">Period 14</option>
			<option value="15">Period 15</option>

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
	    </li>

		<li>
		<label for="end"><?php echo $lang['siya']['timetable']['END_TIME']; ?></label><?php echo $endhour_placeholder.' : '.$endminute_placeholder; ?> 
	    </li>

		<li>
		<label for="day"><?php echo $lang['siya']['timetable']['DAYS']; ?></label>
		<select name="day" id="day" <?php echo _FORM_FINAL;?>>

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
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>