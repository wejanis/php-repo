<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();
$response["success"] = 0;

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );

//The post request must include an id, weight, and reps
if(isset($_POST['update_id']) && isset($_POST['weight']) && isset($_POST['reps']))
{
	//Convert post data to ints
	$id = intval($_POST['update_id']);
	$weight = intval($_POST['weight']);
	$reps = intval($_POST['reps']);
	
	// Load the bean from the database and update the values 
	// based on the post data, then store it.
	$exercise = R::load('exercises', $id);
	$exercise->weight = $weight;
	$exercise->reps = $reps;	
	R::store($exercise);
	
	//Send a successful json response
	$response["success"] = 1;
	
}
else{
	//Send an unsuccessful json response.
	$response["success"] = 0;
}

//Close connection to the database
R::close();
echo json_encode($response);

?>