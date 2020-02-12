<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	// Define PlaceHolders
	$page_name_placeholder = '';
	$page_title_placeholder = '';
	$menu_placeholder = '';
	$input_data_placeholder = '';
	$input_data2_placeholder = '';
	$input_datamore_placeholder = '';
	$input_data2more_placeholder = '';
	$meta_keys_placeholder = '';
	$meta_desc_placeholder = '';


	// Get Page Data
	$columns = array('id','pid','menuid','name','title','data','datamore','data2','data2more','metadesc','metakeys');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	
	$page_name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name);
	$page_title_placeholder = $sqlObj->getCleanData($resultsetpagecontents->title);
	$meta_keys_placeholder = $sqlObj->getCleanData($resultsetpagecontents->metakeys);
	$meta_desc_placeholder = $sqlObj->getCleanData($resultsetpagecontents->metadesc);
	global $pagemenuid,$parentpageid,$pageid;
	$pageid = $id;
	$pagemenuid = $resultsetpagecontents->menuid;
	$parentpageid = $resultsetpagecontents->pid;
	}else{
	trigger_error('Data Fetch Error');
	}
	}else{ // if Page Doesn't Exists
	$_SESSION['message'] = 'Page Does Not Exists';
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/getAdminArea/'));
	}
	}else{
	trigger_error('SQL Error');
	}
	
	// Create Menu and Get Menu Data

	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'menuid';
	$htmlarray[]['select']['onChange'] = MainSystem::URLCreator('cms/getPagesByMenu/'.$id.'/','ajax','get','getMenuID',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
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


	// Create Page Menu and Get Page Menu Data

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

	function recursivePageMenu($menuid='',$pagelevel){
	global $htmlarray,$parentpageid,$pagelevel,$pagemenuid,$pageid;
	$pagelevel++;
	$columns = array('id','pid','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND =']['menuid'] = $pagemenuid;
	$conditions['AND =']['pid'] = $menuid;
	$conditions['AND !=']['id'] = $pageid;


	$sqlObj = new MainSQL();
	$sqlmenu = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');

	if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
	if($sqlObj->getNumRows($resultmenu)!=0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$str = '';
	for($i=0;$i<=$pagelevel;$i++){
	$str .= '----';
	}
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultsetmenu->id;
	($resultsetmenu->id == $parentpageid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->name);
	$htmlarray[]['option']['end'] = '';
	if($resultsetmenu->id != $menuid){
	recursivePageMenu($resultsetmenu->id,$pagelevel);
	$pagelevel--;
	}
	}
	}
	}
	}

	recursivePageMenu(0,0);

	$htmlarray[]['select']['end'] = '';
	$parent_page_placeholder = $HTMLObj->HTMLCreator($htmlarray);

	$input_data_placeholder = MainSystem::HTMLEditorInit('data',$sqlObj->getCleanData($resultsetpagecontents->data));

	$input_datamore_placeholder = MainSystem::HTMLEditorInit('datamore',$sqlObj->getCleanData($resultsetpagecontents->datamore));

	$input_data2_placeholder = MainSystem::HTMLEditorInit('data2',$sqlObj->getCleanData($resultsetpagecontents->data2));
	
	$input_data2more_placeholder = MainSystem::HTMLEditorInit('data2more',$sqlObj->getCleanData($resultsetpagecontents->data2more));
?>



<form id="editpage" name="editpage" method="post" action="<?php echo MainSystem::URLCreator('cms/savePage/'.$id.'/') ?>">
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="17%" bgcolor="#CCCC66">SEO URL </td>
    <td width="83%" bgcolor="#CCCC66"><?php echo MainSystem::URLCreator('cms/getContent/'.$id.'/');?></td>
  </tr>  
  
  <tr>
    <td width="17%" bgcolor="#CCCC66">Page Name </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="name" size="95" value="<?php echo $page_name_placeholder; ?>" /></td>
  </tr>
  <tr>
    <td width="17%" bgcolor="#CCCC66">Page Title </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="title" size="95" value="<?php echo $page_title_placeholder; ?>" /></td>
  </tr>

  <tr>
    <td bgcolor="#CCCC66">Menu </td>
    <td bgcolor="#CCCC66"><?php echo $menu_placeholder; ?></td>
  </tr>

  <tr>
    <td bgcolor="#CCCC66">Parent Page </td>
    <td bgcolor="#CCCC66"><div id="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>" name="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>"><?php echo $parent_page_placeholder; ?></div></td>
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
    <td bgcolor="#CCCC66"><textarea name="metakeys" cols="85" rows="5"><?php echo $meta_keys_placeholder; ?></textarea></td>
  </tr>

   <tr>
    <td bgcolor="#CCCC66">Meta Description </td>
    <td bgcolor="#CCCC66"><textarea name="metadesc" cols="85" rows="5"><?php echo $meta_desc_placeholder; ?></textarea></td>
  </tr>

  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Save Page" /></td>
  </tr>

</table>
</form>