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
<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/jquery-1.10.2.js"></script>
<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/ui/jquery-ui-1.10.3.js"></script>

<script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>pdfobject.js"></script>
<script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>swfobject.js"></script>


<?php
if(!isset($_SESSION['controllers']['SELECTEDTHEME']) || $_SESSION['controllers']['SELECTEDTHEME']==''){
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

<!-- Admin Menu -->
<link href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>dcaccordion.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>dcdrilldownskins/blue.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>dcdrilldownskins/graphite.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>dcdrilldownskins/grey.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.cookie.js'></script>
<script type='text/javascript' src='<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.dcjqaccordion.2.7.min.js'></script>

<!-- Admin Menu --> 


<!-- Tooltip -->
<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.cluetip.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>jquery.cluetip.css" />
<!-- Tooltip -->

<!-- Menu -->
<script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.easing-sooper.js"></script>
<script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.sooperfish.js"></script>
<!-- Menu -->


<!-- JQuery Date Picker -->
<link rel="stylesheet" href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>jquery/jquery.ui.all.css">
<!-- <link href="<?php echo _TEMPLATE_CSS_DIR._WS ;?>jquery/themes/ui-darkness/jquery-ui.css" rel="stylesheet" type="text/css" />
 -->
 
 
<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/ui/jquery.ui.core.js"></script>
<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/ui/jquery.ui.widget.js"></script>


<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/ui/jquery-ui-sliderAccess.js"></script>

<!-- JQuery Date Picker -->

<script src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery/ui/jquery-ui-timepicker-addon.js"></script>


<?php MainSystem::IncludeMainJSFunctions(); ?>
<?php MainSystem::IncludeMainAjaxFunctions(); ?>
<?php MainSystem::IncludeModulesCSS(); ?>
<?php MainSystem::IncludeBlocksCSS(); ?>

<?php MainSystem::IncludeModulesJS(); ?>
<?php MainSystem::IncludeBlocksJS(); ?>



<script type="text/javascript">
$(function() {
$('#sticky').cluetip({sticky: true, closePosition: 'title', arrows: true});
});
</script>

</head>
<body>

<?php
//echo $lang['siya']['entities']['ADD_NEW_ENTITY'];
?>

<?php
if($_SESSION['controllers']['SCREENGRID'] == '960'){
?>
<!-- start .container_16 -->

<div class="container_16" id="container_16">
<div class="grid_16">
<?php echo $maincontrollersblock_placeholder; ?>
</div>
<div class="clear"></div>

  <?php
  if(!$HIDE_TEMPLATE_HEADER_PART){
  ?>

  <div class="grid_16">


	<div>
	<h1 class="logoclass">
	<span class="logotext"></span> <br />
    <span class="logotext2"></span></h1>
	</div>
  
		<?php echo $header_blocks_placeholder; ?>
		<br /><br /><br />

		<?php echo $opentadka_header_navigation_placeholder; ?>
		<br />
		<br />

  </div>

  <div class="clear"></div>

	<?php
	 }
	?>


	<?php
	if(!$HIDE_TEMPLATE_LEFT_PART){
	?>
  
  <div class="grid_4">

	<?php echo $left_blocks_placeholder; ?>

  </div>

	<?php
	}
	?>

	<div class="<?php echo $middle_div_class; ?>">

	<?php
	if(!$HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART){
	?>

	<?php echo $beforemiddlecontent_blocks_placeholder; ?>

	<?php
	}
	?>

		<?php echo $session_message_placeholder; ?>
		<?php echo $login_box_placeholder; ?>
		<div id="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>">


		<?php
		if($secondcolumntrue==1){
		?>
		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content_placeholder; ?>
		<?php
		if($main_contentmore_url_placeholder !=''){
		?>
		<br /><a href="<?php echo $main_contentmore_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content2_placeholder; ?>
		
		<?php
		if($main_content2more_url_placeholder !=''){
		?>
		<br /><a href="<?php echo $main_content2more_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<?php
		}else{
		?>
		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content_placeholder; ?>
		<?php
		if($main_contentmore_url_placeholder !='' && $moreid ==''){
		?>
		<br /><a href="<?php echo $main_contentmore_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content2_placeholder; ?>
		
		<?php
		if($main_content2more_url_placeholder !='' && $moreid ==''){
		?>
		<br /><a href="<?php echo $main_content2more_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<?php 
		if($moreid == 'm1'){
		echo $main_contentmore_placeholder;
		?>
		<br /><a href="<?php echo $main_contentmore_back_url_placeholder; ?>"class="button small" >Back</a>
		<?php
		}
		?>
		<?php 
		if($moreid == 'm2'){
		echo $main_content2more_placeholder;
		?>
		<br /><a href="<?php echo $main_content2more_back_url_placeholder; ?>"class="button small" >Back</a>
		<?php
		}
		?>

		<?php
		}
		?>


		</div>
		<br />
		<br />
		<br />


	<?php
	if(!$HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART){
	?>

	<?php echo $aftermiddlecontent_blocks_placeholder; ?>

	<?php
	}
	?>

	</div>


	<?php
	if(!$HIDE_TEMPLATE_RIGHT_PART){
	?>
	  <div class="grid_4">
		<?php echo $right_blocks_placeholder; ?>
	  </div>

	<?php
	}
	?>

  <div class="clear"></div>

	<?php
	if(!$HIDE_TEMPLATE_FOOTER_PART){
	?>
  <div class="grid_16">
  <br /><br />
   <?php echo $opentadka_footer_navigation_placeholder; ?>

  </div>
  <?php
	}
  ?>

</div>
<!-- end .container_16 -->

<?php
}else if($_SESSION['controllers']['SCREENGRID'] == '1200'){
?>


<!-- start .container_15 -->

<div class="container_15" id="container_15">
<div class="grid_15">
<?php echo $maincontrollersblock_placeholder; ?>
</div>
<div class="clear"></div>

  <?php
  if(!$HIDE_TEMPLATE_HEADER_PART){
  ?>

  <div class="grid_15">


	<div>
	<h1 class="logoclass">
	<span class="logotext"></span> <br />
    <span class="logotext2"></span></h1>
	</div>
  
		<?php echo $header_blocks_placeholder; ?>
		<br /><br /><br />

		<?php echo $opentadka_header_navigation_placeholder; ?>
		<br />
		<br />

  </div>

  <div class="clear"></div>

	<?php
	 }
	?>


	<?php
	if(!$HIDE_TEMPLATE_LEFT_PART){
	?>
  
  <div class="grid_3">

	<?php echo $left_blocks_placeholder; ?>

  </div>

	<?php
	}
	?>

	<div class="<?php echo $middle_div_class; ?>">

	<?php
	if(!$HIDE_TEMPLATE_BEFOREMIDDLECONTENT_PART){
	?>

	<?php echo $beforemiddlecontent_blocks_placeholder; ?>

	<?php
	}
	?>

		<?php echo $session_message_placeholder; ?>
		<?php echo $login_box_placeholder; ?>
		<div id="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>">

<?php
		if($secondcolumntrue==1){
		?>
		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content_placeholder; ?>
		<?php
		if($main_contentmore_url_placeholder !=''){
		?>
		<br /><a href="<?php echo $main_contentmore_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content2_placeholder; ?>
		
		<?php
		if($main_content2more_url_placeholder !=''){
		?>
		<br /><a href="<?php echo $main_content2more_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<?php
		}else{
		?>
		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content_placeholder; ?>
		<?php
		if($main_contentmore_url_placeholder !='' && $moreid ==''){
		?>
		<br /><a href="<?php echo $main_contentmore_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<div class="<?php echo $middle_div_2_columns_class; ?>">
		<?php echo $main_content2_placeholder; ?>
		
		<?php
		if($main_content2more_url_placeholder !='' && $moreid ==''){
		?>
		<br /><a href="<?php echo $main_content2more_url_placeholder; ?>"class="button small" >Read More</a>
		<?php
		}
		?>
		</div>

		<?php 
		if($moreid == 'm1'){
		echo $main_contentmore_placeholder;
		?>
		<br /><a href="<?php echo $main_contentmore_back_url_placeholder; ?>"class="button small" >Back</a>
		<?php
		}
		?>
		<?php 
		if($moreid == 'm2'){
		echo $main_content2more_placeholder;
		?>
		<br /><a href="<?php echo $main_content2more_back_url_placeholder; ?>"class="button small" >Back</a>
		<?php
		}
		?>

		<?php
		}
		?>
		
		
		</div>
		<br />
		<br />
		<br />


	<?php
	if(!$HIDE_TEMPLATE_AFTERMIDDLECONTENT_PART){
	?>

	<?php echo $aftermiddlecontent_blocks_placeholder; ?>

	<?php
	}
	?>

	</div>


	<?php
	if(!$HIDE_TEMPLATE_RIGHT_PART){
	?>
	  <div class="grid_3">
		<?php echo $right_blocks_placeholder; ?>
	  </div>

	<?php
	}
	?>

  <div class="clear"></div>

	<?php
	if(!$HIDE_TEMPLATE_FOOTER_PART){
	?>
  <div class="grid_15">
  <br /><br />
   <?php echo $opentadka_footer_navigation_placeholder; ?>

  </div>
  <?php
	}
  ?>

</div>
<!-- end .container_15 -->


<?php
}
?>
</body>
</html>