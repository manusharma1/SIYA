<?php
$blockname = $_POST['blockname'];

if(PROJ_RUN_AJAX==1){
$formaction_block = MainSystem::URLCreator('opentadkainstaller/uninstallBlockConfirmed/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction_block = MainSystem::URLCreator('opentadkainstaller/uninstallBlockConfirmed/');
}

$uninstall_block_cancel  = 'opentadkainstaller/getSystemInfo/';

?>

<table width="100%" border="0" bgcolor="#CC9933" align="center">
<tr>
<td width="100%" bgcolor="#CCCC66" align="center">

<br /><b>Are you sure you want to Uninstall this Block: "<?php echo $blockname; ?>" ? </b>

<br /><br /> 

<form name="uninstall_<?php echo $blockname;?>" action="<?php echo $formaction_block; ?>" method="post">
<input type="hidden" name="blockname" value="<?php echo $blockname;?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
<input type="submit" class="button green" name="submit" value="Yes Uninstall this Block" />
<input type="button" class="button red" onclick="JavaScript:document.location.href='<?php echo MainSystem::URLCreator($uninstall_block_cancel);?>';" name="cancel" value="Cancel" />
<br /><br />
</form>
</td>
</tr>
</table>