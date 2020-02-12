<?php
$id = _ACTION_VIEW_PARAMETER_ID;

$name_placeholder = '';
$description_placeholder = '';


global $groupid_tag ,$batchid_tag,$subjectid_tag,$topicid_tag;
$batchid_tag = '';
$groupid_tag = '';
$subjectid_tag = '';
$topicid_tag = '';


$columns = array('id','groupid','batchid','subjectid','topicid','name','description');
$sqlObj = new MainSQL();

$conditions = array();
$conditions['=']['id'] = $id;
$sql = $sqlObj->SQLCreator('S', 'whiteboard', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$groupid_tag =  $sqlObj->getCleanData($resultset->groupid);
$batchid_tag =  $sqlObj->getCleanData($resultset->batchid);
$subjectid_tag =  $sqlObj->getCleanData($resultset->subjectid);
$topicid_tag =  $sqlObj->getCleanData($resultset->topicid);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
}
}
}


// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag,$subjectid_tag,$topicid_tag;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'groupid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','grouptypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $groupid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$groupid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


//Batch ID
$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'batchid';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = 'All Batches';
$htmlarray[]['option']['end'] = '';

$columns = array('id','batchcode','title');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
($resultset->id == $batchid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
$htmlarray[]['option']['end'] = '';

}
}
}else{
trigger_error('Data Fetch Error');
}

$htmlarray[]['select']['end'] = '';
$batchid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

// Subject ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'subjectid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','subjectcode','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $subjectid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->subjectcode).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$subjectid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

// Topic ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'topicid';
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
$sqlmenu = $sqlObj->SQLCreator('S', 'topics', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $topicid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$topicid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST) && isset($_POST['issubmit'])){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
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
$formaction = MainSystem::URLCreator('whiteboard/saveWhiteBoard/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('whiteboard/saveWhiteBoard/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit White Board</legend>

	<ol>
		<li>
		<label for="groupid">Group </label><?php echo $groupid_placeholder; ?>			
	    </li>
		
		<li>
		<label for="batchid">Batch</label> <?php echo $batchid_placeholder; ?>	
	    </li>

		<li>
		<label for="topicid">Topic </label><?php echo $topicid_placeholder; ?>		
	    </li>

		<li>
		<label for="subjectid">Subject</label><?php echo $subjectid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="name"><?php echo $lang['siya']['whiteboard']['NAME']; ?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['whiteboard']['NAME']; ?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['whiteboard']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['whiteboard']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>