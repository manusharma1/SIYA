<!-- page specific scripts -->
<script type="text/javascript" charset="utf-8">
	$(function()
	{
		Date.format = 'mm/dd/yyyy';
		$('#newsdate').datePicker({autoFocusNextInput: true});
	});
</script>

<form id="addnewnews" name="addnewnews" method="post" action="<?php echo MainSystem::URLCreator('news/saveNews/') ?>" onsubmit="return JSMainFunction();">
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="17%" bgcolor="#CCCC66">News Title </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="newstitle" id="newstitle" size="95" title="News Title"/></td>
  </tr>

   <tr>
    <td bgcolor="#CCCC66">News Text </td>
    <td bgcolor="#CCCC66"><textarea name="newstext" id="newstext" cols="73" width="5" title="News Text"></textarea></td>
  </tr>

  <tr>
    <td width="17%" bgcolor="#CCCC66">News Date </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="newsdate" id="newsdate" class="date-pick">
</td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Add New News" /></td>
  </tr>

</table>
</form>

<?php
$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=newstitle,newstext,newsdate:onsubmit=addnewnews:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>