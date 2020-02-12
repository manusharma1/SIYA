<?php
$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);
	
	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////
	
	$id = (isset($parameters[0]))?$parameters[0]:'';
	MainSystem::CheckGroupPermissions($id,'group');

$topiccode_placeholder = '';
$subjectname_placeholder = '';
$subjectcode_placeholder = '';
$name_placeholder = '';
$description_placeholder = '';
$url = '';

$columns = array('subjectcode','name');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$subjectname_placeholder = $sqlObj->getCleanData($resultset->name);	
$subjectcode_placeholder = $sqlObj->getCleanData($resultset->subjectcode);
$url='stage/showSubject/'.$id.'/';

}
}
}else{
trigger_error($lang['siya']['ADD_ASSIGNMENTS']);
}		

if(isset($_POST)){
$topiccode_placeholder = (isset($_POST['topiccode']))?$_POST['topiccode']:'';
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
}
?>

<?php
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
$formaction = MainSystem::URLCreator('subjects/saveTopic/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('subjects/saveTopic/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend><?php echo $lang['siya']['attendence']['ADD_NEW_TOPIC'];?></legend>

	<ol>
		<li>
		<label for="subjectname"><?php echo $lang['siya']['SUBJECT'];?> <a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $subjectname_placeholder.' ('.$subjectcode_placeholder.')'; ?></a></label>
	    </li>
		<li>
		<label for="topiccode"><?php echo $lang['siya']['attendence']['TOPIC_CODE'];?></label>
		<input id="topiccode" name="topiccode" type="text" placeholder="<?php echo $lang['siya']['attendence']['ENTER_TOPIC_CODE'];?>" value="<?php echo $topiccode_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['NAME'];?> </label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['ENTER_NAME'];?> " required="" autofocus="" value="<?php echo $name_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required">
		</li>

		<li>
		<label for="description"><?php echo $lang['siya']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" type="text" placeholder="<?php echo $lang['siya']['ENTER_DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		</li>
		<input type="hidden" name="subjectid" value="<?php echo $id;?>">
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