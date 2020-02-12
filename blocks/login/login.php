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
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//////////////////////////////////////////////////////////////////////////

class Login extends MainHTML
{

static function CreateLoginBox(){
	
	$returndata = '';

	$htmlarray = array();
	$htmlarray['form']['name'] = 'test';
	$htmlarray['form']['method'] = 'get';
	$htmlarray['form']['action'] = '1.php';
	$htmlarray['form']['close'];
	$returndata = parent::HTMLCreator($htmlarray);



	/*$columns = array('id');
	$conditions = array();
	$conditions['=']['name'] = $name;
	$conditions['AND =']['isactive'] = '1';
	$sql = parent::SQLCreator('S', 'menu', $columns, $conditions, '', '', '');
	$result = parent::$DBConnectionObj->query($sql);
	if($resultset = mysqli_fetch_object($result)){
	$menuid = $resultset->id;
	
	$columns = array('title','id');
	$conditions = array();
	$conditions['=']['menuid'] = $menuid;
	$conditions['AND =']['isactive'] = '1';
	$sql = parent::SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	if($result = parent::$DBConnectionObj->query($sql)){
	$returndata .= '<ul>';
	while($resultset = mysqli_fetch_object($result)){
	$returndata .= '<li><a href="'.$resultset->id.'">'.$resultset->title.'</a></li>';
	}
	$returndata .= '</ul>';
	
	return $returndata;

	}else{
	trigger_error('SQL Error'); // The Error Reporting (For Mysql query and fetch) in this senario needs to be well coded 
	// Trigger DB Error
	return 0;
	}
	
	}else{
	trigger_error('DB Fetch Error');
	// Trigger DB Error
	return 0;
	}
	*/

}
	

} // class Login