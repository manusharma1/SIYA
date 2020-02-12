<?php
$gradecategoryid_placeholder = '';
$assessmenttypeid_placeholder = '';
$gradetype_placeholder = '';
$startrange_placeholder = '';
$endrange_placeholder = '';
$marks_placeholder = '';
$grade_placeholder = '';
$gradepoint_placeholder = '';

// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'gradecategoryid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','description','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'gradecategories', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$gradecategoryid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'assessmenttypeid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = 'All Assesments Type';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','name','description');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'assessmenttypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $assessmenttypeid_placeholder)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name);
$htmlarray[]['option']['end'] = '';
}
}
}


$htmlarray[]['select']['end'] = '';
$assessmenttypeid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST)){
$startrange_placeholder = (isset($_POST['startrange']))?$_POST['startrange']:'';
$endrange_placeholder = (isset($_POST['endrange']))?$_POST['endrange']:'';
$marks_placeholder = (isset($_POST['marks']))?$_POST['marks']:'';
$grade_placeholder = (isset($_POST['grade']))?$_POST['grade']:'';
$gradepoint_placeholder = (isset($_POST['gradepoint']))?$_POST['gradepoint']:'';

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
$("#addgradeform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('assessments/saveGrade/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assessments/saveGrade/');
}
?>
<form id="addgradeform" name="addgradeform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['assessments']['ADD_GRADE'];?></legend>

	<ol>
		<li>
		<label for="gradecategoryid"><?php echo $lang['siya']['assessments']['GRADE_CATEGORY_ID'];?> </label><?php echo $gradecategoryid_placeholder; ?> 
	    </li>
		
		<li>
		<label for="assessmenttypeid"><?php echo $lang['siya']['assessments']['ASSESSMENT_TYPE'];?></label>
		<?php echo $assessmenttypeid_placeholder; ?>
		</li>		
		
		<li>
		<label for="gradetype"><?php echo $lang['siya']['assessments']['GRADETYPE'];?></label>
		<select name="gradetype" id="gradetype" <?php echo _FORM_FINAL; ?> />
		<option value="">------</option>
		<option value="ALL" <?php  echo ($gradetype_placeholder=='ALL')?'SELECTED':''; ?>>ALL</option>
		<option value="NORMAL" <?php  echo ($gradetype_placeholder=='NORMAL')?'SELECTED':''; ?>>NORMAL</option>
		<option value="TOTAL" <?php  echo ($gradetype_placeholder=='TOTAL')?'SELECTED':''; ?>>TOTAL</option>
		<option value="GRANDTOTAL" <?php  echo ($gradetype_placeholder=='GRANDTOTAL')?'SELECTED':''; ?>>GRANDTOTAL</option>
		<option value="FINAL" <?php  echo ($gradetype_placeholder=='FINAL')?'SELECTED':''; ?>>FINAL</option>
		</select>
		</li>
		

		<li>
		<label for="startrange"><?php echo $lang['siya']['assessments']['START_RANGE'];?></label>
		<input id="startrange" name="startrange" type="text" placeholder="<?php echo $lang['siya']['assessments']['ENTER_START_RANGE'];?>" value="<?php echo $startrange_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="endrange"><?php echo $lang['siya']['assessments']['END_RANGE'];?></label>
		<input id="endrange" name="endrange" type="text" placeholder="<?php echo $lang['siya']['assessments']['ENTER_END_RANGE'];?>" value="<?php echo $endrange_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="marks"><?php echo $lang['siya']['assessments']['MARKS'];?></label>
		<input id="marks" name="marks" type="text" placeholder="<?php echo $lang['siya']['assessments']['ENTER_MARKS'];?>" value="<?php echo $marks_placeholder; ?>"  />
		</li>
		
		<li>
		<label for="grade"><?php echo $lang['siya']['assessments']['GRADE'];?></label>
		<input id="grade" name="grade" type="text" placeholder="<?php echo $lang['siya']['assessments']['ENTER_GRADE'];?>" value="<?php echo $grade_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="gradepoint"><?php echo $lang['siya']['assessments']['GRADE_POINT'];?></label>
		<input id="gradepoint" name="gradepoint" type="text" placeholder="<?php echo $lang['siya']['assessments']['ENTER_GRADE_POINT'];?>" value="<?php echo $gradepoint_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>