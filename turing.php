<script src='fsm_turing.js'></script>

<input id="program_header" class="program_header" type="text", value="Turing program #1">

<div id="turing_frame" class="turing_frame">
	<canvas class='turing_tape' id='turing_tape'>Обновите браузер</canvas>
	
	<table>
		<tr>
			<td class="cell_markup">
				<table id="turing_table" class="turing_table">
					<tr>
						<th>State</th><th>1</th><th>0</th><th>space</th>
					</tr>
					<tr>
						<td contenteditable='true'>q1</td>
						<td contenteditable='true'>q1 L 0</td>
						<td contenteditable='true'>q0 L 1</td>
						<td contenteditable='true'>q2 L 1</td>
					</tr>
					<tr>
						<td contenteditable='true'>q0</td>
						<td contenteditable='true'>q0 L 1</td>
						<td contenteditable='true'>q0 L 0</td>
						<td contenteditable='true'>STOP</td>
					</tr>
					<tr>
						<td contenteditable='true'>q2</td>
						<td contenteditable='true'>STOP</td>
						<td contenteditable='true'>STOP</td>
						<td contenteditable='true'>STOP</td>
					</tr>

				</table>
				<button class="button" onclick="addRow()">+</button>
			</td>
			<td class="cell_markup">
				<b><span id="txt_steps" class="plain_text">Steps: 0</span>&nbsp;&nbsp;&nbsp;
				<span id="txt_state" class="plain_text">State: q0</span><br></b>
				<button class="button" style="width:60px;" onclick="run()">RUN</button>
				<button class="button" style="width:60px;" onclick="stop()">STOP</button>
				<!--<button class="button" style="width:60px;" onclick="stop()">STEP</button> --><br>
				<button class="button" style="width:60px;" onclick="writeValue('1')">&nbsp;1&nbsp;</button>
				<button class="button" style="width:60px;" onclick="writeValue('0')">&nbsp;0&nbsp;</button>
				<button class="button" style="width:60px;" onclick="writeValue('-')">&nbsp;-&nbsp;</button><br>
				<button class="button" style="width:60px;" onclick="moveLeft()">&#8656;</button>
				<button class="button" style="width:60px;" onclick="moveRight()">&#8658;</button><br><br>
			</td>
		</tr>
	</table>
</div>