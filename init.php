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
////////////////////////////////////////////////////////////////////////////

require_once("environment.php"); // To Be Changed after the creation of Install file
Environment::set_seperator();
Environment::set_paths();
require_once('mainsystemconfig.php'); // Main System Config File
$error_reporting = (defined('PROJ_ERROR_REPORTING_SWITCH'))?PROJ_ERROR_REPORTING_SWITCH:E_ALL|E_STRICT;
error_reporting($error_reporting);
Environment::set_error_reporting();
require_once('includes'._S.'db.php'); // DB Connection File
require_once('functions'._S.'db'._S.PROJ_DBTYPE._S.'MainDB.php'); // Main DB Class and Functions
require_once('functions'._S.'db'._S.PROJ_DBTYPE._S.'MainSQL.php'); // Main SQL Formatter Class and Functions
require_once('functions'._S.'html'._S.'MainHTML.php'); // Main HTML Formatter Class and Functions
require('functions'._S.'system'._S.'MainSystem.php'); // Main System Functions
$DBFilename = DBSelector::selectDB(PROJ_DBTYPE);
$DBConnection = $DBFilename::getDBInstance();
$DBConnectionObj = $DBConnection->getDBObj();
MainDB::initDBConnectionObj($DBConnectionObj);
require_once('includes'._S.'config.php'); // Config File

Environment::set_time_zone();