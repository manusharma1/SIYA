<?php
	
	// Define placeholders

	$menu_name_placeholder = '';
	$menu_parent_placeholder = '';
	$edit_menu_placeholder = '';
	$delete_menu_placeholder = '';
	
	
	$html_coutput = '';
	$tr_bg_value = 0;

	$html_coutput .= '<table width="100%" border="0" bgcolor="#CC9933">
	<tr>
    <td width="10%" bgcolor="#CCCC66"><b>Menu Name </b></td>
    <td width="10%" bgcolor="#CCCC66"><b>Menu Parent Name </b></td>
    <td width="5%" bgcolor="#CCCC66"><b>Edit </b></td>
    <td width="5%" bgcolor="#CCCC66"><b>Delete </b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','pid','name','isactive');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'menu', $columns, '', '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){
		
		$columns2 = array('id','name');
		$conditions2 = array();
		$conditions2['=']['id'] = $resultset->pid;

		$sql2 = $sqlObj->SQLCreator('S', 'menu', $columns2, $conditions2, '', '', '');
		if($result2 = $sqlObj->FireSQL($sql2)){
		if($sqlObj->getNumRows($result2) !=0){ // If Row Exists
		if($resultset2 = $sqlObj->FetchResult($result2)){
		$menu_parent_placeholder = $sqlObj->getCleanData($resultset2->name);
		}
		}else{
		$menu_parent_placeholder = '';
		}
		}
	
	
	$tr_bg_color = ($tr_bg_value==0)?'#FFFFAA':'#FFFF7F';
	$tr_bg_value = ($tr_bg_value==0)?1:0;

	$menu_name_placeholder = ($resultset->name=='')?'':$resultset->name;
	$edit_menu_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('cms/editMenu/'.$resultset->id.'/');
	$delete_menu_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('cms/deleteMenu/'.$resultset->id.'/');
	

	$html_coutput .= '<tr bgcolor="'.$tr_bg_color.'">
    <td>'.$menu_name_placeholder.'</td>
    <td>'.$menu_parent_placeholder.'</td>
    <td><a href="'.$edit_menu_placeholder.'">Edit </a></td>
    <td><a href="'.$delete_menu_placeholder.'">Delete </a></td>
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
