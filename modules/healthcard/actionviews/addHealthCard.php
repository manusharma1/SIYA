<?php
$ids = _ACTION_VIEW_PARAMETER_ID;
$idsarray = explode(',',$ids);

$id = $idsarray[0];
$groupid = $idsarray[1];

$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];

//if(!MainSystem::isUserExistsbyGroupandBatch($id,$groupid,$selected_batch_id)){

//$_SESSION['message'] = $lang['siya']['USER_GROUP_BATCH_COMBINATION_INVALID'];
//MainSystem::URLForwarder(MainSystem::URLCreator('healthcard/manageHealthCard/'));
//}


$userid_placeholder = '';
$height_placeholder = '';
$teeth_placeholder = '';
$weight_placeholder = '';
$leftvision_placeholder = '';
$rightvision_placeholder = '';
$oralheigine_placeholder = '';
$allergies_placeholder = '';
$remarks_placeholder = '';
// User ID //

$sqlObj = new MainSQL();
$columns = array('id','fname','mname','lname');
$conditions = array();
$conditions['=']['id'] = $id;

$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
if($resultset = $sqlObj->FetchResult($result)){
$user_placeholder  = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
}
}
}

if(isset($_POST)){
$height_placeholder = (isset($_POST['height']))?$_POST['height']:'';
$teeth_placeholder = (isset($_POST['teeth']))?$_POST['teeth']:'';
$weight_placeholder = (isset($_POST['weight']))?$_POST['weight']:'';
$leftvision_placeholder = (isset($_POST['leftvision']))?$_POST['leftvision']:'';
$rightvision_placeholder = (isset($_POST['rightvision']))?$_POST['rightvision']:'';
$oralheigine_placeholder = (isset($_POST['oralheigine']))?$_POST['oralheigine']:'';
$allergies_placeholder = (isset($_POST['allergies']))?$_POST['allergies']:'';
$remarks_placeholder = (isset($_POST['allergies']))?$_POST['allergies']:'';
}
?>

<?php
if(PROJ_RUN_AJAX==1){
	if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	}
}
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('healthcard/saveHealthCard/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('healthcard/saveHealthCard/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Health Card Of a Student</legend>

	<ol>
	<?php
	if($id !=''){
	?>
		<li>
		<label for="userid"><?php echo $lang['siya']['healthcard']['STUDENT']; ?></label><?php echo $user_placeholder; ?> 
	    </li>

	<?php
		}
	?>
		
		<li>
		<label for="height"><?php echo $lang['siya']['healthcard']['HEIGHT']; ?></label>
		<input id="height" name="height" type="text" placeholder="<?php echo $lang['siya']['healthcard']['HEIGHT']; ?>" value="<?php echo $height_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="bloodgroup">Blood Group</label><br/>
		<input name="bloodgroup" id="radio-01" value="a+" type="radio" <?php echo _FORM_FINAL; ?> />a+<br/>
		<input name="bloodgroup" id="radio-02" value="b+" type="radio" <?php echo _FORM_FINAL; ?> />b+<br/>
		<input name="bloodgroup" id="radio-03" value="o+" type="radio" <?php echo _FORM_FINAL; ?> />o+<br/>
		<input name="bloodgroup" id="radio-04" value="ab+" type="radio" <?php echo _FORM_FINAL; ?> />ab+<br/>
		<input name="bloodgroup" id="radio-05" value="a-" type="radio" <?php echo _FORM_FINAL; ?> />a-<br/>
		<input name="bloodgroup" id="radio-06" value="b-" type="radio" <?php echo _FORM_FINAL; ?> />b-<br/>
		<input name="bloodgroup" id="radio-07" value="o-" type="radio" <?php echo _FORM_FINAL; ?> />o-<br/>
		<input name="bloodgroup" id="radio-08" value="ab-" type="radio" <?php echo _FORM_FINAL; ?> />ab-<br/>
		</li>

		<li>
		<label for="teeth"><?php echo $lang['siya']['healthcard']['TEETH']; ?></label>
		<input id="teeth" name="teeth" type="text" placeholder="<?php echo $lang['siya']['healthcard']['TEETH']; ?>" value="<?php echo $teeth_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="weight"><?php echo $lang['siya']['healthcard']['WEIGHT']; ?></label>
		<input id="weight" name="weight" type="text" placeholder="<?php echo $lang['siya']['healthcard']['WEIGHT']; ?>" value="<?php echo $weight_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="leftvision"><?php echo $lang['siya']['healthcard']['LEFT_VISION']; ?></label>
		<input id="leftvision" name="leftvision" type="text" placeholder="<?php echo $lang['siya']['healthcard']['LEFT_VISION']; ?>" value="<?php echo $leftvision_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="rightvision"><?php echo $lang['siya']['healthcard']['RIGHT_VISION']; ?></label>
		<input id="rightvision" name="rightvision" type="text" placeholder="<?php echo $lang['siya']['healthcard']['RIGHT_VISION']; ?>" value="<?php echo $rightvision_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="oralheigine"><?php echo $lang['siya']['healthcard']['ORAL_HEIGINE']; ?></label>
		<input id="oralheigine" name="oralheigine" type="text" placeholder="<?php echo $lang['siya']['healthcard']['ORAL_HEIGINE']; ?>" value="<?php echo $oralheigine_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		
		</li>
		
		<li>
		<label for="allergies">Allergies</label>
		<input id="allergies" name="allergies" type="text" placeholder="Enter Allergies" value="<?php echo $allergies_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="remarks">Description</label>
		<textarea id="remarks" name="remarks" type="text" placeholder="Enter Remarks" rows="5" required="" autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $remarks_placeholder; ?></textarea>
		</li>
	
	</ol>
<fieldset>
<input id="userid" name="userid" type="hidden" value="<?php echo $id; ?>" />
<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>" />
<input id="batchid" name="batchid" type="hidden" value="<?php echo $selected_batch_id; ?>" />


<button type="submit">Save</button>

</fieldset>

</form>

<?php
/*$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=newstitle,newstext,newsdate:onsubmit=addnewnews:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;*/
?>