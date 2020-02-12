<?php
$id = _ACTION_VIEW_PARAMETER_ID;
?>


<table width="100%" border="0">
  <tr>
    <td width="100%" height="400px"><iframe name="chattext" id="chattext" src="<?php  echo MainSystem::URLCreator('webconferencing/joinWebConferencingModerator/'.$id.'/?USE_TEMPLATE=blanktemplate&SELECTEDTHEME=&HIDE_TEMPLATE_HEADER_PART=1'); ?>" frameborder="0" scrolling="yes" width="100%" height="400px" marginwidth="5" marginheight="5" ></iframe></td>
  </tr>
</table>