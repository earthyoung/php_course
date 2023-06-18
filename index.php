<?php

include "util.php";

$form = "
<h1>Course Website</h1>
<br>
<div class='mx-auto p-2' align=center><button type='button' class='btn btn-light'><a href='login_student_table.php'>Login as Student</a></button></div>
<br>
<div class='mx-auto p-2' align=center><button type='button' class='btn btn-light'><a href='login_instructor_table.php'>Login as Instructor</a></button></div>
<br>
<div class='mx-auto p-2' align=center><button type='button' class='btn btn-light'><a href='join_student_table.php'>Join as Student</a></button></div>
<br>
<div class='mx-auto p-2' align=center><button type='button' class='btn btn-light'><a href='join_instructor_table.php'>Join as Instructor</a></button></div>
";


$form_h = basis($form, "");
echo $form_h;

?>