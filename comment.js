
function cmt_addComment(user, date, content) {
    var time_ref = "5 минут назад";

    var table = document.getElementById("table_comment");

    table.innerHTML += "<tr class=\"comment\">"+
    "<td> <img class='ava' src='ava_default.png'/></td>"+
    "<td><span class='nickname'>" + user + "</span>&nbsp;&nbsp;"+
    "<span class='time'>" + time_ref + "</span><br>"+
    "<span class='expr'>" + content + "</span></td>";
}

function cmt_update() {
    if(program_id == 0) {
        //TODO Нахуй комменты
        return;
    }

    var request = $.ajax({
		url: "comment.php",
		type: "POST",
		data: {func: 'read', program: program_id},
		dataType: "html"
	  });
	   
    request.done(function(msg) {
        //alert(msg);
    });
	   
    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
    
}

function cmt_comment() {
   /* var content = document.getElementById('new_comment_field').value;
    var request = $.ajax({
		url: "comment.php",
		type: "POST",
		data: {func: 'write', program: program_id, text: text},
		dataType: "html"
	  });
	   
    request.done(function(msg) {
        //alert(msg);
    });
	   
    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });*/
}

cmt_update();