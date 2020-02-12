<?php
$id = _ACTION_VIEW_PARAMETER_ID;
$_SESSION['siyachatlastshowndatetime'] = '';
?>


<div id="chattextdiv">

	<?php
	$columns = array('id','fromid','chattext','datetime');
	$conditions = array();
	$conditions['<']['datetime'] =  date('Y-m-d H:i:s');
	$conditions['AND =']['chatid'] =  $id;

	$sqlObj = new MainSQL();
	$sql = $sqlObj->SQLCreator('S', 'chattemprecords', $columns, $conditions, '', '', '');

	if($result = $sqlObj->FireSQL($sql)){
	if($sqlObj->getNumRows($result) !=0){ 
	while($resultset = $sqlObj->FetchResult($result)){

	$columns2 = array('fname','mname','lname');
	$conditions2 = array();
	$conditions2['=']['id'] =  $resultset->fromid;
	$sql2 = $sqlObj->SQLCreator('S', 'users', $columns2, $conditions2, '', '', '');

	if($result2 = $sqlObj->FireSQL($sql2)){
	if($sqlObj->getNumRows($result2) !=0){ 
	if($resultset2 = $sqlObj->FetchResult($result2)){
	}
	}
	}
	$name_placeholder = $sqlObj->getCleanData($resultset2->fname).' '.$sqlObj->getCleanData($resultset2->mname).' '.$sqlObj->getCleanData($resultset2->lname);
	$datetime_placeholder = $sqlObj->getCleanData($resultset->datetime);	
	$chattext_placeholder = $sqlObj->getCleanData($resultset->chattext);	
	?>
	<p>	<img src="<?php echo MainSystem::URLCreator('users/showUserImageByID/'.$resultset->fromid.',1/'); ?>" width="50px" height="50px" />		
	<?php echo $name_placeholder; ?> - <?php echo $datetime_placeholder; ?> : <?php echo $chattext_placeholder; ?></p>
										
	<?php
	}
	$_SESSION['siyachatlastshowndatetime'] = $datetime_placeholder;
	}
	}else{
	trigger_error('Data Fetch Error');
	}		
	
	$siyachatlastshowndatetime = $_SESSION['siyachatlastshowndatetime'];
	
	?>



	
</div>


<div id="chattextdiv2">
	
</div>

<div id="chatend"></div>



<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	
	//Load the file containing the chat log
	function getNewChatText(){		
		var oldscrollHeight = $("#chattextdiv2").attr("scrollHeight") - 20;
		$.ajax({
			url: "<?php echo MainSystem::URLCreator('chat/getNewChatText/'.$id.'/?USE_TEMPLATE=nulltemplate'); ?>",
			cache: false,
			success: function(html){


				$("#chattextdiv2").html(html); //Insert chat log into the #chatbox div		
				$('html,body').animate({
					scrollTop: $("#chatend").offset().top},
					'slow');			
				var newscrollHeight = $("#chattextdiv2").attr("scrollHeight") - 20;
				if(newscrollHeight > oldscrollHeight){
					$("#chattextdiv2").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}


		function getNewChatText2(){		
		var oldscrollHeight = $("#chattextdiv2").attr("scrollHeight") - 20;
		$.ajax({
			url: "<?php echo MainSystem::URLCreator('chat/getNewChatText/'.$id.'/?USE_TEMPLATE=nulltemplate'); ?>",
			cache: false,
			success: function(html){
				oldhtml = $("#chattextdiv2").html();

				if(html != ''){
				$("#chattextdiv2").html(oldhtml+html); //Insert chat log into the #chatbox div
				}
				$('html,body').animate({
					scrollTop: $("#chatend").offset().top},
					'slow');			
				var newscrollHeight = $("#chattextdiv2").attr("scrollHeight") - 20;
				if(newscrollHeight > oldscrollHeight){
					$("#chattextdiv2").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
	
	getNewChatText();
	setInterval (getNewChatText2, 3000);	
	

});

</script>