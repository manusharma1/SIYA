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
	
	$startscripttime = microtime(TRUE);

	if(is_dir('siyasetup') && !is_file('mainsystemconfig.php')){
	header("location:siyasetup/index.php");
	}

	if(phpversion() >= '5.3.0'){
	require_once('init.php');
	}else{
	require_once('init_old.php');
	}

	MainSystem::IncludeSystemLanguage();
	MainSystem::SelectTemplate();
	MainSystem::IncludeModules();
	MainSystem::IncludeBlocks();
	MainSystem::MainActionCaller();
	MainSystem::MainTemplateControllerViewCaller();

	if(MainSystem::checkSIYASetup()){
	if(is_dir('siyasetup') && is_file('mainsystemconfig.php')){
	echo '<div align="center"><p class="button orange large">Please delete the SIYA Setup (Installation) Folder (Folder name is "siyasetup")</p></div>';
	}
	}

	//gc_enable(); // Enable Garbage Collector
	//var_dump(gc_enabled()); // true
	//var_dump(gc_collect_cycles()); // # of elements cleaned up
	//gc_disable(); // Disable Garbage Collector

	$endscripttime = microtime(TRUE);

	//echo $endscripttime-$startscripttime;