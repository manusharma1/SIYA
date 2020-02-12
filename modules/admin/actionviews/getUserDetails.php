<?php
// OPENTADKA FRAMEWORK		http://www.opentadka.org

	$id = _ACTION_VIEW_PARAMETER_ID;

	// Get User Data
	$columns = array('id','username','fname','lname','email','phone','addressline1','addressline2','city','state','country');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($resultset = $sqlObj->FetchResult($result)){

	$username_placeholder = $sqlObj->getCleanData($resultset->username);
	$fname_placeholder = $sqlObj->getCleanData($resultset->fname);
	$lname_placeholder = $sqlObj->getCleanData($resultset->lname);
	$email_placeholder = $sqlObj->getCleanData($resultset->email);
	$phone_placeholder = $sqlObj->getCleanData($resultset->phone);
	$addressline1_placeholder = $sqlObj->getCleanData($resultset->addressline1);
	$addressline2_placeholder = $sqlObj->getCleanData($resultset->addressline2);
	$city_placeholder = $sqlObj->getCleanData($resultset->city);
	$state_placeholder = $sqlObj->getCleanData($resultset->state);
	$country_placeholder = $sqlObj->getCleanData($resultset->country);
	}else{
	trigger_error('Data Fetch Error');
	}
	}else{
	trigger_error('SQL Error');
	}
	

?>


<form id="edituserdetails" name="edituserdetails" method="post" action="<?php echo MainSystem::URLCreator('admin/saveUserDetails/'.$id.'/') ?>" onsubmit="return JSMainFunction(this);">
<table width="100%" border="0" bgcolor="#CC9933">
  <tr>
    <td width="17%" bgcolor="#CCCC66">Username </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="username" size="95" value="<?php echo $username_placeholder; ?>" readonly/></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66">Password </td>
    <td width="83%" bgcolor="#CCCC66"><input type="password" name="password" id="password" title="Password"  size="95" /></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66">Retype Password </td>
    <td width="83%" bgcolor="#CCCC66"><input type="password" name="password2" id="password2" size="95" /></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66">First Name </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="fname" id="fname" title="First Name" size="95" value="<?php echo $fname_placeholder; ?>"/></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66">Last Name </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="lname" id="lname" title="Last Name" size="95" value="<?php echo $lname_placeholder; ?>"/></td>
  </tr>
    <tr>
  <td width="17%" bgcolor="#CCCC66">Email </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="email" id="email" title="Email" size="95" value="<?php echo $email_placeholder; ?>"/></td>
  </tr>	
	<tr>
  <td width="17%" bgcolor="#CCCC66">Phone </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="phone" id="phone" title="Phone" size="95" value="<?php echo $phone_placeholder; ?>"/></td>
  </tr>
    <tr>
  <td width="17%" bgcolor="#CCCC66">Address Line 1 </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="addressline1" id="addressline1" title="Address Line 1" size="95" value="<?php echo $addressline1_placeholder; ?>"/></td>
  </tr>
    <tr>
  <td width="17%" bgcolor="#CCCC66">Address Line 2 </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="addressline2" id="addressline2" title="Address Line 2" size="95" value="<?php echo $addressline2_placeholder; ?>"/></td>
  </tr>
     <tr>
  <td width="17%" bgcolor="#CCCC66">City </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="city" id="city" size="95" title="City" value="<?php echo $city_placeholder; ?>"/></td>
  </tr>
     <tr>
  <td width="17%" bgcolor="#CCCC66">State </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="state" id="state" size="95" title="State" value="<?php echo $state_placeholder; ?>"/></td>
  </tr>
     <tr>
  <td width="17%" bgcolor="#CCCC66">Country </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="country" id="country" title="Country" size="95" value="<?php echo $country_placeholder; ?>"/></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCC66" align="center"><input type="Submit" name="Submit" value="Save User Details" /></td>
  </tr>

</table>
</form>

<?php
$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=username,email,fname,lname,phone:onsubmit=edituserdetails:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>