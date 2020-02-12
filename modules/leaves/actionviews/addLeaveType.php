<?php
$entitytypetag_placeholder = '';
$title_placeholder = '';
$description_placeholder = '';

// Entity Type Tag //


$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'entitytypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

function recursiveMenu($pid='',$level){
global $htmlarray,$level;
$level++;
$columns = array('e.id','e.entitytypetag','e.entityname');
$conditions = array();

$tables = array();
$tables['entities'] = 'e';
$tables['entitiesrelationship'] = 'er';

$conditions['=']['er.entitytype1'] = $pid;
$conditions['K AND =']['e.id'] = 'er.pid';
$conditions['AND =']['er.entityrelationtype'] = 'parent';


$sqlObj = new MainSQL();

$sqlmenu = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, 'e.id', '', '');
	
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$str = '';
for($i=0;$i<=$level;$i++){
$str .= '-';
}
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu->entityname).')';
$htmlarray[]['option']['end'] = '';
if($resultsetmenu->id != $pid){
recursiveMenu($resultsetmenu->id,$level);
$level--;
}
}
}
}
}

recursiveMenu(0,0);

$htmlarray[]['select']['end'] = '';

$entitytypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST)){
$leavetypetag_placeholder = (isset($_POST['leavetypetag']))?$_POST['leavetypetag']:'';
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
$("#addleavetypeform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('leaves/saveLeaveType/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('leaves/saveLeaveType/');
}
?>
<form id="addleavetypeform" name="addleavetypeform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Leave Type</legend>

	<ol>

		<li>
		<label for="leavetypetag">Leave Type Tag</label>
		<input id="leavetypetag" name="leavetypetag" type="text" placeholder="Enter Leave Type" value="<?php echo $leavetypetag_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="entitytypetag">Entity Type Tag : </label><?php echo $entitytypetag_placeholder; ?> 
	    </li>
		
		<li>
		<label for="title"><?php echo $lang['siya']['leaves']['TITLE'];?></label>
		<input id="title" name="title" type="text" placeholder="Enter Title"  autofocus="" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['leaves']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" type="text" placeholder="Enter Description" rows="5"  autofocus=""<?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>
	
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>