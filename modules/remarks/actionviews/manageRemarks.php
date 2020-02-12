<?php
	
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	$previouslink = '';
	$nextlinkurl = '';
	$nextlink = '';
	$noofrecordstodisplayall = '';

	if(isset($_GET['orderby'])){
	$orderby = $_GET['orderby'];
	}else{
	$orderby = 'id';
	}

	if(isset($_GET['orderbytype'])){
	$orderbytype = $_GET['orderbytype'];
	}else{
	$orderbytype = 'ASC';
	}

	$orderbytype = ($orderbytype=='DESC')?'ASC':'DESC';

	$orderby .= ' '.$orderbytype;  
	
	if(isset($_GET['noofrecords'])){
	$noofrecordstodisplay = $_GET['noofrecords'];
	}else{
	$noofrecordstodisplay = PROJ_DEFAULT_NO_OF_ROWS;
	}


	if($noofrecordstodisplay == 'ALL'){
	$previouslink = '';
	$startlimit = '';
	$startlimit2 = '';
	$noofrecordstodisplay = '';
	$noofrecordstodisplayall = 'true';
	}else{
	if($id == '' || $id == 0){
	$previouslink = '';
	$startlimit = '0';
	$startlimit2 = $noofrecordstodisplay;
	}else{
	$previouslinkurl =	MainSystem::URLCreator('remarks/manageRemarks/'.($id-1).'/');
	$previouslink = '<a href="'.$previouslinkurl.'?noofrecords='.$noofrecordstodisplay.'">Prev</a>';
	$startlimit = $noofrecordstodisplay*($id);
	$startlimit2 = $noofrecordstodisplay*($id+1);
	}
	}

	if($noofrecordstodisplayall != 'true'){
	$columns = array('id');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'remarks', $columns, '', '', $startlimit2, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) > 0){
	$nextlinkurl =	MainSystem::URLCreator('remarks/manageRemarks/'.($id+1).'/');
	$nextlink = '<a href="'.$nextlinkurl.'?noofrecords='.$noofrecordstodisplay.'">Next</a>';
	}else{
	$nextlink = '';
	}
	}
	}


	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('remarks/remarksMultipleManage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('remarks/remarksMultipleManage/');
	}

	// Define placeholders

	$name_placeholder = '';
	$newstext_placeholder = '';
	$newsdate_placeholder = '';
	$edit_news_placeholder = '';
	$delete_news_placeholder = '';
		
	$html_output = '';
	$tr_bg_value = 0;

	$html_output .= MainSystem::CreateNoofRecordsDropDown($noofrecordstodisplay); 

	$returnarraymanageccess = MainSystem::CheckModuleActionAccess('admin','remarks','remarksMultipleManage');
	if($returnarraymanageccess['noerror'] == 1){
	
	$html_output .= '<form name="manage" method="post" id="manage" action="'.$formaction.'">
	<table id="listing">
	<tr>
    <td width="5%"><input type="checkbox" id="maincheckbox" name="maincheckbox" value="all" onclick="checkAll(\'manage\');" /></td>';
	}else{
	$html_output .= '
	<table id="listing">
	<tr>';	
	}

    $html_output .= '<td width="10%" ><a href="?orderby=messagetitle&orderbytype='.$orderbytype.'"><b>Message Title</b></a></td>
	<td width="10%" >Message</td>
	<td width="5%" >Status</td>
    <td width="5%" >Edit</td>
    <td width="5%" >Delete</td>
	</tr>';

	// Get Page Data
	$columns = array('id','messagetitle','message','isactive');
	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('S', 'remarks', $columns, '', $orderby, $startlimit, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){

	$messagetitle_placeholder = ($resultset->messagetitle=='')?'':$sqlObj->getCleanData($resultset->messagetitle);
	$message_placeholder = ($resultset->message=='')?'':$sqlObj->getCleanData($resultset->message);

	$status_placeholder = MainSystem::URLCreator('remarks/changeRemarkStatus/'.$resultset->id.'/');
	$status_text_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('remarks/editRemarks/'.$resultset->id.'/');
	$delete_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('remarks/deleteRemarks/'.$resultset->id.'/');

	$tr_bg_color = ($tr_bg_value==0)?'evenclass':'oddclass';
	$tr_bg_value = ($tr_bg_value==0)?1:0;
	
	$html_output .= '<tr class="'.$tr_bg_color.'">';
	if($returnarraymanageccess['noerror'] == 1 && MainSystem::CheckOtherUsersActionAccess('usertypes','addedby',$resultset->id)=='OK' && $resultset->iscore!=1){
	$html_output .= '<td width="5%"><input type="checkbox" id="checkbox_'.$resultset->id.'" name="checkbox['.$resultset->id.']" /></td>';
	}else{
	$html_output .= '<td width="5%"></td>';
	}
	
    $html_output .= '<td>'.$messagetitle_placeholder.'</td>
    <td>'.$message_placeholder.'</td>';
 	if(MainSystem::CheckOtherUsersActionAccess('remarks','addedby',$resultset->id)=='OK'){
	$html_output .= '<td><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></td>
    <td><a href="'.$edit_placeholder.'">'.$lang['siya']['remarks']['EDIT'] .' </a></td>
    <td><a href="'.$delete_placeholder.'">'.$lang['siya']['remarks']['DELETE'].' </a></td>';
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