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

final class mysqli_DBConnection
{
    static private $DBinstance = NULL;
    private $MySqliOBj = NULL;

	private function __construct(){
	$this->MySqliOBj = new mysqli(PROJ_DBHOSTNAME,PROJ_DBUSER,PROJ_DBPASS,PROJ_DBNAME);
    }

    static public function getDBInstance(){
       if (self::$DBinstance == NULL) self::$DBinstance = new self;
       return self::$DBinstance;
    }

    public function __clone(){
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }


    public function getDBObj(){
        return $this->MySqliOBj;
    }
}