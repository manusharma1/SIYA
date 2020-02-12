<?php
$id = _ACTION_VIEW_PARAMETER_ID;

MainSystem::CheckIDExists('healthcard','id',$id,'healthcard/manageHealthCard/');

$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('healthcard','addedby',$id);
if($accessreturnmessage != 'OK'){
MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
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

global $entitytype_tag,$userid;
$entitytype_tag = '';
$userid = '';

$columns = array('h.id','h.userid','u.fname','u.mname','u.lname','h.height','h.bloodgroup','h.teeth','h.weight','h.leftvision','h.rightvision','h.oralheigine','h.allergies','h.remarks','h.isactive');
$conditions = array();
$tables = array();
$tables['healthcard'] = 'h';
$tables['users'] = 'u';

$conditions['K =']['u.id'] = 'h.userid';

$sqlObj = new MainSQL();
	
$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$userid =  $sqlObj->getCleanData($resultset->userid);
$fname_placeholder =  $sqlObj->getCleanData($resultset->fname);
$mname_tag =  $sqlObj->getCleanData($resultset->mname);
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




$HTMLObj = new MainHTML();
global $htmlarray, $userid;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'userid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns2 = array('id','fname','mname','lname');
$conditions2 = array();
$conditions2['=']['isactive'] = '1';
$conditions2['AND =']['entitytypetag'] = '@student';

$sql2 = $sqlObj->SQLCreator('S', 'users', $columns2, $conditions2, '', '', '');
if($result2 = $sqlObj->FireSQL($sql2)){
if($sqlObj->getNumRows($result2)!=0){
while($resultset2 = $sqlObj->FetchResult($result2)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset2->id);
($resultset2->id == $userid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset2->fname).' ('.$sqlObj->getCleanData($resultset2->mname).' '.$sqlObj->getCleanData($resultset2->lname).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$userid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

if(isset($_POST) && isset($_POST['issubmit'])){
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
$("#edithealthcardform").validate();
});
</script>
<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('healthcard/saveHealthCard/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('healthcard/saveHealthCard/'.$id.'/');
}
?>
<form id="edithealthcardform" name="edithealthcardform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Health Card Of A Student</legend>

	<ol>
		<li>
		<label for="userid">Student </label><?php echo $userid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="height">Height</label>
		<input id="height" name="height" type="text" placeholder="Enter Height" value="<?php echo $height_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="bloodgroup">Blood Group</label><br/>
		<input name="bloodgroup" id="radio-01" value="a+" type="radio" <?php echo _FORM_FINAL; ?><?php  echo ($bloodgroup_placeholder=='a+')?'CHECKED':''; ?>/>a+<br/>

		<input name="bloodgroup" id="radio-02" value="b+" type="radio" <?php  echo ($bloodgroup_placeholder=='b+')?'CHECKED':''; ?>/>b+<br/>
		<input name="bloodgroup" id="radio-03" value="o+" type="radio" <?php  echo ($bloodgroup_placeholder=='o+')?'CHECKED':''; ?>/>o+<br/>
		<input name="bloodgroup" id="radio-04" value="ab+" type="radio" <?php  echo ($bloodgroup_placeholder=='ab+')?'CHECKED':''; ?>/>ab+<br/>
		<input name="bloodgroup" id="radio-05" value="a-" type="radio" <?php  echo ($bloodgroup_placeholder=='a-')?'CHECKED':''; ?>/>a-<br/>
		<input name="bloodgroup" id="radio-06" value="b-" type="radio" <?php  echo ($bloodgroup_placeholder=='b-')?'CHECKED':''; ?>/>b-<br/>
		<input name="bloodgroup" id="radio-07" value="o-" type="radio" <?php  echo ($bloodgroup_placeholder=='o-')?'CHECKED':''; ?>/>o-<br/>
		<input name="bloodgroup" id="radio-08" value="ab-" type="radio" <?php  echo ($bloodgroup_placeholder=='ab-')?'CHECKED':''; ?>/>ab-<br/>
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
		<textarea id="remarks" name="remarks" type="text" placeholder="Enter Remarks" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $remarks_placeholder; ?></textarea>
		</li>
	
	</ol>
<fieldset>

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