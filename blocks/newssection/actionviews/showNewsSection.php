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
?>

<div class="indent1">
	<div class="ins">
	<span class="txt1">News</span>
		<img class="title1" alt="" src="<?php echo _TEMPLATE_IMG_DIR._WS ;?>1_t2.gif" /><br />


<?php
	// Define PlaceHolders
	$newstitle_placeholder = '';
	$newstext_placeholder = '';
	$newsdate_placeholder = '';

	// Get News Data
	$columns = array('id','newstitle','newstext','newsdate');
	$conditions = array();
	$conditions['=']['isactive'] = 1;
	$sqlObj = new MainSQL();
	$sqlnewscontents = $sqlObj->SQLCreator('S', 'news', $columns, $conditions, '', '', '');
	if($resultnewscontents = $sqlObj->FireSQL($sqlnewscontents)){
	if($sqlObj->getNumRows($resultnewscontents) !=0){ // If News Exists
	while($resultsetnewscontents = $sqlObj->FetchResult($resultnewscontents)){
	$newstitle_placeholder = $sqlObj->getCleanData($resultsetnewscontents->newstitle);
	$newstext_placeholder = $sqlObj->getCleanData($resultsetnewscontents->newstext);
	$newsdate_array = explode('-', $sqlObj->getCleanData($resultsetnewscontents->newsdate));
	$newsdate_placeholder = $newsdate_array[1].'/'.$newsdate_array[2].'/'.$newsdate_array[0];
	?>
										<div class="news_block">
											<div class="ins">
												<div class="fleft" style="width:71px; padding-top:3px;">
													&nbsp;<?php echo $newsdate_placeholder; ?><br />
											  </div>
												<div class="fleft" style="width:210px;">
													<a class="link1" href="#">
													<b><?php echo $newstitle_placeholder; ?></b>
													<?php echo $newstext_placeholder; ?>
													</a>
												</div>
												<div class="clear"></div>
											</div>
										</div>
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}

?>

  </div>
</div>