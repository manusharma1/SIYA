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

if(MainSystem::IsAdminLogged()){

global $_ACTION_VIEW_PARAMETER_ID;
$blockparameters = explode(',',$_ACTION_VIEW_PARAMETER_ID);

$blockid = (isset($blockparameters[0]))?$blockparameters[0]:'';
$blocktitle = (isset($blockparameters[1]))?$blockparameters[1]:'';
$userid = MainSystem::GetSessionUserID();
?>

 <div class="loggedinuserdiv">
 <div class="">	
		<?php
		if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
		
		$controlsarray = array();		
		$controlsarray['editblock']['nameid'] = $blockid.'_edit_block';
		$controlsarray['editblock']['title'] = 'Edit This Block';
		$controlsarray['editblock']['style'] = 'image';
		$controlsarray['editblock']['url'] = 'blocksadministration/editBlocks/'.$blockid.'/';

		$controlsarray['deleteblock']['nameid'] = $blockid.'_delete_block';
		$controlsarray['deleteblock']['title'] = 'Delete This Block';
		$controlsarray['deleteblock']['style'] = 'image';
		$controlsarray['deleteblock']['url'] = 'blocksadministration/deleteBlock/'.$blockid.'/';

		$controlsarray['moveleftblock']['nameid'] = $blockid.'_moveleft_block';
		$controlsarray['moveleftblock']['title'] = 'Move This Block Left';
		$controlsarray['moveleftblock']['style'] = 'image';
		$controlsarray['moveleftblock']['url'] = 'blocksadministration/moveBlocks/left,'.$blockid.'/';

		$controlsarray['moverightblock']['nameid'] = $blockid.'_moveright_block';
		$controlsarray['moverightblock']['title'] = 'Move This Block Right';
		$controlsarray['moverightblock']['style'] = 'image';
		$controlsarray['moverightblock']['url'] = 'blocksadministration/moveBlocks/right,'.$blockid.'/';

		$controlsarray['moveupblock']['nameid'] = $blockid.'_moveup_block';
		$controlsarray['moveupblock']['title'] = 'Move This Block Up';
		$controlsarray['moveupblock']['style'] = 'image';
		$controlsarray['moveupblock']['url'] = 'blocksadministration/moveBlocks/up,'.$blockid.'/';

		$controlsarray['movedownblock']['nameid'] = $blockid.'_movedown_block';
		$controlsarray['movedownblock']['title'] = 'Move This Block Down';
		$controlsarray['movedownblock']['style'] = 'image';
		$controlsarray['movedownblock']['url'] = 'blocksadministration/moveBlocks/down,'.$blockid.'/';

		$controlsarray['moveheaderblock']['nameid'] = $blockid.'_moveheader_block';
		$controlsarray['moveheaderblock']['title'] = 'Move This Block To Header';
		$controlsarray['moveheaderblock']['style'] = 'image';
		$controlsarray['moveheaderblock']['url'] = 'blocksadministration/moveBlocks/header,'.$blockid.'/';

		$controlsarray['movefooterblock']['nameid'] = $blockid.'_movefooter_block';
		$controlsarray['movefooterblock']['title'] = 'Move This Block To Footer';
		$controlsarray['movefooterblock']['style'] = 'image';
		$controlsarray['movefooterblock']['url'] = 'blocksadministration/moveBlocks/footer,'.$blockid.'/';

		$controlsarray['movefooterblock']['nameid'] = $blockid.'_movefooter_block';
		$controlsarray['movefooterblock']['title'] = 'Move This Block To Footer';
		$controlsarray['movefooterblock']['style'] = 'image';
		$controlsarray['movefooterblock']['url'] = 'blocksadministration/moveBlocks/footer,'.$blockid.'/';

		$controlsarray['movebeforemiddlecontentblock']['nameid'] = $blockid.'_beforemiddlecontent_block';
		$controlsarray['movebeforemiddlecontentblock']['title'] = 'Move This Block Before Middle Content';
		$controlsarray['movebeforemiddlecontentblock']['style'] = 'image';
		$controlsarray['movebeforemiddlecontentblock']['url'] = 'blocksadministration/moveBlocks/beforemiddlecontent,'.$blockid.'/';

		$controlsarray['moveaftermiddlecontentblock']['nameid'] = $blockid.'_aftermiddlecontent_block';
		$controlsarray['moveaftermiddlecontentblock']['title'] = 'Move This Block After Middle Content';
		$controlsarray['moveaftermiddlecontentblock']['style'] = 'image';
		$controlsarray['moveaftermiddlecontentblock']['url'] = 'blocksadministration/moveBlocks/aftermiddlecontent,'.$blockid.'/';

		$controls = MainSystem::CreateControls($controlsarray);
		
		?>

		<br />
		<?php echo $controls; ?>
		<?php
		}
		?>
		
        <div class="boxstyle3">
			<?php
			$columns = array('id','fname','mname','lname','entitytypetag','usertypetag');
			$sqlObj = new MainSQL();
			$conditions = array();
			$conditions['=']['id'] = $userid;

			$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
			if($result = $sqlObj->FireSQL($sql)){
			if($sqlObj->getNumRows($result) !=0){
			if($resultset = $sqlObj->FetchResult($result)){
			$id = $sqlObj->getCleanData($resultset->id);
			$entitytypetag = $sqlObj->getCleanData($resultset->entitytypetag);	
			$fname = $sqlObj->getCleanData($resultset->fname);	
			$mname = $sqlObj->getCleanData($resultset->mname);	
			$lname = $sqlObj->getCleanData($resultset->lname);
			$entitytypetag = $sqlObj->getCleanData($resultset->entitytypetag);
			$usertypetag = $sqlObj->getCleanData($resultset->usertypetag);

			if($entitytypetag == '@admin'){
			$profileurl = MainSystem::URLCreator('users/editAdminRegistration/'.$id.'/');
			}else if($entitytypetag == '@teacher'){
			$profileurl = MainSystem::URLCreator('users/editStaffRegistration/'.$id.'/');
			}else if($entitytypetag == '@parent'){
			$profileurl = MainSystem::URLCreator('users/editParentRegistration/'.$id.'/');
			}else if($entitytypetag == '@student'){
			$profileurl = MainSystem::URLCreator('users/editStudentRegistration/'.$id.'/');
			}else{
			$profileurl = '#';
			}
			?>
			<div class="clear"></div>

			<div class="<?php echo ($_SESSION['controllers']['SCREENGRID'] == '960')?'container_16':'container_15';?>">
			<div class="<?php echo ($_SESSION['controllers']['SCREENGRID'] == '960')?'grid_4':'grid_3';?>">
			<b><?php echo strtoupper($fname.' '.$mname.' '.$lname); ?></b>
			<p><img src="<?php echo MainSystem::URLCreator('users/showUserImageByID/'.$userid.',1/'); ?>" width="100px" height="100px" align="left"/>
			<a href="<?php echo $profileurl; ?>" class="buttonsfortopiccontents">edit profile</a></p>

			</div>
			<div class="<?php echo ($_SESSION['controllers']['SCREENGRID'] == '960')?'grid_4':'grid_3';?>">
			<a href="#" class="buttonslarge"><?php echo $entitytypetag; ?></a><br />
			<a href="#" class="buttonslarge"><?php echo $usertypetag; ?></a>
			<?php
			$columns = array('id','batchcode','title');
			$conditions = array();
			$conditions['=']['issystemdefault'] = '1';

			$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

			if($result = $sqlObj->FireSQL($sql)){
			if($sqlObj->getNumRows($result) !=0){ 
			if($resultset = $sqlObj->FetchResult($result)){
			$system_batch_details = $sqlObj->getCleanData($resultset->title).' ['.$sqlObj->getCleanData($resultset->batchcode).']';
			?>

			<br /><a href="#" class="buttonslargegreen"><?php echo $system_batch_details; ?></a>

			<?php
			}
			}
			}
			?>

			<?php
			$batchid = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
			$columns = array('id','batchcode','title');
			$conditions = array();
			$conditions['=']['id'] = $batchid;

			$sql = $sqlObj->SQLCreator('S', 'batches', $columns, $conditions, '', '', '');

			if($result = $sqlObj->FireSQL($sql)){
			if($sqlObj->getNumRows($result) !=0){ 
			if($resultset = $sqlObj->FetchResult($result)){
			$system_batch_details = $sqlObj->getCleanData($resultset->title).' ['.$sqlObj->getCleanData($resultset->batchcode).']';
			?>

			<br /><a href="#" class="buttonslargeyellow"><?php echo $system_batch_details; ?></a>

			<?php
			}
			}
			}
			?>


			</div>
			<div class="<?php echo ($_SESSION['controllers']['SCREENGRID'] == '960')?'grid_4':'grid_3';?>">
			<a href="<?php echo MainSystem::URLCreator('stage/showCampus/')?>" class="buttonslarge">Campus</a><br />
			<?php
			if($entitytypetag=='@student'){
			?>
			<a href="<?php echo MainSystem::URLCreator('users/showTeachersbyUser/'); ?>" class="buttonslarge">Teachers</a><br />
			<a href="<?php echo MainSystem::URLCreator('users/showParentsbyUser/'); ?>" class="buttonslarge">Parents</a>
			<?php
			}
			?>
			</div>
			<div class="<?php echo ($_SESSION['controllers']['SCREENGRID'] == '960')?'grid_4':'grid_3';?>">
			<?php

			$selected_batch_id = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];
			$columns = array('g.grouptypetag','b.batchcode','g.id = usergroupid','ug.rollno');

			$tables = array();
			$tables['groups'] = 'g';
			$tables['batches'] = 'b';
			$tables['usersingroup'] = 'ug';

			$conditions = array();
			$conditions['=']['ug.userid'] = $id;
			$conditions['AND =']['ug.batchid'] = $selected_batch_id;
			$conditions['K AND =']['b.id'] = 'ug.batchid';
			$conditions['K AND =']['g.id'] = 'ug.groupid';

			$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
		
			if($result = $sqlObj->FireSQL($sql)){
			if($sqlObj->getNumRows($result) !=0){
			while($resultset = $sqlObj->FetchResult($result)){
			$memberof = $sqlObj->getCleanData($resultset->grouptypetag).' ['.$sqlObj->getCleanData($resultset->batchcode).'] RollNo - '.$sqlObj->getCleanData($resultset->rollno);
			?>
			<a href="<?php echo MainSystem::URLCreator('stage/showClass/'.$resultset->usergroupid.'/'); ?>" class="buttonsforgroups"><?php echo $memberof; ?></a><br />
			<?php
			}
			}
			}
			?>
			</div>
			</div>
			<div class="clear"></div>

			<?php
			}
			}
			}else{
			trigger_error('Data Fetch Error');
			}		
			?>


		
		</div>
 </div>
 </div>

<div style="clear: both;"></div>

<?php
}
?>