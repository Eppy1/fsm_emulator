var CELL_SIZE = 48;

var tape_tab = 0;
var tape_dir = 0;

var tape_arr = [];
var pos = 0;
var steps = 0;
var current_state = "q0";
var running = 0;

var program_id = 0;

var header = "Post program #1"

function drawTape() {
	tape = document.getElementById('post_tape');
	ctx = tape.getContext('2d');
	
	ctx.strokeStyle = '#003';
	ctx.fillStyle = '#fff';
	ctx.font = "48px Courier";
	ctx.fillRect(0, 4, tape.width, CELL_SIZE+16+10);

	var w = tape.width;

	for(var i=-10; i<w/(CELL_SIZE+4); i++) {
		x = w/2 - (CELL_SIZE+4)/2 + (CELL_SIZE+4)*i + tape_tab
		y = 16

		ctx.fillStyle = '#fff';
		ctx.fillRect(x, y, CELL_SIZE, CELL_SIZE);
		ctx.strokeRect(x, y, CELL_SIZE, CELL_SIZE);

		ctx.fillStyle = '#222';
		if(tape_arr[pos+i] == '1' || tape_arr[pos+i] == '0') {
			ctx.fillText(tape_arr[pos+i], x+11.5, y+40);
		}
	}

	ctx.fillStyle = '#a03';
	ctx.beginPath();
    ctx.moveTo(w/2, 16 + CELL_SIZE - 10);
    ctx.lineTo(w/2-8, 16 + CELL_SIZE - 10 + 24);
    ctx.lineTo(w/2+8, 16 + CELL_SIZE - 10 + 24);
    ctx.fill();
}

function resizeTape() {
	tape = document.getElementById('post_tape');
	tape.width = document.getElementById('post_frame').offsetWidth-2;
	tape.height = CELL_SIZE+16+16;
}

function hliteCode() {
	var code_area = document.getElementById('code_area');
	var rex = /(<([^>]+)>)/ig;
	var text = code_area.innerHTML.replace(/<br>/g,"||").replace(rex, "").trim();
	var result = "";
	var arr = text.split("||");

	for(i=0; i<arr.length; i++) {
		var str = arr[i];

		var j = 0;
		for(; j<str.length; j++) {
			if(str[j] == '.') {
				result += '<span style="font-weight: bold">' + str.substr(0, j+1) + "</span>" + str.substr(j+1) + "<br>";
				flag = 1;
				break;
			}
			if(j >= str.length)  result += '<span style="color: red">' + str + "</span><br>";
		}
	}

	code_area.innerHTML = result;
}

function redraw() {
	tape_tab += tape_dir * 2.8;

	if(Math.abs(tape_tab) >= CELL_SIZE+4) {
		pos -= tape_dir;
		tape_tab = tape_dir = 0;
	}
	
	if(running) {
		if(tape_dir == 0 && tape_tab == 0) {
            /*
			for(i=0; i<states.length; i++) {
				document.getElementById('turing_table').rows[i+1].style.backgroundColor = "#fff";
			}
            */
			for(i=0; i<states.length; i++) {
				if(current_state == states[i].name) {
					document.getElementById('turing_table').rows[i+1].style.backgroundColor = "#fd9";

					steps++;
					document.getElementById('txt_steps').innerHTML = "Шагов: " + steps;

					var op = states[i].on_;

					switch(tape_arr[pos]) {
					case '1': op = states[i].on1; break;
					case '0': op = states[i].on0; break;
					}
					
					if(op.next == "STOP") {
						running = 0;
						break;
					}

					tape_arr[pos] = op.write;
					if(op.move == 'L') tape_dir = +1;
					if(op.move == 'R') tape_dir = -1;
					current_state = op.next;
					
					document.getElementById('txt_state').innerHTML = "Состояние: " + op.next;

					break;
				}
			}
		}
	}
    drawTape();
	setTimeout(redraw, 20);
}

function moveLeft() {
	tape_dir = +1;
}

function moveRight() {
	tape_dir = -1;
}

function writeValue(x) {
	if(x == '1' || x == '0') tape_arr[pos] = x;
	else tape_arr[pos] = ' '
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

function setWord(word) {
	for(i=0; i<word.length; i++) {
		if(word[i] == '1' || word[i] == '0') {
			tape_arr[pos+i] = word[i];
		}
	}
}

function setup() {
	resizeTape();
	setWord('1101');
	redraw();
	var title = document.getElementById('program_header');
	title.oninput = function() {
		header = title.value;
	}
}

window.onresize = resizeTape;
/*
window.onerror = function(msg, url, linenumber) {
    alert('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    return true;
}
*/