
function formatDate(date) {
    var monthNames = [
      "января", "февраля", "марта",
      "апреля", "мая", "июня", "июля",
      "августа", "сентябра", "октября",
      "ноября", "декабря"
    ];
  
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
  
    return day + ' ' + monthNames[monthIndex];
  }

function psearch_addRow(name, type, rating, author, date) {
    var stars = "<span style='color:#a03'>";

    for(var i=0; i<rating; i++) stars += '*';
    stars += "</span><span style='color:#777'>";
    for(var i=rating; i<5; i++) stars += '*';
    stars += "</span>";

    switch(type) {
        case 'turing':
            type = 'Машина Тьюринга';
            break;

        default: break;
    }

    var d = (Date.now() - new Date(date).getTime()) / 1000 - 3600*3;
    var time_ref = 'Недавно';
    
    if(d < 5) time_ref = 'Только что';
    else if(d <= 60) time_ref = Math.trunc(d) + ' секунд назад';
    else if(d <= 3600) time_ref = Math.trunc(d/60) + ' минут назад';
    else if(d <= 3600*24) time_ref = Math.trunc(d/3600) + ' часов назад';
    else time_ref = formatDate(new Date(date));

    var table = document.getElementById("table_psearch");
    table.innerHTML += "<tr> <td style='width:40%; text-align:left;'> <span class='program_name'>" + 
    name + "</span><br> <span class='program_type'>" +  type +
    "</span> </td>" +  "<td class='stars'>" + stars + "</td> <td>" + author + 
    "</td> <td class='time_ref'>" + time_ref + "</td></tr>";
}

function psearch_upd(msg) {
    var q = msg.split('==');

    for(var i=0; i<q.length-1; i++)
    {
        var arr = q[i].split('||');
        psearch_addRow(arr[1], arr[2], parseInt(arr[4]), "eppy", arr[3]);
    }
}

function psearch_update() {
    var request = $.ajax({
		url: "psearch.php",
		type: "POST",
		data: {func: "select"},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
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

function psearch_setup() {
    psearch_update();
}

window.onload = psearch_setup;