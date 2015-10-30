<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();
$response["success"] = 0;

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);


if(isset($_POST['update_id']) && isset($_POST['weight']) && isset($_POST['reps']))
{
	$id = intval($_POST['update_id']);
	$weight = intval($_POST['weight']);
	$reps = intval($_POST['reps']);
	
	$exercise = R::load('exercises', $id);
	$exercise->weight = $weight;
	$exercise->reps = $reps;	
	R::store($exercise);
	
	$response["success"] = 1;
	
}
else{
	$response["success"] = 0;
}

R::close();
echo json_encode($response);

?>