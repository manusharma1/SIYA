<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('topiccontentsuploads','id',$id,'admin/getAdminHome/');
	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('topiccontentsuploads','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$title_placeholder = '';
$description_placeholder = '';
$topicid='';
$input_data_placeholder = '';
$contenttype='';
$upload_placeholder='';
$topicname_placeholder='';
$show_upload_file =1;

if(isset($_POST['return'])){
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
}

if(isset($_POST['add'])){
$contenttype = (isset($_POST['contenttype']))?$_POST['contenttype']:'';

if($contenttype=='DOC'){
$text = 'Document File';
$show_upload_file = 1;
}else if($contenttype=='VIDEO'){
$text = 'Video File';
$show_upload_file = 1;
}else if($contenttype=='FLASH'){
$text = 'Flash (Animation) File';
$show_upload_file = 1;
}else if($contenttype=='HTML'){
$text = 'HTML Content';
$show_upload_file = 0;
}else if($contenttype=='LINK'){
$text = 'Link';
$show_upload_file = 0;
}

}

$columns = array('tcu.id=tcuid','tcu.title','tcu.description','tcu.topicid=topicid','t.name','tcu.contenttype');
$conditions = array();

$tables = array();
$tables['topiccontentsuploads']  = 'tcu';
$tables['topics']		= 't';
$conditions['=']['tcu.id'] = $id;
$conditions['K AND =']['t.id'] = 'tcu.topicid';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset= $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->tcuid);
$topicid = $sqlObj->getCleanData($resultset->topicid);	
$topicname_placeholder = $sqlObj->getCleanData($resultset->name);	
$title_placeholder = $sqlObj->getCleanData($resultset->title);
$description_placeholder = $sqlObj->getCleanData($resultset->description);
$contenttype = $sqlObj->getCleanData($resultset->contenttype);

}
}
}

if(isset($_POST) && isset($_POST['issubmit'])){

$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$description_placeholder =(isset($_POST['description']))?$_POST['description']:'';

}

?>
<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('topiccontents/saveTopicContents/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('topiccontents/saveTopicContents/'.$id.'/');
}
$input_data_placeholder = MainSystem::HTMLEditorInit('data');
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend><?php echo $lang['siya']['topiccontents']['EDIT_TOPIC'];?></legend>

	<ol><li>
		<label for="topicid"><?php echo $lang['siya']['TOPIC'];?></label><?php echo MainSystem::getTopicInfobyID($topicid)->name; ?>
	    </li>
		
		<li>
		<label for="title"><?php echo $lang['siya']['topiccontents']['TITLE'];?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['topiccontents']['TITLE'];?>" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>


		<li>
		<label for="description"><?php echo $lang['siya']['topiccontents']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['topiccontents']['DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>
		</ol>
		<?php
		if($contenttype=='HTML' || $contenttype=='LINK'){
		?>
		<li>
		<label for="description">HTML Editor</label><br />
		<?php echo $input_data_placeholder; ?>
		</li>
		<?php
		}
		?>
		
		<?php
		if($show_upload_file == 1){
		?>
		<li>
		<label for="chosenfile">Choose File to Upload</label>
		<input id="chosenfile" name="chosenfile" type="file"/>
		</li>
		<?php
		}
		?>
		<fieldset>

		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="topicid" value="<?php echo $topicid; ?>">
		<input type="hidden" name="contenttype" value="<?php echo $contenttype; ?>">
		<button type="submit">Save</button>

		</fieldset>

		</form>