<?php
$subjectid=$_POST['subjectid'];
$groupid=$_POST['groupid'];
$topicid=$_POST['topicid'];
$batchid=$_POST['batchid'];

$name_placeholder = '';
$description_placeholder = '';


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


<?php
if($groupid == '' && $subjectid == '' && $topicid == ''){


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
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->fname).' '.$sqlObj->getCleanData($resultsetmenu->mname).' '.$sqlObj->getCleanData($resultsetmenu->lname).' ('.$sqlObj->getCleanData($resultsetmenu->usertypetag).')';
$htmlarray[]['option']['end'] = '';
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
$htmlarray[]['select']['end'] = '';
$usersingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);

}

?>

<script>
$(document).ready(function(){


<?php
if($groupid == '' && $subjectid == '' && $topicid == ''){
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

$("#addchatform").validate();

})
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('chat/saveChat/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('chat/saveChat/');
}
?>
<form id="addchatform" name="addchatform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Chat</legend>

	<ol>
			
		<li>
		<label for="name"><?php echo $lang['siya']['chat']['NAME'];?></label><br />
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['chat']['NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['chat']['DESCRIPTION']; ?></label><br />
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['chat']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>

		<?php
		if($groupid == '' && $subjectid == '' && $topicid == ''){
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


	</ol>
	<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
	<input id="batchid" name="batchid" type="hidden" value="<?php echo $batchid; ?>" /> 
	<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" /> 
	<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 

	</fieldset>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>