<script>
$(function() {
	$( "#paymentdate" ).datepicker({dateFormat:'yy-mm-dd'});
});
</script>
<?php
$id = _ACTION_VIEW_PARAMETER_ID;

	MainSystem::CheckIDExists('payments','id',$id,'payments/managePayments/');

	$accessreturnmessage = MainSystem::CheckOtherUsersActionAccess('payments','addedby',$id);
	if($accessreturnmessage != 'OK'){
	MainSystem::URLForwarder(MainSystem::URLCreator('errorhandler/displayError/'.$accessreturnmessage.'/'));
	}

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


global $paymenttype_tag;
$paymenttype_tag = '';


$columns = array('id','paymenttypeid','userid','title','description','paymentdate','paymentvalue','paymentmode','checkddnumber','bankdetails','carddetails','discount','tax');

$conditions = array();
$conditions['=']['id'] = $id;

$sqlObj = new MainSQL();

$sql = $sqlObj->SQLCreator('S', 'payments', $columns, $conditions, '', '', '');

if($result = $sqlObj->FireSQL($sql)){
if($sqlObj->getNumRows($result) !=0){ 
if($resultset = $sqlObj->FetchResult($result)){
$id = $sqlObj->getCleanData($resultset->id);
$title_placeholder =  $sqlObj->getCleanData($resultset->title);
$paymenttype_tag =  $sqlObj->getCleanData($resultset->paymenttypeid);
$userid_placeholder =  $sqlObj->getCleanData($resultset->userid);
$description_placeholder =  $sqlObj->getCleanData($resultset->description);
$paymentdate_placeholder = $sqlObj->getCleanData($resultset->paymentdate);
$paymentmode_placeholder = $sqlObj->getCleanData($resultset->paymentmode);
$paymentvalue_placeholder = $sqlObj->getCleanData($resultset->paymentvalue);
$checkddnumber_placeholder = $sqlObj->getCleanData($resultset->checkddnumber);
$bankdetails_placeholder = $sqlObj->getCleanData($resultset->bankdetails);
$carddetails_placeholder = $sqlObj->getCleanData($resultset->carddetails);
$discount_placeholder = $sqlObj->getCleanData($resultset->discount);
$tax_placeholder = $sqlObj->getCleanData($resultset->tax);
}
}
}



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
($resultsetmenu->id == $paymenttype_tag)?$htmlarray[]['option']['nonattribute'] = 'SELECTED':'';
$htmlarray[]['option']['close'] = '';
$htmlarray[]['option']['data'] = $sqlObj->getCleanData($resultsetmenu->name).' ('.$sqlObj->getCleanData($resultsetmenu->description).')';
$htmlarray[]['option']['end'] = '';
}
}
}

$htmlarray[]['select']['end'] = '';
$paymenttypeid_placeholder = $HTMLObj->HTMLCreator($htmlarray);



if(isset($_POST) && isset($_POST['issubmit'])){
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
$("#editpaymenttypeform").validate();
});
</script>

<?php
if(PROJ_RUN_AJAX==1){
$formaction = MainSystem::URLCreator('payments/savePayment/'.$id.'/','ajax','post','',PROJ_AJAX_DEFAULT_HTML_ID_FOR_TEMPLATE,false);
}else{
$formaction = MainSystem::URLCreator('payments/savePayment/'.$id.'/');
}
?>
<form id="editpaymenttypeform" name="editpaymenttypeform" method="post" action="<?php echo $formaction; ?>">

<fieldset>

	<legend>Edit Payment</legend>

	<ol>
		
		<li>
		<label for="paymenttypeid">Payment Type : </label><?php echo $paymenttypeid_placeholder; ?>
		
		</li>
		
		<li>
		<label for="userid">userid</label>
		<input id="userid" name="userid" type="text" placeholder="Enter User Id" value="<?php echo $userid_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="title">Title</label>
		<input id="title" name="title" type="text" placeholder="Enter Title" value="<?php echo $title_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>
		
		<li>
		<label for="description">Description</label>
		<textarea id="description" name="description" placeholder="Enter Description" rows="5" autofocus="" <?php echo _FORM_CLASS; ?>><?php echo $description_placeholder; ?></textarea>
		</li>

		<li>
		<label for="paymentdate">Payment Date</label>
		<input id="paymentdate" name="paymentdate" type="text" placeholder="Enter Payment Date" value="<?php echo $paymentdate_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="paymentvalue">Payment Value</label>
		<input id="paymentvalue" name="paymentvalue" type="text" placeholder="Enter Payment Value" value="<?php echo $paymentvalue_placeholder; ?>" <?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="paymentmode">Payment Mode </label><select name="paymentmode" id="paymentmode" <?php echo _FORM_FINAL; ?> />
		<option value="">------</option>
		<option value="CASH" <?php  echo ($paymentmode_placeholder=='CASH')?'SELECTED':''; ?>>CASH</option>
		<option value="CHEQUE" <?php  echo ($paymentmode_placeholder=='CHEQUE')?'SELECTED':''; ?>>CHEQUE</option>
		<option value="DD" <?php  echo ($paymentmode_placeholder=='DD')?'SELECTED':''; ?>>DD</option>
		<option value="ONLINEPAYMENT" <?php  echo ($paymentmode_placeholder=='ONLINEPAYMENT')?'SELECTED':''; ?>>ONLINEPAYMENT</option>
		<option value="BANKTRANSFER" <?php  echo ($paymentmode_placeholder=='BANKTRANSFER')?'SELECTED':''; ?>>BANKTRANSFER</option>
		<option value="CARDSWIPE" <?php  echo ($paymentmode_placeholder=='CARDSWIPE')?'SELECTED':''; ?>>CARDSWIPE</option>
		</select>
		</li>

		<li>
		<label for="checkddnumber">Check / DD Number</label>
		<input id="checkddnumber" name="checkddnumber" type="text" placeholder="Enter Check / DD Number" value="<?php echo $checkddnumber_placeholder; ?>" <?php echo _FORM_FINAL; ?>/>
		</li>
		
		
		<li>
		<label for="bankdetails">Bank Details</label>
		<input id="bankdetails" name="bankdetails" type="text" placeholder="Enter Bank Details" value="<?php echo $bankdetails_placeholder; ?>"<?php echo _FORM_FINAL; ?> />
		</li>

		<li>
		<label for="carddetails">Card Details</label>
		<input id="carddetails" name="carddetails" type="text" placeholder="Enter Card Details" value="<?php echo $carddetails_placeholder; ?>"<?php echo _FORM_FINAL; ?>  />
		</li>

		<li>
		<label for="discount">Discount</label>
		<input id="discount" name="discount" type="text" placeholder="Enter Discount" value="<?php echo $discount_placeholder; ?>" />
		</li>

		<li>
		<label for="tax">Tax</label>
		<input id="tax" name="tax" type="text" placeholder="Enter tax" value="<?php echo $tax_placeholder; ?>" />
		</li>

	</ol>
<fieldset>

<button type="submit">Save</button>

</fieldset>

</form>