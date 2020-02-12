<script>
	$(function() {
		$( "#dob" ).datepicker({dateFormat:'yy-mm-dd'});
		$( "#doj" ).datepicker({dateFormat:'yy-mm-dd'});
	});
</script>
<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('users','id',$id,'users/manageParents/');

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
$occupation_placeholder='';
$officeaddressline1_placeholder = '';
$officeaddressline2_placeholder = '';
$officecity_placeholder = '';
$officestate_placeholder = '';
$officecountry_placeholder = '';
$officephone_placeholder = '';
$resumefile_placeholder = '';
$status_placeholder = '';

global $entitytype_tag,$usertype_tag;
$entitytype_tag = '';
$usertype_tag = '';

$columns = array('u.id','u.usertypetag','u.entitytypetag','u.username','u.fname','u.mname','u.lname','u.gender','u.email','u.phone','u.addressline1','u.addressline2','u.city','u.state','u.country','u.nationality','u.dob','p.parentof','p.occupation','p.officeaddressline1','p.officeaddressline2','p.officecity','p.officestate','p.officecountry','p.officephone','p.resumefile');

$tables = array();
$tables['users'] = 'u';
$tables['parents'] = 'p';

$conditions = array();
$conditions['=']['u.id'] = $id;
$conditions['K AND =']['u.id'] = 'p.userid';

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
$parentof_placeholder =  $sqlObj->getCleanData($resultset->parentof);
$occupation_placeholder =  $sqlObj->getCleanData($resultset->occupation);
$officeaddressline1_placeholder =  $sqlObj->getCleanData($resultset->officeaddressline1);
$officeaddressline2_placeholder =  $sqlObj->getCleanData($resultset->officeaddressline2);
$officecity_placeholder =  $sqlObj->getCleanData($resultset->officecity);
$officestate_placeholder =  $sqlObj->getCleanData($resultset->officestate);
$officecountry_placeholder =  $sqlObj->getCleanData($resultset->officecountry);
$officephone_placeholder =  $sqlObj->getCleanData($resultset->officephone);
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


$restricted_array = array('@parent');


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

$restricted_array = array('#parent');

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
$photofile_placeholder = (isset($_POST['photofile']))?$_POST['photofile']:'';
$occupation_placeholder=(isset($_POST['occupation']))?$_POST['occupation']:'';
$officeaddressline1_placeholder = (isset($_POST['officeaddressline1']))?$_POST['officeaddressline1']:'';
$officeaddressline2_placeholder = (isset($_POST['officeaddressline2']))?$_POST['officeaddressline2']:'';
$officecity_placeholder =(isset($_POST['officecity']))?$_POST['officecity']:'';
$officestate_placeholder = (isset($_POST['officestate']))?$_POST['officestate']:'';
$officecountry_placeholder = (isset($_POST['officecountry']))?$_POST['officecountry']:'';
$officephone_placeholder = (isset($_POST['officephone']))?$_POST['officephone']:'';
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
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('users/saveParentRegistration/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('users/saveParentRegistration/'.$id.'/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend>Edit Parent Details</legend>

	<ol>
		
		<li>
		<label for="usertypetag"><?php echo $lang['siya']['users']['USER_TYPE_TAG'];?> </label><?php echo $usertype_tag_placeholder; ?>
		</li>
		<li>
		<label for="entitytypetag"><?php echo $lang['siya']['users']['ENTITY_TYPE_TAG'];?> </label><?php echo $entitytype_tag_placeholder; ?>
		</li>
		
		<li>
		<label for="parentof"><?php echo $lang['siya']['users']['PARENT_OF'];?></label>
		<?php
		// To Be Done, There is a confusion in Table // A table to be created for Student - Parent Relationship
		?>
		</li>

		<li>
		<label for="username"><?php echo $lang['siya']['users']['USER_NAME'];?></label>
		<input id="username" name="username" type="text" placeholder="<?php echo $lang['siya']['users']['USER_NAME'];?>" value="<?php echo $username_placeholder; ?>" <?php echo _FORM_FINAL; ?> readonly />
		</li>
		
		<li>
		<label for="fname"><?php echo $lang['siya']['users']['FIRST_NAME'];?></label>
		<input id="fname" name="fname" type="text" placeholder="<?php echo $lang['siya']['users']['FIRST_NAME'];?>" value="<?php echo $fname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="mname"><?php echo $lang['siya']['users']['MIDDLE_NAME'];?></label>
		<input id="mname" name="mname" type="text" placeholder="<?php echo $lang['siya']['users']['MIDDLE_NAME'];?>" value="<?php echo $mname_placeholder; ?>" <?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL; ?> />
		</li>
		
		<li>
		<label for="lname"><?php echo $lang['siya']['users']['LAST_NAME'];?></label>
		<input id="lname" name="lname" type="text" placeholder="<?php echo $lang['siya']['users']['LAST_NAME'];?>" value="<?php echo $lname_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label class="label_radio" for="gender"><?php echo $lang['siya']['users']['GENDER'];?> </label><br />
		<input name="gender" id="gender-01" value="M" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" <?php  echo ($gender_placeholder=='M')?'CHECKED':''; ?> />Male<br />
		<input name="gender" id="gender-02" value="F" type="radio" <?php  echo ($gender_placeholder=='F')?'CHECKED':''; ?>/>Female<br />
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
		<input id="addressline2" name="addressline2" type="text" placeholder="<?php echo $lang['siya']['users']['ADDRESS_2'];?>" value="<?php echo $addressline2_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
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
		<label for="occupation"><?php echo $lang['siya']['users']['OCCUPATION'];?></label>
		<input id="occupation" name="occupation" type="text" placeholder="<?php echo $lang['siya']['users']['OCCUPATION'];?>" value="<?php echo $occupation_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>


		<li>
		<label for="officeaddressline1"><?php echo $lang['siya']['users']['OFFICE_ADDRESS_1'];?></label>
		<input id="officeaddressline1" name="officeaddressline1" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_ADDRESS_1'];?>" value="<?php echo $officeaddressline1_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		
		</li>
		
		<li>
		<label for="officeaddressline2"><?php echo $lang['siya']['users']['OFFICE_ADDRESS_2'];?></label>
		<input id="officeaddressline2" name="officeaddressline2" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_ADDRESS_2'];?>" value="<?php echo $officeaddressline2_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>


	
		<li>
		<label for="officecity"><?php echo $lang['siya']['users']['OFFICE_CITY'];?></label>
		<input id="officecity" name="officecity" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_CITY'];?>" value="<?php echo $officecity_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="officestate"><?php echo $lang['siya']['users']['OFFICE_STATE'];?></label>
		<input id="officestate" name="officestate" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_STATE'];?>" value="<?php echo $officestate_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>
		
		<li>
		<label for="officecountry"><?php echo $lang['siya']['users']['OFFICE_COUNTRY'];?></label>
		<input id="officecountry" name="officecountry" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_COUNTRY'];?>" value="<?php echo $officecountry_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
		</li>

		<li>
		<label for="officephone"><?php echo $lang['siya']['users']['OFFICE_PHONE_NUMBER'];?></label>
		<input id="officephone" name="officephone" type="text" placeholder="<?php echo $lang['siya']['users']['OFFICE_PHONE_NUMBER'];?>" value="<?php echo $officephone_placeholder; ?>" <?php echo _FORM_CLASS; ?> />
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
		<p><?php echo $resumefile_placeholder; ?><br /><a class="buttonsfortopiccontents" href="<?php echo MainSystem::URLCreator('users/downloadParentResumeFile/'.$id.'/'); ?>">Download and View Resume</a></p>
		<?php
		}
		?>
		</li>	


		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>