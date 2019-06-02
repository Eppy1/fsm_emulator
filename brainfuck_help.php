<h2> Brainfuck </h2>

Brainfuck is an esoteric programming language created in 1993 by Urban Müller, and is notable for its extreme minimalism.

The language consists of only eight simple commands and an instruction pointer. While it is fully Turing complete, it is not intended for practical use, but to challenge and amuse programmers. Brainfuck simply requires one to break commands into microscopic steps.

The language's name is a reference to the slang term brainfuck, which refers to things so complicated or unusual that they exceed the limits of one's understanding.
<hr>

<ul>
  <li><b>></b> increment the data pointer</li>
  <li><b><</b> decrement the data pointer</li>
  <li><b>+</b> increment </li>
  <li><b>-</b> decrement </li>
  <li><b>.</b> output the byte at the data pointer</li>
  <li><b>,</b> accept one byte of input, storing its value in the byte at the data pointer</li>
  <li><b>[</b> if the byte at the data pointer is zero, then instead of moving the instruction pointer forward to the next command, jump it forward to the command after the matching ] command</li>
  <li><b>]</b> if the byte at the data pointer is nonzero, then instead of moving the instruction pointer forward to the next command, jump it back to the command after the matching [ command</li>
</ul>

<hr>

<button class="button" style="width:64px">RUN</button> - Runs the program<br>
<button class="button" style="width:64px">RESET</button> - Resets the program<br>
