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
	$previouslinkurl =	MainSystem::URLCreator('cms/managePages/'.($id-1).'/');
	$previouslink = '<a href="'.$previouslinkurl.'?noofrecords='.$noofrecordstodisplay.'">Prev</a>';
	$startlimit = $noofrecordstodisplay*($id);
	$startlimit2 = $noofrecordstodisplay*($id+1);
	}
	}

	if($noofrecordstodisplayall != 'true'){
	$columns = array('id');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'content', $columns, '', '', $startlimit2, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) > 0){
	$nextlinkurl =	MainSystem::URLCreator('cms/managePages/'.($id+1).'/');
	$nextlink = '<a href="'.$nextlinkurl.'?noofrecords='.$noofrecordstodisplay.'">Next</a>';
	}else{
	$nextlink = '';
	}
	}
	}


	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('cms/pagesMultipleManage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('cms/pagesMultipleManage/');
	}


	// Define placeholders

	$menu_name_placeholder = '';
	$page_name_placeholder = '';
	$edit_page_placeholder = '';
	$delete_page_placeholder = '';
	
	
	$html_output = '';
	$tr_bg_value = 0;

	$html_output .= MainSystem::CreateNoofRecordsDropDown($noofrecordstodisplay); 



	$returnarraymanageccess = MainSystem::CheckModuleActionAccess('admin','cms','pagesMultipleManage');
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

	$html_output .= '<td width="10%" ><a href="?orderby=name&orderbytype='.$orderbytype.'"><b>'.$lang['siya']['cms']['PAGE_NAME'] .'</b></a></td>
    <td width="10%"><b>'.$lang['siya']['cms']['PARENT_PAGE'].'</b></td>
    <td width="10%"><b>'.$lang['siya']['cms']['MENU_NAME'].'</b></td>
	<td width="10%"><b>'.$lang['siya']['cms']['ISCORE'].'</b></td>
	<td width="10%"><b>'.$lang['siya']['cms']['STATUS'].'</b></td>
    <td width="5%" ><b>'.$lang['siya']['cms']['EDIT'].' </b></td>
    <td width="5%" ><b>'.$lang['siya']['cms']['DELETE'].'</b></td>
	</tr>';

	// Get Page Data
	$columns = array('id','pid','menuid','name','title','isactive','iscore');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'content', $columns, '', $orderby, $startlimit, $noofrecordstodisplay);
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

		$sql2 = $sqlObj->SQLCreator('S', 'content', $columns2, $conditions2, 'id', '', ''); // Consider Self Join //
		if($result2 = $sqlObj->FireSQL($sql2)){
		if($sqlObj->getNumRows($result2) !=0){ // If Row Exists
		if($resultset2 = $sqlObj->FetchResult($result2)){
		$parent_page_name_placeholder = $sqlObj->getCleanData($resultset2->name);
		}
		}else{
		$parent_page_name_placeholder = '';
		}
		}


	$status_text_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$tr_bg_color = ($tr_bg_value==0)?'evenclass':'oddclass';
	$tr_bg_value = ($tr_bg_value==0)?1:0;

	$page_name_placeholder = ($resultset->name=='')?'':$resultset->name;

	$edit_placeholder = MainSystem::URLCreator('cms/editPage/'.$resultset->id.'/');
	$delete_placeholder = ($resultset->id=='')?'#':($resultset->iscore==1)?'#':MainSystem::URLCreator('cms/deletePage/'.$resultset->id.'/');
	$status_placeholder = ($resultset->id=='')?'#':($resultset->iscore==1)?'#':MainSystem::URLCreator('cms/changePageStatus/'.$resultset->id.'/');

	$iscore_placeholder = ($resultset->iscore==1)?'Yes':'No';


	$html_output .= '<tr class="'.$tr_bg_color.'">';
	if($returnarraymanageccess['noerror'] == 1 && MainSystem::CheckOtherUsersActionAccess('usertypes','addedby',$resultset->id)=='OK' && $resultset->iscore!=1){
	$html_output .= '<td width="5%"><input type="checkbox" id="checkbox_'.$resultset->id.'" name="checkbox['.$resultset->id.']" /></td>';
	}else{
	$html_output .= '<td width="5%"></td>';
	}

	$html_output .= '<td>'.$page_name_placeholder.'</td>
    <td>'.$parent_page_name_placeholder.'</td>
    <td>'.$menu_name_placeholder.'</td>
	<td>'.$iscore_placeholder.'</td>';

	
	
	if(MainSystem::CheckOtherUsersActionAccess('content','addedby',$resultset->id)=='OK'){
	$html_output .= '<td><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></td>
    <td><a href="'.$edit_placeholder.'">'.$lang['siya']['cms']['EDIT'] .' </a></td>
    <td><a href="'.$delete_placeholder.'">'.$lang['siya']['cms']['DELETE'].' </a></td>';
	}else{
	$html_output .= '<td><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></td>
    <td><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></td>
    <td><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></td>';
	}

	$html_output .= '</tr>';
	} // while

	}else{ // if Doesn't Exists
	$_SESSION['message'] = $lang['siya']['cms']['NO_RECORD'] ;
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
	<input type="image" src ="'._TEMPLATE_IMG_DIR._WS.'siya_delete_large.png" name="Delete" value="Delete" /> <input type="image" src ="'._TEMPLATE_IMG_DIR._WS.'siya_inactive_large.png" name="Inactive" value="Inactive" /> <input type="image" src ="'._TEMPLATE_IMG_DIR._WS.'siya_active_large.png" name="Active" value="Active" />
	</fieldset>
	<br />

	</form>';
	}

	echo $html_output;