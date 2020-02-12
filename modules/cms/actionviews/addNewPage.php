<?php
	
	// Create Menu and Get Menu Data

	$HTMLObj = new MainHTML();
	global $htmlarray;
	$htmlarray = array();
	$htmlarray[]['select']['nameid'] = 'menuid';
	$htmlarray[]['select']['onChange'] = MainSystem::URLCreator('cms/getPagesByMenu/','ajax','get','getMenuID','parentpage',false);
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

	$input_data_placeholder = MainSystem::HTMLEditorInit('data');
	
	$input_data2_placeholder = MainSystem::HTMLEditorInit('data2');

	$input_datamore_placeholder = MainSystem::HTMLEditorInit('datamore');
	
	$input_data2more_placeholder = MainSystem::HTMLEditorInit('data2more');
?>


	<script>
	$(document).ready(function(){
	$("#formaddnewpage").validate();
	});
	</script>
	
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('cms/savePage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('cms/savePage/');
	}
	?>

	<form id="formaddnewpage" name="formaddnewpage" method="post" action="<?php echo $formaction; ?>">
	
	<fieldset>
	<legend><?php echo $lang['siya']['cms']['ADD_NEW_PAGE'];?></legend>	
	<ol>
		<li>
		<label for="pagename"><?php echo $lang['siya']['cms']['PAGE_NAME']; ?> </label>
		<input type="text" name="name" id="name" size="95" <?php echo _FORM_FINAL; ?>/>
		</li>
  
		<li>
		<label for="pagetitle"><?php echo $lang['siya']['cms']['PAGE_TITLE']; ?> </label>
		<input type="text" name="title" id="title" size="95" <?php echo _FORM_FINAL; ?>/>
		</li>

		<li>
		<label for="menu"><?php echo $lang['siya']['cms']['MENU']; ?></label>
		<?php echo $menu_placeholder; ?>
		</li>


		<li>
		<label for="parentpage"><?php echo $lang['siya']['cms']['PARENT_PAGE']; ?></label><br />
		<div id="parentpage" name="parentpage"></div>
		</li>

		<li>
		<label for="pagecontent"><?php echo $lang['siya']['cms']['PAGE_CONTENT'];?></label><br />
		<?php  echo $input_data_placeholder; ?>
		</li>

		<li>
		<label for="pagecontentmore"><?php echo $lang['siya']['cms']['PAGE_CONTENT_MORE'];?></label><br /><br />
		<?php  echo $input_datamore_placeholder; ?>
		</li>

		<li>
		<label for="pagecontent2"><?php echo $lang['siya']['cms']['PAGE_CONTENT2'];?> </label><br /><br /><br /><br /><br />
	    <?php  echo $input_data2_placeholder; ?>
		</li>

		<li>
		<label for="pagecontentmore2"><?php echo $lang['siya']['cms']['PAGE_CONTENT2_MORE'];?></label><br /><br />
	    <?php  echo $input_data2more_placeholder; ?>
		</li>

		<li>
		<label for="metakeywords"><?php echo $lang['siya']['cms']['META_KEYWORDS'];?> </label>
		<textarea name="metakeys" cols="85" rows="5"></textarea>
		</li>

		<li>
		<label for="metadescription"><?php echo $lang['siya']['cms']['META_DESCRIPTION'];?></label>
	    <textarea name="metadesc" cols="85" rows="5"></textarea>
		</li>

		</ol>

<fieldset>

	<button type="submit"><?php echo $lang['siya']['cms']['SAVE'];?></button>

</fieldset>

</form>