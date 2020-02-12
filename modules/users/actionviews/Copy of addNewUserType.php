<form id="add" name="add" method="post" action="<?php echo MainSystem::URLCreator('users/addNewUserType/') ?>" onsubmit="return JSMainFunction();">

<fieldset>

	<legend>Add New User Type</legend>

	<ol>

		<li>
		<label for="name"><?php echo $lang['siya']['users']['USER_TYPE_TAG'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['users']['USER_TYPE_TAG'];?>" required="" autofocus="">
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['users']['NAME'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['users']['NAME'];?>" required="" autofocus="">
		</li>

		<li>
		<label for="name"><?php echo $lang['siya']['users']['DESCRIPTION'];?></label>
		<input id="name" name="name" type="text" placeholder="<?php echo $lang['siya']['users']['DESCRIPTION'];?>" required="" autofocus="">
		</li>

	</ol>

</fieldset>

<fieldset>

	<legend>Delivery address</legend>

	<ol>

		<li>
		<label for="address">Address</label>
		<textarea id="address" name="address" rows="5" required=""></textarea>
		</li>

		<li>
		<label for="postcode">Post code</label>
		<input id="postcode" name="postcode" type="text" required="">
		</li>

		<li>
		<label for="country">Country</label>
		<input id="country" name="country" type="text" required="">
		</li>

	</ol>

</fieldset>

<fieldset>

	<legend>Card details</legend>

	<ol>

		<li>

		<fieldset>

		<legend>Card type</legend>

		<ol>

		<li>
			<input id="visa" name="cardtype" type="radio">
			<label for="visa">VISA</label>
		</li>

		<li>
			<input id="amex" name="cardtype" type="radio">
			<label for="amex">AmEx</label>
		</li>

		<li>
			<input id="mastercard" name="cardtype" type="radio">
			<label for="mastercard">Mastercard</label>
		</li>

		</ol>

		</fieldset>

		</li>

		<li>
		<label for="cardnumber">Card number</label>
		<input id="cardnumber" name="cardnumber" type="number" required="">
		</li>

		<li>
		<label for="secure">Security code</label>
		<input id="secure" name="secure" type="number" required="">
		</li>

		<li>
		<label for="namecard">Name on card</label>
		<input id="namecard" name="namecard" type="text" placeholder="Exact name as on the card" required="">
		</li>

	</ol>

</fieldset>

<fieldset>

<button type="submit">Buy it!</button>

</fieldset>

</form>

<?php
$HTMLObj = new MainHTML();
$htmlarray = array();

$htmlarray[]['js']['js'] = 'notempty=newstitle,newstext,newsdate:onsubmit=addnewnews:alert:default';
$validation = $HTMLObj->HTMLCreator($htmlarray);

echo $validation;
?>