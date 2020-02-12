<?php
$id = _ACTION_VIEW_PARAMETER_ID;


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

<h3>Assessment Detail</h3>

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

	<legend>Add Assessment</legend>
	
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
	?>
	

	<li>
	<label for="groupid"><?php echo $name_placeholder.' '.$mname_placeholder.' '.$lname_placeholder; ?>
		<input type="text" size="5" name="assessmentmarks[<?php echo $id_placeholder; ?>]" />
		
		</label>
	</li>
	
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	
	

	?>

	<input type="hidden" name="assessmentid" value="<?php echo $id; ?>" />
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>