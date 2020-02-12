<?php
	
	// Create Menu and Get Menu Data

	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'menuid';
	$htmlarray[]['select']['onChange'] = MainSystem::URLCreator('cms/getPagesByMenu/','ajax','get','getMenuID',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = 0;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	function recursiveMenu($menuid='',$level){
	global $htmlarray,$pagemenuid,$level;
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
	($resultsetmenu->id == $pagemenuid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
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

	$input_data_placeholder = MainSystem::HTMLEditorInit('data');
	
	$input_data2_placeholder = MainSystem::HTMLEditorInit('data2');

	$input_datamore_placeholder = MainSystem::HTMLEditorInit('datamore');
	
	$input_data2more_placeholder = MainSystem::HTMLEditorInit('data2more');
?>



<form id="addnewpage" name="addnewpage" method="post" action="<?php echo MainSystem::URLCreator('cms/savePage/') ?>" onsubmit="return JSMainFunction();">
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="17%" bgcolor="#CCCC66">Page Name </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="name" id="name" size="95"/></td>
  </tr>
  <tr>
    <td width="17%" bgcolor="#CCCC66">Page Title </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="title" id="title" size="95"/></td>
  </tr>

  <tr>
    <td bgcolor="#CCCC66">Menu</td>
    <td bgcolor="#CCCC66"><?php echo $menu_placeholder; ?></td>
  </tr>

  <tr>
    <td bgcolor="#CCCC66">Parent Page</td>
    <td bgcolor="#CCCC66"><div id="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>" name="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>"></div></td>
  </tr>

  <tr>
    <td bgcolor="#CCCC66">Page Content </td>
    <td bgcolor="#CCCC66"><?php  echo $input_data_placeholder; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCC66">Page Content (MORE OPTION)</td>
    <td bgcolor="#CCCC66"><?php  echo $input_datamore_placeholder; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCC66">Page Content 2 (if you type any content here then page will break into 2 divisions : Left and Right) </td>
    <td bgcolor="#CCCC66"><?php  echo $input_data2_placeholder; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCC66">Page Content 2 (MORE OPTION) </td>
    <td bgcolor="#CCCC66"><?php  echo $input_data2more_placeholder; ?></td>
  </tr>
   <tr>
    <td bgcolor="#CCCC66">Meta Keywords </td>
    <td bgcolor="#CCCC66"><textarea name="metakeys" cols="85" rows="5"></textarea></td>
  </tr>

   <tr>
    <td bgcolor="#CCCC66">Meta Description </td>
    <td bgcolor="#CCCC66"><textarea name="metadesc" cols="85" rows="5"></textarea></td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Add New Page" /></td>
  </tr>

</table>
</form>


<?php
unset($htmlarray);
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=name,title,menuid:onsubmit=addnewpage:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>