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
	&& isset($_POST['exercise_complete']) && isset($_POST['date']))
{
	$workout_result = array();
	$workout_id = -1;
	$workout_result = R::findOne('workouts', 'workout_date = ?', array($_POST['date']));
	
	if(empty($workout_result))
	{
		$workout = R::dispense('workouts');
		$workout->user_id = 27; //hardcoded for now until I get username working.
		$newdate = date('Y-m-d', strtotime($_POST['date']));
		$workout->workout_date = $newdate;
		$workout_id = R::store($workout);
		
	}

	else{
		$workout_id = $workout_result->getId();
	}
	
	$exercise = R::dispense('exercises');
	$exercise->workout_id = $workout_id;
	$exercise->exercise_name = $_POST['exercise_name'];
	$exercise->weight = $_POST['weight'];
	$exercise->reps = $_POST['reps'];
	
	if($_POST['exercise_complete'] == "false")
		$exercise->exercise_complete = 0;
	else
		$exercise->exercise_complete - 1;
	
	$exercise_id = R::store($exercise);
	
	$response["success"] = 1;
	$response["error_message"] = "All fields set";

}

R::close();
echo json_encode($response);

?>