<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>

<h3>Result Detail</h3>

	<?php
	
	$columns = array('type','answer','useranswer');
	$conditions = array();
	$conditions['=']['uniquetestattemptid'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'testquestionssnapshots', $columns, $conditions, '', '', '');
	$k = 1;
	$totalresult = array();
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){
	$type = $sqlObj->getCleanData($resultset->type);
	$answer = $sqlObj->getCleanData($resultset->answer);
	$useranswer = $sqlObj->getCleanData($resultset->useranswer);
	
	
	echo "Question No:".$k."  ";
	$k++;
	if($type == 'MC'){

	
	questions::setSeperators();
	
	$answerseperatorarray = array();
	$answerarray = array();

	$answerseperatorarray = explode(questions::$seprator, $answer);
	foreach($answerseperatorarray as $key => $value){
		
	$answersubseperatorarray = explode(questions::$subseprator, $value);
	$answerarray[] = $answersubseperatorarray;
	}

	foreach($answerarray as $key1 => $value1){		
	if($value1[0] == $useranswer){
	?>	
	Result  is : <?php echo $value1[1];?> <br/>
	<?php
	$totalresult[] = $value1[1];
	}
	}
	
	}
	
	if($type == 'FITB'){
	
	$answerseperatorarray = array();
	$useranswerseperatorarray = array();
	$answerseperatorarray = explode('####', $answer);
	$useranswerseperatorarray = explode('####', $useranswer);
	$counttrue = 0;
	$countfalse = 0;
	echo "Fill In The Blanks: <br />";


	for($i=0,$j=0;$i<count($answerseperatorarray),$j<count($useranswerseperatorarray);$i++,$j++){
	
	if($answerseperatorarray[$i] == $useranswerseperatorarray[$j]){
		echo $useranswerseperatorarray[$i].' is true Answer <br/>  <br />';
		$counttrue++;
	}
	else{
		echo $useranswerseperatorarray[$i].'  is false Answer <br/>  <br />';
		$countfalse++;
	}

	}
	
	$percentage = $counttrue/count($answerseperatorarray);
	echo "Result is ". round($percentage*100).'%';
	$totalresult[] = round($percentage*100);
	}


	if($type == 'TF'){
	echo "True OR False: <br />";
		
	if($useranswer == 'true'){
		echo "Result is True";
		$totalresult[] = '100';
	}
	if($useranswer == 'false'){
		echo "Result is False";
		$totalresult[] = '0';
	}

	}

	
	if($type == 'MTF'){

	echo "Match The Following: <br />";
	questions::setSeperators();
	$counta = 0;
	$countb = 0;
	$answerseperatorarray = array();
	$answerarray = array();
	$useranswerarray = array();
	$answerseperatorarray = explode(questions::$seprator, $answer);
	$useranswerseperatorarray = explode(questions::$seprator, $useranswer);

	foreach($answerseperatorarray as $key => $value){
			
	$answersubseperatorarray = explode(questions::$subseprator, $value);
	$answerarray[] = $answersubseperatorarray;
	}

	
	foreach($useranswerseperatorarray as $key => $value){
			
	$useranswersubseperatorarray = explode(questions::$subseprator, $value);
	$useranswerarray[] = $useranswersubseperatorarray;
	}

	for($i=0,$j=0;$i<count($answerarray),$j<count($useranswerarray);$i++,$j++){
		
	if(($answerarray[$i][0] == $useranswerarray[$j][0]) && ($answerarray[$i][1] == $useranswerarray[$j][1])){
	
	echo $answerarray[$i][0].' is True <br />';
	++$counta;

	}else{

	echo $answerarray[$i][0].' is False <br />';
	
	}
	
	}
	
	$percentage = $counta/count($answerarray);
	echo  $result4 = round($percentage*100).'%';
	$totalresult[] = $result4;
	}
	echo "<hr />";

	}
	}
	}
	?>
	Total Result : 
	<?php
	print_r($totalresult);
	?>