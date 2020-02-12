<?php
$excelfile = '';



if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
?>

<script>
$(document).ready(function(){
$("#addform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('importexport/saveStaffFromExcel/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('importexport/saveStaffFromExcel/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend>Import Bulk Staff Details From Excel</legend>

	<ol>
		<li>
		<label for="select">Select A </label><select name="A" id="A" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" SELECTED>Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select B </label><select name="B" id="B" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag" SELECTED>User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>
		
		<li>
		<label for="select">Select C </label><select name="C" id="C" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag" SELECTED>Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select D </label><select name="D" id="D" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username" SELECTED>User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select E </label><select name="E" id="E" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password" SELECTED>Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		
		<li>
		<label for="select">Select F </label><select name="F" id="F" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname" SELECTED>First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		
		<li>
		<label for="select">Select G </label><select name="G" id="G" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname" SELECTED>Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select H </label><select name="H" id="H" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname" SELECTED>Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select I </label><select name="I" id="I" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender" SELECTED>Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select J </label><select name="J" id="J" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email" SELECTED>Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select K </label><select name="K" id="K" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone" SELECTED>Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select L </label><select name="L" id="L" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1" SELECTED>Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select M </label><select name="M" id="M" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2" SELECTED>Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select N </label><select name="N" id="N" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city" SELECTED>City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select O </label><select name="O" id="O" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state" SELECTED>State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select P </label><select name="P" id="P" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country" SELECTED>Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select Q </label><select name="Q" id="Q" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality" SELECTED>Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select R </label><select name="R" id="R" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob" SELECTED>Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select S </label><select name="S" id="S" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj" SELECTED>Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select T </label><select name="T" id="T" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup" SELECTED>Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select U </label><select name="U" id="U" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname" SELECTED>Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>


		<li>
		<label for="select">Select V </label><select name="V" id="V" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber" SELECTED>Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select W </label><select name="W" id="W" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications" SELECTED>Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select X </label><select name="X" id="X" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile" SELECTED>Upload Photo File</option>
		<option value="resumefile">Resumefile</option>
		</select>
		</li>

		<li>
		<label for="select">Select Y </label><select name="Y" id="Y" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="empid" >Employee Id</option>
		<option value="usertypetag">User Type Tag</option>
		<option value="entitytypetag">Entity Type Tag</option>
		<option value="username">User Name</option>
		<option value="password">Password</option>
		<option value="fname">First Name</option>
		<option value="mname">Middle Name</option>
		<option value="lname">Last Name</option>
		<option value="gender">Gender</option>
		<option value="email">Email - Id</option>
		<option value="phone">Phone Number</option>
		<option value="addressline1">Address 1</option>
		<option value="addressline2">Address 2</option>
		<option value="city">City</option>
		<option value="state">State </option>
		<option value="country">Country</option>
		<option value="nationality">Nationality</option>
		<option value="dob">Date Of Birth</option>
		<option value="doj">Date Of Joining</option>
		<option value="bloodgroup">Blood Group</option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="qualifications">Qualifications</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile" SELECTED>Resumefile</option>
		</select></label>
		</li>


		<li>
		<label for="chosenfile"><?php echo $lang['siya']['importexport']['SELECT_EXCEL_FILE'];?></label>
		<input id="chosenfile" name="chosenfile" type="file" placeholder="<?php echo $lang['siya']['importexport']['SELECT_EXCEL_FILE'];?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>

<?php
/*$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=newstitle,newstext,newsdate:onsubmit=addnewnews:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;*/
?>