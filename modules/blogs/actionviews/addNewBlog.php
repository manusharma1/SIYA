<?php
if(isset($_POST['userid'])){
$userid = $_POST['userid'];
}else{
$userid = MainSystem::GetSessionUserID();
}
$data_placeholder = '';
$title_placeholder = '';
$metadescription_placeholder = '';
$metakeywords_placeholder = '';

if(isset($_POST) && isset($_POST['issubmit'])){
$data_placeholder = (isset($_POST['data']))?$_POST['data']:'';
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$metadescription_placeholder = (isset($_POST['metadescription']))?$_POST['metadescription']:'';
$metakeywords_placeholder = (isset($_POST['metakeywords']))?$_POST['metakeywords']:'';
}

$data_placeholder = MainSystem::HTMLEditorInit('data'); 
$datamore_placeholder = MainSystem::HTMLEditorInit('datamore'); 
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
$("#addnewblocgform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('blogs/saveBlog/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('blogs/saveBlog/');
}
?>
<form id="addnewblocgform" name="addnewblocgform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['blogs']['ADD_BLOGS'];?></legend>

	<ol>
				
		<li>
		<label for="title"><?php echo $lang['siya']['blogs']['TITLE'];?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['blogs']['ENTER_TITLE'];?>"  autofocus="" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL;?>>
		</li>

		<li>
		<label for="type"><?php echo $lang['siya']['blogs']['TYPE'];?></label>
		<select name="type" id="type" <?php echo _FORM_FINAL;?> />
		<option value="">------</option>
		<option value="POST">Post</option>
		<option value="PAGE">Page</option>
		</select>
		</li>
		
		<li>
		<label for="visibility"><?php echo $lang['siya']['blogs']['VISIBILITY'];?></label>
		<select name="visibility" id="visibility" <?php echo _FORM_FINAL;?>/>
		<option value="">------</option>
		<option value="ALL">ALL</option>
		<option value="ALLGROUPS">ALLGROUPS</option>
		<option value="COMMONGROUPS">COMMONGROUPS</option>
		<option value="SELFGROUP">SELFGROUP</option>
		<option value="FRIENDS">FRIENDS</option>
		</select>
		</li>

		<li>
		<label for="data"><?php echo $lang['siya']['blogs']['DATA'];?></label><br />
		<?php echo $data_placeholder; ?>
		</li>

		<li>
		<label for="datamore"><?php echo $lang['siya']['blogs']['DATAMORE'];?></label><br />
		<?php echo $datamore_placeholder; ?>
		</li>

		<li>
		<label for="metadescription"><?php echo $lang['siya']['blogs']['META_DESCRIPTION'];?></label>
		<textarea id="metadescription" name="metadescription" type="text" placeholder="<?php echo $lang['siya']['blogs']['ENTER_META_DESCRIPTION'];?>" rows="5" autofocus="" <?php echo _FORM_CLASS;?>><?php echo $metadescription_placeholder; ?></textarea>
		</li>

		<li>
		<label for="metakeywords"><?php echo $lang['siya']['blogs']['META_KEYWORDS'];?></label>
		<textarea id="metakeywords" name="metakeywords" type="text" placeholder="<?php echo $lang['siya']['blogs']['ENTER_META_KEYWORD'];?>" rows="5"  autofocus=""  <?php echo _FORM_CLASS;?>><?php echo $metakeywords_placeholder; ?></textarea>
		</li>
		
		
		<input id="userid" name="userid" type="hidden" value="<?php echo $userid; ?>"/>
	    
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>