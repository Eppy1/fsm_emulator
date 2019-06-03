var CELL_SIZE = 48;

var tape_tab = 0;
var tape_dir = 0;

var tape_arr = [];
var program = [];
var pos = 0;
var steps = 0;
var running = 0;
var curr_line = 1;

var program_id = 0;

var header = "Post program #1"

function drawTape() {
	tape = document.getElementById('post_tape');
	ctx = tape.getContext('2d');
	
	ctx.strokeStyle = '#2d1e2d';
	ctx.fillStyle = '#fff';
	ctx.font = "48px Courier";
	ctx.fillRect(0, 4, tape.width, CELL_SIZE+16+10);

	var w = tape.width;

	for(var i=-20; i<w/(CELL_SIZE+4); i++) {
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
    ctx.lineTo(w/2-8, 16 + CELL_SIZE - 11 + 24);
    ctx.lineTo(w/2+8, 16 + CELL_SIZE - 11 + 24);
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

function interpretate() {
	var text = code_area.innerText;
	var lines = text.split(String.fromCharCode(10));
	program = [];
	for(var i=0; i<lines.length; i++) {
		lines[i] = lines[i].replace('\t', ' ').replace('  ', ' ').replace('  ', ' ');
		var line = lines[i].split(' ');

		var n = parseInt(line[0]);
		if(i == 0) curr_line = n;
		program[n] = []
		for(var j=1; j<line.length; j++) {
			program[n][j-1] = line[j];
		}
	}
}

function run() {
	interpretate();
	steps = 0;
	running = 1;
}

function redraw() {
	tape_tab += tape_dir * 2.8;

	if(Math.abs(tape_tab) >= CELL_SIZE+4) {
		pos -= tape_dir;
		tape_tab = tape_dir = 0;
	}
	
	if(running) {
		if(tape_dir == 0 && tape_tab == 0) {

			var line = program[curr_line];
			
			steps++;
			document.getElementById('txt_steps').innerHTML = "Steps: " + steps;
			curr_line++;
			switch(line[0]) {
				case 'L': tape_dir = +1; break;
				case 'R': tape_dir = -1; break;
				case 'X': tape_arr[pos] = '0'; break;
				case 'V': tape_arr[pos] = '1'; break;
				case '-': tape_arr[pos] = '-'; break;
				case '!': running = 0; break;
				case '?': curr_line = tape_arr[pos] == '1' ? line[1] : line[2]; break;
			}

			document.getElementById('txt_state').innerHTML = "State: " + curr_line;
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
	var code = code_area.innerText;
	for(var i=0; i<code.length; i++) code = code.replace(String.fromCharCode(10), '#').trim();
	alert(code);
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
				window.location.replace("/page_fsm.php?fsm=post&id="+msg);
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

	for(var i=0; i<arr[2].length; i++) arr[2] = arr[2].replace('#', '<br>');
    document.getElementById("code_area").innerHTML = arr[2];
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

function stop() {
	running = 0;
}

window.onresize = resizeTape;
/*
window.onerror = function(msg, url, linenumber) {
    alert('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    return true;
}
*/