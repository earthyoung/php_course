<?php

function course_update($form_dest, $course_id, $course_name, $instructor_name, $category, $description, $open_date){
	$form = "
	<form align=center action=$form_dest method='post'>
		<div class='mb-3'>
			<label class='form-label'>course id</label>
			<input type='text' class='form-control' name='course_id' value=$course_id readonly>
		</div>
		<div class='mb-3'>
			<label class='form-label'>course name</label>
			<input type='text' class='form-control' value=$course_name readonly>
		</div>
		<div class='mb-3'>
			<label class='form-label'>instructor name</label>
			<input type='text' class='form-control' value=$instructor_name readonly>
		</div>
		<div class='mb-3'>
			<label class='form-label'>open date</label>
			<input type='text' class='form-control' value=$open_date readonly>
		</div>
		<div class='mb-3'>
			<label class='form-label'>category</label>
			<input type='text' value=$category class='form-control' name='category'>
		</div>
		<div class='mb-3'>
			<label class='form-label'>description</label>
			<textarea class='form-control' name='description'>$description</textarea>
		</div>
		<button type='submit' class='btn btn-primary'>Update</button>
	</form>
	";
	
	return $form;
}

?>