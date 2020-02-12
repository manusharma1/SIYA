<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	// Define PlaceHolders
	$additionalsettingname_placeholder = '';
	$additionalsettingvalue_placeholder = '';

	// Get News Data
	$columns = array('id','name','value','isactive');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'additionalsettings', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If News Exists
	if($resultset = $sqlObj->FetchResult($result)){
	
	$additionalsettingname_placeholder = $sqlObj->getCleanData($resultset->name);
	$additionalsettingvalue_placeholder = $sqlObj->getCleanData($resultset->value);

	}else{
	trigger_error('Data Fetch Error');
	}
	}else{ // if Page Doesn't Exists
	$_SESSION['message'] = 'Additional Settings Does Not Exists';
	MainSystem::URLForwarder(MainSystem::URLCreator('admin/getAdminHome/'));
	}
	}else{
	trigger_error('SQL Error');
	}
?>


<!-- page specific scripts -->
<script type="text/javascript" charset="utf-8">
	$(function()
	{
		Date.format = 'mm/dd/yyyy';
		$('#newsdate').datePicker({autoFocusNextInput: true});
	});
</script>

<form id="editadditionalsetting" name="editadditionalsetting" method="post" action="<?php echo MainSystem::URLCreator('additionalsettings/saveAdditionalSettings/'.$id.'/') ?>" onsubmit="return JSMainFunction();">
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="17%" bgcolor="#CCCC66">Additional Setting Name </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="additionalsettingname" id="additionalsettingname" size="95" value="<?php echo $additionalsettingname_placeholder; ?>" title="Additional Setting Name"/></td>
  </tr>

   <tr>
    <td bgcolor="#CCCC66">Additional Setting Value </td>
    <td bgcolor="#CCCC66"><textarea name="additionalsettingvalue" id="additionalsettingvalue" cols="97" rows="20" title="Additional Setting Value"><?php echo $additionalsettingvalue_placeholder; ?></textarea></td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Edit Additional Setting" /></td>
  </tr>

</table>
</form>

<?php
$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=additionalsettingname,additionalsettingvalue:onsubmit=editadditionalsetting:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>