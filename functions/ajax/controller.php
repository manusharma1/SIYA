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

ob_clean();

$result = '';
if(isset($_GET['method']) && $_GET['method']=='get' && isset($_GET['ajaxcall']) && $_GET['ajaxcall'] == '1'){
$urlarray = explode('/', $_GET['url']);
$isblock = $_GET['isblock'];
}if(isset($_POST['method']) && $_POST['method']=='post' && isset($_POST['ajaxcall']) && $_POST['ajaxcall'] == '1'){
$urlarray = explode('/', $_POST['url']);
$isblock = $_POST['isblock'];
}

$module_block = (isset($urlarray[0]))?$urlarray[0]:'';
$module_block_action  = (isset($urlarray[1]))?$urlarray[1]:'';
$module_block_action_parameters = (isset($urlarray[2]))?$urlarray[2]:'';

//Allowed Actions, Please add your allowed actions, in the array

//array('login','logout','loginCheck','getAdminHome','getContent','errorPage','addNewPage','addNewMenu','savePage','saveMenu','editPage','editMenu','managePages','manageMenus','deletePage','deleteMenu','deletePageConfirmed','deleteMenuConfirmed','ajaxGetPageContent');

$allowed_actions = array('saveUserType','sendChatMessage','getNewChatText','getPagesByMenu','showChatUser','showChatText','getNewChatUsersStatus','showChatText','saveHoliday','editHoliday');
if(in_array($module_block_action,$allowed_actions)){
require_once('include.php');

if(isset($_GET['method']) && $_GET['method']=='get' && isset($_GET['ajaxcall']) && $_GET['ajaxcall'] == '1'){

$result = MainSystem::CallAjaxActionView($module_block,$module_block_action,$module_block_action_parameters,$isblock);


}

if(isset($_POST['method']) && $_POST['method']=='post' && isset($_POST['ajaxcall']) && $_POST['ajaxcall'] == '1'){
$MainSystemObj = new MainSystem(); // Main Caller 
$result = $MainSystemObj->CallModule($module_block,$module_block_action,array($module_block_action_parameters)); // ClassName , Method Name, Parameters in Array
}

}else{
$result = 'Action not Allowed';
}

echo $result;