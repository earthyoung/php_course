<?php

include "../util.php";

function course_read($course_title, $instructor_name, $course_point, $register_date, $course_id){
	$url_d = url_main."course_student/register_delete.php?course_id=$course_id";
	$url_r = url_main."course_instructor/course_detail.php?course_id=$course_id";
	
	$form = "
		<tr align=center>
			<td><a href=$url_r color:red>$course_title</a></td>
			<td>$instructor_name</td>
			<td>$course_point</td>
			<td>$register_date</td>
			<td><a href=$url_d color:red>Delete</a></td>
		</tr>
	";
	
	return $form;
}

?>

