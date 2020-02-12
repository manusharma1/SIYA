<?php
	
	// Define placeholders

	$file_name_placeholder = '';
	$file_location_placeholder = '';
	$file_description_placeholder = '';
	$edit_file_placeholder = '';
	$delete_file_placeholder = '';
	
	
	$html_coutput = '';
	$tr_bg_value = 0;

	$html_coutput .= '<table width="100%" border="0" bgcolor="#CC9933">
	<tr>
    <td width="10%" bgcolor="#CCCC66"><b>File Name <br />(As Saved on the System) </b></td>
	<td width="10%" bgcolor="#CCCC66"><b>File Description</b></td>
    <td width="10%" bgcolor="#CCCC66"><b>File Location</b></td>
    <td width="5%" bgcolor="#CCCC66"><b>Delete </b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','filename','filedescription','filelocationid','isactive');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'fileupload', $columns, '', '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){
		
	switch($resultset->filelocationid){
	case 1:
	$foldername = 'imageslider';
	break;

	case 2:
	$foldername = 'pictures';
	break;
	
	case 3:
	$foldername = 'videos';
	break;
	
	case 4:
	$foldername = 'website';
	break;
	}
	
	$tr_bg_color = ($tr_bg_value==0)?'#FFFFAA':'#FFFF7F';
	$tr_bg_value = ($tr_bg_value==0)?1:0;

	$file_name_placeholder = ($resultset->filename=='')?'':$resultset->filename;
	$file_description_placeholder = ($resultset->filedescription=='')?'':$resultset->filedescription;
	$file_location_placeholder = $foldername;
	$delete_file_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('fileuploader/deleteFile/'.$resultset->id.'/');
	

	$html_coutput .= '<tr bgcolor="'.$tr_bg_color.'">
    <td>'.$file_name_placeholder.'</td>
    <td>'.$file_description_placeholder.'</td>
    <td>'.$file_location_placeholder.'</td>
    <td><a href="'.$delete_file_placeholder.'">Delete </a></td>
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
