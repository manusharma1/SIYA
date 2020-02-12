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
class menublock
{
private static $lang;

function SIYA__menublock_INSTALLER__(){

$block_installer_info_array = array();
$block_installer_info_array['block']['info'] = array('description' => '');
$block_installer_info_array['action']['SIYA__Default_menublock_Action'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
$block_installer_info_array['action']['showCMSMenu'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
$block_installer_info_array['action']['showAdminMenu'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
$block_installer_info_array['action']['showBlogPagesMenu'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
return $block_installer_info_array;
}

function SIYA__menublock_INIT__(){

global $lang;

self::$lang = $lang;

}


function  SIYA__Default_menublock_Action($blocktitle = '')
{

	$actionviewresult = MainSystem::CallActionView($blocktitle,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}


function  showCMSMenu($blocktitle = '')
{

	$actionviewresult = MainSystem::CallActionView($blocktitle,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}


function  showAdminMenu($blocktitle = '')
{

	$actionviewresult = MainSystem::CallActionView($blocktitle,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}


function  showBlogPagesMenu($blocktitle = '')
{

	$actionviewresult = MainSystem::CallActionView($blocktitle,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}

} // class menublock