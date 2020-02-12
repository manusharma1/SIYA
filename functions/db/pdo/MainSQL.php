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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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


			case 'ANDINCON':
			case 'AND INCON':
			case 'AND IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND `'.$key .'` IN ('.$value.')';			
			break;

			case 'ORINCON':
			case 'OR INCON':
			case 'OR IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= 'OR `'.$key .'` IN ('.$value.')';			
			break;

			case '=':
			$setconditions .= '`'.$key .'` = '. '\''.$value.'\'';
			break;

			case '<':
			$setconditions .= '`'.$key .'` < '. '\''.$value.'\'';
			break;

			case '>':
			$setconditions .= '`'.$key .'` > '. '\''.$value.'\'';
			break;

			case '<=':
			$setconditions .= '`'.$key .'` <= '. '\''.$value.'\'';
			break;

			case '>=':
			$setconditions .= '`'.$key .'` >= '. '\''.$value.'\'';
			break;

			case '!=':
			$setconditions .= '`'.$key .'` != '. '\''.$value.'\'';
			break;

			case 'AND=':
			case 'AND =':

		    $setconditions .= ' AND `'. $key .'` = '. '\''.$value.'\'';
			break;

			case 'OR=':
			case 'OR =':

		    $setconditions .= ' OR `'. $key .'` = '. '\''.$value.'\'';
			break;

			case 'AND>=':
			case 'AND >=':
			case 'AND > =':

		    $setconditions .= ' AND `'. $key .'` >= '. '\''.$value.'\'';
			break;

			case 'OR>=':
			case 'OR >=':
			case 'OR > =':

		    $setconditions .= ' OR `'. $key .'` >= '. '\''.$value.'\'';
			break;


			case 'AND<=':
			case 'AND <=':
			case 'AND < =':

		    $setconditions .= ' AND `'. $key .'` <= '. '\''.$value.'\'';
			break;

			case 'OR<=':
			case 'OR <=':
			case 'OR < =':

		    $setconditions .= ' OR `'. $key .'` <= '. '\''.$value.'\'';
			break;


			case 'AND!=':
			case 'AND !=':

		    $setconditions .= ' AND `'. $key .'` != '. '\''.$value.'\'';
			break;

			case 'OR!=':
			case 'OR !=':

		    $setconditions .= ' OR `'. $key .'` != '. '\''.$value.'\'';
			break;

			
		}

		if($conditionclose == 1){
		$setconditions  .= ' '.$conditionvalue.' `'.$key.'` = ' . '\''.$value.'\'';
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



private static function conditionsFormatterPDO($conditions){

$conditionclose = 0;
$conditionvalue = '';
$setconditions = '';
$valuetypes = '';
$valuearray = array();
$returnarray = array();

foreach($conditions as $conkeys => $convalues){
 foreach($convalues as $conkey => $convalue){

		switch($conkeys){

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
			$setconditions  .= '`'.$conkey .'` IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case '!INARR':
			case '!IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= '`'.$conkey .'` NOT IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


			case 'ANDINARR':
			case 'AND IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND `'.$conkey .'` IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'AND!INARR':
			case 'AND !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND `'.$conkey .'` NOT IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


			case 'ORINARR':
			case 'OR IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR `'.$conkey .'` IN (';
				
				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'OR!INARR':
			case 'OR !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR `'.$conkey .'` NOT IN (';

				foreach($value as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}

			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'INCON':
			case 'IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= '`'.$conkey .'` IN ('.$value.')';			
			break;


			case 'ANDINCON':
			case 'AND INCON':
			case 'AND IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND `'.$conkey .'` IN ('.$value.')';			
			break;

			case 'ORINCON':
			case 'OR INCON':
			case 'OR IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= 'OR `'.$conkey .'` IN ('.$value.')';			
			break;

			case '=':
			$setconditions .= '`'.$conkey .'` = '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case '<':
			$setconditions .= '`'.$conkey .'` < '. '?';
			break;

			case '>':
			$setconditions .= '`'.$conkey .'` > '. '?';
			break;

			case '<=':
			$setconditions .= '`'.$conkey .'` <= '. '?';
			break;

			case '>=':
			$setconditions .= '`'.$conkey .'` >= '. '?';
			break;

			case '!=':
			$setconditions .= '`'.$conkey .'` != '. '?';
			break;

			case 'AND=':
			case 'AND =':

		    $setconditions .= ' AND `'. $conkey .'` = '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'OR=':
			case 'OR =':

		    $setconditions .= ' OR `'. $conkey .'` = '. '?';
			break;

			case 'AND>=':
			case 'AND >=':
			case 'AND > =':

		    $setconditions .= ' AND `'. $conkey .'` >= '. '?';
			break;

			case 'OR>=':
			case 'OR >=':
			case 'OR > =':

		    $setconditions .= ' OR `'. $conkey .'` >= '. '?';
			break;


			case 'AND<=':
			case 'AND <=':
			case 'AND < =':

		    $setconditions .= ' AND `'. $conkey .'` <= '. '?';
			break;

			case 'OR<=':
			case 'OR <=':
			case 'OR < =':

		    $setconditions .= ' OR `'. $conkey .'` <= '. '?';
			break;


			case 'AND!=':
			case 'AND !=':

		    $setconditions .= ' AND `'. $conkey .'` != '. '?';
			break;

			case 'OR!=':
			case 'OR !=':

		    $setconditions .= ' OR `'. $conkey .'` != '. '?';
			break;

			
		}

		if($conditionclose == 1){
		$setconditions  .= ' '.$conditionvalue.' `'.$conkey.'` = ' . '?';
		}

		if($conditionclose == 2){
		$setconditions  .= ')';
		}
	
		if($conditionclose == 1){
		$conditionclose = $conditionclose+1;
		}
	}
 
}

$returnarray['setconditions'] = $setconditions;
$returnarray['valuearray'] = $valuearray;

return $returnarray;

} // function conditionsFormatterPDO

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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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
				$invalues  .= '\''.$invalue.'\', ';
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

			case 'ANDINCON':
			case 'AND INCON':
			case 'AND IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND '.$key .' IN ('.$value.')';			
			break;

			case '!INCON':
			case '!IN CON':
			case '! IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= $key .' NOT IN ('.$value.')';			
			break;



			case '=':
			$setconditions .= $key .' = '. '\''.$value.'\'';
			break;

			case '<':
			$setconditions .= $key .' < '. '\''.$value.'\'';
			break;

			case '>':
			$setconditions .= $key .' > '. '\''.$value.'\'';
			break;

			case '<=':
			$setconditions .= $key .' <= '. '\''.$value.'\'';
			break;

			case '>=':
			$setconditions .= $key .' >= '. '\''.$value.'\'';
			break;

			case '!=':
			$setconditions .= $key .' != '. '\''.$value.'\'';
			break;

			case 'AND=':
			case 'AND =':

		    $setconditions .= ' AND '. $key .' = '. '\''.$value.'\'';
			break;

			case 'OR=':
			case 'OR =':

		    $setconditions .= ' OR '. $key .' = '. '\''.$value.'\'';
			break;

			case 'AND>=':
			case 'AND >=':
			case 'AND > =':

		    $setconditions .= ' AND '. $key .' >= '. '\''.$value.'\'';
			break;

			case 'OR>=':
			case 'OR >=':
			case 'OR > =':

		    $setconditions .= ' OR '. $key .' >= '. '\''.$value.'\'';
			break;


			case 'AND<=':
			case 'AND <=':
			case 'AND < =':

		    $setconditions .= ' AND '. $key .' <= '. '\''.$value.'\'';
			break;

			case 'OR<=':
			case 'OR <=':
			case 'OR < =':

		    $setconditions .= ' OR '. $key .' <= '. '\''.$value.'\'';
			break;

			case 'AND!=':
			case 'AND !=':

		    $setconditions .= ' AND '. $key .' != '. '\''.$value.'\'';
			break;

			case 'OR!=':
			case 'OR !=':

		    $setconditions .= ' OR '. $key .' != '. '\''.$value.'\'';
			break;

			case 'K=':
			case 'K =':

			$setconditions .= $key .' = '.$value;
			break;

			case 'K!=':
			case 'K !=':

			$setconditions .= $key .' != '.$value;
			break;

			case 'KAND=':
			case 'K AND =':

		    $setconditions .= ' AND '. $key .' = '.$value;
			break;

			case 'KOR=':
			case 'K OR =':

		    $setconditions .= ' OR '. $key .' = '.$value;
			break;

			case 'KAND!=':
			case 'K AND !=':

		    $setconditions .= ' AND '. $key .' != '.$value;
			break;

			case 'KOR!=':
			case 'K OR !=':

		    $setconditions .= ' OR '. $key .' != '.$value;
			break;
			
		}

		if($conditionclose == 1){
		$setconditions  .= ' '.$conditionvalue.' `'.$key.'` = ' . '\''.$value.'\'';
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





private static function conditionsFormatterJPDO($conditions){

$conditionclose = 0;
$conditionvalue = '';
$setconditions = '';


foreach($conditions as $conkeys => $convalues){
	foreach($convalues as $conkey => $convalue){

		switch($conkeys){

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
			$setconditions  .= $conkey .' IN (';
				
				foreach($convalue as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case '!INARR':
			case '!IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= $conkey .' NOT IN (';
				
				foreach($convalue as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


			case 'ANDINARR':
			case 'AND IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND '.$conkey .' IN (';
				
				foreach($convalue as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'AND!INARR':
			case 'AND !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND '.$conkey .' NOT IN (';
				
				foreach($convalue as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;


			case 'ORINARR':
			case 'OR IN ARR':
			// need to check if the value coming is array // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR '.$conkey .' IN (';
				
				foreach($convalue as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}
			
			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'OR!INARR':
			case 'OR !IN ARR':

			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' OR '.$conkey .' NOT IN (';

				foreach($convalue as $inkey => $invalue){
				$invalues  .= '\''.$invalue.'\', ';
				}

			$invalues = substr($invalues,0,-2);
			$setconditions .=  $invalues.')';
			break;

			case 'INCON':
			case 'IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= $conkey .' IN ('.$convalue.')';			
			break;

			case 'ANDINCON':
			case 'AND INCON':
			case 'AND IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= ' AND '.$conkey .' IN ('.$convalue.')';			
			break;

			case '!INCON':
			case '!IN CON':
			case '! IN CON':
			// need to check if the value coming is NOT AN ARRAY // note this
			$conditionvalue = '';
			$invalues = '';
			$setconditions  .= $conkey .' NOT IN ('.$convalue.')';			
			break;



			case '=':
			$setconditions .= $conkey .' = '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case '<':
			$setconditions .= $conkey .' < '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case '>':
			$setconditions .= $conkey .' > '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case '<=':
			$setconditions .= $conkey .' <= '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case '>=':
			$setconditions .= $conkey .' >= '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case '!=':
			$setconditions .= $conkey .' != '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'AND=':
			case 'AND =':

		    $setconditions .= ' AND '. $conkey .' = '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'OR=':
			case 'OR =':

		    $setconditions .= ' OR '. $conkey .' = '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'AND>=':
			case 'AND >=':
			case 'AND > =':

		    $setconditions .= ' AND '. $conkey .' >= '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'OR>=':
			case 'OR >=':
			case 'OR > =':

		    $setconditions .= ' OR '. $conkey .' >= '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;


			case 'AND<=':
			case 'AND <=':
			case 'AND < =':

		    $setconditions .= ' AND '. $conkey .' <= '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'OR<=':
			case 'OR <=':
			case 'OR < =':

		    $setconditions .= ' OR '. $conkey .' <= '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'AND!=':
			case 'AND !=':

		    $setconditions .= ' AND '. $conkey .' != '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'OR!=':
			case 'OR !=':

		    $setconditions .= ' OR '. $conkey .' != '. '?';
			$valuearray[][$convalue[1]] = $convalue[0];
			break;

			case 'K=':
			case 'K =':

			$setconditions .= $conkey .' = '.$convalue[0];
			break;

			case 'K!=':
			case 'K !=':

			$setconditions .= $conkey .' != '.$convalue[0];
			break;

			case 'KAND=':
			case 'K AND =':

		    $setconditions .= ' AND '. $conkey .' = '.$convalue[0];
			break;

			case 'KOR=':
			case 'K OR =':

		    $setconditions .= ' OR '. $conkey .' = '.$convalue[0];
			break;

			case 'KAND!=':
			case 'K AND !=':

		    $setconditions .= ' AND '. $conkey .' != '.$convalue[0];
			break;

			case 'KOR!=':
			case 'K OR !=':

		    $setconditions .= ' OR '. $conkey .' != '.$convalue[0];
			break;
			
		}

		if($conditionclose == 1){
		$setconditions  .= ' '.$conditionvalue.' `'.$conkey.'` = ' . '\''.$convalue.'\'';
		}

		if($conditionclose == 2){
		$setconditions  .= ')';
		}
	
		if($conditionclose == 1){
		$conditionclose = $conditionclose+1;
		}
	}

}

$returnarray['setconditions'] = $setconditions;
$returnarray['valuearray'] = $valuearray;

return $returnarray;
} // function conditionsFormatterJPDO




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
$dbcolsvalues .= '\''.$value.'\', ';
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
$setvalues  .= '`'.$key.'` = ' . '\''.$value.'\', ';
}
$setvalues = substr($setvalues, 0, -2);
}

if($conditions!=''){
$setconditions = self::conditionsFormatter($conditions);
$sql = "UPDATE `".$table."` SET ".$setvalues." WHERE ".$setconditions;
}else{
$sql = "UPDATE `".$table."` SET ".$setvalues;
}

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
	
	if(strstr($value,'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('=',$value);
	$dbcolsnames .= '`'.trim($valuearray[0]).'` AS '.trim($valuearray[1]).', ';
	}else{
	$dbcolsnames .= '`'.$value.'`, ';
	}
	
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

if($endlimit != ''){
$sql .= " , ".$endlimit;
}

break;


// Select Case with SQL Functions added 11 Jun 2012 eg : SELECT MAX(id) ect.

case 'SF':
case 'sf':

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	if(strstr($value,'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('=',$value);
	$dbcolsnames .= '`'.trim($valuearray[0]).'` AS '.trim($valuearray[1]).', ';
	}else{
	$dbcolsnames .= ''.$value.', ';
	}
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



// Select Case // SELECT DISTINCT Added 27 May 2012

case 'SD':
case 'sd':
case 'S D':
case 's d':

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
$sql = "SELECT DISTINCT ".$dbcolsnames." FROM `".$table."` WHERE ".$setconditions;
}else{
$sql = "SELECT DISTINCT".$dbcolsnames." FROM `".$table."`";
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


// Function for MySql Prepared Statements - Added 04 June 2013 //

public function SQLCreatorPDO($type, $table, $cols, $conditions, $orderby, $startlimit, $endlimit){ // Added 04 June 2013 //

$sql = '';
$sqlreturnarray = array();
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
$dbcolsvalues .= '\''.$value.'\', ';
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
$setvalues  .= '`'.$key.'` = ' . '\''.$value.'\', ';
}
$setvalues = substr($setvalues, 0, -2);
}

if($conditions!=''){
$setconditions = self::conditionsFormatter($conditions);
$sql = "UPDATE `".$table."` SET ".$setvalues." WHERE ".$setconditions;
}else{
$sql = "UPDATE `".$table."` SET ".$setvalues;
}

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
	
	if(strstr($value,'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('=',$value);
	$dbcolsnames .= '`'.trim($valuearray[0]).'` AS '.trim($valuearray[1]).', ';
	}else{
	$dbcolsnames .= '`'.$value.'`, ';
	}
	
	}
}
$dbcolsnames = substr($dbcolsnames, 0, -2);
}

if($conditions != ''){
$returnarray = self::conditionsFormatterPDO($conditions);
$setconditions = $returnarray['setconditions'];

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

if($endlimit != ''){
$sql .= " , ".$endlimit;
}

break;


// Select Case with SQL Functions added 11 Jun 2012 eg : SELECT MAX(id) ect.

case 'SF':
case 'sf':

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	if(strstr($value,'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('=',$value);
	$dbcolsnames .= '`'.trim($valuearray[0]).'` AS '.trim($valuearray[1]).', ';
	}else{
	$dbcolsnames .= ''.$value.', ';
	}
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



// Select Case // SELECT DISTINCT Added 27 May 2012

case 'SD':
case 'sd':
case 'S D':
case 's d':

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
$sql = "SELECT DISTINCT ".$dbcolsnames." FROM `".$table."` WHERE ".$setconditions;
}else{
$sql = "SELECT DISTINCT".$dbcolsnames." FROM `".$table."`";
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


$sqlreturnarray['sql'] = $sql;
$sqlreturnarray['valuearray'] = $returnarray['valuearray'];
return $sqlreturnarray;

}

// function SQLCreatorSTMT



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
$dbcolsvalues .= '\''.$value.'\', ';
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
$setvalues  .= ''.$key.' = ' . '\''.$value.'\', ';
}
$setvalues = substr($setvalues, 0, -2);
}

if($conditions!=''){
$setconditions = self::conditionsFormatterJ($conditions);
$sql = "UPDATE ".$dbtablesnamesandaliasis." SET ".$setvalues." WHERE ".$setconditions;
}else{
$sql = "UPDATE ".$dbtablesnamesandaliasis." SET ".$setvalues." WHERE ".$setconditions;
}
break;


// Select Case

case 'S':
case 's':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){ 
$tablevaluearray = explode(',',$value); // Modified on 03 May 2012 // Because of the self Join//
for($i=0;$i<count($tablevaluearray);$i++){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$tablevaluearray[$i].', '; // Modified on 03 May 2012 // Because of the self Join//
}
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2); // Modified 19 Apr 2012

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	if(strstr($value,'.')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('.',$value); // First Modified 19 Apr 2012
	if(strstr($valuearray[1],'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray2 = explode('=',$valuearray[1]);
	$dbcolsnames .= $valuearray[0].'.`'.trim($valuearray2[0]).'` AS '.trim($valuearray2[1]).', ';
	}else{
	$dbcolsnames .= $valuearray[0].'.`'.$valuearray[1].'`, ';
	}
	}
	}

}
$dbcolsnames = substr($dbcolsnames, 0, -2);
}

$returnarray = self::conditionsFormatterJPDO($conditions);
$setconditions = $returnarray['setconditions'];

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


// Select Case with SQL Functions added 11 Jun 2012 eg : SELECT MAX(id) ect.

case 'SF':
case 'sf':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){ 
$tablevaluearray = explode(',',$value); // Modified on 03 May 2012 // Because of the self Join//
for($i=0;$i<count($tablevaluearray);$i++){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$tablevaluearray[$i].', '; // Modified on 03 May 2012 // Because of the self Join//
}
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2); // Modified 19 Apr 2012

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	if(strstr($value,'.')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('.',$value); // First Modified 19 Apr 2012
	if(strstr($valuearray[1],'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray2 = explode('=',$valuearray[1]);
	$dbcolsnames .= $valuearray[0].'.'.trim($valuearray2[0]).' AS '.trim($valuearray2[1]).', ';
	}else{
	$dbcolsnames .= $valuearray[0].'.'.$valuearray[1].', ';
	}
	}
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



// Select Case // SELECT DISTINCT Added 27 May 2012 // We need to find some better ways to do this

case 'SD':
case 'sd':
case 'S D':
case 's d':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){ 
$tablevaluearray = explode(',',$value); // Modified on 03 May 2012 // Because of the self Join//
for($i=0;$i<count($tablevaluearray);$i++){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$tablevaluearray[$i].', '; // Modified on 03 May 2012 // Because of the self Join//
}
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2); // Modified 19 Apr 2012

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	$valuearray = explode('.',$value); // Modified 19 Apr 2012
	$dbcolsnames .= $valuearray[0].'.`'.$valuearray[1].'`, ';
	}
}
$dbcolsnames = substr($dbcolsnames, 0, -2);
}

$setconditions = self::conditionsFormatterJ($conditions);


$sql = "SELECT DISTINCT ".$dbcolsnames." FROM ".$dbtablesnamesandaliasis." WHERE ".$setconditions;

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



public function SQLCreatorJPDO($type, $tables, $cols, $conditions, $orderby, $startlimit, $endlimit){

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
$dbcolsvalues .= '\''.$value.'\', ';
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
$setvalues  .= ''.$key.' = ' . '\''.$value.'\', ';
}
$setvalues = substr($setvalues, 0, -2);
}

if($conditions!=''){
$setconditions = self::conditionsFormatterJ($conditions);
$sql = "UPDATE ".$dbtablesnamesandaliasis." SET ".$setvalues." WHERE ".$setconditions;
}else{
$sql = "UPDATE ".$dbtablesnamesandaliasis." SET ".$setvalues." WHERE ".$setconditions;
}
break;


// Select Case

case 'S':
case 's':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){ 
$tablevaluearray = explode(',',$value); // Modified on 03 May 2012 // Because of the self Join//
for($i=0;$i<count($tablevaluearray);$i++){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$tablevaluearray[$i].', '; // Modified on 03 May 2012 // Because of the self Join//
}
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2); // Modified 19 Apr 2012

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	if(strstr($value,'.')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('.',$value); // First Modified 19 Apr 2012
	if(strstr($valuearray[1],'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray2 = explode('=',$valuearray[1]);
	$dbcolsnames .= $valuearray[0].'.`'.trim($valuearray2[0]).'` AS '.trim($valuearray2[1]).', ';
	}else{
	$dbcolsnames .= $valuearray[0].'.`'.$valuearray[1].'`, ';
	}
	}
	}

}
$dbcolsnames = substr($dbcolsnames, 0, -2);
}

$returnarray = self::conditionsFormatterJPDO($conditions);
$setconditions = $returnarray['setconditions'];


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


// Select Case with SQL Functions added 11 Jun 2012 eg : SELECT MAX(id) ect.

case 'SF':
case 'sf':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){ 
$tablevaluearray = explode(',',$value); // Modified on 03 May 2012 // Because of the self Join//
for($i=0;$i<count($tablevaluearray);$i++){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$tablevaluearray[$i].', '; // Modified on 03 May 2012 // Because of the self Join//
}
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2); // Modified 19 Apr 2012

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	if(strstr($value,'.')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray = explode('.',$value); // First Modified 19 Apr 2012
	if(strstr($valuearray[1],'=')){ // Added / Modified 11 June 2012 Due to Column Alias
	$valuearray2 = explode('=',$valuearray[1]);
	$dbcolsnames .= $valuearray[0].'.'.trim($valuearray2[0]).' AS '.trim($valuearray2[1]).', ';
	}else{
	$dbcolsnames .= $valuearray[0].'.'.$valuearray[1].', ';
	}
	}
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



// Select Case // SELECT DISTINCT Added 27 May 2012 // We need to find some better ways to do this

case 'SD':
case 'sd':
case 'S D':
case 's d':

$dbtablesnamesandaliasis = '';

foreach($tables as $key => $value){ 
$tablevaluearray = explode(',',$value); // Modified on 03 May 2012 // Because of the self Join//
for($i=0;$i<count($tablevaluearray);$i++){
$dbtablesnamesandaliasis .= '`'.$key.'` '.$tablevaluearray[$i].', '; // Modified on 03 May 2012 // Because of the self Join//
}
}

$dbtablesnamesandaliasis = substr($dbtablesnamesandaliasis, 0, -2); // Modified 19 Apr 2012

$dbcolsnames = '';

if(!is_array($cols)){
$dbcolsnames = $cols;
}else{
foreach($cols as $key => $value){
	if($value=='*'){
	$dbcolsnames .= $value.', ';
	}else{
	$valuearray = explode('.',$value); // Modified 19 Apr 2012
	$dbcolsnames .= $valuearray[0].'.`'.$valuearray[1].'`, ';
	}
}
$dbcolsnames = substr($dbcolsnames, 0, -2);
}

$setconditions = self::conditionsFormatterJ($conditions);


$sql = "SELECT DISTINCT ".$dbcolsnames." FROM ".$dbtablesnamesandaliasis." WHERE ".$setconditions;

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

$sqlreturnarray['sql'] = $sql;
$sqlreturnarray['valuearray'] = $returnarray['valuearray'];
return $sqlreturnarray;

} // function SQLCreatorJPDO



public function FireSQL($sql){
return parent::$DBConnectionObj->prepare($sql);
}

public function PDOBindValues($sth,$valuearrays){

foreach($valuearrays as $keys => $values){
foreach($values as $key => $value){
$sequence = $keys + 1;
$parameter = $value;

if($key=='STR'){
$parametervalue = PDO::PARAM_STR;
}else if($key=='BOOL'){
$parametervalue = PDO::PARAM_BOOL;
}else if($key=='INT'){
$parametervalue = PDO::PARAM_INT;
}

$sth->bindValue($sequence,$parameter,$parametervalue);
}
}
	
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