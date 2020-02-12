<?php
$id = _ACTION_VIEW_PARAMETER_ID;//leaves/manageLeaves/

	MainSystem::CheckIDExists('leavetypes','id',$id,'leaves/manageLeavetype/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('leavetypes','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$entitytypetag_placeholder = '';
$title_placeholder = '';
$description_placeholder = '';
$leavetypetag_placeholder = '';


global $entitytype_tag;
$entitytype_tag = '';



$columns = array('id','leavetypetag','entitytypetag','title','description');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'leavetypes', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$leavetypetag_placeholder =  $sqlObj->getCleanData($resultset->leavetypetag);
$entitytype_tag =  $sqlObj->getCleanData($resultset->entitytypetag);
$title_placeholder =  $sqlObj->getCleanData($resultset->title);
$description_placeholder=  $sqlObj->getCleanData($resultset->description);
}
}
}



// Entity Type Tag //


$HTMLObj = new MainHTML();
global $htmlarray,$entitytype_tag;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'entitytypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

function recursiveMenu($pid='',$level){
global $htmlarray,$level,$entitytype_tag;
$level++;
$columns = array('e.id','e.entitytypetag','e.entityname');
$conditions = array();

$tables = array();
$tables['entities'] = 'e';
$tables['entitiesrelationship'] = 'er';

$conditions['=']['er.entitytype1'] = $pid;
$conditions['K AND =']['e.id'] = 'er.pid';
$conditions['AND =']['er.entityrelationtype'] = 'parent';


$sqlObj = new MainSQL();

$sqlmenu = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, 'e.id', '', '');
	
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$str = '';
for($i=0;$i<=$level;$i++){
$str .= '-';
}
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag);
($resultsetmenu->entitytypetag == $entitytype_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu->entityname).')';
$htmlarray[]['option']['end'] = '';
if($resultsetmenu->id != $pid){
recursiveMenu($resultsetmenu->id,$level);
$level--;
}
}
}
}
}

recursiveMenu(0,0);

$htmlarray[]['select']['end'] = '';

$entitytypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST) && isset($_POST['issubmit'])){
$leavetypetag_placeholder = (isset($_POST['leavetypetag']))?$_POST['leavetypetag']:'';
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
}
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
$("#editleavetypeform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('leaves/saveLeaveType/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('leaves/saveLeaveType/'.$id.'/');
}
?>
<form id="editleavetypeform" name="editleavetypeform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Leave Type</legend>

	<ol>

		<li>
		<label for="leavetypetag"><?php echo $lang['siya']['leaves']['LEAVE_TYPE_TAG']; ?></label>
		<input id="leavetypetag" name="leavetypetag" type="text" placeholder="<?php echo $lang['siya']['leaves']['LEAVE_TYPE_TAG']; ?>" value="<?php echo $leavetypetag_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="entitytypetag"><?php echo $lang['siya']['leaves']['ENTITY_TYPE_TAG']; ?></label><?php echo $entitytypetag_placeholder; ?> 
	    </li>
		
		<li>
		<label for="title"><?php echo $lang['siya']['leaves']['TITLE']; ?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['leaves']['TITLE']; ?>" required="" autofocus="" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['leaves']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['leaves']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" <?php echo _FORM_FINAL; ?>><?php echo $description_placeholder; ?></textarea>
		</li>
	
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>

<?php
/*$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=newstitle,newstext,newsdate:onsubmit=addnewnews:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;*/
?>