<?php
$sqlObj = new MainSQL();
$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
$id = (isset($parameters[0]))?$parameters[0]:'';
$groupid = (isset($parameters[1]))?$parameters[1]:'';
//////////////////////////////////////////////////////////////////////////////////////
// 	Action Permissions can be controlled by the Controller, but here the 			//
//  Group Permissions can be checked and the action can be taken accordingly 		//
//////////////////////////////////////////////////////////////////////////////////////
	
MainSystem::CheckGroupPermissions($groupid,'group');
$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
$timetable_day = '';

$period_id = '';
$timetable_id = '';
$timetable_day = '';
$subject_name = '';
$teacherid = '';
$coteacherid = '';
$teacher = '';
$coteacher = '';

$numofdays = array('MON'=>'MONDAY','TUE'=>'TUESDAY','WED'=>'WEDNESDAY','THU'=>'THURSDAY','FRI'=>'FRIDAY','SAT'=>'SATURDAY','SUN'=>'SUNDAY');
?>
<table cellpadding="2" cellspacing="2" border="2" width="100%" class="siyatable">
<tr>
<th>
Period
</th>
<?php
foreach($numofdays as $daycode => $dayname){
?>
<th><?php echo $dayname; ?></th>
<?php
}
?>
</tr>
<tr>
<?php

$columns = array('MAX(`periodnumber`)=maxperiodnumber');

$conditions = array();
$conditions['=']['batchid'] = $selected_batch_id;
$conditions['AND =']['groupid'] = $id;
$conditions['AND =']['isactive'] = '1';


$sql= $sqlObj->SQLCreator('SF', 'periods', $columns, $conditions, '', '', '');


if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
if($resultset = $sqlObj->FetchResult($result)){

$maxperiod = $resultset->maxperiodnumber;

}
}
}

for($i=1;$i<=$maxperiod;$i++){
?>
<td>Period <?php echo $i; ?></td>
<?php
foreach($numofdays as $daycode => $dayname){
$period_id = '';

$columns = array('id','title','starttime','endtime');
$conditions = array();

$conditions['=']['groupid'] = $id;
$conditions['AND =']['batchid'] = $selected_batch_id;
$conditions['AND =']['periodnumber'] = $i;
$conditions['AND =']['day'] = $daycode;

$columns_subquery = array('periodid');
$sql_subquery = $sqlObj->SQLCreator('S', 'timetable', $columns_subquery, '', '', '', '');

$conditions['AND IN CON']['id'] = $sql_subquery; // Sub Query //

$sql = $sqlObj->SQLCreator('S', 'periods', $columns, $conditions, 'periodnumber, starttime ASC', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){

if($resultset = $sqlObj->FetchResult($result)){

if($resultset->id != ''){
$period_id = $sqlObj->getCleanData($resultset->id);
}else{
$period_id = '';
}
$period_display_placeholder = $sqlObj->getCleanData($resultset->title).'<br />'.$sqlObj->getCleanData($resultset->starttime).' - '.$sqlObj->getCleanData($resultset->endtime);
}
}else{
$period_display_placeholder = '';
$teacher_name = '';
$coteacher_name = '';
}
}


$columns2 = array('t.id','t.teacherid','t.coteacherid','p.day','s.subjectcode','s.name');
$conditions2 = array();

$tables2 = array();
$tables2['timetable'] = 't';
$tables2['periods'] = 'p';
$tables2['subjects'] = 's';

$conditions2['=']['t.periodid'] = $period_id;
$conditions2['K AND =']['t.periodid'] = 'p.id';
$conditions2['K AND =']['t.subjectid'] = 's.id';

$sqlObj = new MainSQL();

$sql2 = $sqlObj->SQLCreatorJ('S', $tables2, $columns2, $conditions2, '', '', '');

if($result2 = $sqlObj->FireSQL($sql2)){
if($sqlObj->getNumRows($result2) !=0){
if($resultset2 = $sqlObj->FetchResult($result2)){
$timetable_id = $sqlObj->getCleanData($resultset2->id);
$timetable_day = $sqlObj->getCleanData($resultset2->day);
$subject_name = $sqlObj->getCleanData($resultset2->name);
$teacherid = $sqlObj->getCleanData($resultset2->teacherid);
$coteacherid = $sqlObj->getCleanData($resultset2->coteacherid);
}else{
$timetable_id = '';
$timetable_day = '';
$subject_name = '';
$teacherid = '';
$coteacherid = '';
}


if($timetable_day==$daycode){
$subject_display = $subject_name;

if($teacherid != ''){
$teacher_name = MainSystem::getUserDetailsByID($teacherid);
$teacher = $teacher_name->fname.' '.$teacher_name->mname.' '.$teacher_name->lname;
}else{
$teacher = '';
}

if($teacherid != ''){
if($coteacherid !=0){
$coteacher_name = MainSystem::getUserDetailsByID($coteacherid);
$coteacher = $coteacher_name->fname.' '.$coteacher_name->mname.' '.$coteacher_name->lname;
}
}else{
$coteacher = '';
}


}
}else{
$teacher = '';
$coteacher = '';
}
}




?>
<td>
<p><?php echo $period_display_placeholder; ?></p>
<p><?php echo $teacher.'<br />'.$coteacher;  ?></p>
</td>
<?php
}
?>
</tr>
<?php
}
?>
</table>