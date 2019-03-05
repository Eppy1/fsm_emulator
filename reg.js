function checkAllFilled() {
	var fields = $('#reg').serializeArray();
	var result = 'ok'

	for(i=0; i<4; i++) {
		if(fields[i].value.length == 0) {
			result = 'no'
		}
	});

	return result == 'ok';
}

function checkEmail() {
	var fields = $('#reg').serializeArray();
	return fields[1]['value'].includes('@') && fields[1]['value'].includes('.');
}

function checkLoginLength() {
	var fields = $('#reg').serializeArray();
	return fields[0]['value'].length >= 4 && fields[0]['value'].length <= 20;
}

function checkPasswordMatch() {
	var fields = $('#reg').serializeArray();
	return fields[2]['value'] == fields[3]['value'];
}

function checkPasswordLength() {
	var fields = $('#reg').serializeArray();
	return fields[2]['value'].length >= 6;
}

function checkRulesConfirmation() {
	var fields = $('#reg').serializeArray();
	return document.getElementById("confirm").checked;
}

function showRegAlert(txt) {
	document.getElementById('alert_txt').innerHTML = txt;
}

$('#reg').submit(function() {

	if(!checkAllFilled())  { showRegAlert("All fields should be filled!"); return false;}
	else if(!checkLoginLength()) { showRegAlert("The login length should be 4...20 chars"); return false;}
	else if(!checkPasswordMatch()) { showRegAlert("Passwords do not match"); return false;}
	else if(!checkPasswordLength()) { showRegAlert("Password is too simple"); return false;}
	else if(!checkRulesConfirmation()) { showRegAlert("Confirm the rules"); return false;}

	return true;
});