<?php
$_SESSION['message'] = '';
$modulename = $_POST['modulename'];
$_SESSION['message'] = MainSystem::SystemUnInstallModule($modulename);
MainSystem::URLForwarder(MainSystem::URLCreator('opentadkainstaller/installerResults/'));
?>