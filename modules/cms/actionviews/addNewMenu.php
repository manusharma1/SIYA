<?php
	$columns = array('id','name');
	$conditions = array();
	$conditions['=']['pid'] = 0;
	$conditions['AND =']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'menu', $columns, $conditions, '', '', '');
		
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

	function recursiveMenu($menuid='',$level){
	global $htmlarray,$level;
	$level++;
	$columns = array('id','pid','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND =']['pid'] = $menuid;

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

	$menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);

?>

	<script>
	$(document).ready(function(){
	$("#formaddmenu").validate();
	});
	</script>
	
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('cms/saveMenu/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('cms/saveMenu/');
	}
	?>

	<form id="formaddmenu" name="formaddmenu" method="post" action="<?php echo $formaction; ?>">

	<fieldset>
	<legend><?php echo $lang['siya']['cms']['ADD_NEW_MENU'];?></legend>	
	<ol>
		<li>
		<label for="menuname"><?php echo $lang['siya']['cms']['MENU_NAME']; ?> </label>
		<input type="text" name="name" size="30" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="parentmenuname"><?php echo $lang['siya']['cms']['PARENT_MENU'];?> </label>
		<?php echo $menu_placeholder; ?>

		</ol>

	<fieldset>

	<button type="submit"><?php echo $lang['siya']['cms']['SAVE'];?></button>

	</fieldset>

	</form>