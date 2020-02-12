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

function recursiveBlogPageMenu2($parent, $levelblog) {
global $levelblog;
global $outputblog;

$count=0;
$levelblog++;


$columns = array('id','title','pid');
$conditions = array();
$conditions['=']['pid'] = $parent;
$conditions['AND =']['isactive'] = 1;
$conditions['AND =']['type'] = 'PAGE';
$conditions['AND =']['userid'] = MainSystem::GetSessionUserID();
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, 'id', '', '');


	$result = $resultmenu = $sqlObj->FireSQL($sql);

	if($sqlObj->getNumRows($resultmenu)>0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$page_title = $resultsetmenu->title;
	$page_id = $resultsetmenu->id;

	$count++;
	 if ($levelblog==1){
		$outputblog .= '<li class="current"><a href="'.MainSystem::URLCreator('blogs/getBlogContent/'.$page_id.'/').'">'.$page_title.'</a>'."\n";
		}else{
		if ($count==1){
			
		$outputblog .= '<ul>'."\n";
		}
		$outputblog .='<li class="current"><a href="'.MainSystem::URLCreator('blogs/getBlogContent/'.$page_id.'/').'">'.$page_title.'</a>'."\n";
		}

		recursiveBlogPageMenu2($page_id,$levelblog);
		$levelblog--;
		}
		$outputblog .= '</li>
		</ul>'."\n";
	
		return $outputblog;
	
	}

} // function recursivePageMenu

	
?>	
<div class="blogdiv">
<ul class="blog-sf-menu" id="blognav">

<?php
$columns = array('id','title','pid');
$conditions = array();
$conditions['=']['userid'] = MainSystem::GetSessionUserID();
$conditions['AND =']['pid'] = 0;
$conditions['AND =']['type'] = 'PAGE';
$conditions['AND =']['isactive'] = 1;

$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, 'id', '', '');


if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){
while($resultset = $sqlObj->FetchResult($result)){

$page_name = $resultset->title;
$page_id = $resultset->id;
?>
<li class="current"><a href="<?php echo MainSystem::URLCreator('blogs/getBlogContent/'.$page_id.'/'); ?>"><?php echo $page_name; ?></a></li>
<?php
}
}
}
?>
</ul>
</div>