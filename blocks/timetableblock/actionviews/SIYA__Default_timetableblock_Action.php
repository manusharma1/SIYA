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

global $_ACTION_VIEW_PARAMETER_ID;
$blocktitle = $_ACTION_VIEW_PARAMETER_ID;

$subjectid = '';
$groupid = '';
$topicid = '';
$batchid = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
$userid = MainSystem::GetSessionUserID();

if(_MODULE == 'stage' && _ACTION == 'showClass'){
$groupid = _ACTION_VIEW_PARAMETER_ID;
}else{
$groupid = '';
}


if(_MODULE == 'stage' && _ACTION == 'showSubject'){
$subjectid = _ACTION_VIEW_PARAMETER_ID;

$columns = array('g.id','g.grouptypetag','g.name');
$conditions = array();

$tables = array();
$tables['subjects'] = 's';
$tables['groups'] = 'g';

$conditions['=']['s.id'] = $subjectid;
$conditions['K AND =']['s.groupid'] = 'g.id';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$groupid = $sqlObj->getCleanData($resultset->id);
}
}
}

}else{
$subjectid = '';
}

$subjectcode_placeholder = '';
$name_placeholder = '';

?>

 <div class="boxstyle0"></div>
 <div class="boxstyle1">
        <div class="boxstyle2"><?php echo $blocktitle; ?> <br /><a href="#">Edit</a></div>
        <div class="boxstyle3">
		
		<?php
		if(PROJ_RUN_AJAX==1){
		$formaction2 = MainSystem::URLCreator('timetable/addRemark/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
		}else{
		$formaction2 = MainSystem::URLCreator('timetable/addRemark/');
		}
		?>

		<form id="addform2" name="addform2" method="post" action="<?php echo $formaction2; ?>">

			<fieldset>

			<legend>Remarks</legend>

			<?php
			$columns = array('id','message');
			$sqlObj = new MainSQL();
			$conditions = array();
			$conditions['=']['remarksby'] = $userid;
			
			$sql = $sqlObj->SQLCreator('S', 'remarks', $columns, $conditions, '', '', '');
			if($result = $sqlObj->FireSQL($sql)){
			if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
			
			while($resultset = $sqlObj->FetchResult($result)){
			$id = $sqlObj->getCleanData($resultset->id);
			$name_placeholder = $sqlObj->getCleanData($resultset->message);	
			$url='stage/showTeacher/'.$id.'/';

			?>
			
			<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $name_placeholder; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?php echo MainSystem::URLCreator('remarks/editRemarks/'.$id.'/'); ?>">edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?php echo MainSystem::URLCreator('remarks/deleteRemarks/'.$id.'/'); ?>">delete</a></p>	
			<?php
			}
			}else{
			echo 'No Record';
			}
			}else{
			trigger_error('Data Fetch Error');
			}		
			?>


			<ol>
			<input type="hidden" name="subjectid" value="<?php echo $userid; ?>" />	
			<input type="hidden" name="subjectid" value="<?php echo $subjectid; ?>" />
			<input type="hidden" name="groupid" value="<?php echo $groupid; ?>" />
			<input type="hidden" name="batchid" value="<?php echo $batchid; ?>" />
			<input type="hidden" name="topicid" value="<?php echo $topicid; ?>" />
			</ol>
			
			</fieldset>
			
			<fieldset>

			<button type="submit">Add Remarks</button>

			</fieldset>

		</form>	
		
		</div>
        <div style="clear: both;"></div>
 </div>