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
////////////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $title_placeholder;?></title>

<meta name="description" content="<?php echo $meta_description_placeholder;?>" />
<meta name="keywords" content="<?php echo $meta_keywords_placeholder;?>" />

<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/jquery-1.7.2.js"></script>


<?php
if(!isset($SELECTEDTHEME) || $SELECTEDTHEME==''){
?>
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>style.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>blocks.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>forms.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>tables.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>buttons.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>cmsmenu.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>blogmenu.css" />
<?php
}else{
?>
<link rel="stylesheet" href="<?php echo _TEMPLATE_THEMES_DIR._WS.$_SESSION['controllers']['SELECTEDTHEME']._WS.'css'._WS; ?>style.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_THEMES_DIR._WS.$_SESSION['controllers']['SELECTEDTHEME']._WS.'css'._WS; ?>blocks.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_THEMES_DIR._WS.$_SESSION['controllers']['SELECTEDTHEME']._WS.'css'._WS; ?>forms.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_THEMES_DIR._WS.$_SESSION['controllers']['SELECTEDTHEME']._WS.'css'._WS; ?>tables.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_THEMES_DIR._WS.$_SESSION['controllers']['SELECTEDTHEME']._WS.'css'._WS; ?>buttons.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_THEMES_DIR._WS.$_SESSION['controllers']['SELECTEDTHEME']._WS.'css'._WS; ?>cmsmenu.css" />
<link rel="stylesheet" href="<?php echo _TEMPLATE_THEMES_DIR._WS.$_SESSION['controllers']['SELECTEDTHEME']._WS.'css'._WS; ?>blogmenu.css" />
<?php
}
?>

<?php
if($_SESSION['controllers']['SCREENGRID'] == '960'){
?>
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>960.css" />
<?php
}else if($_SESSION['controllers']['SCREENGRID'] == '1200'){
?>
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>1200.css" />
<?php
}
?>

<?php MainSystem::IncludeMainJSFunctions(); ?>
<?php MainSystem::IncludeMainAjaxFunctions(); ?>

</head>
<body>

<?php
if($_SESSION['controllers']['SCREENGRID'] == '960'){
?>
<!-- start .container_16 -->

<div class="container_16" id="container_16">


  <?php
  if(!$HIDE_TEMPLATE_HEADER_PART){
  ?>

  <div class="grid_16">
<?php echo $maincontrollersblock_placeholder; ?>

	<div>
	<h1 class="logoclass">
	<span class="logotext"></span> <br />
    <span class="logotext2"></span></h1>
	</div>
  
  </div>

  <div class="clear"></div>

	<?php
	 }
	?>


	

		<?php echo $session_message_placeholder; ?>

		<div id="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>">
		<?php echo $main_content_placeholder; ?>
		</div>



</div>
<!-- end .container_16 -->

<?php
}else if($_SESSION['controllers']['SCREENGRID'] == '1200'){
?>


<!-- start .container_15 -->

<div class="container_15" id="container_15">


  <?php
  if(!$HIDE_TEMPLATE_HEADER_PART){
  ?>

  <div class="grid_15">
	<?php echo $maincontrollersblock_placeholder; ?>


	<div>
	<h1 class="logoclass">
	<span class="logotext"></span> <br />
    <span class="logotext2"></span></h1>
	</div>
  
  </div>

  <div class="clear"></div>

	<?php
	 }
	?>


	

		<?php echo $session_message_placeholder; ?>
		<div id="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>">
		<?php echo $main_content_placeholder; ?>

		</div>


</div>
<!-- end .container_15 -->


<?php
}
?>
</body>
</html>