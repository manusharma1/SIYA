

<script>
$(document).ready(function(){

// http://jquerybyexample.blogspot.com/2012/05/how-to-move-items-between-listbox-using.html //

$('#btnRight').click(function(e) {
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

    $('#btnLeft').click(function(e) {
        var selectedOpts = $('#usersingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#usersnotingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
})


$("adduserstogroup").validate();



function SelectedOn(){
$('#usersnotingroup option').prop('selected', 'selected');
$('#usersingroup option').prop('selected', 'selected');
}

</script>


<?php

	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	MainSystem::CheckGroupPermissions($id,'group');
	$nousersingroup = 0;
	$default_group_id = $id;

// More Logics to come - for filtering //

	$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];


	$HTMLObj = new MainHTML();
	$htmlarray = array();
	$htmlarray[]['select']['name'] = 'usersingroup[]';
	$htmlarray[]['select']['id'] = 'usersingroup';
	$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
	$htmlarray[]['select']['close'] = '';
	$htmlarray[]['option']['end'] = '';


	$columns = array('u.id','u.fname','u.mname','u.lname','u.entitytypetag','u.usertypetag');

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['users'] = 'u';

	$conditions = array();
	$conditions['=']['ug.groupid']  = $id;
	$conditions['AND =']['ug.batchid']  = $selected_batch_id;
	$conditions['AND =']['ug.iscore']  = 1;
	$conditions['K AND =']['ug.userid']  = 'u.id';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('SD', $tables, $columns, $conditions, 'u.fname, u.mname, u.lname', '', '');


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultset->id;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname).' ['.$sqlObj->getCleanData($resultset->entitytypetag).'] ['.$sqlObj->getCleanData($resultset->usertypetag).']';
	$htmlarray[]['option']['end'] = '';

	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}


	$htmlarray[]['select']['end'] = '';
	$usersingroup_menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);

	
	$HTMLObj = new MainHTML();
	$htmlarray = array();
	$htmlarray[]['select']['name'] = 'usersnotingroup[]';
	$htmlarray[]['select']['id'] = 'usersnotingroup';
	$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
	$htmlarray[]['select']['close'] = '';
	$htmlarray[]['option']['end'] = '';


	
	/*$columns = array('u.id','u.fname','u.mname','u.lname','u.entitytypetag','u.usertypetag');

	$tables = array();

	$tables['users'] = 'u';
	if($nousersingroup == 0){
	$tables['usersingroup'] = 'ug';
	}
	$conditions = array();

	$conditions['=']['u.isactive']  = '1';
	if($nousersingroup == 0){
	$conditions['K AND !=']['u.id']  = 'ug.userid';
	}
	$conditions['AND IN ARR']['u.entitytypetag']  = array('@teacher','@student');

	*/

	$sqlObj = new MainSQL();

	$sql = "SELECT u.id, u.fname, u.mname, u.lname, u.entitytypetag, u.usertypetag FROM users u LEFT JOIN usersingroup ug ON ug.userid = u.id AND ug.groupid = '".$id."' WHERE ug.id IS NULL AND u.entitytypetag IN ('@teacher','@student') AND u.isactive = '1' ORDER BY u.fname, u.mname, u.lname";


	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultset->id;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname).' ['.$sqlObj->getCleanData($resultset->entitytypetag).'] ['.$sqlObj->getCleanData($resultset->usertypetag).']';
	$htmlarray[]['option']['end'] = '';

	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}


	$htmlarray[]['select']['end'] = '';
	$usersnotingroup_menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);	
		
	
	
	// Get Group Data


	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'groupid';
	$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = '';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';



	//$columns = array('groupid');
	//$conditions = array();
	//$conditions['=']['userid'] = $id;

	//$sqlObj = new MainSQL();
	//$sql = $sqlObj->SQLCreator('SD', 'usersingroup', $columns, $conditions, '', '', '');


	$columns = array('id','grouptypetag','name');


	$conditions = array();
	$conditions['=']['id'] = $id;
	$conditions['AND =']['entitytypetag'] = '@class';

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);
	
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultset->id;
	($resultset->id == $default_group_id)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->name).' ('.$sqlObj->getCleanData($resultset->grouptypetag).')';
	$htmlarray[]['option']['end'] = '';

	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}

	$htmlarray[]['select']['end'] = '';
	$group_placeholder = $HTMLObj->HTMLCreator($htmlarray);
	
	
	
	// Batch ID //
	
	$HTMLObj = new MainHTML();
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'batchid';
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
	$htmlarray[]['option']['value'] = $resultset->id;
	($resultset->id == $selected_batch_id)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultset->title).' ('.$sqlObj->getCleanData($resultset->batchcode).')';
	$htmlarray[]['option']['end'] = '';

	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}


	$htmlarray[]['select']['end'] = '';
	$batch_placeholder = $HTMLObj->HTMLCreator($htmlarray);


	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('groups/addUsersToGroup2/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('groups/addUsersToGroup2/');
	}

	?>
	
	<?php
	if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	}
	?>


	<form id="adduserstogroup" name="adduserstogroup" method="post" action="<?php echo $formaction; ?>" onSubmit="JavaScript:SelectedOn();">

	<fieldset>
	<legend><?php echo $lang['siya']['groups']['ADD_USER_TO_GROUP'];?></legend>	
	
	<ol>
	<li>
	<label for="groupid"> <?php echo $lang['siya']['groups']['GROUP'];?> </label><?php echo $group_placeholder; ?> 
	</li>
	</ol>
	

	<ol>
	<li>
	<label for="groupid"> <?php echo $lang['siya']['groups']['BATCH'];?> </label><?php echo $batch_placeholder; ?> 
	</li>
	</ol>


	<ol>
	<li>
	<label for="groupid"><?php echo $lang['siya']['groups']['USER_MGNT'];?></label>
	
	
	
	<table style='width:500px;'>
    <tr>
        <td style='width:200px;'>
            <b><?php echo $lang['siya']['groups']['USER_NOT_IN_GROUP'];?></b><br/>
	<?php echo $usersnotingroup_menu_placeholder; ?> 

    </td>
    <td style='width:50px;text-align:center;vertical-align:middle;'>
        <input type='button' id='btnRight' value ='  >  '/>
        <br/><input type='button' id='btnLeft' value ='  <  '/>
    </td>
    <td style='width:200px;'>
        <b><?php echo $lang['siya']['groups']['USER_IN_GROUP'];?></b><br/>
<?php echo $usersingroup_menu_placeholder; ?>
    </td>
</tr>
</table>
	
	
	</li>
	</ol>
	
	

	<fieldset>
	<button type="submit"><?php echo $lang['siya']['groups']['SAVE'];?></button>
	</fieldset>

	</form>