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

function recursivePageMenu($parent, $levelcms) {
global $levelcms;
global $outputcms;

$count=0;
$levelcms++;


$columns = array('id','name','pid');
$conditions = array();
$conditions['=']['pid'] = $parent;
$conditions['AND =']['isactive'] = 1;

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, 'id', '', '');


	$result = $resultmenu = $sqlObj->FireSQL($sql);

	if($sqlObj->getNumRows($resultmenu)>0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$page_name = $resultsetmenu->name;
	$page_id = $resultsetmenu->id;

	$count++;
	 if ($levelcms==1){
		$outputcms .= '<li class="current"><a href="'.MainSystem::URLCreator('cms/getContent/'.$page_id.'/').'">'.$page_name.'</a>'."\n";
		}else{
		if ($count==1){
			
		$outputcms .= '<ul>'."\n";
		}
		$outputcms .='<li class="current"><a href="'.MainSystem::URLCreator('cms/getContent/'.$page_id.'/').'">'.$page_name.'</a>'."\n";
		}

		recursivePageMenu($page_id,$levelcms);
		$levelcms--;
		}
		$outputcms .= '</li>
		</ul>'."\n";
	
		return $outputcms;
	
	}

} // function recursivePageMenu

	
?>	
<div class="cmsdiv">
<ul class="cms-sf-menu" id="cmsnav">

<?php
$columns = array('id','name','pid');
$conditions = array();
$conditions['=']['menuid'] = 1;
$conditions['AND =']['pid'] = 0;
$conditions['AND =']['isactive'] = 1;

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, 'id', '', '');


if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
while($resultset = $sqlObj->FetchResult($result)){

$page_name = $resultset->name;
$page_id = $resultset->id;

$columns2 = array('id');
$conditions2 = array();
$conditions2['=']['menuid'] = 1;
$conditions2['AND =']['pid'] = $page_id;
$conditions2['AND =']['isactive'] = 1;

$sql2 = $sqlObj->SQLCreator('S', 'content', $columns2, $conditions2, 'id', '', '');

if($result2 = $sqlObj->FireSQL($sql2)){
if($sqlObj->getNumRows($result2)==0){
?>
<li class="current"><a href="<?php echo MainSystem::URLCreator('cms/getContent/'.$page_id.'/'); ?>"><?php echo $page_name; ?></a></li>
<?php
}else{
?>
<li class="current"><a href="<?php echo MainSystem::URLCreator('cms/getContent/'.$page_id.'/'); ?>"><?php echo $page_name; ?></a>
<ul>
<li>
<?php
global $outputcms;
$outputcms = '';
recursivePageMenu($page_id,0);
echo $outputcms;
}
}

}
}
}
?>
</ul>
</div>