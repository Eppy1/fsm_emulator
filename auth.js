
function auth_checkAllFilled() {
    var fields = $('#auth').serializeArray();
    var result = 'ok'

    jQuery.each( fields, function( i, field ) {
        if(field.value.length == 0) {
            result = 'no'
        }
    });

    return result == 'ok';
}

$('#auth').submit(function() {
    if(!auth_checkAllFilled())  {
        document.getElementById('auth_alert_txt').innerHTML = "Все поля должны быть заполнены!";
        return false;
    }

	return true;
});