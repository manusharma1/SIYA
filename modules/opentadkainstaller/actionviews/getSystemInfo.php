<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT  - DO NOT REMOVE THIS NOTICE                      //
//                                                                       //
// OPENTADKA FRAMEWORK											         //
//          http://www.opentadka.org                                     //
//                                                                       //
// Copyright (C) 2010 onwards  Manu Sharma  http://www.opentadka.org     //
//                                                                       //
// STUDENT INFORMATION YARN (SIYA)								         //
//          http://www.siya.org.in                                       //
//                                                                       //
// Copyright (C) 2012 onwards  Manu Sharma  http://www.siya.org.in       //
//                                                                       //
// OPENTADKA FRAMEWORK LICENSE :                                         //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
// STUDENT INFORMATION YARN (SIYA) LICENSE :                             //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//   OPENTADKA FRAMEWORK & STUDENT INFORMATION YARN (SIYA)               //
//   FOR LICENCESPLEASE REFER LICENCE PAGE                               //
//   FOR MORE DETAILS                                                    //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

//GET ALL MODULES AND BLOCKS DIR INFO//
// NOTE : The DirectoryIterator class may be used in Future Versions as it is supported only in PHP 5 and Above //

$installed_modules_core_array = array();
$installed_modules_non_core_array = array();
$inactive_modules_non_core_array = array();


if(PROJ_RUN_AJAX==1){
$formaction_install_module = MainSystem::URLCreator('opentadkainstaller/installModule/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
$formaction_uninstall_module = MainSystem::URLCreator('opentadkainstaller/uninstallModule/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
$formaction_deactivate_module = MainSystem::URLCreator('opentadkainstaller/deactivateModule/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
$formaction_activate_module = MainSystem::URLCreator('opentadkainstaller/activateModule/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction_install_module = MainSystem::URLCreator('opentadkainstaller/installModule/');
$formaction_uninstall_module = MainSystem::URLCreator('opentadkainstaller/uninstallModule/');
$formaction_deactivate_module = MainSystem::URLCreator('opentadkainstaller/deactivateModule/');
$formaction_activate_module = MainSystem::URLCreator('opentadkainstaller/activateModule/');
}

$columns = array('value');
$conditions = array();
$conditions['=']['name'] = 'module';
$conditions['AND =']['isinstalled'] = '1';
$conditions['AND =']['iscore'] = '0';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$installed_modules_non_core_array[] = $resultset->value;
}
}
}


$columns = array('value');
$conditions = array();
$conditions['=']['name'] = 'module';
$conditions['AND =']['isactive'] = '0';
$conditions['AND =']['iscore'] = '0';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$inactive_modules_non_core_array[] = $resultset->value;
}
}
}

$columns = array('value');
$conditions = array();
$conditions['=']['name'] = 'module';
$conditions['AND =']['iscore'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$installed_modules_core_array[] = $resultset->value;
}
}
}


?>
<h1>The System has detected The Following Modules To Run any Module it needs to be Installed and Activated on the System, You can also Uninstall or Deactivate the already Installed Modules</h1>
<?php
$dirs = glob(PROJ_MODULES_DIR._S.'*',GLOB_ONLYDIR); 
foreach ($dirs as $dir){
$dirarray = explode(PROJ_MODULES_DIR._S,$dir);
$module_dir_name = end($dirarray);
if(in_array($module_dir_name,$installed_modules_non_core_array)){
?>
<hr />
<form name="uninstall_<?php echo $module_dir_name;?>" action="<?php echo $formaction_uninstall_module; ?>" method="post">
<h2><strong><?php echo $module_dir_name;?> Module</strong></h2>
<input type="hidden" name="modulename" value="<?php echo $module_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button red large" name="submit" value="Uninstall" />
</form>
<?php
if(in_array($module_dir_name,$inactive_modules_non_core_array)){
?>
<form name="activate_<?php echo $module_dir_name;?>" action="<?php echo $formaction_activate_module; ?>" method="post">
<input type="hidden" name="modulename" value="<?php echo $module_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button orange large" name="submit" value="Activate" />
</form>
<?php
}else{
?>
<form name="deactivate_<?php echo $module_dir_name;?>" action="<?php echo $formaction_deactivate_module; ?>" method="post">
<input type="hidden" name="modulename" value="<?php echo $module_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button purple large" name="submit" value="Deactivate" />
</form>
<?php
}
?>
<?php
}else if(!in_array($module_dir_name,$installed_modules_core_array)){
?>
<hr />
<form name="install_<?php echo $module_dir_name;?>" action="<?php echo $formaction_install_module; ?>" method="post">
<h2><strong><?php echo $module_dir_name;?> Module</strong></h2>
<input type="hidden" name="modulename" value="<?php echo $module_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button green large" name="submit" value="Install" />
</form>
<?php
}
}
?>

<br /><br /><br /><br />

<?php // BLOCKS START HERE //


$installed_blocks_core_array = array();
$installed_blocks_non_core_array = array();
$inactive_blocks_non_core_array = array();


if(PROJ_RUN_AJAX==1){
$formaction_install_block = MainSystem::URLCreator('opentadkainstaller/installBlock/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
$formaction_uninstall_block = MainSystem::URLCreator('opentadkainstaller/uninstallBlock/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
$formaction_deactivate_block = MainSystem::URLCreator('opentadkainstaller/deactivateBlock/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
$formaction_activate_block = MainSystem::URLCreator('opentadkainstaller/activateBlock/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction_install_block = MainSystem::URLCreator('opentadkainstaller/installBlock/');
$formaction_uninstall_block = MainSystem::URLCreator('opentadkainstaller/uninstallBlock/');
$formaction_deactivate_block = MainSystem::URLCreator('opentadkainstaller/deactivateBlock/');
$formaction_activate_block = MainSystem::URLCreator('opentadkainstaller/activateBlock/');
}

$columns = array('value');
$conditions = array();
$conditions['=']['name'] = 'block';
$conditions['AND =']['isinstalled'] = '1';
$conditions['AND =']['iscore'] = '0';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$installed_blocks_non_core_array[] = $resultset->value;
}
}
}


$columns = array('value');
$conditions = array();
$conditions['=']['name'] = 'block';
$conditions['AND =']['isactive'] = '0';
$conditions['AND =']['iscore'] = '0';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$inactive_blocks_non_core_array[] = $resultset->value;
}
}
}

$columns = array('value');
$conditions = array();
$conditions['=']['name'] = 'block';
$conditions['AND =']['iscore'] = '1';
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
while($resultset = $sqlObj->FetchResult($result)){
$installed_blocks_core_array[] = $resultset->value;
}
}
}


?>
<h1>The System has detected The Following Blocks To Run any Block it needs to be Installed and Activated on the System, You can also Uninstall or Deactivate the already Installed Blocks</h1>
<?php
$dirs = glob(PROJ_BLOCKS_DIR._S.'*',GLOB_ONLYDIR); 
foreach ($dirs as $dir){
$dirarray = explode(PROJ_BLOCKS_DIR._S,$dir);
$block_dir_name = end($dirarray);
if(in_array($block_dir_name,$installed_blocks_non_core_array)){
?>
<hr />
<form name="uninstall_<?php echo $block_dir_name;?>" action="<?php echo $formaction_uninstall_block; ?>" method="post">
<h2><strong><?php echo $block_dir_name;?> Block</strong></h2>
<input type="hidden" name="blockname" value="<?php echo $block_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button red large" name="submit" value="Uninstall" />
</form>
<?php
if(in_array($block_dir_name,$inactive_blocks_non_core_array)){
?>
<form name="activate_<?php echo $block_dir_name;?>" action="<?php echo $formaction_activate_block; ?>" method="post">
<input type="hidden" name="blockname" value="<?php echo $block_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button orange large" name="submit" value="Activate" />
</form>
<?php
}else{
?>
<form name="deactivate_<?php echo $block_dir_name;?>" action="<?php echo $formaction_deactivate_block; ?>" method="post">
<input type="hidden" name="blockname" value="<?php echo $block_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button purple large" name="submit" value="Deactivate" />
</form>
<?php
}
?>
<?php
}else if(!in_array($block_dir_name,$installed_blocks_core_array)){
?>
<hr />
<form name="install_<?php echo $block_dir_name;?>" action="<?php echo $formaction_install_block; ?>" method="post">
<h2><strong><?php echo $block_dir_name;?> Block</strong></h2>
<input type="hidden" name="blockname" value="<?php echo $block_dir_name;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button green large" name="submit" value="Install" />
</form>
<?php
}
}
?>
