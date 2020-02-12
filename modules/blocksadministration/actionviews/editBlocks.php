<script>
$(document).ready(function(){

// http://jquerybyexample.blogspot.com/2012/05/how-to-move-items-between-listbox-using.html //

$('#buttonusertypetagright').click(function(e) {
        var selectedOpts = $('#usertypetagnotingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#usertypetagingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
		$('#usertypetagingroup option').prop('selected', 'selected');
		e.preventDefault();
    });

    $('#buttonusertypetagleft').click(function(e) {
        var selectedOpts = $('#usertypetagingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#usetypetagnotingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });



$('#buttonentitytypetagright').click(function(e) {
        var selectedOpts = $('#entitytypetagnotingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#entitytypetagingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
		$('#entitytypetagingroup option').prop('selected', 'selected');
		e.preventDefault();
    });

    $('#buttonentitytypetagleft').click(function(e) {
        var selectedOpts = $('#entitytypetagingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#usetypetagnotingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });



$('#buttongrouptypetagright').click(function(e) {
        var selectedOpts = $('#grouptypetagnotingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#grouptypetagingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
		$('#grouptypetagingroup option').prop('selected', 'selected');
		e.preventDefault();
    });

    $('#buttongrouptypetagleft').click(function(e) {
        var selectedOpts = $('#grouptypetagingroup option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#usetypetagnotingroup').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });


})


$("#addform").validate();

</script>


<?php

$id = _ACTION_VIEW_PARAMETER_ID;

MainSystem::CheckIDExists('blocksinstances','id',$id,'blocksadministration/manageBlocks/');


$block_placeholder = '';
$blockaction_placeholder = '';
$blocktitle_placeholder = '';
$issticky_placeholder = '';
$blockdisplay_placeholder = '';
$blockposition_placeholder = '';
$userids_placeholder = '';
$actionview_placeholder = '';
$usertypetagingroup_placeholder = '';
$usertypetagnotingroup_placeholder = '';
$entitytypetagingroup_placeholder = '';
$entitytypetagnotingroup_placeholder = '';
$grouptypetagingroup_placeholder = '';
$grouptypetagnotingroup_placeholder = '';

global $entitytype_tag;
$entitytype_tag = '';
$usertype_tag = '';


$columns = array('b.id','b.block','b.blockaction','b.blocktitle','b.blockdisplay','b.blockposition','b.blockdirection','b.orderid','b.issticky','bis.type','bis.userids','bis.actionview','bis.entitytypetag','bis.usertypetag','bis.grouptypetag');

$tables = array();
$tables['blocksinstances'] = 'b';
$tables['blocksinstancessettings'] = 'bis';


$conditions = array();
$conditions['=']['b.id'] = $id;
$conditions['K AND =']['b.id'] = 'bis.blocksinstancesid';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');


if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$block_tag =  $sqlObj->getCleanData($resultset->block);
$blockaction_placeholder =  $sqlObj->getCleanData($resultset->blockaction);
$blocktitle_placeholder=  $sqlObj->getCleanData($resultset->blocktitle);
$blockposition_placeholder =  $sqlObj->getCleanData($resultset->blockposition);
$blockdisplay_placeholder =  $sqlObj->getCleanData($resultset->blockdisplay);
$blockorderid_placeholder =  $sqlObj->getCleanData($resultset->orderid);
$issticky_placeholder =  $sqlObj->getCleanData($resultset->issticky);
$blockdirection_placeholder =  $sqlObj->getCleanData($resultset->blockdirection);
$type_placeholder=  $sqlObj->getCleanData($resultset->type);
$userids_placeholder =  $sqlObj->getCleanData($resultset->userids);
$actionview_placeholder =  $sqlObj->getCleanData($resultset->actionview);
$entitytype_tag =  $sqlObj->getCleanData($resultset->entitytypetag);
$usertype_tag =  $sqlObj->getCleanData($resultset->usertypetag);
$grouptype_tag =  $sqlObj->getCleanData($resultset->grouptypetag);
}
}
}



$HTMLObj = new MainHTML();
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'block';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','value','description');
$conditions = array();
$conditions['=']['isactive'] = '1';
$conditions['AND =']['name'] = 'block';
$sqlmenu = $sqlObj->SQLCreator('S', 'config', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->value);
($resultsetmenu->value == $block_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->value);
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$block_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// User Type Tag //

$sqlObj = new MainSQL();
$columns = array('usertypetag');
$conditions = array();
$conditions['=']['blocksinstancesid'] = $id;
$sql = $sqlObj->SQLCreator('S', 'blocksinstancessettings', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
if($resultset = $sqlObj->FetchResult($result)){

$usertypetagarray = explode(',',$sqlObj->getCleanData($resultset->usertypetag));

}
}
}


$htmlarray = array();
$htmlarray[]['select']['name'] = 'usertypetagnotingroup[]';
$htmlarray[]['select']['id'] = 'usertypetagnotingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','usertypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(!in_array($sqlObj->getCleanData($resultsetmenu->usertypetag),$usertypetagarray)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->usertypetag);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->usertypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$usertypetagnotingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);



// User Type Tag //


$htmlarray = array();
$htmlarray[]['select']['name'] = 'usertypetagingroup[]';
$htmlarray[]['select']['id'] = 'usertypetagingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','usertypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'usertypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(in_array($sqlObj->getCleanData($resultsetmenu->usertypetag),$usertypetagarray)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->usertypetag);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->usertypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$usertypetagingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);



// Entity Type Tag //


$sqlObj = new MainSQL();
$columns = array('entitytypetag');
$conditions = array();
$conditions['=']['blocksinstancesid'] = $id;
$sql = $sqlObj->SQLCreator('S', 'blocksinstancessettings', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
if($resultset = $sqlObj->FetchResult($result)){

$entitytypetagarray = explode(',',$sqlObj->getCleanData($resultset->entitytypetag));

}
}
}


$htmlarray = array();
$htmlarray[]['select']['name'] = 'entitytypetagnotingroup[]';
$htmlarray[]['select']['id'] = 'entitytypetagnotingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','entitytypetag','entityname');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'entities', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(!in_array($sqlObj->getCleanData($resultsetmenu->entitytypetag),$entitytypetagarray)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu->entityname).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$entitytypetagnotingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);



// Entity Type Tag //


$htmlarray = array();
$htmlarray[]['select']['name'] = 'entitytypetagingroup[]';
$htmlarray[]['select']['id'] = 'entitytypetagingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','entitytypetag','entityname');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'entities', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(in_array($sqlObj->getCleanData($resultsetmenu->entitytypetag),$entitytypetagarray)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->entitytypetag).' ('.$sqlObj->getCleanData($resultsetmenu->entityname).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$entitytypetagingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);




// Group Type Tag //


$sqlObj = new MainSQL();
$columns = array('grouptypetag');
$conditions = array();
$conditions['=']['blocksinstancesid'] = $id;
$sql = $sqlObj->SQLCreator('S', 'blocksinstancessettings', $columns, $conditions, '', '', '');
if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result)!=0){
if($resultset = $sqlObj->FetchResult($result)){

$grouptypetagarray = explode(',',$sqlObj->getCleanData($resultset->grouptypetag));

}
}
}

// Group Type Tag //


$htmlarray = array();
$htmlarray[]['select']['name'] = 'grouptypetagnotingroup[]';
$htmlarray[]['select']['id'] = 'grouptypetagnotingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','grouptypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(!in_array($sqlObj->getCleanData($resultsetmenu->id),$grouptypetagarray)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$grouptypetagnotingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);


// Group Type Tag //


$htmlarray = array();
$htmlarray[]['select']['name'] = 'grouptypetagingroup[]';
$htmlarray[]['select']['id'] = 'grouptypetagingroup';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL;
$htmlarray[]['select']['nonattribute'] = 'multiple="multiple"';
$htmlarray[]['select']['close'] = '';

$sqlObj = new MainSQL();
$columns = array('id','grouptypetag','name');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'groups', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
if(in_array($sqlObj->getCleanData($resultsetmenu->id),$grouptypetagarray)){

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->grouptypetag).' ('.$sqlObj->getCleanData($resultsetmenu->name).')';
$htmlarray[]['option']['end'] = '';

}

}
}
}

$htmlarray[]['select']['end'] = '';
$grouptypetagingroup_placeholder = $HTMLObj->HTMLCreator($htmlarray);


if(isset($_POST) && isset($_POST['issubmit'])){
$block_placeholder = (isset($_POST['block']))?$_POST['block']:'';
$blockaction_placeholder = (isset($_POST['blockaction']))?$_POST['blockaction']:'';
$blocktitle_placeholder = (isset($_POST['blocktitle']))?$_POST['blocktitle']:'';
$issticky_placeholder = (isset($_POST['issticky']))?$_POST['issticky']:'';
$blockposition_placeholder = (isset($_POST['blockposition']))?$_POST['blockposition']:'';

}
?>

<?php
if(PROJ_RUN_AJAX==1){
	if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	}
}
?>

<script>
$(document).ready(function(){
$("#editblocksform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('blocksadministration/saveBlock/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('blocksadministration/saveBlock/'.$id.'/');
}
?>
<form id="editblocksform" name="editblocksform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Block</legend>

	<ol>
		
		<li>
		<label for="block">Block </label><?php echo $block_placeholder; ?>
		</li>
		
		<li>
		<label for="blockaction"><?php echo $lang['siya']['blocksadministration']['BLOCK_ACTION'];  ?></label>
		<input id="blockaction" name="blockaction" type="text" placeholder="Enter Block Action" value="<?php echo $blockaction_placeholder; ?>" />
		</li>

		<li>
		<label for="blocktitle"><?php echo $lang['siya']['blocksadministration']['BLOCK_TITLE']; ?></label>
		<input id="blocktitle" name="blocktitle" type="text" placeholder="Enter Block Title" value="<?php echo $blocktitle_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="blockposition"><?php echo $lang['siya']['blocksadministration']['BLOCK_POSITION'];?></label>
		<select name="blockposition" id="blockposition" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="HEADER" <?php  echo ($blockposition_placeholder=='HEADER')?'SELECTED':''; ?> ><?php echo $lang['siya']['blocksadministration']['HEADER'];?></option>
		<option value="FOOTER" <?php  echo ($blockposition_placeholder=='FOOTER')?'SELECTED':''; ?> ><?php echo $lang['siya']['blocksadministration']['FOOTER'];?></option>
		<option value="LEFT" <?php  echo ($blockposition_placeholder=='LEFT')?'SELECTED':''; ?> ><?php echo $lang['siya']['blocksadministration']['LEFT'];?></option>
		<option value="RIGHT" <?php  echo ($blockposition_placeholder=='RIGHT')?'SELECTED':''; ?> ><?php echo $lang['siya']['blocksadministration']['RIGHT'];?></option>
		<option value="BEFOREMIDDLECONTENT" <?php  echo ($blockposition_placeholder=='BEFOREMIDDLECONTENT')?'SELECTED':''; ?> ><?php echo $lang['siya']['blocksadministration']['BEFORE_MIDDLE_CONTENT'];?></option>
		<option value="AFTERMIDDLECONTENT" <?php  echo ($blockposition_placeholder=='AFTERMIDDLECONTENT')?'SELECTED':''; ?> ><?php echo $lang['siya']['blocksadministration']['AFTER_MIDDLE_CONTENT'];?></option>
		</select>
		</li>
		
		<li>
		<label for="blockdisplay"><?php echo $lang['siya']['blocksadministration']['BLOCK_DISPLAY_POSITION']; ?></label><br /><select name="blockdisplay" id="blockdisplay" <?php echo _FORM_FINAL; ?> />
		<option value="">------</option>
		<option value="FRONTEND" <?php  echo ($blockdisplay_placeholder=='FRONTEND')?'SELECTED':''; ?> ><?php echo $lang['siya']['blocksadministration']['FRONTEND'];?></option>
		<option value="BACKEND" <?php  echo ($blockdisplay_placeholder=='BACKEND')?'SELECTED':''; ?>><?php echo $lang['siya']['blocksadministration']['BACKEND'];?></option>
		<option value="ALL" <?php  echo ($blockdisplay_placeholder=='ALL')?'SELECTED':''; ?>><?php echo $lang['siya']['blocksadministration']['ALL'];?></option>

		</select>
		</li>

		<li>
		<label for="blockdirection"><?php echo $lang['siya']['blocksadministration']['BLOCK_DIRECTION'];?></label>
		<select name="blockdirection" id="blockdirection" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
		<option value="">------</option>
		<option value="HORIZONTAL" <?php  echo ($blockdirection_placeholder=='HORIZONTAL')?'SELECTED':''; ?>>Horizontal</option>
		<option value="VERTICAL" <?php  echo ($blockdirection_placeholder=='VERTICAL')?'SELECTED':''; ?>>Vertical</option>
		</select>
		</li>


		<li>
		<label class="label_radio" for="issticky"><?php echo $lang['siya']['blocksadministration']['IS_STICKY'];?></label><br />
		<input name="issticky" id="issticky-01" value="1" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" <?php  echo ($issticky_placeholder=='1')?'CHECKED':''; ?> />Yes<br />
		<input name="issticky" id="issticky-02" value="0" type="radio" <?php  echo ($issticky_placeholder=='0')?'CHECKED':''; ?> />No<br />
		</li>

		<li>
		<label class="label_radio" for="type"><?php echo $lang['siya']['blocksadministration']['TYPE'];?></label><br />
		<input name="type" id="type-01" value="SHOW" type="radio" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" <?php  echo ($type_placeholder=='SHOW')?'CHECKED':''; ?>  />Show<br />
		<input name="type" id="type-02" value="HIDE" type="radio" <?php  echo ($type_placeholder=='HIDE')?'CHECKED':''; ?> />Hide<br />
		</li>

		<li>
		<label for="userids"><?php echo $lang['siya']['blocksadministration']['USER_IDS'];?></label>
		<textarea id="userids" name="userids" type="text" placeholder="Enter User Ids with Comma Seperated" rows="5" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> "><?php echo $userids_placeholder; ?></textarea>
		</li>

		<li>
		<label for="actionview"><?php echo $lang['siya']['blocksadministration']['ACTION_VIEWS'];?></label>
		<textarea id="actionview" name="actionview" type="text" placeholder="Enter Action View's with Comma Seperated" rows="5" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>"><?php echo $actionview_placeholder; ?></textarea>
		</li>

	<li>
		<label for="usertypetag"><?php echo $lang['siya']['blocksadministration']['FOR_USERTYPE_TAG'];?></label>


		<table style='width:500px;'>
		<tr>
		<td style='width:200px;'>
		<b>User Types Not In this Block:</b><br/>
		<?php echo $usertypetagnotingroup_placeholder; ?> 

		</td>
		<td style='width:50px;text-align:center;vertical-align:middle;'>
		<input type='button' id='buttonusertypetagright' value ='  >  '/>
		<br/><input type='button' id='buttonusertypetagleft' value ='  <  '/>
		</td>
		<td style='width:200px;'>
		<b>User Types In this Block: </b><br/>
		<?php echo $usertypetagingroup_placeholder; ?>
		</td>
		</tr>
		</table>


		</li>

		<li>
		<label for="entitytypetag"><?php echo $lang['siya']['blocksadministration']['FOR_ENTITYTYPE_TAG'];?></label>

		<table style='width:500px;'>
		<tr>
		<td style='width:200px;'>
		<b>Entity Types Not In this Block:</b><br/>
		<?php echo $entitytypetagnotingroup_placeholder; ?> 

		</td>
		<td style='width:50px;text-align:center;vertical-align:middle;'>
		<input type='button' id='buttonentitytypetagright' value ='  >  '/>
		<br/><input type='button' id='buttonentitytypetagleft' value ='  <  '/>
		</td>
		<td style='width:200px;'>
		<b>Entity Types In this Block: </b><br/>
		<?php echo $entitytypetagingroup_placeholder; ?>
		</td>
		</tr>
		</table>

		</li>

		<li>
		<label for="grouptypetag"><?php echo $lang['siya']['blocksadministration']['FOR_GROUPTYPE_TAG'];?> </label>


		<table style='width:500px;'>
		<tr>
		<td style='width:200px;'>
		<b>Group Types Not In this Block:</b><br/>
		<?php echo $grouptypetagnotingroup_placeholder; ?> 

		</td>
		<td style='width:50px;text-align:center;vertical-align:middle;'>
		<input type='button' id='buttongrouptypetagright' value ='  >  '/>
		<br/><input type='button' id='buttongrouptypetagleft' value ='  <  '/>
		</td>
		<td style='width:200px;'>
		<b>Group Types In this Block: </b><br/>
		<?php echo $grouptypetagingroup_placeholder; ?>
		</td>
		</tr>
		</table>


		</li>
		</ol>

<fieldset>
<button type="submit"><?php echo $lang['siya']['blocksadministration']['SAVE'] ;?></button>

</fieldset>

</form>

<?php
/*$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=newstitle,newstext,newsdate:onsubmit=addnewnews:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;*/
?>