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
class MainHTML
{

public function HTMLCreator($htmlarray){

$htmloutput = '';
$jsoutput = '';
$htmltagsdata = '';

$allowedhtmltags = array('a' => 1, 'b' => 1, 'br' => 0, 'del' => 1, 'div' => 1, 'em' => 1, 'font' => 1, 'form' => 1, 'h1' => 1, 'h2' => 1, 'h3' => 1, 'h4' => 1, 'h5' => 1, 'h6' => 1, 'hr' => 0, 'i' => 1, 'img' => 0, 'input' => 0, 'js' => 0, 'li' => 1, 'ol' => 1, 'option' => 1, 'p' => 1, 'pre' => 1, 's' => 1, 'select' => 1, 'small' => 1, 'span' => 1, 'strong' => 1, 'sub' => 1, 'sup' => 1, 'table' => 1, 'td' => 1, 'th' => 1, 'textarea' => 1, 'tr' => 1, 'u' => 1, 'ul' => 1); 

/* 1 = Nested */

$allowedhtmltagsattributes = array('name', 'id', 'value', 'height', 'width', 'style', 'method', 'class', 'href', 'src', 'action', 'type', 'title', 'onSubmit', 'onChange', 'data','nonattribute');

foreach($htmlarray as $mainkeys){
	foreach($mainkeys as $keys => $values){
			foreach($values as $key => $value){
				
				if(in_array($keys,$allowedhtmltags) && ($key == 'data')){
				$htmltagsdata = $value;
				}
				
				if(in_array($keys,$allowedhtmltags) && ($key == 'start' || $key == 'name')){
				$htmloutput .= '<'.$keys;
				}

				if(in_array($keys,$allowedhtmltags) && ($key == 'nonattribute')){
				$htmloutput .= ' '.$value.' ';
				}

				if(in_array($keys,$allowedhtmltags) && ($key == 'nameid')){
				$htmloutput .= '<'.$keys. ' name="'.$value.'" id="'.$value.'"';
				}

				if(in_array($keys,$allowedhtmltags) && $key == 'close'){
				$htmloutput .= '> '."\n";
				}
				if(in_array($key,$allowedhtmltagsattributes) && $key != 'start' && $key != 'close' && $key != 'js' && $key != 'data' && $key != 'nonattribute'){
				$htmloutput .= ' '.$key.'="'.$value.'"';
				}

				if($key == 'js'){
				$jsvalues = explode(':', $value);
				$jscondition = $jsvalues[0];
				$jsevent = $jsvalues[1];
				$jsfunction = $jsvalues[2];
				$jsfunctionvalue = $jsvalues[3];

				$jsconditionsubvalues = explode('=', $jscondition);
				$jsconditionvalue = $jsconditionsubvalues[0];
				$jsconditionfields = $jsconditionsubvalues[1];
				$jsconditionfields = explode(',',$jsconditionfields);
				$jseventsubvalues = explode('=', $jsevent);
				$jseventname = $jseventsubvalues[0];
				$jseventfield = $jseventsubvalues[1];
				
				$jsoutput .= self::JSCreator($jsconditionvalue, $jsconditionfields, $jseventname, $jseventfield, $jsfunction, $jsfunctionvalue);
				}
				}

			if($allowedhtmltags[$keys] == 1 && $key =='end'){
			$htmloutput .= $htmltagsdata.' </'.$keys.'>'."\n";
			$htmltagsdata = '';
			}else if($allowedhtmltags[$keys] == 0 && $key =='end'){
			$htmloutput .= ' />'."\n";
			}
	
	}	
	  
}

return $htmloutput.$jsoutput;

} // function HTMLCreator


private function JSCreator($jsconditionvalue, $jsconditionfields, $jseventname, $jseventfield, $jsfunction, $jsfunctionvalue)
{

$jsoutput = "\n".'<script type="text/javascript">'."\n";
$jsoutput .= '//<![CDATA['."\n";

if($jsfunctionvalue == 'default'){
$jsoutput .= 'function JSMainFunction(){'."\n";
}else if($jsfunctionvalue == 'multiple'){
$jsoutput .= 'function JSMainFunction_'.$jseventfield.'(){'."\n";
}
$jsoutput .= 'var elementtypeArray = [];'."\n";
$jsoutput .= 'var returnvalue = true;'."\n";


for($i=0;$i<count($jsconditionfields);$i++){
$jsoutput .= 'elementtypeArray['.$i.'] = "'.$jsconditionfields[$i].'"+ ":" + document.getElementById(\''.$jseventfield.'\').'.$jsconditionfields[$i].'.type'."\n";
}
$jsoutput .= 'return JSElementTypeProcessor(elementtypeArray, "'.$jsconditionvalue.'", "'.$jsfunction.'", "'.$jsfunctionvalue.'");'."\n";

$jsoutput .= '}'."\n";

$jsoutput .= '//]]>'."\n";
$jsoutput .= '</script>'."\n";

return $jsoutput;

} // function JSCreator


} // class MainHTML