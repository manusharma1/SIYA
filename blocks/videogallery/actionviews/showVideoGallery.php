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
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
//////////////////////////////////////////////////////////////////////////
?>				
					
					<?php
					// Define PlaceHolders
					$i=0;
					$filename_placeholder = '';
					$filedescription_placeholder = '';
					// Get Image Slider File Data
					$columns = array('id','filename','filedescription');
					$conditions = array();
					$conditions['=']['isactive'] = 1;
					$conditions['AND =']['filelocationid'] = 3;

					$sqlObj = new MainSQL();
					$sqlfilecontents = $sqlObj->SQLCreator('S', 'fileupload', $columns, $conditions, '', '', '');
					if($resultfilecontents = $sqlObj->FireSQL($sqlfilecontents)){
					if($sqlObj->getNumRows($resultfilecontents) !=0){ // If file Exists
					while($resultsetfilecontents = $sqlObj->FetchResult($resultfilecontents)){
					$filename_placeholder = $sqlObj->getCleanData($resultsetfilecontents->filename);
					$filedescription_placeholder = $sqlObj->getCleanData($resultsetfilecontents->filedescription);
					$i++;
					?>
					  <br />  
						<div id="flash<?php echo $i; ?>" class="flash">
						<div class="aligncenter"><a href="http://www.adobe.com/go/EN_US-H-GET-FLASH"><img src="http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png" alt="" /></a></div>
						</div>
					 <br /> 
						<script type="text/javascript">
                          var fo = new FlashObject("<?php echo PROJ_BLOCKS_WWW_DIR._WS.'videogallery'._WS.'flash'._WS; ?>video_AS3.swf?width=608&amp;height=386&amp;fileVideo=<?php echo PROJ_DATA_WWW_DIR._WS.'videos'._WS.$filename_placeholder; ?>", "flash<?php echo $i; ?>", "608", "386", "8", "");
                          fo.addParam("quality", "high");
                                fo.addParam("allowFullScreen", "true");
                                fo.addParam("wmode", "transparent");
                                fo.addParam("flashvars", "colorTheme=gray");
                          fo.write("flash<?php echo $i; ?>");
                        </script>
					<hr/><p><?php echo $filedescription_placeholder; ?></p><br />
					<?php
					}
					}
					}
					?>
