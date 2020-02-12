<?php
$semesterid_placeholder = '';
$semestercode_placeholder = '';
$title_placeholder = '';
$description_placeholder = '';

// Semester ID //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'batchid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','batchcode','title');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->batchcode).' ('.$sqlObj->getCleanData($resultsetmenu->title).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$batchid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST)){
$semestercode_placeholder = (isset($_POST['semestercode']))?$_POST['semestercode']:'';
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
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
$("#addnewsemesterform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('semesters/saveSemester/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('semesters/saveSemester/');
}
?>
<form id="addnewsemesterform" name="addnewsemesterform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add New Semester</legend>

	<ol>
		<li>
		<label for="batchid">Batch </label><?php echo $batchid_placeholder; ?> 
	    </li>
		<li>
		<label for="semestercode">Semester Code</label>
		<input id="semestercode" name="semestercode" type="text" placeholder="Enter Semester Code" value="<?php echo $semestercode_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="title"><?php echo $lang['siya']['semesters']['TITLE']; ?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['semesters']['TITLE']; ?>" required="" autofocus="" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['semesters']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['semesters']['DESCRIPTION']; ?>" rows="5"  autofocus="" <?php echo _FORM_FINAL; ?>><?php echo $description_placeholder; ?></textarea>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>