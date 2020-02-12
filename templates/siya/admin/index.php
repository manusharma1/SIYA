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
///////////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo $title_placeholder;?></title>

<meta name="description" content="<?php echo $meta_description_placeholder;?>" />
<meta name="keywords" content="<?php echo $meta_keywords_placeholder;?>" />

 <script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.js"></script>
 <script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>yui-min.js"></script>
 <script type="text/javascript" src="<?php echo _TEMPLATE_JS_DIR._WS ;?>jquery.validate.js"></script>

<!--<script type="text/javascript" src="<?php echo PROJ_3RDPARTY_WWW_DIR._WS.'jqtransformplugin'._WS ;?>jquery.jqtransform.js"></script>
<link rel="stylesheet" href="<?php echo PROJ_3RDPARTY_WWW_DIR._WS.'jqtransformplugin'._WS ;?>jqtransform.css" type="text/css" media="all" /> -->

<!-- <link rel="stylesheet" href="<?php echo PROJ_3RDPARTY_WWW_DIR._WS.'ynf'._WS ;?>ynf.css" type="text/css" media="all" />

<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js&amp;2.7.0/build/animation/animation-min.js"></script>
<script src="<?php echo PROJ_3RDPARTY_WWW_DIR._WS.'ynf'._WS ;?>ynf.js" type="text/javascript"></script> -->

<style type="text/css">
@import url(<?php echo _TEMPLATE_CSS_DIR._WS ;?>style.css);
</style>

<?php MainSystem::IncludeMainJSFunctions(); ?>
<?php MainSystem::IncludeMainAjaxFunctions(); ?>
<?php //MainSystem::IncludeModulesCSS(); ?>
<?php //MainSystem::IncludeBlocksCSS(); ?>

<?php //MainSystem::IncludeModulesJS(); ?>
<?php //MainSystem::IncludeBlocksJS(); ?>


<!-- <script language="javascript">
	$(function(){
		$('form').jqTransform({imgPath:'jqtransformplugin/img/'});
	});
</script> -->

</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
      <tr>
        <td><table width="100%" border="0" bgcolor="#CA6262">
          <tr>
            <td width="12%" valign="top"><img src="<?php echo _TEMPLATE_IMG_DIR._WS ;?>siya_logo.gif" alt="Open Source School Information Management System" /></td>
            <td width="88%" valign="top"><table width="100%" border="0">
                <tr>
                  <td><h1 class="whitetext">STUDENT INFORMATION YARN (SIYA) <br />
                    An Open Source Student Information Management System based on OPENTADKA <sup>TM</sup> Framework</h1></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" bgcolor="#CB9865" class="whitetext">
                      <tr class="whitetext">
                        <td width="20%" bgcolor="#993333" ><div align="center"><a href="<?php echo MainSystem::URLCreator(''); ?>" class="whitetext"><span class="style4">Home</span></a></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
               </td>
          </tr>
        </table></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td>
		<?php echo $opentadka_header_navigation_placeholder; ?>
		<br>
		<br>
		<?php echo $session_message_placeholder; ?>
		<?php echo $login_box_placeholder; ?>
		<div id="<?php echo PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE; ?>"><?php echo $main_content_placeholder; ?></div>
		<br>
		<br>
		<br>
		<?php echo $opentadka_footer_navigation_placeholder; ?>
		<br>
		<br>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#000000"><table width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td valign="top" bgcolor="#993333" class="whitetext"><table width="100%" border="0">
              <tr>
                <td><h3 class="whitetextbold"><a href="http://www.open.org.in"><img src="<?php echo _TEMPLATE_IMG_DIR._WS ;?>open_org_logo_small.gif" alt="Open.Org.In" border="0" /></a></h3></td>
                <td><span class="whitetextbold">Open Source India<br />
(open.org.in)</span></td>
              </tr>
          </table></td>
          <td valign="top" bgcolor="#333333" class="whitetext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><span class="whitetextbold">Powered by OPENTADKA Framework</span><br />
Copyright &copy; 2010 onwards, Manu Sharma<br />STUDENT INFORMATION YARN (SIYA) Project Copyright &copy; 2012 onwards, Manu Sharma<br />[For Copyright and Licences, Please refer to the <a href="<?php echo MainSystem::URLCreator('cms/getContent/6/'); ?>" class="whitetext">Licence</a>]</td>
              <td><div align="right"><a href="http://www.open.org.in"><img src="<?php echo _TEMPLATE_IMG_DIR._WS ;?>opentadkalogo.gif" alt="OPENTADKA Framework" border="0" /></a></div></td>
            </tr>
          </table>          </td>
        </tr>
    </table></td>
  </tr>
</table>


</body>
</html>
