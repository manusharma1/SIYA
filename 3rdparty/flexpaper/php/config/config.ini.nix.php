; <?php exit; ?> DO NOT REMOVE THIS LINE
[requirements]
 test_pdf2swf				= true
 test_pdf2json				= false

[general]
 allowcache 				= true
 splitmode					= false
 path.pdf					= "/var/www/flexpaper/php/pdf/"
 path.swf 					= "/var/www/flexpaper/php/docs/"
 
[external commands]
 cmd.conversion.singledoc 	= "pdf2swf \"{path.pdf}{pdffile}\" -o \"{path.swf}{pdffile}.swf\" -f -T 9 -t -s storeallcharacters"
 cmd.conversion.splitpages 	= "pdf2swf \"{path.pdf}{pdffile}\" -o \"{path.swf}{pdffile}%.swf\" -f -T 9 -t -s storeallcharacters -s linknameurl"
 cmd.searching.extracttext 	= "swfstrings \"{path.swf}{swffile}\""
