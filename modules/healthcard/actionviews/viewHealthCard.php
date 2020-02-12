<?php

$ids = _ACTION_VIEW_PARAMETER_ID;
$idsarray = explode(',',$ids);

$id = $idsarray[0];
$groupid = $idsarray[1];

$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

if(!MainSystem::isUserExistsbyGroupandBatch($id,$groupid,$selected_batch_id)){
$_SESSION['message'] = $lang['siya']['USER_GROUP_BATCH_COMBINATION_INVALID'];
MainSystem::URLForwarder(MainSystem::URLCreator('healthcard/manageHealthCard/'));
}

$userid_placeholder = '';
$height_placeholder = '';
$teeth_placeholder = '';
$weight_placeholder = '';
$leftvision_placeholder = '';
$rightvision_placeholder = '';
$oralheigine_placeholder = '';
$allergies_placeholder = '';
$remarks_placeholder = '';

$userid = '';

$columns = array('h.id','h.userid','u.fname','u.mname','u.lname','h.height','h.bloodgroup','h.teeth','h.weight','h.leftvision','h.rightvision','h.oralheigine','h.allergies','h.remarks','h.isactive');
$conditions = array();
$tables = array();
$tables['healthcard'] = 'h';
$tables['users'] = 'u';

$conditions['K =']['u.id'] = 'h.userid';
$conditions['AND =']['h.userid'] = $id;
$conditions['AND =']['h.groupid'] = $groupid;
$conditions['AND =']['h.batchid'] = $selected_batch_id;

$sqlObj = new MainSQL();
	
$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$userid =  $sqlObj->getCleanData($resultset->userid);
$fname_placeholder =  $sqlObj->getCleanData($resultset->fname);
$mname_placeholder =  $sqlObj->getCleanData($resultset->mname);
$lname_placeholder =  $sqlObj->getCleanData($resultset->lname);
$height_placeholder =  $sqlObj->getCleanData($resultset->height);
$bloodgroup_placeholder =  $sqlObj->getCleanData($resultset->bloodgroup);
$teeth_placeholder =  $sqlObj->getCleanData($resultset->teeth);
$weight_placeholder =  $sqlObj->getCleanData($resultset->weight);
$leftvision_placeholder =  $sqlObj->getCleanData($resultset->leftvision);
$rightvision_placeholder =  $sqlObj->getCleanData($resultset->rightvision);
$oralheigine_placeholder =  $sqlObj->getCleanData($resultset->oralheigine);
$allergies_placeholder =  $sqlObj->getCleanData($resultset->allergies);
$remarks_placeholder =  $sqlObj->getCleanData($resultset->remarks);
}
}
}


if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('healthcard/saveHealthCard/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('healthcard/saveHealthCard/'.$id.'/');
}
?>
<form>

<fieldset>

	<legend>Health Card Of A Student</legend>

	<ol>
		<li>
		<label for="userid">Student </label><?php echo $fname_placeholder.' '.$mname_placeholder.' '.$lname_placeholder; ?> 
	    </li>
		
		<li>
		<label for="height">Height</label>
		<?php echo $height_placeholder; ?>
		</li>
		
		<li>
		<label for="bloodgroup">Blood Group</label>
		<?php echo $bloodgroup_placeholder; ?>
		</li>

		<li>
		<label for="teeth">Teeth</label>
		<?php echo $teeth_placeholder; ?>
		</li>
		
		<li>
		<label for="weight">Weight</label>
		<?php echo $weight_placeholder; ?>
		</li>

		<li>
		<label for="leftvision">Left Vision</label>
		<?php echo $leftvision_placeholder; ?>
		</li>
		
		<li>
		<label for="rightvision">Right Vision</label>
		<?php echo $rightvision_placeholder; ?>
		</li>
		
		<li>
		<label for="oralheigine">Oral Heigine</label>
		<?php echo $oralheigine_placeholder; ?>
		
		</li>
		
		<li>
		<label for="allergies">Allergies</label>
		<?php echo $allergies_placeholder; ?>
		</li>
		
		<li>
		<label for="remarks">Description</label>
		<?php echo $remarks_placeholder; ?>
		</li>
	
	</ol>
<fieldset>


</fieldset>

</form>