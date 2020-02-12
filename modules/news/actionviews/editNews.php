<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	MainSystem::CheckIDExists('news','id',$id,'news/manageNews/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('news','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	
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
	if($sqlObj->getNumRows($resultnewscontents) !=0){ 
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


<script>
	$(function() {
		$( "#newsdate" ).datepicker();
	});
</script>
<?php
if(PROJ_RUN_AJAX==1){
	if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	}
}
?>

<script>
$(document).ready(function(){
$("#editnewsform").validate();
});
</script>
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('news/saveNews/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('news/saveNews/'.$id.'/');
	}
	?>

	<form id="editnewsform" name="editnewsform" method="post" action="<?php echo $formaction; ?>">


<fieldset>
	<legend>Edit News</legend>	
		
		<ol>
		<li>
		<label for="newstitle"><?php echo $lang['siya']['news']['NEWS_TITLE']; ?></label>
		<input type="text" name="newstitle" id="newstitle" size="30" title="<?php echo $lang['siya']['news']['NEWS_TITLE']; ?>" value="<?php echo $newstitle_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>

		<li>
		<label for="newstext"><?php echo $lang['siya']['news']['NEWS_TEXT']; ?></label>
		<textarea name="newstext" id="newstext" cols="73" width="5" title="<?php echo $lang['siya']['news']['NEWS_TEXT']; ?>" <?php echo _FORM_FINAL; ?>><?php echo $newstext_placeholder; ?></textarea>
		</li>
		
		<li>
		<label for="newstext"><?php echo $lang['siya']['news']['NEWS_DATE']; ?></label>
		<input type="text" name="newsdate" id="newsdate" title="<?php echo $lang['siya']['news']['NEWS_DATE']; ?>" value="<?php echo $newsdate_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>