<html>
	<head>
		<link href="style.css" rel="stylesheet">
		<meta charset='utf-8'/>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="script.js"></script>
	</head>

	<body>
		<?php echo 'kek' ?>

		<input id="program_header" class="program_header" type="text", value="Turing program #1">

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
						<button onclick="addRow()">+</button>
					</td>
					<td class="cell_markup">
						<span id="txt_steps" class="plain_text">Шагов: 0</span> <br>
						<span id="txt_state" class="plain_text">Состояние: q0</span><br>
						<button onclick="run()">RUN</button>
						<button onclick="stop()">STOP</button>
						<button onclick="stop()">STEP</button><br>
						<button onclick="writeValue('1')">1</button>
						<button onclick="writeValue('0')">0</button>
						<button onclick="writeValue('-')">-</button><br>
						<button onclick="moveLeft()"><-</button>
						<button onclick="moveRight()">-></button>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>