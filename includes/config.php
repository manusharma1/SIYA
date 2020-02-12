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

//PROJECT / WEBSITE NAME
define('PROJ_NAME', 'www.siya.org.in');

// DEFAULT FOLDER NAME //

define('PROJ_FOLDERNAME', ''); // to be defined manually according to the folder name //

// DATABASE //

define('PROJ_DBHOSTNAME','localhost');
define('PROJ_DBNAME','openorgi_siya');
define('PROJ_DBUSER','openorgi_siya');
define('PROJ_DBPASS','3k.Tb%JM}!9U');
define('PROJ_DBTYPE','mysqli');


// ERROR REPORTING AND SETTINGS

define('PROJ_ERROR_REPORTING_SWITCH', E_ALL | E_STRICT);
//define('PROJ_ERROR_REPORTING_SWITCH', NULL);



// PATHS TO TEMPLATES, BLOCKS, MODULE FOLDERS
if(PROJ_FOLDERNAME == ''){
define('PROJ_MAIN_DIR', PROJ_DOCUMENTROOT);
define('PROJ_TEMPLATES_DIR', PROJ_DOCUMENTROOT._S.'templates');
define('PROJ_BLOCKS_DIR', PROJ_DOCUMENTROOT._S.'blocks');
define('PROJ_MODULES_DIR', PROJ_DOCUMENTROOT._S.'modules');
define('PROJ_MAINSYSTEM_JS_DIR', PROJ_DOCUMENTROOT._S.'functions'._S.'js');
define('PROJ_MAINSYSTEM_AJAX_DIR', PROJ_DOCUMENTROOT._S.'functions'._S.'ajax');
define('PROJ_3RDPARTY_DIR', PROJ_DOCUMENTROOT._S.'3rdparty');
define('PROJ_DATA_DIR',  PROJ_DOCUMENTROOT._S.'uploads'); // This needs to be changed and should be ouside www root// will require modification in the next version
define('PROJ_MAIN_WWW_DIR', PROJ_HOSTNAME);
define('PROJ_TEMPLATES_WWW_DIR', PROJ_HOSTNAME._WS.'templates');
define('PROJ_BLOCKS_WWW_DIR', PROJ_HOSTNAME._WS.'blocks');
define('PROJ_MODULES_WWW_DIR', PROJ_HOSTNAME._WS.'modules');
define('PROJ_MAINSYSTEM_JS_WWW_DIR', PROJ_HOSTNAME._WS.'functions'._WS.'js');
define('PROJ_MAINSYSTEM_AJAX_WWW_DIR', PROJ_HOSTNAME._WS.'functions'._WS.'ajax');
define('PROJ_3RDPARTY_WWW_DIR', PROJ_HOSTNAME._WS.'3rdparty');
define('PROJ_DATA_WWW_DIR',  PROJ_HOSTNAME._WS.'uploads'); // This needs to be changed and should be ouside www root// will require modification in the next version
}else{
define('PROJ_MAIN_DIR', PROJ_DOCUMENTROOT.PROJ_FOLDERNAME);
define('PROJ_TEMPLATES_DIR', PROJ_DOCUMENTROOT.PROJ_FOLDERNAME._S.'templates');
define('PROJ_BLOCKS_DIR', PROJ_DOCUMENTROOT.PROJ_FOLDERNAME._S.'blocks');
define('PROJ_MODULES_DIR', PROJ_DOCUMENTROOT.PROJ_FOLDERNAME._S.'modules');
define('PROJ_MAINSYSTEM_JS_DIR', PROJ_DOCUMENTROOT.PROJ_FOLDERNAME._S.'functions'._S.'js');
define('PROJ_MAINSYSTEM_AJAX_DIR', PROJ_DOCUMENTROOT.PROJ_FOLDERNAME._S.'functions'._S.'ajax');
define('PROJ_3RDPARTY_DIR', PROJ_DOCUMENTROOT.PROJ_FOLDERNAME._S.'3rdparty');
define('PROJ_DATA_DIR',  PROJ_DOCUMENTROOT.PROJ_FOLDERNAME._S.'uploads'); // This needs to be changed and should be ouside www root// will require modification in the next version
define('PROJ_MAIN_WWW_DIR', PROJ_HOSTNAME._WS.PROJ_FOLDERNAME);
define('PROJ_TEMPLATES_WWW_DIR', PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS.'templates');
define('PROJ_BLOCKS_WWW_DIR', PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS.'blocks');
define('PROJ_MODULES_WWW_DIR', PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS.'modules');
define('PROJ_MAINSYSTEM_JS_WWW_DIR', PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS.'functions'._WS.'js');
define('PROJ_MAINSYSTEM_AJAX_WWW_DIR', PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS.'functions'._WS.'ajax');
define('PROJ_3RDPARTY_WWW_DIR', PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS.'3rdparty');
define('PROJ_DATA_WWW_DIR',  PROJ_HOSTNAME._WS.PROJ_FOLDERNAME._WS.'uploads'); // This needs to be changed and should be ouside www root// will require modification in the next version
}


// OVERRIDE ADMIN TEMPLATE WHEN ADMIN SESSION IS ON

define('PROJ_OVERRIDE_ADMIN_TEMPLATE', 1);

// EVEN IF ADMIN TEMPLATE OVERRIDE IS TRUE SOME MODULE AND ACTIONS SHOULD USE ONLY MAIN TEMPLATE // HERE OVERRIDING IS DISABLED FOR THE COMBINATION OF MODULE:ACTION , Example : cms/getContent 
//IF YOU ARE ADDING MORE COMBINATIONS THEN IT SOULD BE COMMA SEPERATED

define('PROJ_MODULES_AND_ACTIONS_USEONLY_MAIN_TEMPLATE', 'cms/getContent');


// DEFAULT FOLDERS AND FILES

define('PROJ_DEFAULT_FOLDER_FILE', 'index.php');
define('PROJ_DEFAULT_CSS_FOLDER', 'css');
define('PROJ_DEFAULT_JS_FOLDER', 'js');
define('PROJ_DEFAULT_CONTROLLER_FILE', 'controller.php');
define('PROJ_DEFAULT_ACTIONVIEWS_FOLDER', 'actionviews');
define('PROJ_ADMIN_TEMPLATE_DIR', 'admin');

//DEFUALT AJAX TEMPLATE ELEMENT ID // FOR ANY AJAX CALL THE RETURN VALUE WILL BE SHOWN IN BETWEEN THE ELEMENT DEFINED IN HTML

define('PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE', 'ajaxcontentelement');


//DEFUALT AJAX POST CLASS

define('PROJ_AJAX_HTML_POST_CLASS_FOR_TEMPLATE', 'ajaxpostclass');


//SEO FRIENDLY URLS (0-Normal, 1-SEO)
define('PROJ_SEO_FRIENDLY_URLS', 1);

//SEO FRIENDLY URLS SEETINGS 
//0-Normal
//1-Include Page Title at last in URL WORKS ONLY WITH CMS PAGES (ONLY FOR cms MODULE and getContent ACTION)
//2- Needs to be defined (UNDEFINED UNTIL NOW))
define('PROJ_SEO_FRIENDLY_URLS_SETTINGS', 1);

//SALT
define('PROJ_SEC_SALT', 'Siya-ORG@$%hjj#$%#4234In');


//SESSION TIME LIMIT
define('PROJ_SESSION_TIME_LIMIT', 3600);


//HTML EDITOR TINYMCE OR CKEDITOR
define('PROJ_HTML_EDITOR', 'ckeditor');


// TIME ZONE
define('PROJ_TIME_ZONE', 'Asia/Calcutta');

// ALLOWED HTML EDITOR HTML TAGS // COMMA SEPERATED // PLEASE ADD ANY NEW TAG CAREFULLY, IT MAY LED TO SECURITY ISSUES IN YOUR PROJECT
define('PROJ_ALLOWED_HTML_TAGS', '<a>,<br>,<blockquote>,<div>,<em>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<hr>,<img>,<li>,<ol>,<p>,<pre>,<span>,<strong>,<sub>,<sup>,<strike>,<u>,<ul>,<table>,<td>,<th>,<tr>,<script>');

// ALLOWED FILE TYPES TO UPLOAD ON THE SYSTEM // COMMA SEPERATED // PLEASE ADD ANY NEW FILE EXTENSIONS CAREFULLY, IT MAY LED TO SECURITY ISSUES IN YOUR PROJECT
define('PROJ_ALLOWED_UPLOAD_FILE_TYPES', 'jpg,jpeg,png,gif,bmp,doc,docx,xls,xlsx,ppt,pptx,pdf,flv');