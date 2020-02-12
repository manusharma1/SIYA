<?php
$_SESSION['message'] = '';
$modulename = $_POST['modulename'];
$_SESSION['message'] = MainSystem::SystemDeactivateModule($modulename);
MainSystem::URLForwarder(MainSystem::URLCreator('opentadkainstaller/installerResults/'));
?>