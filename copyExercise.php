<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();
$response["success"] = 0;
$response["new_id"] = -1;

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);


if(isset($_POST['copy_id']))
{
	$id = intval($_POST['copy_id']);
	
	// Load the exercise to be copied based on the given id
	// and duplicate it.
	$exercise = R::load('exercises', $id);
	$exercise_copy = R::duplicate($exercise);
	$response["new_id"] = R::store($exercise_copy);
	$response["success"] = 1;
	
 }
else{
	$response["success"] = 0;
	$response["new_id"] = -1;
}

R::close();
echo json_encode($response);

?>