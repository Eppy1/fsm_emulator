<script src='fsm_markov.js'></script>

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

<input id="program_header" class="program_header" type="text", value="Markov program #1">

<div id="markov_frame" class="turing_frame">
	<div id='output_area' contenteditable="true">101</div>
	<div contenteditable="true" id="code_area">
	1 -> 0!;<br>
	!0 -> 0!!;<br>
	0 ->;<br>
	</div>
</div>
	<button class="button" style="width:64px" onclick="step()">STEP</button>