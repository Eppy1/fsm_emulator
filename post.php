<script src='fsm_post.js'></script>

<style>
	#code_area {
		display: block;
		border: 1px solid #333;
		border-radius: 1mm;
		resize: vertical;
		width: 100%;
		height: 480px;
	}
</style>

<input id="program_header" class="program_header" type="text", value="Post program #1">

<div id="post_frame" class="turing_frame">
	<canvas class='turing_tape' id='post_tape'>Обновите браузер</canvas>
	
	<table>
		<tr>
			<td class="cell_markup" style="width:50%">
				<div contenteditable="true" id="code_area">
					1 L<br>2 ? 1 3<br>3 X<br>4 R<br>5 ? 4 6<br>6 X<br>7 R<br>8 ? 9 1<br>9 !<br>
				</div>
			</td>
			<td class="cell_markup">
				<b><span id="txt_steps" class="plain_text">Steps: 0</span>&nbsp;&nbsp;&nbsp;
				<span id="txt_state" class="plain_text">State: q0</span><br></b>
				<button class="button" style="width:60px;" onclick="run()">RUN</button>
				<button class="button" style="width:60px;" onclick="stop()">STOP</button>
				<button class="button" style="width:60px;" onclick="stop()">STEP</button><br>
				<button class="button" style="width:60px;" onclick="writeValue('1')">&nbsp;1&nbsp;</button>
				<button class="button" style="width:60px;" onclick="writeValue('0')">&nbsp;0&nbsp;</button>
				<button class="button" style="width:60px;" onclick="writeValue('-')">&nbsp;-&nbsp;</button><br>
				<button class="button" style="width:60px;" onclick="moveLeft()">&#8656;</button>
				<button class="button" style="width:60px;" onclick="moveRight()">&#8658;</button><br><br>
			</td>
		</tr>
	</table>
</div>