<script>
	$(function() {
		$( "#dob" ).datepicker({dateFormat:'yy-mm-dd'});
		$( "#pdob" ).datepicker({dateFormat:'yy-mm-dd'});
		$( "#doa" ).datepicker({dateFormat:'yy-mm-dd'});
		
	});
</script>
<?php

$usertype_tag_placeholder = '';
$entitytype_tag_placeholder = '';
$username_placeholder = '';
$password_placeholder = '';
$fname_placeholder = '';
$mname_placeholder = '';
$lname_placeholder = '';
$gender_placeholder = '';
$email_placeholder = '';
$phone_placeholder = '';
$addressline1_placeholder = '';
$addressline2_placeholder = '';
$city_placeholder = '';
$state_placeholder = '';
$country_placeholder = '';
$nationality_placeholder = '';
$dob_placeholder = '';
$bloodgroup_placeholder = '';
$photofile_placeholder = '';
$rollno_placeholder='';
$doa_placeholder = '';
$emergencycontactname_placeholder = '';
$emergencycontactnumber_placeholder = '';
$status_placeholder = '';



$p_usertype_tag_placeholder = '';
$p_entitytype_tag_placeholder = '';
$p_username_placeholder = '';
$p_password_placeholder = '';
$p_fname_placeholder = '';
$p_mname_placeholder = '';
$p_lname_placeholder = '';
$p_email_placeholder = '';
$p_phone_placeholder = '';
$p_addressline1_placeholder = '';
$p_addressline2_placeholder = '';
$p_officeaddressline1_placeholder = '';
$p_officeaddressline2_placeholder = '';
$p_city_placeholder = '';
$p_state_placeholder = '';
$p_country_placeholder = '';
$p_nationality_placeholder = '';
$p_dob_placeholder = '';
$p_photofile_placeholder = '';
$p_occupation_placeholder='';
$p_officecity_placeholder = '';
$p_officestate_placeholder = '';
$p_officecountry_placeholder = '';
$p_officephone_placeholder = '';
$p_resumefile_placeholder = '';
$p_status_placeholder = '';



// Create Menu and Get Menu Data

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'pentitytypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

function recursiveMenu2($pid='',$level){
global $htmlarray,$level;
$level++;
$columns = array('e.id','e.entitytypetag','e.entityname');
$conditions = array();

$tables = array();
$tables['entities'] = 'e';
$tables['entitiesrelationship'] = 'er';

$conditions['=']['er.entitytype1'] = $pid;
$conditions['K AND =']['e.id'] = 'er.pid';
$conditions['AND =']['er.entityrelationtype'] = 'parent';

$restricted_array = array('@parent');

$sqlObj = new MainSQL();

$sqlmenu = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, 'e.id', '', '');
	
if($resultmenu2 = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu2)!=0){
while($resultsetmenu2 = $sqlObj->FetchResult($resultmenu2)){

if(in_array($sqlObj->getCleanData($resultsetmenu2->entitytypetag),$restricted_array)){


$str = '';
for($i=0;$i<=$level;$i++){
$str .= '-';
}
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu2->entitytypetag);
($resultsetmenu2->entitytypetag == '@parent')?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu2->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu2->entityname).')';
$htmlarray[]['option']['end'] = '';

}


if($resultsetmenu2->id != $pid){
recursiveMenu2($resultsetmenu2->id,$level);
$level--;
}
}
}
}
}

recursiveMenu2(0,0);

$htmlarray[]['select']['end'] = '';

$p_entitytypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// User Type Tag //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'pusertypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','usertypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';

$restricted_array = array('#parent');


$sqlmenu = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){

if(in_array($sqlObj->getCleanData($resultsetmenu->usertypetag),$restricted_array)){


$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->usertypetag);
($resultsetmenu->usertypetag == '#parent')?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->usertypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$p_usertypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);





// Create Menu and Get Menu Data

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'entitytypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

function recursiveMenu($pid='',$level){
global $htmlarray,$level;
$level++;
$columns = array('e.id','e.entitytypetag','e.entityname');
$conditions = array();

$tables = array();
$tables['entities'] = 'e';
$tables['entitiesrelationship'] = 'er';

$conditions['=']['er.entitytype1'] = $pid;
$conditions['K AND =']['e.id'] = 'er.pid';
$conditions['AND =']['er.entityrelationtype'] = 'parent';

$restricted_array = array('@student');


$sqlObj = new MainSQL();

$sqlmenu = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, 'e.id', '', '');
	
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$str = '';
for($i=0;$i<=$level;$i++){
$str .= '-';
}

if(in_array($sqlObj->getCleanData($resultsetmenu->entitytypetag),$restricted_array)){


$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag);
($resultsetmenu->entitytypetag == '@student')?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu->entityname).')';
$htmlarray[]['option']['end'] = '';

}


if($resultsetmenu->id != $pid){
recursiveMenu($resultsetmenu->id,$level);
$level--;
}
}
}
}
}

recursiveMenu(0,0);

$htmlarray[]['select']['end'] = '';

$entitytypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// User Type Tag //

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'usertypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$restricted_array = array('#student');


$sqlObj = new MainSQL();
$columns = array('id','usertypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){

if(in_array($sqlObj->getCleanData($resultsetmenu->usertypetag),$restricted_array)){


$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->usertypetag);
($resultsetmenu->usertypetag == '#student')?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->usertypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$usertypetag_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST)){
$usertype_tag_placeholder = (isset($_POST['usertypetag']))?$_POST['usertypetag']:'';
$entitytype_tag_placeholder = (isset($_POST['entitytypetag']))?$_POST['entitytypetag']:'';
$username_placeholder = (isset($_POST['username']))?$_POST['username']:'';
$password_placeholder = (isset($_POST['password']))?$_POST['password']:'';
$fname_placeholder = (isset($_POST['fname']))?$_POST['fname']:'';
$mname_placeholder = (isset($_POST['mname']))?$_POST['mname']:'';
$lname_placeholder = (isset($_POST['lname']))?$_POST['lname']:'';
$gender_placeholder = (isset($_POST['gender']))?$_POST['gender']:'';
$email_placeholder = (isset($_POST['email']))?$_POST['email']:'';
$phone_placeholder = (isset($_POST['phone']))?$_POST['phone']:'';
$addressline1_placeholder = (isset($_POST['addressline1']))?$_POST['addressline1']:'';
$addressline2_placeholder = (isset($_POST['addressline2']))?$_POST['addressline2']:'';
$city_placeholder = (isset($_POST['city']))?$_POST['city']:'';
$state_placeholder = (isset($_POST['state']))?$_POST['state']:'';
$country_placeholder = (isset($_POST['country']))?$_POST['country']:'';
$nationality_placeholder = (isset($_POST['nationality']))?$_POST['nationality']:'';
$dob_placeholder = (isset($_POST['dob']))?$_POST['dob']:'';
$bloodgroup_placeholder = (isset($_POST['bloodgroup']))?$_POST['bloodgroup']:'';
$photofile_placeholder = (isset($_POST['photofile']))?$_POST['photofile']:'';

$rollno_placeholder=(isset($_POST['rollno']))?$_POST['rollno']:'';
$doa_placeholder=(isset($_POST['doa']))?$_POST['doa']:'';
$emergencycontactname_placeholder=(isset($_POST['emergencycontactname']))?$_POST['emergencycontactname']:'';
$emergencycontactnumber_placeholder=(isset($_POST['emergencycontactnumber']))?$_POST['emergencycontactnumber']:'';
$status_placeholder = (isset($_POST['status']))?$_POST['status']:'';


$p_usertype_tag_placeholder = (isset($_POST['pusertypetag']))?$_POST['pusertypetag']:'';
$p_entitytype_tag_placeholder = (isset($_POST['pentitytypetag']))?$_POST['pentitytypetag']:'';
$p_username_placeholder = (isset($_POST['pusername']))?$_POST['pusername']:'';
$p_password_placeholder = (isset($_POST['ppassword']))?$_POST['ppassword']:'';
$p_fname_placeholder = (isset($_POST['pfname']))?$_POST['pfname']:'';
$p_mname_placeholder = (isset($_POST['pmname']))?$_POST['pmname']:'';
$p_lname_placeholder = (isset($_POST['plname']))?$_POST['plname']:'';
$p_gender_placeholder = (isset($_POST['pgender']))?$_POST['pgender']:'';
$p_email_placeholder = (isset($_POST['pemail']))?$_POST['pemail']:'';
$p_phone_placeholder = (isset($_POST['pphone']))?$_POST['pphone']:'';
$p_addressline1_placeholder = (isset($_POST['paddressline1']))?$_POST['paddressline1']:'';
$p_addressline2_placeholder = (isset($_POST['paddressline2']))?$_POST['paddressline2']:'';
$p_city_placeholder = (isset($_POST['pcity']))?$_POST['pcity']:'';
$p_state_placeholder = (isset($_POST['pstate']))?$_POST['pstate']:'';
$p_country_placeholder = (isset($_POST['country']))?$_POST['country']:'';
$p_nationality_placeholder = (isset($_POST['pnationality']))?$_POST['pnationality']:'';
$p_dob_placeholder = (isset($_POST['pdob']))?$_POST['pdob']:'';
$p_photofile_placeholder = (isset($_POST['pphotofile']))?$_POST['pphotofile']:'';

$p_occupation_placeholder=(isset($_POST['poccupation']))?$_POST['poccupation']:'';
$p_officeaddressline1_placeholder = (isset($_POST['pofficeaddressline1']))?$_POST['pofficeaddressline1']:'';
$p_officeaddressline2_placeholder = (isset($_POST['pofficeaddressline2']))?$_POST['pofficeaddressline2']:'';
$p_officecity_placeholder =(isset($_POST['pofficecity']))?$_POST['pofficecity']:'';
$p_officestate_placeholder = (isset($_POST['pofficestate']))?$_POST['pofficestate']:'';
$p_officecountry_placeholder = (isset($_POST['pofficecountry']))?$_POST['pofficecountry']:'';
$p_officephone_placeholder = (isset($_POST['pofficephone']))?$_POST['pofficephone']:'';
$p_resumefile_placeholder = (isset($_POST['presumefile']))?$_POST['presumefile']:'';
$p_status_placeholder = (isset($_POST['pstatus']))?$_POST['pstatus']:'';
}
?>

<?php
if(PROJ_RUN_AJAX==1){
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
}
?>

<script>
$(document).ready(function(){
$("#addstudentparentregistrationform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveStudentParentRegistration/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveStudentParentRegistration/');
}
?>


<form id="addstudentparentregistrationform" name="addstudentparentregistrationform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend>Add Student Information</legend>

	<ol>
		<li>
		<label for="usertypetag">User Type Tag</label><?php echo $usertypetag_placeholder; ?>
		</li>
		<li>
		<label for="entitytypetag">Entity Type Tag </label><?php echo $entitytypetag_placeholder; ?>
		</li>
		
	<li>
		<label for="username"><?php echo $lang['siya']['users']['USER_NAME'];?></label>
		<input id="username" name="username" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME'];?>" value="<?php echo $username_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		

		<li>
		<label for="password"><?php echo $lang['siya']['users']['PASSWORD'];?></label>
		<input id="password" name="password" type="password" placeholder="<?php echo $lang['siya']['users']['PASSWORD'];?>" required="" autofocus="" value="<?php echo $password_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="fname"><?php echo $lang['siya']['users']['FIRST_NAME'];?></label>
		<input id="fname" name="fname" type="text" placeholder="<?php echo $lang['siya']['users']['FIRST_NAME'];?>" value="<?php echo $fname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="mname"><?php echo $lang['siya']['users']['MIDDLE_NAME'];?></label>
		<input id="mname" name="mname" type="text" placeholder="<?php echo $lang['siya']['users']['MIDDLE_NAME'];?>" value="<?php echo $mname_placeholder; ?>"/>
		</li>
		
		<li>
		<label for="lname"><?php echo $lang['siya']['users']['LAST_NAME'];?></label>
		<input id="lname" name="lname" type="text" placeholder="<?php echo $lang['siya']['users']['LAST_NAME'];?>" value="<?php echo $lname_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>

		<li>
		<label class="label_radio" for="gender"><?php echo $lang['siya']['users']['GENDER'];?></label><br />
		<input name="gender" id="gender-01" value="M" type="radio" <?php echo _FORM_FINAL; ?> />Male<br />
		<input name="gender" id="gender-02" value="F" type="radio" />Female<br />
		
		</li>

		<li>
		<label for="email"><?php echo $lang['siya']['users']['EMAIL'];?></label>
		<input id="email" name="email" type="text" placeholder="<?php echo $lang['siya']['users']['EMAIL'];?>" value="<?php echo $email_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="phone"><?php echo $lang['siya']['users']['PHONE_NUMBER'];?></label>
		<input id="phone" name="phone" type="text" placeholder="<?php echo $lang['siya']['users']['PHONE_NUMBER'];?>" value="<?php echo $phone_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="addressline1"><?php echo $lang['siya']['users']['ADDRESS_1'];?></label>
		<input id="addressline1" name="addressline1" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_1'];?>" value="<?php echo $addressline1_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		
		</li>
		
		<li>
		<label for="addressline2"><?php echo $lang['siya']['users']['ADDRESS_2'];?></label>
		<input id="addressline2" name="addressline2" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_2'];?>" value="<?php echo $addressline2_placeholder; ?>"/>
		</li>
		
		<li>
		<label for="city"><?php echo $lang['siya']['users']['CITY'];?></label>
		<input id="city" name="city" type="text" placeholder="<?php echo $lang['siya']['users']['CITY'];?>" value="<?php echo $city_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="state"><?php echo $lang['siya']['users']['STATE'];?></label>
		<input id="state" name="state" type="text" placeholder="<?php echo $lang['siya']['users']['STATE'];?>" value="<?php echo $state_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="country"><?php echo $lang['siya']['users']['COUNTRY'];?></label>
		<input id="country" name="country" type="text" placeholder="<?php echo $lang['siya']['users']['COUNTRY'];?>" value="<?php echo $country_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="nationality"><?php echo $lang['siya']['users']['NATIONALITY'];?></label>
		<input id="nationality" name="nationality" type="text" placeholder="<?php echo $lang['siya']['users']['NATIONALITY'];?>" value="<?php echo $nationality_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="dob"><?php echo $lang['siya']['users']['DATE_OF_BIRTH'];?></label>
		<input id="dob" name="dob" type="text" placeholder="<?php echo $lang['siya']['users']['DATE_OF_BIRTH'];?>Enter Date Of Birth" value="<?php echo $dob_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		

		<li>
		<label for="registrationno"><?php echo $lang['siya']['users']['REGISTRATION_NO'];?></label>
		<input id="registrationno" name="registrationno" type="text" placeholder="<?php echo $lang['siya']['users']['REGISTRATION_NO'];?>" value="<?php echo $rollno_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>


		<li>
		<label for="doa"><?php echo $lang['siya']['users']['DATE_OF_ADDMISSION'];?></label>
		<input id="doa" name="doa" type="text" placeholder="<?php echo $lang['siya']['users']['DATE_OF_ADDMISSION'];?>" value="<?php echo $doa_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="emergencycontactname"><?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NAME'];?></label><br />
		<input id="emergencycontactname" name="emergencycontactname" type="text" placeholder="<?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NAME'];?>" value="<?php echo $emergencycontactname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="emergencycontactnumber"><?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NUMBER'];?></label><br />
		<input id="emergencycontactnumber" name="emergencycontactnumber" type="text" placeholder="<?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NUMBER'];?>" value="<?php echo $emergencycontactnumber_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		
	<li>
		<label for="photofile"><?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?></label>
		<input id="photofile" name="photofile" type="file" placeholder="<?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?>" value="<?php echo $photofile_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		</ol>
				
		<hr />

		<legend>Add Parent Information</legend>
		
		<ol>
			
		<li>
		<label for="pusertypetag">User Type Tag </label><?php echo $p_usertypetag_placeholder; ?>
		</li>
		<li>
		<label for="pentitytypetag">Entity Type Tag </label><?php echo $p_entitytypetag_placeholder; ?>
		</li>
		
		<li>
		<label for="pusername"><?php echo $lang['siya']['users']['USER_NAME'];?></label>
		<input id="pusername" name="pusername" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME'];?>" value="<?php echo $p_username_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		

		<li>
		<label for="ppassword"><?php echo $lang['siya']['users']['PASSWORD'];?></label>
		<input id="ppassword" name="ppassword" type="password" placeholder="<?php echo $lang['siya']['users']['PASSWORD'];?>" required="" autofocus="" value="<?php echo $p_password_placeholder; ?>" <?php echo _FORM_FINAL; ?>>
		</li>

		<li>
		<label for="pfname"><?php echo $lang['siya']['users']['FIRST_NAME'];?></label>
		<input id="pfname" name="pfname" type="text" placeholder="<?php echo $lang['siya']['users']['FIRST_NAME'];?>" value="<?php echo $p_fname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="pmname"><?php echo $lang['siya']['users']['MIDDLE_NAME'];?></label>
		<input id="pmname" name="pmname" type="text" placeholder="<?php echo $lang['siya']['users']['MIDDLE_NAME'];?>" value="<?php echo $p_mname_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="plname"><?php echo $lang['siya']['users']['LAST_NAME'];?></label>
		<input id="plname" name="plname" type="text" placeholder="<?php echo $lang['siya']['users']['LAST_NAME'];?>" value="<?php echo $p_lname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label class="label_radio" for="pgender"><?php echo $lang['siya']['users']['GENDER'];?> </label><br />
		<input name="pgender" id="pgender-01" value="M" type="radio" <?php echo _FORM_FINAL; ?>/>Male<br />
		<input name="pgender" id="pgender-02" value="F" type="radio" />Female		
		</li>

		<li>
		<label for="pemail"><?php echo $lang['siya']['users']['EMAIL'];?></label>
		<input id="pemail" name="pemail" type="text" placeholder="<?php echo $lang['siya']['users']['EMAIL'];?>" value="<?php echo $p_email_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="pphone"><?php echo $lang['siya']['users']['PHONE_NUMBER'];?></label>
		<input id="pphone" name="pphone" type="text" placeholder="<?php echo $lang['siya']['users']['PHONE_NUMBER'];?>" value="<?php echo $p_phone_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="paddressline1"><?php echo $lang['siya']['users']['ADDRESS_1'];?></label>
		<input id="paddressline1" name="paddressline1" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_1'];?>" value="<?php echo $p_addressline1_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		
		</li>
		
		<li>
		<label for="paddressline2"><?php echo $lang['siya']['users']['ADDRESS_2'];?></label>
		<input id="paddressline2" name="paddressline2" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_2'];?>" value="<?php echo $p_addressline2_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="pcity"><?php echo $lang['siya']['users']['CITY'];?></label>
		<input id="pcity" name="pcity" type="text" placeholder="<?php echo $lang['siya']['users']['CITY'];?>" value="<?php echo $p_city_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="pstate"><?php echo $lang['siya']['users']['STATE'];?></label>
		<input id="pstate" name="pstate" type="text" placeholder="<?php echo $lang['siya']['users']['STATE'];?>" value="<?php echo $p_state_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="pcountry"><?php echo $lang['siya']['users']['COUNTRY'];?></label>
		<input id="pcountry" name="pcountry" type="text" placeholder="<?php echo $lang['siya']['users']['COUNTRY'];?>" value="<?php echo $p_country_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="pnationality"><?php echo $lang['siya']['users']['NATIONALITY'];?></label>
		<input id="pnationality" name="pnationality" type="text" placeholder="<?php echo $lang['siya']['users']['NATIONALITY'];?>" value="<?php echo $p_nationality_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="pdob"><?php echo $lang['siya']['users']['DATE_OF_BIRTH'];?></label>
		<input id="pdob" name="pdob" type="text" placeholder="<?php echo $lang['siya']['users']['DATE_OF_BIRTH'];?>" value="<?php echo $p_dob_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="poccupation"><?php echo $lang['siya']['users']['OCCUPATION'];?></label>
		<input id="poccupation" name="poccupation" type="text" placeholder="<?php echo $lang['siya']['users']['OCCUPATION'];?>" value="<?php echo $p_occupation_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="pofficeaddressline1"><?php echo $lang['siya']['users']['OFFICE_ADDRESS_1'];?></label>
		<input id="pofficeaddressline1" name="pofficeaddressline1" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME'];?>" value="<?php echo $p_officeaddressline1_placeholder; ?>" <?php echo _FORM_CLASS; ?> />		
		</li>
		
		<li>
		<label for="pofficeaddressline2"><?php echo $lang['siya']['users']['OFFICE_ADDRESS_2'];?></label>
		<input id="pofficeaddressline2" name="pofficeaddressline2" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_ADDRESS_2'];?>" value="<?php echo $p_officeaddressline2_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>

		<li>
		<label for="pofficecity"><?php echo $lang['siya']['users']['OFFICE_CITY'];?></label>
		<input id="pofficecity" name="pofficecity" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_CITY'];?>" value="<?php echo $p_officecity_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="pofficestate"><?php echo $lang['siya']['users']['OFFICE_STATE'];?></label>
		<input id="pofficestate" name="pofficestate" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_STATE'];?>" value="<?php echo $p_officestate_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="pofficecountry"><?php echo $lang['siya']['users']['OFFICE_COUNTRY'];?></label>
		<input id="pofficecountry" name="pofficecountry" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_COUNTRY'];?>" value="<?php echo $p_officecountry_placeholder; ?>"<?php echo _FORM_CLASS; ?> />
		</li>

		<li>
		<label for="pofficephone"><?php echo $lang['siya']['users']['OFFICE_PHONE_NUMBER'];?></label>
		<input id="pofficephone" name="pofficephone" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_PHONE_NUMBER'];?>" value="<?php echo $p_officephone_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>

		<li>
		<label for="pphotofile"><?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?></label>
		<input id="pphotofile" name="pphotofile" type="file" placeholder="<?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?>" value="<?php echo $p_photofile_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>


		<li>
		<label for="presumefile"><?php echo $lang['siya']['users']['UPLOAD_RESUME_FILE'];?></label>
		<input id="presumefile" name="presumefile" type="file" placeholder="<?php echo $lang['siya']['users']['UPLOAD_RESUME_FILE'];?>" value="<?php echo $p_resumefile_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>