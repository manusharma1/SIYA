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
    <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['USERNAME']; ?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="username" size="95" value="<?php echo $username_placeholder; ?>" readonly/></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['PASSWORD']; ?> </td>
    <td width="83%" bgcolor="#CCCC66"><input type="password" name="password" id="password" title="<?php echo $lang['siya']['admin']['PASSWORD']; ?>"  size="95" /></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['RETYPE_PASSWORD ']; ?> </td>
    <td width="83%" bgcolor="#CCCC66"><input type="password" name="password2" id="password2" size="95" /></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['FIRST_NAME']; ?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="fname" id="fname" title="<?php echo $lang['siya']['admin']['FIRST_NAME']; ?>" size="95" value="<?php echo $fname_placeholder; ?>"/></td>
  </tr>
  <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['LAST_NAME']; ?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="lname" id="lname" title="<?php echo $lang['siya']['admin']['LAST_NAME']; ?>" size="95" value="<?php echo $lname_placeholder; ?>"/></td>
  </tr>
    <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['EMAIL']; ?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="email" id="email" title="<?php echo $lang['siya']['admin']['EMAIL']; ?>" size="95" value="<?php echo $email_placeholder; ?>"/></td>
  </tr>	
	<tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['PHONE']; ?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="phone" id="phone" title="<?php echo $lang['siya']['admin']['PHONE']; ?>" size="95" value="<?php echo $phone_placeholder; ?>"/></td>
  </tr>
    <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['ADDRESS_LINE_1']; ?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="addressline1" id="addressline1" title="<?php echo $lang['siya']['admin']['ADDRESS_LINE_1']; ?>" size="95" value="<?php echo $addressline1_placeholder; ?>"/></td>
  </tr>
    <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['ADDRESS_LINE_2']; ?></td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="addressline2" id="addressline2" title="<?php echo $lang['siya']['admin']['ADDRESS_LINE_2']; ?>" size="95" value="<?php echo $addressline2_placeholder; ?>"/></td>
  </tr>
     <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['CITY']; ?> </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="city" id="city" size="95" title="<?php echo $lang['siya']['admin']['CITY']; ?>" value="<?php echo $city_placeholder; ?>"/></td>
  </tr>
     <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['STATE'];?> </td>
    <td width="83%" bgcolor="#CCCC66"><input type="text" name="state" id="state" size="95" title="<?php echo $lang['siya']['admin']['STATE'];?>" value="<?php echo $state_placeholder; ?>"/></td>
  </tr>
     <tr>
  <td width="17%" bgcolor="#CCCC66"><?php echo $lang['siya']['admin']['COUNTRY'];?></td>
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