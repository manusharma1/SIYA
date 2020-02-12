<h3>Question Details</h3>

	<?php
	$columns = array('id','type','question','options');
	$conditions = array();
	$conditions['=']['isactive'] = '1';
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'questions', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$sid_placeholder = $sqlObj->getCleanData($resultset->id);
	$type_placeholder = $sqlObj->getCleanData($resultset->type);	
	$question_placeholder = $sqlObj->getCleanData($resultset->question);
	$options = $sqlObj->getCleanData($resultset->options);
	$url='questions/showQuestions/'.$sid_placeholder.'/';
	
	if($type_placeholder!='FITB'){
	?>
	<p><?php echo 'Question :'.$question_placeholder.'  <br />Options: '; ?></p>
	<?php
	}

	if($type_placeholder=='MC'){
	
	$optionsseperatorarray = array();
	$optionsarray = array();
	$optionsseperatorarray = explode(questions::$seprator, $options);

	//print_r($optionsseperatorarray);
	// There needs to be changes in this as the last seperator should not go while adding the question, changes should be done

	foreach($optionsseperatorarray as $key => $value){
	$optionssubseperatorarray = explode(questions::$subseprator, $value);
	$optionsarray[] = $optionssubseperatorarray;
	}
	foreach($optionsarray as $key => $value){
	?>
	<input type="radio" name="<?php echo $value[0]; ?>" value="<?php echo $value[1]; ?>"> <?php echo $value[1]; ?> <br />
	<?php
	}
	?>
	<hr />

	<?php
	}
	
	if($type_placeholder=='MTF'){
	
	$optionsseperatorarray = array();
	$optionsarray = array();
	$optionspartsseperatorarray = explode(questions::$partsseprator, $options);

	//print_r($optionspartsseperatorarray);die;
	// There needs to be changes in this as the last seperator should not go while adding the question, changes should be done
	
	$optionsseperatorarray = explode(questions::$seprator, $optionspartsseperatorarray[0]);
	//print_r($optionsseperatorarray);die;
	
	?>
	<table width="100%">
	<tr>
	<td width="50%"><h3>Part A </h3></td>
	<td width="50%"><h3>Part B </h3></td>
	</tr>
	
	<tr>
	<td>
	<select name="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
	
	<?php
	foreach($optionsseperatorarray as $key => $value){
	$optionssubseperatorarray = explode(questions::$subseprator, $value);
	?>
	
	<option name="<?php echo $optionssubseperatorarray[0]; ?>" value="<?php echo $optionssubseperatorarray[1]; ?>"><?php echo $optionssubseperatorarray[1]; ?></option>
	
	<?php
	}
	?>
	
	</select>
	</td>
	
	<td>
	<?php
	$optionsseperatorarray = explode(questions::$seprator, $optionspartsseperatorarray[1]);
	
	?> 
	<select name="" class="<?php echo PROJ_AJAX_HTML_POST_CLASS_NORMAL;?> required" />
	
	<?php
	foreach($optionsseperatorarray as $key => $value){
	$optionssubseperatorarray = explode(questions::$subseprator, $value);
	?>
	
	<option name="<?php echo $optionssubseperatorarray[0]; ?>" value="<?php echo $optionssubseperatorarray[1]; ?>"><?php echo $optionssubseperatorarray[1]; ?></option>
	
	<?php
	}
	?>
	
	</select>
	</td>
	</tr>
	</table>
	
	<?php
	}

	if($type_placeholder == 'TF'){
	?>
	<input type="radio" name="true" value="true" /> True <br />
	<input type="radio" name="false" value="false"/> False  
	<?php
	}
	
	if($type_placeholder == 'FITB'){
	$userAnswer = str_replace('{{____}}','<input type="Text" name="useranswer[]" />',$question_placeholder);
	?>
	<hr />
	<p>Questions :</p>
	<p><?php echo $userAnswer; ?></p>
		
	<?php
	}
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	?>


