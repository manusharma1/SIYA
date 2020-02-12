<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT  - DO NOT REMOVE THIS NOTICE                      //
//                                                                       //
// OPENTADKA FRAMEWORK											         //
//          http://www.opentadka.org                                     //
//                                                                       //
// Copyright (C) 2010 onwards  Manu Sharma  http://www.opentadka.org     //
//                                                                       //
// STUDENT INFORMATION YARN (SIYA)								         //
//          http://www.siya.org.in                                       //
//                                                                       //
// Copyright (C) 2012 onwards  Manu Sharma  http://www.siya.org.in       //
//                                                                       //
// OPENTADKA FRAMEWORK LICENSE :                                         //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
// STUDENT INFORMATION YARN (SIYA) LICENSE :                             //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//   OPENTADKA FRAMEWORK & STUDENT INFORMATION YARN (SIYA)               //
//   FOR LICENCESPLEASE REFER LICENCE PAGE                               //
//   FOR MORE DETAILS                                                    //
//                                                                       //
///////////////////////////////////////////////////////////////////////////
?>

<?php

	$parameters = explode(',',_ACTION_VIEW_PARAMETER_ID);

	//////////////////////////////////////////////////////////////////////////////////////
	// 	Action Permissions can be controlled by the Controller, but here the 			//
	//  Group Permissions can be checked and the action can be taken accordingly 		//
	//////////////////////////////////////////////////////////////////////////////////////

	$id = (isset($parameters[0]))?$parameters[0]:'';
	$groupid = (isset($parameters[1]))?$parameters[1]:'';
	MainSystem::CheckGroupPermissions($groupid,'group');
	
	

	$id_placeholder = '';
	$fname_placeholder = '';
	$mname_placeholder = '';
	$lname_placeholder = '';
	$groupid_placeholder = '';
	$grouptypetag_placeholder = '';
	$name_placeholder = '';
	
	// Get Users Data
	$columns = array('id','fname','mname','lname','gender');
	$conditions = array();
	$conditions['=']['id'] = $id;
	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	if($resultset = $sqlObj->FetchResult($result)){
	$id_placeholder = $sqlObj->getCleanData($resultset->id);
	$student_name_placeholder = $sqlObj->getCleanData($resultset->fname).' '.$sqlObj->getCleanData($resultset->mname).' '.$sqlObj->getCleanData($resultset->lname);
	$gender = $sqlObj->getCleanData($resultset->gender);
	?>

	<h3 class="headingh3"><?php echo $student_name_placeholder; ?></h3>
										
	<?php
	}
	}
	}else{
	trigger_error('Data Fetch Error');
	}

	
	$columns = array('g.id','g.grouptypetag','g.name');
	$conditions = array();

	$tables = array();
	$tables['usersingroup'] = 'ug';
	$tables['groups'] = 'g';

	$conditions['=']['ug.userid'] = $id;
	$conditions['AND =']['g.id'] = $groupid; // Added 11-Oct-2013 // One Student Can have many Groups / Classes , So Select the Current Group
	$conditions['K AND =']['ug.groupid'] = 'g.id';
	$conditions['AND =']['g.entitytypetag'] = '@class';


	$sqlObj = new MainSQL();

	$sql = $sqlObj->SQLCreatorJ('S', $tables, $columns, $conditions, '', '', '');
		
	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result)!=0){
	if($resultset = $sqlObj->FetchResult($result)){
	$groupid_placeholder = $sqlObj->getCleanData($resultset->id);
	$grouptypetag_placeholder = $sqlObj->getCleanData($resultset->grouptypetag);
	$name_placeholder = $sqlObj->getCleanData($resultset->name);	
	?>
	<br />
	<p><a class="button green large" href="<?php echo MainSystem::URLCreator('stage/showClass/'.$groupid.'/');?>"><?php echo $name_placeholder.' ('.$grouptypetag_placeholder.') '; ?></a></p><br /><br />
	<p><a class="headingh3" href="<?php echo MainSystem::URLCreator('groups/addUserToGroup/'.$id.','.$groupid.'/');?>">Add User To Another Group </a></p>
	<br />
	<p><a class="headingh3" href="<?php echo MainSystem::URLCreator('healthcard/addHealthCard/'.$id.','.$groupid.'/');?>">Add Health Card </a></p>
	<br />
	<p><a class="headingh3" href="<?php echo MainSystem::URLCreator('leaves/addLeave/'.$id.','.$groupid.'/');?>">Add Leave </a></p>
	<br />
	<p><a class="headingh3" href="<?php echo MainSystem::URLCreator('healthcard/viewHealthCard/'.$id.','.$groupid.'/');?>">View Health Card </a></p>
	<br />
	<p><a class="headingh3" href="<?php echo MainSystem::URLCreator('assessments/showReportCard/'.$id.','.$groupid.'/');?>">Show Report Card</a></p>
	<br /><br />
	<?php

	}
	}else{
	
	?>
	
	<h2>No Class has been Allocated, Allocate this Student to Class</h2>
	<a href="<?php echo MainSystem::URLCreator('groups/addUserToGroup/'.$id.','.$groupid.'/');?>">Add User To Group </a>
	
	<?php
	}
	}


?>

	    <script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/lib/jquery-1.7.1-min.js"></script>

		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/lib/jquery-ui-1.8.13-min.js"></script>
		<!-- /DEP -->
		
		<!-- JS -->
		<!-- support lib for bezier stuff -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/lib/jsBezier-0.4-min.js"></script>
		<!-- jsplumb util -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jsPlumb-util-1.4.0-RC1.js"></script>
		<!-- main jsplumb engine -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jsPlumb-1.4.0-RC1.js"></script>
		<!-- connectors, endpoint and overlays  -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jsPlumb-defaults-1.4.0-RC1.js"></script>
		<!-- state machine connectors -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jsPlumb-connectors-statemachine-1.4.0-RC1.js"></script>
		<!-- SVG renderer -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jsPlumb-renderers-svg-1.4.0-RC1.js"></script>
		<!-- canvas renderer -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jsPlumb-renderers-canvas-1.4.0-RC1.js"></script>
		<!-- vml renderer -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jsPlumb-renderers-vml-1.4.0-RC1.js"></script>
		<!-- jquery jsPlumb adapter -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/1.4.0/jquery.jsPlumb-1.4.0-RC1.js"></script>
		<!-- /JS -->

<script>
		
;(function() {
	
	window.jsPlumbDemo = {
			
		init : function() {			

			var color = "gray";

			jsPlumb.importDefaults({
				// notice the 'curviness' argument to this Bezier curve.  the curves on this page are far smoother
				// than the curves on the first demo, which use the default curviness value.			
				Connector : [ "Straight", { curviness:50 } ],
				DragOptions : { cursor: "crosshair", zIndex:2000 },
				PaintStyle : { strokeStyle:color, lineWidth:2 },
				EndpointStyle : { radius:9, fillStyle:color },
				HoverPaintStyle : {strokeStyle:"#ec9f2e" },
				EndpointHoverStyle : {fillStyle:"#ec9f2e" },			
				Anchors :  [ "BottomCenter", "TopCenter" ]
			});
			
				
			// declare some common values:
			var arrowCommon = { foldback:0.7, fillStyle:color, width:14 },
				// use three-arg spec to create two different arrows with the common values:
				overlays = [
					[ "Arrow", { location:0.7 }, arrowCommon ],
					[ "Arrow", { location:0.3, direction:-1 }, arrowCommon ]
				];
		
			jsPlumb.connect({
				source : 'window1',
				target : 'window2',
				paintStyle : {
				strokeStyle:"blue",
				dashstyle:"4 1",
				lineWidth:10
				}
			});

			
						
			jsPlumb.connect({
				source : 'window1',
				target : 'window3',
				paintStyle : {
				strokeStyle:"green", 
				lineWidth:10
				}
			});


						
			var stateMachineConnector = {				
				connector:"StateMachine",
				paintStyle:{lineWidth:3,strokeStyle:"#056"},
				hoverPaintStyle:{strokeStyle:"#dbe300"},
				endpoint:"Blank",
				anchor:"Continuous",
				overlays:[ ["PlainArrow", {location:1, width:20, length:12} ]]
			};
			
			jsPlumb.connect({
				source:"window1",
				target:"window4"
			}, stateMachineConnector);
			
			jsPlumb.connect({
				source:"window4",
				target:"window2",
		        label : "Reports will be Sent to Parents"
			}, stateMachineConnector);


			jsPlumb.connect({
				source:"window1",
				target:"window5"
			}, stateMachineConnector);



			jsPlumb.connect({
				source : 'window1',
				target : 'window6',
				paintStyle : {
				strokeStyle:"orange",
				dashstyle:"4 1",
				lineWidth:10
				}
			});




			jsPlumb.draggable(jsPlumb.getSelector(".window"));
		}
	};
	
})();
	
</script>		

		<!--  demo helper code -->
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/demo-list.js"></script>
		<script type="text/javascript" src="<?php echo  PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'js'._WS; ?>plumb/demo-helper-jquery.js"></script>


	<div class="student_div component window" id="window1">
	<b>@Student<b>
	<?php
	$student_icon = ($gender=='M')?'user_male_white_blue_brown.png':'user_female_white_pink_brown.png';
	?>
	<img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.$student_icon; ?>" alt="<?php echo $name_placeholder; ?>" title="<?php echo $name_placeholder; ?>" /><br /><?php echo $student_name_placeholder; ?>
	</div>



	<div class="parent_div component window" id="window2">
	<b>@Parent<b>
	<?php
	$parent_icon = ($gender=='M')?'parent_male.png':'parent_female.png';
	?>
	<div align="center"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.'parent_male.png'; ?>" alt="FATHER of <?php echo $student_name_placeholder; ?>" title="FATHER of <?php echo $student_name_placeholder; ?>" width="60px" height="60px"/> 	<img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.'parent_female.png'; ?>" alt="MOTHER of <?php echo $student_name_placeholder; ?>" title="MOTHER of <?php echo $student_name_placeholder; ?>" width="60px" height="60px"/></div><br />
	</div>


	
	<div class="classteacher_div component window" id="window3">
	<b>@Teacher<b>
	<div align="center"><img src="<?php echo PROJ_MODULES_WWW_DIR._WS.'stage'._WS.'images'._WS.'female_teacher.png'; ?>" alt="TEACHER of <?php echo $student_name_placeholder; ?>" title="TEACHER of <?php echo $student_name_placeholder; ?>" width="60px" height="60px"/></div><br />
	</div>

	</div>

	<div class="reports_div component window" id="window4">
	<b>Reports<b>

	</div>

	<div class="reportcard_div component window" id="window5">
	<b>Health Card<b>

	</div>

	<div class="reportcard_div component window" id="window6">
	<b>Friends<b>

	</div>