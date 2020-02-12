<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<?php
	$columns = array('id','fromid','chattext','datetime');
	$conditions = array();
	$conditions['<']['datetime'] =  date('Y-m-d H:i:s');
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'chattemprecords', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$chattext_placeholder = $sqlObj->getCleanData($resultset->chattext);	
	
	
	?>
	
	<p><?php echo $chattext_placeholder; ?></p>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>



<div id="chattext">
	
<br/></div>

<script>
window.setInterval("reloadIFrame();", 5000);

function reloadIFrame() {
 document.frames["chattext"].location.reload();
}
</script>