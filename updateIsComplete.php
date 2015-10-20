<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();
$response["success"] = 0;

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);


if(isset($_POST['is_complete']) && isset($_POST['exercise_id']))
{
	$id = intval($_POST['exercise_id']);
	$exercise_complete = intval($_POST['is_complete']);
	$exercise = R::load('exercises', $id);
	$exercise->exercise_complete = $exercise_complete;
	R::store($exercise);

	$response["success"] = 1;
	
}
else{
	$response["success"] = 0;
}

R::close();
echo json_encode($response);

?>