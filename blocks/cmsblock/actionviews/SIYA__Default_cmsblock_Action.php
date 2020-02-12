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
echo 'Under Development - Yet to Come';
?>

</div>
        <div style="clear: both;"></div>
 </div>
