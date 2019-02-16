<script src='fsm_turing.js'></script>

<input style="border:none" id="program_header" class="program_header" type="text", value="Turing program #1">

<div id="turing_frame" class="turing_frame">
	<canvas class='turing_tape' id='turing_tape'>Обновите браузер</canvas>
	
	<table>
		<tr>
			<td class="cell_markup">
				<table id="turing_table" class="turing_table">
					<tr>
						<th>Состояние</th><th>1</th><th>0</th><th>Пусто</th>
					</tr>
					<tr>
						<td contenteditable='true'>q0</td>
						<td contenteditable='true'>q1 L 1</td>
						<td contenteditable='true'>q1 R 1</td>
						<td contenteditable='true'>q0 R Пусто</td>
					</tr>
					<tr>
						<td contenteditable='true'>q1</td>
						<td contenteditable='true'>q0 R 0</td>
						<td contenteditable='true'>q0 L 0</td>
						<td contenteditable='true'>q0 R Пусто</td>
					</tr>
				</table>
				<button class="button" onclick="addRow()">+</button>
			</td>
			<td class="cell_markup">
				<span id="txt_steps" class="plain_text">Шагов: 0</span> <br>
				<span id="txt_state" class="plain_text">Состояние: q0</span><br>
				<button class="button" onclick="run()">RUN</button>
				<button class="button" onclick="stop()">STOP</button>
				<button class="button" onclick="stop()">STEP</button><br>
				<button class="button" onclick="writeValue('1')">1</button>
				<button class="button" onclick="writeValue('0')">0</button>
				<button class="button" onclick="writeValue('-')">-</button><br>
				<button class="button" onclick="moveLeft()"><-</button>
				<button class="button" onclick="moveRight()">-></button><br><br>
			</td>
		</tr>
	</table>
</div>