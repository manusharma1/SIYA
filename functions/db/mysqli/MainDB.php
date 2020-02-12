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

class MainDB
{

static protected $DBConnectionObj = NULL;

static public function initDBConnectionObj($DBConnectionObj){
self::$DBConnectionObj = $DBConnectionObj;
}


static public function closeDBConnection(){
self::$DBConnectionObj->close();
}

protected static function db_input_values_protection($value){ 

    if (get_magic_quotes_gpc()) { 
        $value = stripslashes($value); 
    } 
    if (!is_numeric($value)) { 
        $value = htmlspecialchars(self::$DBConnectionObj->real_escape_string(strip_tags($value,PROJ_ALLOWED_HTML_TAGS)));
    } 
    return $value; 

} // function db_input_values_protection

protected static function db_input_values_protection_v2($value){ 

    if (get_magic_quotes_gpc()) { 
        $value = stripslashes($value); 
    } 
    if (!is_numeric($value)) { 
        $value = htmlspecialchars(self::$DBConnectionObj->real_escape_string($value));
    } 
    return $value; 

} // function db_input_values_protection_v2


protected static function db_input_values_protection_decode($value){ 

    if (!is_numeric($value)) { 
        $value = htmlspecialchars_decode($value);
    } 
    return $value; 

} // function db_input_values_protection_decode


protected static function db_input_values_protection_no_htmlsplchars($value){ 

    if (get_magic_quotes_gpc()) { 
        $value = stripslashes($value); 
    } 
    if (!is_numeric($value)) { 
        $value = self::$DBConnectionObj->real_escape_string(strip_tags($value));
    } 
    return $value; 

} // function db_input_values_protection_no_htmlsplchars


} // class MainDB