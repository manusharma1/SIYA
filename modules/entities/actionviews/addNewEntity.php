<?php
	// Create Menu and Get Menu Data

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
	global $htmlarray,$level;
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
	$htmlarray[]['option']['value'] = $resultsetmenu->id;
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

	$pid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

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
$("#addnewentity").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('entities/saveEntity/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('entities/saveEntity/');
}
?>
<form id="addnewentity" name="addnewentity" method="post" action="<?php echo $formaction; ?>">
<fieldset>

	<legend><?php echo $lang['siya']['entities']['ADD_NEW_ENTITY'];?></legend>

	<ol>
			
		<li>
		<label for="entityname"><?php echo $lang['siya']['entities']['ENTER_NAME']; ?></label>
		*
        <input name="entity_tag" type="text" value="@" size="1" maxlength="1" readonly="readonly" />
		<input type="text" name="entityname" id="entityname" placeholder="<?php echo $lang['siya']['entities']['ENTER_NAME']; ?>" 
		<?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="entitytypetag"><?php echo $lang['siya']['entities']['ENTITY_TAG']; ?></label>
		*
		<input type="text" name="entitytypetag" id="entitytypetag" placeholder="<?php echo $lang['siya']['entities']['ENTITY_TAG']; ?>"
		<?php echo _FORM_FINAL; ?> />
		</li>


		<li>
		<label for="entitydescription"><?php echo $lang['siya']['entities']['ENTITY_DESCRIPTION']; ?></label>
		<textarea name="entitydescription" id="entitydescription" title="Entity Description" placeholder="<?php echo $lang['siya']['entities']['ENTITY_DESCRIPTION']; ?>" <?php echo _FORM_CLASS; ?> ></textarea>
		</li>
 
		<li>*
		  <label class="label_radio" for="type"><?php echo $lang['siya']['entities']['ENTITY_RELATIONSHIP']; ?></label>
		<input name="type" id="type-01" value="parent" type="radio" <?php echo _FORM_FINAL; ?> /><?php echo $lang['siya']['entities']['PARENT_DEFAULT'] ?> <br />
		<input name="type" id="type-02" value="Group" type="radio" /> <?php echo $lang['siya']['entities']['GROUP'] ?><br />
		<input name="type" id="type-03" value="Linked" type="radio" /><?php echo $lang['siya']['entities']['LINKED'] ?>
		</li>
	

		<li>
		<label for="pid"><?php echo $lang['siya']['entities']['PARENT']; ?></label><?php echo $pid_placeholder; ?>
		</li>

	</ol>

	<fieldset>

	<button type="submit"><?php echo $lang['siya']['entities']['SAVE'] ?></button>

	</fieldset>

	</form>
