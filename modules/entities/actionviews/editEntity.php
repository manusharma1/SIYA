<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	
	MainSystem::CheckIDExists('entities','id',$id,'entities/manageEntities/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('entities','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	
	$name_placeholder ='';
	$description_placeholder = '';
	$entity_relation_type = '';
	$selected_parent_id =  '';
	$entity_tag_placeholder = '';
	$tag_placeholder=''; 
	
	global $selected_parent_id;
	
	$columns = array('er2.entitytype1','er2.entityrelationtype','e.entitytypetag','e.entityname','e.entitydescription');
	$conditions = array();

	$tables = array();
	$tables['entitiesrelationship'] = 'er1,er2'; // FOR SELF JOIN PASS THE VALUES OF ALIAS COMMA SEPERATED //
	$tables['entities'] = 'e'; // Joining 3rd Table for fetching Entity Data

	$conditions['=']['er1.entitytype2'] = $id;
	$conditions['K AND =']['e.id'] = 'er1.pid';
	$conditions['K AND =']['er1.entitytype2'] = 'er2.pid';
	$conditions['AND =']['er1.entityrelationtype'] = 'parent';


	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
		
	if($result = $sqlObj->FireSQL($sql)){
	if($resultset = $sqlObj->FetchResult($result)){
	
	$name_placeholder = $resultset->entityname;
	$description_placeholder = $resultset->entitydescription;
	$entity_relation_type = $resultset->entityrelationtype;
	$selected_parent_id =  $resultset->entitytype1;
	$entity_tag_placeholder = $resultset->entitytypetag;
	$tag_placeholder=substr($entity_tag_placeholder,1); //using substr function to remove '@' from string
	}
	}


	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'pid';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = 0;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	function recursiveMenu($pid='',$level){
	global $htmlarray,$level,$selected_parent_id;
	$level++;
	$columns = array('e.id','e.entitytypetag','e.entityname','er.entitytype1');
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
	$htmlarray[]['option']['value'] = $resultsetmenu->id;
	($resultsetmenu->id == $selected_parent_id)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->entityname);
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

	$parentid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST) && isset($_POST['issubmit'])){
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
$("#editentityform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('entities/saveEntity/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('entities/saveEntity/'.$id.'/');
}
?>
<form id="editentityform" name="editentityform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['entities']['EDIT_ENTITY'] ;?></legend>

	<ol>
		<li> 
		<label for="name"><?php echo $lang['siya']['entities']['ENTER_NAME']; ?></label>
		<input type="text" name="entityname" id="entityname" size="50" title="Entity Name" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>
		<li> 
		<label for="entitytypetag"><?php echo $lang['siya']['entities']['ENTITY_TAG']; ?></label>
        <input id="entity_tag" name="entity_tag" value="@" size="1" readonly="readonly"/>
		<input type="text" name="entitytypetag" id="entitytypetag" size="30" value="<?php echo $tag_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>
 
		<li> 
		<label for="entitydescription"><?php echo $lang['siya']['entities']['ENTITY_DESCRIPTION']; ?> </label>
		<textarea name="entitydescription" id="entitydescription" cols="60" rows="10" <?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>
		
		<li> 
		<label for="entityrelationtype"><?php echo $lang['siya']['entities']['ENTITY_RELATIONSHIP']; ?></label><br/>
		<input type="radio" name="entityrelationtype" value="parent" <?php echo ($entity_relation_type=='parent')?'CHECKED':''; ?> required="" autofocus="" <?php echo _FORM_FINAL; ?>/> <?php echo$lang['siya']['entities']['PARENT_DEFAULT'];?><br/>
		<input type="radio" name="entityrelationtype" value="group" <?php echo ($entity_relation_type=='group')?'CHECKED':''; ?>/><?php echo $lang['siya']['entities']['GROUP'];?><br/>
		<input type="radio" name="entityrelationtype" value="linked" <?php echo ($entity_relation_type=='linked')?'CHECKED':''; ?>/> <?php echo $lang['siya']['entities']['LINKED'];?>
		</li>
	
		<li> 
		<label for="pid"><?php echo $lang['siya']['entities']['PARENT'];?></label><?php echo $parentid_placeholder; ?></label>
		</li>
	</ol>

	<fieldset>

	<button type="submit"><?php echo $lang['siya']['entities']['SAVE'] ;?></button>

	</fieldset>

	</form>
