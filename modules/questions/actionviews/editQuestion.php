<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('questions','id',$id,'questions/manageQuestions/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('questions','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

$optioncount = 0;

$columns = array('categoryid','type','leveltype','question','options','answer','feedback');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'questions', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$categoryid = $sqlObj->getCleanData($resultset->categoryid);
$type =  $sqlObj->getCleanData($resultset->type);
$leveltype =  $sqlObj->getCleanData($resultset->leveltype);
$question =  $sqlObj->getCleanData($resultset->question);
$options =  $sqlObj->getCleanData($resultset->options);
$answer =  $sqlObj->getCleanData($resultset->answer);
$feedback =  $sqlObj->getCleanData($resultset->feedback);
}
}
}

$option_placeholder = MainSystem::HTMLEditorInit('option'); 
$question_placeholder = MainSystem::HTMLEditorInit('question',$question); 
//$answer_placeholder = MainSystem::HTMLEditorInit('answer'); 
$feedback_placeholder = MainSystem::HTMLEditorInit('feedback',$feedback); 



if(isset($_POST) && isset($_POST['issubmit'])){
$name_placeholder = (isset($_POST['name']))?$_POST['name']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
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
$("#editquestionform").validate();
});
</script>


<script language="javascript">
function addOptions(fields) {
if (fields < 7) {
document.getElementById('additionalfields').innerHTML += '<li><label for="option'+fields+'">Option '+fields+' :</label><br /><textarea id="option'+fields+'"  name="options[options][option'+fields+']"></textarea><label for="answer'+fields+'">Correctness in %</label><select name="options[answers][option'+fields+']" id="option'+fields+'"  class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" /><option value="">------</option><option value="100%">100% Correct</option><option value="75%">75% Correct</option><option value="50%">50% Correct</option><option value="25%">25% Correct</option></select></li>';

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

function addOptionsMf(fields) {

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



<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('questions/saveQuestions/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('questions/saveQuestions/'.$id.'/');
}
?>

<form id="editquestionform" name="editquestionform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Test</legend>

	<ol>
		
		<li>
		<label for="type"><?php echo $lang['siya']['questions']['TYPE']; ?></label><?php echo $type; ?>
		
		</li>
		
		<li>
		<label for="leveltype" ><?php echo $lang['siya']['questions']['QUESTION_LEVEL']; ?></label>
			<select name="leveltype" id="leveltype" <?php echo _FORM_FINAL;?> />
			<option value="">------</option>
			<option value="H" <?php echo ($leveltype=='H')?'SELECTED':''; ?> >Hard Level</option>
			<option value="M" <?php echo ($leveltype=='M')?'SELECTED':''; ?> >Medium Level</option>
			<option value="E" <?php echo ($leveltype=='E')?'SELECTED':''; ?> >Easy Level</option>
			
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

			$optionsseperatorarray = array();
			$optionsarray = array();
			$optionsseperatorarray = explode(questions::$seprator, $options);

			foreach($optionsseperatorarray as $key => $value){
			$optionssubseperatorarray = explode(questions::$subseprator, $value);
			$optionsarray[] = $optionssubseperatorarray;
			}


			$answerseperatorarray = array();
			$answerarray = array();
			$answerseperatorarray = explode(questions::$seprator, $answer);

			foreach($answerseperatorarray as $key => $value){
			$answersubseperatorarray = explode(questions::$subseprator, $value);
			$answerarray[] = $answersubseperatorarray;
			}


			$arraycount = count($optionsarray);

			for($i=0;$i<$arraycount;$i++){
			$option_question_value =  $optionsarray[$i][1];
			$option_answer_value =  $answerarray[$i][1];
			$ii = $i+1;
			?>

			<li>
				<label for="option1">Option <?php echo $ii; ?> :</label><br /><textarea id="option1" name="options[options][option<?php echo $ii; ?>]"><?php echo $option_question_value; ?></textarea>
					
				<label for="answer<?php echo $ii; ?>">Correctness in %</label><select name="options[answers][option<?php echo $ii; ?>]" id="option<?php echo $ii; ?>" <?php echo _FORM_FINAL;?>/>
				<option value="">------</option>
				<option value="100%" <?php echo ($option_answer_value=='100%')?'SELECTED':'';?>>100% Correct</option>
				<option value="75%" <?php echo ($option_answer_value=='75%')?'SELECTED':'';?>>75% Correct</option>
				<option value="50%" <?php echo ($option_answer_value=='50%')?'SELECTED':'';?>>50% Correct</option>
				<option value="25%" <?php echo ($option_answer_value=='25%')?'SELECTED':'';?>>25% Correct</option>
				</select>
		
			</li>
			
			<?php
			}
			?>
						
			<div id="additionalfields">

			</div>

			<input type="button" onclick="addOptions(<?php echo $i+1; ?>)" name="addbutton" value="Add Another Option" />
			</li>


		<?php	
			break;
			case 'TF':
		?>

	
		<li>
			<label for="answer"><?php echo $lang['siya']['questions']['ANSWER']; ?></label><select name="answer" id="select" <?php echo _FORM_FINAL;?>/>
			<option value="">------</option>
			<option value="true" <?php echo ($answer=='true')?'SELECTED':'';?>>True</option>
			<option value="false" <?php echo ($answer=='false')?'SELECTED':'';?>>False</option>
			</select>
			
				
		</li>
		 
		<?php
			break;
			case 'MTF':
			
			$optionsseperatorarray = array();
			$optionsarray = array();
			$optionspartsseperatorarray = explode(questions::$partsseprator, $options);


			$optionsseperatorarray1 = explode(questions::$seprator, $optionspartsseperatorarray[0]);

			foreach($optionsseperatorarray1 as $key => $value){
			$optionssubseperatorarray1 = explode(questions::$subseprator, $value);
			$optionsarray1[] = $optionssubseperatorarray1;
			}


			$optionsseperatorarray2 = explode(questions::$seprator, $optionspartsseperatorarray[1]);

			foreach($optionsseperatorarray2 as $key => $value){
			$optionssubseperatorarray2 = explode(questions::$subseprator, $value);
			$optionsarray2[] = $optionssubseperatorarray2;
			}

			$answerseperatorarray = array();
			$answerarray = array();
			$answerseperatorarray = explode(questions::$seprator, $answer);


			foreach($answerseperatorarray as $key => $value){
			$answersubseperatorarray = explode(questions::$subseprator, $value);
			$answerarray[] = $answersubseperatorarray;
			}

		?>
	
		

		  <table width = "100%">
		  <tr>
		  <td width = "50%"><h3>Part A</h3></td>
		  <td width = "50%"><h3>Part B</h3></td>
		  </tr>

			<?php
			
			$arraycount = count($optionsarray1);

			for($i=0;$i<$arraycount;$i++){
			$option_a_value =  $optionsarray1[$i][1];
			$option_b_value =  $optionsarray2[$i][1];
			?>

		  <tr>
		  <td width = "50%">
			
			<label for="option<?php echo $i+1; ?>">Option <?php echo $i+1; ?> : </label>
			<input type="text" id="optiona<?php echo $i+1; ?>" name="optionsa[options][option<?php echo $i+1; ?>]" value="<?php echo $option_a_value; ?>" <?php echo _FORM_FINAL;?>/>
		 </td>
		 <td width = "50%">

			<label for="option<?php echo $i+1; ?>">Option <?php echo $i+1; ?> : </label>
			<input type="text" id="optionb<?php echo $i+1; ?>"  name="optionsb[options][option<?php echo $i+1; ?>]" value="<?php echo $option_b_value; ?>"<?php echo _FORM_FINAL;?>/>
		 </td>

		  </tr>

		  <?php
			}
		  ?>

		 </table>

		<div id="additionalfields">

		</div>


			<input type="button" onclick="addOptionsMf(<?php echo $i+1; ?>)" name="addbutton" value="Add Option" <?php echo _FORM_FINAL;?>/>
			<h3> Answers: </h3>
		  <table width = "100%">
		  <tr>
		  <td width = "50%"><h3>Part A</h3></td>
		  <td width = "50%"><h3>Part B</h3></td>
		  </tr>


		<?php
		$arraycount = count($answerarray);

		for($i=0;$i<$arraycount;$i++){
		$option_selected_value =  $answerarray[$i][1];
		$ii = $i+1;
		?>

		<tr>
		  <td width = "50%">
		<label for="answersa1">Answer <?php echo $ii; ?> : <select name="answersa[answers][option<?php echo $ii; ?>]" id="answera<?php echo $ii; ?>" <?php echo _FORM_FINAL;?>/></label>
		<option value="option<?php echo $ii; ?>">Option <?php echo $ii; ?></option>

		</select>

		</td>
    	<td width = "50%">
				
		<label for="answersb<?php echo $ii; ?>">Answer <?php echo $ii; ?> : <select name="answersb[answers][option<?php echo $ii; ?>]" id="answerb<?php echo $ii; ?>" <?php echo _FORM_FINAL;?> /></label>
		<option value="">------</option>
		<?php
		for($j=0;$j<$arraycount;$j++){
		$jj = $j+1;
		$option_value = 'option'.$jj;
		$selectedtxt = ($option_selected_value==$option_value)?'SELECTED':'';

		?>
		<option value="option<?php echo $jj; ?>" <?php echo $selectedtxt; ?>>Option <?php echo $jj; ?></option>
		<?php
		}
		?>
		</select>
		
		</tr>

		<?php
		}
		?>

		</table>

		<div id="additionalanswers">

		</div>

		<?php
			 
		  break;
		  case 'FITB':
		?>

		<li>
		<label for="answer"><?php echo $lang['siya']['questions']['ANSWER']; ?></label><br /><b><?php echo $lang['siya']['questions']['ANSWER_FOR_FITB']; ?></b>
		<textarea id="answer" name="answer" placeholder="<?php echo $lang['siya']['questions']['ANSWER']; ?>" rows="5" autofocus="" <?php echo _FORM_FINAL;?>><?php echo $answer;?></textarea>
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
<input type="hidden" name="type" value="<?php echo $type; ?>" />

<button type="submit">Save</button>

</fieldset>

</form>