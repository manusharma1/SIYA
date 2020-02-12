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

global $_ACTION_VIEW_PARAMETER_ID;
$blockparameters = explode(',',$_ACTION_VIEW_PARAMETER_ID);

$blockid = (isset($blockparameters[0]))?$blockparameters[0]:'';
$blocktitle = (isset($blockparameters[1]))?$blockparameters[1]:'';
?>

<script>
$(document).ready(function(){
$("#login").validate();
});
</script>

 <div class="boxstyle0"></div>
 <div class="boxstyle1">
	<div class="boxstyle2">
	
		<?php echo $blocktitle; ?> 

		<?php
		if(PROJ_RUN_AJAX==1){
		$formaction2 = MainSystem::URLCreator('admin/loginCheck/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
		}else{
		$formaction2 = MainSystem::URLCreator('admin/loginCheck/');
		}
		?>

		<form id="login" name="login" method="post" action="<?php echo $formaction2; ?>">

			<fieldset>
				<ol>
				<li><label for="username">Username </label>
				<input type="text" name="username" id="username" size="5" <?php echo _FORM_FINAL; ?>/></li>

				<li><label for="password">Password</label>
				<input type="password" name="password" id="password" size="5" <?php echo _FORM_FINAL; ?>/></li>
				</ol>
			</fieldset>



			<input type="hidden" name="LoginForm" value="1" />

			
			
			<fieldset>

			<button type="submit" name="Submit" value="Login">Login</button>

			</fieldset>


		<div align="center"><br /><a href="<?php echo MainSystem::URLCreator('users/addNewRegistrationStudentFront/'); ?>">Student Registration</a><br />
		<a href="<?php echo MainSystem::URLCreator('users/addNewRegistrationTeacherFront/'); ?>">Teacher Registration</a></div>

		</form>

		</div>
        <div style="clear: both;"></div>
 </div>