<script>
$(function() {
	$( "#date" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>
<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('holidays','id',$id,'holidays/manageHolidays/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('holidays','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$groupid = '';
$menu = '';
$date = '';


global $groupid_tag ,$batchid_tag;
$batchid_tag = '';
$groupid_tag = '';



$columns = array('id','groupid','batchid','type','day','week','month','date','remarks');
$sqlObj = new MainSQL();

$conditions = array();
$conditions['=']['id'] = $id;
$sql = $sqlObj->SQLCreator('S', 'holidays', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$groupid_tag =  $sqlObj->getCleanData($resultset->groupid);
$batchid_tag =  $sqlObj->getCleanData($resultset->batchid);
$type =  $sqlObj->getCleanData($resultset->type);
$day =  $sqlObj->getCleanData($resultset->day);
$week =  $sqlObj->getCleanData($resultset->week);
$month =  $sqlObj->getCleanData($resultset->month);
$date =  $sqlObj->getCleanData($resultset->date);
$remarks =  $sqlObj->getCleanData($resultset->remarks);
}
}
}



// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
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
$groupid = $HTMLObj->HTMLCreator($htmlarray);


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
$batchid = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST) && isset($_POST['issubmit'])){
$date = (isset($_POST['date']))?$_POST['date']:'';

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
$("#editholidayform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('holidays/saveHoliday/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('holidays/saveHoliday/'.$id.'/');
}
?>
<form id="editholidayform" name="editholidayform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Holiday</legend>

	<ol>
		<li>
		<label for="groupid">Group </label><?php echo $groupid; ?> 
	    </li>
		
		<li>
		<label for="batchid">Batch </label><?php echo $batchid; ?> 
	    </li>
		
		<li>
		<label class="label_radio" for="radio-01"><input name="type" id="radio-01" value="D" type="radio" <?php echo _FORM_FINAL;?> <?php  echo ($type=='D')?'CHECKED':''; ?> />Day</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="date" name="date" type="text" placeholder="Enter Date" value="<?php echo $date; ?>" <?php echo _FORM_FINAL;?> />
		
		</li> 

		<li>
		<label class="label_radio" for="radio-02"><input name="type" id="radio-02" value="W" type="radio" <?php echo _FORM_FINAL;?><?php  echo ($type=='W')?'CHECKED':''; ?> />Day in Week</label>
		&nbsp;&nbsp;&nbsp;
				<select name="day" id="day" <?php echo _FORM_FINAL;?>>

				<option value="">--------------------</option>
				<option value="MON" <?php  echo ($day=='MON')?'SELECTED':''; ?> > Monday </option>
				<option value="TUE" <?php  echo ($day=='TUE')?'SELECTED':''; ?> > Tuesday </option>
				<option value="WED" <?php  echo ($day=='WED')?'SELECTED':''; ?> > Wednesday </option>
				<option value="THU" <?php  echo ($day=='THU')?'SELECTED':''; ?> > Thursday </option>
				<option value="FRI" <?php  echo ($day=='FRI')?'SELECTED':''; ?> > Friday </option>
				<option value="SAT" <?php  echo ($day=='SAT')?'SELECTED':''; ?> > Saturday </option>
				<option value="SUN" <?php  echo ($day=='SUN')?'SELECTED':''; ?> > Sunday </option>

			</select> 
		</li> 

		<li>
		<label class="label_radio" for="radio-03"><input name="type" id="radio-03" value="M" type="radio" <?php echo _FORM_FINAL;?> <?php  echo ($type=='M')?'CHECKED':''; ?> />Week & Month Combination</label>
		&nbsp;&nbsp;

		<select name="day" id="day" <?php echo _FORM_FINAL;?>>

				<option value="">--------------------</option>
				<option value="MON" <?php  echo ($day=='MON')?'SELECTED':''; ?> > Monday </option>
				<option value="TUE" <?php  echo ($day=='TUE')?'SELECTED':''; ?> > Tuesday </option>
				<option value="WED" <?php  echo ($day=='WED')?'SELECTED':''; ?> > Wednesday </option>
				<option value="THU" <?php  echo ($day=='THU')?'SELECTED':''; ?> > Thursday </option>
				<option value="FRI" <?php  echo ($day=='FRI')?'SELECTED':''; ?> > Friday </option>
				<option value="SAT" <?php  echo ($day=='SAT')?'SELECTED':''; ?> > Saturday </option>
				<option value="SUN" <?php  echo ($day=='SUN')?'SELECTED':''; ?> > Sunday </option>

			</select> &nbsp;&nbsp; &nbsp;&nbsp;

		<select name="week" id="week" <?php echo _FORM_FINAL;?>>

				<option value="">------</option>
				<option value="1" <?php  echo ($week=='1')?'SELECTED':''; ?> >Week 1</option>
				<option value="2" <?php  echo ($week=='2')?'SELECTED':''; ?> >Week 2</option>
				<option value="3" <?php  echo ($week=='3')?'SELECTED':''; ?> >Week 3</option>
				<option value="4" <?php  echo ($week=='4')?'SELECTED':''; ?> >Week 4</option>
				<option value="5" <?php  echo ($week=='5')?'SELECTED':''; ?> >Week 5</option>
		</select> &nbsp;&nbsp; &nbsp;&nbsp;
		
		<select name="month" id="month" <?php echo _FORM_FINAL;?>>

				<option value="">------</option>
				<option value="JAN" <?php  echo ($month=='JAN')?'SELECTED':''; ?> >January</option>
				<option value="FEB" <?php  echo ($month=='FEB')?'SELECTED':''; ?> >February</option>
				<option value="MAR" <?php  echo ($month=='MAR')?'SELECTED':''; ?> >March</option>
				<option value="APR" <?php  echo ($month=='APR')?'SELECTED':''; ?> >April</option>
				<option value="MAY" <?php  echo ($month=='MAY')?'SELECTED':''; ?> >May</option>
				<option value="JUN" <?php  echo ($month=='JUN')?'SELECTED':''; ?> >June</option>
				<option value="JUL" <?php  echo ($month=='JUL')?'SELECTED':''; ?> >July</option>
				<option value="AUG" <?php  echo ($month=='AUG')?'SELECTED':''; ?> >August</option>
				<option value="SEP" <?php  echo ($month=='SEP')?'SELECTED':''; ?> >September</option>
				<option value="OCT" <?php  echo ($month=='OCT')?'SELECTED':''; ?> >October</option>
				<option value="NOV" <?php  echo ($month=='NOV')?'SELECTED':''; ?> >November</option>
				<option value="DEC" <?php  echo ($month=='DEC')?'SELECTED':''; ?> >December</option>
		</select> &nbsp;&nbsp; &nbsp;&nbsp;	&nbsp;&nbsp;
		
		</li> 

   <li>
    <label for="remarks">Remarks </label>
    <textarea name="remarks" cols="50" rows="5"><?php echo $remarks; ?></textarea>
  </li>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>