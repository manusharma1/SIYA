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
<div class="menu_list" id="secondpane">

<?php
	global $_ACTION_VIEW_PARAMETER_ID;
	$menuid = $_ACTION_VIEW_PARAMETER_ID;
	$columns = array('id','name');
	$conditions = array();
	$conditions['=']['pid'] = $menuid;
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, 'id', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Sub Page Exists
	?>
	<?php
	while($resultset = $sqlObj->FetchResult($result)){
	?>
	<p class="menu_head"><a href="<?php echo MainSystem::URLCreator('cms/getContent/'.$resultset->id.'/'); ?>"><?php echo $resultset->name; ?></a></p>
	<?php
	
	$columns2 = array('id','name');
	$conditions2 = array();
	$conditions2['=']['pid'] = $resultset->id;
	$conditions2['AND =']['isactive'] = '1';
	$sql2 = $sqlObj->SQLCreator('S', 'content', $columns2, $conditions2, '', '', '');
	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ // If Sub Page Exists
	?>
	<div class="menu_body">
	<?php
	while($resultset2 = $sqlObj->FetchResult($result2)){
	?>
	<a href="<?php echo MainSystem::URLCreator('cms/getContent/'.$resultset2->id.'/'); ?>"><?php echo $resultset2->name; ?></a>
	<?php
	}
	?>
	</div>
	<?php
	}
	}
	}
	}
	}
?>
</div>