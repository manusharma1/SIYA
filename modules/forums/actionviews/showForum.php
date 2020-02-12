<?php
$id = _ACTION_VIEW_PARAMETER_ID;

$columns = array('id','description','name');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'forums', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){
$sid_placeholder = $sqlObj->getCleanData($resultset->id);
$name_placeholder = $sqlObj->getCleanData($resultset->name);	
$description_placeholder = $sqlObj->getCleanData($resultset->description);
$url='forums/showForum/'.$sid_placeholder.'/';

?>

<h3 class="headingh3">Forum : <?php echo $name_placeholder; ?></h3>
<p><?php echo $description_placeholder; ?></p>
<?php
}
}
}else{
trigger_error('Data Fetch Error');
}		
?>

<?php
if(PROJ_RUN_AJAX==1){
$formaction2 = MainSystem::URLCreator('forums/addForumCategory/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction2 = MainSystem::URLCreator('forums/addForumCategory/');
}
?>

	<form id="addform2" name="addform2" method="post" action="<?php echo $formaction2; ?>">

		<fieldset>

		<legend>Categories</legend>


		<?php
		$columns2 = array('id','name');
		$conditions2 = array();
		$conditions2['=']['forumid'] = $id;
		$sqlObj = new MainSQL();
		$sql = $sqlObj->SQLCreator('S', 'forumcategories', $columns2, $conditions2, '', '', '');

		if($result2 = $sqlObj->FireSQL($sql)){
		if($sqlObj->getNumRows($result2) !=0){ 
		while($resultset2 = $sqlObj->FetchResult($result2)){
		$id_placeholder = $sqlObj->getCleanData($resultset2->id);
		$name_placeholder = $sqlObj->getCleanData($resultset2->name);	
		$url='forums/showAllForumTopic/'.$id_placeholder.'/';

		?>
		

		<p class="bigtext"><a href="<?php echo MainSystem::URLCreator($url); ?>"><?php echo $name_placeholder; ?></a>

		<?php 
		if(isset($_SESSION['controllers']['SHOWCONTROLS']) && $_SESSION['controllers']['SHOWCONTROLS']==1){
		?>
		<a href="<?php echo MainSystem::URLCreator('forums/editForumCategory/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_editblockcontent.png'; ?>" alt="Edit" title="Edit" /></a>
		<a href="<?php echo MainSystem::URLCreator('forums/deleteForumCategory/'.$id_placeholder.'/'); ?>"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_deleteblockcontent.png'; ?>" alt="Delete" title="Delete" /></a>
		<a href="#"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_inactive.png'; ?>" alt="Make this inactive" title="Make this inactive" /></a>
		<a href="#"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_moveupblock.png'; ?>" alt="Move this up" title="Move this up" /></a>
		<a href="#"><img src="<?php echo _TEMPLATE_IMG_DIR._WS.'siya_movedownblock.png'; ?>" alt="Move this down" title="Move this down" /></a>
		<?php
		}
		?>
		
		</p>
		
		<?php
		}
		}
		}else{
		trigger_error('Data Fetch Error');
		}		
		?>


		<ol>
			
		<input type="hidden" name="forumcatid" value="<?php echo $id; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
	
		</ol>
		
		</fieldset>
		
		<fieldset>

		<button type="submit">Add New Category</button>

		</fieldset>

	</form>	