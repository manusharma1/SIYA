	<table cellpadding="2" cellspacing="2" border="2" width="100%" class="siyatable">
	<tr>
	<th>
	No.
	</th>
	<th>
	Question
	</th>
	<th>
	Category
	</th>
	<th>
	Type
	</th>
	<th>
	Level
	</th>
	</tr>

	<?php

	$id = _ACTION_VIEW_PARAMETER_ID;
	
	$sqlObj = new MainSQL();
	$columns = array('q.categoryid','q.type','q.leveltype','q.question','qc.name = questioncategoryname');
	$conditions = array();

	$tables = array();
	$tables['questionsintest'] = 'qt';
	$tables['questions'] = 'q';
	$tables['questionscategories'] = 'qc';

	$conditions['=']['qt.testid'] = $id ;
	$conditions['K AND =']['qt.questionid'] = 'q.id';
	$conditions['K AND =']['qc.id'] = 'q.categoryid';

	$conditions['AND =']['q.isactive'] = '1';
	$count = 0;
	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	while($resultset = $sqlObj->FetchResult($result)){
	$count++;
	$categoryid	= $sqlObj->getCleanData($resultset->categoryid);
	$type = $sqlObj->getCleanData($resultset->type);
	$leveltype = $sqlObj->getCleanData($resultset->leveltype);
	$question = $sqlObj->getCleanData($resultset->question);
	$questioncategoryname = $sqlObj->getCleanData($resultset->questioncategoryname);

	?>
	<tr>
	<td>
	<?php echo $count; ?>
	</td>
	<td>
	<?php echo $question; ?>
	</td>
	<td>
	<?php echo $questioncategoryname; ?>
	</td>
	<td>
	<?php echo $type; ?>
	</td>
	<td>
	<?php echo $leveltype; ?>
	</td>
	</tr>
	<?php
	}
	}
	}
?>
</table>