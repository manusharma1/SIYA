<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$forumtopicid = '';

$columns = array('id','title','content','forumcatid','addedby');
$conditions = array();
$conditions['=']['id'] = $id;
$sqlObj = new MainSQL();
$sql = $sqlObj->SQLCreator('S', 'forumtopics', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
while($resultset = $sqlObj->FetchResult($result)){
$forumtopicid = $sqlObj->getCleanData($resultset->id);
$title = $sqlObj->getCleanData($resultset->title);	
$forumcatid = $sqlObj->getCleanData($resultset->forumcatid);	
$content = $sqlObj->getCleanData($resultset->content);
$addedby = $sqlObj->getCleanData($resultset->addedby);
?>
	
<h3 class="headingh3"><?php echo $title; ?></h3>
<p class="mediumtext"><img src="<?php echo MainSystem::URLCreator('users/showUserImageByID/'.$addedby.',1/'); ?>" width="40px" height="40px" align="left"/>
<?php echo $content; ?></p>


<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('forums/replyForumTopic/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('forums/replyForumTopic/');
}
?>

	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">

		<fieldset>

		<?php

		$columns2 = array('ft.id','ft.title','ft.content','ft.added','u.username','u.id = userid');
		$conditions2 = array();

		$tables = array();
		$tables['forumtopics'] = 'ft';
		$tables['users'] = 'u';
	
		$conditions2['=']['ft.forumcatid'] = $forumcatid;
		$conditions2['AND =']['ft.replyid'] = $id;
		$conditions2['K AND =']['ft.addedby'] = 'u.id';

		$sqlObj = new MainSQL();
		$sql = $sqlObj->SQLCreatorJ('S',  $tables, $columns2, $conditions2, '', '', '');
		
		if($result2 = $sqlObj->FireSQL($sql)){
		if($sqlObj->getNumRows($result2) !=0){ 
		while($resultset2 = $sqlObj->FetchResult($result2)){
		$forumtopicid = $sqlObj->getCleanData($resultset2->id);
		$title1 = $sqlObj->getCleanData($resultset2->title);	
		$content1 = $sqlObj->getCleanData($resultset2->content);
		$added = $sqlObj->getCleanData($resultset2->added);	
		$username = $sqlObj->getCleanData($resultset2->username);
		$userid = $sqlObj->getCleanData($resultset2->userid);	
		?>
		
		<p><?php echo $title1.'<br /> '.$content1.'<br /> ';?>
		<img src="<?php echo MainSystem::URLCreator('users/showUserImageByID/'.$userid.',1/'); ?>" width="40px" height="40px" align="left"/>
		<?php echo 'On : '.$added.' By: '.$username.'<hr />'; ?></p>
											
		<?php
		}
		}
		}else{
		trigger_error('Data Fetch Error');
		}		
		?>
		</fieldset>
		
		<fieldset>
		<input type="hidden" name="forumtopicid" value="<?php echo $id; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
		<input type="hidden" name="forumcatid" value="<?php echo $forumcatid; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>

		<button type="submit">Add Reply To This Comment</button>

		</fieldset>

	</form>	



									
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
	$formaction2 = MainSystem::URLCreator('forums/replyForumTopic/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction2 = MainSystem::URLCreator('forums/replyForumTopic/');
	}
	?>

	<form id="addform2" name="addform2" method="post" action="<?php echo $formaction2; ?>">

		<fieldset>
		<ol>
			
		<input type="hidden" name="forumtopicid" value="<?php echo $id; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
		<input type="hidden" name="forumcatid" value="<?php echo $forumcatid; ?>"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"/>
		</ol>
		
		</fieldset>
		
		<fieldset>

		<button type="submit">Reply To This Topic</button>

		</fieldset>

	</form>	