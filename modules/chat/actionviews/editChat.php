<?php
$id = _ACTION_VIEW_PARAMETER_ID;

$name_placeholder = '';
$description_placeholder = '';


global $groupid ,$batchid,$subjectid,$topicid;
$batchid = '';
$groupid = '';
$subjectid = '';
$topicid = '';


$columns = array('id','groupid','batchid','subjectid','topicid','name','description','userids');
$sqlObj = new MainSQL();

$conditions = array();
$conditions['=']['id'] = $id;
$sql = $sqlObj->SQLCreator('S', 'chat', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$groupid =  $sqlObj->getCleanData($resultset->groupid);
$batchid =  $sqlObj->getCleanData($resultset->batchid);
$subjectid =  $sqlObj->getCleanData($resultset->subjectid);
$topicid =  $sqlObj->getCleanData($resultset->topicid);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
$userids = $sqlObj->getCleanData($resultset->userids);
}
}
}


$useridsarray = explode(',',$userids);

if($groupid == 0 && $subjectid == 0 && $topicid == 0){


$HTMLObj = new MainHTML();

$htmlarray = array();
$htmlarray[]['select']['name'] = 'usersnotingroup[]';
$htmlarray[]['select']['id'] = 'usersnotingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','fname','mname','lname','usertypetag');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(!in_array($sqlObj->getCleanData($resultsetmenu->id),$useridsarray)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->fname).' '.$sqlObj->getCleanData($resultsetmenu->mname).' '.$sqlObj->getCleanData($resultsetmenu->lname).' ('.$sqlObj->getCleanData($resultsetmenu->usertypetag).')';
$htmlarray[]['option']['end'] = '';
}
}
}
}

$htmlarray[]['select']['end'] = '';
$usersnotingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);




$htmlarray = array();
$htmlarray[]['select']['name'] = 'usersingroup[]';
$htmlarray[]['select']['id'] = 'usersingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','fname','mname','lname','usertypetag');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(in_array($sqlObj->getCleanData($resultsetmenu->id),$useridsarray)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->fname).' '.$sqlObj->getCleanData($resultsetmenu->mname).' '.$sqlObj->getCleanData($resultsetmenu->lname).' ('.$sqlObj->getCleanData($resultsetmenu->usertypetag).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$usersingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);

}

// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid,$batchid,$subjectid,$topicid;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'groupid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

if($userids == ''){

$sqlObj = new MainSQL();
$columns = array('id','grouptypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $groupid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';
}
}
}

}

$htmlarray[]['select']['end'] = '';
$groupid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


//Batch ID
$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'batchid';
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
$htmlarray[]['option']['data'] = 'All Batches';
$htmlarray[]['option']['end'] = '';


$columns = array('id','batchcode','title');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultset->id);
($resultset->id == $batchid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
$htmlarray[]['option']['end'] = '';

}
}
}else{
trigger_error('Data Fetch Error');
}

$htmlarray[]['select']['end'] = '';
$batchid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

// Subject ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid,$batchid ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'subjectid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

if($userids == ''){

$sqlObj = new MainSQL();
$columns = array('id','subjectcode','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'subjects', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $subjectid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->subjectcode).')';
$htmlarray[]['option']['end'] = '';
}
}
}

}

$htmlarray[]['select']['end'] = '';
$subjectid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

// Topic ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid,$batchid ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'topicid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

if($userids == ''){

$sqlObj = new MainSQL();
$columns = array('id','description','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'topics', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $topicid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

}

$htmlarray[]['select']['end'] = '';
$topicid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST) && isset($_POST['issubmit'])){
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


<?php
if($groupid == 0 && $subjectid == 0 && $topicid == 0){
?>

	$('#buttonusersright').click(function(e) {
        var selectedOpts = $('#usersnotingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#usersingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
		$('#usersingroup option').prop('selected', 'selected');
		e.preventDefault();
    });

    $('#buttonusersleft').click(function(e) {
        var selectedOpts = $('#usersingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#usesnotingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });


<?php
}
?>

$("#editchatform").validate();

})
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('chat/saveChat/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('chat/saveChat/'.$id.'/');
}
?>
<form id="editchatform" name="editchatform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Chat</legend>

	<ol>
		<li>
		<label for="groupid">Group <?php echo $groupid_placeholder; ?></label><br />
	    </li>
		
		<li>
		<label for="batchid">Batch <?php echo $batchid_placeholder; ?></label><br />
	    </li>

		<li>
		<label for="topicid">Topic <?php echo $topicid_placeholder; ?></label><br />
	    </li>

		<li>
		<label for="subjectid">subject<?php echo $subjectid_placeholder; ?></label><br />
	    </li>
		

		<?php
		if($groupid == 0 && $subjectid == 0 && $topicid == 0){
		?>

		<li>

		<label for="addusersinchat"><?php echo $lang['siya']['chat']['ADD_USERS_IN_CHAT'];?></label><br />


		<table style='width:500px;'>
		<tr>
		<td style='width:200px;'>
		<b>Users not in this Chat:</b><br/>
		<?php echo $usersnotingroup_placeholder; ?> 

		</td>
		<td style='width:50px;text-align:center;vertical-align:middle;'>
		<input type='button' id='buttonusersright' value ='  >  '/>
		<br/><input type='button' id='buttonusersleft' value ='  <  '/>
		</td>
		<td style='width:200px;'>
		<b>Users in this Chat: </b><br/>
		<?php echo $usersingroup_placeholder; ?>
		</td>
		</tr>
		</table>


		</li>


		<?php
		}
		?>



		<li>
		<label for="name"><?php echo $lang['siya']['chat']['NAME'];?></label><br />
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['chat']['NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['chat']['DESCRIPTION'];?></label><br />
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['chat']['DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
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