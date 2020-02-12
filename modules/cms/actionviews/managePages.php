<?php
	// Define placeholders

	$menu_name_placeholder = '';
	$page_name_placeholder = '';
	$edit_page_placeholder = '';
	$delete_page_placeholder = '';
	
	
	$html_coutput = '';
	$tr_bg_value = 0;

	$html_coutput .= '<table width="100%" border="0" bgcolor="#CC9933">
	<tr>
    <td width="10%" bgcolor="#CCCC66"><b>Page Name </b></td>
    <td width="10%" bgcolor="#CCCC66"><b>Parent Page Name </b></td>
    <td width="10%" bgcolor="#CCCC66"><b>Menu Name </b></td>
    <td width="5%" bgcolor="#CCCC66"><b>Edit </b></td>
    <td width="5%" bgcolor="#CCCC66"><b>Delete </b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','pid','menuid','name','title','data','metadesc','metakeys');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'content', $columns, '', 'id', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){
		
		$columns2 = array('name');
		$conditions2 = array();
		$conditions2['=']['id'] = $resultset->menuid;

		$sql2 = $sqlObj->SQLCreator('S', 'menu', $columns2, $conditions2, '', '', '');
		if($result2 = $sqlObj->FireSQL($sql2)){
		if($sqlObj->getNumRows($result2) !=0){ // If Row Exists
		if($resultset2 = $sqlObj->FetchResult($result2)){
		$menu_name_placeholder = $sqlObj->getCleanData($resultset2->name);
		}
		}else{
		$menu_name_placeholder = '';
		}
		}


		$columns2 = array('name');
		$conditions2 = array();
		$conditions2['=']['id'] = $resultset->pid;

		$sql2 = $sqlObj->SQLCreator('S', 'content', $columns2, $conditions2, '', '', '');
		if($result2 = $sqlObj->FireSQL($sql2)){
		if($sqlObj->getNumRows($result2) !=0){ // If Row Exists
		if($resultset2 = $sqlObj->FetchResult($result2)){
		$parent_page_name_placeholder = $sqlObj->getCleanData($resultset2->name);
		}
		}else{
		$parent_page_name_placeholder = '';
		}
		}
	
	
	$tr_bg_color = ($tr_bg_value==0)?'#FFFFAA':'#FFFF7F';
	$tr_bg_value = ($tr_bg_value==0)?1:0;

	$page_name_placeholder = ($resultset->name=='')?'':$resultset->name;
	$edit_page_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('cms/editPage/'.$resultset->id.'/');
	$delete_page_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('cms/deletePage/'.$resultset->id.'/');
	

	$html_coutput .= '<tr bgcolor="'.$tr_bg_color.'">
    <td>'.$page_name_placeholder.'</td>
    <td>'.$parent_page_name_placeholder.'</td>
    <td>'.$menu_name_placeholder.'</td>
    <td><a href="'.$edit_page_placeholder.'">Edit </a></td>
    <td><a href="'.$delete_page_placeholder.'">Delete </a></td>
	</tr>';
	} // while

	}else{ // if Doesn't Exists
	$_SESSION['message'] = 'No Record';
	}
	}else{
	trigger_error('SQL Error');
	}
	

	$html_coutput .= '</table>';

	echo $html_coutput;