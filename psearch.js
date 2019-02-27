
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

function psearch_addRow(id, name, type, rating, author, date) {
    var stars = "<img style='align:bottom; height:5mm' src='like_stroke.png' />"+
                "<span style='color:#935171; font-size:large;'>&nbsp;" + rating + "</span>";

    switch(type) {
        case 'turing':
            type = 'Turing machine';
            break;

        default: break;
    }

    var d = (Date.now() - new Date(date).getTime()) / 1000 - 3600*3;
    var time_ref = 'Недавно';
    
    if(d < 5) time_ref = 'Recently';
    else if(d <= 60) time_ref = Math.trunc(d) + ' seconds ago';
    else if(d <= 3600) time_ref = Math.trunc(d/60) + ' minutes ago';
    else if(d <= 3600*24) time_ref = Math.trunc(d/3600) + ' hours ago';
    else time_ref = formatDate(new Date(date));

    var table = document.getElementById("table_psearch");
    table.innerHTML += "<tr onclick=\"window.location.href = 'page_fsm.php?fsm=turing&id="+id+"'\"> <td style='width:40%; text-align:left;'> <span class='program_name'>" + 
    name + "</span><br> <span class='program_type'>" +  type +
    "</span> </td>" +  "<td class='stars'>" + stars + "</td> <td style='font-size:large'>" + author + 
    "</td> <td class='time_ref'>" + time_ref + "</td></tr>";
}

function psearch_upd(msg) {
    var q = msg.split('==');

    for(var i=0; i<q.length-1; i++)
    {
        var arr = q[i].split('||');
        psearch_addRow(arr[0], arr[1], arr[2], parseInt(arr[4]), arr[6], arr[3]);
    }
}

function psearch_update(arg) {
    var request = $.ajax({
		url: "psearch.php",
		type: "POST",
		data: {func: "select", filter: arg},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
        //alert(msg);
        psearch_upd(msg);
	  });
	   
	  request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
	  });
}

function psearch_filter() {
    var filter = document.getElementById("input").value;

    var table = document.getElementById("table_psearch");
	var n = table.getElementsByTagName("tr").length;

	for(i=0; i<n; i++) {
		var prog = table.rows[i].cells[0].textContent;
		var author  = table.rows[i].cells[2].textContent;
        
        table.rows[i].style.display = (prog.toUpperCase().includes(filter.toUpperCase()) || author.toUpperCase().includes(filter.toUpperCase())) ? 'block' : 'none';
	}
}
