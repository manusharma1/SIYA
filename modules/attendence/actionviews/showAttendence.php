<?php
$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
$id = (isset($parameters[0]))?$parameters[0]:'';
$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
$userid = MainSystem::GetSessionUserID();

if(isset($_POST['subjectid'])){
$subjectid = $_POST['subjectid'];
}else{
$subjectid = '';
}


if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('attendence/showAttendence/'.$id.','.$selected_batch_id.','.$subjectid.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('attendence/showAttendence/'.$id.','.$selected_batch_id.','.$subjectid.'/');
}

$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'subjectid';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = 'All Subjects';
$htmlarray[]['option']['end'] = '';

$columns = array('id','subjectcode','name');
$conditions = array();
$conditions['=']['groupid'] = $id;

if($selected_batch_id!=''){
$conditions['AND =']['batchid'] = $selected_batch_id;
}else{

$conditions['OR =']['batchid'] = 0;
}

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $resultset->id;
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->name).' ('.$sqlObj->getCleanData($resultset->subjectcode).')';
$htmlarray[]['option']['end'] = '';

}
}
}else{
trigger_error(self::$lang['siya']['DATA_FETCH_ERROR']);
}


$htmlarray[]['select']['end'] = '';
$menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);

?>
	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

	<fieldset>

	<legend><?php echo $lang['siya']['attendence']['VIEW_ATTENDENC_FOR_SUBJECT'];?></legend>

	<ol>
		
		<li>
		<label for="subjects"><?php echo $lang['siya']['SUBJECT'];?></label>
		<?php echo $menu_placeholder; ?>
		</li>

	</ol>
	
	</fieldset>
	<fieldset>

	<button type="submit"><?php echo $lang['siya']['attendence']['CHANGE'];?></button>

	</fieldset>

	</form>

<?php

if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('attendence/saveAttendence/'.$id.','.$selected_batch_id.','.$subjectid.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('attendence/saveAttendence/'.$id.','.$selected_batch_id.','.$subjectid.'/');
}

$status = 'P'; // Default Status is Present
$currentmonth = date('m');
$currentmonthinchar = date('F');
$currentyear = date('Y');
$numofdays = cal_days_in_month(CAL_GREGORIAN, $currentmonth, $currentyear);
?>
<table width="100%" align="center">
<tr>
<td width="20%" align="center">
<?php echo $lang['siya']['attendence']['STUDENT_NAME'];?>
</td>
<?php
for($i=1;$i<=$numofdays;$i++){
?>
<td width="20%" align="center"><?php echo $i; ?></td>
<?php
}
?>
</tr>
<tr>
<?php
$columns = array('u.id','u.fname','u.mname','u.lname','u.gender');
$conditions = array();

$tables = array();
$tables['usersingroup'] = 'ug';
$tables['users'] = 'u';

$conditions['=']['ug.userid'] = $userid;
$conditions['AND =']['ug.batchid'] = $selected_batch_id;
$conditions['K AND =']['ug.userid'] = 'u.id';


$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
while($resultset = $sqlObj->FetchResult($result)){
$user_id = $sqlObj->getCleanData($resultset->id);
$user_name_placeholder =$sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
?>
<td width="20%" align="center">
<?php
echo $user_name_placeholder;
?>
</td>
<?php
$holidays_config_array = array();
$c = 1;
$columns2 = array('id','type','date','day','week','month');
$conditions2 = array();
$conditions2['=']['groupid'] = $id;
$conditions2['AND =']['batchid'] = $selected_batch_id;
$sql2 = $sqlObj->SQLCreator('S', 'holidays', $columns2, $conditions2, '', '', '');
if($result2 = $sqlObj->FireSQL($sql2)){
if($sqlObj->getNumRows($result2) !=0){
while($resultset2 = $sqlObj->FetchResult($result2)){

$holidays_config_array[$c]['id'] = $sqlObj->getCleanData($resultset2->id);
$holidays_config_array[$c]['type']= $sqlObj->getCleanData($resultset2->type);
$holidays_config_array[$c]['date'] = $sqlObj->getCleanData($resultset2->date);
$holidays_config_array[$c]['day']= $sqlObj->getCleanData($resultset2->day);
$holidays_config_array[$c]['week'] = $sqlObj->getCleanData($resultset2->week);
$holidays_config_array[$c]['month'] = $sqlObj->getCleanData($resultset2->month);

$c++;
}
}
}

$absentdate_array = array();

$columns3 = array('id','absentdate');
$conditions3 = array();
$conditions3['=']['groupid'] = $id;
$conditions3['AND =']['batchid'] = $selected_batch_id;
$conditions3['AND =']['userid'] = $user_id;
if($subjectid !=''){
$conditions3['AND =']['subjectid'] = $subjectid;
}

$sql3 = $sqlObj->SQLCreator('S', 'attendence', $columns3, $conditions3, '', '', '');
if($result3 = $sqlObj->FireSQL($sql3)){
if($sqlObj->getNumRows($result3) !=0){
while($resultset3 = $sqlObj->FetchResult($result3)){
$absentdate_array[] = $sqlObj->getCleanData($resultset3->absentdate);
}
}
}

for($i=1;$i<=$numofdays;$i++){
$status = 'P';
if($i<10){
$currentday = '0'.$i;
}else{
$currentday = $i;
}

$currentdate = $currentyear.'-'.$currentmonth.'-'.$currentday;

if(in_array($currentdate, $absentdate_array)){
$status = 'A';
}else{
$status = 'P';
}


for($j=1;$j<=count($holidays_config_array);$j++){


if($holidays_config_array[$j]['type']=='D' && $currentdate == $holidays_config_array[$j]['date']){
$status = 'H';
}

if($holidays_config_array[$j]['type']=='W'){

if($currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 1 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 2 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 3 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 4 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 5 '.$holidays_config_array[$j]['day'])) ){
$status = 'H';
}
}else if($holidays_config_array[$j]['type'] && $holidays_config_array[$j]['week']=='' && $holidays_config_array[$j]['month']==''){
if($currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 1 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 2 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 3 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 4 '.$holidays_config_array[$j]['day'])) || $currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' 5 '.$holidays_config_array[$j]['day'])) ){
$status = 'H';
}
}else if($holidays_config_array[$j]['type']=='M' && $holidays_config_array[$j]['week']!='' && $holidays_config_array[$j]['month']==''){
if($currentdate==date('Y-m-d', strtotime($currentmonthinchar.' '.$currentyear.' '.$holidays_config_array[$j]['week'].' '.$holidays_config_array[$j]['day']))){
$status = 'H';
}
}else if($holidays_config_array[$j]['type']=='M' && $holidays_config_array[$j]['month']!=''){
if($currentdate==date('Y-m-d', strtotime($holidays_config_array[$j]['month'].' '.$currentyear.' '.$holidays_config_array[$j]['week'].' '.$holidays_config_array[$j]['day']))){
$status = 'H';
}
}else{
$status = 'P';
}

}
?>
<td align="center">
<?php
if($status=='P'){
?>
<img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'attendence'._WS.'images'._WS.'bullet_green.png'; ?>" width="16px" height="16px" name="Present" value="<?php echo $status; ?>" title="<?php echo $status; ?>" alt="<?php echo $status; ?>" align="center"/>
<?php
}else if($status=='A'){
?>
<img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'attendence'._WS.'images'._WS.'bullet_red.png'; ?>" width="16px" height="16px" name="Absent" title="<?php echo $status; ?>" alt="<?php echo $status; ?>" align="center" />
<?php
}else if($status=='H'){
?>
<img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'attendence'._WS.'images'._WS.'bullet_purple.png'; ?>" width="16px" height="16px" name="Absent" title="<?php echo $status; ?>" alt="<?php echo $status; ?>" align="center" />
<?php
}
?>
</td>
<?php
}
?>
</tr>
<?php
}
}
}
?>

</table>

<h2>Legend</h2><hr />
<p><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'attendence'._WS.'images'._WS.'bullet_green.png'; ?>" width="16px" height="16px" name="Present" title="Present" alt="Present" /> Present</p>
<p><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'attendence'._WS.'images'._WS.'bullet_red.png'; ?>" width="16px" height="16px" name="Absent" title="Absent" alt="Absent" /> Absent</p>
<p><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'attendence'._WS.'images'._WS.'bullet_purple.png'; ?>" width="16px" height="16px" name="Holiday" title="Holiday" alt="Holiday" /> Holiday</p>