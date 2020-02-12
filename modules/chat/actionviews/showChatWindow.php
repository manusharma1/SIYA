<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>


<table width="100%" border="0">
  <tr>
    <td width="68%" height="400px"><iframe name="chattext" id="chattext" src="<?php  echo MainSystem::URLCreator('chat/showChatText/'.$id.'/#chat'); ?>" frameborder="1" scrolling="yes" width="100%" height="400px" marginwidth="5" marginheight="5" style="overflow-y:scroll;"></iframe></td>
    <td width="32%" rowspan="2" height="600px"></td>
  </tr>
  <tr>
    <td>
	
<?php
$fromid = MainSystem::GetSessionUserID();
$formaction = MainSystem::URLCreator('chat/sendChatMessage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
?>

<form id="addchat" name="addchat" method="post" action="<?php echo $formaction; ?>" onsubmit="JavaScript:clearText();">

<fieldset>

	<ol>
		
		<li>
		<label for="chattext"></label>
		<textarea id="chattextarea" name="chattextarea" placeholder="Enter Chat Text" rows="5" cols="100" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>"></textarea>
		<input type="hidden" name="chattextareahidden" id="chattextareahidden" value="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
		<input type="hidden" name="chatid" value="<?php echo $id; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
		<input type="hidden" name="fromid" value="<?php echo $fromid; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
		</li>
	
		
	</ol>
<fieldset>

<button type="submit">Send</button>

</fieldset>
	</td>
  </tr>
</table>

<script>

function clearText() {
 document.getElementById("chattextareahidden").value = document.getElementById("chattextarea").value;
 document.getElementById("chattextarea").value='';
}

</script>