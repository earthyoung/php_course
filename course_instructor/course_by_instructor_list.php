<?php

include "../util.php";

$instructor_id = $_COOKIE["id"];
$conn = mysqli_connect($servername, $username, $password, $db_name);
$sql = "select course.id, course.title, course.category from course inner join instructor on course.instructor = instructor.id where instructor.id = '$instructor_id'";
$query = mysqli_query($conn, $sql);
$row_num = mysqli_num_rows($query);


if($row_num == "") {
	$row_num = 0;
}

$form = "<p align=center>$row_num records in total.</p>";
$form = $form.form();

for($i=1; $i<=$row_num; $i++){
	$result = mysqli_fetch_array($query);
	$form = $form.course_by_instructor_list($result[0], $result[1], $result[2]);
}
$form = $form."</table>";

echo basis($form, "");
mysqli_close($conn);

function course_by_instructor_list($course_id, $course_name, $category){
	$url_r = url_main."course_instructor/course_detail.php?course_id=$course_id";
	$url_u = url_main."course_instructor/course_update_table.php?course_id=$course_id";
	$url_s = url_main."course_instructor/course_student_list.php?course_id=$course_id";
	$form = "
	<tr>
		<td align=center><a href=$url_r>$course_name</a></td>
		<td align=center>$category</td>
		<td align=center><a href=$url_u>Update</a></td>
		<td align=center><a href=$url_s>Students</a></td>
	</tr>
	";
	return $form;
}

function form(){
	return "
	<table class='table' align=center>
		<tr class='table-primary'>
			<td align=center>course name</td>
			<td align=center>category</td>
			<td align=center>Update</td>
			<td align=center>Students</td>
		</tr>";
}

?>