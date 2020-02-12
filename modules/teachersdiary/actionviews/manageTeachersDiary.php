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
  	<li>Day</li>
	<li>Content</li>
	<li>Objective</li>
	<li>Status</li>
    <li>Edit</li>
    <li>Delete</li>
	</ul>';

	// Get Page Data
	$columns = array('id','day','content','objective','isactive');
	$sqlObj = new MainSQL();
	$conditions = array();
	$sql = $sqlObj->SQLCreator('S', 'teachersdiary', $columns, '', '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ // If Rows Exists
	
	while($resultset = $sqlObj->FetchResult($result)){

	$day_placeholder = ($resultset->day=='')?'':$sqlObj->getCleanData($resultset->day);
	$content_placeholder = ($resultset->content=='')?'':$sqlObj->getCleanData($resultset->content);
	$objective_placeholder = ($resultset->objective=='')?'':$sqlObj->getCleanData($resultset->objective);

	$status_placeholder = MainSystem::URLCreator('teachersdiary/changeTeachersDiaryStatus/'.$resultset->id.'/');
	$status_text_placeholder = ($resultset->isactive==0)?'Not Active':'Active';

	$edit_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('teachersdiary/editTeachersDiary/'.$resultset->id.'/');
	$delete_placeholder = ($resultset->id=='')?'#':MainSystem::URLCreator('teachersdiary/deleteTeachersDiary/'.$resultset->id.'/');

	$tr_bg_class = ($tr_bg_value==0)?'lightpink':'white';
	$tr_bg_value = ($tr_bg_value==0)?1:0;
	
	$html_output .= '<ul class="'.$tr_bg_class.'">
  	<li>'.$day_placeholder.'</li>
    <li>'.$content_placeholder.'</li>
	<li>'.$objective_placeholder.'</li>
 	<li><a href="'.$status_placeholder.'">'.$status_text_placeholder.'</a></li>
    <li><a href="'.$edit_placeholder.'">Edit </a></li>
    <li><a href="'.$delete_placeholder.'">Delete </a></li>
	</ul>';
	} // while

	}else{ // if Doesn't Exists
	$html_output .= '<ul><li><h2>No Record</h2></li></ul>';
	}
	}else{
	trigger_error('SQL Error');
	}
	$html_output .= '';

	echo $html_output;
