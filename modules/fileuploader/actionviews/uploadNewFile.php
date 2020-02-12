<?php
	$HTMLObj = new MainHTML();
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'filelocationid';
	$htmlarray[]['select']['title'] = 'File Location';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';
	
	$filelocationarray = array(1=>'Image Slider Section',2=>'Picture Gallery Section',3=>'Video Section',4=>'Website Section');

	foreach($filelocationarray as $key => $value){

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $key;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $value;
	$htmlarray[]['option']['end'] = '';
	}

	$htmlarray[]['select']['end'] = '';

	$filelocation_menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);
?>

<form id="addnewfile" name="addnewfile" method="post" action="<?php echo MainSystem::URLCreator('fileuploader/saveFile/') ?>" enctype="multipart/form-data" onsubmit="return JSMainFunction();">
<table width="100%" border="0" bgcolor="#CC9933">
 
  <tr>
    <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['fileuploader']['FILE_LOCATION'];?></td>
    <td width="83%" bgcolor="#CCCC66"><?php echo $filelocation_menu_placeholder; ?></td>
  </tr>
  
  <tr>
    <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['fileuploader']['FILE_NAME'];?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="filename" id="filename" size="95" title="File Name"/></td>
  </tr>

   <tr>
    <td bgcolor="#CCCC66"><?php echo $lang['siya']['fileuploader']['FILE_DESCRIPTION'];?></td>
    <td bgcolor="#CCCC66"><textarea name="filedescription" id="filedescription" cols="73" width="5" title="File Description"></textarea></td>
  </tr>

  <tr>
    <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['fileuploader']['CHOOSE_FILE'];?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="file" name="chosenfile" id="chosenfile" title="Please Choose the File"/>
</td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Add New File" /></td>
  </tr>

</table>
</form>

<?php
$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=filelocationid,filename,filedescription,chosenfile:onsubmit=addnewfile:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>