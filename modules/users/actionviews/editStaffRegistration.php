<script>
	$(function() {
		$( "#dob" ).datepicker({dateFormat:'yy-mm-dd'});
		$( "#doj" ).datepicker({dateFormat:'yy-mm-dd'});
	});
</script>

<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('users','id',$id,'users/manageStaff/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('users','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

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
$photofile_placeholder = '';

$empid_placeholder='';
$doj_placeholder='';
$bloodgroup_placeholder = '';
$emergencycontactname_placehoder='';
$emergencycontactnumber_placehoder='';
$qualifications_placeholder = '';
$resumefile_placeholder = '';
$status_placeholder = '';


global $entitytype_tag,$usertype_tag;
$entitytype_tag = '';
$usertype_tag = '';



$columns = array('u.id','u.usertypetag','u.entitytypetag','u.username','u.fname','u.mname','u.lname','u.gender','u.email','u.phone','u.addressline1','u.addressline2','u.city','u.state','u.country','u.nationality','u.dob','st.empid','st.doj','st.emergencycontactname','st.emergencycontactnumber','st.bloodgroup','st.qualifications','st.resumefile');

$tables = array();
$tables['users'] = 'u';
$tables['staff'] = 'st';

$conditions = array();
$conditions['=']['u.id'] = $id;
$conditions['K AND =']['u.id'] = 'st.userid';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$usertype_tag =  $sqlObj->getCleanData($resultset->usertypetag);
$entitytype_tag =  $sqlObj->getCleanData($resultset->entitytypetag);
$username_placeholder =  $sqlObj->getCleanData($resultset->username);
$fname_placeholder =  $sqlObj->getCleanData($resultset->fname);
$mname_placeholder =  $sqlObj->getCleanData($resultset->mname);
$lname_placeholder =  $sqlObj->getCleanData($resultset->lname);
$gender_placeholder =  $sqlObj->getCleanData($resultset->gender);
$email_placeholder =  $sqlObj->getCleanData($resultset->email);
$phone_placeholder =  $sqlObj->getCleanData($resultset->phone);
$addressline1_placeholder =  $sqlObj->getCleanData($resultset->addressline1);
$addressline2_placeholder =  $sqlObj->getCleanData($resultset->addressline2);
$city_placeholder =  $sqlObj->getCleanData($resultset->city);
$state_placeholder =  $sqlObj->getCleanData($resultset->state);
$country_placeholder =  $sqlObj->getCleanData($resultset->country);
$nationality_placeholder =  $sqlObj->getCleanData($resultset->nationality);
$dob_placeholder =  $sqlObj->getCleanData($resultset->dob);
$empid_placeholder =  $sqlObj->getCleanData($resultset->empid);
$doj_placeholder =  $sqlObj->getCleanData($resultset->doj);
$emergencycontactname_placeholder =  $sqlObj->getCleanData($resultset->emergencycontactname);
$emergencycontactnumber_placeholder =  $sqlObj->getCleanData($resultset->emergencycontactnumber);
$bloodgroup_placeholder =  $sqlObj->getCleanData($resultset->bloodgroup);
$qualifications_placeholder =  $sqlObj->getCleanData($resultset->qualifications);
$resumefile_placeholder =  $sqlObj->getCleanData($resultset->resumefile);

}
}
}



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
global $htmlarray,$level,$entitytype_tag;
$level++;
$columns = array('e.id','e.entitytypetag','e.entityname');
$conditions = array();

$tables = array();
$tables['entities'] = 'e';
$tables['entitiesrelationship'] = 'er';

$conditions['=']['er.entitytype1'] = $pid;
$conditions['K AND =']['e.id'] = 'er.pid';
$conditions['AND =']['er.entityrelationtype'] = 'parent';


$restricted_array = array('@staff','@teacher');


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
($resultsetmenu->entitytypetag == $entitytype_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
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

$entitytype_tag_placeholder = $HTMLObj->HTMLCreator($htmlarray);




// Create Menu and Get Menu Data

$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'usertypetag';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';


$columns = array('id','usertypetag','name');
$sqlObj = new MainSQL();

$sqlmenu = $sqlObj->SQLCreator('S', 'usertypes', $columns, '', '', '', '');

$restricted_array = array('#teacher','#staff');

if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){

if(in_array($sqlObj->getCleanData($resultsetmenu->usertypetag),$restricted_array)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->usertypetag);
($resultsetmenu->usertypetag == $usertype_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->usertypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}


$htmlarray[]['select']['end'] = '';

$usertype_tag_placeholder = $HTMLObj->HTMLCreator($htmlarray);




if(isset($_POST) && isset($_POST['issubmit'])){

$usertype_tag_placeholder = (isset($_POST['usertypetag']))?$_POST['usertypetag']:'';
$entitytype_tag_placeholder = (isset($_POST['entitytypetag']))?$_POST['entitytypetag']:'';
$username_placeholder = (isset($_POST['username']))?$_POST['username']:'';
$password_placeholder = (isset($_POST['password']))?$_POST['password']:'';
$fname_placeholder = (isset($_POST['fname']))?$_POST['fname']:'';
$mname_placeholder = (isset($_POST['mname']))?$_POST['mname']:'';
$lname_placeholder = (isset($_POST['lname']))?$_POST['lname']:'';
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

$empid_placeholder=(isset($_POST['empid']))?$_POST['empid']:'';
$doj_placeholder=(isset($_POST['doj']))?$_POST['doj']:'';
$bloodgroup_placeholder = (isset($_POST['bloodgroup']))?$_POST['bloodgroup']:'';
$emergencycontactname_placeholder=(isset($_POST['emergencycontactname']))?$_POST['emergencycontactname']:'';
$emergencycontactnumber_placeholder=(isset($_POST['emergencycontactnumber']))?$_POST['emergencycontactnumber']:'';
$qualifications_placeholder = (isset($_POST['qualifications']))?$_POST['qualifications']:'';
$resumefile_placeholder = (isset($_POST['resumefile']))?$_POST['resumefile']:'';
$status_placeholder = (isset($_POST['status']))?$_POST['status']:'';

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
$("#editstaffregistrationform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveStaffRegistration/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveStaffRegistration/'.$id.'/');
}
?>
<form id="editstaffregistrationform" name="editstaffregistrationform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend>Edit Staff Details</legend>

	<ol>
		<li>
		<label for="empid"><?php echo $lang['siya']['users']['EMPLOYEE_ID']; ?></label>
		<input id="empid" name="empid" type="text" placeholder="<?php echo $lang['siya']['users']['EMPLOYEE_ID']; ?>" value="<?php echo $empid_placeholder; ?>" <?php echo _FORM_FINAL; ?> readonly />
		</li>

		<li>
		<label for="usertypetag"><?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?></label><?php echo $usertype_tag_placeholder; ?>
		</li>
		<li>
		<label for="entitytypetag"><?php echo $lang['siya']['users']['ENTITY_TYPE_TAG']; ?></label><?php echo $entitytype_tag_placeholder; ?>
		</li>
		
		<li>
		<label for="username"><?php echo $lang['siya']['users']['USER_NAME']; ?></label>
		<input id="username" name="username" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME']; ?>" value="<?php echo $username_placeholder; ?>" <?php echo _FORM_FINAL; ?> readonly />
		</li>
		
		<li>
		<label for="fname"><?php echo $lang['siya']['users']['FIRST_NAME']; ?></label>
		<input id="fname" name="fname" type="text" placeholder="<?php echo $lang['siya']['users']['FIRST_NAME']; ?>" value="<?php echo $fname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="mname"><?php echo $lang['siya']['users']['MIDDLE_NAME']; ?></label>
		<input id="mname" name="mname" type="text" placeholder="<?php echo $lang['siya']['users']['MIDDLE_NAME']; ?>" value="<?php echo $mname_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="lname"><?php echo $lang['siya']['users']['LAST_NAME']; ?></label>
		<input id="lname" name="lname" type="text" placeholder="<?php echo $lang['siya']['users']['LAST_NAME']; ?>" value="<?php echo $lname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label class="label_radio" for="gender"><?php echo $lang['siya']['users']['GENDER']; ?> </label><br />
		<input name="gender" id="gender-01" value="M" type="radio" <?php echo _FORM_CLASS;?><?php  echo ($gender_placeholder=='M')?'CHECKED':''; ?> />Male<br />
		<input name="gender" id="gender-02" value="F" type="radio" <?php  echo ($gender_placeholder=='F')?'CHECKED':''; ?>/>Female<br />
		</li>

		<li>
		<label for="email"><?php echo $lang['siya']['users']['EMAIL']; ?></label>
		<input id="email" name="email" type="text" placeholder="<?php echo $lang['siya']['users']['EMAIL']; ?>" value="<?php echo $email_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="phone"><?php echo $lang['siya']['users']['PHONE_NUMBER']; ?></label>
		<input id="phone" name="phone" type="text" placeholder="<?php echo $lang['siya']['users']['PHONE_NUMBER']; ?>" value="<?php echo $phone_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="addressline1"><?php echo $lang['siya']['users']['ADDRESS_1']; ?></label>
		<input id="addressline1" name="addressline1" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_1']; ?>" value="<?php echo $addressline1_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		
		</li>
		
		<li>
		<label for="addressline2"><?php echo $lang['siya']['users']['ADDRESS_2']; ?></label>
		<input id="addressline2" name="addressline2" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_2']; ?>" value="<?php echo $addressline2_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="city"><?php echo $lang['siya']['users']['CITY']; ?></label>
		<input id="city" name="city" type="text" placeholder="<?php echo $lang['siya']['users']['CITY']; ?>" value="<?php echo $city_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="state"><?php echo $lang['siya']['users']['STATE']; ?></label>
		<input id="state" name="state" type="text" placeholder="<?php echo $lang['siya']['users']['STATE']; ?>" value="<?php echo $state_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="country"><?php echo $lang['siya']['users']['COUNTRY']; ?></label>
		<input id="country" name="country" type="text" placeholder="<?php echo $lang['siya']['users']['COUNTRY']; ?>" value="<?php echo $country_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="nationality"><?php echo $lang['siya']['users']['NATIONALITY']; ?></label>
		<input id="nationality" name="nationality" type="text" placeholder="<?php echo $lang['siya']['users']['NATIONALITY']; ?>" value="<?php echo $nationality_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="dob"><?php echo $lang['siya']['users']['DATE_OF_BIRTH']; ?></label>
		<input id="dob" name="dob" type="text" placeholder="<?php echo $lang['siya']['users']['DATE_OF_BIRTH']; ?>" value="<?php echo $dob_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="doj"><?php echo $lang['siya']['users']['DATE_OF_JOINING']; ?></label>
		<input id="doj" name="doj" type="text" placeholder="<?php echo $lang['siya']['users']['DATE_OF_JOINING']; ?>" value="<?php echo $doj_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>


		<li>
		<label for="doj">Blood Group</label><br />

		<input name="bloodgroup" id="radio-01" value="a+" type="radio" <?php echo _FORM_CLASS;?><?php  echo ($bloodgroup_placeholder=='a+')?'CHECKED':''; ?>/>a+ <br />

		<input name="bloodgroup" id="radio-02" value="b+" type="radio" <?php  echo ($bloodgroup_placeholder=='b+')?'CHECKED':''; ?>/>b+ <br />
		<input name="bloodgroup" id="radio-03" value="o+" type="radio" <?php  echo ($bloodgroup_placeholder=='o+')?'CHECKED':''; ?>/>o+ <br />
		<input name="bloodgroup" id="radio-04" value="ab+" type="radio" <?php  echo ($bloodgroup_placeholder=='ab+')?'CHECKED':''; ?>/>ab+ <br />
		<input name="bloodgroup" id="radio-05" value="a-" type="radio" <?php  echo ($bloodgroup_placeholder=='a-')?'CHECKED':''; ?>/>a- <br />
		<input name="bloodgroup" id="radio-06" value="b-" type="radio" <?php  echo ($bloodgroup_placeholder=='b-')?'CHECKED':''; ?>/>b- <br />
		<input name="bloodgroup" id="radio-07" value="o-" type="radio" <?php  echo ($bloodgroup_placeholder=='o-')?'CHECKED':''; ?>/>o- <br />
		<input name="bloodgroup" id="radio-08" value="ab-" type="radio" <?php  echo ($bloodgroup_placeholder=='ab-')?'CHECKED':''; ?>/>ab- <br />
		</li>

		<li>
		<label for="emergencycontactname"><?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NAME']; ?></label><br />
		<input id="emergencycontactname" name="emergencycontactname" type="text" placeholder="<?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NAME']; ?>" value="<?php echo $emergencycontactname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="emergencycontactnumber"><?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NUMBER']; ?></label><br />
		<input id="emergencycontactnumber" name="emergencycontactnumber" type="text" placeholder="<?php echo $lang['siya']['users']['EMERGENCY_CONTACT_NUMBER']; ?>" value="<?php echo $emergencycontactnumber_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="qualifications"><?php echo $lang['siya']['users']['QUALIFICATION']; ?></label><br />
		<textarea id="qualifications" name="qualifications" placeholder="<?php echo $lang['siya']['users']['QUALIFICATION']; ?>" rows="5" required="" autofocus="" <?php echo _FORM_FINAL;?>><?php echo $qualifications_placeholder; ?></textarea>
		
		</li>

		<li>
		<label for="photofile"><?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?></label>
		<input id="photofile" name="photofile" type="file" placeholder="<?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?>" <?php echo _FORM_CLASS; ?> /><br />
		<p><b>Existing Image:</b> <img src="<?php echo MainSystem::URLCreator('users/showUserImageByID/'.$id.',1/'); ?>" width="50px" height="50px"/></p>

		</li>


		<li>
		<label for="resumefile"><?php echo $lang['siya']['users']['UPLOAD_RESUME_FILE'];?></label>
		<input id="resumefile" name="resumefile" type="file" placeholder="<?php echo $lang['siya']['users']['UPLOAD_RESUME_FILE'];?>" <?php echo _FORM_CLASS; ?> /><br />

		<?php
		if($resumefile_placeholder !=''){
		?>
		<p><?php echo $resumefile_placeholder; ?><br /><a class="buttonsfortopiccontents" href="<?php echo MainSystem::URLCreator('users/downloadStaffResumeFile/'.$id.'/'); ?>">Download and View Resume</a></p>
		<?php
		}
		?>
		</li>		


		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>