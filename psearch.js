
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

function checkIsAdmin() {
  $.ajax({
    url : "is_amin.php",
    type : "get",
    async: false,
    success : function(msg) {
      alert(msg)
    },
    error: function() {

    }
 });
}

function psearch_addRow(id, name, type, rating, author, date, like) {
    var heart = like != '0' ? "like_fill.png" : "like_stroke.png";
    var stars = "<img style='align:bottom; height:5mm' src='" + heart + "' />"+
                "<span style='color:#935171; font-size:large;'>&nbsp;" + rating + "</span>";

    var typeName = "FSM";

    if(id.includes('"')) id = id.substr(1);

    switch(type) {
      case 'turing':    typeName = 'Turing machine'; break;
      case 'post':      typeName = 'Post machine'; break;
      case 'life':      typeName = 'Conway\'s Game of Life'; break;
      case 'markov':    typeName = 'Markov algorithm'; break;
      case 'brainfuck': typeName = 'Brainfuck'; break;

        default: break;
    }

    var d = (Date.now() - new Date(date).getTime()) / 1000 - 3600*3;
    var time_ref = 'Recently';
    
    if(d < 5) time_ref = 'Recently';
    else if(d <= 60) time_ref = Math.trunc(d) + ' seconds ago';
    else if(d <= 3600) time_ref = Math.trunc(d/60) + ' minutes ago';
    else if(d <= 3600*24) time_ref = Math.trunc(d/3600) + ' hours ago';
    else time_ref = formatDate(new Date(date));

    var table = document.getElementById("table_psearch");
    var t = table.innerHTML + ""
    table.innerHTML = t+"<tr style='width:100%; margin:auto;' onclick=\"window.location.href = 'page_fsm.php?fsm="+ type +"&id="+id+"'\"> <td style='width:52%; text-align:left;'> <span class='program_name'>" + 
    name + "</span><br> <span class='program_type'>" +  typeName +
    "</span> </td>" +  "<td class='stars'>" + stars + "</td> <td style='font-size:large'>" + author + 
    "</td> <td class='time_ref'>" + time_ref + "</td></tr>";
}

function psearch_upd(msg) {
    var q = msg.split('==');

    if(q.length == 2) {
      document.getElementById("input").visibility = "inherit";
      document.getElementById("table_psearch").innerHTML = "<tr><td> There are no programs yet...</td></tr>"
    } else {
      document.getElementById("input").visibility = "visible";
    }

    for(var i=0; i<q.length-1; i++)
    {
        var arr = q[i].split('||');
        if(arr[0] == '' || arr[1] == '') break;
        psearch_addRow(arr[0].trim(), arr[1], arr[2], parseInt(arr[4]), arr[6], arr[3], arr[7]);
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
        
    table.rows[i].style.display = (prog.toUpperCase().includes(filter.toUpperCase()) || author.toUpperCase().includes(filter.toUpperCase())) ? 'table-row' : 'none';
	}
}
