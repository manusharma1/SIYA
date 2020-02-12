<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$replyid = '';
$description_placeholder = '';
?>
<?php
$columns = array('a.id','a.replyid','a.description','au.assignmentid');
$conditions = array();
$tables=array();
$tables['assignments']  = 'a';
$tables['assignmentuploads']  = 'au';

$conditions['=']['a.id'] = $id;
$conditions['K AND =']['au.id'] = 'a.replyid';
$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S',$tables, $columns, $conditions, '', '', '');
echo $sql;die;

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset= $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$replyid = $sqlObj->getCleanData($resultset->replyid);
$description_placeholder = $sqlObj->getCleanData($resultset->description);
}
}
}

if(isset($_POST) && isset($_POST['issubmit'])){
$description_placeholder =(isset($_POST['description']))?$_POST['description']:'';

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
$formaction = MainSystem::URLCreator('assignments/saveReplyAssignment/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('assignments/saveReplyAssignment/'.$id.'/');
}
?>


<script language="javascript">
fields = 1;
function addOptions() {
if (fields < 6) {
var content
content = '<li><label for="chosenfile'+fields+'">Upload File '+fields+' :</label><input type="file" id="chosenfile'+fields+'"  name="chosenfile[file'+fields+']" value="model.jpg"/><input type="hidden" id="chosenfile'+fields+'"  name="chosenfile[file'+fields+']" /></li>';
$("#additionalfields").append(content);
fields += 1;
} else {
alert("Upto 5 File Uploads are allowed.");
document.form.addbutton.disabled=true;
}

}

</script>



<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>"  enctype="multipart/form-data">

<fieldset>

	<legend><?php echo $lang['siya']['assignments']['EDIT_REPLY_TO_ASSIGNMENT'];?></legend>

	<ol>
			
		<li>
		<label for="description"><?php echo $lang['siya']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['ENTER_DESCRIPTION'];?>" rows="5" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>	
		</li>

	
		<div id="additionalfields">

		</div>
		<input type="button" onclick="addOptions()" name="addbutton" value="Add File" />


		<input id="replyid" name="replyid" type="hidden" value="<?php echo $replyid; ?>"/>
		

		</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>