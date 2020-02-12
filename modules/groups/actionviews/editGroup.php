<?php

$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('groups','id',$id,'groups/manageGroups/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('groups','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$grouptype_tag_placeholder = '';
$grouptype_tag='';
$entitytype_tag_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';
$parent_placeholder = '';
$pid_tag = '';


global $entitytype_tag,$pid_tag;
$entitytype_tag = '';


$columns = array('id','pid','batchid','grouptypetag','entitytypetag','name','description');
$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$pid_tag =  $sqlObj->getCleanData($resultset->pid);
$batchid =  $sqlObj->getCleanData($resultset->batchid);
$grouptype_tag_placeholder =  $sqlObj->getCleanData($resultset->grouptypetag);
$grouptype_tag=substr($grouptype_tag_placeholder,1);
$entitytype_tag =  $sqlObj->getCleanData($resultset->entitytypetag);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
}
}
}



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
($batchid == 0)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
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
($resultset->id == $batchid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
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


// Create Menu and Get Menu Data

$HTMLObj = new MainHTML();
global $htmlarray;
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

$entitytype_tag_placeholder = $HTMLObj->HTMLCreator($htmlarray);




$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'pid';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

function recursiveMenu2($menuid='',$level){
global $htmlarray,$pid_tag,$level;
$level++;
$columns = array('id','pid','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$conditions['AND =']['pid'] = $menuid;

$sqlObj = new MainSQL();
$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');

if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$str = '';
for($i=0;$i<=$level;$i++){
$str .= '-';
}
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $resultsetmenu->id;
($resultsetmenu->id == $pid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->name);
$htmlarray[]['option']['end'] = '';
if($resultsetmenu->id != $menuid){
recursiveMenu2($resultsetmenu->id,$level);
$level--;
}
}
}
}
}

recursiveMenu2(0,0);
$htmlarray[]['select']['end'] = '';
$parent_placeholder = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST) && isset($_POST['issubmit'])){
$grouptype_tag_placeholder = (isset($_POST['grouptypetag']))?$_POST['grouptypetag']:'';
$entitytype_tag_placeholder = (isset($_POST['entitytypetag']))?$_POST['entitytypetag']:'';
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
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
$("#editgroupform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('groups/saveGroup/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('groups/saveGroup/'.$id.'/');
}
?>
<form id="editgroupform" name="editgroupform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php  echo $lang['siya']['groups']['EDIT_GROUP'];?></legend>

	<ol>
		
		<li>
		<label for="batchid"><?php  echo $lang['siya']['groups']['BATCH'];?></label><?php echo $batchid_placeholder; ?>
	    </li>
		
		<li>
		<label for="grouptypetag"><?php  echo $lang['siya']['groups']['GROUP_TYPE_TAG'];?></label>
        <input name="group_tag" id="group_tag" type="text" value="+" size="1" maxlength="1" readonly="true" />
		<input id="grouptypetag" name="grouptypetag" type="text" placeholder="Enter Group Type Tag" value="<?php echo $grouptype_tag; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="entitytypetag"><?php  echo $lang['siya']['groups']['ENTITY_TYPE_TAG'];?></label><?php echo $entitytype_tag_placeholder; ?>
		</li>
		
		<li>
		<label for="parent"><?php  echo $lang['siya']['groups']['PARENT'];?></label><?php echo $parent_placeholder; ?>
		</li>


		<li>
		<label for="name"><?php echo $lang['siya']['groups']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['groups']['NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		

		<li>
		<label for="description"><?php echo $lang['siya']['groups']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['groups']['DESCRIPTION'];?>" rows="5" autofocus="" <?php echo _FORM_CLASS_NOT_REQUIRED;?>><?php echo $description_placeholder; ?></textarea>
		
		</li>

		</ol>

<fieldset>

<button type="submit"><?php echo $lang['siya']['groups']['SAVE'];?></button>

</fieldset>

</form>