<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	// Define PlaceHolders
	$newstitle_placeholder = '';
	$newstext_placeholder = '';
	$newsdate_placeholder = '';

	// Get News Data
	$columns = array('id','newstitle','newstext','newsdate');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'news', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ // If News Exists
	if($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	
	$newstitle_placeholder = $sqlObj->getCleanData($resultsetnewscontents->newstitle);
	$newstext_placeholder = $sqlObj->getCleanData($resultsetnewscontents->newstext);
	$newsdate_array = explode('-', $sqlObj->getCleanData($resultsetnewscontents->newsdate));
	$newsdate_placeholder = $newsdate_array[1].'/'.$newsdate_array[2].'/'.$newsdate_array[0];
	}else{
	trigger_error('Data Fetch Error');
	}
	}else{ // if Page Doesn't Exists
	$_SESSION['message'] = 'News Does Not Exists';
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

<form id="editnews" name="editnews" method="post" action="<?php echo MainSystem::URLCreator('news/saveNews/'.$id.'/') ?>">
<table width="100%" border="0" bgcolor="#CC9933">
  
  <tr>
    <td width="17%" bgcolor="#CCCC66">News Title </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="newstitle" id="newstitle" size="95" title="News Title" value="<?php echo $newstitle_placeholder; ?>" /></td>
  </tr>
   <tr>
    <td bgcolor="#CCCC66">News Text </td>
    <td bgcolor="#CCCC66"><textarea  name="newstext" id="newstext" cols="73" width="5" title="News Text"><?php echo $newstext_placeholder; ?></textarea></td>
  </tr>

  <tr>
    <td width="17%" bgcolor="#CCCC66">News Date </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="newsdate" id="newsdate" class="date-pick" value="<?php echo $newsdate_placeholder; ?>" /></td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Save Page" /></td>
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