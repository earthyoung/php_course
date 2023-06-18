<?php

include "../util.php";
include "util.php";

$title = $_POST["title"];
$category = $_POST["category"];
$description = $_POST["description"];
$price = $_POST["price"];
$date = date('Y-m-d');
$instructor = $_COOKIE["id"];

if($title == "" or $category == "" or $description == "" or $price == "" or $instructor == ""){
	$url = url_main."course_instructor/course_by_instructor_list.php";
	alert("You should enter all values in the form.", $url);
} else {
	$conn = mysqli_connect(servername, username, password, db_name);
	$sql = "INSERT INTO course (title, category, description, price, open_date, instructor) VALUES('$title', '$category', '$description', '$price', '$date', '$instructor')";
	$query = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);
	mysqli_close($conn);
	
	if(!$query){
		alert("An SQL error occurred.", course_page());
	}
	
	$url = url_main."course_instructor/course_detail.php?course_id=$id";
	header( "Location: $url" );
	}

?>