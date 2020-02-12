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
	$previouslinkurl =	MainSystem::URLCreator('blogs/manageBlog/'.($id-1).'/');
	$previouslink = '<a href="'.$previouslinkurl.'?noofrecords='.$noofrecordstodisplay.'">Prev</a>';
	$startlimit = $noofrecordstodisplay*($id);
	$startlimit2 = $noofrecordstodisplay*($id+1);
	}
	}

	if($noofrecordstodisplayall != 'true'){
	$columns = array('id');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, '', '', $startlimit2, $noofrecordstodisplay);
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) > 0){
	$nextlinkurl =	MainSystem::URLCreator('blogs/manageBlog/'.($id+1).'/');
	$nextlink = '<a href="'.$nextlinkurl.'?noofrecords='.$noofrecordstodisplay.'">Next</a>';
	}else{
	$nextlink = '';
	}
	}
	}


	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('blogs/blogsMultipleManage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('blogs/blogsMultipleManage/');
	}	
	
	// Define placeholders

	$day_placeholder = '';
	$content_placeholder = '';
	$objective_placeholder = '';
	$edit_placeholder = '';
	$delete_placeholder = '';
	$status_placeholder = '';
	$status_text_placeholder = '';
	
	
	$html_output = '';
	$tr_bg_value = 0;
	$html_output .= MainSystem::CreateNoofRecordsDropDown($noofrecordstodisplay); 
	$returnarraymanageccess = MainSystem::CheckModuleActionAccess('admin','blogs','blogsMultipleManage');
	
	if($returnarraymanageccess['noerror'] == 1){
	
	$html_output .= '<form name="manage" method="post" id="manage" action="'.$formaction.'">
	<div id="listing">
	<ul>
    <li width="5%"><input type="checkbox" id="maincheckbox" name="maincheckbox" value="all" onclick="checkAll(\'manage\');" /></li>';
	}else{
	$html_output .= '
	<div id="listing">';
	}
	$html_output .= '<ul class="heading">
	<li>'.$lang['siya']['blogs']['TITLE'].'</li>
	<li>'.$lang['siya']['STATUS'].'</li>
    <li>'.$lang['siya']['EDIT'].'</li>
    <li>'.$lang['siya']['DELETE'].'</li>
  	</ul>';

	// Get Page Data
	$columns = array('id','title','data','isactive');
	$sqlObj = new MainSQL();
	$conditions = array();
	$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, '', '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){

	$title_placeholder = ($resultset->title=='')?'':$sqlObj->getCleanData($resultset->title);
	$data_placeholder = ($resultset->data=='')?'':$sqlObj->getCleanData($sqlObj->limit_words($resultset->data,10));
	$status_placeholder = MainSystem::URLCreator('blogs/changeBlogStatus/'.$resultset->id.'/');
	$status_text_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('blogs/editBlog/'.$resultset->id.'/');
	$delete_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('blogs/deleteBlog/'.$resultset->id.'/');

	$tr_bg_class = ($tr_bg_value==0)?'lightpink':'white';
	$tr_bg_value = ($tr_bg_value==0)?1:0;
	
	$html_output .= '<ul class="'.$tr_bg_class.'">';
	if($returnarraymanageccess['noerror'] == 1 && MainSystem::CheckOtherUsersActionAccess('usertypes','addedby',$resultset->id)=='OK' && $resultset->iscore!=1){
	$html_output .= '<td width="5%"><input type="checkbox" id="checkbox_'.$resultset->id.'" name="checkbox['.$resultset->id.']" /></td>';
	}else{
	$html_output .= '<td width="5%"></td>';
	}
  	$html_output .= '<li>'.$title_placeholder.'</li>';
 	if(MainSystem::CheckOtherUsersActionAccess('blogs','addedby',$resultset->id)=='OK'){
	$html_output .= '<li><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></li>
    <li><a href="'.$edit_placeholder.'">'.$lang['siya']['blogs']['EDIT'] .' </a></li>
    <li><a href="'.$delete_placeholder.'">'.$lang['siya']['blogs']['DELETE'].' </a></li>';
	}else{
	$html_output .= '<td><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></li>
    <li><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></li>
    <li><a href="JavaScript:alert(\''.$lang['siya']['YOU DO NOT HAVE PERMISSIONS TO ACCESS THE CONTENT'].'\')">--</a></li>';
	}

	$html_output .= '</ul>';
	} // while

	}else{ // if Doesn't Exists
	$html_output .= '<ul><li><h2>No Record</h2></li></ul>';
	}
	}else{
	trigger_error($lang['siya']['SQL_ERROR']);
	}
	$html_output .= '</div>';
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