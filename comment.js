function cmt_addComment(user, date, content) {
    var d = (Date.now() - new Date(date).getTime()) / 1000 - 3600*3;
    var time_ref = 'Недавно';
    
    if(d < 5) time_ref = 'Recently';
    else if(d <= 60) time_ref = Math.trunc(d) + ' seconds ago';
    else if(d <= 3600) time_ref = Math.trunc(d/60) + ' minutes ago';
    else if(d <= 3600*24) time_ref = Math.trunc(d/3600) + ' hours ago';
    else time_ref = formatDate(new Date(date));

    var table = document.getElementById("table_comment");

    table.innerHTML += "<tr class=\"comment\">"+
    "<td width='48px'><img class='ava' src='ava_default.png'/></td>"+
    "<td><span class='nickname'>" + user + "</span>&nbsp;&nbsp;"+
    "<span class='time'>" + time_ref + "</span><br>"+
    "<span class='expr'>" + content + "</span></td></tr>";
}

function cmt_update() {
    if(this.program_id == 0) {
        getElementById("comment_form").style.display = 'none';
        return;
    }

    document.getElementById("table_comment").innerHTML="";

    var request = $.ajax({
		url: "comment.php",
		type: "POST",
		data: {func: 'read', program: program_id},
		dataType: "html"
	  });
	   
    request.done(function(msg) {
        comments = msg.split('==');

        document.getElementById("comment_counter").innerText = (comments.length-1) + " comments";

        for(i=0; i<comments.length-1; i++) {
            var comment = comments[i].split('||');
            
            var username = comment[0];
            var time_ref = comment[1];
            var content = comment[2];

            cmt_addComment(username, time_ref, content);
        }
    });
	   
    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
    
}

function cmt_comment() {
    var content = document.getElementById('new_comment_field').value;
    document.getElementById('new_comment_field').value = "";

    var request = $.ajax({
		url: "comment.php",
		type: "POST",
		data: {func: 'write', program: program_id, text: content},
		dataType: "html"
	  });
	   
    request.done(function(msg) {
        cmt_update();
    });
	   
    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}