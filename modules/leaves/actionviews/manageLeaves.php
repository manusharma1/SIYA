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
	$previouslinkurl =	MainSystem::URLCreator('leaves/manageLeaves/'.($id-1).'/');
	$previouslink = '<a href="'.$previouslinkurl.'?noofrecords='.$noofrecordstodisplay.'">Prev</a>';
	$startlimit = $noofrecordstodisplay*($id);
	$startlimit2 = $noofrecordstodisplay*($id+1);
	}
	}

	if($noofrecordstodisplayall != 'true'){
	$columns = array('id');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'leaves', $columns, '', '', $startlimit2, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) > 0){
	$nextlinkurl =	MainSystem::URLCreator('leaves/manageLeaves/'.($id+1).'/');
	$nextlink = '<a href="'.$nextlinkurl.'?noofrecords='.$noofrecordstodisplay.'">Next</a>';
	}else{
	$nextlink = '';
	}
	}
	}


	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('leaves/leaveMultipleManage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('leaves/leaveMultipleManage/');
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

	$returnarraymanageccess = MainSystem::CheckModuleActionAccess('admin','leaves','leaveMultipleManage');
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

    $html_output .= '<td width="10%" ><b>Start - End Date</b></td>
	<td width="10%" ><b>User</b></td>
	<td width="10%" ><b>Application By</b></td>
	<td width="10%" ><b>Approved By</b></td>
	<td width="5%" ><b>Status</b></td>
    <td width="5%" ><b>Edit</b></td>
    <td width="5%" ><b>Delete</b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','startdate','enddate','userid','applicationby','approvedby','isactive');
	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('S', 'leaves', $columns, '', $orderby, $startlimit, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){

	$startdate_placeholder = ($resultset->startdate=='')?'':$sqlObj->getCleanData($resultset->startdate);
	$enddate_placeholder = ($resultset->enddate=='')?'':$sqlObj->getCleanData($resultset->enddate);
	
	$userid =  $sqlObj->getCleanData($resultset->userid);
	$applicationby =  $sqlObj->getCleanData($resultset->applicationby);
	$approvedby =  $sqlObj->getCleanData($resultset->approvedby);

	$user = MainSystem::getUserDetailsByID($userid);
	$userdetails = $user->fname.' '.$user->mname.' '.$user->lname;
	$usertype = '['.$user->usertypetag.' '.$user->entitytypetag.']';

	$addedbyuser = MainSystem::getUserDetailsByID($applicationby);
	$addedbyuserdetails = $addedbyuser->fname.' '.$addedbyuser->mname.' '.$addedbyuser->lname;
	$addedbyusertype = '['.$addedbyuser->usertypetag.' '.$addedbyuser->entitytypetag.']';

	if($approvedby != 0){
	$approvedbyuser = MainSystem::getUserDetailsByID($approvedby);
	$approvedbyuserdetails = $user->fname.' '.$user->mname.' '.$user->lname;
	$approvedbyusertype = '['.$user->usertypetag.' '.$user->entitytypetag.']';
	}else{
	$approvedbyuserdetails = 'Not Approved';
	$approvedbyusertype = '<a href="'.MainSystem::URLCreator('leaves/approveLeave/'.$resultset->id.'/').'"><b>Approve this Leave</b></a>';
	}

	$status_placeholder = MainSystem::URLCreator('leaves/changeLeaveStatus/'.$resultset->id.'/');
	$status_text_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('leaves/editLeave/'.$resultset->id.'/');
	$delete_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('leaves/deleteLeave/'.$resultset->id.'/');

	$tr_bg_color = ($tr_bg_value==0)?'evenclass':'oddclass';
	$tr_bg_value = ($tr_bg_value==0)?1:0;
	
	$html_output .= '<tr class="'.$tr_bg_color.'">';
	if($returnarraymanageccess['noerror'] == 1 && MainSystem::CheckOtherUsersActionAccess('usertypes','addedby',$resultset->id)=='OK' && $resultset->iscore!=1){
	$html_output .= '<td width="5%"><input type="checkbox" id="checkbox_'.$resultset->id.'" name="checkbox['.$resultset->id.']" /></td>';
	}else{
	$html_output .= '<td width="5%"></td>';
	}

	$html_output .= '<td>'.$startdate_placeholder.'-'.$enddate_placeholder.'</td>
    <td>'.$userdetails.'<br />'.$usertype.'</td>
	<td>'.$addedbyuserdetails.'<br />'.$addedbyusertype.'</td>
	<td>'.$approvedbyuserdetails.'<br />'.$approvedbyusertype.'</td>';
 	if(MainSystem::CheckOtherUsersActionAccess('leaves','addedby',$resultset->id)=='OK'){
	
	$html_output .= '<td><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></td>
    <td><a href="'.$edit_placeholder.'">'.$lang['siya']['leaves']['EDIT'] .' </a></td>
    <td><a href="'.$delete_placeholder.'">'.$lang['siya']['leaves']['DELETE'].' </a></td>';
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