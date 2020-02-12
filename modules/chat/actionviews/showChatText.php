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
// comet implementation
var oldscrollHeight = $("#chattextdiv2").attr("scrollHeight") - 20;

var Comet = function (data_url) {
  this.timestamp = 0;
  this.url = data_url;  
  this.noerror = true;

  this.connect = function() {
    var self = this;
	
    $.ajax({
      type : 'get',
      url : this.url,
      dataType : 'json', 
	  timeout: 30000,

      data : {'timestamp' : self.timestamp},
      success : function(response) {
        self.timestamp = response.timestamp;
        self.handleResponse(response);
        self.noerror = true;          
      },
      complete : function(response) {
        // send a new ajax request when this request is finished
        if (!self.noerror) {
          // if a connection problem occurs, try to reconnect each 5 seconds
          setTimeout(function(){ comet.connect(); }, 5000);           
        }else {
          // persistent connection
          self.connect(); 
        }

        self.noerror = false; 
      
	  }
    });
  

  
  }

  this.disconnect = function() {}

  this.handleResponse = function(response) {
    $('#chattextdiv2').append('<div>' + response.msg + '</div>');
	$('html,body').animate({
	scrollTop: $("#chatend").offset().top},
	'slow');			
	var newscrollHeight = $("#chattextdiv2").attr("scrollHeight") - 20;
	if(newscrollHeight > oldscrollHeight){
	$("#chattextdiv2").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
	}

  }

  this.doRequest = function(request) {
      $.ajax({
        type : 'get',
        url : this.url,
        data : {'msg' : request}
      });
  }

}

var comet = new Comet("<?php echo MainSystem::URLCreator('chat/getNewChatText/'.$id.'/?USE_TEMPLATE=nulltemplate'); ?>");
comet.connect();
</script>