<?php
$id = _ACTION_VIEW_PARAMETER_ID;



	MainSystem::CheckIDExists('webconferencing','id',$id,'admin/getAdminHome/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('webconferencing','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$name_placeholder = '';
$description_placeholder = '';
$meetingid_placeholder = '';
$meetingname_placeholder = '';
$attendeepw_placeholder = '';
$moderatorpw_placeholder = '';
$welcomemsg_placeholder = '';
$dialnumber_placeholder = '';
$voicebridge_placeholder = '';
$webvoice_placeholder = '';
$logouturl_placeholder = '';
$maxparticipants_placeholder = '';
$record_placeholder = '';
$duration_placeholder = '';


global $groupid_tag ,$batchid_tag,$subjectid_tag,$topicid_tag;
$batchid_tag = '';
$groupid_tag = '';
$subjectid_tag = '';
$topicid_tag = '';



$columns = array('id','groupid','batchid','subjectid','topicid','name','description','meetingid','meetingname','attendeepw','moderatorpw','welcomemsg','dialnumber','voicebridge','webvoice','logouturl','maxparticipants','record','duration');
$sqlObj = new MainSQL();

$conditions = array();
$conditions['=']['id'] = $id;
$sql = $sqlObj->SQLCreator('S', 'webconferencing', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$groupid_tag =  $sqlObj->getCleanData($resultset->groupid);
$batchid_tag =  $sqlObj->getCleanData($resultset->batchid);
$subjectid_tag =  $sqlObj->getCleanData($resultset->subjectid);
$topicid_tag =  $sqlObj->getCleanData($resultset->topicid);
$name_placeholder =  $sqlObj->getCleanData($resultset->name);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
$meetingid_placeholder =  $sqlObj->getCleanData($resultset->meetingid);
$meetingname_placeholder =  $sqlObj->getCleanData($resultset->meetingname);
$attendeepw_placeholder =  $sqlObj->getCleanData($resultset->attendeepw);
$moderatorpw_placeholder =  $sqlObj->getCleanData($resultset->moderatorpw);
$welcomemsg_placeholder =  $sqlObj->getCleanData($resultset->welcomemsg);
$dialnumber_placeholder =  $sqlObj->getCleanData($resultset->dialnumber);
$voicebridge_placeholder =  $sqlObj->getCleanData($resultset->voicebridge);
$webvoice_placeholder =  $sqlObj->getCleanData($resultset->webvoice);
$logouturl_placeholder =  $sqlObj->getCleanData($resultset->logouturl);
$maxparticipants_placeholder =  $sqlObj->getCleanData($resultset->maxparticipants);
$record_placeholder =  $sqlObj->getCleanData($resultset->record);
$duration_placeholder =  $sqlObj->getCleanData($resultset->duration);

}
}
}


// Group ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag,$subjectid_tag,$topicid_tag;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'groupid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

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
($resultsetmenu->id == $groupid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';
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
($resultset->id == $batchid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
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
global $htmlarray,$groupid_tag,$batchid_tag ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'subjectid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

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
($resultsetmenu->id == $subjectid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->subjectcode).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$subjectid_placeholder = $HTMLObj->HTMLCreator($htmlarray);

// Topic ID //

$HTMLObj = new MainHTML();
global $htmlarray,$groupid_tag,$batchid_tag ;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'topicid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
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
$sqlmenu = $sqlObj->SQLCreator('S', 'topics', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
($resultsetmenu->id == $topicid_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$topicid_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST) && isset($_POST['issubmit'])){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
$meetingid_placeholder = (isset($_POST['meetingid']))?$_POST['meetingid']:'';
$meetingname_placeholder = (isset($_POST['meetingname']))?$_POST['meetingname']:'';
$attendeepw_placeholder = (isset($_POST['attendeepw']))?$_POST['attendeepw']:'';
$moderatorpw_placeholder = (isset($_POST['moderatorpw']))?$_POST['moderatorpw']:'';
$welcomemsg_placeholder = (isset($_POST['welcomemsg']))?$_POST['welcomemsg']:'';
$dialnumber_placeholder = (isset($_POST['dialnumber']))?$_POST['dialnumber']:'';
$voicebridge_placeholder = (isset($_POST['voicebridge']))?$_POST['voicebridge']:'';
$webvoice_placeholder = (isset($_POST['webvoice']))?$_POST['webvoice']:'';
$logouturl_placeholder = (isset($_POST['logouturl']))?$_POST['logouturl']:'';
$maxparticipants_placeholder = (isset($_POST['maxparticipants']))?$_POST['maxparticipants']:'';
$record_placeholder = (isset($_POST['record']))?$_POST['record']:'';
$duration_placeholder = (isset($_POST['duration']))?$_POST['duration']:'';

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
$formaction = MainSystem::URLCreator('webconferencing/saveWebConferencing/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('webconferencing/saveWebConferencing/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Web Conferencing</legend>

	<ol>
		<li>
		<label for="groupid">Group </label><?php echo $groupid_placeholder; ?>
			
	    </li>
		
		<li>
		<label for="batchid">Batch </label><?php echo $batchid_placeholder; ?>
		
	    </li>

		<li>
		<label for="topicid">Topic </label><?php echo $topicid_placeholder; ?>
		
	    </li>

		<li>
		<label for="subjectid">subject </label><?php echo $subjectid_placeholder; ?> 
		
	    </li>
		
		<li>
		<label for="name"><?php echo $lang['siya']['webconferencing']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['NAME'];?>" value="<?php echo $name_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['webconferencing']['DESCRIPTION'];?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['webconferencing']['DESCRIPTION'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $description_placeholder; ?></textarea>
		
		</li>

		<li>
		<label for="meetingid"><?php echo $lang['siya']['webconferencing']['MEETING_ID'];?></label>
		<input id="meetingid" name="meetingid" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['MEETING_ID'];?>" value="<?php echo $meetingid_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="meetingname"><?php echo $lang['siya']['webconferencing']['MEETING_NAME'];?></label>
		<input id="meetingname" name="meetingname" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['MEETING_NAME'];?>" value="<?php echo $meetingname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="attendeepw"><?php echo $lang['siya']['webconferencing']['ATTENDEE_PASSWORD'];?></label>
		<input id="attendeepw" name="attendeepw" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['ATTENDEE_PASSWORD'];?>" value="<?php echo $attendeepw_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="moderatorpw"><?php echo $lang['siya']['webconferencing']['MODERATOR_PASSWORD'];?></label>
		<input id="moderatorpw" name="moderatorpw" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['MODERATOR_PASSWORD'];?>" value="<?php echo $moderatorpw_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="welcomemsg"><?php echo $lang['siya']['webconferencing']['WELCOME_MESSAGE'];?></label>
		<textarea id="welcomemsg" name="welcomemsg" placeholder="<?php echo $lang['siya']['webconferencing']['WELCOME_MESSAGE'];?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"><?php echo $welcomemsg_placeholder; ?></textarea>
		
		</li>

		<li>
		<label for="dialnumber"><?php echo $lang['siya']['webconferencing']['DIAL_NUMBER'];?></label>
		<input id="dialnumber" name="dialnumber" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['DIAL_NUMBER'];?>" value="<?php echo $dialnumber_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="voicebridge"><?php echo $lang['siya']['webconferencing']['VOICE_BRIDGE'];?></label>
		<input id="voicebridge" name="voicebridge" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['VOICE_BRIDGE'];?>" value="<?php echo $voicebridge_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="webvoice"><?php echo $lang['siya']['webconferencing']['WEB_VOICE'];?></label>
		<input id="webvoice" name="webvoice" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['WEB_VOICE'];?>" value="<?php echo $webvoice_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="logouturl"><?php echo $lang['siya']['webconferencing']['LOGOUT_URL'];?></label>
		<input id="logouturl" name="logouturl" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['LOGOUT_URL'];?>" value="<?php echo $logouturl_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		
		<li>
		<label for="maxparticipants"><?php echo $lang['siya']['webconferencing']['MAXIMUM_PARTICIPANTS'];?></label>
		<input id="maxparticipants" name="maxparticipants" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['MAXIMUM_PARTICIPANTS'];?>" value="<?php echo $maxparticipants_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
	
		
		<li>
		<label class="label_radio" for="record"><?php echo $lang['siya']['webconferencing']['RECORD'];?></label><br />
		<input name="record" id="record-01" value="true" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" <?php  echo ($record_placeholder=='true')?'CHECKED':''; ?>/>True<br />
		<input name="record" id="record-02" value="false" type="radio" <?php  echo ($record_placeholder=='false')?'CHECKED':''; ?>/>False
		</li>

		<li>
		<label for="duration"><?php echo $lang['siya']['webconferencing']['DURATION'];?></label>
		<input id="duration" name="duration" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['DURATION'];?>" value="<?php echo $duration_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>