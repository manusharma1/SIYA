<script>
$(function() {
	$( "#date" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>

<?php
$groupid_placeholder = '';
$batchid_placeholder = '';
$date_placeholder = '';

// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'groupid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['close'] = '';
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = 'All Groups';
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
$batchid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST)){
$date_placeholder = (isset($_POST['date']))?$_POST['date']:'';

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
$("#addholidayform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('holidays/saveHoliday/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('holidays/saveHoliday/');
}
?>
<form id="addholidayform" name="addholidayform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Holidays</legend>

	<ol>
		<li>
		<label for="groupid">Group </label><?php echo $groupid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="batchid">Batch </label><?php echo $batchid_placeholder; ?>
	    </li>
		
		<li>
		<label class="label_radio" for="radio-01"><input name="type" id="radio-01" value="D" type="radio" <?php echo _FORM_FINAL;?>  />Day</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="date" name="date" type="text" placeholder="Enter Date" value="<?php echo $date_placeholder; ?>" />
		
		</li> 

		<li>
		<label class="label_radio" for="radio-02"><input name="type" id="radio-02" value="W" type="radio" <?php echo _FORM_FINAL;?> />Day in Week</label>

				<select name="day" id="day">

				<option value="MON">Monday</option>
				<option value="TUE">Tuesday</option>
				<option value="WED">Wednesday</option>
				<option value="THU">Thursday</option>
				<option value="FRI">Friday</option>
				<option value="SAT">Saturday</option>
				<option value="SUN">Sunday</option>

			</select> 
		</li> 

		<li>
		<label class="label_radio" for="radio-03"><input name="type" id="radio-03" value="M" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />Week & Month Combination</label>

		<select name="day" id="day">

				<option value="MON">Monday</option>
				<option value="TUE">Tuesday</option>
				<option value="WED">Wednesday</option>
				<option value="THU">Thursday</option>
				<option value="FRI">Friday</option>
				<option value="SAT">Saturday</option>
				<option value="SUN">Sunday</option>

		</select>
		<select name="week" id="week">

				<option value="1">Week 1</option>
				<option value="2">Week 2</option>
				<option value="3">Week 3</option>
				<option value="4">Week 4</option>
				<option value="5">Week 5</option>
		</select>
		
		<select name="month" id="month">

				<option value="JAN">January</option>
				<option value="FEB">February</option>
				<option value="MAR">March</option>
				<option value="APR">April</option>
				<option value="MAY">May</option>
				<option value="JUN">June</option>
				<option value="JUL">July</option>
				<option value="Aud">August</option>
				<option value="Sep">September</option>
				<option value="OCT">October</option>
				<option value="NOV">November</option>
				<option value="DEC">December</option>
		</select>
		
		</li> 


   <li>
    <label for="remarks">Remarks </label>
    <textarea name="remarks" cols="50" rows="5"></textarea>
  </li>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>