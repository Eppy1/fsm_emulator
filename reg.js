function checkAllFilled() {
	var fields = $('#reg').serializeArray();
	var result = 'ok'

	jQuery.each( fields, function( i, field ) {
		if(field.value.length == 0) {
			result = 'no'
		}
	});

	return result == 'ok';
}

function checkEmail() {
	var fields = $('#reg').serializeArray();
	return fields[1]['value'].includes('@') && fields[1]['value'].includes('.');
}

function showRegAlert(txt) {
	document.getElementById('alert_txt').innerHTML = txt;
}

$('#reg').submit(function() {

	if(!checkAllFilled())  { showRegAlert("Все поля должны быть заполнены!"); return false;}
	else if(!checkEmail()) { showRegAlert("Некорректный e-mail"); return false;}

	return true;
});