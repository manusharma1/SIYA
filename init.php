<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
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
///////////////////////////////////////////////////////////////////////////

require_once("environment.php"); // To Be Changed after the creation of Install file
Environment::set_error_reporting();
Environment::set_seperator();
Environment::set_paths();
require_once('includes'._S.'config.php'); // Main Config File
error_reporting(PROJ_ERROR_REPORTING_SWITCH);
Environment::set_time_zone();
require_once('includes'._S.'db.php'); // DB Connection File
require_once('functions'._S.'db'._S.PROJ_DBTYPE._S.'MainDB.php'); // Main DB Class and Functions
require_once('functions'._S.'db'._S.PROJ_DBTYPE._S.'MainSQL.php'); // Main SQL Formatter Class and Functions
require_once('functions'._S.'html'._S.'MainHTML.php'); // Main HTML Formatter Class and Functions
require('functions'._S.'system'._S.'MainSystem.php'); // Main System Functions
$DBFilename = DBSelector::selectDB(PROJ_DBTYPE);
$DBConnection = $DBFilename::getDBInstance();
$DBConnectionObj = $DBConnection->getDBObj();