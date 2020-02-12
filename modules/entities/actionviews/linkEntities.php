<?php
	// Create Menu and Get Menu Data

	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	
	function createMenu($menuid=''){
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = $menuid;
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = 0;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';
	recursiveMenu(0,0);
	$htmlarray[]['select']['end'] = '';
	}

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
	
	createMenu('entitytype1');
	$menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);
	createMenu('entitytype2');
	$menu2_placeholder = $HTMLObj->HTMLCreator($htmlarray);

?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('entities/saveLinkEntities/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('entities/saveLinkEntities/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">
<fieldset>

	<legend><?php echo $lang['siya']['entities']['LINK_ENTITIES'];?></legend>

	<ol>
			
		<li>
		<label for="entity1"><?php echo $lang['siya']['entities']['ENTITY_1'];?></label><?php echo $menu_placeholder; ?>
		</li>

		<li>
		<label for="entity2"><?php echo $lang['siya']['entities']['ENTITY_2'];?></label><?php echo $menu2_placeholder; ?>
		</li>

		<li>
		<label for="entityrelationtype"><?php echo $lang['siya']['entities']['ENTITY_RELATIONSHIP'];?></label><br/>
		<input type="radio" name="entityrelationtype" value="group" /><?PHP ECHO $lang['siya']['entities']['GROUP'] ;?><br/>
		<input type="radio" name="entityrelationtype" value="linked" /><?php echo $lang['siya']['entities']['LINKED'] ?>
		</li>
	</ol>

	<fieldset>

	<button type="submit"><?php echo $lang['siya']['entities']['ADD_LINK_ENTITY'];?></button>

	</fieldset>

	</form>
