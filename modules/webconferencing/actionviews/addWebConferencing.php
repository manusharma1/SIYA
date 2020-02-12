<?php
$subjectid=$_POST['subjectid'];
$groupid=$_POST['groupid'];
$topicid=$_POST['topicid'];
$batchid=$_POST['batchid'];

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
$formaction = MainSystem::URLCreator('webconferencing/saveWebConferencing/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('webconferencing/saveWebConferencing/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Web Congerencing</legend>

	<ol>
			
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
		<input name="record" id="record-01" value="true" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />True<br />
		<input name="record" id="record-02" value="false" type="radio" />False</label>
		</li>

		<li>
		<label for="duration"><?php echo $lang['siya']['webconferencing']['DURATION'];?></label>
		<input id="duration" name="duration" type="text" placeholder="<?php echo $lang['siya']['webconferencing']['DURATION'];?>" value="<?php echo $duration_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
	</ol>
	<input id="groupid" name="groupid" type="hidden" value="<?php echo $groupid; ?>"/>
	<input id="batchid" name="batchid" type="hidden" value="<?php echo $batchid; ?>" /> 
	<input id="topicid" name="topicid" type="hidden" value="<?php echo $topicid; ?>" /> 
	<input id="subjectid" name="subjectid" type="hidden" value="<?php echo $subjectid; ?>" /> 

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>