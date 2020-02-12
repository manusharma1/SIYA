<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('forumtopics','id',$id,'forums/showForumTopic/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('forumtopics','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$title_placeholder = '';
$content_placeholder = '';


global $forumcatid_tag;
$forumcatid_tag = '';


$columns = array('id','forumcatid','title','content');
$sqlObj = new MainSQL();

$conditions = array();
$conditions['=']['id'] = $id;
$sql = $sqlObj->SQLCreator('S', 'forumtopics', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$forumcatid_tag =  $sqlObj->getCleanData($resultset->forumcatid);
$title_placeholder =  $sqlObj->getCleanData($resultset->title);
$content_placeholder =  $sqlObj->getCleanData($resultset->content);
}
}
}

// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray,$forumid_tag;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'forumcatid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','description','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'forumcategories', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $forumcatid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$forumcatid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST) && isset($_POST['issubmit'])){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$content_placeholder = (isset($_POST['content']))?$_POST['content']:'';
}
?>

<?php
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('forums/saveForumTopic/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('forums/saveForumTopic/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Forum Topic</legend>

	<ol>
		<li>
		<label for="forumcatid">Forum Category</label><?php echo $forumcatid_placeholder; ?>
			
	    </li>
		
		<li>
		<label for="title"><?php echo $lang['siya']['forums']['TITLE']; ?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['forums']['TITLE']; ?>" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="content"><?php echo $lang['siya']['forums']['CONTENT']; ?></label>
		<textarea id="content" name="content" placeholder="<?php echo $lang['siya']['forums']['CONTENT']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $content_placeholder; ?></textarea>
		
		</li>
		

	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>