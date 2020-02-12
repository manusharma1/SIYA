<?php
// SIYA PROJECT		http://www.siya.org.in

// OPENTADKA FRAMEWORK		http://www.opentadka.org

// SIYA SETUP, PLEASE DO NOT CHANGE ANYTHING
?>

<?php
if(!isset($_SESSION['modulecompletionpercentage'])){
$_SESSION['modulecompletionpercentage'] = 0;
}

if(!isset($_SESSION['blockcompletionpercentage'])){
$_SESSION['blockcompletionpercentage'] = 0;
}
?>
<p><b>Modules Installation</b></p>
<div id="modulesprogressbar" style="width:500px;border:1px solid #000000;"><div style="width:<?php echo $_SESSION['modulecompletionpercentage']; ?>%;background-color:#3FBF3F;">&nbsp;</div></div>

<p><b>Blocks Installation</b></p>
<div id="blocksprogressbar" style="width:500px;border:1px solid #000000;"><div style="width:<?php echo $_SESSION['blockcompletionpercentage']; ?>%;background-color:#3FBF3F;">&nbsp;</div></div>

<?php
if(isset($_POST['adminusertrue']) &&  ($_POST['adminusertrue'] == $_SESSION['UserLoGGedIn']) && isset($_POST['adminusertrue']) && ($_POST['siyasetuplogintrue'] == $_SESSION['SiyaSetupLogin']) && !isset($_POST['modulesetupvalue']) && !isset($_POST['blocksetupvalue'])){

$data = array();
$data['batchcode'] = $_POST['batchcode'];
$data['title'] = $_POST['batchname'];
$data['description'] = $_POST['batchname'];

$data['added'] = date('Y-m-d H:i:s');
$data['addedby'] = MainSystem::GetSessionUserID();
$data['isactive'] = 1;
$data['issystemdefault'] = 1;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('I', 'batches', $data, '', '', '', '');
if($result = $sqlObj->FireSQL($sql)){

$_SESSION['modules_setup_counter'] = 0;
$_SESSION['blocks_setup_counter'] = 0;
$_SESSION['modules_setup_total_counter'] = 0;
$_SESSION['blocks_setup_total_counter'] = 0;


$random_value = MainSystem::randomValue();

$_SESSION['modulesetupvalue'] = $random_value;

$modulepost = implode(',',$_POST['modulename']);
$blockpost = implode(',',$_POST['blockname']);


$modulearray = array();
$blockarray = array();


$modulearray = explode(',', $modulepost);
$blockarray = explode(',', $blockpost);


$modulecount = count($modulearray);
$blockcount = count($blockarray);

$modulearray_chunks = array_chunk($modulearray,3);

$modulearray_chunks_count = count($modulearray_chunks);

$modules_setup_counter = $_SESSION['modules_setup_counter'];
$blocks_setup_counter = $_SESSION['blocks_setup_counter'];


foreach($modulearray_chunks[$modules_setup_counter] as $key => $value){
MainSystem::SystemInstallModule($value);
$totalmodulesremaining = $modulecount-$_SESSION['modules_setup_total_counter'];
$_SESSION['modulecompletionpercentage'] = round(100-($totalmodulesremaining*100/$modulecount),0);
$_SESSION['modules_setup_total_counter']++;
?>

<script>
document.getElementById("modulesprogressbar").innerHTML='<div style="width:<?php echo $_SESSION[modulecompletionpercentage]?>%;background-color:#3FBF3F;">&nbsp;</div>';
</script>

<?php
}
$_SESSION['modules_setup_counter']++;
?>
<form name="siyasetupconfigmodule<?php echo $modules_setup_counter; ?>" id="siyasetupconfigmodule<?php echo $modules_setup_counter; ?>" method="post">
<input type="hidden" name="modulesetupvalue" value="<?php echo $random_value; ?>">
<input type="hidden" name="adminusertrue" value="<?php echo $_SESSION['UserLoGGedIn']; ?>">
<input type="hidden" name="siyasetuplogintrue" value="<?php echo $_SESSION['SiyaSetupLogin']; ?>">
<input type="hidden" name="modulename" value="<?php echo $modulepost; ?>">
<input type="hidden" name="blockname" value="<?php echo $blockpost; ?>">
</form>

<script>
$("#siyasetupconfigmodule<?php echo $modules_setup_counter; ?>").submit();
</script>
<?php



}else{ // if Batch Data is Saved
trigger_error('DB Error : Batch Data can\'t be Saved, Cannot Continue');
die;
}
}

if(isset($_POST['adminusertrue']) &&  ($_POST['adminusertrue'] == $_SESSION['UserLoGGedIn']) && isset($_POST['adminusertrue']) && ($_POST['siyasetuplogintrue'] == $_SESSION['SiyaSetupLogin']) && isset($_POST['modulesetupvalue']) && ($_POST['modulesetupvalue'] == $_SESSION['modulesetupvalue']) && !isset($_POST['blocksetupvalue'])){

$random_value = MainSystem::randomValue();

$_SESSION['modulesetupvalue'] = $random_value;
$_SESSION['blocksetupvalue'] = $random_value;


$modulearray = array();
$blockarray = array();

$modulearray = explode(',', $_POST['modulename']);
$blockarray = explode(',', $_POST['blockname']);

$modulecount = count($modulearray);
$blockcount = count($blockarray);

$modulearray_chunks = array_chunk($modulearray,3);
$modulearray_chunks_count = count($modulearray_chunks);

$modules_setup_counter = $_SESSION['modules_setup_counter'];

foreach($modulearray_chunks[$modules_setup_counter] as $key => $value){
MainSystem::SystemInstallModule($value);
$totalmodulesremaining = $modulecount-$_SESSION['modules_setup_total_counter'];
$_SESSION['modulecompletionpercentage'] = round(100-($totalmodulesremaining*100/$modulecount),0);
$_SESSION['modules_setup_total_counter']++;
?>
<script>
document.getElementById("modulesprogressbar").innerHTML='<div style="width:<?php echo $_SESSION[modulecompletionpercentage]?>%;background-color:#3FBF3F;">&nbsp;</div>';
</script>
<?php
}
$_SESSION['modules_setup_counter']++;

if($modulearray_chunks_count == $_SESSION['modules_setup_counter']){
$blocks_setup_counter = $_SESSION['blocks_setup_counter'];
?>
<form name="siyasetupconfigblock<?php echo $blocks_setup_counter; ?>" id="siyasetupconfigblock<?php echo $blocks_setup_counter; ?>" method="post">
<input type="hidden" name="blocksetupvalue" value="<?php echo $random_value; ?>">
<input type="hidden" name="adminusertrue" value="<?php echo $_SESSION['UserLoGGedIn']; ?>">
<input type="hidden" name="siyasetuplogintrue" value="<?php echo $_SESSION['SiyaSetupLogin']; ?>">
<input type="hidden" name="blockname" value="<?php echo $_POST['blockname']; ?>">
</form>


<script>
document.getElementById("modulesprogressbar").innerHTML='<div style="width:100%;background-color:#3FBF3F;">&nbsp;</div>';
$("#siyasetupconfigblock<?php echo $blocks_setup_counter; ?>").submit();
</script>

<?php
}else{
?>

<form name="siyasetupconfigmodule<?php echo $modules_setup_counter; ?>" id="siyasetupconfigmodule<?php echo $modules_setup_counter; ?>" method="post">
<input type="hidden" name="modulesetupvalue" value="<?php echo $random_value; ?>">
<input type="hidden" name="adminusertrue" value="<?php echo $_SESSION['UserLoGGedIn']; ?>">
<input type="hidden" name="siyasetuplogintrue" value="<?php echo $_SESSION['SiyaSetupLogin']; ?>">
<input type="hidden" name="modulename" value="<?php echo $_POST['modulename']; ?>">
<input type="hidden" name="blockname" value="<?php echo $_POST['blockname']; ?>">
</form>
<script>
$("#siyasetupconfigmodule<?php echo $modules_setup_counter; ?>").submit();
</script>

<?php
}
?>




<?php
}




if(isset($_POST['adminusertrue']) &&  ($_POST['adminusertrue'] == $_SESSION['UserLoGGedIn']) && isset($_POST['adminusertrue']) && ($_POST['siyasetuplogintrue'] == $_SESSION['SiyaSetupLogin']) && isset($_POST['blocksetupvalue']) && ($_POST['blocksetupvalue'] == $_SESSION['blocksetupvalue']) && !isset($_POST['modulesetupvalue'])){

$random_value = MainSystem::randomValue();

$_SESSION['blocksetupvalue'] = $random_value;

$modulearray = array();
$blockarray = explode(',', $_POST['blockname']);
$blockcount = count($blockarray);

$blockarray_chunks = array_chunk($blockarray,3);
$blockarray_chunks_count = count($blockarray_chunks);

$blocks_setup_counter = $_SESSION['blocks_setup_counter'];

foreach($blockarray_chunks[$blocks_setup_counter] as $key => $value){
MainSystem::SystemInstallBlock($value);
$totalblocksremaining = $blockcount-$_SESSION['blocks_setup_total_counter'];
$_SESSION['blockcompletionpercentage'] = round(100-($totalblocksremaining*100/$blockcount),0);
$_SESSION['blocks_setup_total_counter']++;
?>

<script>
document.getElementById("blocksprogressbar").innerHTML='<div style="width:<?php echo $_SESSION[blockcompletionpercentage]?>%;background-color:#3FBF3F;">&nbsp;</div>';
</script>

<?php
}
$_SESSION['blocks_setup_counter']++;

if($blockarray_chunks_count == $_SESSION['blocks_setup_counter']){

define('SIYA_ADMIN_SQL_FILES_FOLDER','sql');
define('SIYA_ADMIN_SQL_FILE_BLOCKSINSTANCES_DATA','blocksinstances.sql');
define('SIYA_ADMIN_SQL_FILE_BLOCKSINSTANCESSETTINGS_DATA','blocksinstancessettings.sql');

$sql = admin::readFileContents(SIYA_ADMIN_SQL_FILE_BLOCKSINSTANCES_DATA);
$sqlObj = new MainSQL();
if($result = $sqlObj->FireSQL($sql)){
$sql = admin::readFileContents(SIYA_ADMIN_SQL_FILE_BLOCKSINSTANCESSETTINGS_DATA);
if($result = $sqlObj->FireSQL($sql)){
?>
<script>
document.getElementById("blocksprogressbar").innerHTML='<div style="width:100%;background-color:#3FBF3F;">&nbsp;</div>';
</script>
<?php

$data = array();
$data['name'] = 'SIYA_SETUP_DONE';
$data['value'] = '1';
$data['added'] = date('Y-m-d H:i:s');
$data['addedby'] = MainSystem::GetSessionUserID();
$data['isactive'] = 1;

$sql = $sqlObj->SQLCreator('I', 'mainsystemconfig', $data, '', '', '', '');

if($result = $sqlObj->FireSQL($sql)){
$finishurl = MainSystem::URLCreator('admin/getAdminHome/');
header('Location:'.$finishurl);
}else{
trigger_error('DB Error : Unable to Add Data to Tables in Database Please check your permissions');
}

}else{
trigger_error('DB Error : Unable to Add Data to Tables in Database Please check your permissions');
}
}else{
trigger_error('DB Error : Unable to Add Data to Tables in Database Please check your permissions');
}

exit;
}
?>

<form name="siyasetupconfigblock<?php echo $blocks_setup_counter; ?>" id="siyasetupconfigblock<?php echo $blocks_setup_counter; ?>" method="post">
<input type="hidden" name="blocksetupvalue" value="<?php echo $random_value; ?>">
<input type="hidden" name="adminusertrue" value="<?php echo $_SESSION['UserLoGGedIn']; ?>">
<input type="hidden" name="siyasetuplogintrue" value="<?php echo $_SESSION['SiyaSetupLogin']; ?>">
<input type="hidden" name="blockname" value="<?php echo $_POST['blockname']; ?>">
</form>


<script>
$("#siyasetupconfigblock<?php echo $blocks_setup_counter; ?>").submit();
</script>
<?php
}
?>


<form class="form2" name="siyasetupconfig" method="post">


<fieldset>

<br /><br /><legend>Setup Your Default Batch and Enter the Code of this Batch</legend>
<ol>
<li>
<label for="batchcode">Enter Your Batch Code</label><input type="text" name="batchcode" placeholder="Enter Your Batch Code" <?php echo _FORM_FINAL;?> /><br /><br />
<label for="batchname">Select Your Default Batch</label><select name="batchname" <?php echo _FORM_FINAL;?>>
<?php
for($i=1970;$i<=2030;$i++){
if(date('Y') == $i){
$selectedtext = ' SELECTED';
}else{
$selectedtext = '';
}

?>
<option value="<?php echo $i.' - '.($i+1).' Batch'; ?>" <?php echo $selectedtext; ?>><?php echo $i.' - '.($i+1).' Batch'; ?></option>
<?php
}
?>
</select><br /><br />

</li>
</ol>

</fieldset>


<fieldset>

<legend>Modules and Blocks Details</legend>

<ol>

<h1>The System has detected The Following Modules to be Installed</h1>
<?php
$dirs = glob(PROJ_MODULES_DIR._S.'*',GLOB_ONLYDIR); 
foreach ($dirs as $dir){
$dirarray = explode(PROJ_MODULES_DIR._S,$dir);
$module_dir_name = end($dirarray);
?>
<li>
<hr />
<h2><strong><?php echo $module_dir_name;?> Module</strong></h2>
<input type="hidden" name="modulename[]" value="<?php echo $module_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<a class="button green">Ready for Install</a>
</li>
<?php
}
?>

<br /><br /><br /><br />

<?php 
// BLOCKS START HERE //
?>
<h1>The System has detected The Following Blocks to be Installed</h1>
<?php
$dirs = glob(PROJ_BLOCKS_DIR._S.'*',GLOB_ONLYDIR); 
foreach ($dirs as $dir){
$dirarray = explode(PROJ_BLOCKS_DIR._S,$dir);
$block_dir_name = end($dirarray);
?>
<li>
<hr />
<h2><strong><?php echo $block_dir_name;?> Block</strong></h2>
<input type="hidden" name="blockname[]" value="<?php echo $block_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<a class="button green">Ready for Install</a>
</li>
<?php
}
?>

</fieldset>

<input type="hidden" name="adminusertrue" value="<?php echo $_SESSION['UserLoGGedIn']; ?>">
<input type="hidden" name="siyasetuplogintrue" value="<?php echo $_SESSION['SiyaSetupLogin']; ?>">

<button type="submit">Save These Values And Finish</button>


</ol>
</form>