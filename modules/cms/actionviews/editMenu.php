<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	MainSystem::CheckIDExists('menu','id',$id,'cms/manageMenus/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('menu','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

	// Define PlaceHolders
	$menu_name_placeholder = '';
	$parent_menu_placeholder = '';

	// Get Menu Data
	$columns = array('id','pid','name');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlmenucontents = $sqlObj->SQLCreator('S', 'menu', $columns, $conditions, '', '', '');
	if($resultmenucontents = $sqlObj->FireSQL($sqlmenucontents)){
	if($sqlObj->getNumRows($resultmenucontents) !=0){ // If Menu Exists
	if($resultsetmenucontents = $sqlObj->FetchResult($resultmenucontents)){

	$menu_name_placeholder = $sqlObj->getCleanData($resultsetmenucontents->name);
	global $parentmenuid,$pageid;
	$parentmenuid = $resultsetmenucontents->pid;
	$pageid = $id;
	}else{
	trigger_error('Data Fetch Error');
	}
	}else{ // if Menu Doesn't Exists
	$_SESSION['message'] = $lang['siya']['cms']['MESSAGE'];
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/manageMenus/'));
	}
	}else{
	trigger_error('SQL Error');
	}
	
	// Create Parent Menu and Get Parent Menu Data

	$columns = array('id','name');
	$conditions = array();
	$conditions['=']['pid'] = 0;
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sqlmenu = $sqlObj->SQLCreator('S', 'menu', $columns, $conditions, '', '', '');
		
	// Create Menu and Get Menu Data

	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['name'] = 'pid';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = 0;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	function recursiveMenu($menuid='',$level){
	global $htmlarray,$parentmenuid,$level,$pageid;
	$level++;
	$columns = array('id','pid','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND =']['pid'] = $menuid;
	$conditions['AND !=']['id'] = $pageid;

	$sqlObj = new MainSQL();
	$sqlmenu = $sqlObj->SQLCreator('S', 'menu', $columns, $conditions, '', '', '');

	if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
	if($sqlObj->getNumRows($resultmenu)!=0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$str = '';
	for($i=0;$i<=$level;$i++){
	$str .= '-';
	}
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultsetmenu->id;
	($resultsetmenu->id == $parentmenuid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->name);
	$htmlarray[]['option']['end'] = '';
	if($resultsetmenu->id != $menuid){
	recursiveMenu($resultsetmenu->id,$level);
	$level--;
	}
	}
	}
	}
	}

	recursiveMenu(0,0);

	$htmlarray[]['select']['end'] = '';

	$parent_menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);


	if(isset($_POST) && isset($_POST['issubmit'])){
	$menu_name_placeholder = (isset($_POST['name']))?$_POST['name']:'';

	}

?>

	<script>
	$(document).ready(function(){
	$("#formeditmenu").validate();
	});
	</script>
	
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('cms/saveMenu/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('cms/saveMenu/'.$id.'/');
	}
	?>

	<form id="formeditmenu" name="formeditmenu" method="post" action="<?php echo $formaction; ?>">

	
	<fieldset>
	<legend><?php echo $lang['siya']['cms']['EDIT_MENU'];?></legend>	
	<ol>
		<li>
		<label for="name"><?php  echo $lang['siya']['cms']['MENU_NAME']; ?></label>
		<input type="text" name="name" size="30" value="<?php echo $menu_name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="parentmenu"><?php echo $lang['siya']['cms']['PARENT_MENU']; ?> </label>
		<?php echo $parent_menu_placeholder; ?>
		</li>

	</ol>

	<fieldset>

	<button type="submit"><?php echo $lang['siya']['cms']['SAVE'];?></button>

	</fieldset>

	</form>