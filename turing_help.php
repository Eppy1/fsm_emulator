<h2> Turing machine </h2>

A Turing machine is a mathematical model of computation that defines an abstract machine, which manipulates symbols on a strip of tape according to a table of rules. Despite the model's simplicity, given any computer algorithm, a Turing machine capable of simulating that algorithm's logic can be constructed.
The machine operates on an infinite memory tape divided into discrete "cells". The machine positions its "head" over a cell and "reads" or "scans" the symbol there. Then, as per the symbol and its present place in a "finite table" of user-specified instructions, the machine (i) writes a symbol (e.g., a digit or a letter from a finite alphabet) in the cell (some models allowing symbol erasure or no writing), then (ii) either moves the tape one cell left or right (some models allow no motion, some models move the head), then (iii) (as determined by the observed symbol and the machine's place in the table) either proceeds to a subsequent instruction or halts the computation.
The Turing machine was invented in 1936 by Alan Turing, who called it an "a-machine" (automatic machine). With this model, Turing was able to answer two questions in the negative: (1) Does a machine exist that can determine whether any arbitrary machine on its tape is "circular" (e.g., freezes, or fails to continue its computational task); similarly, (2) does a machine exist that can determine whether any arbitrary machine on its tape ever prints a given symbol. Thus by providing a mathematical description of a very simple device capable of arbitrary computations, he was able to prove properties of computation in general—and in particular, the uncomputability of the Entscheidungsproblem ("decision problem").

<hr>

<button class="button" style="width:60px;">RUN</button> - To execute code;<br>
<button class="button" style="width:60px;">STOP</button> - For stop code execution;<br>
<button class="button" style="width:60px;">&nbsp;1&nbsp;</button>
<button class="button" style="width:60px;">&nbsp;0&nbsp;</button>
<button class="button" style="width:60px;">&nbsp;-&nbsp;</button> - For write a symbol on a cell;<br>
<button class="button" style="width:60px;">&#8656;</button>
<button class="button" style="width:60px;">&#8658;</button> - Move tape left or right.<br><br>

<button class="button">+</button> - Adds a new row in a table.