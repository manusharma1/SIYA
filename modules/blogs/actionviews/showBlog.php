<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

<h3>Blog Detail</h3>

	<?php
	$columns = array('id','type','data','visibility');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'blogs', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$type_placeholder = $sqlObj->getCleanData($resultset->type);	
	$data_placeholder = $sqlObj->getCleanData($resultset->data);
	$visibility_placeholder = $sqlObj->getCleanData($resultset->visibility);

	$url='blogs/showBlog/'.$id_placeholder.'/';
	?>
	
	<p><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo ' Blog Type:  '. $type_placeholder.' ('.' Visibility : ',$visibility_placeholder.')'; ?></a>
	</p>
	<p><?php echo $data_placeholder; ?></p>
										
	<?php
	}
	}
	}else{
	trigger_error($lang['siya']['DATA_FETCH_ERROR']);
	}		
	?>


