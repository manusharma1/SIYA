<?php
	
	// Define placeholders

	$additionalsettingname_placeholder = '';
	$additionalsettingvalue_placeholder = '';
	$additionalsettingstatus_placeholder = '';
	$edit_additionalsetting_placeholder = '';
	$delete_additionalsetting_placeholder = '';
	
	
	$html_coutput = '';
	$tr_bg_value = 0;

	$html_coutput .= '<table width="100%" border="0" bgcolor="#CC9933">
	<tr>
    <td width="10%" bgcolor="#CCCC66"><b>Additional Settings Name</b></td>
	<td width="10%" bgcolor="#CCCC66"><b>Additional Settings Value</b></td>
    <td width="10%" bgcolor="#CCCC66"><b>Status</b></td>
    <td width="10%" bgcolor="#CCCC66"><b>Edit</b></td>
    <td width="5%" bgcolor="#CCCC66"><b>Delete </b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','name','value','isactive');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'additionalsettings', $columns, '', '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){
		
	$tr_bg_color = ($tr_bg_value==0)?'#FFFFAA':'#FFFF7F';
	$tr_bg_value = ($tr_bg_value==0)?1:0;

	$additionalsettingname_placeholder = ($resultset->name=='')?'':$resultset->name;
	$additionalsettingvalue_placeholder = ($resultset->value=='')?'':$resultset->value;
	$id = $resultset->id;
	$additionalsettingisactive_link_placeholder = ($resultset->isactive==0)?MainSystem::URLCreator('additionalsettings/changeAdditionalSettingsStatus/'.$id.'/'):MainSystem::URLCreator('additionalsettings/changeAdditionalSettingsStatus/'.$id.'/');
	$additionalsettingisactive_text_placeholder = $additionalsettingisactive_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_additionalsetting_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('additionalsettings/editAdditionalSetting/'.$resultset->id.'/');
	$delete_additionalsetting_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('additionalsettings/deleteAdditionalSetting/'.$resultset->id.'/');
	
	$html_coutput .= '<tr bgcolor="'.$tr_bg_color.'">
    <td>'.$additionalsettingname_placeholder.'</td>
    <td>'.$additionalsettingvalue_placeholder.'</td>
	<td><a href="'.$additionalsettingisactive_link_placeholder.'">'.$additionalsettingisactive_text_placeholder.'</a></td>
    <td><a href="'.$edit_additionalsetting_placeholder.'">Edit </a></td>
    <td><a href="'.$delete_additionalsetting_placeholder.'">Delete </a></td>
	</tr>';
	} // while

	}else{ // if Doesn't Exists
	$html_coutput .= '<tr>
    <td colspan="5" align="center"><h2>No Record</h2></td></tr>';
	}
	}else{
	trigger_error('SQL Error');
	}
	

	$html_coutput .= '</table>';

	echo $html_coutput;
