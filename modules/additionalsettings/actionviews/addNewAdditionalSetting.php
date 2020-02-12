<form id="addnewadditionalsetting" name="addnewadditionalsetting" method="post" action="<?php echo MainSystem::URLCreator('additionalsettings/saveAdditionalSettings/') ?>" onsubmit="return JSMainFunction();">
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="17%" bgcolor="#CCCC66">Additional Setting Name </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="additionalsettingname" id="additionalsettingname" size="95" title="Additional Setting Name"/></td>
  </tr>

   <tr>
    <td bgcolor="#CCCC66">Additional Setting Value </td>
    <td bgcolor="#CCCC66"><textarea name="additionalsettingvalue" id="additionalsettingvalue" cols="97" rows="20" title="Additional Setting Value"></textarea></td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Add New Additional Setting" /></td>
  </tr>

</table>
</form>

<?php
$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=additionalsettingname,additionalsettingvalue:onsubmit=addnewadditionalsetting:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>