<?php

	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
	
	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////
	
	$id = (isset($parameters[0]))?$parameters[0]:'';
	$groupid = (isset($_POST['groupid']))?$_POST['groupid']:'';
	MainSystem::CheckGroupPermissions($groupid,'group');


$title_placeholder = '';
$description_placeholder = '';

$show_upload_file = 0;

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


if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('topiccontents/saveTopicContent/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('topiccontents/saveTopicContent/');
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

	<legend><?php echo $lang['siya']['topiccontents']['ADD_TOPIC']; ?></legend>

	<ol>
		
		<li>
		<label for="title"><?php echo $lang['siya']['topiccontents']['TITLE'];?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['topiccontents']['TITLE'];?>" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>


		<li>
		<label for="description"><?php echo $lang['siya']['topiccontents']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['topiccontents']['DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>
			
				
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
		<input id="chosenfile" name="chosenfile" type="file" placeholder="Choose File to Upload" <?php echo _FORM_FINAL; ?> />
		</li>
		<?php
		}
		?>

		</ol>

		<fieldset>

		<input type="hidden" name="topicid" value="<?php echo $id; ?>">
		<input type="hidden" name="contenttype" value="<?php echo $contenttype; ?>">

		<button type="submit">Save</button>

		</fieldset>

		</form>