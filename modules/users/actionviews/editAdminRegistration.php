<?php
$id = _ACTION_VIEW_PARAMETER_ID;


$usertype_tag_placeholder = '';
$entitytype_tag_placeholder = '';
$username_placeholder = '';
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

global $entitytype_tag,$usertype_tag;
$entitytype_tag = '';
$usertype_tag = '';



$columns = array('id','username','fname','mname','lname','gender','email','phone','addressline1','addressline2','city','state','country','nationality','dob');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
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

}
}
}




if(isset($_POST) && isset($_POST['issubmit'])){
$username_placeholder = (isset($_POST['username']))?$_POST['username']:'';
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

$rollno_placeholder=(isset($_POST['rollno']))?$_POST['rollno']:'';
$doa_placeholder=(isset($_POST['doa']))?$_POST['doa']:'';
$emergencycontactname_placeholder=(isset($_POST['emergencycontactname']))?$_POST['emergencycontactname']:'';
$emergencycontactnumber_placeholder=(isset($_POST['emergencycontactnumber']))?$_POST['emergencycontactnumber']:'';
$status_placeholder = (isset($_POST['status']))?$_POST['status']:'';
}
?>

<?php
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#editadminregistration").validate();
});
</script>


<script>
$(function() {
	$( "#dob" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveRegistration/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveRegistration/'.$id.'/');
}
?>
<form id="editadminregistration" name="editadminregistration" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend>Edit Admin Detail</legend>

	<ol>
		

		<ol>
		<li>
		<label for="usertypetag"><?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?></label><input id="usertypetag" name="usertypetag" type="text" placeholder="<?php echo $lang['siya']['users']['USER_TYPE_TAG']; ?>" value="#admin" <?php echo _FORM_FINAL; ?> readonly />
		</li>
		<li>
		<label for="entitytypetag"><?php echo $lang['siya']['users']['ENTITY_TYPE_TAG']; ?></label><input id="entitytypetag" name="entitytypetag" type="text" placeholder="<?php echo $lang['siya']['users']['ENTITY_TYPE_TAG']; ?>" value="@admin" <?php echo _FORM_FINAL; ?> readonly />
		</li>
		
		<li>
		<label for="username"><?php echo $lang['siya']['users']['USER_NAME']; ?></label>
		<input id="username" name="username" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME']; ?>" value="<?php echo $username_placeholder; ?>" <?php echo _FORM_FINAL; ?> readonly />
		</li>
		
		<li>
		<label for="password"><?php echo $lang['siya']['users']['PASSWORD'];?></label>
		<input id="password" name="password" type="password" placeholder="<?php echo $lang['siya']['users']['PASSWORD'];?>" autofocus=""  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>">
		</li>

		<li>
		<label for="password2"><?php echo $lang['siya']['users']['PASSWORD2'];?></label>
		<input id="password2" name="password2" type="password2" placeholder="<?php echo $lang['siya']['users']['PASSWORD2'];?>" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>">
		</li>
		
		<li>
		<label for="fname"><?php echo $lang['siya']['users']['FIRST_NAME'];?></label>
		<input id="fname" name="fname" type="text" placeholder="<?php echo $lang['siya']['users']['FIRST_NAME'];?>" value="<?php echo $fname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="mname"><?php echo $lang['siya']['users']['MIDDLE_NAME'];?></label>
		<input id="mname" name="mname" type="text" placeholder="<?php echo $lang['siya']['users']['MIDDLE_NAME'];?>" value="<?php echo $mname_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="lname"><?php echo $lang['siya']['users']['LAST_NAME'];?></label>
		<input id="lname" name="lname" type="text" placeholder="<?php echo $lang['siya']['users']['LAST_NAME'];?>" value="<?php echo $lname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
	
		<li>
		<label class="label_radio" for="gender"><?php echo $lang['siya']['users']['GENDER'];?></label><br />
		<input name="gender" id="gender-01" value="M" type="radio" class="<?php echo _FORM_CLASS;?> required" <?php echo ($gender_placeholder=='M')?'CHECKED':''; ?> />Male<br />
		<input name="gender" id="gender-02" value="F" type="radio" <?php  echo ($gender_placeholder=='F')?'CHECKED':''; ?>/>Female<br />
		</li>

		<li>
		<label for="email"><?php echo $lang['siya']['users']['EMAIL'];?></label>
		<input id="email" name="email" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME'];?>" value="<?php echo $email_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
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
		<input id="addressline2" name="addressline2" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_2'];?>" value="<?php echo $addressline2_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
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
		<input id="photofile" name="photofile" type="file" placeholder="<?php echo $lang['siya']['users']['UPLOAD_PHOTO_FILE'];?>" <?php echo _FORM_CLASS; ?> /><br />
		<p><b>Existing Image:</b> <img src="<?php echo MainSystem::URLCreator('users/showUserImageByID/'.$id.',1/'); ?>" width="50px" height="50px"/></p>

		</li>		
		</ol>

</fieldset>


<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>