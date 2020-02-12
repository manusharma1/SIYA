<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	$groupid = (isset($parameters[1]))?$parameters[1]:'';
	MainSystem::CheckGroupPermissions($groupid,'group');


?>
<style>
html, body{ height:100%; }
</style>
<iframe style="overflow:visible; height:1000px;" src="<?php echo MainSystem::URLCreator('topiccontents/openTopicContentFile/'.$id.'/')?>"></iframe>