<?php

include "../util.php";
include "util.php";

$conn = mysqli_connect(servername, username, password, db_name);
$course_id = $_POST["course_id"];
$category = $_POST["category"];
$description = $_POST["description"];


$sql = "update course set category='$category', description='$description' where id='$course_id'";
mysqli_query($conn, $sql);


$sql = "select course.title, instructor.name, course.category, course.description, course.open_date from course inner join instructor on course.instructor = instructor.id where course.id = $course_id";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);
$form = course_detail($result[0], $result[1], $result[2], $result[3], $result[4]);
echo basis($form, "");

?>