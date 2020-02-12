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
?>
<h3>@Teachers</h3>
<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
$columns = array('u.id','u.fname','u.mname','u.lname','u.gender');
$conditions = array();

$tables = array();
$tables['usersingroup'] = 'ug';
$tables['groups'] = 'g';
$tables['users'] = 'u';

$conditions['=']['ug.groupid'] = $id;

if($selected_batch_id!=''){
$conditions['AND =']['ug.batchid'] = $selected_batch_id;
}
$conditions['K AND =']['ug.userid'] = 'u.id';
$conditions['K AND =']['ug.groupid'] = 'g.id';
$conditions['AND =']['g.entitytypetag'] = '@class';
$conditions['AND =']['u.entitytypetag'] = '@teacher';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
while($resultset = $sqlObj->FetchResult($result)){
$id_placeholder = $sqlObj->getCleanData($resultset->id);
$name_placeholder = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
?>
<p><img src="<?php echo MainSystem::URLCreator('users/showUserImageByID/'.$id_placeholder.',1/'); ?>" width="50px" height="50px" align="left"/><a href="<?php echo MainSystem::URLCreator('stage/showStudent/'.$id_placeholder.'/'); ?>"><?php echo $name_placeholder; ?></a></p>
<?php
}
?>
<?php
}
}else{
trigger_error('Data Fetch Error');
}		

?>
<hr />

<?php
$columns = array('u.id');
$conditions = array();

$tables = array();
$tables['usersingroup'] = 'ug';
$tables['groups'] = 'g';
$tables['users'] = 'u';

$conditions['=']['ug.groupid'] = $id;
$conditions['K AND =']['ug.userid'] = 'u.id';
$conditions['K AND =']['ug.groupid'] = 'g.id';

if($selected_batch_id!=''){
$conditions['AND =']['ug.batchid'] = $selected_batch_id;
}
$conditions['AND =']['g.entitytypetag'] = '@class';
$conditions['AND =']['u.entitytypetag'] = '@student';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
?>
<h3>@Students - Total <?php echo $sqlObj->getNumRows($result); ?></h3><hr />
<?php
}else{
trigger_error('Data Fetch Error');
}		

$columns = array('id','subjectcode','name');
$conditions = array();
$conditions['=']['groupid'] = $id;
if($selected_batch_id!=''){
$conditions['AND =']['batchid'] = $selected_batch_id;
}
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
?>
<h3>Subjects - Total <?php echo $sqlObj->getNumRows($result); ?></h3><hr /> 
<?php
}else{
trigger_error('Data Fetch Error');
}		

?>
<p align="center" valign="top"><a href="#">Send Message for This Class</a></p>
<p align="center" valign="top"><a href="#">View Activities</a></p>