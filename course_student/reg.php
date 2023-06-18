<?php

include "util.php";

$type = @$_COOKIE["type"];
if ($type != "student") {
	alert("Only student can register courses.", url_course);
}

$conn = mysqli_connect(servername, username, password, db_name);
$course_id = $_GET["course_id"];
$student_id = $_COOKIE["id"];
$student_name = $_COOKIE["name"];

$sql = "select course.title, course.price, instructor.id, instructor.name from course inner join instructor on course.instructor = instructor.id where course.id=$course_id";
$query = mysqli_query($conn, $sql);

$result = mysqli_fetch_array($query);
$row_num = mysqli_num_rows($query);
if ($row_num == "") {
	$row_num = 0;
}

$course_title = $result[0];
$course_point = $result[1];
$instructor_id = $result[2];
$instructor_name = $result[3];
$register_date = date('Y-m-d'); 

$form = "<form action='register.php' method='post'>
	<table align=center>
		<tr><td>course title</td><td>instructor name</td><td>course point</td><td>register date</td><td>course id</td></tr>
		<tr>
			<td><input type='text' name='course_title' value='$course_title' readonly></td>
			<td><input type='text' name='instructor_name' value='$instructor_name' readonly></td>
			<td><input type='text' name='course_point' value='$course_point' readonly></td>
			<td><input type='text' name='register_date' value='$register_date' readonly></td>
			<td><input type='text' name='course_id' value='$course_id' readonly></td>
		</tr>
		<tr><td align=center colspan='5'><input type='submit' class='btn btn-primary' value='submit'></td></tr></table></form>";

// echo "hi";

echo basis($form, "");
mysqli_close($conn);


?>