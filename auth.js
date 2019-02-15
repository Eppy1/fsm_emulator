
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

    e.preventDefault();
    $.ajax({
      url: "sendOrderForm.php",
      type: "POST",
      data: $('#osForm').serialize(),
      success: function(response) {
        //обработка успешной отправки
      },
      error: function(response) {
        //обработка ошибок при отправке
     }
    });

	return true;
});