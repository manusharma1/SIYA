<?php
$modulename = $_POST['modulename'];

if(PROJ_RUN_AJAX==1){
$formaction_module = MainSystem::URLCreator('opentadkainstaller/installModuleConfirmed/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction_module = MainSystem::URLCreator('opentadkainstaller/installModuleConfirmed/');
}

$install_module_cancel  = 'opentadkainstaller/getSystemInfo/';

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center">

<br /><b>Are you sure you want to Add this Module: "<?php echo $modulename; ?>" ? </b>

<br /><br /> 

<form name="install_<?php echo $modulename;?>" action="<?php echo $formaction_module; ?>" method="post">
<input type="hidden" name="modulename" value="<?php echo $modulename;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button green" name="submit" value="Yes Install this Module" />
<input type="button" class="button red" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($install_module_cancel);?>';" name="cancel" value="Cancel" />
<br /><br />
</form>
</td>
</tr>
</table>