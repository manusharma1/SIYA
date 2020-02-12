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
global $_ACTION_VIEW_PARAMETER_ID;
$pageid = $_ACTION_VIEW_PARAMETER_ID;

?>
                    <article class="grid_8 prefix_1">
                        <h2 class="spacing-bot">Contact Form</h2>
                        <div id="contact_form">
                            <form id="contactform" name="contactform" method="post" action="<?php echo MainSystem::URLCreator('contactform/contactFormSubmit/'.$pageid.'/1/') ?>" onsubmit="return JSMainFunction(this);">
                                <fieldset>
                                    <div class="field">
                                        <input name="name" id="name" title="Name" type="text" value="Name:" class="text-input" onFocus="if(this.value=='Name:'){this.value=''}" onBlur="if(this.value==''){this.value='Name:'}" />
                                        <label class="error" for="name" id="name_error">*This field is required.</label>
                                        <label class="error" for="name" id="name_error2">*This is not a valid name.</label>
                                    </div>
                                    <div class="field">
                                        <input name="email" id="email" title="Email" type="text" value="E-mail:" class="text-input" onFocus="if(this.value=='E-mail:'){this.value=''}" onBlur="if(this.value==''){this.value='E-mail:'}" />
                                        <label class="error" for="email" id="email_error">*This field is required.</label>
                                        <label class="error" for="email" id="email_error2">*This is not a valid email address.</label>
                                    </div>
                                    <div class="field">
                                        <input name="phone" id="phone" title="Phone" type="text" value="Phone:" class="text-input" onFocus="if(this.value=='Phone:'){this.value=''}" onBlur="if(this.value==''){this.value='Phone:'}"/>
                                        <label class="error" for="phone" id="phone_error">*This field is required.</label>
                                        <label class="error" for="phone" id="phone_error2">*This is not a valid phone number.</label>
                                    </div>                        
                                    <div class="area">
                                        <textarea name="message" id="message" title="Message" class="text-input" onFocus="if(this.value=='Message:'){this.value=''}" onBlur="if(this.value==''){this.value='Message:'}">Message:</textarea>
                                        <label class="error" for="message" id="message_error">*This field is required.</label>
                                    </div>

                                    <div class="field">
									</div>

                                    <div class="field">
                                        <img name="captcha" id="captcha" src="<?php echo PROJ_3RDPARTY_WWW_DIR._WS; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid());?>" alt="CAPTCHA Image" /></td>
                                       <input type="text" name="captchatext" id="captchatext" value="Enter Security Code Shown Above:" title="Security Image Text" class="text-input" onFocus="if(this.value=='Enter Security Code Shown Above:'){this.value=''}" onBlur="if(this.value==''){this.value='Enter Security Code Shown Above:'}" />
										<label class="error" for="captchatext" id="captcha_error">*This field is required.</label>
										<label class="error" for="captchatext" id="captchatext_error2">*This is not a valid name.</label>
                                    </div>

                                        <div class="buttons-wrapper">
										<input type="hidden" name="contactformid" id="contactformid" value="1" />
										<input type="Submit" id="submit" name="Submit" value="Submit" /></div>
                                </fieldset>
                            </form>
                        </div>
                    </article>


<?php
$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=name,email,phone,message,captchatext:onsubmit=contactform:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>