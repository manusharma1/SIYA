<?php //This is taken from http://blog.ilric.org/2010/11/20/javascript-collaborative-painting-software-using-html5-canvas ?>

		<?php //include(PROJ_MODULES_DIR._S.'whiteboard'._S.'js'._S.'whiteboard.js.php'); ?>

		<input type="button" value="Clear" onclick="c.fillRect(0,0,w,h);" /><br/>Brush width: 
		<input type="button" value="W: 1" onclick="c.lineWidth=1;lw=1;" /> 
		<input type="button" value="W: 2" onclick="c.lineWidth=2;lw=2;" /> 
		<input type="button" value="W: 4" onclick="c.lineWidth=4;lw=4;" /> 
		<input type="button" value="W: 8" onclick="c.lineWidth=8;lw=8;" /> 
		<input type="button" value="W: 16" onclick="c.lineWidth=16;w=16;" /> 
		<input type="button" value="W: 32" onclick="c.lineWidth=32;lw=32;" /> 
		<input type="button" value="W: 64" onclick="c.lineWidth=64;lw=64;" /><br />Brush Color:
		<input type="button" value="#000000" onclick="c.strokeStyle='#000000';col='000000';" /> 
		<input type="button" value="#FF0000" onclick="c.strokeStyle='#FF0000';col='FF0000';" /> 
		<input type="button" value="#00FF00" onclick="c.strokeStyle='#00FF00';col='00FF00';" /> 
		<input type="button" value="#0000FF" onclick="c.strokeStyle='#0000FF';col='0000FF';" /> 
		<input type="button" value="#FFFF00" onclick="c.strokeStyle='#FFFF00';col='FFFF00';" /> 
		<input type="button" value="#00FFFF" onclick="c.strokeStyle='#00FFFF';col='00FFFF';" /> 
		<input type="button" value="#FF00FF" onclick="c.strokeStyle='#FF00FF';col='FF00FF';" /> 
		<input type="button" value="#C0C0C0" onclick="c.strokeStyle='#C0C0C0';col='C0C0C0';" /> 
		<input type="button" value="#FFFFFF" onclick="c.strokeStyle='#FFFFFF';col='FFFFFF';" /><br/>Clear Color:
		<input type="button" value="#000000" onclick="c.fillStyle='#000000'" /> 
		<input type="button" value="#FF0000" onclick="c.fillStyle='#FF0000'" /> 
		<input type="button" value="#00FF00" onclick="c.fillStyle='#00FF00'" /> 
		<input type="button" value="#0000FF" onclick="c.fillStyle='#0000FF'" /> 
		<input type="button" value="#FFFF00" onclick="c.fillStyle='#FFFF00'" /> 
		<input type="button" value="#00FFFF" onclick="c.fillStyle='#00FFFF'" /> 
		<input type="button" value="#FF00FF" onclick="c.fillStyle='#FF00FF'" /> 
		<input type="button" value="#C0C0C0" onclick="c.fillStyle='#C0C0C0'" /> 
		<input type="button" value="#FFFFFF" onclick="c.fillStyle='#FFFFFF'" /><br/> 

		<canvas id="canv" width="300" height="300" style='width:300px;height:300px'> 
			Your Browser does'nt support canvas (Please download Chrome)
		</canvas> 