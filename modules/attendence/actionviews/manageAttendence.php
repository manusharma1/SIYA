<?php
	
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

	$html_output .= '<div id="listing"><ul class="heading">
	<li>'.$lang['siya']['blogs']['TITLE'].'</li>
	<li>'.$lang['siya']['blogs']['DATA'].'</li>
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
	$data_placeholder = ($resultset->data=='')?'':$sqlObj->getCleanData($resultset->data);
	$status_placeholder = MainSystem::URLCreator('blogs/changeBlogStatus/'.$resultset->id.'/');
	$status_text_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('blogs/editBlog/'.$resultset->id.'/');
	$delete_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('blogs/deleteBlog/'.$resultset->id.'/');

	$tr_bg_class = ($tr_bg_value==0)?'lightpink':'white';
	$tr_bg_value = ($tr_bg_value==0)?1:0;
	
	$html_output .= '<ul class="'.$tr_bg_class.'">
  	<li>'.$title_placeholder.'</li>
    <li>'.$data_placeholder.'</li>
 	<li><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></li>
    <li><a href="'.$edit_placeholder.'">'.$lang['siya']['EDIT'].' </a></li>
    <li><a href="'.$delete_placeholder.'">'.$lang['siya']['DELETE'].' </a></li>
	</ul>';
	} // while

	}else{ // if Doesn't Exists
	$html_output .= '<ul><li><h2>No Record</h2></li></ul>';
	}
	}else{
	trigger_error($lang['siya']['SQL_ERROR']);
	}
	$html_output .= '';

	echo $html_output;
