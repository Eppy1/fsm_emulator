var program_id = 0;

var header = "Brainfuck program #1"

var main_arr = [];
var pos = 0;
var code_pos = 0;
var code = "";
var code_reserved = "";
var stack = [0];
var interp = undefined;

function step() {
	var text = code;
	var c = text[code_pos];

	if(typeof main_arr[pos] == 'undefined') {
		main_arr[pos] = 0;
	}

	if(c == '>') pos++;
	if(c == '<') pos--;
	if(c == '+') main_arr[pos]++;
	if(c == '-') main_arr[pos]--;
	if(c == '.') {
		document.getElementById('output_area').innerHTML += String.fromCharCode(main_arr[pos]);
	}
	if(c == '[') {
		if(main_arr[pos] == 0) {
			while(text[code_pos] != ']') code_pos++;
		} else stack.push(code_pos);
	}

	if(c == ']') {
			code_pos = stack.pop()-1;
	}

	code_pos++;

	var code_area = document.getElementById('code_area');

	if(code_pos >= code.length-1) {
		code_area.innerHTML = code;
	} else code_area.innerHTML = code.substr(0, code_pos-1) + '<span style="color: white; background-color: #634c7f">' + text[code_pos] +'</span>'+ code.substr(code_pos+1)
}

function runCode() {
	
	document.getElementById('output_area').innerHTML = "> ";
	var code_area = document.getElementById('code_area');
	code = code_area.innerText.trim();
	code_reserved = code.trim();
	main_arr = [];
	pos = 0;
	code_pos = 0;
	updateMemory();

	interp = setInterval(function() {
		 step();
		 updateMemory();
		 if(code_pos >= code.length) {
				code_area.innerHTML = code;
				clearTimeout(interp);
		 }
		}, 20);
}

function makeCode() {
	return code_area.innerText.trim();
}

function saveCode() {
	var code1 = makeCode();
	var request = $.ajax({
		url: "fsm_save.php",
		type: "POST",
		data: {func: "save", id: program_id, code: code1, fsm: "brainfuck", name: header},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
			if(!msg.includes("UPDATE")) {
				window.location.replace("/page_fsm.php?fsm=brainfuck&id="+msg);
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

function updateMemory() {
	var table = '<table style="border"><tr><th>#</th>';

	for(var i=0; i<16; i++) table += '<th>' + i.toString(16) + '</th>';

	table += '<th>char</th></tr>';

	for(var i=0; i<16; i++) {
		table += '<tr><th>' + i.toString(16) + '</th>';

		for(var j=0; j<16; j++) {

			table += '<td>';
			if(pos == i*16+j) table += '<u><b>';

			table += (main_arr[i*16+j] == undefined ? '00' : ( parseInt((main_arr[i*16+j]/16)).toString(16) + (main_arr[i*16+j]%16).toString(16) ) ); 
		
			if(pos == i*16+j) table += '</u></b>';
			table += '</td>';
		}

		table += '<td>';

		for(var j=0; j<16; j++) {
			table += main_arr[i*16+j] == undefined ? '<span style="color:#999;">&middot;</span>' : String.fromCharCode(main_arr[i*16+j]);
		}

		table += '</td>';

		table += '</tr>';
	}

	table += '</table>';

	document.getElementById('memory_area').innerHTML = table;
}

function setup() {
	var title = document.getElementById('program_header');
	title.oninput = function() {
		header = title.value;
	}

	updateMemory();

	setInterval(function() {
		if(interp != undefined) return;
		var code_area = document.getElementById('code_area');
		code_area.innerHTML = code_area.innerText
	}, 100);
}

function reset() {
	if(interp != undefined) clearTimeout(interp);
	main_arr = [];
	pos = 0;
	code_pos = 0;
	document.getElementById('output_area').innerHTML = '> ';
	updateMemory();
}

function stepFromGui() {
	step();
	updateMemory();
}

/*
window.onerror = function(msg, url, linenumber) {
    alert('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    return true;
}
*/