<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$fromid = MainSystem::GetSessionUserID();

$formaction = MainSystem::URLCreator('chat/sendChatMessage/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
?>

<form id="addchat" name="addchat" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Chat</legend>

	<ol>
		
		<li>
		<label for="chattext"><?php echo $lang['siya']['chat']['DESCRIPTION']; ?></label>
		<textarea id="chattext" name="chattext" placeholder="<?php echo $lang['siya']['chat']['DESCRIPTION']; ?>" rows="5" required="" autofocus="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required"></textarea>
		<input type="hidden" name="toid" value="<?php echo $id; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
		<input type="hidden" name="fromid" value="<?php echo $fromid; ?>" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?>" />
		</li>
	
		
	</ol>
<fieldset>

<button type="submit">Send</button>

</fieldset>

</form>