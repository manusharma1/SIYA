<script>
$(function() {
	$( "#paymentdate" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>
<?php
$paymenttypeid_placeholder = '';
$title_placeholder = '';
$description_placeholder = '';
$userid_placeholder = '';
$tax_placeholder = '';
$paymentdate_placeholder = '';
$paymentvalue_placeholder = '';
$checkddnumber_placeholder = '';
$bankdetails_placeholder = '';
$carddetails_placeholder = '';
$discount_placeholder = '';
$tax_placeholder = '';

$HTMLObj = new MainHTML();
global $htmlarray;
$htmlarray = array();
$htmlarray[]['select']['nameid'] = 'paymenttypeid';
$htmlarray[]['select']['class'] = PROJ_AJAX_HTML_POST_CLASS_NORMAL.' required';
$htmlarray[]['select']['close'] = '';

$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = '';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = '------------------';
$htmlarray[]['option']['end'] = '';

$sqlObj = new MainSQL();
$columns = array('id','name','description');
$conditions = array();
$conditions['=']['isactive'] = '1';
$sqlmenu = $sqlObj->SQLCreator('S', 'paymenttypes', $columns, $conditions, '', '', '');
if($resultmenu = $sqlObj->FireSQL($sqlmenu)){
if($sqlObj->getNumRows($resultmenu)!=0){
while($resultsetmenu = $sqlObj->FetchResult($resultmenu)){
$htmlarray[]['option']['start'] = '';
$htmlarray[]['option']['value'] = $sqlObj->getCleanData($resultsetmenu->id);
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$paymenttypeid_placeholder = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST)){
$title_placeholder = (isset($_POST['title']))?$_POST['title']:'';
$description_placeholder = (isset($_POST['description']))?$_POST['description']:'';
$userid_placeholder = (isset($_POST['userid']))?$_POST['userid']:'';
$paymentdate_placeholder = (isset($_POST['paymentdate']))?$_POST['paymentdate']:'';
$paymentvalue_placeholder = (isset($_POST['paymentvalue']))?$_POST['paymentvalue']:'';
$checkddnumber_placeholder = (isset($_POST['checkddnumber']))?$_POST['checkddnumber']:'';
$bankdetails_placeholder = (isset($_POST['bankdetails']))?$_POST['bankdetails']:'';
$carddetails_placeholder = (isset($_POST['carddetails']))?$_POST['carddetails']:'';
$discount_placeholder = (isset($_POST['discount']))?$_POST['discount']:'';
$tax_placeholder = (isset($_POST['tax']))?$_POST['tax']:'';
}
?>

<?php
if(PROJ_RUN_AJAX==1){
if(isset($_SESSION['message'])){
echo $_SESSION['message'];
}
}
?>

<script>
$(document).ready(function(){
$("#addpaymentform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('payments/savePayment/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('payments/savePayment/');
}
?>
<form id="addpaymentform" name="addpaymentform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Add Payment</legend>

	<ol>
		
		<li>
		<label for="paymenttypeid">Payment Type : </label><?php echo $paymenttypeid_placeholder; ?>
		
		</li>
		
		<li>
		<label for="userid"><?php echo $lang['siya']['payments']['USERID']; ?></label>
		<input id="userid" name="userid" type="text" placeholder="<?php echo $lang['siya']['payments']['USERID']; ?>" value="<?php echo $userid_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="title"><?php echo $lang['siya']['payments']['TITLE']; ?></label>
		<input id="title" name="title" type="text" placeholder="<?php echo $lang['siya']['payments']['TITLE']; ?>" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description"><?php echo $lang['siya']['payments']['DESCRIPTION']; ?></label>
		<textarea id="description" name="description" placeholder="<?php echo $lang['siya']['payments']['DESCRIPTION']; ?>" rows="5"  autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>

		<li>
		<label for="paymentdate"><?php echo $lang['siya']['payments']['ADD_PAYMENT']; ?></label>
		<input id="paymentdate" name="paymentdate" type="text" placeholder="<?php echo $lang['siya']['payments']['ADD_PAYMENT']; ?>" value="<?php echo $paymentdate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="paymentvalue"><?php echo $lang['siya']['payments']['PAYMENT_DATE']; ?></label>
		<input id="paymentvalue" name="paymentvalue" type="text" placeholder="<?php echo $lang['siya']['payments']['PAYMENT_DATE']; ?>" value="<?php echo $paymentvalue_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="paymentmode"><?php echo $lang['siya']['payments']['PAYMENT_VALUE']; ?></label><select name="paymentmode" id="paymentmode" <?php echo _FORM_CLASS; ?> />
		<option value="">------</option>
		<option value="CASH">CASH</option>
		<option value="CHEQUE">CHEQUE</option>
		<option value="DD">DD</option>
		<option value="ONLINEPAYMENT">ONLINEPAYMENT</option>
		<option value="BANKTRANSFER">BANKTRANSFER</option>
		<option value="CARDSWIPE">CARDSWIPE</option>
		</select>
		</li>

		<li>
		<label for="checkddnumber"><?php echo $lang['siya']['payments']['CHECK_/_DD_NUMBER']; ?></label>
		<input id="checkddnumber" name="checkddnumber" type="text" placeholder="<?php echo $lang['siya']['payments']['CHECK_/_DD_NUMBER']; ?>" value="<?php echo $checkddnumber_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>
		
		
		<li>
		<label for="bankdetails"><?php echo $lang['siya']['payments']['BANK_DETAILS']; ?></label>
		<input id="bankdetails" name="bankdetails" type="text" placeholder="<?php echo $lang['siya']['payments']['BANK_DETAILS']; ?>" value="<?php echo $bankdetails_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>

		<li>
		<label for="carddetails"><?php echo $lang['siya']['payments']['CARD_DETAILS']; ?></label>
		<input id="carddetails" name="carddetails" type="text" placeholder="<?php echo $lang['siya']['payments']['CARD_DETAILS']; ?>" value="<?php echo $carddetails_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="discount"><?php echo $lang['siya']['payments']['DISCOUNT']; ?></label>
		<input id="discount" name="discount" type="text" placeholder="<?php echo $lang['siya']['payments']['DISCOUNT']; ?>" value="<?php echo $discount_placeholder; ?>" />
		</li>

		<li>
		<label for="tax"><?php echo $lang['siya']['payments']['TAX']; ?></label>
		<input id="tax" name="tax" type="text" placeholder="<?php echo $lang['siya']['payments']['TAX']; ?>" value="<?php echo $tax_placeholder; ?>" />
		</li>

	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>