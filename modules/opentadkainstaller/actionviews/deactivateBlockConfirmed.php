<?php
$_SESSION['message'] = '';
$blockname = $_POST['blockname'];
$_SESSION['message'] = MainSystem::SystemDeactivateModule($blockname);
MainSystem::URLForwarder(MainSystem::URLCreator('opentadkainstaller/installerResults/'));
?>