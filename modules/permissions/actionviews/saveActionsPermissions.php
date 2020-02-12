<?php
echo '<pre>';

$sqlObj = new MainSQL();


foreach($_POST['siyausertypeactionspermissions'] as $key => $value){
$otheruserstypeaccessoverridesstring = '';


$module = $key;

foreach($value as $key2 => $value2){
$otheruserstypeaccessoverridesstring = '';
$action = $key2;

foreach($value2 as $key3 => $value3){
$otherusertypestring = '';
$usertype = $key3;

foreach($value3 as $key4 => $value4){
$otherusertype = $key4;

$otherusertypestring .= $otherusertype.',';

}

$otherusertypestring = substr($otherusertypestring,0,-1);
$otheruserstypeaccessoverridesstring .= $usertype.'='.$otherusertypestring.';';

}
$otheruserstypeaccessoverridesstring = substr($otheruserstypeaccessoverridesstring,0,-1);

$data2 = array();
$data2['otheruserstypeaccessoverrides'] = $otheruserstypeaccessoverridesstring;



// Conditions in case of Edit //
$conditions2 = array();
$conditions2['=']['type'] = 'module';
$conditions2['AND =']['typename'] = $module;
$conditions2['AND =']['actionname'] = $action;

$sql2 = $sqlObj->SQLCreator('U', 'actionsconfig', $data2, $conditions2, '', '', '');

if($result2 = $sqlObj->FireSQL($sql2)){
//$_SESSION['message'] = 'Permissions Saved';
//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
//MainSystem::URLForwarder(MainSystem::URLCreator('cms/addNewMenu/'.$returnid.'/'));
}else{
//$_SESSION['message'] = 'Permissions cannot be Saved';
//MainSystem::URLForwarder(MainSystem::URLCreator('cms/addNewMenu/'));
}


}
}


foreach($_POST['siyaactionspermissions'] as $key => $value){

$module = $key;

foreach($value as $key2 => $value2){
$usertypes = '';

$action = $key2;

foreach($value2 as $key3 => $value3){

$usertypes .= $key3.',';

}

$usertypes = substr($usertypes,0,-1);
$allusertypes = '#admin,'.$usertypes;
$systemallusertypes = $_POST['systemallusertypes'];

if($allusertypes == $systemallusertypes){
$typeaccess = '*';
}else{
$typeaccess = $allusertypes;
}

$data = array();
$data['usertypeaccessoverrides'] = $typeaccess;

// Conditions in case of Edit //
$conditions = array();
$conditions['=']['type'] = 'module';
$conditions['AND =']['typename'] = $module;
$conditions['AND =']['actionname'] = $action;
//$conditions['AND !=']['usertypeaccess'] = $typeaccess;


$sql = $sqlObj->SQLCreator('U', 'actionsconfig', $data, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
//$_SESSION['message'] = 'Permissions Saved';
//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
//MainSystem::URLForwarder(MainSystem::URLCreator('cms/addNewMenu/'.$returnid.'/'));
}else{
//$_SESSION['message'] = 'Permissions cannot be Saved';
//MainSystem::URLForwarder(MainSystem::URLCreator('cms/addNewMenu/'));
}



}




}






?>