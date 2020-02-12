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
class Environment 
{

static function set_seperator(){
define('_S', DIRECTORY_SEPARATOR);
define('_WS', '/');
}

static function set_paths(){
define('PROJ_HOSTNAME', 'http://'.$_SERVER['HTTP_HOST']);
$backslash_os = array('CYGWIN_NT-5.1','WIN32','WINNT','Windows');
$slash_os = array('Darwin','FreeBSD','HP-UX','IRIX64','Linux','NetBSD','OpenBSD','SunOS','Unix');
if(in_array(PHP_OS,$backslash_os)){
$documentroot = str_replace("/", "\\", $_SERVER['DOCUMENT_ROOT']);
define('PROJ_DOCUMENTROOT', $documentroot);
}else if(in_array(PHP_OS,$slash_os)){
define('PROJ_DOCUMENTROOT', $_SERVER['DOCUMENT_ROOT']);
}else{
define('PROJ_DOCUMENTROOT', $_SERVER['DOCUMENT_ROOT']);
}
}

static function error_reporter($errno, $errstr, $errfile, $errline){

switch ($errno) {
case E_USER_ERROR:
case E_USER_WARNING:
case E_USER_NOTICE:
$project_error_message = $errstr;
break;

default:
$project_error_message = 'The Following Error has been occoured:'.'</br>'.'Error No - '.$errno.'</br>'.'Error Line - '.$errline.'</br>'.'Error File - '.$errfile.'</br>'.'Error - '.$errstr;
break;
}

$project_error_message_value = '<div class="box">
  <div class="topleft">
  <div class="topright">
    <div>'.$project_error_message.'</div>
  </div>
  </div>
  <div class="bottomleft">
  <div class="bottomright">
  </div>
  </div>
</div>';

echo $project_error_message_value;
}

static function set_error_reporting(){
set_error_handler(array(__CLASS__,'error_reporter'));
}

static function set_time_zone(){
date_default_timezone_set(PROJ_TIME_ZONE);
}



} // class Environment