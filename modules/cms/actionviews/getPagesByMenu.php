<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
	global $id,$pagemenuid;
	
	if(isset($parameters[0])){
	$id = $parameters[0];
	}else{
	$id='';
	}

	if(isset($parameters[1])){
	$pagemenuid = $parameters[1];
	}else{
	$pagemenuid = '';
	}

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
	global $htmlarray,$parentpageid,$pagelevel,$pagemenuid,$id;
	$pagelevel++;
	$columns = array('id','pid','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND =']['menuid'] = $pagemenuid;
	$conditions['AND =']['pid'] = $menuid;
	if($id !=''){
	$conditions['AND !=']['id'] = $id;
	}
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


	echo $parent_page_placeholder; 
	
	?>