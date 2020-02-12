<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('blogs','id',$id,'blogs/manageBlog/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('blogs','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$data = '';
$datamore = '';
$title_placeholder = '';
$type_placeholder = '';
$metadescription_placeholder = '';
$metakeywords_placeholder = '';



$columns = array('id','userid','type','title','data','datamore','visibility','metadescription','metakeywords');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$userid = $sqlObj->getCleanData($resultset->userid);
$type_placeholder =  $sqlObj->getCleanData($resultset->type);
$title_placeholder =  $sqlObj->getCleanData($resultset->title);
$data =  $sqlObj->getCleanData($resultset->data);
$datamore =  $sqlObj->getCleanData($resultset->datamore);
$visibility_placeholder =  $sqlObj->getCleanData($resultset->visibility);
$metadescription_placeholder =  $sqlObj->getCleanData($resultset->metadescription);
$metakeywords_placeholder =  $sqlObj->getCleanData($resultset->metakeywords);
}
}
}


if(isset($_POST) && isset($_POST['issubmit'])){
$data = (isset($_POST['data']))?$_POST['data']:'';
$datamore = (isset($_POST['datamore']))?$_POST['datamore']:'';
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$type_placeholder = (isset($_POST['type']))?$_POST['type']:'';
$visibility_placeholder = (isset($_POST['visibility']))?$_POST['visibility']:'';
$metadescription_placeholder = (isset($_POST['metadescription']))?$_POST['metadescription']:'';
$metakeywords_placeholder = (isset($_POST['metakeywords']))?$_POST['metakeywords']:'';
}

$data = MainSystem::HTMLEditorInit('data',$data); 
$datamore = MainSystem::HTMLEditorInit('datamore',$datamore); 

?>

<?php
if(PROJ_RUN_AJAX==1){
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
}
?>

<script>
$(document).ready(function(){
$("#editblogform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('blogs/saveBlog/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('blogs/saveBlog/'.$id.'/');
}
?>
<form id="editblogform" name="editblogform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['blogs']['EDIT_BLOG'];?></legend>

	<ol>
		
		<li>
		<label for="title"><?php echo $lang['siya']['blogs']['TITLE'];?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['blogs']['ENTER_TITLE'];?>" required="" autofocus="" value="<?php echo $title_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required">
		</li>

		<li>
		<label for="type"><?php echo $lang['siya']['blogs']['TYPE'];?></label>
		<select name="type" id="type" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="POST" <?php  echo ($type_placeholder=='POST')?'SELECTED':''; ?>>Post</option>
		<option value="PAGE" <?php  echo ($type_placeholder=='PAGE')?'SELECTED':''; ?>>Page</option>
		</select>
		</li>
		
		<li>
		<label for="visibility"><?php echo $lang['siya']['blogs']['VISIBILITY'];?></label>
		<select name="visibility" id="visibility" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="ALL" <?php  echo ($visibility_placeholder=='ALL')?'SELECTED':''; ?>>ALL</option>
		<option value="ALLGROUPS" <?php  echo ($visibility_placeholder=='ALLGROUPS')?'SELECTED':''; ?>>ALLGROUPS</option>
		<option value="COMMONGROUPS" <?php  echo ($visibility_placeholder=='COMMONGROUPS')?'SELECTED':''; ?>>COMMONGROUPS</option>
		<option value="SELFGROUP" <?php  echo ($visibility_placeholder=='SELFGROUP')?'SELECTED':''; ?>>SELFGROUP</option>
		<option value="FRIENDS" <?php  echo ($visibility_placeholder=='FRIENDS')?'SELECTED':''; ?>>FRIENDS</option>
		</select>
		</li>

		<li>
		<label for="data"><?php echo $lang['siya']['blogs']['DATA'];?></label><br />
		<?php echo $data; ?>
		</li>

		
		<li>
		<label for="datamore"><?php echo $lang['siya']['blogs']['DATAMORE'];?></label><br />
		<?php echo $datamore; ?>
		</li>


		<li>
		<label for="metadescription"><?php echo $lang['siya']['blogs']['META_DESCRIPTION'];?></label>
		<textarea id="metadescription" name="metadescription" type="text" placeholder="<?php echo $lang['siya']['blogs']['ENTER_META_DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $metadescription_placeholder; ?></textarea>
		</li>

		<li>
		<label for="metakeywords"><?php echo $lang['siya']['blogs']['META_KEYWORDS'];?></label>
		<textarea id="metakeywords" name="metakeywords" type="text" placeholder="<?php echo $lang['siya']['blogs']['ENTER_META_KEYWORD'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $metakeywords_placeholder; ?></textarea>
		</li>

		<input id="userid" name="userid" type="hidden" value="<?php echo $userid; ?>"/>
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>