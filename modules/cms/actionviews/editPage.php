<?php
	$id = _ACTION_VIEW_PARAMETER_ID;
	
	MainSystem::CheckIDExists('content','id',$id,'cms/managePages/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('content','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}
	
	// Define PlaceHolders
	$page_name_placeholder = '';
	$page_title_placeholder = '';
	$menu_placeholder = '';
	$input_data_placeholder = '';
	$input_data2_placeholder = '';
	$input_datamore_placeholder = '';
	$input_data2more_placeholder = '';
	$meta_keys_placeholder = '';
	$meta_desc_placeholder = '';


	MainSystem::CheckOtherUsersActionAccess('content','addedby',$id);

	// Get Page Data
	$columns = array('id','pid','menuid','name','title','data','datamore','data2','data2more','metadesc','metakeys');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sqlpagecontents = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');
	if($resultpagecontents = $sqlObj->FireSQL($sqlpagecontents)){
	if($sqlObj->getNumRows($resultpagecontents) !=0){ // If Page Exists
	if($resultsetpagecontents = $sqlObj->FetchResult($resultpagecontents)){
	
	$page_name_placeholder = $sqlObj->getCleanData($resultsetpagecontents->name);
	$page_title_placeholder = $sqlObj->getCleanData($resultsetpagecontents->title);
	$meta_keys_placeholder = $sqlObj->getCleanData($resultsetpagecontents->metakeys);
	$meta_desc_placeholder = $sqlObj->getCleanData($resultsetpagecontents->metadesc);
	global $pagemenuid,$parentpageid,$pageid;
	$pageid = $id;
	$pagemenuid = $resultsetpagecontents->menuid;
	$parentpageid = $resultsetpagecontents->pid;
	}else{
	trigger_error('Data Fetch Error');
	}
	}else{ // if Page Doesn't Exists
	$_SESSION['message'] = 'Page Does Not Exists';
	MainSystem::URLForwarder(MainSystem::URLCreator('cms/managePages/'));
	}
	}else{
	trigger_error('SQL Error');
	}
	
	// Create Menu and Get Menu Data

	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'menuid';
	$htmlarray[]['select']['onChange'] = MainSystem::URLCreator('cms/getPagesByMenu/'.$id.'/','ajax','get','getMenuID','parentpage',false);
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = 0;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	function recursiveMenu($menuid='',$level){
	global $htmlarray,$pagemenuid,$level;
	$level++;
	$columns = array('id','pid','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND =']['pid'] = $menuid;

	$sqlObj = new MainSQL();
	$sqlmenu = $sqlObj->SQLCreator('S', 'menu', $columns, $conditions, '', '', '');

	if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
	if($sqlObj->getNumRows($resultmenu)!=0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$str = '';
	for($i=0;$i<=$level;$i++){
	$str .= '-';
	}
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultsetmenu->id;
	($resultsetmenu->id == $pagemenuid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->name);
	$htmlarray[]['option']['end'] = '';
	if($resultsetmenu->id != $menuid){
	recursiveMenu($resultsetmenu->id,$level);
	$level--;
	}
	}
	}
	}
	}

	recursiveMenu(0,0);
	$htmlarray[]['select']['end'] = '';
	$menu_placeholder = $HTMLObj->HTMLCreator($htmlarray);


	// Create Page Menu and Get Page Menu Data

	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'pid';
	$htmlarray[]['select']['close'] = '';

	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = 0;
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = '------------------';
	$htmlarray[]['option']['end'] = '';

	function recursivePageMenu2($menuid='',$pagelevel){
	global $htmlarray,$parentpageid,$pagelevel,$pagemenuid,$pageid;
	$pagelevel++;
	$columns = array('id','pid','name');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$conditions['AND =']['menuid'] = $pagemenuid;
	$conditions['AND =']['pid'] = $menuid;
	$conditions['AND !=']['id'] = $pageid;


	$sqlObj = new MainSQL();
	$sqlmenu = $sqlObj->SQLCreator('S', 'content', $columns, $conditions, '', '', '');

	if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
	if($sqlObj->getNumRows($resultmenu)!=0){
	while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
	$str = '';
	for($i=0;$i<=$pagelevel;$i++){
	$str .= '----';
	}
	$htmlarray[]['option']['start'] = '';
	$htmlarray[]['option']['value'] = $resultsetmenu->id;
	($resultsetmenu->id == $parentpageid)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
	$htmlarray[]['option']['close'] = '';
	$htmlarray[]['option']['data'] = $str.$sqlObj->getCleanData($resultsetmenu->name);
	$htmlarray[]['option']['end'] = '';
	if($resultsetmenu->id != $menuid){
	recursivePageMenu2($resultsetmenu->id,$pagelevel);
	$pagelevel--;
	}
	}
	}
	}
	}

	recursivePageMenu2(0,0);

	$htmlarray[]['select']['end'] = '';
	$parent_page_placeholder = $HTMLObj->HTMLCreator($htmlarray);

	$input_data_placeholder = MainSystem::HTMLEditorInit('data',$sqlObj->getCleanData($resultsetpagecontents->data));

	$input_datamore_placeholder = MainSystem::HTMLEditorInit('datamore',$sqlObj->getCleanData($resultsetpagecontents->datamore));

	$input_data2_placeholder = MainSystem::HTMLEditorInit('data2',$sqlObj->getCleanData($resultsetpagecontents->data2));
	
	$input_data2more_placeholder = MainSystem::HTMLEditorInit('data2more',$sqlObj->getCleanData($resultsetpagecontents->data2more));


	if(isset($_POST) && isset($_POST['issubmit'])){
	$page_name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
	$page_title_placeholder = (isset($_POST['title']))?$_POST['title']:'';

	}
?>

	<script>
	$(document).ready(function(){
	$("#addform").validate();
	});
	</script>
	
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('cms/savePage/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('cms/savePage/'.$id.'/');
	}
	?>

	<form id="addform" name="addform" method="post" action="<?php echo $formaction; ?>">
	
	<fieldset>
	<legend><?php echo $lang['siya']['cms']['EDIT_PAGE']; ?></legend>	
	<ol>
		<li>
		<label for="seourl"><?php echo $lang['siya']['cms']['SEO_URL']; ?></label>
		<?php echo MainSystem::URLCreator('cms/getContent/'.$id.'/');?>
  </li>  
  
  <li>
   <label for="name"><?php echo $lang['siya']['cms']['PAGE_NAME']; ?></label>
    <input type="text" name="name" size="95" value="<?php echo $page_name_placeholder; ?>" />
  </li>
  <li>
    <label for="title"><?php echo $lang['siya']['cms']['PAGE_TITLE']; ?> </label>
    <input type="text" name="title" size="95" value="<?php echo $page_title_placeholder; ?>" />
  </li>

  <li>
    <label for="menu"><?php echo $lang['siya']['cms']['MENU']; ?> </label>
    <?php echo $menu_placeholder; ?>
  </li>

  <li>
    <label for="parentpage"><?php echo $lang['siya']['cms']['PARENT_PAGE']; ?></label><br />
    <div id="parentpage" name="parentpage"><?php echo $parent_page_placeholder; ?></div>
  </li>

  <li>
    <label for="pagecontent"><?php echo $lang['siya']['cms']['PAGE_CONTENT']; ?></label><br />
    <?php  echo $input_data_placeholder; ?>
  </li>

  <li>
    <label for="pagecontentmore"><?php echo $lang['siya']['cms']['PAGE_CONTENT_MORE']; ?></label><br /><br />
    <?php  echo $input_datamore_placeholder; ?>
  </li>

  <li>
    <label for="pagecontent2"><?php echo $lang['siya']['cms']['PAGE_CONTENT2']; ?></label><br /><br /><br /><br /><br />
    <?php  echo $input_data2_placeholder; ?>
  </li>
  <li>
    <label for="pagecontentmore2"><?php echo $lang['siya']['cms']['PAGE_CONTENT2_MORE']; ?></label><br /><br />
    <?php  echo $input_data2more_placeholder; ?>
  </li>
   <li>
    <label for="metakeys"><?php echo $lang['siya']['cms']['META_KEYWORDS']; ?> </label>
    <textarea name="metakeys" cols="50" rows="5"><?php echo $meta_keys_placeholder; ?></textarea>
  </li>

   <li>
    <label for="metadesc"><?php echo $lang['siya']['cms']['META_DESCRIPTION']; ?> </label>
    <textarea name="metadesc" cols="50" rows="5"><?php echo $meta_desc_placeholder; ?></textarea>
  </li>
</ol>

<fieldset>

	<button type="submit"><?php echo $lang['siya']['cms']['SAVE'];?></button>

</fieldset>

</form>