<script>
$(function() {
	$( "#newsdate" ).datepicker();
});
</script>
<?php
if(PROJ_RUN_AJAX==1){
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
}
?>

<script>
$(document).ready(function(){
$("#addnewnewsform").validate();
});
</script>

	
	<?php
	if(PROJ_RUN_AJAX==1){
	$formaction = MainSystem::URLCreator('news/saveNews/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
	}else{
	$formaction = MainSystem::URLCreator('news/saveNews/');
	}
	?>

	<form id="addnewnewsform" name="addnewnewsform" method="post" action="<?php echo $formaction; ?>">
	
	<fieldset>
	<legend>Add News</legend>	
		<ol>
		<li>
		<label for="newstitle"><?php echo $lang['siya']['news']['NEWS_TITLE'];?></label>
		<input type="text" name="newstitle" id="newstitle" size="30" title="<?php echo $lang['siya']['news']['NEWS_TITLE'];?>" <?php echo _FORM_FINAL; ?>/>
		</li>


		
		<li>
		<label for="newstext"><?php echo $lang['siya']['news']['NEWS_TEXT'];?></label>
		<textarea name="newstext" id="newstext" title="<?php echo $lang['siya']['news']['NEWS_TEXT'];?>" rows="5" autofocus=""  <?php echo _FORM_FINAL; ?>></textarea>
		</li>

		
		<li>
		<label for="newstext"><?php echo $lang['siya']['news']['NEWS_DATE'];?></label>
		<input type="text" name="newsdate" id="newsdate" title="<?php echo $lang['siya']['news']['NEWS_DATE'];?>" <?php echo _FORM_FINAL; ?>/>
		</li>

		</ol>

<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>
