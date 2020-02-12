<?php
	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	$groupid = (isset($parameters[1]))?$parameters[1]:'';
	MainSystem::CheckGroupPermissions($groupid,'group');

$columns = array('id','contenttype','title','data');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'topiccontentsdata', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$content_id = $sqlObj->getCleanData($resultset->id);
$contenttype = $sqlObj->getCleanData($resultset->contenttype);
$contenttitle = $sqlObj->getCleanData($resultset->title);
$contentdata = $sqlObj->getCleanData($resultset->data);
}
}
}
?>

<h1><?php echo $contenttitle; ?></h1><br /><hr />
<?php echo $contentdata; ?>