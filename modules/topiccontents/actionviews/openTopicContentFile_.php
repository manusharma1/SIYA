<?php
$id = _ACTION_VIEW_PARAMETER_ID;

$columns = array('s.batchid','s.groupid','s.semesterid','s.id','tc.topicid','tc.title','tc.description','tc.filename');
$conditions = array();

$tables = array();
$tables['subjects'] = 's';
$tables['topics'] = 't';
$tables['topiccontents'] = 'tc';

$conditions['=']['tc.id'] = $id;
$conditions['K AND =']['tc.topicid'] = 't.id';
$conditions['K AND =']['s.id'] = 't.subjectid';

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
//print_r($resultset);
$foldername = PROJ_DATA_DIR._S.'Batch_'.$resultset->batchid._S.'Group_'.$resultset->groupid._S.'Semester_'.$resultset->semesterid._S.'Subject_'.$resultset->id._S.'Topic_'.$resultset->topicid;
$filename = $resultset->filename;
}
}
}
	

echo $foldername._S.$filename;die;

if (file_exists($foldername._S.$filename)) {

header('Content-Description: File Transfer');
header('Content-Type:'.MainSystem::returnMIMEType($filename));
header('Content-Disposition: attachment; filename='.basename($foldername._WS.$filename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
$contents = file_get_contents($foldername._S.$filename);
echo $contents;
exit;


}