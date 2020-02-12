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
class contactform
{
private static $lang;

function SIYA__contactform_INSTALLER__(){

$block_installer_info_array = array();
$block_installer_info_array['block']['info'] = array('description' => '');
$block_installer_info_array['action']['showContactForm'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
$block_installer_info_array['action']['showVolunteerContactForm'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
$block_installer_info_array['action']['showEndorseContactForm'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
$block_installer_info_array['action']['showDonateContactForm'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
$block_installer_info_array['action']['contactFormSubmit'] = array('usertypeaccess'=>'', 'templateaccess'=>'', 'description' => '');
return $block_installer_info_array;
}

function SIYA__contactform_INIT__(){

global $lang;

self::$lang = $lang;

}

function showContactForm($parameters)
{
	$pageid = $parameters[0];

	$actionviewresult = MainSystem::CallActionView($pageid,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}



function showVolunteerContactForm($parameters)
{
	$pageid = $parameters[0];

	$actionviewresult = MainSystem::CallActionView($pageid,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}


function showEndorseContactForm($parameters)
{
	$pageid = $parameters[0];

	$actionviewresult = MainSystem::CallActionView($pageid,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}


function showDonateContactForm($parameters)
{
	$pageid = $parameters[0];

	$actionviewresult = MainSystem::CallActionView($pageid,__CLASS__,__FUNCTION__);
	return $actionviewresult;
}


public function contactFormSubmit($parameters){

	$pageid = $parameters[0];

	include_once(PROJ_3RDPARTY_DIR._S.'securimage/securimage.php');
	//require_once(PROJ_3RDPARTY_DIR._S.'phpmailer/class.phpmailer.php');


		// Get Email Data
		$columns = array('email');
		$conditions = array();
		$conditions['=']['isactive'] = 1;
		$conditions['AND =']['usertype'] = 1;
		$conditions['AND =']['username'] = 'admin';

		$sqlObj = new MainSQL();
		$sqlcontactcontents = $sqlObj->SQLCreator('S', 'users', $columns, $conditions, '', '', '');
		if($resultcontactcontents = $sqlObj->FireSQL($sqlcontactcontents)){
		if($sqlObj->getNumRows($resultcontactcontents) !=0){ // If contact Exists
		if($resultsetcontactcontents = $sqlObj->FetchResult($resultcontactcontents)){
		$admin_email = $resultsetcontactcontents->email;

		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$captchatext = $_POST['captchatext'];

		if(isset($_POST['message'])){
		$message = $_POST['message'];
		}

		$securimage2 = new Securimage();
		if ($securimage2->check($captchatext) == false) {
		$_SESSION['message'] = 'The Security Image Code that you have entered is incorrect';
		MainSystem::URLForwarder(MainSystem::URLCreator('cms/getContent/'.$pageid.'/'));
		}

		/*$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

		$mail->IsSMTP(); // telling the class to use SMTP

		try {
		  $mail->Host       = "mail.danekirbyforsheriff.com"; // SMTP server
		  $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
		  $mail->SMTPAuth   = true;                  // enable SMTP authentication
		  $mail->Port       = 25;                    // set the SMTP port 
		  $mail->Username   = $admin_email; // SMTP account username
		  $mail->Password   = "ron78";        // SMTP account password
		  // if you're using SSL
		  //$mail->SMTPSecure = 'ssl';
		  // OR use TLS
		  //$mail->SMTPSecure = 'tls';
		  $mail->CharSet = "UTF-8";
		  $mail->IsHTML(true); // send as HTML
		  $mail->AddReplyTo($admin_email, 'Dane Kirby Contact Us');
		  $mail->AddAddress($admin_email, 'Dane Kirby Contact Us');
		  $mail->SetFrom($admin_email, 'Dane Kirby Contact Us');
		  $mail->AddReplyTo($admin_email, 'Dane Kirby Contact Us');
		  */
		  
		  if($_POST['contactformid']=='1'){
		  $mailsubject = 'Contact Us Form';
		  }else if($_POST['contactformid']=='2'){
		  $mailsubject = 'Volunteer Form';
		  }else if($_POST['contactformid']=='3'){
		  $mailsubject = 'Endorsement Form';
		  }else if($_POST['contactformid']=='4'){
		  $mailsubject = 'Donate Form';
		  }
		  
		  //$mail->Subject = $mailsubject;/
		  //$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		  $body = $mailsubject.'<br /><hr />';
		  $body .= 'Name : '.$name.'<br />';
		  $body .= 'Email : '.$email.'<br />';
		  $body .= 'Phone : '.$phone.'<br /><hr />';


		  if($_POST['contactformid']=='2'){
		  $sign = (isset($_POST['sign']))?$_POST['sign']:'';
		  $licence = (isset($_POST['licence']))?$_POST['licence']:'';
		  $campaigncards = (isset($_POST['campaigncards']))?$_POST['campaigncards']:'';
		  $body .= ($sign=='1')?'I would like to Place a Sign in my Yard':''.'<br />';
		  $body .= ($licence=='1')?'I would like a License Plate for my Auto':''.'<br />';
		  $body .= ($campaigncards=='1')?'I would like some of your Campaign Cards to Distribute to my Friends':''.'<br />';
		  }
			
		  if($_POST['contactformid']=='4'){
		  
		  if(isset($_POST['donate']) && $_POST['donate']=='50'){
		  $donate_amount = 'Donation of $50.00';
		  }else if(isset($_POST['donate']) && $_POST['donate']=='100'){
		  $donate_amount = 'Donation of $100.00';
		  }else if(isset($_POST['donate']) && $_POST['donate']=='otheramount'){
		  $donate_amount = 'User Specific Donation Amount of '.$_POST['donateamount'];
		  }
		  
		  $body .= 'Donation Amount - '.$donate_amount;
		  }

		  if($_POST['contactformid']=='1' || $_POST['contactformid']=='3'){
		  $body .= 'Message : '.$message;
		  }

		  //$mail->MsgHTML($body);


		//PHP MAIL FUNCTION

		$subject = $mailsubject;

		$message = $body;

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Dane Kirby Website <'.$admin_email . ">\r\n" .
			'X-Mailer: PHP/' . phpversion();

		$mailsend = mail($admin_email, $subject, $message, $headers);
		if($mailsend){
		$_SESSION['message'] = 'Your Message has been sent';
		}else{
		$_SESSION['message'] = 'MAIL ERROR : Message cannot be sent';		
		}

		  /*$mail->Send();
		  $_SESSION['message'] = 'Your Message has been sent';
		  }catch (phpmailerException $e){
		  $_SESSION['message'] = $e->errorMessage(); //Pretty error messages from PHPMailer
		  MainSystem::URLForwarder(MainSystem::URLCreator('cms/getContent/'.$pageid.'/'));
		  }catch (Exception $e){
		  $_SESSION['message'] = $e->getMessage(); //Boring error messages from anything else!
		  MainSystem::URLForwarder(MainSystem::URLCreator('cms/getContent/'.$pageid.'/'));

		  }*/
		
		  }
		  }
		  }



}

} // class contactform