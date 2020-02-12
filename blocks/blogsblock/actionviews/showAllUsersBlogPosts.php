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
if(_MODULE == '' && _ACTION == ''){
?>


<div class="clear"></div>

<br /><br />
<h1>Users Blogs</h1><br /><br />
<?php
$columns = array('id','title','data','datamore','added','addedby');
$conditions = array();
$conditions['=']['type'] = 'POST';
$conditions['AND =']['visibility'] = 'ALL';
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
$added = $sqlObj->getCleanData($resultset->added);
$addedby = $sqlObj->getCleanData($resultset->addedby);
$url='blogs/getBlogContent/'.$id.',more/';
?>
<h1 class="blogtitleclass"><?php echo $title; ?> </h1>
<hr/> 
<div id="blogpclass" class="blogpclass"><?php echo $data; ?></div>
<br /><p class="authorclass"> Posted By: 
<?php
$userDetails = MainSystem::getUserDetailsByID($addedby);
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
