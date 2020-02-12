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

class MainSQL extends MainDB{

private static function conditionsFormatter($conditions){

$conditionclose = 0;
$conditionvalue = '';
$setconditions = '';


foreach($conditions as $keys => $values){
	foreach($values as $key => $value){

		switch($keys){

			case 'AND()':
			case 'AND ()':

			$conditionvalue = '';
			$setconditions  .= ' AND (';
			$conditionclose = 1;
			break;

			case 'OR()':
			case 'OR ()':

			$conditionvalue = '';
			$setconditions  .= ' OR (';
			$conditionclose = 1;
			break;

			case 'INARR':
			case 'IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= '`'.$key .'` IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case '!INARR':
			case '!IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= '`'.$key .'` NOT IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


			case 'ANDINARR':
			case 'AND IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND `'.$key .'` IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'AND!INARR':
			case 'AND !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND `'.$key .'` NOT IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


		case 'ORINARR':
			case 'OR IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR `'.$key .'` IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'OR!INARR':
			case 'OR !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR `'.$key .'` NOT IN (';

				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}

			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'INCON':
			case 'IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= '`'.$key .'` IN ('.$value.')';			
			break;

			case '=':
			$setconditions .= '`'.$key .'` = '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case '!=':
			$setconditions .= '`'.$key .'` != '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'AND=':
			case 'AND =':

		    $setconditions .= ' AND `'. $key .'` = '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'OR=':
			case 'OR =':

		    $setconditions .= ' OR `'. $key .'` = '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'AND!=':
			case 'AND !=':

		    $setconditions .= ' AND `'. $key .'` != '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'OR!=':
			case 'OR !=':

		    $setconditions .= ' OR `'. $key .'` != '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			
		}

		if($conditionclose == 1){
		$setconditions  .= ' '.$conditionvalue.' `'.$key.'` = ' . '\''.parent::db_input_values_protection($value).'\'';
		}

		if($conditionclose == 2){
		$setconditions  .= ')';
		}
	
		if($conditionclose == 1){
		$conditionclose = $conditionclose+1;
		}
	}

}

return $setconditions;

} // function conditionsFormatter


private static function conditionsFormatterJ($conditions){

$conditionclose = 0;
$conditionvalue = '';
$setconditions = '';


foreach($conditions as $keys => $values){
	foreach($values as $key => $value){

		switch($keys){

			case 'AND()':
			case 'AND ()':

			$conditionvalue = '';
			$setconditions  .= ' AND (';
			$conditionclose = 1;
			break;

			case 'OR()':
			case 'OR ()':

			$conditionvalue = '';
			$setconditions  .= ' OR (';
			$conditionclose = 1;
			break;

			case 'INARR':
			case 'IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= $key .' IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case '!INARR':
			case '!IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= $key .' NOT IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


			case 'ANDINARR':
			case 'AND IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND '.$key .' IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'AND!INARR':
			case 'AND !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND '.$key .' NOT IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


			case 'ORINARR':
			case 'OR IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR '.$key .' IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'OR!INARR':
			case 'OR !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR '.$key .' NOT IN (';

				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.parent::db_input_values_protection($invalue).'\', ';
				}

			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'INCON':
			case 'IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= $key .' IN ('.$value.')';			
			break;

			case '=':
			$setconditions .= $key .' = '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case '!=':
			$setconditions .= $key .' != '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'AND=':
			case 'AND =':

		    $setconditions .= ' AND '. $key .' = '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'OR=':
			case 'OR =':

		    $setconditions .= ' OR '. $key .' = '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'AND!=':
			case 'AND !=':

		    $setconditions .= ' AND '. $key .' != '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'OR!=':
			case 'OR !=':

		    $setconditions .= ' OR '. $key .' != '. '\''.parent::db_input_values_protection($value).'\'';
			break;

			case 'K=':
			case 'K =':

			$setconditions .= $key .' = '.parent::db_input_values_protection($value);
			break;

			case 'K!=':
			case 'K !=':

			$setconditions .= $key .' != '.parent::db_input_values_protection($value);
			break;

			case 'KAND=':
			case 'K AND =':

		    $setconditions .= ' AND '. $key .' = '.parent::db_input_values_protection($value);
			break;

			case 'KOR=':
			case 'K OR =':

		    $setconditions .= ' OR '. $key .' = '.parent::db_input_values_protection($value);
			break;

			case 'KAND!=':
			case 'K AND !=':

		    $setconditions .= ' AND '. $key .' != '.parent::db_input_values_protection($value);
			break;

			case 'KOR!=':
			case 'K OR !=':

		    $setconditions .= ' OR '. $key .' != '.parent::db_input_values_protection($value);
			break;
			
		}

		if($conditionclose == 1){
		$setconditions  .= ' '.$conditionvalue.' `'.$key.'` = ' . '\''.parent::db_input_values_protection($value).'\'';
		}

		if($conditionclose == 2){
		$setconditions  .= ')';
		}
	
		if($conditionclose == 1){
		$conditionclose = $conditionclose+1;
		}
	}

}

return $setconditions;

} // function conditionsFormatterJ

public function SQLCreator($type, $table, $cols, $conditions, $orderby, $startlimit, $endlimit){

$sql = '';

switch($type){

//Insert Case 

case 'I':
case 'i':

$dbcolsnames = '';
$dbcolsvalues = '';

if(!is_array($cols)){
// Fire Some Error //
}else{
foreach($cols as $key => $value){
$dbcolsnames .= '`'.$key.'`, ';
$dbcolsvalues .= '\''.parent::db_input_values_protection($value).'\', ';
}

$dbcolsnames = substr($dbcolsnames, 0, -2);
$dbcolsvalues = substr($dbcolsvalues, 0, -2);
}

$sql = "INSERT INTO `".$table."` (".$dbcolsnames.") VALUES (".$dbcolsvalues.")";
break;

// Update Case

case 'U':
case 'u':

$setvalues = '';

if(!is_array($cols)){
// Fire Some Error //
}else{
foreach($cols as $key => $value){
$setvalues  .= '`'.$key.'` = ' . '\''.parent::db_input_values_protection($value).'\', ';
}
$setvalues = substr($setvalues, 0, -2);
}

$setconditions = self::conditionsFormatter($conditions);

$sql = "UPDATE `".$table."` SET ".$setvalues." WHERE ".$setconditions;

break;


// Select Case

case 'S':
case 's':

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	$dbcolsnames .= '`'.$value.'`, ';
	}
}
$dbcolsnames = substr($dbcolsnames, 0, -2);
}

if($conditions != ''){
$setconditions = self::conditionsFormatter($conditions);
$sql = "SELECT ".$dbcolsnames." FROM `".$table."` WHERE ".$setconditions;
}else{
$sql = "SELECT ".$dbcolsnames." FROM `".$table."`";
}

if($orderby != ''){
$sql .= " ORDER BY ".$orderby;
}

if($startlimit != ''){
$sql .=  " LIMIT ".$startlimit;
}

if($endlimit !=''){
$sql .= " , ".$endlimit;
}

break;


// Delete Case

case 'D':
case 'd':

$setconditions = self::conditionsFormatter($conditions);


$sql = "DELETE FROM `".$table."` WHERE ".$setconditions;

break;


} // end of the case - I = Insert , U = Update, S = Select, D = Delete

return $sql;

}

// function SQLCreator

public function SQLCreatorJ($type, $tables, $cols, $conditions, $orderby, $startlimit, $endlimit){

// UPDATE users u, content c SET u.phone = '676776' where u.isactive='1' AND u.id = c.id
// INSERT INTO users(phone) SELECT content.id FROM content WHERE content.id = '1'

$sql = '';

switch($type){

//Insert Case // Needs to be discussed

case 'I':
case 'i':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){
$dbtablesnamesandaliasis .= $key.' '.$value.', ';
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2);

$dbcolsnames = '';
$dbcolsvalues = '';

if(!is_array($cols)){
// Fire Some Error
}else{
foreach($cols as $key => $value){
$dbcolsnames .= '`'.$key.'`, ';
$dbcolsvalues .= '\''.parent::db_input_values_protection($value).'\', ';
}
$dbcolsnames = substr($dbcolsnames, 0, -2);
$dbcolsvalues = substr($dbcolsvalues, 0, -2);
}

$sql = "INSERT INTO `".$dbtablesnamesandaliasis."` (".$dbcolsnames.") VALUES (".$dbcolsvalues.")";
break;

// Update Case

case 'U':
case 'u':

$setvalues = '';

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$value.', ';
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2);

if(!is_array($cols)){
// Fire Some Error
}else{
foreach($cols as $key => $value){
$setvalues  .= ''.$key.' = ' . '\''.parent::db_input_values_protection($value).'\', ';
}
$setvalues = substr($setvalues, 0, -2);
}

$setconditions = self::conditionsFormatterJ($conditions);

$sql = "UPDATE ".$dbtablesnamesandaliasis." SET ".$setvalues." WHERE ".$setconditions;

break;


// Select Case

case 'S':
case 's':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$value.', ';
}

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	$dbcolsnames .= '`'.$value.'`, ';
	}
}
$dbcolsnames = substr($dbcolsnames, 0, -2);
}

$setconditions = self::conditionsFormatterJ($conditions);


$sql = "SELECT ".$dbcolsnames." FROM ".$dbtablesnamesandaliasis." WHERE ".$setconditions;

if($orderby != ''){
$sql .= " ORDER BY ".$orderby;
}

if($startlimit != ''){
$sql .=  " LIMIT ".$startlimit;
}

if($endlimit != ''){
$sql .= " , ".$endlimit;
}

break;


// Delete Case

case 'D':
case 'd':

$setconditions = self::conditionsFormatter($conditions);


$sql = "DELETE FROM `".$table."` WHERE ".$setconditions;

break;


} // end of the case - I = Insert , U = Update, S = Select, D = Delete

return $sql;

} // function SQLCreatorJ


public function FireSQL($sql){
return parent::$DBConnectionObj->query($sql);
}

public function FetchResult($result){
return mysqli_fetch_object($result);
}

public function getLastInsertID(){
return parent::$DBConnectionObj->insert_id;
}

public function getNumRows($result){
return mysqli_num_rows($result);
}


public function getCleanData($value){
return parent::db_input_values_protection_decode($value);
}


public function limit_words($str, $n = 100, $end_char = '&#8230;')
{
	
	if (strlen($str) < $n){
		return $str;
	}
	$words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str)));
	if (count($words) <= $n){
		return $str;
	}	
	$str = '';
	for ($i = 0; $i < $n; $i++){
		$str .= $words[$i].' ';
	}
	return trim($str).$end_char;

}


} // end of class //