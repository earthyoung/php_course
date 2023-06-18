<?php

include "../util.php";
include "util.php";

$conn = mysqli_connect(servername, username, password, db_name);
$course_id = $_GET["course_id"];
$sql = "select course.title, instructor.name, course.category, course.description, course.open_date from course inner join instructor on course.instructor = instructor.id where course.id = $course_id";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);

$form = course_update("course_update.php", $course_id, $result[0], $result[1], $result[2], $result[3], $result[4]);
echo basis($form, "");

?>