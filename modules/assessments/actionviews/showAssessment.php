<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
	
	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////
	
	$id = (isset($parameters[0]))?$parameters[0]:'';
	$groupid = (isset($parameters[1]))?$parameters[1]:'';
	MainSystem::CheckGroupPermissions($groupid,'group');


if(isset($_POST)){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';

}
?>

<?php
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<p class="buttonsfortitles"><?php echo $lang['siya']['assessments']['ASSESSMENT_DETAIL'];?></p><br /><br />
<p>Enter Marks for the Assessments</p><br />

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('assessments/saveUsersAssessment/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assessments/saveUsersAssessment/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['assessments']['SHOW_ASSESSMENT'];?></legend>
	
	<ol>

	<?php
	
	$columns = array('u.id','u.fname','u.mname','u.lname');
	$conditions = array();

	$tables = array();
	$tables['assessments'] = 'a';
	$tables['groups'] = 'g';
	$tables['batches'] = 'b';
	$tables['usersingroup'] = 'ug';
	$tables['users'] = 'u';

	$conditions['=']['a.id'] = $id;
	$conditions['K AND =']['a.groupid'] = 'ug.groupid';
	$conditions['K AND =']['a.batchid'] = 'ug.batchid';
	$conditions['K AND =']['ug.userid'] = 'u.id';



	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('SD', $tables, $columns, $conditions, '', '', '');
	
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$name_placeholder = $sqlObj->getCleanData($resultset->fname);	
	$mname_placeholder = $sqlObj->getCleanData($resultset->mname);	
	$lname_placeholder = $sqlObj->getCleanData($resultset->lname);

	$assessment_marks_placeholder = '';	

	$columns2 = array('marks');
	$conditions2 = array();
	$conditions2['=']['userid'] = $id_placeholder;
	$conditions2['AND =']['assessmentid'] = $id;

	$sql2 = $sqlObj->SQLCreator('S', 'usersassessments', $columns2, $conditions2, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ 
	if($resultset2 = $sqlObj->FetchResult($result2)){
	$assessment_marks_placeholder = $sqlObj->getCleanData($resultset2->marks);	
	}else{
	$assessment_marks_placeholder = '';	
	}
	}
	}


	?>
	
	<li>
	<input type="text" size="5" name="assessmentmarks[<?php echo $id_placeholder; ?>]" value="<?php echo $assessment_marks_placeholder; ?>"/>
	<?php echo $name_placeholder.' '.$mname_placeholder.' '.$lname_placeholder; ?>
	</li>
											
	<?php
	}
	}
	}else{
	trigger_error($lang['siya']['DATA_FETCH_ERROR']);
	}		

	?>

	<input type="hidden" name="assessmentid" value="<?php echo $id; ?>" />
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>