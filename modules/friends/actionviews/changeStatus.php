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
?>

<?php 
	$id = _ACTION_VIEW_PARAMETER_ID;
	

	$columns = array('id','friendrequesttext','status','userid','friendid');
	$conditions = array();
	$conditions['=']['id'] = $id;

	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreator('S', 'friends', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$id = $sqlObj->getCleanData($resultset->id);
	$friendrequesttext =  $sqlObj->getCleanData($resultset->friendrequesttext);
	$status =  $sqlObj->getCleanData($resultset->status);
	$userid =  $sqlObj->getCleanData($resultset->userid);
	$friendid =  $sqlObj->getCleanData($resultset->friendid);
	}
	}
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
$formaction = MainSystem::URLCreator('friends/saveFriendRequest/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('friends/saveFriendRequest/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Confirm Request</legend>

	<ol>
		
		<li>
		<label for="friendrequesttext"><b>Message</b></label><br/>
			<?php echo $friendrequesttext; ?>
		</li>
		
		<li>
		<label class="label_radio" for="status">Give Permission </label><br />
		<input name="status" id="status-02" value="ACCEPTED" type="radio" <?php  echo ($friendrequesttext=='ACCEPTED')?'CHECKED':''; ?> />Accepted<br />
		<input name="status" id="status-02" value="REJECTED" type="radio" <?php  echo ($friendrequesttext=='REJECTED')?'CHECKED':''; ?> />Rejected<br />
		<input name="status" id="status-02" value="BLOCKED" type="radio" <?php  echo ($friendrequesttext=='BLOCKED')?'CHECKED':''; ?> />Blocked<br />
		</li>

		
	</ol>
<fieldset>

<button type="submit">Confirm</button>

</fieldset>

</form>