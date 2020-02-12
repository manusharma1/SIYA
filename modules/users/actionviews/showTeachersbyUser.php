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

<?php

	$userid = MainSystem::GetSessionUserID();
	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

	$columns0 = array('groupid');

	$conditions0 = array();
	$conditions0['=']['userid'] = $userid;
	$conditions0['AND =']['batchid'] = $selected_batch_id;

	$sqlObj = new MainSQL();
	$sql0 = $sqlObj->SQLCreator('S', 'usersingroup', $columns0, $conditions0, '', '', '');
	if($result0 = $sqlObj->FireSQL($sql0)){
	if($sqlObj->getNumRows($result0)!=0){
	while($resultset0 = $sqlObj->FetchResult($result0)){

	$groupid = $resultset0->groupid;


?>
	<?php
	$columns = array('u.id','u.fname','u.mname','u.lname','u.gender');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';
	
	$conditions['=']['ug.groupid'] = $groupid;

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
	?>
	<table><tr>
	<?php
	$counter=0;
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder =$sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
	$teacher_icon = ($resultset->gender=='M')?'male_teacher.png':'female_teacher.png';
	?>
	<td><a class="sticky" href="<?php echo MainSystem::URLCreator('stage/showTeacher/'.$id_placeholder.'/'); ?>" rel="<?php echo MainSystem::URLCreator('stage/showTeacherInfo/'.$id_placeholder.','.$groupid.'/'); ?>"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.$teacher_icon; ?>" alt="<?php echo $name_placeholder; ?>" title="<?php echo $name_placeholder; ?>" /><br /><?php echo $name_placeholder; ?></a></td>
	<?php
	$counter++;
	if($counter>=3){
	$counter = 0;	
	?>
	</tr>
	<tr>
	<?php
	}
	}
	?>
	</tr></table>
	<?php
	}
	}else{
	trigger_error('Data Fetch Error');
	}
	
	
	}
	}
	}
	
?>





<script type="text/javascript">
$(function() {
$('.sticky').cluetip({sticky: true, closePosition: 'title', arrows: true, cluetipClass: 'rounded'});
$('a.title').cluetip({splitTitle: '|'});
});
</script>