<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();
$response["success"] = 0;
$response["error_message"] = "A required field is missing";

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);


if(isset($_POST['exercise_name']) && isset($_POST['weight']) && isset($_POST['reps']) 
	&& isset($_POST['exercise_complete']) && isset($_POST['date']) && isset($_POST['username']) && isset($_POST['sets']))
{

	$username_result = R::findOne('user', 'username = ?', array($_POST['username']));
	$user_id = $username_result->getId();

	$exercise = R::dispense('exercises');
	$exercise->user_id = $user_id;
	$exercise->exercise_name = $_POST['exercise_name'];
	$exercise->weight = $_POST['weight'];
	$exercise->reps = $_POST['reps'];
	$exercise->sets = $_POST['sets'];
	
	$date = date('Y-m-d', strtotime($_POST['date']));
	$exercise->exercise_date = $date;
	
	if($_POST['exercise_complete'] == "false")
		$exercise->exercise_complete = 0;
	else
		$exercise->exercise_complete = 1;
	
	$exercise_id = R::store($exercise);
	
	$response["success"] = 1;
	$response["error_message"] = "All fields set";

}

R::close();
echo json_encode($response);

?>