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
if(_ACTION=='getAdminHome'){

$userid = MainSystem::GetSessionUserID();

global $_ACTION_VIEW_PARAMETER_ID;
$blockparameters = explode(',',$_ACTION_VIEW_PARAMETER_ID);

$blockid = (isset($blockparameters[0]))?$blockparameters[0]:'';
$blocktitle = (isset($blockparameters[1]))?$blockparameters[1]:'';

$listcount = 0;

$columns = array('id','title','data','datamore');
$conditions = array();
$conditions['=']['userid'] = $userid;
$conditions['AND =']['pid'] = 0;
$conditions['AND =']['type'] = 'POST';
$conditions['AND =']['isactive'] = 1;

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, 'added DESC', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
while($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$title = $sqlObj->getCleanData($resultset->title);
$data = $sqlObj->getCleanData($resultset->data);
$datamore = $sqlObj->getCleanData($resultset->datamore);
$url='blogs/getBlogContent/'.$id.',more/';
?>

<?php
if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){

$controlsarray = array();
$controlsarray['editblockcontent']['nameid'] = $blockid.'_edit_blockcontent';
$controlsarray['editblockcontent']['title'] = 'Edit';
$controlsarray['editblockcontent']['style'] = 'image';
$controlsarray['editblockcontent']['url'] = 'blogs/editBlog/'.$id.'/';

$controlsarray['deleteblockcontent']['nameid'] = $blockid.'_delete_blockcontent';
$controlsarray['deleteblockcontent']['title'] = 'Delete';
$controlsarray['deleteblockcontent']['style'] = 'image';
$controlsarray['deleteblockcontent']['url'] = 'blogs/deleteBlog/'.$id.'/';

if($listcount!=0){
$controlsarray['moveupblockcontent']['nameid'] = $blockid.'_moveup_blockcontent';
$controlsarray['moveupblockcontent']['title'] = 'Move Up';
$controlsarray['moveupblockcontent']['style'] = 'image';
$controlsarray['moveupblockcontent']['url'] = 'blogs/changeBlogOrder/up,'.$blockid.'/';
}

if($listcount!=5){
$controlsarray['movedownblockcontent']['nameid'] = $blockid.'_movedown_blockcontent';
$controlsarray['movedownblockcontent']['title'] = 'Move Down';
$controlsarray['movedownblockcontent']['style'] = 'image';
$controlsarray['movedownblockcontent']['url'] = 'blogs/changeBlogOrder/down,'.$blockid.'/';
}

$controls = MainSystem::CreateControls($controlsarray);

echo $controls;

}
?>


<h1 class="blogtitleclass"><?php echo $title; ?> </h1>
<hr/> 
<div id="blogpclass" class="blogpclass"><?php echo $data; ?></div>
<br /><p class="authorclass"> Posted By: 
<?php 
$userDetails = MainSystem::getUserDetailsByID($userid);
echo $autherName = $userDetails->fname.' '.$userDetails->mname.' '.$userDetails->lname;
if($datamore != ''){
?>
</p>
	<a href="<?php echo MainSystem::URLCreator($url); ?>" class="button small">Read More</a>
<?php
}
?>
<br /><br /><br />
<?php
}
}
}

}
?>