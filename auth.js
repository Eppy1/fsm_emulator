$( document ).ready(function() {
    $("#btn").click(
		function(){
			sendAjaxForm('auth', 'auth.php');
			return false; 
		}
	);
});
 
function sendAjaxForm(ajax_form, url) {
    jQuery.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: jQuery("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
        	result = jQuery.parseJSON(response);
    	},
    	error: function(response) {
    	}
 	});
}