var program_id = 0;

var header = "The Game of life program #1"

var main_arr = [];
var reserved_arr = [];
var field = undefined;

var WIDTH = 36
var HEIGHT = 18

var running = false;
var runTimer = undefined;

var generation = 0;

function step() {
	makeIteration();
}

function run() {
	if(running) return;

	running = true;

	generation = 0;

	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			reserved_arr[i*WIDTH+j] = main_arr[i*WIDTH+j];
		}
	}

	runTimer = setInterval(step, 200);
}

function makeCode() {
	var code = "";
	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			code += main_arr[i*WIDTH+j] ? '1' : '0';
		}
	}
	return code;
}

function clear() {
	alert('kek');
	stop();
	main_arr = [];
	reserved_arr = [];
	updateField();
}

function saveCode() {
	alert(program_id);
	var code1 = makeCode();
	alert(code1);
	var request = $.ajax({
		url: "fsm_save.php",
		type: "POST",
		data: {func: "save", id: program_id, code: code1, fsm: "life", name: header},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
			if(!msg.includes("UPDATE")) {
				window.location.replace("/page_fsm.php?fsm=life&id="+msg);
			}
	  });
	   
	  request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
	  });
}

function acceptProg(msg) {
  var arr=msg.split('||');
	program_id = parseInt(arr[0].substr(1));
	document.getElementById('program_header').value = arr[1];
	header = document.getElementById('program_header').value;
	document.getElementById('author').innerHTML = "Author: " + arr[4].substr(0, arr[4].length-1); 
	var map = arr[2];
	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			reserved_arr[i*WIDTH+j] = main_arr[i*WIDTH+j] = map[i*WIDTH+j] == '1';
		}
	}
	updateField();
}

function loadProg(id1) {
	var request = $.ajax({
		url: "fsm_load.php",
		type: "POST",
		data: {id: id1},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
			acceptProg(msg);
	  });
	   
	  request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
	  });
}

function like() {
	var request = $.ajax({
		url: "like.php",
		type: "POST",
		data: {program: program_id},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
			if(msg == "wtf") {alert('wtf');}
			else {
				var m = msg.split(' ');
				document.getElementById("like_counter").innerHTML = "" + m[0];
				document.getElementById("heart").src = m[1];
			}
	  });
	   
	  request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
	  });
}

var alive_symbols = ['&#8240;', '&#167;', '&#38;', '&#163;', '&#8364;', '&#8776;', '&#8730;', '&#8721;', '&#8719;', '&#8706;', '&#8747;', '&#8711;', '&#8704;', '&#8708;'];
var emty_symbols = ['&middot;', '&#176;', '&#183;', '.', ',', '\'', '\"'];

function randomInteger(min, max) {
	var rand = min - 0.5 + Math.random() * (max - min + 1)
	rand = Math.round(rand);
	return rand;
}

function getCellSymbol(alive) {
	if(alive) {
		return alive_symbols[randomInteger(0, alive_symbols.length-1)]
	} else {
		return emty_symbols[randomInteger(0, emty_symbols.length-1)]
	}
}

function countCells(x, y) {
	var count = 0;
	for(var i=y-1; i<=y+1; i++) {	
		for(var j=x-1; j<=x+1; j++) {
			if(main_arr[i*WIDTH+j]%(WIDTH*HEIGHT)) count++;
		}
	}

	return count;
}

function makeIteration() {
	var tmp_arr = [];

	generation++;

	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			var count = countCells(j, i);

			if(main_arr[i*WIDTH+j]) {
				tmp_arr[i*WIDTH+j] = (count == 3 || count == 4);
			} else {
				tmp_arr[i*WIDTH+j] = count == 3;
			}
		}
	}

	for(var i=0; i< tmp_arr.length; i++) main_arr[i] = tmp_arr[i];

	updateField();
}

function updateField() {
	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			field.rows[i].cells[j].innerHTML = getCellSymbol(main_arr[i*WIDTH+j]);
			field.rows[i].cells[j].className = main_arr[i*WIDTH+j] ? 'fullCell' : 'emptyCell';
		}
	}

	document.getElementById("txt_gen").innerHTML = "Generation: " + generation;
}

function makeField() {
	for(var i=0; i<HEIGHT; i++) {
		var row = field.insertRow();
		for(var j=0; j<WIDTH; j++) {
			main_arr[i*WIDTH+j] = false;

			var cell = row.insertCell();
			cell.className = 'emptyCell';
			cell.innerHTML = getCellSymbol(false);
			cell.onclick = function () {
				var y = this.parentNode.rowIndex
				var x = this.cellIndex

				main_arr[y*WIDTH+x] = !main_arr[y*WIDTH+x];
				updateField();
			};
		}
	}
}

function setup() {
	var title = document.getElementById('program_header');
	title.oninput = function() {
		header = title.value;
	}

	field = document.getElementById('field');
	main_arr = [];

	makeField();

}

function reset() {
	generation = 0;

	clearInterval(runTimer);
	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			main_arr[i*WIDTH+j] = reserved_arr[i*WIDTH+j];
		}
	}
	updateField();
}

function stop() {
	clearInterval(runTimer);
}