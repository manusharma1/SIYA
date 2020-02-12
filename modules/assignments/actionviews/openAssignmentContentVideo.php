<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>
 
 <div id="mediaplayer"></div>
	<script type="text/javascript" src="<?php echo PROJ_3RDPARTY_WWW_DIR._WS.'jwplayer'._WS; ?>jwplayer.js"></script>
	<script type="text/javascript">
		jwplayer("mediaplayer").setup({
			flashplayer: "<?php echo PROJ_3RDPARTY_WWW_DIR._WS.'jwplayer'._WS; ?>player.swf",
			file: "<?php echo MainSystem::URLCreator('assignments/openAssignmentContentFile/'.$id.'/');?>",
			image: "<?php echo PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'images'._WS; ?>logo.png",
			type:"video"
		});
	</script>

	<div id="container">
    <script type="text/javascript">
        var s1 = new SWFObject("<?php echo PROJ_3RDPARTY_WWW_DIR._WS.'jwplayer'._WS; ?>player.swf","ply","400","300","9","#000000");
        s1.addParam("allowfullscreen","true");
        s1.addParam("allowscriptaccess","always");
		s1.addVariable('type', 'flv');
        s1.addVariable("file","<?php echo MainSystem::URLCreator('assignments/openAssignmentContentFile/'.$id.'/');?>");
        s1.addVariable("duration","300");
        s1.addVariable("logo","<?php echo PROJ_TEMPLATES_WWW_DIR._WS.PROJ_DEFAULT_TEMPLATE_DIR._WS.'admin'._WS.'images'._WS; ?>logo.png");
        s1.addVariable("plugins","logomover");
        s1.addVariable("bufferlength","5");
        s1.write("container");
    </script>
</div> <!-- end container -->