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
	$previouslinkurl =	MainSystem::URLCreator('users/manageStaff/'.($id-1).'/');
	$previouslink = '<a href="'.$previouslinkurl.'?noofrecords='.$noofrecordstodisplay.'">Prev</a>';
	$startlimit = $noofrecordstodisplay*($id);
	$startlimit2 = $noofrecordstodisplay*($id+1);
	}
	}

	if($noofrecordstodisplayall != 'true'){
	$columns = array('id');
	$sqlObj = new MainSQL();
	$conditions = array();
	$conditions['=']['entitytypetag'] = '@staff';
	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', $startlimit2, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) > 0){
	$nextlinkurl =	MainSystem::URLCreator('users/manageStaff/'.($id+1).'/');
	$nextlink = '<a href="'.$nextlinkurl.'?noofrecords='.$noofrecordstodisplay.'">Next</a>';
	}else{
	$nextlink = '';
	}
	}
	}


	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('users/staffMultipleManage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('users/staffMultipleManage/');
	}	
	// Define placeholders

	$newstitle_placeholder = '';
	$newstext_placeholder = '';
	$newsdate_placeholder = '';
	$edit_news_placeholder = '';
	$delete__placeholder = '';
	
	
	$html_output = '';
	$tr_bg_value = 0;
	
	$html_output .= MainSystem::CreateNoofRecordsDropDown($noofrecordstodisplay); 

	$returnarraymanageccess = MainSystem::CheckModuleActionAccess('admin','users','staffMultipleManage');
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

    $html_output .= '<td width="10%"><a href="?orderby=fname&orderbytype='.$orderbytype.'"><b>Name</b> <img src="'._TEMPLATE_IMG_DIR._WS.'siya_orderby.png" alt="Order By Name" title="Order By Name" /></a></td>
    <td width="10%"><b>User Type Tag</b></td>
	<td width="10%"><b>Status </b></td>
    <td width="5%"><b>Edit </b></td>
    <td width="5%"><b>Delete </b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','fname','mname','lname','usertypetag','isactive');
	$sqlObj = new MainSQL();
	$conditions = array();
	$conditions['=']['entitytypetag'] = '@staff';

	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, $orderby, $startlimit, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){

	$fname_placeholder = ($resultset->fname=='')?'':$sqlObj->getCleanData($resultset->fname);
	$mname_placeholder = ($resultset->mname=='')?'':$sqlObj->getCleanData($resultset->mname);
	$lname_placeholder = ($resultset->lname=='')?'':$sqlObj->getCleanData($resultset->lname);
	$usertypetag_placeholder = ($resultset->usertypetag=='')?'':$sqlObj->getCleanData($resultset->usertypetag);

	$status_placeholder = MainSystem::URLCreator('users/changeStaffStatus/'.$resultset->id.'/');
	$status_text_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('users/editStaffRegistration/'.$resultset->id.'/');
	$delete_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('users/deleteStaffRegistration/'.$resultset->id.'/');
	
	$tr_bg_color = ($tr_bg_value==0)?'evenclass':'oddclass';
	$tr_bg_value = ($tr_bg_value==0)?1:0;
	
	$html_output .= '<tr class="'.$tr_bg_color.'">';
	if($returnarraymanageccess['noerror'] == 1 && MainSystem::CheckOtherUsersActionAccess('usertypes','addedby',$resultset->id)=='OK' && $resultset->iscore!=1){
	$html_output .= '<td width="5%"><input type="checkbox" id="checkbox_'.$resultset->id.'" name="checkbox['.$resultset->id.']" /></td>';
	}else{
	$html_output .= '<td width="5%"></td>';
	}
    $html_output .= '<td>'.$fname_placeholder.' '.$mname_placeholder.' '.$lname_placeholder.'</td>
    <td>'.$usertypetag_placeholder.'</td>';
 	if(MainSystem::CheckOtherUsersActionAccess('users','addedby',$resultset->id)=='OK'){
	$html_output .= '<td><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></td>
    <td><a href="'.$edit_placeholder.'">'.$lang['siya']['users']['EDIT'] .' </a></td>
    <td><a href="'.$delete_placeholder.'">'.$lang['siya']['users']['DELETE'].' </a></td>';
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