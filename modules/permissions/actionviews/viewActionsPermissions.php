<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('permissions/saveActionsPermissions/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('permissions/saveActionsPermissions/');
}


if(isset($_GET['modulename'])){
$modulename = $_GET['modulename'];
}else{
$modulename = '';
}

?>

<?php

$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'modulename';
$htmlarray[]['select']['nonattribute'] = 'onChange="JavaScript:document.forms[\'moduleselect\'].submit();"';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','value');
$conditions = array();
$conditions['=']['name'] = 'module';
$conditions['AND =']['isactive'] = '1';
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, 'value', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->value);
($resultset->value == $modulename)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->value);
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$modules_placeholder = $HTMLObj->HTMLCreator($htmlarray);

?>



<form name="moduleselect" id="moduleselect" method="GET">

<fieldset>

<legend><?php echo $lang['siya']['permissions']['SELECT_MODULE']; ?></legend>


<ol>
	<li>
	<label for="day"><?php echo $lang['siya']['permissions']['MODULE']; ?> </label>
	<?php echo $modules_placeholder; ?>
	</li>
	</ol>
	</select>
</fieldset>

</form>

<?php
if($modulename !=''){
?>




<form id="savepermissions" name="savepermissions" method="post" action="<?php echo $formaction; ?>">


<table width="100%" border="0">
<tr>
<td>
<?php
$sqlObj = new MainSQL();
$usertypetagsarray = array();
$columns = array('usertypetag');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sql = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$usertypetagsarray[] = $resultset->usertypetag;
}
}
}

$systemallusertypes = implode(',',$usertypetagsarray);


$columns2 = array('id','value','description','iscore','isinstalled','isactive');
$conditions2 = array();
$conditions2['=']['name'] = 'module';
$conditions2['AND =']['value'] = $modulename;
$conditions2['AND =']['isactive'] = '1';
$sql2 = $sqlObj->SQLCreator('S', 'config', $columns2, $conditions2, '', '', '');
if($result2 = $sqlObj->FireSQL($sql2)){
if($sqlObj->getNumRows($result2)!=0){
while($resultset2 = $sqlObj->FetchResult($result2)){
?>

<br /><br /><h2><?php echo $resultset2->value; ?></h2><hr />


<table>
<tr>
<td>
<?php
$columns3 = array('id','actionname','usertypeaccess','usertypeaccessoverrides','templateaccess','otheruserstypeaccessoverrides','description','isactive');
$conditions3 = array();
$conditions3['=']['type'] = 'module';
$conditions3['AND =']['typename'] = $resultset2->value;
$sql3 = $sqlObj->SQLCreator('S', 'actionsconfig', $columns3, $conditions3, '', '', '');
if($result3 = $sqlObj->FireSQL($sql3)){
if($sqlObj->getNumRows($result3)!=0){
while($resultset3 = $sqlObj->FetchResult($result3)){
?>
<br /><br /><hr /><p><font color="FF002A"><b><i><?php echo $resultset3->actionname; ?></i></b></font></p><br />
<b>Original Permissions</b><br />

<?php 
$usertypeaccessarray = explode(',',$resultset3->usertypeaccess);
if($resultset3->usertypeaccessoverrides!=''){
$usertypeaccessoverridesarray = explode(',',$resultset3->usertypeaccessoverrides);
}else{
$usertypeaccessoverridesarray = $usertypeaccessarray;
}

foreach($usertypetagsarray as $key2 => $value2){
if(in_array($value2,$usertypeaccessarray) || in_array('*',$usertypeaccessarray)){
$checked_value = 'CHECKED';
}else{
$checked_value = '';
}

if($value2=='#admin'){
$readonly_value = 'disabled="disabled" checked="checked"';
}else{
$readonly_value = 'disabled="disabled"';
}

echo '<input type="checkbox" '.$checked_value.' '.$readonly_value.'/>'.$value2.' ';
}

echo '<br /><br /> <b><i>Permission Overrides (Over Original Permissions)</i></b> <br />';

foreach($usertypetagsarray as $key2 => $value2){
if(in_array($value2,$usertypeaccessoverridesarray) || in_array('*',$usertypeaccessoverridesarray)){
$checked_value = 'CHECKED';
}else{
$checked_value = '';
}

if($value2=='#admin'){
$readonly_value = 'disabled="disabled" checked="checked"';
}else{
$readonly_value = '';
}

echo '<input type="checkbox" name="siyaactionspermissions['.$resultset2->value.']['.$resultset3->actionname.']['.$value2.']" '.$checked_value.' '.$readonly_value.'/>'.$value2.' ';


}

?>
<br />
<?php



$usertypeaccessvalue = '';
$otheruserstypeaccessarray = array();
$otheruserstypeaccessvalue = array();

if($resultset3->otheruserstypeaccessoverrides != ''){
if(strstr($resultset3->otheruserstypeaccessoverrides, ';')){
$otheruserstypeaccessarray = explode(';',$resultset3->otheruserstypeaccessoverrides);
}
}else{
if(strstr(PROJ_DEFAULT_OTHERUSERS_PERMISSIONS, ';')){
$otheruserstypeaccessarray = explode(';',PROJ_DEFAULT_OTHERUSERS_PERMISSIONS);
}
}
//if($otheruserstypeaccessarray != ''){
foreach($otheruserstypeaccessarray as $key => $value){
if(strstr($value, '=')){
$otheruserstypeaccessarray3 = explode('=',$value);
$usertypeaccessvalue = $otheruserstypeaccessarray3[0];
if(strstr($otheruserstypeaccessarray3[1], ',')){
$otheruserstypeaccessarray3 = explode(',',$otheruserstypeaccessarray3[1]);
foreach($otheruserstypeaccessarray3 as $key3 => $value3){

$otheruserstypeaccessvalue[$usertypeaccessvalue][] = $value3;
}
}else{
$otheruserstypeaccessvalue[$usertypeaccessvalue][] = $otheruserstypeaccessarray3[1];

}
}
//}
}
?>

<br /><br /><hr /><p><font color="FF002A"><b><i><?php echo $resultset3->actionname; ?> - Users Permissions over Other Users Types (On Behalf of Other Users)</i></b></font></p><br />

<?php

foreach($usertypetagsarray as $key4 => $value4){

echo '<h3>'.$value4.'</h3>';
$readonly_value2 = '';

foreach($usertypetagsarray as $key5 => $value5){

if($value4 == $value5){
//$readonly_value2 = ' disabled="disabled"';
}else if($value5 == '#admin'){
//$readonly_value2 = ' disabled="disabled"';
}else{
$readonly_value2 = '';
}





if(!empty($otheruserstypeaccessvalue[$value4]) && in_array($value5,$otheruserstypeaccessvalue[$value4])){
$checked_value2 = ' CHECKED';
echo '<input type="checkbox" name="siyausertypeactionspermissions['.$resultset2->value.']['.$resultset3->actionname.']['.$value4.']['.$value5.']" '.$checked_value2.' '.$readonly_value2.'/>'.$value5.' ';
}else if(!empty($otheruserstypeaccessvalue[$value4]) && $otheruserstypeaccessvalue[$value4][0] == 'self' && $value4 == $value5){
$checked_value2 = ' CHECKED';
echo '<input type="checkbox" name="siyausertypeactionspermissions['.$resultset2->value.']['.$resultset3->actionname.']['.$value4.']['.$value5.']" '.$checked_value2.' '.$readonly_value2.'/>'.$value5.' ';
}else{
$checked_value2 = '';
echo '<input type="checkbox" name="siyausertypeactionspermissions['.$resultset2->value.']['.$resultset3->actionname.']['.$value4.']['.$value5.']" '.$checked_value2.' '.$readonly_value2.'/>'.$value5.' ';
}

}
}
?>

<br /> <br /><button type="submit">Save</button>

<?php
}
}
}
?>
<br /><br />

<input type="hidden" name="systemallusertypes" value="<?php echo $systemallusertypes; ?>">

<button type="submit">Save</button>


</td>
</tr>
</table>
<?php
}
}
}
?>

</td>
</tr>
</table>


</form>



<?php
}else{
?>
<br /><p><b>Please select the Module first</b></p>
<?php
}
?>