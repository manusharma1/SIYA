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
$formaction = MainSystem::URLCreator('importexport/saveStudentParentFromExcel/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('importexport/saveStudentParentFromExcel/');
}
?>
<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>" enctype="multipart/form-data">

<fieldset>

	<legend>Import Bulk Students From Excel</legend>

	<ol>
		<li>
		<label for="select">Select A </label><select name="A" id="A" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select B </label><select name="B" id="B" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>
		
		<li>
		<label for="select">Select C </label><select name="C" id="C" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select D </label><select name="D" id="D" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select E </label><select name="E" id="E" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		
		<li>
		<label for="select">Select F </label><select name="F" id="F" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		
		<li>
		<label for="select">Select G </label><select name="G" id="G" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select H </label><select name="H" id="H" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select I </label><select name="I" id="I" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select J </label><select name="J" id="J" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select K </label><select name="K" id="K" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>

		<li>
		<label for="select">Select L </label><select name="L" id="L" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select M </label><select name="M" id="M" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select N </label><select name="N" id="N" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select O </label><select name="O" id="O" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select P </label><select name="P" id="P" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select Q </label><select name="Q" id="Q" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select R </label><select name="R" id="R" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="rollno" SELECTED>Roll No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select S </label><select name="S" id="S" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa" SELECTED>Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select T </label><select name="T" id="T" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname" SELECTED>Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile" >Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select U </label><select name="U" id="U" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber" SELECTED>Emergency Contact Number</option>
		<option value="photofile">Upload Photo File</option>
		</select>
		</li>


		<li>
		<label for="select">Select V </label><select name="V" id="V" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="registrationno">Registration No</option>
		<option value="doa">Date Of Addmission </option>
		<option value="emergencycontactname">Emergency Contact Name</option>
		<option value="emergencycontactnumber">Emergency Contact Number</option>
		<option value="photofile" SELECTED>Upload Photo File</option>
		</select>
		</li>


		</ol>
		<hr />



	<legend>Import Bulk Parents Details From Excel</legend>

	<ol>
		<li>
		<label for="select">Select PA </label><select name="PA" id="PA" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PB </label><select name="PB" id="PB" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>
		
		<li>
		<label for="select">Select PC </label><select name="PC" id="PC" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PD </label><select name="PD" id="PD" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PE </label><select name="PE" id="PE" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		
		<li>
		<label for="select">Select PF </label><select name="PF" id="PF" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		
		<li>
		<label for="select">Select PG </label><select name="PG" id="PG" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PH </label><select name="PH" id="PH" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PI </label><select name="PI" id="PI" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PJ </label><select name="PJ" id="PJ" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PK </label><select name="PK" id="PK" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PL </label><select name="PL" id="PL" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PM </label><select name="PM" id="PM" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PN </label><select name="PN" id="PN" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PO </label><select name="PO" id="PO" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PP </label><select name="PP" id="PP" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PQ </label><select name="PQ" id="PQ" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PR </label><select name="PR" id="PR" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation" SELECTED>Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PS </label><select name="PS" id="PS" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1" SELECTED>Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PT </label><select name="PT" id="PT" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2" SELECTED>Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PU </label><select name="PU" id="PU" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity" SELECTED>Office City</option>
		<option value="officestate">Office State</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PV </label><select name="PV" id="PV" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate" SELECTED>Office State</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PW </label><select name="PW" id="PW" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry" SELECTED>Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>
		
		<li>
		<label for="select">Select PX </label><select name="PX" id="PX" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone" SELECTED>Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>


		<li>
		<label for="select">Select PY </label><select name="PY" id="PY" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile" SELECTED>Upload Photo File</option>
		<option value="resumefile">Resume File</option>
		</select>
		</li>

		<li>
		<label for="select">Select PZ </label><select name="PZ" id="PZ" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="usertypetag" >User Type Tag</option>
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
		<option value="occupation">Occupation</option>
		<option value="officeaddressline1">Office Address 1 </option>
		<option value="officeaddressline2">Office Address 2</option>
		<option value="officecity">Office City</option>
		<option value="officestate">Office State 	</option>
		<option value="officecountry">Office Country</option>
		<option value="officephone">Office Phone</option>
		<option value="photofile">Upload Photo File</option>
		<option value="resumefile" SELECTED>Resume File</option>
		</select>
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