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
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//////////////////////////////////////////////////////////////////////////

function recursivePageMenu($parent, $level) {
global $level;
global $output;

$count=0;
$level++;


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
	 if ($level==1){
		$output .= '<li class="yuimenuitem"><a href="'.MainSystem::URLCreator('cms/getContent/'.$page_id.'/').'">'.$page_name.'</a>'."\n";
		}else{
		if ($count==1){
			
		$output .= '<div class="yuimenu" id="'.$page_id.'">
		  <div class="bd">
		  <ul>'."\n";
		}
		$output .='<li class="yuimenuitem"><a href="'.MainSystem::URLCreator('cms/getContent/'.$page_id.'/').'">'.$page_name.'</a>'."\n";
		}

		recursivePageMenu($page_id,$level);
		$level--;
		}
		$output .= '</li>
		</ul>
		</div>
		</div>'."\n";
	
	return $output;
	
	}

} // function recursivePageMenu

	
?>	

<div id="dropdown" class="yuimenubar yuimenubarnav">
<div class="bd">
<ul class="first-of-type">
<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="<?php echo MainSystem::URLCreator(''); ?>">HOME<br />PAGE</a></li>
<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="<?php echo MainSystem::URLCreator('cms/getContent/2/'); ?>">OPEN<br />OFFICES</a>

<div class="yuimenu">
<div class="bd">
<ul>

<?php		
recursivePageMenu(2,0);
global $output;
echo $output;	
?>

<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="<?php echo MainSystem::URLCreator('cms/getContent/3/'); ?>">VOTING<br />TIME TABLE</a></li>
<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="<?php echo MainSystem::URLCreator('cms/getContent/4/'); ?>">POLLING<br />LOCATIONS</a></li>
<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="<?php echo MainSystem::URLCreator('cms/getContent/5/'); ?>">OUR<br />VOTING</a></li>
<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="<?php echo MainSystem::URLCreator('cms/getContent/6/'); ?>">ABOUT<br />US</a></li>
<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="<?php echo MainSystem::URLCreator('cms/getContent/7/'); ?>">CONTACT<br />US</a></li>

</ul>
</div>
</div>
		