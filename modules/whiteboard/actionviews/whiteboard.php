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

//Reference is taken from http://blog.ilric.org/2010/11/20/javascript-collaborative-painting-software-using-html5-canvas 
?>
<?php

/*$return = array () ;
 
switch ($_GET['action']){
    
	case 'gpfp':
		$return ["path"] = array();
		$id = intval($_GET['value']);
		$columns = array('id','path','color','width');
		$conditions = array();
		$conditions['>']['id'] = $id;
		$sqlObj = new MainSQL();
		$sql = $sqlObj->SQLCreator('S', 'whiteboardtempdata', $columns, $conditions, '', '', '');
		if($result = $sqlObj->FireSQL($sql)){
		if($sqlObj->getNumRows($result) !=0){ // If News Exists
		while($resultset = $sqlObj->FetchResult($result)){
		$return["path"][] = array("data" => json_decode($resultset->path), "color" => $resultset->color, "width" => $resultset->width);
		$return["id"] = intval($resultset->id);
		}
		}
		}else{
		json_encode(array("error" => "Database query failed"));
		}
		$return["ok"] = "Query OK";
        break;

    case 'tp':
		
		$path = explode("|",$_GET['value']);
		array_walk ($path, create_function( '&$a', '$a = explode(",",$a);'));
		array_walk_recursive($path, create_function( '&$a', 'if(!intval($a)) die(); '));
		$path = json_encode($path);


		$data = array();
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['path'] = '{$path}';
		$data['width'] = intval($_GET['lw']);
		$data['color'] = htmlspecialchars($_GET['color']);
		
		$sql = $sqlObj->SQLCreator('I', 'whiteboardtempdata', $data, '', '', '', '');

		if($result = $sqlObj->FireSQL($sql)){
		$_SESSION['message'] = 'White Board Temporary Data Saved';
		
		}else{
		json_encode(array("error" => "Database query failed"))
		}
		$return["ok"] = "Query OK";
		$return["id"] = $sqlObj->getLastInsertID();
		$return["orid"] = intval ($_GET['orid']);
		break;


	case 'cni':
		$columns = array('id');
		$sql = $sqlObj->SQLCreator('S', 'whiteboardtempdata', $columns, '', 'id DESC', '1', '');
		if($result = $sqlObj->FireSQL($sql)){
		if($sqlObj->getNumRows($result) !=0){
		while($resultset = $sqlObj->FetchResult($result)){
		$return["id"] = intval($resultset->id);
		}
		}
		}else{
		json_encode(array("error" => "Database query failed"));
		}
		break;


        case 'cni':
                $r = mysql_query ( "SELECT id FROM whiteboardtempdata ORDER BY id DESC LIMIT 1" ) or die(json_encode(array("error" => "Database query failed: " . mysql_error())));
                $row = mysql_fetch_assoc ( $r );
                $return ["id"] = intval($row ["id"]);
                break;

 
default :
		$return["error"] = "No action given";
		break;
}

//print_r($return);die; 
echo json_encode( $return );
*/
?>
<?php //This is taken from http://blog.ilric.org/2010/11/20/javascript-collaborative-painting-software-using-html5-canvas ?>

<?php
//mysql_connect("localhost","root","") or die(json_encode(array("error" => "Database connection failed")));
//mysql_select_db("siya") or die(json_encode(array("error" => "Database connection failed")));

if(phpversion() >= '5.3.0'){
require_once('../../init.php');
}else{
require_once('../../init_old.php');
}

$sqlObj = new MainSQL();

$return = array ( ) ;
 
switch ( $_GET['action'] ) {
        case 'gpfp':
                $return ["path"] = array ( );
                $r = $sqlObj->FireSQL("SELECT id,path,color,width FROM whiteboardtempdata WHERE id > " . intval ( $_GET['value'] ) ) or die(json_encode(array("error" => "Database query failed")));
                while ( $row =  $r->fetch_assoc() ) {
                        $return ["path"] [] = array("data" => json_decode ( $row ["path"] ), "color" => $row["color"], "width" => $row["width"]);
                        $return ["id"] = intval( $row ["id"] ) ;
                }
                $return ["ok"] = "Query OK";
                break;
        case 'tp':
                $path = explode("|",$_GET['value']);
                array_walk ( $path, create_function( '&$a', '$a = explode(",",$a);' ) );
                array_walk_recursive( $path, create_function( '&$a', 'if(!intval($a)) die(); ' ) );
                $path = json_encode ( $path );
                $sqlObj->FireSQL( "INSERT INTO whiteboardtempdata (ip,host,path,width,color) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','" . $_SERVER['HTTP_HOST'] . "','{$path}'," . intval($_GET['lw']) . ",'" . htmlspecialchars($_GET['color']) . "')" ) or die(json_encode(array("error" => "Database query failed: " . mysqli_error())));
                $return ["ok"] = "Query OK";
                $return ["id"] = $sqlObj->getLastInsertID();
                $return ["orid"] = intval ( $_GET['orid'] );
                break;
        case 'cni':
                $r = $sqlObj->FireSQL( "SELECT id FROM whiteboardtempdata ORDER BY id DESC LIMIT 1" ) or die(json_encode(array("error" => "Database query failed: " . mysqli_error())));
                $row = $r->fetch_assoc();
                $return ["id"] = intval($row ["id"]);
                break;
 
        default :
                $return ["error"] = "No action given";
                break;
}

echo json_encode( $return );
?>