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
<div class="panel">

<div class="buttons">

	<?php
	if(!isset($_SESSION['controllers']['HIDE_TEMPLATE_LEFT_PART'])){
	?>
    <button type="submit" class="positive" name="hideleftpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_LEFT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Left Panel" title="Hide Left Panels" />
        Hide Left Panels
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_LEFT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_LEFT_PART']==1){
	?>
    <button type="submit" class="positive" name="showleftpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_LEFT_PART=0';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Show Left Panels" title="Show Left Panels" />
        Show Left Panels
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_LEFT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_LEFT_PART']==0){
	?>
    <button type="submit" class="positive" name="hideleftpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_LEFT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Left Panels" title="Hide Left Panels" />
        Hide Left Panels
    </button>
	<?php
	}
	?>

	<?php // DONT HIDE HEADER Panels // ?>

	<?php
	if(!isset($_SESSION['controllers']['HIDE_TEMPLATE_RIGHT_PART'])){
	?>
    <button type="submit" class="positive" name="hiderightpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_RIGHT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Right Panels" title="Hide Right Panels" />
        Hide Right Panels
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_RIGHT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_RIGHT_PART']==1){
	?>
    <button type="submit" class="positive" name="showrightpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_RIGHT_PART=0';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Show Right Panels" title="Show Right Panels" />
        Show Right Panels
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_RIGHT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_RIGHT_PART']==0){
	?>
    <button type="submit" class="positive" name="hiderightpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_RIGHT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Right Panels" title="Hide Right Panels" />
        Hide Right Panels
    </button>
	<?php
	}
	?>

	<?php
	if(!isset($_SESSION['controllers']['HIDE_TEMPLATE_HEADER_PART'])){
	?>
    <button type="submit" class="positive" name="hideheaderpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_HEADER_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Header Panels" title="Hide Header Panels" />
        Hide Header Panels
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_HEADER_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_HEADER_PART']==1){
	?>
    <button type="submit" class="positive" name="showheaderpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_HEADER_PART=0';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Show Header Panels" title="Show Header Panels" />
        Show Header Panels
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_HEADER_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_HEADER_PART']==0){
	?>
    <button type="submit" class="positive" name="hideheaderpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_HEADER_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Header Panels" title="Hide Header Panels" />
        Hide Header Panels
    </button>
	<?php
	}
	?>


	<?php
	if(!isset($_SESSION['controllers']['HIDE_TEMPLATE_FOOTER_PART'])){
	?>
    <button type="submit" class="positive" name="hidefooterpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_FOOTER_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Footer Panels" title="Hide Footer Panels" />
        Hide Footer Panels
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_FOOTER_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_FOOTER_PART']==1){
	?>
    <button type="submit" class="positive" name="showfooterpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_FOOTER_PART=0';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Show Footer Panels" title="Show Footer Panels" />
        Show Footer Panels
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_FOOTER_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_FOOTER_PART']==0){
	?>
    <button type="submit" class="positive" name="hidefooterpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_FOOTER_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Footer Panels" title="Hide Footer Panels" />
        Hide Footer Panels
    </button>
	<?php
	}
	?>

	<br />

	<?php
	if(!isset($_SESSION['controllers']['HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART'])){
	?>
    <button type="submit" class="positive" name="hidebeforemiddlecontentpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Panels Before Middle Content" title="Hide Panels Before Middle Content" />
        Hide Panels Before Middle Content
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART']==1){
	?>
    <button type="submit" class="positive" name="showbeforemiddlecontentpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART=0';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Show Before Middle Content Panels" title="Show Before Middle Content Panels" />
        Show Before Middle Content Panels
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART']==0){
	?>
    <button type="submit" class="positive" name="hidebeforemiddlecontentpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Panels Before Middle Content" title="Hide Panels Before Middle Content" />
        Hide Panels Before Middle Content
    </button>
	<?php
	}
	?>

	<?php
	if(!isset($_SESSION['controllers']['HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART'])){
	?>
    <button type="submit" class="positive" name="hideaftermiddlecontentpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Panels After Middle Content" title="Hide Panels After Middle Content" />
        Hide Panels After Middle Content
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART']==1){
	?>
    <button type="submit" class="positive" name="showaftermiddlecontentpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART=0';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Show After Middle Content Panels" title="Show After Middle Content Panels" />
        Show After Middle Content Panels
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART']) && $_SESSION['controllers']['HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART']==0){
	?>
    <button type="submit" class="positive" name="hideaftermiddlecontentpanel" onClick="JavaScript:document.location.href='?HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART=1';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_hide_medium.png';?>" alt="Hide Panels After Middle Content" title="Hide Panels After Middle Content" />
        Hide Panels After Middle Content
    </button>
	<?php
	}
	?>


	<?php
	$returnarrayblockaddaccess = MainSystem::CheckModuleActionAccess('admin','admin','showhideControllers');
	if($returnarrayblockaddaccess['noerror'] == 1){

	$returnurl = _MODULE.','._ACTION;
	$controllerurl = 'admin/showhideControllers/'.$returnurl.'/';
	if(!isset($_SESSION['controllers']['SHOWCONTROLS'])){
	?>
    <button type="submit" class="positive" name="hidecontrols" onClick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($controllerurl); ?>';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_controls.png';?>" alt="Show Controls" title="Show Controls" />
        Show Controls
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
	?>
    <button type="submit" class="positive" name="showcontrols" onClick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($controllerurl); ?>';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_controls.png';?>" alt="Hide Controls" title="Hide Controls" />
        Hide Controls
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==0){
	?>
    <button type="submit" class="positive" name="hidecontrols" onClick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($controllerurl); ?>';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_controls.png';?>" alt="Show Controls" title="Show Controls" />
        Show Controls
    </button>
	<?php
	}

	}
	?>

<br />

	<?php
	if(!isset($_SESSION['controllers']['SCREENGRID'])){
	?>
    <button type="submit" class="positive" name="screengrid" onClick="JavaScript:document.location.href='?SCREENGRID=1200';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_screen_grid.png';?>" alt="Change to 1200 Pixels" title="Change to 1200 Pixels" />
        Change to 1200 Pixels
    </button>

	<?php
	}else if(isset($_SESSION['controllers']['SCREENGRID']) && $_SESSION['controllers']['SCREENGRID']=='960'){
	?>
    <button type="submit" class="positive" name="screengrid" onClick="JavaScript:document.location.href='?SCREENGRID=1200';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_screen_grid.png';?>" alt="Change to 1200 Pixels" title="Change to 1200 Pixels" />
        Change to 1200 Pixels
    </button>
	<?php
	}else if(isset($_SESSION['controllers']['SCREENGRID']) && $_SESSION['controllers']['SCREENGRID']=='1200'){
	?>
    <button type="submit" class="positive" name="screengrid" onClick="JavaScript:document.location.href='?SCREENGRID=960';">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_screen_grid.png';?>" alt="Change to 960 Pixels" title="Change to 960 Pixels" />
        Change to 960 Pixels
    </button>
	<?php
	}
	?>

<?php
$returnarrayblockaddaccess = MainSystem::CheckModuleActionAccess('admin','users','setBatch');
if($returnarrayblockaddaccess['noerror'] == 1){
echo controllersblock::showBatcheslist();
}
?>
<?php
echo MainSystem::CreateAllAvailableThemesSelector();
?>
</div>

</div>
 
<p class="flip">

<span style="float:left">
<button type="submit" class="positive" name="save" class="buttons">
<img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_logo_horizontal_small.png';?>" alt="STUDENT INFORMATION YARN (SIYA)" title="STUDENT INFORMATION YARN (SIYA)" />
</button>

</span>
    <button type="submit" class="positive" name="save" class="buttons">
        <img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_controllers.png';?>" alt="Controllers" title="Controllers" />
        Controllers
    </button>
</p>


<script type="text/javascript"> 
$(document).ready(function(){
$(".flip").click(function(){
    $(".panel").slideToggle("slow");
  });
});
</script>
 
<style type="text/css"> 
div.panel,p.flip
{
margin:0px;
padding:5px;
text-align:center;
background:#F5F5F5;
border:solid 1px #c3c3c3;
}
div.panel
{
height:170px;
display:none;
}

p.flip{
height:70px;
}

</style>