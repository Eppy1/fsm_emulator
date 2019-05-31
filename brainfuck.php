<script src='fsm_brainfuck.js'></script>

<style>
	#code_area {
		display: block;
		border: 1px solid #333;
		border-radius: 1mm;
		resize: vertical;
		width: 100%;
		height: 320px;
		overflow: scroll;
	}

	#output_area {
		display: block;
		border: 1px solid #444;
		background-color: #444;
		font-family: Courier;
		color: white;
		border-radius: 1mm;
		resize: vertical;
		height: 160px;
		padding: 15px;
		overflow: scroll;
	}

	#memory_area {
		font-family: Courier;
		overflow: auto;
		display: block;
		border: 1px solid #333;
		background-color: #eee;
		border-radius: 1mm;
		height: 160px;
	}

	table {
		border-collapse: collapse;
		margin: auto;
		margin-top: 8px;
		margin-bottom: 8px;
	}

	td, th { border: 1px solid #333; }

</style>

<input id="program_header" class="program_header" type="text", value="Brainfuck program #1">

<div id="bf_frame" class="turing_frame">
	<div id='memory_area'></div>
	<div id='output_area'>>run me</div>
	<div contenteditable="true" id="code_area"> +++++++++++++++++++++++++++++++++++++++++++++
 +++++++++++++++++++++++++++.+++++++++++++++++
 ++++++++++++.+++++++..+++.-------------------
 ---------------------------------------------
 ---------------.+++++++++++++++++++++++++++++
 ++++++++++++++++++++++++++.++++++++++++++++++
 ++++++.+++.------.--------.------------------
 ---------------------------------------------
 ----.-----------------------.
	</div>
	<button class="button" style="width:64px" onclick="runCode()">RUN</button>
	<button class="button" style="width:64px" onclick="stepFromGui()">STEP</button>
	<button class="button" style="width:64px" onclick="reset()">RESET</button><br>
</div>