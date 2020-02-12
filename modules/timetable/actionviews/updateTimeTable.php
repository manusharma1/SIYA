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
$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
$id = (isset($parameters[0]))?$parameters[0]:'';
$groupid = (isset($parameters[1]))?$parameters[1]:'';
//////////////////////////////////////////////////////////////////////////////////////
// 	Action Permissions can be controlled by the Controller, but here the 			//
//  Group Permissions can be checked and the action can be taken accordingly 		//
//////////////////////////////////////////////////////////////////////////////////////
	
MainSystem::CheckGroupPermissions($groupid,'group');

$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
if(isset($_GET['day'])){
$dayselect = $_GET['day'];
}
else{
$dayselect = '';
}

$periodid_placeholder = '';
$subjectid_placeholder = '';
$title_placeholder = '';
$starthour_placeholder = '';
$startminute_placeholder = '';
$endhour_placeholder = '';
$endminute_placeholder = '';
$teacherid_placeholder = '';

// Period ID //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'periodid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('p.id','p.title','p.starttime','p.endtime');

$tables = array();
$tables['periods'] = 'p';

$columns_subquery = array('periodid');
$sql_subquery = $sqlObj->SQLCreator('S', 'timetable', $columns_subquery, '', '', '', '');


$conditions = array();
$conditions['=']['p.isactive'] = '1';
$conditions['AND !IN CON']['p.id'] = $sql_subquery; // Sub Query //
$conditions['AND =']['p.groupid'] = $id;
$conditions['AND =']['p.batchid'] = $selected_batch_id;
$conditions['AND =']['p.day'] = $dayselect;


$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->starttime).' '.$sqlObj->getCleanData($resultset->endtime). ')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$periodid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


	
// Subject ID //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'subjectid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','subjectcode','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$conditions['AND =']['groupid'] = $id;
$conditions['AND =']['batchid'] = $selected_batch_id;
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->subjectcode).' ('.$sqlObj->getCleanData($resultset->name).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$subjectid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// Teacher ID //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'teacherid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$columns = array('u.id','u.fname','u.mname','u.lname');
$conditions = array();

$tables = array();
$tables['usersingroup'] = 'ug';
$tables['groups'] = 'g';
$tables['users'] = 'u';

$conditions['=']['g.id'] = $id;
$conditions['K AND =']['ug.userid'] = 'u.id';
$conditions['K AND =']['ug.groupid'] = 'g.id';
$conditions['AND =']['g.entitytypetag'] = '@class';
$conditions['AND =']['u.entitytypetag'] = '@teacher';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$teacherid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// Co-Teacher ID //
// Co-Teacher Can be from any group

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'coteacherid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$columns = array('u.id','u.fname','u.mname','u.lname');
$conditions = array();

$tables = array();
$tables['usersingroup'] = 'ug';
$tables['groups'] = 'g';
$tables['users'] = 'u';

$conditions['=']['g.id'] = $id;
$conditions['K AND =']['ug.userid'] = 'u.id';
$conditions['K AND =']['ug.groupid'] = 'g.id';
$conditions['AND =']['g.entitytypetag'] = '@class';
$conditions['AND =']['u.entitytypetag'] = '@teacher';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$coteacherid_placeholder = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST)){
$subjectcode_placeholder = (isset($_POST['subjectcode']))?$_POST['subjectcode']:'';
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
}
?>

<?php
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('timetable/saveTimeTable/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('timetable/saveTimeTable/');
}
?>

<form name="dayselect" id="dayselect" method="GET">

<fieldset>

<legend><?php echo $lang['siya']['timetable']['UPDATE_TIMETABLE']; ?></legend>


<ol>
	<li>
	<label for="day">Days </label>
	<select name="day" id="day" onChange="JavaScript:document.forms['dayselect'].submit();">

		<option value="">--------------------</option>
		<option value="MON" <?php echo ($dayselect == 'MON')?'SELECTED':''; ?>>MONDAY</option>
		<option value="TUE" <?php echo ($dayselect == 'TUE')?'SELECTED':''; ?>>TUESDAY</option>
		<option value="WED" <?php echo ($dayselect == 'WED')?'SELECTED':''; ?>>WEDNESDAY</option>
		<option value="THU" <?php echo ($dayselect == 'THU')?'SELECTED':''; ?>>THURSDAY</option>
		<option value="FRI" <?php echo ($dayselect == 'FRI')?'SELECTED':''; ?>>FRIDAY</option>
		<option value="SAT" <?php echo ($dayselect == 'SAT')?'SELECTED':''; ?>>SATURDAY</option>
		<option value="SUN" <?php echo ($dayselect == 'SUN')?'SELECTED':''; ?>>SUNDAY</option>
	</li>
	</ol>
	</select>
</fieldset>

</form>

<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	
	<ol>
		<li>
		<label for="periodid">Period </label><?php echo $periodid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="subjectid">Subject </label><?php echo $subjectid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="teacherid">Teacher </label><?php echo $teacherid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="coteacherid">Co Teacher </label><?php echo $coteacherid_placeholder; ?> 
	    </li>

		<input type="hidden" name="day" value="<?php echo $dayselect;?>" />

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>