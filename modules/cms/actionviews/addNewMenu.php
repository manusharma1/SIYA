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



<form id="addnewpage" name="addnewpage" method="post" action="<?php echo MainSystem::URLCreator('cms/saveMenu/') ?>">
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="17%" bgcolor="#CCCC66">Menu Name </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="name" size="95"/></td>
  </tr>

    <tr>
    <td width="17%" bgcolor="#CCCC66">Parent Menu </td>
    <td width="83%" bgcolor="#CCCC66"><?php echo $menu_placeholder; ?></td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Add New Menu" /></td>
  </tr>

</table>
</form>