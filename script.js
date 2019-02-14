var CELL_SIZE = 48;

var tape_tab = 0;
var tape_dir = 0;

var tape_arr = [];
var pos = 0;
var steps = 0;
var current_state = "q0";
var running = 0;

var states = [];

var header = "Turing program #1"

class TuringOp {
	constructor(str) {
		var a = str.split(" ");
		this.next = a[0];
		this.move = a[1];
		this.write = a[2];
		
		//alert(this.next + "~" + this.move + "~" + this.write);
	}
}

class TuringState {
	constructor(name, on1, on0, on_) {
		this.name = name;
		this.on1 = on1;
		this.on0 = on0;
		this.on_ = on_;
	}
}

function drawTape() {
	tape = document.getElementById('turing_tape');
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
	tape = document.getElementById('turing_tape');
	tape.width = document.getElementById('turing_frame').offsetWidth-2;
	tape.height = CELL_SIZE+16+16;
}

function redraw() {
	tape_tab += tape_dir * 2.8;

	if(Math.abs(tape_tab) >= CELL_SIZE+4) {
		pos -= tape_dir;
		tape_tab = tape_dir = 0;
	}
	
	if(running) {
		if(tape_dir == 0 && tape_tab == 0) {

			for(i=0; i<states.length; i++) {
				document.getElementById('turing_table').rows[i+1].style.backgroundColor = "#fff";
			}

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

function setWord(word) {
	for(i=0; i<word.length; i++) {
		if(word[i] == '1' || word[i] == '0') {
			tape_arr[pos+i] = word[i];
		}
	}
}

function selectCell(cell) {
	cell.css("background-color", "yellow");
	document.getElementById("test").textContent = "" + cell.className;
}

function addRow() {
	var table = document.getElementById("turing_table");
	var n = table.getElementsByTagName("tr").length;
	var row = table.insertRow(n);
	var cell1 = row.insertCell(0); cell1.contentEditable = "true";
	var cell2 = row.insertCell(1); cell2.contentEditable = "true"
	var cell3 = row.insertCell(2); cell3.contentEditable = "true"
	var cell4 = row.insertCell(3); cell4.contentEditable = "true"
	cell1.innerHTML = "q" + n;
	cell2.innerHTML = "";
	cell3.innerHTML = "";
	cell4.innerHTML = "";
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

function interpretate() {
	var table = document.getElementById("turing_table");
	var n = table.getElementsByTagName("tr").length;

	states = [];

	for(i=1; i<n; i++) {
		var name = table.rows[i].cells[0].textContent;
		var on1  = table.rows[i].cells[1].textContent;
		var on0  = table.rows[i].cells[2].textContent;
		var on_  = table.rows[i].cells[3].textContent;
		
		states.push(new TuringState(name, new TuringOp(on1), new TuringOp(on0), new TuringOp(on_)))
	}
}

function run() {
	interpretate();
	steps = 0;
	running = 1;
}

function stop() {
	running = 0;
	//tape_dir = tape_tab = 0;
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

window.onload = setup;
window.onresize = resizeTape;