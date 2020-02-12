<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT  - DO NOT REMOVE THIS NOTICE                      //
//                                                                       //
// OPENTADKA FRAMEWORK											         //
//          http://www.opentadka.org                                     //
//                                                                       //
// Copyright (C) 2010 onwards  Manu Sharma  http://www.opentadka.org     //
//                                                                       //
// STUDENT INFORMATION YARN (SIYA)								         //
//          http://www.siya.org.in                                       //
//                                                                       //
// Copyright (C) 2012 onwards  Manu Sharma  http://www.siya.org.in       //
//                                                                       //
// OPENTADKA FRAMEWORK LICENSE :                                         //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
// STUDENT INFORMATION YARN (SIYA) LICENSE :                             //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//   OPENTADKA FRAMEWORK & STUDENT INFORMATION YARN (SIYA)               //
//   FOR LICENCESPLEASE REFER LICENCE PAGE                               //
//   FOR MORE DETAILS                                                    //
//                                                                       //
///////////////////////////////////////////////////////////////////////////


$id = _ACTION_VIEW_PARAMETER_ID;
// Include PHPBBB API
// This ACTIONVIEW USES PHPBBB API
// PHPBBB API : Copyright 2010 Blindside Networks

/* _____ PHP Big Blue Button API Usage ______
* by Peter Mentzer peter@petermentzerdesign.com
*/
MainSystem::CheckIDExists('webconferencing','id',$id,'admin/getAdminHome/');
require_once(PROJ_3RDPARTY_DIR._S.'phpbbb'._S.'bbb-api.php');
?>

<h3 class="headingh3">Web Conferencing Detail</h3>

	<?php
	$columns = array('id','description','name','meetingid','meetingname','attendeepw','moderatorpw','welcomemsg','dialnumber','voicebridge','webvoice','logouturl','maxparticipants','record','duration','isactive','added','addedby','modified','modifiedby');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'webconferencing', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$id = $sqlObj->getCleanData($resultset->id);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	$description_placeholder = $sqlObj->getCleanData($resultset->description);
	$url='webconferencing/showWebConferencing/'.$id.'/';
	?>
	
	<br /><p class="button blue"><?php echo $name_placeholder; ?></p>
										
	<?php
	if($resultset->isactive){
	$bbb = new BigBlueButton();
	$creationParams = array(
	'meetingId' => $resultset->meetingid,			// REQUIRED
	'meetingName' => $resultset->meetingname,	// REQUIRED
	'attendeePw' => $resultset->attendeepw,		// Match this value in getJoinMeetingURL() to join as attendee.
	'moderatorPw' => $resultset->moderatorpw,		// Match this value in getJoinMeetingURL() to join as moderator.
	'welcomeMsg' => $resultset->welcomemsg,		// ''= use default. Change to customize.
	'dialNumber' => $resultset->dialnumber,		// The main number to call into. Optional.
	'voiceBridge' => $resultset->voicebridge,		// PIN to join voice. Optional.
	'webVoice' => $resultset->webvoice,		// Alphanumeric to join voice. Optional.
	'logoutUrl' => $resultset->logouturl,		// Default in bigbluebutton.properties. Optional.
	'maxParticipants' => $resultset->maxparticipants,	// Optional. -1 = unlimitted. Not supported in BBB. [number]
	'record' => $resultset->record,		// New. 'true' will tell BBB to record the meeting.
	'duration' => $resultset->duration,		// Default = 0 which means no set duration in minutes. [number]
	//'meta_category' => '',	// Use to pass additional info to BBB server. See API docs.
	);
	
	$bbbresult = $bbb->createMeetingWithXmlResponseArray($creationParams);
	}else{
	echo 'This Meeting is Inactive';
	die;
	}
	
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>

	<?php 
	if($bbbresult['returncode']=='SUCCESS'){
	?>
	<br /><br /><br /><br /><p><a class="button orange large" href="<?php echo MainSystem::URLCreator('webconferencing/showWebConferencingWindowModerator/'.$id.'/?USE_TEMPLATE=blanktemplate'); ?>" target="_blank">Join Web Conferencing [ MODERATOR]</a></p>
	<br /><br /><br /><a class="button green large" href="<?php echo MainSystem::URLCreator('webconferencing/showWebConferencingWindow/'.$id.'/?USE_TEMPLATE=blanktemplate'); ?>" target="_blank">Join Web Conferencing [NORMAL USER]</a></p>
	<?php
	}
	?>