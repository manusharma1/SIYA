<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$id_placeholder = '';
?>


<h3 class="headingh3">Forum Topics</h3>

	<?php
	$columns = array('id','title','content');
	$conditions = array();
	$conditions['=']['forumcatid'] = $id;
	$conditions['AND =']['replyid'] = '0';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'forumtopics', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$title_placeholder = $sqlObj->getCleanData($resultset->title);	
	$content_placeholder = $sqlObj->getCleanData($resultset->content);
	$url='forums/showForumTopic/'.$id_placeholder.'/';

	?>
	
	<p class="bigtext"><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $title_placeholder; ?></a>
	
	
		<?php 
		if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
		?>
		<a href="<?php echo MainSystem::URLCreator('forums/editForumTopic/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_editblockcontent.png'; ?>" alt="Edit" title="Edit" /></a>
		<a href="<?php echo MainSystem::URLCreator('forums/deleteForumTopic/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_deleteblockcontent.png'; ?>" alt="Delete" title="Delete" /></a>
		<a href="#"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_inactive.png'; ?>" alt="Make this inactive" title="Make this inactive" /></a>
		<a href="#"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_moveupblock.png'; ?>" alt="Move this up" title="Move this up" /></a>
		<a href="#"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_movedownblock.png'; ?>" alt="Move this down" title="Move this down" /></a></p>
		<?php
		}
		?>
	
		
		
		</p>
	
	<?php
	}
	}
	else{
		echo "There is no topic in this category";
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>
	


<?php
	if(PROJ_RUN_AJAX==1){
	$formaction2 = MainSystem::URLCreator('forums/addForumTopic/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction2 = MainSystem::URLCreator('forums/addForumTopic/');
	}
	?>

	<form id="addform2" name="addform2" method="post" action="<?php echo $formaction2; ?>">

		<fieldset>
		<ol>
			
		<input type="hidden" name="forumcatid" value="<?php echo $id; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
	
		</ol>
		
		</fieldset>
		
		<fieldset>

		<button type="submit">Add New Topic</button>

		</fieldset>

	</form>	