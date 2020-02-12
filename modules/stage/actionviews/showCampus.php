<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT  - DO NOT REMOVE THIS NOTICE                      //
//                                                                       //
// OPENTADKA FRAMEWORK											         //
//          http://www.opentadka.org                                     //
//                                                                       //
// Copyright (C) 2010 onwards  Manu Sharma  http://www.opentadka.org     //
//                                                                       //
// STUDENT INFORMATION YARN (SIYA)								         //
//          http://www.siya.org.in                                       //
//                                                                       //
// Copyright (C) 2012 onwards  Manu Sharma  http://www.siya.org.in       //
//                                                                       //
// OPENTADKA FRAMEWORK LICENSE :                                         //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
// STUDENT INFORMATION YARN (SIYA) LICENSE :                             //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//   OPENTADKA FRAMEWORK & STUDENT INFORMATION YARN (SIYA)               //
//   FOR LICENCESPLEASE REFER LICENCE PAGE                               //
//   FOR MORE DETAILS                                                    //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

?>
<h3 class="headingh3">CAMPUS</h3>
<br />

<table width="100%" align="center">
<tr>
<?php
$counter = 1;
$columns = array('id','grouptypetag','name');
$conditions = array();
$conditions['=']['entitytypetag'] = '@class';

if($selected_batch_id!=''){
$conditions['AND =']['batchid'] = $selected_batch_id;
}
$conditions['OR =']['batchid'] = 0;

$conditions['AND =']['isactive'] = 1;

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
while($resultset = $sqlObj->FetchResult($result)){
$id_placeholder = $sqlObj->getCleanData($resultset->id);
$name_placeholder = $sqlObj->getCleanData($resultset->name);
$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
$url='stage/showClassInfo/'.$id_placeholder.'/';
$urlclick='stage/showClass/'.$id_placeholder.'/';
?>
<td align="center">
<a class="sticky" rel="<?php echo MainSystem::URLCreator($url); ?>" href="<?php echo MainSystem::URLCreator($urlclick); ?>"><img src="<?php echo  _TEMPLATE_IMG_DIR._WS.'siya_classroom.png'; ?>" alt="<?php echo $name_placeholder.' ('.$grouptypetag_placeholder.')'; ?>" title="<?php echo $name_placeholder; ?>"/><br /><a class="sticky" rel="<?php echo MainSystem::URLCreator($url); ?>" href="<?php echo MainSystem::URLCreator($urlclick); ?>"><?php echo $name_placeholder.' ['.$grouptypetag_placeholder.']'; ?></a>
</td>						
<?php
$counter++;
if($counter==5){
?>
</tr>
<tr>
<?php
}
}
?>
<?php
}else{
?>
<td align="center">
No Classes (Groups) Defined, Please define one from Group Administration
</td>
<?php
}
}else{
trigger_error('Data Fetch Error');
}

?>

</tr>
</table>
<script type="text/javascript">
$(function() {
$('.sticky').cluetip({sticky: true, closePosition: 'title', arrows: true, cluetipClass: 'rounded'});
$('a.title').cluetip({splitTitle: '|'});
});
</script>