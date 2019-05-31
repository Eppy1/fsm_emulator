<script src='fsm_life.js'></script>

<style>
	#field {
		margin: auto;
		margin-top: 16px;
		border-collapse: collapse;
  		border: 1px solid #2d1e2d;
		border-radius: 1mm;
		font-size: x-small;
		background-color: #634c7f;
	}

	#field tr {
		height: 26px;
	}

	#field td {
  		border: 1px solid #a16cba;
		width: 16px;
		height: 26x;

		cursor:pointer;
		-webkit-transition: all 0.15s ease;;
		-moz-transition: all 0.15s ease;;
		-o-transition: all 0.15s ease;;
		transition: all 0.15s ease;
	}

	#field td:hover {
		background-color: #d6afc2;
	}

	.emptyCell {
		color: #a16cba;
		background-color: #634c7f;
  		font-weight: bold;
	}

	.fullCell {
		color: #634c7f;
  		font-weight: bold;
		background-color: #a16cba;
	}

</style>

<input id="program_header" class="program_header" type="text" style="width:400px" value="The Game of Life program #1">

<div id="life_frame" class="turing_frame">
	<table id='field'> </table>

	<button class="button" onclick="run()">RUN</button>
	<button class="button" onclick="step();">STEP</button>
	<button class="button" onclick="reset()">RESET</button><br>
	<button class="button" onclick="stop()">STOP</button><br>
</div>