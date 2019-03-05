<?php include 'header.php' ?>
<?php include 'utils.php'  ?>

<div class="content">
<h2 align="center">
<?php
	$name = getCurrentUserName();
	if($name != '-') echo "Welcome, ".$name."!";
	else echo "Welcome!";
?>
</h2>
A <i>finite-state machine</i> is a mathematical model of computation.
It is an abstract machine that can be in
exactly one of a finite number of states at any given time.
The FSM can change from one state to another in response to some external inputs;
the change from one state to another is called a transition. An FSM is defined by a
list of its states, its initial state, and the conditions for each transition. Finite
state machines are of two types – deterministic finite state machines and
non-deterministic finite state machines. A <i>deterministic finite-state
machine</i> can be constructed equivalent to any non-deterministic one.
	<center>
		<button class="button" onclick="alert('xyi')">
			<h2>Try It!</h2>
		</button>
	</center>
<br><br><br>
	
<div width=640px>
	<?php include 'psearch_form.php' ?>
	<script>  psearch_update("1 ORDER BY rating DESC, last_change DESC"); </script>
</div>
</div>


<?php include 'footer.php' ?>