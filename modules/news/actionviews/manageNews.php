<?php
	
	// Define placeholders

	$newstitle_placeholder = '';
	$newstext_placeholder = '';
	$newsdate_placeholder = '';
	$edit_news_placeholder = '';
	$delete_news_placeholder = '';
	
	
	$html_coutput = '';
	$tr_bg_value = 0;

	$html_coutput .= '<table width="100%" border="0" bgcolor="#CC9933">
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
	
	$html_coutput .= '<tr bgcolor="'.$tr_bg_color.'">
    <td>'.$newstitle_placeholder.'</td>
    <td>'.$newstext_placeholder.'</td>
    <td>'.$newsdate_placeholder.'</td>
	<td><a href="'.$newsisactive_link_placeholder.'">'.$newsisactive_text_placeholder.'</a></td>
    <td><a href="'.$edit_news_placeholder.'">Edit </a></td>
    <td><a href="'.$delete_news_placeholder.'">Delete </a></td>
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
