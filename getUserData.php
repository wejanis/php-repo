<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);

//Grab data from the URL
$username = $_GET['username'];
$date = $_GET['exercise_date'];

//Find the bean of the user in the database
$username_result = R::findOne('user', 'username = ?', array($username));

//grab the user's id
$user_id = $username_result->getId();

//Find all of the exercises in the db that have the user's id
$exercises = R::getAll( 
	'select id, exercise_name, weight, reps, exercise_complete 
	 from exercises 
	 where user_id = :user_id AND exercise_date = :date', 
	 array(':user_id' => $user_id,':date' => $date)
	);

//encode exercise data in json
echo json_encode($exercises);

?>