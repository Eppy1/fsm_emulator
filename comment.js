function formatDate(date) {
    var monthNames = [
      "Jan", "Feb", "Mar",
      "Apr", "May", "Jun", "Jul",
      "Aug", "Sep", "Oct",
      "Nov", "Dec"
    ];
  
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
  
    return monthNames[monthIndex] + ' ' + day;
  }

function deleteComment(id) {
    var c = confirm("Do you really want to delete this comment?");

    if(c) {
        $.ajax({
            url : "comment.php",
            type : "post",
            async: true,
            data: {func: 'delete', id: ''+id},
            success : function(msg) {
              cmt_update();
            },
            error: function() {
        
            }
         });
    }
}

function cmt_addComment(user, date, content, admin, id) {
    var d = (Date.now() - new Date(date).getTime()) / 1000 - 3600*3;
    var time_ref = 'Right now';
    
    if(d < 5) time_ref = 'Recently';
    else if(d <= 60) time_ref = Math.trunc(d) + ' seconds ago';
    else if(d <= 3600) time_ref = Math.trunc(d/60) + ' minutes ago';
    else if(d <= 3600*24) time_ref = Math.trunc(d/3600) + ' hours ago';
    else time_ref = formatDate(new Date(date));

    var table = document.getElementById("table_comment");

    var ava = '0';
    $.ajax({
        url : "ava.php",
        type : "get",
        async: false,
        data: {user: ''+user},
        success : function(msg) {
          ava = msg;
        },
        error: function() {
    
        }
     });

    table.innerHTML += "<tr class=\"comment\">"+
    "<td width='48px'><img class='ava' src='\\avas\\"+ ava +".png'/></td>"+
    "<td><span class='nickname'>" + user + "</span>&nbsp;&nbsp;"+
    "<span class='time'>" + time_ref + "</span><br>"+
    "<span class='expr'>" + content + "</span></td>" + (admin ? "<td style='width:40px;'><button onclick='deleteComment(" + id + ")' class='button'> &#10006; </button></td>" : "") + "</tr>";
}

function checkIsAdmin() {
    var result = false;
    $.ajax({
      url : "is_amin.php",
      type : "get",
      async: false,
      success : function(msg) {
        result = msg == 'yes';
      },
      error: function() {
  
      }
   });

   return result;
}
  
function cmt_update() {
    var is_admin = checkIsAdmin();

    if(this.program_id == 0) {
        getElementById("comment_form").style.display = 'none';
        return;
    }

    document.getElementById("table_comment").innerHTML="";
    document.getElementById("loader").style.display = 'none';

    var request = $.ajax({
		url: "comment.php",
		type: "POST",
		data: {func: 'read', program: program_id},
		dataType: "html"
	  });
	   
    request.done(function(msg) {
        //alert(msg);

        comments = msg.split('==');

        document.getElementById("comment_counter").innerText = (comments.length-1) + ((comments.length-1) == 1 ? " comment" : " comments");

        for(i=0; i<comments.length-1; i++) {
            var comment = comments[i].split('||');
            
            var username = comment[0];
            var time_ref = comment[1];
            var content = comment[2];
            var id = comment[3];
            //alert(content);
            cmt_addComment(username, time_ref, content, is_admin, id);
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
        //alert(msg);
        cmt_update();
    });
	   
    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}