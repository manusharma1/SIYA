<?php
	
	// Define placeholders

	$newstitle_placeholder = '';
	$newstext_placeholder = '';
	$newsdate_placeholder = '';
	$edit_news_placeholder = '';
	$delete_news_placeholder = '';
	
	
	$html_output = '';
	$tr_bg_value = 0;

	$html_output .= '<table width="100%" border="0" bgcolor="#CC9933">
	<tr>
    <td width="10%" bgcolor="#CCCC66"><b>News Title</b></td>
	<td width="10%" bgcolor="#CCCC66"><b>News Text</b></td>
    <td width="10%" bgcolor="#CCCC66"><b>News Date</b></td>
    <td width="10%" bgcolor="#CCCC66"><b>Status</b></td>
    <td width="10%" bgcolor="#CCCC66"><b>Edit</b></td>
    <td width="5%" bgcolor="#CCCC66"><b>Delete </b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','newstitle','newstext','newsdate','isactive');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'news', $columns, '', '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){
		
	$tr_bg_color = ($tr_bg_value==0)?'#FFFFAA':'#FFFF7F';
	$tr_bg_value = ($tr_bg_value==0)?1:0;

	$newstitle_placeholder = ($resultset->newstitle=='')?'':$resultset->newstitle;
	$newstext_placeholder = ($resultset->newstext=='')?'':$resultset->newstext;
	$newsdate_placeholder = ($resultset->newsdate=='')?'':$resultset->newsdate;
	$id = $resultset->id;
	$newsisactive_link_placeholder = ($resultset->isactive==0)?MainSystem::URLCreator('news/changeNewsStatus/'.$id.'/'):MainSystem::URLCreator('news/changeNewsStatus/'.$id.'/');
	$newsisactive_text_placeholder = $newsisactive_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_news_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('news/editNews/'.$resultset->id.'/');
	$delete_news_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('news/deleteNews/'.$resultset->id.'/');
	
	$html_output .= '<tr bgcolor="'.$tr_bg_color.'">';
	if($returnarraymanageccess['noerror'] == 1){
	$html_output .= '<td width="5%" ><input type="checkbox" id="checkbox_'.$resultset->id.'" name="checkbox['.$resultset->id.']" /></td>';
	}
    $html_output .= '<td>'.$newstitle_placeholder.'</td>
    <td>'.$newstext_placeholder.'</td>
    <td>'.$newsdate_placeholder.'</td>';
 	if(MainSystem::CheckOtherUsersActionAccess('news','addedby',$resultset->id)=='OK'){
	$html_output .= '<td><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></td>
    <td><a href="'.$edit_news_placeholder.'">'.$lang['siya']['news']['EDIT'] .' </a></td>
    <td><a href="'.$delete_news_placeholder.'">'.$lang['siya']['news']['DELETE'].' </a></td>';
	}else{
	$html_output .= '<td><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></td>
    <td><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></td>
    <td><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></td>';
	}

	$html_output .= '</tr>';
	} // while

	}else{ // if Doesn't Exists
	$_SESSION['message'] = 'No Record';
	}
	}else{
	trigger_error('SQL Error');
	}
	$html_output .= '</table>';
	if($returnarraymanageccess['noerror'] == 1){

	$html_output .=  $previouslink.' '.$nextlink.'<input type="hidden" name="IsSubmit" value="1" />
	<br /><hr />
	<p>With Selected : </p>
	<fieldset>
	<input type="image" src ="'._TEMPLATE_IMG_DIR._WS.'siya_delete_large.png" name="Delete" value="Delete" /> 
	<input type="image" src ="'._TEMPLATE_IMG_DIR._WS.'siya_inactive_large.png" name="Inactive" value="Inactive" /> 
	<input type="image" src ="'._TEMPLATE_IMG_DIR._WS.'siya_active_large.png" name="Active" value="Active" />
	</fieldset>
	<br />

	</form>';
	}

	echo $html_output;