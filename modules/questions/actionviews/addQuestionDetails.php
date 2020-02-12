<?php
$categoryid = $_POST['categoryid'];
$type = $_POST['sample-radio'];
$question_placeholder = '';
$option_placeholder = '';
$answer_placeholder = '';
$feedback_placeholder = '';


if(isset($_POST)){

$question_placeholder = (isset($_POST['question']))?$_POST['question']:'';
$option_placeholder = (isset($_POST['option']))?$_POST['option']:'';
$answer_placeholder = (isset($_POST['answer']))?$_POST['answer']:'';
$feedback_placeholder = (isset($_POST['feedback']))?$_POST['feedback']:'';

}
$option_placeholder = MainSystem::HTMLEditorInit('option'); 
$question_placeholder = MainSystem::HTMLEditorInit('question'); 
//$answer_placeholder = MainSystem::HTMLEditorInit('answer'); 
$feedback_placeholder = MainSystem::HTMLEditorInit('feedback'); 

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
$("#addquestiondetailsform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('questions/saveQuestions/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('questions/saveQuestions/');
}
?>


<script language="javascript">
fields = 3;
function addOptions() {
if (fields < 7) {
document.getElementById('additionalfields').innerHTML += '<li><label for="option'+fields+'">Option '+fields+' :</label><textarea id="option'+fields+'"  name="options[options][option'+fields+']"></textarea><label for="answer'+fields+'">Correctness in %<select name="options[answers][option'+fields+']" id="option'+fields+'"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" /><option value="">------</option><option value="100%">100% Correct</option><option value="75%">75% Correct</option><option value="50%">50% Correct</option><option value="25%">25% Correct</option></select></label></li>';

fields += 1;
} else {
alert("Only 6 options are allowed.");
document.form.addbutton.disabled=true;
}

/*for(i=1;i<fields;i++)
{
	CKEDITOR.replace('option'+i);

}*/

}

function addOptionsMf() {

var output;

var optionfora,optionforb;




if (fields < 7) {


document.getElementById('additionalfields').innerHTML += '<table width="100%"><tr><td width = "50%"><label for="option'+fields+'">Option '+fields+' :</label><input type="text" id="optiona'+fields+'" name="optionsa[options][option'+fields+']" /></td><td width = "50%"><label for="option'+fields+'">Option '+fields+':</label><input type="text" id="optionb'+fields+'"  name="optionsb[options][option'+fields+']" /></td></tr></table>';


output = '<table width="100%"><tr><td width = "50%"><label for="answersa'+fields+'">Answer '+fields+' : <select  name="answersa[answers][option'+fields+']" id="answera'+fields+'" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />';


output += '<option value="option'+fields+'">Option '+fields+'</option>';

output += '</select></label>';

output += '</td><td width = "50%"><label for="answersb'+fields+'">Answer '+fields+' : <select  name="answersb[answers][option'+fields+']" id="answerb'+fields+'" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" /><option value="">------</option>';

for(i=1;i<=fields;i++){
output += '<option value="option'+i+'">Option '+i+'</option>';
}
output += '</select></label></td></tr></table>';


document.getElementById('additionalanswers').innerHTML += output;


for(ii=1;ii<fields;ii++){

eval(optionforb = document.getElementById('answerb'+ii));
optionforb.options[optionforb.options.length] = new Option('Option '+fields, 'option'+fields);

}

fields += 1;

} else {
alert("Only 6 options are allowed.");
document.form.addbutton.disabled=true;
}

/*for(i=1;i<fields;i++)
{
	CKEDITOR.replace('option'+i);

}*/

}
</script>

<form id="addquestiondetailsform" name="addquestiondetailsform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Test</legend>

	<ol>
		
		<li>
		<label for="type"><?php echo $lang['siya']['questions']['TYPE']; ?></label><?php echo $type; ?>
		<input type="hidden" name="type" value="<?php echo $type; ?>" <?php echo _FORM_FINAL; ?> />
		
		</li>
		
		<li>
		<label for="leveltype" ><?php echo $lang['siya']['questions']['QUESTION_LEVEL']; ?></label>
			<select name="leveltype" id="leveltype" <?php echo _FORM_FINAL; ?> />
			<option value="">------</option>
			<option value="H">Hard Level</option>
			<option value="M">Medium Level</option>
			<option value="E">Easy Level</option>
			
			</select>
		</li>
		

		<li>
		<label for="question"><?php echo $lang['siya']['questions']['QUESTION']; ?></label><br />

		<?php
		if($type == 'FITB'){
		?>
		<b><?php echo $lang['siya']['questions']['QUESTION_FOR_FITB']; ?></b>
		<?php
		}
		?>

		<?php echo $question_placeholder; ?>
		</li>
		
		
		<?php
			switch ($type)
			{
			case 'MC':
		?>
		
			<li>
				<label for="option1">Option 1 :</label><br /><textarea id="option1" name="options[options][option1]"></textarea>
					
				<label for="answer1">Correctness in %<select name="options[answers][option1]" id="option1" <?php echo _FORM_FINAL; ?>/>
				<option value="">------</option>
				<option value="100%">100% Correct</option>
				<option value="75%">75% Correct</option>
				<option value="50%">50% Correct</option>
				<option value="25%">25% Correct</option>
				</select>
		
			</li>
			
			<li>
				<label for="option2">Option 2 :</label><br /><textarea id="option2" name="options[options][option2]"></textarea>
				<label for="answer2">Correctness in %<select name="options[answers][option2]" id="option2" <?php echo _FORM_FINAL; ?> />
				<option value="">------</option>
				<option value="100%">100% Correct</option>
				<option value="75%">75% Correct</option>
				<option value="50%">50% Correct</option>
				<option value="25%">25% Correct</option>
				</select>
			</li>
						
			<div id="additionalfields">

			</div>
			<input type="button" onclick="addOptions()" name="addbutton" value="Add Another Option" />
			</li>


		<?php	
			  break;
			case 'TF':
		?>

	
		<li>
			<label for="answer"><?php echo $lang['siya']['questions']['ANSWER']; ?></label><br /><select name="answer" id="select" <?php echo _FORM_FINAL; ?> />
			<option value="">------</option>
			<option value="true">True</option>
			<option value="false">False</option>
			</select>
			
				
		</li>
		 
		<?php
			break;
			case 'MTF':
		?>

		  <table width = "100%">
		  <tr>
		  <td width = "50%"><h3>Part A</h3></td>
		  <td width = "50%"><h3>Part B</h3></td>
		  </tr>
		  <tr>
		  <td width = "50%">
			
			<label for="option1">Option 1 : </label>
			<input type="text" id="optiona1" name="optionsa[options][option1]" <?php echo _FORM_FINAL; ?>/>
		 </td>
		 <td width = "50%">

			<label for="option1">Option 1 : </label>
			<input type="text" id="optionb1"  name="optionsb[options][option1]" <?php echo _FORM_FINAL; ?> />
		 </td>

		  </tr>
		  <tr>
		  <td width = "50%">
			
			<label for="option2">Option 2 : </label>
			<input type="text" id="optiona2" name="optionsa[options][option2]" <?php echo _FORM_FINAL; ?>/>
		  </td>
  		 <td width = "50%">

		
		    <label for="option2">Option 2 : </label>
			<input type="text" id="optionb2"  name="optionsb[options][option2]" <?php echo _FORM_FINAL; ?>/>
		
		 </td>
		 </tr>

		 </table>

		<div id="additionalfields">

		</div>


			<input type="button" onclick="addOptionsMf()" name="addbutton" value="Add Option" <?php echo _FORM_FINAL; ?>/>
			<h3> Answers: </h3>
		  <table width = "100%">
		  <tr>
		  <td width = "50%"><h3>Part A</h3></td>
		  <td width = "50%"><h3>Part B</h3></td>
		  </tr>

		<tr>
		  <td width = "50%">
		<label for="answersa1">Answer 1 : <select name="answersa[answers][option1]" id="answera1"<?php echo _FORM_FINAL; ?> /></label>
		<option value="option1">Option 1</option>

		</select>

		</td>
    	<td width = "50%">
				
		<label for="answersb1">Answer 1 : <select name="answersb[answers][option1]" id="answerb1" <?php echo _FORM_FINAL; ?>/></label>
		<option value="">------</option>
		<option value="option1">Option 1</option>
		<option value="option2">Option 2</option>
		</select>
		
		</tr>
		<tr>
		<td width = "50%">


		<label for="answersa2">Answer 2 : <select name="answersa[answers][option2]" id="answera2" <?php echo _FORM_FINAL; ?>/></label>
		<option value="option2">Option 2</option>

		</select>
		

		</td>
  		<td width = "50%">

		<label for="answersb2">Answer 2 : <select name="answersb[answers][option2]" id="answerb2" <?php echo _FORM_FINAL; ?> /></label>
		<option value="">------</option>
		<option value="option1">Option 1</option>
		<option value="option2">Option 2</option>
		</select>

		 </td>
		 </tr>

		 </table>

		<div id="additionalanswers">

		</div>
		<?php
			 
		  break;
		  case 'FITB':
		?>

		<li>
		<label for="answer"><?php echo $lang['siya']['questions']['ANSWER']; ?></label><br />
		<b><?php echo $lang['siya']['questions']['ANSWER_FOR_FITB']; ?></b>
		<textarea id="answer" name="answer" placeholder="<?php echo $lang['siya']['questions']['ANSWER']; ?>" rows="5"  autofocus="" <?php echo _FORM_FINAL; ?>></textarea>
		</li>
		 
		<?php
			  break;
			default:
			  echo "No Choice have been chosen";
			}
		?>

		
    	<li>
		<label for="feedback"><?php echo $lang['siya']['questions']['FEEDBACK'];?></label><br />
		<?php echo $feedback_placeholder; ?>
		</li>


	</ol>
<fieldset>
<input type ="hidden" name="categoryid" value="<?php echo $categoryid; ?>" />
<button type="submit">Save</button>

</fieldset>

</form>