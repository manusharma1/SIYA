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
	
	<p><?php echo $name_placeholder; ?></p>
										
	<?php
	if($resultset->isactive){

	$loggedinuserdetails = MainSystem::getLoggedinUserDetails();

	// Instatiate the BBB class:
	$bbb = new BigBlueButton();

	/* ___________ JOIN MEETING w/ OPTIONS ______ */
	/* Determine the meeting to join via meetingId and join it.
	*/

	$joinParams = array(
	'meetingId' => $resultset->meetingid, 				// REQUIRED - We have to know which meeting to join.
	'username' => $loggedinuserdetails->fname.' '.$loggedinuserdetails->mname.' '.$loggedinuserdetails->lname,		// REQUIRED - The user display name that will show in the BBB meeting.
	'password' => $resultset->attendeepw,					// REQUIRED - Must match either attendee or moderator pass for meeting.
	'createTime' => '',					// OPTIONAL - string
	'userId' => $loggedinuserdetails->id,						// OPTIONAL - string
	'webVoiceConf' => ''				// OPTIONAL - string
	);

	// Get the URL to join meeting:
	$itsAllGood = true;
	try {$bbbresult = $bbb->getJoinMeetingURL($joinParams);}
	catch (Exception $e) {
	echo '<p class="button red">Caught exception: ', $e->getMessage(), "</p>\n";
	$itsAllGood = false;
	}

	if ($itsAllGood == true) {
	?>
	<p><a class="button green large" href="<?php echo $bbbresult;?>">Click Here to Join</a></p>
	<?php
	}

	}else{
	echo '<p class="button red">This Meeting is Inactive</p>';
	die;
	}
	
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>

