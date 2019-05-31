var program_id = 0;

var header = "The Game of life program #1"

var main_arr = [];
var reserved_arr = [];
var field = undefined;

var WIDTH = 36
var HEIGHT = 18

var running = false;
var runTimer = undefined;

function step() {
	makeIteration();
}

function run() {
	running = true;

	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			reserved_arr[i*WIDTH+j] = main_arr[i*WIDTH+j];
		}
	}

	runTimer = setInterval(step, 200);
}

function makeCode() {
	var code = "";
	/**
     * TODO
     * TODO
     */
	return code;
}

function saveCode() {
	var code1 = makeCode();
	var request = $.ajax({
		url: "fsm_save.php",
		type: "POST",
		data: {func: "save", id: program_id, code: code1, fsm: "post", name: header},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
			if(!msg.includes("UPDATE")) {
				window.location.replace("/page_fsm.php?fsm=turing&id="+msg);
			}
	  });
	   
	  request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
	  });
}

function acceptProg(msg) {
    /*TODO
     *TODO
     */
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
	for(var i=0; i<HEIGHT; i++) {
		for(var j=0; j<WIDTH; j++) {
			main_arr[i*WIDTH+j] = reserved_arr[i*WIDTH+j];
		}
	}
	clearInterval(runTimer);
}

function stop() {
	clearInterval(runTimer);
}