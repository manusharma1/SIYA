<?php



foreach($_POST as $key => $value){
	
	
	$columns = array('uniquetestattemptid','type');
	$conditions = array();
	$conditions['=']['id'] = $key;
	
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'testquestionssnapshots', $columns, $conditions, '', '', '');
	
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$type = $sqlObj->getCleanData($resultset->type);
	$uniquetestattemptid = $sqlObj->getCleanData($resultset->uniquetestattemptid);
	
	}
	}
	}
	
	

if($type=='FITB'){
	
	questions::setSeperators();
	
	$value2=implode(questions::$fillinblanksanswerseperator,$value);
		$data = array();
	
	$data['useranswer'] = $value2;
		
	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $key;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'testquestionssnapshots', $data, $conditions, '', '', '');
	
	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Save User Answers Saved';
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = 'Save User Answers cannot be Saved';
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'saveUserAnswers'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'saveUserAnswers'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = 'ERROR : Save User Answers Cannot be Saved';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
}

if($type=='MTF'){
	
	questions::setSeperators();
	$answera = array();
	$answerb = array();
	$answers_str = '';

	for($i=1;$i<=count($value['parta']);$i++){
		
	$answers_str .= $value['parta'][$i].questions::$subseprator.$value['partb'][$i].questions::$seprator;
	}

	$answers_str = questions::stringLastSeperatorReplace(questions::$seprator,'',$answers_str);
	
	$data = array();
	
	$data['useranswer'] = $answers_str;
		
	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $key;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'testquestionssnapshots', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Save User Answers Saved';
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = 'Save User Answers cannot be Saved';
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'saveUserAnswers'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'saveUserAnswers'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = 'ERROR : Save User Answers Cannot be Saved';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
}

if($type=='MC' || $type=='TF' ){
	
	$data = array();
	
	$data['useranswer'] = $value;
		
	// Conditions in case of Edit //
	$conditions = array();
	$conditions['=']['id'] = $key;

	$sqlObj = new MainSQL();
	
	$sql = $sqlObj->SQLCreator('U', 'testquestionssnapshots', $data, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	$_SESSION['message'] = 'Save User Answers Saved';
	
	//$returnid = ($id=='')?$sqlObj->getLastInsertID():$id;
	//MainSystem::URLForwarder(MainSystem::URLCreator('users/editUserType/'.$returnid.'/'));
	
	}else{
	$_SESSION['message'] = 'Save User Answers cannot be Saved';
	
	if(PROJ_RUN_AJAX==1){
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'saveUserAnswers'); // REVIEW ABOUT THE SECURITY HERE//
	return $actionviewresult;
	}else{
	$actionviewresult = MainSystem::CallOtherActionView(__CLASS__,'saveUserAnswers'); // REVIEW ABOUT THE SECURITY HERE//
	$functionreturnarray['title_placeholder'] = 'ERROR : Save User Answers Cannot be Saved';
	$functionreturnarray['main_content_placeholder'] = $actionviewresult;	
	return $functionreturnarray;
	}

	}
	

 }

	// Mark Test as Completed //

	$testid = $_POST['testid'];
	$data2 = array();
	$data2['completed'] = '1';
	$conditions2 = array();
	
	$sql2 = $sqlObj->SQLCreator('I', 'testattempts', $data2, '', '', '', '');
	
	
	if($result2 = $sqlObj->FireSQL($sql2)){
	$_SESSION['message'] .= 'Test Saved';
	}


	// Mark Test as Completed //

?>



<?php 
}
?>
<p><a href="<?php echo MainSystem::URLCreator('tests/showResult/'.$uniquetestattemptid.'/'); ?>"> Show Result</a></p>