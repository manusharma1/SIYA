<script>
$(function() {
	$( "#dob" ).datepicker({
		dateFormat:'yy-mm-dd',
		yearRange:'-20:+0',
		showOn: "both",
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true
		});
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


$sqlObj = new MainSQL();

$sqlmenu = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, 'e.id', '', '');
	
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$str = '';
for($i=0;$i<=$level;$i++){
$str .= '-';
}
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu->entityname).')';
$htmlarray[]['option']['end'] = '';
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

$sqlObj = new MainSQL();
$columns = array('id','usertypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->usertypetag);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->usertypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';
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

}
?>

<?php
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#addnewregistrationform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveRegistration/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveRegistration/');
}
?>
<form id="addnewregistrationform" name="addnewregistrationform" method="post" action="<?php echo $formaction; ?>"  enctype="multipart/form-data">

<fieldset>

	<legend>Add New User Type</legend>

	<ol>
		<li>
		<label for="usertypetag">User Type Tag </label><?php echo $usertypetag_placeholder; ?>
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
		<input id="password" name="password" type="password" placeholder="<?php echo $lang['siya']['users']['PASSWORD'];?>" required="" autofocus="" value="<?php echo $password_placeholder; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required">
		</li>

		<li>
		<label for="fname"><?php echo $lang['siya']['users']['FIRST_NAME'];?></label>
		<input id="fname" name="fname" type="text" placeholder="<?php echo $lang['siya']['users']['FIRST_NAME'];?>" value="<?php echo $fname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="mname"><?php echo $lang['siya']['users']['MIDDLE_NAME'];?></label>
		<input id="mname" name="mname" type="text" placeholder="<?php echo $lang['siya']['users']['MIDDLE_NAME'];?>" value="<?php echo $mname_placeholder; ?>" <?php echo _FORM_CLASS_NOT_REQUIRED; ?> />
		</li>
		
		<li>
		<label for="lname"><?php echo $lang['siya']['users']['LAST_NAME'];?></label>
		<input id="lname" name="lname" type="text" placeholder="<?php echo $lang['siya']['users']['LAST_NAME'];?>" value="<?php echo $lname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label class="label_radio" for="gender"><?php echo $lang['siya']['users']['GENDER'];?></label><br/>
		<input name="gender" id="gender-01" value="M" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />Male<br/>
		<input name="gender" id="gender-02" value="F" type="radio" />Female <br/>
		
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
		<input id="addressline2" name="addressline2" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_2'];?>" value="<?php echo $addressline2_placeholder; ?>" <?php echo _FORM_CLASS_NOT_REQUIRED; ?> />
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
		<input id="dob" name="dob" type="text" placeholder="<?php echo $lang['siya']['users']['DATE_OF_BIRTH'];?>" value="<?php echo $dob_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="photofile"><?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?></label>
		<input id="photofile" name="photofile" type="file" placeholder="<?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?>" value="<?php echo $photofile_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>