var program_id = 0;

var header = "Markov program #1"

var program = []
var interp = undefined


function runCode() {
	program = []
	var code_area = document.getElementById('code_area');
	var code = code_area.innerText.trim().split(';');
	curr = 0;

	for(var i=0; i<code.length; i++) {
		program[i] = code[i].split('->');
		program[i][program[i].length] = ' ';
		for(var j=0; j<program[i].length; j++) program[i][j] = program[i][j].trim();

		//alert(program[i]);
	}
	
	interp = setInterval(function() {
		 step();/*
		 if(curr >= program.length) {
				code_area.innerHTML = code;
				clearTimeout(interp);
		 }*/
		}, 500);
		
}

function step() {
	for(var k=0; i<program.length; k++) {
		var text = document.getElementById('output_area').innerText;
		for(var i=0; i<text.length; i++) text.replace(program[k][0], program[k][1]);
		document.getElementById('output_area').innerText = text;
	}
}

function makeCode() {
	/**
	 * TODO
	 * TODO
	 * TODO
	 */
	return "";
}

function saveCode() {
	var code1 = makeCode();
	var request = $.ajax({
		url: "fsm_save.php",
		type: "POST",
		data: {func: "save", id: program_id, code: code1, fsm: "markov", name: header},
		dataType: "html"
	  });
	   
	  request.done(function(msg) {
			if(!msg.includes("UPDATE")) {
				window.location.replace("/page_fsm.php?fsm=markov&id="+msg);
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
	/**
	 * TODO
	 * TODO
	 * TODO
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

function setup() {
	var title = document.getElementById('program_header');
	title.oninput = function() {
		header = title.value;
	}
}

function reset() {
	/**
	 * TODO
	 * TODO
	 */
}

/*
window.onerror = function(msg, url, linenumber) {
    alert('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    return true;
}
*/