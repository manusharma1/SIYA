function JSFunctionVolunteerContactForm(thisform){

    valid = true;
	radiogroupchecked = false;
	var text_not_empty = 'Should not be Empty';


	if (thisform.name.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }

	if (thisform.email.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }


	if (thisform.phone.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }


	if (thisform.sign.checked == false && thisform.licence.checked == false && thisform.campaigncards.checked == false){
        alert ("Please check at least one option from Volenteer Items");
        valid = false;
    }


	if (thisform.captchatext.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }

	return valid;


}


function JSFunctionDonateContactForm(thisform){

    valid = true;
	var text_not_empty = 'Should not be Empty';

	if (thisform.name.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }

	if (thisform.email.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }


	if (thisform.phone.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }

	if(document.getElementById('donate_1').checked==false && document.getElementById('donate_2').checked==false && document.getElementById('donate_3').checked==false){
    alert ("Please select the Amount to Donate");
	valid = false;
	}
	

	if(document.getElementById('donate_3').checked==true && thisform.donateamount.value==""){
    alert ("Please Enter the Amount to Donate");
	valid = false;
	}

	if (thisform.captchatext.value == ""){
        alert (thisform.name.title+' '+text_not_empty);
        valid = false;
    }

	return valid;

}