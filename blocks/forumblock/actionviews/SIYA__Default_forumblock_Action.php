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

global $_ACTION_VIEW_PARAMETER_ID;
$blockparameters = explode(',',$_ACTION_VIEW_PARAMETER_ID);

$blockid = (isset($blockparameters[0]))?$blockparameters[0]:'';
$blocktitle = (isset($blockparameters[1]))?$blockparameters[1]:'';


$LoggedinUserDetails = MainSystem::getUserDetailsByID(MainSystem::GetSessionUserID());
$LoggedinUserID = $LoggedinUserDetails->id;
$LoggedinUserTypeTag = $LoggedinUserDetails->usertypetag;


$subjectid = '';
$groupid = '';
$chapterid = '';
$topicid = '';
$batchid = (isset($_SESSION['batchid']))?$_SESSION['batchid']:$_SESSION['defaultbatchid'];


$controls = '';

if(_MODULE == 'stage' && _ACTION == 'showClass'){
$groupid = _ACTION_VIEW_PARAMETER_ID;
}else{
$groupid = '';
}


if(_MODULE == 'stage' && _ACTION == 'showSubject'){
$subjectid = _ACTION_VIEW_PARAMETER_ID;

$columns = array('g.id','g.grouptypetag','g.name');
$conditions = array();

$tables = array();
$tables['subjects'] = 's';
$tables['groups'] = 'g';

$conditions['=']['s.id'] = $subjectid;
$conditions['K AND =']['s.groupid'] = 'g.id';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$groupid = $sqlObj->getCleanData($resultset->id);
}
}
}

}else{
$subjectid = '';
}



if(_MODULE == 'stage' && _ACTION == 'showTopic'){
$topicid = _ACTION_VIEW_PARAMETER_ID;

$columns = array('g.id = groupid','c.id = chapterid','s.id = subjectid','s.batchid = batchid');
$conditions = array();

$tables = array();
$tables['topics'] = 't';
$tables['chapters'] = 'c';
$tables['subjects'] = 's';
$tables['groups'] = 'g';

$conditions['=']['t.id'] = $topicid;
$conditions['K AND =']['t.chapterid'] = 'c.id';
$conditions['K AND =']['c.subjectid'] = 's.id';
$conditions['K AND =']['s.groupid'] = 'g.id';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$groupid = $sqlObj->getCleanData($resultset->groupid);
$batchid = $sqlObj->getCleanData($resultset->batchid);
$subjectid = $sqlObj->getCleanData($resultset->subjectid);
$chapterid = $sqlObj->getCleanData($resultset->chapterid);

}
}
}

}



$subjectcode_placeholder = '';
$name_placeholder = '';

?>

 <div class="boxstyle0"></div>
 <div class="boxstyle1">
        <div class="boxstyle2">
		
		<?php echo $blocktitle; ?> 
		
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

		$controlsarray['inactive']['nameid'] = $blockid.'_inactive_block';
		$controlsarray['inactive']['title'] = 'Make this Block Inactive';
		$controlsarray['inactive']['style'] = 'image';
		$controlsarray['inactive']['url'] = 'blocksadministration/changeBlockStatus/0,'.$blockid.'/';

		$controlsarray['hide']['nameid'] = $blockid.'_hide_block';
		$controlsarray['hide']['title'] = 'Hide this Block';
		$controlsarray['hide']['style'] = 'image';
		$controlsarray['hide']['url'] = 'blocksadministration/hideBlock/0,'.$blockid.'/';

		$controls = MainSystem::CreateControls($controlsarray);
		
		?>
		<br />
		<?php echo $controls; ?>
		<?php
		}
		?>
		
		</div>
        <div class="boxstyle3">
		
		<?php
		if(PROJ_RUN_AJAX==1){
		$formaction2 = MainSystem::URLCreator('forums/addNewForum/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
		}else{
		$formaction2 = MainSystem::URLCreator('forums/addNewForum/');
		}
		?>

		<?php
		$returnarrayblockaddaccess = MainSystem::CheckModuleActionAccess('admin','forums','addNewForum');
		if($returnarrayblockaddaccess['noerror'] == 1){
		?>

		<form id="addforumblock" name="addforumblock" method="post" action="<?php echo $formaction2; ?>">

		<?php
		}
		?>
			<fieldset>

			<?php
			$listcount = 0;
			$columns2 = array('id','name','addedby','modifiedby');
			$conditions2 = array();
			$conditions2['=']['subjectid'] = $subjectid;
			$conditions2['AND =']['groupid'] = $groupid;
			$sqlObj = new MainSQL();
			$sql = $sqlObj->SQLCreator('S', 'forums', $columns2, $conditions2, 'added DESC', '5', '');

			if($result2 = $sqlObj->FireSQL($sql)){
			if($sqlObj->getNumRows($result2) !=0){ 
			while($resultset2 = $sqlObj->FetchResult($result2)){
			$forum_id = $sqlObj->getCleanData($resultset2->id);
			$name_placeholder = $sqlObj->getCleanData($resultset2->name);
			$addedby = $sqlObj->getCleanData($resultset2->addedby);
			$modifiedby = $sqlObj->getCleanData($resultset2->modifiedby);

			$url='forums/showForum/'.$forum_id.'/';

			?>
			
			<a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $name_placeholder; ?></a><br />
			<?php
			if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){

			$controlsarray = array();
			
			if($LoggedinUserID == $addedby || $LoggedinUserID == $modifiedby || $LoggedinUserTypeTag == '#admin' || $LoggedinUserTypeTag == '#subadmin'){ // if the loogedin User is the Author of the data //
			
			$controlsarray['editblockcontent']['nameid'] = $blockid.'_edit_blockcontent';
			$controlsarray['editblockcontent']['title'] = 'Edit';
			$controlsarray['editblockcontent']['style'] = 'image';
			$controlsarray['editblockcontent']['url'] = 'forums/editForum/'.$forum_id.'/';

			$controlsarray['deleteblockcontent']['nameid'] = $blockid.'_delete_blockcontent';
			$controlsarray['deleteblockcontent']['title'] = 'Delete';
			$controlsarray['deleteblockcontent']['style'] = 'image';
			$controlsarray['deleteblockcontent']['url'] = 'forums/deleteForum/'.$forum_id.'/';
			
			}


			if($LoggedinUserTypeTag == '#admin' || $LoggedinUserTypeTag == '#subadmin'){ 

			if($listcount!=0){
			$controlsarray['moveupblockcontent']['nameid'] = $blockid.'_moveup_blockcontent';
			$controlsarray['moveupblockcontent']['title'] = 'Move Up';
			$controlsarray['moveupblockcontent']['style'] = 'image';
			$controlsarray['moveupblockcontent']['url'] = 'forum/changeForumOrder/up,'.$blockid.'/';
			}

			if($listcount!=4){
			$controlsarray['movedownblockcontent']['nameid'] = $blockid.'_movedown_blockcontent';
			$controlsarray['movedownblockcontent']['title'] = 'Move Down';
			$controlsarray['movedownblockcontent']['style'] = 'image';
			$controlsarray['movedownblockcontent']['url'] = 'forum/changeForumOrder/down,'.$blockid.'/';
			}

			}


			$controls = MainSystem::CreateControls($controlsarray);
			}
			?>

			<?php
			echo $controls;	
			?>
			<br />
			<?php
			$listcount++;
			}
			}else{
			echo 'No Record';
			}
			}else{
			trigger_error('Data Fetch Error');
			}		
			?>


			<ol>
				
			<input type="hidden" name="subjectid" value="<?php echo $subjectid; ?>" />
			<input type="hidden" name="groupid" value="<?php echo $groupid; ?>" />
			<input type="hidden" name="batchid" value="<?php echo $batchid; ?>" />
			<input type="hidden" name="chapterid" value="<?php echo $chapterid; ?>" />
			<input type="hidden" name="topicid" value="<?php echo $topicid; ?>" />

			</ol>
			
			</fieldset>
			
			<fieldset>

			<?php
			if($returnarrayblockaddaccess['noerror'] == 1){
			?>

			<button type="submit">Add Forums</button>
			
			<?php
			}
			?>

			</fieldset>

		</form>	
		
		</div>
        <div style="clear: both;"></div>
 </div>