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
	$id = _ACTION_VIEW_PARAMETER_ID;
	$id_placeholder = '';
	$groupid_placeholder = '';
	$grouptypetag_placeholder = '';
	$name_placeholder = '';
	
	// Get Users Data
	$columns = array('id','grouptypetag','name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
	
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$groupid_placeholder = $sqlObj->getCleanData($resultset->id);
	$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	?>

	<h2><?php echo $name_placeholder.' ('.$grouptypetag_placeholder.') '; ?></h2>

	<?php

	}
	}else{
	
	?>
	
	<h2>No Class with this Id</h2>
	<?php
	}
	}
	?>
	
	<h3>Students</h3>
	<?php
	$columns = array('u.id','u.username');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';

	$conditions['=']['g.id'] = $id;
	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['AND =']['g.entitytypetag'] = '@class';
	$conditions['AND =']['u.entitytypetag'] = '@student';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$username_placeholder = $sqlObj->getCleanData($resultset->username);	
	$url='stage/showStudent/'.$id_placeholder.'/';

	?>
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $username_placeholder; ?></a></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>
	
	<h3>Teachers</h3>

	<?php
	$columns = array('u.id','u.username');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';
	$tables['users'] = 'u';
	
	$conditions['=']['g.id'] = $id;
	$conditions['K AND =']['ug.userid'] = 'u.id';
	$conditions['AND =']['g.entitytypetag'] = '@class';
	$conditions['AND =']['u.entitytypetag'] = '@teacher';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$username_placeholder = $sqlObj->getCleanData($resultset->username);	
	$url='stage/showTeacher/'.$id_placeholder.'/';

	?>
	
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $username_placeholder; ?></a></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	
	
?>