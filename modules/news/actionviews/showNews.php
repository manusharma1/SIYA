<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

<h3>News Detail</h3>

	<?php
	$columns = array('newstitle','newstext','newsdate');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$conditions['AND =']['isactive'] = 1;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'news', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$newstitle = $sqlObj->getCleanData($resultset->newstitle);	
	$newstext = $sqlObj->getCleanData($resultset->newstext);
	$newsdate = $sqlObj->getCleanData($resultset->newsdate);

	$url='news/showNews/'.$id.'/';
	?>
	<br /><br />
	<hr />
	<h3><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $newstitle; ?></a></h3>
	<h4><?php echo $newsdate; ?></h4>
	<p><?php echo $newstext; ?></p>

										
	<?php
	}
	}
	}else{
	trigger_error($lang['siya']['DATA_FETCH_ERROR']);
	}		
	?>


