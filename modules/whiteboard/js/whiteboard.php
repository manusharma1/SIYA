<?php //This is taken from http://blog.ilric.org/2010/11/20/javascript-collaborative-painting-software-using-html5-canvas ?>

<?php
mysql_connect("localhost","root","") or die(json_encode(array("error" => "Database connection failed")));
mysql_select_db("siya") or die(json_encode(array("error" => "Database connection failed")));
 
$return = array ( ) ;
 
switch ( $_GET['action'] ) {
        case 'gpfp':
                $return ["path"] = array ( );
                $r = mysql_query ( "SELECT id,path,color,width FROM whiteboardtempdata WHERE id > " . intval ( $_GET['value'] ) ) or die(json_encode(array("error" => "Database query failed")));
                while ( $row = mysql_fetch_assoc ( $r ) ) {
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
                mysql_query ( "INSERT INTO whiteboardtempdata (ip,path,width,color) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','{$path}'," . intval($_GET['lw']) . ",'" . htmlspecialchars($_GET['color']) . "')" ) or die(json_encode(array("error" => "Database query failed: " . mysql_error())));
                $return ["ok"] = "Query OK";
                $return ["id"] = mysql_insert_id();
                $return ["orid"] = intval ( $_GET['orid'] );
                break;
        case 'cni':
                $r = mysql_query ( "SELECT id FROM whiteboardtempdata ORDER BY id DESC LIMIT 1" ) or die(json_encode(array("error" => "Database query failed: " . mysql_error())));
                $row = mysql_fetch_assoc ( $r );
                $return ["id"] = intval($row ["id"]);
                break;
 
        default :
                $return ["error"] = "No action given";
                break;
}

echo json_encode( $return );