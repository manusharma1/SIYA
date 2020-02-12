<table class="siyatable2">
<tr>
<th>
<h3><?php echo $lang['siya']['assessments']['SUBJECTS'];?></h3>
</th>

<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$semesterstypearray = array();
$marks = 0;
$grandsemestertotalmarks = array();
$grandtotalmarks = array();
$finaltotalmarks = 0;

$grade = '';
$gradepoint = '';


$columns = array('id','title');
$conditions = array();

$batchid = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

$conditions['=']['batchid'] = $batchid;
$conditions['OR =']['batchid'] = 0;
$conditions['AND =']['isactive'] = '1';


$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'semesters', $columns, $conditions, 'title', '', ''); // needs to be changed to orderid
	
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$semesterstypearray[] = $resultset->id;
?>
<th>
<h3><?php echo $resultset->title; ?></h3>

<!-- ASSESSMENTS -->

<table class="siyatable2">
<tr>
<?php
$assessmentstypearray = array();
$columns2 = array('at.id','at.name');
$conditions2 = array();

$tables2 = array();
$tables2['assessmenttypes'] = 'at';
$tables2['assessments'] = 'a';
$tables2['usersingroup'] = 'ug';

$conditions2['=']['ug.userid'] = $id;
$conditions2['K AND =']['ug.groupid'] = 'a.groupid';
$conditions2['K AND =']['ug.batchid'] = $batchid;
$conditions2['K AND =']['a.batchid'] = $batchid;
$conditions2['K AND =']['a.assessmenttypeid'] = 'at.id';

$sql2 = $sqlObj->SQLCreatorJ('SD', $tables2, $columns2, $conditions2, '', '', '');
	
if($result2 = $sqlObj->FireSQL($sql2)){
if($sqlObj->getNumRows($result2)!=0){
while($resultset2 = $sqlObj->FetchResult($result2)){
$assessmentstypearray[] = $resultset2->id;
?>
<td><b><?php echo $resultset2->name; ?><b></td>
<?php
}
}
}
?>
<td><b>Total</b></td>

</tr>
</table>

<!-- ASSESSMENTS -->

<?php
}
}
}
?>
</th>
</tr>

<?php

$columns = array('s.id','s.name','s.subjectcode');
$conditions = array();

$tables = array();
$tables['subjects'] = 's';
$tables['assessments'] = 'a';
$tables['usersingroup'] = 'ug';

$conditions['=']['ug.userid'] = $id;
$conditions['K AND =']['ug.groupid'] = 's.groupid';
$conditions['K AND =']['ug.batchid'] = $batchid;
$conditions['K AND =']['s.batchid'] = $batchid;
$conditions['K OR =']['s.batchid'] = 0;


$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('SD', $tables, $columns, $conditions, '', '', '');
	
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$subject_id = $sqlObj->getCleanData($resultset->id);
$subject_display_placeholder = $sqlObj->getCleanData($resultset->name).'<br />'.$sqlObj->getCleanData($resultset->subjectcode);
?>
<tr>
<td>
<?php
echo $subject_display_placeholder;
?>
</td>
<?php
// SEMESTERS //

$semestercount = count($semesterstypearray);
for($i=0;$i<$semestercount;$i++){
?>
<td>

<table class="siyatable2">
<tr>

<?php

foreach($assessmentstypearray as $assessmentkey => $assessmentvalue){
$assesment_type_str{$assessmentvalue} = '';
}

$totalmarks = 0;

foreach($assessmentstypearray as $assessmentkey => $assessmentvalue){
$columns3 = array('ua.marks','a.name','a.id');
$conditions3 = array();

$tables3 = array();
$tables3['assessments'] = 'a';
$tables3['usersassessments'] = 'ua';


$conditions3['=']['ua.userid'] = $id;
$conditions3['AND =']['a.reportthis'] = '1';
$conditions3['K AND =']['ua.assessmentid'] = 'a.id';
$conditions3['K AND =']['a.batchid'] = $batchid;
$conditions3['K AND =']['a.semesterid'] = $semesterstypearray[$i];
$conditions3['K AND =']['a.assessmenttypeid'] = $assessmentvalue;
$conditions3['K AND =']['a.subjectid'] = $subject_id;

$sql3 = $sqlObj->SQLCreatorJ('SD', $tables3, $columns3, $conditions3, '', '', '');
if($result3 = $sqlObj->FireSQL($sql3)){
if($sqlObj->getNumRows($result3)!=0){
while($resultset3 = $sqlObj->FetchResult($result3)){
$marks = $resultset3->marks;
$totalmarks += $marks;
$assessmentid = $resultset3->id;
$grandsemestertotalmarks[$i][] = $totalmarks;

// Grades

$grade = '';
$gradepoint = '';

$columns3_1 = array('g.grade','g.gradepoint');
$conditions3_1 = array();

$tables3_1 = array();
$tables3_1['grades'] = 'g';
$tables3_1['gradecategories'] = 'gc';
$tables3_1['assessments'] = 'a';

$conditions3_1['=']['a.id'] = $assessmentid;
$conditions3_1['K AND =']['a.groupid'] = 'gc.groupid';
$conditions3_1['K AND =']['a.batchid'] = 'gc.batchid';
$conditions3_1['K AND =']['gc.id'] = 'g.gradecategoryid';
$conditions3_1['K AND =']['g.assessmenttypeid'] = 'a.assessmenttypeid';
$conditions3_1['AND <=']['g.startrange'] = $marks;
$conditions3_1['AND >=']['g.endrange'] = $marks;

$sql3_1 = $sqlObj->SQLCreatorJ('S', $tables3_1, $columns3_1, $conditions3_1, '', '', '');
if($result3_1 = $sqlObj->FireSQL($sql3_1)){
if($sqlObj->getNumRows($result3_1)!=0){
if($resultset3_1 = $sqlObj->FetchResult($result3_1)){

$grade = $resultset3_1->grade;
$gradepoint = $resultset3_1->gradepoint;

}else{

$grade = '';
$gradepoint = '';

}
}
}
// Grades


?>
<?php $assesment_type_str{$assessmentvalue} .= '<br />'.$resultset3->name.'<br />[ <b>'.$marks.'</b> ] <br /> ['.$grade.']<br />';?>
<?php
}
}else{
?>
<?php
}
}
}

foreach($assessmentstypearray as $assessmentkey => $assessmentvalue){
echo '<td>'.$assesment_type_str{$assessmentvalue}.'</td>';
}



// Grades

$grade = '';
$gradepoint = '';

$columns3_1 = array('grade','gradepoint');
$conditions3_1 = array();

$conditions3_1['=']['gradetype'] = 'TOTAL';
$conditions3_1['AND <=']['startrange'] = $totalmarks;
$conditions3_1['AND >=']['endrange'] = $totalmarks;

$sql3_1 = $sqlObj->SQLCreator('S', 'grades', $columns3_1, $conditions3_1, '', '', '');
if($result3_1 = $sqlObj->FireSQL($sql3_1)){
if($sqlObj->getNumRows($result3_1)!=0){
if($resultset3_1 = $sqlObj->FetchResult($result3_1)){

$grade = $resultset3_1->grade;
$gradepoint = $resultset3_1->gradepoint;

}else{

$grade = '';
$gradepoint = '';

}
}
}
// Grades


?>
<td><b>[ <?php echo $totalmarks; ?> ] </b> <br /> [ <?php echo $grade; ?> ]</td>
</tr>
</table>
</td>

<?php
} // For Each
?>
<?php
}
?>

<?php
}
}
?>
<tr>
<td>
<b>Semester Grand Total</b>
</td>
<?php
for($k=0;$k<count($grandsemestertotalmarks);$k++){
$semestergrandtotal = array_sum($grandsemestertotalmarks[$k]);
$grandtotalmarks[] = $semestergrandtotal;


// Grades

$grade = '';
$gradepoint = '';

$columns3_1 = array('grade','gradepoint');
$conditions3_1 = array();

$conditions3_1['=']['gradetype'] = 'GRANDTOTAL';
$conditions3_1['AND <=']['startrange'] = $semestergrandtotal;
$conditions3_1['AND >=']['endrange'] = $semestergrandtotal;

$sql3_1 = $sqlObj->SQLCreator('S', 'grades', $columns3_1, $conditions3_1, '', '', '');
if($result3_1 = $sqlObj->FireSQL($sql3_1)){
if($sqlObj->getNumRows($result3_1)!=0){
if($resultset3_1 = $sqlObj->FetchResult($result3_1)){

$grade = $resultset3_1->grade;
$gradepoint = $resultset3_1->gradepoint;

}else{

$grade = '';
$gradepoint = '';

}
}
}
// Grades


?>
<td align="right">
<b> [ <?php echo $semestergrandtotal; ?> ] </b> <br />[ <?php echo $grade; ?> ] </td>
<?php
}

$finaltotalmarks = array_sum($grandtotalmarks);
?>
</tr>

<tr>
<td>
<b>Final Total Marks</b>
</td>

<?php


// Grades

$grade = '';
$gradepoint = '';

$columns3_1 = array('grade','gradepoint');
$conditions3_1 = array();

$conditions3_1['=']['gradetype'] = 'FINAL';
$conditions3_1['AND <=']['startrange'] = $finaltotalmarks;
$conditions3_1['AND >=']['endrange'] = $finaltotalmarks;

$sql3_1 = $sqlObj->SQLCreator('S', 'grades', $columns3_1, $conditions3_1, '', '', '');
if($result3_1 = $sqlObj->FireSQL($sql3_1)){
if($sqlObj->getNumRows($result3_1)!=0){
if($resultset3_1 = $sqlObj->FetchResult($result3_1)){

$grade = $resultset3_1->grade;
$gradepoint = $resultset3_1->gradepoint;

}else{

$grade = '';
$gradepoint = '';

}
}
}
// Grades

?>

<td colspan="2" align="right"> <b> [<?php echo $finaltotalmarks; ?>]</b> <br /> [<?php echo $grade; ?>]
</td>
</tr>
</table>

